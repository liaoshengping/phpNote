<?php

class message
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
        echo $orderId.'发送消息，你的订单已经创建成功！！！'.PHP_EOL;
    }

}
