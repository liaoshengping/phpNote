<?php
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "http://ballapi.dingdong.site/test");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXY, '111.177.63.86'); // 阿里云服务器的IP
curl_setopt($ch, CURLOPT_PROXYPORT, '8888');   // 代理服务的端口

// 如果代理服务器需要身份验证，添加以下选项：
curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'username:password');

$output = curl_exec($ch);

if(curl_errno($ch)){
echo 'Curl error: ' . curl_error($ch);
}

curl_close($ch);

echo $output;