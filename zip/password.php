<?php

// 创建一个新的ZIP文件
$zip = new ZipArchive();
//$dir = 'D:\BaiduNetdiskDownload\34省考+国考PDF\34省考+国考PDF（推荐打印用）\34省行测+申论真题pdf';
$dir = 'D:\BaiduNetdiskDownload\34省考+国考PDF\34省考+国考PDF（推荐打印用）\34省行测+申论真题pdf';
$zipFilePath = 'D:\BaiduNetdiskDownload\34省考+国考PDF\first.zip';




// 如果压缩包创建成功
if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {

    $password = '1212'; // 设置你的密码

    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir),
        RecursiveIteratorIterator::LEAVES_ONLY
    );
    foreach ($files as $name => $file)
    {
        // Skip directories (they would be added automatically)
        if (!$file->isDir())
        {
            // Get real and relative path for current file
            $filePath = $file->getRealPath();

            $relativePath = substr($filePath, strlen($dir) + 1);
            // Add current file to archive
            $relativePath = str_replace('\\','/',$relativePath);
            $zip->addFile($filePath, $relativePath);
            $zip->setEncryptionName($relativePath, ZipArchive::EM_AES_256);
        }
    }

    $zip->setPassword($password);

    // 关闭ZIP文件
    $zip->close();

    echo "压缩包创建成功并设置了密码！";
} else {
    echo "创建压缩包失败！";
}