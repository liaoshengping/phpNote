<?php
//$url="'/index.php?main_page=index&cPath=55&pagesize=48'";
//$pos1=strpos($url,'&pagesize');//搜索&pagesize第一次出现的位置
//echo substr($url,0,$pos1);//由于&pagesize=48是url的最后，所以可以截取字符串
$keys =array(
    array('网页特效','/js_a/js.html'),
    array('seo','/seo/seo.html'),
    array('php','/phper/php.html'),
    array('jsp','/jsp/jsp.html'),
    array('asp','/asp/asp.html'),
    array('ps','/fw/photo.html'),
    array('photoshop','/fw/photo.html'),
    array('javascript','/js_a/js.html'),
    array('.net','/net/net.html'),
    array('非主流','/fw/photo.html'),
    array('网络','/mon/mon.html'),
    array('css','/cssdiv/css.html'),
    array('平面设计','/fw/photo.html'),
    array('网站','/person/'),
    array('网页制作','/wy/yw.html'),
    array('搜索引擎','/seo/seo.html'),
    array('优化','/seo/seo.html'),
    array('动画','/flash_a/flash.html'),
    array('数据库','/database/database.html'),
    array('挣钱','/mon/mon.html'),
    array('运营','/mon/mon.html')
);
$str ="今天是2010年5月30号,我的网站出现的问题这对seo有很多的问题,seo就是搜索引擎优化了,以前学php好啊现在觉得jsp 好,css+div,网页,网页设计,网页制作,网页学习,网页教 学,Photoshop,Flash,HTML,CSS,Dreamweaver,Fireworks,ASP,PHP,JSP,ASP.NET,网站建 设,网站开发,网页特效,平面设计,个人网站,网页素材";

//echo $str,"<br>";
foreach($keys as $nkeys){
    //print_r($nkeys);echo"<br>";
    //foreach( $nkeys as $join) {
    //echo($join),"<br>";
    if(strpos($str,$nkeys[0]) ){
        $str =str_replace($nkeys[0],"<a href=http://www.****.com.cn".$nkeys[1]." target=_blank >".$nkeys[0]."</a>",$str);
    }
    //}
}

echo $str;
