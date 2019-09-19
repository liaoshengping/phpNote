<?php
namespace provider;

use core\Container;
use functions\Order;
use interfaces\Provider;

class DbProvider implements Provider
{
    public function serviceProvider(Container $container,array $values = array())
    {
        $container['db'] = function($container){
            return new \functions\Db($container);
        };

    }
}
