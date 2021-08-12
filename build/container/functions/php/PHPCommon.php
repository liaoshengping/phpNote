<?php

namespace container\functions\php;

use container\core\BaseClient;

class PHPCommon extends BaseClient
{
    /**
     * 模型
     * @var
     */
    public $modeBselTemplate;

    public $classBaseName;


    /**
     * 模型初始化
     */
    public function run()
    {


        $this->classBaseName = $this->app->className."Base";
        //覆盖即可
        $this->app->frame;

        $this->modeBselTemplate = file_get_contents(APP_PATH . "/studs/" . $this->app->frame . '/model_base');

        //namespace
        $this->renameBaseModelNamespace();

        //类名
        $this->modeBselTemplate = str_replace('{{ClassName}}', $this->classBaseName, $this->modeBselTemplate);
        $this->modeBselTemplate = str_replace('{{table_name}}', $this->app->table->table_name, $this->modeBselTemplate);


        //规则
        $this->rule();

        $this->modelRemark();

        $this->enumsBuild();

        $this->build();

    }

    /**
     * 命名空间
     */
    public function renameBaseModelNamespace()
    {
        $this->modeBselTemplate = str_replace('{{namespace}}', config('base_model_namespace_path'), $this->modeBselTemplate);
    }

    /**
     * 规则
     */
    public function rule(){
        $rules =[];
        foreach ($this->app->struct->struct as $item) {
            $rule =$this->validateData($item["comment"]);
            if ($rule) {
                $rules[$item['name']] = $rule;
            }
        }

        $strRule = 'public $rule = [];';

        if ($rules){
            $strRuleKeyValue = ''.PHP_EOL;
            foreach ($rules as $name => $rule){
                $strRuleKeyValue.= "           '".$name."' => "."'".$rule."',".PHP_EOL;
            }
            $strRule = 'public $rule = [
               '.$strRuleKeyValue.'
            ];';
        }

        //替换规则
        $this->modeBselTemplate = str_replace('{{rule}}', $strRule,  $this->modeBselTemplate);

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
        $this->modeBselTemplate = str_replace('{{property}}', $propertys, $this->modeBselTemplate);

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

        $this->modeBselTemplate = str_replace('{{enums}}', $enums, $this->modeBselTemplate);
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

    /**
     * 最终生成
     */
    public function build()
    {
        $frame_modebase_path = config('frame_modebase_path').'/'.$this->classBaseName.'.php';

        file_put_contents($frame_modebase_path,$this->modeBselTemplate);
    }





}
