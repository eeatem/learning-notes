<?php
/**
 * Created by PhpStorm.
 * User: eeatem
 * Date: 2019-04-13
 * Time: 04:40
 * Func: 实现微博点赞功能
 */
include 'connection.php';
session_start();
// 获取点赞用户id
$userName = $_SESSION['userNameTemp'];
$sql      = "select * from t_user where user_name = '$userName'";
$result   = mysqli_query($connect, $sql);
$row      = mysqli_fetch_assoc($result);
$uId      = $row['id'];
// 获取点赞微博id
$id = $_GET['id'];
// 插入微博点赞记录
$sql    = "insert into t_like values ('$uId','$id')";
$result = mysqli_query($connect,$sql);
// 提示用户点赞成功
if ($result) {
    // 若点赞成功，增加微博点赞次数
    $sql        = "select * from t_weibo_record where id='$id'";
    $result     = mysqli_query($connect, $sql);
    $row        = mysqli_fetch_assoc($result);
    $like       = ++$row['praise'];
    $sql        = "update t_weibo_record set praise='$like' where id='$id'";
    $likeResult = mysqli_query($connect, $sql);
    if ($likeResult) {
        echo '点赞成功！';
    }
}
echo "<a href='myfans_list_weibo.php'><input type='button' value='返回'></a>";

?>