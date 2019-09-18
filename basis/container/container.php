<?php

/* 声明一个简单的容器类 */

class Container
{
    private $_diList = array();

    public function set($className, $concrete)
    {
        $this->_diList[$className] = $concrete;
    }

    /*
    * 核心方法之二，用于获取服务对象
    * @param string $className 将要获取的依赖的名称
    * @return object 返回一个依赖的实例化对象
    */
    public function get($className)
    {
        if (isset($this->_diList[$className])) {
            return call_user_func_array($this->_diList[$className],[]);
        }
        return null;
    }

    /**
     * @return array
     */
    public function getDiList(): array
    {
        return $this->_diList;
    }

}

class demo1
{
    public function __construct()
    {
        echo 'hello word';
    }

    public function test()
    {
        echo 'hello liaosp';
    }
}

$container = new Container();
$container->set('demo1',function (){
    return new demo1();
});

function get(Container $container){
    return $container->get('demo1');
}
$get = get($container)->test();
var_dump($get);exit;
//$data =$container->get('demo1');


/* 数据库连接类 */

class Connection
{
    public function __construct($dbParams)
    {
        // connect the database...
    }

    public function someDbTask()
    {
        // code...
    }
}

/* 会话控制类 */

class Session
{
    public function openSession()
    {
        session_start();
    }
    // code...
}

$container->set('session', function () {
    return new Session();
});

$container = new Container();
// 使用容器注册数据库连接服务
$container->set('db', function () {
    return new Connection(array(
        "host" => "localhost",
        "username" => "root",
        "password" => "root",
        "dbname" => "dbname"
    ));
});
// 使用容器注册会话控制服务
$container->set('session', function () {
    return new Session();
});
// 获取之前注册到容器中的服务，并进行业务的处理
$container->get('db')->someDbTask();
$container->get('session')->openSession();


