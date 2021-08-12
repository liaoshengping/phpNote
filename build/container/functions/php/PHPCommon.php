<?php

namespace container\functions\php;

use container\core\BaseClient;

class PHPCommon extends BaseClient
{
    /**
     * 模型
     * @var
     */
    public $modelTemplate;

    public $className;


    /**
     * 模型初始化
     */
    public function init()
    {

        $table_name = $this->app->table->table_name;

        //覆盖即可

        $this->app->frame;

        $this->modelTemplate = file_get_contents(APP_PATH . "/studs/" . $this->app->frame . '/model_base');

        //namespace
        $this->renameBaseModelNamespace();

        //类名
        $this->modelTemplate = str_replace('{{ClassName}}', $this->app->className, $this->modelTemplate);
        $this->modelTemplate = str_replace('{{table_name}}', $this->app->table->table_name, $this->modelTemplate);



        $this->modelRemark();

        $this->enumsBuild();

        $this->build();

    }

    /**
     * 命名空间
     */
    public function renameBaseModelNamespace()
    {
        $this->modelTemplate = str_replace('{{namespace}}', config('base_model_namespace_path'), $this->modelTemplate);
    }


    /**
     * 模型基础
     */
    public function modelRemark()
    {
        $propertys = '';
        foreach ($this->app->struct->struct as $item) {
            $propertys .= " * @property $" . $item['name'] . "  " . $item["comment"] . PHP_EOL;
        }
        $this->modelTemplate = str_replace('{{property}}', $propertys, $this->modelTemplate);

    }

    /**
     *  枚举
     */
    public function enumsBuild()
    {
        foreach ($this->app->struct->struct as &$item) {
            $enum = $this->enums($item['name'], $item["comment"]);
            if ($enum) {
                $enums[] = $enum;
            }
        }

        //枚举
        $enums = $this->handleEnums($enums);

        $this->modelTemplate = str_replace('{{enums}}', $enums, $this->modelTemplate);


    }

    public function build()
    {
        echo $this->modelTemplate;
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





}
