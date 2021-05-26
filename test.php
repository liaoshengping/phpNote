<?php
include ("vendor/autoload.php");





exit;
$tokenUrl = 'https://www.baidu.com/baidu?isource=infinity&iname=baidu&itype=web&tn=02003390_42_hao_pg&ie=utf-8&wd=%E5%BF%AB%E9%80%92';

$client = new GuzzleHttp\Client();
$res = $client->request('GET', $tokenUrl, [
    'query' => ['wd' => 'QueryList'],
    'headers' => [
        'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.149 Safari/537.36',
        'Accept-Encoding' => 'gzip, deflate, br',
    ]
]);
$html = $res->getBody();

echo $html;
exit;

header('Content-type:text/html;charset=utf-8');
$url = "http://www.baidu.com";
var_dump(file_get_contents($url));exit;


  function MoneyTrimSymbol($money)
{
    $money = floatval($money);
    return $money >= 0 ? '¥' . $money : '-¥' . abs($money);
}

echo MoneyTrimSymbol(null);exit;


$goods = ['name' => '222'];
$list =['name2' => '234234','list' => [[123,12312,1231],[12312]]];

$merge = array_merge($goods,$list);

var_dump($merge);exit;


$arr = array('5','2','0','1','3','1','4');

function BubbleSort(array $arr)
{
    for ($i=0 ; $i <count($arr) ; $i++) {
        //设置一个空变量
        $data = '';
        for ($j=$i ; $j < count($arr)-1 ; $j++) {

            //if 5 >2  5拿出来  5的位置被下一位取代 下一位编程了5

            if ($arr[$i] > $arr[$j+1]) {
                $data      = $arr[$i];
                $arr[$i]   = $arr[$j+1];
                $arr[$j+1] = $data;
            }
        }
    }
    return $arr;
}

print_r(BubbleSort($arr));

exit;


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


