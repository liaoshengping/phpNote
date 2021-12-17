<?php


namespace container\core;


use container\interfaces\Middlewares;

class ContainerBase extends Container
{
    protected $provider = [];

    public $params = array();

    public function __construct($params = array())
    {

        $this->params = $params;

        $provider_callback = function ($provider) {
            $obj = new $provider;
            $this->serviceRegister($obj);
        };
        array_walk($this->provider, $provider_callback);//注册




        //处理中间件
        foreach ($this->middlewares as $key => $middleware) {

            echo "=================“.$key.”=================".PHP_EOL;
            /**@var Middlewares $_m**/
            $_m = new $middleware;
            $_m->handle($this);
        }
    }

    public function __get($id)
    {
        if (!empty($this->provider[$id])) {
            return $this;
        }
        return $this->offsetGet($id);

    }
}
