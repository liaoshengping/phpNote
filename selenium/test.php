<?php

use Facebook\WebDriver\Remote\RemoteWebDriver;
include ("../vendor/autoload.php");

$serverUrl = 'http://localhost:4444';

// Chrome
$driver = RemoteWebDriver::create($serverUrl, \Facebook\WebDriver\Remote\DesiredCapabilities::chrome());


for ($day=0;$day<32;$day++){
    $date = \Carbon\Carbon::parse('2022-04-01')->addDays($day)->timestamp;
    $driver->get('https://app.diandian.com/rank/android/2-201-0-75-901977?time='.$date.'000&timetype=custom');
    for ($i = 1; $i < 60; $i++) {
        sleep(1);
        $driver->executeScript('window.scrollTo(0,document.body.scrollHeight);');
        $driver->executeScript('window.scrollTo(0,0);');
        $driver->executeScript('window.scrollTo(0,document.body.scrollHeight);');
    }
    $data =$driver->getPageSource();
    file_put_contents(__DIR__.'/4/'.$date.'.html',$data);
}



?>
