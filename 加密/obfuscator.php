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

$sObfusationData = new Obfuscator($sData, 'Give a name to the piece of code you want to obfuscate');
file_put_contents('obfuscated_code.php', '<?php ' . "\r\n" . $sObfusationData);
