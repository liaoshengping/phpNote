<?php
namespace container\middlewares;

use container\Application;
use container\core\ContainerBase;
use container\interfaces\Middlewares;
use Inhere\Console\Util\Interact;
use Inhere\Console\Util\Show;

class configHandler implements Middlewares
{

    public function handle(Application $app)
    {
        $datatabases  = include_once(__DIR__.'\..\..\config\database.php');
        Show::panel($datatabases, '数据库配置信息',[]);
        // 先输出消息，再读取
//        $userInput = Interact::readln('Your name:');
//
//        Show::block('是你输入的是'.$userInput,'success','warning');

        $app->db->init($datatabases['host'],$datatabases['username'] ,$datatabases['password'],$datatabases["database"]);
        //所有表
//        $data = $app->db->query("select table_name from information_schema.tables where table_schema='" . $datatabases["database"] . "'");
//
//        var_dump($data);exit;
    }


}
