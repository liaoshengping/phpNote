<?php
include ("vendor/autoload.php");
$hashids = new \Hashids\Hashids();
$encode = $hashids->encode(1,2,3);
$data = $hashids->decode('o2fXhV');
var_dump($data);exit;
echo $encode;exit;
