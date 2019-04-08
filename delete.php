<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/31
 * Time: 1:19
 * Func: 删除微博
 */
    include 'connection.php';
    $id=$_GET['id'];
    // echo $id;

    $sql="delete from t_weibo_record where id='$id'";
    mysqli_query($connect,$sql);
    echo '微博删除成功！';
?>

<a href="list_weibo.php"><input type="button" value="返回"/></a>
