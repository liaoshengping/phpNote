<?php

use Xin\Phalcon\Enum\Enum;
class Test extends Enum{

    public function closure(\Closure $closure){

        $data =  call_user_func($closure,$this);

        var_dump($data);
    }

    public function doTest($data){
        return $data;
    }


}


//$obj = new Test();
//
//$num = 1;
//
//$obj->closure(function (Test $test )use($num){
//  return  $test->doTest('hello word'.$num);
//});
//
