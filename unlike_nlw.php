<?php
/**
 * Created by PhpStorm.
 * User: eeatem
 * Date: 2019-04-19
 * Time: 19:32
 * Func: 实现微博取消点赞功能
 */
include 'connection.php';
session_start();
// 获取取消点赞用户id
$userName = $_SESSION['userNameTemp'];
$sql      = "select * from t_user where user_name = '$userName'";
$result   = mysqli_query($connect, $sql);
$row      = mysqli_fetch_assoc($result);
$uId      = $row['id'];
    // echo $uId;
// 获取取消点赞微博id
$id = $_GET['id'];
    // echo $id;
// 删除微博点赞记录
$sql    = "delete from t_like where `user_id`='$uId' and `weibo_id`='$id'";
$result = mysqli_query($connect,$sql);
// 提示用户取消点赞成功
if ($result) {
    // 若取消点赞成功，减少微博点赞次数
    $sql        = "select * from t_weibo_record where id='$id'";
    $result     = mysqli_query($connect, $sql);
    $row        = mysqli_fetch_assoc($result);
    $like       = --$row['praise'];
    $sql        = "update t_weibo_record set praise='$like' where id='$id'";
    $likeResult = mysqli_query($connect, $sql);
    if ($likeResult) {
        echo '取消点赞成功！';
    }
}
echo "<a href='myfans_list_weibo.php'><input type='button' value='返回'></a>";

?>