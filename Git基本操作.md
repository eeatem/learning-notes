***
### 1.创建版本库
***
##### 创建版本库
git init [folder]
##### 进入本地磁盘
cd x:
##### 进入下一目录(文件夹)
cd <folder\name>
***
### 2.新建文件
***
##### 直接新建文件
touch <file>
##### 新建文件并进入编辑状态
vi <file> <br >
1.(若该文件已存在直接进入编辑模式) <br >
2.(默认处于命令模式，按i键后切换到编辑模式) <br >
3.(按esc退出编辑模式，输入‘:wq’保存编辑并退出) 
##### 删除文件
rm -rf <file>
***
### 3.添加文件	
***
##### 将指定文件添加到版本库
git add <file>
##### 将所有文件添加到版本库
git add .
##### 提交[添加标签]
git commit [-m message]
##### 注释当前版本
git tag <-a tag> [-m message]
***
### 查看状态	
***
##### 查看版本库的未提交内容
git status
##### 查看版本库修改内容
git diff <file>
##### 查看提交日志
###### (-p 包括修改内容)
###### (--oneline 版本单行显示)
###### (--all 显示所有日志)
###### (--graph 图形化显示)
git log [-p] [--oneline] [--all] [--graph]
##### 列出所有注释版本
git <tag>
##### 查看注释版本信息
git show <tag>
***
### 选择版本
***
##### 选择版本
git checkout <id> <tag>
##### 回退到上一个版本
git checkout - 
***
### 分支
***
##### 创建分支
git branch <branch>
##### 创建并选择分支
git checkout <-b branch>
##### 切换分支
git checkout <branch>
##### 将其他分支合并到当前所在分支
git merge <branch>
***
### 远程仓库	
***
##### 查看远程仓库
git remote
##### 添加远程仓库
git remote add <name> <remote address>
##### 上传
git push <-u name> <branch>
##### 拷贝仓库
git clone <address>
##### 更新仓库
git pull
***