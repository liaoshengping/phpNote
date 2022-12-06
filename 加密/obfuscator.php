<?php
require_once("../vendor/autoload.php");

$sData = <<<'DATA'
    $hour = date('H');

    echo 'The hour (of the server) is ' . date('H:m');
    echo ', and will give the following message:<br><br>';

    if ($hour < 10) {
        echo 'Have a good morning!';
    } elseif ($hour < 20) {
        echo 'Have a good day!';
    } else {
        echo 'Have a good night! zZz z';
    }
    echo "im 'liaosp ";
DATA;

$sObfusationData = new Obfuscator($sData, 'key');
file_put_contents('obfuscated_code.php', '<?php ' . "\r\n" . $sObfusationData);



/**
 * 使用scandir 遍历目录
 *
 * @param $path
 * @return array
 */
function getDir($path)
{
    //判断目录是否为空
    if(!file_exists($path)) {
        return [];
    }

    $files = scandir($path);
    $fileItem = [];

    foreach($files as $v) {
        $newPath = $path .DIRECTORY_SEPARATOR . $v;
        if(is_dir($newPath) && $v != '.' && $v != '..') {
            $fileItem = array_merge($fileItem, getDir($newPath));
        }else if(is_file($newPath)){
            $fileItem[] = $newPath;
        }
    }

    return $fileItem;
}

//调用
echo('遍历目录开始');
$path = realpath('D:\linuxdir\php\linxia-huichongapi\config');

foreach (getDir($path) as $value){

    if (!strstr($value,'.php')) continue;

    $sdata = file_get_contents($value);

    $sdata = str_replace('<?php','',$sdata);

    $sObfusationData = new Obfuscator($sdata, 'encode');

    file_put_contents($value, '<?php ' . "\r\n" . $sObfusationData);
}
