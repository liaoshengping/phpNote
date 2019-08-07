<?php

$arr = [
    'id',
    'name',
];
$data ='';

foreach($arr as $key=>$value){
    $data.= 'public static function findOneBy'.ucfirst($value).PHP_EOL;
    $data.='{'.PHP_EOL;
        $data.='static::find';

    $data .= PHP_EOL.'}'.PHP_EOL;
}

foreach($arr as $key=>$value){
    $data.= 'public static function getListBy'.ucfirst($value).PHP_EOL;
}

echo $data;
