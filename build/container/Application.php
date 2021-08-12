<?php

namespace container;

use container\core\ContainerBase;
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
    public $frame = '';
    public $className;//目标对象的classname

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
        /**
         * @var Thinkphp
         */
        $this->{$this->frame}->run();
    }
}
