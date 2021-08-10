<?php

namespace container;

use container\core\ContainerBase;
use container\middlewares\configHandler;
use container\middlewares\FrameHandler;
use container\provider\CommonProvider;
use container\provider\DiningProvider;

/**
 * Class Application
 * @property \container\functions\Dining dining
 * @property \container\functions\Pdos db
 */
class Application extends ContainerBase
{
    /**
     * 服务提供者
     * @var array
     */
    public function __construct($params = array())
    {
        $this->pushMiddlewares(configHandler::class,'配置信息');
        $this->pushMiddlewares(FrameHandler::class,'框架信息初始化');

        parent::__construct($params);
    }

    protected $provider = [
        DiningProvider::class,
        CommonProvider::class,
        //...其他服务提供者
    ];
}
