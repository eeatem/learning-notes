<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>关注用户</title>
    <style>
        .tips{color:blue;}
    </style>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: eeatem
 * Date: 2019-04-11
 * Time: 23:25
 * Func：关注用户模块
 */
    include 'connection.php';
    session_start();
    $uId=$_SESSION['uIdTemp'];
    $fId=$_SESSION['fIdTemp'];
    $searchUser=$_SESSION['searchUserTemp'];
    // 插入关注信息
    $sql = "insert into t_follow values ('$uId','$fId')";
    $followResult=mysqli_query($connect, $sql);
    if($followResult) {
        echo "您已成功关注用户：<span class='tips'>$searchUser</span>！<br>";
    }
    // 返回菜单
    echo "<a href='search_user.php'><input type='button' value='继续查找'/></a>";
    if($isManager==0) {
        echo "<a href='temp.php'><input type='button' value='返回菜单'/></a><br>";
    }else{
        echo "<a href='temp_m.php'><input type='button' value='返回菜单'/></a><br>";
    }
?>

</body>
</html>
