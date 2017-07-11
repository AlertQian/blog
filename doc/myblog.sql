-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-07-11 11:23:15
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myblog`
--

-- --------------------------------------------------------

--
-- 表的结构 `bg_admin`
--

CREATE TABLE IF NOT EXISTS `bg_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uname` varchar(60) CHARACTER SET utf8 NOT NULL,
  `pwd` varchar(100) CHARACTER SET utf8 NOT NULL,
  `addtime` int(11) NOT NULL COMMENT '添加账号时间',
  `uptime` int(11) DEFAULT NULL COMMENT '更该账号时间',
  `type` int(1) unsigned DEFAULT NULL COMMENT '1代表自己，2代表其他人',
  PRIMARY KEY (`id`),
  KEY `uname` (`uname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `bg_admin`
--

INSERT INTO `bg_admin` (`id`, `uname`, `pwd`, `addtime`, `uptime`, `type`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1498709918, 1499484331, 1);

-- --------------------------------------------------------

--
-- 表的结构 `bg_article`
--

CREATE TABLE IF NOT EXISTS `bg_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `content` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `author` varchar(30) NOT NULL COMMENT '作者',
  `item` int(1) DEFAULT NULL COMMENT '分类',
  `addtime` int(11) NOT NULL,
  `uptime` int(11) DEFAULT NULL COMMENT '更新时间',
  `view_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文章查看数',
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `content` (`content`(255)),
  KEY `item` (`item`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `bg_article`
--

INSERT INTO `bg_article` (`id`, `title`, `content`, `author`, `item`, `addtime`, `uptime`, `view_num`) VALUES
(1, 'wampserver域名重定向被360修复而失效', '<p>之前在本地wampserver下配置好了多域名访问本地项目，然后手贱用360修复hosts导致打开wampserver用配置好的域名访问不了本地项目，解决方法：</p><p>打开本地计算机 C:\\Windows\\System32\\drivers\\etc&nbsp;目录下面的hosts文件，你会发现原来配置好的域名前面被 “#”注释了，去掉“#”保存一下就可以了。<br></p>', 'admin', NULL, 1499742795, NULL, 0),
(3, '这是测试', '<p>这是测试这是测试这是测试这是测试<img src="/imgupload/20170711/article\\1499744661246.jpg" class="artimg" style=""><br></p>', 'admin', NULL, 1499744844, NULL, 0),
(4, '对方根本', '<p>非得说</p>', 'admin', NULL, 1499761756, NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `bg_class`
--

CREATE TABLE IF NOT EXISTS `bg_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(30) NOT NULL COMMENT '分类',
  `parent` int(2) NOT NULL COMMENT '父类id',
  `addtime` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `item` (`item`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章分类' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `bg_hf`
--

CREATE TABLE IF NOT EXISTS `bg_hf` (
  `hf_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ht_id` int(10) unsigned NOT NULL COMMENT '文章id',
  `hf_name` varchar(60) NOT NULL COMMENT '回复者的姓名',
  `hf_content` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `hf_date` int(10) NOT NULL,
  `lz_hf` varchar(1000) NOT NULL,
  `lzhf_date` int(10) NOT NULL COMMENT '楼主回复时间',
  `fromhf_id` int(10) NOT NULL COMMENT '引用回复id',
  PRIMARY KEY (`hf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `bg_info`
--

CREATE TABLE IF NOT EXISTS `bg_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) CHARACTER SET utf8 NOT NULL COMMENT '博客名称',
  `signature` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT '签名信息',
  `visitors_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '访客数',
  `web_info` varchar(300) CHARACTER SET utf8 DEFAULT NULL COMMENT '站点信息',
  `addtime` int(10) unsigned NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `bg_info`
--

INSERT INTO `bg_info` (`id`, `title`, `signature`, `visitors_num`, `web_info`, `addtime`) VALUES
(1, 'AlertQian的博客', '海到无边天作岸，山高绝顶人为峰', 0, 'This is my first site built by myself', 1499484530);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
