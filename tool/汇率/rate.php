<?php

 function getExchangeRate()
{
    $date = date("Y-m-d", time());
    //获得页面代码
    echo "http://srh.bankofchina.com/search/whpj/search.jsp?erectDate=".$date."&nothing=".$date."&pjname=1316&page=1";exit;
    $data = file_get_contents("http://srh.bankofchina.com/search/whpj/search.jsp?erectDate=".$date."&nothing=".$date."&pjname=1316&page=1");
    //去掉非字符
    $data = str_replace(array(" ","\r","\n","\t"), "", $data);
    //得到汇率代码
    preg_match('/<tr>[\s]*<td>美元<\/td>[\s]*<td>[\s|\S]*<\/td>[\s]*<\/tr>/',$data, $converted);
    //开始各种调整格式，为了整理为数组
    $data = str_replace("</tr><tr>", ";", $converted[0]);
    $data = str_replace(array("<tr>","</tr>"), "", $data);
    $data = str_replace("</td><td>", ",", $data);
    $data = str_replace(array("<td>","</td>"), "", $data);
    $rateList = explode(";", $data);
    $rate = explode(",", $rateList[0]);
    //$rate [0] 国家 [1] 现汇买入价 [2]现钞买入价[3]现汇卖出价[4]现钞卖出价[5]外管局中间价[6]中行折算价
    $rate = $rate[3];
    $rate = round(($rate/100),2);
    if(is_numeric($rate))return $rate;
    else return false;
}


echo getExchangeRate();

