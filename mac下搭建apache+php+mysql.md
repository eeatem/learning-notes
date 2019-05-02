## 由于mac系统自带apache和php，直接在终端开启服务即可。
***
### 开启apache
```
sudo apachectl start 
```
在浏览器中输入 **localhost:80(80是默认端口)** 若显示 **It works!** 则表明apache开启成功。<br >
### apache常用命令
启动apache: **sudo apachectl start** <br >
重启apache: **sudo apachectl restart** <br >
停止apache: **sudo apachectl stop** <br >
查看apache: **sudo apachectl -v** <br >
***
### 开启php（忽略此步骤将导致php.ini配置修改后不能生效）
打开finder 使用快捷键 **command+shift+g** 搜索 **/etc**文件夹 并在 **/etc/apache2** 目录下打开 **httpd.conf** 在文件中搜索 **LoadModule php** 把该行中的 **#** 去掉并保存（若提示无法写入，可直接拷贝该文件修改后再在该目录中直接进行替换）
### 在phpstorm中配置php
若不能直接使用mac自带的php，出现 **php-cgi not found** 提示，则可以自行安装php。<br >
（在终端中运行命令 **curl -s http://php-osx.liip.ch/install.sh | bash -s 7.2** 即可自动进行安装)
### 关闭php notice/waring级别提示
在php文件内加入：
```
error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL ^ E_WARNING);
```
***
### mac终端进入MySQL
```
/usr/local/MySQL/bin/mysql -u root -p
```
### MySQL 修改初始化密码
1.在 **系统偏好设置** 中关闭MySQL服务<br >
2.进入终端中输入：
``` 
cd /usr/local/mysql/bin/ 
```
回车 <br >
登陆管理员权限：
```
sudo su
```
回车 <br >
禁止MySQL验证功能：
```
./mysqld_safe —skip-grant-tables &
```
回车后MySQL自动重启（系统偏好设置中MySQL的状态变成running）<br >
3.输入命令：
```
./mysql
```
回车
```
flush privileges;
```
回车
```
set password for `root`@`localhost`=password(‘新密码’);
```
### MySQL导入数据库
```
mysql -u root -p
use db_name;
source
```
‘source’后面的内容可以直接将.sql文件直接拖拽至终端即可自动补全其文件目录
### MySQL导出数据库
```
cd /Users/eeatem/Desktop
mysql -u root -p db_name [t_name] > db_name.sql;
```
1.首先输入导出的数据库文件的目录 <br>
2.导出数据库或数据库中的某一个表，并给文件命名
***
### 导出数据库时mac终端出现 **Operation not permitted**
1.重启mac进入恢复模式 <br>
2.在菜单栏中进入终端，输入命令： **csrutil disable** <br>
3.重启Mac在终端查看rootless状态： **csrutil status** 此时rootless已经关闭 <br>
4.若需要开启rootless机制，第2步中命令改为： **csrutil enable**
### 导出数据库时Mac终端出现 **mysqldump: command not found**
1.打开终端输入： **vi ~/.bash_profile** <br>
2.按‘i’键后输入三行代码：
```
#mysql
PATH=$PATH:/usr/local/mysql/bin 
export
```
3.输入‘:wq’保存退出
4.最后在终端输入：**source ~/.bash_profil** 即可
