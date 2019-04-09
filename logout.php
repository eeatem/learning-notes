<?php
    /**
     * Created by PhpStorm.
     * User: Administrator
     * Date: 2019/3/30
     * Time: 18:52
     * Func: 注销账户
     */
    session_start();
    // 清空用户登陆的session信息
    session_unset();
    session_destroy();

    echo '账户注销成功！欢迎您下次使用本系统！';
    echo "<a href='home.php'><input type='button' value='返回首页'/></a>";

?>