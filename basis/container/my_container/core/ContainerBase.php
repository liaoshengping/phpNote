<?php


namespace core;


class ContainerBase extends Container
{
    protected $provider = [];

    public function __construct()
    {
        $provider_callback = function ($provider) {
            $obj =new $provider;
            $this->serviceRegister($obj);
        };
        array_walk($this->provider, $provider_callback);//注册
    }

    public function __get($id)
    {
        return $this->offsetGet($id);

    }
}
