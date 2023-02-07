<title>匹配抓取</title>
<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>



<?php

$jingjibao = json_decode(file_get_contents(__DIR__.'/json/jingjibao.json'),true);

$ray = json_decode(file_get_contents(__DIR__.'/json/ray.json'),true);


$result = [];

$rays = [];


foreach ($ray as &$item){
    $item['teamKey'] = $item['leftTeamName'].'-'.$item['rightTeamName'];
    $rays[$item['teamKey']] =  $item;
}

foreach ($jingjibao as &$item){
    $item['teamKey'] = $item['leftTeamName'].'-'.$item['rightTeamName'];
    if (!empty($rays[$item['teamKey']])){

        $result[$item['teamKey']] = [
            'ray' =>$rays[$item['teamKey']],
            'other' => $item,
        ];

    }
}
//var_dump($result);

foreach ($result as $key=>$item){

//    $teamName = $item[];
    echo "<h1><img src='".$item['ray']['gameLogo']."'>$key</h1>";

    echo "<img style='width :50px ;height : 50px' src='".$item['ray']['leftTeamLogo']."'><span  style='color: red;font-size: 30px'> VS</span><img style='width :50px ;height : 50px' src='".$item['ray']['rightTeamLogo']."'><br>";

    echo "ray:".$item['ray']['leftTeamAdds'].'------'.$item['ray']['rightTeamAdds']."<br>";
    echo "other:".$item['other']['leftTeamAdds'].'------'.$item['other']['rightTeamAdds'];
    if (empty($item['ray']['leftTeamAdds']) || empty($item['other']['leftTeamAdds'])) {
        continue;
    }
    $win1 = 100 * $item['ray']['leftTeamAdds'];
    $otherXia = $win1/$item['other']['rightTeamAdds'];
    $resultWin =$win1 - (100+ $otherXia);
    if ($resultWin>0){
        echo '<span style="color: red">可下注:</span>'.$item['ray']['leftTeamAdds'].'对冲'.$win1/$item['other']['rightTeamAdds'].'赢'.$resultWin.'元';
        continue;
    }


    $win1 = 100 * $item['other']['leftTeamAdds'];
    $otherXia = $win1/$item['ray']['rightTeamAdds'];
    $resultWin =$win1 - (100+ $otherXia);

    if ($resultWin>0){
        echo '<span style="color: red">可下注:</span>'.$item['other']['leftTeamAdds'].'对冲'.$item['ray']['rightTeamAdds'].'赢'.$resultWin.'元';
        continue;
    }


}


echo "<h3>已匹配上的数据:</h3>";

echo file_get_contents(__DIR__.'/cache/cache')

?>

