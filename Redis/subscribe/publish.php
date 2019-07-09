<?php
//发布者

$redis = new Redis();

$redis->connect('127.0.0.1',6379);


$res = $redis->publish('c1','');

echo 'clents'.$res;
