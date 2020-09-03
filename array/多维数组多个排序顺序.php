<?php
//场景：打折的排前面，不打折的排后面，前提都是金额小的在前面

$array1 = array(
    0=>array('id'=>1,'order'=>'1','price'=> 9),
    1=>array('id'=>2,'order'=>'1','price'=>8),
    2=>array('id'=>3,'order'=>'0','price'=>10),
    3=>array('id'=>4,'order'=>'0','price'=>7)
);
function sortArrByManyField(){
    $args = func_get_args(); // 获取函数的参数的数组
    if(empty($args)){
        return null;
    }
    $arr = array_shift($args);
    if(!is_array($arr)){
        throw new Exception("第一个参数不为数组");
    }
    foreach($args as $key => $field){
        if(is_string($field)){
            $temp = array();
            foreach($arr as $index=> $val){
                $temp[$index] = $val[$field];
            }
            $args[$key] = $temp;
        }
    }
    $args[] = &$arr;//引用值
    call_user_func_array('array_multisort',$args);
    return array_pop($args);
}
$arr = sortArrByManyField($array1,'order',SORT_DESC,'price',SORT_ASC);

print_r($arr);
