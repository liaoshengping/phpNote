<?php
namespace container\middlewares;

use common\cache;
use container\Application;
use container\core\ContainerBase;
use container\interfaces\Middlewares;
use Inhere\Console\Util\Interact;
use Inhere\Console\Util\Show;

class configHandler implements Middlewares
{

    public function handle(Application $app)
    {

        if (empty(config('database'))) return;

        // 先输出消息，再读取
//        $userInput = Interact::readln('Your name:');
//
//        Show::block('是你输入的是'.$userInput,'success','warning');

        $app->db->init(config('host'),config('username'),config('password'),config('database'),config('port'));
        //记录当前表明

        //所有表
//        $data = $app->db->query("select table_name from information_schema.tables where table_schema='" . $datatabases["database"] . "'");
//
//        var_dump($data);exit;
    }


}
