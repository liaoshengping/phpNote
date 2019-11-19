<?php

namespace Facebook\WebDriver;
include ("../vendor/autoload.php");

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

$wd_host = 'http://127.0.0.1:4444/wd/hub';
$driver = RemoteWebDriver::create($wd_host, DesiredCapabilities::chrome());
$driver->get("http://baidu.com");


?>
