//获取默认配置
$config = new \Screenshot\Config();

//修改默认端口号（修改配置）
$config->setPort(8080);

//修改默认端图片宽度
$config->setWidth(600);

//修改默认端图片高度
$config->setHeight(800);

//开启JavaScript支持（开启后将可以解析页面中js代码，对于js生成的页面可以截取）
$config->setJavascriptEnabled(true);

//用配置文件初始化截图服务（不传$config会走默认配置）
$screenshot = new \Screenshot\ScreenShot($config);

//生成截图服务并截取百度图片
$screenshot->shot('http://image.baidu.com');

//开启截图服务
$screenshot->start();
