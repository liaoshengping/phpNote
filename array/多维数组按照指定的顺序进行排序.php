<?php
$data = array(
    array( 'title' => '区块链'),
    array('title' => '股票'),
    array( 'title' => '地摊')
);

$order = array('区块链','股票','地摊','捡垃圾');

$order = array_flip($order);
function cmp($a, $b)
{
    global $order;

    $posA = $order[$a['title']];
    $posB = $order[$b['title']];

    if ($posA == $posB) {
        return 0;
    }
    return ($posA < $posB) ? -1 : 1;
}

usort($data, 'cmp');

var_dump($data);
