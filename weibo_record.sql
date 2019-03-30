-- 创建一个记录用户已发微博的表
create table t_weibo_record(
	user_name varchar(30),
	weibo_type varchar(20),
	weibo_content varchar(600)
);

INSERT INTO t_weibo_record values ('$userName', '$weiboType', '$weitoContent');