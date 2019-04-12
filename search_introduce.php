<?php
/**
 * Created by PhpStorm.
 * User: eeatem
 * Date: 2019-04-11
 * Time: 18:48
 */
    error_reporting(E_ALL ^ E_NOTICE);
    include 'connection.php';
    session_start();
    $userName=$_SESSION['searchUserTemp'];
    $isManager=$_SESSION['isManager'];
    $uId=$_SESSION['uIdTemp'];
    $fId=$_SESSION['fIdTemp'];
    // 检测关注者是否已经关注被关注者
    $isFollowed = false;
    $sql = "select * from t_follow where `user_id`='$uId'";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_array($result)) {
        if ($row['follow_id'] == $fId) {
            $isFollowed = true;
        }
    }
    // 获取用户注册时间
    $sql="select * from t_user where user_name='$userName'";
    $result=mysqli_query($connect,$sql);
    $row=mysqli_fetch_array($result);
    $date=$row['register_time'];
    // 获取用户个人资料
    $sql="select * from t_introduce where user_name='$userName' and id=(select max(id) from t_introduce where user_name='$userName')";
    $result=mysqli_query($connect,$sql);
    $row=mysqli_fetch_array($result);
    // 若查看个人资料成功，增加访问次数
    if($row){
        $sql="select * from t_introduce where user_name='$userName' and id=(select max(id) from t_introduce where user_name='$userName')";
        $result=mysqli_query($connect,$sql);
        $row1=mysqli_fetch_array($result);
        $lateId=$row1['id'];
        $time=++$row1['visits'];
        // echo $time;
        $sql="update t_introduce set visits='$time' where id='$lateId'";
        mysqli_query($connect,$sql);
    }

    echo '注册日期： '.$date.'<br />'.'<br />';
    echo '出生年月： '.$row['birthday_year'].'年'.$row['birthday_month'].'月'.'<br />'.'<br />';
    echo '所在区域： '.$row['location'].'（省/自治区/直辖市）'.'<br />'.'<br />';
    echo '兴趣爱好：'.$row['hobby1'].$row['hobby2'].$row['hobby3'].$row['hobby4'].$row['hobby5'].$row['hobby6'].'<br />'.'<br />';
    echo '个性签名： '.$row['label'].'<br />'.'<br />';
    echo '个人简介： '.$row['introduce'].'<br />'.'<br />';

    if(!$isFollowed) {
        echo "<a href='follow.php'><input type='button' value='关注'/></a>";
    }else{
        echo "<a href='unfollow.php'><input type='button' value='取消关注'></a>";
    }
    echo "<a href='search_user.php'><input type='button' value='继续查找'/></a>";
    if($isManager==0) {
        echo "<a href='temp.php'><input type='button' value='返回菜单'/></a>";
    }else{
        echo "<a href='temp_m.php'><input type='button' value='返回菜单'/></a>";
    }
?>