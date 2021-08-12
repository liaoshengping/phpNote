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
    ];

    /**
     * @param Application $app
     * @return mixed|void
     */
    public function handle(Application $app)
    {
        $app->console->init();

        $argvs = $app->params['argv'];
//        $userInput = Interact::readln('Your name:');
//        Show::block('是你输入的是', 'success', 'error');
        if (count($argvs) < 2) {
            Show::aList($this->help, 'Instructions');
            throw new \Exception("输入参数上面介绍的参数");
        }
        switch ($argvs[1]) {
            case 'model':
                if (empty($argvs[2])) {
                    Show::aList($this->help, '指示');
                    throw new \Exception("请填写表名");
                }
                $app->table->queryCurrentTableInfo($argvs[2]);
                break;
            default:
                Show::aList($this->help, '指示');
                throw new \Exception("不存在的指令:" . $argvs[1]);
                break;
        }

        $app->todo = $argvs[1];
    }
}
