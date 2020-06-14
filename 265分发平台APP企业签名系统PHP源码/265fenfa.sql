/*
Navicat MySQL Data Transfer

Source Server         : b
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : 265fenfa

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2020-02-20 20:55:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for prefix_admin
-- ----------------------------
DROP TABLE IF EXISTS `prefix_admin`;
CREATE TABLE `prefix_admin` (
  `in_adminid` int(11) NOT NULL AUTO_INCREMENT,
  `in_adminname` varchar(255) NOT NULL,
  `in_adminpassword` varchar(255) NOT NULL,
  `in_loginip` varchar(255) DEFAULT NULL,
  `in_loginnum` int(11) NOT NULL,
  `in_logintime` datetime DEFAULT NULL,
  `in_islock` int(11) NOT NULL,
  `in_permission` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`in_adminid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of prefix_admin
-- ----------------------------
INSERT INTO `prefix_admin` VALUES ('1', 'admin@qq.com', 'e10adc3949ba59abbe56e057f20f883e', '127.0.0.1', '24', '2020-02-20 20:52:04', '0', '1,2,3,4,5,6');

-- ----------------------------
-- Table structure for prefix_app
-- ----------------------------
DROP TABLE IF EXISTS `prefix_app`;
CREATE TABLE `prefix_app` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT,
  `in_uid` int(11) NOT NULL COMMENT '用户id',
  `in_uname` varchar(255) NOT NULL COMMENT '用户名',
  `in_appid` int(11) NOT NULL COMMENT '应用主表关联ID',
  `in_name` varchar(255) NOT NULL,
  `in_form` varchar(255) NOT NULL COMMENT '应用类型',
  `in_bid` varchar(255) NOT NULL COMMENT '应用包名',
  `in_mnvs` varchar(255) NOT NULL COMMENT '兼容系统',
  `in_bsvs` varchar(255) NOT NULL COMMENT '版本',
  `in_bvs` varchar(255) NOT NULL COMMENT 'Build',
  `in_type` int(11) NOT NULL COMMENT '0安装1企业版2内测版',
  `in_nick` varchar(255) DEFAULT NULL COMMENT '公司名称',
  `in_team` varchar(255) DEFAULT NULL COMMENT '证书名称',
  `in_udids` text COMMENT '内测设备',
  `in_app` varchar(255) NOT NULL COMMENT '应用文件名',
  `in_originalName` varchar(255) NOT NULL COMMENT '应用上传时文件名',
  `in_size` bigint(20) NOT NULL COMMENT '应用大小',
  `in_deduct` int(11) NOT NULL COMMENT '下载扣除云币',
  `in_desc` varchar(255) DEFAULT NULL COMMENT '更新说明',
  `in_release` int(11) DEFAULT '1' COMMENT '0未发布1发布',
  `in_addtime` bigint(11) DEFAULT NULL COMMENT '更新时间',
  `remote` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`in_id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COMMENT='app版本关联表';

-- ----------------------------
-- Records of prefix_app
-- ----------------------------

-- ----------------------------
-- Table structure for prefix_appid
-- ----------------------------
DROP TABLE IF EXISTS `prefix_appid`;
CREATE TABLE `prefix_appid` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT,
  `in_uid` int(11) NOT NULL COMMENT '用户id',
  `in_uname` varchar(255) NOT NULL COMMENT '用户名',
  `in_name` varchar(255) NOT NULL COMMENT '应用名称',
  `in_icon` varchar(255) DEFAULT NULL COMMENT '应用图标',
  `in_form` varchar(255) NOT NULL COMMENT '应用类型',
  `in_bid` varchar(255) NOT NULL COMMENT '应用包名',
  `in_mnvs` varchar(255) NOT NULL COMMENT '兼容系统',
  `in_bsvs` varchar(255) NOT NULL COMMENT '版本',
  `in_bvs` varchar(255) NOT NULL COMMENT 'Build',
  `in_type` int(11) NOT NULL COMMENT '0安装1企业版2内测版',
  `in_nick` varchar(255) DEFAULT NULL COMMENT '公司名称',
  `in_team` varchar(255) DEFAULT NULL COMMENT '证书名称',
  `in_udids` text COMMENT '内测设备',
  `in_app` varchar(255) NOT NULL COMMENT '应用文件名',
  `in_originalName` varchar(255) NOT NULL COMMENT '应用上传时文件名',
  `in_downloads` int(11) DEFAULT '0' COMMENT '总下载次数',
  `in_deduct` int(11) NOT NULL COMMENT '下载扣除云币',
  `in_size` bigint(20) NOT NULL,
  `in_link` varchar(255) DEFAULT NULL COMMENT '下载链接',
  `in_tutorial` int(11) DEFAULT '1' COMMENT '信任教程0不显示1显示',
  `in_apppwd` varchar(255) DEFAULT NULL COMMENT '下载密码',
  `in_applimit` varchar(255) DEFAULT NULL COMMENT '下载限制',
  `in_contact` varchar(255) DEFAULT NULL COMMENT '联系方式',
  `in_appstore` varchar(255) DEFAULT NULL COMMENT '苹果应用商店地址',
  `in_remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `in_appintro` varchar(255) DEFAULT NULL COMMENT '应用介绍',
  `template` int(11) DEFAULT '3' COMMENT '下载模板',
  `template_language` varchar(11) DEFAULT 'zh' COMMENT '设置语言',
  `in_kid` int(11) DEFAULT '0' COMMENT '应用关联',
  `in_sign` int(11) NOT NULL DEFAULT '0',
  `in_resign` int(11) NOT NULL DEFAULT '0',
  `in_applock` int(11) DEFAULT '0' COMMENT '应用状态0正常1锁定',
  `in_addtime` bigint(11) DEFAULT NULL COMMENT '创建时间',
  `in_updatetime` bigint(11) DEFAULT NULL COMMENT '创建时间',
  `remote` tinyint(1) DEFAULT '0' COMMENT '0本地1远程',
  PRIMARY KEY (`in_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of prefix_appid
-- ----------------------------

-- ----------------------------
-- Table structure for prefix_buylog
-- ----------------------------
DROP TABLE IF EXISTS `prefix_buylog`;
CREATE TABLE `prefix_buylog` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT,
  `in_uid` int(11) NOT NULL,
  `in_uname` varchar(255) NOT NULL,
  `in_title` varchar(255) NOT NULL,
  `in_tid` int(11) NOT NULL,
  `in_money` int(11) NOT NULL,
  `in_lock` int(11) NOT NULL,
  `in_addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`in_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of prefix_buylog
-- ----------------------------

-- ----------------------------
-- Table structure for prefix_cert
-- ----------------------------
DROP TABLE IF EXISTS `prefix_cert`;
CREATE TABLE `prefix_cert` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT,
  `in_iden` varchar(255) NOT NULL,
  `in_name` varchar(255) NOT NULL,
  `in_dir` varchar(255) NOT NULL,
  PRIMARY KEY (`in_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of prefix_cert
-- ----------------------------

-- ----------------------------
-- Table structure for prefix_downhistory
-- ----------------------------
DROP TABLE IF EXISTS `prefix_downhistory`;
CREATE TABLE `prefix_downhistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `appid` int(11) NOT NULL COMMENT '应用id',
  `appname` varchar(50) NOT NULL COMMENT '应用名称',
  `appversion` varchar(50) NOT NULL COMMENT '应用版本',
  `appsize` varchar(50) NOT NULL COMMENT '应用大小',
  `liulan` int(11) NOT NULL COMMENT '0浏览1下载',
  `down` int(11) NOT NULL COMMENT '0浏览1下载',
  `addtime` datetime NOT NULL COMMENT '新增时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of prefix_downhistory
-- ----------------------------
INSERT INTO `prefix_downhistory` VALUES ('1', '1', '19', '仁龙美妆', '1.0.0', '4586908', '21', '0', '2019-12-17 21:55:02');
INSERT INTO `prefix_downhistory` VALUES ('3', '1', '20', '仁龙美妆', '1.0.0', '10035101', '18', '0', '2019-12-17 22:57:36');
INSERT INTO `prefix_downhistory` VALUES ('4', '1', '20', '仁龙美妆', '1.0.0', '10035101', '14', '20', '2019-12-18 00:00:16');
INSERT INTO `prefix_downhistory` VALUES ('5', '1', '19', '仁龙美妆', '1.0.0', '4586908', '20', '9', '2019-12-18 00:00:31');
INSERT INTO `prefix_downhistory` VALUES ('7', '1', '19', '仁龙美妆', '1.0.0', '4586908', '1', '0', '2019-12-19 17:52:59');
INSERT INTO `prefix_downhistory` VALUES ('8', '1', '26', '仁龙美妆', '1.0.0', '10035101', '7', '6', '2020-01-04 15:12:42');
INSERT INTO `prefix_downhistory` VALUES ('10', '1', '26', '仁龙美妆', '1.0.0', '10035101', '8', '0', '2020-01-09 11:02:09');

-- ----------------------------
-- Table structure for prefix_key
-- ----------------------------
DROP TABLE IF EXISTS `prefix_key`;
CREATE TABLE `prefix_key` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT,
  `in_tid` int(11) NOT NULL,
  `in_code` varchar(255) NOT NULL,
  `in_state` int(11) NOT NULL,
  `in_time` int(11) NOT NULL,
  PRIMARY KEY (`in_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of prefix_key
-- ----------------------------

-- ----------------------------
-- Table structure for prefix_mail
-- ----------------------------
DROP TABLE IF EXISTS `prefix_mail`;
CREATE TABLE `prefix_mail` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT,
  `in_uid` int(11) NOT NULL,
  `in_ucode` varchar(255) NOT NULL,
  `in_addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`in_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of prefix_mail
-- ----------------------------

-- ----------------------------
-- Table structure for prefix_mailreg
-- ----------------------------
DROP TABLE IF EXISTS `prefix_mailreg`;
CREATE TABLE `prefix_mailreg` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT,
  `in_uid` varchar(255) NOT NULL,
  `in_code` varchar(255) NOT NULL,
  `in_addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`in_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of prefix_mailreg
-- ----------------------------
INSERT INTO `prefix_mailreg` VALUES ('2', 'go916@qq.com', '197236f44e145925cc6f484022175b6d', '2019-09-21 00:11:34');
INSERT INTO `prefix_mailreg` VALUES ('3', 'admin@wlxiu.cn', '136957', '2019-09-21 00:26:36');
INSERT INTO `prefix_mailreg` VALUES ('4', 'admin@wlxiu.cn', '955442', '2019-09-21 00:36:18');
INSERT INTO `prefix_mailreg` VALUES ('5', 'admin@wlxiu.cn', '088442', '2019-09-21 00:40:00');
INSERT INTO `prefix_mailreg` VALUES ('6', 'go916@qq.com', '929317', '2019-12-18 17:03:49');

-- ----------------------------
-- Table structure for prefix_mobile
-- ----------------------------
DROP TABLE IF EXISTS `prefix_mobile`;
CREATE TABLE `prefix_mobile` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT,
  `in_mobile` varchar(255) NOT NULL,
  `in_code` varchar(255) NOT NULL,
  `in_ip` varchar(255) NOT NULL,
  `in_addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`in_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of prefix_mobile
-- ----------------------------
INSERT INTO `prefix_mobile` VALUES ('1', '', '857850', '127.0.0.1', '2019-11-07 00:13:51');
INSERT INTO `prefix_mobile` VALUES ('2', '15981908861', '287850', '127.0.0.1', '2019-12-18 17:15:59');

-- ----------------------------
-- Table structure for prefix_order
-- ----------------------------
DROP TABLE IF EXISTS `prefix_order`;
CREATE TABLE `prefix_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `up_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `main` (`pay_id`,`pay_time`,`money`,`type`,`pay_tag`),
  UNIQUE KEY `pay_no` (`pay_no`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用于区分是否已经处理';

-- ----------------------------
-- Records of prefix_order
-- ----------------------------

-- ----------------------------
-- Table structure for prefix_paylog
-- ----------------------------
DROP TABLE IF EXISTS `prefix_paylog`;
CREATE TABLE `prefix_paylog` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `in_uid` int(11) NOT NULL COMMENT '用户id',
  `in_uname` varchar(255) NOT NULL COMMENT '用户名',
  `pay_id` varchar(50) NOT NULL COMMENT '订单号',
  `pay_tag` varchar(255) NOT NULL COMMENT '订单描述',
  `pay_points` varchar(255) NOT NULL COMMENT '订单内容',
  `pay_money` decimal(5,2) NOT NULL COMMENT '付款金额',
  `pay_type` int(1) NOT NULL COMMENT '支付方式',
  `pay_no` varchar(100) DEFAULT NULL COMMENT '交易单号',
  `pay_param` int(1) NOT NULL COMMENT '业务类型',
  `pay_status` int(1) NOT NULL COMMENT '订单状态',
  `creat_time` bigint(11) NOT NULL COMMENT '创建时间',
  `pay_time` bigint(11) DEFAULT NULL COMMENT '付款时间',
  `update_time` bigint(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`in_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of prefix_paylog
-- ----------------------------

-- ----------------------------
-- Table structure for prefix_plugin
-- ----------------------------
DROP TABLE IF EXISTS `prefix_plugin`;
CREATE TABLE `prefix_plugin` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT,
  `in_name` varchar(255) NOT NULL,
  `in_dir` varchar(255) NOT NULL,
  `in_file` varchar(255) NOT NULL,
  `in_type` int(11) NOT NULL,
  `in_author` varchar(255) DEFAULT NULL,
  `in_address` varchar(255) DEFAULT NULL,
  `in_addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`in_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of prefix_plugin
-- ----------------------------
INSERT INTO `prefix_plugin` VALUES ('1', '阿里云存储[分发]', 'App-oss', 'upload', '0', 'BEES', 'https://www.021163.cn/', '2019-02-25 13:05:56');
INSERT INTO `prefix_plugin` VALUES ('2', '七牛云存储[分发]', 'App-qiniu', 'upload', '0', 'BEES', 'https://www.021163.cn/', '2019-02-25 13:05:56');

-- ----------------------------
-- Table structure for prefix_report
-- ----------------------------
DROP TABLE IF EXISTS `prefix_report`;
CREATE TABLE `prefix_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appid` int(11) NOT NULL COMMENT '应用id',
  `appname` varchar(50) NOT NULL COMMENT '应用名称',
  `addtime` datetime NOT NULL COMMENT '举报时间',
  `email` varchar(50) NOT NULL COMMENT '联系邮箱',
  `reason` varchar(50) NOT NULL COMMENT '举报类型0盗版1黄色2欺诈3其他',
  `note` text NOT NULL COMMENT '举报内容原因',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of prefix_report
-- ----------------------------

-- ----------------------------
-- Table structure for prefix_salt
-- ----------------------------
DROP TABLE IF EXISTS `prefix_salt`;
CREATE TABLE `prefix_salt` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT,
  `in_aid` int(11) NOT NULL,
  `in_salt` varchar(255) NOT NULL,
  `in_time` int(11) NOT NULL,
  PRIMARY KEY (`in_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of prefix_salt
-- ----------------------------

-- ----------------------------
-- Table structure for prefix_secret
-- ----------------------------
DROP TABLE IF EXISTS `prefix_secret`;
CREATE TABLE `prefix_secret` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT,
  `in_site` varchar(255) NOT NULL,
  `in_md5` varchar(255) NOT NULL,
  `in_endtime` int(11) NOT NULL,
  PRIMARY KEY (`in_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of prefix_secret
-- ----------------------------

-- ----------------------------
-- Table structure for prefix_sign
-- ----------------------------
DROP TABLE IF EXISTS `prefix_sign`;
CREATE TABLE `prefix_sign` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT,
  `in_aid` int(11) NOT NULL,
  `in_aname` varchar(255) DEFAULT NULL,
  `in_replace` varchar(255) DEFAULT NULL,
  `in_ssl` varchar(255) NOT NULL,
  `in_site` varchar(255) NOT NULL,
  `in_path` varchar(255) NOT NULL,
  `in_ipa` varchar(255) NOT NULL,
  `in_status` int(11) NOT NULL,
  `in_cert` varchar(255) NOT NULL,
  `in_time` int(11) NOT NULL,
  PRIMARY KEY (`in_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of prefix_sign
-- ----------------------------

-- ----------------------------
-- Table structure for prefix_signlog
-- ----------------------------
DROP TABLE IF EXISTS `prefix_signlog`;
CREATE TABLE `prefix_signlog` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT,
  `in_aid` int(11) NOT NULL,
  `in_aname` varchar(255) NOT NULL,
  `in_uid` int(11) NOT NULL,
  `in_uname` varchar(255) NOT NULL,
  `in_status` int(11) NOT NULL,
  `in_step` varchar(255) NOT NULL,
  `in_percent` int(11) NOT NULL,
  `in_cert` varchar(255) NOT NULL,
  `in_addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`in_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of prefix_signlog
-- ----------------------------

-- ----------------------------
-- Table structure for prefix_ticket
-- ----------------------------
DROP TABLE IF EXISTS `prefix_ticket`;
CREATE TABLE `prefix_ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL COMMENT '类型',
  `desc` text CHARACTER SET utf8 NOT NULL COMMENT '反馈内容',
  `upimg` text CHARACTER SET utf8 NOT NULL COMMENT '图片',
  `qq` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '联系方式',
  `addtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of prefix_ticket
-- ----------------------------
INSERT INTO `prefix_ticket` VALUES ('1', '1', '5G云资源网', '', '570602783', '2019-11-22 18:24:58');

-- ----------------------------
-- Table structure for prefix_user
-- ----------------------------
DROP TABLE IF EXISTS `prefix_user`;
CREATE TABLE `prefix_user` (
  `in_userid` int(11) NOT NULL AUTO_INCREMENT,
  `in_username` varchar(255) NOT NULL COMMENT '用户名',
  `in_userpassword` varchar(255) NOT NULL COMMENT '登录密码',
  `in_mail` varchar(255) NOT NULL COMMENT '邮箱',
  `in_mobile` varchar(255) DEFAULT NULL COMMENT '手机',
  `in_svip` int(11) NOT NULL DEFAULT '0' COMMENT '0体验1初级2中级3高级',
  `in_viptime` int(11) DEFAULT NULL COMMENT '会员过期时间',
  `in_nick` varchar(255) DEFAULT NULL COMMENT '实名姓名',
  `in_card` varchar(255) DEFAULT NULL COMMENT '实名身份证号码',
  `in_nameqy` varchar(255) DEFAULT NULL COMMENT '实名企业名称',
  `in_cardqy` varchar(255) DEFAULT NULL COMMENT '实名营业执照号码',
  `in_imgqy` varchar(255) DEFAULT NULL COMMENT '实名营业执照照片',
  `in_imgzm` varchar(255) DEFAULT NULL COMMENT '实名身份证正面',
  `in_imgfm` varchar(255) DEFAULT NULL COMMENT '实名身份证反面',
  `in_imgsc` varchar(255) DEFAULT NULL COMMENT '实名身份证手持',
  `in_regdate` datetime NOT NULL COMMENT '注册时间',
  `in_loginip` varchar(255) DEFAULT NULL COMMENT '最近登录ip',
  `in_logintime` datetime DEFAULT NULL COMMENT '最近登录时间',
  `in_type` int(11) NOT NULL DEFAULT '0' COMMENT '1个人2企业',
  `in_verify` int(11) NOT NULL DEFAULT '0' COMMENT '0未认证1通过2认证中3失败',
  `in_info` varchar(255) DEFAULT NULL COMMENT '拒绝原因',
  `in_islock` int(11) NOT NULL DEFAULT '0' COMMENT '0正常登录1禁止登录',
  `in_release` int(11) NOT NULL DEFAULT '0' COMMENT '0正常发布1禁止发布',
  `in_points` int(11) NOT NULL COMMENT '云币余额',
  `in_filesize` bigint(20) NOT NULL COMMENT '上传限制',
  `in_spaceuse` bigint(20) NOT NULL COMMENT '已使用容量',
  `in_spacetotal` bigint(20) NOT NULL COMMENT '总容量',
  PRIMARY KEY (`in_userid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of prefix_user
-- ----------------------------
INSERT INTO `prefix_user` VALUES ('2', 'zhifeng', '49ba59abbe56e057', 'admin@wlxiu.cn', '15617502218', '0', '0', '', '', '', '', null, null, null, null, '2019-12-18 17:07:16', '127.0.0.1', '2019-12-18 17:11:10', '0', '0', '', '0', '0', '1000', '104857600', '0', '209715200');
