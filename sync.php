<?php

include ("vendor/autoload.php");

use \Liaosp\Tool\Curl\SyncCurl;

$urls = [];
for ($i=0;$i<100;$i++){
    $urls[] ='http://baidu.com';
}
function callback($output){
    echo $output;
}

SyncCurl::Curl($urls,'callback');

