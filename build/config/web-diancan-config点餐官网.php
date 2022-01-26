<?php

require_once "core/config.php";


const FRAME_PATH = 'E:\linuxdir\web\diancan/';
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
    "frame" => HTMLV1,
    'frame_path' => FRAME_PATH,
    'title' => '点餐系统',
    'slogan' => '扫码点餐就用两粒米',
    'database' => false,
    'view_path' => 'container\functions\htmlv1\bootstrap_official\html',
    'logo' => 'https://s4.ax1x.com/2021/12/17/TF5q8U.png',
    'qrCode' => 'assets/images/erweima.jpg',


    'menus' => [
        [
            'name' => '首页',
            'href' => 'index.html',
        ],
        [
            'name' => '软件产品',
            'href' => 'scan_diancan.html',
            'sub_type' => 'one', //先实现一级的
            'sub' => [
                [
                    'name' => '扫码点餐',
                    'href' => 'scan_diancan.html',
                ],
                [
                    'name' => '智慧食堂',
                    'href' => 'zhihuishitang.html',
                ],
                [
                    'name' => '点单宝',
                    'href' => 'diandanbao.html',
                ],
            ],

        ],
        [
            'name' => '应用场景',
            'href' => '#',
            'sub_type' => 'one', //先实现一级的
            'sub' => [
                [
                    'name' => 'AI食堂团餐解决方案',
                    'href' => 'aijiesuan.html',
                ],
                [
                    'name' => '美食城解决方案',
                    'href' => 'meishicheng.html',
                ],
                [
                    'name' => '刷脸团餐解决方案',
                    'href' => 'qingwa.html',
                ],
                [
                    'name' => '无接触扫码点餐解决方案',
                    'href' => 'wujiechu.html',
                ],
            ],
        ],
        [
            'name' => '智慧硬件',
            'href' => 'yingjianbuy.html',
        ],
        [
            'name' => '下载登录',
            'href' => 'download.html',
        ],
        [
            'name' => '关于我们',
            'href' => '#',
            'sub_type' => 'one', //先实现一级的
            'sub' => [
                [
                    'name' => '公司简介',
                    'href' => 'jianjie.html',
                ],
                [
                    'name' => '公司资质',
                    'href' => 'zizhi.html',
                ],
                [
                    'name' => '联系我们',
                    'href' => 'contact.html',
                ],
            ],

        ],

    ],

    'footer_urls' => [
        [
            'name' => '产品中心',
            'url' => '#',
            'items' => [
                [
                    'name' => '增值服务',
                    'url' => '#',
                ],
                [
                    'name' => '硬件设备',
                    'url' => '#',
                ],
                [
                    'name' => '收费套餐',
                    'url' => '#',
                ]
            ],
        ],
        [
            'name' => '文章资讯',
            'url' => '#',
            'items' => [
                [
                    'name' => '品牌动态',
                    'url' => '#',
                ],
                [
                    'name' => '专业知识',
                    'url' => '#',
                ],
                [
                    'name' => '行业焦点',
                    'url' => '#',
                ],
                [
                    'name' => '使用教程',
                    'url' => '#',
                ]
            ],
        ],
        [
            'name' => '关于我们',
            'url' => '#',
            'items' => [
                [
                    'name' => '企业简介',
                    'url' => '#',
                ],
                [
                    'name' => '品牌故事',
                    'url' => '#',
                ],
                [
                    'name' => '品牌文化',
                    'url' => '#',
                ],
                [
                    'name' => '企业文化',
                    'url' => '#',
                ],
                [
                    'name' => '未来&愿景',
                    'url' => '#',
                ]
            ],
        ],
        [
            'name' => '联系我们',
            'url' => '#',
            'items' => [
                [
                    'name' => '联系方式',
                    'url' => '#',
                ],
                [
                    'name' => '在线留言',
                    'url' => '#',
                ],
            ],
        ]
    ],


    /**
     * 生成html文件
     */
    'html_files' => [
        [
            'file_name' => 'index.html',
            'layout' => 'header_footer',//头部加脚页
            'content' => [

                [
                    'type' => TYPE_BANNER,
                    'items' => [
                        [
                            'title' => '两粒米，让点餐更简单',
                            'title_top' => '餐饮用户都在用的点餐软件',
                            'title_right_image' => 'assets/images/diancan/home_title_right_image.png',
                            'title_sub' => '收银点餐，聚合支付，会员营销，连锁管理，数据分析',
                            'image_url' => 'assets/images/slider/homebg.jpg',
                            'href' => [
                                'name' => '免费试用',
                                'url' => '#'
                            ]
                        ]
                    ],

                ],
                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                    'image_url' => 'assets/images/diancan/home-2.png',
                    'title' => '高效管理餐饮店',
                    'big_title' => '餐饮店都在用的点餐系统',
                    'title_sub' => '',
                    'text' => '两粒米是一款针对于中小餐饮商户开发的，简单好用且功能强大的系统，基于微信
和支付宝小程序、APP、WEB后台，它能帮助商家实现收银点餐、外卖接单、聚合
支付、会员管理、数据分析，也可以帮助商家实现拉新留存、智慧营销！<br><a href="##"><button style="margin-top: 10px; padding: 5px; width: 150px;background-color: #fbd922;border: white 0px solid">点击了解</button></a>',
                ],
                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                    'image_url' => 'assets/images/diancan/home-3.png',
                    'title' => '外卖平台无缝对接',
                    'big_title' => '让餐饮店生意更简单',
                    'bg_color' => '',
                    'title_sub' => '',
                    'text' => '系统无缝对接美团、饿了么等平台，一台打印机就能够管理及分配所有外卖订单，并
且无缝对接厨打系统，再无需抱着手机前台后厨来回跑。<br><br>两粒米为您打造更完善的数字化餐厅。<br><a href="##"><button style="margin-top: 10px; padding: 5px; width: 150px;background-color: #fbd922;border: white 0px solid">点击了解</button></a>>',
                ],
                [
                    'type' => TYPE_IMAGE_RIGHT_SECTION,
                    'image_url' => 'assets/images/diancan/home-4.png',
                    'title' => '点餐页面多样化 适应多种场景',
                    'big_title' => '',
                    'title_sub' => '',
                    'text' => '微餐厅内设多样化的点餐页面，为不同业态、不同营销方式提供多样的选择。


适用于：中餐厅、西餐厅、日韩料理、酒吧、咖啡简餐、火锅店、快餐店、小吃烧
烤、甜品店等业态的扫码点餐。<br><br>两粒米为您打造更完善的数字化餐厅。<br><a href="##"><button style="margin-top: 10px; padding: 5px; width: 150px;background-color: #fbd922;border: white 0px solid">点击了解</button></a>',
                ],
                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                    'image_url' => 'assets/images/diancan/home/5/图.png',
                    'title' => '支持微信和支付宝小程序',
//                    'big_title'=>'让餐饮店生意更简单',
                    'bg_color' => '',
                    'title_sub' => '',
                    'text' => '两粒米小程序“自助点餐”功能，顾客只需扫描桌面二维码、或者打开小程序，即
可点餐，从支付宝到微信无缝对接，支持多种支付方式微信、支付宝、信用卡、花
呗、会员卡等。

每日收益数据打开两粒米手机版就能全部了解，不再错过每一笔账单，收益清晰让
心里更有 “数”。<br><a href="##"><button style="margin-top: 10px; padding: 5px; width: 150px;background-color: #fbd922;border: white 0px solid">点击了解</button></a>',
                ],
                [
                    'type' => TYPE_IMAGE_RIGHT_SECTION,
                    'image_url' => 'assets/images/diancan/home/6/图.png',
                    'title' => '自建会员体系 留住每位顾客',
                    'big_title' => '',
                    'title_sub' => '',
                    'text' => '把握到店流量，支持会员管理，官方商家券、官方立减补贴活动，刺激二次消费让
新顾客变老顾客。

店铺、商品、商品属性、套餐自由设置，营销活动丰富多样，客户信息便捷管理，
全面强大的报表统计功能。<br><a href="##"><button style="margin-top: 10px; padding: 5px; width: 150px;background-color: #fbd922;border: white 0px solid">点击了解</button></a>',
                ],
                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                    'image_url' => 'assets/images/diancan/home/7/图.png',
                    'title' => '告别人为错单漏单',
//                    'big_title'=>'让餐饮店生意更简单',
                    'bg_color' => '',
                    'title_sub' => '',
                    'text' => '多平台便捷管理，提供更省心的自动接单管理

用户下单及前台的点餐数据实时同步到后厨小票打印机，后厨根据不同的桌号即可
分别备餐，全程自动化，再不会出现因掉单、漏单等影响餐厅口碑的问题。<br><a href="##"><button style="margin-top: 10px; padding: 5px; width: 150px;background-color: #fbd922;border: white 0px solid">点击了解</button></a>',
                ],
                [
                    'type' => TYPE_IMAGE_RIGHT_SECTION,
                    'image_url' => 'assets/images/diancan/home/8/图.png',
                    'title' => '搭建零抽佣的聚合配送',
                    'big_title' => '',
                    'title_sub' => '',
                    'text' => '聚合配送支持达达，顺丰，跑腿，美团，蜂鸟等多家平台。


摆脱外卖平台，第三方平台骑手为您服务，商家支持自配送和聚合配送组合使用，
提升操作效率，无需平台抽佣！<br><a href="##"><button style="margin-top: 10px; padding: 5px; width: 150px;background-color: #fbd922;border: white 0px solid">点击了解</button></a>',
                ],
                [
                    'type' => TYPE_QE_MIN,
                    'image_url' => 'assets/images/diancan/home/9/二维码.jpg',
                    'bg_image_url' => 'assets/images/diancan/home/9/背景.jpg',
                    'title' => '关注两粒米
<br>
让点餐更简单',
                    'title_sub' => '<div style="margin-top: 20px">如何维护好客户，让客户依赖您的小程序</div>'
                ],
                [
                    'type' => TYPE_TITILE_ITEMS_IMAGE,
                    'title' => '支持多个行业',
                    'title_sub' => '丰富的功能，灵活的设计，让我们可以支持多个不同的行业提供更合适您的解决方案',
                    'bg_color' => 'bg-gary',
                    'row' => 2,
                    'items' => [
                        [

                            'image_url' => 'assets/images/diancan/home/10/1.jpg',
                            'image_center_icon' => 'assets/images/diancan/home/10/图标1.png',
                            'center_text' => '快餐店',
                            'image_width' => '250px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/home/10/2.jpg',
                            'image_center_icon' => 'assets/images/diancan/home/10/图标2.png',
                            'center_text' => '烘焙店',
                            'image_width' => '250px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/home/10/3.jpg',
                            'image_center_icon' => 'assets/images/diancan/home/10/图标3.png',
                            'center_text' => '奶茶店',
                            'image_width' => '250px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/home/10/4.jpg',
                            'image_center_icon' => 'assets/images/diancan/home/10/图标4.png',
                            'center_text' => '奶茶店',
                            'image_width' => '250px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/home/10/5.jpg',
                            'image_center_icon' => 'assets/images/diancan/home/10/图标5.png',
                            'center_text' => '奶茶店',
                            'image_width' => '250px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/home/10/6.jpg',
                            'image_center_icon' => 'assets/images/diancan/home/10/图标6.png',
                            'center_text' => '奶茶店',
                            'image_width' => '250px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/home/10/7.jpg',
                            'image_center_icon' => 'assets/images/diancan/home/10/图标7.png',
                            'center_text' => '奶茶店',
                            'image_width' => '250px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/home/10/8.jpg',
                            'image_center_icon' => 'assets/images/diancan/home/10/图标8.png',
                            'center_text' => '奶茶店',
                            'image_width' => '250px'
                        ],


                    ]
                ],
                [
                    'type' => TYPE_TITILE_ITEMS_IMAGE,
                    'title' => '他们都选择了两粒米',
                    'title_sub' => '打造优质店铺，多数商家的选择',

                    'row' => 2,
                    'items' => [
                        [
                            'image_url' => 'assets/images/diancan/home/11/半天妖.jpg',
                            'image_width' => '150px'
                        ],
                        [
                            'image_url' => 'assets/images/diancan/home/11/摩吉奶茶.jpg',
                            'image_width' => '150px'
                        ],
                        [
                            'image_url' => 'assets/images/diancan/home/11/如意馄饨.jpg',
                            'image_width' => '150px'
                        ],
                        [
                            'image_url' => 'assets/images/diancan/home/11/刘一手火锅.jpg',
                            'image_width' => '150px'
                        ],
                        [
                            'image_url' => 'assets/images/diancan/home/11/叫了个炸鸡.jpg',
                            'image_width' => '150px'
                        ],
                        [
                            'image_url' => 'assets/images/diancan/home/11/皇茶.jpg',
                            'image_width' => '150px'
                        ],
                        [
                            'image_url' => 'assets/images/diancan/home/11/觅茶.jpg',
                            'image_width' => '150px'
                        ],
                        [
                            'image_url' => 'assets/images/diancan/home/11/至尊比萨.jpg',
                            'image_width' => '150px'
                        ],
                        [
                            'image_url' => 'assets/images/diancan/home/11/艾肯莱.jpg',
                            'image_width' => '150px'
                        ],
                        [
                            'image_url' => 'assets/images/diancan/home/11/香缘麻辣香锅.jpg',
                            'image_width' => '150px'
                        ],
                        [
                            'image_url' => 'assets/images/diancan/home/11/壹家烘焙.jpg',
                            'image_width' => '150px'
                        ],
                        [
                            'image_url' => 'assets/images/diancan/home/11/黄海森林公园.jpg',
                            'image_width' => '150px'
                        ],


                    ]
                ],
                [
                    'type' => TYPE_QE_MIN,
                    'bg_image_url' => 'assets/images/diancan/home/12/bg.jpg',
                    'title' => '',
                    'title_sub' => '<div style="height: 400px"></div>'
                ],
                [
                    'type' => TYPE_QE_MIN,
                    'bg_image_url' => 'assets/images/diancan/home/13/背景.jpg',
                    'title' => '<div style="color: white;font-size: 60px">新餐饮时代，我们携手同行，合作共赢！</div>',
                    'title_sub' => '<div style="color: white;font-size: 30px;height: 300px;display: flex;justify-content: center; align-items:center;flex-direction: column">
<div>专注于中小餐饮门店服务</div>
            <a href="##"><div style="margin-top: 10px; background-color: yellow;padding: 20px; color: #0d0a0a;border-radius: 10px;">申请合作</div></a>
</div>'
                ]
            ],
        ],
        //扫码点餐
        [
            'file_name' => 'scan_diancan.html', //扫码点餐小程序
            'layout' => 'header_footer',//头部加脚页
            'content' => [

                [
                    'type' => TYPE_BANNER,
                    'items' => [
                        [
                            'title' => '两粒米，让点餐更简单',
                            'title_top' => '餐饮店的点餐小程序',
                            'title_right_image' => 'assets/images/diancan/scan_diancan/1/png.png',
                            'title_sub' => '低成本拓客·自动客流·高效接单·稳定维护',
                            'image_url' => 'assets/images/diancan/scan_diancan/1/背景.jpg',
                            'href' => [
                                'name' => '扫码体验',
                                'url' => '#'
                            ]
                        ]
                    ],
                ],
                [
                    'type' => TYPE_TITILE_ITEMS_IMAGE,
                    'title' => '为什么要用两粒米小程序？',
                    'title_sub' => '解决餐饮店推广4大痛点',
                    'items' => [
                        [
                            'title' => '突出门店知名度',
                            'title_sub' => '<h6 style="color: gray">位置偏僻，客流量低</h6>',
                            'image_url' => 'assets/images/diancan/scan_diancan/2/1.png',
                        ],
                        [
                            'title' => '提高客户回头率',
                            'title_sub' => '<h6 style="color: gray">可对接多个外卖平台</h6>',
                            'image_url' => 'assets/images/diancan/scan_diancan/2/2.png',
                        ],
                        [
                            'title' => '解决排队等候问题',
                            'title_sub' => '<h6 style="color: gray" >扫码自动出单，点餐效率高</h6>',
                            'image_url' => 'assets/images/diancan/scan_diancan/2/3.png',
                        ],
                        [
                            'title' => '提高客户满意度',
                            'title_sub' => '<h6 style="color: gray" >支持在线下单、结算</h6>',
                            'image_url' => 'assets/images/diancan/scan_diancan/2/4.png',
                        ],
//                        [
//                            'title' => '翻桌率',
//                            'title_sub' => '<h6 class="text-red">提升30%</h6>',
//                            'image_url' => 'https://s4.ax1x.com/2021/12/24/TYivYn.png',
//                        ],


                    ]
                ],
                [
                    'type' => TYPE_IMAGE_RIGHT_SECTION,
                    'image_url' => 'assets/images/diancan/scan_diancan/3/1.png',
                    'title' => '快捷点餐，操作方便',
                    'big_title' => '',
                    'bg_color' => 'bg-white',
                    'title_sub' => '',
                    'text' => '上手简单，无复杂操作即可管理自己的店铺，<br>
堂食点餐，扫码点餐，零售商场，外卖配送，
样样俱全',
                ],
                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                    'image_url' => 'assets/images/diancan/scan_diancan/4/1.png',
                    'title' => '智能计算起送价/配送费',
//                    'big_title'=>'让餐饮店生意更简单',

                    'title_sub' => '',
                    'text' => '可以按不同的时间，不同的距离设置不同起送价和配送费，
系统根据不同的时间，不同的距离智能计算出各人订单的
起送价和配送费，非常强大！',
                ],
                [
                    'type' => TYPE_IMAGE_RIGHT_SECTION,
                    'image_url' => 'assets/images/diancan/scan_diancan/5/1.png',
                    'title' => '低投入成本，超高性价比',
                    'big_title' => '',
                    'bg_color' => 'bg-white',
                    'title_sub' => '',
                    'text' => '低门槛制作小程序，平台0佣金
适用大多客户不同需求！',
                ],
                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                    'image_url' => 'assets/images/diancan/scan_diancan/6/1.png',
                    'title' => '自动识别桌台，实时打印订单',
//                    'big_title'=>'让餐饮店生意更简单',

                    'title_sub' => '',
                    'text' => '扫码、点单、提交，一气呵成。扫码自动识别桌台号，
系统实时打印用户提交的订单，所在桌台号',
                ],
                [
                    'type' => TYPE_IMAGE_RIGHT_SECTION,
                    'image_url' => 'assets/images/diancan/scan_diancan/7/1.png',
                    'title' => '强大的会员储值',
                    'big_title' => '',
                    'bg_color' => 'bg-white',
                    'title_sub' => '',
                    'text' => '会员储值优惠多多。在线充值，充值越多赠送越多
会员余额支付快捷方便！提高客户忠诚度，加速资
金回笼，这不单单是储值，而是拥有整个会员体系
支撑',
                ],
                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                    'image_url' => 'assets/images/diancan/scan_diancan/8/透明.png',
                    'title' => '为餐饮店提供支付场景营销服务',
//                    'big_title'=>'让餐饮店生意更简单',
                    'bg-color' => '',
                    'title_sub' => '',
                    'text' => '<img src="assets/images/diancan/scan_diancan/8/1.jpg">',
                ],
            ],
        ],
//        2-2智慧食堂
        [
            'file_name' => 'zhihuishitang.html', //智慧食堂
            'layout' => 'header_footer',//头部加脚页
            'content' => [

                [
                    'type' => TYPE_BANNER,
                    'items' => [
                        [
                            'title' => '两粒米智慧食堂',
                            'title_top' => '无需联网布线的云消费机系统',
                            'title_right_image' => 'assets/images/diancan/zhihuishitang/1/透明.png',
                            'title_sub' => '安全、高效、智能的就餐体验，就用两粒米智慧食堂系统',
                            'image_url' => 'assets/images/diancan/scan_diancan/1/背景.jpg',
                            'href' => [
                                'name' => '扫码体验',
                                'url' => '#'
                            ]
                        ],
                    ],
                ],
                [
                    'type' => TYPE_BREADCRUMB,
                    'text' => '首页>产品介绍>两粒米点餐宝'
                ],
                [
                    'type' => TYPE_ITEM_IMAGES,
                    'bg_color' => 'bg-white',
                    'title' => '智慧食堂VS传统食堂',
                    'title_sub' => '全新就餐体验，尽在两粒米智慧食堂！',
                    'items' => [
                        [
                            'image_url' => 'assets/images/diancan/zhihuishitang/2/1.jpg',
                        ]
                    ]
                ],
                [
                    'type' => TYPE_QE_MIN,
                    'bg_image_url' => 'assets/images/diancan/zhihuishitang/3/youshi.jpg',
                    'title' => '',
                    'title_sub' => '<div style="height: 400px"></div>'
                ],
                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                    'image_url' => 'assets/images/diancan/zhihuishitang/4/透明.png',
                    'big_title' => '开启智慧食堂新时代',
//                    'title' => '智能计算起送价/配送费',
//                    'big_title'=>'让餐饮店生意更简单',
                    'bg_style' => 'background-color:#f2f3f5;',
                    'title_sub' => '',
                    'text' => '<img src="assets/images/diancan/zhihuishitang/4/1.jpg">',
                ],
                [
                    'type' => TYPE_ITEM_IMAGES,
                    'bg_color' => 'bg-white',
                    'title' => '两粒米智慧食堂场景',
                    'title_sub' => '为商户提供全方位效率提升方案，节约运营成本。',
                    'items' => [
                        [
                            'image_url' => 'assets/images/diancan/zhihuishitang/5/图.jpg',
                        ]
                    ]
                ],
                [
                    'type' => TYPE_TITILE_ITEMS_IMAGE,
                    'title' => '支持多场景运营模式',
                    'title_sub' => '智慧科技引领时代发展，享受生活便捷',
//                    'bg_color' => 'bg-gary',
                    'row' => 1,
                    'items' => [
                        [

                            'image_url' => 'assets/images/diancan/zhihuishitang/6/1.jpg',
//                            'image_center_icon' => 'assets/images/diancan/home/10/图标1.png',
                            'title' => '档口就餐场景',
                            'title_sub' => '人脸结算 可视化点餐 
点餐打餐 同步进行  ',
                            'image_width' => '350px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/zhihuishitang/6/2.jpg',
//                            'image_center_icon' => 'assets/images/diancan/home/10/图标1.png',
                            'title' => '自助餐场景',
                            'title_sub' => '无人值守 计次消费
  规则多样 刷脸结算 ',
                            'image_width' => '350px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/zhihuishitang/6/3.jpg',
//                            'image_center_icon' => 'assets/images/diancan/home/10/图标1.png',
                            'title' => '自选餐场景',
                            'title_sub' => '定价核算 精准计量
营养分析 订单可溯',
                            'image_width' => '350px'
                        ],


                        [

                            'image_url' => 'assets/images/diancan/zhihuishitang/6/4.jpg',
//                            'image_center_icon' => 'assets/images/diancan/home/10/图标1.png',
                            'title' => '预定餐场景',
                            'title_sub' => '多终端订餐 提前预订
精准备餐 员工互动 ',
                            'image_width' => '350px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/zhihuishitang/6/5.jpg',
//                            'image_center_icon' => 'assets/images/diancan/home/10/图标1.png',
                            'title' => '智能取餐场景',
                            'title_sub' => '智能保温柜 餐车送餐
外卖派送 大屏叫号',
                            'image_width' => '350px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/zhihuishitang/6/6.jpg',
//                            'image_center_icon' => 'assets/images/diancan/home/10/图标1.png',
                            'title' => '特色就餐场景',
                            'title_sub' => '招待餐 访客餐
 包间餐 班组餐',
                            'image_width' => '350px'
                        ],


                    ]
                ],
                [
                    'type' => TYPE_TITILE_ITEMS_IMAGE,
                    'title' => '两粒米相关资质证书',
//                    'title_sub' => '智慧科技引领时代发展，享受生活便捷',
                    'bg_color' => 'bg-white',
                    'row' => 1,
                    'items' => [
                        [
                            'image_url' => 'assets/images/diancan/zhihuishitang/7/1.png',
//                            'image_center_icon' => 'assets/images/diancan/home/10/图标1.png',
                            'image_width' => '350px'
                        ],
                        [
                            'image_url' => 'assets/images/diancan/zhihuishitang/7/2.png',
//                            'image_center_icon' => 'assets/images/diancan/home/10/图标1.png',
                            'image_width' => '350px'
                        ],
                        [
                            'image_url' => 'assets/images/diancan/zhihuishitang/7/3.png',
//                            'image_center_icon' => 'assets/images/diancan/home/10/图标1.png',
                            'image_width' => '350px'
                        ],


                    ]
                ],


            ],
        ],
//        2-3点单宝
        [

            'file_name' => 'diandanbao.html', //
            'layout' => 'header_footer',//头部加脚页
            'content' => [
                [
                    'type' => TYPE_BANNER_STAIC,
                    'image_left' => 'assets/images/diancan/diandanbao/1/png.png',
                    'image_right' => 'assets/images/diancan/diandanbao/1/png1.png',
                    'bg_image_url' => 'assets/images/diancan/diandanbao/1/背景.jpg',
                ],
                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                    'image_url' => 'assets/images/diancan/diandanbao/2/透明.png',
                    'title' => '安全、高效、便捷的移动支付工具',
                    'big_title' => '<div style="text-align: center;">
<div>点单宝</div>
    
<div><h4>让餐饮店的收银管理更简单</h4></div>
</div>',
// 'big_title'=>'让餐饮店生意更简单',

                    'title_sub' => '',
                    'bg_color' => 'bg-white',
                    'text' => '两粒米点单宝是仝心科技倾力打造的安全、高效、便捷的移动支付工具，
集成了微信、支付宝、花呗、信用卡等多种支付方式。
实现更低费率，更安全的移动支付工具。',
                ],
                [
                    'type' => TYPE_IMAGE_RIGHT_SECTION,
                    'image_url' => 'assets/images/diancan/diandanbao/3/透明.png',
                    'title' => '<img src="assets/images/diancan/diandanbao/3/1.jpg">',
                    'big_title' => '<div style="text-align: center;">
<div>点单宝</div>
    
<div><h4>让餐饮店的收银管理更简单</h4></div>
</div>',
                    'bg_style' => 'background-color:#f2f3f5;'
// 'big_title'=>'让餐饮店生意更简单',

//                    'title_sub' => '',
//                    'text' => '两粒米点单宝是仝心科技倾力打造的安全、高效、便捷的移动支付工具，
//集成了微信、支付宝、花呗、信用卡等多种支付方式。
//实现更低费率，更安全的移动支付工具。',
                ],
                [
                    'type' => TYPE_ITEM_IMAGES,
                    'bg_color' => 'bg-white',
                    'title' => '点单宝全方位效率提升方案',
                    'title_sub' => '为商户提供全方位效率提升方案，节约运营成本。',
                    'items' => [
                        [
                            'image_url' => 'assets/images/diancan/diandanbao/4/1.jpg',
                        ]
                    ]
                ],
                [
                    'type' => TYPE_ITEM_IMAGES,
//                    'bg_color' => 'bg-white',
                    'bg_style' => 'background-color:#f2f3f5',
                    'title' => '服务员代点餐方式',
                    'title_sub' => '服务员用点单宝APP代点餐，选择菜品与付款方式，
为顾客提供快速、便捷的点单服务，实现顾客与服务员之间的交流互动',
                    'items' => [
                        [
                            'image_url' => 'assets/images/diancan/diandanbao/5/1.jpg',
                        ]
                    ]
                ],
                [
                    'type' => TYPE_QE_MIN,
                    'bg_image_url' => 'assets/images/diancan/diandanbao/6/背景.jpg',
                    'title' => '<div style="color: white;font-size: 30px">免费申请开通点单宝</div>',
                    'title_sub' => '<div style="color: white;font-size: 20px;height: 300px;display: flex;justify-content: center; align-items:center;flex-direction: column">
<div>如果您想了解更多或者开通点单宝，欢迎咨询客服进行对接</div>
            <a href="##"><div style="margin-top: 10px; background-color: yellow;padding: 20px; color: #0d0a0a;border-radius: 10px;">申请开通</div></a>
</div>'
                ]


            ],
        ],
//       3-1 Ai 结算
        [

            'file_name' => 'aijiesuan.html', //
            'layout' => 'header_footer',//头部加脚页
            'content' => [
                [
                    'type' => TYPE_ITEM_IMAGES,
                    'bg_color' => '',
                    'bg_style' => 'background-color:#f2f3f5',
                    'title' => '两粒米AI智能结算系统',
                    'title_sub' => '三方共赢 收银快、准、省',
                    'items' => [
                        [
                            'image_url' => 'assets/images/diancan/fangan1/1/11.jpg',
                        ]
                    ]
                ],
                [
                    'type' => TYPE_TITILE_ITEMS_IMAGE,
                    'title' => '全流程自助 不止速度',
                    'title_sub' => '用户自选用餐，AI图像识别结算仅需0.3S，数据上云，支持用餐营养分析和运营管理分析',
//                    'bg_color' => 'bg-gary',
                    'bg_color'=>'bg-white',
                    'row' => 1,
                    'items' => [
                        [

                            'image_url' => 'assets/images/diancan/fangan1/2/1.png',
                            'center_text' => '快餐店',
                            'image_width' => '350px',
                            'title'=>'选餐',
                            'title_sub'=>'用餐者再窗口选餐<br>
                            放置在托盘上',
                        ],
                        [

                            'image_url' => 'assets/images/diancan/fangan1/2/2.png',
                            'center_text' => '烘焙店',
                            'image_width' => '350px',
                                 'title'=>'识别',
                            'title_sub'=>'将托盘放置到识别区<br>
                            系统自动识别菜品',
                        ],
                        [

                            'image_url' => 'assets/images/diancan/fangan1/2/3.png',
                            'center_text' => '奶茶店',
                            'image_width' => '350px',
                            'title'=>'支付',
                            'title_sub'=>'确认菜品无误后<br>
                            使用卡/二维码/人脸识别',
                        ],



                    ]
                ],
                [
                    'type' => TYPE_IMAGE_RIGHT_SECTION,
                    'image_url' =>  'assets/images/diancan/fangan1/3/透明.png',
                    'title' => '快速识别 极速运算',
//                    'bg_color'=>'bg-white',
// 'big_title'=>'让餐饮店生意更简单',
                    'big_title' => '<div style="text-align: center;">
<div>广阔的市场发展前景</div>
    
<div><h4>智能科技引领时代发展，享受生活便捷</h4></div>
</div>',
                    'title_sub' => '',
                    'text' => '采用阿里口碑算法，识别成功率高达99%，识别
图像仅需80ms（0.08秒），从识别至支付完成，
最快2秒完成1单。',
                ],
                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                    'image_url' =>  'assets/images/diancan/fangan1/4/透明.png',
                    'title' => '并单结算、优惠活动',
                    'bg_color'=>'bg-white',
                    'title_sub' => '',
                    'text' => '支持多个订单合并支付，同时增设附加费和优惠，
实现促销活动。',
                ],

                [
                    'type' => TYPE_IMAGE_RIGHT_SECTION,
                    'image_url' =>  'assets/images/diancan/fangan1/5/透明.png',
                    'title' => '菜品轻松录入',
//                    'bg_color'=>'bg-white',
                    'title_sub' => '',
                    'text' => '轻松拍照三张录入新菜品。先本地存储，再同
步云端服务器，确保多店同步数据',
                ],
                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                    'image_url' => 'assets/images/diancan/fangan1/6/透明.png',
                    'title' => '批量管理菜品',
                    'bg_color'=>'bg-white',
                    'title_sub' => '',
                    'text' => '批量导入菜品名称及价格，在终端上传图片、编
辑，菜品数据同步总部云平台。',
                ],
                [
                    'type' => TYPE_IMAGE_RIGHT_SECTION,
                    'image_url' =>  'assets/images/diancan/fangan1/7/透明.png',
                    'title' => '结算界面一目了然',
//                    'bg_color'=>'bg-white',
                    'title_sub' => '',
                    'text' => '操作简单、支持扫码、IC卡、刷脸等多种支付
方式，任您选择',
                ],
                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                    'image_url' => 'assets/images/diancan/fangan1/8/透明.png',
                    'title' => '数据分析',
                    'bg_color'=>'bg-white',
                    'title_sub' => '',
                    'text' => '商品销售订单/数量查询，轻松管理销售爆品，
一键分析统计业绩利润',
                ],
                [
                    'type' => TYPE_TITILE_ITEMS_IMAGE,
                    'title' => '两粒米AI智慧食堂使用场景',
                    'title_sub' => '更多应用场景...',
//                    'bg_color' => 'bg-white',
                    'row' => 2,
                    'items' => [
                        [

                            'image_url' => 'assets/images/diancan/fangan1/9/1.png',
                            'title' => '面包店',
                            'image_width' => '250px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/fangan1/9/2.png',
                            'title' => '食堂',
                            'image_width' => '250px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/fangan1/9/3.png',
                            'title' => '快餐店',
                            'image_width' => '250px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/fangan1/9/4.png',
                            'title' => '面店',
                            'image_width' => '250px'
                        ]

                    ]
                ],



            ]
        ],
//        3-2  美食城
        [
            'file_name' => 'meishicheng.html', //
            'layout' => 'header_footer',//头部加脚页
            'content' => [
                [
                    'type' => TYPE_ITEM_IMAGES,
                    'bg_color' => '',
                    'bg_style' => 'background-color:#f2f3f5',
                    'title' => '两粒米便携食堂消费机',
                    'title_sub' => '一款集扫码、刷卡支付于一体的无线POS终端
食堂专用产品支持补贴累计清零模式，消费补贴充值一体，支持消费外接小票打印功能',
                    'items' => [
                        [
                            'image_url' => 'assets/images/diancan/fangan2/1/11.jpg',
                        ]
                    ]
                ],
                [
                    'type' => TYPE_IMAGE_RIGHT_SECTION,
                    'image_url' =>  'assets/images/diancan/fangan2/2/透明.png',
                    'title' => '支付方式多样化',
                    'bg_color'=>'bg-white',
// 'big_title'=>'让餐饮店生意更简单',
                    'big_title' => '<div style="text-align: center;">
<div>小能手 收款大轻松</div>
    
<div><h4>满足主流支付场景的聚合支付终端</h4></div>
</div>',
                    'title_sub' => '',
                    'text' => '支持单位一卡通定制接入、微信、支付宝、
信用卡等多种方式',
                ],
                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                    'image_url' =>  'assets/images/diancan/fangan2/3/透明.png',
                    'title' => '智能语音播报',
//                    'bg_color'=>'bg-white',
                    'title_sub' => '',
                    'text' => '通过真人语音实时播报，第一时间了解消费数据，防止错单漏单，
实现促销活动。',
                ],

                [
                    'type' => TYPE_IMAGE_RIGHT_SECTION,
                    'image_url' =>  'assets/images/diancan/fangan2/4/透明.png',
                    'title' => 'WiFi+4G联网方式',
                    'bg_color'=>'bg-white',
                    'title_sub' => '',
                    'text' => '支持网络自由切换，随时随地都可以联网
收银',
                ],

                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                    'image_url' =>  'assets/images/diancan/fangan2/5/透明.png',
                    'title' => '多元化报表统计',
//                    'bg_color'=>'bg-white',
                    'title_sub' => '',
                    'text' => '消费明细、消费汇总、餐别明细等实时
上传 无需单独下载 ',
                ],

                [
                    'type' => TYPE_IMAGE_RIGHT_SECTION,
                    'image_url' =>  'assets/images/diancan/fangan2/6/透明.png',
                    'title' => '停电可刷卡',
                    'bg_color'=>'bg-white',
                    'title_sub' => '',
                    'text' => '内置备用可充电锂电池，停电后仍可刷卡, 方便高效',
                ],
                [
                    'type' => TYPE_TITILE_ITEMS_IMAGE,
                    'title' => '适用于各种食堂刷卡需求',
                    'title_sub' => '学校/工厂/企业/工地食堂均适用',
//                    'bg_color' => 'bg-gary',
                    'row' => 12,
                    'items' => [
                        [

                            'image_url' => 'assets/images/diancan/fangan2/7/1.png',
                            'title' => '快餐店',
                            'image_width' => '250px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/fangan2/7/2.png',
                            'title' => '烘焙店',
                            'image_width' => '250px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/fangan2/7/3.png',
                            'title' => '奶茶店',
                            'image_width' => '250px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/fangan2/7/4.png',
                            'title' => '奶茶店',
                            'image_width' => '250px'
                        ],



                    ]
                ],
                [
                    'type' => TYPE_ITEM_IMAGES,
                    'bg_color' => 'bg-white',
//                    'bg_style' => 'background-color:#f2f3f5',
                    'title' => '云端操作使用',
                    'title_sub' => '简单操作 仅需两步',
                    'items' => [
                        [
                            'image_url' => 'assets/images/diancan/fangan2/8/图.jpg',
                        ]
                    ]
                ],



            ]
        ],

//        3-3 青蛙
        [
            'file_name' => 'qingwa.html', //
            'layout' => 'header_footer',//头部加脚页
            'content' => [
                [
                    'type' => TYPE_QE_MIN,
                    'title'=>'<div style="height: 600px"></div>',
                    'bg_image_url' => 'assets/images/diancan/fangan3/1/1.jpg',
                ],
                [
                    'type' => TYPE_ITEM_IMAGES,
//                    'bg_color' => 'bg-white',
                    'bg_style' => 'background-color:#f2f3f5',
                    'title' => '我们的优势',
//                    'title_sub' => '简单操作 仅需两步',
                    'items' => [
                        [
                            'image_url' => 'assets/images/diancan/fangan3/2/11.jpg',
                        ]
                    ]
                ],

                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                    'image_url' =>  'assets/images/diancan/fangan3/3/透明.png',
                    'title' => '快速刷脸',
                    'bg_color'=>'bg-white',
// 'big_title'=>'让餐饮店生意更简单',
                    'big_title' => '<div style="text-align: center;">
<div>微信刷脸支付，新一代收银神器</div>
    
<div><h4>支付更快捷方便，营销功能更齐全</h4></div>
</div>',
                    'title_sub' => '',
                    'text' => '3D结构光摄像头，刷脸速度更快，支付更安全',
                ],


                [
                    'type' => TYPE_IMAGE_RIGHT_SECTION,
                    'image_url' =>  'assets/images/diancan/fangan3/4/透明.png',
                    'title' => '一体双屏',
//                    'bg_color'=>'bg-white',
                    'title_sub' => '',
                    'text' => '前屏刷脸支付，后屏可实时感知前屏状态，更加方
便地引导顾客操作',
                ],

                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                    'image_url' =>  'assets/images/diancan/fangan3/5/透明.png',
                    'title' => '优惠看得见',
                    'bg_color'=>'bg-white',
                    'title_sub' => '',
                    'text' => '青蛙+会员：刷脸付款享优惠',
                ],

                [
                    'type' => TYPE_IMAGE_RIGHT_SECTION,
                    'image_url' =>  'assets/images/diancan/fangan3/6/透明.png',
                    'title' => '互动海报',
//                    'bg_color'=>'bg-white',
                    'title_sub' => '',
                    'text' => '进阶互动海报投送，收银员可通过后屏向顾客投送
互动物料；包括图片，视频，小程序以及H5等',
                ],

                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                    'image_url' =>  'assets/images/diancan/fangan3/7/透明.png',
                    'title' => '微信生态',
                    'bg_color'=>'bg-white',
                    'title_sub' => '',
                    'text' => '支持在微信青蛙Pro上运行所有微信小程序；刷
脸支付支持展示微信卡包相关信息，并提供非会
员注册入口及“开卡有礼”功能。',
                ],


            ]
        ],

//        3-4 方案无接触
        [
            'file_name' => 'wujiechu.html', //
            'layout' => 'header_footer',//头部加脚页
            'content' => [
                [
                    'type' => TYPE_ITEM_IMAGES,
//                    'bg_color' => 'bg-white',
                    'bg_style' => 'background-color:#f2f3f5',
                    'title' => '两粒米无接触式智慧食堂',
                    'title_sub' => '在食堂大厅摆放智能餐柜，食堂各档口可将用户预订好的餐品提前摆放到智能餐柜中
（智能餐柜有保温功能），用户在就餐时可直接在智能餐柜通过手机订餐二维码进行取餐，
省去了在档口的拥挤，提升了用户就餐体验，同时大大的增加了食堂各档口就餐时间内的服务能力，
为食堂带来更多的收入。',
                    'items' => [
                        [
                            'image_url' => 'assets/images/diancan/fangan4/1/1.jpg',
                        ]
                    ]
                ],
                [
                    'type' => TYPE_IMAGE_RIGHT_SECTION,
                    'image_url' =>  'assets/images/diancan/fangan4/2/透明.png',
                    'title' => '无接触式配送',
                    'big_title' => '<div style="text-align: center;">
<div>广阔的市场发展前景</div>
    
<div><h4>智能科技引领时代发展，享受生活便捷</h4></div>
</div>',
                    'bg_color'=>'bg-white',
                    'title_sub' => '',
                    'text' => '之前受疫情影响，政府推动“无接触配送”加速
培养用户取餐习惯，让用户从心里上逐渐认可新
形势取餐方式',
                ],
                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                    'image_url' =>  'assets/images/diancan/fangan4/3/透明.png',
                    'title' => '外卖丢失、易凉问题',
//                    'bg_color'=>'bg-white',
// 'big_title'=>'让餐饮店生意更简单',
//                    'big_title' => '<div style="text-align: center;">
//<div>微信刷脸支付，新一代收银神器</div>
//
//<div><h4>支付更快捷方便，营销功能更齐全</h4></div>
//</div>',
                    'title_sub' => '',
                    'text' => '提供系统化外卖送餐点分类储存，拒绝丢失；搭配
智能加热、温控、紫外线消毒功能，保证用餐的品
质和安全',
                ],


                [
                    'type' => TYPE_IMAGE_RIGHT_SECTION,
                    'image_url' =>  'assets/images/diancan/fangan4/4/图.jpg',
                    'title' => '持续的收益',
                    'bg_color'=>'bg-white',
                    'title_sub' => '',
                    'text' => '包含广告收益、外卖员收费、线上收入、等多种
收益模式，一次投资、持久使用。坐在家里能轻
松赚钱',
                ],

                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                    'image_url' =>  'assets/images/diancan/fangan4/5/图.jpg',
                    'title' => '可视化报表和统计',
//                    'bg_color'=>'bg-white',
                    'title_sub' => '',
                    'text' => '易查询，可清晰分析出各档口消费情况、当天营业
情况和成本管控，也避免了相关浪费',
                ],

                [
                    'type' => TYPE_ITEM_IMAGES,
                    'bg_color' => 'bg-white',
//                    'bg_style' => 'background-color:#f2f3f5',
//                    'title' => '两粒米无接触式智慧食堂',
//                    'title_sub' => '在食堂大厅摆放智能餐柜，食堂各档口可将用户预订好的餐品提前摆放到智能餐柜中
//（智能餐柜有保温功能），用户在就餐时可直接在智能餐柜通过手机订餐二维码进行取餐，
//省去了在档口的拥挤，提升了用户就餐体验，同时大大的增加了食堂各档口就餐时间内的服务能力，
//为食堂带来更多的收入。',
                    'items' => [
                        [
                            'image_url' => 'assets/images/diancan/fangan4/6/1.jpg',
                        ]
                    ]
                ],
                [
                    'type' => TYPE_ITEM_IMAGES,
//                    'bg_color' => 'bg-white',
                    'bg_style' => 'background-color:#f2f3f5',
                    'title' => '多种功能满足不同需求',
                    'title_sub' => '支持多场景运营模式，满足不同客户场景提供APP嵌入用户对接',
                    'items' => [
                        [
                            'image_url' => 'assets/images/diancan/fangan4/7/1.jpg',
                        ]
                    ]
                ],


            ]
        ],

//        4-1 硬件购买
        [
            'file_name' => 'yingjianbuy.html', //
            'layout' => 'header_footer',//头部加脚页
            'content' => [
                [
                    'type' => TYPE_QE_MIN,
                    'title'=>'硬件购买',
                    'bg_image_url' => 'assets/images/diancan/diandanbao/1/背景.jpg',
                ],
                [
                    'type' => TYPE_BREADCRUMB,
                    'text' => '首页>硬件购买'
                ],
                [
                    'type' => TYPE_TITILE_ITEMS_IMAGE,
//                    'title' => '支持多个行业',
//                    'title_sub' => '丰富的功能，灵活的设计，让我们可以支持多个不同的行业提供更合适您的解决方案',
                    'bg_color' => 'bg-gary',
                    'row' => 1,
                    'items' => [
                        [

                            'image_url' => 'assets/images/diancan/yingjian/1.png',
                            'image_width' => '350px',
                            'bottom'=>'
<div style="width: 350px;word-break:hyphenate;margin-top: 20px;">
   <div ><h5 style="color: #e74848 !important;">芯烨外卖订单打印机</h5></div>
   <div>设备型号：XP-C58H</div>

支持接口：蓝牙  wifi  无线网  USB<br>

打印方式：直接式热敏打印<br>

打印纸宽度：58mm<br>
    <div style="width: 100%;display: flex;justify-content: end">
    
    <a href="##">
    <div style="background-color: #fddc7a;padding-bottom: 5px;padding-top: 5px;padding-right: 10px;padding-left: 10px;border-radius: 30px;">
    前往购买
    </div>
    </a>
    

</div>
</div>',
                        ],
                        [

                            'image_url' => 'assets/images/diancan/yingjian/2.png',
                            'image_width' => '350px',
                            'bottom'=>'
<div style="width: 350px;word-break:hyphenate;margin-top: 20px;">
   <div ><h5 style="color: #e74848 !important;">芯烨外卖订单打印机</h5></div>
   <div>设备型号：XP-C58H</div>

支持接口：蓝牙  wifi  无线网  USB<br>

打印方式：直接式热敏打印<br>

打印纸宽度：58mm<br>
    <div style="width: 100%;display: flex;justify-content: end">
    
    <a href="##">
    <div style="background-color: #fddc7a;padding-bottom: 5px;padding-top: 5px;padding-right: 10px;padding-left: 10px;border-radius: 30px;">
    前往购买
    </div>
    </a>
    

</div>
</div>'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/yingjian/3.png',
                            'image_width' => '350px',
                            'bottom'=>'
<div style="width: 350px;word-break:hyphenate;margin-top: 20px;">
   <div ><h5 style="color: #e74848 !important;">芯烨外卖订单打印机</h5></div>
   <div>设备型号：XP-C58H</div>

支持接口：蓝牙  wifi  无线网  USB<br>

打印方式：直接式热敏打印<br>

打印纸宽度：58mm<br>
    <div style="width: 100%;display: flex;justify-content: end">
    
    <a href="##">
    <div style="background-color: #fddc7a;padding-bottom: 5px;padding-top: 5px;padding-right: 10px;padding-left: 10px;border-radius: 30px;">
    前往购买
    </div>
    </a>
    

</div>
</div>'
                        ],



                    ]
                ],

            ]
        ],

//        5-1 下载登录

        [
            'file_name' => 'download.html', //
            'layout' => 'header_footer',//头部加脚页
            'content' => [
                [
                    'type' => TYPE_QE_MIN,
                    'title'=>'系统下载',
                    'bg_image_url' => 'assets/images/diancan/diandanbao/1/背景.jpg',
                ],
                [
                    'type' => TYPE_BREADCRUMB,
                    'text' => '首页>系统下载'
                ],
                [
                    'type' => TYPE_DOWNLOAD,
                    'items'=>[
                        [
                            'image_url'=>'assets/images/diancan/download/1/透明.png',
                            'items'=>[
                                [
                                    'image_url'=>'assets/images/diancan/download/1/1.png',
                                    'title'=>'两粒米掌柜手机端',
                                    'ver'=>'版本号：v7.1',
                                    'date'=>'更新时间：2021-10-19',
                                    'button_text'=>'扫一扫立即体验',
                                    'content'=>'软件大小：约33MB<br>
适配系统：支持 XP/ Win 7/Win 8/Win 8.1/Win 10<br>
温馨提示：原6.0版本用户请<a style="color: red" href="##">点击此处</a>下载V6.0安装包<br>',
                                ],
                                [
                                    'image_url'=>'assets/images/diancan/download/1/2.png',
                                    'title'=>'两粒米商户后台电脑端',
                                    'ver'=>'版本号：v7.1',
                                    'date'=>'更新时间：2021-10-21',
                                    'button_text'=>'立即登录',
                                    'content'=>'打开方式：浏览器打开<br>
适配系统：无需下载<br>
温馨提示：使用谷歌浏览器打开系统网页效果更好',
                                ],

                            ],
                        ],

                        [
                            'image_url'=>'assets/images/diancan/download/2/透明.png',
                            'items'=>[
                                [
                                    'image_url'=>'assets/images/diancan/download/2/1.png',
                                    'title'=>'两粒米点单宝',
                                    'ver'=>'版本号：v7.1',
                                    'date'=>'更新时间：2021-10-19',
                                    'button_text'=>'最新版下载',
                                    'content'=>'软件大小：约33MB<br>
适配系统：支持 XP/ Win 7/Win 8/Win 8.1/Win 10<br>
温馨提示：原6.0版本用户请<a style="color: red" href="##">点击此处</a>下载V6.0安装包<br>',
                                ],
                                [
                                    'image_url'=>'assets/images/diancan/download/2/2.png',
                                    'title'=>'乐刷APP下载',
                                    'ver'=>'版本号：v7.1',
                                    'button_text'=>'最新版下载',
                                    'date'=>'更新时间：2021-10-08',
                                    'content'=>'打开方式：浏览器打开<br>
适配系统：无需下载<br>
温馨提示：使用谷歌浏览器打开系统网页效果更好',
                                ],

                            ],
                        ],
                        [
                            'image_url'=>'assets/images/diancan/download/3/透明.png',
                            'items'=>[
                                [
                                    'image_url'=>'assets/images/diancan/download/3/1.png',
                                    'title'=>'两粒米服务商后台',
                                    'ver'=>'版本号：v7.1',
                                    'date'=>'更新时间：2021-10-19',
                                    'button_text'=>'立即登录',
                                    'content'=>'软件大小：约33MB<br>
适配系统：支持 XP/ Win 7/Win 8/Win 8.1/Win 10<br>
温馨提示：原6.0版本用户请<a style="color: red" href="##">点击此处</a>下载V6.0安装包<br>',
                                ],
                                [
                                    'image_url'=>'assets/images/diancan/download/3/2.png',
                                    'title'=>'乐刷服务商后台',
                                    'ver'=>'版本号：v7.1',
                                    'button_text'=>'立即登录',
                                    'date'=>'更新时间：2021-10-08',
                                    'content'=>'打开方式：浏览器打开<br>
适配系统：无需下载<br>
温馨提示：使用谷歌浏览器打开系统网页效果更好',
                                ],

                            ],
                        ],
                        [
                            'image_url'=>'assets/images/diancan/download/4/透明.png',
                            'items'=>[
                                [
                                    'image_url'=>'assets/images/diancan/download/4/1.png',
                                    'title'=>'两粒米智慧食堂商户后台',
                                    'ver'=>'版本号：v7.1',
                                    'date'=>'更新时间：2021-10-19',
                                    'button_text'=>'立即登录',
                                    'content'=>'软件大小：约33MB<br>
适配系统：支持 XP/ Win 7/Win 8/Win 8.1/Win 10<br>
温馨提示：原6.0版本用户请<a style="color: red" href="##">点击此处</a>下载V6.0安装包<br>',
                                ],
                                [
                                    'image_url'=>'assets/images/diancan/download/4/2.png',
                                    'title'=>'两粒米智慧食堂服务商后台',
                                    'ver'=>'版本号：v7.1',
                                    'button_text'=>'立即登录',
                                    'date'=>'更新时间：2021-10-08',
                                    'content'=>'打开方式：浏览器打开<br>
适配系统：无需下载<br>
温馨提示：使用谷歌浏览器打开系统网页效果更好',
                                ],

                            ],
                        ],
                    ],
                ],

            ]
        ],


//        6-1 公司简介
        [
            'file_name' => 'jianjie.html', //
            'layout' => 'header_footer',//头部加脚页
            'content' => [
                [
                    'type' => TYPE_QE_MIN,
                    'title'=>'公司简介',
                    'bg_image_url' => 'assets/images/diancan/diandanbao/1/背景.jpg',
                ],
                [
                    'type' => TYPE_BREADCRUMB,
                    'text' => '首页>关于团队'
                ],

                [
                    'type' => TYPE_ITEM_IMAGES,
                    'bg_color' => 'bg-white',
                    'title'=>'上海仝心科技有限公司',
                    'title_sub'=>'两粒米采用以物联网、互联网、云计算技术为基础，智能硬件搭载云端服务，并打造出各种极为智能
便捷的应用技术，提供一站式的解决方案。两粒米主营产品有智慧食堂云消费系统、扫码点餐系统、美食
城云管理系统、智慧硬件等，产品使用范围涉及企业政府食堂、医院校园食堂、餐饮连锁、景区、服务区、
美食城店等各个领域。两粒米励志打造智慧餐饮，让科技改变生活！',
                ],

                [
                    'type' => TYPE_ITEM_IMAGES,
//                    'bg_color' => 'bg-white',
                    'title'=>'企业文化',
                    'bg_style' => 'background-color:#f2f3f5',
//                    'title_sub'=>'全新就餐体验，尽在两粒米智慧食堂！',
                    'items' => [
                        [
                            'image_url' =>'assets/images/diancan/jianjie/2/1.jpg',
                        ]
                    ]
                ],
                [
                    'type' => TYPE_QE_MIN,
                    'title'=>'<div style="color: white !important;">专业打造“智慧餐厅”，让每一个商户好开店、开好店！</div>',
                    'bg_image_url' => 'assets/images/diancan/jianjie/3/背景图.jpg',
                ],




            ]
        ],

//        6-2 资质
        [
            'file_name' => 'zizhi.html', //
            'layout' => 'header_footer',//头部加脚页
            'content' => [
                [
                    'type' => TYPE_QE_MIN,
                    'title'=>'公司资质',
                    'bg_image_url' => 'assets/images/diancan/diandanbao/1/背景.jpg',
                ],
                [
                    'type' => TYPE_BREADCRUMB,
                    'text' => '首页>公司资质'
                ],

                [
                    'type' => TYPE_TITILE_ITEMS_IMAGE,
                    'title' => '两粒米知识产权相关',
                    'title_sub' => '相关图标',
                    'bg_color' => 'bg-gary',
                    'items' => [
                        [

                            'image_url' => 'assets/images/diancan/zizhi/1/1.png',
                            'image_width' => '350px'
                        ],

                        [

                            'image_url' => 'assets/images/diancan/zizhi/1/2.png',
                            'image_width' => '350px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/zizhi/1/3.png',
                            'image_width' => '350px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/zizhi/1/4.png',
                            'image_width' => '350px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/zizhi/1/5.png',
                            'image_width' => '350px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/zizhi/1/6.png',
                            'image_width' => '350px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/zizhi/1/7.png',
                            'image_width' => '350px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/zizhi/1/8.png',
                            'image_width' => '350px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/zizhi/1/9.png',
                            'image_width' => '350px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/zizhi/1/10.png',
                            'image_width' => '350px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/zizhi/1/11.png',
                            'image_width' => '350px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/zizhi/1/12.png',
                            'image_width' => '350px'
                        ],

                    ]
                ],

                [
                    'type' => TYPE_TITILE_ITEMS_IMAGE,
                    'title' => '两粒米相关软件著作权',
//                    'title_sub' => '相关图标',
                    'bg_color' => 'bg-gary',
                    'items' => [
                        [

                            'image_url' => 'assets/images/diancan/zizhi/2/1.png',
                            'image_width' => '350px'
                        ],

                        [

                            'image_url' => 'assets/images/diancan/zizhi/2/2.png',
                            'image_width' => '350px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/zizhi/2/3.png',
                            'image_width' => '350px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/zizhi/2/4.png',
                            'image_width' => '350px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/zizhi/2/5.png',
                            'image_width' => '350px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/zizhi/2/6.png',
                            'image_width' => '350px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/zizhi/2/7.png',
                            'image_width' => '350px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/zizhi/2/8.png',
                            'image_width' => '350px'
                        ],
                        [

                            'image_url' => 'assets/images/diancan/zizhi/2/9.png',
                            'image_width' => '350px'
                        ],


                    ]
                ],


            ]
        ],

//        6-3 联系我们
        [
            'file_name' => 'contact.html', //
            'layout' => 'header_footer',//头部加脚页
            'content' => [
                [
                    'type' => TYPE_QE_MIN,
                    'title'=>'联系我们',
                    'bg_image_url' => 'assets/images/diancan/diandanbao/1/背景.jpg',
                ],
                [
                    'type' => TYPE_BREADCRUMB,
                    'text' => '首页>联系我们'
                ],
               [
                   'type'=>TYPE_CONTACT,
                   'tel'=>'<h3>官方热线：4000-526-528</h3>'
               ]
            ]
        ],

    ],

];
