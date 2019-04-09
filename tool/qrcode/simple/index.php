<?php
/**
 * Created by PhpStorm.
 * User: liaosp
 * Date: 2019/4/9
 * Time: 17:30
 * 如果不行，要单独创建一个文件，通过<img src =""qrcode.php?url =自己定义的域名就可以了
 */
include_once('phpqrcode.php');
$url = urldecode('baidu.com');
QRcode::png($url);