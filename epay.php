<?php

$price = 0.01;
$payId = time();
$type = 1;
$param = '自定义参数';
$mchId = '1698387051';
$secret = '7fb421c8a3df49f6afc09d15e06f96e7';

//var_dump(md5($payId . $param . $type . $price . $secret));exit;

$form = [
    'mchId' => $mchId,
    'payId' => $payId,
    'type' => $type,
    'price' => 0.01,
    'sign' => md5($payId . $param . $type . $price . $secret),
    'goodsName' => '商品名称',
    'param' => $param,
    'isHtml' => 0,
    'notifyUrl' => 'https://mb.mm1988.com/pay',
    'returnUrl' => '',
];



$data =send_post('https://epay.jylt.cc/api/createOrder',$form);

file_put_contents('epay.json',$data);


/**
 * Curl版本
 * 使用方法：
 * $post_string = "app=request&version=beta";
 * 吃猫的鱼 www.fish9.cn
 */


/**
 * Curl版本
 * 使用方法：
 * $post_string = "app=request&version=beta";
 * request_by_curl('http://www.jb51.net/restServer.php', $post_string);
 */
/**
 * 发送post请求
 * @param string $url 请求地址
 * @param array $post_data post键值对数据
 * @return string
 */
function send_post($url, $post_data) {

    $postdata = http_build_query($post_data);
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-type:application/x-www-form-urlencoded',
            'content' => $postdata,
            'timeout' => 15 * 60 // 超时时间（单位:s）
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    return $result;
}




