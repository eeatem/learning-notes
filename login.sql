-- 检测用户名或注册邮箱是否存在
SELECT user_name, email FROM t_user WHERE user_name='$userName' or email='$userName';

-- 检测用户名是否与密码匹配
SELECT password FROM t_user WHERE (user_name='$userName') and (password='$password');

-- 检测邮箱所属用户是否与密码匹配
SELECT email, password FROM t_user WHERE (email='$userName') and (password='$password');

-- 查询与用户输入邮箱对应的用户昵称
select user_name from t_user where email='$userName';

