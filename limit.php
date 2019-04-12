<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/31
 * Time: 18:27
 * Func: 实现微博分页查询
 */
    include 'connection.php';
    // 定义每一页显示多少条微博
    $pageSize = 3;
    // 获取要翻页文件的路径
    $url = $_SERVER['REQUEST_URI'];
    $url = parse_url($url);
    $url = $url['path'];
    // 获取微博总条数
    $sql    = "select * from t_weibo_record ";
    $result = mysqli_query($connect, $sql);
    $num    = mysqli_num_rows($result);
    // 翻页公式
    if ($_GET['page']) {
        $pageval = $_GET['page'];
        $page    = ($pageval - 1) * $pageSize;
        $page    .= ',';
    }
    // 查询数据库中的微博
    $sql    = "select * from t_weibo_record limit $page $pageSize";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
        echo $row['weibo_content'] . '<br />';
    }
    // 判断是否为第一页
    if ($num > $pageSize) {
        if ($pageval <= 1) {
            $pageval = 1;
            echo "共 $num 条微博";
            echo "<br><a href=$url?page=" . ($pageval + 1) . "><input type='button' value='下一页'/></a>";
        } else if($pageval>=$num/$pageSize){ //判断是否为最后一页
            echo "共 $num 条微博";
            echo "<br><a href=$url?page=" . ($pageval - 1) . "><input type='button' value='上一页'/></a> ";
            echo "<a href=$url?page=0><input type='button' value='回到首页'></a>";
        } else {
            echo "共 $num 条微博";
            echo "<br><a href=$url?page=" . ($pageval - 1) . "><input type='button' value='上一页'/></a> ";
            echo "<a href=$url?page=" . ($pageval + 1) . "><input type='button' value='下一页'/></a>";
        }
    }
?>