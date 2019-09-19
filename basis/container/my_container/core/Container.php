<?php

namespace core;

use interfaces\Provider;

/**
 * Class Container
 * @package core
 */
class Container implements \ArrayAccess
{
    private $instances =array();
    private $values = array();
    public $register;

    public function serviceRegister(Provider $provider)
    {
        $provider->serviceProvider($this);

        return $this;
    }

    public function offsetExists($offset)
    {
        // TODO: Implement offsetExists() method.
    }

    public function offsetGet($offset)
    {
        if(isset($this->instances[$offset])){
            return $this->instances[$offset];
        }
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
}
