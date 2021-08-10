<?php
require_once("../vendor/autoload.php");


class AliOpen extends \Liaosp\AliOpen\AliOpen
{
    public function __construct($params = array())
    {
        $this->setAppkey('39376**');
        $this->setAppsecret('0RsvFZYV**');
        $this->access_token = '06410386-242c-41f6-8a20-5e7e0d2b62**';
        parent::__construct($params);
    }
}

//$get_data = (new AliOpen([     //这边的AliOpen ,是你设置appkey的对象
//    'page' => 1,
//    'pageSize' => 100,
//]))
//    ->order
//    ->setApi('com.alibaba.product:alibaba.category.get-1')
//    ->post();


$get_data = (new AliOpen([//这边的AliOpen ,是你设置appkey的对象
    'categoryID' => 0,
]))
    ->order
    ->setApi('com.alibaba.product:alibaba.category.get-1')
    ->post();
var_dump($get_data);
