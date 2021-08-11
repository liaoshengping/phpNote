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
    public function structByTable($table){
        if (empty($table)){
            throw new \Exception("empty table stuct");
        }
        $this->struct['name'] = $table['COLUMN_NAME'];
        $this->struct['type'] = $table['DATA_TYPE'];
        $this->struct['comment'] = $table['COLUMN_COMMENT'];
    }

}