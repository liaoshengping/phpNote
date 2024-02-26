<?php


const THINKPHP = "thinkphp";
const LARAVEL = "laravel";
const GOLANG = "golang";
const PYTHON = "PYTHON";


const THINKPHP_FORNT = "thinkphp_fornt";
const LARVAL_FORNT = "larval_fornt";
const VUE_ELEMENT = "vue_element";


const FRAME_PATH = '';
const WORK_NAME = '';

//const MODEL = 'MbGoods';

return [
    "frame" => LARAVEL,
    'frame_path' => xenv("live_path",FRAME_PATH),
    'frame_controller_path' => xenv("live_path",FRAME_PATH) . "app\Http\Controllers/",
    'frame_modebase_path' => xenv("live_path",FRAME_PATH) . 'app\Models\base\\',
    'frame_mode_path' => xenv("live_path",FRAME_PATH) . "app\Models/",
    'base_model_namespace_path' => "App\Models\base",
    'model_namespace_path' => "App\Models",
    'controller_namespace_path' => "App\Http\Controllers",
    'frame_controller_base_namespace' => "\App\Http\Controllers\base",
//    'base_base_model' => 'BaseMemberModel', //模型的模型继承的类
    'disable_soft_delete' => true, //是否软删除


//    "frame" => LARAVEL,
//    'frame_path' => xenv("live_path",FRAME_PATH),
//    'frame_controller_path' => xenv("live_path",FRAME_PATH) . "app\Http\Controllers/",
//    'frame_modebase_path' => xenv("live_path",FRAME_PATH) . 'app\Models\base\\'.MODEL.'\\',
//    'frame_mode_path' => xenv("live_path",FRAME_PATH) . "app\Models/".MODEL.'/',
//    'base_model_namespace_path' => "App\Models\base\\".MODEL,
//    'model_namespace_path' => "App\Models\\".MODEL,
//    'controller_namespace_path' => "App\Http\Controllers",
//    'frame_controller_base_namespace' => "\App\Http\Controllers\base",
//    'base_base_model' => 'Base'.MODEL.'Model', //模型的模型继承的类
//    'disable_soft_delete' => true, //是否软删除

    /**
     * 数据库信息
     */
    "host" => xenv('host'),
//    "database" => 'mb_goods',
    "database" => 'live_api',
    "port" => xenv("port", "3306"),
    "username" => xenv("username", "root"),
    "password" => xenv("password", "root"),

    "fornt" => "",
    "enum_path" => "",//没有则不创建，或在model中定义,
    "database_file_name" => "database-edu-manager",
    'prefix' => "",
    'is_auto_build_time' =>false,
    'auto_build_time' => [
        'created_at',
        'updated_at',
        'deleted_at'
    ], //自动生成数据库缺少的字段比如 create_at,update_at

    //框架区别
    'validate_int' => 'integer',
    'validate_number' => 'numeric',



    'admin_hide_id' =>true, //隐藏admin 的id

    //文档地址
    'document_path' => FRAME_PATH . 'document',

    /**
     * 生成文档 https://github.com/DarkaOnLine/L5-Swagger
     */
    'api_doc' => 'swagger',//不生成为空
    'api_prefix' => 'api', //生成的api前缀
    'create_exclude_fields' => ['created_at', 'updated_at', 'deleted_at', 'id', 'group_id', 'user_id', 'email_verified_at'],


    'exclude_fillable' => ['created_at', 'updated_at', 'deleted_at'],//$fillable  全局排除字段 ,即不可编辑的字段

    'hidden_fields' => ['deleted_at', 'password', 'remember_token','updated_at'], //全局需要隐藏的字段


    //auth userid
    'auth_user_id' => '\Illuminate\Support\Facades\Auth::id()',

    'user_id_translate_the_name' => '',//后台管理 user_id 转化为users.nickname 并disable，不需要可不写 试了下没用，再研究



    /**
     * 数据差异性
     */
    "tables" => [
        'user' => [
            'name' => '用户管理',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [],
            'is_auth' => false,//只可以获取自己的信息，结合auth_user_id 使用
            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖
            'create_input' => [], //创建需要的字段如果为空取上面的
            'controller_actions' => ['show'],
//            ['create','list','edit','show','delete'];
//            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的
            /**
             * [
             *   name:'liaosp',
             *   plan_code:[
             *      {
             *
            'name':'liaosp',
             * }
             * ]
             * ]
             */
            'relations' => [

//                [
//                    'relation' => "hasMany",
//                    'tables' => [
//                        [
//                            'table_name' => 'plan_code',
//                            'target' => 'plan_id', //目标表中的字段
//                            'origin' => 'id',//本表的字段
//                            'list_show' => true,
//                            'list_exist' => false,
//                            'one_show' => true,
//                            'create_relation' => false,//创建时，是否可以关联添加
//                        ],
//                    ],
//                ],

            ]
        ],

        'order' => [
            'name' => '订单管理',
            'request_method' => 'form',//form表单 json (Json Body的形式),
            'fields' => [
                ''
            ],
            'input' => [],
            'is_auth' => false,//只可以获取自己的信息，结合auth_user_id 使用
            'no_cover_admin' => true,//创建laravel-admin 后台数据不可以强制覆盖
            'create_input' => [], //创建需要的字段如果为空取上面的
            'controller_actions' => ['list','show'],
//            ['create','list','edit','show','delete'];
//            'create_input' => [], //创建需要的字段如果为空取上面的

            'edit_input' => [],//编辑需要的字段 如果为空取上面的
            /**
             * [
             *   name:'liaosp',
             *   plan_code:[
             *      {
             *
            'name':'liaosp',
             * }
             * ]
             * ]
             */
            'relations' => [

//                [
//                    'relation' => "hasMany",
//                    'tables' => [
//                        [
//                            'table_name' => 'plan_code',
//                            'target' => 'plan_id', //目标表中的字段
//                            'origin' => 'id',//本表的字段
//                            'list_show' => true,
//                            'list_exist' => false,
//                            'one_show' => true,
//                            'create_relation' => false,//创建时，是否可以关联添加
//                        ],
//                    ],
//                ],

            ]
        ],
    ]
];
