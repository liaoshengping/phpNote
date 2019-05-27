<?php
/*
 * 添加用户
 */

require __DIR__ . '/config.php';
use JMessage\IM\User;
//注册
$user = new User($jm);
$res =$user->register('liaosp4','liaosp4','bb','我是圣平4');
//获取用户信息
$res =$user->show('liaosp4');

//$options =[
//    'nickname'=>'我是修改的',
//];
//$res =$user->update('liaosp4',$options);

var_dump($res);
