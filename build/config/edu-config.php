<?php


const THINKPHP = "thinkphp";
const LARAVEL = "laravel";
const GOLANG = "golang";
const PYTHON = "PYTHON";


const THINKPHP_FORNT = "thinkphp_fornt";
const LARVAL_FORNT = "larval_fornt";
const VUE_ELEMENT = "vue_element";


const FRAME_PATH = 'E:\linuxdir\php\edu-manager/';
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
    "database" => 'edu-manager',
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

    /**
     * table relations
     */
    'relations' => [
        'users' => [
            [
                'relation' => "hasMany",
                'table' => [
                    [
                        'table_name' => 'posts',
                        'target' => 'user_id', //目标表中的字段
                        'origin' => 'id',//本表的字段
                        'limit' => 0,//查询为10条
                        'list_show' => true,
                        'list_exist' => false,
                        'one_show' => false,
                        'create_relation' => false,//创建时，是否可以关联添加
                    ],
                ],
            ],

            [
                'relation' => "hasOne",
                'table' => [
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
    ]

];
