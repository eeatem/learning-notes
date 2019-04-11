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
 * Date: 2019-04-11
 * Time: 23:37
 * Func: 取消关注用户模块
 */
    include 'connection.php';
    session_start();
    $uId=$_SESSION['uIdTemp'];
    $fId=$_SESSION['fIdTemp'];
    $searchUser=$_SESSION['searchUserTemp'];
    // 删除关注信息
    $sql="delete from t_follow where `user_id`='$uId' and `follow_id`='$fId'";
    $deleteResult=mysqli_query($connect,$sql);
    if($deleteResult){
        echo "您已成功取消关注用户：<span class='error'>$searchUser</span>！<br>";
    }
    // 返回菜单
    echo "<a href='search_user.php'><input type='button' value='返回'/></a>";
    if($isManager==0) {
        echo "<a href='temp.php'><input type='button' value='返回菜单'/></a><br>";
    }else{
        echo "<a href='temp_m.php'><input type='button' value='返回菜单'/></a><br>";
    }
?>

</body>
</html>
