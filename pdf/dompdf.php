<?php

include ('vendor/autoload.php');

use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml('hello world');
$dompdf->render();

// 将PDF文件保存为图片
$image = $dompdf->output();

file_put_contents('output.jpg', $image); // 保存为PNG格式的图片文件
