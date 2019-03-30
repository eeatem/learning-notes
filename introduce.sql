create table t_introduce(
	`birthday` date not NULL,
	`hobby` varchar(30),
	`location` varchar(50),
	`label` varchar(100), -- 限输入30字
	`introduce` varchar(300) -- 限输入100字
);