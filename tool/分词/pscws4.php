<?php
include ("../../vendor/autoload.php");
use wxkxklmyt\Scws;
$scws = new Scws();
$data =$scws -> scws('啦','5',false);
var_dump($data);
