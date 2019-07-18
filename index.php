<?php
//set_time_limit(0);
//for ($i =1;$i<=4716;$i++){
//    $result = getUrl();
//    file_put_contents('test.txt',$result);
//    echo $i.PHP_EOL;
//}
//echo $result;

echo "hello worldss";exit;
function getUrl($url){
    $result = file_get_contents($url);
    if(! mb_check_encoding($result, 'utf-8')) {
        $result = mb_convert_encoding($result,'UTF-8',['ASCII','UTF-8','GB2312','GBK']);
    }
    return $result;
}

var_dump(getUrl('https://mp.weixin.qq.com/s?__biz=MjM5MjAxNDM4MA==&mid=2666257152&idx=1&sn=64b95c867abace4ce247510c11b42847&chksm=bdb3b2438ac43b55001063cdd8a326d8a531f053252c2f8148681c82743bf4acc91e64086b3b'));
