<?php


namespace container\functions;


use container\core\BaseClient;

class Table extends BaseClient
{
    /**
     * 当前财讯表
     * @var
     */
    public $current_table_info;

    /**
     * 查询当前表结构
     */
    public function queryCurrentTableInfo($table_name){

        $databaseInfo = $this->app->db->query("select
	* 
FROM INFORMATION_SCHEMA.COLUMNS
where table_name = '{$table_name}'");

        if (!empty($databaseInfo)){
            $this->current_table_info = $databaseInfo;
        }

        return true;
    }

    //格式化


}
