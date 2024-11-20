<?php

echo md5('1729051434');
exit;

$data = file_get_contents('https://v3-web.douyinvod.com/a68ee460d5e158efdc740995d5fb18bb/667bda93/video/tos/cn/tos-cn-ve-15c001-alinc2/oIGA4WetUQnOuAgAj6egbZDuj3oV9agACE73yB/?a=6383&ch=11&cr=3&dr=0&lr=all&cd=0%7C0%7C0%7C3&cv=1&br=710&bt=710&cs=2&ds=6&ft=rVWEerwwZRLGsk~o2PDS6kFgAX1tGkKPHf9eFYIa8Dr12nzXT&mime_type=video_mp4&qs=11&rc=Ojc5PGRkaWVoaTloZGg6PEBpamQ0bTM6ZnVxaDMzNGkzM0A1MDVfMjZeXjQxXmEwY142YSNibDNfcjRnZW9gLS1kLS9zcw%3D%3D&btag=80000e00010000&cquery=100o_101n_100B_100x_100z&dy_q=1719385687&feature_id=eb4c918b9cc575f3dbb154e6c6a43e47&l=2024062615080632A33725C00BAB019956&__vid=7185345014006926652');
var_dump($data);exit;


$start_date = strtotime('2020-01-01');
$end_date = strtotime('2024-03-19');

// 创建一个空数组来存储日志
$log_array = array();

// 循环遍历日期范围，并将每天的日期添加到日志数组中
$current_date = $start_date;
while ($current_date <= $end_date) {
    // 这里可以加入你的日志记录逻辑，例如向$log_array添加元素
    $log_array[] = [
        'start' => $current_date,
        'end' => strtotime('+1 day', $current_date)
    ]; // 将日期格式化为字符串并添加到数组中
    $current_date = strtotime('+1 day', $current_date); // 增加一天
}

$year = [
    '2020' => [
        9000,
        15000,
        2000,
    ],
    '2021' => [
        30000, //每天销售额在 随机 最低三万
        50000, //每天销售额在 随机 最高五万
        2000, //每单价格 100 ~ 10000区间订单
    ],
    '2022' => [
        9000,
        25000,
        6000,
    ],
    '2023' => [
        3000000,
        4000000,
        5000,
    ],
    '2024' => [
        3000000,
        4000000,
        10000,
    ],
];

foreach ($log_array as $value){
    $start = $value['start'];
    $end = $value['end'];


    $amount = 0;

    $current_year = date('Y',$start_date);

    $current_year = $year[$current_year];

    while ($amount < rand($current_year[0],$current_year[1])){
        $orderAmount = rand(100,($current_year[2]*100))/100;
        $amount+=$orderAmount;
        $time = rand($start,$end);

    }

}
exit;

var_dump($log_array);exit;


$img = file_get_contents('https://img.wowo6.com/2c3128b1e81fecb9930ead6e39505d3e.jpg?imageView2/0/w/400');
file_put_contents('test.png',$img);exit;

// 创建 RSA 密钥对
$config = array(
    "digest_alg" => "sha256",
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
);

// 生成密钥对
$rsaKey = openssl_pkey_new($config);

// 获取私钥
openssl_pkey_export($rsaKey, $privateKey);

// 获取公钥
$publicKey = openssl_pkey_get_details($rsaKey)['key'];

// 要加密的原始数据
$data = "Hello, world!";

// 使用公钥加密数据
openssl_public_encrypt($data, $encrypted, $publicKey, OPENSSL_PKCS1_OAEP_PADDING);

// 打印加密后的数据
echo base64_encode($encrypted);
exit;


$encrypted = '123'; //wyJy7dTITM1EBaQzVmT+lw==
$key = '1234567891234567';
$iv = '1234567891234567';
echo base64_encode(openssl_encrypt($encrypted,"AES-128-CBC",$key,OPENSSL_RAW_DATA,$iv));

exit;


$data =file_get_contents('https://m.smxs.com/12shengxiao/tu/218481.html');

var_dump($data);exit;
exit;


include ("vendor/autoload.php");


$data = [];

if (empty($data['kkk']['data'])){
    echo 'empty';exit;
}
exit;

$url = 'https://movie.douban.com/cinema/search/hangzhou/?start=0&q=&city_id=118172';

var_dump(file_get_contents($url));exit;



$data = file_get_contents(__DIR__.'/xingbake');

$str = '';
foreach (json_decode($data,true)['data'] as $item){

    $str.= $item['restaurantName'];
    $str.= "(".$item['restaurantAddress'].")".PHP_EOL;

}
file_put_contents('xingbake.result',$str);
echo $str;exit;

echo date("Y-m-d", strtotime("last day of -1 month", time()));
exit;

echo date('Y-m-d', strtotime('-2 month'));

exit;

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


