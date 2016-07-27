-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-07-24 07:24:34
-- 服务器版本： 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newshop`
--

-- --------------------------------------------------------

--
-- 表的结构 `newshop_auth_group`
--

DROP TABLE IF EXISTS `newshop_auth_group`;
CREATE TABLE IF NOT EXISTS `newshop_auth_group` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` varchar(300) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `newshop_auth_group`
--

INSERT INTO `newshop_auth_group` (`id`, `title`, `status`, `rules`) VALUES
(1, '管理员', 1, '19,22,21,20,15,18,17,16,9,14,13,12,11,10,3,8,7,6,5,4,2,1'),
(4, '生产员', 1, '1,21,2,22,26,27,28,29,30,31'),
(2, '测试员', 1, '1,2,3,4,7,8,9'),
(3, '一般员工', 1, '19,21,20,15,18,17,16,2,1'),
(5, '生产员1', 0, '1,21,2,22,26,27,28,29,30,31'),
(6, 'ceee', 0, '1,21');

-- --------------------------------------------------------

--
-- 表的结构 `newshop_auth_group_access`
--

DROP TABLE IF EXISTS `newshop_auth_group_access`;
CREATE TABLE IF NOT EXISTS `newshop_auth_group_access` (
  `uid` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `newshop_auth_group_access`
--

INSERT INTO `newshop_auth_group_access` (`uid`, `group_id`) VALUES
(1, 1),
(2, 2),
(1141, 1),
(1145, 3);

-- --------------------------------------------------------

--
-- 表的结构 `newshop_auth_rule`
--

DROP TABLE IF EXISTS `newshop_auth_rule`;
CREATE TABLE IF NOT EXISTS `newshop_auth_rule` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '父级id',
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `newshop_auth_rule`
--

INSERT INTO `newshop_auth_rule` (`id`, `pid`, `name`, `title`, `type`, `status`, `condition`) VALUES
(22, 19, 'admin/categorys/del', '删除栏目', 1, 1, ''),
(21, 19, 'admin/categorys/edit', '修改栏目', 1, 1, 'condition'),
(20, 19, 'admin/categorys/add', '增加栏目', 1, 1, 'condition'),
(19, 0, 'admin/categorys/index', '栏目管理', 1, 1, 'condition'),
(18, 15, 'admin/goods/ajaxdel', 'ajax删除商品', 1, 1, 'condition'),
(17, 15, 'admin/goods/edit', '修改商品', 1, 1, 'condition'),
(16, 15, 'admin/goods/add', '增加商品', 1, 1, 'condition'),
(15, 0, 'admin/goods/index', '商品管理', 1, 1, 'condition'),
(14, 9, 'admin/group/recover', '恢复角色', 1, 1, 'condition'),
(13, 9, 'admin/group/del', '删除角色', 1, 1, 'condition'),
(12, 9, 'admin/group/add', '增加角色', 1, 1, 'condition'),
(11, 9, 'admin/group/ajaxmodify', 'ajax修改角色', 1, 1, 'condition'),
(10, 9, 'admin/group/modify', '修改角色', 1, 1, 'condition'),
(9, 0, 'admin/group/index', '角色控制', 1, 1, 'condition'),
(8, 3, 'admin/manager/recover', '恢复管理员', 1, 1, 'condition'),
(7, 3, 'admin/manager/assignrole', '分配角色', 1, 1, 'condition'),
(6, 3, 'admin/manager/delmanager', '删除管理员', 1, 1, 'condition'),
(5, 3, 'admin/manager/editmanager', '修改管理员', 1, 1, 'condition'),
(4, 3, 'admin/manager/addmanager', '增加管理员', 1, 1, 'condition'),
(3, 0, 'admin/manager/index', '管理员控制', 1, 1, 'condition'),
(2, 0, 'admin/index/welcome', '欢迎页面', 1, 1, 'condition'),
(1, 0, 'admin/index/index', '管理首页', 1, 1, 'condition');

-- --------------------------------------------------------

--
-- 表的结构 `newshop_comment`
--

DROP TABLE IF EXISTS `newshop_comment`;
CREATE TABLE IF NOT EXISTS `newshop_comment` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `content` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `newshop_comment`
--

INSERT INTO `newshop_comment` (`id`, `goods_id`, `content`) VALUES
(1, 11, '测试内容'),
(2, 11, '擦擦擦擦擦擦');

-- --------------------------------------------------------

--
-- 表的结构 `newshop_goods`
--

DROP TABLE IF EXISTS `newshop_goods`;
CREATE TABLE IF NOT EXISTS `newshop_goods` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sn` char(15) NOT NULL DEFAULT '',
  `cat_id` smallint(6) NOT NULL DEFAULT '0',
  `brand_id` smallint(6) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `shop_price` decimal(9,2) NOT NULL DEFAULT '0.00',
  `market_price` decimal(9,2) NOT NULL DEFAULT '0.00',
  `goods_number` smallint(6) NOT NULL DEFAULT '1',
  `click_count` mediumint(9) NOT NULL DEFAULT '0',
  `weight` decimal(6,3) NOT NULL DEFAULT '0.000',
  `brief` varchar(100) NOT NULL DEFAULT '',
  `goods_desc` text NOT NULL,
  `thumb_img` varchar(200) NOT NULL DEFAULT '',
  `goods_img` varchar(200) DEFAULT NULL,
  `ori_img` varchar(200) DEFAULT NULL,
  `is_on_sale` tinyint(4) NOT NULL DEFAULT '1',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  `is_best` tinyint(4) NOT NULL DEFAULT '0',
  `is_new` tinyint(4) NOT NULL DEFAULT '0',
  `is_hot` tinyint(4) NOT NULL DEFAULT '0',
  `add_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `last_update` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `keywords` varchar(100) NOT NULL DEFAULT '',
  `seller_note` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `goods_sn` (`sn`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `newshop_goods`
--

INSERT INTO `newshop_goods` (`id`, `sn`, `cat_id`, `brand_id`, `name`, `shop_price`, `market_price`, `goods_number`, `click_count`, `weight`, `brief`, `goods_desc`, `thumb_img`, `goods_img`, `ori_img`, `is_on_sale`, `is_delete`, `is_best`, `is_new`, `is_hot`, `add_time`, `last_update`, `keywords`, `seller_note`) VALUES
(20, 'GD2016072125652', 9, 0, '小米 Note 全网通 白色 移动联通电信4G手机 双卡双待', '1299.00', '1600.00', 10, 0, '1.000', '低至1299元！7.21-7.28打白条6期免息！限时赠送充电宝！小米Note 7.18日零点开始大促，转盘抽奖狂送1200万优惠券、送手机充电宝', '&lt;ul class=&quot;parameter1 p-parameter-list list-paddingleft-2&quot; style=&quot;list-style-type: none;&quot;&gt;&lt;li&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 4px; padding: 0px; text-overflow: ellipsis; overflow: hidden; width: 197px;&quot;&gt;屏幕尺寸：5.7英寸&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 4px; padding: 0px; text-overflow: ellipsis; overflow: hidden; width: 197px;&quot;&gt;分辨率：1920×1080(FHD,1080P)&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;span class=&quot;i-camera&quot; style=&quot;margin: 2px 0px 0px -37px; padding: 0px; float: left; width: 33px; height: 33px; overflow: hidden; line-height: 1000px; background-image: url(&amp;quot;//static.360buyimg.com/item/default/1.0.12/components/detail/i/param2.png&amp;quot;); background-position: 0px 0px; background-repeat: no-repeat;&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 4px; padding: 0px; text-overflow: ellipsis; overflow: hidden; width: 197px;&quot;&gt;后置摄像头：1300万像素&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 4px; padding: 0px; text-overflow: ellipsis; overflow: hidden; width: 197px;&quot;&gt;前置摄像头：400万像素&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;span class=&quot;i-cpu&quot; style=&quot;margin: 2px 0px 0px -37px; padding: 0px; float: left; width: 33px; height: 33px; overflow: hidden; line-height: 1000px; background-image: url(&amp;quot;//static.360buyimg.com/item/default/1.0.12/components/detail/i/param3.png&amp;quot;); background-position: 0px 0px; background-repeat: no-repeat;&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 4px; padding: 0px; text-overflow: ellipsis; overflow: hidden; width: 197px;&quot;&gt;核&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;数：四核&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 4px; padding: 0px; text-overflow: ellipsis; overflow: hidden; width: 197px;&quot;&gt;频&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;率：2.5GHz&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;span class=&quot;i-network&quot; style=&quot;margin: 2px 0px 0px -37px; padding: 0px; float: left; width: 33px; height: 33px; overflow: hidden; line-height: 1000px; background-image: url(&amp;quot;//static.360buyimg.com/item/default/1.0.12/components/detail/i/param4.png&amp;quot;); background-position: 0px 0px; background-repeat: no-repeat;&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 4px; padding: 0px; text-overflow: ellipsis; overflow: hidden; width: 197px;&quot;&gt;4G：移动/联通/电信&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 4px; padding: 0px; text-overflow: ellipsis; overflow: hidden; width: 197px;&quot;&gt;3G：移动(TD-SCDMA)/联通(WCDMA)/电信(CDMA2000)&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 4px; padding: 0px; text-overflow: ellipsis; overflow: hidden; width: 197px;&quot;&gt;2G：移动/联通(GSM)/电信(CDMA)&lt;/p&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', 'good/2016-07-21/thumb_5790ccfc5dd94.jpg,good/2016-07-21/thumb_5790ccfc5ee99.jpg', 'good/2016-07-21/goods_5790ccfc5dd94.jpg,good/2016-07-21/goods_5790ccfc5ee99.jpg', 'good/2016-07-21/5790ccfc5dd94.jpg,good/2016-07-21/5790ccfc5ee99.jpg', 1, 0, 1, 0, 0, 1469107452, 0, '', ''),
(19, 'GD2016072193472', 8, 0, '华为 麦芒5 全网通 4GB+64GB版 香槟金 移动联通电信4G手机 双卡双待', '2599.00', '3000.00', 1, 0, '1.000', '预订用户一周左右陆续发货！光学防抖，持久续航！购机享12期白条免息！评价晒单返京豆！', '&lt;ul class=&quot;parameter2 p-parameter-list list-paddingleft-2&quot; style=&quot;list-style-type: none;&quot;&gt;&lt;li&gt;&lt;p&gt;商品名称：华为麦芒5&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;商品编号：3234250&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;商品毛重：460.00g&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;商品产地：中国大陆&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;热点：双卡双待，指纹识别&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;运行内存：4GB&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;像素：1000-1600万&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;机身内存：64GB&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;系统：安卓（Android）&lt;/p&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;img src=&quot;/newshop/Application/Public/upload/good_art/image/20160721/1469107279945924.jpg&quot; title=&quot;1469107279945924.jpg&quot; alt=&quot;578736a7Neff8de0b.jpg&quot;/&gt;&lt;/p&gt;', 'good/2016-07-21/thumb_5790cc771f252.jpg,good/2016-07-21/thumb_5790cc7729b1a.jpg,good/2016-07-21/thumb_5790cc772ad3f.jpg', 'good/2016-07-21/goods_5790cc771f252.jpg,good/2016-07-21/goods_5790cc7729b1a.jpg,good/2016-07-21/goods_5790cc772ad3f.jpg', 'good/2016-07-21/5790cc771f252.jpg,good/2016-07-21/5790cc7729b1a.jpg,good/2016-07-21/5790cc772ad3f.jpg', 1, 0, 0, 1, 0, 1469107319, 0, '华为,智能手机', ''),
(18, 'GD2016072154704', 8, 0, '荣耀7 (PLK-AL10) 3GB+64GB内存版 荣耀金 移动联通电信4G手机 双卡双待双通', '1900.00', '2100.00', 11, 0, '1.000', '一键智灵，指纹识别，2000万后置摄像头！【荣耀手机~更多惊喜请点击】\r\n选择下方购买方式→【移动优惠购】→【北京老用户优惠购机】即享优惠【套餐享7折+免费宽带】', '&lt;ul class=&quot;parameter2 p-parameter-list list-paddingleft-2&quot; style=&quot;list-style-type: none;&quot;&gt;&lt;li&gt;&lt;p&gt;商品名称：华为荣耀7(PLK-AL10)&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;商品编号：1684485&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;商品毛重：157.00g&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;商品产地：中国大陆&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;系统：安卓（Android）&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;运行内存：3GB&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;热点：以旧换新，双卡双待，指纹识别，金属机身&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;机身内存：64GB&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;机身颜色：金色&lt;/p&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;img src=&quot;/newshop/Application/Public/upload/good_art/image/20160721/1469087461135412.jpg&quot; title=&quot;1469087461135412.jpg&quot; alt=&quot;57340e61N9e4663f4.jpg&quot;/&gt;&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;', 'good/2016-07-21/thumb_57907ef086869.jpg,good/2016-07-21/thumb_57907ef08822f.jpg,good/2016-07-21/thumb_57907ef08e320.jpg', 'good/2016-07-21/goods_57907ef086869.jpg,good/2016-07-21/goods_57907ef08822f.jpg,good/2016-07-21/goods_57907ef08e320.jpg', 'good/2016-07-21/57907ef086869.jpg,good/2016-07-21/57907ef08822f.jpg,good/2016-07-21/57907ef08e320.jpg', 1, 0, 1, 0, 0, 1469087473, 0, '华为,智能手机', ''),
(21, 'GD2016072154674', 10, 0, '三星 Galaxy C5（SM-C5000）32G版 枫叶金 移动联通电信4G手机 双卡双待', '2199.00', '2500.00', 5, 0, '1.000', '现在购买享受12期白条免息！八核CPU，4GB运行内存，5.2英寸大屏，数码变焦！抢购三星C7，享12期免息！\r\n推荐选择下方【移动优惠购】，手机套餐齐搞定，不用换号，每月还有话费返。', '&lt;ul class=&quot;parameter1 p-parameter-list list-paddingleft-2&quot; style=&quot;list-style-type: none;&quot;&gt;&lt;li&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 4px; padding: 0px; text-overflow: ellipsis; overflow: hidden; width: 197px;&quot;&gt;屏幕尺寸：5.2英寸&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 4px; padding: 0px; text-overflow: ellipsis; overflow: hidden; width: 197px;&quot;&gt;分辨率：1920×1080(FHD,1080P)&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;span class=&quot;i-camera&quot; style=&quot;margin: 2px 0px 0px -37px; padding: 0px; float: left; width: 33px; height: 33px; overflow: hidden; line-height: 1000px; background-image: url(&amp;quot;//static.360buyimg.com/item/default/1.0.12/components/detail/i/param2.png&amp;quot;); background-position: 0px 0px; background-repeat: no-repeat;&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 4px; padding: 0px; text-overflow: ellipsis; overflow: hidden; width: 197px;&quot;&gt;后置摄像头：1600万像素&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 4px; padding: 0px; text-overflow: ellipsis; overflow: hidden; width: 197px;&quot;&gt;前置摄像头：800万像素&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;span class=&quot;i-cpu&quot; style=&quot;margin: 2px 0px 0px -37px; padding: 0px; float: left; width: 33px; height: 33px; overflow: hidden; line-height: 1000px; background-image: url(&amp;quot;//static.360buyimg.com/item/default/1.0.12/components/detail/i/param3.png&amp;quot;); background-position: 0px 0px; background-repeat: no-repeat;&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 4px; padding: 0px; text-overflow: ellipsis; overflow: hidden; width: 197px;&quot;&gt;核&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;数：八核&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 4px; padding: 0px; text-overflow: ellipsis; overflow: hidden; width: 197px;&quot;&gt;频&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;率：1.5GHz&lt;/p&gt;&lt;/li&gt;&lt;li&gt;&lt;p&gt;&lt;span class=&quot;i-network&quot; style=&quot;margin: 2px 0px 0px -37px; padding: 0px; float: left; width: 33px; height: 33px; overflow: hidden; line-height: 1000px; background-image: url(&amp;quot;//static.360buyimg.com/item/default/1.0.12/components/detail/i/param4.png&amp;quot;); background-position: 0px 0px; background-repeat: no-repeat;&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 4px; padding: 0px; text-overflow: ellipsis; overflow: hidden; width: 197px;&quot;&gt;4G：移动/联通/电信&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 4px; padding: 0px; text-overflow: ellipsis; overflow: hidden; width: 197px;&quot;&gt;3G：移动(TD-SCDMA)/联通(WCDMA)/电信(CDMA2000)&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 4px; padding: 0px; text-overflow: ellipsis; overflow: hidden; width: 197px;&quot;&gt;2G：移动/联通(GSM)/电信(CDMA)&lt;/p&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;img src=&quot;/newshop/Application/Public/upload/good_art/image/20160721/1469107597718157.jpg&quot; title=&quot;1469107597718157.jpg&quot; alt=&quot;5754e156N97acd9e5.jpg&quot;/&gt;&lt;/p&gt;', 'good/2016-07-21/thumb_5790cd8f49630.jpg,good/2016-07-21/thumb_5790cd8f517e5.jpg', 'good/2016-07-21/goods_5790cd8f49630.jpg,good/2016-07-21/goods_5790cd8f517e5.jpg', 'good/2016-07-21/5790cd8f49630.jpg,good/2016-07-21/5790cd8f517e5.jpg', 1, 0, 0, 1, 0, 1469107599, 0, '', ''),
(22, 'GD2016072165099', 11, 0, 'Cawa 佳能 1300D相机贴膜 屏幕保护膜 AR蓝光高清抗反射膜', '58.00', '66.00', 10, 0, '1.000', '屏幕保护膜 AR蓝光高清抗反射膜', '&lt;p&gt;&lt;span style=&quot;margin: 0px; padding: 0px; font-family: SimHei; font-size: x-large; color: rgb(204, 0, 0);&quot;&gt;&lt;strong style=&quot;margin: 0px; padding: 0px;&quot;&gt;(赠送全套贴膜工具! 58元膜默认为AR蓝光高清抗反射(光学级PET)-相机专用材料, 如需GF/HC\\AF三种材料可以联系客服的哟! /:^_^)&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;margin: 0px; padding: 0px; font-family: SimHei; font-size: x-large; color: rgb(204, 0, 0);&quot;&gt;&lt;strong style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;br/&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;margin: 0px; padding: 0px; font-family: SimHei; font-size: x-large; color: rgb(204, 0, 0);&quot;&gt;&lt;strong style=&quot;margin: 0px; padding: 0px;&quot;&gt;GF高清防指纹材料-进口PET 16.8元/张&amp;nbsp;&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;margin: 0px; padding: 0px; font-family: SimHei; font-size: x-large; color: rgb(204, 0, 0);&quot;&gt;&lt;strong style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;br/&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;margin: 0px; padding: 0px; line-height: 18px; font-family: SimHei; font-size: x-large; color: rgb(204, 0, 0); background-color: rgb(255, 255, 255);&quot;&gt;&lt;strong style=&quot;margin: 0px; padding: 0px;&quot;&gt;HC高清防刮-光学级 35.8元/张&lt;/strong&gt;&lt;/span&gt;&lt;span style=&quot;color: rgb(102, 102, 102); font-family: Arial, Verdana, 宋体; font-size: 12px; line-height: 18px; background-color: rgb(255, 255, 255);&quot;&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;span style=&quot;margin: 0px; padding: 0px; font-family: SimHei; font-size: x-large; color: rgb(204, 0, 0);&quot;&gt;&lt;strong style=&quot;margin: 0px; padding: 0px;&quot;&gt;AF高清防指纹-光学级 46.6元/张&amp;nbsp;&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;/newshop/Application/Public/upload/good_art/image/20160721/1469107678854740.jpg&quot; title=&quot;1469107678854740.jpg&quot; alt=&quot;573e8435N12b9d0f5.jpg&quot;/&gt;&lt;/p&gt;', 'good/2016-07-21/thumb_5790ce1d3f27a.jpg', 'good/2016-07-21/goods_5790ce1d3f27a.jpg', 'good/2016-07-21/5790ce1d3f27a.jpg', 1, 0, 0, 0, 1, 1469107741, 0, '贴膜,屏幕', '');

-- --------------------------------------------------------

--
-- 表的结构 `newshop_good_categorys`
--

DROP TABLE IF EXISTS `newshop_good_categorys`;
CREATE TABLE IF NOT EXISTS `newshop_good_categorys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '',
  `intro` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `newshop_good_categorys`
--

INSERT INTO `newshop_good_categorys` (`id`, `pid`, `name`, `intro`) VALUES
(7, 0, '手机', ''),
(8, 7, '华为', ''),
(9, 7, '小米', ''),
(10, 7, '三星', ''),
(11, 0, '数码配件', ''),
(13, 0, 'ttt', '');

-- --------------------------------------------------------

--
-- 表的结构 `newshop_home_menu`
--

DROP TABLE IF EXISTS `newshop_home_menu`;
CREATE TABLE IF NOT EXISTS `newshop_home_menu` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '父级id',
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `newshop_home_menu`
--

INSERT INTO `newshop_home_menu` (`id`, `pid`, `name`, `title`) VALUES
(1, 0, 'home/index/category', '分类栏目'),
(2, 0, 'home/goods/index', '全部商品'),
(3, 1, 'home/goods/detail', '商品详情'),
(4, 0, 'home/flow/add', '购物车'),
(5, 4, 'home/flow/checkout', '确认提单'),
(6, 5, 'home/flow/done', '生成提单'),
(7, 0, 'home/user/index', '个人中心'),
(8, 0, 'home/user/register', '注册'),
(9, 0, 'home/user/login', '登录');

-- --------------------------------------------------------

--
-- 表的结构 `newshop_mg_keys`
--

DROP TABLE IF EXISTS `newshop_mg_keys`;
CREATE TABLE IF NOT EXISTS `newshop_mg_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(20) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `newshop_mg_users`
--

DROP TABLE IF EXISTS `newshop_mg_users`;
CREATE TABLE IF NOT EXISTS `newshop_mg_users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '登录密码；mb_password加密',
  `salt` char(8) NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT '登录邮箱',
  `email_code` varchar(60) DEFAULT '' COMMENT '激活码',
  `phone` varchar(11) DEFAULT '' COMMENT '手机号',
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '用户状态 0：禁用； 1：正常 ；2：未验证',
  `register_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login_ip` varchar(16) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `last_login_time` int(10) UNSIGNED NOT NULL COMMENT '最后登录时间',
  PRIMARY KEY (`id`),
  KEY `user_login_key` (`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1149 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `newshop_mg_users`
--

INSERT INTO `newshop_mg_users` (`id`, `username`, `password`, `salt`, `email`, `email_code`, `phone`, `status`, `register_time`, `last_login_ip`, `last_login_time`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '', 'haoranclover@gmail.com', '', '13590942242', 1, 0, '', 0),
(1141, 'addams', 'e10adc3949ba59abbe56e057f20f883e', '', 'haoranclover@gmail.com', '', '13590942242', 1, 1468392053, '', 1468392053),
(1142, 'addamx', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', 0, 1468392255, '', 1468392255),
(1143, 'addamxx', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', 0, 1468392371, '', 1468392371),
(1144, 'testt', 'c8837b23ff8aaa8a2dde915473ce0991', '', 'haoranclover@gmail.com', '', '', 1, 1468403204, '', 1468403204),
(1145, 'Johon', 'e10adc3949ba59abbe56e057f20f883e', '', 'ccc@gmail.com', '', '13590923323', 1, 1468419381, '', 1468419381),
(1148, 'aaaaaxxxx', 'dbb05cef13c46b73aff521962a1d682d', '7&9a0qju', '', '', '', 0, 1468996762, '', 1468996762);

-- --------------------------------------------------------

--
-- 表的结构 `newshop_ordgoods`
--

DROP TABLE IF EXISTS `newshop_ordgoods`;
CREATE TABLE IF NOT EXISTS `newshop_ordgoods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ordinfo_id` int(11) NOT NULL DEFAULT '0',
  `goods_id` int(11) NOT NULL DEFAULT '0',
  `goods_name` varchar(100) DEFAULT NULL,
  `shop_price` decimal(7,2) DEFAULT NULL,
  `num` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ordinfo_id` (`ordinfo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `newshop_ordgoods`
--

INSERT INTO `newshop_ordgoods` (`id`, `ordinfo_id`, `goods_id`, `goods_name`, `shop_price`, `num`) VALUES
(24, 31, 22, 'Cawa 佳能 1300D相机贴膜 屏幕保护膜 AR蓝光高清抗反射膜', '58.00', 1),
(23, 30, 21, '三星 Galaxy C5（SM-C5000）32G版 枫叶金 移动联通电信4G手机 双卡双待', '2199.00', 1),
(22, 28, 19, '华为 麦芒5 全网通 4GB+64GB版 香槟金 移动联通电信4G手机 双卡双待', '2599.00', 1),
(21, 26, 19, '华为 麦芒5 全网通 4GB+64GB版 香槟金 移动联通电信4G手机 双卡双待', '2599.00', 1),
(17, 20, 19, '华为 麦芒5 全网通 4GB+64GB版 香槟金 移动联通电信4G手机 双卡双待', '2599.00', 2),
(18, 21, 19, '华为 麦芒5 全网通 4GB+64GB版 香槟金 移动联通电信4G手机 双卡双待', '2599.00', 2),
(19, 24, 22, 'Cawa 佳能 1300D相机贴膜 屏幕保护膜 AR蓝光高清抗反射膜', '58.00', 3),
(20, 25, 21, '三星 Galaxy C5（SM-C5000）32G版 枫叶金 移动联通电信4G手机 双卡双待', '2199.00', 1);

-- --------------------------------------------------------

--
-- 表的结构 `newshop_ordinfo`
--

DROP TABLE IF EXISTS `newshop_ordinfo`;
CREATE TABLE IF NOT EXISTS `newshop_ordinfo` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ord_sn` char(15) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `xm` char(10) NOT NULL DEFAULT '',
  `mobile` char(11) DEFAULT NULL,
  `address` varchar(30) DEFAULT NULL,
  `paytype` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:在线,2:到付',
  `paystatus` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0未支付, 1已付',
  `money` decimal(9,2) DEFAULT NULL,
  `note` varchar(20) NOT NULL DEFAULT '',
  `ordtime` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `newshop_ordinfo`
--

INSERT INTO `newshop_ordinfo` (`id`, `ord_sn`, `user_id`, `xm`, `mobile`, `address`, `paytype`, `paystatus`, `money`, `note`, `ordtime`, `is_delete`) VALUES
(24, 'OD2016072376678', 1141, '晨晨', '13808829003', '阿萨德', 1, 0, '174.00', '', 1469273423, 0),
(21, 'OD2016072382528', 1141, '晨晨', '18927389332', 'yui Rodad 12th', 1, 0, '5198.00', '嘻嘻嘻嘻嘻嘻嘻嘻嘻嘻嘻嘻', 1469273293, 0),
(20, 'OD2016072343609', 1141, 'Addamx YU', '17828737372', '都是啥地方', 1, 0, '5198.00', '', 1469266695, 0),
(25, 'OD2016072311083', 1141, '大法师', '', '', 1, 0, '2199.00', '', 1469273496, 0),
(26, 'OD2016072358528', 1141, '', '', '', 1, 0, '2599.00', '', 1469273518, 0),
(28, 'OD2016072320837', 1141, '', '', '', 1, 0, '2599.00', '', 1469273578, 0),
(30, 'OD2016072330779', 1141, '', '', '', 1, 0, '2199.00', '', 1469273638, 0),
(31, 'OD2016072342216', 1141, '', '', '', 1, 0, '58.00', '', 1469273700, 0);

-- --------------------------------------------------------

--
-- 表的结构 `newshop_users`
--

DROP TABLE IF EXISTS `newshop_users`;
CREATE TABLE IF NOT EXISTS `newshop_users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(64) NOT NULL DEFAULT '' COMMENT '登录密码；mb_password加密',
  `avatar` varchar(255) NOT NULL DEFAULT '' COMMENT '用户头像，相对于upload/avatar目录',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT '登录邮箱',
  `phone` bigint(11) UNSIGNED DEFAULT NULL COMMENT '手机号',
  `status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '用户状态 0：禁用； 1：正常 ；2：未验证',
  `register_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login_ip` varchar(16) NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `last_login_time` int(10) UNSIGNED NOT NULL COMMENT '最后登录时间',
  `email_code` varchar(60) NOT NULL DEFAULT '',
  `salt` char(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_login_key` (`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1142 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `newshop_users`
--

INSERT INTO `newshop_users` (`id`, `username`, `password`, `avatar`, `email`, `phone`, `status`, `register_time`, `last_login_ip`, `last_login_time`, `email_code`, `salt`) VALUES
(1141, 'addams', 'bb2128d0e1edd54c63307c3ba3dfaadf', '', 'haoranclover@gmail.com', NULL, 1, 1469215209, '', 1469215209, '', 'lo0*[ji3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
