<?php
/**
 * Created by PhpStorm.
 * User: eeatem
 * Date: 2019-04-12
 * Time: 14:34
 * Func: 我的关注过渡页面
 */
    session_start();
    $_SESSION['followUserTemp']=$_GET['userName'];
    echo "<a href='myfollow_list_weibo.php'><input type='button' value='查看微博'></a>";
    echo "<a href='myfollow_list_introduce.php'><input type='button' value='个人资料'/></a>";
    echo "<a href='myfollow_unfollow.php'><input type='button' value='取消关注'></a>";
    echo "<a href='myfollow.php'><input type='button' value='返回'/></a>";

?>

