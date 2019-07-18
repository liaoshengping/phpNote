<?php
header('Content-type: image/jpg');
$url = $_GET['url'];
$refer = "http://www.qq.comsss/";
$opt = [
    'http'=>[
        'header'=>"Referer: " . $refer
    ]
];
$context = stream_context_create($opt);
$file_contents = file_get_contents($url);
echo $file_contents;
