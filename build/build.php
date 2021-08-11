<?php

include_once("vendor/autoload.php");
include_once("Loder.php");
include_once ("common/common.php");

$app = new \container\Application([
    'argv' => $argv
]);

$app->run();



