<?php

use Facebook\WebDriver\Remote\RemoteWebDriver;
include ("../vendor/autoload.php");

$serverUrl = 'http://localhost:4444';


$capabilities  = \Facebook\WebDriver\Remote\DesiredCapabilities::chrome();



$option = new \Facebook\WebDriver\Chrome\ChromeOptions();
$option->addArguments();

$capabilities->setPlatform(\Facebook\WebDriver\WebDriverPlatform::WINDOWS);
$capabilities->setCapability('userAgent', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
$capabilities->setCapability('user-agent', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
// Chrome
$driver = RemoteWebDriver::create($serverUrl, $capabilities);




//for ($day=0;$day<32;$day++){
//    $date = \Carbon\Carbon::parse('2022-04-01')->addDays($day)->timestamp;
    $driver->get('https://www.qimai.cn/rank/index/brand/free/device/iphone/country/cn/genre/1000000000');
    for ($i = 1; $i < 10000; $i++) {
        sleep(1);
        $driver->executeScript('window.scrollTo(0,document.body.scrollHeight);');
        $driver->executeScript('window.scrollTo(0,0);');
        $driver->executeScript('window.scrollTo(0,document.body.scrollHeight);');
        $driver->executeScript('window.scrollTo(0,0);');
        sleep(1);
        $driver->executeScript('window.scrollTo(0,document.body.scrollHeight);');
    }
    $data =$driver->getPageSource();
    file_put_contents(__DIR__.'/damai/.html',$data);
//}



?>
