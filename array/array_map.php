<?php
// 使用map的时候，在匿名函数里面是没有key值的，而walk是同时存在key val两个值的，
//所以这应该是他们最大的区别吧。
$arr = [1,2,3];
$new = array_map(array(new demo(),'callback'),$arr);
var_dump($new);

class demo{
    public function callback($value){
        return $value+1;
    }
}
