<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>注册</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/22
 * Time: 21:35
 * Function: 实现用户注册功能
 */
    error_reporting(E_ALL ^ E_NOTICE);
    session_start();
    // 转换html的空格字符
    function html_replace_space($content)
    {
        $content = str_replace(' ', '&nbsp;', $content);
        return $content;
    }

    // 调用数据库文件
    include 'connection.php';
    // 防止报错，初始化用户输入变量
    $userName = '';
    $email    = '';
    $password = '';
    $gender   = '';
    // 防止报错，初始化错误信息变量
    $error1 = '';
    $error2 = '';
    $error3 = '';
    $error4 = '';
    $error5 = '';
    // 该bool用于判断用户输入信息是否符合要求
    $isEmpty = false;

    // 该模块用于检测用户输入的注册信息是否都符合要求
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $isEmpty = true;
        // 检测用户昵称是否为空
        if (empty(trim($_POST['userName']))) { //防止输入空白昵称
            $error1  = '*请输入您的昵称';
            $isEmpty = false;
        } else {
            $userName = trim($_POST['userName']); // 自动屏蔽用户名中的空格
        }
        // 检测用户邮箱是否为空
        if (empty($_POST['email'])) {
            $error2  = '*请输入您的常用邮箱';
            $isEmpty = false;
        } else {
            $email = trim($_POST['email']); // 自动屏蔽邮箱中的空格
            //利用正则表达式对邮箱格式进行限制
            if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
                $error2  = "*请输入正确的邮箱地址";
                $isEmpty = false;
            }
        }
        // 检测用户性别是否输入正确
        if (trim($_POST['gender']) == '男' | trim($_POST['gender']) == '女') {
            $gender = trim($_POST['gender']); // 自动屏蔽性别中的空格
        } else {
            $error3  = '                    *请选择您的性别';
            $error3  = html_replace_space($error3);
            $isEmpty = false;
        }
        // 检测用户密码是否为空
        if (empty($_POST['password'])) {
            $error4  = '*请输入您的密码';
            $isEmpty = false;
        } else {
            $password = $_POST['password'];
            // 利用正则表达式对密码长度进行限制
            if (!preg_match("/(\w{6,100})/", $password)) {
                $error4  = '*请至少输入6位密码';
                $isEmpty = false;
            }
            $password = md5($password); // 对用户密码进行md5不可逆加密
        }
        // 检测用户两次输入的密码是否一致
        if ($_POST['password'] != $_POST['repassword']) {
            $error5  = '*请确保您两次输入的密码一致';
            $isEmpty = false;
        } else {
            $password = md5($_POST['password']);
        }
    }

    // 检测用户名是否被占用
    $sql    = "SELECT user_name FROM t_user WHERE user_name='$userName'";
    $result = mysqli_query($connect, $sql); // 查询不到(F)即用户名未被注册，查询到(T)即用户名已经存在
    $test   = mysqli_fetch_assoc($result);
    if ($test != false) {// 记录不为空即用户名已被注册
        $error1  = '*该用户名已存在';
        $isEmpty = false;
    }
    // 检测邮箱是否已被注册
    $sql    = "select email from t_user where email='$email'";
    $result = mysqli_query($connect, $sql);
    $test   = mysqli_fetch_assoc($result);
    if ($test != false) {
        $error2  = '*该邮箱已被注册';
        $isEmpty = false;
    }
    /*
    // 该模块用于把用于输入的注册信息传输到数据库中
    if ($_SERVER['REQUEST_METHOD'] == "POST" && $isEmpty == true) {
        // 编写一句SQL将用户注册信息插入到数据库的表中
        $sql = "INSERT INTO t_user (`user_name`, `email`, `password`, `gender`, `register_time`)
                        values ('$userName', '$email', '$password', '$gender', curdate())";
        // 将数据输入到数据库中
        if (mysqli_query($connect, $sql)) {
            // echo '注册成功';    // echo '插入数据成功';
        } else {
            echo '插入数据失败';
        }
    }
    */
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    用户昵称：<input type="text" name="userName"/>
    <?php echo "<span class=error>" . $error1 . "</span>"; ?><br/>
    常用邮箱：<input type="text" name="email"/>
    <?php echo "<span class=error>" . $error2 . "</span>"; ?><br/>
    您的性别：<input type="radio" name="gender" value="男"/>男
    <input type="radio" name="gender" value="女"/>女
    <?php echo "<span class=error>" . $error3 . "</span>"; ?><br/>
    注册密码：<input type="password" name="password"/>
    <?php echo "<span class=error>" . $error4 . "</span>"; ?><br/>
    确认密码：<input type="password" name="repassword"/>
    <?php echo "<span class=error>" . $error5 . "</span>"; ?><br/>
    <input type="submit" value="注册"/>
</form>

</body>
</html>

<?php
/*
if ($isEmpty) {
    echo '注册成功！<br/>';
    echo "您的用户名：" . $userName . "<br/>";
    echo '注册时间为：' . date('Y-m-d- h:i:s') . '<br />';
    echo '<a href="edit_introduce.php"><input type="button" value="完善个人资料"/></a>';
    $_SESSION['userNameTemp'] = $userName;
}
*/
?>

<?php
    // 该模块用于把用于输入的注册信息传输到数据库中
    if ($_SERVER['REQUEST_METHOD'] == "POST" && $isEmpty == true) {
        // 编写一句SQL将用户注册信息插入到数据库的表中
        $sql = "INSERT INTO t_user (`user_name`, `email`, `password`, `gender`, `register_time`)
                values ('$userName', '$email', '$password', '$gender', curdate())";
        // 将数据输入到数据库中
            // 判断注册数据是否插入成功
        if (mysqli_query($connect, $sql)) {
            echo '注册成功！<br/>';
            echo "您的用户名：" . $userName . "<br/>";
            echo '注册时间为：' . date('Y-m-d- h:i:s') . '<br />';
            echo '<a href="edit_introduce.php"><input type="button" value="完善个人资料"/></a>';
            // 用session保存注册成功的用户名
            $_SESSION['userNameTemp'] = $userName;
        } else {
            echo '插入数据失败';
        }
    }
?>
