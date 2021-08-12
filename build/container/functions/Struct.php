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

        foreach ($table as $item) {
            $struct_one = [
                'name' => $item['COLUMN_NAME'],
                'type' => $item['DATA_TYPE'],
                'comment' => $item['COLUMN_COMMENT'],
            ];

            $this->struct[$item['COLUMN_NAME']] = $struct_one;
        }

    }

}
