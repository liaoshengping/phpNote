<?php
use core\ContainerBase;

/**
 * Class Application
 * @property \functions\Db db
 * @property \functions\Order order
 * @property \functions\Sale sale
 * @property \functions\Dining dining
 * @property \functions\Curl curl
 * @property \functions\LajiLaji lajiLaji
 */
class Application extends ContainerBase
{
    /**
     * 服务提供者
     * @var array
     */
    public function __construct($params = array())
    {
        $this->pushMiddlewares(array(\functions\Log::class,'addLog'),'log');

        parent::__construct($params);
    }

    protected $provider = [
        \provider\CurlProvider::class,
        \provider\DbProvider::class,
        \provider\OrderProvider::class,
        \provider\SaleProvider::class,
        \provider\DiningProvider::class,
        //...其他服务
    ];
}
