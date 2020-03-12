<?php
require_once("../vendor/autoload.php");
$client = Algolia\AlgoliaSearch\SearchClient::create(
    '6USHAEYV9D',
    '0f8fd9577c82eabfe60e131de36e1cd8'
);

$index = $client->initIndex('test');

$index->saveObject(['objectID' => 1, '人民' => '中国人民银行','农行'=>'厦大门']);
$index->saveObject(['objectID' => 2, '建设' => '厦门建设']);
