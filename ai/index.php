<?php
require_once("../vendor/autoload.php");

$samples = [
    ['香烟','打火机','火柴','电饭煲','大米','粗粮','米老头'],
    ['花生油','薯条机','薯条','炸鸡翅',],
    ['香烟','炸鸡','啤酒','鸡排','薯条'],
    ['打火机','炸鸡','啤酒','可乐','吸毒'],
    ['香烟','打火机','炸鸡','啤酒','吸毒'],
    ['香烟','打火机','炸鸡','可乐','吸毒'],
    ['可乐','炸鸡','薯条','可乐','吸毒','炸鸡翅'],

];
use Phpml\Association\Apriori;
$associator  =  new  Apriori($support  =  0.2,  $confidence  =  0.2);
$associator->train($samples,  []);
$associator->getRules();

$res = $associator->predict(['薯条']);

var_dump($res);exit;

