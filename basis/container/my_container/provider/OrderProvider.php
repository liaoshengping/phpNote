<?php


namespace provider;


use core\Container as 容器;
use functions\Order as Dingdan;
use interfaces\Provider;

class OrderProvider implements Provider
{
    public function serviceProvider(容器 $container)
    {
        $container['order'] = function(){
            return new Dingdan();
        };
    }
}
