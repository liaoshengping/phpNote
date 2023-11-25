<?php

$url = 'http://t.cms.hjcpay.com/foreignCommon/getCharge';

$bizContent = [
    'parkingId' => 1,
    'carNumber' => 1,
    'chrgSeq' => 1,
    'chrgType' => 1,
    'chrgTime' => 1,
    'chrgMny' => 1,
    'shopType' => 1,
];

$data  = post_curl($url,$bizContent);

var_dump($data);exit;



function post_curl($url, $data, $timeout = 5) {
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true );
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
    $result = curl_exec( $ch );
    curl_close($ch);
    return $result;
}