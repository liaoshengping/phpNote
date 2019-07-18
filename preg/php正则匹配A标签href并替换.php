<?php

$file = "<a href='http://www.baidu.com'>baidu</a>";
$file = preg_replace('/<a .*?href="(.*?)".*?>/is',"<a href='###'>",$file);
