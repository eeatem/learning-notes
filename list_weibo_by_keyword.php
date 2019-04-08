<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>根据正文关键字查询微博</title>
    <style>
        .tips{color:blue;}
        .error{color:red;}
    </style>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/31
 * Time: 2:53
 * Func: 根据正文关键字查询微博
 */
    error_reporting(E_ALL ^ E_NOTICE);
    include 'connection.php';
    session_start();
    $userName=$_SESSION['userNameTemp'];
    $isManager=$_SESSION['isManager'];
    $keyWord=$_POST['keyWord'];
    $keyWordTemp=$keyWord;
    $keyWord="%$keyWord%";
    $_SESSION['keyWord']=$keyWord;

    // 判断是否能够进行查询
    $isSearch=true;
    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(empty($_POST['keyWord'])){
            $isSearch=false;
        }
        if($isManager==1) {
            $sql = "select * from t_weibo_record where weibo_content like '$keyWord'";
        }else{
            $sql="select * from t_weibo_record where user_name='$userName' and weibo_content like '$keyWord'";
        }
        $result = mysqli_query($connect, $sql);
        if (!mysqli_fetch_array($result)) {
            $isSearch=false;
        }
    }
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <br>请输入微博正文关键字：<br><input type="text" name="keyWord"/>&nbsp;<input type="submit" value="确认"/>

    <?php
        // 提交表单后 且 满足查找条件后才生成‘查找按钮’
        if($_SERVER['REQUEST_METHOD']=="POST" && $isSearch==true){
            echo "<a href='list_weibo_by_keyword_limit.php'><input type='button' value='查找'/></a>";
        }
    ?>

    <?php
        if($isManager==0){
            echo "<a href='temp.php'><input type='button' value='返回菜单'/></a><br>";
        } else{
            echo "<a href='temp_m.php'><input type='button' value='返回菜单'/></a><br>";
        }
        if($isManager==1) {
            $sql = "select * from t_weibo_record where weibo_content like '$keyWord'";
        }else{
            $sql="select * from t_weibo_record where user_name='$userName' and weibo_content like '$keyWord'";
        }
        $result = mysqli_query($connect, $sql);
        if ($_SERVER['REQUEST_METHOD']=="POST" && mysqli_fetch_array($result) && !empty($keyWordTemp)) {
            echo "即将查找关键字为: <span class='tips'>$keyWordTemp</span> 的已发微博！";
        }else if($_SERVER['REQUEST_METHOD']=="POST" && !mysqli_fetch_array($result)){
            echo "<span class='error'>不存在任何关键字为: <span class='tips'>$keyWordTemp</span> 的微博，请重新输入！</span>";
        }
        if($_SERVER['REQUEST_METHOD']=="POST" && empty($keyWordTemp)){
            echo "<span class='error'>关键字不能为空，请重新输入！</span>";
        }
    ?>

</form>
</body>
</html>