<?php
require __DIR__ . '/config.php';
use JMessage\IM\Friend;

$friend = new Friend($jm);
$user = 'liaosp';
$friends = ['test'];

echo "list friends: \n";
$response = $friend->listAll($user);
print_r($response);
echo "\n";//

echo "add friends: \n";
$response = $friend->add($user, $friends);
print_r($response);
echo "\n";

echo "list friends: \n";
$response = $friend->listAll($user);
print_r($response);
echo "\n";

echo "update notename of friends: \n";
$response = $friend->updateNotename($user, [
    [
        'username' => 'test',
        'note_name' => 'test',
        'others' => 'good friend'
    ]
]);
print_r($response);
echo "\n";

echo "list friends: \n";
$response = $friend->listAll($user);
print_r($response);
echo "\n";

echo "remove friends: \n";
$response = $friend->remove($user, $friends);
print_r($response);
echo "\n";
