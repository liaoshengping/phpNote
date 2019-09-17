<?php
class demo{
    public function __get($name)
    {
        echo 'kkk';
    }
}
class demo2{}
function test(demo $demo){
    $demo['demo2'] = function ($demo){
        return new demo2();
    };
}

test('');

