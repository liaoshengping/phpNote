<?php

$encrypted = '{"id":12}'; //wyJy7dTITM1EBaQzVmT+lw==


$key = '5232557b2c46da39';
$iv = '1724661709357097';


$data =  base64_encode(openssl_encrypt($encrypted,"AES-128-CBC",$key,OPENSSL_RAW_DATA,$iv));

echo openssl_decrypt(base64_decode($data),"AES-128-CBC",$key,OPENSSL_RAW_DATA,$iv);
# uniapp  https://ext.dcloud.net.cn/plugin?id=4317

