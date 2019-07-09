<?php
/**
 *  阻塞模式（后面的进程会一直等待前面的进程执行完毕）
 */
 function crateOrder()
{
    $file = fopen(__DIR__.'/lock.txt','w+');
    //加锁
   flock($file,LOCK_EX);
//    {
        sleep(100);
//        echo 'kkk';
//        //TODO 执行业务代码
//        flock($file,LOCK_UN);//解锁
//    }
//    //关闭文件
//    fclose($file);
}

crateOrder();
