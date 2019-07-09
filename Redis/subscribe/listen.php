<?php
//监听者
$redis = new Redis();
$redis->connect('127.0.0.1',6379);

echo 'reading c1 ...\n';

//设置超时控制
$redis->setOption(Redis::OPT_READ_TIMEOUT,-1);

$redis->subscribe(['c1','c2'],function(Redis $instance, $channel, $message){
    echo 'recieve message from '.$channel.':'.$message.'\n';
});
