<?php


namespace common\redis_publish\base;


use common\services\CommonService;

class RedisClient
{
    static $_instance;
    static $redis;
    /**
     *  初始化Redis ,订阅中用系统自带的 Redis::$app->redis 报错，故统一做处理
     */
    public static function init(){
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
            //连接Redis
            $redisParam = \Yii::$app->redis;
            $redis = new \Redis();
            $hostname = $redisParam->hostname;
            $port =$redisParam->port;
            $redis->connect($hostname,$port);
            self::$redis = $redis;
            return $redis;
        }else{
            return self::$redis;
        }
    }
}
