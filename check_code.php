<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/8
 * Time: 23:46
 * Func:实现验证码功能
 * Step: 生成随机数 -> 创建图片 -> 随机数写入图片 -> 通过SESSION保存
 */
    session_start();

    // 创建四个十六进制随机数并转换为十六进制
    for($i=0;$i<4;$i++){
        $randNumber .= dechex(rand(0, 15));
    }
    // 通过SESSION保存验证码的值
    $_SESSION['checkCode']=$randNumber;
    // 生成背景图片
    $im=imagecreatetruecolor(65,25);
    // 设置颜色
    $bg=imagecolorallocate($im,0,0,0);
    $te=imagecolorallocate($im,255,255,255);
    // 把字符串写在图像左上角
    imagestring($im,rand(3,6),rand(1,25),rand(1,10),$randNumber,$te);
    // 输出图像
    header("Content-type: image/jpeg");
    imagejpeg($im);
?>