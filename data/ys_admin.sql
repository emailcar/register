-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 08 月 28 日 01:57
-- 服务器版本: 5.7.1-m11
-- PHP 版本: 5.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `marryys`
--

-- --------------------------------------------------------

--
-- 表的结构 `ys_admin`
--

CREATE TABLE IF NOT EXISTS `ys_admin` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_esperanto_ci NOT NULL,
  `admin_password` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_esperanto_ci NOT NULL DEFAULT 'e10adc3949ba59abbe56e057f20f883e',
  `user_classify` bigint(20) unsigned DEFAULT '1',
  `admin_number` bigint(20) NOT NULL,
  `admin_remark` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_esperanto_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- 转存表中的数据 `ys_admin`
--

INSERT INTO `ys_admin` (`id`, `admin_name`, `admin_password`, `user_classify`, `admin_number`, `admin_remark`) VALUES
(2, 'root', 'e10adc3949ba59abbe56e057f20f883e', 1, 3, ''),
(4, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 0, 1, ''),
(24, '李华', 'e10adc3949ba59abbe56e057f20f883e', 1, 34, '十月添加'),
(26, '张丹', 'e10adc3949ba59abbe56e057f20f883e', 1, 21, 'f'),
(31, '李华', 'e10adc3949ba59abbe56e057f20f883e', 1, 20, '备注部分'),
(32, '倒霉熊', 'e10adc3949ba59abbe56e057f20f883e', 1, 25, '八月22'),
(33, '张先生', 'e10adc3949ba59abbe56e057f20f883e', 1, 11, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
