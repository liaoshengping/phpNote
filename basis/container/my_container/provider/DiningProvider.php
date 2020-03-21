<?php


namespace provider;


use core\Container;
use functions\Dining;
use interfaces\Provider;

/**
 * Class DiningProvider
 * @package provider
 * @property Dining dining
 * @property Dining dinings
 */
class DiningProvider implements Provider
{


    public function serviceProvider(Container $container)
    {
        $container['dining'] = function ($container){
            return new Dining($container);
        };
        $container['dinings'] = function ($container){
            return new Dining($container);
        };
    }
}
