<?php

namespace Cblink\MeituanDispatch;

use Hanson\Foundation\Foundation;

/**
 * Class Dispatch
 * @method array createByShop($params)
 *
 * @package Cblink\MeituanDispatch
 */
class Dispatch extends Foundation
{

    private $order;

    public function __construct($config)
    {
        parent::__construct($config);
        $this->order = new Order($config['appkey'], $config['secret']);
    }

    public function __call($name, $arguments)
    {
        return $this->order->{$name}(...$arguments);
    }
}
