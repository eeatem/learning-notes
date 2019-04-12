<?php
/**
 * Created by PhpStorm.
 * User: eeatem
 * Date: 2019-04-13
 * Time: 02:11
 * Func: 我的粉丝过渡页面
 */
    session_start();
    $_SESSION['followUserTemp']=$_GET['userName'];
    echo "<a href='myfans_list_weibo.php'><input type='button' value='查看微博'></a>";
    echo "<a href='myfans_list_introduce.php'><input type='button' value='个人资料'/></a>";
    echo "<a href='myfans_remote.php'><input type='button' value='移除粉丝'></a>";
    echo "<a href='myfollow.php'><input type='button' value='返回'/></a>";
?>

