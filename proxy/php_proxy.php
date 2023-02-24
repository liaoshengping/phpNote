<?php

//echo file_get_contents('http://get-goods.dingdong.site/');exit;

function GET_URL()
{
    $ch = curl_init();
    //设置目标请求的网址
    curl_setopt($ch, CURLOPT_URL, 'http://get-goods.dingdong.site/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    //设置代理ip地址
    curl_setopt($ch, CURLOPT_PROXY, "173.245.49.77");
    //设置代理端口
    curl_setopt($ch, CURLOPT_PROXYPORT, "80");
    // curl_setopt($ch, CURLOPT_PROXYUSERPWD, "user:password");//账号密码
    curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP); //使用http代理模式

    //执行URL请求并把它传递给浏览器
    $response = curl_exec($ch);

//     print($response);
    curl_close($ch);
    return $response;
}

$value = GET_URL();
var_dump($value);

