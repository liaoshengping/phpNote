<?php
include (__DIR__.'/mid.php');
$user = mid::user();
$user->param = 12;
$param = $user->param;
echo $param;
