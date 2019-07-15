<?php
require_once ("../vendor/autoload.php");
$config = require(__DIR__."/config.php");
use Hanson\Vbot\Foundation\Vbot;


$vbot = new Vbot($config);

$vbot->messageHandler->setHandler(function(\Illuminate\Support\Collection $message){
    \Hanson\Vbot\Message\Text::send($message['from']['UserName'], 'hi');
});

$vbot->server->serve();
