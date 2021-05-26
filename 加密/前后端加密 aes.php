<?php

$key = '123456';//��������
$plaintext = "http://www.neter8.com/";
$ivlen = openssl_cipher_iv_length($cipher="AES-128-CBC");
$iv = openssl_random_pseudo_bytes($ivlen);
$ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
$hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
$ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
var_dump($ciphertext);//string(108) "���������Ǳ仯��Ŷ"

$c = base64_decode($ciphertext);//����base64
$ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
$iv = substr($c, 0, $ivlen);
$hmac = substr($c, $ivlen, $sha2len = 32);
$ciphertext_raw = substr($c, $ivlen + $sha2len);
$original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
$calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
if (hash_equals($hmac, $calcmac)) //PHP 5.6+ ��ʱ������ȫ�ԱȽ�
{
    echo $original_plaintext;//http://www.neter8.com/
}

//7.1 +

$key = '��������';
$plaintext = "http://www.neter8.com/";
$cipher = "aes-128-gcm";
$iv =222;
if (in_array($cipher, openssl_get_cipher_methods())) {
    $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options = 0, $iv, $tag);
    //ʹ�� $cipher, $iv, and $tag ����
    $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, $options = 0, $iv, $tag);
    echo $original_plaintext;//http://www.neter8.com/
}

