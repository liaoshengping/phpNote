<?php


require_once("../vendor/autoload.php");

use Phpml\Classification\NaiveBayes;

// 定义训练数据集和标签
$samples = [
    'I love PHP programming language',
    'Java is a popular programming language',
    'Python is a widely used programming language',
    'JavaScript is used for web development'
];
$labels = ['php', 'java', 'python', 'javascript'];

// 初始化朴素贝叶斯分类器
$classifier = new NaiveBayes();

// 使用数据集和标签对分类器进行训练
$classifier->train($samples, $labels);

// 对新语句进行预测
$prediction = $classifier->predict(['PHP is my favorite programming language']);

// 输出预测结果
echo $prediction; // 输出 'php'
