<?php

namespace container\functions\php;

use container\core\BaseClient;
use Inhere\Console\Util\Show;

class PHPCommon extends BaseClient
{
    /**
     * 模型
     * @var
     */
    public $modeBaseTemplate;
    public $modeTemplate;
    public $classBaseName;
    public $classModelName;
    /**
     * 模型初始化
     */
    public function run()
    {

        $this->classBaseName = $this->app->className . "Base";
        $this->classModelName = $this->app->className;
        //覆盖即可
        $this->app->frame;
        if (!is_dir(APP_PATH . "/studs/" . $this->app->frame )){
            throw new \Exception("请添加模版".APP_PATH . "/studs/" . $this->app->frame . '/model_base');
        }
        $this->modeBaseTemplate = file_get_contents(APP_PATH . "/studs/" . $this->app->frame . '/model_base');
        $this->modeTemplate = file_get_contents(APP_PATH . "/studs/" . $this->app->frame . '/model');
        //namespace
        $this->renameModelNamespace();

        //类名
        $this->modeBaseTemplate = str_replace('{{ClassName}}', $this->classBaseName, $this->modeBaseTemplate);
        $this->modeBaseTemplate = str_replace('{{table_name}}', $this->app->table->table_name, $this->modeBaseTemplate);

        //规则
        $this->rule();

        $this->modelRemark();

        $this->enumsBuild();

        $this->buildModelBase();

        switch ($this->app->todo) {
            case 'modelbase':
                break;
            case 'model':
                $this->buildModel();
                break;
            case 'modelapi':
                break;

        }


    }

    /**
     * 命名空间
     */
    public function renameModelNamespace()
    {
        $this->modeBaseTemplate = str_replace('{{namespace}}', config('base_model_namespace_path'), $this->modeBaseTemplate);
        $this->modeTemplate = str_replace('{{namespace}}', config('model_namespace_path'), $this->modeTemplate);

        $useBaseName = config('base_model_namespace_path').'\\'.$this->classBaseName;
        $this->modeTemplate = str_replace('{{model_base}}',$useBaseName, $this->modeTemplate);
        $this->modeTemplate = str_replace('{{ClassName}}',$this->classModelName, $this->modeTemplate);
        $this->modeTemplate = str_replace('{{extends}}',$this->classBaseName, $this->modeTemplate);

    }


    /**
     * 规则
     */
    public function rule()
    {
        $rules = [];
        foreach ($this->app->struct->struct as $item) {
            $rule = $this->validateData($item["comment"]);
            if ($rule) {
                $rules[$item['name']] = $rule;
            }
        }

        $strRule = 'public $rule = [];';

        if ($rules) {
            $strRuleKeyValue = '' . PHP_EOL;
            foreach ($rules as $name => $rule) {
                $strRuleKeyValue .= "           '" . $name . "' => " . "'" . $rule . "'," . PHP_EOL;
            }
            $strRule = 'public $rule = [
               ' . $strRuleKeyValue . '
            ];';
        }

        //替换规则
        $this->modeBaseTemplate = str_replace('{{rule}}', $strRule, $this->modeBaseTemplate);

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
        $this->modeBaseTemplate = str_replace('{{property}}', $propertys, $this->modeBaseTemplate);

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
        if (!empty($enums)){
            //枚举
            $enums = $this->handleEnums($enums);
        }else{
            $enums = '';
        }


        $this->modeBaseTemplate = str_replace('{{enums}}', $enums, $this->modeBaseTemplate);
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
    public function buildModelBase()
    {
        if (!is_dir(config('frame_modebase_path'))){
            mkdir(config('frame_modebase_path'),0777);
        }

        if (!is_file(config('frame_modebase_path').'/BaseModel.php')){
            file_put_contents(config('frame_modebase_path').'/BaseModel.php', file_get_contents(APP_PATH . "/studs/" . $this->app->frame . '/model_base_base'));
        }

        $frame_modebase_path = config('frame_modebase_path') . $this->classBaseName . '.php';
//        echo $frame_modebase_path;exit;

        file_put_contents($frame_modebase_path, $this->modeBaseTemplate);

        Show::block('生成成功' . $frame_modebase_path, 'success', 'success');


    }

    public function buildModel()
    {
        $frame_mode_path = config('frame_mode_path') . $this->classModelName . '.php';

        file_put_contents($frame_mode_path, $this->modeTemplate);

        Show::block('生成成功' . $frame_mode_path, 'success', 'success');
    }

    //生成验证规则
    public function validateData($field){
        if (empty($field)){
            return false;
        }
        $result = '';
        preg_match("/(?:rule)+(?:\[)(.*)(?:\])/i", $field, $result);

        if (empty($result[1])){
            return false;
        }
        return $result[1];

    }





}
