<?php

$data = file_get_contents('http://127.0.0.1:8181/?a=https://m.5ykj.com/');

file_put_contents(__DIR__.'/image.png', base64_decode($data));
