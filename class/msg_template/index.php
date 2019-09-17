<?php
//地址https://blog.csdn.net/qq_22823581/article/details/100690466
$array = [
    'msg'=>[
        'title'=>'你的订单已经发货',
        'url'=>'baidu.com?url=【order_id】',
        'order_id'=>"【order_id】",
        'applet_msg'=>[
            'page'=>"【order_id】",
            'data'=>'内容：【content】',
            'array'=>[
                'sub'=>'【phone】'
            ]
        ]
    ]
];


//提取出标志中的关键字
$temp_array = multi2array($array);//多维数组转化为一位数组
$strPattern = "/(?<=【)[^】]+/";
$arrMatches = [];
preg_match_all($strPattern,implode('',$temp_array), $arrMatches);

//替换关键字(数据库中查询)
$ready = $info = [
    'order_id'=>'3224234234234',
    'name'=>'liaosp.top',
    'title'=>'我是标题',
    'phone'=>'150909090909',
    'content'=>'我是信息',
];
//多维数组替换
foreach ($arrMatches[0] as $key=>$value){
    if(key_exists($value,$ready)){//如果存在信息则替换
        strReplace($array,'【'.$value.'】',$ready[$value]);
    }
}

var_dump($array);




/**
 * 全局替换
 * @param $array
 * @param string $search
 * @param string $replace
 */
function strReplace(&$array, $search='', $replace='') {
    $array = str_replace($search, $replace, $array);
    if (is_array($array)) {
        foreach ($array as $key => $val) {
            if (is_array($val)) {
                strReplace($array[$key],$search,$replace);
            }
        }
    }
}

/**
 * 多维数组转化为一维数组
 * @param $array
 * @return array
 */
function multi2array($array) {
    static $result_array = array();
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            multi2array($value);
        }
        else
            $result_array[$key] = $value;
    }
    return $result_array;
}

