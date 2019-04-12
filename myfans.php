<?php
/**
 * Created by PhpStorm.
 * User: eeatem
 * Date: 2019-04-12
 * Time: 22:56
 * Func: 显示我的粉丝
 */
    include 'connection.php';
    session_start();
    $userName=$_SESSION['userNameTemp'];
    $isManager=$_SESSION['isManager'];

    // 获取登陆用户id
    $sql="select * from t_user where `user_name`='$userName'";
    $result=mysqli_query($connect,$sql);
    $row=mysqli_fetch_array($result);
    $uId=$row['id'];
    // echo $uId;
    // 查询该用户的粉丝
    $sql="select * from t_follow where `follow_id`='$uId'";
    $result=mysqli_query($connect,$sql);
    $i=0;
    while ($row=mysqli_fetch_array($result)){
        $fans[$i]=$row['user_id'];
        ++$i;
    }
    // 用SESSION收集该用户的粉丝
    for($k=0;$k<$i;++$k){
        // echo $follows[$k];
        $sql="select * from t_user where `id`='$fans[$k]'";
        $result=mysqli_query($connect,$sql);
        $row=mysqli_fetch_array($result);
        // $_SESSION['followName']=$row['user_name'];
?>

    <a href="myfans_temp.php?userName=<?= $row['user_name']; ?>"><input type="button" value="<?= $row['user_name']?>"/></a>

<?
    }
    if($isManager==0) {
        echo "<br><br><a href='temp.php'><input type='button' value='返回菜单'/></a>";
    }else{
        echo "<br><br><a href='temp_m.php'><input type='button' value='返回菜单'></a>";
    }
?>
