<?php

include_once("vendor/autoload.php");
include_once("Loder.php");
include_once ("common/common.php");

cache('config_cache',include_once ("config/go-config.php")); //如果多应用，复制这个文件，新增配置名字

$app = new \container\Application([
    'argv' => $argv,
]);

$app->run();
