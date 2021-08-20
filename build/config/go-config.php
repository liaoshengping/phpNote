<?php


const THINKPHP = "thinkphp";
const LARAVEL = "laravel";
const GOLANG = "golang";
const PYTHON = "PYTHON";


const THINKPHP_FORNT = "thinkphp_fornt";
const LARVAL_FORNT = "larval_fornt";
const VUE_ELEMENT = "vue_element";


const FRAME_PATH = 'E:\linuxdir\php\1bugapi';
const WORK_NAME = 'yibage';


return [
    "frame" => GOLANG,
    'frame_path'=>FRAME_PATH,
    'frame_controller_path'=> FRAME_PATH ."/application/". WORK_NAME.'/controller/',
    'frame_modebase_path'=> FRAME_PATH .'/application/common/model/base/',
    'frame_mode_path'=> FRAME_PATH ."/application/". WORK_NAME.'/controller/',
    'base_model_namespace_path'=>"app\common\model\base",
    'model_namespace_path'=>"app\common\model\base",
    "fornt" => "",
    "enum_path" => "",//没有则不创建，或在model中定义,
    "database_file_name" => "database",
    'prefix' =>"",
];
