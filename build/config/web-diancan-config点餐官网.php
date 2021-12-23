<?php

require_once "core/config.php";


const FRAME_PATH = 'E:\linuxdir\web\diancan/';
const WORK_NAME = 'yibage';

const TYPE_BANNER = 'banner';
const TYPE_IMAGE_LEFT_SECTION = 'image_left_section';
const TYPE_BREADCRUMB = 'breadcrumb';


return [
    "frame" => HTMLV1,
    'frame_path' => FRAME_PATH,
    'title' => '点餐系统',
    'database' => false,
    'view_path' => 'container\functions\htmlv1\bootstrap_official\html',
    'logo'=> 'https://s4.ax1x.com/2021/12/17/TF5q8U.png',

    'menus' => [
        [
            'name' => '首页',
            'href' => '#',
        ],
        [
            'name' => '产品介绍',
            'href' => '#',
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
                [
                    'type'=>TYPE_BREADCRUMB
                ],
                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                ],
                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                ],
                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                ],
                [
                    'type' => TYPE_IMAGE_LEFT_SECTION,
                ]

            ],
        ],
        [
            'file_name' => 'prouct.html',//产品页
            'layout' => 'header_footer'
        ]

    ],

];
