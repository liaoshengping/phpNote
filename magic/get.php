<?php

class Base {
    protected $_object;
    public function __get($name)
    {
        // TODO: Implement __get() method.
        $method_name = 'get' . ucfirst($name);
        if (method_exists($this, $method_name)) {
            return $this->$method_name();
        } elseif (isset($this->_object[$name])) {
            return $this->_object[$name];
        }
        return '';
    }

};

/**
 * Class Test
 * @property $demo string //测试
 */
class Test extends Base{
    static $_instance;

    public static function instance(){
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function getDemo(){
        return '我是demo';
    }
}

$obj = Test::instance();
var_dump($obj->demo);

