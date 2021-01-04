<?php
require_once("../vendor/autoload.php");

$ffmpeg = FFMpeg\FFMpeg::create();
$video = $ffmpeg->open(__DIR__.'video.mp4');

var_dump($video);exit;


