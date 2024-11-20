<?php

namespace container\functions\php\laravel;

use container\functions\php\PHPCommon;
use Inhere\Console\Util\Show;

class Laravel extends PHPCommon
{
    /**
     * 处理枚举
     */
    public function handleEnums($enums)
    {
        if (empty($enums)) return '';
        $result = '';
        //添加 append

        $strAppend = '';
        foreach ($enums as $enumData) {
            $strAppend .= "'" . $enumData['key'] . "_name',";
        }
        $result .= 'protected $appends = [
            ' . $strAppend . '
    ];';

        $baseStr = '
    /**
     * {{keyName}}
     */
    ';

        foreach ($enums as $enumData) {
            $str = PHP_EOL . $baseStr;
            $result .= str_replace('{{keyName}}', $enumData['key'] . $enumData['key_note'], $str) . PHP_EOL;

            $prefix = strtoupper($enumData['key']);

            foreach ($enumData['data'] as $key => $value) {
                $result .= '   const ' . $prefix . '_' . strtoupper($key) . ' = ' . "'" . $key . "';" . "     //" . $value . PHP_EOL;
            }
        }

        //数组

        foreach ($enums as $enumData) {
            $str = $baseStr;
            $result .= str_replace('{{keyName}}', $enumData['key'] . $enumData['key_note'], $str) . PHP_EOL;

            $strFunction = '     const ' . $enumData['key'] . ' = [
            
{{arrData}}
      ];';
            $arrdata = '';
            foreach ($enumData['data'] as $key => $value) {
                $arrdata .= "          '" . $key . "' =>" . "'" . $value . "'," . PHP_EOL;
            }
            $strFunction = str_replace('{{arrData}}', $arrdata, $strFunction);
            $result .= $strFunction;

        }
        //获取枚举方法
        foreach ($enums as $enumData) {
            $str = $baseStr;
            $result .= str_replace('{{keyName}}', $enumData['key'] . '获取描述', $str) . PHP_EOL;
            $function_name = ucfirst($this->app->tool->struct($enumData['key']));

            $strFunction = ' 
    public function get' . $function_name . 'Params($key)
    {
        if(empty($key)) return "未知";
        return self::' . $enumData['key'] . '[$key] ?? "未知";
    }';
            $result .= $strFunction;

        }

        //增加枚举的修改器
        foreach ($enums as $enumData) {
            $str = $baseStr;
            $result .= str_replace('{{keyName}}', $enumData['key'] . '修改器', $str) . PHP_EOL;
            $function_name = ucfirst($this->app->tool->struct($enumData['key']));
            $strFunction = '
    public function get' . $function_name . 'NameAttribute()
    {
       return $this->get' . $function_name . 'Params($this["' . $enumData['key'] . '"]);
    }';
            $result .= $strFunction;

        }


        $strLibFunction = '';
        //增加枚举的修改器
        foreach ($enums as $enumData) {
            $strLibFunction .= "'" . $enumData['key'] . "' =>self::" . $enumData['key'] . ',';
        }

        $result .= ' 
        
    /**
     * 获取所有枚举
     */
    public function getlibrary()
    {
       return [' . $strLibFunction . '];
    }';


        return $result;
    }


    /**
     * 处理关联类型
     *     'relations' => [
     * 'users' => [
     * [
     * 'relation' => "hasMany",
     * 'table' => [
     * [
     * 'table_name' => 'posts',
     * 'target' => 'user_id', //目标表中的字段
     * 'origin' => 'id',//本表的字段
     * 'limit' => 0,//查询为10条
     * 'list_show' => true,
     * 'list_exist' => false,
     * 'one_show' => false,
     * 'create_relation' => false,//创建时，是否可以关联添加
     * ],
     * ],
     * ],
     */
    public function buildRelation()
    {



        //数据表生成的关联模型
//        $relationTable = $this->generateRelation();
//
//        if ($relationTable){
//            $this->modelRelationTemplate = $relationTable;
//            return  $relationTable;
//        }

        $relations = $this->getRelation();


        if (empty($relations)) {
            return '';
        }
        $tamplate = '';
        foreach ($relations as $table_name => $relation) {

//            var_dump($relations);exit;

            $originName = $this->app->tool->struct($table_name);

            $model_base_namespace = config('model_namespace_path') . '\\';
            $relationName = $relation['relation'];

            foreach ($relation['tables'] as $item) {

                $tagName = $this->app->tool->struct($item['table_name']);

                //危险警告
                if (!is_file(config('frame_mode_path') . $tagName . '.php')) {
                    Show::block('缺少关联表' . $tagName . '存在，最高危险级别警告,请执行： php 你的项目名字 model ' . $item['table_name'], 'error', 'error');
                }

                $relation_name = !empty($item['relation_name'])?$item['relation_name']:$item['table_name'];
                $relation_where = $item['relation_where']??'';
                $relation_where_str = '';
                if ($relation_where){
                    $relation_where_arr = explode(':',$relation_where);
                    $relation_where_str = "->where('".$relation_where_arr[0]."','".$relation_where_arr[1]."')";
                }
                switch ($relationName) {
                    case 'hasMany':
                        $limitStr = '';
                        $limit = $item['limit'] ?? 0;
                        if ($limit > 0) {
                            $limitStr = '->limit("' . $limit . '")';
                        }
                        $tamplate .= '
   public function ' . $relation_name . '()
    {
        return $this->hasMany(\\' . $model_base_namespace . $tagName . '::class, \'' . $item['target'] . '\', \'' . $item['origin'] . '\')' .$relation_where_str. $limitStr . ';
    }
                    ' . PHP_EOL;
                        break;
                    case 'hasOne':
                        $tamplate .= '
   public function ' . $relation_name . '()
    {
        return $this->hasOne(\\' . $model_base_namespace . $tagName . '::class, \'' . $item['target'] . '\', \'' . $item['origin'] . '\')'.$relation_where_str.';
    }
                    ' . PHP_EOL;
                        break;

                    case 'belongsToMany':
                        $tamplate .= '
   public function ' . $relation_name . '()
    {
        return $this->belongsToMany(\\' . $model_base_namespace . $tagName . '::class,"'.$item['relation_table'].'", \'' . $item['origin'] . '\', \'' .$item['target']. '\')'.$relation_where_str.';
    }
                    ' . PHP_EOL;
                        break;
                    case 'belongsTo':
                        $tamplate .= '
   public function ' . $relation_name . '()
    {
        return $this->belongsTo(\\' . $model_base_namespace . $tagName . '::class, \'' . $item['target'] . '\', \'' . $item['origin'] . '\')'  .$relation_where_str. ';
    }
                    ' . PHP_EOL;
                        break;
                    default:
                        throw new \Exception('config relations的配置中，缺少类型：' . $relation['relation']);
                        break;
                }
            }


        }




        $this->modelRelationTemplate = $tamplate;

        return $tamplate;
    }
}
