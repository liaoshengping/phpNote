<?php


namespace provider;


use core\Container;
use functions\Order;
use interfaces\Provider;

class OrderProvider implements Provider
{

    public function serviceProvider(Container $container)
    {
        $container['order'] = function (){
            return new Order();
        };
    }
}
