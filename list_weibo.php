<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>查询微博</title>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/27
 * Time: 18:57
 * Func: 按用户名查询微博
 */
session_start();
$userName=$_SESSION['userNameTemp'];
include 'connection.php';
?>

<table width=500 border="0" cellpadding="5" cellspacing="1" bgcolor="#add3ef">
    <?php
    $sql="select `weibo_type`,`weibo_content` from t_weibo_record where user_name='$userName'";
    $result=mysqli_query($connect,$sql);
        while($row=mysqli_fetch_array($result)){
    ?>
            <tr bgcolor="#eff3ff">
                <td>类型：<?=$row['weibo_type']; ?> </td>
            </tr>
            <tr bgcolor="#ffffff">
                <td>正文：<?=$row['weibo_content']; ?> </td>
            </tr>
        <?
        }
        ?>
</table>
</body>
</html>
