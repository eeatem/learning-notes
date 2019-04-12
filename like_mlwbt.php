<?php
/**
 * Created by PhpStorm.
 * User: eeatem
 * Date: 2019-04-13
 * Time: 04:40
 * Func: 实现微博点赞功能
 */
include 'connection.php';
$id=$_GET['id'];
// 增加微博点赞次数
$sql="select * from t_weibo_record where id='$id'";
$result=mysqli_query($connect,$sql);
$row=mysqli_fetch_array($result);
$like=++$row['praise'];
// echo $like;
$sql="update t_weibo_record set praise='$like' where id='$id'";
$likeResult=mysqli_query($connect,$sql);
// 提示用户点赞成功
if($likeResult) {
    echo '点赞成功！';
}
echo "<a href='myfollow_list_weibo_by_type_limit.php'><input type='button' value='返回'></a>";
?>