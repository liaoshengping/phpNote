<?php

$array =[
    [
        'id' => 1,
        'name' => 'name',
    ]
];

foreach ($array as ['id' =>&$id ,'name' =>$name]){
    $id = 3;
}

var_dump($array);
