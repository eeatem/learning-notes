<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>根据微博类型查询微博</title>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/27
 * Time: 20:46
 * Func: 根据微博类型查询微博
 */
session_start();
include 'connection.php';

$userName=$_SESSION['userNameTemp'];
    // echo $userName;
$weiboType=$_POST['weiboType'];

?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <label>微博类型</label>
    <select name="weiboType">
        <option value="所有">所有</option>
        <option value="生活">生活</option>
        <option value="科学">科学</option>
        <option value="技术">技术</option>
        <option value="娱乐">娱乐</option>
        <option value="体育">体育</option>
    </select>
    <input type="submit" value="选择"/>

        <table width="500" border="0" cellpadding="5" cellspacing="1" bgcolor="#add3ef">
            <?php
            if($_SERVER['REQUEST_METHOD']=="POST") {
                if ($weiboType == '所有') {
                    $sql = "select `weibo_type`, `weibo_content` from t_weibo_record where user_name='$userName'";
                } else {
                    $sql = "select `weibo_type`, `weibo_content` from t_weibo_record where user_name='$userName' 
                          and weibo_type='$weiboType'";
                }
                $result = mysqli_query($connect, $sql);
                while ($row = mysqli_fetch_array($result)) {
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