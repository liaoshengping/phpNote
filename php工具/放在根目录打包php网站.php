<?php
set_time_limit(0);

{
    $zip = new ZipArchive();
    $filename = "./".date("Y-m-d")."_".md5(time())."_lzso.zip";
    if ($zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {
        exit("无法创建 <$filename>\n");
    }
    $files = listdir();
    foreach($files as $path)
    {
        $zip->addFile($path,str_replace("./","",str_replace("\\","/",$path)));
    }
    echo "压缩完成，共压缩了: " . $zip->numFiles . "个文件\n";
    $zip->close();
}
Function listdir($start_dir='.') {
    $files = array();
    if (is_dir($start_dir)) {
        $fh = opendir($start_dir);
        while (($file = readdir($fh)) !== false) {
            if (strcmp($file, '.')==0 || strcmp($file, '..')==0) continue;
            $filepath = $start_dir . '/' . $file;
            if ( is_dir($filepath) )
                $files = array_merge($files, listdir($filepath));
            else
                array_push($files, $filepath);
        }
        closedir($fh);
    } else {
        $files = false;
    }
    return $files;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" >
<html>
<head>
    <title>专属打包工具  阆中搜版权所有！</title>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
</head>
<body>
<form name="form1" method="post" action="">
    <hr size="1">
    <h3><a href="http://www.lzso.com">支持一下主页</a></h3>
    <P> <input type="submit" name="button" value="点击这里继续打包！" /></P>
    <P>说明：点开始打包，之后，就是耐心等待打包完成了，根据网站文件多少，需要的时间可能会很长。打包完成之后，压缩包会存放在要打包的站点目录下，以<span style='color:red;'>打包时间+不定长随机字符串+lzso.zip</span>这样命名，请登陆ftp后下载。</P>
</form>
</body>
</html>
