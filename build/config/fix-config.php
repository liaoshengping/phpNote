<?php


const THINKPHP = "thinkphp";
const LARAVEL = "laravel";
const GOLANG = "golang";
const PYTHON = "PYTHON";


const THINKPHP_FORNT = "thinkphp_fornt";
const LARVAL_FORNT = "larval_fornt";
const VUE_ELEMENT = "vue_element";


const FRAME_PATH = 'E:\linuxdir\php\fix_station/';
const WORK_NAME = 'yibage';


return [
    "frame" => LARAVEL,
    'frame_path' => FRAME_PATH,
    'frame_controller_path' => FRAME_PATH . "app\Http\Controllers/",
    'frame_modebase_path' => FRAME_PATH . 'app\Models\base\\',
    'frame_mode_path' => FRAME_PATH . "app\Models/",
    'base_model_namespace_path' => "App\Models\base",
    'model_namespace_path' => "App\Models",
    'controller_namespace_path' => "App\Http\Controllers",
    'frame_controller_base_namespace' => "\App\Http\Controllers\base",

    /**
     * 数据库信息
     */
    "host" => xenv('host'),
    "database" => 'fix_station',
    "port" => xenv("port", "3306"),
    "username" => xenv("username", "root"),
    "password" => xenv("password", "123456"),

    "fornt" => "",
    "enum_path" => "",//没有则不创建，或在model中定义,
    "database_file_name" => "database-edu-manager",
    'prefix' => "",
    'auto_build_time' => [
        'created_at',
        'updated_at',
        'deleted_at'
    ], //自动生成数据库缺少的字段比如 create_at,update_at

    //框架区别
    'validate_int' => 'integer',
    'validate_number' => 'numeric',

    //文档地址
    'document_path' => FRAME_PATH . 'document',

    /**
     * 生成文档 https://github.com/DarkaOnLine/L5-Swagger
     */
    'api_doc' => 'swagger',//不生成为空
    'api_prefix' => 'api', //生成的api前缀
    'create_exclude_fields' => ['created_at', 'updated_at', 'deleted_at', 'id', 'user_id', 'email_verified_at'],


    'exclude_fillable' => ['created_at', 'updated_at', 'deleted_at'],//$fillable  全局排除字段 ,即不可编辑的字段

    'hidden_fields' => ['deleted_at', 'password', 'remember_token'], //全局需要隐藏的字段


    //auth userid
    'auth_user_id' => '\Illuminate\Support\Facades\Auth::user()->user_id',

    'user_id_translate_the_name' => '',//后台管理 user_id 转化为users.nickname 并disable，不需要可不写 试了下没用，再研究

    /**
     * 数据差异性
     */
    "tables" => [
        'fix_station' => [
            'name' => '维修站接口',//文章
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
            'controller_actions' => ['show'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'no_cover_admin' => false,//创建laravel-admin 后台数据不可以强制覆盖

            'relations' => [
//                [
//                    'relation' => "hasMany",
//                    'tables' => [
//                        [
//                            'table_name' => 'posts',
//                            'target' => 'user_id', //目标表中的字段
//                            'origin' => 'id',//本表的字段
//                            'limit' => 5,//查询为10条
//                            'list_show' => true,
//                            'list_exist' => false,
//                            'one_show' => false,
//                            'create_relation' => false,//创建时，是否可以关联添加
//                        ],
//                    ],
//                ],
//
                [
                    'relation' => "hasOne",
                    'tables' => [
                        [
                            'table_name' => 'users',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'user_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => true,//创建时，是否可以关联添加
                        ],
                    ],
                ]
            ]
        ],
        'users' => [
            'name' => '用户管理',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
            'is_auth' => true,//只可以获取自己的信息，结合auth_user_id 使用
            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => 'none',
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'relations' => [
//                [
//                    'relation' => "hasMany",
//                    'tables' => [
//                        [
//                            'table_name' => 'posts',
//                            'target' => 'user_id', //目标表中的字段
//                            'origin' => 'id',//本表的字段
//                            'limit' => 5,//查询为10条
//                            'list_show' => true,
//                            'list_exist' => false,
//                            'one_show' => false,
//                            'create_relation' => false,//创建时，是否可以关联添加
//                        ],
//                    ],
//                ],
//
                [
                    'relation' => "hasOne",
                    'tables' => [
//                        [
//                            'table_name' => 'cars',
//                            'target' => 'user_id', //目标表中的字段
//                            'origin' => 'id',//本表的字段
//                            'list_show' => true,
//                            'list_exist' => false,
//                            'one_show' => true,
//                            'create_relation' => true,//创建时，是否可以关联添加
//                        ],
                        [
                            'table_name' => 'user_car',
                            'target' => 'user_id', //目标表中的字段
                            'origin' => 'id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => true,//创建时，是否可以关联添加
                        ],
                    ],
                ]
            ]
        ],
        'cars' => [
            'name' => '车辆管理',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
            'is_auth' => false,//只可以获取自己的信息，结合auth_user_id 使用
            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => ['list'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'relations' => [
//                [
//                    'relation' => "hasMany",
//                    'tables' => [
//                        [
//                            'table_name' => 'posts',
//                            'target' => 'user_id', //目标表中的字段
//                            'origin' => 'id',//本表的字段
//                            'limit' => 5,//查询为10条
//                            'list_show' => true,
//                            'list_exist' => false,
//                            'one_show' => false,
//                            'create_relation' => false,//创建时，是否可以关联添加
//                        ],
//                    ],
//                ],
//
//                [
//                    'relation' => "hasOne",
//                    'tables' => [
//                        [
//                            'table_name' => 'cars',
//                            'target' => 'user_id', //目标表中的字段
//                            'origin' => 'id',//本表的字段
//                            'list_show' => true,
//                            'list_exist' => false,
//                            'one_show' => true,
//                            'create_relation' => true,//创建时，是否可以关联添加
//                        ],
//                    ],
//                ]
            ]
        ],
        'user_account' => [
            'name' => '微信',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
            'controller_actions' => ['create'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'relations' => [
//                [
//                    'relation' => "hasMany",
//                    'tables' => [
//                        [
//                            'table_name' => 'posts',
//                            'target' => 'user_id', //目标表中的字段
//                            'origin' => 'id',//本表的字段
//                            'limit' => 5,//查询为10条
//                            'list_show' => true,
//                            'list_exist' => false,
//                            'one_show' => false,
//                            'create_relation' => false,//创建时，是否可以关联添加
//                        ],
//                    ],
//                ],
//
                [
                    'relation' => "hasOne",
                    'tables' => [
                        [
                            'table_name' => 'users',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'user_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => true,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'fix_station',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'fix_station_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => true,//创建时，是否可以关联添加
                        ],
                    ],

                ]
            ]
        ],
        'order' => [
            'name' => '订单管理',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
            'is_auth' => true,//只可以获取自己的信息，结合auth_user_id 使用

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => ['list', 'show'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'relations' => [
                [
                    'relation' => "hasMany",
                    'tables' => [
                        [
                            'table_name' => 'order_product',
                            'target' => 'order_id', //目标表中的字段
                            'origin' => 'id',//本表的字段
                            'limit' => 20,//查询为10条
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'order_fee',
                            'target' => 'order_id', //目标表中的字段
                            'origin' => 'id',//本表的字段
                            'limit' => 20,//查询为10条
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                    ],
                ],
                [
                    'relation' => "hasOne",
                    'tables' => [
                        [
                            'table_name' => 'users',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'user_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'fix_station',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'fix_station_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => true,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'payment',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'payment_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => true,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'order_sale',
                            'target' => 'order_id', //目标表中的字段
                            'origin' => 'id',//本表的字段
                            'list_show' => true,
                            'list_exist' => true,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],

                    ],

                ]
            ]
        ],
        'order_product' => [
            'name' => '订单类目',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
            'is_auth' => true,//只可以获取自己的信息，结合auth_user_id 使用

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => ['none'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'relations' => [
                [
                    'relation' => "hasOne",
                    'tables' => [
                        [
                            'table_name' => 'order',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'order_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'product',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'product_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => true,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                    ],

                ]
            ]
        ],
        'product' => [
            'name' => '产品管理',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
//            'is_auth'=>true,//只可以获取自己的信息，结合auth_user_id 使用

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => ['list'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'relations' => [

            ]
        ],
        'payment' => [
            'name' => '支付管理',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
//            'is_auth'=>true,//只可以获取自己的信息，结合auth_user_id 使用

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => ['list'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'relations' => [
                [
                    'relation' => "hasOne",
                    'tables' => [
                        [
                            'table_name' => 'order',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'order_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ]
                    ],

                ],
                [
                    'relation' => "hasOne",
                    'tables' => [
                        [
                            'table_name' => 'fix_station',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'fix_station_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'users',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'user_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'admin_users',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'admin_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ]


                    ],

                ],

            ]
        ],
        'user_car' => [
            'name' => '车辆管理',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
//            'is_auth'=>true,//只可以获取自己的信息，结合auth_user_id 使用

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => ['edit'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'relations' => [
                [
                    'relation' => "hasOne",
                    'tables' => [
//                        [
//                            'table_name' => 'fix_station',
//                            'target' => 'id', //目标表中的字段
//                            'origin' => 'fix_station_id',//本表的字段
//                            'list_show' => true,
//                            'list_exist' => false,
//                            'one_show' => true,
//                            'create_relation' => false,//创建时，是否可以关联添加
//                        ],
                        [
                            'table_name' => 'users',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'user_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'admin_users',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'admin_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'cars',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'car_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],


                    ],

                ],

            ]
        ],
        'user_fix_station' => [
            'name' => '车辆管理',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
//            'is_auth'=>true,//只可以获取自己的信息，结合auth_user_id 使用

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => ['edit'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'relations' => [
                [
                    'relation' => "hasOne",
                    'tables' => [
                        [
                            'table_name' => 'users',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'user_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ]
                    ],

                ],

            ]
        ],
        'order_sale' => [
            'name' => '售后管理',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
//            'is_auth'=>true,//只可以获取自己的信息，结合auth_user_id 使用

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => ['show'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'relations' => [
                [
                    'relation' => "hasMany",
                    'tables' => [
                        [
                            'table_name' => 'order_sale_product',
                            'target' => 'order_sale_id', //目标表中的字段
                            'origin' => 'id',//本表的字段
                            'limit' => 20,//查询为10条
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ]
                    ],
                ],
                [
                    'relation' => "hasOne",
                    'tables' => [
                        [
                            'table_name' => 'order',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'order_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],

                        [
                            'table_name' => 'fix_station',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'fix_station_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                    ],

                ]
            ]
        ],
        'order_sale_product' => [
            'name' => '售后管理商品',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
//            'is_auth'=>true,//只可以获取自己的信息，结合auth_user_id 使用

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => ['show'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'relations' => [
//                [
//                    'relation' => "hasMany",
//                    'tables' => [
//                        [
//                            'table_name' => 'order_sale_product',
//                            'target' => 'order_sale_id', //目标表中的字段
//                            'origin' => 'id',//本表的字段
//                            'limit' => 20,//查询为10条
//                            'list_show' => true,
//                            'list_exist' => false,
//                            'one_show' => true,
//                            'create_relation' => false,//创建时，是否可以关联添加
//                        ]
//                    ],
//                ],
                [
                    'relation' => "hasOne",
                    'tables' => [
                        [
                            'table_name' => 'order_product',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'order_product_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],



                    ],

                ]
            ]
        ],
        'sale' => [
            'name' => '售后管理',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
//            'is_auth'=>true,//只可以获取自己的信息，结合auth_user_id 使用

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => ['show'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'relations' => [
                [
                    'relation' => "hasMany",
                    'tables' => [
                        [
                            'table_name' => 'sale_product',
                            'target' => 'sale_id', //目标表中的字段
                            'origin' => 'id',//本表的字段
                            'limit' => 30,//查询为10条
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => true,//创建时，是否可以关联添加
                        ]
                    ],
                ],
                [
                    'relation' => "hasOne",
                    'tables' => [
                        [
                            'table_name' => 'fix_station',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'fix_station_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'users',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'user_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],

                    ],

                ]
            ]
        ],
        'sale_product' => [
            'name' => '售后管理',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
//            'is_auth'=>true,//只可以获取自己的信息，结合auth_user_id 使用

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => ['show','list'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'relations' => [
                [
                    'relation' => "hasMany",
                    'tables' => [
//                        [
//                            'table_name' => 'sale_product',
//                            'target' => 'sale_id', //目标表中的字段
//                            'origin' => 'id',//本表的字段
//                            'limit' => 30,//查询为10条
//                            'list_show' => true,
//                            'list_exist' => false,
//                            'one_show' => true,
//                            'create_relation' => true,//创建时，是否可以关联添加
//                        ]
                    ],
                ],
                [
                    'relation' => "hasOne",
                    'tables' => [
                        [
                            'table_name' => 'fix_station',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'fix_station_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ]
                ,
                        [
                            'table_name' => 'product',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'product_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ]
                    ],

                ]
            ]
        ],
        'product_stock' => [
            'name' => '维修站产品库存',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
//            'is_auth'=>true,//只可以获取自己的信息，结合auth_user_id 使用

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => ['list'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'list_other_params' => [
                [
                    'key' => 'fix_station_id',
                    'des' => '当前维修站id',//描述
                    'required' => 'true',//是否必须
                ]
            ],

            'relations' => [
                [
                    'relation' => "hasMany",
                    'tables' => [
//                        [
//                            'table_name' => 'sale_product',
//                            'target' => 'sale_id', //目标表中的字段
//                            'origin' => 'id',//本表的字段
//                            'limit' => 30,//查询为10条
//                            'list_show' => true,
//                            'list_exist' => false,
//                            'one_show' => true,
//                            'create_relation' => true,//创建时，是否可以关联添加
//                        ]
                    ],
                ],
                [
                    'relation' => "hasOne",
                    'tables' => [
                        [
                            'table_name' => 'fix_station',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'fix_station_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ]
                        ,
                        [
                            'table_name' => 'product',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'product_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ]
                    ],

                ]
            ]
        ],
        'meal_ticket_send_log' => [
            'name' => '负责人',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
//            'is_auth'=>true,//只可以获取自己的信息，结合auth_user_id 使用

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => ['list'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'list_other_params' => [
                [
                    'key' => 'manager_station_id',
                    'des' => '当前维修站id',//描述
                    'required' => 'true',//是否必须
                ]
            ],

            'relations' => [

                [
                    'relation' => "hasOne",
                    'tables' => [
                        [
                            'table_name' => 'fix_station',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'store_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'users',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'send_user_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ]

                    ],


                ]
            ]
        ],
        'meal_ticket_date' => [
            'name' => '饭票情况',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
//            'is_auth'=>true,//只可以获取自己的信息，结合auth_user_id 使用

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => ['list'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'list_other_params' => [
                [
                    'key' => 'manager_station_id',
                    'des' => '当前维修站id',//描述
                    'required' => 'true',//是否必须
                ]
            ],

            'relations' => [
                [
                    'relation' => "hasMany",
                    'tables' => [
//                        [
//                            'table_name' => 'sale_product',
//                            'target' => 'sale_id', //目标表中的字段
//                            'origin' => 'id',//本表的字段
//                            'limit' => 30,//查询为10条
//                            'list_show' => true,
//                            'list_exist' => false,
//                            'one_show' => true,
//                            'create_relation' => true,//创建时，是否可以关联添加
//                        ]
                    ],
                ],
                [
                    'relation' => "hasOne",
                    'tables' => [
                        [
                            'table_name' => 'fix_station',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'store_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ]

                    ],

                ]
            ]
        ],
        'meal_ticket_log' => [
            'name' => '饭票流水',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
//            'is_auth'=>true,//只可以获取自己的信息，结合auth_user_id 使用

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => ['list'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'list_other_params' => [
                [
                    'key' => 'manager_station_id',
                    'des' => '当前维修站id',//描述
                    'required' => 'true',//是否必须
                ]
            ],

            'relations' => [
                [
                    'relation' => "hasMany",
                    'tables' => [
//                        [
//                            'table_name' => 'sale_product',
//                            'target' => 'sale_id', //目标表中的字段
//                            'origin' => 'id',//本表的字段
//                            'limit' => 30,//查询为10条
//                            'list_show' => true,
//                            'list_exist' => false,
//                            'one_show' => true,
//                            'create_relation' => true,//创建时，是否可以关联添加
//                        ]
                    ],
                ],
                [
                    'relation' => "hasOne",
                    'tables' => [
                        [
                            'table_name' => 'fix_station',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'store_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'users',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'user_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],

                    ],

                ]
            ]
        ]

    ],


];
