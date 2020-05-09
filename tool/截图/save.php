<?php

$data = file_get_contents('http://127.0.0.1:8181/?a=http://www.jq22.com/demo/jqueryEcharts202004092216/');

file_put_contents(__DIR__.'/image.png', base64_decode($data));
