<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>登陆</title>
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
 * Date: 2019/3/23
 * Time: 20:06
 * Func: 实现用户登陆功能
 */
    error_reporting(E_ALL ^ E_NOTICE);
    include 'connection.php';
    include 'function.php';
    session_start();
    $checkCode=$_SESSION['checkCode'];

    // 该bool用于判断用户输入信息是否符合要求
    $isEmpty=false;
    //
    $isLogin=false;
    //
    $isRegister=true;

    if($_SERVER['REQUEST_METHOD']=="POST") {
        $isEmpty = true;
        // 检测用户名是否为空
        if (empty($_POST['userName'])) {
            $error1  = '*请输入您的用户名或注册邮箱';
            $isEmpty = false;
        } else {
            $userName = trim($_POST['userName']);
        }
        // 检测用户密码是否为空
        if (empty($_POST['password'])) {
            $error2  = '*请输入您的密码';
            $isEmpty = false;
        } else {
            $password = md5($_POST['password']); //用于将用户输入的密码与数据库表中注册时已通过md5加密的密码进行匹配对比
        }
        // 检测用户输入的验证码是否正确
        if ($_POST['checkCode']!=$checkCode){
            $isEmpty=false;
            $error3='                           *请输入正确的验证码';
            $error3=html_replace_space($error3);
        }
        // 检测用户名或注册邮箱是否存在
        if ($isEmpty) {
            $sql    = "SELECT user_name, email FROM t_user WHERE user_name='$userName' or email='$userName'";
            $result = mysqli_query($connect, $sql);
            $test   = mysqli_fetch_assoc($result);
            if ($test == false) {
                $error1 = "*该用户不存在";
                $isRegister=false;
                // 检测密码是否正确
            } else {
                // 检测昵称所属用户输入密码是否正确
                    // 在数据库中查询用户名和密码
                $sql1    = "SELECT user_name, password FROM t_user WHERE (user_name='$userName') and (password='$password')";
                $result1 = mysqli_query($connect, $sql1);
                $test1   = mysqli_fetch_assoc($result1);
                // 检测邮箱所属用户输入密码是否正确
                    // 在数据库中查询邮箱和密码
                $sql2    = "SELECT email, password FROM t_user WHERE (email='$userName') and (password='$password')";
                $result2=mysqli_query($connect, $sql2);
                $test2=mysqli_fetch_assoc($result2);
                if ($test1 == false && $test2 == false) {
                    $error2 = "*密码错误";
                } else {
                   $isLogin=true; // echo "登陆成功!";
                }
            }
        }
    }
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    用户名或邮箱：<input type="text" name="userName"/>
    <?php echo "<span class=error>".$error1."</span>";?>
    <?php if($isRegister==false){echo "<a href='register.php'>注册</a>";} ?><br/>
    您的登陆密码：<input type="password" name="password"/>
    <?php echo "<span class=error>".$error2."</span>";?><br/>
    验证码&emsp;&emsp;&emsp;：<input size="5" type="text" name="checkCode"/>
    <?php echo "<span class=error>" . $error3 . "</span>"; ?><br/>
    <img src="check_code.php"><br>
    <input type="submit" value="登陆"/>

</form>
</body>
</html>

<?php
    if($isLogin) {
        if($test2==true) { // 若用户使用邮箱登陆，则需要通过输入的邮箱在数据库表中找到对应的用户昵称
            $sql = "select * from t_user where email='$userName'";
            $result=mysqli_query($connect,$sql);
            $row=mysqli_fetch_array($result);
            $userName=$row['user_name'];
            $isManager=$row['isManager'];
        }
        // 用session保存登陆后的用户名
        $_SESSION['userNameTemp']=$userName;
        // 检测登陆者是否为管理员
        $sql = "select * from t_user where user_name='$userName'";
        $result=mysqli_query($connect,$sql);
        $row=mysqli_fetch_array($result);
        $isManager=$row['is_manager'];
        // 用session保存登陆用户的身份
        $_SESSION['isManager']=$isManager;

        if($isManager==0) {
            echo "登陆成功！欢迎您，用户：<span class='tips'>&nbsp;$userName</span> ！";
            echo "<a href='temp.php'><input type='button' value='进入微博系统'/></a>";
        }else{
            echo "登陆成功！欢迎您，管理员：<span class='tips'>$userName</span> ！";
            echo "<a href='temp_m.php'><input type='button' value='进入微博系统'></a>";
        }
    }
?>