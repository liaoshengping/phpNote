<?php

// 数据库连接信息
$host = "10.22.139.3";
$user = "root";
$password = "ivas_admin";
$dbname = "ivas";

// 创建数据库连接
$conn = mysqli_connect($host, $user, $password, $dbname);

// 检查连接是否成功
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
}

// 定义查询时间参数变量
$start_time = date('Y-m-d').' '.'07:00:00';
$end_time = date('Y-m-d').' '.'23:00:00';

$month = date('m');

// 执行 SQL 查询语句,查询进馆人数
$sql_in = "SELECT SUM(in_num) as in_num FROM t".date("Y")."_".$month."_ivas_1 WHERE record_time BETWEEN '".$start_time."' AND '".$end_time."';";
$result_in = mysqli_query($conn, $sql_in);
$in_num = mysqli_fetch_assoc($result_in)['in_num'];

// 如果没人进馆，则显示0
if(empty($in_num)) {
    $in_num = 0;
}

// 执行 SQL 查询语句,查询出馆人数
$sql_out = "SELECT SUM(out_num) as out_num FROM t".date("Y")."_".$month."_ivas_1 WHERE record_time BETWEEN '".$start_time."' AND '".$end_time."';";
$result_out = mysqli_query($conn, $sql_out);
$out_num = mysqli_fetch_assoc($result_out)['out_num'];

// 进馆人数-出馆人数=在馆人数
$now_num = $in_num - $out_num;
$now_num = $now_num < 0 ? 0: $now_num ;

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>游客数据</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        h1 {
            font-size: 100px;
            margin-top: 50px;
        }

        .number {
            font-size: 150px;
            margin-top: 20px;
        }

        .label {
            font-size: 70px;
        }

        .data {
            margin: auto;
            width: 50%;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>儿童馆</h1>
    <div class="data">
        <p class="label">进馆：</p>
        <p class="number" style="color: red;"><?= $in_num ?></p>
        <p class="label">在馆：</p>
        <p class="number" style="color: red;"><?= $now_num ?></p>
    </div>
</body>
<script>
    setTimeout(function (){
        location.reload()
    },5000)
</script>
</html>