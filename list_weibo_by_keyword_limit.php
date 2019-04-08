    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>根据正文关键字查询分页模块</title>
    <style>
        .tips{color:blue;}
    </style>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/3
 * Time: 1:03
 * Func: 根据正文关键字查询微博分页模块
 */
    error_reporting(E_ALL ^ E_NOTICE);
    include 'connection.php';
    session_start();
    $userName=$_SESSION['userNameTemp'];
    $isManager=$_SESSION['isManager'];
    $keyWord=$_SESSION['keyWord'];
    // echo $userName;
    // echo $isManager;
    // echo $keyWord;

    // 翻页模块
    // 定义每一页显示多少条微博
    $pageSize = 3;
    // 获取要翻页文件的路径
    $url = $_SERVER['REQUEST_URI'];
    $url = parse_url($url);
    $url = $url['path'];
    // 获取微博总条数
    if($isManager==1) {
        $sql = "select * from t_weibo_record where weibo_content like '$keyWord'";
    }else{
        $sql="select * from t_weibo_record where user_name='$userName' and weibo_content like '$keyWord'";
    }
    $result = mysqli_query($connect, $sql);
    $num    = mysqli_num_rows($result);
    // 计算总页数
    if ($num%$pageSize==0){
        $pagenum=$num/$pageSize;
    }else {
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
    echo "<a href='list_weibo_by_keyword.php'><input type=\"button\" value=\"继续查找\"/></a>&nbsp;";
    if($isManager==1) {
        echo "<a href='temp_m.php'><input type='button' value='返回菜单'/></a><br><br>";
    }else{
        echo "<a href='temp.php'><input type='button' value='返回菜单'/></a><br><br>";
    }
?>

    <table width="500" border="0" cellpadding="5" cellspacing="1" bgcolor="#add3ef">
        <?php
        // if($_SERVER['REQUEST_METHOD']=="POST") {
            if ($isManager == 0) {
                $sql    = "select `weibo_type`, `weibo_content` from t_weibo_record where user_name='$userName'
                  and weibo_content like '$keyWord' limit $page $pageSize";
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr bgcolor="#eff3ff">
                        <td>类型：<?= $row['weibo_type']; ?> </td>
                    </tr>
                    <tr bgcolor="#ffffff">
                        <td>正文：<?= $row['weibo_content']; ?> </td>
                    </tr>
                    <tr bgcolor="#ffffff">
                        <td><a href="delete.php?id=<?=$row['id']; ?>"><input type="button" value="删除微博"/></a></td>
                    </tr>
                    <?php
                }
            } else {
                $sql    = "select * from t_weibo_record where weibo_content like '$keyWord' limit $page $pageSize";
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr bgcolor="#eff3ff">
                        <td>发送人：<?= $row['user_name']; ?> —— 类型：<?= $row['weibo_type']; ?></td>
                    </tr>
                    <tr bgcolor="#ffffff">
                        <td>正文：<?= $row['weibo_content']; ?> </td>
                    </tr>
                    <tr bgcolor="#ffffff">
                        <td><a href="delete_m.php?id=<?=$row['id']; ?>"><input type="button" value="删除微博"/></a></td>
                    </tr>
                    <?php
                }
            }
        // }
        ?>

    </table>
</form>
</body>
</html>
