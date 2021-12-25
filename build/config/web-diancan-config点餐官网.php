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
                            'title' => '大标题',
                            'title_sub' => '小标题',
                            'image_url' => 'assets/images/slider/slider1-1.png',
                            'href' => [
                                'name' => '下载',
                                'url' => '#'
                            ]
                        ],
                        [
                            'title' => '天下没有难做的生意',
                            'title_sub' => '小标题',
                            'image_url' => 'assets/images/slider/slider1-2.png',
                            'href' => [
                                'name' => '下载',
                                'url' => '#'
                            ]
                        ]
                    ],

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
                    'title' => '大标题',
                    'title_sub' => '',
                    'text' => '小标题',
                ],
                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                    'image_url' => 'https://s4.ax1x.com/2021/12/25/TamId1.png',
                    'title' => '大标题',
                    'bg_color' => 'bg_white',
                    'title_sub' => '',
                    'text' => '小标题',
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
                            'title'=>'1',
                            'image_url' => 'https://s4.ax1x.com/2021/12/25/TaurCV.png',
                        ],
                        [
                            'title'=>'2',

                            'image_url' => 'https://s4.ax1x.com/2021/12/25/TaurCV.png',
                        ],
                        [
                            'title'=>'3',

                            'image_url' => 'https://s4.ax1x.com/2021/12/25/TaurCV.png',
                        ],
                        [
                            'title'=>'4',

                            'image_url' => 'https://s4.ax1x.com/2021/12/25/TaurCV.png',
                        ],
                        [
                            'title'=>'5',

                            'image_url' => 'https://s4.ax1x.com/2021/12/25/TaurCV.png',
                        ],
                        [
                            'title'=>'6',

                            'image_url' => 'https://s4.ax1x.com/2021/12/25/TaurCV.png',
                        ],
                    ]
                ],

            ],
        ]
    ],

];
