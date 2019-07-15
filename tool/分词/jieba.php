<?php
ini_set('memory_limit', '1024M');
include ("../../vendor/autoload.php");
use Fukuball\Jieba\Jieba;
use Fukuball\Jieba\Finalseg;
Jieba::init();
Finalseg::init();

$seg_list = Jieba::cut("我是厦门人！");
var_dump($seg_list);
