<?php

use MillionMile\GetEnv\Env;

const APP_PATH = __DIR__ . '/..';

function env($name, $default = null)
{
    Env::loadFile('.env');
    return Env::get($name, $default);
}
//缓存
function cache($name, $data='' , $extime = 0){
   return \common\cache::cache($name, $data, $extime);
}

//缓存
function config($name, $default = null)
{
    $config = cache('config_cache');

    return $config[$name]??$default;
}


