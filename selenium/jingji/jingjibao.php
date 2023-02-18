<?php


use Facebook\WebDriver\Remote\RemoteWebDriver;

include("../../vendor/autoload.php");
include_once ('match.php');

$serverUrl = 'http://localhost:4444';


$capabilities = \Facebook\WebDriver\Remote\DesiredCapabilities::chrome();

$option = new \Facebook\WebDriver\Chrome\ChromeOptions();


$capabilities->setPlatform(\Facebook\WebDriver\WebDriverPlatform::WINDOWS);
$capabilities->setCapability('userAgent', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
$capabilities->setCapability('user-agent', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
// Chrome
$driver = RemoteWebDriver::create($serverUrl, $capabilities);



while (true){

    $save = true;

    $driver->get('https://www.jingjibao.today/TfGame');

    sleep(2);

    $driver->manage()->window()->maximize();
//点击 朕已阅
    $driver->findElement(
        \Facebook\WebDriver\WebDriverBy::xpath('//div[contains(text(), "朕已阅")]')
    )->click();

//输入用户名
    $driver->findElement(\Facebook\WebDriver\WebDriverBy::cssSelector('.header_input_box .input_box input')) // find search input element
    ->sendKeys('lsplsp1'); // fill the search box
//输入密码
    $driver->findElement(\Facebook\WebDriver\WebDriverBy::cssSelector('.pwd .input_box input')) // find search input element
    ->sendKeys('aa0597'); // fill the search box
//点击登录
    $driver->findElement(
        \Facebook\WebDriver\WebDriverBy::cssSelector('.login_btn')
    )->click();
    sleep(2);
//再进入竞技宝
    $driver->get('https://www.jingjibao.today/TfGame');
    sleep(2);
    $newWindow = $driver->findElement(
        \Facebook\WebDriver\WebDriverBy::cssSelector('iframe')
    )->getAttribute('src');

    $driver->get($newWindow);



    while ($save) {
//    sleep(6);
        file_put_contents(__DIR__ . '/html/jingjibao.html', $driver->getPageSource());

//    echo '保存成功';
//}

        if (is_int((time() - (strtotime(date('Y-m-d'))))/600)){
            $driver->navigate()->refresh();
            sleep(2);
        }

        if (strstr($driver->getPageSource(),'Token已无效')){
            $save = false;
        }


        $html = file_get_contents(__DIR__ . '/html/jingjibao.html');
//$data = \QL\QueryList::get('https://cms.demo.tecmz.com/news')
        $data = \QL\QueryList::html($html)
//    ->find('.match-card-list .match-card section')->map(function ($row){
//    return $row->find('.bet-odds')->texts()->all();
//});

            // 设置采集规则
            ->rules([
                'teamName' => array('.tooltip__text:eq(0)', 'text'),
                'gameLogo' => array('.lip-container__top span img', 'src'),
                'matchStatus' => array('.inplayBtn', 'text'),

                'leftTeamLogo' => array('.ti-container__home div img', 'src'),
                'leftTeamName' => array('.ti-container__home .tooltip__text', 'text'),
                'leftTeamAdds' => array('.ti-container__home .rate__rate', 'text'),

                'rightTeamLogo' => array('.ti-container__away div img', 'src'),
                'rightTeamName' => array('.ti-container__away .tooltip__text', 'text'),
                'rightTeamAdds' => array('.ti-container__away .rate__rate', 'text'),
            ])
            ->range('.event-row')
            ->queryData();


        file_put_contents(__DIR__ . '/json/jingjibao.json', json_encode($data, JSON_UNESCAPED_UNICODE));

        doMatch();
//        echo '保存json成功';

    }
}


