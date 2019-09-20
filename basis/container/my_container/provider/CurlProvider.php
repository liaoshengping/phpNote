<?php


namespace provider;


use core\Container;
use functions\Curl;
use functions\Dining;
use interfaces\Provider;

class CurlProvider implements Provider
{

    public function serviceProvider(Container $container)
    {
        $container['curl'] = function ($container){
            return new Curl($container);
        };
    }
}
