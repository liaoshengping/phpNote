<?php

require_once "core/config.php";


const FRAME_PATH = 'D:\linuxdir\php\linxia-huichongapi/';
const WORK_NAME = 'yibage';

const TYPE_BANNER = 'banner';
const TYPE_BANNER_STAIC = 'banner_static';

const TYPE_BREADCRUMB = 'breadcrumb';
const TYPE_TITILE_ITEMS_IMAGE = 'title_items_image';
const TYPE_ITEM_IMAGES = 'item_images';
const TYPE_IMAGE_RIGHT_SECTION = 'image_right_section';
const TYPE_IMAGE_LEFT_SECTION = 'image_left_section';
const TYPE_QE_MIN = 'qr_min';  //二维码在中间上下都是文字

//高度定制化
const TYPE_DOWNLOAD = 'download';  //二维码在中间上下都是文字
const TYPE_CONTACT = 'contact';  //二维码在中间上下都是文字


return [
    "frame" => HUAFEI,
    'frame_path' => FRAME_PATH,
    'title' => '话费',
    'name' =>'杭州丰辉',
    'database' => false,
    'view_path' => 'container\functions\htmlv1\bootstrap_official\html',
    'logo' => 'https://s4.ax1x.com/2021/12/17/TF5q8U.png',
    'qrCode' => 'assets/images/erweima.jpg',




];
