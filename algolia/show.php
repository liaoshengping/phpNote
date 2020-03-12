<?php



require_once("../vendor/autoload.php");
$client = Algolia\AlgoliaSearch\SearchClient::create(
    '6USHAEYV9D',
    '0f8fd9577c82eabfe60e131de36e1cd8'
);

$index = $client->initIndex('test');

$objects = $index->search('建厦');

var_dump($objects);exit;
