<?php


namespace container\provider;


use container\core\Container;
use container\functions\Dining;
use container\functions\Pdos;
use container\functions\php\PHPCommon;
use container\functions\Struct;
use container\functions\Table;
use container\functions\tool\Console;
use container\functions\tool\Tool;
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
        $container['struct'] = function ($container){
            return new Struct($container);
        };
        $container['phpcommon'] = function ($container){
            return new PHPCommon($container);
        };
        $container['tool'] = function ($container){
            return new Tool($container);
        };
    }
}
