<?php

// 初始资金
$initialBalance = 1000;
// 当前资金
$currentBalance = $initialBalance;
// 赌注（初始为1）
$bet = 10;
// 倍投次数计数器
$doubleBetCount = 0;
$selectedSide = 0;
// 假设我们随机生成一个结果来模拟赌局（0表示小，1表示大）
// 这里我们简单地用随机数来模拟，你可以根据需要修改这个逻辑
 // 假设你选择了“小”
$count = 0;
// 模拟赌局
do {
    if ($count >= 20){
        break;
    }
    echo '第'.$count.'局'.PHP_EOL;
    $count++;
    // 生成一个随机数（0或1），模拟赌局结果
    $result = rand(0, 1);

    // 判断结果
    if ($result == $selectedSide) {
        // 赢了，增加资金，赢得的金额为投注的0.98倍
        $winAmount = $bet *1.2;
        $currentBalance += $winAmount;
        echo "赢了，赢得{$winAmount}元，当前余额：{$currentBalance}元，继续下一轮。\n";
        $bet = 10; // 重置赌注
        $doubleBetCount = 0; // 重置倍投次数
    } else {
        // 输了，执行倍投
        echo "输了，当前余额：{$currentBalance}元，倍投，赌注变为{$bet}元。\n";
        $currentBalance -= $bet;

        // 检查资金是否足够进行下一次倍投
        if ($currentBalance < $bet) {
            echo "资金不足，无法继续倍投。\n";
            break;
        }

        // 增加倍投次数和赌注
        $doubleBetCount++;
        $bet *= 2;

        // 检查倍投次数是否达到上限
        if ($doubleBetCount >= 5) {
            echo "已达到倍投次数上限，不再倍投。\n";
            $bet = 1;
            $selectedSide = rand(0, 1);
//            break;
        }
    }
} while (true); // 无限循环，直到资金不足或达到倍投次数上限

// 输出最终余额
echo "最终余额：{$currentBalance}元。\n";

?>