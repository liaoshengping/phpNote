<?php
class Client
{
    static $_instance;
    static $redis;
    public static function init(){
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
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
