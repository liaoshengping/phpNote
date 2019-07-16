<?php
//$data = file_get_contents('http://detail.1688.com/offer/593777588910.html?spm=a262eq.12572798.jsczf959.1.137c2fb1QYTqvh');
include ("vendor/autoload.php");
$ql = \QL\QueryList::getInstance();
//$ql->use();




$url = 'https://detail.1688.com/offer/535867721312.html?spm=a26qs.11040298.jb30n1mb.1.2da06418zB7IYe';
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
