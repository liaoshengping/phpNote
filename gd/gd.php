<?php
// 创建画布
$width = 600; // 设置画布宽度为200px
$height = 150; // 设置画布高度为150px
$image = imagecreate($width, $height); // 创建空白画布

// 定义颜色
$backgroundColor = imagecolorallocate($image, 255, 255, 255); // 背景色为白色
$textColor = imagecolorallocate($image, 0, 0, 0); // 文本颜色为黑色

// 在画布上添加文字
imagettftext($image, 36, 0, 40, 90, $textColor, 'arial.ttf', "<h1>Hello World!</h1><div>Hello World!</div>"); // 将"Hello World!"写入画布并指定位置、大小等参数

// 输出图像到浏览器或保存到服务器
header('Content-Type: image/png'); // 设置HTTP头部信息，告知浏览器返回PNG格式图像
//imagepng($image); // 直接输出图像到浏览器
 imagepng($image, 'output.png'); // 保存图像到服务器（需要提供路径）

// 清理内存
imagedestroy($image);