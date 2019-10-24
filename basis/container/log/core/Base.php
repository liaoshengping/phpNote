<?php


namespace core;


class Base
{
    protected $obj;

    protected $function;

    protected $message_template;

    public function __construct($obj,$function)
    {
        $this->obj = $obj;
        $this->function = $function;
    }

    public function push(){

    }
}
