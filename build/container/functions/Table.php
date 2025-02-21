<?php


namespace container\functions;


use common\cache;
use container\core\BaseClient;
use functions\Log;
use Inhere\Console\Util\Show;

class Table extends BaseClient
{

    public $table_name;

    public $table_format_name;//格式化后的名字

    public $table_info; //表信息

    public $table_comment; //表注释

    public $pk;//索引字段


    /**
     * 当前财讯表
     * @var
     */

    public $current_table_info;

    /**
     * 查询当前表结构
     */
    public function queryCurrentTableInfo($table_name)
    {

        Show::block("查询表：" . $table_name, 'info', 'warning');

        $this->table_name = $table_name;


        //如果有前缀就去掉前缀咯
        $prefix = config('prefix');
        $new_table_name = $table_name;
        if ($prefix) {
            $new_table_name = str_replace($prefix, '', $table_name);
        }
        //去除最后一个s 去除s
        if (!config('plural_model',true)){
            $last_char = substr($new_table_name, -1);
            do{
                if (strstr($new_table_name,'ies')){
                    $new_table_name  = str_replace('ies','y',$new_table_name);
                    break;
                }
                if ($last_char == 's') {
                    $new_table_name = substr($new_table_name, 0, -1);
                }
            }while(false);


        }
        $this->app->className = $this->app->tool->struct($new_table_name);


        $db_name = config('database');

        $databaseInfo = $this->app->db->query("select * from information_schema.columns
where table_schema = '{$db_name}'
and table_name = '{$table_name}' ORDER BY ORDINAL_POSITION ASC");
        if (empty($databaseInfo)) {
            throw new \Exception("查询不到数据库数据:" . $table_name);
        }

        //查询表备注
        $dataTableInfo = $this->app->db->query("SELECT
*
FROM
information_schema.TABLES
WHERE
table_schema = '{$db_name}' and table_name = '{$table_name}'
ORDER BY
table_name ");

        if (empty($dataTableInfo[0])) {
            throw new \Exception("查询不到数据库结构:" . $table_name);
        }
        $dataTableInfo = $dataTableInfo[0];

        $this->table_comment = $this->table_format_name = !empty($dataTableInfo['TABLE_COMMENT']) ? $dataTableInfo['TABLE_COMMENT'] : $this->app->className;


        if (!empty($databaseInfo)) {
            $this->current_table_info = $databaseInfo;
        }

        $this->pk = $this->getPk($dataTableInfo);

        Show::block("查询成功：" . $table_name, 'info', 'success');

        //处理该表
        $this->app->struct->structByTable($databaseInfo);

        return true;
    }

    //格式化

    private function getPk($info)
    {
        //第一个主键
      foreach ($this->current_table_info as $item){
            if ($item['COLUMN_KEY'] == 'PRI'){
                return $item['COLUMN_NAME'];
            }
      }
    }


    /**
     * 获取所有表信息
     */
    public function getAllTables(){

        $db_name = config('database');


        $dataTableInfo = $this->app->db->query("SELECT
*
FROM
information_schema.tables 
WHERE
table_schema = '{$db_name}'
ORDER BY
table_name ");
        return $dataTableInfo;
    }


}
