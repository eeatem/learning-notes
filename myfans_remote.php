<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>取消关注</title>
    <style>
        .error{color:red;}
    </style>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: eeatem
 * Date: 2019-04-13
 * Time: 02:30
 * Func: 移除关注
 */
    include 'connection.php';
    session_start();
    $userName=$_SESSION['userNameTemp'];
    $followUser=$_SESSION['followUserTemp'];
    // 获取登陆用户的Id
    $sql="select * from t_user where `user_name`='$userName'";
    $result=mysqli_query($connect,$sql);
    $row=mysqli_fetch_array($result);
    $uId=$row['id'];
    // 获取登陆用户粉丝的Id
    $sql="select * from t_user where `user_name`='$followUser'";
    $result=mysqli_query($connect,$sql);
    $row=mysqli_fetch_array($result);
    $fId=$row['id'];
    // 删除关注信息
    $sql="delete from t_follow where `user_id`='$fId' and `follow_id`='$uId'";
    $deleteResult=mysqli_query($connect,$sql);
    if($deleteResult){
        echo "您已成功取消关注用户：<span class='error'>$followUser</span>！<br>";
    }
    // 返回菜单
    echo "<a href='myfans.php'><input type='button' value='返回'/></a>";
    if($isManager==0) {
        echo "<a href='temp.php'><input type='button' value='返回菜单'/></a><br>";
    }else{
        echo "<a href='temp_m.php'><input type='button' value='返回菜单'/></a><br>";
    }
?>

</body>
</html>
