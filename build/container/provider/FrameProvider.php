<?php


namespace container\provider;


use container\core\Container;
use container\functions\go\gin\Gin;
use container\functions\php\thinkphp\Thinkphp;
use container\interfaces\Provider;

class FrameProvider implements Provider
{

    public function serviceProvider(Container $container)
    {
        $container['thinkphp'] = function ($container){
            return new Thinkphp($container);
        };
        $container['golang'] = function ($container){
            return new Gin($container);
        };
    }
}
