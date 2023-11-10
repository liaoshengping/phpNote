<?php


$dir = 'D:\BaiduNetdiskDownload\测试';
$target = 'D:\BaiduNetdiskDownload\测试结果';

// 设置密码
$password = 'es56d'; // 设置你的密码



$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($dir),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file) {
    var_dump($file->getRealPath());
}

exit;




$packageList = scandir($dir);


foreach ($packageList as $item) {



    $zipFilePath = $target.'\\'.$item.'.zip';

    // 创建一个新的ZIP文件
    $zip = new ZipArchive();
    // 如果压缩包创建成功
    if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($newDir),
            RecursiveIteratorIterator::LEAVES_ONLY
        );
        foreach ($files as $name => $file) {
            // Skip directories (they would be added automatically)
            if (!$file->isDir()) {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($newDir) + 1);
                echo $relativePath . PHP_EOL;
                // Add current file to archive
                $zip->addFile($filePath, $relativePath);

//                $zip->setEncryptionName($relativePath, ZipArchive::EM_AES_256);
            }
        }

        $zip->setPassword($password);

        // 关闭ZIP文件
        $zip->close();

        echo "压缩包创建成功并设置了密码！";
    } else {
        echo "创建压缩包失败！";
    }
}



// foreach (scandir($target) as $fileItem){
//
//     if (in_array($fileItem,['.','..'])) continue;
//     $zip = new ZipArchive();
//     $zip->open($target.'\\'.$fileItem, ZipArchive::CREATE | ZipArchive::OVERWRITE);
//
//     $zip->addFile($target.'\\'.$fileItem, $fileItem);
//     $zip->setEncryptionName($fileItem, ZipArchive::EM_AES_256);
//     $zip->setPassword($password);
//     $zip->close();
// };


