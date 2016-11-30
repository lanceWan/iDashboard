# iDashboard - Laravel5.3基本的权限管理系统

**当前分支为Laravel版本~，[Vue2.0版本戳这里](https://github.com/lanceWan/iDashboard/tree/vue-2.0) ,Vue2.0只完成了部分，用户管理，权限管理以及角色管理，其他的都还没有做。本人时间有限，重复的增删改查不想写了，代码共参考，近期会出Laravel5.3和Vue2.0的视频教程。请关注博客！[http://iwanli.me](http://iwanli.me)**

----

基于Laravel5.3的后台管理系统，实现最基本的后台框架：权限、角色、菜单、用户、日志功能，后台主题是用的 [INSPINIA - Responsive Admin Theme](https://wrapbootstrap.com/theme/inspinia-responsive-admin-theme-WB0R5L90S) 主题，本人代码完全开源，至于主题只供学习交流。如需商业应用请自行购买授权！


![](http://cache.iwanli.me/iDashboard_log_index.png)
![](http://cache.iwanli.me/iDashboard_menu_list.png)
![](http://cache.iwanli.me/iDashboard_permission_list.png)

在 [Laravel5.2 iAdmin](https://github.com/lanceWan/IAdmin) 基础上升级为 `Laravel5.3` ,同时优化了很多代码，代码模式更改。本后台打算一直更新下去并持续集成，下面是接下来要添加的功能：

* 后台首页统计相关信息
* ~~系统报错发送邮件(队列发送)~~
* 系统配置功能
* ~~即时通知~~(即时通知已经测试完成，打算结合Vue来使用)
*  `Media Manager` 资源管理(本地和七牛)
* 在线 IM 聊天
* **基于 `iDashboard` 的个人博客计划**
* ~~**基于 `iDashboard` 代码将css、js用 [Laravel Elixir](https://laravel.com/docs/5.3/elixir) 管理。Blade视图与 Vuejs2.0 结合管理**（暂停开发，出视频教程）~~

OK,这是目前想要完善的地方，可能冒出其他的灵感。待续...

## 待解决问题

* ~~后台验证码图片显示不出来问题~~

## 安装
下载本项目代码到本地:

```
git clone https://github.com/lanceWan/iDashboard.git
```

进入到项目然后 `composer` 安装:

```
cd iDashboard

composer install
```

配置 `.env` 文件:

```
[sudo]cp .env.example .env
```

> Linux 和 Mac 下注意执行权限 !

配置数据库和日志:

```
DB_HOST=localhost
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret

# log日志包配置，这里固定这么写(后面考虑去掉)
APP_LOG=daily
```

迁移数据:

```
php artisan migrate --seed
```

OK,项目已经配置完成，直接访问首页然后登录即可，不清楚路由的可以直接去看 `routes/web.php` 文件。默认管理员账号：`iwanli` , 密码：`123456` 。如果你是在Linux或Mac下配置的请注意相关目录的权限，这里我就不多说了，enjoy！

如有什么错误的地方，请指点，非常感谢！也可以直接联系我QQ：709344897 。现阶段比较忙，没有太多时间给各位一一解答，希望理解！

# 错误邮件发送
发送错误邮件请先配置好邮件发送服务器，具体看官方文档或者中文文档。

```php
# 邮件地址
MAIL_ADRESS=null
# 发件人名称
MAIL_NAME=null
# 错误邮件发送地址
MAIL_SYSTEMERROR=null
```

最后一个错误邮件发送地址是系统报错后接收的邮箱地址，默认为空（空值的情况下是不会进行发送邮件）。队列默认情况下是本地实时发送，换其他的发送驱动请参考文档上设置即可。

## 扩展包

* [验证码](https://github.com/mewebstudio/captcha)
* [Redis驱动(暂未使用)](https://github.com/nrk/predis)
* [l5-repository](https://github.com/andersao/l5-repository)
* [权限包](https://github.com/GeniusTS/roles)
* [Flash提示](https://github.com/laracasts/flash)
* [active高亮](https://github.com/letrunghieu/active)
* [LogViewer日志](https://github.com/ARCANEDEV/LogViewer)

> Redis在本后台中可以选择性的使用，看你个人爱好，如要启动，直接在 `.env` 文件中将缓存驱动改为 Reids 即可。目前后台没有做状态管理，后期升级的话只能自定义 blade 或者在这个权限包的基础上改一些代码(又是耗时间的事情。。)。日志包改得改得面目前非，增加了权限判断，页面优化等。

## License
The iDashboard is open-sourced software licensed under the [MIT](https://opensource.org/licenses/MIT) license.