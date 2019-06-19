<?php


include ("vendor/autoload.php");
$obj = new \Liaosp\Express\Express();
//$obj->addChannel('baidu')
$obj->setExpress('kuaidi100');
$obj->setExpress('ickd');
$res = $obj->number('71291609210123');
echo json_encode($res);exit;
