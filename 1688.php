<?php
//$data = file_get_contents('http://detail.1688.com/offer/593777588910.html?spm=a262eq.12572798.jsczf959.1.137c2fb1QYTqvh');
include ("vendor/autoload.php");
//$ql = \QL\QueryList::getInstance();
////$ql->use();
//\Liaosp\Express\Channel\Test::test();
//exit;



$url = 'https://detail.1688.com/offer/599153448526.html?spm=b26110380.sw1688.mof001.432.5a172888Xm4xmn';
$html = \QL\QueryList::get($url)->getHtml();
$sku = \QL\QueryList::html($html)
    // 设置采集规则
    ->rules([
//        'title'=>array('.d-title','text'),
        'name'=>array('.table-sku .name span','text'),
        'price'=>array('.table-sku .price','text'),
    ])->removeHead() ->encoding('UTF-8','GBK')
    ->queryData();
$data['sku'] = $sku;
$title = \QL\QueryList::html($html)
    // 设置采集规则
    ->rules([
        'title'=>array('.mod-detail-title .d-title','text'),
//        'content'=>array('.offerdetail_w1190_description','text')
    ])->removeHead() ->encoding('UTF-8','GBK')
    ->queryData();
$data ['title'] = $title;
$data['banner'] =  \QL\QueryList::html($html)
    // 设置采集规则
    ->rules([
        'url'=>array(' .vertical-img img','src'),
    ])->removeHead() ->encoding('UTF-8','GBK')
    ->queryData();
echo json_encode($data);
