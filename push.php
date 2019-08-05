<?php

/**
 * Class A
 * @property  $test
 */
class A{
    /**
     * @return A
     */
    public static function instance(){
        echo __FUNCTION__;exit;
    }
    public function pushTest(){
        echo 'test';
    }
    function __call($name, $arguments)
    {
        $function = 'push'.$name;
        $this->$function();
    }
}

