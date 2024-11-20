<?php

// 假设这是你从Python加密后得到的Base64编码的字符串
$encryptedData = 'dol0FkuCxzWyEwJEw5aInQ==';

// 加密时使用的密钥和IV，确保它们与Python加密时使用的相同
$key = '9048582919458519'; // AES-128 需要16字节的密钥
$iv = '7052670228029926';  // CBC模式需要一个IV，通常也是16字节

// 将Base64编码的字符串解码回二进制数据
$encryptedData = base64_decode($encryptedData);


// 使用openssl_decrypt解密数据
// 注意：AES-128-CBC是加密模式，OPENSSL_RAW_DATA表示输出原始二进制数据（而不是Base64编码）
$decryptedData = openssl_decrypt($encryptedData, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);

// 输出解密后的数据
var_dump($decryptedData);exit;
