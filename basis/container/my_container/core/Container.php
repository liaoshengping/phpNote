<?php

namespace core;

use interfaces\Provider;

class Container implements \ArrayAccess
{
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
        $raw = $this->values[$offset];
        $val = $this->values[$offset] = $raw($this);
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
