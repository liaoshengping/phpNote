<?php

require_once("../vendor/autoload.php");

$mpdf = new \Mpdf\Mpdf();
$mpdf->autoScriptToLang = true;
$mpdf->autoLangToFont = true;
$mpdf->WriteHTML('<h1>Hello world! 我的朋友</h1>');
$mpdf->Output();
