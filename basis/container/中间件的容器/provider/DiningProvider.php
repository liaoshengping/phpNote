<?php


namespace container\provider;


use container\core\Container;
use container\functions\Dining;
use container\interfaces\Provider;

class DiningProvider implements Provider
{

    public function serviceProvider(Container $container)
    {
        $container['dining'] = function ($container){
            return new Dining($container);
        };
    }
}
