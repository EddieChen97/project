-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 2019-02-18 09:27:49
-- 服务器版本： 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cbwwdndg`
--

-- --------------------------------------------------------

--
-- 表的结构 `blog_category`
--

DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE IF NOT EXISTS `blog_category` (
  `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '分类id',
  `cat_name` varchar(20) NOT NULL COMMENT '分类名称',
  `order` int(4) UNSIGNED NOT NULL COMMENT '排序',
  `cat_url` varchar(20) NOT NULL COMMENT '分类地址',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `blog_category`
--

INSERT INTO `blog_category` (`id`, `cat_name`, `order`, `cat_url`, `create_time`, `update_time`) VALUES
(1, 'php', 1, '?cat=1', 1530251993, 1530323014),
(2, 'mysql', 2, '?cat=2', 1530252176, 1530323029),
(3, 'javascript', 3, '?cat=3', 1530252216, 1530323049);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
