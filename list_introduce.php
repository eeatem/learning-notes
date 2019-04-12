<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/30
 * Time: 15:45
 */
    // error_reporting(E_ALL ^ E_NOTICE);
    include 'connection.php';
    session_start();
    $userName=$_SESSION['userNameTemp'];
    $isManager=$_SESSION['isManager'];
    // 获取用户注册时间
    $sql="select * from t_user where user_name='$userName'";
    $result=mysqli_query($connect,$sql);
    $row=mysqli_fetch_array($result);
    $date=$row['register_time'];
    // 获取用户相关信息
    $sql="select * from t_introduce where user_name='$userName' and id=(select max(id) from t_introduce where user_name='$userName')";
    $result=mysqli_query($connect,$sql);
    $row=mysqli_fetch_array($result);
    // 获取用户经验值
    $sql="select * from t_user where user_name='$userName'";
    $result=mysqli_query($connect,$sql);
    $exp=mysqli_fetch_array($result);
    $exp=$exp['exp'];
    // 设定用户等级
    if($exp<1){
        $level='1级';
    }else if($exp<3){
        $level='2级';
    }else if($exp<5){
        $level='3级';
    }else{
        $level='4级';
    }

    echo '注册日期： '.$date.'<br />'.'<br />';
    echo '出生年月： '.$row['birthday_year'].'年'.$row['birthday_month'].'月'.'<br />'.'<br />';
    echo '所在区域： '.$row['location'].'（省/自治区/直辖市）'.'<br />'.'<br />';
    echo '兴趣爱好：'.$row['hobby1'].$row['hobby2'].$row['hobby3'].$row['hobby4'].$row['hobby5'].$row['hobby6'].'<br />'.'<br />';
    echo '个性签名： '.$row['label'].'<br />'.'<br />';
    echo '个人简介： '.$row['introduce'].'<br />'.'<br />';
    echo '访问次数： '.$row['visits'].'<br />'.'<br />';
    echo '微博等级： '.$level.'<br />'.'<br />';

    echo "<a href='edit_introduce.php'><input type='button' value='修改个人资料'></a>&nbsp;";
    if($isManager==0){
            echo "<a href='temp.php'><input type='button' value='返回菜单'/></a>";
        } else{
            echo "<a href='temp_m.php'><input type='button' value='返回菜单'/></a>";
        }

?>