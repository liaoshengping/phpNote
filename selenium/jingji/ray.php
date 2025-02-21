<?php

use Facebook\WebDriver\Remote\RemoteWebDriver;
include ("../../vendor/autoload.php");
include_once ('match.php');

$serverUrl = 'http://localhost:4444';


$capabilities  = \Facebook\WebDriver\Remote\DesiredCapabilities::chrome();

$option = new \Facebook\WebDriver\Chrome\ChromeOptions();

$capabilities->setPlatform(\Facebook\WebDriver\WebDriverPlatform::WINDOWS);
$capabilities->setCapability('userAgent', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
$capabilities->setCapability('user-agent', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
// Chrome
$driver = RemoteWebDriver::create($serverUrl, $capabilities);


$driver->get('https://www.ray052.com/');

sleep(5);
while (true){

    file_put_contents(__DIR__.'/html/ray.html',$driver->getPageSource());

    if (is_int((time() - (strtotime(date('Y-m-d'))))/600)){
        $driver->navigate()->refresh();
        sleep(2);
    }



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

        'leftTeamLogo'=>array('.left-contain .team-logo','data-src'),
        'leftTeamName'=>array('.left-contain .odds-name','text'),
        'leftTeamAdds'=>array('.left-contain .bet-odds','text'),

        'rightTeamLogo'=>array('.right-contain .team-logo','data-src'),
        'rightTeamName'=>array('.right-contain .odds-name','text'),
        'rightTeamAdds'=>array('.right-contain .bet-odds','text'),
    ])
    ->range('.match-card')
    ->queryData();

file_put_contents(__DIR__.'/json/ray.json',json_encode($data,JSON_UNESCAPED_UNICODE));

doMatch();
}

?>
