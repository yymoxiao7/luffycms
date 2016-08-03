/*
Navicat MySQL Data Transfer

Source Server         : luffyzhao
Source Server Version : 50712
Source Host           : 139.129.93.215:3306
Source Database       : shopping

Target Server Type    : MYSQL
Target Server Version : 50712
File Encoding         : 65001

Date: 2016-06-14 16:32:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for aricle
-- ----------------------------
DROP TABLE IF EXISTS `aricle`;
CREATE TABLE `aricle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL COMMENT '所属分类',
  `title` varchar(255) NOT NULL,
  `keyword` varchar(100) DEFAULT NULL COMMENT '关键词',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `thumbnail` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `content` text,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `sort` int(11) NOT NULL DEFAULT '255' COMMENT '排序',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of aricle
-- ----------------------------
INSERT INTO `aricle` VALUES ('1', '3', 'PHP依赖管理工具Composer入门教程', '管理工具,require,日志记录,程序,项目', 'Composer 是 PHP 的一个依赖管理工具。它允许你申明项目所依赖的代码库，它会在你的项目中为你安装他们。\r\n\r\n依赖管理\r\n\r\nComposer 不是一个包管理器。是的，它涉及 \"packag', '\\static\\aricle-thumbnail\\20160612\\82e180ee55b7fa1d2eb4d389c5f6b223.jpg', '<span style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;line-height:25px;background-color:#FFFFFF;\">Composer 是 PHP 的一个依赖管理工具。它允许你申明</span><a href=\"http://www.07net01.com/tags-%E9%A1%B9%E7%9B%AE-0.html\" target=\"_blank\" class=\"infotextkey\">项目</a><span style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;line-height:25px;background-color:#FFFFFF;\">所依赖的代码库，它会在你的项目中为你安装他们。</span><br />\r\n<br />\r\n<strong>依赖管理</strong><br />\r\n<span></span><br />\r\n<span style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;line-height:25px;background-color:#FFFFFF;\">Composer 不是一个包管理器。是的，它涉及 \"</span><a href=\"http://www.07net01.com/tags-package-0.html\" target=\"_blank\" class=\"infotextkey\">package</a><span style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;line-height:25px;background-color:#FFFFFF;\">s\" 和 \"libraries\"，但它在每个项目的基础上进行管理，在你项目的某个目录中（例如 vendor）进行安装。默认情况下它不会在全局安装任何东西。因此，这仅仅是一个依赖管理。</span><br />\r\n<br />\r\n<span style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;line-height:25px;background-color:#FFFFFF;\">这种想法并不新鲜，Composer 受到了 node\'s npm 和 ruby\'s bundler 的强烈启发。而当时 PHP 下并没有类似的工具。</span><br />\r\n<br />\r\n<span style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;line-height:25px;background-color:#FFFFFF;\">Composer 将这样为你解决问题：</span><br />\r\n<span style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;line-height:25px;background-color:#FFFFFF;\">你有一个项目依赖于若干个库。</span><br />\r\n<span style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;line-height:25px;background-color:#FFFFFF;\">其中一些库依赖于其他库。</span><br />\r\n<span style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;line-height:25px;background-color:#FFFFFF;\">你声明你所依赖的东西。</span><br />\r\n<span style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;line-height:25px;background-color:#FFFFFF;\">Composer 会找出哪个版本的包需要安装，并安装它们（将它们下载到你的项目中）。</span><br />\r\n<br />\r\n<span style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;line-height:25px;background-color:#FFFFFF;\">参考：http://www.lai18.com/content/319715.html</span><br />\r\n<span style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;line-height:25px;background-color:#FFFFFF;\">http://docs.phpcomposer.com/00-intro.md</span><span style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;line-height:25px;background-color:#FFFFFF;\"> </span><br />\r\n<strong>声明依赖关系</strong><br />\r\n<br />\r\n<span style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;line-height:25px;background-color:#FFFFFF;\">比方说，你正在创建一个项目，你需要一个库来做日志记录。你决定使用 monolog。为了将它添加到你的项目中，你所需要做的就是创建一个 composer.json 文件，其中描述了项目的依赖关系。</span><br />\r\n<br />\r\n<p style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;background-color:#FFFFFF;\">\r\n	{ \"require\": { \"monolog/monolog\": \"1.2.*\" } }<br />\r\n我们只要指出我们的项目需要一些 monolog/monolog 的包，从 1.2 开始的任何版本。<br />\r\n<strong>系统要求</strong><br />\r\n运行 Composer 需要 PHP 5.3.2+ 以上版本。一些敏感的 PHP 设置和编译标志也是必须的，但对于任何不兼容项安装<a href=\"http://www.07net01.com/tags-%E7%A8%8B%E5%BA%8F-0.html\" target=\"_blank\" class=\"infotextkey\">程序</a>都会抛出警告。<br />\r\n我们将从包的来源直接安装，而不是简单的下载 zip 文件，你需要 git 、 svn 或者 hg ，这取决于你载入的包所使用的版本<a href=\"http://www.07net01.com/tags-%E7%AE%A1%E7%90%86%E7%B3%BB%E7%BB%9F-0.html\" target=\"_blank\" class=\"infotextkey\">管理系统</a>。<br />\r\nComposer 是多平台的，我们努力使它在 <a href=\"http://www.07net01.com/\" target=\"_blank\" class=\"infotextkey\">Windows</a> 、 <a href=\"http://www.07net01.com/linux/\" target=\"_blank\" class=\"infotextkey\">linux</a> 以及 OSX 平台上运行的同样出色。<br />\r\n<strong>Linux/Unix下安装<br />\r\n局部安装</strong><br />\r\n要真正获取 Composer，我们需要做两件事。首先安装 Composer （同样的，这意味着它将下载到你的项目中）：\r\n</p>\r\n<p style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;background-color:#FFFFFF;\">\r\n	curl -sS https://getcomposer.org/installer | php<br />\r\n注意： 如果上述方法由于某些原因失败了，你还可以通过 php &gt;下载安装器：\r\n</p>\r\n<p style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;background-color:#FFFFFF;\">\r\n	php -r \"readfile(\'https://getcomposer.org/installer\');\" | php<br />\r\n这将检查一些 PHP 的设置，然后下载 composer.phar 到你的工作目录中。这是 Composer 的<a href=\"http://www.07net01.com/tags-%E4%BA%8C%E8%BF%9B%E5%88%B6-0.html\" target=\"_blank\" class=\"infotextkey\">二进制</a>文件。这是一个 PHAR 包（PHP 的归档），这是 PHP 的归档格式可以帮助用户在命令行中执行一些操作。<br />\r\n你可以通过 --install-dir 选项指定 Composer 的安装目录（它可以是一个绝对或相对路径）：\r\n</p>\r\n<p style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;background-color:#FFFFFF;\">\r\n	curl -sS https://getcomposer.org/installer | php -- --install-dir=bin<br />\r\n<strong>全局安装</strong><br />\r\n你可以将此文件放在任何地方。如果你把它放在系统的 PATH 目录中，你就能在全局访问它。 在类Unix系统中，你甚至可以在使用时不加 php 前缀。<br />\r\n你可以执行这些命令让 composer 在你的系统中进行全局调用：\r\n</p>\r\n<p style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;background-color:#FFFFFF;\">\r\n	curl -sS https://getcomposer.org/installer | phpmv composer.phar /usr/local/bin/composer <br />\r\n注意： 如果上诉命令因为权限执行失败， 请使用 sudo 再次尝试运行 mv 那行命令。 现在只需要运行 composer 命令就可以使用 Composer 而不需要输入 php composer.phar。<br />\r\n<strong>全局安装 (on OSX via homebrew)</strong><br />\r\nComposer 是 homebrew-php 项目的一部分。\r\n</p>\r\n<p style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;background-color:#FFFFFF;\">\r\n	brew <a href=\"http://www.07net01.com/tags-update-0.html\" target=\"_blank\" class=\"infotextkey\">update</a> brew tap josegonzalez/homebrew-php brew tap homebrew/<a href=\"http://www.07net01.com/tags-version-0.html\" target=\"_blank\" class=\"infotextkey\">version</a>s brew install php55-intl brew install josegonzalez/php/composer<br />\r\n<strong>Windows下安装<br />\r\n使用安装程序</strong><br />\r\n这是将 Composer 安装在你机器上的最简单的方法。<br />\r\n下载并且运行&nbsp;Composer-Setup.exe，它将安装最新版本的 Composer ，并设置好系统的环境变量，因此你可以在任何目录下直接使用 composer 命令。<br />\r\n<strong>手动安装</strong><br />\r\n设置系统的环境变量 PATH 并运行安装命令下载 composer.phar 文件：\r\n</p>\r\n<p style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;background-color:#FFFFFF;\">\r\n	C:\\Users\\username&gt;cd C:\\bin C:\\bin&gt;php -r \"readfile(\'https://getcomposer.org/installer\');\" | php<br />\r\n注意： 如果收到 readfile 错误提示，请使用 http 链接或者在 php.ini 中开启 php_openssl.dll 。 在 composer.phar 同级目录下新建文件 composer.bat ：\r\n</p>\r\n<p style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;background-color:#FFFFFF;\">\r\n	C:\\bin&gt;echo @php \"%~dp0composer.phar\" %*&gt;composer.bat<br />\r\n关闭当前的命令行窗口，打开新的命令行窗口进行测试：\r\n</p>\r\n<p style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;background-color:#FFFFFF;\">\r\n	C:\\Users\\username&gt;composer -V Composer version 27d8904<br />\r\n<strong>使用 Composer</strong><br />\r\n现在我们将使用 Composer 来安装项目的依赖。<br />\r\n要解决和下载依赖，请执行 install 命令：\r\n</p>\r\n<p style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;background-color:#FFFFFF;\">\r\n	php composer.phar install<br />\r\n如果你进行了全局安装，并且没有 phar 文件在当前目录，请使用下面的命令代替：\r\n</p>\r\n<p style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;background-color:#FFFFFF;\">\r\n	composer install<br />\r\n继续 上面的例子，这里将下载 monolog 到 vendor/monolog/monolog 目录。<br />\r\n<strong>自动加载</strong><br />\r\n除了库的下载，Composer 还准备了一个自动加载文件，它可以加载 Composer 下载的库中所有的类文件。使用它，你只需要将下面这行代码添加到你项目的引导文件中：\r\n</p>\r\n<p style=\"color:#444444;font-family:\'Microsoft Yahei\', \'Helvetica Neue\', Helvetica, Arial, sans-serif;font-size:15px;background-color:#FFFFFF;\">\r\n	require \'vendor/autoload.php\';<br />\r\n现在我们就可以使用 monolog 了！\r\n</p>', '1', '255', '1465287817', '1465701575');
INSERT INTO `aricle` VALUES ('2', '3', '日本2015年向中国人发签证数猛增85% 创历史新高', '', '\r\n	环球网报道记者 王欢】 日本外务省6月6日发布统计结果称，2015年面向中国人的签证发放数量比上年约增加85%，达到378.08万份，刷新此前最高纪录。在旅游签证发放条件放宽和日元贬值的背景下，', '\\static\\aricle-thumbnail\\20160607\\c83886962ffa2e23f42118be7d54cd25.jpg', '<p style=\"text-indent:28px;font-size:14px;text-align:justify;color:#2B2B2B;font-family:simsun, arial, helvetica, clean, sans-serif;background-color:#FFFFFF;\">\r\n	环球网报道记者 王欢】 日本外务省6月6日发布统计结果称，2015年面向中国人的签证发放数量比上年约增加85%，达到378.08万份，刷新此前最高纪录。在<a href=\"http://travel.ifeng.com/\" target=\"_blank\">旅游</a>签证发放条件放宽和日元贬值的背景下，团体和个人游客都有大幅增加。以所有外国人为对象的签证发放数为476.83万份，同样创新高。\r\n</p>\r\n<p style=\"text-indent:28px;font-size:14px;text-align:justify;color:#2B2B2B;font-family:simsun, arial, helvetica, clean, sans-serif;background-color:#FFFFFF;\">\r\n	日本共同社6月6日报道说，向中国人发放的签证数占总数的8成左右，占据绝对多数。虽然2012年和2013年该数据因中日围绕钓鱼岛问题引发对立而有所减少，但随着两国关系趋于恢复，签证发放数也日渐增多。\r\n</p>\r\n<p style=\"text-indent:28px;font-size:14px;text-align:justify;color:#2B2B2B;font-family:simsun, arial, helvetica, clean, sans-serif;background-color:#FFFFFF;\">\r\n	2015年统计显示，继中国之后排在第二的是菲律宾的225,676份，比上年增加约38%;第三是印度尼西亚的16.23万份，约增15%。\r\n</p>\r\n<p style=\"text-indent:28px;font-size:14px;text-align:justify;color:#2B2B2B;font-family:simsun, arial, helvetica, clean, sans-serif;background-color:#FFFFFF;\">\r\n	日本外务省6日还发布了2015年10月1日的“在外日侨人数”。在海外居住3个月以上者与永住者合计131.71万人，比上年增长2.1%，创新高。\r\n</p>\r\n<p style=\"text-indent:28px;font-size:14px;text-align:justify;color:#2B2B2B;font-family:simsun, arial, helvetica, clean, sans-serif;background-color:#FFFFFF;\">\r\n	按所在国来分，最多的是美国的41.96万人，其次是中国的13.12万人，再次是<a href=\"http://app.travel.ifeng.com/country_76\" target=\"_blank\">澳大利亚</a>的8.91万人。在中国的日本人比上年减少约2%，自2012年达到峰值后已连减三年。\r\n</p>', '1', '255', '1465288220', '1465288220');

-- ----------------------------
-- Table structure for ariclecategory
-- ----------------------------
DROP TABLE IF EXISTS `ariclecategory`;
CREATE TABLE `ariclecategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `description` varchar(255) DEFAULT '' COMMENT '简介',
  `keyword` varchar(100) DEFAULT NULL COMMENT '关键词',
  `sort` int(11) NOT NULL DEFAULT '255' COMMENT '排序',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ariclecategory
-- ----------------------------
INSERT INTO `ariclecategory` VALUES ('1', '0', '体育', '体育,shan,mqq', '体育,shan,mqq', '255', '1465203618', '1465204885');
INSERT INTO `ariclecategory` VALUES ('3', '1', '篮球', '篮球,科比,詹姆斯', '篮球,科比,詹姆斯', '255', '1465265950', '1465265950');

-- ----------------------------
-- Table structure for backstage_log
-- ----------------------------
DROP TABLE IF EXISTS `backstage_log`;
CREATE TABLE `backstage_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '登录用户id',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '简单说明',
  `ip` varchar(20) NOT NULL COMMENT 'IP地址',
  `create_time` int(11) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`),
  KEY `userId` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=432 DEFAULT CHARSET=utf8mb4 COMMENT='后台操作日志表';

-- ----------------------------
-- Records of backstage_log
-- ----------------------------
INSERT INTO `backstage_log` VALUES ('9', '2', '登录', '127.0.0.1', '1463985788');
INSERT INTO `backstage_log` VALUES ('10', '0', '登录失败,email:[luffyzhao@vip.126.com] password:[12****131]', '127.0.0.1', '1463985959');
INSERT INTO `backstage_log` VALUES ('11', '2', '登录', '127.0.0.1', '1463985996');
INSERT INTO `backstage_log` VALUES ('12', '2', '修改用户组,ID:[14]', '127.0.0.1', '1463986503');
INSERT INTO `backstage_log` VALUES ('13', '2', '删除用户组,ID:[14]', '127.0.0.1', '1463986512');
INSERT INTO `backstage_log` VALUES ('14', '2', '添加用户组,ID:[15]', '127.0.0.1', '1463986536');
INSERT INTO `backstage_log` VALUES ('15', '2', '修改用户组,ID:[15]', '127.0.0.1', '1463986664');
INSERT INTO `backstage_log` VALUES ('16', '2', '删除用户组,ID:[15]', '127.0.0.1', '1463986673');
INSERT INTO `backstage_log` VALUES ('17', '2', '删除用户组,ID:[13]', '127.0.0.1', '1463986704');
INSERT INTO `backstage_log` VALUES ('18', '2', '添加菜单,ID:[12]', '127.0.0.1', '1463986716');
INSERT INTO `backstage_log` VALUES ('19', '2', '修改菜单,ID:[12]', '127.0.0.1', '1463986737');
INSERT INTO `backstage_log` VALUES ('20', '2', '删除菜单,ID:[12]', '127.0.0.1', '1463986748');
INSERT INTO `backstage_log` VALUES ('21', '2', '添加菜单,ID:[13]', '127.0.0.1', '1463987636');
INSERT INTO `backstage_log` VALUES ('22', '2', '添加菜单,ID:[14]', '127.0.0.1', '1463987783');
INSERT INTO `backstage_log` VALUES ('23', '2', '添加菜单,ID:[15]', '127.0.0.1', '1463987851');
INSERT INTO `backstage_log` VALUES ('24', '2', '修改用户组,ID:[1]', '127.0.0.1', '1463987879');
INSERT INTO `backstage_log` VALUES ('25', '2', '修改菜单,ID:[14]', '127.0.0.1', '1463987959');
INSERT INTO `backstage_log` VALUES ('26', '2', '登录', '127.0.0.1', '1464053270');
INSERT INTO `backstage_log` VALUES ('27', '2', '登录', '127.0.0.1', '1464073462');
INSERT INTO `backstage_log` VALUES ('28', '2', '登录', '127.0.0.1', '1464225616');
INSERT INTO `backstage_log` VALUES ('29', '2', '个人资料修改]', '127.0.0.1', '1464234144');
INSERT INTO `backstage_log` VALUES ('30', '2', '个人资料修改]', '127.0.0.1', '1464234157');
INSERT INTO `backstage_log` VALUES ('31', '2', '个人资料修改]', '127.0.0.1', '1464234193');
INSERT INTO `backstage_log` VALUES ('32', '2', '个人资料修改]', '127.0.0.1', '1464234645');
INSERT INTO `backstage_log` VALUES ('33', '2', '个人资料修改]', '127.0.0.1', '1464234659');
INSERT INTO `backstage_log` VALUES ('34', '2', '个人资料修改]', '127.0.0.1', '1464255583');
INSERT INTO `backstage_log` VALUES ('35', '2', '个人资料修改]', '127.0.0.1', '1464255712');
INSERT INTO `backstage_log` VALUES ('36', '2', '个人资料修改]', '127.0.0.1', '1464255747');
INSERT INTO `backstage_log` VALUES ('37', '2', '个人资料修改]', '127.0.0.1', '1464255761');
INSERT INTO `backstage_log` VALUES ('38', '2', '个人资料修改]', '127.0.0.1', '1464256057');
INSERT INTO `backstage_log` VALUES ('39', '2', '个人资料修改]', '127.0.0.1', '1464256073');
INSERT INTO `backstage_log` VALUES ('40', '2', '个人资料修改]', '127.0.0.1', '1464256574');
INSERT INTO `backstage_log` VALUES ('41', '2', '个人资料修改]', '127.0.0.1', '1464256882');
INSERT INTO `backstage_log` VALUES ('42', '2', '个人资料修改]', '127.0.0.1', '1464257062');
INSERT INTO `backstage_log` VALUES ('43', '0', '登录失败,email:[luffyzhao@vip.126.com] password:[1***56]', '127.0.0.1', '1464272975');
INSERT INTO `backstage_log` VALUES ('44', '2', '登录', '127.0.0.1', '1464273075');
INSERT INTO `backstage_log` VALUES ('45', '2', '登录', '127.0.0.1', '1464312099');
INSERT INTO `backstage_log` VALUES ('46', '2', '添加菜单,ID:[16]', '127.0.0.1', '1464312681');
INSERT INTO `backstage_log` VALUES ('47', '2', '修改用户组,ID:[1]', '127.0.0.1', '1464312694');
INSERT INTO `backstage_log` VALUES ('48', '2', '删除用户组,ID:[12]', '127.0.0.1', '1464312704');
INSERT INTO `backstage_log` VALUES ('49', '2', '添加菜单,ID:[17]', '127.0.0.1', '1464312796');
INSERT INTO `backstage_log` VALUES ('50', '2', '修改用户组,ID:[1]', '127.0.0.1', '1464313427');
INSERT INTO `backstage_log` VALUES ('51', '2', '添加菜单,ID:[18]', '127.0.0.1', '1464313489');
INSERT INTO `backstage_log` VALUES ('52', '2', '添加菜单,ID:[19]', '127.0.0.1', '1464313509');
INSERT INTO `backstage_log` VALUES ('53', '2', '添加菜单,ID:[20]', '127.0.0.1', '1464313534');
INSERT INTO `backstage_log` VALUES ('54', '2', '修改用户组,ID:[1]', '127.0.0.1', '1464313869');
INSERT INTO `backstage_log` VALUES ('55', '2', '个人资料修改]', '127.0.0.1', '1464314398');
INSERT INTO `backstage_log` VALUES ('56', '2', '登录', '127.0.0.1', '1464315281');
INSERT INTO `backstage_log` VALUES ('57', '2', '登录', '127.0.0.1', '1464319360');
INSERT INTO `backstage_log` VALUES ('58', '2', '添加菜单,ID:[21]', '127.0.0.1', '1464320817');
INSERT INTO `backstage_log` VALUES ('59', '2', '修改用户组,ID:[1]', '127.0.0.1', '1464320831');
INSERT INTO `backstage_log` VALUES ('60', '2', '添加菜单,ID:[22]', '127.0.0.1', '1464320919');
INSERT INTO `backstage_log` VALUES ('61', '2', '修改菜单,ID:[4]', '127.0.0.1', '1464321536');
INSERT INTO `backstage_log` VALUES ('62', '2', '修改菜单,ID:[5]', '127.0.0.1', '1464321552');
INSERT INTO `backstage_log` VALUES ('63', '2', '修改菜单,ID:[6]', '127.0.0.1', '1464321568');
INSERT INTO `backstage_log` VALUES ('64', '2', '修改菜单,ID:[8]', '127.0.0.1', '1464321707');
INSERT INTO `backstage_log` VALUES ('65', '2', '修改菜单,ID:[9]', '127.0.0.1', '1464321722');
INSERT INTO `backstage_log` VALUES ('66', '2', '修改菜单,ID:[16]', '127.0.0.1', '1464321739');
INSERT INTO `backstage_log` VALUES ('67', '2', '修改菜单,ID:[18]', '127.0.0.1', '1464321758');
INSERT INTO `backstage_log` VALUES ('68', '2', '修改菜单,ID:[19]', '127.0.0.1', '1464321775');
INSERT INTO `backstage_log` VALUES ('69', '2', '修改菜单,ID:[20]', '127.0.0.1', '1464321790');
INSERT INTO `backstage_log` VALUES ('70', '2', '修改用户组,ID:[1]', '127.0.0.1', '1464329553');
INSERT INTO `backstage_log` VALUES ('71', '2', '添加菜单,ID:[23]', '127.0.0.1', '1464331343');
INSERT INTO `backstage_log` VALUES ('72', '2', '添加菜单,ID:[24]', '127.0.0.1', '1464331374');
INSERT INTO `backstage_log` VALUES ('73', '2', '修改用户组,ID:[1]', '127.0.0.1', '1464331399');
INSERT INTO `backstage_log` VALUES ('74', '2', '优化数据表：[backstage_log]', '127.0.0.1', '1464332183');
INSERT INTO `backstage_log` VALUES ('75', '2', '修复数据表：[user]', '127.0.0.1', '1464332275');
INSERT INTO `backstage_log` VALUES ('76', '2', '优化数据表：[uploaded_file]', '127.0.0.1', '1464332277');
INSERT INTO `backstage_log` VALUES ('77', '2', '优化数据表：[rule]', '127.0.0.1', '1464332279');
INSERT INTO `backstage_log` VALUES ('78', '2', '优化数据表：[]', '127.0.0.1', '1464332984');
INSERT INTO `backstage_log` VALUES ('79', '2', '优化数据表：[]', '127.0.0.1', '1464332994');
INSERT INTO `backstage_log` VALUES ('80', '2', '优化数据表：[role]', '127.0.0.1', '1464333011');
INSERT INTO `backstage_log` VALUES ('81', '2', '优化数据表：[user]', '127.0.0.1', '1464333011');
INSERT INTO `backstage_log` VALUES ('82', '2', '优化数据表：[rule]', '127.0.0.1', '1464333011');
INSERT INTO `backstage_log` VALUES ('83', '2', '优化数据表：[uploaded_file]', '127.0.0.1', '1464333011');
INSERT INTO `backstage_log` VALUES ('84', '2', '优化数据表：[role_rule]', '127.0.0.1', '1464333011');
INSERT INTO `backstage_log` VALUES ('85', '2', '优化数据表：[backstage_log]', '127.0.0.1', '1464333011');
INSERT INTO `backstage_log` VALUES ('86', '2', '修复数据表：[role]', '127.0.0.1', '1464333071');
INSERT INTO `backstage_log` VALUES ('87', '2', '修复数据表：[rule]', '127.0.0.1', '1464333071');
INSERT INTO `backstage_log` VALUES ('88', '2', '修复数据表：[backstage_log]', '127.0.0.1', '1464333071');
INSERT INTO `backstage_log` VALUES ('89', '2', '修复数据表：[uploaded_file]', '127.0.0.1', '1464333071');
INSERT INTO `backstage_log` VALUES ('90', '2', '修复数据表：[user]', '127.0.0.1', '1464333071');
INSERT INTO `backstage_log` VALUES ('91', '2', '修复数据表：[role_rule]', '127.0.0.1', '1464333071');
INSERT INTO `backstage_log` VALUES ('92', '0', '登录失败,email:[luffyzhao@vip.126.cn] password:[1***56]', '127.0.0.1', '1464577988');
INSERT INTO `backstage_log` VALUES ('93', '2', '登录', '127.0.0.1', '1464577993');
INSERT INTO `backstage_log` VALUES ('94', '2', '添加菜单,ID:[25]', '127.0.0.1', '1464578136');
INSERT INTO `backstage_log` VALUES ('95', '2', '修改用户组,ID:[1]', '127.0.0.1', '1464578152');
INSERT INTO `backstage_log` VALUES ('96', '2', '备份数据表：[backstage_log]', '127.0.0.1', '1464578166');
INSERT INTO `backstage_log` VALUES ('97', '2', '备份数据表：[role]', '127.0.0.1', '1464578173');
INSERT INTO `backstage_log` VALUES ('98', '2', '备份数据表：[backstage_log]', '127.0.0.1', '1464578173');
INSERT INTO `backstage_log` VALUES ('99', '2', '备份数据表：[rule]', '127.0.0.1', '1464578173');
INSERT INTO `backstage_log` VALUES ('100', '2', '备份数据表：[role_rule]', '127.0.0.1', '1464578173');
INSERT INTO `backstage_log` VALUES ('101', '2', '备份数据表：[uploaded_file]', '127.0.0.1', '1464578173');
INSERT INTO `backstage_log` VALUES ('102', '2', '备份数据表：[user]', '127.0.0.1', '1464578173');
INSERT INTO `backstage_log` VALUES ('103', '2', '备份数据表：[backstage_log]', '127.0.0.1', '1464578375');
INSERT INTO `backstage_log` VALUES ('104', '2', '备份数据表：[backstage_log]', '127.0.0.1', '1464578379');
INSERT INTO `backstage_log` VALUES ('105', '2', '备份数据表：[rule]', '127.0.0.1', '1464578379');
INSERT INTO `backstage_log` VALUES ('106', '2', '备份数据表：[user]', '127.0.0.1', '1464578379');
INSERT INTO `backstage_log` VALUES ('107', '2', '备份数据表：[role]', '127.0.0.1', '1464578379');
INSERT INTO `backstage_log` VALUES ('108', '2', '备份数据表：[uploaded_file]', '127.0.0.1', '1464578379');
INSERT INTO `backstage_log` VALUES ('109', '2', '备份数据表：[role_rule]', '127.0.0.1', '1464578379');
INSERT INTO `backstage_log` VALUES ('110', '2', '修复数据表：[role_rule]', '127.0.0.1', '1464578459');
INSERT INTO `backstage_log` VALUES ('111', '2', '修复数据表：[uploaded_file]', '127.0.0.1', '1464578459');
INSERT INTO `backstage_log` VALUES ('112', '2', '修复数据表：[user]', '127.0.0.1', '1464578459');
INSERT INTO `backstage_log` VALUES ('113', '2', '修复数据表：[backstage_log]', '127.0.0.1', '1464578459');
INSERT INTO `backstage_log` VALUES ('114', '2', '修复数据表：[role]', '127.0.0.1', '1464578459');
INSERT INTO `backstage_log` VALUES ('115', '2', '修复数据表：[rule]', '127.0.0.1', '1464578459');
INSERT INTO `backstage_log` VALUES ('116', '2', '修复数据表：[user]', '127.0.0.1', '1464578555');
INSERT INTO `backstage_log` VALUES ('117', '2', '修复数据表：[role_rule]', '127.0.0.1', '1464578555');
INSERT INTO `backstage_log` VALUES ('118', '2', '修复数据表：[role]', '127.0.0.1', '1464578555');
INSERT INTO `backstage_log` VALUES ('119', '2', '修复数据表：[backstage_log]', '127.0.0.1', '1464578555');
INSERT INTO `backstage_log` VALUES ('120', '2', '修复数据表：[uploaded_file]', '127.0.0.1', '1464578555');
INSERT INTO `backstage_log` VALUES ('121', '2', '修复数据表：[rule]', '127.0.0.1', '1464578555');
INSERT INTO `backstage_log` VALUES ('122', '2', '修复数据表：[role_rule]', '127.0.0.1', '1464578583');
INSERT INTO `backstage_log` VALUES ('123', '2', '修复数据表：[backstage_log]', '127.0.0.1', '1464578583');
INSERT INTO `backstage_log` VALUES ('124', '2', '修复数据表：[user]', '127.0.0.1', '1464578583');
INSERT INTO `backstage_log` VALUES ('125', '2', '修复数据表：[role]', '127.0.0.1', '1464578583');
INSERT INTO `backstage_log` VALUES ('126', '2', '修复数据表：[uploaded_file]', '127.0.0.1', '1464578583');
INSERT INTO `backstage_log` VALUES ('127', '2', '修复数据表：[rule]', '127.0.0.1', '1464578583');
INSERT INTO `backstage_log` VALUES ('128', '2', '修复数据表：[rule]', '127.0.0.1', '1464578638');
INSERT INTO `backstage_log` VALUES ('129', '2', '修复数据表：[backstage_log]', '127.0.0.1', '1464578638');
INSERT INTO `backstage_log` VALUES ('130', '2', '修复数据表：[user]', '127.0.0.1', '1464578638');
INSERT INTO `backstage_log` VALUES ('131', '2', '修复数据表：[role_rule]', '127.0.0.1', '1464578638');
INSERT INTO `backstage_log` VALUES ('132', '2', '修复数据表：[uploaded_file]', '127.0.0.1', '1464578638');
INSERT INTO `backstage_log` VALUES ('133', '2', '修复数据表：[role]', '127.0.0.1', '1464578638');
INSERT INTO `backstage_log` VALUES ('134', '2', '修复数据表：[backstage_log]', '127.0.0.1', '1464578677');
INSERT INTO `backstage_log` VALUES ('135', '2', '修复数据表：[role]', '127.0.0.1', '1464578677');
INSERT INTO `backstage_log` VALUES ('136', '2', '修复数据表：[rule]', '127.0.0.1', '1464578677');
INSERT INTO `backstage_log` VALUES ('137', '2', '修复数据表：[uploaded_file]', '127.0.0.1', '1464578678');
INSERT INTO `backstage_log` VALUES ('138', '2', '修复数据表：[role_rule]', '127.0.0.1', '1464578677');
INSERT INTO `backstage_log` VALUES ('139', '2', '修复数据表：[user]', '127.0.0.1', '1464578678');
INSERT INTO `backstage_log` VALUES ('140', '2', '修复数据表：[backstage_log]', '127.0.0.1', '1464578726');
INSERT INTO `backstage_log` VALUES ('141', '2', '修复数据表：[user]', '127.0.0.1', '1464578726');
INSERT INTO `backstage_log` VALUES ('142', '2', '修复数据表：[role]', '127.0.0.1', '1464578726');
INSERT INTO `backstage_log` VALUES ('143', '2', '修复数据表：[role_rule]', '127.0.0.1', '1464578726');
INSERT INTO `backstage_log` VALUES ('144', '2', '修复数据表：[uploaded_file]', '127.0.0.1', '1464578726');
INSERT INTO `backstage_log` VALUES ('145', '2', '修复数据表：[rule]', '127.0.0.1', '1464578726');
INSERT INTO `backstage_log` VALUES ('146', '2', '修复数据表：[role]', '127.0.0.1', '1464578749');
INSERT INTO `backstage_log` VALUES ('147', '2', '修复数据表：[user]', '127.0.0.1', '1464578749');
INSERT INTO `backstage_log` VALUES ('148', '2', '修复数据表：[uploaded_file]', '127.0.0.1', '1464578749');
INSERT INTO `backstage_log` VALUES ('149', '2', '修复数据表：[rule]', '127.0.0.1', '1464578749');
INSERT INTO `backstage_log` VALUES ('150', '2', '修复数据表：[role_rule]', '127.0.0.1', '1464578749');
INSERT INTO `backstage_log` VALUES ('151', '2', '修复数据表：[backstage_log]', '127.0.0.1', '1464578749');
INSERT INTO `backstage_log` VALUES ('152', '2', '修复数据表：[backstage_log]', '127.0.0.1', '1464578839');
INSERT INTO `backstage_log` VALUES ('153', '2', '修复数据表：[role]', '127.0.0.1', '1464578840');
INSERT INTO `backstage_log` VALUES ('154', '2', '修复数据表：[role_rule]', '127.0.0.1', '1464578841');
INSERT INTO `backstage_log` VALUES ('155', '2', '修复数据表：[rule]', '127.0.0.1', '1464578843');
INSERT INTO `backstage_log` VALUES ('156', '2', '修复数据表：[uploaded_file]', '127.0.0.1', '1464578844');
INSERT INTO `backstage_log` VALUES ('157', '2', '修复数据表：[user]', '127.0.0.1', '1464578845');
INSERT INTO `backstage_log` VALUES ('158', '2', '修复数据表：[backstage_log]', '127.0.0.1', '1464578994');
INSERT INTO `backstage_log` VALUES ('159', '2', '修复数据表：[user]', '127.0.0.1', '1464578994');
INSERT INTO `backstage_log` VALUES ('160', '2', '修复数据表：[role]', '127.0.0.1', '1464578994');
INSERT INTO `backstage_log` VALUES ('161', '2', '修复数据表：[rule]', '127.0.0.1', '1464578994');
INSERT INTO `backstage_log` VALUES ('162', '2', '修复数据表：[role_rule]', '127.0.0.1', '1464578994');
INSERT INTO `backstage_log` VALUES ('163', '2', '修复数据表：[uploaded_file]', '127.0.0.1', '1464578994');
INSERT INTO `backstage_log` VALUES ('164', '2', '备份数据表：[backstage_log]', '127.0.0.1', '1464579010');
INSERT INTO `backstage_log` VALUES ('165', '2', '备份数据表：[role]', '127.0.0.1', '1464579010');
INSERT INTO `backstage_log` VALUES ('166', '2', '备份数据表：[role_rule]', '127.0.0.1', '1464579010');
INSERT INTO `backstage_log` VALUES ('167', '2', '备份数据表：[user]', '127.0.0.1', '1464579010');
INSERT INTO `backstage_log` VALUES ('168', '2', '备份数据表：[uploaded_file]', '127.0.0.1', '1464579010');
INSERT INTO `backstage_log` VALUES ('169', '2', '备份数据表：[rule]', '127.0.0.1', '1464579010');
INSERT INTO `backstage_log` VALUES ('170', '2', '优化数据表：[uploaded_file]', '127.0.0.1', '1464579125');
INSERT INTO `backstage_log` VALUES ('171', '2', '修复数据表：[backstage_log]', '127.0.0.1', '1464579182');
INSERT INTO `backstage_log` VALUES ('172', '2', '修复数据表：[role]', '127.0.0.1', '1464579183');
INSERT INTO `backstage_log` VALUES ('173', '2', '修复数据表：[role_rule]', '127.0.0.1', '1464579185');
INSERT INTO `backstage_log` VALUES ('174', '2', '修复数据表：[rule]', '127.0.0.1', '1464579186');
INSERT INTO `backstage_log` VALUES ('175', '2', '修复数据表：[uploaded_file]', '127.0.0.1', '1464579187');
INSERT INTO `backstage_log` VALUES ('176', '2', '修复数据表：[user]', '127.0.0.1', '1464579189');
INSERT INTO `backstage_log` VALUES ('177', '2', '优化数据表：[backstage_log]', '127.0.0.1', '1464579206');
INSERT INTO `backstage_log` VALUES ('178', '2', '优化数据表：[role]', '127.0.0.1', '1464579207');
INSERT INTO `backstage_log` VALUES ('179', '2', '优化数据表：[role_rule]', '127.0.0.1', '1464579209');
INSERT INTO `backstage_log` VALUES ('180', '2', '优化数据表：[rule]', '127.0.0.1', '1464579210');
INSERT INTO `backstage_log` VALUES ('181', '2', '优化数据表：[uploaded_file]', '127.0.0.1', '1464579211');
INSERT INTO `backstage_log` VALUES ('182', '2', '优化数据表：[user]', '127.0.0.1', '1464579213');
INSERT INTO `backstage_log` VALUES ('183', '2', '优化数据表：[backstage_log]', '127.0.0.1', '1464579310');
INSERT INTO `backstage_log` VALUES ('184', '2', '添加菜单,ID:[26]', '127.0.0.1', '1464581281');
INSERT INTO `backstage_log` VALUES ('185', '2', '添加菜单,ID:[27]', '127.0.0.1', '1464581424');
INSERT INTO `backstage_log` VALUES ('186', '2', '修改用户组,ID:[1]', '127.0.0.1', '1464581528');
INSERT INTO `backstage_log` VALUES ('187', '2', '修改菜单,ID:[26]', '127.0.0.1', '1464588114');
INSERT INTO `backstage_log` VALUES ('188', '2', '添加菜单,ID:[28]', '127.0.0.1', '1464588144');
INSERT INTO `backstage_log` VALUES ('189', '2', '修改用户组,ID:[1]', '127.0.0.1', '1464588168');
INSERT INTO `backstage_log` VALUES ('190', '2', '优化数据表：[role]', '127.0.0.1', '1464588418');
INSERT INTO `backstage_log` VALUES ('191', '2', '优化数据表：[user]', '127.0.0.1', '1464588418');
INSERT INTO `backstage_log` VALUES ('192', '2', '优化数据表：[rule]', '127.0.0.1', '1464588418');
INSERT INTO `backstage_log` VALUES ('193', '2', '优化数据表：[role_rule]', '127.0.0.1', '1464588418');
INSERT INTO `backstage_log` VALUES ('194', '2', '优化数据表：[backstage_log]', '127.0.0.1', '1464588418');
INSERT INTO `backstage_log` VALUES ('195', '2', '优化数据表：[uploaded_file]', '127.0.0.1', '1464588418');
INSERT INTO `backstage_log` VALUES ('196', '2', '优化数据表：[variable]', '127.0.0.1', '1464588419');
INSERT INTO `backstage_log` VALUES ('197', '2', '修复数据表：[uploaded_file]', '127.0.0.1', '1464588425');
INSERT INTO `backstage_log` VALUES ('198', '2', '修复数据表：[role]', '127.0.0.1', '1464588425');
INSERT INTO `backstage_log` VALUES ('199', '2', '修复数据表：[user]', '127.0.0.1', '1464588425');
INSERT INTO `backstage_log` VALUES ('200', '2', '修复数据表：[role_rule]', '127.0.0.1', '1464588425');
INSERT INTO `backstage_log` VALUES ('201', '2', '修复数据表：[rule]', '127.0.0.1', '1464588425');
INSERT INTO `backstage_log` VALUES ('202', '2', '修复数据表：[backstage_log]', '127.0.0.1', '1464588425');
INSERT INTO `backstage_log` VALUES ('203', '2', '修复数据表：[variable]', '127.0.0.1', '1464588426');
INSERT INTO `backstage_log` VALUES ('204', '2', '备份数据表：[role]', '127.0.0.1', '1464588432');
INSERT INTO `backstage_log` VALUES ('205', '2', '备份数据表：[user]', '127.0.0.1', '1464588432');
INSERT INTO `backstage_log` VALUES ('206', '2', '备份数据表：[backstage_log]', '127.0.0.1', '1464588432');
INSERT INTO `backstage_log` VALUES ('207', '2', '备份数据表：[uploaded_file]', '127.0.0.1', '1464588432');
INSERT INTO `backstage_log` VALUES ('208', '2', '备份数据表：[role_rule]', '127.0.0.1', '1464588432');
INSERT INTO `backstage_log` VALUES ('209', '2', '备份数据表：[rule]', '127.0.0.1', '1464588432');
INSERT INTO `backstage_log` VALUES ('210', '2', '备份数据表：[variable]', '127.0.0.1', '1464588434');
INSERT INTO `backstage_log` VALUES ('211', '2', '优化数据表：[role]', '127.0.0.1', '1464591362');
INSERT INTO `backstage_log` VALUES ('212', '2', '优化数据表：[rule]', '127.0.0.1', '1464591362');
INSERT INTO `backstage_log` VALUES ('213', '2', '优化数据表：[backstage_log]', '127.0.0.1', '1464591362');
INSERT INTO `backstage_log` VALUES ('214', '2', '优化数据表：[user]', '127.0.0.1', '1464591362');
INSERT INTO `backstage_log` VALUES ('215', '2', '优化数据表：[role_rule]', '127.0.0.1', '1464591362');
INSERT INTO `backstage_log` VALUES ('216', '2', '优化数据表：[uploaded_file]', '127.0.0.1', '1464591362');
INSERT INTO `backstage_log` VALUES ('217', '2', '优化数据表：[variable]', '127.0.0.1', '1464591364');
INSERT INTO `backstage_log` VALUES ('218', '2', '添加自定义变量：[shabi]', '127.0.0.1', '1464591704');
INSERT INTO `backstage_log` VALUES ('219', '2', '添加自定义变量：[shabi]', '127.0.0.1', '1464591734');
INSERT INTO `backstage_log` VALUES ('220', '2', '添加自定义变量：[shabi]', '127.0.0.1', '1464592003');
INSERT INTO `backstage_log` VALUES ('221', '2', '添加菜单,ID:[29]', '127.0.0.1', '1464594427');
INSERT INTO `backstage_log` VALUES ('222', '2', '修改用户组,ID:[1]', '127.0.0.1', '1464594445');
INSERT INTO `backstage_log` VALUES ('223', '2', '登录', '127.0.0.1', '1464657437');
INSERT INTO `backstage_log` VALUES ('224', '2', '个人资料修改', '127.0.0.1', '1464659886');
INSERT INTO `backstage_log` VALUES ('225', '2', '修改后台用户：[5]', '127.0.0.1', '1464660072');
INSERT INTO `backstage_log` VALUES ('226', '2', '修改后台用户：[5]', '127.0.0.1', '1464660151');
INSERT INTO `backstage_log` VALUES ('227', '2', '修改后台用户：[5]', '127.0.0.1', '1464660214');
INSERT INTO `backstage_log` VALUES ('228', '2', '修改后台用户：[5]', '127.0.0.1', '1464660890');
INSERT INTO `backstage_log` VALUES ('229', '2', '修改后台用户：[5]', '127.0.0.1', '1464660945');
INSERT INTO `backstage_log` VALUES ('230', '2', '删除后台用户：[5]', '127.0.0.1', '1464660964');
INSERT INTO `backstage_log` VALUES ('231', '2', '修改后台用户：[4]', '127.0.0.1', '1464661149');
INSERT INTO `backstage_log` VALUES ('232', '2', '删除后台用户：[4]', '127.0.0.1', '1464661157');
INSERT INTO `backstage_log` VALUES ('233', '2', '添加菜单,ID:[30]', '127.0.0.1', '1464661679');
INSERT INTO `backstage_log` VALUES ('234', '2', '修改用户组,ID:[1]', '127.0.0.1', '1464661695');
INSERT INTO `backstage_log` VALUES ('235', '2', '个人资料修改', '127.0.0.1', '1464661805');
INSERT INTO `backstage_log` VALUES ('236', '2', '设置自定义变量的值：[1]', '127.0.0.1', '1464663544');
INSERT INTO `backstage_log` VALUES ('237', '2', '设置自定义变量的值：[0]', '127.0.0.1', '1464663593');
INSERT INTO `backstage_log` VALUES ('238', '2', '设置自定义变量的值：[0]', '127.0.0.1', '1464663661');
INSERT INTO `backstage_log` VALUES ('239', '2', '设置自定义变量的值：[0]', '127.0.0.1', '1464664050');
INSERT INTO `backstage_log` VALUES ('240', '2', '设置自定义变量的值：[622]', '127.0.0.1', '1464664102');
INSERT INTO `backstage_log` VALUES ('241', '2', '设置自定义变量的值：[622]', '127.0.0.1', '1464664125');
INSERT INTO `backstage_log` VALUES ('242', '2', '设置自定义变量的值：[622]', '127.0.0.1', '1464664144');
INSERT INTO `backstage_log` VALUES ('243', '2', '设置自定义变量的值：[622]', '127.0.0.1', '1464664314');
INSERT INTO `backstage_log` VALUES ('244', '2', '设置自定义变量的值：[622]', '127.0.0.1', '1464664327');
INSERT INTO `backstage_log` VALUES ('245', '2', '设置自定义变量的值：[994]', '127.0.0.1', '1464664448');
INSERT INTO `backstage_log` VALUES ('246', '2', '设置自定义变量的值：[1538]', '127.0.0.1', '1464664469');
INSERT INTO `backstage_log` VALUES ('247', '2', '修改自定义变量：[title]', '127.0.0.1', '1464665253');
INSERT INTO `backstage_log` VALUES ('248', '2', '删除自定义变量：[title]', '127.0.0.1', '1464665618');
INSERT INTO `backstage_log` VALUES ('249', '2', '添加自定义变量：[default_image]', '127.0.0.1', '1464665884');
INSERT INTO `backstage_log` VALUES ('250', '2', '设置自定义变量的值：[1]', '127.0.0.1', '1464666070');
INSERT INTO `backstage_log` VALUES ('251', '2', '设置自定义变量的值：[1]', '127.0.0.1', '1464676127');
INSERT INTO `backstage_log` VALUES ('252', '2', '个人资料修改', '127.0.0.1', '1464676412');
INSERT INTO `backstage_log` VALUES ('253', '2', '添加自定义变量：[xieyu]', '127.0.0.1', '1464679848');
INSERT INTO `backstage_log` VALUES ('254', '2', '优化数据表：[rule]', '127.0.0.1', '1464683660');
INSERT INTO `backstage_log` VALUES ('255', '2', '优化数据表：[user]', '127.0.0.1', '1464683660');
INSERT INTO `backstage_log` VALUES ('256', '2', '优化数据表：[role_rule]', '127.0.0.1', '1464683660');
INSERT INTO `backstage_log` VALUES ('257', '2', '优化数据表：[backstage_log]', '127.0.0.1', '1464683660');
INSERT INTO `backstage_log` VALUES ('258', '2', '优化数据表：[images_info]', '127.0.0.1', '1464683660');
INSERT INTO `backstage_log` VALUES ('259', '2', '优化数据表：[role]', '127.0.0.1', '1464683660');
INSERT INTO `backstage_log` VALUES ('260', '2', '优化数据表：[variable]', '127.0.0.1', '1464683661');
INSERT INTO `backstage_log` VALUES ('261', '2', '优化数据表：[variable_type]', '127.0.0.1', '1464683662');
INSERT INTO `backstage_log` VALUES ('262', '2', '修改菜单,ID:[1]', '127.0.0.1', '1464685841');
INSERT INTO `backstage_log` VALUES ('263', '2', '修改菜单,ID:[2]', '127.0.0.1', '1464685856');
INSERT INTO `backstage_log` VALUES ('264', '2', '修改菜单,ID:[21]', '127.0.0.1', '1464685870');
INSERT INTO `backstage_log` VALUES ('265', '2', '添加菜单,ID:[31]', '127.0.0.1', '1464687329');
INSERT INTO `backstage_log` VALUES ('266', '2', '添加菜单,ID:[32]', '127.0.0.1', '1464687503');
INSERT INTO `backstage_log` VALUES ('267', '2', '添加菜单,ID:[33]', '127.0.0.1', '1464687552');
INSERT INTO `backstage_log` VALUES ('268', '2', '添加菜单,ID:[34]', '127.0.0.1', '1464687586');
INSERT INTO `backstage_log` VALUES ('269', '2', '添加菜单,ID:[35]', '127.0.0.1', '1464687640');
INSERT INTO `backstage_log` VALUES ('270', '2', '修改用户组,ID:[1]', '127.0.0.1', '1464687672');
INSERT INTO `backstage_log` VALUES ('271', '2', '修改菜单,ID:[31]', '127.0.0.1', '1464687926');
INSERT INTO `backstage_log` VALUES ('272', '2', '登录', '127.0.0.1', '1464743969');
INSERT INTO `backstage_log` VALUES ('273', '2', '添加友情链接：[1]', '127.0.0.1', '1464745978');
INSERT INTO `backstage_log` VALUES ('274', '2', '添加友情链接：[2]', '127.0.0.1', '1464746018');
INSERT INTO `backstage_log` VALUES ('275', '2', '修改友情链接：[1]', '127.0.0.1', '1464747196');
INSERT INTO `backstage_log` VALUES ('276', '2', '删除菜单,ID:[2]', '127.0.0.1', '1464747518');
INSERT INTO `backstage_log` VALUES ('277', '2', '添加菜单,ID:[36]', '127.0.0.1', '1464749754');
INSERT INTO `backstage_log` VALUES ('278', '2', '添加菜单,ID:[37]', '127.0.0.1', '1464749794');
INSERT INTO `backstage_log` VALUES ('279', '2', '添加菜单,ID:[38]', '127.0.0.1', '1464749824');
INSERT INTO `backstage_log` VALUES ('280', '2', '添加菜单,ID:[39]', '127.0.0.1', '1464749863');
INSERT INTO `backstage_log` VALUES ('281', '2', '修改菜单,ID:[38]', '127.0.0.1', '1464749881');
INSERT INTO `backstage_log` VALUES ('282', '2', '修改菜单,ID:[37]', '127.0.0.1', '1464749898');
INSERT INTO `backstage_log` VALUES ('283', '2', '修改用户组,ID:[1]', '127.0.0.1', '1464750172');
INSERT INTO `backstage_log` VALUES ('284', '2', '添加焦点图位置：[1]', '127.0.0.1', '1464751294');
INSERT INTO `backstage_log` VALUES ('285', '2', '修改焦点图位置：[1]', '127.0.0.1', '1464753131');
INSERT INTO `backstage_log` VALUES ('286', '2', '添加焦点图位置：[2]', '127.0.0.1', '1464753444');
INSERT INTO `backstage_log` VALUES ('287', '2', '删除焦点图位置,ID:[2]', '127.0.0.1', '1464753464');
INSERT INTO `backstage_log` VALUES ('288', '2', '添加菜单,ID:[40]', '127.0.0.1', '1464761821');
INSERT INTO `backstage_log` VALUES ('289', '2', '修改菜单,ID:[40]', '127.0.0.1', '1464761858');
INSERT INTO `backstage_log` VALUES ('290', '2', '添加菜单,ID:[41]', '127.0.0.1', '1464761906');
INSERT INTO `backstage_log` VALUES ('291', '2', '添加菜单,ID:[42]', '127.0.0.1', '1464761938');
INSERT INTO `backstage_log` VALUES ('292', '2', '添加菜单,ID:[43]', '127.0.0.1', '1464761981');
INSERT INTO `backstage_log` VALUES ('293', '2', '修改用户组,ID:[1]', '127.0.0.1', '1464762150');
INSERT INTO `backstage_log` VALUES ('294', '2', '添加焦点图：[1]', '127.0.0.1', '1464764709');
INSERT INTO `backstage_log` VALUES ('295', '2', '修改焦点图：[1]', '127.0.0.1', '1464765875');
INSERT INTO `backstage_log` VALUES ('296', '2', '删除焦点图,ID:[1]', '127.0.0.1', '1464766828');
INSERT INTO `backstage_log` VALUES ('297', '2', '添加焦点图：[2]', '127.0.0.1', '1464767431');
INSERT INTO `backstage_log` VALUES ('298', '2', '备份数据表：[backstage_log]', '127.0.0.1', '1464772404');
INSERT INTO `backstage_log` VALUES ('299', '2', '备份数据表：[images_info]', '127.0.0.1', '1464772404');
INSERT INTO `backstage_log` VALUES ('300', '2', '备份数据表：[focus]', '127.0.0.1', '1464772404');
INSERT INTO `backstage_log` VALUES ('301', '2', '备份数据表：[links]', '127.0.0.1', '1464772404');
INSERT INTO `backstage_log` VALUES ('302', '2', '备份数据表：[focus_position]', '127.0.0.1', '1464772404');
INSERT INTO `backstage_log` VALUES ('303', '2', '备份数据表：[role]', '127.0.0.1', '1464772404');
INSERT INTO `backstage_log` VALUES ('304', '2', '备份数据表：[role_rule]', '127.0.0.1', '1464772409');
INSERT INTO `backstage_log` VALUES ('305', '2', '备份数据表：[rule]', '127.0.0.1', '1464772410');
INSERT INTO `backstage_log` VALUES ('306', '2', '备份数据表：[user]', '127.0.0.1', '1464772412');
INSERT INTO `backstage_log` VALUES ('307', '2', '备份数据表：[variable]', '127.0.0.1', '1464772413');
INSERT INTO `backstage_log` VALUES ('308', '2', '备份数据表：[variable_type]', '127.0.0.1', '1464772415');
INSERT INTO `backstage_log` VALUES ('309', '2', '登录', '127.0.0.1', '1464848465');
INSERT INTO `backstage_log` VALUES ('310', '2', '登录', '127.0.0.1', '1464920776');
INSERT INTO `backstage_log` VALUES ('311', '2', '登录', '127.0.0.1', '1464922587');
INSERT INTO `backstage_log` VALUES ('312', '2', '修改菜单,ID:[5]', '127.0.0.1', '1464933974');
INSERT INTO `backstage_log` VALUES ('313', '2', '添加菜单,ID:[44]', '127.0.0.1', '1464934794');
INSERT INTO `backstage_log` VALUES ('314', '2', '修改菜单,ID:[44]', '127.0.0.1', '1464934832');
INSERT INTO `backstage_log` VALUES ('315', '2', '添加菜单,ID:[45]', '127.0.0.1', '1464934931');
INSERT INTO `backstage_log` VALUES ('316', '2', '添加菜单,ID:[46]', '127.0.0.1', '1464934993');
INSERT INTO `backstage_log` VALUES ('317', '2', '添加菜单,ID:[47]', '127.0.0.1', '1464935036');
INSERT INTO `backstage_log` VALUES ('318', '2', '添加菜单,ID:[48]', '127.0.0.1', '1464935078');
INSERT INTO `backstage_log` VALUES ('319', '2', '修改用户组,ID:[1]', '127.0.0.1', '1464935109');
INSERT INTO `backstage_log` VALUES ('320', '2', '添加单页面：[1]', '127.0.0.1', '1464939566');
INSERT INTO `backstage_log` VALUES ('321', '2', '添加单页面：[2]', '127.0.0.1', '1464944062');
INSERT INTO `backstage_log` VALUES ('322', '2', '添加单页面：[1]', '127.0.0.1', '1464944653');
INSERT INTO `backstage_log` VALUES ('323', '2', '添加单页面：[1]', '127.0.0.1', '1464944891');
INSERT INTO `backstage_log` VALUES ('324', '2', '修改单页面：[2]', '127.0.0.1', '1464944962');
INSERT INTO `backstage_log` VALUES ('325', '2', '添加单页面：[3]', '127.0.0.1', '1464945828');
INSERT INTO `backstage_log` VALUES ('326', '2', '登录', '127.0.0.1', '1465180148');
INSERT INTO `backstage_log` VALUES ('327', '2', '添加菜单,ID:[49]', '127.0.0.1', '1465180654');
INSERT INTO `backstage_log` VALUES ('328', '2', '添加菜单,ID:[50]', '127.0.0.1', '1465180895');
INSERT INTO `backstage_log` VALUES ('329', '2', '添加菜单,ID:[51]', '127.0.0.1', '1465180970');
INSERT INTO `backstage_log` VALUES ('330', '2', '添加菜单,ID:[52]', '127.0.0.1', '1465181022');
INSERT INTO `backstage_log` VALUES ('331', '2', '修改用户组,ID:[1]', '127.0.0.1', '1465181868');
INSERT INTO `backstage_log` VALUES ('332', '2', '添加单页面：[1]', '127.0.0.1', '1465203618');
INSERT INTO `backstage_log` VALUES ('333', '2', '添加单页面：[2]', '127.0.0.1', '1465204101');
INSERT INTO `backstage_log` VALUES ('334', '2', '修改文章分类页面：[1]', '127.0.0.1', '1465204885');
INSERT INTO `backstage_log` VALUES ('335', '2', '删除单页面,ID:[3]', '127.0.0.1', '1465205802');
INSERT INTO `backstage_log` VALUES ('336', '2', '删除文章分类页面,ID:[2]', '127.0.0.1', '1465206776');
INSERT INTO `backstage_log` VALUES ('337', '2', '登录', '127.0.0.1', '1465265495');
INSERT INTO `backstage_log` VALUES ('338', '2', '添加文章分类页面：[3]', '127.0.0.1', '1465265950');
INSERT INTO `backstage_log` VALUES ('339', '2', '添加菜单,ID:[53]', '127.0.0.1', '1465266208');
INSERT INTO `backstage_log` VALUES ('340', '2', '添加菜单,ID:[54]', '127.0.0.1', '1465266293');
INSERT INTO `backstage_log` VALUES ('341', '2', '添加菜单,ID:[55]', '127.0.0.1', '1465266327');
INSERT INTO `backstage_log` VALUES ('342', '2', '添加菜单,ID:[56]', '127.0.0.1', '1465266480');
INSERT INTO `backstage_log` VALUES ('343', '2', '修改用户组,ID:[1]', '127.0.0.1', '1465267060');
INSERT INTO `backstage_log` VALUES ('344', '2', '添加单页面：[1]', '127.0.0.1', '1465287817');
INSERT INTO `backstage_log` VALUES ('345', '2', '添加单页面：[2]', '127.0.0.1', '1465288220');
INSERT INTO `backstage_log` VALUES ('346', '0', '登录失败,email:[luffyzhao@vip.126.vom] password:[zha******g311]', '127.0.0.1', '1465695608');
INSERT INTO `backstage_log` VALUES ('347', '0', '登录失败,email:[zft55052623@163.com] password:[zha******g311]', '127.0.0.1', '1465696129');
INSERT INTO `backstage_log` VALUES ('348', '0', '登录失败,email:[zft55052623@163.com] password:[1***56]', '127.0.0.1', '1465696136');
INSERT INTO `backstage_log` VALUES ('349', '0', '登录失败,email:[zft55052623@163.com] password:[1***56]', '127.0.0.1', '1465696142');
INSERT INTO `backstage_log` VALUES ('350', '2', '登录', '127.0.0.1', '1465696157');
INSERT INTO `backstage_log` VALUES ('351', '2', '修改文章：[1]', '127.0.0.1', '1465699220');
INSERT INTO `backstage_log` VALUES ('352', '2', '修改文章：[1]', '127.0.0.1', '1465701575');
INSERT INTO `backstage_log` VALUES ('353', '2', '个人资料修改', '127.0.0.1', '1465701620');
INSERT INTO `backstage_log` VALUES ('354', '2', '添加友情链接：[3]', '127.0.0.1', '1465701687');
INSERT INTO `backstage_log` VALUES ('355', '2', '修改友情链接：[3]', '127.0.0.1', '1465701697');
INSERT INTO `backstage_log` VALUES ('356', '2', '删除菜单,ID:[3]', '127.0.0.1', '1465701708');
INSERT INTO `backstage_log` VALUES ('357', '2', '添加焦点图位置：[3]', '127.0.0.1', '1465701751');
INSERT INTO `backstage_log` VALUES ('358', '2', '修改焦点图位置：[3]', '127.0.0.1', '1465701776');
INSERT INTO `backstage_log` VALUES ('359', '2', '删除焦点图位置,ID:[3]', '127.0.0.1', '1465701786');
INSERT INTO `backstage_log` VALUES ('360', '2', '添加焦点图：[3]', '127.0.0.1', '1465701837');
INSERT INTO `backstage_log` VALUES ('361', '2', '删除焦点图,ID:[3]', '127.0.0.1', '1465701846');
INSERT INTO `backstage_log` VALUES ('362', '2', '修改焦点图：[2]', '127.0.0.1', '1465701862');
INSERT INTO `backstage_log` VALUES ('363', '2', '添加单页面：[4]', '127.0.0.1', '1465702036');
INSERT INTO `backstage_log` VALUES ('364', '2', '修改单页面：[4]', '127.0.0.1', '1465702053');
INSERT INTO `backstage_log` VALUES ('365', '2', '删除单页面,ID:[4]', '127.0.0.1', '1465702068');
INSERT INTO `backstage_log` VALUES ('366', '2', '添加文章分类页面：[4]', '127.0.0.1', '1465702193');
INSERT INTO `backstage_log` VALUES ('367', '2', '修改文章分类页面：[4]', '127.0.0.1', '1465702210');
INSERT INTO `backstage_log` VALUES ('368', '2', '删除文章分类页面,ID:[4]', '127.0.0.1', '1465702313');
INSERT INTO `backstage_log` VALUES ('369', '2', '添加文章：[3]', '127.0.0.1', '1465702432');
INSERT INTO `backstage_log` VALUES ('370', '2', '修改文章：[1]', '127.0.0.1', '1465702447');
INSERT INTO `backstage_log` VALUES ('371', '2', '删除文章,ID:[3]', '127.0.0.1', '1465702494');
INSERT INTO `backstage_log` VALUES ('372', '2', '优化数据表：[ariclecategory]', '127.0.0.1', '1465702508');
INSERT INTO `backstage_log` VALUES ('373', '2', '优化数据表：[images_info]', '127.0.0.1', '1465702508');
INSERT INTO `backstage_log` VALUES ('374', '2', '优化数据表：[focus]', '127.0.0.1', '1465702508');
INSERT INTO `backstage_log` VALUES ('375', '2', '优化数据表：[focus_position]', '127.0.0.1', '1465702508');
INSERT INTO `backstage_log` VALUES ('376', '2', '优化数据表：[aricle]', '127.0.0.1', '1465702508');
INSERT INTO `backstage_log` VALUES ('377', '2', '优化数据表：[backstage_log]', '127.0.0.1', '1465702508');
INSERT INTO `backstage_log` VALUES ('378', '2', '优化数据表：[links]', '127.0.0.1', '1465702509');
INSERT INTO `backstage_log` VALUES ('379', '2', '优化数据表：[pages]', '127.0.0.1', '1465702510');
INSERT INTO `backstage_log` VALUES ('380', '2', '优化数据表：[role]', '127.0.0.1', '1465702510');
INSERT INTO `backstage_log` VALUES ('381', '2', '优化数据表：[role_rule]', '127.0.0.1', '1465702511');
INSERT INTO `backstage_log` VALUES ('382', '2', '优化数据表：[rule]', '127.0.0.1', '1465702511');
INSERT INTO `backstage_log` VALUES ('383', '2', '优化数据表：[user]', '127.0.0.1', '1465702512');
INSERT INTO `backstage_log` VALUES ('384', '2', '优化数据表：[variable]', '127.0.0.1', '1465702512');
INSERT INTO `backstage_log` VALUES ('385', '2', '优化数据表：[variable_type]', '127.0.0.1', '1465702513');
INSERT INTO `backstage_log` VALUES ('386', '2', '修复数据表：[backstage_log]', '127.0.0.1', '1465702518');
INSERT INTO `backstage_log` VALUES ('387', '2', '修复数据表：[aricle]', '127.0.0.1', '1465702518');
INSERT INTO `backstage_log` VALUES ('388', '2', '修复数据表：[images_info]', '127.0.0.1', '1465702518');
INSERT INTO `backstage_log` VALUES ('389', '2', '修复数据表：[ariclecategory]', '127.0.0.1', '1465702518');
INSERT INTO `backstage_log` VALUES ('390', '2', '修复数据表：[focus_position]', '127.0.0.1', '1465702518');
INSERT INTO `backstage_log` VALUES ('391', '2', '修复数据表：[focus]', '127.0.0.1', '1465702518');
INSERT INTO `backstage_log` VALUES ('392', '2', '修复数据表：[links]', '127.0.0.1', '1465702519');
INSERT INTO `backstage_log` VALUES ('393', '2', '修复数据表：[pages]', '127.0.0.1', '1465702520');
INSERT INTO `backstage_log` VALUES ('394', '2', '修复数据表：[role]', '127.0.0.1', '1465702520');
INSERT INTO `backstage_log` VALUES ('395', '2', '修复数据表：[role_rule]', '127.0.0.1', '1465702521');
INSERT INTO `backstage_log` VALUES ('396', '2', '修复数据表：[rule]', '127.0.0.1', '1465702522');
INSERT INTO `backstage_log` VALUES ('397', '2', '修复数据表：[user]', '127.0.0.1', '1465702522');
INSERT INTO `backstage_log` VALUES ('398', '2', '修复数据表：[variable]', '127.0.0.1', '1465702523');
INSERT INTO `backstage_log` VALUES ('399', '2', '修复数据表：[variable_type]', '127.0.0.1', '1465702524');
INSERT INTO `backstage_log` VALUES ('400', '2', '备份数据表：[ariclecategory]', '127.0.0.1', '1465702531');
INSERT INTO `backstage_log` VALUES ('401', '2', '备份数据表：[backstage_log]', '127.0.0.1', '1465702531');
INSERT INTO `backstage_log` VALUES ('402', '2', '备份数据表：[focus_position]', '127.0.0.1', '1465702531');
INSERT INTO `backstage_log` VALUES ('403', '2', '备份数据表：[images_info]', '127.0.0.1', '1465702531');
INSERT INTO `backstage_log` VALUES ('404', '2', '备份数据表：[aricle]', '127.0.0.1', '1465702531');
INSERT INTO `backstage_log` VALUES ('405', '2', '备份数据表：[focus]', '127.0.0.1', '1465702531');
INSERT INTO `backstage_log` VALUES ('406', '2', '备份数据表：[links]', '127.0.0.1', '1465702532');
INSERT INTO `backstage_log` VALUES ('407', '2', '备份数据表：[pages]', '127.0.0.1', '1465702535');
INSERT INTO `backstage_log` VALUES ('408', '2', '备份数据表：[role]', '127.0.0.1', '1465702536');
INSERT INTO `backstage_log` VALUES ('409', '2', '备份数据表：[role_rule]', '127.0.0.1', '1465702537');
INSERT INTO `backstage_log` VALUES ('410', '2', '备份数据表：[rule]', '127.0.0.1', '1465702538');
INSERT INTO `backstage_log` VALUES ('411', '2', '备份数据表：[user]', '127.0.0.1', '1465702539');
INSERT INTO `backstage_log` VALUES ('412', '2', '备份数据表：[variable]', '127.0.0.1', '1465702540');
INSERT INTO `backstage_log` VALUES ('413', '2', '备份数据表：[variable_type]', '127.0.0.1', '1465702541');
INSERT INTO `backstage_log` VALUES ('414', '2', '添加自定义变量：[erji]', '127.0.0.1', '1465702639');
INSERT INTO `backstage_log` VALUES ('415', '2', '设置自定义变量的值：[1]', '127.0.0.1', '1465702649');
INSERT INTO `backstage_log` VALUES ('416', '2', '修改自定义变量：[erji]', '127.0.0.1', '1465702665');
INSERT INTO `backstage_log` VALUES ('417', '2', '删除自定义变量：[erji]', '127.0.0.1', '1465702672');
INSERT INTO `backstage_log` VALUES ('418', '2', '添加菜单,ID:[58]', '127.0.0.1', '1465702757');
INSERT INTO `backstage_log` VALUES ('419', '2', '修改菜单,ID:[57]', '127.0.0.1', '1465702772');
INSERT INTO `backstage_log` VALUES ('420', '2', '删除菜单,ID:[58]', '127.0.0.1', '1465702809');
INSERT INTO `backstage_log` VALUES ('421', '2', '删除菜单,ID:[57]', '127.0.0.1', '1465702820');
INSERT INTO `backstage_log` VALUES ('422', '2', '添加用户组,ID:[16]', '127.0.0.1', '1465702876');
INSERT INTO `backstage_log` VALUES ('423', '2', '修改用户组,ID:[16]', '127.0.0.1', '1465702892');
INSERT INTO `backstage_log` VALUES ('424', '2', '删除用户组,ID:[16]', '127.0.0.1', '1465702913');
INSERT INTO `backstage_log` VALUES ('425', '2', '修改后台用户：[3]', '127.0.0.1', '1465703371');
INSERT INTO `backstage_log` VALUES ('426', '2', '删除后台用户：[3]', '127.0.0.1', '1465703382');
INSERT INTO `backstage_log` VALUES ('427', '2', '添加后台用户：[6]', '127.0.0.1', '1465703454');
INSERT INTO `backstage_log` VALUES ('428', '0', '登录失败,email:[zft55052623@163.com] password:[zha******g311]', '127.0.0.1', '1465876078');
INSERT INTO `backstage_log` VALUES ('429', '0', '登录失败,email:[zft55052623@163.com] password:[1***56]', '127.0.0.1', '1465876084');
INSERT INTO `backstage_log` VALUES ('430', '2', '登录', '127.0.0.1', '1465876091');
INSERT INTO `backstage_log` VALUES ('431', '2', '登录', '127.0.0.1', '1465891909');

-- ----------------------------
-- Table structure for focus
-- ----------------------------
DROP TABLE IF EXISTS `focus`;
CREATE TABLE `focus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position_id` int(11) NOT NULL COMMENT '焦点图所属位置',
  `title` varchar(100) NOT NULL COMMENT '焦点图标题',
  `url` varchar(255) NOT NULL COMMENT '焦点图链接地址',
  `image` varchar(255) NOT NULL COMMENT '图片',
  `remark` tinytext COMMENT '焦点图说明',
  `status` tinyint(4) NOT NULL COMMENT '是否可用',
  `sort` int(11) NOT NULL COMMENT '排序',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `position` (`position_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='焦点图';

-- ----------------------------
-- Records of focus
-- ----------------------------
INSERT INTO `focus` VALUES ('2', '1', '国庆促销1', 'http://www.qiny.com', '\\static\\focus_image\\2016-06-01\\5ed9acec0f3270cf6c07c37417c38097.png', '国庆促销', '1', '255', '1464767431', '1465701862');

-- ----------------------------
-- Table structure for focus_position
-- ----------------------------
DROP TABLE IF EXISTS `focus_position`;
CREATE TABLE `focus_position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) NOT NULL COMMENT '调用代码',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='焦点图位置';

-- ----------------------------
-- Records of focus_position
-- ----------------------------
INSERT INTO `focus_position` VALUES ('1', 'index_1', '首页第一p', '1464751294', '1464753131');

-- ----------------------------
-- Table structure for images_info
-- ----------------------------
DROP TABLE IF EXISTS `images_info`;
CREATE TABLE `images_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(20) NOT NULL COMMENT '文件目录',
  `remark` varchar(255) NOT NULL COMMENT '说明',
  `height` int(11) NOT NULL DEFAULT '0' COMMENT '高度(为0时不限制)',
  `width` int(11) NOT NULL DEFAULT '0' COMMENT '长度(为0时不限制)',
  `size` int(11) NOT NULL DEFAULT '0' COMMENT '最大(为0时不限制) 单位kb',
  PRIMARY KEY (`id`),
  UNIQUE KEY `path` (`path`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='图片控制';

-- ----------------------------
-- Records of images_info
-- ----------------------------
INSERT INTO `images_info` VALUES ('1', 'head', '头像', '100', '100', '100');
INSERT INTO `images_info` VALUES ('2', 'editor', '编辑器', '0', '0', '500');
INSERT INTO `images_info` VALUES ('3', 'links_logo', '友情链接LOGO', '0', '0', '50');

-- ----------------------------
-- Table structure for links
-- ----------------------------
DROP TABLE IF EXISTS `links`;
CREATE TABLE `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL COMMENT 'logo',
  `linker` varchar(255) DEFAULT NULL COMMENT '联系人说明',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1 开启 0 关闭',
  `sort` int(10) NOT NULL DEFAULT '255' COMMENT '排序 ',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='友情 链接';

-- ----------------------------
-- Records of links
-- ----------------------------
INSERT INTO `links` VALUES ('1', '京东', 'http://www.sino.com', '\\static\\links_logo\\2016-06-01\\8672b9290390e6e026fe570cd145647d.png', 'QQ:36363636', '1', '23', '1464745978', '1464747196');

-- ----------------------------
-- Table structure for pages
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父级',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `description` varchar(255) DEFAULT '' COMMENT '简介',
  `keyword` varchar(100) DEFAULT '' COMMENT '关键字',
  `content` text COMMENT '内容',
  `status` tinyint(255) NOT NULL DEFAULT '0' COMMENT '状态',
  `sort` int(11) NOT NULL COMMENT '排序',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='单页面';

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT INTO `pages` VALUES ('1', '0', '公司介绍', '', '公司介绍', '<h2 style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';background-color:#FFFFFF;\">\r\n	公司介绍\r\n</h2>\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">上海顶想信息科技有限公司（TOPThink Inc.）是国内领先的WEB应用和服务提供商致力于WEB应用平台、产品和应用的研发和服务，为企事业单位提供基于WEB的应用开发快速解决方案和产品。公司成立于2008年9月，是一家拥有自主知识产权的高新企业。</span><br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">公司长期专注于WEB应用框架、应用平台和企业解决方案的研究，公司的核心技术框架ThinkPHP由创始人刘晨于2006年创立，经过7年多的精心打造和发展，具有广泛的用户基础和良好的业内口碑，已经成长为国内领先和最具影响力的WEB应用开发框架，国外同比也具有相当大的优势。其应用领域分布于各个行业，在门户、社区和电子商务领域有着非常良好支持以及拓展，大小案例不下千家，在安全、效率、负载上都有很大优势，已经成为WEB应用的快速开发解决方案和最佳实践！</span><br />\r\n<br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">公司总部位于上海，由从事互联网和用户体验研究达10年的资深专家领军，拥有一批专业的策划、设计和技术团队以及广泛的社区技术力量。公司长期以来凭借业内的影响力、良好的客户和合作关系，邀请了众多安全和项目专家作为顾问，有力得保证了客户项目的开发和实施。公司还拥有一支资深用户体验和设计研究队伍，针对不同用户量身定做用户体验流程，有着良好的产品设计和设计概念。</span><br />\r\n<br />\r\n<br />\r\n<h2 style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';background-color:#FFFFFF;\">\r\n	公司理念\r\n</h2>\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">公司理念：专业源于专注，细节决定成败。</span><br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">我们的口号是：WE CAN DO IT ,JUST THINK !</span><br />\r\n<br />\r\n<br />\r\n<h2 style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';background-color:#FFFFFF;\">\r\n	公司服务\r\n</h2>\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">专业网站策划开发</span><br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">企业业务系统定制</span><br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">为企业应用提供一系列的解决方案</span><br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">ThinkPHP认证培训</span><br />\r\n<br />\r\n<br />\r\n<h2 style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';background-color:#FFFFFF;\">\r\n	公司优势\r\n</h2>\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">ThinkPHP 6年的用户基础和口碑</span><br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">日益增加的典型案例</span><br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">具有技术优势的团队</span><br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">广泛的合作资源，包括：校园、企业、培训和媒体</span><br />\r\n<br />\r\n<br />\r\n<h2 style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';background-color:#FFFFFF;\">\r\n	公司价值观\r\n</h2>\r\n<b>合作</b><span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">&nbsp;—— 团队合作，共同成长</span><br />\r\n<b>专业</b><span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">&nbsp;—— 提倡专业素质</span><br />\r\n<b>专注</b><span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">&nbsp;—— 成为某个领域的专家</span><br />\r\n<b>创新</b><span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">&nbsp;—— 持续创新，不断改进</span><br />\r\n<b>服务</b><span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">&nbsp;—— 给客户最满意的服务而不是产品</span><br />\r\n<b>贡献</b><span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">&nbsp;—— 有贡献就有收获</span><br />\r\n<br />\r\n<br />\r\n<h2 style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';background-color:#FFFFFF;\">\r\n	我们的客户\r\n</h2>\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">国家保密局 中青旅 联想中国 美特斯邦威 腾讯家居 凤凰家居 56.Com 星巴克 宝矿力水特 特力屋 奔驰 莆田在线 都市客 商虎网 泡面三国 三国英雄传 贵州便民网 中国西部开发网 中华家园网 记忆日 互动日程 魔力岛 巨人网络 灵通集团…</span><br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">更多典型案例演示：</span><a href=\"http://www.thinkphp.cn/Case/\" target=\"_blank\">http://www.thinkphp.cn/Case/&nbsp;</a><br />\r\n<br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">社 区：</span><a href=\"http://thinkphp.cn/\" target=\"_blank\">http://thinkphp.cn/</a><br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">公司官网：</span><a href=\"http://topthink.net/\" target=\"_blank\">http://topthink.net/</a>', '1', '255', '1464939566', '1464939566');
INSERT INTO `pages` VALUES ('2', '1', '关于我们', '关于我们 ', '关于我们', '<h2 style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';background-color:#FFFFFF;\">\r\n	公司介绍\r\n</h2>\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">上海顶想信息科技有限公司（TOPThink Inc.）是国内领先的WEB应用和服务提供商致力于WEB应用平台、产品和应用的研发和服务，为企事业单位提供基于WEB的应用开发快速解决方案和产品。公司成立于2008年9月，是一家拥有自主知识产权的高新企业。</span><br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">公司长期专注于WEB应用框架、应用平台和企业解决方案的研究，公司的核心技术框架ThinkPHP由创始人刘晨于2006年创立，经过7年多的精心打造和发展，具有广泛的用户基础和良好的业内口碑，已经成长为国内领先和最具影响力的WEB应用开发框架，国外同比也具有相当大的优势。其应用领域分布于各个行业，在门户、社区和电子商务领域有着非常良好支持以及拓展，大小案例不下千家，在安全、效率、负载上都有很大优势，已经成为WEB应用的快速开发解决方案和最佳实践！</span><br />\r\n<br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">公司总部位于上海，由从事互联网和用户体验研究达10年的资深专家领军，拥有一批专业的策划、设计和技术团队以及广泛的社区技术力量。公司长期以来凭借业内的影响力、良好的客户和合作关系，邀请了众多安全和项目专家作为顾问，有力得保证了客户项目的开发和实施。公司还拥有一支资深用户体验和设计研究队伍，针对不同用户量身定做用户体验流程，有着良好的产品设计和设计概念。</span><br />\r\n<br />\r\n<br />\r\n<h2 style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';background-color:#FFFFFF;\">\r\n	公司理念\r\n</h2>\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">公司理念：专业源于专注，细节决定成败。</span><br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">我们的口号是：WE CAN DO IT ,JUST THINK !</span><br />\r\n<br />\r\n<br />\r\n<h2 style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';background-color:#FFFFFF;\">\r\n	公司服务\r\n</h2>\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">专业网站策划开发</span><br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">企业业务系统定制</span><br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">为企业应用提供一系列的解决方案</span><br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">ThinkPHP认证培训</span><br />\r\n<br />\r\n<br />\r\n<h2 style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';background-color:#FFFFFF;\">\r\n	公司优势\r\n</h2>\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">ThinkPHP 6年的用户基础和口碑</span><br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">日益增加的典型案例</span><br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">具有技术优势的团队</span><br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">广泛的合作资源，包括：校园、企业、培训和媒体</span><br />\r\n<br />\r\n<br />\r\n<h2 style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';background-color:#FFFFFF;\">\r\n	公司价值观\r\n</h2>\r\n<b>合作</b><span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\"> —— 团队合作，共同成长</span><br />\r\n<b>专业</b><span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\"> —— 提倡专业素质</span><br />\r\n<b>专注</b><span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\"> —— 成为某个领域的专家</span><br />\r\n<b>创新</b><span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\"> —— 持续创新，不断改进</span><br />\r\n<b>服务</b><span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\"> —— 给客户最满意的服务而不是产品</span><br />\r\n<b>贡献</b><span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\"> —— 有贡献就有收获</span><br />\r\n<br />\r\n<br />\r\n<h2 style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';background-color:#FFFFFF;\">\r\n	我们的客户\r\n</h2>\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">国家保密局 中青旅 联想中国 美特斯邦威 腾讯家居 凤凰家居 56.Com 星巴克 宝矿力水特 特力屋 奔驰 莆田在线 都市客 商虎网 泡面三国 三国英雄传 贵州便民网 中国西部开发网 中华家园网 记忆日 互动日程 魔力岛 巨人网络 灵通集团…</span><br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">更多典型案例演示：</span><a href=\"http://www.thinkphp.cn/Case/\" target=\"_blank\">http://www.thinkphp.cn/Case/ </a><br />\r\n<br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">社 区：</span><a href=\"http://thinkphp.cn/\" target=\"_blank\">http://thinkphp.cn/</a><br />\r\n<span style=\"color:#323232;font-family:\'Century Gothic\', \'Microsoft yahei\';font-size:16px;line-height:35.2px;background-color:#FFFFFF;\">公司官网：</span><a href=\"http://topthink.net/\" target=\"_blank\">http://topthink.net/</a>', '1', '25', '1464944062', '1464944962');

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL COMMENT '角色名称',
  `status` tinyint(5) NOT NULL DEFAULT '0' COMMENT '是否启用',
  `remark` varchar(255) DEFAULT '' COMMENT '简单说明',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COMMENT='角色表';

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', '网站管理员', '1', '网站所有者权限', '1463639061', '1465267060');

-- ----------------------------
-- Table structure for role_rule
-- ----------------------------
DROP TABLE IF EXISTS `role_rule`;
CREATE TABLE `role_rule` (
  `role_id` int(11) NOT NULL,
  `rule_id` int(11) NOT NULL,
  UNIQUE KEY `fu` (`role_id`,`rule_id`),
  KEY `role_rule_rule_id` (`rule_id`),
  CONSTRAINT `role_rule_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`),
  CONSTRAINT `role_rule_rule_id` FOREIGN KEY (`rule_id`) REFERENCES `rule` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='角色权限关联表';

-- ----------------------------
-- Records of role_rule
-- ----------------------------
INSERT INTO `role_rule` VALUES ('1', '1');
INSERT INTO `role_rule` VALUES ('1', '2');
INSERT INTO `role_rule` VALUES ('1', '3');
INSERT INTO `role_rule` VALUES ('1', '4');
INSERT INTO `role_rule` VALUES ('1', '5');
INSERT INTO `role_rule` VALUES ('1', '6');
INSERT INTO `role_rule` VALUES ('1', '7');
INSERT INTO `role_rule` VALUES ('1', '8');
INSERT INTO `role_rule` VALUES ('1', '9');
INSERT INTO `role_rule` VALUES ('1', '13');
INSERT INTO `role_rule` VALUES ('1', '14');
INSERT INTO `role_rule` VALUES ('1', '15');
INSERT INTO `role_rule` VALUES ('1', '16');
INSERT INTO `role_rule` VALUES ('1', '17');
INSERT INTO `role_rule` VALUES ('1', '18');
INSERT INTO `role_rule` VALUES ('1', '19');
INSERT INTO `role_rule` VALUES ('1', '20');
INSERT INTO `role_rule` VALUES ('1', '21');
INSERT INTO `role_rule` VALUES ('1', '22');
INSERT INTO `role_rule` VALUES ('1', '23');
INSERT INTO `role_rule` VALUES ('1', '24');
INSERT INTO `role_rule` VALUES ('1', '25');
INSERT INTO `role_rule` VALUES ('1', '26');
INSERT INTO `role_rule` VALUES ('1', '27');
INSERT INTO `role_rule` VALUES ('1', '28');
INSERT INTO `role_rule` VALUES ('1', '29');
INSERT INTO `role_rule` VALUES ('1', '30');
INSERT INTO `role_rule` VALUES ('1', '31');
INSERT INTO `role_rule` VALUES ('1', '32');
INSERT INTO `role_rule` VALUES ('1', '33');
INSERT INTO `role_rule` VALUES ('1', '34');
INSERT INTO `role_rule` VALUES ('1', '35');
INSERT INTO `role_rule` VALUES ('1', '36');
INSERT INTO `role_rule` VALUES ('1', '37');
INSERT INTO `role_rule` VALUES ('1', '38');
INSERT INTO `role_rule` VALUES ('1', '39');
INSERT INTO `role_rule` VALUES ('1', '40');
INSERT INTO `role_rule` VALUES ('1', '41');
INSERT INTO `role_rule` VALUES ('1', '42');
INSERT INTO `role_rule` VALUES ('1', '43');
INSERT INTO `role_rule` VALUES ('1', '44');
INSERT INTO `role_rule` VALUES ('1', '45');
INSERT INTO `role_rule` VALUES ('1', '46');
INSERT INTO `role_rule` VALUES ('1', '47');
INSERT INTO `role_rule` VALUES ('1', '48');
INSERT INTO `role_rule` VALUES ('1', '49');
INSERT INTO `role_rule` VALUES ('1', '50');
INSERT INTO `role_rule` VALUES ('1', '51');
INSERT INTO `role_rule` VALUES ('1', '52');
INSERT INTO `role_rule` VALUES ('1', '53');
INSERT INTO `role_rule` VALUES ('1', '54');
INSERT INTO `role_rule` VALUES ('1', '55');
INSERT INTO `role_rule` VALUES ('1', '56');

-- ----------------------------
-- Table structure for rule
-- ----------------------------
DROP TABLE IF EXISTS `rule`;
CREATE TABLE `rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父菜单',
  `name` varchar(100) NOT NULL COMMENT 'url地址 c+a',
  `title` varchar(100) NOT NULL COMMENT '菜单名称',
  `icon` varchar(100) DEFAULT NULL COMMENT '图标',
  `islink` tinyint(5) NOT NULL DEFAULT '0' COMMENT '是否菜单',
  `sort` int(3) NOT NULL DEFAULT '255' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rulename` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COMMENT='权限&菜单表';

-- ----------------------------
-- Records of rule
-- ----------------------------
INSERT INTO `rule` VALUES ('1', '0', 'index/main', '主界面', 'glyphicon glyphicon-home', '1', '0');
INSERT INTO `rule` VALUES ('2', '0', 'role', '用户组权限管理', 'fa fa-users', '1', '1');
INSERT INTO `rule` VALUES ('3', '2', 'rule/index', '菜单管理', 'fa fa-th', '1', '2');
INSERT INTO `rule` VALUES ('4', '3', 'rule/add', '添加菜单', '', '0', '255');
INSERT INTO `rule` VALUES ('5', '3', 'rule/edit', '修改菜单', '', '0', '22');
INSERT INTO `rule` VALUES ('6', '3', 'rule/destroy', '菜单删除', '', '0', '255');
INSERT INTO `rule` VALUES ('7', '2', 'Role/index', '用户组管理', 'fa fa-users', '1', '255');
INSERT INTO `rule` VALUES ('8', '7', 'role/add', '添加用户组', '', '0', '255');
INSERT INTO `rule` VALUES ('9', '7', 'role/edit', '修改用户组', '', '0', '12');
INSERT INTO `rule` VALUES ('13', '0', 'profile', '个人中心', 'fa fa-user-secret', '1', '255');
INSERT INTO `rule` VALUES ('14', '13', 'personal/profile', '个人资料', 'fa fa-user-plus', '1', '255');
INSERT INTO `rule` VALUES ('15', '13', 'index/logout', '退出', 'fa fa-sign-out', '1', '255');
INSERT INTO `rule` VALUES ('16', '7', 'role/destroy', '删除用户组', '', '0', '255');
INSERT INTO `rule` VALUES ('17', '2', 'user/index', '后台用户管理', 'fa fa-user', '1', '255');
INSERT INTO `rule` VALUES ('18', '17', 'user/add', '添加后台用户', '', '0', '255');
INSERT INTO `rule` VALUES ('19', '17', 'user/edit', '修改后台用户', '', '0', '255');
INSERT INTO `rule` VALUES ('20', '17', 'user/destroy', '删除后台用户', '', '0', '255');
INSERT INTO `rule` VALUES ('21', '0', 'system', '系统设置', 'fa fa-cog', '1', '2');
INSERT INTO `rule` VALUES ('22', '21', 'databases/index', '数据库备份', 'fa fa-database', '1', '255');
INSERT INTO `rule` VALUES ('23', '22', 'databases/optimize', '优化表', '', '0', '255');
INSERT INTO `rule` VALUES ('24', '22', 'databases/repair', '数据修复', '', '0', '255');
INSERT INTO `rule` VALUES ('25', '22', 'databases/backup', '备份表', '', '0', '255');
INSERT INTO `rule` VALUES ('26', '21', 'variable/index', '自定义变量', 'fa fa-superscript', '1', '255');
INSERT INTO `rule` VALUES ('27', '26', 'variable/add', '添加变量', '', '0', '255');
INSERT INTO `rule` VALUES ('28', '26', 'variable/edit', '修改变量', '', '0', '255');
INSERT INTO `rule` VALUES ('29', '26', 'variable/set', '修改变量值', '', '0', '255');
INSERT INTO `rule` VALUES ('30', '26', 'upload/uploadpic', '编辑器上传', '', '0', '255');
INSERT INTO `rule` VALUES ('31', '0', 'other', '其他功能管理', 'fa fa-instagram', '1', '10');
INSERT INTO `rule` VALUES ('32', '31', 'links/index', '友情链接管理', 'fa fa-link', '1', '255');
INSERT INTO `rule` VALUES ('33', '32', 'links/add', '添加友情链接', '', '0', '255');
INSERT INTO `rule` VALUES ('34', '32', 'links/edit', '修改友情链接', '', '0', '255');
INSERT INTO `rule` VALUES ('35', '32', 'links/destroy', '删除友情链接', '', '0', '255');
INSERT INTO `rule` VALUES ('36', '31', 'focusposition/index', '焦点图位置', 'fa fa-play-circle', '1', '255');
INSERT INTO `rule` VALUES ('37', '36', 'focusposition/add', '添加焦点图位置', '', '0', '255');
INSERT INTO `rule` VALUES ('38', '36', 'focusposition/edit', '修改焦点图位置', '', '0', '255');
INSERT INTO `rule` VALUES ('39', '36', 'focusposition/destroy', '删除焦点图位置', '', '0', '255');
INSERT INTO `rule` VALUES ('40', '31', 'focus/index', '焦点图', 'fa fa-money', '1', '255');
INSERT INTO `rule` VALUES ('41', '40', 'focus/add', '添加焦点图', '', '0', '255');
INSERT INTO `rule` VALUES ('42', '40', 'focus/edit', '修改焦点图', '', '0', '255');
INSERT INTO `rule` VALUES ('43', '40', 'focus/destroy', '删除焦点图', '', '0', '255');
INSERT INTO `rule` VALUES ('44', '0', 'content', '内容管理', 'fa fa-newspaper-o', '1', '3');
INSERT INTO `rule` VALUES ('45', '44', 'page/index', '单页面管理', 'fa fa-pagelines', '1', '255');
INSERT INTO `rule` VALUES ('46', '45', 'page/add', '添加单页面', '', '0', '255');
INSERT INTO `rule` VALUES ('47', '45', 'page/edit', '修改单页面', '', '0', '255');
INSERT INTO `rule` VALUES ('48', '45', 'page/destroy', '删除单页面', '', '0', '255');
INSERT INTO `rule` VALUES ('49', '44', 'ariclecategory/index', '分类管理', 'fa fa-certificate', '1', '255');
INSERT INTO `rule` VALUES ('50', '49', 'ariclecategory/add', '添加文章分类', '', '0', '255');
INSERT INTO `rule` VALUES ('51', '49', 'ariclecategory/edit', '修改文章分类', '', '0', '255');
INSERT INTO `rule` VALUES ('52', '49', 'ariclecategory/destroy', '删除文章分类', '', '0', '255');
INSERT INTO `rule` VALUES ('53', '44', 'aricle/index', '文章管理', 'fa fa-book', '1', '255');
INSERT INTO `rule` VALUES ('54', '53', 'aricle/add', '添加文章', '', '0', '255');
INSERT INTO `rule` VALUES ('55', '53', 'aricle/edit', '修改文章', '', '0', '255');
INSERT INTO `rule` VALUES ('56', '53', 'aricle/destroy', '删除文章', '', '0', '255');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL COMMENT '用户姓名',
  `email` varchar(100) NOT NULL COMMENT '用户邮件地址',
  `password` varchar(64) NOT NULL COMMENT '用户密码',
  `role_id` int(11) NOT NULL COMMENT '用户角色',
  `status` tinyint(5) NOT NULL COMMENT '是否启用',
  `sex` tinyint(5) NOT NULL DEFAULT '0' COMMENT '0：保密 1：男 2：女',
  `head` varchar(150) DEFAULT NULL,
  `birthday` date DEFAULT '1000-01-01' COMMENT '生日',
  `tel` varchar(20) DEFAULT '' COMMENT '电话号码',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`) USING BTREE,
  KEY `user_role_id` (`role_id`),
  CONSTRAINT `user_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='后台用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('2', 'Luffy Zhao', 'luffyzhao@vip.126.com', 'e10adc3949ba59abbe56e057f20f883e', '1', '1', '1', '\\static\\head\\20160612\\957b36ae60b452c7255afd38142fab87.jpg', '1991-04-03', '18620712325', '1461232560', '1465701620');
INSERT INTO `user` VALUES ('6', '? luffy丶橡皮人', 'luffyzhao@vio.126.com', '4297f44b13955235245b2497399d7a93', '1', '1', '0', '\\static\\head\\20160612\\dda72ecf5ca829ae586141b46a9721f0.png', '2016-06-12', '', '1465703454', '1465703454');

-- ----------------------------
-- Table structure for variable
-- ----------------------------
DROP TABLE IF EXISTS `variable`;
CREATE TABLE `variable` (
  `key` varchar(100) NOT NULL COMMENT '变量',
  `value` varchar(255) DEFAULT NULL COMMENT '值',
  `description` varchar(255) NOT NULL COMMENT '描述',
  `input_types` char(10) CHARACTER SET utf8 NOT NULL DEFAULT 'text' COMMENT '输入框类型 ',
  `check` varchar(50) DEFAULT 'required',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `k` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='自定义变量';

-- ----------------------------
-- Records of variable
-- ----------------------------
INSERT INTO `variable` VALUES ('default_image', '\\static\\value\\2016-05-31\\a32c0e5e0ba656dd3cc04182a9cd9c90.gif', '默认图片', 'image', '', '0', '0');
INSERT INTO `variable` VALUES ('xieyu', null, '坑底 ', 'editor', '', '0', '0');

-- ----------------------------
-- Table structure for variable_type
-- ----------------------------
DROP TABLE IF EXISTS `variable_type`;
CREATE TABLE `variable_type` (
  `type` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COMMENT='自定义变量类型';

-- ----------------------------
-- Records of variable_type
-- ----------------------------
INSERT INTO `variable_type` VALUES ('editor', '编辑器');
INSERT INTO `variable_type` VALUES ('image', '图片上传');
INSERT INTO `variable_type` VALUES ('input', '单行文本框');
INSERT INTO `variable_type` VALUES ('textarea', '多行文本框');
