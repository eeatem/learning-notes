<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/30
 * Time: 12:41
 * Func: 存放自定义函数
 */
    // 个人资料所在地选择框
    $province=array('北京','天津','上海','重庆','河北','山西','辽宁','吉林','黑龙江', '江苏','浙江',
                    '安徽','福建','江西','山东','河南','湖北','湖南','广东','海南','四川', '贵州',
                    '云南','陕西','甘肃','青海','台湾','内蒙古','广西','西藏', '宁夏',
                    '新疆','香港','澳门');
    function html_introduce_location($array){
        foreach($array as $value){
            echo"<option value='$value'>$value</option>";
        }
    }

    //转换html的空格字符
    function html_replace_space($content){
        $content = str_replace(' ', '&nbsp;', $content);
        return $content;
    }
?>