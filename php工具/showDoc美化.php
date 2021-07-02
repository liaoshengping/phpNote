<?php

$path = __DIR__.'\\obj.text';

function read($path){
  $file = fopen($path, "r");
    $user=array();
   $i=0;

   while(! feof($file))
  {
        $user[$i]= fgets($file);//fgets()
         $i++;
    }
   fclose($file);
     $user=array_filter($user);
   return $user;
 }

 $result = read($path);


 $data = '';

 foreach ($result as $key=>$item){
     if (strlen($item) <10 ){
        continue;
     }else{
         $item = DeleteHtml($item);
//         if ($key ==6){
//             echo $item.='|';exit;
//         }
//         echo $item;
         $data.= $item.'|'.PHP_EOL;
     }
 }
 echo $data;


function DeleteHtml($str)
{
    $str = trim($str); //清除字符串两边的空格
    $str = preg_replace("/\t/","",$str); //使用正则表达式替换内容，如：空格，换行，并将替换为空。
    $str = preg_replace("/\r\n/","",$str);
    $str = preg_replace("/\r/","",$str);
    $str = preg_replace("/\n/","",$str);
    $str = preg_replace("/ /","",$str);
    $str = preg_replace("/  /","",$str);  //匹配html中的空格
    return trim($str); //返回字符串
}
