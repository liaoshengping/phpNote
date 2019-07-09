<?php
/**
 *  非阻塞模式（只要当前文件有锁存在，那么直接返回）
 */
function crateOrder()
{
    $file = fopen(__DIR__.'/lock.txt','w+');
    //加锁
    if(flock($file,LOCK_EX|LOCK_NB))
    {
        echo '关闭';
        //TODO 执行业务代码
        flock($file,LOCK_UN);//解锁
    }else{
        echo '正在打开';
    }
    //关闭文件
    fclose($file);

}
crateOrder();
