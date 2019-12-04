<?php

$heap = new SplMaxHeap(); # 最大堆 升序输出
$heap->insert('E');
$heap->insert('B');
$heap->insert('D');
$heap->insert('A');
$heap->insert('C');

echo $heap->extract(), PHP_EOL; # E
echo $heap->extract(), PHP_EOL; # D

$heap = new SplMinHeap(); # 最小堆 降序输出
$heap->insert('E');
$heap->insert('B');
$heap->insert('D');
$heap->insert('A');
$heap->insert('C');

print PHP_EOL;
echo $heap->extract(), PHP_EOL; # A
echo $heap->extract(), PHP_EOL; # B

