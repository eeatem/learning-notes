<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>根据用户名查询微博</title>
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
 * Func: 管理员根据用户名查询微博
 */
    error_reporting(E_ALL ^ E_NOTICE);
    include 'connection.php';
    session_start();
    $isManager=$_SESSION['isManager'];
    $userNameTemp                   = trim($_POST['userName']);
    $_SESSION['searchUserNameTemp'] = $userNameTemp;
    // 判断是否能够进行查找
    $isSearch=true;
    if($_SERVER['REQUEST_METHOD']=="POST"){
        if(empty($userNameTemp)){
            $isSearch=false;
        }
        $sql    = "select * from t_weibo_record where user_name='$userNameTemp'";
        $result=mysqli_query($connect, $sql);
        $row=mysqli_fetch_array($result);
        if ($row['user_name'] != $userNameTemp) {
            $isSearch=false;
        }
    }
    // 检测是否为管理员
    if($isManager!=1) {
        echo "<span class='error'>非管理员无权登入该页面！</span>";
        exit;
    }
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    请输入用户名：<input type="text" name="userName"/>&nbsp;<input type="submit" value="确认"/>
    <?php
        // 提交表单后 且 满足查找条件后才生成‘查找按钮’
        if($_SERVER['REQUEST_METHOD']=="POST" && $isSearch==true){
            echo "<a href='list_weibo_by_username_limit.php'><input type='button' value='查找'/></a>";
        }
    ?>
    <a href='temp_m.php'><input type='button' value='返回菜单'/></a><br>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $sql    = "select * from t_weibo_record where user_name='$userNameTemp'";
            $result=mysqli_query($connect, $sql);
            $row=mysqli_fetch_array($result);
            if(empty($userNameTemp)){
                echo "<span class='error'>用户名不能为空，请重新输入！</span>";
            }else {
                if ($row['user_name'] == $userNameTemp) {
                    echo "即将查找 <span class='tips'>$userNameTemp</span> 的已发微博！";
                } else {
                    echo "<span class='error'>该用户不存在或尚未发送任何微博，请重新输入！</span>";
                }
            }
        }
    ?>
</form>
</body>
</html>