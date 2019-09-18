<?php


namespace provider;


use core\Container;
use functions\Sale;
use interfaces\Provider;

class SaleProvider implements Provider
{

    public function serviceProvider(Container $container)
    {
      $container['sale'] = function (){
          return new Sale();
      };
    }
}
