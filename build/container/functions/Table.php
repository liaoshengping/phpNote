<?php


namespace container\functions;


use common\cache;
use container\core\BaseClient;
use Inhere\Console\Util\Show;

class Table extends BaseClient
{

    public $table_name;

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
        $this->app->className = $this->app->tool->struct($new_table_name);
        $db_name =config('database');

        $databaseInfo = $this->app->db->query("select * from information_schema.columns
where table_schema = '{$db_name}'
and table_name = '{$table_name}' ORDER BY ORDINAL_POSITION ASC");


        if (empty($databaseInfo)){
            throw new \Exception("查询不到数据库数据:".$table_name);
        }

        if (!empty($databaseInfo)) {
            $this->current_table_info = $databaseInfo;
        }

        Show::block("查询成功：" . $table_name, 'info', 'success');

        //处理该表
        $this->app->struct->structByTable($databaseInfo);

        return true;
    }
    //格式化


}
