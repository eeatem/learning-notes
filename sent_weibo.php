<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>发送微博</title>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/26
 * Time: 23:57
 * Func: 实现发微博功能
 */

    session_start();
    // 调用数据库连接文件
    include 'connection.php';
    // 防止报错，初始化错误信息变量
    $userName='';
    $weiboType='';
    // 调用已登陆用户的用户名
    $userName=$_SESSION['userNameTemp'];
        // echo $userName;
    // 收集用户填写在表单中的信息
    $weiboType=$_POST['weiboType'];
    $weiboContent=$_POST['weiboContent'];
    // 获取用户输入微博正文的长度
    $len=strlen($weiboContent);

    // 用户提交表单后
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // 获取该用户发送微博前最新一条微博的id
        $sql    = "select max(id) from t_weibo_record";
        $result = mysqli_query($connect, $sql);
        $row    = mysqli_fetch_array($result);
        $id1    = $row[0];

        // 若记录用户已发送微博的表为空
        if(empty($row[0])){
            $id1=-1;
        }
            // echo $id1;

        // 编写一句SQL将用户发送的微博插入到数据库的表中
        $sql = "INSERT INTO t_weibo_record (`user_name`,`weibo_type`,`weibo_content`) 
                values ('$userName', '$weiboType', '$weiboContent')";
        mysqli_query($connect, $sql);

        // 获取最新一条微博的id
        $sql    = "select max(id) from t_weibo_record";
        $result = mysqli_query($connect, $sql);
        $row    = mysqli_fetch_array($result);
        $id2    = $row[0];
    }

?>

<!-- 微博类型下拉选择标签 -->
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <label>微博类型</label>
    <select name="weiboType">
        <option value="生活">生活</option>
        <option value="科学">科学</option>
        <option value="技术">技术</option>
        <option value="娱乐">娱乐</option>
        <option value="体育">体育</option>
    </select><br>
    <!-- 微博正文输入文本框及其规格 -->
    <textarea rows="10" cols="100" name="weiboContent"></textarea><br>
    <input type="submit" value="发送"/>
    <?php echo '（注意：限输入200字）' ?>
</form>

</body>
</html>

<?php
// 若成功插入新的微博信息 且 微博正文不超过200字（汉字）
if($id2>$id1 && $len<=600){
    echo '微博发送成功！';
}
// 微博正文超过200字（汉字）
if($len>600){
    echo '超出输入限制，请重新输入！';
}

?>