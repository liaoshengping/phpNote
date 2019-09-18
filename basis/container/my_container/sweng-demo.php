<?php

include('Container.php');

class DB
{
    public function test()
    {
        echo 'laji';
    }
}


class Base extends Container
{
    protected $provider = [];

    public function __construct()
    {
        $provider_callback = function ($provider) {
            $this->serviceRegister(new $provider);
        };
        array_walk($this->provider, $provider_callback);//注册
    }

    public function __get($id)
    {
        return $this->offsetGet($id);

    }
}

/**
 * Class Application
 * @property   Db db
 */
class Application extends Base
{
    protected $provider = [
        DbServiceProvider::class,
        //...其他服务
    ];

}

class DbServiceProvider implements Provider
{
    /**
     * 服务提供者
     * @param Container $container
     * @return mixed
     */
    public function serviceProvider(Container $container,array $values = array())
    {

        $container['db'] = function () {
            return new DB();
        };
    }
}


interface Provider
{
    public function serviceProvider(Container $container);
}


$app = new Application();
$app->db->test();


