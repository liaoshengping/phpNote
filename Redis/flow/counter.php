<?php
/**
 *
 * @param $userId
 * @param $action
 * @param $period  2*1000 两秒钟内，最大的请求数
 * @param $maxCount
 * @return bool
 */
function isActionAllowed($userId, $action, $period, $maxCount)
{
    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379);
    $key = sprintf('hist:%s:%s', $userId, $action);
    $now = msectime();   # 毫秒时间戳

    $pipe=$redis->multi(Redis::PIPELINE); //使用管道提升性能
    $pipe->zadd($key, $now, $now); //value 和 score 都使用毫秒时间戳
    $pipe->zremrangebyscore($key, 0, $now - $period); //移除时间窗口之前的行为记录，剩下的都是时间窗口内的
    $pipe->zcard($key);  //获取窗口内的行为数量
    $pipe->expire($key, $period + 1);  //多加一秒过期时间
    $replies = $pipe->exec();
    return $replies[2] <= $maxCount;
}
for ($i=0; $i<6; $i++){
    var_dump(isActionAllowed("110", "reply", 2*1000, 5)); //执行可以发现只有前5次是通过的
}

//返回当前的毫秒时间戳
function msectime() {
    list($msec, $sec) = explode(' ', microtime());
    $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    return $msectime;
}
