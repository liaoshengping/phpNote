<?php
//乘法：1*100 =100
$sum =bcmul(1,100,2);
echo ($sum).PHP_EOL;
//加法  1.2322323423 +483984
$sum = bcadd(1.23234234,1.232234234,2);
echo $sum.PHP_EOL;

/*
TODO https://www.php.net/manual/zh/book.bc.php
bcadd — 2个任意精度数字的加法计算
bccomp — 比较两个任意精度的数字
bcdiv — 2个任意精度的数字除法计算
bcmod — 对一个任意精度数字取模
bcmul — 2个任意精度数字乘法计算
bcpow — 任意精度数字的乘方
bcpowmod — Raise an arbitrary precision number to another, reduced by a specified modulus
bcscale — 设置所有bc数学函数的默认小数点保留位数
bcsqrt — 任意精度数字的二次方根
bcsub — 2个任意精度数字的减法
*/
