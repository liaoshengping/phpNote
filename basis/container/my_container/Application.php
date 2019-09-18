<?php
use core\Base;

/**
 * Class Application
 * @property \functions\Db db
 * @property \functions\Order order
 * @property \functions\Sale sale
 */
class Application extends Base
{
    /**
     * 服务提供者
     * @var array
     */
    protected $provider = [
        \provider\DbProvider::class,
        \provider\OrderProvider::class,
        \provider\SaleProvider::class,
        //...其他服务
    ];
}
