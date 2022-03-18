<?php

namespace container\functions\huafei;


class Bootstrap extends \container\core\BaseClient
{

    protected $channle;

    public function run(){


        $channle = $this->app->params['argv'][2];

        $this->channle = $channle;

        //生成回调控制器 app/api/controller/noti.php

        //生成配置 config/console.php

        //生成命令 查询订单  /app/task/command/guigong.php




        //生成实体接口 /extend/api/guitong.php
        $this->buildExtend();

        //任务
        $this->buildTask();

        //回调
        $this->buildNotify();


    }


    /**
     * 生成实体查询请求的
     */
    public function buildExtend(){



        //模板地址APP_PATH . "/studs/" . $this->app->frame)

        //应用地址  config('frame_path')

        $path = config('frame_path').'\extend\api\\'.ucfirst($this->channle).'.php';

        $template = file_get_contents(APP_PATH . "/studs/" . $this->app->frame.'/extend');

        $template = str_replace('{{ucname}}',ucfirst($this->channle),$template);
        $template = str_replace('{{name}}',$this->channle,$template);



        file_put_contents($path,$template);


    }

    //task任务
    public function buildTask(){

        $path = config('frame_path').'\app\task\command\\'.ucfirst($this->channle).'.php';


        $template = file_get_contents(APP_PATH . "/studs/" . $this->app->frame.'/command');

        $template = str_replace('{{ucname}}',ucfirst($this->channle),$template);

        $template = str_replace('{{channel}}',$this->channle,$template);

        $template = str_replace('{{name}}',config('name'),$template);


        file_put_contents($path,$template);

    }

    /**
     * 回调
     */
    public function buildNotify(){

        $path = config('frame_path').'\app\api\controller\Notify.php';

        $template = file_get_contents($path);

        $mark = '   //mark请勿删除';


        if (strstr($template,$this->channle.'Notify')){
            echo '已设置，请勿设置,请查看代码，不然要祭天';
            return false;
        }

        $one = '    /**
     * '.config("name").'回调地址
     */
    public function '.$this->channle.'Notify() {
        $data = input(\'\');

        $info = Db::name(\'mobile_supplier\')
            ->field(\'id, app_id, app_secret, url\')
            ->where(\'code\', \''.$this->channle.'\')
            ->where(\'is_deleted\', 0)
            ->find();

        if (empty($info)) {
            echo \'账号异常\';
            exit;
        }
        $model = new \api\\'.ucfirst($this->channle).'($info);
        echo $model->notify($data);
    }'.PHP_EOL.$mark;


        $template = str_replace($mark,$one,$template);


        file_put_contents($path,$template);



    }

}
