<?php


namespace container\provider;


use container\core\Container;
use container\functions\Dining;
use container\functions\Pdos;
use container\functions\Table;
use container\functions\tool\Console;
use container\interfaces\Provider;

class CommonProvider implements Provider
{

    public function serviceProvider(Container $container)
    {
        $container['db'] = function ($container){
            return new PDOs($container);
        };
        $container['console'] = function ($container){
            return new Console($container);
        };

        $container['table'] = function ($container){
            return new Table($container);
        };
    }
}
