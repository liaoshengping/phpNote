<?php
//$data = file_get_contents('http://detail.1688.com/offer/593777588910.html?spm=a262eq.12572798.jsczf959.1.137c2fb1QYTqvh');
include ("vendor/autoload.php");
$ql = \QL\QueryList::getInstance();
//$ql->use();




$url = 'https://detail.1688.com/offer/593520740375.html?spm=a261b.2187593.1998088710.1.40401576ReRZWk&tracelog=p4p&clickid=2cee3d4469b14b77997252b6cd152be5&sessionid=5e9215d17fbb2978cf990d6fd6185159';
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
