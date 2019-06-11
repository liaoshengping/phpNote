<?php
//function createRange($number){
//    $data = [];
//    for($i=0;$i<$number;$i++){
//        $data[] = time();
//    }
//    return $data;
//}
function createRange($number){
    for($i=0;$i<$number;$i++){
        yield time();
    }
}
$data =createRange(10);
foreach($data as $value){
    sleep(1);//这里停顿1秒，我们后续有用
    echo $value.'<br />';
}
