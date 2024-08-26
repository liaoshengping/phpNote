<?php

$encrypted = '123'; //wyJy7dTITM1EBaQzVmT+lw==
$key = '1234567891234567';
$iv = '1234567891234567';
echo openssl_encrypt($encrypted,"AES-128-CBC",$key,OPENSSL_RAW_DATA,$iv);

# uniapp  https://ext.dcloud.net.cn/plugin?id=4317

