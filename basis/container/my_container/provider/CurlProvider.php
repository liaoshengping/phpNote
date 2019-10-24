<?php


namespace provider;


use core\Container;
use functions\Curl;
use functions\LajiLaji;
use interfaces\Provider;

class CurlProvider implements Provider
{

    public function serviceProvider(Container $container)
    {
        $container['curl'] = function ($container){
            return new Curl($container);
        };
        $container['lajiLaji'] = function ($container){
            return new LajiLaji($container);
        };
    }
}
