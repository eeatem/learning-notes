<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>查找用户</title>
    <style>
        .error{color:red;}
        .tips{color:blue;}
    </style>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: eeatem
 * Date: 2019-04-11
 * Time: 18:25
 * Func：实现查找用户功能
 */
    include 'connection.php';
    session_start();
    $userName=$_SESSION['userNameTemp'];
    $searchUser=trim($_POST['searchUser']);
    $_SESSION['searchUserTemp']=$searchUser;

    // 查询用户是否存在
    $isExit=true;
    $sql="select * from t_user where `user_name`='$searchUser'";
    $result=mysqli_query($connect,$sql);
    $row=mysqli_fetch_array($result);
    if($row['user_name']!=$searchUser){
        $isExit=false;
    }
    // 判断登陆用户是否正在查找自己
    $isSelf=false;
    if($userName==$searchUser){
        $isSelf=true;
    }
    // 判断当前用户（登陆者）是否已经关注被查找用户
    $sql = "select * from t_user where `user_name`='$searchUser'";
    $result = mysqli_query($connect, $sql);
    if ($row=mysqli_fetch_array($result)) {
        // 被关注者的id
        $fId = $row['id'];
        $_SESSION['fIdTemp']=$fId;
        // 关注者（当前登陆用户）的id
        $sql = "select * from t_user where `user_name`='$userName'";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($result);
        $uId = $row['id'];
        $_SESSION['uIdTemp']=$uId;
        // 检测关注者是否已经关注被关注者
        $isFollowed = false;
        $sql = "select * from t_follow where `user_id`='$uId'";
        $result = mysqli_query($connect, $sql);
        while ($row = mysqli_fetch_array($result)) {
            if ($row['follow_id'] == $fId) {
                $isFollowed = true;
            }
        }
    }
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    用户名：<input type="text" name="searchUser"/>
    <input type="submit" value="查找"/>

    <?php
        if($isManager==0) {
            echo "<a href='temp.php'><input type='button' value='返回菜单'></a><br>";
        }else{
            echo "<a href='temp_m.php'><input type='button' value='返回菜单'/></a><br>";
        }
    ?>

    <?php
        if($_SERVER['REQUEST_METHOD']=="POST") {
            if (empty($searchUser)) {
                echo "<span class='error'>用户名不能为空，请重新输入！</span>";
            }else if(!$isExit){
                echo "<span class='error'>用户不存在，请重新输入！</span>";
            }else if($isSelf){
                // 在查找用户后加一个空格，与后面按钮分开
                $searchUserDisplay=$searchUser.' ';
                echo "您搜索的用户为：<span class='tips'>$searchUserDisplay</span>";
                echo "<a href='search_introduce.php'><input type='button' value='查看用户个人资料'/></a>";
            }else if(!$isSelf && $isFollowed){
                // 在查找用户后加一个空格，与后面按钮分开
                $searchUserDisplay=$searchUser.' ';
                echo "您搜索的用户为：<span class='tips'>$searchUserDisplay</span>";
                echo "<a href='search_introduce.php'><input type='button' value='查看用户个人资料'/></a>";
                echo "<a href='unfollow.php'><input type='button' value='取消关注'></a>";
            }else if(!$isFollowed){
                $searchUserDisplay=$searchUser.' ';
                echo "您搜索的用户为：<span class='tips'>$searchUserDisplay</span>";
                echo "<a href='search_introduce.php'><input type='button' value='查看个人资料'/></a>";
                echo "<a href='follow.php'><input type='button' value='关注'></a>";
            }
        }
    ?>

</form>
</body>
</html>
