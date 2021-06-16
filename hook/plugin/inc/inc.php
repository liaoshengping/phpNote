<?php

class inc
{
    public function __construct(&$Manager)
    {
        /**
         * @var PluginManager $Manager
         */
        $Manager->register('order', $this, 'order');

    }


    public function order($orderId)
    {
        echo $orderId.'减库存'.PHP_EOL;
    }
}
