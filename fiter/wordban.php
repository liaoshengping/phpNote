<?php
require_once ("../vendor/autoload.php");
$sensitive_words = array(
    'SB', '傻逼', 'Fuck','fuck'
);

use Singiu\WordBan;

$text = 'SB就是傻逼！fuck is a bad word!';

WordBan\WordBan::load($sensitive_words);
$result = WordBan\WordBan::escape($text); // escape 方法会将文本中找到的敏感词使用替代词（默认是*）替换掉。
echo $result; // **就是**！**** is a bad word!
