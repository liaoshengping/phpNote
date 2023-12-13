<?php


use Swow\Coroutine;
use Swow\Sync\WaitGroup;


function work3($url): void
{
    echo '处理了一个';
    file_put_contents(md5($url) . '.html', file_get_contents($url));
}

$wg = new WaitGroup();

$arr = [
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
    'http://www.baidu.com',
//    'https://jj.dmjvip.com/agent/channel/list',
//    'https://jj.dmjvip.com/agent/channel/list',
];

// $wg->add(3); // 这么写也可以

foreach ($arr as $item) {
    $wg->add();
    Coroutine::run(static function () use ($item, $wg): void {
        work3($item);
        $wg->done();
    });
}


echo "Wait...\n";
$wg->wait();
echo "Done\n";
