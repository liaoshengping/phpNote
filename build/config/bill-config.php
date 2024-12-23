<?php


const THINKPHP = "thinkphp";
const LARAVEL = "laravel";
const GOLANG = "golang";
const PYTHON = "PYTHON";


const THINKPHP_FORNT = "thinkphp_fornt";
const LARVAL_FORNT = "larval_fornt";
const VUE_ELEMENT = "vue_element";


const FRAME_PATH = 'E:\linuxdir\php\nongline_bill/';
const WORK_NAME = 'yibage';


return [
    "frame" => LARAVEL,
    'frame_path' => FRAME_PATH,
    'frame_modebase_path' => FRAME_PATH . 'app\Models\base\\',
    'frame_mode_path' => FRAME_PATH . "app\Models/",
    'base_model_namespace_path' => "App\Models\base",
    'model_namespace_path' => "App\Models",
    'controller_namespace_path' => "App\Http\Controllers\Api",
    'frame_controller_path' => FRAME_PATH . "app\Http\Controllers\Api/",
    'frame_controller_base_namespace' => "\App\Http\Controllers\base",

    'set_pk' => true,//设置主键

    /**
     * 数据库信息
     */
    "host" => '47.104.104.162',
//    "host" => '192.168.205.22',
    "database" => 'nongline_bill',
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


    //文档地址
    'document_path' => FRAME_PATH . 'document',

    /**
     * 生成文档 https://github.com/DarkaOnLine/L5-Swagger
     */
    'api_doc' => 'swagger',//不生成为空
    'api_prefix' => 'api', //生成的api前缀
    'create_exclude_fields' => ['created_at', 'updated_at', 'deleted_at', 'id', 'email_verified_at', 'store_id', 'is_root', 'is_bind'],
    'keyword_name' => 'key_word',//其他项目改成keyword


    'exclude_fillable' => ['created_at', 'updated_at', 'deleted_at'],//$fillable  全局排除字段 ,即不可编辑的字段

    'hidden_fields' => ['deleted_at', 'password', 'remember_token'], //全局需要隐藏的字段


    //auth userid
    'auth_user_id' => '\Illuminate\Support\Facades\Auth::user()->user_id',
    'auth_store_id' => 'app("store")->store_id', //店铺id

    'user_id_translate_the_name' => '',//后台管理 user_id 转化为users.nickname 并disable，不需要可不写 试了下没用，再研究


    'common_query' => '
            if (!empty($request->input(\'start_at\')) && !empty($request->input(\'end_at\'))){
                $query->whereBetween(\'created_at\',app(\'Time\')->getBetweenAt());
            }',
//    'time_between_field'=>'create_at',
//
    /**
     * 数据差异性
     */
    "tables" => [
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

            'controller_actions' => ['create', 'list', 'show', 'delete'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'create_other_params' => [
                [
                    'key' => 'member_name',
                    'des' => '新增的会员名字，没有检索到member_id的会员传 值，如果该名称有值，member_id 为-1',//描述
                    'required' => 'false',//是否必须
                ],

            ], //创建时额外的参数，用于swagger 生成

            'relations' => [
                [
                    'relation' => "hasMany",
                    'tables' => [
                        [
                            'table_name' => 'order_goods',
                            'target' => 'order_id', //目标表中的字段
                            'origin' => 'order_id',//本表的字段
                            'limit' => 30,//查询为10条
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
                            'table_name' => 'payment',
                            'target' => 'payment_id', //目标表中的字段
                            'origin' => 'payment_id',//本表的字段
                            'list_show' => false,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'store_contacts',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'member_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'store_admin',
                            'target' => 'store_admin_id', //目标表中的字段
                            'origin' => 'store_admin_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],

                    ],

                ]
            ],

        ],
        'goods' => [
            'name' => '商品管理',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
//            'is_auth' => true,//只可以获取自己的信息，结合auth_user_id 使用

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => ['create', 'list', 'edit', 'show', 'delete'],
//            ['create','list','edit','show','delete'];

            'is_auth' => false,//只可以获取自己的信息，结合auth_user_id 使用
            'is_auth_store' => true,//查询是否需要用store_id 去查询
//            'time_between_field'=>'order_at',
            //删除的状态
            'status_delete' => [
                'key' => 'status',
                'value' => 'delete',
            ],
            //修改状态
            "change_status" => [
                'key' => 'status',
            ],
            //删除检查表是否使用
            "delete_check" => [
                [
                    'table' => 'wms_record_detail',
                    'model' => '\App\Models\WmsRecordDetail',
                    'key' => 'goods_id'
                ],
            ],


            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'create_input' => [], //创建需要的字段如果为空取上面的

            'create_other_params' => [
                [
                    'key' => 'initial_stock_quantity',
                    'des' => '初始库存数量',//描述
                    'required' => 'false',//是否必须
                ],
                [
                    'key' => 'initial_stock_weight',
                    'des' => '初始库存重量',//描述
                    'required' => "false",//是否必须
                ],
                [
                    'key' => 'initial_stock_cost',
                    'des' => '库存成本',//描述
                    'required' => "false",//是否必须
                ],

            ],
            //创建时额外的参数，用于swagger 生成

            'list_input' => ['cate_id'], // 列表需要的字段如果为空取上面的

            'relations' => [
//                [
//                    'relation' => "hasMany",
//                    'tables' => [
//                        [
//                            'table_name' => 'order_goods',
//                            'target' => 'order_id', //目标表中的字段
//                            'origin' => 'id',//本表的字段
//                            'limit' => 30,//查询为10条
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
                            'table_name' => 'goods_attr',
                            'target' => 'goods_attr_id', //目标表中的字段
                            'origin' => 'goods_attr_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'goods_unit',
                            'target' => 'goods_unit_id', //目标表中的字段
                            'origin' => 'goods_unit_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'goods_category',
                            'target' => 'cate_id', //目标表中的字段
                            'origin' => 'cate_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'sys_dict',
                            'target' => 'sys_dict_id', //目标表中的字段
                            'origin' => 'dict_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                    ],

                ]
            ]
        ],
        'goods_attr' => [
            'name' => '商品属性管理',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
            'is_auth' => false,//只可以获取自己的信息，结合auth_user_id 使用
            'is_auth_store' => true,//查询是否需要用store_id 去查询

            'no_cover_admin' => false,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => ['list', 'show'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'relations' => [
                [
                    'relation' => "hasMany",
                    'tables' => [
//                        [
//                            'table_name' => 'goods_unit',
//                            'target' => 'goods_attr_id', //目标表中的字段
//                            'origin' => 'goods_attr_id',//本表的字段
//                            'limit' => 100,//查询为10条
//                            'list_show' => true,
//                            'list_exist' => false,
//                            'one_show' => true,
//                            'create_relation' => false,//创建时，是否可以关联添加
//                        ]
                    ],
                ],
//                [
//                    'relation' => "hasOne",
//                    'tables' => [
//                        [
//                            'table_name' => 'goods_unit',
//                            'target' => 'goods_attr_id', //目标表中的字段
//                            'origin' => 'goods_attr_id',//本表的字段
//                            'list_show' => true,
//                            'list_exist' => false,
//                            'one_show' => true,
//                            'create_relation' => false,//创建时，是否可以关联添加
//                        ],
//                    ],
//
//                ]
            ]
        ],
        'goods_unit' => [
            'name' => '商品单位',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
            'is_auth' => true,//只可以获取自己的信息，结合auth_user_id 使用
            'is_auth_store' => true,//查询是否需要用store_id 去查询

            'no_cover_admin' => false,//创建laravel-admin 后台数据不可以强制覆盖
            //删除检查表是否使用
            "delete_check" => [
                [
                    'table' => 'goods',
                    'model' => '\App\Models\Goods',
                    'key' => 'goods_unit_id'
                ],
            ],
            'controller_actions' => ['create', 'list', 'show', 'delete'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'relations' => [
//                [
//                    'relation' => "hasMany",
//                    'tables' => [
//                        [
//                            'table_name' => 'order_goods',
//                            'target' => 'order_id', //目标表中的字段
//                            'origin' => 'id',//本表的字段
//                            'limit' => 30,//查询为10条
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
                            'table_name' => 'goods_attr',
                            'target' => 'goods_attr_id', //目标表中的字段
                            'origin' => 'goods_attr_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'goods_unit',
                            'target' => 'goods_unit_id', //目标表中的字段
                            'origin' => 'goods_unit_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                    ],

                ]
            ]
        ],
        'store' => [
            'name' => '商店管理',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
            'is_auth' => false,//只可以获取自己的信息，结合auth_user_id 使用
            'is_auth_store' => true,//查询是否需要用store_id 去查询

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => ['create', 'list',],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'relations' => [
                [
                    'relation' => "hasMany",
                    'tables' => [
                        [
                            'table_name' => 'store_admin',
                            'target' => 'store_id', //目标表中的字段
                            'origin' => 'store_id',//本表的字段
                            'limit' => 10,//查询为10条
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
//                        [
//                            'table_name' => 'goods_attr',
//                            'target' => 'goods_attr_id', //目标表中的字段
//                            'origin' => 'goods_attr_id',//本表的字段
//                            'list_show' => true,
//                            'list_exist' => false,
//                            'one_show' => true,
//                            'create_relation' => false,//创建时，是否可以关联添加
//                        ],

                    ],

                ]
            ]
        ],

        'store_admin' => [
            'name' => '员工管理',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
            'is_auth' => false,//只可以获取自己的信息，结合auth_user_id 使用
            'is_auth_store' => true,//查询是否需要用store_id 去查询

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => ['create', 'list', 'edit', 'show', 'delete'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的


            'relations' => [
//                [
//                    'relation' => "hasMany",
//                    'tables' => [
//                        [
//                            'table_name' => 'store_admin',
//                            'target' => 'store_id', //目标表中的字段
//                            'origin' => 'store_id',//本表的字段
//                            'limit' => 10,//查询为10条
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
                            'table_name' => 'store',
                            'target' => 'store_id', //目标表中的字段
                            'origin' => 'store_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
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
            'is_auth' => false,//只可以获取自己的信息，结合auth_user_id 使用
            'is_auth_store' => true,//查询是否需要用store_id 去查询

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            'controller_actions' => ['create', 'list',],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'relations' => [
//                [
//                    'relation' => "hasMany",
//                    'tables' => [
//                        [
//                            'table_name' => 'store_admin',
//                            'target' => 'store_id', //目标表中的字段
//                            'origin' => 'store_id',//本表的字段
//                            'limit' => 10,//查询为10条
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
                            'table_name' => 'store_admin',
                            'target' => 'user_id', //目标表中的字段
                            'origin' => 'id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],

                    ],

                ]
            ]
        ],

        'sys_dict' => [
            'name' => '数据字典',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
            'is_auth' => false,//只可以获取自己的信息，结合auth_user_id 使用
            'is_auth_store' => true,//查询是否需要用store_id 去查询

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            //            "delete_check"=>[
//                [
//                    'table'=>'goods',
//                    'model'=> '\App\Models\Goods',
//                    'key'=>'dict_id'
//                ]
//            ],

            //修改状态
            "change_status" => [
                'key' => 'status',
            ],
            //删除检查表是否使用
            "delete_check" => [
                [
                    'table' => 'goods',
                    'model' => '\App\Models\Goods',
                    'key' => 'dict_id'
                ],
                [
                    'table' => 'store_contacts',
                    'model' => '\App\Models\StoreContacts',
                    'key' => 'dict_id'
                ],
            ],

            'controller_actions' => ['create', 'list', 'edit', 'show', 'delete'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'relations' => [
//                [
//                    'relation' => "hasMany",
//                    'tables' => [
//                        [
//                            'table_name' => 'store_admin',
//                            'target' => 'store_id', //目标表中的字段
//                            'origin' => 'store_id',//本表的字段
//                            'limit' => 10,//查询为10条
//                            'list_show' => true,
//                            'list_exist' => false,
//                            'one_show' => true,
//                            'create_relation' => false,//创建时，是否可以关联添加
//                        ]
//                    ],
//                ],
//                [
//                    'relation' => "hasOne",
//                    'tables' => [
//                        [
//                            'table_name' => 'store_admin',
//                            'target' => 'user_id', //目标表中的字段
//                            'origin' => 'id',//本表的字段
//                            'list_show' => true,
//                            'list_exist' => false,
//                            'one_show' => true,
//                            'create_relation' => false,//创建时，是否可以关联添加
//                        ],
//
//                    ],
//
//                ]
            ]
        ],

        'store_contacts' => [
            'name' => '客户/供应商/货主 管理',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
            'is_auth' => false,//只可以获取自己的信息，结合auth_user_id 使用
            'is_auth_store' => true,//查询是否需要用store_id 去查询

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            //修改状态
            "change_status" => [
                'key' => 'status',
            ],
            //删除检查表是否使用
//            "delete_check"=>[
//                [
//                    'table'=>'goods',
//                    'model'=> '\App\Models\Goods',
//                    'key'=>'dict_id'
//                ]
//            ],
            //列表关键字搜索
            'list_keyword_search' => [
                [
                    'key' => 'name',
                    'op' => 'like',
                ],
                [
                    'key' => 'phone',
                    'op' => 'like',
                ]
            ],
            'controller_actions' => ['create', 'edit', 'list', 'show', 'delete'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的

            'relations' => [
//                [
//                    'relation' => "hasMany",
//                    'tables' => [
//                        [
//                            'table_name' => 'store_admin',
//                            'target' => 'store_id', //目标表中的字段
//                            'origin' => 'store_id',//本表的字段
//                            'limit' => 10,//查询为10条
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
                            'table_name' => 'sys_dict',
                            'target' => 'sys_dict_id', //目标表中的字段
                            'origin' => 'cate_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],

                    ],

                ]
            ]
        ],

        'wms_record' => [
            'name' => '进销存管理/采购入库/销售记录/进销存记录',
            'request_method' => 'json',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
            'is_auth' => false,//只可以获取自己的信息，结合auth_user_id 使用
            'is_auth_store' => true,//查询是否需要用store_id 去查询

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            //修改状态
            "change_status" => [
                'key' => 'status',
            ],
            //删除检查表是否使用
//            "delete_check"=>[
//                [
//                    'table'=>'goods',
//                    'model'=> '\App\Models\Goods',
//                    'key'=>'dict_id'
//                ]
//            ],
            'relation_save' => true, //关联保存要先安装 composer require liaosp/laravel-relation-save

            'controller_actions' => ['create', 'edit', 'list', 'show'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的
//            wms_record_id

            'relations' => [
                [
                    'relation' => "hasMany",
                    'tables' => [
                        [
                            'table_name' => 'wms_record_detail',
                            'target' => 'wms_record_id', //目标表中的字段
                            'origin' => 'wms_record_id',//本表的字段
                            'limit' => 30,//查询为10条
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'wms_record_other_fee',
                            'target' => 'wms_record_id', //目标表中的字段
                            'origin' => 'wms_record_id',//本表的字段
                            'limit' => 30,//查询为10条
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
                            'table_name' => 'store_admin',
                            'relation_name' => '',
                            'target' => 'store_admin_id', //目标表中的字段
                            'origin' => 'store_admin_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'store_contacts',
                            'relation_name' => 'supplier',//关联模型的名字，默认为表名
                            'target' => 'id', //目标表中的字段
                            'origin' => 'supplier_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'store_contacts',
                            'relation_name' => 'shipper',//关联模型的名字，默认为表名
                            'target' => 'id', //目标表中的字段
                            'origin' => 'shipper_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],

                    ],

                ]
            ]
        ],
        'wms_record_detail' => [
            'name' => '出入库详情',
            'request_method' => 'json',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
            'is_auth' => false,//只可以获取自己的信息，结合auth_user_id 使用
            'is_auth_store' => true,//查询是否需要用store_id 去查询

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            //修改状态
            "change_status" => [
                'key' => 'status',
            ],
            //删除检查表是否使用
//            "delete_check"=>[
//                [
//                    'table'=>'goods',
//                    'model'=> '\App\Models\Goods',
//                    'key'=>'dict_id'
//                ]
//            ],
            'relation_save' => true, //关联保存要先安装 composer require liaosp/laravel-relation-save

            'controller_actions' => ['create', 'edit', 'list', 'show'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的


            'relations' => [
//                [
//                    'relation' => "hasMany",
//                    'tables' => [
//                        [
//                            'table_name' => 'wms_record_detail',
//                            'target' => 'wms_record_id', //目标表中的字段
//                            'origin' => 'wms_record_id',//本表的字段
//                            'limit' => 30,//查询为10条
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
                            'table_name' => 'goods',
                            'relation_name' => '',
                            'target' => 'goods_id', //目标表中的字段
                            'origin' => 'goods_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'wms_record',
                            'relation_name' => '',
                            'target' => 'wms_record_id', //目标表中的字段
                            'origin' => 'wms_record_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                    ],

                ]
            ]
        ],

        'wms_stock' => [
            'name' => '库存，批次库存，进销存库存',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
            'is_auth' => false,//只可以获取自己的信息，结合auth_user_id 使用
            'is_auth_store' => true,//查询是否需要用store_id 去查询

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            //修改状态
//            "change_status" => [
//                'key' => 'status',
//            ],
            //删除检查表是否使用
//            "delete_check"=>[
//                [
//                    'table'=>'goods',
//                    'model'=> '\App\Models\Goods',
//                    'key'=>'dict_id'
//                ]
//            ],
//            'relation_save' => true, //关联保存要先安装 composer require liaosp/laravel-relation-save

            'controller_actions' => ['list', 'show'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的


            'relations' => [
//                [
//                    'relation' => "hasMany",
//                    'tables' => [
//                        [
//                            'table_name' => 'wms_record_detail',
//                            'target' => 'wms_record_id', //目标表中的字段
//                            'origin' => 'wms_record_id',//本表的字段
//                            'limit' => 30,//查询为10条
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
                            'table_name' => 'goods',
                            'relation_name' => '',
                            'target' => 'goods_id', //目标表中的字段
                            'origin' => 'goods_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'wms_record',
                            'relation_name' => '',
                            'target' => 'wms_record_id', //目标表中的字段
                            'origin' => 'wms_record_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                    ],

                ]
            ]
        ],

        'payment_wallet' => [
            'name' => '账户管理，支付方式，财务钱包',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
            'is_auth' => false,//只可以获取自己的信息，结合auth_user_id 使用
            'is_auth_store' => true,//查询是否需要用store_id 去查询

            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖

            //修改状态
//            "change_status" => [
//                'key' => 'status',
//            ],
            //删除检查表是否使用
//            "delete_check"=>[
//                [
//                    'table'=>'goods',
//                    'model'=> '\App\Models\Goods',
//                    'key'=>'dict_id'
//                ]
//            ],

            'list_other_params' => [
                [
                    'key' => 'scene',
                    'des' => '使用场景,采购：传no_period,开单:order',//描述
                    'required' => 'false',//是否必须
                ]

            ],
//            'relation_save' => true, //关联保存要先安装 composer require liaosp/laravel-relation-save

            'controller_actions' => ['list'],
//            ['create','list','edit','show','delete'];
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的


            'relations' => [
//                [
//                    'relation' => "hasMany",
//                    'tables' => [
//                        [
//                            'table_name' => 'wms_record_detail',
//                            'target' => 'wms_record_id', //目标表中的字段
//                            'origin' => 'wms_record_id',//本表的字段
//                            'limit' => 30,//查询为10条
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
                            'table_name' => 'goods',
                            'relation_name' => '',
                            'target' => 'goods_id', //目标表中的字段
                            'origin' => 'goods_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'wms_record',
                            'relation_name' => '',
                            'target' => 'wms_record_id', //目标表中的字段
                            'origin' => 'wms_record_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                    ],

                ]
            ]
        ],

//        payment_wallet

    ]

];
