<?php


namespace container\middlewares;


use container\Application;
use container\interfaces\Middlewares;
use Inhere\Console\IO\Input;
use Inhere\Console\IO\Output;
use Inhere\Console\Util\Show;

class CommandHandler implements Middlewares
{
    /**
     * @var array
     */
    public $help = [
        'model  table_name' => '生成模型', // key-value
        'modelbase  table_name' => '只生成模型的base', // key-value
        'modelapi  tablename' => '生成api和模型',//
        'l-admin  tablename' => '生成Laravel-admin 控制器',//
        'dcat  tablename' => '生成Dcat-admin 控制器',//
        'html filename' => '生成静态页',//
    ];

    /**
     * @param Application $app
     * @return mixed|void
     */
    public function handle(Application $app)
    {
        $app->console->init();


        $argvs = $app->params['argv'];


        $app->todo = $argvs[1];
//        $userInput = Interact::readln('Your name:');
//        Show::block('是你输入的是', 'success', 'error');
        if (count($argvs) < 2) {
            Show::aList($this->help, 'Instructions');
            throw new \Exception("输入参数上面介绍的参数");
        }
        if (empty($argvs[2])) {
            Show::aList($this->help, '指示');
            throw new \Exception("请填写表名/文件名");
        }
        if ($argvs[2]  == 'all'){
            return true;
        }
        switch ($argvs[1]) {
            case 'model':
            case "modelapi":
            case 'admin': //laravel-admin
            case 'dcat': //dcat-admin
                $app->table->queryCurrentTableInfo($argvs[2]);
                break;
            case 'html':
                Show::info('生成静态页面');
                break;
            default:
                Show::aList($this->help, '指示');
                throw new \Exception("尚未开发指令:" . $argvs[1]);
                break;
        }


    }
}
