<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>根据关键字查询微博</title>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/27
 * Time: 23:47
 * Func: 根据正文关键字查询微博
 */
session_start();
include 'connection.php';
$userName=$_SESSION['userNameTemp'];
    // echo $userName;
$keyWord=$_POST['keyWord'];
$keyWord="%$keyWord%";
    // echo $keyWord;
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    请输入微博正文关键字：<br><input type="text" name="keyWord"/>
    <input type="submit" value="查找"/>

        <table width="500" border="0" cellpadding="5" cellspacing="1" bgcolor="#add3ef">
    <?php
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $sql="select `weibo_type`, `weibo_content` from t_weibo_record where user_name='$userName'
                  and weibo_content like '$keyWord'";
            $result=mysqli_query($connect,$sql);
            while($row=mysqli_fetch_array($result)) {
                ?>
                <tr bgcolor="#eff3ff">
                    <td>类型：<?= $row['weibo_type']; ?> </td>
                </tr>
                <tr bgcolor="#ffffff">
                    <td>正文：<?= $row['weibo_content']; ?> </td>
                </tr>
                <?php
            }
        }
                ?>
        </table>
</form>

</body>
</html>




