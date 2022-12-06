<?php

use Facebook\WebDriver\Remote\RemoteWebDriver;
include ("../vendor/autoload.php");

$serverUrl = 'http://localhost:4444';


$capabilities  = \Facebook\WebDriver\Remote\DesiredCapabilities::chrome();



$option = new \Facebook\WebDriver\Chrome\ChromeOptions();
//$option->addArguments();

$capabilities->setPlatform(\Facebook\WebDriver\WebDriverPlatform::WINDOWS);
$capabilities->setCapability('userAgent', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
$capabilities->setCapability('user-agent', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
// Chrome
$driver = RemoteWebDriver::create($serverUrl, $capabilities);

//可学习点击事件
//https://github.com/luanloose/api-mc-experiencia/blob/8f5d31d8017a27f3d452501a303689891dd94a64/app/Http/Controllers/McDonalds.php#L188
//https://github.com/greenpeace/planet4-selenium-tests/blob/e732e68a040ee16b7f300b6ae00f8c23d3ca0417/tests/p4/CarouselHeader.php

$arr = [
    '原创设计可爱圣诞节帽子发箍女发卡发夹头箍鸭嘴夹子发饰头饰饰品',
    '圣诞节装饰品创意小灯笼摆件桌面场景布置儿童礼物小礼品拍摄道具',
];

//for ($day=0;$day<32;$day++){
//    $date = \Carbon\Carbon::parse('2022-04-01')->addDays($day)->timestamp;
    $driver->get('https://kzurl02.cn/dCKdK');
    for ($i = 1; $i < 10000; $i++) {
        echo '到了';
        sleep(2);



        $click = $driver->findElement(
            \Facebook\WebDriver\WebDriverBy::xpath('//div[contains(text(), "'.$arr[$i-1].'")]')
//            \Facebook\WebDriver\WebDriverBy::xpath('//div[contains(@class, "buy-btn")][1]')
//            \Facebook\WebDriver\WebDriverBy::cssSelector('.list-view-section-body:nth-child('.$i.') .buy-btn')
        );

//        var_dump($click->getText());
        $click->click();

        sleep(2);
        $driver->findElement(
            \Facebook\WebDriver\WebDriverBy::xpath('//span[contains(text(), "复制口令")]')
        )->click();
        sleep(1);

        $data =$driver->getPageSource();
        file_put_contents(__DIR__.'/damai/'.$i.'.html',$data);

//        $driver->executeScript('window.scrollTo(0,document.body.scrollHeight);');
//        $driver->executeScript('window.scrollTo(0,0);');
//        $driver->executeScript('window.scrollTo(0,document.body.scrollHeight);');
//        $driver->executeScript('window.scrollTo(0,0);');
//        sleep(1);
//        $driver->executeScript('window.scrollTo(0,document.body.scrollHeight);');
    }
    $data =$driver->getPageSource();
    file_put_contents(__DIR__.'/damai/.html',$data);
//}



?>
