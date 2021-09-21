<?php


namespace container\functions;


use container\core\BaseClient;

class Struct extends BaseClient
{
    public $struct;

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
                $struct_one['enum'] = $enum['data'];

            }

            //规则名字
            $validateData = $this->validateData($struct_one['origin_comment']);
            if ($validateData) {
                $rule_name = explode('rule', $struct_one['origin_comment']);
                $rule_name = $rule_name[0];
                $struct_one['comment'] = $rule_name;
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

            if ($is_build) {
                throw new \Exception('请重试，或执行migrate');
            }


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


}
