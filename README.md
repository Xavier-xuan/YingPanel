# YingPanel
FrozenGo 非官方控制面板


# 安装
下文将假设你已经假设好了 Web 服务器的情况下进行说明。如果还没有假设好 Web 服务器，我们推荐您使用 [Laradock](https://github.com/laradock/laradock)

## 环境要求
+ Apache2
+ PHP 7.0+  
+ Mysql 5.7+
+ Composer


## 基础安装
### 1.克隆源代码
克隆源代码到本地：
```
git clone https://github.com/Seth8277/YingPanel.git 
```

### 2.设置 Web 根目录
请将 Public 设置成您的 Web 根目录

以下是一份标准的 Apache 配置文件，您可以在修改后写入site文件夹中
```
<VirtualHost *:80>
    DocumentRoot "/to/your/public/folder"
    ServerName your.domain.com
    ServerAlias your.domain.com
    ServerAdmin email@your.com
    ErrorLog logs/dev-error.log
    CustomLog logs/dev-access.log common 
    <Directory "/to/your/public/folder">
        Options Indexes FollowSymLinks
        AllowOverride All
        Order Allow,Deny
        Allow from all
        RewriteEngine on
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteRule ^(.*)$ index.php/$1 [QSA,PT,L]
    </Directory>
</VirtualHost>
```

### 3. 安装扩展包依赖
```
composer install
```

### 4. 生成配置文件 && 密匙
```
cp .env.example .env
php artisan key:generate
```
请用编辑器打开 .env 填写相关信息

### 5. 执行数据库迁移
如果您使用的是 Laradock 或者其他虚拟容器的话，您需要切换到容器内（能连接到数据库）执行以下命令
```
php artisan migrate
```

至此，安装就已经结束了。
管理员帐号： admin@local.com
管理员密码： admin
请尽快修改以免发生意外！

