<?php


namespace App\Services\AliOpen\core;


class ContainerBase extends Container
{
    protected $provider = [];

    public $params = array();

    public function __construct($params =array())
    {
        $this->params = $params;

        $provider_callback = function ($provider) {
            $obj =new $provider;
            $this->serviceRegister($obj);
        };
        array_walk($this->provider, $provider_callback);//注册
    }

    public function __get($id)
    {
        if(!empty($this->provider[$id])){
            return $this;
        }
        return $this->offsetGet($id);

    }
}
