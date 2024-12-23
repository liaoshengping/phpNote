<?php

namespace container\functions\php;

use container\core\BaseClient;
use container\functions\php\laravel\DcatAdmin;
use container\functions\php\laravel\LaravelAdmin;
use container\functions\php\laravel\Oapi\Oapi;
use container\functions\php\laravel\RelationBuildByTable;
use Illuminate\Support\Arr;
use Inhere\Console\Util\Show;

class PHPCommon extends BaseClient
{
    use ControllerTemplateCommon;
    use RequestForm;
    use LaravelAdmin;
    use DcatAdmin;
    use RelationBuildByTable;
    use Oapi;

    /**
     * 模型
     * @var
     */
    public $modeBaseTemplate;
    public $modeTemplate;
    public $classBaseName;
    public $classModelName;
    /**
     *  控制器
     */
    public $controllerTemplate;
    public $controllerFunctionSection;//方法部分往这边塞方法
    public $controllerBaseName;
    public $controllerName;

    /**
     * 文档
     */
    public $documentModel;
    public $documentController;

    public $hiddenProperties = array();//隐藏的字段

    /**
     * 关联模版
     * @var
     */
    public $modelRelationTemplate;


    /**
     * eq:
     * array(3) {
     * ["key_note"]=>
     * string(6) "状态"
     * ["key"]=>
     * string(6) "status"
     * ["data"]=>
     * array(2) {
     * [1]=>
     * string(6) "停止"
     * [2]=>
     * string(6) "正常"
     * }
     * }
     */
    public $enums;

    /**
     * 模型初始化
     */
    public function run()
    {


        $this->classBaseName = $this->app->className . "Base";
        $this->classModelName = $this->app->className;
        //覆盖即可

        if (!is_dir(APP_PATH . "/studs/" . $this->app->frame)) {
            throw new \Exception("请添加模版" . APP_PATH . "/studs/" . $this->app->frame . '/model_base');
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

        $this->buildProperty(); //模型的属性

        $this->modelRemark();

        $this->enumsBuild();

        $this->buildModelDocument();

        //处理关联
        $this->buildRelation();

        $this->buildAppend();

        //关联关系写入注释
        $this->buildRelationToNote();

        switch ($this->app->todo) {
            case 'modelbase':
                $this->buildModelBase();
                break;
            case 'model':
                $this->buildModelBase();
                $this->buildModel();
                break;
            case 'modelapi':
                $this->buildModelBase();
                $this->buildModel();
                $this->buildController();
                break;
            case 'oapi':
                $this->handleOapi();
                break;
//                $this->buildValidate();
//                $this->buildRedpository();
//                 $this->buildDocument(); //创建接口文档
            case 'admin'://laravel-admin 生成控制器
                $this->buildModelBase();
                $this->buildModel();
                $this->buildLaravelAdminController();
                break;
            case 'dcat'://dcat-admin 生成控制器
                $this->buildModelBase();
                $this->buildModel();
                $this->buildDcatAdminController();
                break;
        }


    }

    /**
     * 关联关系写入注释包括写入api文档
     */
    public function buildRelationToNote()
    {
        $relationPropertys = '';
        $apiDoc = '';
        $relations = $this->getRelation();

        do {
            if (empty($relations)) {
                break;
            }

            //处理关联表注释
            foreach ($relations as $relation) {
                foreach ($relation['tables'] as $item) {
                    $table_name = $item['table_name'];
                    $relation_name = !empty($item['relation_name']) ? $item['relation_name'] : $item['table_name'];
                    $namespace = config('model_namespace_path');
                    $relationPropertys .= '* @property \\' . $namespace . '\\' . $this->app->tool->struct($table_name) . ' ' . $relation_name . PHP_EOL;
                }
            }

            //处理文档swagger
            foreach ($relations as $relation) {

                if (empty($relation['relation'])) {
                    throw new \Exception('关联关系必填 hasMany 或 hasOne');
                }

                foreach ($relation['tables'] as $item) {

                    $table_name = $item['table_name'];
                    $schema_name = $this->app->tool->struct($item['table_name']);

                    if (!is_file(config('frame_mode_path') . $schema_name . '.php')) {
                        Show::block('致命bug，请执行：model ' . $table_name, 'error', 'error');
                    }
                    $relation_name = !empty($item['relation_name']) ? $item['relation_name'] : $item['table_name'];
                    $description = !empty($item['description']) ? $item['description'] : '';
                    if ($relation['relation'] == 'hasMany') {
                        $apiDoc .= '
 *      @OA\Property(
 *     property="' . $relation_name . '",
 *     description="' . $description . '",
 *     type= "array",
 *     @OA\Items(
 *     ref="#/components/schemas/' . $schema_name . '"
 *     )
 *      ),';
                    } elseif ($relation['relation'] == 'belongsToMany') {
                        $apiDoc .= '
 *      @OA\Property(
 *     property="' . $relation_name . '",
 *     description="' . $description . '",
 *     type= "array",
 *     @OA\Items(
 *     ref="#/components/schemas/' . $this->app->tool->struct($item['relation_table']) . '"
 *     )
 *      ),';
                    } else {
                        $apiDoc .= '
 *      @OA\Property(
 *     property="' . $relation_name . '",
 *      description="' . $description . '",
 *     ref="#/components/schemas/' . $schema_name . '"
 *      ),';
                    }

                }
            }


        } while (false);


        $this->modeBaseTemplate = str_replace('{{relationPropertys}}', $relationPropertys, $this->modeBaseTemplate);
        $this->modeBaseTemplate = str_replace('{{apiDocRelationPropertys}}', $apiDoc, $this->modeBaseTemplate);


    }

    /**
     * 生成模型的属性
     */
    public function buildProperty()
    {

        $hidden = [];
        $need_hidden = $this->getHidden();

        foreach ($this->app->struct->struct as $item) {
            if (in_array($item['name'], $need_hidden)) {
                $this->hiddenProperties[] = $item['name'];
                $hidden[] = "'" . $item['name'] . "'";
            }
        }
        if (empty($hidden)) {
            $hidden = [];
        }
        $this->modeBaseTemplate = str_replace('{{hidden}}', 'protected $hidden = [' . implode(',', $hidden) . '];', $this->modeBaseTemplate);

    }

    /**
     * 获取控制器
     */
    private function getControllerAction()
    {
        $config = $this->getCurrentSetting();
        if ($this->getCurrentSetting('controller_actions') == 'none') {
            return [];
        }
        $tags = !empty($config['controller_actions']) ? $config['controller_actions'] : ['create', 'list', 'edit', 'show', 'delete'];
        return $tags;
    }

    /**
     * 生成控制器
     * @return bool
     */
    public function buildController()
    {
        $temp = [];
        $this->pushTemplate($temp, $this->buildInitController() ?? []);

        $actions = $this->getControllerAction();

        if (in_array('create', $actions)) {
            $this->pushTemplate($temp, $this->buildStoreController() ?? []);
        }
        if (in_array('show', $actions)) {
            $this->pushTemplate($temp, $this->buildShowController() ?? []);
        }
        if (in_array('list', $actions)) {
            $this->pushTemplate($temp, $this->buildListsController() ?? []);
        }
        if (in_array('edit', $actions)) {
            $this->pushTemplate($temp, $this->buildEditController() ?? []);
        }
        if (in_array('delete', $actions)) {
            $this->pushTemplate($temp, $this->buildDelController() ?? []);
        }

        //生成修改状态的控制器
        if ($this->getCurrentSetting('change_status')) {
            $this->pushTemplate($temp, $this->buildChangeController('status') ?? []);

        }


        foreach ($temp as $item) {
            $this->controllerFunctionSection .= $item['template'];
            $this->documentController .= $item['document'];
        }

        //判断basecontroller的存在
        $templateBaseFilePath = config('frame_controller_path') . 'base/BaseController.php';


        if (!is_dir(config('frame_controller_path') . 'base/')) {
            mkdir(config('frame_controller_path') . 'base', '0777');
        }

        if (!is_file($templateBaseFilePath)) {
            file_put_contents($templateBaseFilePath, file_get_contents(APP_PATH . "/studs/" . $this->app->frame . '/base_controller'));
        }
        //创建baseconroller
        $this->controllerTemplate = file_get_contents(APP_PATH . "/studs/" . $this->app->frame . '/controller');

        $controller_base_name = !empty($this->controllerBaseName) ? $this->controllerBaseName : $this->classBaseName . 'Controller';

        $templateBaseName = config('frame_controller_path') . 'base/' . $controller_base_name . '.php';

        $this->controllerTemplate = str_replace('{{controller_base_name}}', $controller_base_name, $this->controllerTemplate);


        $this->controllerTemplate = str_replace('{{content}}', $this->controllerFunctionSection, $this->controllerTemplate);

        $this->controllerTemplate = str_replace('{{base_model_namespace_path}}', config('controller_namespace_path') . '\base', $this->controllerTemplate);


        $this->controllerTemplate = str_replace('{{frame_controller_base_namespace}}', config('frame_controller_base_namespace'), $this->controllerTemplate);

        file_put_contents($templateBaseName, $this->controllerTemplate);

        //创建正式controller
        $controllerPaht = config('frame_controller_path') . $this->classModelName . '.php';

        if (is_file($controllerPaht)) {
            Show::block('已存在' . $controllerPaht . '控制器');
            return true;
        }

        $this->controllerTemplate = file_get_contents(APP_PATH . "/studs/" . $this->app->frame . '/index_controller');

        $this->controllerTemplate = str_replace("{{controller_namespace_path}}", config('controller_namespace_path'), $this->controllerTemplate);
        $this->controllerTemplate = str_replace("{{controller_name}}", $this->classModelName, $this->controllerTemplate);

        $this->controllerTemplate = str_replace("{{BaseController}}", '\\' . config('controller_namespace_path') . '\base\\' . $controller_base_name, $this->controllerTemplate);


        file_put_contents(config('frame_controller_path') . $this->classModelName . '.php', $this->controllerTemplate);


        echo $controllerPaht;
        exit;

    }

    /**
     *
     * @param $temp
     * @param $obj
     */
    public function pushTemplate(&$temp, $obj)
    {
        if (empty($obj)) {
            return;
        } else {
            $temp[] = $obj;
        }
    }

    /**
     * 命名空间
     */
    public function renameModelNamespace()
    {
        $this->modeBaseTemplate = str_replace('{{namespace}}', config('base_model_namespace_path'), $this->modeBaseTemplate);
        $this->modeTemplate = str_replace('{{namespace}}', config('model_namespace_path'), $this->modeTemplate);

        $useBaseName = config('base_model_namespace_path') . '\\' . $this->classBaseName;
        $this->modeTemplate = str_replace('{{model_base}}', $useBaseName, $this->modeTemplate);
        $this->modeTemplate = str_replace('{{ClassName}}', $this->classModelName, $this->modeTemplate);
        $this->modeTemplate = str_replace('{{extends}}', $this->classBaseName, $this->modeTemplate);

    }


    /**
     * 规则
     */
    public function rule()
    {
        $rules = [];
        foreach ($this->app->struct->struct as $item) {
            $rule = $this->validateData($item["origin_comment"]);
            $inter_perg = '';
            if (in_array($item['type'], ['tinyint', 'int'])) {
                $inter_perg = config('validate_int');
            }
            if ($item['type'] == 'decimal') {
                $inter_perg = config('validate_number');
            }
            if ($rule) {
                $rules[$item['name']] = $rule;
            }
            if ($inter_perg) {
                if (!empty($rules[$item['name']])) {
                    $rules[$item['name']] .= '|' . $inter_perg;
                } else {
                    $rules[$item['name']] = $inter_perg;
                }
            }
            if (!empty($item['enum'])) {
                //如果是枚举
                $enum_rule = 'in:' . implode(',', array_keys($item['enum']));

                if (!empty($rules[$item['name']])) {
                    $rules[$item['name']] .= '|' . $enum_rule;
                } else {
                    $rules[$item['name']] = $enum_rule;
                }
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
        $apiProperty = '';
        $schema = '';
        $api_doc = config('api_doc');
        $fillable = '';
        $relation_save = '';
        $enums = [];
        foreach ($this->app->struct->struct as $item) {
            if ($api_doc == 'swagger' && !in_array($item['name'], $this->hiddenProperties)) {
                $example = '';
                switch ($item['type']) {
                    case 'bigint':
                        $example = 1;
                        break;
                    case 'varchar':
                        $example = '--';
                        break;
                    case 'timestamp':
                        $example = '2008-08-08 08:08:08';
                        break;
                }
                if ($item['default']) {
                    $example = $item['default'];
                }
                //判断是否是枚举
                $apiProperty .= '
 *      @OA\Property(
 *     property="' . $item['name'] . '",
 *     format="' . $item['name'] . '",
 *     type="' . $item['type'] . '",
 *     description="' . $item["origin_comment"] . '",
 *     example="' . $example . '"
 *                  ),';
//    ,
            }


            $propertys .= " * @property $" . $item['name'] . "  " . $item["comment"] . PHP_EOL;
            if ($item['name'] != $this->app->table->pk && !in_array($item['name'], config('exclude_fillable') ?? [])) {
                $fillable .= "'" . $item['name'] . "',";
            }
            if (!empty($item['enum'])) {
                $propertys .= " * @property $" . $item['name'] . "_name  " . $item["comment"] . '描述' . PHP_EOL;
                $enums[] = $item;
            }

        }

//        foreach ($enums as $item) {
//            $propertys .= " * @property $" . $item['name']."_name  " . $item["comment"].'描述' . PHP_EOL;
//        }


        $propertys .= "{{relationPropertys}}";

        if ($fillable) {
            $fillable = 'protected $fillable = [' . $fillable . '];';
        }

        $pkString = '';
        if ($this->app->table->pk) {
            $pk = $this->app->table->pk;
            if (config('set_pk') && $pk) {
                $pkString = 'protected $primaryKey = "' . $pk . '";';
            }
        }


        if ($apiProperty) {
            $apiProperty .= "{{apiDocRelationPropertys}}";
            $schema = '*@OA\Schema(
 *   schema="' . $this->classModelName . '",
 *   description="",
 {{apiDocProperty}}
 *     ) ';


//            需要隐藏的字段
            $hidden = '';
//            apiDocRelationPropertys

            $schema = str_replace('{{apiDocProperty}}', $apiProperty, $schema);
        }
        //关联配置
        if ($this->getCurrentSetting('relation_save')) {
            $relation_save = 'use \Liaosp\LaravelRelationSave\SaveRelation;';
        }

        //软删除
        $soft_delete = $this->getCurrentSetting('disable_soft_delete', false) ? '' : 'use SoftDeletes;';
        if (config('disable_soft_delete')) {
            $soft_delete = '';
        }

        $this->modeBaseTemplate = str_replace('{{soft_delete}}', $soft_delete, $this->modeBaseTemplate);
        $this->modeBaseTemplate = str_replace('{{BaseModel}}', config('base_base_model', 'BaseModel'), $this->modeBaseTemplate);


        $this->modeBaseTemplate = str_replace('{{property}}', $propertys, $this->modeBaseTemplate);
        $this->modeBaseTemplate = str_replace('{{apiDoc}}', $schema, $this->modeBaseTemplate);
        $this->modeBaseTemplate = str_replace('{{fillable}}', $fillable, $this->modeBaseTemplate);
        $this->modeBaseTemplate = str_replace('{{relation_save}}', $relation_save, $this->modeBaseTemplate);
        $this->modeBaseTemplate = str_replace('{{primaryKey}}', $pkString, $this->modeBaseTemplate);


    }

    /**
     *  枚举
     */
    public function enumsBuild()
    {
        foreach ($this->app->struct->struct as &$item) {
            $enum = $this->enums($item['name'], $item["origin_comment"]);
            if ($enum) {
                $this->enums[$enum['key']] = $enum;
                $enums[] = $enum;
            }
        }
        if (!empty($enums)) {
            //枚举
            $enums = $this->handleEnums($enums);
        } else {
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
                $result['data'][trim($kv[0])] = trim($kv[1]);

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

        if (!is_dir(config('frame_modebase_path'))) {
            mkdir(config('frame_modebase_path'), 0777);
        }

        if (!is_file(config('frame_modebase_path') . '/BaseModel.php')) {
            file_put_contents(config('frame_modebase_path') . '/BaseModel.php', file_get_contents(APP_PATH . "/studs/" . $this->app->frame . '/model_base_base'));
        }

        $this->modeBaseTemplate = str_replace('{{relation}}', $this->modelRelationTemplate, $this->modeBaseTemplate);


        $frame_modebase_path = config('frame_modebase_path') . $this->classBaseName . '.php';

        file_put_contents($frame_modebase_path, $this->modeBaseTemplate);

        Show::block('生成成功' . $frame_modebase_path, 'success', 'success');


    }

    public function buildModel()
    {
        $frame_mode_path = config('frame_mode_path') . $this->classModelName . '.php';

        if (is_file($frame_mode_path)) return;


//        $this->modeTemplate = iconv("CP1257","UTF-8", $this->modeTemplate);
        file_put_contents($frame_mode_path, $this->modeTemplate);

        Show::block('生成成功' . $frame_mode_path, 'success', 'success');
    }

    /**
     * 获取所有的关联配置
     * @return array|mixed
     */
    public function getRelation()
    {
        $table = $this->getCurrentSetting();


        if (empty($table['relations'])) {
            return $this->app->struct->compatibleRelation; //表里面的关联关系，后期可以做成合并的方式

        }

        return $table['relations'];


//        $relation = config('relations');
//
//        if (empty($relation[$table_name])) {
//            return [];
//        }
//        $relations = $relation[$table_name];
//
//        return $relations;
    }

    /**
     * 获取当前配置
     * @return array|mixed
     */
    public function getCurrentSetting($key = '', $default = '')
    {


        $table_name = $this->app->table->table_name;

        $tables = config('tables') ?? [];

        if (empty($tables[$table_name])) {
            return [];
        }
        $table = $tables[$table_name];
//        if (empty($table['relations'])) {
//            return [];
//        }
        $inputParams = [
            'list_input',
            'edit_input',
            'create_input',
        ];

        if (in_array($key, $inputParams)) {
            if (empty($table[$key])) {
                return !empty($table['input']) ? $table['input'] : [];
            }

        }

        if ($key) {
            return !empty($table[$key]) ? $table[$key] : $default;
        }


        return $table;
    }

    /**
     * 生成模型文档
     */
    public function buildModelDocument()
    {

        $this->documentModel .= 'document_path';
        $path = config('document_path');

    }

    /**
     * 获取需要隐藏的字段
     */
    public function getHidden()
    {
        //全局隐藏的字段
        $hidden_fields = config('hidden_fields') ?? [];

        foreach ($this->app->struct->struct as $item) {
            $str = strstr($item['comment'], 'hidden');
            if ($str) {
                array_push($hidden_fields, $item['name']);
            }
        }

        return $hidden_fields;
    }

    //生成验证规则
    public function validateData($field)
    {
        $str = $field;
        $arr = array();

// Define a regular expression pattern
        $pattern = "/(\w+)\[([^\]]+)\]/";

// Search for matches in the string and extract the variable names and values
        preg_match_all($pattern, $str, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $arr[$match[1]] = $match[2];
        }
        if (!empty($arr['rule'])) {
            return $arr['rule'];
        }

        return false;

    }

    //生成名字根据正则
    public function getMsgPreg($field, $bool = false)
    {


        $str = $field;
        $arr = array();

// Define a regular expression pattern
        $pattern = "/(\w+)\[([^\]]+)\]/";

// Search for matches in the string and extract the variable names and values
        preg_match_all($pattern, $str, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $arr[$match[1]] = $match[2];
        }
        if (!empty($arr['msg'])) {

            return $arr['msg'];
        }

        if ($bool) {
            return false;
        }
        return $field;


    }

    /**
     * 统一获取规则
     * @param $str
     * @param $field
     * @return false|mixed
     */
    public function getPergByRule($rule, $field)
    {
        $str = 'msg[供应商商品ID] help[如淘宝商品ID投放页] rule[required] search';
//
//        $pattern = "/(\w+)\[([^\]]+)\]/";
//
//        preg_match_all($pattern, $str, $matches, PREG_SET_ORDER);
//        foreach ($matches as $match) {
//            $arr[$match[1]] = $match[2];
//        }
//
//        var_dump($arr);exit;
//
//
//        exit;

        $str = $field;
        $arr = array();

// Define a regular expression pattern
        $pattern = "/(\w+)\[([^\]]+)\]/";

// Search for matches in the string and extract the variable names and values
        preg_match_all($pattern, $str, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $arr[$match[1]] = $match[2];
        }

        if (!empty($arr[$rule])) {
            return $arr[$rule];
        }


        return false;


    }

    //验证规则
    public function getRulePreg($field)
    {

        $str = $field;
        $arr = array();

// Define a regular expression pattern
        $pattern = "/(\w+)\[([^\]]+)\]/";

// Search for matches in the string and extract the variable names and values
        preg_match_all($pattern, $str, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $arr[$match[1]] = $match[2];
        }
        if (!empty($arr['rule'])) {
            return $arr['rule'];
        }


        return false;

    }

    //字段是否是图片
    public function isImage($field)
    {
        if (strstr($field, 'image')) {
            return true;
        }
        return false;
    }


    /**
     * get scence field
     * scence: create,list,edit
     */
    public function getInputByScence($scence = '')
    {
        $current_table_name = $this->app->table->table_name;

        if (empty($scence)) {
            if (empty(config('tables')[$current_table_name])) {
                return [];
            }
            //if tables input no`t empty
            return config('tables')[$current_table_name]['input'];
        }
        if (empty(config('tables')[$current_table_name])) {
            return [];
        }


        switch ($scence) {

            case 'create'://create data
                if (empty(config('tables')[$current_table_name]['create_input'])) {
                    return config('tables')[$current_table_name]['input'];
                } else {
                    return config('tables')[$current_table_name]['create_input'];
                }
                break;

            case "list":
                if (empty(config('tables')[$current_table_name]['list_input'])) {

                    return config('tables')[$current_table_name]['input'];
                } else {
                    return config('tables')[$current_table_name]['list_input'];
                }
                break;
            case "edit":
                if (empty(config('tables')[$current_table_name]['edit_input'])) {

                    return config('tables')[$current_table_name]['input'];
                } else {
                    return config('tables')[$current_table_name]['edit_input'];
                }
                break;
        }

    }

    /**
     * 获取当前的名字  比如 订单管理，产品管理
     * @return mixed
     */
    public function getThisTags()
    {
        $config = $this->getCurrentSetting();

        $tags = !empty($config['name']) ? $config['name'] : $this->getMsgPreg($this->app->table->table_format_name);
        return $tags;
    }

    /**
     * 列表需要筛选的字段 比如 筛选 phone,user_id 之类的
     */
    public function listFiltrateParameter()
    {
        $data = [];


        foreach ($this->app->struct->struct as $item) {

            if (strstr($item['name'], 'name')
                || strstr($item['name'], '_no')
                || strstr($item['name'], 'id')
                || !empty($item['enum'])

            ) {
                $data[] = $item['name'];
                continue;
            }
            //config 配置的表信息
            $list_input = $this->getCurrentSetting('list_input');

            if (in_array($item['name'], $list_input)) {
                $data[] = $item['name'];
                continue;
            }
        }


        return $data;

    }

    /**
     * 字段修改
     * @return void
     */
    public function buildAppend()
    {
        $append = '';
        foreach ($this->app->struct->struct as $item) {

            if (strstr($item['origin_comment'], 'multipleImage')) {
                $className = $this->app->tool->struct($item['name']);
                $append .= ' 
    public function getFirst'.$className.'Attribute($key)
    {
        if (is_array($this->'.$item["name"].')){
            return Arr::first($this->'.$item["name"].');
        }
        if (json_decode($this->'.$item["name"].')){
            return Arr::first(json_decode($this->'.$item["name"].'));
        }
    }';
            }

        }
        $this->modeBaseTemplate = str_replace('{{append}}', $append, $this->modeBaseTemplate);
    }


}
