<?php

$jingjibao = json_decode(file_get_contents(__DIR__.'/json/jingjibao.json'),true);

$ray = json_decode(file_get_contents(__DIR__.'/json/ray.json'),true);


$result = [];

$rays = [];


foreach ($ray as $item){
    $rays[] =  $item['leftTeamName'].'-'.$item['rightTeamName'];
}

foreach ($jingjibao as $item){

    if (in_array($item['leftTeamName'].'-'.$item['rightTeamName'],$rays)){
        $result[] = $item['leftTeamName'].'-'.$item['rightTeamName'];
    }
}

var_dump(implode(',',$result));

