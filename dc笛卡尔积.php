<?php


/**
 * 计算多个集合的笛卡尔积
 * @param Array $sets 集合数组
 * @return Array
 */

function CartesianProduct($sets)
{
    $result = array();
    // 循环遍历集合数据
    for ($i = 0, $count = count($sets); $i < $count - 1; $i++) {
        if ($i == 0) {
            $result = $sets[$i];
        }

        $tmp = array();
        // 结果与下一个集合计算笛卡尔积
        foreach ($result as $res) {
            foreach ($sets[$i + 1] as $set) {
                $tmp[] = $res . $set;
            }
        }
        $result = $tmp;
    }
    return $result;
}

// 定义集合
$sets = array(
    array(
        '透气',
        '防滑',
    ),
    array(
        '37码',
        '38码',
        '39码',
    ),
    array(
        '男款',
        '女款',
    ),
);

$result = CartesianProduct($sets);
echo "<pre>";
print_r($result);
