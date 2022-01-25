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
            'href' => '#',
        ],
        [
            'name' => '产品介绍',
            'href' => 'introduction.html',
            'sub_type' => 'one', //先实现一级的
            'sub' => [
                [
                    'name' => '产品介绍',
                    'href' => '#',
                ]
            ],

        ],
        [
            'name' => '方案介绍',
            'href' => '#',
        ],
        [
            'name' => '下载登录',
            'href' => '#',
        ],
        [
            'name' => '关于两粒米',
            'href' => '#',
            'sub_type' => 'one', //先实现一级的
            'sub' => [
                [
                    'name' => '关于两粒米',
                    'href' => '#',
                ],
                [
                    'name' => '关于我们团队',
                    'href' => '#',
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
                    'title'=>'智慧食堂VS传统食堂',
                    'title_sub'=>'全新就餐体验，尽在两粒米智慧食堂！',
                    'items' => [
                        [
                            'image_url' =>'assets/images/diancan/zhihuishitang/2/1.jpg',
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
                    'big_title'=>'开启智慧食堂新时代',
//                    'title' => '智能计算起送价/配送费',
//                    'big_title'=>'让餐饮店生意更简单',
                    'bg_style' =>'background-color:#f2f3f5;',
                    'title_sub' => '',
                    'text' => '<img src="assets/images/diancan/zhihuishitang/4/1.jpg">',
                ],
                [
                    'type' => TYPE_ITEM_IMAGES,
                    'bg_color' => 'bg-white',
                    'title'=>'两粒米智慧食堂场景',
                    'title_sub'=>'为商户提供全方位效率提升方案，节约运营成本。',
                    'items' => [
                        [
                            'image_url' =>'assets/images/diancan/zhihuishitang/5/图.jpg',
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
        [
            'file_name' => 'mini_code.html',//产品页
            'layout' => 'header_footer',
            'content' => [
                [
                    'type' => TYPE_BANNER_STAIC,
                    'image_url' => 'https://s4.ax1x.com/2021/12/24/TJqG7T.png',
                    'title' => '餐饮店的微商城小程序',
                    'tital_top' => '餐饮店的微商城小程序',
                    'tital_bottom' => '低成本拓客·自动客流·高效接单·稳定维护',
                ],
                [
                    'type' => TYPE_BANNER,
                    'items' => [
                        [
                            'title' => '餐饮店的微商城小程序',
                            'title_sub' => '低成本拓客·自动客流·高效接单·稳定维护',
                            'image_url' => 'https://s4.ax1x.com/2021/12/24/TJqG7T.png',
                            'href' => [
                                'name' => '下载',
                                'url' => '#'
                            ]
                        ],
                        [
                            'title' => '天下没有难做的生意',
                            'title_sub' => '小标题',
                            'image_url' => 'https://s4.ax1x.com/2021/12/24/TJqG7T.png',
                            'href' => [
                                'name' => '下载',
                                'url' => '#'
                            ]
                        ]
                    ],


                ],
                [
                    'type' => TYPE_BREADCRUMB,
                    'text' => '首页>产品介绍>小程序'
                ],
//                [
//                    'type'=>TYPE_IMAGE_LEFT_SECTION
//                ],
                [
                    'type' => TYPE_TITILE_ITEMS_IMAGE,
                    'title' => '为什么要用两粒米小程序?',
                    'title_sub' => '解决餐饮店推广四大痛点',
                    'bg_color' => 'bg-gary',
                    'items' => [
                        [
                            'title' => '突出门店知名度',
                            'title_sub' => '位置偏僻，客流量低',
                            'image_url' => 'https://s4.ax1x.com/2021/12/23/TGIXz6.png',
                        ],
                        [
                            'title' => '提高客户回头率',
                            'title_sub' => '可对接多个外卖平台',
                            'image_url' => 'https://s4.ax1x.com/2021/12/23/TGIXz6.png',
                        ],
                        [
                            'title' => '解决排队等候问题',
                            'title_sub' => '扫码自动出单，点餐效率高',
                            'image_url' => 'https://s4.ax1x.com/2021/12/23/TGIXz6.png',
                        ],
                        [
                            'title' => '提高客户满意度',
                            'title_sub' => '支持在线下单，结算',
                            'image_url' => 'https://s4.ax1x.com/2021/12/23/TGIXz6.png',
                        ],
                    ]
                ],
                [
                    'type' => TYPE_TITILE_ITEMS_IMAGE,
                    'title' => '两种点餐方式任意选',
//                    'title_sub' => '解决餐饮店推广四大痛点',
                    'items' => [
                        [
//                            'title' => '突出门店知名度',
//                            'title_sub' => '位置偏僻，客流量低',
                            'image_url' => 'https://s4.ax1x.com/2021/12/24/TJbTfJ.png',
                        ],
                        [
//                            'title' => '提高客户回头率',
//                            'title_sub' => '可对接多个外卖平台',
                            'image_url' => 'https://s4.ax1x.com/2021/12/24/TJbTfJ.png',
                        ]
                    ]
                ],
                [
                    'type' => TYPE_ITEM_IMAGES,
                    'bg_color' => 'bg-white',
                    'items' => [
                        [
                            'image_url' => 'https://s4.ax1x.com/2021/12/24/TJvyfU.png'
                        ],
                        [
                            'image_url' => 'https://s4.ax1x.com/2021/12/24/TJvyfU.png'
                        ]
                    ]
                ]


            ],
        ],
        [
            'file_name' => 'introduction.html',//产品页
            'layout' => 'header_footer',
            'content' => [
                [
                    'type' => TYPE_BANNER_STAIC,
                    'image_url' => 'https://s4.ax1x.com/2021/12/24/TJqG7T.png',
                    'title' => '代理商独立管理后台',
                    'tital_top' => '两粒米智慧餐饮（扫码点餐/云消费系统）',
                    'tital_bottom' => '合作伙伴可轻松管理自有商户，轻松查看数据和配置参数',
                ],
                [
                    'type' => TYPE_BANNER,
                    'items' => [
                        [
                            'title' => '代理商独立管理后台',
                            'title_sub' => '合作伙伴可轻松管理自有商户，轻松查看数据和配置参数',
                            'image_url' => 'https://s4.ax1x.com/2021/12/24/TJqG7T.png',
                            'href' => [
                                'name' => '下载',
                                'url' => '#'
                            ]
                        ],
                        [
                            'title' => '天下没有难做的生意',
                            'title_sub' => '小标题',
                            'image_url' => 'https://s4.ax1x.com/2021/12/24/TJqG7T.png',
                            'href' => [
                                'name' => '下载',
                                'url' => '#'
                            ]
                        ]
                    ],


                ],
                [
                    'type' => TYPE_BREADCRUMB,
                    'text' => '首页>系统介绍>两粒米介绍'
                ],
//                [
//                    'type'=>TYPE_IMAGE_LEFT_SECTION
//                ],
                [
                    'type' => TYPE_TITILE_ITEMS_IMAGE,
                    'title' => '餐饮行业最专业的微信点餐小程序?',
                    'title_sub' => '<div>传统餐饮的经营模式已不能满足当下消费者的需求</div><div>改变商业模式才是称霸未来餐饮界的捞金利器</div>',
                    'bg_color' => 'bg-gary',
                    'items' => [
                        [
                            'title' => '点单买单时间',
                            'title_sub' => '<h6 class="text-red">解决超过10分钟/单</h6>',
                            'image_url' => 'https://s4.ax1x.com/2021/12/24/TYivYn.png',
                        ],
                        [
                            'title' => '错菜，漏菜率',
                            'title_sub' => '<h6 class="text-red">降低至 0%</h6>',
                            'image_url' => 'https://s4.ax1x.com/2021/12/24/TYivYn.png',
                        ],
                        [
                            'title' => '服务效率',
                            'title_sub' => '<h6 class="text-red">提升80%</h6>',
                            'image_url' => 'https://s4.ax1x.com/2021/12/24/TYivYn.png',
                        ],
                        [
                            'title' => '人工成本',
                            'title_sub' => '<h6 class="text-red">节省50%</h6>',
                            'image_url' => 'https://s4.ax1x.com/2021/12/24/TYivYn.png',
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
                    'image_url' => 'https://s4.ax1x.com/2021/12/25/Tam6iV.png',
                    'title' => '大标题1',
                    'title_sub' => '',
                    'text' => '小标题2',
                ],
                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                    'image_url' => 'https://s4.ax1x.com/2021/12/25/TamId1.png',
                    'title' => '大标题3',
                    'bg_color' => 'bg_white',
                    'title_sub' => '',
                    'text' => '小标题4',
                ],
                [
                    'type' => TYPE_IMAGE_RIGHT_SECTION,
                    'image_url' => 'https://s4.ax1x.com/2021/12/25/Tanymd.png',
                    'title' => '大标题',
                    'title_sub' => '',
                    'text' => '小标题',
                ],

                [
                    'type' => TYPE_TITILE_ITEMS_IMAGE,
                    'title' => '餐饮行业最专业的微信点餐小程序?',
                    'bg_color' => 'bg-gary',
                    'row' => 2,//两行显示
                    'items' => [
                        [
                            'title' => '1',
                            'image_url' => 'https://s4.ax1x.com/2021/12/25/TaurCV.png',
                        ],
                        [
                            'title' => '2',

                            'image_url' => 'https://s4.ax1x.com/2021/12/25/TaurCV.png',
                        ],
                        [
                            'title' => '3',

                            'image_url' => 'https://s4.ax1x.com/2021/12/25/TaurCV.png',
                        ],
                        [
                            'title' => '4',

                            'image_url' => 'https://s4.ax1x.com/2021/12/25/TaurCV.png',
                        ],
                        [
                            'title' => '5',

                            'image_url' => 'https://s4.ax1x.com/2021/12/25/TaurCV.png',
                        ],
                        [
                            'title' => '6',

                            'image_url' => 'https://s4.ax1x.com/2021/12/25/TaurCV.png',
                        ],
                    ]
                ],

            ],
        ]
    ],

];
