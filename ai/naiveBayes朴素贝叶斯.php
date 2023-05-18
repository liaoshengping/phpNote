<?php


require_once("../vendor/autoload.php");
use Phpml\Classification\NaiveBayes;

// 训练数据集
$dataset = [
    [1, 'sunny', 85, 'FALSE', 'no'],
    [2, 'sunny', 80, 'TRUE', 'no'],
    [3, 'overcast', 83, 'FALSE', 'yes'],
    [4, 'rainy', 70, 'FALSE', 'yes'],
    [5, 'rainy', 68, 'FALSE', 'yes'],
    [6, 'rainy', 65, 'TRUE', 'no'],
    [7, 'overcast', 64, 'TRUE', 'yes'],
    [8, 'sunny', 72, 'FALSE', 'no'],
    [9, 'sunny', 69, 'FALSE', 'yes'],
    [10, 'rainy', 75, 'FALSE', 'yes'],
    [11, 'sunny', 75, 'TRUE', 'yes'],
    [12, 'overcast', 72, 'TRUE', 'yes'],
    [13, 'overcast', 81, 'FALSE', 'yes'],
    [14, 'rainy', 71, 'TRUE', 'no']
];

// 分类目标值
$targets = ['no', 'no', 'yes', 'yes', 'yes', 'no', 'yes', 'no', 'yes', 'yes', 'yes', 'yes', 'yes', 'no'];

// 创建朴素贝叶斯分类器
$classifier = new NaiveBayes();

// 使用训练数据集和分类目标值拟合分类器
$classifier->train($dataset, $targets);

// 预测新的样本
$sample = [2, 'rainy', 72, 'FALSE'];
$predicted = $classifier->predict([$sample]);

print_r($predicted);