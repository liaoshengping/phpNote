<?php

include ("vendor/autoload.php");

use \Liaosp\Tool\Curl\SyncCurl;

$urls = [];
for ($i=0;$i<2;$i++){
    $urls[] ='http://liaosp.top';
}
$datas = [];

function callback($output) {
    echo $output;

}

SyncCurl::Curl($urls,'callback',$datas);


var_dump($datas);

