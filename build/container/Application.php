<?php

namespace container;

use container\core\ContainerBase;
use container\functions\go\gin\Gin;
use container\functions\htmlv1\bootstrap_official\Bootstrap;
use container\functions\php\laravel\Laravel;
use container\functions\php\thinkphp\Thinkphp;
use container\middlewares\CommandHandler;
use container\middlewares\configHandler;
use container\middlewares\FrameHandler;
use container\provider\CommonProvider;
use container\provider\DiningProvider;
use container\provider\FrameProvider;
use Inhere\Console\Util\Show;

/**
 * Class Application
 * @property \container\functions\Dining dining
 * @property \container\functions\Pdos db
 * @property \container\functions\tool\Console console
 * @property \container\functions\Table table
 * @property \container\functions\Struct struct
 * @property \container\functions\php\PHPCommon phpcommon
 * @property \container\functions\php\thinkphp\Thinkphp thinkphp
 * @property \container\functions\tool\Tool tool
 */
class Application extends ContainerBase
{
    public $todo = '';
    public $argvs = [];
    public $frame = '';
    public $className;//目标对象的classname
    public $projectName;//项目 比如 cid 或者 yuce

    /**
     * 服务提供者
     * @var array
     */
    public function __construct($params = array())
    {
        $this->pushMiddlewares(configHandler::class, '配置信息');
        $this->pushMiddlewares(CommandHandler::class, '命令初始化');
        $this->pushMiddlewares(FrameHandler::class, '框架信息初始化');

        parent::__construct($params);
//        $this->console->run();
    }

    protected $provider = [
        DiningProvider::class,
        CommonProvider::class,
        FrameProvider::class,
        //...其他服务提供者
    ];

    public function run()
    {
        $argvs = $this->params['argv'];
        if ($argvs[2] == 'all') {
            $this->handleAll();
            return true;
        }

        $this->runFrame();

    }

    /**
     * 处理所有
     * @return bool
     * @throws \Exception
     */
    public function handleAll()
    {

//        var_dump($this->table->getAllTables());exit;

        foreach ($this->table->getAllTables() as $tableInfo) {

            $table_name = $tableInfo['TABLE_NAME'];
            $this->params['argv'][2] = $table_name;
            (new self($this->params))->run();
        }
        return true;

    }

    public function runFrame()
    {
        /**
         * 请在这边添加框架
         * @var Thinkphp
         * @var Gin
         * @var Laravel
         * @var Bootstrap
         */
        $this->{$this->frame}->run();
    }
}
