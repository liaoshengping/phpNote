<?php

include_once "vendor/autoload.php";

use  FormBuilder\Factory\Elm;

$action = '/save.php';
$method = 'POST';

$input = Elm::input('goods_name', '商品名称')->required();
$textarea = Elm::textarea('goods_info', '商品简介');
$switch = Elm::switches('is_open', '是否开启')->activeText('开启')->inactiveText('关闭');
$datePicker = Elm::datePicker('field', '日期');
$color = Elm::color('color','颜色选择','red');
$rate = Elm::rate('rate', '评分');
$image = Elm::uploadImages('image_url','图片选择','/upload.php');

$checkbox = Elm::checkbox('sss', 'title');
$tree = Elm::tree('fi谁说的eld', '我是树形');
$checkbox->options(function(){
    $options = [];
    foreach(['好用', '高效'] as $k=>$v){
        $options[] = Elm::option($k, $v);
    }
    //等同于 [['value'=>0,'label'=>'好用'],['value'=>1,'label'=>'高效']]
    return $options;
});
//创建表单
$form = Elm::createForm($action)->setMethod($method);

//添加组件
$form->setRule([$input, $textarea,$color,$rate,$image,$checkbox,$tree]);

$form->append($switch);
$form->append($datePicker);

//生成表单页面
echo $formHtml = $form->view();