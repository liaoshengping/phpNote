<?php
include_once ('manager.php');

//处理订单的流程
$manager = new PluginManager(); //可把这个加入系统的静态类 eg:app('plugin')

$manager->trigger('order','订单id:234234234');
