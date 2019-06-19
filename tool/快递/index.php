<?php
include ("../../vendor/autoload.php");
// ("../../vendor/autoload.php");
$logistics = new Wythe\Logistics\Logistics();
$res =$logistics->query('71291609210123'); // 第二参数不设,则默认快递100接口
var_dump($res['kuaidi100']['result']);
