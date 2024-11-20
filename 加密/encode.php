<?php
$encrypted = '===='; //wyJy7dTITM1EBaQzVmT+lw==


$key = '9048582919458519';
$iv = '7052670228029926';


echo base64_encode(openssl_encrypt($encrypted,"AES-128-CBC",$key,OPENSSL_RAW_DATA,$iv));

# uniapp  https://ext.dcloud.net.cn/plugin?id=4317