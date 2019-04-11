<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>添加关注</title>
    <style>
        .error{color:red;}
        .tips{color:blue;}
    </style>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: eeatem
 * Date: 2019-04-10
 * Time: 23:07
 * Func: 实现关注用户功能
 */
include 'connection.php';
session_start();
$userName=$_SESSION['userNameTemp'];
// 收集表单中填写的用户名
$followUser=$_POST['followUser'];
// 查询数据库中是否存在该用户名（是否能够进行关注）
$isFollow=true;
if($_SERVER['REQUEST_METHOD']=="POST") {
    $sql = "select * from t_user where `user_name`='$followUser'";
    $result = mysqli_query($connect, $sql);
    if ($row=mysqli_fetch_array($result)) {
        // 被关注者的id
        $fId=$row['id'];
        // 关注者（当前登陆用户）的id
        $sql="select * from t_user where `user_name`='$userName'";
        $result=mysqli_query($connect,$sql);
        $row=mysqli_fetch_array($result);
        $uId=$row['id'];
        // 检测关注者是否已经关注被关注者
        $isFollowed=false;
        $sql="select * from t_follow where `user_id`='$uId'";
        $result=mysqli_query($connect,$sql);
        while($row=mysqli_fetch_array($result)){
            if($row['follow_id']==$fId){
                $isFollowed=true;
            }
        }
        // 检测关注者是否正在关注自己
        if($fId==$uId){
            $isFollow=false;
            $isSame=true;
        }else if(!$isFollowed){
            // 插入关注信息
            $sql = "insert into t_follow values ('$uId','$fId')";
            $followResult=mysqli_query($connect, $sql);
        }
    }else{
        $isFollow=false;
    }
}
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    用户名：<input type="text" name="followUser"/>
    <input type="submit" value="关注"/><br>

    <?php
    if($_SERVER['REQUEST_METHOD']=="POST") {
        if (empty($followUser)) {
            echo "<span class='error'>用户不能为空，请重新输入！</span>";
        }else if($isFollowed){
            echo "<span class='error'>您已关注用户：<span class='tips'>$followUser</span> ，请勿重复关注！</span>";
        }
        if ($isSame) {
            echo "<span class='error'>您不能对自己添加关注，请重新输入！</span>";
        } else if(!empty($followUser) && !$isFollow){
            echo "<span class='error'>用户不存在，请重新输入！</span>";
        }
        if ($followResult) {
            echo "您已成功关注用户：<span class='tips'>$followUser</span>";
        }
    }
    ?>

</form>
</body>
</html>