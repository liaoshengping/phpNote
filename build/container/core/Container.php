<?php

namespace container\core;


use container\Application;

/**
 * Class Container
 * @package container\core
 */
class Container implements \ArrayAccess
{
    /**
     * 中间件
     * @var array
     */
    protected $middlewares = array();
    private $instances =array();
    private $values = array();
    public $register;

    public function serviceRegister($provider)
    {
        $provider->serviceProvider($this);

        return $this;
    }

    public function offsetExists($offset)
    {
       return true;
    }

    public function offsetGet($offset)
    {

        if(isset($this->instances[$offset])){
            return $this->instances[$offset];
        }
        /**
         * @var Application  run 方法的问题
         */
        $raw = $this->values[$offset];
        $val = $this->values[$offset] = $raw($this);
        $this->instances[$offset] = $val;
        return $val;
    }


    public function offsetSet($offset, $value)
    {
        $this->values[$offset] = $value;
    }

    public function offsetUnset($offset)
    {

    }

    /**
     * @return array
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    /**
     * @param array $middlewares
     */
    public function setMiddlewares(array $middlewares)
    {
        $this->middlewares = $middlewares;
    }

    /**
     * 添加中间件
     * @param $function
     * @param string $name
     * @return array
     */
    public function pushMiddlewares($class_and_function,$name =''){
         $this->middlewares[$name] = $class_and_function;
        return $this->middlewares;
    }


}
