<?php
namespace container\functions\php\laravel\Oapi;
use Inhere\Console\Util\Show;

/**
 * 章鱼系统 看上去非常规范的开发流程
 */
trait Oapi
{

    public $help = [
        'controller' => '控制器',
        'request' => '请求器',
        'repo' => '仓库',
        'transfor' => '返回格式转换',
        'all' => '全部',
    ];


    public function handleOapi(){

        $action = $this->app->argvs[2];
        switch ($action){

            default:
                Show::info('请输入操作选项');
                throw new \Exception("输入参数上面介绍的参数");
        }

    }
}