<?php


namespace App\Services\AliOpen\provider;


use App\Services\AliOpen\core\Container;
use App\Services\AliOpen\functions\Dining;
use App\Services\AliOpen\interfaces\Provider;

class DiningProvider implements Provider
{

    public function serviceProvider(Container $container)
    {
        $container['dining'] = function ($container){
            return new Dining($container);
        };
    }
}
