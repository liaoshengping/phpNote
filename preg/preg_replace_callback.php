<?php
//例子1.1
$str = 'dfadfas7[不要的内容,但该内容不确定，只是用中括号括着]fadsfdsfadfsdaf';
$str = preg_replace('/(.*?)(7\[.*\])(.*)/', '${2}', $str);
//例子1：


// Define a dummy text, for testing...
$Text = "Title: Hello world!\n";
$Text .= "Author: Jonas\n";
$Text .= "This is a example message!\n\n";
$Text .= "Title: Entry 2\n";
$Text .= "Author: Sonja\n";
$Text .= "Hello world, what's up!\n";
// This function will replace specific matches
// into a new form
function RewriteText($Match){
    // Entire matched section:
    // --> /.../
    $EntireSection = $Match[0];
    // --> "\nTitle: Hello world!"
    // Key
    // --> ([a-z0-9]+)
    $Key      = $Match[1];
    // --> "Title"
    // Value
    // --> ([^\n\r]+)
    $Value    = $Match[2];
    // --> "Hello world!"
    // Add some bold (<b>) tags to around the key to
    return '<b>' . $Key . '</b>: ' . $Value;
}
// The regular expression will extract and pass all "key: value" pairs to
// the "RewriteText" function that is definied above
$NewText = preg_replace_callback('/[\r\n]([a-z0-9]+): ([^\n\r]+)/i', "RewriteText", $Text);
// Print the new modified text
print $NewText;


//例子二


// 将文本中的年份增加一年.
$text = "April fools day is 04/01/2002\n";
$text .= "Last christmas was 12/24/2001\n";
// 回调函数
function next_year($matches)
{
    // 通常: $matches[0]是完成的匹配
    // $matches[1]是第一个捕获子组的匹配
    // 以此类推
    return $matches[1] . ($matches[2] + 1);
}

echo preg_replace_callback(
    "|(\d{2}/\d{2}/)(\d{4})|",
    "next_year",
    $text);

