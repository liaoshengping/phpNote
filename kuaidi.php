<?php


include ("vendor/autoload.php");
$obj = new \Liaosp\Express\Express();
//$obj->addChannel('baidu');
//$obj->setExpress('kuaidi100');
//$obj->setExpress('ickd');
$res = $obj->number('YT2121729223657');

var_dump($res);exit;
echo json_encode($res);exit;
