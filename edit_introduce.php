<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>个人资料</title>
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
 * Date: 2019/3/30
 * Time: 1:13
 * Func: 实现注册时填写个人资料
 */
    error_reporting(E_ALL ^ E_NOTICE);
    include 'function.php';
    include 'connection.php';
    session_start();
    $userName   = $_SESSION['userNameTemp'];
    $isManager = $_SESSION['isManager'];
    // 收集表单中的用户填写的信息
    $birthdayYear  = $_POST['birthdayYear'];
    $birthdayMonth = $_POST['birthdayMonth'];
    $location      = $_POST['location'];
    $hobby1        = ' ' . $_POST['hobby1'] . ' ';
    $hobby2        = $_POST['hobby2'] . ' ';
    $hobby3        = $_POST['hobby3'] . ' ';
    $hobby4        = $_POST['hobby4'] . ' ';
    $hobby5        = $_POST['hobby5'] . ' ';
    $hobby6        = $_POST['hobby6'];
    $label         = $_POST['label'];
    $introduce     = $_POST['introduce'];
    // 用户判断是否满足条件提交个人资料的修改
    $isEmpty = true;

    // 若用户未登陆则报错
    if (empty($userName)) {
        $isEmpty = false;
        $error0   = '获取用户信息失败，无法修改个人资料！';
        echo "<span class='error'>$error0</span>";
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // 检测用户是否已经选择了出生年月
        if (empty($_POST['birthdayYear']) || empty($_POST['birthdayMonth'])) {
            $error1   = '       *请选择您的出生年月';
            $error1   = html_replace_space($error1);
            $isEmpty = false;
        }
        // 检测用户是否已经选择了所在区域
        if (empty($_POST['location'])) {
            $error2   = '*请选择您的所在区域';
            $isEmpty = false;
        }
    }
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <label>出生年月：</label>
    <select name="birthdayYear">
        <option value="">------</option>
        <?php
        // 获取当前年份 并生成一系列年份选择
        for ($year = date(Y); $year >= 1920; $year--) {
            echo "<option value='$year'>$year</option>";
        }
        ?>
    </select>年
    <select name="birthdayMonth">
        <option value="">---</option>
        <?php
        // 生成一系列月份选择
        for ($month = 1; $month <= 12; $month++) {
            echo "<option value='$month'>$month</option>";
        }
        ?>
    </select>月
    <!-- 若未填写出生年月则报错 -->
    <?php echo "<span class=error>$error1</span>"; ?>
    <br>
    <label>所在区域：</label>
    <select name="location">
        <option value="">--------</option>
        <?php
        html_introduce_location($province);
        ?>
    </select>省/自治区/直辖市
    <!-- 若未填写所在区域则报错 -->
    <?php echo "<span class='error'>$error2</span>"; ?>
    <br>
    <label>您的爱好：</label>
    <input type="checkbox" name="hobby1" value="摄影"/>摄影
    <input type="checkbox" name="hobby2" value="游泳"/>游泳
    <input type="checkbox" name="hobby3" value="射箭"/>射箭
    <input type="checkbox" name="hobby4" value="滑雪"/>滑雪
    <input type="checkbox" name="hobby5" value="绘画"/>绘画
    其他<input type="text" size="5" name="hobby6"/>
    <br>
    <label>个性签名：</label>
    <textarea rows="2" cols="30" name="label"></textarea><br>
    <label>个人简介：</label>
    <textarea rows="5" cols="52" name="introduce"></textarea>
    <br>
    <input type="submit" value="提交"/>
    <?php if ($isManager == 0) {
        echo "<a href='temp.php'><input type='button' value='返回菜单'/></a>";
    } else {
        echo "<a href='temp_m.php'><input type='button' value='返回菜单'/></a>";
    }
    ?>
</form>

</body>
</html>

<?php
    /*
    if($_SERVER['REQUEST_METHOD']=="POST" && $is_empty==true){
        echo '个人资料修改成功！';
        echo "<a href='list_introduce.php'><input type='button' value='查看个人资料'/></a>";
    }
    */
    // 该模块用于把用户修改的个人信息插入到数据库中
    if ($_SERVER['REQUEST_METHOD'] == "POST" && $isEmpty == true) {
        $sql = "insert into t_introduce (`user_name`,`birthday_year`,`birthday_month`,`location`,`hobby1`,`hobby2`,`hobby3`,
                `hobby4`,`hobby5`,`hobby6`,`label`,`introduce`)
                values ('$userName', '$birthdayYear', '$birthdayMonth', '$location','$hobby1','$hobby2','$hobby3','$hobby4',
                '$hobby5','$hobby6', '$label', '$introduce')";
        // 判断个人资料是否修改成功
        if (mysqli_query($connect, $sql)) {
            echo '个人资料修改成功！';
            echo "<a href='list_introduce.php'><input type='button' value='查看个人资料'/></a>";
        } else {
            $error4 = '插入数据失败！';
            echo "<span class='error'>$error4</span>";
        }
    }
?>






