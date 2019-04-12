<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>根据微博类型查询微博</title>
    <style>
        .tips {
            color: blue;
        }
    </style>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: eeatem
 * Date: 2019-04-12
 * Time: 13:48
 * Func: 通过类型查找我的关注用户的微博分页模块
 */
    error_reporting(E_ALL ^ E_NOTICE);
    include 'connection.php';
    session_start();
    $userName  = $_SESSION['followUserTemp'];
    $isManager = $_SESSION['isManager'];
    $weiboType = $_SESSION['weiboType'];

    // 翻页模块
    // 定义每一页显示多少条微博
    $pageSize = 3;
    // 获取要翻页文件的路径
    $url = $_SERVER['REQUEST_URI'];
    $url = parse_url($url);
    $url = $url['path'];
    // 获取微博总条数
    if ($isManager == 1) {
        if ($weiboType == '所有类型') {
            $sql = "select * from t_weibo_record";
        } else {
            $sql = "select * from t_weibo_record where weibo_type='$weiboType'";
        }
    } else {
        if ($weiboType == '所有类型') {
            $sql = "select * from t_weibo_record where user_name='$userName'";
        } else {
            $sql = "select * from t_weibo_record where user_name='$userName' and weibo_type='$weiboType'";
        }
    }
    $result = mysqli_query($connect, $sql);
    $num    = mysqli_num_rows($result);
    // 计算总页数
    if ($num % $pageSize == 0) {
        $pagenum = $num / $pageSize;
    } else {
        $pagenum = (int)($num / $pageSize) + 1;
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

<?php
    echo "<a href='myfollow_list_weibo_by_type.php'><input type=\"button\" value=\"继续查找\"/></a>&nbsp;";
    if ($isManager == 1) {
        echo "<a href='temp_m.php'><input type='button' value='返回菜单'/></a><br><br>";
    } else {
        echo "<a href='temp.php'><input type='button' value='返回菜单'/></a><br><br>";
    }
?>

<table width="500" border="0" cellpadding="5" cellspacing="1" bgcolor="#add3ef">

    <?php
            if ($weiboType == '所有类型') {
                $sql = "select * from t_weibo_record where user_name='$userName' limit $page $pageSize";
            } else {
                $sql = "select * from t_weibo_record where user_name='$userName' 
                                  and weibo_type='$weiboType' limit $page $pageSize";
            }
            $result = mysqli_query($connect, $sql);
            while ($row = mysqli_fetch_array($result)) {
    ?>
                <tr bgcolor="#eff3ff">
                    <td>类型：<?= $row['weibo_type']; ?> —— 点赞数：<?= $row['praise']; ?>&emsp;<a href="like_mlwbt.php?id=<?= $row['id']; ?>"><input type="button" value="点赞"></a></td>
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