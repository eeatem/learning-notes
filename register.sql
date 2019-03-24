-- 创建一个用户表
create table t_user(
	`id` int not NULL auto_increment,
	`user_name` varchar(30),
	`email` varchar(100),
	`password` varchar(100),
	`gender` char(3),
	`register_time` date,
	primary key(`id`)
);

-- 插入用户注册信息
INSERT INTO t_user (`user_name`, `email`, `password`, `gender`, `register_time`) values ('$userName', '$email', '$password', '$gender', curdate());

-- 检测用户名是否被占用/是否存在
SELECT user_name FROM t_user WHERE user_name='$userName';

-- 检测用户名是否与密码匹配
SELECT password FROM t_user WHERE (user_name='$userName') and (password='$password')