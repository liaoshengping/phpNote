<?php

namespace container\functions\php\laravel\Oapi;

use Inhere\Console\Util\Show;

/**
 * 章鱼系统 看上去非常规范的开发流程
 */
trait Oapi
{

    public $help = [
        'controller' => '控制器',
        'request' => '请求器',
        'repository' => '仓库',
        'transformer' => '返回格式转换',
        'filter' => '过滤',
        'form' => 'DTO 数组转化对象'
//        'all' => '全部',
    ];


    public function handleOapi()
    {

        $action = $this->app->argvs[3];

        switch ($action) {
            case 'controller':
            case "filter":
            case "request":
            case "transformer":
            case "repository":
            case "form":
                $this->oapi($action);
                break;
            case "all":
                foreach (array_keys($this->help) as $subAction) {
                    $this->oapi($subAction);
                }

                $routeName = str_replace('_', '-', $this->app->table->table_name);
                $className = $this->app->className;
                //路由
                $text = <<<TEXT
    // {{ClassName}}
    Route::get('{{routeName}}', '{{ClassName}}Controller@index');
    Route::post('{{routeName}}', '{{ClassName}}Controller@store');
    Route::put('{{routeName}}/{id}', '{{ClassName}}Controller@update');
    Route::delete('{{routeName}}/{id}', '{{ClassName}}Controller@delete');
TEXT;
                $text = str_replace('{{routeName}}',$routeName,$text);
                $text = str_replace('{{ClassName}}',$className,$text);
                Show::success(PHP_EOL.$text);

                break;
            default:
                Show::aList($this->help, '指示');
                throw new \Exception("输入参数上面介绍的参数");
        }

    }


    public function oapi($action)
    {

        $className = $this->app->className;
        $actionName = $className . ucfirst($action);
        $template = file_get_contents(APP_PATH . "/studs/" . $this->app->frame . '/oapi/api_' . $action);

        $template = str_replace('{{ActionClass}}', $actionName, $template);
        $template = str_replace('{{ClassName}}', $className, $template);
        $template = str_replace('{{Repository}}', $className . 'Repository', $template);


        $template = str_replace('{{FormField}}', $this->formField(), $template);
        $template = str_replace('{{FormInit}}', $this->formInit(), $template);

        $path = config('frame_' . $action . '_path') . $actionName . '.php';

        if (file_exists($path)) {
            echo '已存在：' . $path . PHP_EOL;
            return true;
        }

        file_put_contents($path, $template);

        echo '成功写入：' . $path . PHP_EOL;

    }

    private function formField(): string
    {

        $str = '';

        foreach ($this->app->struct->struct as $value) {


            if (in_array($value['name'],[
                'created_at',
                'id',
                'updated_at',
                'deleted_at',
            ])){
                continue;
            }

            $nullable = '?';

            if ($value["is_nullable"] == 'YES'){
                $nullable = '';
            }

            $type = 'string';
            if (strstr($value['type'], 'int')) {
                $type = 'int';
            }
            $str .= '        public '.$nullable.'' . $type . ' $' . $value['name'] . ',' . PHP_EOL;
        }

        return $str;
    }

    public function formInit(): string
    {
        $str = '';

        if (config('app_name') != 'oct') {
            return $str;
        }


        foreach ($this->app->struct->struct as $value) {

            if ($value['name'] == 'user_id') {
                $str .= '        $this->user_id = Auth::id();' . PHP_EOL;
            }

            if ($value['name'] == 'company_id') {
                $str .= '        Auth::user()->company_id;' . PHP_EOL;
            }

        }
        return $str;
    }


}