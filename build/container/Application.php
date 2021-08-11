<?php

namespace container;

use container\core\ContainerBase;
use container\middlewares\CommandHandler;
use container\middlewares\configHandler;
use container\middlewares\FrameHandler;
use container\provider\CommonProvider;
use container\provider\DiningProvider;
use Inhere\Console\Util\Show;

/**
 * Class Application
 * @property \container\functions\Dining dining
 * @property \container\functions\Pdos db
 * @property \container\functions\tool\Console console
 * @property \container\functions\Table table
 */
class Application extends ContainerBase
{
    public $todo = '';//做什么

    /**
     * 服务提供者
     * @var array
     */
    public function __construct($params = array())
    {
        $this->pushMiddlewares(configHandler::class, '配置信息');
        $this->pushMiddlewares(FrameHandler::class, '框架信息初始化');
        $this->pushMiddlewares(CommandHandler::class, '命令初始化');
        parent::__construct($params);
//        $this->console->run();
    }

    protected $provider = [
        DiningProvider::class,
        CommonProvider::class,
        //...其他服务提供者
    ];

    public function run()
    {

    }
}
