<?php


include("./vendor/autoload.php");
$word = '麒麟9000S';
$url = 'https://image.baidu.com/search/index?tn=baiduimage&ipn=r&ct=201326592&cl=2&lm=-1&st=-1&fm=result&fr=&sf=1&fmq=1704506869590_R&pv=&ic=&nc=1&z=&hd=&latest=&copyright=&se=1&showtab=0&fb=0&width=&height=&face=0&istype=2&dyTabStr=MCwzLDEsMiw2LDQsNSw4LDcsOQ%3D%3D&ie=utf-8&sid=&word=' . urlencode($word) . '&f=3&oq=&rsp=-1';

//file_put_contents('test.png',file_get_contents('https://img1.baidu.com/it/u=2574972620,1754170611&fm=253&fmt=auto&app=120&f=JPEG?w=1050&h=800'));


$data = \QL\QueryList::get($url);

$data = $data->getHtml();

$startString = "imgData";
$endString = "fcadData";

// 构建正则表达式
$pattern = '/' . preg_quote($startString, '/') . '(.*?)' . preg_quote($endString, '/') . '/s';


//$pattern = '/imgData (.*?) albumBannerData/';

preg_match($pattern, $data, $matches);
$matches = str_replace("imgData', ", '', $matches);
$matches = str_replace("app.setData(", '', $matches);

// 查找要删除的字符串及其后面的内容
$position = strpos($matches[0], 'fcadData');
if ($position !== false) {
    // 删除匹配项及其后的内容
    $matches = substr($matches[0], 0, $position);
} else {
    throw new Exception("未找到匹配项");
}

$matches = trim($matches);

$matches = substr($matches, 0, -8);

$data = json_decode($matches, true);
$data = $data['data'];


foreach ($data as $key => $item) {
    $wordPath = __DIR__ . '/图片/' . $word;
    if (!is_dir($wordPath)) {
        mkdir($wordPath);
    }
    $file = file_get_contents($item['replaceUrl'][0]['ObjURL']);
    if (!$file) {
        continue;
    }
    file_put_contents($wordPath . '/' . $word . $key . '.png', $file);
}

echo '采集成功';