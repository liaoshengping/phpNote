<?php
namespace core;


use functions\Order;
use functions\Sales;

/**
 * Class Log
 * @package core
 * @method static Order order()
 * @method static Sales sales()
 */
class Msg
{
    protected static $class_name;

    protected $apps = [
        'order'=>\functions\Order::class,
        'sales'=>\functions\Sales::class,
    ];

    public static function __callStatic($name, $arguments)
    {
        self::$class_name = $name;
        return new self();
    }
    public function __call($name, $arguments)
    {
        $obj = $this->apps[self::$class_name];
        if(!class_exists($obj)){
            throw new \Exception('不存在类('.$obj.')');
        }
        $class = new $obj($obj,$name);

        $class->{$name}();
    }

}
