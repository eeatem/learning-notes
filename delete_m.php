<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/31
 * Time: 2:36
 * Func: 管理员删除微博
 */
    include 'connection.php';
    $id=$_GET['id'];
    // echo $id;

    $sql="delete from t_weibo_record where id='$id'";
    mysqli_query($connect,$sql);
    echo '微博删除成功！';
?>

<a href="system.php"><input type="button" value="返回"/></a>