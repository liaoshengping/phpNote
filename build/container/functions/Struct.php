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
            ];

            $this->struct[] = $struct_one;
        }
        if ($this->app->frame = LARAVEL) {
            $set = config('auto_build_time') ?? [];
            $is_build = false;
            foreach ($set as $i) {
                if (!in_array($i, $container)) {
                    $is_build = true;
                    echo('缺少时间参数:::已自动生成sql，后期有必要生成migrate'.$i);

                    $table_name = $this->app->table->table_name;

                    $sql = <<<SQL
ALTER TABLE `{$table_name}`
ADD COLUMN `{$i}`  timestamp NULL;
SQL;
                    $this->app->db->query($sql);


                }
            }

            if ($is_build){
                throw new \Exception('请重试，或执行migrate');
            }


        }

    }

}
