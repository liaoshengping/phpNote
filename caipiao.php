<?php

include ("vendor/autoload.php");

function curl_get_contents($url, $timeout = 60) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
    $result = curl_exec_utf8($ch);
    curl_close($ch);
    return $result;
}

function curl_exec_utf8($ch) {
    $data = curl_exec($ch);
    if (!is_string($data))
        return $data;

    unset($charset);
    $content_type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

    /* 1: HTTP Content-Type: header */
    preg_match('@([\w/+]+)(;\s*charset=(\S+))?@i', $content_type, $matches);
    if (isset($matches[3]))
        $charset = $matches[3];

    /* 2: <meta> element in the page */
    if (!isset($charset)) {
        preg_match( '@<meta\s+http-equiv="Content-Type"\s+content="([\w/]+)(;\s*charset=([^\s"]+))?@i', $data, $matches );
        if ( isset( $matches[3] ) ) {
            $charset = $matches[3];
            /* In case we want do do further processing downstream: */
            $data = preg_replace('@(<meta\s+http-equiv="Content-Type"\s+content="[\w/]+\s*;\s*charset=)([^\s"]+)@i', '$1utf-8', $data, 1);
        }
    }

    /* 3: <xml> element in the page */
    if (!isset($charset)) {
        preg_match( '@<\?xml.+encoding="([^\s"]+)@si', $data, $matches );
        if ( isset( $matches[1] ) ) {
            $charset = $matches[1];
            /* In case we want do do further processing downstream: */
            $data = preg_replace('@(<\?xml.+encoding=")([^\s"]+)@si', '$1utf-8', $data, 1);
        }
    }

    /* 4: PHP's heuristic detection */
    if (!isset($charset)) {
        $encoding = mb_detect_encoding($data);
        if ($encoding)
            $charset = $encoding;
    }

    /* 5: Default for HTML */
    if (!isset($charset)) {
        if (strstr($content_type, "text/html") === 0)
            $charset = "ISO 8859-1";
    }

    /* Convert it if it is anything but UTF-8 */
    /* You can change "UTF-8"  to "UTF-8//IGNORE" to
      ignore conversion errors and still output something reasonable */
    if (isset($charset) && strtoupper($charset) != "UTF-8")
        $data = iconv($charset, 'UTF-8', $data);

    return $data;
}

$html = curl_get_contents('https://m.78500.cn/zs/ssq/');


function removeBOM($str = '')
{
    if (substr($str, 0,3) == pack("CCC",0xef,0xbb,0xbf)) {
        $str = substr($str, 3);
    }
    return $str;
}
echo $html;exit;
function writeUTF8File($filename,$content)
{
    $f = fopen($filename, 'w');
    fwrite($f, pack("CCC", 0xef,0xbb,0xbf));
    fwrite($f,$content);
    fclose($f);
}

str_replace('<meta charset="gb2312">','',$html);

$html = removeBOM($html);



//var_dump($data);exit;
//
////$htmlj = file_get_contents('https://m.78500.cn/zs/ssq/');
////
//var_dump($html);exit;
//
//
//
writeUTF8File(__DIR__.'/ssq2.html',$html);