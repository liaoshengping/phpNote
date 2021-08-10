<?php
//内存太大了，弃用
ini_set('memory_limit', '1024M');
include ("../../vendor/autoload.php");
use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Finalseg;
Jieba::init();
Finalseg::init();

$seg_list = Jieba::cut("帮宝适清新帮拉拉裤试用装XL5片(12-17kg)加大码婴儿纸尿裤尿不湿柔软透气！");
var_dump($seg_list);
