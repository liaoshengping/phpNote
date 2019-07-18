<?php
// 将文本中的年份增加一年.
//$text = "April fools day is 04/01/2002\n";
$text = '111<img data-src="234sdfasdfad">222';
$text .= '111<img data-src="234sdfasdfad">222';
//$text.='<img src="ksdjflksjdlf">';
//echo $text;exit;
//$str = 'dfadfas7[不要的内容,但该内容不确定，只是用中括号括着]fadsfdsfadfsdaf';
//$str = preg_replace('/(\<.*\>)/', '${1}', $text);
//echo $str."\n";
function next_year($matches)
{
//    var_dump($matches);
    $string = $matches[0];
    preg_replace_callback('/data-src=\"([^(\}>)]+)\"/',function ($match)use(&$url){
        $url = $match[1];
        $url= 'fangdao.php?url='.$url;
    },$string);
    return '<img data-src="'.$url.'">';
//    return $string;
//    return 'laji';
    // 通常: $matches[0]是完成的匹配
    // $matches[1]是第一个捕获子组的匹配
    // 以此类推
//    return $matches[1] . ($matches[2] + 1);

}

//echo preg_replace_callback(
//    "/(\<img data-src.*\>)/",
//    "next_year",
//    $text);
$text = '111<img data-src="234sdfasdfad">222';
$text .= '333<img data-src="234sdfasdfad">444';
$content_html = preg_replace_callback('/data-src="(.*?)"/', function($matches){
    return 'data-src=http://phpnote.text?url='.urlencode($matches[1]);
}, $text);
echo $content_html;
