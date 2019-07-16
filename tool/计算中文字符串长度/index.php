<?php
$data =utf8_strlen('中文');
// 计算中文字符串长度
function utf8_strlen($string = null) {
// 将字符串分解为单元
    preg_match_all("/./us", $string, $match);
// 返回单元个数
    return count($match[0]);
}
echo $data;  // 2
