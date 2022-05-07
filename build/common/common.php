<?php

use MillionMile\GetEnv\Env;
use Philo\Blade\Blade;

const APP_PATH = __DIR__ . '/..';

function xenv($name, $default = null)
{

    Env::loadFile('.env');
    return Env::get($name, $default);
}

//缓存
function cache($name, $data = '', $extime = 0)
{
    return \common\cache::cache($name, $data, $extime);
}

function view($name, $data)
{

    $path = config('view_path');

    $cache = 'runtime/cache/';

    $render = (new Blade(
        $path,
        $cache
    ))->view()->make($name, $data)->render();


    return $render;

}

//缓存
function config($name = '', $default = null)
{
    $config = cache('config_cache');

    if (empty($config)) {
        return $config;
    }

    if (empty($name)) {
        return $config;
    }

    return $config[$name] ?? $default;
}


