<?php

//doMatch();

function doMatch(){

    $fileData = file_get_contents(__DIR__.'/cache/cache') ?? '';
    $fileData = json_decode($fileData,true);



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
//        echo "<h2>$key</h2>";
//
//        echo "ray:".$item['ray']['leftTeamAdds'].'------'.$item['ray']['rightTeamAdds']."<br>";
//        echo "other:".$item['other']['leftTeamAdds'].'------'.$item['other']['rightTeamAdds'];
        if (empty($item['ray']['leftTeamAdds']) || empty($item['other']['leftTeamAdds'])) {
            continue;
        }
        $win1 = 100 * $item['ray']['leftTeamAdds'];
        $otherXia = $win1/$item['other']['rightTeamAdds'];
        $resultWin =$win1 - (100+ $otherXia);
        if ($resultWin>0){
//            if (!empty($fileData[date('Y-m-d').'-'.$item['teamKey']])){
                $value = $fileData[date('Y-m-d').'-'.$item['teamKey']]??0;
                if ($resultWin > $value){
                    $fileData[date('Y-m-d').'-'.$key] = '可下注100:'.$item['ray']['leftTeamAdds'].'对冲'.$item['other']['rightTeamAdds'].'赢'.$resultWin.'元';
                    file_put_contents(__DIR__.'/cache/cache',json_encode($fileData,JSON_UNESCAPED_UNICODE));
                }
//            }
//            echo '<span style="color: red">可下注:</span>'.$item['ray']['leftTeamAdds'].'对冲'.$win1/$item['other']['rightTeamAdds'].'赢'.$resultWin.'元';
            continue;
        }


        $win1 = 100 * $item['other']['leftTeamAdds'];
        $otherXia = $win1/$item['ray']['rightTeamAdds'];
        $resultWin =$win1 - (100+ $otherXia);

        if ($resultWin>0){
//            if (!empty($fileData[date('Y-m-d').'-'.$item['teamKey']])){
                $value = $fileData[date('Y-m-d').'-'.$item['teamKey']] ?? 0;
                if ($resultWin > $value){
                    $fileData[date('Y-m-d').'-'.$key] = '可下注100:'.$item['other']['leftTeamAdds'].'对冲'.$item['ray']['rightTeamAdds'].'赢'.$resultWin.'元'.date('Y-m-d H:i:s');
                    file_put_contents(__DIR__.'/cache/cache',json_encode($fileData,JSON_UNESCAPED_UNICODE));
                }
//            }
//            echo '<span style="color: red">可下注:</span>'.$item['other']['leftTeamAdds'].'对冲'.$item['ray']['rightTeamAdds'].'赢'.$resultWin.'元';
            continue;
        }


    }
}