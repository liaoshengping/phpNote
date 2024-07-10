<?php

// IMAP服务器设置
$hostname = '{imap.163.com:993/imap/ssl}INBOX'; // IMAP服务器地址和端口，使用SSL
$username = '15080206817@163.com'; // 你的163邮箱地址
$password = 'aa0597'; // 你的163邮箱密码

// 尝试连接到IMAP服务器
$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to 163: ' . imap_last_error());

// 检查是否有邮件
if ($emails = imap_search($inbox, 'ALL')) {
    // 如果有邮件，则遍历它们
    rsort($emails);
    foreach ($emails as $email_number) {
        // 获取邮件头信息
        $overview = imap_fetch_overview($inbox, $email_number, 0);
        $message = imap_fetchbody($inbox, $email_number, 2); // 获取邮件正文

        // 打印邮件的一些基本信息
        echo 'Subject: ' . $overview[0]->subject . "<br>\n";
        echo 'From: ' . $overview[0]->from . "<br>\n";
        echo 'Date: ' . $overview[0]->date . "<br>\n";
        echo 'Body: ' . nl2br($message) . "<br>\n";
        echo "<hr>";
    }
} else {
    echo "No emails found!\n";
}

// 关闭IMAP流
imap_close($inbox);
