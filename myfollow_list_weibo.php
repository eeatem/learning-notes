<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>查询微博</title>
    <style>
        .tips{color:blue;}
    </style>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: eeatem
 * Date: 2019-04-12
 * Time: 13:20
 * Func: 显示我关注的用户的微博
 */
    error_reporting(E_ALL ^ E_NOTICE);
    include 'connection.php';
    session_start();
    $userName=$_SESSION['followUserTemp'];
    // echo $userName;
    $isManager = $_SESSION['isManager'];

    echo "<br><a href='myfollow_list_weibo_by_type.php'><input type='button' value='根据类型查找微博'></a>&nbsp;";
    echo "<a href='myfollow_list_weibo_by_keyword.php'><input type='button' value='根据关键字查找微博'></a>&nbsp;";
    echo "<a href='myfollow.php'><input type='button' value='返回'></a>";
    // 检测用户是否为管理员
    if ($isManager == 0) {
        echo "<a href='temp.php'><input type='button' value='返回菜单'/></a><br>";
    } else {
        echo "<a href='temp_m.php'><input type='button' value='返回菜单'/></a><br>";
    }
    ?>

    <?php
    // 翻页模块
    // 定义每一页显示多少条微博
    $pageSize = 3;
    // 获取要翻页文件的路径
    $url = $_SERVER['REQUEST_URI'];
    $url = parse_url($url);
    $url = $url['path'];
    // 获取微博总条数
    $sql    = "select * from t_weibo_record where user_name='$userName'";
    $result = mysqli_query($connect, $sql);
    $num    = mysqli_num_rows($result);
    // 计算总页数
    if ($num%$pageSize==0){
        $pagenum=$num/$pageSize;
    }else{
        $pagenum=(int)($num/$pageSize)+1;
    }
    // 翻页公式
    if ($_GET['page']) {
        $pageval = $_GET['page'];
        $page    = ($pageval - 1) * $pageSize;
        $page    .= ',';
    }
    // 判断是否为第一页
    if ($num > $pageSize) {
        if ($pageval <= 1) {
            $pageval = 1;
            echo "<br />共 <span class='tips'>$num</span> 条微博 第 <span class='tips'>$pageval</span> 页 | 共 <span class='tips'>$pagenum</span> 页";
            echo "&nbsp;<a href=$url?page=" . ($pageval + 1) . "><input type='button' value='下一页'/></a>";
        } else if ($pageval >= $num / $pageSize) { //判断是否为最后一页
            echo "<br />共 <span class='tips'>$num</span> 条微博 第 <span class='tips'>$pageval</span> 页 | 共 <span class='tips'>$pagenum</span>  页";
            echo "&nbsp;<a href=$url?page=" . ($pageval - 1) . "><input type='button' value='上一页'/></a> ";
            echo "&nbsp;<a href=$url?page=0><input type='button' value='回到首页'></a>";
        } else {
            echo "<br />共 <span class='tips'>$num</span> 条微博 第 <span class='tips'>$pageval</span> 页 | 共 <span class='tips'>$pagenum</span>  页";
            echo "&nbsp;<a href=$url?page=" . ($pageval - 1) . "><input type='button' value='上一页'/></a> ";
            echo "&nbsp;<a href=$url?page=" . ($pageval + 1) . "><input type='button' value='下一页'/></a>";
        }
    }
?>

<table width=500 border="0" cellpadding="5" cellspacing="1" bgcolor="#add3ef">

    <?php
        $sql    = "select * from t_weibo_record where user_name='$userName' limit $page $pageSize";
        $result = mysqli_query($connect, $sql);
        while ($row = mysqli_fetch_array($result)) {
    ?>
        <tr bgcolor="#eff3ff">
            <td>类型：<?= $row['weibo_type']; ?> —— 点赞数：<?= $row['praise']; ?>&emsp;<a href="like_mlw.php?id=<?= $row['id']; ?>"><input type="button" value="点赞"></a></td>
        </tr>
        <tr bgcolor="#ffffff">
            <td>正文：<?= $row['weibo_content']; ?> </td>
        </tr>
    <?php
        }
    ?>

</table>
</body>
</html>
