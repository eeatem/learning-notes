<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>根据正文关键字查询微博</title>
    <style>
        .tips {
            color: blue;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: eeatem
 * Date: 2019-04-12
 * Time: 13:48
 * Func: 通过类型查找我的关注用户的微博
 */
    error_reporting(E_ALL ^ E_NOTICE);
    include 'connection.php';
    session_start();
    $isManager             = $_SESSION['isManager'];
    $userName              = $_SESSION['followUserTemp'];
    $weiboType             = $_POST['weiboType'];
    $_SESSION['weiboType'] = $weiboType;

    // 判断是否能够进行查找
    $isSearch=true;
    // if($_SERVER['REQUEST_METHOD']=="POST") {
        if(empty($weiboType)){
            $isSearch=false;
        }
        if ($isManager == 1) {
            if ($weiboType == '所有类型') {
                $sql = "select * from t_weibo_record";
            } else {
                $sql = "select * from t_weibo_record where weibo_type='$weiboType'";
            }
        } else {
            if ($weiboType == '所有类型') {
                $sql = "select * from t_weibo_record where user_name='$userName'";
            } else {
                $sql = "select * from t_weibo_record where user_name='$userName' and weibo_type='$weiboType'";
            }
        }
        $result=mysqli_query($connect,$sql);
        if(!mysqli_fetch_array($result)){
            $isSearch=false;
        }
    // }
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <label>微博类型</label>
    <select name="weiboType">
        <option value="">------</option>
        <option value="所有类型">所有</option>
        <option value="生活">生活</option>
        <option value="科学">科学</option>
        <option value="技术">技术</option>
        <option value="娱乐">娱乐</option>
        <option value="体育">体育</option>
    </select>
    <input type="submit" value="选择"/>
    <?php
        if($_SERVER['REQUEST_METHOD']=="POST" && $isSearch==true){
            echo "<a href='myfollow_list_weibo_by_type_limit.php'><input type='button' value='查找'></a>";
        }
    ?>

    <?php
        echo "<a href='myfollow.php'><input type='button' value='返回'></a>";
        if ($isManager == 0) {
            echo "<a href='temp.php'><input type='button' value='返回菜单'/></a><br>";
        } else {
            echo "<a href='temp_m.php'><input type='button' value='返回菜单'/></a><br>";
        }
        /*
        if ($isManager == 1) {
            if ($weiboType == '所有类型') {
                $sql = "select * from t_weibo_record";
            } else {
                $sql = "select * from t_weibo_record where weibo_type='$weiboType'";
            }
        } else {
            if ($weiboType == '所有类型') {
                $sql = "select * from t_weibo_record where user_name='$userName'";
            } else {
                $sql = "select * from t_weibo_record where user_name='$userName' and weibo_type='$weiboType'";
            }
        }
        $result = mysqli_query($connect, $sql);
        */
        if ($_SERVER['REQUEST_METHOD'] == "POST" && $isSearch && $weiboType == '所有类型') {
            echo "即将查找 <span class='tips'>$weiboType</span> 的已发微博！";
        } else if ($_SERVER['REQUEST_METHOD'] == "POST" && $isSearch) {
            echo "即将查找类型为: <span class='tips'>$weiboType</span> 的已发微博！";
        } else if ($_SERVER['REQUEST_METHOD'] == "POST" && empty($weiboType)) {
            echo "<span class='error'>请选择您需要查找的微博类型！</span>";
        } else if ($_SERVER['REQUEST_METHOD'] == "POST" && !$isSearch) {
            echo "<span class='error'>不存在任何类型为: <span class='tips'>$weiboType</span> 的微博，请重新选择！</span>";
        }
    ?>

</form>
</body>
</html>
