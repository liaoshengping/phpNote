<?php


namespace container\functions;


use container\core\BaseClient;

class Struct extends BaseClient
{
    public $struct;
    public $structRelation;
    public $compatibleRelation = [];//兼容config里面的Relation配置

    /**
     * 结构
     * @param $table
     * @throws \Exception
     */
    public function structByTable($table)
    {
        if (empty($table)) {
            throw new \Exception("空的数据库结构");
        }

        $container = [];
        foreach ($table as $item) {


            $container[] = $item['COLUMN_NAME'];

            $struct_one = [
                'name' => $item['COLUMN_NAME'],
                'type' => $item['DATA_TYPE'],
                'comment' => $item['COLUMN_COMMENT'],
                'default' => $item['COLUMN_DEFAULT'],
                'origin_comment' => $item['COLUMN_COMMENT'],
                'tabel_name' => $item['TABLE_NAME'],
            ];
            if ($struct_one['name'] == 'created_at' && empty($item['commont'])) {
                $struct_one['comment'] = '创建时间';
            }
            if ($struct_one['name'] == 'deleted_at' && empty($item['commont'])) {
                $struct_one['comment'] = '删除时间';
            }
            if ($struct_one['name'] == 'updated_at' && empty($item['commont'])) {
                $struct_one['comment'] = '更新时间';
            }

            $help = $this->help($item['COLUMN_COMMENT']);

            if ($help) {
                $struct_one['help'] = $help; //help[这里填写帮助字段]
                $help_name = explode('help', $item['COLUMN_COMMENT']);
                $help_name = $help_name[0];
                $struct_one['comment'] = $help_name;
            }

            //枚举
            $enum = $this->enums($item['COLUMN_NAME'], $item['COLUMN_COMMENT']);

            if ($enum) {

                $struct_one['comment'] = $enum['key_note'];
                $struct_one['enum_name'] = $enum['key_note'];
                $struct_one['enum'] = $enum['data'];

            }

            //规则名字
            $validateData = $this->validateData($struct_one['origin_comment']);
            if ($validateData) {
                $rule_name = explode('rule', $struct_one['origin_comment']);
                $rule_name = $rule_name[0];
                $struct_one['comment'] = $rule_name;
            }


            //处理关联关系
            $relationRepo = [
                'hasMany',
                'hasOne',
                'belongsTo',
            ];
            foreach ($relationRepo as $relationStr) {
                $rule = $this->app->phpcommon->getPergByRule($relationStr, $struct_one['origin_comment']);
                if ($rule) {
                    foreach (explode(',', $rule) as $relationTable) {
                        $temp = [];
                        if (strstr($relationTable, ':')) {
                            $arr = explode(':', $relationTable);
                            $temp['table_name'] = $arr[0];
                            $relation_table_name = $temp['table_name'];

                            unset($arr[0]);
                            $temp['params'] = array_values($arr);
                        } else {
                            $temp['table_name'] = $relationTable;
                            $relation_table_name = $relationTable;
                        }


                        $foreignKey = $item['TABLE_NAME'] . '_id';
                        $ownerKey = 'id';


                        switch ($relationStr) {
                            case 'belongsTo':
                                $foreignKey = $relation_table_name.'_id';
                                break;
                            default:
                                if (!empty($structInfo['params'][1])) {
                                    $foreignKey = $structInfo['params'][1];
                                }
                                if (!empty($structInfo['params'][0])) {
                                    $ownerKey = $structInfo['params'][0];
                                }
                                break;
                        }


                        $this->compatibleRelation[] = [
                            'relation' => $relationStr,
                            'tables' => [
                                [
                                    'table_name' => $relation_table_name,
                                    'relation_name' => camel_case($relation_table_name),
                                    'target' => $foreignKey, //目标表中的字段
                                    'origin' => $ownerKey,//本表的字段
                                    'list_show' => true,
                                    'list_exist' => false,
                                    'one_show' => true,
                                    'create_relation' => false,//创建时，是否可以关联添加
                                ],
                            ],
                        ];


                        $temp['relationName'] = camel_case($relation_table_name);
                        $temp['className'] = $this->app->tool->struct($relation_table_name);;
                        $this->structRelation[$relationStr][] = $temp['relationName'];

                        $struct_one['relation'][$relationStr][] = $temp;

                    }
                }
            }


            //belongsTo 的关联的名字
            if (!empty($struct_one['relation']['belongsTo'][0]['table_name'])) {

                $belongName = $this->getTableName($struct_one['relation']['belongsTo'][0]['table_name'], $struct_one['origin_comment']);

                $struct_one['belongName'] = $struct_one['relation']['belongsTo'][0]['relationName'] . '.' . $belongName;

                $struct_one['belongClass'] = $struct_one['relation']['belongsTo'][0]['className'];

                $struct_one['belongNameOne'] = $belongName;

            }

            $this->struct[] = $struct_one;
        }

        if ($this->app->frame = LARAVEL) {
            $set = config('auto_build_time') ?? [];
            $is_build = false;
            foreach ($set as $i) {
                if (!in_array($i, $container)) {
                    $is_build = true;
                    echo('缺少时间参数:::已自动生成sql，后期有必要生成migrate' . $i);

                    $table_name = $this->app->table->table_name;

                    $sql = <<<SQL
ALTER TABLE `{$table_name}`
ADD COLUMN `{$i}`  timestamp NULL;
SQL;
                    $this->app->db->query($sql);


                }
            }

//            if ($is_build) {
//                throw new \Exception('请重试，或执行migrate');
//            }


        }

    }

    //生成帮助规则
    public function help($field)
    {
        if (empty($field)) {
            return false;
        }
        $result = '';
        preg_match("/(?:help)+(?:\[)(.*)(?:\])/i", $field, $result);

        if (empty($result[1])) {
            return false;
        }
        return $result[1];

    }

    /**
     * 返回这个字段所有信息 包括枚举信息
     */
    public function getFieldByKey($key)
    {

        foreach ($this->struct as $item) {
            if ($item['name'] == $key) {
                return $item;
            }
        }
        return [];
    }

    /**
     * 获取数据库枚举
     */
    public function enums($key, $note = '')
    {

        do {
            $perg_result = array();

            preg_match("/([^\s]*)(?:\()(.*)(?:\))/i", $note, $perg_result);

            if (empty($perg_result)) {
                break;
            }
            if (empty($perg_result[1])) {
                break;
            }
            $result = [];
            $result['key_note'] = $perg_result[1];
            $result['key'] = $key;
            $keys = explode(',', $perg_result[2]);

            if (empty($keys)) {
                break;
            }


            foreach ($keys as $v) {
                $kv = explode(':', $v);
                if (empty($kv)) return false;
                if (empty($kv[1])) return false;
                $result['data'][$kv[0]] = $kv[1];

            }

            return $result;

        } while (false);

        return false;


    }

    //生成验证规则
    public function validateData($field)
    {
        if (empty($field)) {
            return false;
        }
        $result = '';
        preg_match("/(?:rule)+(?:\[)(.*)(?:\])/i", $field, $result);

        if (empty($result[1])) {
            return false;
        }
        return $result[1];

    }

    /**
     * 获取关键名称 ,长得比较像名称的
     */
    public function getTableName($table, $originCommont)
    {

        if ($name = $this->app->phpcommon->getPergByRule('belongsName', $originCommont)) {
            return $name;
        }


        $db_name = config('database');
        $dataTableInfo = $this->app->db->query("select * from information_schema.columns
where table_schema = '{$db_name}'
and table_name = '{$table}' ORDER BY ORDINAL_POSITION ASC");

        if (empty($dataTableInfo)) {
            throw new \Exception('belongsTo关联表没有数据');
        }
        //有名字就返名称
        foreach ($dataTableInfo as $item) {
            if (strstr($item['COLUMN_NAME'], 'name')) {
                return $item['COLUMN_NAME'];
            }
        }

        foreach ($dataTableInfo as $item) {
            if (strstr($item['COLUMN_COMMENT'], '名')) {
                return $item['COLUMN_NAME'];
            }
        }

        foreach ($dataTableInfo as $item) {
            if (strstr($item['COLUMN_TYPE'], 'varchar')) {
                return $item['COLUMN_NAME'];
            }
        }

        foreach ($dataTableInfo as $item) {
            return $item['COLUMN_NAME'];
        }

    }


}
