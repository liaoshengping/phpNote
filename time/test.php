<?php
$time = '1639242732';

$time =strtotime(date("Y-m-d H", $time).':00:00');


var_dump($time);exit;
