#  <#Title#>Mac下搭建PHP+nginx+MySQL
## （使用nginx前先关闭apache，否则两个服务器同时运行将冲突）
## 1.安装homebrew
homebrew是mac下非常好用的包管理器，会自动安装相关的依赖包，将你从繁琐的软件依赖安装中解放出来。

```
/usr/bin/ruby -e "$(curl -fsSLhttps://raw.githubusercontent.com/Homebrew/install/master
/install)"
```

homebrew常用相关命令
```
brew -v #查看版本信息
brew help #查看帮助信息
brew update #更新可安装包的最新信息，建议每次安装前都运行下
brew search pkg_name #搜索相关的包信息
brew install pkg_name #安装包
```

## 2.安装PHP（略）
在“Mac下搭建PHP+apache+MySQL”中可找到相关步骤

## 3.安装nginx

```
brew search nginx
brew install nginx
```

nginx常用相关命令
```
sudo nginx #打开 nginx
nginx -s reload|reopen|stop|quit  #重新加载配置|重启|停止|退出 nginx
nginx -t   #测试配置是否有语法错误
```

nginx配置
```
cd /usr/local/etc/nginx/
mkdir conf.d
vim nginx.conf                      #进入配置nginx.conf
vim ./servers/default.conf          #创建并进入配置default.conf
vim /usr/local/etc/nginx/php-fpm    #创建并进入配置php-fpm
```

将以下信息覆盖 **nginx.conf** 
```
worker_processes  1;

error_log   /usr/local/var/log/nginx/error.log debug;
pid        /usr/local/var/run/nginx.pid;

events {
worker_connections  256;
}

http {
include       mime.types;
default_type  application/octet-stream;

log_format  main  '$remote_addr - $remote_user [$time_local] "$request" '
'$status $body_bytes_sent "$http_referer" '
'"$http_user_agent" "$http_x_forwarded_for"';

access_log  /usr/local/var/log/nginx/access.log  main;

sendfile        on;
keepalive_timeout  65;
port_in_redirect off;

include /usr/local/etc/nginx/servers/*;
}
```

在 **default.conf** 中输入以下内容：
```
server {
listen       80;
server_name  localhost;
root         /usr/local/var/www/default;

access_log  /usr/local/var/log/nginx/default.access.log  main;

location / {
index  index.html index.htm index.php;
autoindex   on;
include     /usr/local/etc/nginx/php-fpm;
}

error_page  404     /404.html;
error_page  403     /403.html;
}
```

在 **php-fpm** 中输入以下内容：
```
location ~ \.php$ {
try_files                   $uri = 404;
fastcgi_pass                127.0.0.1:9000;
fastcgi_index               index.php;
fastcgi_intercept_errors    on;
include /usr/local/etc/nginx/fastcgi.conf;
}
```

建立站点根目（存放项目）：/usr/local/var/www/default
并建立PHP测试文件
```
mkdir /usr/local/var/www/default
vi /usr/local/var/www/default/info.php #输入 <?php  phpinfo();
```

## 4.开启php-fpm，并（开启）重启nginx服务

```
php-fpm -D
```

```
sudo nginx #若已经开启则重启：sudo nginx -s reload
```


