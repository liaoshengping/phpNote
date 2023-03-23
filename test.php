<?php


$data = file_get_contents('https://m.duanqu.com/?_ariver_appid=3000000082492472&_mp_code=tb&transition=present&page=pages%2Fgoods%2Fgoods%3Fid%3D101%26goods_id%3D683516332721%26uu%3DHXKJ%26dd%3D__AID__%26cc%3D__CID__%26platform_code%3Dtoutiao');

file_put_contents('duanqu.html',$data);exit;


echo bcmul(microtime(true), 1000);exit;

var_dump(spider());


 function spider(){

    ini_set("display_errors", "On");//打开错误提示
    ini_set("error_reporting",E_ALL);//显示所有错误
    header("Content-Type: text/html; charset=utf-8");

    $header = headers();
    $header[] = 'Referer: https://item.jd.com/4995961.html';

    //设置浏览器信息
    $header[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.70 Safari/537.36';

    $url = 'https://club.jd.com/comment/productPageComments.action?callback=fetchJSON_comment98&productId=4995961&score=0&sortType=5&page=1&pageSize=10&isShadowSku=0&rid=0&fold=1';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    //为防止爬取多次禁用Ip，可用代理ip
//            curl_setopt($ch, CURLOPT_PROXY,'88.198.50.103'); //代理服务器地址
//            curl_setopt($ch, CURLOPT_PROXYPORT, '8080'); //代理服务器端口

    $output = curl_exec($ch);
    curl_close($ch);

    $encode = mb_detect_encoding($output, array("ASCII",'UTF-8',"GB2312","GBK",'BIG5'));
    if($encode == 'UTF-8'){
        echo $encode;
    }else{
        $output = mb_convert_encoding($output, 'UTF-8', $encode);
    }
    $result = json_decode($output, true);

    return $result;

}

function headers() {
    $ip_long = array(
        array('607649792', '608174079'), //36.56.0.0-36.63.255.255
        array('1038614528', '1039007743'), //61.232.0.0-61.237.255.255
        array('1783627776', '1784676351'), //106.80.0.0-106.95.255.255
        array('2035023872', '2035154943'), //121.76.0.0-121.77.255.255
        array('2078801920', '2079064063'), //123.232.0.0-123.235.255.255
        array('-1950089216', '-1948778497'), //139.196.0.0-139.215.255.255
        array('-1425539072', '-1425014785'), //171.8.0.0-171.15.255.255
        array('-1236271104', '-1235419137'), //182.80.0.0-182.92.255.255
        array('-770113536', '-768606209'), //210.25.0.0-210.47.255.255
        array('-569376768', '-564133889'), //222.16.0.0-222.95.255.255
    );
    $rand_key = mt_rand(0, 9);
    $ip= long2ip(mt_rand($ip_long[$rand_key][0], $ip_long[$rand_key][1]));

    $headers['CLIENT-IP'] =$ip;
    $headers['X-FORWARDED-FOR'] =$ip;
    $headers["VIA"] = $ip;
    $headers["REMOTE_ADDR"] = $ip;

//    $headers[] = 'Referer: https://item.jd.com/';

    $headerArr = array();
    foreach($headers as $n => $v ) {
        $headerArr[] = $n .': ' . $v;
    }
    return $headerArr;
}

function getMillisecond() {
    list($s1, $s2) = explode(' ', microtime());
    return (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
}


