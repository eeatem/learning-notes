/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.1.49-community : Database - db_weibo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_weibo` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `db_weibo`;

/*Table structure for table `t_introduce` */

DROP TABLE IF EXISTS `t_introduce`;

CREATE TABLE `t_introduce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) DEFAULT NULL,
  `birthday_year` varchar(5) DEFAULT NULL,
  `birthday_month` varchar(2) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `hobby1` varchar(30) DEFAULT NULL,
  `hobby2` varchar(30) DEFAULT NULL,
  `hobby3` varchar(30) DEFAULT NULL,
  `hobby4` varchar(30) DEFAULT NULL,
  `hobby5` varchar(30) DEFAULT NULL,
  `hobby6` varchar(30) DEFAULT NULL,
  `label` varchar(100) DEFAULT NULL,
  `introduce` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

/*Data for the table `t_introduce` */

insert  into `t_introduce`(`id`,`user_name`,`birthday_year`,`birthday_month`,`location`,`hobby1`,`hobby2`,`hobby3`,`hobby4`,`hobby5`,`hobby6`,`label`,`introduce`) values (1,'','2017','2','天津','摄影','','','滑雪','绘画','','',''),(2,'John','2012','4','上海','摄影','','','滑雪','绘画','','',''),(3,'John','1998','6','河北','','游泳','射箭','','','打游戏','不要迷恋哥，哥只是哥传说','就读于广东工业大学计算机专业。'),(6,'John','2017','2','上海','摄影 ',' ','射箭 ',' ',' ','','',''),(7,'John','2014','2','上海',' ','游泳 ','射箭 ',' ',' ','','',''),(8,'John','2013','7','重庆','摄影 ',' ',' ','滑雪 ',' ','开车','不要迷恋哥，哥只是哥传说！','毕业于罗东中学\r\n！'),(9,'John','2008','4','上海','摄影 ','游泳 ',' ',' ',' ','LOL','天空一声巨响，老子闪亮登场','毕业于罗定中学'),(10,'','2016','3','山西',' ','游泳 ','射箭 ',' ',' ','','',''),(11,'','1999','11','广东',' ',' ','射箭 ','滑雪 ',' ','PUBG','周杰伦最棒！','毕业于大山小学！'),(12,'John','2015','5','河北','摄影 ',' ','射箭 ',' ',' ','','',''),(13,'','2017','3','上海',' ','游泳 ',' ',' ',' ','LOL','77777777777','77888888888888888'),(14,'林震123','2014','5','重庆','摄影 ',' ',' ',' ',' ','LOL','123456','asdvxcb'),(15,' 林震123','2014','4','上海','摄影 ',' ',' ',' ',' ','开车','1231','123313'),(16,'林震123','2017','2','上海',' 摄影 ',' ',' ',' ',' ','','1231','51111'),(17,'John','1999','1','广东',' 摄影 ',' ',' ',' ','绘画 ','LOL','不要迷恋哥','就读于广东工业大学'),(18,'John','2019','1','北京','  ','游泳 ','射箭 ',' ',' ','','哥只是个传说','毕业于广东工业大学'),(19,'John   121111345','2014','3','北京',' 摄影 ','游泳 ',' ',' ',' ','','',''),(20,'','2018','3','上海','  ',' ',' ',' ',' ','','',''),(21,'','2014','5','山西','  ',' ',' ',' ',' ','','',''),(22,'林震','2010','10','广东',' 摄影 ',' ',' ',' ','绘画 ','LOL','111','222'),(25,'manager','1985','8','北京',' 摄影 ',' ',' ','滑雪 ',' ','LOL','不要迷恋哥','就读于广工'),(26,'user','2015','5','上海','  ',' ',' ',' ',' ','','',''),(27,'user','1959','6','内蒙古',' 摄影 ',' ',' ','滑雪 ',' ','打游戏','buyaomiliange','biyeyuguangdong'),(28,'user','1921','7','澳门',' 摄影 ',' ',' ',' ',' ','PUBG','不要迷恋哥','毕业于广东'),(29,'manager','1940','4','黑龙江',' 摄影 ',' ',' ',' ',' ','开车','哥只是个传说','就读于广东高等院校'),(30,'user','2019','1','北京','  ',' ',' ',' ',' ','','',''),(31,'user','1922','11','内蒙古',' 摄影 ',' ','射箭 ',' ',' ','开车','不要迷','就读于广东'),(32,'user','2014','2','上海',' 摄影 ','游泳 ',' ',' ',' ','','1111111','22222222'),(33,'manager','2009','5','河北','  ','游泳 ','射箭 ',' ',' ','LOL','111111','2222222222'),(34,'林震','2017','2','上海','  ',' ',' ',' ',' ','','',''),(35,'John','2013','4','河北','  ',' ',' ',' ',' ','','',''),(36,'John','1999','4','上海','  ','游泳 ','射箭 ',' ',' ','LOL','111','222');

/*Table structure for table `t_user` */

DROP TABLE IF EXISTS `t_user`;

CREATE TABLE `t_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `gender` char(3) DEFAULT NULL,
  `register_time` date DEFAULT NULL,
  `is_manager` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

/*Data for the table `t_user` */

insert  into `t_user`(`id`,`user_name`,`email`,`password`,`gender`,`register_time`,`is_manager`) values (64,'manager','123456@qq.com','e10adc3949ba59abbe56e057f20f883e','男','2019-03-31',1),(67,'John','12115151@qq.com','e10adc3949ba59abbe56e057f20f883e','男','2019-03-31',0),(68,'user','123asdaaa1@qq.com','e10adc3949ba59abbe56e057f20f883e','男','2019-03-31',0),(69,'林震','1211131@qq.com','e10adc3949ba59abbe56e057f20f883e','男','2019-04-02',0),(70,'Amy123','amy@qq.com','e10adc3949ba59abbe56e057f20f883e','女','2019-04-08',0);

/*Table structure for table `t_weibo_record` */

DROP TABLE IF EXISTS `t_weibo_record`;

CREATE TABLE `t_weibo_record` (
  `user_name` varchar(30) DEFAULT NULL,
  `weibo_type` varchar(20) DEFAULT NULL,
  `weibo_content` varchar(600) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;

/*Data for the table `t_weibo_record` */

insert  into `t_weibo_record`(`user_name`,`weibo_type`,`weibo_content`,`id`) values ('John','娱乐','44444444444444444444',49),('John','体育','555555555555555555555555555',50),('John','技术','6666666666666666666666666666',51),('John','生活','777777777777777777777777',52),('John','娱乐','88888888888888888888888888',53),('John','生活','11111111111111111111',54),('John','生活','1111111111',55),('John','生活','11111',56),('林震','生活','1111111111111',58),('林震','科学','2222222222222',59),('user','生活','5555555555555555555555555',77),('user','技术','666666666666666666666666666',78),('user','科学','777777777777777777777777',79),('user','体育','88888888888888888888',80),('user','体育','999999999999999999999999',81),('user','科学','000000000000000000000000',82),('林震','生活','唉！今天云台过载发烫了，有点怕怕，加点钱卖了，小赚一波美滋滋！',85),('John','生活','1111111111111222222222222222333333333333333',86),('John','技术','1111111111',87);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
