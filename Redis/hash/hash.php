<?php
$redis = new redis();
$redis -> connect('127.0.0.1',6379);
//$redis -> hSet('myhash','123123123123123','1');
//$redis -> hSet('myhash','12312312221312','2');
//$redis->hDel('myhash','12312312221312');
var_dump($redis -> hGetAll('myhash'));// string 'cherry
