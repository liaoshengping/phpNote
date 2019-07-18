<?php
//博客园  https://www.cnblogs.com/crxis/p/7714636.html

// 去掉任意数字
$str="as2223adfsf0s4df0sdfsdf<abc>";
echo preg_replace("/0/","",$str).PHP_EOL;//去掉0字符，此时相当于 replace的功能, preg_replace("/0/","A",$str); 这样就是将0变成A的意思了
echo preg_replace("/[0-9]/","",$str).PHP_EOL;//去掉所有数字
echo preg_replace("/[a-z]/","",$str).PHP_EOL; //这样是去掉所有小写字母
echo preg_replace("/[A-Z]/","",$str).PHP_EOL; //这样是去掉所有大写字母
echo preg_replace("/[a-z,A-Z]/","",$str).PHP_EOL; //这样是去掉所有字母
echo preg_replace("/[a-z,A-Z,0-9]/","",$str).PHP_EOL; //去掉所有字母和数字
echo "匹配开始:".PHP_EOL;
echo preg_replace("/<.*>/","",$str).PHP_EOL;//这个是表示去除以<开头，以>结尾的那部份，输出结果是：acsdcssdcd
$str="acsdcs<55555555>sc<6666>sdcd";
echo preg_replace("/<.{4}>/","",$str).PHP_EOL; // 去除 括号里四位数的

//sh

