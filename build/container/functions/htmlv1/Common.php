<?php

namespace container\functions\htmlv1;

use container\core\BaseClient;
use container\functions\htmlv1\bootstrap_official\type\banner;

/**
 * 官網
 * Class BootstrapOfficial
 */
class Common extends BaseClient
{

    public $templte;//模板

    private $config;//当前html文件的配置

    /**
     * 生成
     */
    public function run()
    {

        //初始化静态css
        $this->app->tool->xCopy(__DIR__ . '/bootstrap_official/assets', config('frame_path') . 'assets');


        //TODO 自定义css
        //生成模板
        foreach (config('html_files') as $item) {
            $this->templte = '';
            $this->config = $item;

            $this->htmlBase();
            $this->layout();
            $this->buildContent();
            $this->buildFile();

        };


        //头部
    }


    /**
     * html 基础
     */
    public function htmlBase()
    {

        $this->templte = file_get_contents(__DIR__ . '/bootstrap_official/html/base.html');

    }

    /**
     * 加载通用的layout
     */
    public function layout()
    {
       $layout = view('layout',config());

        $this->templte = str_replace('{{layout}}', $layout, $this->templte);
    }

    /**
     * 生成 html
     */
    public function buildContent()
    {

        if (empty($this->config['content'])) return;

        $content = '';

        foreach ($this->config['content'] as $item) {

            $class = '\container\functions\htmlv1\bootstrap_official\type\\' . $item['type'];

            if ( class_exists($class)){
                /**
                 * @var banner
                 */
                $content .= (new $class($item))->handle();
            }else{

                $view  = array_merge($this->config,$item);

                $content .= view($item['type'],$view);
            }



        }

        $this->templte = str_replace('【content】', $content, $this->templte);
    }

    /**
     * 最后的检查
     */
    public function buildFile()
    {

        //todo 检查是否存在正则匹配

        preg_match_all('/{{(.*)}}/', $this->templte, $result);

        foreach ($result[1] as $item) {
            if (config($item)) {
                $this->templte = str_replace("{{{$item}}}", config($item), $this->templte);
                continue;
            } else {
                $this->templte = str_replace("{{{$item}}}", '', $this->templte);
            }
        }

        file_put_contents(config('frame_path') . '/' . $this->config['file_name'], $this->templte);

    }


}