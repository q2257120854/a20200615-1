-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2020-01-12 13:18:42
-- 服务器版本： 5.6.44-log
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `km_ziiiz_cn`
--

-- --------------------------------------------------------

--
-- 表的结构 `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL COMMENT '账户',
  `password` varchar(62) DEFAULT NULL COMMENT '账户密码',
  `passwords` varchar(64) NOT NULL COMMENT '操作密码',
  `rname` text COMMENT '真实姓名',
  `amount` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '网站用户可用额度',
  `supamount` float(255,3) NOT NULL DEFAULT '0.000' COMMENT 'Sup金额',
  `founder` int(1) NOT NULL DEFAULT '0' COMMENT '创始人',
  `flag` text COMMENT '会员权限',
  `email` varchar(60) NOT NULL COMMENT '绑定邮箱',
  `begtime` int(11) NOT NULL COMMENT '从开始到现在的时间'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `administrator`
--

INSERT INTO `administrator` (`id`, `username`, `password`, `passwords`, `rname`, `amount`, `supamount`, `founder`, `flag`, `email`, `begtime`) VALUES
(1, 'admin', '2e2d43e555b454f64dc3235c9b0431c2', '2e2d43e555b454f64dc3235c9b0431c2', 'PHP源码分享网 www.phpkm.cn', 99999000.000, 0.000, 1, '101,102,103,104,105,106,107,108,109,110,111,201,203,301,302,303,304,305,306,307,308,401,402,403,404,405,406,407,408,409,410,411,412,501,601,602,603,701,702,703,704,705,706,707,708,709,710,711,801,802', '843367003@qq.com', 1543549663);

-- --------------------------------------------------------

--
-- 表的结构 `advertising`
--

CREATE TABLE IF NOT EXISTS `advertising` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `begtime` int(11) NOT NULL,
  `content` text
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '信息标题',
  `color` varchar(50) NOT NULL COMMENT '标题颜色',
  `menu` varchar(50) NOT NULL COMMENT '信息栏目',
  `source` varchar(50) NOT NULL COMMENT '信息来源',
  `begtime` int(11) NOT NULL,
  `content` text,
  `hiddens` int(2) DEFAULT NULL COMMENT '显示隐藏'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `balance_cash`
--

CREATE TABLE IF NOT EXISTS `balance_cash` (
  `id` int(11) NOT NULL,
  `number` int(11) DEFAULT NULL COMMENT '会员编号',
  `type` varchar(50) DEFAULT NULL COMMENT '账户类型',
  `account` varchar(50) DEFAULT NULL COMMENT '账户号码',
  `rname` varchar(50) DEFAULT NULL COMMENT '开户姓名',
  `price` float(12,3) DEFAULT NULL COMMENT '提现金额',
  `audit` int(2) NOT NULL COMMENT '审核',
  `begtime` int(11) NOT NULL COMMENT '时间：秒'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `bobo_links`
--

CREATE TABLE IF NOT EXISTS `bobo_links` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `img` text NOT NULL COMMENT '图片地址',
  `begtime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `buy_modl`
--

CREATE TABLE IF NOT EXISTS `buy_modl` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL COMMENT '手工充值模板名称',
  `custom1` varchar(50) DEFAULT NULL COMMENT '自定义名称1',
  `type1` int(2) DEFAULT NULL COMMENT '自定义类型1',
  `content1` varchar(50) DEFAULT NULL COMMENT '自定义选项内容1',
  `custom2` varchar(50) DEFAULT NULL COMMENT '自定义名称2',
  `type2` int(2) DEFAULT NULL COMMENT '自定义类型2',
  `content2` varchar(50) DEFAULT NULL COMMENT '自定义选项内容2',
  `custom3` varchar(50) DEFAULT NULL COMMENT '自定义名称3',
  `type3` int(2) DEFAULT NULL COMMENT '自定义类型3',
  `content3` varchar(50) DEFAULT NULL COMMENT '自定义选项内容3',
  `custom4` varchar(50) DEFAULT NULL COMMENT '自定义名称4',
  `type4` int(2) DEFAULT NULL COMMENT '自定义类型4',
  `content4` varchar(50) DEFAULT NULL COMMENT '自定义选项内容4',
  `custom5` varchar(50) DEFAULT NULL COMMENT '自定义名称5',
  `type5` int(2) DEFAULT NULL COMMENT '自定义类型5',
  `content5` varchar(50) DEFAULT NULL COMMENT '自定义选项内容5',
  `custom6` varchar(50) DEFAULT NULL COMMENT '自定义名称6',
  `type6` int(2) DEFAULT NULL COMMENT '自定义类型6',
  `content6` varchar(50) DEFAULT NULL COMMENT '自定义选项内容6',
  `custom7` varchar(50) DEFAULT NULL COMMENT '自定义名称7',
  `type7` int(2) DEFAULT NULL COMMENT '自定义类型7',
  `content7` varchar(50) DEFAULT NULL COMMENT '自定义选项内容7',
  `custom8` varchar(50) DEFAULT NULL COMMENT '自定义名称7',
  `type8` int(2) DEFAULT NULL COMMENT '自定义类型7',
  `content8` varchar(50) DEFAULT NULL COMMENT '自定义选项内容7',
  `time` int(11) NOT NULL COMMENT '发布时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `check_email`
--

CREATE TABLE IF NOT EXISTS `check_email` (
  `id` int(11) NOT NULL,
  `locks` int(1) NOT NULL DEFAULT '0',
  `check` varchar(32) NOT NULL COMMENT '验证信息',
  `username` varchar(32) NOT NULL COMMENT '用户名',
  `begtime` int(11) NOT NULL COMMENT '操作时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `check_reg`
--

CREATE TABLE IF NOT EXISTS `check_reg` (
  `id` int(11) NOT NULL,
  `locks` int(1) NOT NULL DEFAULT '0' COMMENT '是否激活',
  `checkcode` varchar(32) NOT NULL COMMENT '验证信息',
  `content` text NOT NULL COMMENT '数据内容',
  `begtime` int(11) NOT NULL COMMENT '操作时间',
  `youip` varchar(50) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `check_reg`
--

INSERT INTO `check_reg` (`id`, `locks`, `checkcode`, `content`, `begtime`, `youip`) VALUES
(1, 0, '420f952e71662f5ee5d06b2ab6dc41de', '&123@321.lc&e10adc3949ba59abbe56e057f20f883e&e10adc3949ba59abbe56e057f20f883e&中华人民共和国&undefined&注册用户&注册用户&370280000910000&843367003&13777777777&未设置&64370&&116.27.17.83&1&1578804121', 1529759140, '116.27.17.83'),
(2, 0, '95b9ede1b0a63d1f13eba4e4f788475a', '&123@321.lc&e10adc3949ba59abbe56e057f20f883e&e10adc3949ba59abbe56e057f20f883e&中华人民共和国&undefined&注册用户&注册用户&370280000910000&843367003&13777777777&未设置&64370&&116.27.17.83&1&1578804227', 1529759140, '116.27.17.83'),
(3, 0, '2b38a0b791ddab6a8077f04888b50f49', '&1652082816@qq.com&e10adc3949ba59abbe56e057f20f883e&e10adc3949ba59abbe56e057f20f883e&中华人民共和国&undefined&注册用户&注册用户&370280000910000&1652082816&13777777777&未设置&64370&&116.27.17.83&1&1578804877', 1529759140, '116.27.17.83'),
(4, 1, '8c8107aba3dd6910190ce048a0664f51', '&1652082816@qq.com&dc483e80a7a0bd9ef71d8cf973673924&e10adc3949ba59abbe56e057f20f883e&中华人民共和国&undefined&注册用户&注册用户&370280000910000&1652082816&13777777777&未设置&64370&&116.27.17.83&1&1578805398', 1529759140, '116.27.17.83');

-- --------------------------------------------------------

--
-- 表的结构 `cloud_key`
--

CREATE TABLE IF NOT EXISTS `cloud_key` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL COMMENT '商品ID',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `begtime` int(11) DEFAULT NULL COMMENT '时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `codepay_order`
--

CREATE TABLE IF NOT EXISTS `codepay_order` (
  `id` int(11) unsigned NOT NULL,
  `pay_id` varchar(50) NOT NULL COMMENT '用户ID或订单ID',
  `money` decimal(6,2) unsigned NOT NULL COMMENT '实际金额',
  `price` decimal(6,2) unsigned NOT NULL COMMENT '原价',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '支付方式',
  `pay_no` varchar(100) NOT NULL COMMENT '流水号',
  `param` varchar(200) DEFAULT NULL COMMENT '自定义参数',
  `pay_time` bigint(11) NOT NULL DEFAULT '0' COMMENT '付款时间',
  `pay_tag` varchar(100) NOT NULL DEFAULT '0' COMMENT '金额的备注',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '订单状态',
  `creat_time` bigint(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `up_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用于区分是否已经处理';

-- --------------------------------------------------------

--
-- 表的结构 `codepay_user`
--

CREATE TABLE IF NOT EXISTS `codepay_user` (
  `id` int(10) NOT NULL COMMENT '用户ID',
  `user` varchar(100) NOT NULL DEFAULT '' COMMENT '用户名',
  `money` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `vip` int(1) NOT NULL DEFAULT '0' COMMENT '会员开通',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '会员状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `commission_record`
--

CREATE TABLE IF NOT EXISTS `commission_record` (
  `id` int(11) NOT NULL,
  `orderid` varchar(255) DEFAULT NULL COMMENT '订单号',
  `title` varchar(255) DEFAULT NULL COMMENT '购买商品',
  `nums` int(10) NOT NULL COMMENT '购买数量',
  `price1` float(12,3) DEFAULT '0.000' COMMENT '下级单价',
  `customers1` int(11) DEFAULT NULL COMMENT '下级会员',
  `price2` float(12,3) DEFAULT '0.000' COMMENT '上级单价',
  `customers2` int(11) DEFAULT NULL COMMENT '上级会员',
  `begtime` int(11) NOT NULL COMMENT '时间：秒'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `complaints_feedback`
--

CREATE TABLE IF NOT EXISTS `complaints_feedback` (
  `id` int(11) NOT NULL,
  `clouds` int(1) NOT NULL DEFAULT '0' COMMENT '是否云端',
  `docking` int(11) NOT NULL DEFAULT '0' COMMENT '对接平台',
  `sid` int(11) NOT NULL DEFAULT '0',
  `number` int(11) DEFAULT NULL COMMENT '会员编号',
  `username` int(11) DEFAULT NULL COMMENT '卖家编号',
  `type` varchar(50) DEFAULT NULL COMMENT '投诉类型',
  `title` varchar(255) DEFAULT NULL COMMENT '投诉主题',
  `orerno` varchar(255) DEFAULT NULL COMMENT '订单号',
  `content` text COMMENT '历次提交时间与内容',
  `reply` text COMMENT '历次回复时间与内容',
  `audit` int(2) NOT NULL DEFAULT '0' COMMENT '审核',
  `time` int(11) NOT NULL,
  `begtime` int(11) DEFAULT NULL COMMENT '时间：秒',
  `locks` int(1) DEFAULT '0' COMMENT '违规处罚'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `data_cloud`
--

CREATE TABLE IF NOT EXISTS `data_cloud` (
  `id` int(11) NOT NULL,
  `api` int(11) NOT NULL COMMENT '主站来源',
  `lock1` int(1) NOT NULL COMMENT '域名审核',
  `lock2` int(1) NOT NULL COMMENT '备案审核',
  `lock3` int(1) NOT NULL COMMENT '是否备案',
  `members` varchar(20) NOT NULL COMMENT '主站账户',
  `username` varchar(20) NOT NULL COMMENT '平台账户',
  `y1` varchar(120) NOT NULL COMMENT '域名',
  `y2` varchar(30) NOT NULL COMMENT '联系人',
  `y3` varchar(30) NOT NULL COMMENT '联系QQ',
  `y4` varchar(30) NOT NULL COMMENT '身份证号码',
  `y5` varchar(30) NOT NULL COMMENT '联系电话',
  `y6` varchar(100) NOT NULL COMMENT '联系地址',
  `content` text COMMENT '域名回复内容',
  `content1` text COMMENT '备案回复内容',
  `begtime` int(11) NOT NULL COMMENT '域名提交时间',
  `gettime` int(11) NOT NULL COMMENT '备案提交时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `delivery_charge`
--

CREATE TABLE IF NOT EXISTS `delivery_charge` (
  `id` int(11) NOT NULL,
  `price1` float(12,3) DEFAULT '0.000' COMMENT '1年收费',
  `price2` float(12,3) DEFAULT '0.000' COMMENT '3年收费',
  `price3` float(12,3) DEFAULT '0.000' COMMENT '5年收费',
  `price4` float(12,3) DEFAULT '0.000' COMMENT '永久收费'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `delivery_record`
--

CREATE TABLE IF NOT EXISTS `delivery_record` (
  `id` int(11) NOT NULL,
  `number` int(11) DEFAULT NULL COMMENT '会员编号',
  `proid` varchar(50) DEFAULT NULL COMMENT '栏目编号',
  `title` varchar(50) DEFAULT NULL COMMENT '店铺名称',
  `price` float(12,3) DEFAULT '0.000' COMMENT '收费价格',
  `time` int(11) NOT NULL COMMENT '提交时间',
  `begtime` int(11) NOT NULL COMMENT '时间：秒'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `details_funds`
--

CREATE TABLE IF NOT EXISTS `details_funds` (
  `id` int(11) NOT NULL,
  `orderid` varchar(100) DEFAULT NULL COMMENT '订单号',
  `title` varchar(100) DEFAULT NULL COMMENT '交易类型',
  `incomes` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '收入',
  `spendings` float(12,3) DEFAULT '0.000' COMMENT '支出',
  `befores` float(12,3) DEFAULT NULL COMMENT '资金变化前',
  `afters` float(12,3) DEFAULT NULL COMMENT '资金变化后',
  `number` int(11) DEFAULT NULL COMMENT '会员编号',
  `feilv` float(12,3) NOT NULL DEFAULT '0.000',
  `begtime` int(11) NOT NULL COMMENT '时间：秒'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `details_funds_back`
--

CREATE TABLE IF NOT EXISTS `details_funds_back` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `orderid` varchar(100) DEFAULT NULL COMMENT '订单号',
  `title` varchar(100) DEFAULT NULL COMMENT '交易类型',
  `incomes` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '收入',
  `spendings` float(12,3) DEFAULT '0.000' COMMENT '支出',
  `befores` float(12,3) DEFAULT NULL COMMENT '资金变化前',
  `afters` float(12,3) DEFAULT NULL COMMENT '资金变化后',
  `number` int(11) DEFAULT NULL COMMENT '会员编号',
  `feilv` float(12,3) NOT NULL DEFAULT '0.000',
  `begtime` int(11) NOT NULL COMMENT '时间：秒'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `diary`
--

CREATE TABLE IF NOT EXISTS `diary` (
  `id` int(11) NOT NULL,
  `type` int(2) NOT NULL DEFAULT '0' COMMENT '操作类型',
  `sid` int(11) NOT NULL DEFAULT '0' COMMENT '操作Id',
  `username` varchar(20) NOT NULL COMMENT '账户',
  `youip` varchar(30) NOT NULL,
  `content` text COMMENT '事件',
  `area` varchar(20) DEFAULT NULL COMMENT '地区',
  `begtime` int(11) NOT NULL COMMENT '从开始到现在的时间'
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `diary`
--

INSERT INTO `diary` (`id`, `type`, `sid`, `username`, `youip`, `content`, `area`, `begtime`) VALUES
(1, 6, 0, 'admin', '113.117.191.251', '修改了网站信息', '-', 1545308669),
(2, 0, 0, 'admin', '116.27.17.83', '鐧诲綍绯荤粺', '-', 0),
(3, 6, 0, 'admin', '116.27.17.83', '修改了网站信息', '-', 1578804026),
(4, 6, 0, 'admin', '116.27.17.83', '修改了系统邮箱的发送邮箱', '-', 0),
(5, 6, 0, 'admin', '116.27.17.83', '修改了系统邮箱的邮箱密码', '-', 0),
(6, 6, 0, 'admin', '116.27.17.83', '修改了系统qq1', '-', 0),
(7, 6, 0, 'admin', '116.27.17.83', '修改了系统邮箱的邮箱密码', '-', 0),
(8, 6, 0, 'admin', '116.27.17.83', '把商品目录 "<b>聚合社原创源码分享社区\r\n www.juheshe.cn</b>" 修改成了 "<b>PHP源码分享网-www.phpkm.cn</b>"', '-', 0),
(9, 6, 0, 'admin', '116.27.17.83', '修改了系统邮箱的邮箱密码', '-', 0),
(10, 6, 0, 'admin', '116.27.17.83', '把商品目录 "聚合社测试" 修改成了 "天赐传奇测试"', '-', 0),
(11, 6, 0, 'admin', '116.27.17.83', '把会员账户 "admin" 密码修改成"QQ843367003"', '-', 0),
(12, 6, 0, 'admin', '116.27.17.83', '把会员账户 "admin" 操作密码修改成"QQ843367003"', '-', 0),
(13, 6, 0, 'admin', '116.27.17.83', '修改了系统邮箱的SMTP服务', '-', 0),
(14, 6, 0, 'admin', '116.27.17.83', '修改了系统邮箱的发送邮箱', '-', 0),
(15, 6, 0, 'admin', '116.27.17.83', '修改了系统邮箱的邮箱密码', '-', 0);

-- --------------------------------------------------------

--
-- 表的结构 `docking_platform`
--

CREATE TABLE IF NOT EXISTS `docking_platform` (
  `id` int(11) NOT NULL,
  `uid` varchar(32) NOT NULL COMMENT '平台域名',
  `keykey` varchar(32) NOT NULL COMMENT '对接密钥',
  `mydatabase` varchar(32) NOT NULL COMMENT '对接数据',
  `username` int(11) NOT NULL COMMENT '平台编号',
  `begtime` int(11) NOT NULL COMMENT '对接时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `encrypted_card`
--

CREATE TABLE IF NOT EXISTS `encrypted_card` (
  `id` int(11) NOT NULL,
  `username` int(11) NOT NULL COMMENT '账户',
  `url` varchar(255) NOT NULL COMMENT '密保卡路径',
  `A1` varchar(4) DEFAULT NULL,
  `B1` varchar(4) DEFAULT NULL,
  `C1` varchar(4) DEFAULT NULL,
  `D1` varchar(4) DEFAULT NULL,
  `E1` varchar(4) DEFAULT NULL,
  `F1` varchar(4) DEFAULT NULL,
  `G1` varchar(4) DEFAULT NULL,
  `H1` varchar(4) DEFAULT NULL,
  `I1` varchar(4) DEFAULT NULL,
  `J1` varchar(4) DEFAULT NULL,
  `A2` varchar(4) DEFAULT NULL,
  `B2` varchar(4) DEFAULT NULL,
  `C2` varchar(4) DEFAULT NULL,
  `D2` varchar(4) DEFAULT NULL,
  `E2` varchar(4) DEFAULT NULL,
  `F2` varchar(4) DEFAULT NULL,
  `G2` varchar(4) DEFAULT NULL,
  `H2` varchar(4) DEFAULT NULL,
  `I2` varchar(4) DEFAULT NULL,
  `J2` varchar(4) DEFAULT NULL,
  `A3` varchar(4) DEFAULT NULL,
  `B3` varchar(4) DEFAULT NULL,
  `C3` varchar(4) DEFAULT NULL,
  `D3` varchar(4) DEFAULT NULL,
  `E3` varchar(4) DEFAULT NULL,
  `F3` varchar(4) DEFAULT NULL,
  `G3` varchar(4) DEFAULT NULL,
  `H3` varchar(4) DEFAULT NULL,
  `I3` varchar(4) DEFAULT NULL,
  `J3` varchar(4) DEFAULT NULL,
  `A4` varchar(4) DEFAULT NULL,
  `B4` varchar(4) DEFAULT NULL,
  `C4` varchar(4) DEFAULT NULL,
  `D4` varchar(4) DEFAULT NULL,
  `E4` varchar(4) DEFAULT NULL,
  `F4` varchar(4) DEFAULT NULL,
  `G4` varchar(4) DEFAULT NULL,
  `H4` varchar(4) DEFAULT NULL,
  `I4` varchar(4) DEFAULT NULL,
  `J4` varchar(4) DEFAULT NULL,
  `A5` varchar(4) DEFAULT NULL,
  `B5` varchar(4) DEFAULT NULL,
  `C5` varchar(4) DEFAULT NULL,
  `D5` varchar(4) DEFAULT NULL,
  `E5` varchar(4) DEFAULT NULL,
  `F5` varchar(4) DEFAULT NULL,
  `G5` varchar(4) DEFAULT NULL,
  `H5` varchar(4) DEFAULT NULL,
  `I5` varchar(4) DEFAULT NULL,
  `J5` varchar(4) DEFAULT NULL,
  `A6` varchar(4) DEFAULT NULL,
  `B6` varchar(4) DEFAULT NULL,
  `C6` varchar(4) DEFAULT NULL,
  `D6` varchar(4) DEFAULT NULL,
  `E6` varchar(4) DEFAULT NULL,
  `F6` varchar(4) DEFAULT NULL,
  `G6` varchar(4) DEFAULT NULL,
  `H6` varchar(4) DEFAULT NULL,
  `I6` varchar(4) DEFAULT NULL,
  `J6` varchar(4) DEFAULT NULL,
  `A7` varchar(4) DEFAULT NULL,
  `B7` varchar(4) DEFAULT NULL,
  `C7` varchar(4) DEFAULT NULL,
  `D7` varchar(4) DEFAULT NULL,
  `E7` varchar(4) DEFAULT NULL,
  `F7` varchar(4) DEFAULT NULL,
  `G7` varchar(4) DEFAULT NULL,
  `H7` varchar(4) DEFAULT NULL,
  `I7` varchar(4) DEFAULT NULL,
  `J7` varchar(4) DEFAULT NULL,
  `A8` varchar(4) DEFAULT NULL,
  `B8` varchar(4) DEFAULT NULL,
  `C8` varchar(4) DEFAULT NULL,
  `D8` varchar(4) DEFAULT NULL,
  `E8` varchar(4) DEFAULT NULL,
  `F8` varchar(4) DEFAULT NULL,
  `G8` varchar(4) DEFAULT NULL,
  `H8` varchar(4) DEFAULT NULL,
  `I8` varchar(4) DEFAULT NULL,
  `J8` varchar(4) DEFAULT NULL,
  `time` datetime NOT NULL COMMENT '操作时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `encrypted_problem`
--

CREATE TABLE IF NOT EXISTS `encrypted_problem` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL COMMENT '账户',
  `members` int(11) NOT NULL,
  `question1` varchar(100) NOT NULL COMMENT '密保问题一',
  `answer1` varchar(100) NOT NULL COMMENT '密保答案一',
  `question2` varchar(100) NOT NULL COMMENT '密保问题二',
  `answer2` varchar(100) NOT NULL COMMENT '密保答案一',
  `time` int(11) NOT NULL COMMENT '操作时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `fast_reply`
--

CREATE TABLE IF NOT EXISTS `fast_reply` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL COMMENT '所属栏目',
  `content` text COMMENT '提交内容',
  `begtime` int(11) NOT NULL COMMENT '时间：秒',
  `username` int(11) DEFAULT NULL COMMENT '所属会员'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `flagship_shops`
--

CREATE TABLE IF NOT EXISTS `flagship_shops` (
  `id` int(11) NOT NULL,
  `uid` varchar(30) NOT NULL COMMENT '上级目录',
  `mid` varchar(30) NOT NULL COMMENT '店铺目录',
  `username` varchar(50) NOT NULL COMMENT '会员编号',
  `price` float(12,3) NOT NULL COMMENT '供货押金',
  `begtime` int(11) NOT NULL COMMENT '开通时间',
  `overday` int(11) NOT NULL COMMENT '到期时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `games_books`
--

CREATE TABLE IF NOT EXISTS `games_books` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `content` text COMMENT '事件描述',
  `username` varchar(20) DEFAULT NULL COMMENT '账户',
  `time` datetime NOT NULL COMMENT '操作时间',
  `begtime` int(11) NOT NULL COMMENT '从开始到现在的时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `game_code`
--

CREATE TABLE IF NOT EXISTS `game_code` (
  `id` int(50) NOT NULL,
  `title` varchar(50) DEFAULT NULL COMMENT '标题',
  `pic` varchar(255) DEFAULT NULL COMMENT '图片',
  `BigClassName` int(20) DEFAULT NULL COMMENT '栏目',
  `SmallClassName` int(20) DEFAULT NULL COMMENT '子栏目',
  `zimu` varchar(10) DEFAULT NULL COMMENT '字母',
  `hot` int(2) DEFAULT NULL COMMENT '是否热门',
  `hots` int(2) DEFAULT NULL COMMENT '热门礼包',
  `content` text COMMENT '事件描述',
  `username` varchar(20) DEFAULT NULL COMMENT '账户',
  `time` datetime NOT NULL COMMENT '操作时间',
  `begtime` int(11) NOT NULL COMMENT '从开始到现在的时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `game_code_class`
--

CREATE TABLE IF NOT EXISTS `game_code_class` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL COMMENT '类别名称',
  `hot` int(2) DEFAULT NULL COMMENT '是否显示',
  `agent` varchar(50) DEFAULT NULL COMMENT '上级',
  `time` datetime NOT NULL COMMENT '操作时间',
  `begtime` int(11) NOT NULL COMMENT '从开始到现在的时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `game_code_list`
--

CREATE TABLE IF NOT EXISTS `game_code_list` (
  `id` int(11) NOT NULL,
  `sid` int(20) DEFAULT NULL COMMENT '对应游戏',
  `type` int(2) DEFAULT NULL COMMENT '是否激活',
  `title` varchar(80) DEFAULT NULL COMMENT '激活码',
  `time` datetime NOT NULL COMMENT '操作时间',
  `begtime` int(11) NOT NULL COMMENT '具体时间',
  `username` varchar(50) DEFAULT NULL COMMENT '激活账户',
  `time1` datetime DEFAULT NULL COMMENT '操作时间',
  `begtime1` int(11) DEFAULT NULL COMMENT '具体时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `goods_change`
--

CREATE TABLE IF NOT EXISTS `goods_change` (
  `id` int(11) NOT NULL,
  `title` varchar(120) DEFAULT NULL COMMENT '商品名称',
  `uid` int(11) NOT NULL COMMENT '商品Id',
  `locks` int(1) NOT NULL COMMENT '操作状态'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `goods_details`
--

CREATE TABLE IF NOT EXISTS `goods_details` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL COMMENT '货款明细',
  `orderid` varchar(255) DEFAULT NULL COMMENT '订单号',
  `incomes` float(12,3) DEFAULT '0.000' COMMENT '收入',
  `spendings` float(12,3) DEFAULT '0.000' COMMENT '支出',
  `befores` float(12,3) DEFAULT '0.000' COMMENT '资金变化前',
  `afters` float(12,3) DEFAULT '0.000' COMMENT '资金变化后',
  `number` int(11) DEFAULT NULL COMMENT '会员编号',
  `begtime` int(11) NOT NULL COMMENT '时间：秒',
  `feilv` float(12,3) DEFAULT NULL COMMENT '商品税收',
  `gongyi` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '公益'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `goods_report`
--

CREATE TABLE IF NOT EXISTS `goods_report` (
  `id` int(11) NOT NULL,
  `proid` int(3) DEFAULT NULL COMMENT '商品ID',
  `online` int(3) DEFAULT NULL COMMENT '是否处理',
  `type` varchar(100) DEFAULT NULL COMMENT '举报类型',
  `pic` varchar(255) DEFAULT NULL COMMENT '上传截图',
  `number` varchar(50) DEFAULT NULL COMMENT '会员编号',
  `username` varchar(50) DEFAULT NULL COMMENT '供货商',
  `content` text COMMENT '提交内容',
  `begtime` int(11) NOT NULL COMMENT '时间：秒',
  `sjcw` int(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `goods_yuer`
--

CREATE TABLE IF NOT EXISTS `goods_yuer` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL COMMENT '货款明细',
  `price` float(12,3) DEFAULT NULL COMMENT '转出金额',
  `number` varchar(50) DEFAULT NULL COMMENT '会员编号',
  `online` int(1) DEFAULT '0' COMMENT '处理状态',
  `begtime` int(11) NOT NULL COMMENT '时间：秒'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `import_goods`
--

CREATE TABLE IF NOT EXISTS `import_goods` (
  `id` int(11) NOT NULL,
  `locks` int(1) NOT NULL COMMENT '锁定',
  `pid` int(11) NOT NULL COMMENT '商品ID',
  `orderid` varchar(50) NOT NULL COMMENT '订单编号',
  `card` varchar(500) NOT NULL COMMENT '卡号',
  `password` varchar(10000) NOT NULL COMMENT '密码',
  `time` int(11) DEFAULT NULL COMMENT '时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `level`
--

CREATE TABLE IF NOT EXISTS `level` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL COMMENT '级别名称',
  `type` varchar(60) NOT NULL COMMENT '级别类型',
  `price` float(12,3) NOT NULL COMMENT '升级价格',
  `time` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `level`
--

INSERT INTO `level` (`id`, `title`, `type`, `price`, `time`) VALUES
(1, '注册用户', '经销体系', 0.000, 0);

-- --------------------------------------------------------

--
-- 表的结构 `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL,
  `wg_rds1` int(5) NOT NULL DEFAULT '0' COMMENT '买家违规次数',
  `wg_rds2` int(5) NOT NULL DEFAULT '0' COMMENT '卖家违规次数',
  `level` int(2) NOT NULL DEFAULT '1' COMMENT '等级',
  `logins` int(11) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `firsts` int(1) NOT NULL DEFAULT '0' COMMENT '第一次登录',
  `locks` int(1) NOT NULL DEFAULT '0' COMMENT '锁定',
  `integral` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `agent` varchar(11) DEFAULT NULL COMMENT '代理',
  `number` int(11) NOT NULL COMMENT '编号',
  `username` varchar(50) NOT NULL COMMENT '会员',
  `password` varchar(32) NOT NULL COMMENT '登录密码',
  `passwords` varchar(32) NOT NULL COMMENT '交易密码',
  `company` varchar(32) DEFAULT NULL COMMENT '公司名称',
  `rname` varchar(10) DEFAULT NULL COMMENT '真实姓名',
  `card` varchar(20) DEFAULT NULL COMMENT '身份证号码',
  `qq` varchar(12) DEFAULT NULL COMMENT 'qq',
  `email` varchar(50) DEFAULT NULL COMMENT '邮件',
  `phone` varchar(14) DEFAULT NULL COMMENT '手机',
  `address` varchar(50) DEFAULT NULL COMMENT '联系地址',
  `kuan` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '金额',
  `goods_kuan` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '供货款',
  `zong_kuan` float(12,3) NOT NULL DEFAULT '0.000',
  `frozen_kuan` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '冻结款',
  `max_amount` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '标准金额',
  `min_amount` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '最低金额',
  `site_credit` int(11) NOT NULL DEFAULT '0',
  `praise1` int(11) NOT NULL DEFAULT '0',
  `praise2` int(11) NOT NULL DEFAULT '0',
  `praise3` int(11) NOT NULL DEFAULT '0',
  `praise4` int(11) NOT NULL DEFAULT '0',
  `praise5` int(11) NOT NULL DEFAULT '0',
  `praise6` int(11) NOT NULL DEFAULT '0',
  `bad_grades` int(11) NOT NULL DEFAULT '0',
  `bad_grades1` int(11) NOT NULL DEFAULT '0' COMMENT '买家违规',
  `ban_reason` varchar(50) DEFAULT NULL COMMENT '禁止原因',
  `overdue` int(3) DEFAULT NULL COMMENT '冻结小时',
  `freeze_time` int(11) DEFAULT NULL COMMENT '冻结时间',
  `begtime` int(11) NOT NULL COMMENT '时间',
  `power1` int(1) NOT NULL DEFAULT '0' COMMENT 'IP绑定',
  `power2` int(1) NOT NULL DEFAULT '0' COMMENT '密保卡',
  `power3` int(1) NOT NULL DEFAULT '0' COMMENT '页面登录',
  `power4` int(1) NOT NULL DEFAULT '0' COMMENT '搜云令',
  `power5` int(1) NOT NULL DEFAULT '0' COMMENT '供货权限',
  `power6` int(1) NOT NULL DEFAULT '0' COMMENT '货款转余额',
  `power7` int(1) NOT NULL DEFAULT '0' COMMENT '加款卡权限',
  `power8` int(1) NOT NULL DEFAULT '0' COMMENT '手机令牌',
  `power9` int(1) NOT NULL DEFAULT '1' COMMENT '交易密码',
  `power10` int(1) NOT NULL DEFAULT '0' COMMENT '手机验证码',
  `power11` int(1) NOT NULL DEFAULT '0' COMMENT '真实手机验证',
  `power12` int(1) NOT NULL DEFAULT '0' COMMENT '真实邮箱验证',
  `power13` int(1) NOT NULL DEFAULT '0' COMMENT '平台对接接口',
  `power14` int(1) NOT NULL DEFAULT '0' COMMENT '淘宝网充值接口',
  `power15` int(1) NOT NULL DEFAULT '0' COMMENT '5173平台充值接口',
  `power16` int(1) NOT NULL DEFAULT '0' COMMENT '分站用户',
  `power17` int(1) NOT NULL DEFAULT '0' COMMENT '分站站长',
  `province` varchar(20) DEFAULT NULL COMMENT '省份',
  `city` varchar(20) DEFAULT NULL COMMENT '城市',
  `sign_in` int(11) NOT NULL DEFAULT '0' COMMENT '签到积分',
  `xlevel` int(11) NOT NULL DEFAULT '0' COMMENT '下级会员',
  `wing` int(11) NOT NULL DEFAULT '0' COMMENT '元宝',
  `time` int(11) DEFAULT NULL COMMENT '注册时间',
  `lost_time` int(11) DEFAULT NULL COMMENT '最后登陆时间',
  `log_time` int(11) DEFAULT NULL COMMENT '上次登陆时间',
  `lost_ip` varchar(20) DEFAULT NULL COMMENT '最后登录IP',
  `log_ip` varchar(20) DEFAULT NULL COMMENT '上次登录IP',
  `lost_dz` varchar(20) DEFAULT NULL COMMENT '最后登录地址',
  `log_dz` varchar(20) DEFAULT NULL COMMENT '上次登录地址',
  `card_pic` varchar(120) NOT NULL COMMENT '身份证',
  `card_lock` int(1) NOT NULL DEFAULT '0' COMMENT '身份证核实',
  `zongren` varchar(32) NOT NULL COMMENT '众人通道码',
  `Api_qq` varchar(60) DEFAULT NULL COMMENT 'QQ登录',
  `error` int(1) NOT NULL DEFAULT '0' COMMENT '密码错误',
  `erdu1` int(10) NOT NULL DEFAULT '2' COMMENT '店铺分类额度',
  `DocApi1` varchar(32) NOT NULL COMMENT '平台对接API'
) ENGINE=MyISAM AUTO_INCREMENT=2374 DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `members`
--

INSERT INTO `members` (`id`, `wg_rds1`, `wg_rds2`, `level`, `logins`, `firsts`, `locks`, `integral`, `agent`, `number`, `username`, `password`, `passwords`, `company`, `rname`, `card`, `qq`, `email`, `phone`, `address`, `kuan`, `goods_kuan`, `zong_kuan`, `frozen_kuan`, `max_amount`, `min_amount`, `site_credit`, `praise1`, `praise2`, `praise3`, `praise4`, `praise5`, `praise6`, `bad_grades`, `bad_grades1`, `ban_reason`, `overdue`, `freeze_time`, `begtime`, `power1`, `power2`, `power3`, `power4`, `power5`, `power6`, `power7`, `power8`, `power9`, `power10`, `power11`, `power12`, `power13`, `power14`, `power15`, `power16`, `power17`, `province`, `city`, `sign_in`, `xlevel`, `wing`, `time`, `lost_time`, `log_time`, `lost_ip`, `log_ip`, `lost_dz`, `log_dz`, `card_pic`, `card_lock`, `zongren`, `Api_qq`, `error`, `erdu1`, `DocApi1`) VALUES
(2373, 0, 0, 1, 0, 0, 0, 0, '64370', 64373, 'php52@qq.com', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '注册用户', '注册用户', '370280000910000', '123456', 'php52@qq.com', '13777777777', '未设置', 0.000, 0.000, 0.000, 0.000, 0.000, 0.000, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1545276255, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '中华人民共和国', 'undefined', 0, 0, 0, 1545276255, 0, 1545276255, '116.27.17.83', '113.117.191.251', '', '', '', 0, '', NULL, 0, 2, '');

-- --------------------------------------------------------

--
-- 表的结构 `members_back`
--

CREATE TABLE IF NOT EXISTS `members_back` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '0',
  `wg_rds1` int(5) NOT NULL DEFAULT '0' COMMENT '买家违规次数',
  `wg_rds2` int(5) NOT NULL DEFAULT '0' COMMENT '卖家违规次数',
  `level` int(2) NOT NULL DEFAULT '1' COMMENT '等级',
  `logins` int(11) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `firsts` int(1) NOT NULL DEFAULT '1' COMMENT '第一次登录',
  `locks` int(1) NOT NULL DEFAULT '0' COMMENT '锁定',
  `integral` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `agent` int(11) DEFAULT '0' COMMENT '代理',
  `number` int(11) NOT NULL COMMENT '编号',
  `username` varchar(20) NOT NULL COMMENT '会员',
  `password` varchar(32) NOT NULL COMMENT '登录密码',
  `passwords` varchar(32) NOT NULL COMMENT '交易密码',
  `company` varchar(32) DEFAULT NULL COMMENT '公司名称',
  `rname` varchar(10) DEFAULT NULL COMMENT '真实姓名',
  `card` varchar(10) DEFAULT NULL COMMENT '身份证号码',
  `qq` varchar(10) DEFAULT NULL COMMENT 'qq',
  `email` varchar(40) DEFAULT NULL COMMENT '邮件',
  `phone` int(11) DEFAULT NULL COMMENT '手机',
  `address` varchar(20) DEFAULT NULL COMMENT '联系地址',
  `kuan` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '金额',
  `goods_kuan` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '供货款',
  `zong_kuan` float(12,3) NOT NULL DEFAULT '0.000',
  `frozen_kuan` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '冻结款',
  `max_amount` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '标准金额',
  `min_amount` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '最低金额',
  `site_credit` int(11) NOT NULL DEFAULT '0',
  `praise1` int(11) NOT NULL DEFAULT '0',
  `praise2` int(11) NOT NULL DEFAULT '0',
  `praise3` int(11) NOT NULL DEFAULT '0',
  `praise4` int(11) NOT NULL DEFAULT '0',
  `praise5` int(11) NOT NULL DEFAULT '0',
  `praise6` int(11) NOT NULL DEFAULT '0',
  `bad_grades` int(11) NOT NULL DEFAULT '0',
  `bad_grades1` int(11) NOT NULL DEFAULT '0' COMMENT '买家违规',
  `ban_reason` varchar(50) DEFAULT NULL COMMENT '禁止原因',
  `overdue` int(3) DEFAULT NULL COMMENT '冻结小时',
  `freeze_time` int(11) DEFAULT NULL COMMENT '冻结时间',
  `begtime` int(11) NOT NULL COMMENT '时间',
  `power1` int(1) NOT NULL DEFAULT '0' COMMENT 'IP绑定',
  `power2` int(1) NOT NULL DEFAULT '0' COMMENT '密保卡',
  `power3` int(1) NOT NULL DEFAULT '0' COMMENT '页面登录',
  `power4` int(1) NOT NULL DEFAULT '0' COMMENT '搜云令',
  `power5` int(1) NOT NULL DEFAULT '0' COMMENT '供货权限',
  `power6` int(1) NOT NULL DEFAULT '0' COMMENT '货款转余额',
  `power7` int(1) NOT NULL DEFAULT '0' COMMENT '加款卡权限',
  `power8` int(1) NOT NULL DEFAULT '0' COMMENT '手机令牌',
  `power9` int(1) NOT NULL DEFAULT '1' COMMENT '交易密码',
  `power10` int(1) NOT NULL DEFAULT '0' COMMENT '手机验证码',
  `power11` int(1) NOT NULL DEFAULT '0' COMMENT '真实手机验证',
  `power12` int(1) NOT NULL DEFAULT '0' COMMENT '真实邮箱验证',
  `power13` int(1) NOT NULL DEFAULT '0' COMMENT '平台对接接口',
  `power14` int(1) NOT NULL DEFAULT '0' COMMENT '淘宝网充值接口',
  `power15` int(1) NOT NULL DEFAULT '0' COMMENT '5173平台充值接口',
  `province` varchar(20) DEFAULT NULL COMMENT '省份',
  `city` varchar(20) DEFAULT NULL COMMENT '城市',
  `sign_in` int(11) NOT NULL DEFAULT '0' COMMENT '签到积分',
  `xlevel` int(11) NOT NULL DEFAULT '0' COMMENT '下级会员',
  `wing` int(11) NOT NULL DEFAULT '0' COMMENT '元宝',
  `time` int(11) DEFAULT NULL COMMENT '注册时间',
  `lost_time` int(11) DEFAULT NULL COMMENT '最后登陆时间',
  `log_time` int(11) DEFAULT NULL COMMENT '上次登陆时间',
  `lost_ip` varchar(20) DEFAULT NULL COMMENT '最后登录IP',
  `log_ip` varchar(20) DEFAULT NULL COMMENT '上次登录IP',
  `lost_dz` varchar(20) DEFAULT NULL COMMENT '最后登录地址',
  `log_dz` varchar(20) DEFAULT NULL COMMENT '上次登录地址',
  `card_pic` varchar(120) NOT NULL COMMENT '身份证',
  `card_lock` int(1) NOT NULL DEFAULT '0' COMMENT '身份证核实',
  `zongren` varchar(32) NOT NULL COMMENT '众人通道码',
  `Api_qq` varchar(60) DEFAULT NULL COMMENT 'QQ登录',
  `error` int(1) NOT NULL DEFAULT '0' COMMENT '密码错误',
  `erdu1` int(10) NOT NULL DEFAULT '2' COMMENT '店铺分类额度',
  `DocApi1` varchar(32) DEFAULT NULL COMMENT '平台对接API'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `money_order`
--

CREATE TABLE IF NOT EXISTS `money_order` (
  `id` int(11) NOT NULL,
  `bank_type` varchar(50) DEFAULT NULL COMMENT '汇款银行',
  `kuan` float(12,3) DEFAULT NULL COMMENT '汇款金额',
  `htime` varchar(50) DEFAULT NULL COMMENT '汇款时间',
  `content` varchar(255) DEFAULT NULL COMMENT '汇款备注',
  `number` int(11) DEFAULT NULL COMMENT '汇款编号',
  `begtime` int(11) NOT NULL COMMENT '时间：秒',
  `state` int(1) DEFAULT '0' COMMENT '汇款状态'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `my_email`
--

CREATE TABLE IF NOT EXISTS `my_email` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL COMMENT '账户',
  `email` varchar(100) NOT NULL COMMENT '邮箱地址',
  `time` int(11) NOT NULL COMMENT '操作时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `my_phone`
--

CREATE TABLE IF NOT EXISTS `my_phone` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL COMMENT '账户',
  `phone` varchar(15) NOT NULL COMMENT '手机号码',
  `time` int(11) NOT NULL COMMENT '操作时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `one_cartoon`
--

CREATE TABLE IF NOT EXISTS `one_cartoon` (
  `id` int(11) NOT NULL,
  `price` float(12,3) DEFAULT NULL COMMENT '金额',
  `account` varchar(50) DEFAULT NULL COMMENT '卡号',
  `password` varchar(50) DEFAULT NULL COMMENT '密码',
  `username` int(11) DEFAULT NULL COMMENT '使用者',
  `time` int(11) NOT NULL COMMENT '开卡时间',
  `begtime` int(11) DEFAULT NULL COMMENT '使用时间',
  `states` int(1) DEFAULT '0' COMMENT '状态'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `password_lock`
--

CREATE TABLE IF NOT EXISTS `password_lock` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL COMMENT '会员',
  `yourip` varchar(20) NOT NULL COMMENT '绑定IP',
  `begtime` int(11) NOT NULL COMMENT '时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `pay_record`
--

CREATE TABLE IF NOT EXISTS `pay_record` (
  `id` int(11) NOT NULL,
  `orderno` varchar(255) DEFAULT NULL COMMENT '订单号',
  `title` varchar(50) DEFAULT NULL COMMENT '支付接口',
  `number` int(11) DEFAULT NULL COMMENT '会员编号',
  `price` float(12,3) DEFAULT NULL COMMENT '充值金额',
  `price1` float(12,3) DEFAULT NULL COMMENT '费率',
  `begtime` int(11) NOT NULL COMMENT '时间：秒',
  `online` int(1) NOT NULL DEFAULT '0' COMMENT '支付状态'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `popular_game`
--

CREATE TABLE IF NOT EXISTS `popular_game` (
  `id` int(11) NOT NULL,
  `title` varchar(120) NOT NULL COMMENT '标题',
  `address` varchar(255) DEFAULT NULL COMMENT '图片地址',
  `url` varchar(255) DEFAULT NULL COMMENT '链接地址',
  `content` text COMMENT '会员权限',
  `begtime` int(50) NOT NULL COMMENT '时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `price_modl`
--

CREATE TABLE IF NOT EXISTS `price_modl` (
  `id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL COMMENT '模板名称',
  `type` int(1) NOT NULL COMMENT '类型',
  `price` float NOT NULL COMMENT '增加值',
  `username` varchar(50) NOT NULL COMMENT '发布会员',
  `begtime` int(11) NOT NULL COMMENT '操作时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL,
  `docking` int(11) NOT NULL DEFAULT '0' COMMENT '对接平台',
  `sid` int(11) NOT NULL DEFAULT '0' COMMENT 'SUPid',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '平台对接',
  `pricing` int(1) NOT NULL DEFAULT '0' COMMENT '定价',
  `rate` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '买价',
  `locks` int(1) NOT NULL DEFAULT '0' COMMENT '锁定',
  `kucun` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `paixu` float NOT NULL DEFAULT '0' COMMENT '排序',
  `sales` int(11) NOT NULL DEFAULT '0' COMMENT '售出数量',
  `overdue` int(3) DEFAULT '0' COMMENT '过期时间',
  `title` varchar(500) NOT NULL COMMENT '标题',
  `color` varchar(10) DEFAULT NULL COMMENT '颜色',
  `directory1` varchar(30) NOT NULL COMMENT '顶级目录',
  `directory2` varchar(30) NOT NULL COMMENT '二级目录',
  `directory3` varchar(30) NOT NULL COMMENT '三级目录',
  `directory4` varchar(30) DEFAULT NULL COMMENT '对接原目录',
  `punit` varchar(10) DEFAULT NULL COMMENT '商品单位',
  `modl` varchar(10) NOT NULL COMMENT '绑定模板',
  `buy_md` int(11) NOT NULL COMMENT '购买模板',
  `price1` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '商品面值',
  `price2` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '商品售价',
  `url` varchar(50) DEFAULT NULL COMMENT '充值网址',
  `content` text COMMENT '商品简介',
  `focus` text COMMENT '注意事项',
  `service` varchar(100) DEFAULT NULL COMMENT '联系客服',
  `username` varchar(11) DEFAULT NULL COMMENT '商品来源',
  `reason` varchar(100) DEFAULT NULL COMMENT '禁止原因',
  `time` int(11) DEFAULT NULL COMMENT '时间',
  `provinces` varchar(10) DEFAULT NULL COMMENT '省份',
  `citys` varchar(10) DEFAULT NULL COMMENT '城市',
  `Api` varchar(10) DEFAULT NULL COMMENT 'Api来源',
  `Api_id` int(11) DEFAULT NULL COMMENT 'ApiId',
  `Api_buy_num` text COMMENT '购买数量',
  `Api_buy_type` int(3) DEFAULT NULL COMMENT '购买类型',
  `state` int(3) DEFAULT '0',
  `price` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '成本价格',
  `whys` varchar(20) DEFAULT NULL COMMENT '原因',
  `begtime` int(11) NOT NULL DEFAULT '0',
  `Store_class` int(11) NOT NULL DEFAULT '0' COMMENT '商品分类',
  `abc` varchar(4) DEFAULT NULL COMMENT '字母'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `product_back`
--

CREATE TABLE IF NOT EXISTS `product_back` (
  `id` int(11) NOT NULL,
  `docking` int(11) NOT NULL DEFAULT '0' COMMENT '对接平台',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '平台商品id',
  `pid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0' COMMENT 'SUPid',
  `pricing` int(1) NOT NULL DEFAULT '0' COMMENT '定价',
  `rate` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '买价',
  `locks` int(1) NOT NULL DEFAULT '0' COMMENT '锁定',
  `kucun` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `paixu` float NOT NULL DEFAULT '0' COMMENT '排序',
  `sales` int(11) NOT NULL DEFAULT '0' COMMENT '售出数量',
  `overdue` int(3) DEFAULT '0' COMMENT '过期时间',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `color` varchar(10) DEFAULT NULL COMMENT '颜色',
  `directory1` varchar(30) NOT NULL COMMENT '顶级目录',
  `directory2` varchar(30) NOT NULL COMMENT '二级目录',
  `directory3` varchar(30) NOT NULL COMMENT '三级目录',
  `directory4` varchar(30) DEFAULT NULL COMMENT '产品目录',
  `punit` varchar(10) DEFAULT NULL COMMENT '商品单位',
  `modl` varchar(10) NOT NULL COMMENT '绑定模板',
  `buy_md` int(11) NOT NULL COMMENT '购买模板',
  `price1` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '商品面值',
  `price2` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '商品售价',
  `url` varchar(50) DEFAULT NULL COMMENT '充值网址',
  `content` text COMMENT '商品简介',
  `focus` text COMMENT '注意事项',
  `service` varchar(100) DEFAULT NULL COMMENT '联系客服',
  `username` varchar(11) DEFAULT 'Null' COMMENT '商品来源',
  `reason` varchar(100) DEFAULT NULL COMMENT '禁止原因',
  `time` int(11) DEFAULT NULL COMMENT '时间',
  `provinces` varchar(10) DEFAULT NULL COMMENT '省份',
  `citys` varchar(10) DEFAULT NULL COMMENT '城市',
  `Api` varchar(10) DEFAULT NULL COMMENT 'Api来源',
  `Api_id` int(11) DEFAULT NULL COMMENT 'ApiId',
  `Api_buy_num` text COMMENT '购买数量',
  `Api_buy_type` int(3) DEFAULT NULL COMMENT '购买类型',
  `state` int(3) DEFAULT '0',
  `price` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '成本价格',
  `whys` varchar(20) DEFAULT NULL COMMENT '原因',
  `begtime` int(11) NOT NULL DEFAULT '0',
  `Store_class` int(11) NOT NULL DEFAULT '0' COMMENT '商品分类'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `product_class`
--

CREATE TABLE IF NOT EXISTS `product_class` (
  `id` int(11) NOT NULL,
  `hot` int(1) NOT NULL COMMENT '热门',
  `locks` int(1) NOT NULL COMMENT '锁定',
  `NumberID` varchar(30) NOT NULL COMMENT '编号',
  `RootID` varchar(30) NOT NULL COMMENT '上级',
  `PartID` varchar(30) NOT NULL COMMENT '下级',
  `LagID` int(1) NOT NULL COMMENT '层级',
  `class` varchar(200) NOT NULL COMMENT '名称',
  `number` varchar(30) DEFAULT NULL COMMENT '会员',
  `color` varchar(30) DEFAULT NULL COMMENT '颜色',
  `Store_icon` varchar(100) DEFAULT NULL COMMENT '店铺站标',
  `Store_title` varchar(100) DEFAULT NULL COMMENT '店铺名称',
  `feilv` int(3) DEFAULT NULL COMMENT '收费费率',
  `overdue` int(3) DEFAULT NULL COMMENT '过期时间',
  `overday` int(3) DEFAULT NULL COMMENT '过期时间',
  `isno1` int(1) NOT NULL DEFAULT '0' COMMENT 'QQ导购',
  `isno2` int(1) NOT NULL DEFAULT '0' COMMENT '申请供货',
  `isno4` int(1) NOT NULL DEFAULT '0' COMMENT '图标1',
  `isno5` int(1) NOT NULL DEFAULT '0' COMMENT '图标2',
  `isno6` int(1) NOT NULL DEFAULT '0' COMMENT '图标3',
  `isno7` int(1) NOT NULL DEFAULT '0' COMMENT '商家店铺',
  `isno8` int(1) NOT NULL DEFAULT '0' COMMENT '店铺Logo展示',
  `price` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '供货押金',
  `time` int(11) DEFAULT NULL COMMENT '时间',
  `begtime` int(11) NOT NULL DEFAULT '0',
  `Classorder` float DEFAULT NULL COMMENT '排序',
  `praise1` int(11) NOT NULL DEFAULT '0' COMMENT '好评',
  `praise2` int(11) NOT NULL DEFAULT '0' COMMENT '信誉',
  `isno3` int(1) NOT NULL DEFAULT '0' COMMENT '分站',
  `qicq` varchar(200) DEFAULT NULL COMMENT 'QQ客服',
  `shop_name` varchar(50) DEFAULT NULL,
  `abc` varchar(10) DEFAULT NULL COMMENT '字母',
  `note` varchar(255) DEFAULT NULL COMMENT '店铺备注',
  `zong` int(11) NOT NULL DEFAULT '0' COMMENT '销售总量'
) ENGINE=MyISAM AUTO_INCREMENT=317 DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `product_class`
--

INSERT INTO `product_class` (`id`, `hot`, `locks`, `NumberID`, `RootID`, `PartID`, `LagID`, `class`, `number`, `color`, `Store_icon`, `Store_title`, `feilv`, `overdue`, `overday`, `isno1`, `isno2`, `isno4`, `isno5`, `isno6`, `isno7`, `isno8`, `price`, `time`, `begtime`, `Classorder`, `praise1`, `praise2`, `isno3`, `qicq`, `shop_name`, `abc`, `note`, `zong`) VALUES
(1, 0, 0, 'H001', '0', '0', 0, 'PHP源码分享网目录', '', '#E53333', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.000, 0, 0, 1, 0, 0, 0, '', '', NULL, NULL, 0),
(3, 0, 0, 'H001001', 'H001', 'H001', 1, '<b>PHP源码分享网-www.phpkm.cn</b>', '', '#FF9900', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.000, 0, 0, 4, 0, 0, 0, '', '', NULL, NULL, 0),
(316, 0, 0, 'H001001001', 'H001', 'H001001', 2, '天赐传奇测试', '1', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.000, 0, 0, 1, 0, 0, 0, '', '', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `product_favorites`
--

CREATE TABLE IF NOT EXISTS `product_favorites` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL COMMENT '商品ID',
  `title` varchar(120) DEFAULT NULL COMMENT '商品标题',
  `number` varchar(50) NOT NULL COMMENT '收藏会员编号',
  `begtime` int(11) NOT NULL COMMENT '时间：秒'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `product_order`
--

CREATE TABLE IF NOT EXISTS `product_order` (
  `locks` int(11) NOT NULL DEFAULT '0' COMMENT '是否云端',
  `docking` int(11) NOT NULL DEFAULT '0' COMMENT '对接平台',
  `docid` int(11) NOT NULL DEFAULT '0' COMMENT '平台商品Id',
  `Api` varchar(10) DEFAULT NULL,
  `Api_id` varchar(11) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL COMMENT '标题',
  `orderid` varchar(30) NOT NULL COMMENT '订单编号',
  `pid` int(11) NOT NULL COMMENT '商品ID',
  `sid` int(11) NOT NULL DEFAULT '0',
  `buyaction` int(1) NOT NULL DEFAULT '0' COMMENT '购买动作',
  `trading` int(2) NOT NULL DEFAULT '0' COMMENT '交易类型',
  `refund` int(1) NOT NULL DEFAULT '0',
  `type` varchar(10) NOT NULL COMMENT '订单类型',
  `price` float(12,3) NOT NULL COMMENT '商品面值',
  `buyprice` float(12,3) NOT NULL COMMENT '购买价格',
  `nums` int(11) NOT NULL COMMENT '购买数量',
  `zongprice` float(12,3) NOT NULL COMMENT '总交易额',
  `zongas` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '抽成费用',
  `feilv` float(12,3) NOT NULL DEFAULT '0.000',
  `gongyi` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '公益费用',
  `txtcomment` text COMMENT '用户备注',
  `reply` text COMMENT '卖家回复',
  `custom1` varchar(50) DEFAULT NULL COMMENT '自定义标题1',
  `content1` varchar(50) DEFAULT NULL COMMENT '自定义内容1',
  `custom2` varchar(50) DEFAULT NULL COMMENT '自定义标题2',
  `content2` varchar(50) DEFAULT NULL COMMENT '自定义内容2',
  `custom3` varchar(50) DEFAULT NULL COMMENT '自定义标题3',
  `content3` varchar(50) DEFAULT NULL COMMENT '自定义内容3',
  `custom4` varchar(50) DEFAULT NULL COMMENT '自定义标题4',
  `content4` varchar(50) DEFAULT NULL COMMENT '自定义内容4',
  `custom5` varchar(50) DEFAULT NULL COMMENT '自定义标题5',
  `content5` varchar(50) DEFAULT NULL COMMENT '自定义内容5',
  `custom6` varchar(50) DEFAULT NULL COMMENT '自定义标题6',
  `content6` varchar(50) DEFAULT NULL COMMENT '自定义内容6',
  `custom7` varchar(50) DEFAULT NULL COMMENT '自定义标题7',
  `content7` varchar(50) DEFAULT NULL COMMENT '自定义内容7',
  `custom8` varchar(50) DEFAULT NULL COMMENT '自定义标题8',
  `content8` varchar(50) DEFAULT NULL COMMENT '自定义内容8',
  `sell_pl` int(1) NOT NULL DEFAULT '0' COMMENT '卖家评论',
  `buy_pl` int(1) NOT NULL DEFAULT '0' COMMENT '买家评论',
  `number` int(11) NOT NULL COMMENT '购买会员',
  `username` varchar(11) DEFAULT NULL COMMENT '供货会员',
  `network` varchar(50) NOT NULL COMMENT '买家网络',
  `youip` varchar(50) NOT NULL COMMENT '买家IP',
  `time` int(11) DEFAULT NULL COMMENT '购买时间',
  `begtime` int(11) DEFAULT NULL COMMENT '处理时间',
  `refundtime` int(11) DEFAULT NULL COMMENT '退款时间',
  `eeval` int(1) NOT NULL DEFAULT '0' COMMENT '重新修改评价',
  `url` varchar(100) DEFAULT NULL,
  `passwords` varchar(30) DEFAULT NULL,
  `overdue` int(3) NOT NULL DEFAULT '0' COMMENT '过期时间',
  `directory` varchar(20) DEFAULT NULL COMMENT '商品目录'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `punishment`
--

CREATE TABLE IF NOT EXISTS `punishment` (
  `id` int(11) NOT NULL,
  `wg_open` int(2) NOT NULL COMMENT '违规开关',
  `bwg_1` int(20) DEFAULT NULL COMMENT '买家商品纠纷',
  `bwg_2` int(20) DEFAULT NULL COMMENT '文明规范纠纷',
  `bwg_3` text COMMENT '关键词',
  `bwg_4` int(20) DEFAULT NULL COMMENT '买家上限分数',
  `bwg_5` int(20) DEFAULT NULL COMMENT '买家上限扣款',
  `bwg_6` int(20) DEFAULT NULL COMMENT '买家冻结账户',
  `mwg_1` int(20) DEFAULT NULL COMMENT '卖家商品纠纷',
  `mwg_2` int(20) DEFAULT NULL COMMENT '违规商品',
  `mwg_3` text COMMENT '违规商品关键词',
  `mwg_4` int(20) DEFAULT NULL COMMENT '72小时未退款扣分',
  `mwg_5` int(20) DEFAULT NULL COMMENT '虚假商品',
  `mwg_6` int(20) DEFAULT NULL COMMENT '误导性商品',
  `mwg_7` int(20) DEFAULT NULL COMMENT '违法商品',
  `mwg_8` int(20) DEFAULT NULL COMMENT '文明规范纠纷',
  `mwg_9` text COMMENT '关键词',
  `mwg_10` int(20) DEFAULT NULL COMMENT '卖家上限分数',
  `mwg_11` int(20) DEFAULT NULL COMMENT '卖家上限扣款',
  `mwg_12` int(20) DEFAULT NULL COMMENT '冻结卖家账户'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `punishment_list`
--

CREATE TABLE IF NOT EXISTS `punishment_list` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL COMMENT '主题',
  `number` varchar(50) DEFAULT NULL COMMENT '会员编号',
  `deduct` int(11) DEFAULT NULL COMMENT '扣除分数',
  `begtime` int(11) NOT NULL COMMENT '时间：秒'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `refund_event`
--

CREATE TABLE IF NOT EXISTS `refund_event` (
  `id` int(11) NOT NULL,
  `sid` varchar(40) NOT NULL COMMENT '订单编号',
  `type` int(2) NOT NULL COMMENT '退款类型',
  `title` varchar(24) NOT NULL COMMENT '退款主题',
  `content` text COMMENT '退款描述'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `reg_machine`
--

CREATE TABLE IF NOT EXISTS `reg_machine` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL COMMENT '验证标题',
  `info` varchar(50) NOT NULL COMMENT '验证内容',
  `begtime` int(11) NOT NULL COMMENT '操作时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `rem_account`
--

CREATE TABLE IF NOT EXISTS `rem_account` (
  `id` int(11) NOT NULL,
  `bank_type` varchar(50) DEFAULT NULL COMMENT '银行类型',
  `bankaccount` varchar(50) DEFAULT NULL COMMENT '银行账户',
  `accountname` varchar(50) DEFAULT NULL COMMENT '持卡人姓名',
  `bankcity` varchar(50) DEFAULT NULL COMMENT '开户地区',
  `time` int(11) NOT NULL DEFAULT '0' COMMENT '提交时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `send_email`
--

CREATE TABLE IF NOT EXISTS `send_email` (
  `id` int(11) NOT NULL,
  `username` int(11) NOT NULL COMMENT '会员编号',
  `email` varchar(50) NOT NULL COMMENT '邮箱地址',
  `title` varchar(50) NOT NULL COMMENT '发送标题',
  `content` text COMMENT '内容',
  `begtime` int(11) NOT NULL COMMENT '操作时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `shops_favorites`
--

CREATE TABLE IF NOT EXISTS `shops_favorites` (
  `id` int(11) NOT NULL,
  `uid` varchar(30) NOT NULL COMMENT '店铺编号',
  `username` varchar(50) NOT NULL COMMENT '收藏用户',
  `begtime` int(11) NOT NULL COMMENT '收藏时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `shuffling`
--

CREATE TABLE IF NOT EXISTS `shuffling` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `menu` varchar(255) DEFAULT NULL,
  `begtime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `sign_in`
--

CREATE TABLE IF NOT EXISTS `sign_in` (
  `id` int(11) NOT NULL,
  `number` int(11) DEFAULT NULL COMMENT '会员编号',
  `begtime` int(11) NOT NULL COMMENT '时间：秒'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `site_config`
--

CREATE TABLE IF NOT EXISTS `site_config` (
  `id` int(11) NOT NULL,
  `site_jump` int(1) NOT NULL DEFAULT '0' COMMENT '跳转',
  `site_reg` int(1) NOT NULL DEFAULT '1' COMMENT '注册开关',
  `site_leve` int(2) NOT NULL DEFAULT '1' COMMENT '注册等级',
  `site_agent` varchar(11) DEFAULT NULL COMMENT '默认上级',
  `moneytype` varchar(50) CHARACTER SET gb2312 NOT NULL COMMENT '货币',
  `site_as` int(1) NOT NULL DEFAULT '0' COMMENT '抽成级数',
  `site_template` varchar(20) NOT NULL DEFAULT '000' COMMENT '网站模版',
  `themecode` text NOT NULL COMMENT '模版代码',
  `themecolor` text CHARACTER SET gb2312 NOT NULL COMMENT '模板色系',
  `bluewhite1` varchar(999) NOT NULL COMMENT '响应式蓝色模版数据',
  `bluewhite2` varchar(999) NOT NULL COMMENT '响应式蓝色模版数据',
  `bluewhite4` varchar(999) CHARACTER SET gb2312 NOT NULL,
  `bluewhite5` varchar(999) NOT NULL,
  `bluewhite6` varchar(255) CHARACTER SET gb2312 NOT NULL,
  `bluewhite7` varchar(255) CHARACTER SET gb2312 NOT NULL,
  `bluewhite8` varchar(255) CHARACTER SET gb2312 NOT NULL,
  `bluewhite9` varchar(255) CHARACTER SET gb2312 NOT NULL,
  `bluewhite10` varchar(255) CHARACTER SET gb2312 NOT NULL,
  `bluewhite11` varchar(255) CHARACTER SET gb2312 NOT NULL,
  `bluewhite12` varchar(255) NOT NULL,
  `bluewhite13` varchar(255) CHARACTER SET gb2312 NOT NULL,
  `bluewhite14` varchar(255) NOT NULL,
  `bluewhite15` varchar(255) CHARACTER SET gb2312 NOT NULL,
  `bluewhite16` varchar(255) NOT NULL,
  `bluewhite17` varchar(255) NOT NULL,
  `bluewhite18` varchar(255) NOT NULL,
  `bluewhite19` varchar(255) NOT NULL,
  `bluewhite20` varchar(255) NOT NULL,
  `bluewhite21` varchar(255) NOT NULL,
  `bluewhite22` varchar(255) NOT NULL,
  `bluewhite23` varchar(255) NOT NULL,
  `bluewhite3` varchar(999) CHARACTER SET gb2312 NOT NULL COMMENT '响应式蓝色模版数据',
  `site_title` varchar(50) NOT NULL DEFAULT '网站标题' COMMENT '网站标题',
  `site_name` varchar(20) NOT NULL DEFAULT '网站名称' COMMENT '网站名称',
  `site_url` varchar(50) NOT NULL DEFAULT '#' COMMENT '网站网址',
  `wap_url` text NOT NULL COMMENT '手机站域名',
  `cardpay_url` text NOT NULL COMMENT '充值卡购买网址',
  `site_logo` varchar(255) DEFAULT NULL COMMENT '网站logo',
  `login_logo` varchar(100) DEFAULT NULL,
  `site_describe` varchar(500) DEFAULT NULL COMMENT '网站描述',
  `site_keywords` varchar(500) DEFAULT NULL COMMENT '网站关键词',
  `site_copyright` varchar(500) DEFAULT NULL COMMENT '网站版权说明',
  `site_menu` text COMMENT '菜单导航',
  `ProductRecommend` text,
  `smtp_email` varchar(50) DEFAULT NULL COMMENT '邮箱SMTP服务',
  `send_email` varchar(50) DEFAULT NULL COMMENT '发送邮箱',
  `send_email_password` varchar(50) DEFAULT NULL COMMENT '邮箱密码',
  `number` int(11) DEFAULT NULL COMMENT 'sup编号',
  `qq1` text CHARACTER SET greek NOT NULL COMMENT 'QQ',
  `qq2` text NOT NULL,
  `qq3` text NOT NULL,
  `qq4` text NOT NULL,
  `phoe1` text NOT NULL COMMENT '客服电话',
  `phoe2` text NOT NULL COMMENT '业务电话',
  `phoe3` text NOT NULL COMMENT '加款电话',
  `address` text NOT NULL COMMENT '地址',
  `shop_sort` varchar(50) DEFAULT NULL COMMENT '店铺排序',
  `shop_name` text COMMENT '店名后缀',
  `login_reg` text COMMENT '注册协议',
  `login_prompt` text COMMENT '登录提示',
  `javascript` text COMMENT '调用代码',
  `site_price1` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '建站价格1',
  `version1` varchar(50) NOT NULL COMMENT '建站版本1',
  `level1` int(2) DEFAULT '0' COMMENT '建站1送等级',
  `domain1` int(1) NOT NULL DEFAULT '0' COMMENT '赠送域名',
  `record1` int(1) NOT NULL DEFAULT '0' COMMENT '赠送备案',
  `site_price2` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '建站价格2',
  `version2` varchar(50) NOT NULL COMMENT '建站版本2',
  `level2` int(2) DEFAULT '0' COMMENT '建站2送等级',
  `domain2` int(1) NOT NULL DEFAULT '0' COMMENT '赠送域名',
  `record2` int(1) NOT NULL DEFAULT '0' COMMENT '赠送备案',
  `site_price3` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '建站价格3',
  `version3` varchar(50) NOT NULL COMMENT '建站版本3',
  `level3` int(2) DEFAULT '0' COMMENT '建站3送等级',
  `domain3` int(1) NOT NULL DEFAULT '0' COMMENT '赠送域名',
  `record3` int(1) NOT NULL DEFAULT '0' COMMENT '赠送备案',
  `site_price4` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '建站价格4',
  `version4` varchar(50) NOT NULL COMMENT '建站版本4',
  `level4` int(2) DEFAULT '0' COMMENT '建站4送等级',
  `domain4` int(1) NOT NULL DEFAULT '0' COMMENT '赠送域名',
  `record4` int(1) NOT NULL DEFAULT '0' COMMENT '赠送备案',
  `site_sup_p1` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '搜云令价格',
  `site_sup_p2` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '密保卡价格',
  `site_sup_p3` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '域名价格',
  `site_sup_p4` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '备案价格',
  `Shop_red_price1` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '1个月店铺红名',
  `Shop_red_price2` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '2个月店铺红名',
  `Shop_red_price3` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '3个月店铺红名',
  `Shop_red_price4` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '永久店铺红名',
  `charge1` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '提现费用1',
  `charge2` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '提现费用2',
  `charge3` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '提现费用3',
  `charge4` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '提现费用4',
  `api_qq` varchar(255) NOT NULL COMMENT 'QQ验证',
  `alipay` varchar(100) DEFAULT NULL COMMENT '支付宝',
  `tenpay` varchar(100) DEFAULT NULL COMMENT '财付通',
  `tenpay_key` varchar(100) CHARACTER SET gb2312 DEFAULT NULL COMMENT '财付通密匙',
  `site_rate` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '建站费率',
  `subprice` float(12,3) NOT NULL DEFAULT '0.000',
  `site_icon` int(1) NOT NULL DEFAULT '0',
  `appid` int(11) DEFAULT NULL,
  `appkey` varchar(36) DEFAULT NULL,
  `fship_price1` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '旗舰店按月收费',
  `fship_price2` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '旗舰店按年收费',
  `fship_price3` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '旗舰店最低押金',
  `catalogue` varchar(10) NOT NULL DEFAULT 'H001' COMMENT '商品目录',
  `pmt_price` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '商家促销价格',
  `price_1` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '店铺分类额度价格',
  `price_2` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '安全保障金',
  `price_3` float(12,3) NOT NULL DEFAULT '0.000' COMMENT '商品公益费用',
  `ServicePhone` text NOT NULL COMMENT '客服电话',
  `SalerPhone` text NOT NULL COMMENT '业务电话',
  `FinancePhone` text NOT NULL COMMENT '加款电话',
  `WorkDateTime` text NOT NULL COMMENT '工作时间',
  `qqsaccount` text NOT NULL COMMENT '前台客服资料',
  `qqchat` int(1) NOT NULL DEFAULT '0' COMMENT 'qq聊天开关',
  `qqaccount` text COMMENT 'qq客服资料',
  `Ypower1` int(1) NOT NULL DEFAULT '0' COMMENT '分站用户登录',
  `Ypower2` int(1) NOT NULL DEFAULT '0' COMMENT '代理商升级',
  `Ypower3` int(1) NOT NULL DEFAULT '0' COMMENT '分站站长升级',
  `Ypower4` int(1) NOT NULL DEFAULT '0' COMMENT '代理关系解除',
  `Ypower5` int(1) NOT NULL DEFAULT '1' COMMENT '开启导购'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

--
-- 转存表中的数据 `site_config`
--

INSERT INTO `site_config` (`id`, `site_jump`, `site_reg`, `site_leve`, `site_agent`, `moneytype`, `site_as`, `site_template`, `themecode`, `themecolor`, `bluewhite1`, `bluewhite2`, `bluewhite4`, `bluewhite5`, `bluewhite6`, `bluewhite7`, `bluewhite8`, `bluewhite9`, `bluewhite10`, `bluewhite11`, `bluewhite12`, `bluewhite13`, `bluewhite14`, `bluewhite15`, `bluewhite16`, `bluewhite17`, `bluewhite18`, `bluewhite19`, `bluewhite20`, `bluewhite21`, `bluewhite22`, `bluewhite23`, `bluewhite3`, `site_title`, `site_name`, `site_url`, `wap_url`, `cardpay_url`, `site_logo`, `login_logo`, `site_describe`, `site_keywords`, `site_copyright`, `site_menu`, `ProductRecommend`, `smtp_email`, `send_email`, `send_email_password`, `number`, `qq1`, `qq2`, `qq3`, `qq4`, `phoe1`, `phoe2`, `phoe3`, `address`, `shop_sort`, `shop_name`, `login_reg`, `login_prompt`, `javascript`, `site_price1`, `version1`, `level1`, `domain1`, `record1`, `site_price2`, `version2`, `level2`, `domain2`, `record2`, `site_price3`, `version3`, `level3`, `domain3`, `record3`, `site_price4`, `version4`, `level4`, `domain4`, `record4`, `site_sup_p1`, `site_sup_p2`, `site_sup_p3`, `site_sup_p4`, `Shop_red_price1`, `Shop_red_price2`, `Shop_red_price3`, `Shop_red_price4`, `charge1`, `charge2`, `charge3`, `charge4`, `api_qq`, `alipay`, `tenpay`, `tenpay_key`, `site_rate`, `subprice`, `site_icon`, `appid`, `appkey`, `fship_price1`, `fship_price2`, `fship_price3`, `catalogue`, `pmt_price`, `price_1`, `price_2`, `price_3`, `ServicePhone`, `SalerPhone`, `FinancePhone`, `WorkDateTime`, `qqsaccount`, `qqchat`, `qqaccount`, `Ypower1`, `Ypower2`, `Ypower3`, `Ypower4`, `Ypower5`) VALUES
(1, 0, 0, 1, '64370', '元', 5, 'blue', 'main-wrap king-wrap king-nvwa-bg', '', '全新卡盟体验', '商品管理、订单记录、收益统计、渠道分析...', '聚合社简介', '平台主要服务于互联网和移动互联网领域，为网页游戏、手机游戏、阅读、音乐、交友、教育等移动应用提供综合计费营销服务，创新、诚信、灵和活多元,创新是企业发展的灵魂。\r\n我们打破了传统软件注册码交易网站几年来一成不变的局面，建立了新一代软件注册码电子商务交易平台的行业方向，我们将引领软件注册码交易过程的个性化、自动化、工具化等。作为业内最善于创新的网站，力争成为行业的佼佼者。', '/templatecss/JuHeShe02/advantage_1.png', '/templatecss/JuHeShe02/advantage_2.png', '/templatecss/JuHeShe02/advantage_3.png', '/templatecss/JuHeShe02/advantage_4.png', '服务器安全', '资金保障', '持续更新', '界面简约', '采用群集服务器，防御高遍布全球，无论用户身在何处，均能获得流畅安全可靠的体验。', '商户资金，全部是次日结算当天到账，资金平均停留的时间不超过12小时，资金安全得到充分的保障.', '支付渠道直接对接官方，直接去掉中间商的差价，因此我们可以给商户提供更低廉的费率。', '简约的UI交互体验可以给您一个体验度极高的商户后台，更好的下单体验。', '94170844@qq.com', '马上开启全新卡盟体验', '聚合社365天在线客服，专业解决各种售后、商户、平台等问题。', '/templatecss/JuHeShe01/log_img.jpg', '0', '', '简易操作，一站式寄售卡，为您稳定服务。', '天赐传奇团队 | km.ziiiz.cn', '天赐传奇团队', 'http://km.ziiiz.cn', '', '未设置', 'http://web.juheshe.cn/as1f5gazxf.png', '/Upload/image/20181117/20181117034758_31280.png', '天赐传奇团队-卡盟源码搭建', '天赐传奇团队,近场网络科技有限公司,卡盟源码,网站源码,资源分享,juheshe,juheshe.cn,www.juheshe.cn,卡云建站,聚合建站,聚合社区,KyCard.cn,卡云工作室,卡云卡盟源码,卡易信源码', 'Copyright 天赐传奇团队km.ziiiz.cn Rights Reserved.', '', '', 'smtp.163.com', 'tccqtd@163.com', 'VtTZLc3iayvoBjKkQlIO1A', 1000, '843367003', '843367003', '843367003', '843367003', '150-0000-000', '150-0000-000', '150-0000-000', '北京市东城区景山前街4号', 'price', '', '用户协议', '', '', 0.000, '', 0, 0, 0, 0.000, '', 6, 0, 0, 0.000, '', 6, 0, 0, 0.000, '', 6, 0, 0, 0.000, 1000.000, 120.000, 150.000, 2.000, 3.000, 5.000, 20.000, 1.000, 0.000, 0.000, 0.000, '', '', '', '', 25.000, 3.000, 0, 101093133, '4fe998a0d6cd9c23cb440d3c3cbdb0dd', 10.000, 60.000, 200.000, '', 1.000, 1.000, 0.000, 0.000, '', '', '', '', '', 0, '', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `sms`
--

CREATE TABLE IF NOT EXISTS `sms` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL COMMENT '信息标题',
  `content` text COMMENT '短信内容',
  `state` int(1) DEFAULT '0' COMMENT '阅读状态',
  `locks` int(2) NOT NULL DEFAULT '0' COMMENT '是否强制查看',
  `username` varchar(50) NOT NULL COMMENT '接收者',
  `reply` text COMMENT '回复',
  `sendname` varchar(50) NOT NULL COMMENT '发送者',
  `begtime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `store_class`
--

CREATE TABLE IF NOT EXISTS `store_class` (
  `id` int(11) NOT NULL,
  `title` varchar(10) NOT NULL COMMENT '分类名称',
  `username` varchar(50) NOT NULL COMMENT '会员编号'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `supplier_refund`
--

CREATE TABLE IF NOT EXISTS `supplier_refund` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL COMMENT '事件',
  `price1` float(12,3) DEFAULT '0.000' COMMENT '订单金额',
  `price2` float(12,3) DEFAULT '0.000' COMMENT '抽成金额',
  `price3` float(12,3) DEFAULT '0.000' COMMENT '最终扣款',
  `content` text COMMENT '事件描述',
  `username` int(11) NOT NULL COMMENT '账户',
  `begtime` int(11) NOT NULL COMMENT '从开始到现在的时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `transfer_detail`
--

CREATE TABLE IF NOT EXISTS `transfer_detail` (
  `id` int(11) NOT NULL,
  `payee` varchar(50) DEFAULT NULL COMMENT '收款人',
  `drawee` varchar(50) DEFAULT NULL COMMENT '付款人',
  `price` float(12,3) DEFAULT NULL COMMENT '转款金额',
  `content` varchar(255) DEFAULT NULL COMMENT '转款备注',
  `begtime` int(11) NOT NULL COMMENT '时间：秒'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `vip_advertising`
--

CREATE TABLE IF NOT EXISTS `vip_advertising` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `content` text,
  `source` varchar(50) NOT NULL COMMENT '信息来源',
  `begtime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `vip_article`
--

CREATE TABLE IF NOT EXISTS `vip_article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '信息标题',
  `color` varchar(50) NOT NULL COMMENT '标题颜色',
  `menu` varchar(50) NOT NULL COMMENT '信息栏目',
  `source` varchar(50) NOT NULL COMMENT '信息来源',
  `content` text COMMENT '信息内容',
  `begtime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `vip_links`
--

CREATE TABLE IF NOT EXISTS `vip_links` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `begtime` int(11) NOT NULL,
  `source` varchar(50) DEFAULT NULL COMMENT '来源'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `vip_rem_account`
--

CREATE TABLE IF NOT EXISTS `vip_rem_account` (
  `id` int(11) NOT NULL,
  `bank_type` varchar(50) DEFAULT NULL COMMENT '银行类型',
  `bankaccount` varchar(50) DEFAULT NULL COMMENT '银行账户',
  `accountname` varchar(50) DEFAULT NULL COMMENT '持卡人姓名',
  `bankcity` varchar(50) DEFAULT NULL COMMENT '开户地区',
  `source` varchar(50) DEFAULT NULL COMMENT '来源',
  `time` int(11) NOT NULL COMMENT '提交时间'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `vip_shuffling`
--

CREATE TABLE IF NOT EXISTS `vip_shuffling` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `menu` varchar(255) DEFAULT NULL,
  `source` varchar(50) NOT NULL COMMENT '信息来源',
  `begtime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `vip_site`
--

CREATE TABLE IF NOT EXISTS `vip_site` (
  `id` int(11) NOT NULL,
  `vip_number` varchar(50) NOT NULL COMMENT '客户编号',
  `vip_username` varchar(50) DEFAULT NULL COMMENT '客户名称',
  `vip_agent` varchar(50) DEFAULT NULL COMMENT '上级编号',
  `vip_logo` varchar(255) DEFAULT NULL COMMENT '网站logo',
  `vip_name` varchar(50) DEFAULT NULL COMMENT '网站名称',
  `vip_title` varchar(255) DEFAULT NULL COMMENT '网站标题',
  `vip_describe` varchar(500) DEFAULT NULL COMMENT '网站描述',
  `vip_keywords` varchar(500) DEFAULT NULL COMMENT '网站关键词',
  `vip_menu` text COMMENT '导航菜单',
  `vip_copyright` text COMMENT '网页底部代码',
  `vip_reg` text COMMENT '注册协议',
  `domain_name` varchar(50) DEFAULT NULL COMMENT '网站域名',
  `template` varchar(50) DEFAULT NULL COMMENT '风格模板',
  `vip_open` int(1) DEFAULT '0' COMMENT '是否开放',
  `vip_reg_open` int(1) DEFAULT '0' COMMENT '注册开关',
  `content` text COMMENT '备注内容',
  `jinzhi` text COMMENT '禁止原因',
  `flag1` int(1) DEFAULT '0' COMMENT '自定义商品目录',
  `flag2` int(1) DEFAULT '0' COMMENT '设置注册默认级别',
  `flag3` int(1) DEFAULT '1' COMMENT '默认级别',
  `time` int(11) NOT NULL,
  `begtime` int(11) NOT NULL COMMENT '时间：秒',
  `myurl1` varchar(100) DEFAULT NULL COMMENT '顶级域名',
  `myurl2` varchar(100) DEFAULT NULL COMMENT '顶级域名',
  `myurl3` varchar(100) DEFAULT NULL COMMENT '顶级域名',
  `opens` int(1) DEFAULT '0' COMMENT '搭建状态',
  `versions` varchar(50) DEFAULT NULL COMMENT '搭建版本',
  `sup_open` int(1) DEFAULT '0' COMMENT '是否开启',
  `sup_why` text COMMENT '关闭原因',
  `smtp_email` varchar(300) DEFAULT NULL COMMENT '邮箱SMTP服务',
  `send_email` varchar(300) DEFAULT NULL COMMENT '发送邮箱',
  `send_email_password` varchar(300) DEFAULT NULL COMMENT '邮箱密码',
  `site_pay` varchar(100) DEFAULT NULL,
  `site_pay1` varchar(100) DEFAULT NULL,
  `login_prompt` varchar(255) DEFAULT NULL,
  `javascript` text,
  `qqreg` varchar(255) DEFAULT NULL COMMENT 'qq验证',
  `site_logins` int(1) DEFAULT '0',
  `hiddens` int(1) NOT NULL DEFAULT '0' COMMENT '上级目录显示',
  `locks` text COMMENT '隐藏的目录',
  `Sub_modl` text COMMENT '分站模版',
  `appid` int(11) DEFAULT NULL,
  `appkey` varchar(36) DEFAULT NULL,
  `qqchat` int(1) NOT NULL DEFAULT '0' COMMENT 'qq聊天开关',
  `qqaccount` text COMMENT 'qq客服资料'
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `advertising`
--
ALTER TABLE `advertising`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balance_cash`
--
ALTER TABLE `balance_cash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bobo_links`
--
ALTER TABLE `bobo_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy_modl`
--
ALTER TABLE `buy_modl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check_email`
--
ALTER TABLE `check_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check_reg`
--
ALTER TABLE `check_reg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cloud_key`
--
ALTER TABLE `cloud_key`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `codepay_order`
--
ALTER TABLE `codepay_order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `main` (`pay_id`,`pay_time`,`money`,`type`,`pay_tag`),
  ADD UNIQUE KEY `pay_no` (`pay_no`,`type`);

--
-- Indexes for table `codepay_user`
--
ALTER TABLE `codepay_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commission_record`
--
ALTER TABLE `commission_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints_feedback`
--
ALTER TABLE `complaints_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_cloud`
--
ALTER TABLE `data_cloud`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_charge`
--
ALTER TABLE `delivery_charge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_record`
--
ALTER TABLE `delivery_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `details_funds`
--
ALTER TABLE `details_funds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `details_funds_back`
--
ALTER TABLE `details_funds_back`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diary`
--
ALTER TABLE `diary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `docking_platform`
--
ALTER TABLE `docking_platform`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `encrypted_card`
--
ALTER TABLE `encrypted_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `encrypted_problem`
--
ALTER TABLE `encrypted_problem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fast_reply`
--
ALTER TABLE `fast_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flagship_shops`
--
ALTER TABLE `flagship_shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games_books`
--
ALTER TABLE `games_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_code`
--
ALTER TABLE `game_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_code_class`
--
ALTER TABLE `game_code_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `game_code_list`
--
ALTER TABLE `game_code_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goods_change`
--
ALTER TABLE `goods_change`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goods_details`
--
ALTER TABLE `goods_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goods_report`
--
ALTER TABLE `goods_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goods_yuer`
--
ALTER TABLE `goods_yuer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `import_goods`
--
ALTER TABLE `import_goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members_back`
--
ALTER TABLE `members_back`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `money_order`
--
ALTER TABLE `money_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_email`
--
ALTER TABLE `my_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_phone`
--
ALTER TABLE `my_phone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `one_cartoon`
--
ALTER TABLE `one_cartoon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_lock`
--
ALTER TABLE `password_lock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_record`
--
ALTER TABLE `pay_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popular_game`
--
ALTER TABLE `popular_game`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_modl`
--
ALTER TABLE `price_modl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_back`
--
ALTER TABLE `product_back`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_class`
--
ALTER TABLE `product_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_favorites`
--
ALTER TABLE `product_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `punishment`
--
ALTER TABLE `punishment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `punishment_list`
--
ALTER TABLE `punishment_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refund_event`
--
ALTER TABLE `refund_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reg_machine`
--
ALTER TABLE `reg_machine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rem_account`
--
ALTER TABLE `rem_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_email`
--
ALTER TABLE `send_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops_favorites`
--
ALTER TABLE `shops_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shuffling`
--
ALTER TABLE `shuffling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sign_in`
--
ALTER TABLE `sign_in`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_config`
--
ALTER TABLE `site_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms`
--
ALTER TABLE `sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_class`
--
ALTER TABLE `store_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_refund`
--
ALTER TABLE `supplier_refund`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer_detail`
--
ALTER TABLE `transfer_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vip_advertising`
--
ALTER TABLE `vip_advertising`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vip_article`
--
ALTER TABLE `vip_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vip_links`
--
ALTER TABLE `vip_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vip_rem_account`
--
ALTER TABLE `vip_rem_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vip_shuffling`
--
ALTER TABLE `vip_shuffling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vip_site`
--
ALTER TABLE `vip_site`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `advertising`
--
ALTER TABLE `advertising`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `balance_cash`
--
ALTER TABLE `balance_cash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bobo_links`
--
ALTER TABLE `bobo_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `buy_modl`
--
ALTER TABLE `buy_modl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `check_email`
--
ALTER TABLE `check_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `check_reg`
--
ALTER TABLE `check_reg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cloud_key`
--
ALTER TABLE `cloud_key`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `codepay_order`
--
ALTER TABLE `codepay_order`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `codepay_user`
--
ALTER TABLE `codepay_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户ID';
--
-- AUTO_INCREMENT for table `commission_record`
--
ALTER TABLE `commission_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `complaints_feedback`
--
ALTER TABLE `complaints_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_cloud`
--
ALTER TABLE `data_cloud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `delivery_charge`
--
ALTER TABLE `delivery_charge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `delivery_record`
--
ALTER TABLE `delivery_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `details_funds`
--
ALTER TABLE `details_funds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `details_funds_back`
--
ALTER TABLE `details_funds_back`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `diary`
--
ALTER TABLE `diary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `docking_platform`
--
ALTER TABLE `docking_platform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `encrypted_card`
--
ALTER TABLE `encrypted_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `encrypted_problem`
--
ALTER TABLE `encrypted_problem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fast_reply`
--
ALTER TABLE `fast_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `flagship_shops`
--
ALTER TABLE `flagship_shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `games_books`
--
ALTER TABLE `games_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `game_code`
--
ALTER TABLE `game_code`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `game_code_class`
--
ALTER TABLE `game_code_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `game_code_list`
--
ALTER TABLE `game_code_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `goods_change`
--
ALTER TABLE `goods_change`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `goods_details`
--
ALTER TABLE `goods_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `goods_report`
--
ALTER TABLE `goods_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `goods_yuer`
--
ALTER TABLE `goods_yuer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `import_goods`
--
ALTER TABLE `import_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2374;
--
-- AUTO_INCREMENT for table `members_back`
--
ALTER TABLE `members_back`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `money_order`
--
ALTER TABLE `money_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `my_email`
--
ALTER TABLE `my_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `my_phone`
--
ALTER TABLE `my_phone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `one_cartoon`
--
ALTER TABLE `one_cartoon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `password_lock`
--
ALTER TABLE `password_lock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pay_record`
--
ALTER TABLE `pay_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `popular_game`
--
ALTER TABLE `popular_game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `price_modl`
--
ALTER TABLE `price_modl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_back`
--
ALTER TABLE `product_back`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_class`
--
ALTER TABLE `product_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=317;
--
-- AUTO_INCREMENT for table `product_favorites`
--
ALTER TABLE `product_favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `punishment`
--
ALTER TABLE `punishment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `punishment_list`
--
ALTER TABLE `punishment_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `refund_event`
--
ALTER TABLE `refund_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reg_machine`
--
ALTER TABLE `reg_machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rem_account`
--
ALTER TABLE `rem_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `send_email`
--
ALTER TABLE `send_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shops_favorites`
--
ALTER TABLE `shops_favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shuffling`
--
ALTER TABLE `shuffling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sign_in`
--
ALTER TABLE `sign_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `site_config`
--
ALTER TABLE `site_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sms`
--
ALTER TABLE `sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `store_class`
--
ALTER TABLE `store_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `supplier_refund`
--
ALTER TABLE `supplier_refund`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transfer_detail`
--
ALTER TABLE `transfer_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vip_advertising`
--
ALTER TABLE `vip_advertising`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vip_article`
--
ALTER TABLE `vip_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vip_links`
--
ALTER TABLE `vip_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vip_rem_account`
--
ALTER TABLE `vip_rem_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vip_shuffling`
--
ALTER TABLE `vip_shuffling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vip_site`
--
ALTER TABLE `vip_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
