<?php


class notify
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
        echo $orderId.'外包公司的老板让我新加功能，通知仓库要发货了。但是不想改动原来系统的代码，所以可以在这里些写业务'.PHP_EOL;
    }



}
