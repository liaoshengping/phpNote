<?php




 $data = format_money("-50.233");
var_dump((string)$data);exit;
function format_money($money = null)
{
   return floatval($money);

}

exit;

$total_amount = bcmul(1, 1.00, 2);
var_dump($total_amount);exit;

$sum = 9/11;
echo round(8*$sum,2);exit;


$lastDate = date('Y-m-d', strtotime('last day'));
echo $lastDate;exit;
    $date = '2019';

    var_dump(is_numeric($date));exit;
    $date = strtotime($date);
    var_dump(date("Y",$date));exit;
    #拼接获取Code的URL

    $url='http://gw.api.alibaba.com/openapi';

    $appKey='3937604';

    $appSecret ='0RsvFZYVQd';

    #回调URL

    $redirectUrl = 'http://amazon_object.com/api/request/requestlog';

    #生成签名

    $code_arr = array(

        'client_id' => $appKey,

        'redirect_uri' => $redirectUrl,

        'site' => 'aliexpress'

    );

    ksort($code_arr);

    $sign_str = '';

    foreach ($code_arr as $key=>$val){

        $sign_str .= $key . $val;

    }

    $code_sign = strtoupper(bin2hex(hash_hmac("sha1", $sign_str, $appSecret, true)));
    $get_code_url = 'http://gw.api.alibaba.com/auth/authorize.htm?client_id='.$appKey.'&site=1688&redirect_uri='.$redirectUrl.'&_aop_signature='.$code_sign;
    echo $get_code_url;


