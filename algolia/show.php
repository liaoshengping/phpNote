<?php


use Algolia\AlgoliaSearch\SearchClient;

require_once("../vendor/autoload.php");
$client = Algolia\AlgoliaSearch\SearchClient::create(
    '6USHAEY**',
    '0f8fd9577c82eabfe60e131de36e1cd8'
);

$index = $client->initIndex('test');

$objects = $index->search('厦门工商');

var_dump($objects);exit;
