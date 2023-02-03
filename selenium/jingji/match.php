<?php

$jingjibao = json_decode(file_get_contents(__DIR__.'/json/jingjibao.json'),true);

$ray = json_decode(file_get_contents(__DIR__.'/json/ray.json'),true);


foreach ($jingjibao as $item){
    echo $item['leftTeamName'].'-'.$item['rightTeamName'].PHP_EOL;
}

foreach ($ray as $item){
    echo $item['leftTeamName'].'-'.$item['rightTeamName'].PHP_EOL;
}