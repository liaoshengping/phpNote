<?php

use Facebook\WebDriver\Remote\RemoteWebDriver;
include ("../../vendor/autoload.php");

$serverUrl = 'http://localhost:4444';


$capabilities  = \Facebook\WebDriver\Remote\DesiredCapabilities::chrome();

$option = new \Facebook\WebDriver\Chrome\ChromeOptions();

$capabilities->setPlatform(\Facebook\WebDriver\WebDriverPlatform::WINDOWS);
$capabilities->setCapability('userAgent', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
$capabilities->setCapability('user-agent', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
// Chrome
//$driver = RemoteWebDriver::create($serverUrl, $capabilities);
//
//
//$driver->get('https://www.ray052.com/');
//
//while (true){
//
//    file_put_contents(__DIR__.'/html/ray.html',$driver->getPageSource());
//    sleep(1);
//
//}


$html = file_get_contents(__DIR__.'/html/ray.html');
//$data = \QL\QueryList::get('https://cms.demo.tecmz.com/news')
$data = \QL\QueryList::html($html)
//    ->find('.match-card-list .match-card section')->map(function ($row){
//    return $row->find('.bet-odds')->texts()->all();
//});

//var_dump($data);
    // 设置采集规则
    ->rules([
        'teamName'=>array('.tournament-name','text'),
        'gameLogo'=>array('.game-icon','data-src'),
        'matchStatus'=>array('.match-status','text'),
        'leftTeam'=>array('.match-status','text'),
    ])
    ->range('.match-card')
    ->queryData();

var_dump($data);exit;

//echo count($data);exit;
foreach ($data as $datum) {
    var_dump($datum);
}



?>
