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
        'table+table_name' => 'Generate basic database model', // key-value
        'name2' => 'value text 2',
    ];

    /**
     * @param Application $app
     * @return mixed|void
     */
    public function handle(Application $app)
    {
        $app->console->init();

//        Show::aList($this->help,'使用说明');

        $argvs = $app->params['argv'];
//        $userInput = Interact::readln('Your name:');
//        Show::block('是你输入的是', 'success', 'error');
        if (count($argvs) < 2) {
            Show::aList($this->help, 'Instructions');
            throw new \Exception("please fill in the parameter");
        }

        switch ($argvs[1]) {
            case 'table':
                if (empty($argvs[2])) {
                    Show::aList($this->help, 'Instructions');
                    throw new \Exception("please fill in the table name");
                }

                break;
            default:
                Show::aList($this->help, 'Instructions');
                throw new \Exception("Non-existent instruction:" . $argvs[1]);
                break;
        }
    }
}
