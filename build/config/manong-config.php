<?php


const THINKPHP = "thinkphp";
const LARAVEL = "laravel";
const GOLANG = "golang";
const PYTHON = "PYTHON";


const THINKPHP_FORNT = "thinkphp_fornt";
const LARVAL_FORNT = "larval_fornt";
const VUE_ELEMENT = "vue_element";


const FRAME_PATH = 'E:\linuxdir\php\manong/';
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

    /**
     * 数据库信息
     */
    "host" => env("host", "192.168.205.22"),
    "database" => 'manong',
    "port" => env("port", "3306"),
    "username" => env("username", "root"),
    "password" => env("password", "123456"),


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
    'create_exclude_fields' => ['created_at', 'updated_at', 'id', 'user_id', 'email_verified_at'],//目前用于文档 全局新增排除字段


    'exclude_fillable' => ['created_at', 'updated_at', 'deleted_at'],//$fillable  全局排除字段 ,即不可编辑的字段

    'hidden_fields' => ['deleted_at', 'password', 'remember_token'], //全局需要隐藏的字段


    //框架区别
    'validate_int' => 'integer',
    'validate_number' => 'numeric',

    /**
     * 数据差异性
     */
    "tables" => [

        'users' => [
            'name' => '文章',//文章
            'request_method' => 'json',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [

            ],
            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的


            'relations' => [
                [
                    'relation' => "hasMany",
                    'tables' => [
                        [
                            'table_name' => 'posts',
                            'target' => 'user_id', //目标表中的字段
                            'origin' => 'id',//本表的字段
                            'limit' => 5,//查询为10条
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => false,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                    ],
                ],

                [
                    'relation' => "hasOne",
                    'tables' => [
                        [
                            'table_name' => 'user_detail',
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
        /**
         * 产品
         */
        'product' => [
            'name' => '产品管理',//文章
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [
                'name',
                'sub_name',
                'tag',
                'image_url',
            ],
            'list_input' => [
                'status',
                'name',
            ],
            'create_input' => [], //创建需要的字段如果为空取上面的
            'edit_input' => [],//编辑需要的字段 如果为空取上面的
            'relations' => [
                [
                    'relation' => "hasMany",
                    'tables' => [
                        [
                            'table_name' => 'product_spec',
                            'description' => '产品的规格，获取列表',
                            'target' => 'product_id', //目标表中的字段
                            'origin' => 'id',//本表的字段
                            'limit' => 5,//查询为10条
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => false,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                        [
                            'table_name' => 'product_comment',
                            'target' => 'product_id', //目标表中的字段
                            'origin' => 'id',//本表的字段
                            'limit' => 5,//查询为10条
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => false,
                            'create_relation' => false,//创建时，是否可以关联添加
                        ],
                    ],
                ],

                [
                    'relation' => "hasOne",
                    'tables' => [
                        [
                            'table_name' => 'store',
                            'description' => '商店信息，创建产品时，不要提交',
                            'target' => 'id', //目标表中的字段
                            'origin' => 'store_id',//本表的字段
                            'list_show' => true,
                            'list_exist' => false,
                            'one_show' => true,//详情是否显示
                            'create_relation' => true,//创建时，是否可以关联添加
                        ],
                    ],
                ]
            ]
        ]

    ],


];
