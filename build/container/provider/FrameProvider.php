<?php


namespace container\provider;


use container\core\Container;
use container\functions\go\gin\Gin;
use container\functions\htmlv1\bootstrap_official\Bootstrap;
use container\functions\php\laravel\Laravel;
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

        $container['laravel'] = function ($container){
            return new Laravel($container);
        };

        $container['htmlv1'] = function ($container){
            return new Bootstrap($container); //簡單官網  https://sc.chinaz.com/moban/210528107370.htm
        };

        $container['huafei'] = function ($container){
            return new \container\functions\huafei\Bootstrap($container); //簡單官網  https://sc.chinaz.com/moban/210528107370.htm
        };



    }
}
