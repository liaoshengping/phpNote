<?php


namespace container\provider;


use container\core\Container;
use container\functions\Dining;
use container\functions\Pdos;
use container\interfaces\Provider;

class CommonProvider implements Provider
{

    public function serviceProvider(Container $container)
    {
        $container['db'] = function ($container){
            return new PDOs($container);
        };
    }
}
