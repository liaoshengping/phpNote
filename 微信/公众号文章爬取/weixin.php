
<?php
//$content_url 变量的值为文章地址
$content_url = 'https://mp.weixin.qq.com/s/QCD95DCsGngqfUyrJGnXdw';
$html = file_get_contents($content_url);

preg_match_all("/id=\"js_content\">(.*)<script/iUs",$html,$content,PREG_PATTERN_ORDER);
$content = "<p id='js_content'>".$content[1][0];
//$content变量的值是前面获取到的文章内容html
$content = str_replace("data-src","src",$content);
preg_match_all('/var nickname = \"(.*?)\";/si',$html,$m);
$nickname = $m[1][0];//公众号昵称
preg_match_all('/var round_head_img = \"(.*?)\";/si',$html,$m);
$head_img = $m[1][0];//公众号头像
//$content变量的值是前面获取到的文章内容html
$content = str_replace("preview.html","player.html",$content);
file_put_contents('test.html',$content);
echo $head_img;exit;
echo $content;
