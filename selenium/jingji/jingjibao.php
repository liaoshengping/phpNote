<?php


use Facebook\WebDriver\Remote\RemoteWebDriver;

include("../../vendor/autoload.php");

$serverUrl = 'http://localhost:4444';


$capabilities = \Facebook\WebDriver\Remote\DesiredCapabilities::chrome();

$option = new \Facebook\WebDriver\Chrome\ChromeOptions();


$capabilities->setPlatform(\Facebook\WebDriver\WebDriverPlatform::WINDOWS);
$capabilities->setCapability('userAgent', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
$capabilities->setCapability('user-agent', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
// Chrome
//$driver = RemoteWebDriver::create($serverUrl, $capabilities);
//$driver->manage()->window()->maximize();
//
//$driver->get('https://www.jingjibao.today/TfGame');
//
//sleep(2);
//
////点击 朕已阅
//$driver->findElement(
//    \Facebook\WebDriver\WebDriverBy::xpath('//div[contains(text(), "朕已阅")]')
//)->click();
//
////输入用户名
//$driver->findElement(\Facebook\WebDriver\WebDriverBy::cssSelector('.header_input_box .input_box input')) // find search input element
//->sendKeys('lsplsp1'); // fill the search box
////输入密码
//$driver->findElement(\Facebook\WebDriver\WebDriverBy::cssSelector('.pwd .input_box input')) // find search input element
//->sendKeys('aa0597'); // fill the search box
////点击登录
//$driver->findElement(
//    \Facebook\WebDriver\WebDriverBy::cssSelector('.login_btn')
//)->click();
//sleep(2);
////再进入竞技宝
//$driver->get('https://www.jingjibao.today/TfGame');
//sleep(2);
//$newWindow = $driver->findElement(
//    \Facebook\WebDriver\WebDriverBy::cssSelector('iframe')
//)->getAttribute('src');
//
//$driver->get($newWindow);

//while (true) {
//
//    file_put_contents(__DIR__ . '/html/jingjibao.html', $driver->getPageSource());
//    sleep(1);
//
//}




$html = file_get_contents(__DIR__.'/html/jingjibao.html.html');
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


var_dump($data);exit;

//echo count($data);exit;
foreach ($data as $datum) {
    var_dump($datum);
}