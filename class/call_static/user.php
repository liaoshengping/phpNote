<?php
include(__DIR__ . '/base.php');

class user extends base
{

    public $type;

    public function my_function(){
        echo $this->param;
    }
}
