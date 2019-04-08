<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/22
 * Time: 20:18
 * Function: 连接php和MySQL数据库
 */
    //引用配置文件
    include 'config.php';
    // 数据库连接语句
    $connect = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_BASE);
    // 检测数据库是否连接成功，若失败则返回错误分析
    if(mysqli_errno($connect)){
        echo '连接MySQL数据库失败: ' . mysqli_error() . '<br />';
    }else{
        // echo '连接MySQL数据库成功!' . '<br />';
    }
    // 使用utf8字符集防止乱码产生
    mysqli_set_charset($connect,DB_CHARSET);

?>

