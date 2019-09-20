<?php


namespace provider;


use core\Container;
use functions\Dining;
use interfaces\Provider;

class DiningProvider implements Provider
{

    public function serviceProvider(Container $container)
    {
        $container['dining'] = function ($container){
            return new Dining($container);
        };
    }
}
