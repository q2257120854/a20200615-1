/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : 127001

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2019-11-24 19:05:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pinduoduo_address
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_address`;
CREATE TABLE `pinduoduo_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `address_province` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '省份id',
  `address_city` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '城市id',
  `address_district` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '区县id',
  `address_concret` varchar(20) NOT NULL DEFAULT '' COMMENT '详细地址',
  `date` datetime DEFAULT NULL COMMENT '使用时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pinduoduo_address
-- ----------------------------
INSERT INTO `pinduoduo_address` VALUES ('1', '6', '77', '708', '福永街道机场路1004号', '2019-06-26 16:07:08');
INSERT INTO `pinduoduo_address` VALUES ('2', '6', '77', '3732', '观澜大道75号', '2019-06-26 16:07:16');
INSERT INTO `pinduoduo_address` VALUES ('3', '6', '77', '707', '南山大道2019号', '2019-06-26 16:07:18');
INSERT INTO `pinduoduo_address` VALUES ('4', '6', '77', '709', '新厦大道23号', '2019-06-26 16:07:18');
INSERT INTO `pinduoduo_address` VALUES ('5', '6', '77', '705', '福华三路289号', '2019-06-26 16:07:19');
INSERT INTO `pinduoduo_address` VALUES ('6', '6', '77', '706', '黄贝路2134号', '2019-06-26 16:07:21');
INSERT INTO `pinduoduo_address` VALUES ('7', '6', '77', '708', '固戍福荣路5号', '2019-06-26 16:07:23');
INSERT INTO `pinduoduo_address` VALUES ('8', '6', '77', '708', '宝安大道8230号', '2019-06-26 16:06:58');
INSERT INTO `pinduoduo_address` VALUES ('9', '6', '77', '708', '凤凰岗路60-1号', '2019-06-26 16:06:59');
INSERT INTO `pinduoduo_address` VALUES ('10', '6', '77', '708', '沿河路2号', '2019-06-26 16:06:59');
INSERT INTO `pinduoduo_address` VALUES ('11', '6', '77', '708', '福一路43号', '2019-06-26 16:06:59');
INSERT INTO `pinduoduo_address` VALUES ('12', '6', '77', '708', '金菊路一号4巷', '2019-06-26 16:06:59');
INSERT INTO `pinduoduo_address` VALUES ('13', '6', '77', '708', '东方路29号', '2019-06-26 16:07:00');
INSERT INTO `pinduoduo_address` VALUES ('14', '6', '77', '708', '福围中路36号', '2019-06-26 16:07:00');
INSERT INTO `pinduoduo_address` VALUES ('15', '6', '77', '708', '温馨路70号', '2019-06-26 16:07:01');
INSERT INTO `pinduoduo_address` VALUES ('16', '6', '77', '708', '征程二路9号', '2019-06-26 16:07:02');
INSERT INTO `pinduoduo_address` VALUES ('17', '6', '77', '708', '码头路252号', '2019-06-26 16:07:02');
INSERT INTO `pinduoduo_address` VALUES ('18', '6', '77', '708', '新和西九巷', '2019-06-26 16:07:02');
INSERT INTO `pinduoduo_address` VALUES ('19', '6', '77', '708', '上合路59号', '2019-06-26 16:07:02');
INSERT INTO `pinduoduo_address` VALUES ('20', '6', '77', '708', '工业路80号', '2019-06-26 16:07:04');
INSERT INTO `pinduoduo_address` VALUES ('21', '6', '77', '708', '朝阳路10号', '2019-06-26 16:07:05');
INSERT INTO `pinduoduo_address` VALUES ('22', '6', '77', '708', '公园路555号', '2019-06-26 16:07:06');
INSERT INTO `pinduoduo_address` VALUES ('23', '6', '77', '708', '企安路12号', '2019-06-26 16:07:08');
INSERT INTO `pinduoduo_address` VALUES ('24', '6', '77', '708', '上川路212号', '2019-06-26 16:07:08');
INSERT INTO `pinduoduo_address` VALUES ('25', '6', '77', '708', '新安三路171号', '2019-06-26 16:07:09');
INSERT INTO `pinduoduo_address` VALUES ('26', '6', '77', '708', '南昌路86号', '2019-06-26 16:07:10');
INSERT INTO `pinduoduo_address` VALUES ('27', '6', '77', '708', '自由路北1巷', '2019-06-26 16:07:11');
INSERT INTO `pinduoduo_address` VALUES ('28', '6', '77', '708', '沿河南路1号', '2019-06-26 16:07:11');
INSERT INTO `pinduoduo_address` VALUES ('29', '6', '77', '708', '辛居路9号', '2019-06-26 16:07:11');
INSERT INTO `pinduoduo_address` VALUES ('30', '6', '77', '708', '蜀风路13号', '2019-06-26 16:07:11');
INSERT INTO `pinduoduo_address` VALUES ('31', '6', '77', '708', '有利路6号', '2019-06-26 16:07:12');
INSERT INTO `pinduoduo_address` VALUES ('32', '6', '77', '708', '衙辛路4号', '2019-06-26 16:07:13');
INSERT INTO `pinduoduo_address` VALUES ('33', '6', '77', '708', '兴业路3005号', '2019-06-26 16:07:13');
INSERT INTO `pinduoduo_address` VALUES ('34', '6', '77', '708', '川一路5号', '2019-06-26 16:07:13');
INSERT INTO `pinduoduo_address` VALUES ('35', '6', '77', '708', '新沙路306号', '2019-06-26 16:07:13');
INSERT INTO `pinduoduo_address` VALUES ('36', '6', '77', '708', '宝安大道4016号', '2019-06-26 16:07:13');
INSERT INTO `pinduoduo_address` VALUES ('37', '6', '77', '3732', '和平路108号', '2019-06-26 16:07:18');
INSERT INTO `pinduoduo_address` VALUES ('38', '6', '77', '3732', '华盛路221号', '2019-06-26 16:07:19');
INSERT INTO `pinduoduo_address` VALUES ('39', '6', '77', '3732', '华荣路58号', '2019-06-26 16:07:19');
INSERT INTO `pinduoduo_address` VALUES ('40', '6', '77', '3732', '新塘村23号', '2019-06-26 16:07:19');
INSERT INTO `pinduoduo_address` VALUES ('41', '6', '77', '3732', '梅龙大道2229号', '2019-06-26 16:07:19');
INSERT INTO `pinduoduo_address` VALUES ('42', '6', '77', '3732', '华兴路19号', '2019-06-26 16:07:20');
INSERT INTO `pinduoduo_address` VALUES ('43', '6', '77', '3732', '锦绣路8号', '2019-06-26 16:07:20');
INSERT INTO `pinduoduo_address` VALUES ('44', '6', '77', '3732', '雪岗北路368号', '2019-06-26 16:07:20');
INSERT INTO `pinduoduo_address` VALUES ('45', '6', '77', '3732', '布新路138号', '2019-06-26 16:07:20');
INSERT INTO `pinduoduo_address` VALUES ('46', '6', '77', '3732', '水斗二路21号', '2019-06-26 16:07:20');
INSERT INTO `pinduoduo_address` VALUES ('47', '6', '77', '3732', '布新路138号', '2019-06-26 16:07:20');
INSERT INTO `pinduoduo_address` VALUES ('48', '6', '77', '3732', '龙观路3号', '2019-06-26 16:07:21');
INSERT INTO `pinduoduo_address` VALUES ('49', '6', '77', '3732', '民治街道东环二路1号', '2019-06-26 16:07:21');
INSERT INTO `pinduoduo_address` VALUES ('50', '6', '77', '3732', '观光路1301号', '2019-06-26 16:07:21');
INSERT INTO `pinduoduo_address` VALUES ('51', '6', '77', '3732', '工业路28号', '2019-06-26 16:07:21');
INSERT INTO `pinduoduo_address` VALUES ('52', '6', '77', '3732', '梅龙大道43号', '2019-06-26 16:07:21');
INSERT INTO `pinduoduo_address` VALUES ('53', '6', '77', '3732', '龙峰二路317', '2019-06-26 16:07:21');
INSERT INTO `pinduoduo_address` VALUES ('54', '6', '77', '3732', '龙观东路198号', '2019-06-26 16:07:22');
INSERT INTO `pinduoduo_address` VALUES ('55', '6', '77', '3732', '华兴路19号', '2019-06-26 16:07:00');
INSERT INTO `pinduoduo_address` VALUES ('56', '6', '77', '3732', '人民路3023号', '2019-06-26 16:07:00');
INSERT INTO `pinduoduo_address` VALUES ('57', '6', '77', '3732', '建设路201号', '2019-06-26 16:07:00');
INSERT INTO `pinduoduo_address` VALUES ('58', '6', '77', '3732', '玉龙路902号', '2019-06-26 16:07:01');
INSERT INTO `pinduoduo_address` VALUES ('59', '6', '77', '3732', '华园道216号', '2019-06-26 16:07:01');
INSERT INTO `pinduoduo_address` VALUES ('60', '6', '77', '3732', '华盛路34号', '2019-06-26 16:07:01');
INSERT INTO `pinduoduo_address` VALUES ('61', '6', '77', '707', '蛇口太子路72号', '2019-06-26 16:07:01');
INSERT INTO `pinduoduo_address` VALUES ('62', '6', '77', '707', '大新路188号', '2019-06-26 16:07:01');
INSERT INTO `pinduoduo_address` VALUES ('63', '6', '77', '707', '南新路1064号', '2019-06-26 16:07:01');
INSERT INTO `pinduoduo_address` VALUES ('64', '6', '77', '707', '南山大道2002号', '2019-06-26 16:07:02');
INSERT INTO `pinduoduo_address` VALUES ('65', '6', '77', '707', '学府路101号', '2019-06-26 16:07:02');
INSERT INTO `pinduoduo_address` VALUES ('66', '6', '77', '707', '桃园路5号', '2019-06-26 16:07:02');
INSERT INTO `pinduoduo_address` VALUES ('67', '6', '77', '707', '深南大道12031号', '2019-06-26 16:07:02');
INSERT INTO `pinduoduo_address` VALUES ('68', '6', '77', '707', '高新中四道11号', '2019-06-26 16:07:03');
INSERT INTO `pinduoduo_address` VALUES ('69', '6', '77', '707', '创业路98号', '2019-06-26 16:07:03');
INSERT INTO `pinduoduo_address` VALUES ('70', '6', '77', '707', '珠光路182号', '2019-06-26 16:07:03');
INSERT INTO `pinduoduo_address` VALUES ('71', '6', '77', '707', '前海路3300号', '2019-06-26 16:07:03');
INSERT INTO `pinduoduo_address` VALUES ('72', '6', '77', '707', '高新南环路18号', '2019-06-26 16:07:03');
INSERT INTO `pinduoduo_address` VALUES ('73', '6', '77', '707', '桂庙路24号', '2019-06-26 16:07:03');
INSERT INTO `pinduoduo_address` VALUES ('74', '6', '77', '707', '翠溪路1号', '2019-06-26 16:07:03');
INSERT INTO `pinduoduo_address` VALUES ('75', '6', '77', '707', '南商路112号', '2019-06-26 16:07:04');
INSERT INTO `pinduoduo_address` VALUES ('76', '6', '77', '707', '四海路20号', '2019-06-26 16:07:04');
INSERT INTO `pinduoduo_address` VALUES ('77', '6', '77', '707', '沙河街55号', '2019-06-26 16:07:04');
INSERT INTO `pinduoduo_address` VALUES ('78', '6', '77', '707', '一号路32号', '2019-06-26 16:07:04');
INSERT INTO `pinduoduo_address` VALUES ('79', '6', '77', '707', '新中路33号', '2019-06-26 16:07:05');
INSERT INTO `pinduoduo_address` VALUES ('80', '6', '77', '707', '龙城路360号', '2019-06-26 16:07:05');
INSERT INTO `pinduoduo_address` VALUES ('81', '6', '77', '707', '桂庙路22号', '2019-06-26 16:07:06');
INSERT INTO `pinduoduo_address` VALUES ('82', '6', '77', '707', '桂庙路62号', '2019-06-26 16:07:06');
INSERT INTO `pinduoduo_address` VALUES ('83', '6', '77', '707', '常兴路102号', '2019-06-26 16:07:06');
INSERT INTO `pinduoduo_address` VALUES ('84', '6', '77', '707', '沿湖路17号', '2019-06-26 16:07:07');
INSERT INTO `pinduoduo_address` VALUES ('85', '6', '77', '707', '学府路123号', '2019-06-26 16:07:08');
INSERT INTO `pinduoduo_address` VALUES ('86', '6', '77', '707', '兴工路11号', '2019-06-26 16:07:08');
INSERT INTO `pinduoduo_address` VALUES ('87', '6', '77', '707', '华明路1号', '2019-06-26 16:07:09');
INSERT INTO `pinduoduo_address` VALUES ('88', '6', '77', '707', '文心二路11号', '2019-06-26 16:07:09');
INSERT INTO `pinduoduo_address` VALUES ('89', '6', '77', '707', '后海大道2002号', '2019-06-26 16:07:10');
INSERT INTO `pinduoduo_address` VALUES ('90', '6', '77', '707', '龙珠五路2号', '2019-06-26 16:07:10');
INSERT INTO `pinduoduo_address` VALUES ('91', '6', '77', '707', '科兴路11号', '2019-06-26 16:07:10');
INSERT INTO `pinduoduo_address` VALUES ('92', '6', '77', '707', '常兴路138号', '2019-06-26 16:07:10');
INSERT INTO `pinduoduo_address` VALUES ('93', '6', '77', '707', '桃李路33号', '2019-06-26 16:07:10');
INSERT INTO `pinduoduo_address` VALUES ('94', '6', '77', '707', '艺园路168号', '2019-06-26 16:07:11');
INSERT INTO `pinduoduo_address` VALUES ('95', '6', '77', '707', '南园新园路67号', '2019-06-26 16:07:12');
INSERT INTO `pinduoduo_address` VALUES ('96', '6', '77', '709', '新木路329号', '2019-06-26 16:07:12');
INSERT INTO `pinduoduo_address` VALUES ('97', '6', '77', '709', '埔厦路6号', '2019-06-26 16:07:12');
INSERT INTO `pinduoduo_address` VALUES ('98', '6', '77', '709', '长发路13号', '2019-06-26 16:07:12');
INSERT INTO `pinduoduo_address` VALUES ('99', '6', '77', '709', '坂雪岗大道4002号', '2019-06-26 16:07:12');
INSERT INTO `pinduoduo_address` VALUES ('100', '6', '77', '709', '龙岗大道6002号', '2019-06-26 16:07:13');
INSERT INTO `pinduoduo_address` VALUES ('101', '6', '77', '709', '深惠路1072', '2019-06-26 16:07:14');
INSERT INTO `pinduoduo_address` VALUES ('102', '6', '77', '709', '平吉大道北295号', '2019-06-26 16:07:14');
INSERT INTO `pinduoduo_address` VALUES ('103', '6', '77', '709', '六和路39-1号', '2019-06-26 16:07:14');
INSERT INTO `pinduoduo_address` VALUES ('104', '6', '77', '709', '雪岗北路113号', '2019-06-26 16:07:14');
INSERT INTO `pinduoduo_address` VALUES ('105', '6', '77', '709', '军田路91号', '2019-06-26 16:07:15');
INSERT INTO `pinduoduo_address` VALUES ('106', '6', '77', '709', '龙飞大道669号', '2019-06-26 16:07:15');
INSERT INTO `pinduoduo_address` VALUES ('107', '6', '77', '709', '龙岗大道5194号', '2019-06-26 16:07:15');
INSERT INTO `pinduoduo_address` VALUES ('108', '6', '77', '709', '龙岗中心城西埔东街1号', '2019-06-26 16:07:15');
INSERT INTO `pinduoduo_address` VALUES ('109', '6', '77', '709', '龙岗大道6002号', '2019-06-26 16:07:15');
INSERT INTO `pinduoduo_address` VALUES ('110', '6', '77', '709', '雪围路6号', '2019-06-26 16:07:15');
INSERT INTO `pinduoduo_address` VALUES ('111', '6', '77', '709', '共乐路2号', '2019-06-26 16:07:16');
INSERT INTO `pinduoduo_address` VALUES ('112', '6', '77', '709', '力嘉路108号', '2019-06-26 16:07:21');
INSERT INTO `pinduoduo_address` VALUES ('113', '6', '77', '709', '茂盛路1号', '2019-06-26 16:07:22');
INSERT INTO `pinduoduo_address` VALUES ('114', '6', '77', '709', '勤富路32号', '2019-06-26 16:07:22');
INSERT INTO `pinduoduo_address` VALUES ('115', '6', '77', '709', '雪岗路113号', '2019-06-26 16:07:22');
INSERT INTO `pinduoduo_address` VALUES ('116', '6', '77', '709', '吉祥三路12号', '2019-06-26 16:07:23');
INSERT INTO `pinduoduo_address` VALUES ('117', '6', '77', '709', '建新路2号', '2019-06-26 16:07:23');
INSERT INTO `pinduoduo_address` VALUES ('118', '6', '77', '709', '南联路46号', '2019-06-26 16:07:23');
INSERT INTO `pinduoduo_address` VALUES ('119', '6', '77', '709', '晨光路49号', '2019-06-26 16:07:23');
INSERT INTO `pinduoduo_address` VALUES ('120', '6', '77', '709', '银珠路69号', '2019-06-26 16:07:24');
INSERT INTO `pinduoduo_address` VALUES ('121', '6', '77', '709', '工业大道43号', '2019-06-26 16:07:24');
INSERT INTO `pinduoduo_address` VALUES ('122', '6', '77', '709', '怡苑路38号', '2019-06-26 16:07:24');
INSERT INTO `pinduoduo_address` VALUES ('123', '6', '77', '709', '龙岗大道6149号', '2019-06-26 16:06:57');
INSERT INTO `pinduoduo_address` VALUES ('124', '6', '77', '709', '里浦街3号', '2019-06-26 16:06:57');
INSERT INTO `pinduoduo_address` VALUES ('125', '6', '77', '709', '四联路353号', '2019-06-26 16:06:58');
INSERT INTO `pinduoduo_address` VALUES ('126', '6', '77', '709', '环城南路5号', '2019-06-26 16:06:58');
INSERT INTO `pinduoduo_address` VALUES ('127', '6', '77', '709', '向前路120号', '2019-06-26 16:06:58');
INSERT INTO `pinduoduo_address` VALUES ('128', '6', '77', '709', '新瑞路21号', '2019-06-26 16:07:01');
INSERT INTO `pinduoduo_address` VALUES ('129', '6', '77', '709', '佳业路5号', '2019-06-26 16:07:02');
INSERT INTO `pinduoduo_address` VALUES ('130', '6', '77', '709', '宝龙大道81号', '2019-06-26 16:07:04');
INSERT INTO `pinduoduo_address` VALUES ('131', '6', '77', '705', '福强路4155号', '2019-06-26 16:07:04');
INSERT INTO `pinduoduo_address` VALUES ('132', '6', '77', '705', '百花一路2号', '2019-06-26 16:07:05');
INSERT INTO `pinduoduo_address` VALUES ('133', '6', '77', '705', '红岭南路1049号', '2019-06-26 16:07:05');
INSERT INTO `pinduoduo_address` VALUES ('134', '6', '77', '705', '百花四路2号', '2019-06-26 16:07:05');
INSERT INTO `pinduoduo_address` VALUES ('135', '6', '77', '705', '笋岗西路2057号', '2019-06-26 16:07:07');
INSERT INTO `pinduoduo_address` VALUES ('136', '6', '77', '705', '福中路315号', '2019-06-26 16:07:08');
INSERT INTO `pinduoduo_address` VALUES ('137', '6', '77', '705', '福永路东2号', '2019-06-26 16:07:08');
INSERT INTO `pinduoduo_address` VALUES ('138', '6', '77', '705', '深南大道2001号', '2019-06-26 16:07:09');
INSERT INTO `pinduoduo_address` VALUES ('139', '6', '77', '705', '福民路139号', '2019-06-26 16:07:09');
INSERT INTO `pinduoduo_address` VALUES ('140', '6', '77', '705', '福民路133号', '2019-06-26 16:07:09');
INSERT INTO `pinduoduo_address` VALUES ('141', '6', '77', '705', '百花四路59号', '2019-06-26 16:07:09');
INSERT INTO `pinduoduo_address` VALUES ('142', '6', '77', '705', '深惠路446号', '2019-06-26 16:07:09');
INSERT INTO `pinduoduo_address` VALUES ('143', '6', '77', '705', '滨河大道9289号', '2019-06-26 16:07:10');
INSERT INTO `pinduoduo_address` VALUES ('144', '6', '77', '705', '红荔路3008号', '2019-06-26 16:07:10');
INSERT INTO `pinduoduo_address` VALUES ('145', '6', '77', '705', '八卦三路6号', '2019-06-26 16:07:10');
INSERT INTO `pinduoduo_address` VALUES ('146', '6', '77', '705', '百花六路27号', '2019-06-26 16:07:11');
INSERT INTO `pinduoduo_address` VALUES ('147', '6', '77', '705', '百花三路2号', '2019-06-26 16:07:12');
INSERT INTO `pinduoduo_address` VALUES ('148', '6', '77', '705', '桂花路17号', '2019-06-26 16:07:12');
INSERT INTO `pinduoduo_address` VALUES ('149', '6', '77', '705', '百花五路34号', '2019-06-26 16:07:13');
INSERT INTO `pinduoduo_address` VALUES ('150', '6', '77', '705', '福中路15号', '2019-06-26 16:07:13');
INSERT INTO `pinduoduo_address` VALUES ('151', '6', '77', '705', '百花四路9号', '2019-06-26 16:07:13');
INSERT INTO `pinduoduo_address` VALUES ('152', '6', '77', '705', '益田路3013号', '2019-06-26 16:07:14');
INSERT INTO `pinduoduo_address` VALUES ('153', '6', '77', '705', '凯丰路8号', '2019-06-26 16:07:14');
INSERT INTO `pinduoduo_address` VALUES ('154', '6', '77', '705', '八卦三路88号', '2019-06-26 16:07:14');
INSERT INTO `pinduoduo_address` VALUES ('155', '6', '77', '705', '振中路35号', '2019-06-26 16:07:14');
INSERT INTO `pinduoduo_address` VALUES ('156', '6', '77', '705', '泰然四路94号', '2019-06-26 16:07:15');
INSERT INTO `pinduoduo_address` VALUES ('157', '6', '77', '705', '深惠路446号', '2019-06-26 16:07:15');
INSERT INTO `pinduoduo_address` VALUES ('158', '6', '77', '705', '八卦一路39号', '2019-06-26 16:07:15');
INSERT INTO `pinduoduo_address` VALUES ('159', '6', '77', '705', '椰风道12号', '2019-06-26 16:07:16');
INSERT INTO `pinduoduo_address` VALUES ('160', '6', '77', '705', '商报东路17号', '2019-06-26 16:07:16');
INSERT INTO `pinduoduo_address` VALUES ('161', '6', '77', '705', '上沙椰树路一巷1号', '2019-06-26 16:07:16');
INSERT INTO `pinduoduo_address` VALUES ('162', '6', '77', '705', '福荣路46号', '2019-06-26 16:07:17');
INSERT INTO `pinduoduo_address` VALUES ('163', '6', '77', '705', '石厦北一街31号', '2019-06-26 16:07:17');
INSERT INTO `pinduoduo_address` VALUES ('164', '6', '77', '705', '香梅路1074号', '2019-06-26 16:07:17');
INSERT INTO `pinduoduo_address` VALUES ('165', '6', '77', '705', '布尾村116-1号', '2019-06-26 16:07:17');
INSERT INTO `pinduoduo_address` VALUES ('166', '6', '77', '705', '祠堂街1号', '2019-06-26 16:07:17');
INSERT INTO `pinduoduo_address` VALUES ('167', '6', '77', '706', '太白西路4017号', '2019-06-26 16:07:17');
INSERT INTO `pinduoduo_address` VALUES ('168', '6', '77', '706', '布心村203号', '2019-06-26 16:07:17');
INSERT INTO `pinduoduo_address` VALUES ('169', '6', '77', '706', '太白街4011号', '2019-06-26 16:07:18');
INSERT INTO `pinduoduo_address` VALUES ('170', '6', '77', '706', '中兴路168号', '2019-06-26 16:07:18');
INSERT INTO `pinduoduo_address` VALUES ('171', '6', '77', '706', '翠竹街道太宁路7', '2019-06-26 16:07:18');
INSERT INTO `pinduoduo_address` VALUES ('172', '6', '77', '706', '深南东路4003号', '2019-06-26 16:07:18');
INSERT INTO `pinduoduo_address` VALUES ('173', '6', '77', '706', '太安路98号', '2019-06-26 16:07:19');
INSERT INTO `pinduoduo_address` VALUES ('174', '6', '77', '706', '红岗路1299号', '2019-06-26 16:07:19');
INSERT INTO `pinduoduo_address` VALUES ('175', '6', '77', '706', '桂圆北路160号', '2019-06-26 16:07:19');
INSERT INTO `pinduoduo_address` VALUES ('176', '6', '77', '706', '笋岗东路2008号', '2019-06-26 16:07:22');
INSERT INTO `pinduoduo_address` VALUES ('177', '6', '77', '706', '太安路71号', '2019-06-26 16:07:22');
INSERT INTO `pinduoduo_address` VALUES ('178', '6', '77', '706', '红岗路1299号', '2019-06-26 16:07:23');
INSERT INTO `pinduoduo_address` VALUES ('179', '6', '77', '706', '文锦北路1081号', '2019-06-26 16:06:57');
INSERT INTO `pinduoduo_address` VALUES ('180', '6', '77', '706', '红岗路1249号', '2019-06-26 16:06:58');
INSERT INTO `pinduoduo_address` VALUES ('181', '6', '77', '706', '文锦中路2019号', '2019-06-26 16:06:58');
INSERT INTO `pinduoduo_address` VALUES ('182', '6', '77', '706', '北站路3号', '2019-06-26 16:06:58');
INSERT INTO `pinduoduo_address` VALUES ('183', '6', '77', '706', '太宁路111号', '2019-06-26 16:06:59');
INSERT INTO `pinduoduo_address` VALUES ('184', '6', '77', '706', '红岗路1299号', '2019-06-26 16:06:59');
INSERT INTO `pinduoduo_address` VALUES ('185', '6', '77', '706', '东门中路2110', '2019-06-26 16:06:59');
INSERT INTO `pinduoduo_address` VALUES ('186', '6', '77', '706', '金洲路193号', '2019-06-26 16:06:59');
INSERT INTO `pinduoduo_address` VALUES ('187', '6', '77', '706', '文锦北路1081号', '2019-06-26 16:07:00');
INSERT INTO `pinduoduo_address` VALUES ('188', '6', '77', '706', '宝岗路41号', '2019-06-26 16:07:00');
INSERT INTO `pinduoduo_address` VALUES ('189', '6', '77', '706', '太白路4009号', '2019-06-26 16:07:01');
INSERT INTO `pinduoduo_address` VALUES ('190', '6', '77', '706', '国威路139号', '2019-06-26 16:07:03');
INSERT INTO `pinduoduo_address` VALUES ('191', '6', '77', '706', '红桂横街11号', '2019-06-26 16:07:04');
INSERT INTO `pinduoduo_address` VALUES ('192', '6', '77', '706', '爱国路3001号', '2019-06-26 16:07:05');
INSERT INTO `pinduoduo_address` VALUES ('193', '6', '77', '706', '罗沙路4089号', '2019-06-26 16:07:06');
INSERT INTO `pinduoduo_address` VALUES ('194', '6', '77', '706', '凤凰街18号', '2019-06-26 16:07:07');
INSERT INTO `pinduoduo_address` VALUES ('195', '6', '77', '706', '洪湖二街50号', '2019-06-26 16:07:11');
INSERT INTO `pinduoduo_address` VALUES ('196', '6', '77', '706', '布心路1012号', '2019-06-26 16:07:11');
INSERT INTO `pinduoduo_address` VALUES ('197', '6', '77', '706', '深南东路3022号', '2019-06-26 16:07:16');
INSERT INTO `pinduoduo_address` VALUES ('198', '6', '77', '706', '罗沙路4089号', '2019-06-26 16:07:17');
INSERT INTO `pinduoduo_address` VALUES ('199', '6', '77', '706', '文锦北路1049号', '2019-06-26 16:07:18');
INSERT INTO `pinduoduo_address` VALUES ('200', '6', '77', '706', '宝安南路3088号', '2019-06-26 16:07:16');

-- ----------------------------
-- Table structure for pinduoduo_bank
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_bank`;
CREATE TABLE `pinduoduo_bank` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(10) NOT NULL DEFAULT '' COMMENT '银行名称',
  `name` varchar(10) NOT NULL DEFAULT '' COMMENT '收款人姓名',
  `address` varchar(20) NOT NULL DEFAULT '' COMMENT '银行卡号',
  `admin_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='银行表';

-- ----------------------------
-- Records of pinduoduo_bank
-- ----------------------------

-- ----------------------------
-- Table structure for pinduoduo_cash
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_cash`;
CREATE TABLE `pinduoduo_cash` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `total` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '账单金额',
  `fee` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '手续费',
  `cash_value` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '实付金额',
  `pre_balance` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '提前余额',
  `balance` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '提后余额',
  `bank_title` varchar(10) NOT NULL DEFAULT '' COMMENT '机构名称',
  `bank_name` varchar(10) NOT NULL DEFAULT '' COMMENT '收款姓名',
  `bank_address` varchar(20) NOT NULL DEFAULT '' COMMENT '收款账号',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '支付状态(0未支付,1已支付,2已取消)',
  `admin_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员id',
  `c_time` datetime DEFAULT NULL COMMENT '添加时间',
  `f_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '财务管理id',
  `cash_sn` char(20) NOT NULL DEFAULT '' COMMENT '提现编号',
  PRIMARY KEY (`id`),
  KEY `f_id_idx` (`f_id`) USING BTREE,
  KEY `admin_uid_idx` (`admin_uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pinduoduo_cash
-- ----------------------------

-- ----------------------------
-- Table structure for pinduoduo_client
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_client`;
CREATE TABLE `pinduoduo_client` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `client_id` char(32) NOT NULL DEFAULT '' COMMENT '商户id',
  `client_secret` char(64) NOT NULL DEFAULT '' COMMENT '商户秘钥',
  `timestamp` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '商户时间戳',
  `total` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '余额',
  `admin_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员id',
  `google_secret` char(16) NOT NULL DEFAULT '' COMMENT 'google秘钥',
  `p_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '通道id',
  `cash_fee` float NOT NULL DEFAULT '0' COMMENT '手续费率',
  `d_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '代理商id',
  PRIMARY KEY (`id`),
  KEY `client_id_idx` (`client_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='客户表';

-- ----------------------------
-- Records of pinduoduo_client
-- ----------------------------
INSERT INTO `pinduoduo_client` VALUES ('4', 'fda5fa508dbdfededf17f473b00f9cc0', 'b37f96d877c63fa36e3d20bdac1cb14edfe8973001ee0c8163cfb22f4a7ce1c6', '0', '0.00', '1', 'MCFHNLK7T7MQ54EE', '1', '0', '0');
INSERT INTO `pinduoduo_client` VALUES ('6', '7bcf8d27255f6581e8cb5c27cda046cb', 'd6ca52cadeafc4bca6ab8fa9f5bb0a1b3c49a35c5cddd0b15fa76c91c6f64ff9', '0', '0.00', '30', '5NHS7NZNANTZ5OLI', '1', '2.5', '0');
INSERT INTO `pinduoduo_client` VALUES ('7', '5931813afebed66b89744098046712bd', '76c716bd5f8116f1bb766d452d48c0853ab2c6bd7243b800a9c0e694cf9eaa00', '0', '0.00', '31', '3PPCVX7SPBYHV7TY', '1', '2.8', '0');
INSERT INTO `pinduoduo_client` VALUES ('8', '5a9fd9b344ebcb8b34fe6daf63fb9ada', '3e77b8342fa185b34fed3dcb5d6f4dd26f6f70d7d57a395bf3ba1bea97f088f0', '0', '0.00', '32', '', '1', '0', '0');
INSERT INTO `pinduoduo_client` VALUES ('9', '054a957ae32e3de076445e5c08da233a', '37fcee56ac041940d0bda2daad278973ed9483049d4d830a2b0824da17360e82', '0', '0.00', '33', '', '1', '2.8', '0');

-- ----------------------------
-- Table structure for pinduoduo_config
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_config`;
CREATE TABLE `pinduoduo_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名',
  `value` varchar(255) NOT NULL DEFAULT '' COMMENT '配置值',
  `description` varchar(10) NOT NULL DEFAULT '' COMMENT '描述',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_idx` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='配置表';

-- ----------------------------
-- Records of pinduoduo_config
-- ----------------------------
INSERT INTO `pinduoduo_config` VALUES ('1', 'api_key', '6EBF91857D60DEA08B18FF97BFD8C28D', '支付平台key');
INSERT INTO `pinduoduo_config` VALUES ('2', 'cash_fee', '0.028', '提现手续费');

-- ----------------------------
-- Table structure for pinduoduo_errors
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_errors`;
CREATE TABLE `pinduoduo_errors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `admin_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员id',
  `function` varchar(100) NOT NULL DEFAULT '' COMMENT '方法名',
  `param` varchar(255) NOT NULL DEFAULT '' COMMENT '参数',
  `error` varchar(50) NOT NULL DEFAULT '' COMMENT '错误信息',
  `msg` varchar(50) NOT NULL DEFAULT '' COMMENT '错误提示',
  `datetime` datetime DEFAULT NULL COMMENT '创建日期',
  `goods` varchar(255) NOT NULL DEFAULT '' COMMENT '商品链接',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='错误表';

-- ----------------------------
-- Records of pinduoduo_errors
-- ----------------------------

-- ----------------------------
-- Table structure for pinduoduo_goods
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_goods`;
CREATE TABLE `pinduoduo_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `admin_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '代理商id',
  `stores_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '店铺id',
  `goods_name` varchar(50) NOT NULL DEFAULT '' COMMENT '商品名称',
  `goods_url` varchar(150) NOT NULL DEFAULT '' COMMENT '商品链接',
  `goods_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `sku_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '拼多多sku_id',
  `group_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '组id',
  `normal_price` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '默认价格',
  `error_count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '错误次数',
  `is_store_limit` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否超库存(0否,1是)',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态(0禁用,1启用)',
  `last_use_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后使用时间',
  `ctime` datetime DEFAULT NULL COMMENT '创建时间',
  `is_upper` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否上架(0否,1是)',
  `c_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商户id',
  `d_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '代理商id',
  PRIMARY KEY (`id`),
  KEY `goods_url_idx` (`goods_url`) USING BTREE,
  KEY `status_idx` (`status`) USING BTREE,
  KEY `is_upper_idx` (`is_upper`) USING BTREE,
  KEY `last_use_time_idx` (`last_use_time`) USING BTREE,
  KEY `c_id_idx` (`c_id`) USING BTREE,
  KEY `d_id_idx` (`d_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=471 DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Records of pinduoduo_goods
-- ----------------------------
INSERT INTO `pinduoduo_goods` VALUES ('420', '1', '44', '夏装新款时尚韩版收腰显瘦法式少女中长款荷叶边雪纺连衣裙子女潮', 'https://mobile.yangkeduo.com/goods.html?goods_id=21978497143', '21978497143', '296930019454', '17844258392', '100', '0', '0', '0', '1563868515', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('421', '1', '52', '韩婵蜗牛原液面霜补水保湿美白霜滋养嫩肤珍珠霜素颜霜', 'http://mobile.yangkeduo.com/goods.html?goods_id=25038375821&page_from=39&is_spike=0&refer_page_name=mall&refer_page_id=10039_1563865672496_gXU16quvj8&', '25038375821', '305731400666', '18373770970', '100', '0', '0', '0', '1563868496', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('422', '1', '54', '符离集特产五香酱卤味猪鼻子猪拱嘴袋特产肉食私房菜包邮', 'https://mobile.yangkeduo.com/goods.html?goods_id=22496780264', '22496780264', '298510506548', '17937008522', '1000', '0', '0', '1', '1564244108', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('423', '1', '54', '正宗内蒙古手撕风干牛肉干特产风味大片酱烤肉干麻辣原味孜然', 'https://mobile.yangkeduo.com/goods.html?goods_id=22496758928', '22496758928', '298511622563', '17937083712', '2000', '0', '0', '1', '1564354654', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('424', '1', '54', '五香熟牛鞭250克熟食下酒菜真空包装', 'https://mobile.yangkeduo.com/goods.html?goods_id=22496721839', '22496721839', '298512651342', '17937088946', '1000', '0', '0', '1', '1564399018', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('425', '1', '54', '河间驴肉驴板肠熟食现煮真空包装即食新鲜驴肠子批发卤味驴大肠', 'https://mobile.yangkeduo.com/goods.html?goods_id=22496707445', '22496707445', '298512300471', '17937145386', '1000', '0', '0', '1', '1564370910', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('426', '1', '54', '八戒猪耳朵15kg卤味熟食下酒菜即食熟食猪耳真空包装', 'https://mobile.yangkeduo.com/goods.html?goods_id=22496621680', '22496621680', '298511940945', '17937096590', '2000', '0', '0', '1', '1564404929', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('427', '1', '54', '特产酱香猪蹄卤味熟食猪手猪脚真空即食5000g含胶原蛋白', 'https://mobile.yangkeduo.com/goods.html?goods_id=22494607984', '22494607984', '298514348034', '17937251462', '800', '0', '0', '1', '1564116739', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('428', '1', '54', '风干肉木炭现款肉干7.5Kg风干超干特干特产零食', 'https://mobile.yangkeduo.com/goods.html?goods_id=22494571903', '22494571903', '298513040686', '17937129834', '800', '0', '0', '1', '1564229906', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('429', '1', '54', '酱卤味五香熟驴肉火烧五香熟驴肉熟食真空即食50000克', 'https://mobile.yangkeduo.com/goods.html?goods_id=22494495367', '22494495367', '298514397957', '17937236716', '3000', '0', '0', '1', '1564275644', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('430', '1', '54', '驴肉新鲜河北特产真空散装50000g包邮不带皮驴肉火烧新鲜生驴肉', 'https://mobile.yangkeduo.com/goods.html?goods_id=22494293991', '22494293991', '298514909735', '17937287658', '5000', '0', '0', '1', '1564271101', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('431', '1', '54', '五香驴肉300g*20  五香酱驴肉 五香酱牛肉卤味熟食', 'https://mobile.yangkeduo.com/goods.html?goods_id=22494132795', '22494132795', '298515577464', '17937411000', '500', '0', '0', '1', '1564329045', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('432', '1', '54', '牛鞭熟食卤酱五香新鲜男用即食真空非鹿羊猪鞭肾宝蛋腰', 'https://mobile.yangkeduo.com/goods.html?goods_id=22330037900', '22330037900', '297973788506', '17905295310', '500', '0', '0', '1', '1563943718', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('433', '1', '54', '清真熟食酱牛腱子牛肉酱香不塞牙闪送顺丰10斤真空', 'https://mobile.yangkeduo.com/goods.html?goods_id=22331921309', '22331921309', '297978119351', '17905489902', '500', '0', '0', '1', '1564315154', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('434', '1', '54', '特色熟食牛腱子即食牛肉牛腿肉当天现烧好吃 五香酱牛肉3斤左右', 'https://mobile.yangkeduo.com/goods.html?goods_id=22333279815', '22333279815', '297980970031', '17905706666', '500', '0', '0', '1', '1564310585', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('435', '1', '54', '【羊杂碎5斤】新鲜真空包装羊肉熟食羊心肺肝肠肚羊头肉羊杂割汤', 'https://mobile.yangkeduo.com/goods.html?goods_id=22334858808', '22334858808', '297985466581', '17906008570', '500', '0', '0', '1', '1564306583', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('436', '1', '54', '【60个熟羊肾】五香羊腰子 开袋即食新鲜男用 熟食 3000g', 'https://mobile.yangkeduo.com/goods.html?goods_id=22336156937', '22336156937', '297993908317', '17906567460', '2000', '0', '0', '1', '1564298021', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('437', '1', '54', '大牧汗 原味羊蝎子2.5kg 熟食 火锅食材 加热即食', 'https://mobile.yangkeduo.com/goods.html?goods_id=22340238392', '22340238392', '298006923018', '17907306854', '500', '0', '0', '1', '1564305133', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('438', '1', '54', '清真烤羊肉串成品熟食烧烤香辣羊肉串1500g内蒙古草原即食羊肉', 'https://mobile.yangkeduo.com/goods.html?goods_id=22343386851', '22343386851', '298007940108', '17907405610', '500', '0', '0', '1', '1564321557', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('439', '1', '54', '内蒙风干手撕肉干5000g/正宗特产香辣原味孜然', 'https://mobile.yangkeduo.com/goods.html?goods_id=22493991571', '22493991571', '298515198944', '17937377038', '500', '0', '0', '1', '1564315161', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('440', '1', '54', '五香驴肉5000g新鲜熟驴肉卤香真空即食驴肉五香牛肉', 'https://mobile.yangkeduo.com/goods.html?goods_id=22494017974', '22494017974', '298514653621', '17937338062', '500', '0', '0', '1', '1564372504', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('441', '1', '54', '熟牛蹄筋当天现做 另有牛大筋牛蹄筋新鲜牛鞭10000gSN6303', 'https://mobile.yangkeduo.com/goods.html?goods_id=22205829331', '22205829331', '297608745681', '17883574432', '4000', '0', '0', '1', '1564390712', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('442', '1', '54', '秘制筋头巴脑228g即食肉类熟食休闲零食卤味 筋头巴脑黑椒牛排', 'https://mobile.yangkeduo.com/goods.html?goods_id=22315236410', '22315236410', '297933871173', '17902773290', '500', '0', '0', '1', '1564329155', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('443', '1', '54', '甘肃平凉零食卤牛肉干熟食酱牛肉脯独立小包装牛排YFb', 'https://mobile.yangkeduo.com/goods.html?goods_id=22317461988', '22317461988', '297937613103', '17902999396', '1000', '0', '0', '1', '1564337601', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('444', '1', '54', '呼伦贝尔特产烤羊排即食熟食烤全羊烤羊排5000克+烤羊腿5000克', 'https://mobile.yangkeduo.com/goods.html?goods_id=22318758898', '22318758898', '297943848011', '17903388432', '2000', '0', '0', '1', '1564298014', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('445', '1', '54', '内蒙烤羊腿即食真空整只烧烤食材手撕烤全羊熟食羊肉4000g 5套装', 'https://mobile.yangkeduo.com/goods.html?goods_id=22321672983', '22321672983', '297947610548', '17903670180', '1000', '0', '0', '1', '1564337572', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('446', '1', '54', '特产烤羊排每日鲜碳烤即食熟食烤全羊烤羊排3000克+烤羊腿3000克', 'https://mobile.yangkeduo.com/goods.html?goods_id=22322657475', '22322657475', '297950777137', '17903869378', '2000', '0', '0', '1', '1564247872', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('447', '1', '54', '西藏特产正宗牦牛肉干散装称重年货熟食风干手撕耗牛肉干5000g', 'https://mobile.yangkeduo.com/goods.html?goods_id=22323770162', '22323770162', '297953605648', '17903994580', '2000', '0', '0', '1', '1564117857', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('448', '1', '54', '四川特产风干牛肉干手撕牦牛肉熟食麻辣牛肉耗牛肉干小吃 香辣味', 'https://mobile.yangkeduo.com/goods.html?goods_id=22325384688', '22325384688', '297957990161', '17904276402', '2000', '0', '0', '1', '1564247817', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('449', '1', '54', '牛鞭熟食 五香酱牛肉整条新鲜熟食卤牛鞭熟男用零食熟牛宝即食', 'https://mobile.yangkeduo.com/goods.html?goods_id=22326702490', '22326702490', '297961371271', '17904489450', '500', '0', '0', '1', '1564360215', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('450', '1', '54', '西藏牦牛鞭酱卤牦牛鞭牛鞭熟食牦牛鞭男用即食牦牛鞭', 'https://mobile.yangkeduo.com/goods.html?goods_id=22327213773', '22327213773', '297969230974', '17904957642', '500', '0', '0', '1', '1564160937', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('451', '1', '54', '黑椒风味牛排 2700g 西餐牛排 烤牛排 西餐原料', 'https://mobile.yangkeduo.com/goods.html?goods_id=21983557660', '21983557660', '297580836622', '17882095400', '500', '0', '0', '1', '1564160939', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('452', '1', '54', '安格斯choice三角牛小排整件原切油花均匀【1kg】3份套装包邮', 'https://mobile.yangkeduo.com/goods.html?goods_id=21983315338', '21983315338', '296945291741', '17883412230', '500', '0', '0', '1', '1564400279', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('453', '1', '54', '上脑牛排10片 共3000g厚切上脑原切大雪花健身牛肉鲜嫩实惠', 'https://mobile.yangkeduo.com/goods.html?goods_id=21983065863', '21983065863', '296944486439', '17883359930', '1000', '0', '0', '1', '1564271111', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('454', '1', '54', 'ANGUS PICANHA 澳洲进口原切安格斯谷饲臀腰肉盖牛肉牛扒 1.8Kg', 'https://mobile.yangkeduo.com/goods.html?goods_id=21983022142', '21983022142', '296943920416', '17883302852', '500', '0', '0', '1', '1564394443', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('455', '1', '54', '原切牛排澳洲西冷M8M9雪花牛肉引进日本和牛新鲜厚切牛扒500g', 'https://mobile.yangkeduo.com/goods.html?goods_id=21982750844', '21982750844', '296943552911', '17883444400', '500', '0', '0', '1', '1564372518', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('456', '1', '54', '黑椒肉排冷冻半成品食材批发40斤外卖牛排食品饭堂江浙沪皖包邮', 'https://mobile.yangkeduo.com/goods.html?goods_id=21980674943', '21980674943', '296937472096', '17883419740', '500', '0', '0', '1', '1564309744', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('457', '1', '54', '澳洲菲力西冷黑椒牛排30片4500g 家庭套餐 礼盒包顺丰包邮', 'https://mobile.yangkeduo.com/goods.html?goods_id=21980601065', '21980601065', '297607568622', '17883462832', '1000', '0', '0', '1', '1564247627', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('458', '1', '54', '新鲜法式羊排羊小排小切羊扒12肋羔羊肉骨烧烤食材半成品10g', 'https://mobile.yangkeduo.com/goods.html?goods_id=26881651217', '26881651217', '311642686488', '18742032104', '100', '0', '0', '1', '1564410451', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('459', '1', '54', '烤羊腿内蒙古羊肉呼伦贝尔特产烤羊排每日鲜碳烤即食熟食30g', 'https://mobile.yangkeduo.com/goods.html?goods_id=26881613230', '26881613230', '311646947420', '18742215942', '300', '0', '0', '1', '1564363814', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('460', '1', '54', '小牛法式羊排烧烤半成品羊肉新鲜羔羊排西餐食材羊扒20g', 'https://mobile.yangkeduo.com/goods.html?goods_id=26881544960', '26881544960', '311645193805', '18742080986', '200', '0', '0', '1', '1564400139', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('461', '1', '54', '骄子牧场速食羊杂汤内蒙古羊肉汤即食熟食小吃', 'https://mobile.yangkeduo.com/goods.html?goods_id=26881504932', '26881504932', '311662339544', '18743173702', '400', '0', '0', '1', '1564405212', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('462', '1', '54', '无骨羊肉新鲜包装新疆草原牧区绵羊后腿烤肉串馅料用包邮60g', 'https://mobile.yangkeduo.com/goods.html?goods_id=26881494566', '26881494566', '311651171971', '18742478736', '600', '0', '0', '1', '1564381687', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('463', '1', '54', '内蒙羊肉新鲜10斤 羊杂羊腿羊排羊脊骨可带皮包邮', 'https://mobile.yangkeduo.com/goods.html?goods_id=26881485310', '26881485310', '311655760047', '18742843146', '900', '0', '0', '1', '1564308720', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('464', '1', '54', '大别山高山放养黑山羊肉 农家散养土羊 带皮羊肉 羊腿80g', 'https://mobile.yangkeduo.com/goods.html?goods_id=26881467952', '26881467952', '311654235213', '18742755014', '800', '0', '0', '1', '1564117255', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('465', '1', '54', '小尾羊 内蒙古羔羊肉新鲜冷冻生羊腿 烧烤食材羊后腿40g', 'https://mobile.yangkeduo.com/goods.html?goods_id=26881463132', '26881463132', '311649303960', '18742362932', '400', '0', '0', '1', '1564312314', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('466', '1', '54', '手抓羊肉内蒙古锡盟草原散养羔羊肉羊腿羊排肉70g', 'https://mobile.yangkeduo.com/goods.html?goods_id=26881438388', '26881438388', '311652606406', '18742616358', '700', '0', '0', '1', '1564213534', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('467', '1', '54', '小尾羊 内蒙古羔羊肉新鲜冷冻生羊腿 烧烤食材羊后腿4斤包邮', 'https://mobile.yangkeduo.com/goods.html?goods_id=26867223281', '26867223281', '311658841350', '18743046282', '300', '0', '0', '1', '1564373157', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('468', '1', '54', '内蒙古带骨羊排0.1kg 烧烤食材 小羊排 羊肉', 'https://mobile.yangkeduo.com/goods.html?goods_id=26867215321', '26867215321', '311663886561', '18743291424', '100', '0', '0', '1', '1564391513', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('469', '1', '54', '手抓羊肉1斤内蒙草原散养羔羊肉羊腿羊排肉', 'https://mobile.yangkeduo.com/goods.html?goods_id=26867183227', '26867183227', '311660787975', '18743085650', '200', '0', '0', '1', '1564351289', null, '0', '0', '0');
INSERT INTO `pinduoduo_goods` VALUES ('470', '32', '56', '2019夏季新款短袖T恤男韩版青年红色本命年圆领半袖潮流体恤上衣', 'https://mobile.yangkeduo.com/goods2.html?goods_id=28676755519', '28676755519', '315789091182', '19005217828', '100', '0', '0', '1', '1564649074', null, '0', '8', '0');

-- ----------------------------
-- Table structure for pinduoduo_jobs
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_jobs`;
CREATE TABLE `pinduoduo_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pinduoduo_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for pinduoduo_orders
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_orders`;
CREATE TABLE `pinduoduo_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `admin_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员id',
  `staff_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '员工id',
  `order_sn` char(100) NOT NULL DEFAULT '''''' COMMENT '订单编号',
  `api_order_sn` char(64) NOT NULL DEFAULT '' COMMENT 'api调用者生成的订单编号',
  `ip` varchar(15) NOT NULL DEFAULT '''''' COMMENT 'ip地址',
  `fp_id` char(43) NOT NULL DEFAULT '''''' COMMENT '拼多多fp_id',
  `total` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '总价',
  `is_pay` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否支付(0否,1是)',
  `notify_url` varchar(200) NOT NULL DEFAULT '''''' COMMENT '通知url',
  `is_notify` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否通知(0未通知,1已通知)',
  `pay_type` tinyint(2) unsigned NOT NULL DEFAULT '9' COMMENT '支付方式(9支付宝,38微信)',
  `from_platform` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '来自哪个平台(1自行出码,2支付平台)',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '订单状态(0待付款,1待发货,2待收货,3待评价,4交易已取消)',
  `do` tinyint(1) NOT NULL DEFAULT '0',
  `mtime` datetime DEFAULT NULL COMMENT '修改日期',
  `ctime` datetime DEFAULT NULL COMMENT '创建日期',
  `g_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `c_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商户id',
  `p_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '通道id',
  `d_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '代理商id',
  `notify_status` int(11) NOT NULL DEFAULT '2',
  `notify_number` int(11) NOT NULL DEFAULT '0',
  `notify_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_sn_idx` (`order_sn`) USING BTREE,
  KEY `is_pay_idx` (`is_pay`) USING BTREE,
  KEY `admin_uid_idx` (`admin_uid`) USING BTREE,
  KEY `g_id_idx` (`g_id`) USING BTREE,
  KEY `user_id_idx` (`user_id`) USING BTREE,
  KEY `c_id` (`c_id`) USING BTREE,
  KEY `status_idx` (`status`) USING BTREE,
  KEY `api_order_sn_idx` (`api_order_sn`) USING BTREE,
  KEY `pay_type_idx` (`pay_type`) USING BTREE,
  KEY `p_id_idx` (`p_id`) USING BTREE,
  KEY `d_id_idx` (`d_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=181518 DEFAULT CHARSET=utf8 COMMENT='订单表';

-- ----------------------------
-- Records of pinduoduo_orders
-- ----------------------------
INSERT INTO `pinduoduo_orders` VALUES ('181357', '1', '0', '190706-219455161373115', '', '61.157.137.62', 'zH_xkYzO-NhG2SwpS7mxTR-E2rqOyPjwqZtqL4AkdZQ', '100', '0', '', '0', '38', '1', '0', '0', '2019-07-06 10:09:09', '2019-07-06 10:08:35', '420', '2905', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181358', '1', '0', '190723-586374513773057', '', '180.171.177.180', 'A_hsLFxFMyeT5Z0u0zYrSLALm4pEYMqr-h4hwCaSpU8', '100', '0', '', '0', '9', '1', '0', '0', '2019-07-23 15:50:33', '2019-07-23 14:21:40', '420', '2906', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181359', '1', '0', '190723-139777147693057', '', '222.89.215.149', 'yNiGp15dqei7_pi0PyufQid1RRuu_G8Kv5meIlv57kM', '100', '0', '', '0', '38', '1', '0', '0', '2019-07-23 16:09:29', '2019-07-23 14:22:32', '420', '2906', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181360', '1', '0', '190723-444613591933057', '', '42.200.180.44', 'haIoWyEHPgeNIJTpIPcwocx3QQi0WkTWmMyINyVvQqA', '5000', '0', '', '0', '9', '1', '0', '0', '2019-07-23 15:50:32', '2019-07-23 14:49:59', '420', '2906', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181361', '1', '0', '190723-566716335313057', '', '42.200.180.44', '3VhQ7OSN3ofyjMs2_omLixyj2ay-PDbYNUp5sgXk1qc', '100', '0', '', '0', '9', '1', '0', '0', '2019-07-23 15:50:31', '2019-07-23 14:50:46', '420', '2906', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181362', '1', '0', '190723-466655970333057', '', '120.85.112.79', 'S9xbTb1ocQ5RKby-3rdM9-Lmi61WFKqEuuUtfEDDeco', '100', '0', '', '0', '38', '1', '0', '0', '2019-07-23 15:50:29', '2019-07-23 14:52:23', '420', '2906', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181363', '1', '0', '190723-071015137933057', '', '120.85.112.79', 'rXw15OVO9hvur6zoAb07OPeZqnq2UJdVyMp0imvC1hA', '100', '0', '', '0', '9', '1', '0', '0', '2019-07-23 15:50:28', '2019-07-23 15:05:47', '420', '2906', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181364', '1', '0', '190723-676883497991246', '', '123.146.254.63', '731kSHLzL6WMIHZZoLS-ZBo9fDlQgwZFs-VgxfIj7kM', '500', '0', '', '0', '9', '1', '4', '0', '2019-07-26 14:38:41', '2019-07-23 20:35:24', '442', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181365', '1', '0', '190723-489848996530600', '', '123.146.254.63', 'o9edth6_Os6nV-HgXi7_seUSlQ3jcPVEVYQn-LOKZaA', '1000', '0', '', '0', '38', '1', '0', '0', '2019-07-23 23:57:50', '2019-07-23 21:57:57', '422', '2908', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181366', '1', '0', '190723-534469837873525', '', '123.146.254.63', 'nHtJjCnBMFl394Ompdx4-lh-2JpZflaeGjZABRq3rF8', '500', '0', '', '0', '9', '1', '0', '0', '2019-07-24 00:17:54', '2019-07-23 22:22:53', '449', '2909', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181367', '1', '0', '190723-493003899873550', '', '45.117.40.123', 'V6_TuEJi0u5IUK0-zDjnDi4ZUxUexiYIXQ7eoNxki5Q', '1000', '0', '', '0', '9', '1', '0', '0', '2019-07-24 00:53:01', '2019-07-23 22:56:59', '457', '2910', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181368', '1', '0', '190723-579078881972550', '', '123.146.254.63', 'TZmCBViyGJMdtP0FnIJoak1G5dR17_JqSGpDvPA6l1k', '5000', '0', '', '0', '9', '1', '0', '0', '2019-07-24 01:23:05', '2019-07-23 23:24:38', '440', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181369', '1', '0', '190723-676001383071748', '', '123.146.254.63', 'A2TiahSfgdnijnvNe6hHm4Z1gwmpV4IsLjFqK_bUwbw', '2000', '0', '', '0', '9', '1', '0', '0', '2019-07-24 01:28:06', '2019-07-23 23:30:08', '455', '2912', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181370', '1', '0', '190723-057190810751631', '', '123.146.254.63', 'SDdOmciqH_lSlEPp6VdDOPeWdZuJ5xMmUhZG6H9KpMo', '500', '0', '', '0', '9', '1', '0', '0', '2019-07-24 01:28:06', '2019-07-23 23:31:07', '454', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181371', '1', '0', '190724-009949676331246', '', '60.246.231.40', 'GZlbh_992U30hv3fjrT01CNowhGR-eJQZDEs-TVDXzw', '2000', '0', '', '0', '9', '1', '0', '0', '2019-07-24 02:58:16', '2019-07-24 00:58:29', '453', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181372', '1', '0', '190724-294782239550600', '', '60.246.231.40', '2xg5lq49d8jnBZ1Aio0WmuOPoheUWeSCjJvZo9sQ_6Q', '5000', '0', '', '0', '9', '1', '0', '0', '2019-07-24 03:33:20', '2019-07-24 01:35:30', '452', '2908', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181373', '1', '0', '190724-569409536692550', '', '60.246.231.40', 'pQNYLVd_LMxEWjxYuGfc3OSFjOSuqP8IZRJWn7b77wc', '15000', '0', '', '0', '9', '1', '0', '0', '2019-07-24 03:43:20', '2019-07-24 01:45:50', '437', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181374', '1', '0', '190724-208943186711748', '', '60.246.231.40', 'VIEWwmHkrhE7RdpvK0v2KxLVxFABpip2kZ1M444AngI', '2000', '0', '', '0', '9', '1', '4', '0', '2019-07-26 14:38:41', '2019-07-24 02:23:31', '448', '2912', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181375', '1', '0', '190724-686443725531631', '', '60.246.231.40', 'ZWHvErXRz0aRfTFRzfE6deDPiuBX64Nb9VogDQ7xxV4', '1000', '0', '', '0', '9', '1', '4', '0', '2019-07-26 14:38:41', '2019-07-24 03:08:45', '435', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181376', '1', '0', '190724-247394468951246', '', '60.246.231.40', 'tJD8yXEieyC_an8-vLiOk6nfoFtnbUU9cZutVEOVa2s', '1000', '0', '', '0', '9', '1', '0', '0', '2019-07-24 06:43:29', '2019-07-24 04:45:30', '456', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181377', '1', '0', '190724-438410936990600', '', '60.246.231.40', 'RjCRgnQ-G6-IyAeCzUyQst5ysrg33NKc5Ma7utYwdP4', '5000', '0', '', '0', '9', '1', '0', '0', '2019-07-24 07:53:33', '2019-07-24 05:53:59', '445', '2908', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181378', '1', '0', '190724-052633928652550', '', '123.146.113.191', 'pBxrKlQOARm1lbFPSN5rvfTlaFE8Qh8Sg52voMTMVXI', '500', '0', '', '0', '38', '1', '4', '0', '2019-07-26 14:38:41', '2019-07-24 10:49:23', '434', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181379', '1', '0', '190724-220073820991748', '', '123.146.113.191', 'dtaLcNsNvJ2OqPBZ0vxJIs9u6Nvk0K7f_o3eNKFQsPA', '3000', '0', '', '0', '9', '1', '0', '0', '2019-07-24 13:03:42', '2019-07-24 11:05:24', '443', '2912', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181380', '1', '0', '190724-451081012451246', '', '85.203.47.8', 'Ufd1WHro1YsPMsY6iEMCK1bREENOQXhju9nsZ9oWQNs', '2000', '0', '', '0', '9', '1', '0', '0', '2019-07-24 14:43:53', '2019-07-24 12:48:39', '433', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181381', '1', '0', '190724-474333184710600', '', '123.55.49.197', 'YKO1RyT3L_--VAPqAu7B-0fQLEJU80FaCVhsHqqx56M', '500', '0', '', '0', '38', '1', '0', '0', '2019-07-24 16:29:03', '2019-07-24 14:33:20', '439', '2908', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181382', '1', '0', '190724-083660964732550', '', '85.203.47.8', 'mRlcP2Jq3tgUh8kcor0gHUSvhZSyxeNZYB1J0kq_6b4', '10000', '0', '', '0', '9', '1', '0', '0', '2019-07-24 16:54:04', '2019-07-24 14:54:18', '438', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181383', '1', '0', '190724-471695688431748', '', '123.146.113.191', 'eNmbHmIU5flfYTuBRXWLLlR4Pqg4-LFf3JHUzy6BTP4', '1000', '0', '', '0', '9', '1', '4', '0', '2019-07-26 14:38:41', '2019-07-24 17:54:48', '431', '2912', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181384', '1', '0', '190724-266595369772665', '', '123.146.203.120', 'Uhf9e0U-nOyznX88yIhi_jEaf8BlHMq6HRnVhI6wEjw', '20000', '0', '', '0', '9', '1', '0', '0', '2019-07-25 00:29:15', '2019-07-24 22:29:23', '430', '2914', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181385', '1', '0', '190724-629797192393525', '', '123.146.203.120', '7SCChl9l_UOUPBkQ91IhMugofJ_EJZVc_jxuJqyoBVU', '6500', '0', '', '0', '9', '1', '4', '0', '2019-07-26 14:38:40', '2019-07-24 22:37:23', '442', '2909', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181386', '1', '0', '190724-055566828313550', '', '123.146.203.120', 'bZIkdONQ4kQ58erPpEQEzmdHlbxHZEu5pijZnL2Hz1M', '10000', '0', '', '0', '9', '1', '4', '0', '2019-07-26 14:38:40', '2019-07-24 22:53:16', '446', '2910', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181387', '1', '0', '190725-673343079551631', '', '123.146.203.120', 'ngxvDBoxSkgtBv2P8UlBG1SBUYhsVMhnfN7HGQ7aaTI', '5000', '0', '', '0', '9', '1', '0', '0', '2019-07-25 02:29:30', '2019-07-25 00:30:25', '425', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181388', '1', '0', '190725-573408543531246', '', '123.146.203.120', 'aMjK-jR9zWHc_QbFhyI63xA8ZoEpuSTd4DbqX3_gxPM', '5000', '0', '', '0', '38', '1', '4', '0', '2019-07-26 14:38:40', '2019-07-25 00:34:22', '424', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181389', '1', '0', '190725-674955264710600', '', '123.146.203.120', 'eCi6zGDtPrNbknAbguDqH6RKWtlATzuXZSVBjbcrMJ4', '5000', '0', '', '0', '9', '1', '0', '0', '2019-07-25 02:44:31', '2019-07-25 00:47:21', '422', '2908', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181390', '1', '0', '190725-409868698852550', '', '123.146.203.120', 'n8fng7-wwkIo-SAHpZnOiLJiIuyCZ-TEf7H9mKuymmY', '5000', '0', '', '0', '9', '1', '0', '0', '2019-07-25 02:59:32', '2019-07-25 01:02:19', '449', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181391', '1', '0', '190725-019300353091748', '', '45.117.40.248', 'iwuC2MliZhIEie9A7ExaMPCpeVQ6DPqwuO0B-AItxpQ', '5000', '0', '', '0', '9', '1', '4', '0', '2019-07-26 14:38:40', '2019-07-25 04:12:51', '457', '2912', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181392', '1', '0', '190725-632601969832665', '', '45.117.40.248', 'I7M195XRxdl8vt_OXLu8lMFEkn2UYnQBQkLad2FUFL4', '5000', '0', '', '0', '9', '1', '4', '0', '2019-07-26 14:38:40', '2019-07-25 04:26:31', '440', '2914', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181393', '1', '0', '190725-316169258053525', '', '45.117.40.248', 'Jq81SISaynTeJeR9Wl0vJTB0Ilk6mh6aAxUjt0ksGLM', '4000', '0', '', '0', '9', '1', '4', '0', '2019-07-26 14:38:40', '2019-07-25 04:46:25', '441', '2909', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181394', '1', '0', '190725-236255970313550', '', '45.117.40.248', 'j87NoNV1xtZb5E20P3Am3J6xU5ZkLm_CNL6neqyCmf8', '4000', '0', '', '0', '9', '1', '4', '0', '2019-07-26 14:38:39', '2019-07-25 05:51:26', '444', '2910', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181395', '1', '0', '190725-608807158791631', '', '45.117.40.248', 'AhHO22OHGZ1ga0B9TYpcuwwp-zFRfP_x-khBEQyO49A', '5000', '0', '', '0', '9', '1', '4', '0', '2019-07-26 14:38:39', '2019-07-25 06:14:56', '455', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181396', '1', '0', '190725-548875797371246', '', '45.117.40.248', 'rncHE4mQYhLdnWwt5CC0oL_GVopcMikvx3ipeFDqXvU', '3000', '0', '', '0', '9', '1', '4', '0', '2019-07-26 14:38:39', '2019-07-25 06:31:41', '429', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181397', '1', '0', '190725-669095035790600', '', '45.117.40.248', 'xG4q7bq7KeuExwRQK6hov13RczEulNnx94COssWglMM', '3000', '0', '', '0', '38', '1', '4', '0', '2019-07-26 14:38:39', '2019-07-25 07:50:40', '454', '2908', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181398', '1', '0', '190725-500820214433550', '', '85.203.47.167', 'odssp25o5SPdQeDSR2mJJ5vzDsravnRo2dg3WSxLBio', '1300', '0', '', '0', '9', '1', '0', '0', '2019-07-25 18:39:54', '2019-07-25 16:41:26', '458', '2910', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181399', '1', '0', '190725-360714404851631', '', '85.203.47.167', 'DkJqHSemxgZVFRQlBOA7w3Cq-4N6JBegn1mnE0sStZI', '1800', '0', '', '0', '9', '1', '4', '0', '2019-07-26 13:58:38', '2019-07-25 16:59:44', '460', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181400', '1', '0', '190725-078723482611246', '', '85.203.47.167', 'qWJ5t-fbiYwjsRKRPl1BicclEYcCMZC68U0ita7mIM8', '3000', '0', '', '0', '9', '1', '4', '0', '2019-07-26 13:58:38', '2019-07-25 17:00:29', '459', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181401', '1', '0', '190725-293395825810600', '', '123.146.203.120', 'AoZDgvRUYRJl-_vG_dZCD2Rx3MsmcTF-j3HpZv-Y9NA', '5000', '0', '', '0', '9', '1', '0', '0', '2019-07-25 20:15:04', '2019-07-25 18:19:52', '469', '2908', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181402', '1', '0', '190725-491566203592550', '', '123.146.203.120', 'tojhuhqkGphVZwFTR3d8_GXxwnAlFL5hi_33D9mytmA', '1200', '0', '', '0', '9', '1', '0', '0', '2019-07-25 20:35:05', '2019-07-25 18:37:35', '462', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181403', '1', '0', '190726-684890522771748', '', '14.108.156.96', 'LTIqNDKEotCQNIqtsAKc5y_xwijKb4ltMesCN70jIrA', '2000', '0', '', '0', '9', '1', '0', '0', '2019-07-26 03:10:16', '2019-07-26 01:13:48', '436', '2912', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181404', '1', '0', '190726-148148716452665', '', '123.144.211.252', 'gjQnaugoE0RntQYmICpyqUypGPIyINC1m1cLwU6yktc', '20000', '0', '', '0', '9', '1', '4', '0', '2019-07-26 13:58:38', '2019-07-26 12:52:20', '427', '2914', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181405', '1', '0', '190726-013058048833525', '', '123.144.211.252', 'YpqLZOirJ2CFJ5Ye7uFgfIKN6YuNGMOmwsFvcD3QaQk', '20000', '0', '', '0', '9', '1', '4', '0', '2019-07-26 13:58:38', '2019-07-26 13:00:55', '464', '2909', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181406', '1', '0', '190726-410802586591631', '', '123.144.211.252', 'tH8aGMpdGo4HTvFxsOcd6U7qWgEks3YzVXZ0V6FPaEw', '20000', '0', '', '0', '9', '1', '4', '0', '2019-07-26 13:55:25', '2019-07-26 13:11:00', '465', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181407', '1', '0', '190726-493532939193550', '', '123.144.211.252', 'u6FlAX_v_5-gTelgGoz9p7O4NEjtZG5FHvsbxI_5CkI', '1000', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:32', '2019-07-26 23:30:47', '468', '2910', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181408', '1', '0', '190726-635211777092550', '', '123.144.211.252', 'Gs6mjKTPF5p0PD2kL-mwoSxOUWXeB8Ehbr9vlyaEjPA', '2000', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:32', '2019-07-26 23:59:28', '461', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181409', '1', '0', '190727-137598075953550', '', '123.144.211.252', 'tQRAqZcheBChsGUJFIBWHWNHmHUeWZx3xH0KCqKnh9E', '600', '0', '', '0', '9', '1', '0', '0', '2019-07-27 02:35:50', '2019-07-27 00:38:22', '467', '2910', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181410', '1', '0', '190727-214428550172550', '', '123.144.211.252', 'Yf1cxRJkwqV3Q-285O6pPRBh6c13i8hr2sjWlV9WR-Y', '600', '0', '', '0', '9', '1', '0', '0', '2019-07-27 02:40:51', '2019-07-27 00:40:57', '458', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181411', '1', '0', '190727-070613730133550', '', '123.144.211.252', 'JwCj6KLbHpp_TpKfIyVTkFynYS9mL7HgaaD7ZwnEAk4', '600', '0', '', '0', '38', '1', '4', '0', '2019-07-30 18:00:32', '2019-07-27 00:41:15', '460', '2910', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181412', '1', '0', '190727-661256930072550', '', '123.144.211.252', 'QI0xzB5C-jtS0jTgIJuFB96Pvupaw9krOdushgjzeVE', '600', '0', '', '0', '38', '1', '0', '0', '2019-07-27 02:50:52', '2019-07-27 00:52:46', '459', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181413', '1', '0', '190727-666322862833550', '', '123.144.211.252', 'tH6RrF4yVOILE0_tGx-HXmze9wHVhmgza9CdcUHHC3c', '1000', '0', '', '0', '38', '1', '4', '0', '2019-07-30 18:00:32', '2019-07-27 01:06:23', '453', '2910', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181414', '1', '0', '190727-478054974471246', '', '123.144.211.252', 'XUzhp2KVPEH2SA3QY8k_yPMZmiRwvciBk6Sr4s1JzSg', '1500', '0', '', '0', '38', '1', '0', '0', '2019-07-27 03:05:53', '2019-07-27 01:08:49', '452', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181415', '1', '0', '190727-012113675031246', '', '123.144.211.252', 'BTx8EVOQDkucwcmt3vHct_Q_Zihni7OO5pycY5ttk1Y', '1500', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:32', '2019-07-27 01:09:01', '437', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181416', '1', '0', '190727-675669607092550', '', '123.144.211.252', 'S2CYRChV4BExsLIKwtbM7lrlqaKdJp1rLPieD0WGF9M', '500', '0', '', '0', '38', '1', '4', '0', '2019-07-30 18:00:32', '2019-07-27 01:11:50', '435', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181417', '1', '0', '190727-086002893611631', '', '123.144.211.252', 'Km0dNxrVO-k8KWBsnnG5Ei1EVSaDcgrdGedPZ9RGOxs', '300', '0', '', '0', '38', '1', '4', '0', '2019-07-30 18:00:32', '2019-07-27 01:27:12', '468', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181418', '1', '0', '190727-125949706933550', '', '123.144.211.252', '7jlZ1mUYIdUrX1BQrDbo4f8h0sQJ-BEa6bcFraFu_Bk', '300', '0', '', '0', '38', '1', '4', '0', '2019-07-30 18:00:31', '2019-07-27 01:54:05', '467', '2910', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181419', '1', '0', '190727-557046825991246', '', '123.144.211.252', 'tJN82o1hvbc7ybPtF4SGFmYEvPI_PNTGCHi-L-wTPWQ', '300', '0', '', '0', '38', '1', '4', '0', '2019-07-30 18:00:31', '2019-07-27 03:13:00', '458', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181420', '1', '0', '190727-195278931172550', '', '123.144.211.252', 'u9I2Mvo15PzI6y7xkFTktaCB8MsUHxjWvIjFYnObvPU', '500', '0', '', '0', '38', '1', '4', '0', '2019-07-30 18:00:31', '2019-07-27 03:25:04', '456', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181421', '1', '0', '190727-474851574791631', '', '123.144.211.252', '_bFOsBSBmsYWE2N9MI3tDGiKtLrDSSYkx-MsX_pIFl0', '300', '0', '', '0', '38', '1', '4', '0', '2019-07-30 18:00:31', '2019-07-27 04:19:12', '459', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181422', '1', '0', '190727-224894649293550', '', '123.144.211.252', 'J6POKfV5YnswgjdrCpNPWORMWKQm_uzpnrrCtIjS8K0', '100', '0', '', '0', '38', '1', '0', '0', '2019-07-27 06:41:06', '2019-07-27 04:41:07', '468', '2910', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181423', '1', '0', '190727-297977775251246', '', '123.144.211.252', 'IoGPYewe_JQpOk0wPLKXzcZYbppvcz1u5gR1ZXDYlUI', '300', '0', '', '0', '38', '1', '0', '0', '2019-07-27 07:41:14', '2019-07-27 05:43:42', '467', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181424', '1', '0', '190727-022211461832550', '', '123.144.211.252', 'BlGG2BnBuIAPCisbkyT21_gLViuILXRLh0KGhC0W7FM', '400', '0', '', '0', '38', '1', '4', '0', '2019-07-30 18:00:31', '2019-07-27 05:43:56', '469', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181425', '1', '0', '190727-572239381551631', '', '123.144.211.252', 'RFiiu4lihA2gMgIlftjdQ8qrQ91Kh6I8lJj4sAIb7OM', '400', '0', '', '0', '9', '1', '0', '0', '2019-07-27 07:46:15', '2019-07-27 05:47:15', '465', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181426', '1', '0', '190727-408567153473550', '', '123.144.211.252', 'MQyioww-coKfgGDZ2_8EziIE69ec3I3UfJURZ03mE1U', '500', '0', '', '0', '38', '1', '4', '0', '2019-07-30 18:00:31', '2019-07-27 06:03:37', '434', '2910', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181427', '1', '0', '190727-264454800531246', '', '123.144.211.252', 'Y6sifcVjP7TCYAPvEzOYM49P9sWZXnh2lPs-P6Fr5sQ', '500', '0', '', '0', '38', '1', '4', '0', '2019-07-30 18:00:31', '2019-07-27 07:05:21', '433', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181428', '1', '0', '190727-582747423792550', '', '123.144.211.252', '7wrJ1dokdZOmCJYJ94z7dcP9z-uJl1BB8633WdWFCA0', '200', '0', '', '0', '38', '1', '4', '0', '2019-07-30 18:00:31', '2019-07-27 07:10:05', '460', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181429', '1', '0', '190727-234105078711631', '', '123.144.211.252', 'iwwP1IjkgT52yHJlL2qHe_EE8XuGshxJhCqk9e8RZdg', '2000', '0', '', '0', '9', '1', '0', '0', '2019-07-27 10:41:25', '2019-07-27 08:45:15', '423', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181430', '1', '0', '190727-029434839753550', '', '123.144.211.252', 'BbAYlRnZAzuPaE3mjqegyyp6TR8OLJkDlVQo3UROB3g', '5500', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:30', '2019-07-27 09:12:50', '439', '2910', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181431', '1', '0', '190727-216854692752550', '', '123.144.211.252', 'bNEzJjWHo_6MRpiCvuj_Wl7Lc7sAcfCFs9c3msuouk8', '500', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:30', '2019-07-27 09:20:29', '438', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181432', '1', '0', '190727-496104899331631', '', '123.144.211.252', 'OJVI479QAl9WJ_lfz8avKQRTwNChC3CGAibs8_9t44I', '3000', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:30', '2019-07-27 09:41:50', '445', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181433', '1', '0', '190727-459797955593550', '', '123.144.211.252', 'Rg3QVEcwDrkU7GkMFWdmmrtg5xxSe5DmCMWJSjbLV1U', '3000', '0', '', '0', '9', '1', '0', '0', '2019-07-27 11:46:30', '2019-07-27 09:51:04', '443', '2910', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181434', '1', '0', '190727-405256274872550', '', '123.144.211.252', 'EelYpDxVpf-N0dYHyKkDEz_a5MDYimKr0w5u6OkZyXI', '3000', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:25', '2019-07-27 09:51:26', '431', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181435', '1', '0', '190727-417569178771631', '', '123.144.211.252', 'gqihKHZEP0MCSLSw5ATawIoigzxa0o5iQgYM3FB48rQ', '3000', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:25', '2019-07-27 10:10:02', '442', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181436', '1', '0', '190727-201066414770600', '', '123.144.211.252', 'M_h54C1hk33sVcIxY_1q7kwxNFX9CaA-9uIHv1nuCp0', '1500', '0', '', '0', '9', '1', '0', '0', '2019-07-27 13:01:36', '2019-07-27 11:06:07', '449', '2908', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181437', '1', '0', '190727-447169823873525', '', '123.144.211.252', '3aJ0qWV7C3SUeP9QTRqALYEaeXBaZRS2mEiG3nPQ0QI', '1000', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:25', '2019-07-27 11:20:24', '425', '2909', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181438', '1', '0', '190727-476457861931246', '', '123.144.211.252', 'pV3QcmQjH_15puwKGKUU-oJnC-7Xn0Y_QoqcREeth-I', '1100', '0', '', '0', '9', '1', '0', '0', '2019-07-27 14:11:45', '2019-07-27 12:16:16', '458', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181439', '1', '0', '190727-193663468693550', '', '123.144.211.252', 'NFMARLEDMOTLhZF8et8xEGOrrhWFPKO7ZuGRBglzndI', '2000', '0', '', '0', '9', '1', '0', '0', '2019-07-27 15:21:55', '2019-07-27 13:22:29', '426', '2910', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181440', '1', '0', '190727-628184187532665', '', '123.144.211.252', 'KZAQoozMbg4VHAN5W2vftHXnIsZU_RGivdQxqmLqShQ', '1000', '0', '', '0', '9', '1', '0', '0', '2019-07-27 15:21:55', '2019-07-27 13:23:40', '424', '2914', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181441', '1', '0', '190727-244716995552550', '', '123.144.211.252', 'zPGD1waTF5k1vVoh28fxxSFs391MDYeinx0pyL3fppE', '200', '0', '', '0', '38', '1', '0', '0', '2019-07-27 16:37:01', '2019-07-27 14:42:01', '468', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181442', '1', '0', '190727-038692782971631', '', '123.144.211.252', 'menUt6B1tNTTM7fg4M1VCEtAuA-1AXS8qdnfl62q7Yk', '500', '0', '', '0', '38', '1', '4', '0', '2019-07-30 18:00:25', '2019-07-27 14:59:21', '440', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181443', '1', '0', '190727-215908680850600', '', '123.144.211.252', 'FS-uEa3Ya7P25av3JEp4XuaeofkJMvoJGsjnhlwxGtM', '700', '0', '', '0', '38', '1', '0', '0', '2019-07-27 17:42:05', '2019-07-27 15:45:34', '466', '2908', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181444', '1', '0', '190727-655682766013525', '', '123.144.211.252', 'X95b4GTghGxNuhIxU0kyFs0XR1yvT_aiRG6akmqwu-w', '2800', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:24', '2019-07-27 16:15:37', '461', '2909', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181445', '1', '0', '190727-316207596251246', '', '123.144.211.252', 'EWxKEug8xYsinazsty7H6t84pLHEd2-HuzX0rL1bs1Y', '800', '0', '', '0', '9', '1', '0', '0', '2019-07-27 22:17:14', '2019-07-27 20:18:27', '428', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181446', '1', '0', '190727-387966239873550', '', '123.144.211.252', 'zh09kj-veS3mPbGyTtUjLODgIEO0n7gy-s_YReGNtfE', '300', '0', '', '0', '9', '1', '4', '0', '2019-07-27 21:59:03', '2019-07-27 20:34:59', '459', '2910', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181447', '1', '0', '190728-065184727912665', '', '123.144.211.252', '0XbQWjoVPd29VV-iKrm3wVDQ_ujh6cWLeE0KeDQVKUA', '3000', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:24', '2019-07-28 00:15:09', '422', '2914', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181448', '1', '0', '190728-161864745732550', '', '123.144.211.252', 'fVkhpqTkcSzmkaIGSsDsNaYqWEXg3f22Fv37bc9W5VM', '3000', '0', '', '0', '9', '1', '0', '0', '2019-07-28 03:12:38', '2019-07-28 01:13:48', '457', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181449', '1', '0', '190728-388518380451631', '', '123.144.211.252', 'Z_jptuD7N6aHmL04T2fVTQmz_idVQRoM4r6e98EP3Ys', '2000', '0', '', '0', '9', '1', '0', '0', '2019-07-28 03:12:38', '2019-07-28 01:16:57', '448', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181450', '1', '0', '190728-661154694170600', '', '123.144.211.252', 'hzV950hmDhXamjCCidiS21H0r6NGRcxvvY5GN-NyE4M', '2000', '0', '', '0', '9', '1', '0', '0', '2019-07-28 03:17:38', '2019-07-28 01:17:52', '446', '2908', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181451', '1', '0', '190728-152460330113525', '', '123.144.211.252', 'Yq3fpZtkLyiyGWqCZ21g8j88tXPFzCdVSlScW6KYAkA', '1000', '0', '', '0', '38', '1', '0', '0', '2019-07-28 03:32:39', '2019-07-28 01:35:20', '455', '2909', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181452', '1', '0', '190728-541467608191246', '', '123.144.211.252', 'FwV_KD-As5YYcT9FqdLO_6OZAiS6FOrz_ZM-C5VLGvY', '500', '0', '', '0', '9', '1', '0', '0', '2019-07-28 07:22:47', '2019-07-28 05:27:11', '454', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181453', '1', '0', '190728-539391427452665', '', '123.144.211.252', '9HwIvM6_aMtlqrZ7iu3yz2q1Ez2y7MnmnA3Ie5knSto', '5000', '0', '', '0', '9', '1', '0', '0', '2019-07-28 09:42:57', '2019-07-28 07:45:01', '430', '2914', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181454', '1', '0', '190728-294337905772550', '', '123.144.211.252', '3bzBdbhgZhXAI4xKXxpcDWp_QXczLRWNzzwsStIkCtA', '5000', '0', '', '0', '38', '1', '4', '0', '2019-07-30 18:00:24', '2019-07-28 07:45:12', '453', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181455', '1', '0', '190728-597485159471631', '', '123.144.211.252', 'SKMReuN584Z_PDCuUED-3qltgYhyfL-SriJmwFwRErQ', '3000', '0', '', '0', '9', '1', '0', '0', '2019-07-28 10:58:04', '2019-07-28 09:00:45', '429', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181456', '1', '0', '190728-372949648350600', '', '123.144.211.252', 'ucBxlHXRI6bAqbuPWX5WOJ6PZh07bgsq7SJ_jMJq1z4', '3000', '0', '', '0', '9', '1', '0', '0', '2019-07-28 11:53:11', '2019-07-28 09:55:30', '462', '2908', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181457', '1', '0', '190728-373092516793525', '', '123.144.211.252', 'XJ8J-iyxHLMqhB4CT6KsWJD5LTBeJW1SkPAlcOJRm6A', '600', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:24', '2019-07-28 10:24:27', '467', '2909', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181458', '1', '0', '190728-457465528971246', '', '123.144.211.252', 'Ou4_oSHnVmX6fduvE8V4enijOAQeIf4suSfB-CBDF0E', '600', '0', '', '0', '9', '1', '0', '0', '2019-07-28 12:33:13', '2019-07-28 10:37:01', '469', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181459', '1', '0', '190728-085504164932665', '', '123.144.211.252', 'JJUR-aLe6cjSPc1nSs9PXimMpvlOmFGg5FIGIcMAOgA', '300', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:24', '2019-07-28 13:29:47', '458', '2914', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181460', '1', '0', '190728-345239061432550', '', '85.203.47.167', 'WKEMv_WXXXByCVmGBmTXjAm8d4qwXqOsV9DO15yf7B4', '300', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:24', '2019-07-28 13:52:01', '468', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181461', '1', '0', '190728-264566539391631', '', '85.203.47.167', 'L2jbK6go83ADVBAmsQayavcu30--tZ6ypG9gydWfTdY', '300', '0', '', '0', '9', '1', '4', '0', '2019-07-28 14:59:24', '2019-07-28 14:31:32', '459', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181462', '1', '0', '190728-431111865210600', '', '123.144.211.252', 'ShaXcKMYZAL4IQmTzRRKmFOlbIJmR90oQTXokuFXQrM', '2000', '0', '', '0', '9', '1', '0', '0', '2019-07-28 17:13:33', '2019-07-28 15:13:35', '444', '2908', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181463', '1', '0', '190728-043959255773525', '', '123.144.211.252', '6tD8l2IsmNA-sLvBq6RAKhOq9GM3l254u2BSvfOkVis', '2000', '0', '', '0', '38', '1', '0', '0', '2019-07-28 17:13:33', '2019-07-28 15:13:41', '436', '2909', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181464', '1', '0', '190728-298017424051246', '', '123.144.211.252', 'QehAquMy7fro-2Rxm4dpRrFSU7nmNTDCg3fZwKLkNc4', '2000', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:24', '2019-07-28 15:48:56', '452', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181465', '1', '0', '190728-335145206552665', '', '123.144.211.252', '5pJQn22965SXrw5txlOVpX-MO77ywqMqASSgFG4FniQ', '300', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:23', '2019-07-28 16:12:25', '467', '2914', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181466', '1', '0', '190728-376426005352550', '', '123.144.211.252', 'FaJSipeLXey4naS7v8qBPVUwXH2IsDeoY-qomhMEqnU', '1000', '0', '', '0', '9', '1', '0', '0', '2019-07-28 19:08:42', '2019-07-28 17:12:13', '437', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181467', '1', '0', '190728-102800098251631', '', '123.144.211.252', '0JvqzJSIEYXntip1IyJuzzXKa9Kh7eIZjuruXvgLENY', '300', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:23', '2019-07-28 17:29:52', '458', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181468', '1', '0', '190728-079268742090600', '', '123.144.211.252', 'XAEYdInVKsXiTrOF95z4yWBmdNdwhF2pptMSpCbGDbQ', '500', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:23', '2019-07-28 17:36:23', '435', '2908', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181469', '1', '0', '190728-424838759333525', '', '123.144.211.252', 'x8XDReTSUOdvmS2Q-tkvz1XiM6CBsO7u-wJAszGD_3E', '900', '0', '', '0', '9', '1', '0', '0', '2019-07-28 20:08:48', '2019-07-28 18:12:01', '463', '2909', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181470', '1', '0', '190728-501883536571246', '', '123.144.211.252', 'eRLZnt4c7PXFtv72YTrypCCF9CJa_PHEZCZTCUXNZJk', '500', '0', '', '0', '38', '1', '4', '0', '2019-07-30 18:00:23', '2019-07-28 18:29:04', '456', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181471', '1', '0', '190728-627673334712665', '', '123.144.211.252', 'o2202nR__G1J_v7BXZj1MGxI3rqGNyQoBd-IEsJ-QHs', '500', '0', '', '0', '38', '1', '0', '0', '2019-07-28 20:38:55', '2019-07-28 18:43:06', '434', '2914', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181472', '1', '0', '190728-455416546472550', '', '123.144.211.252', 'EBS2v-aaX4PeqPYTLZn6Q1gA5doODfynKn-eUnMzIkM', '400', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:23', '2019-07-28 19:11:54', '465', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181473', '1', '0', '190728-653746668651631', '', '123.144.211.252', 'cg5JaY-oFaiYGs5hkwp9t-1S8kXRc5xCd35ZZlfM-94', '500', '0', '', '0', '9', '1', '0', '0', '2019-07-28 21:59:00', '2019-07-28 19:59:15', '433', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181474', '1', '0', '190728-173009961650600', '', '123.144.211.252', 'lYI2MCyoacE3OhMEZu9yUHiQYN0bJAUGo88HMEy4irQ', '500', '0', '', '0', '38', '1', '4', '0', '2019-07-30 18:00:23', '2019-07-28 19:59:21', '439', '2908', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181475', '1', '0', '190728-302834156313525', '', '123.144.211.252', 'Z5t4PRBdXaifpbdTjOq9bnBhqpLjBp61umVxKeSm644', '200', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:23', '2019-07-28 20:01:06', '460', '2909', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181476', '1', '0', '190728-311238492811246', '', '123.144.211.252', 'gS9BY3Z5ntW8y1Hp3Xd-aQFFS9aS3abN4c41e7Qu-L8', '5000', '0', '', '0', '9', '1', '0', '0', '2019-07-28 23:44:06', '2019-07-28 21:45:58', '438', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181477', '1', '0', '190728-528052060952665', '', '123.144.211.252', '3j7ijQLuHnaTH39aaDSae7B9KwTTHR5MgKaMGcqORgA', '300', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:22', '2019-07-28 23:16:04', '468', '2914', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181478', '1', '0', '190728-650464625372550', '', '123.144.211.252', 'dLwZrzpb4aD_6rm5A1JXnFMaL0rZW3hT3l1A7N2tFf0', '500', '0', '', '0', '9', '1', '0', '0', '2019-07-29 01:49:13', '2019-07-28 23:50:45', '431', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181479', '1', '0', '190728-259801908051631', '', '123.144.211.252', 'lwYS-woVIUObutW7LJeA9pZrVzBUCAmr_9A-wtbo59U', '500', '0', '', '0', '38', '1', '4', '0', '2019-07-30 18:00:22', '2019-07-28 23:52:35', '442', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181480', '1', '0', '190729-202527212290600', '', '123.144.211.252', 'T1pCQPCB-2lgqw-3Rg8Ib0iKTV-Aani2Q5BrDTIJJKw', '3000', '0', '', '0', '38', '1', '0', '0', '2019-07-29 04:09:19', '2019-07-29 02:12:53', '445', '2908', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181481', '1', '0', '190729-313081201713525', '', '123.144.211.252', 'YN1lTSveIlbuA8IYXwcYxofTTzLh7hcVgWDXcfkpIkc', '3000', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:22', '2019-07-29 02:13:21', '443', '2909', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181482', '1', '0', '190729-466381701931246', '', '123.144.211.252', 'nOvgxv9bZU-mF2e-9XjBo4HgcmcqAdG9TO70xIcXQ8I', '200', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:22', '2019-07-29 06:01:30', '469', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181483', '1', '0', '190729-550924452732665', '', '123.144.211.252', 'cQmCffHiRL_swJG1ydLd1flmhrMJ5HA-OH6cL4IUl-0', '2000', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:22', '2019-07-29 06:57:34', '423', '2914', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181484', '1', '0', '190729-393493873612550', '', '123.144.211.252', 'icoHDdzYXver2yeyToZHpojHPM8RoHK7GCzfurls-Jo', '500', '0', '', '0', '9', '1', '0', '0', '2019-07-29 10:29:29', '2019-07-29 08:30:16', '449', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181485', '1', '0', '190729-429079921431631', '', '123.144.211.252', 'bc3F2uAbfh6gGGz84WqzIqr3iO0L6GTrWSDaMC8lvaE', '300', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:22', '2019-07-29 09:30:14', '459', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181486', '1', '0', '190729-337823007790600', '', '123.144.211.252', 'vt5xR9Ey6l0QK-xU-7bo78LwTXCOloxh7ZHP1tBgjwQ', '1000', '0', '', '0', '9', '1', '0', '0', '2019-07-29 13:24:46', '2019-07-29 11:28:31', '425', '2908', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181487', '1', '0', '190729-036053320473525', '', '123.144.211.252', 'nhT4eOhFi0Hy63WYlCggehxYPQ0jEePPlZ-SdgzVgHg', '500', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:22', '2019-07-29 11:55:05', '440', '2909', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181488', '1', '0', '190729-593953424351246', '', '123.144.211.252', 'MAPM5YEnhaQfp_6H1KsEIb2WZJEMG3KmDKvInZrhXM0', '500', '0', '', '0', '9', '1', '0', '0', '2019-07-29 13:54:48', '2019-07-29 11:55:18', '455', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181489', '1', '0', '190729-142378926872665', '', '123.144.211.252', 'CKP6DxZhe4lTgHCLUcb61dOoE3pFFGQKQ5XrLjTrYg0', '300', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:21', '2019-07-29 12:05:58', '467', '2914', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181490', '1', '0', '190729-568968479752550', '', '123.144.211.252', 'hsxAqPlK5Lo58IyARCrG8CwsyR_ap4p21dV2I4Nsz1c', '600', '0', '', '0', '9', '1', '0', '0', '2019-07-29 16:24:56', '2019-07-29 14:28:08', '462', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181491', '1', '0', '190729-269991609071631', '', '123.144.211.252', 'BF3pei4zL6N1-S-8K1sx165b06pyaqVxg1K4CE5j2XY', '100', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:21', '2019-07-29 16:54:54', '458', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181492', '1', '0', '190729-189011395430600', '', '123.144.211.252', 'bD3ilf2cBIdXFeXWqkPuR_R4ZHnp_y89ItKDE2CTnkk', '4000', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:21', '2019-07-29 16:58:32', '441', '2908', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181493', '1', '0', '190729-528767058613525', '', '123.144.211.252', 'q5Fkgvua1Fff2YKM90I-XmiGKojligrxGZlXgWnJ58w', '100', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:21', '2019-07-29 17:11:53', '468', '2909', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181494', '1', '0', '190729-322164655331246', '', '123.144.211.252', '789k4Ne-MdSXS3w0E0bOvEizF7MbyJCqIHIZdiZdDY8', '1500', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:21', '2019-07-29 18:00:43', '454', '2907', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181495', '1', '0', '190729-508208251833550', '', '123.144.211.252', 'iDDTgJ734_lmTi55AxWNyiQNa_jTfVCmP_pNBvt6QP0', '1000', '0', '', '0', '9', '1', '4', '0', '2019-07-30 18:00:21', '2019-07-29 19:16:59', '424', '2910', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181496', '1', '0', '190729-605615227572665', '', '123.144.211.252', '0YDT4rZvqM9Eg__bJ7uqHqPjyN0kLjzGeDKg11J2CUI', '600', '0', '', '0', '9', '1', '0', '0', '2019-07-29 21:35:12', '2019-07-29 19:35:40', '460', '2914', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181497', '1', '0', '190729-315314832152550', '', '123.144.211.252', 'y6Db1nMtCvIDmy--RLOAuyTvpqFidzj74Qx5tOXapVQ', '500', '0', '', '0', '9', '1', '0', '0', '2019-07-29 21:35:12', '2019-07-29 19:37:59', '452', '2911', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181498', '1', '0', '190729-110250722351631', '', '123.144.211.252', 'ye1fqeIertNG4wtotZGWdOcCddIekS1MurYeJ2QqOPw', '2000', '0', '', '0', '38', '1', '0', '0', '2019-07-29 22:55:21', '2019-07-29 20:55:29', '426', '2913', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181499', '1', '0', '190729-272926802990600', '', '123.144.211.252', 'y7jHmEsCbIEmjNdKbz5LcP63biJMT-XcjuyBfjlfm8I', '2000', '0', '', '0', '38', '1', '0', '0', '2019-07-29 22:55:21', '2019-07-29 21:00:12', '461', '2908', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181500', '1', '0', '190729-212461323493525', '', '123.144.211.252', '6QVgADtP0dR99ODmoTqEsErFvhCPFVx7_ReIXyw5wtk', '100', '0', '', '0', '9', '1', '0', '0', '2019-07-30 00:25:26', '2019-07-29 22:27:31', '458', '2909', '0', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181501', '32', '0', '190730-033028506451566', '', '112.48.0.245', 'bnt0GJtB1kb-UbNuucr4R3ZqJ6ZXAS1VVr9Hj8CrzVY', '100', '0', '', '0', '38', '1', '0', '0', '2019-07-30 20:35:56', '2019-07-30 18:38:48', '470', '2915', '8', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181502', '32', '0', '190730-012260148131566', '', '112.48.0.245', 'yA1CNJOur1yKwk772EQT77a_VPcqlclcy7yQ_WMlUn8', '100', '0', '', '0', '9', '1', '0', '0', '2019-07-30 20:40:56', '2019-07-30 18:41:54', '470', '2915', '8', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181503', '32', '0', '190730-055136420891566', '', '112.48.0.245', '4wjN5wNj1erw10vJgc8Z19ZrE5tORCQzZNLrd4TrIXA', '100', '0', '', '0', '9', '1', '0', '0', '2019-07-30 21:21:00', '2019-07-30 19:22:00', '470', '2915', '8', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181504', '32', '0', '190730-672272548551566', '', '112.48.0.245', 'PhZKBt7WMpJr68hwbcOtGN7iaM7osS9jvLE0-Wgok9E', '500', '0', '', '0', '38', '1', '0', '0', '2019-07-30 21:21:00', '2019-07-30 19:22:11', '470', '2915', '8', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181505', '32', '0', '190730-511010079671566', '', '123.55.49.97', 'Sb-39Fw9wTGdJLdX_GQ4H97tIUI0VqK8ltNoSqdcDw8', '100', '0', '', '0', '38', '1', '0', '0', '2019-07-30 23:41:27', '2019-07-30 21:44:47', '470', '2915', '8', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181506', '32', '0', '190730-143893136031566', '', '123.55.49.97', 'XR2Pi1WL0gWxI2oOTOGjXNYhALlS4HHLFKu_A4bNQQo', '100', '0', '', '0', '9', '1', '0', '0', '2019-07-30 23:46:28', '2019-07-30 21:46:47', '470', '2915', '8', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181507', '32', '0', '190730-459269407451566', '', '119.85.105.245', 'aQxA8q2EkTdZkux8_I-FSYnD1VSDONDsauHg_Vee5uM', '100', '0', '', '0', '38', '1', '0', '0', '2019-07-30 23:46:28', '2019-07-30 21:47:15', '470', '2915', '8', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181508', '32', '0', '190730-052500562811566', '', '123.55.49.97', 'fgDQvi-SBTF5G52rgKxJ54hV14O06SM8ISamwESqhaU', '100', '0', '', '0', '38', '1', '0', '0', '2019-07-30 23:46:28', '2019-07-30 21:48:27', '470', '2915', '8', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181509', '32', '0', '190730-515623814051566', '', '123.55.49.97', 'ReS9vtEsZPGK1i3Z45ZXTnmnFvL5ClBufcnbregz038', '100', '0', '', '0', '38', '1', '0', '0', '2019-07-30 23:46:28', '2019-07-30 21:49:44', '470', '2915', '8', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181510', '32', '0', '190801-340925154191566', '', '119.85.109.140', '3eNlzGuphY5HtY26ABkzcAnCqykk5srfHp2UaxvpGBQ', '200', '0', '', '0', '38', '1', '0', '0', '2019-08-01 18:42:56', '2019-08-01 16:43:28', '470', '2915', '8', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181511', '32', '0', '190801-437082194611566', '', '119.85.109.140', 'uS69JEpt0CQD_5xV6A2XkRBoyHtDvP-D5XPNlRVNNow', '300', '0', '', '0', '38', '1', '0', '0', '2019-08-01 18:42:56', '2019-08-01 16:43:42', '470', '2915', '8', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181512', '32', '0', '190801-009395569311566', '', '119.85.109.140', '8Z_bc111FDQF9iE2mDzOksOa-LJqjMS9X3H49CpPsuM', '300', '0', '', '0', '9', '1', '0', '0', '2019-08-01 18:42:56', '2019-08-01 16:43:56', '470', '2915', '8', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181513', '32', '0', '190801-287019173051566', '', '119.85.109.140', 'tq1vJ3-vdNOkU4ZLKoYdqauBRbh4V1TiQmyMDWLtMq4', '400', '0', '', '0', '9', '1', '0', '0', '2019-08-01 18:42:56', '2019-08-01 16:44:04', '470', '2915', '8', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181514', '32', '0', '190801-526023722191566', '', '119.85.109.140', 'n-ISdNcXevO0rYomINxAXI36cxFBBozt7KpXCnOdNnY', '500', '0', '', '0', '9', '1', '0', '0', '2019-08-01 18:42:55', '2019-08-01 16:44:14', '470', '2915', '8', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181515', '32', '0', '190801-062614733991566', '', '119.85.109.140', 'tMbDCXsrI8jFBdGmQCCt74nHxvl08z_BCR9n6r3GgEM', '500', '0', '', '0', '38', '1', '0', '0', '2019-08-01 18:42:55', '2019-08-01 16:44:21', '470', '2915', '8', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181516', '32', '0', '190801-438770402291566', '', '119.85.109.140', 'neCNwPQVLLs0Fie9K_zAUcHfUOsrxejsUfAh0iWNFug', '500', '0', '', '0', '9', '1', '0', '0', '2019-08-01 18:42:55', '2019-08-01 16:44:25', '470', '2915', '8', '0', '0', '2', '0', '0');
INSERT INTO `pinduoduo_orders` VALUES ('181517', '32', '0', '190801-545798554851566', '', '119.85.109.140', 'rVaGsVneOoLC4lePViiOnf6EnXmy_pQo98AQonKOB2s', '500', '0', '', '0', '38', '1', '0', '0', '2019-08-01 18:42:55', '2019-08-01 16:44:30', '470', '2915', '8', '0', '0', '2', '0', '0');

-- ----------------------------
-- Table structure for pinduoduo_passageway
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_passageway`;
CREATE TABLE `pinduoduo_passageway` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '通道名称',
  `alias` varchar(10) NOT NULL DEFAULT '' COMMENT '别称',
  `last_use_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '使用时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态(0禁用,1启用)',
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否默认(0否,1是)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='通道表';

-- ----------------------------
-- Records of pinduoduo_passageway
-- ----------------------------
INSERT INTO `pinduoduo_passageway` VALUES ('1', 'pinduoduo', '拼多多', '0', '1', '1');
INSERT INTO `pinduoduo_passageway` VALUES ('2', 'nonchanpin', '农产品', '0', '1', '0');

-- ----------------------------
-- Table structure for pinduoduo_reports
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_reports`;
CREATE TABLE `pinduoduo_reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `admin_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员id',
  `date` datetime DEFAULT NULL COMMENT '统计日期',
  `day` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '当天统计',
  `cy_day` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '海付当天统计',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间戳',
  `day_sum` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '每天统计总额',
  `cy_day_sum` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '海付统计总额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='统计表';

-- ----------------------------
-- Records of pinduoduo_reports
-- ----------------------------
INSERT INTO `pinduoduo_reports` VALUES ('1', '1', null, '47000', '0', '1563934093', '47000', '0');
INSERT INTO `pinduoduo_reports` VALUES ('2', '30', null, '0', '0', '1563934093', '0', '0');
INSERT INTO `pinduoduo_reports` VALUES ('3', '31', null, '0', '0', '1563934093', '0', '0');

-- ----------------------------
-- Table structure for pinduoduo_stores
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_stores`;
CREATE TABLE `pinduoduo_stores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '店铺名称',
  `admin_uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '代理商id',
  `store_remain_total` bigint(10) unsigned NOT NULL DEFAULT '9999999999999' COMMENT '商铺额度限制',
  `order_total` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '下单额度',
  `cur_total` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '成团额度',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态(0禁用,1启用)',
  `ctime` datetime DEFAULT NULL COMMENT '创建时间',
  `mtime` datetime DEFAULT NULL COMMENT '修改时间',
  `c_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商户id',
  `d_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '代理商id',
  PRIMARY KEY (`id`),
  KEY `name_idx` (`name`) USING BTREE,
  KEY `c_id_idx` (`c_id`) USING BTREE,
  KEY `d_id_idx` (`d_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COMMENT='店铺表';

-- ----------------------------
-- Records of pinduoduo_stores
-- ----------------------------
INSERT INTO `pinduoduo_stores` VALUES ('44', '忆川居', '1', '9999999999999', '0', '0', '0', '2019-07-06 09:25:09', '2019-07-06 09:25:09', '0', '0');
INSERT INTO `pinduoduo_stores` VALUES ('45', '我的店铺1', '1', '9999999999999', '0', '0', '0', '2019-07-19 16:04:59', '2019-07-19 16:04:59', '0', '0');
INSERT INTO `pinduoduo_stores` VALUES ('46', '向阳百货小店', '1', '9999999999999', '0', '0', '0', '2019-07-19 16:50:34', '2019-07-19 16:50:34', '0', '0');
INSERT INTO `pinduoduo_stores` VALUES ('47', '思品德商品', '1', '9999999999999', '0', '0', '0', '2019-07-19 19:13:06', '2019-07-19 19:13:06', '0', '0');
INSERT INTO `pinduoduo_stores` VALUES ('48', '张工', '1', '9999999999999', '0', '0', '0', '2019-07-21 23:17:19', '2019-07-21 23:17:19', '0', '0');
INSERT INTO `pinduoduo_stores` VALUES ('49', '佰發金服', '1', '9999999999999', '0', '0', '0', '2019-07-22 22:51:37', '2019-07-22 22:51:37', '0', '0');
INSERT INTO `pinduoduo_stores` VALUES ('50', 'alipay', '1', '9999999999999', '0', '0', '0', '2019-07-23 12:53:00', '2019-07-23 12:53:00', '0', '0');
INSERT INTO `pinduoduo_stores` VALUES ('51', '测试店铺', '1', '9999999999999', '0', '0', '0', '2019-07-23 14:08:55', '2019-07-23 14:08:55', '0', '0');
INSERT INTO `pinduoduo_stores` VALUES ('52', '大树化妆品店', '1', '9999999999999', '0', '0', '0', '2019-07-23 15:06:01', '2019-07-23 15:06:01', '0', '0');
INSERT INTO `pinduoduo_stores` VALUES ('53', '111', '1', '9999999999999', '0', '0', '0', '2019-07-23 15:06:52', '2019-07-23 15:06:52', '0', '0');
INSERT INTO `pinduoduo_stores` VALUES ('54', '丹丹精品熟食', '1', '9999999999999', '294000', '0', '1', '2019-07-23 19:46:37', '2019-07-23 19:46:37', '0', '0');
INSERT INTO `pinduoduo_stores` VALUES ('55', '1111', '1', '9999999999999', '0', '0', '1', '2019-07-30 17:25:53', '2019-07-30 17:25:53', '4', '0');
INSERT INTO `pinduoduo_stores` VALUES ('56', '趣模板源码网', '32', '9999999999999', '4500', '0', '1', '2019-07-30 18:22:23', '2019-07-30 18:22:23', '8', '0');

-- ----------------------------
-- Table structure for pinduoduo_system_annex
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_system_annex`;
CREATE TABLE `pinduoduo_system_annex` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关联的数据ID',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '类型',
  `group` varchar(100) NOT NULL DEFAULT 'sys' COMMENT '文件分组',
  `file` varchar(255) NOT NULL COMMENT '上传文件',
  `hash` varchar(64) NOT NULL COMMENT '文件hash值',
  `size` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '附件大小KB',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '使用状态(0未使用，1已使用)',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash` (`hash`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[系统] 上传附件';

-- ----------------------------
-- Records of pinduoduo_system_annex
-- ----------------------------

-- ----------------------------
-- Table structure for pinduoduo_system_annex_group
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_system_annex_group`;
CREATE TABLE `pinduoduo_system_annex_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '附件分组',
  `count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '附件数量',
  `size` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '附件大小kb',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[系统] 附件分组';

-- ----------------------------
-- Records of pinduoduo_system_annex_group
-- ----------------------------

-- ----------------------------
-- Table structure for pinduoduo_system_config
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_system_config`;
CREATE TABLE `pinduoduo_system_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为系统配置(1是，0否)',
  `group` varchar(20) NOT NULL DEFAULT 'base' COMMENT '分组',
  `title` varchar(20) NOT NULL COMMENT '配置标题',
  `name` varchar(50) NOT NULL COMMENT '配置名称，由英文字母和下划线组成',
  `value` text NOT NULL COMMENT '配置值',
  `type` varchar(20) NOT NULL DEFAULT 'input' COMMENT '配置类型()',
  `options` text NOT NULL COMMENT '配置项(选项名:选项值)',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '文件上传接口',
  `tips` varchar(255) NOT NULL COMMENT '配置提示',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL COMMENT '状态',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COMMENT='[系统] 系统配置';

-- ----------------------------
-- Records of pinduoduo_system_config
-- ----------------------------
INSERT INTO `pinduoduo_system_config` VALUES ('1', '1', 'sys', '扩展配置分组', 'config_group', '', 'array', ' ', '', '请按如下格式填写：&lt;br&gt;键值:键名&lt;br&gt;键值:键名&lt;br&gt;&lt;span style=&quot;color:#f00&quot;&gt;键值只能为英文、数字、下划线&lt;/span&gt;', '2', '1', '1492140215', '1492140215');
INSERT INTO `pinduoduo_system_config` VALUES ('13', '1', 'base', '网站域名', 'site_domain', 'qumuban.com', 'input', '', '', '', '2', '1', '1492140215', '1492140215');
INSERT INTO `pinduoduo_system_config` VALUES ('14', '1', 'upload', '图片上传大小限制', 'upload_image_size', '0', 'input', '', '', '单位：KB，0表示不限制大小', '3', '1', '1490841797', '1491040778');
INSERT INTO `pinduoduo_system_config` VALUES ('15', '1', 'upload', '允许上传图片格式', 'upload_image_ext', 'jpg,png,gif,jpeg,ico', 'input', '', '', '多个格式请用英文逗号（,）隔开', '4', '1', '1490842130', '1491040778');
INSERT INTO `pinduoduo_system_config` VALUES ('16', '1', 'upload', '缩略图裁剪方式', 'thumb_type', '2', 'select', '1:等比例缩放\r\n2:缩放后填充\r\n3:居中裁剪\r\n4:左上角裁剪\r\n5:右下角裁剪\r\n6:固定尺寸缩放\r\n', '', '', '5', '1', '1490842450', '1491040778');
INSERT INTO `pinduoduo_system_config` VALUES ('17', '1', 'upload', '图片水印开关', 'image_watermark', '1', 'switch', '0:关闭\r\n1:开启', '', '', '6', '1', '1490842583', '1491040778');
INSERT INTO `pinduoduo_system_config` VALUES ('18', '1', 'upload', '图片水印图', 'image_watermark_pic', '', 'image', '', '', '', '7', '1', '1490842679', '1491040778');
INSERT INTO `pinduoduo_system_config` VALUES ('19', '1', 'upload', '图片水印透明度', 'image_watermark_opacity', '50', 'input', '', '', '可设置值为0~100，数字越小，透明度越高', '8', '1', '1490857704', '1491040778');
INSERT INTO `pinduoduo_system_config` VALUES ('20', '1', 'upload', '图片水印图位置', 'image_watermark_location', '9', 'select', '7:左下角\r\n1:左上角\r\n4:左居中\r\n9:右下角\r\n3:右上角\r\n6:右居中\r\n2:上居中\r\n8:下居中\r\n5:居中', '', '', '9', '1', '1490858228', '1491040778');
INSERT INTO `pinduoduo_system_config` VALUES ('21', '1', 'upload', '文件上传大小限制', 'upload_file_size', '0', 'input', '', '', '单位：KB，0表示不限制大小', '1', '1', '1490859167', '1491040778');
INSERT INTO `pinduoduo_system_config` VALUES ('22', '1', 'upload', '允许上传文件格式', 'upload_file_ext', 'doc,docx,xls,xlsx,ppt,pptx,pdf,wps,txt,rar,zip', 'input', '', '', '多个格式请用英文逗号（,）隔开', '2', '1', '1490859246', '1491040778');
INSERT INTO `pinduoduo_system_config` VALUES ('23', '1', 'upload', '文字水印开关', 'text_watermark', '0', 'switch', '0:关闭\r\n1:开启', '', '', '10', '1', '1490860872', '1491040778');
INSERT INTO `pinduoduo_system_config` VALUES ('24', '1', 'upload', '文字水印内容', 'text_watermark_content', '', 'input', '', '', '', '11', '1', '1490861005', '1491040778');
INSERT INTO `pinduoduo_system_config` VALUES ('25', '1', 'upload', '文字水印字体', 'text_watermark_font', '', 'file', '', '', '不上传将使用系统默认字体', '12', '1', '1490861117', '1491040778');
INSERT INTO `pinduoduo_system_config` VALUES ('26', '1', 'upload', '文字水印字体大小', 'text_watermark_size', '20', 'input', '', '', '单位：px(像素)', '13', '1', '1490861204', '1491040778');
INSERT INTO `pinduoduo_system_config` VALUES ('27', '1', 'upload', '文字水印颜色', 'text_watermark_color', '#000000', 'input', '', '', '文字水印颜色，格式:#000000', '14', '1', '1490861482', '1491040778');
INSERT INTO `pinduoduo_system_config` VALUES ('28', '1', 'upload', '文字水印位置', 'text_watermark_location', '7', 'select', '7:左下角\r\n1:左上角\r\n4:左居中\r\n9:右下角\r\n3:右上角\r\n6:右居中\r\n2:上居中\r\n8:下居中\r\n5:居中', '', '', '11', '1', '1490861718', '1491040778');
INSERT INTO `pinduoduo_system_config` VALUES ('29', '1', 'upload', '缩略图尺寸', 'thumb_size', '300x300;500x500', 'input', '', '', '为空则不生成，生成 500x500 的缩略图，则填写 500x500，多个规格填写参考 300x300;500x500;800x800', '4', '1', '1490947834', '1491040778');
INSERT INTO `pinduoduo_system_config` VALUES ('30', '1', 'sys', '开发模式', 'app_debug', '0', 'switch', '0:关闭\r\n1:开启', '', '&lt;strong class=&quot;red&quot;&gt;生产环境下一定要关闭此配置&lt;/strong&gt;', '3', '1', '1491005004', '1492093874');
INSERT INTO `pinduoduo_system_config` VALUES ('31', '1', 'sys', '页面Trace', 'app_trace', '1', 'switch', '0:关闭\r\n1:开启', '', '&lt;strong class=&quot;red&quot;&gt;生产环境下一定要关闭此配置&lt;/strong&gt;', '4', '1', '1491005081', '1492093874');
INSERT INTO `pinduoduo_system_config` VALUES ('33', '1', 'sys', '富文本编辑器', 'editor', 'kindeditor', 'select', 'ueditor:UEditor\r\numeditor:UMEditor\r\nkindeditor:KindEditor\r\nckeditor:CKEditor', '', '', '0', '1', '1491142648', '1492140215');
INSERT INTO `pinduoduo_system_config` VALUES ('35', '1', 'databases', '备份目录', 'backup_path', './backup/database/', 'input', '', '', '数据库备份路径,路径必须以 / 结尾', '0', '1', '1491881854', '1491965974');
INSERT INTO `pinduoduo_system_config` VALUES ('36', '1', 'databases', '备份分卷大小', 'part_size', '20971520', 'input', '', '', '用于限制压缩后的分卷最大长度。单位：B；建议设置20M', '0', '1', '1491881975', '1491965974');
INSERT INTO `pinduoduo_system_config` VALUES ('37', '1', 'databases', '备份压缩开关', 'compress', '1', 'switch', '0:关闭\r\n1:开启', '', '压缩备份文件需要PHP环境支持gzopen,gzwrite函数', '0', '1', '1491882038', '1491965974');
INSERT INTO `pinduoduo_system_config` VALUES ('38', '1', 'databases', '备份压缩级别', 'compress_level', '4', 'radio', '1:最低\r\n4:一般\r\n9:最高', '', '数据库备份文件的压缩级别，该配置在开启压缩时生效', '0', '1', '1491882154', '1491965974');
INSERT INTO `pinduoduo_system_config` VALUES ('39', '1', 'base', '网站状态', 'site_status', '1', 'switch', '0:关闭\r\n1:开启', '', '站点关闭后将不能访问，后台可正常登录', '1', '1', '1492049460', '1494690024');
INSERT INTO `pinduoduo_system_config` VALUES ('40', '1', 'sys', '后台管理路径', 'admin_path', 'admin.php', 'input', '', '', '必须以.php为后缀', '1', '1', '1492139196', '1492140215');
INSERT INTO `pinduoduo_system_config` VALUES ('41', '1', 'base', '网站标题', 'site_title', 'HisiPHP 开源后台管理框架', 'input', '', '', '网站标题是体现一个网站的主旨，要做到主题突出、标题简洁、连贯等特点，建议不超过28个字', '6', '1', '1492502354', '1494695131');
INSERT INTO `pinduoduo_system_config` VALUES ('42', '1', 'base', '网站关键词', 'site_keywords', 'hisiphp,hisiphp框架,php开源框架', 'input', '', '', '网页内容所包含的核心搜索关键词，多个关键字请用英文逗号&quot;,&quot;分隔', '7', '1', '1494690508', '1494690780');
INSERT INTO `pinduoduo_system_config` VALUES ('43', '1', 'base', '网站描述', 'site_description', '趣模板拼多多出码', 'textarea', '', '', '网页的描述信息，搜索引擎采纳后，作为搜索结果中的页面摘要显示，建议不超过80个字', '8', '1', '1494690669', '1494691075');
INSERT INTO `pinduoduo_system_config` VALUES ('44', '1', 'base', 'ICP备案信息', 'site_icp', '', 'input', '', '', '请填写ICP备案号，用于展示在网站底部，ICP备案官网：&lt;a href=&quot;http://www.miibeian.gov.cn&quot; target=&quot;_blank&quot;&gt;http://www.miibeian.gov.cn&lt;/a&gt;', '9', '1', '1494691721', '1494692046');
INSERT INTO `pinduoduo_system_config` VALUES ('45', '1', 'base', '站点统计代码', 'site_statis', '', 'textarea', '', '', '第三方流量统计代码，前台调用时请先用 htmlspecialchars_decode函数转义输出', '10', '1', '1494691959', '1494694797');
INSERT INTO `pinduoduo_system_config` VALUES ('46', '1', 'base', '网站名称', 'site_name', '趣模板拼多多出码', 'input', '', '', '将显示在浏览器窗口标题等位置', '3', '1', '1494692103', '1494694680');
INSERT INTO `pinduoduo_system_config` VALUES ('47', '1', 'base', '网站LOGO', 'site_logo', '', 'image', '', '', '网站LOGO图片', '4', '1', '1494692345', '1494693235');
INSERT INTO `pinduoduo_system_config` VALUES ('48', '1', 'base', '网站图标', 'site_favicon', '', 'image', '', '/system/annex/favicon', '又叫网站收藏夹图标，它显示位于浏览器的地址栏或者标题前面，&lt;strong class=&quot;red&quot;&gt;.ico格式&lt;/strong&gt;，&lt;a href=&quot;https://www.baidu.com/s?ie=UTF-8&amp;wd=favicon&quot; target=&quot;_blank&quot;&gt;点此了解网站图标&lt;/a&gt;', '5', '1', '1494692781', '1494693966');
INSERT INTO `pinduoduo_system_config` VALUES ('49', '1', 'base', '手机网站', 'wap_site_status', '1', 'switch', '0:关闭\r\n1:开启', '', '如果有手机网站，请设置为开启状态，否则只显示PC网站', '2', '1', '1498405436', '1498405436');
INSERT INTO `pinduoduo_system_config` VALUES ('50', '1', 'sys', '云端推送', 'cloud_push', '1', 'switch', '0:关闭\r\n1:开启', '', '关闭之后，无法通过云端推送安装扩展', '5', '1', '1504250320', '1504250320');
INSERT INTO `pinduoduo_system_config` VALUES ('51', '1', 'base', '手机网站域名', 'wap_domain', 'qumuban.com', 'input', '', '', '手机访问将自动跳转至此域名', '2', '1', '1504304776', '1504304837');
INSERT INTO `pinduoduo_system_config` VALUES ('52', '1', 'sys', '多语言支持', 'multi_language', '1', 'switch', '0:关闭\r\n1:开启', '', '开启后你可以自由上传多种语言包', '6', '1', '1506532211', '1506532211');
INSERT INTO `pinduoduo_system_config` VALUES ('53', '1', 'sys', '后台白名单验证', 'admin_whitelist_verify', '0', 'switch', '0:禁用\r\n1:启用', '', '禁用后不存在的菜单节点将不在提示', '7', '1', '1542012232', '1542012321');
INSERT INTO `pinduoduo_system_config` VALUES ('54', '1', 'sys', '系统日志保留', 'system_log_retention', '0', 'input', '', '', '单位天，系统将自动清除 ? 天前的系统日志', '8', '1', '1542013958', '1542014158');

-- ----------------------------
-- Table structure for pinduoduo_system_hook
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_system_hook`;
CREATE TABLE `pinduoduo_system_hook` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '系统插件',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `source` varchar(50) NOT NULL DEFAULT '' COMMENT '钩子来源[plugins.插件名，module.模块名]',
  `intro` varchar(200) NOT NULL DEFAULT '' COMMENT '钩子简介',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='[系统] 钩子表';

-- ----------------------------
-- Records of pinduoduo_system_hook
-- ----------------------------
INSERT INTO `pinduoduo_system_hook` VALUES ('1', '1', 'system_admin_index', '', '后台首页', '1', '1490885108', '1490885108');
INSERT INTO `pinduoduo_system_hook` VALUES ('2', '1', 'system_admin_tips', '', '后台所有页面提示', '1', '1490713165', '1490885137');
INSERT INTO `pinduoduo_system_hook` VALUES ('3', '1', 'system_annex_upload', '', '附件上传钩子，可扩展上传到第三方存储', '1', '1490884242', '1490885121');
INSERT INTO `pinduoduo_system_hook` VALUES ('4', '1', 'system_member_login', '', '会员登陆成功之后的动作', '1', '1490885108', '1490885108');
INSERT INTO `pinduoduo_system_hook` VALUES ('5', '1', 'system_member_register', '', '会员注册成功后的动作', '1', '1512610518', '1512610518');

-- ----------------------------
-- Table structure for pinduoduo_system_hook_plugins
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_system_hook_plugins`;
CREATE TABLE `pinduoduo_system_hook_plugins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hook` varchar(32) NOT NULL COMMENT '钩子id',
  `plugins` varchar(32) NOT NULL COMMENT '插件标识',
  `ctime` int(11) unsigned NOT NULL DEFAULT '0',
  `mtime` int(11) unsigned NOT NULL DEFAULT '0',
  `sort` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='[系统] 钩子-插件对应表';

-- ----------------------------
-- Records of pinduoduo_system_hook_plugins
-- ----------------------------
INSERT INTO `pinduoduo_system_hook_plugins` VALUES ('1', 'system_admin_index', 'hisiphp', '1509380301', '1509380301', '0', '1');

-- ----------------------------
-- Table structure for pinduoduo_system_language
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_system_language`;
CREATE TABLE `pinduoduo_system_language` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '语言包名称',
  `code` varchar(20) NOT NULL DEFAULT '' COMMENT '编码',
  `locale` varchar(255) NOT NULL DEFAULT '' COMMENT '本地浏览器语言编码',
  `icon` varchar(30) NOT NULL DEFAULT '' COMMENT '图标',
  `pack` varchar(100) NOT NULL DEFAULT '' COMMENT '上传的语言包',
  `sort` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='[系统] 语言包';

-- ----------------------------
-- Records of pinduoduo_system_language
-- ----------------------------
INSERT INTO `pinduoduo_system_language` VALUES ('1', '简体中文', 'zh-cn', 'zh-CN,zh-CN.UTF-8,zh-cn', '', '1', '1', '1');

-- ----------------------------
-- Table structure for pinduoduo_system_log
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_system_log`;
CREATE TABLE `pinduoduo_system_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) DEFAULT '',
  `url` varchar(200) DEFAULT '',
  `param` text,
  `remark` varchar(255) DEFAULT '',
  `count` int(10) unsigned NOT NULL DEFAULT '1',
  `ip` varchar(128) DEFAULT '',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1684 DEFAULT CHARSET=utf8 COMMENT='[系统] 操作日志';

-- ----------------------------
-- Records of pinduoduo_system_log
-- ----------------------------
INSERT INTO `pinduoduo_system_log` VALUES ('1654', '1', '后台首页', '/admin.php/system/index/index.html', '[]', '浏览数据', '2', '127.0.0.1', '1574592645', '1574592822');
INSERT INTO `pinduoduo_system_log` VALUES ('1655', '1', '框架升级', '/admin.php/system/upgrade/index.html', '[]', '浏览数据', '1', '127.0.0.1', '1574592814', '1574592814');
INSERT INTO `pinduoduo_system_log` VALUES ('1656', '1', '店铺管理', '/admin.php/system/pinduoduo/goods.html', '[]', '浏览数据', '2', '127.0.0.1', '1574592827', '1574593245');
INSERT INTO `pinduoduo_system_log` VALUES ('1657', '1', '店铺管理', '/admin.php/system/pinduoduo/goods.html?page=1&limit=10', '{\"page\":\"1\",\"limit\":\"10\"}', '浏览数据', '2', '127.0.0.1', '1574592827', '1574593245');
INSERT INTO `pinduoduo_system_log` VALUES ('1658', '1', '店铺列表', '/admin.php/system/pinduoduo/stores.html', '[]', '浏览数据', '2', '127.0.0.1', '1574592885', '1574592899');
INSERT INTO `pinduoduo_system_log` VALUES ('1659', '1', '店铺列表', '/admin.php/system/pinduoduo/stores.html?page=1&limit=10', '{\"page\":\"1\",\"limit\":\"10\"}', '浏览数据', '2', '127.0.0.1', '1574592885', '1574592899');
INSERT INTO `pinduoduo_system_log` VALUES ('1660', '1', '未加入系统菜单', '/admin.php/system/pinduoduo/stores_rename.html', '{\"id\":\"56\",\"name\":\"\\u8da3\\u6a21\\u677f\\u6e90\\u7801\\u7f51\"}', '保存数据', '1', '127.0.0.1', '1574592899', '1574592899');
INSERT INTO `pinduoduo_system_log` VALUES ('1661', '1', '基础信息', '/admin.php/system/pinduoduo/infos.html', '[]', '浏览数据', '1', '127.0.0.1', '1574592904', '1574592904');
INSERT INTO `pinduoduo_system_log` VALUES ('1662', '1', '数据统计', '/admin.php/system/pinduoduo/reports.html', '[]', '浏览数据', '2', '127.0.0.1', '1574593062', '1574593065');
INSERT INTO `pinduoduo_system_log` VALUES ('1663', '1', '数据统计', '/admin.php/system/pinduoduo/reports.html?page=1&limit=7', '{\"page\":\"1\",\"limit\":\"7\"}', '浏览数据', '2', '127.0.0.1', '1574593063', '1574593065');
INSERT INTO `pinduoduo_system_log` VALUES ('1664', '1', '错误日志', '/admin.php/system/pinduoduo/errors.html', '[]', '浏览数据', '1', '127.0.0.1', '1574593064', '1574593064');
INSERT INTO `pinduoduo_system_log` VALUES ('1665', '1', '错误日志', '/admin.php/system/pinduoduo/errors.html?page=1&limit=10', '{\"page\":\"1\",\"limit\":\"10\"}', '浏览数据', '1', '127.0.0.1', '1574593064', '1574593064');
INSERT INTO `pinduoduo_system_log` VALUES ('1666', '1', '一键导入', '/admin.php/system/pinduoduo/onekey.html', '[]', '浏览数据', '1', '127.0.0.1', '1574593076', '1574593076');
INSERT INTO `pinduoduo_system_log` VALUES ('1667', '1', '帐号管理', '/admin.php/system/pinduoduo/users.html', '[]', '浏览数据', '1', '127.0.0.1', '1574593078', '1574593078');
INSERT INTO `pinduoduo_system_log` VALUES ('1668', '1', '帐号管理', '/admin.php/system/pinduoduo/users.html?page=1&limit=10', '{\"page\":\"1\",\"limit\":\"10\"}', '浏览数据', '1', '127.0.0.1', '1574593079', '1574593079');
INSERT INTO `pinduoduo_system_log` VALUES ('1669', '1', '添加帐号', '/admin.php/system/pinduoduo/users_add.html', '[]', '浏览数据', '2', '127.0.0.1', '1574593084', '1574593159');
INSERT INTO `pinduoduo_system_log` VALUES ('1670', '1', '添加QQ号', '/admin.php/system/pinduoduo/qq_add.html', '[]', '浏览数据', '1', '127.0.0.1', '1574593085', '1574593085');
INSERT INTO `pinduoduo_system_log` VALUES ('1671', '1', '系统设置', '/admin.php/system/system/index.html', '[]', '浏览数据', '2', '127.0.0.1', '1574593166', '1574593234');
INSERT INTO `pinduoduo_system_log` VALUES ('1672', '1', '基础配置', '/admin.php/system/system/index.html?group=base', '{\"group\":\"base\",\"id\":{\"site_status\":\"1\",\"site_domain\":\"qumuban.com\",\"wap_site_status\":\"1\",\"wap_domain\":\"qumuban.com\",\"site_name\":\"\\u8da3\\u6a21\\u677f\\u62fc\\u591a\\u591a\\u51fa\\u7801\",\"site_logo\":\"\",\"site_favicon\":\"\",\"site_title\":\"HisiPHP \\u5f00\\u6e90\\u540e\\u53f0\\u7ba1\\u7406\\u6846\\u67b6\",\"site_keywords\":\"hisiphp,hisiphp\\u6846\\u67b6,php\\u5f00\\u6e90\\u6846\\u67b6\",\"site_description\":\"\\u8da3\\u6a21\\u677f\\u62fc\\u591a\\u591a\\u51fa\\u7801\",\"site_icp\":\"\",\"site_statis\":\"\"},\"type\":{\"site_status\":\"switch\",\"site_domain\":\"input\",\"wap_site_status\":\"switch\",\"wap_domain\":\"input\",\"site_name\":\"input\",\"site_logo\":\"image\",\"site_favicon\":\"image\",\"site_title\":\"input\",\"site_keywords\":\"input\",\"site_description\":\"textarea\",\"site_icp\":\"input\",\"site_statis\":\"textarea\"},\"__token__\":\"c7707c8723ba86ae1a337c7950e3a326\"}', '保存数据', '1', '127.0.0.1', '1574593209', '1574593209');
INSERT INTO `pinduoduo_system_log` VALUES ('1673', '1', '基础配置', '/admin.php/system/system/index/group/base.html', '{\"group\":\"base\"}', '浏览数据', '1', '127.0.0.1', '1574593213', '1574593213');
INSERT INTO `pinduoduo_system_log` VALUES ('1674', '1', '系统配置', '/admin.php/system/system/index.html?group=sys', '{\"group\":\"sys\"}', '浏览数据', '2', '127.0.0.1', '1574593216', '1574593218');
INSERT INTO `pinduoduo_system_log` VALUES ('1675', '1', '基础配置', '/admin.php/system/system/index.html?group=base', '{\"group\":\"base\"}', '浏览数据', '1', '127.0.0.1', '1574593217', '1574593217');
INSERT INTO `pinduoduo_system_log` VALUES ('1676', '1', '上传配置', '/admin.php/system/system/index.html?group=upload', '{\"group\":\"upload\"}', '浏览数据', '1', '127.0.0.1', '1574593220', '1574593220');
INSERT INTO `pinduoduo_system_log` VALUES ('1677', '1', '数据库配置', '/admin.php/system/system/index.html?group=databases', '{\"group\":\"databases\"}', '浏览数据', '2', '127.0.0.1', '1574593221', '1574593235');
INSERT INTO `pinduoduo_system_log` VALUES ('1678', '1', '应用市场', '/admin.php/system/store/index.html', '[]', '浏览数据', '1', '127.0.0.1', '1574593227', '1574593227');
INSERT INTO `pinduoduo_system_log` VALUES ('1679', '1', '应用市场', '/admin.php/system/store/index.html?page=1&limit=10', '{\"page\":\"1\",\"limit\":\"10\"}', '浏览数据', '1', '127.0.0.1', '1574593228', '1574593228');
INSERT INTO `pinduoduo_system_log` VALUES ('1680', '1', '数据库管理', '/admin.php/system/database/index.html', '[]', '浏览数据', '1', '127.0.0.1', '1574593231', '1574593231');
INSERT INTO `pinduoduo_system_log` VALUES ('1681', '1', '数据库管理', '/admin.php/system/database/index.html?group=export&page=1&limit=10', '{\"group\":\"export\",\"page\":\"1\",\"limit\":\"10\"}', '浏览数据', '1', '127.0.0.1', '1574593231', '1574593231');
INSERT INTO `pinduoduo_system_log` VALUES ('1682', '1', '系统管理员', '/admin.php/system/user/index.html', '[]', '浏览数据', '1', '127.0.0.1', '1574593233', '1574593233');
INSERT INTO `pinduoduo_system_log` VALUES ('1683', '1', '系统管理员', '/admin.php/system/user/index.html?page=1&limit=20', '{\"page\":\"1\",\"limit\":\"20\"}', '浏览数据', '1', '127.0.0.1', '1574593233', '1574593233');

-- ----------------------------
-- Table structure for pinduoduo_system_menu
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_system_menu`;
CREATE TABLE `pinduoduo_system_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '管理员ID(快捷菜单专用)',
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `module` varchar(20) NOT NULL COMMENT '模块名或插件名，插件名格式:plugins.插件名',
  `title` varchar(20) NOT NULL COMMENT '菜单标题',
  `icon` varchar(80) NOT NULL DEFAULT 'aicon ai-shezhi' COMMENT '菜单图标',
  `url` varchar(200) NOT NULL COMMENT '链接地址(模块/控制器/方法)',
  `param` varchar(200) NOT NULL DEFAULT '' COMMENT '扩展参数',
  `target` varchar(20) NOT NULL DEFAULT '_self' COMMENT '打开方式(_blank,_self)',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `debug` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '开发模式可见',
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否为系统菜单，系统菜单不可删除',
  `nav` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否为菜单显示，1显示0不显示',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态1显示，0隐藏',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=189 DEFAULT CHARSET=utf8 COMMENT='[系统] 管理菜单';

-- ----------------------------
-- Records of pinduoduo_system_menu
-- ----------------------------
INSERT INTO `pinduoduo_system_menu` VALUES ('1', '0', '0', 'system', '首页', '', 'system/index', '', '_self', '0', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('2', '0', '0', 'system', '系统', '', 'system/system', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('3', '0', '0', 'system', '插件', 'aicon ai-shezhi', 'system/plugins', '', '_self', '2', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('4', '0', '1', 'system', '快捷菜单', 'aicon ai-caidan', 'system/quick', '', '_self', '0', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('5', '0', '3', 'system', '插件列表', 'aicon ai-mokuaiguanli', 'system/plugins', '', '_self', '0', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('6', '0', '2', 'system', '系统基础', 'aicon ai-gongneng', 'system/system', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('7', '0', '4', 'system', '预留占位', '', '', '', '_self', '0', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('8', '0', '2', 'system', '系统扩展', 'aicon ai-shezhi', 'system/extend', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('9', '0', '4', 'system', '预留占位', '', '', '', '_self', '4', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('10', '0', '6', 'system', '系统设置', 'aicon ai-icon01', 'system/system/index', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('11', '0', '6', 'system', '配置管理', 'aicon ai-peizhiguanli', 'system/config/index', '', '_self', '2', '1', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('12', '0', '6', 'system', '系统菜单', 'aicon ai-systemmenu', 'system/menu/index', '', '_self', '3', '1', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('13', '0', '6', 'system', '管理员角色', '', 'system/user/role', '', '_self', '4', '0', '1', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('14', '0', '6', 'system', '系统管理员', 'aicon ai-tubiao05', 'system/user/index', '', '_self', '5', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('15', '0', '6', 'system', '系统日志', 'aicon ai-xitongrizhi-tiaoshi', 'system/log/index', '', '_self', '7', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('16', '0', '6', 'system', '附件管理', '', 'system/annex/index', '', '_self', '8', '0', '1', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('17', '0', '8', 'system', '本地模块', 'aicon ai-mokuaiguanli1', 'system/module/index', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('18', '0', '8', 'system', '本地插件', 'aicon ai-chajianguanli', 'system/plugins/index', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('19', '0', '8', 'system', '插件钩子', 'aicon ai-icon-test', 'system/hook/index', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('20', '0', '4', 'system', '预留占位', '', '', '', '_self', '1', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('21', '0', '4', 'system', '预留占位', '', '', '', '_self', '2', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('22', '0', '4', 'system', '预留占位', '', '', '', '_self', '1', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('23', '0', '4', 'system', '预留占位', '', '', '', '_self', '2', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('24', '0', '4', 'system', '后台首页', '', 'system/index/index', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('25', '0', '4', 'system', '清空缓存', '', 'system/index/clear', '', '_self', '2', '0', '1', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('26', '0', '12', 'system', '添加菜单', '', 'system/menu/add', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('27', '0', '12', 'system', '修改菜单', '', 'system/menu/edit', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('28', '0', '12', 'system', '删除菜单', '', 'system/menu/del', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('29', '0', '12', 'system', '状态设置', '', 'system/menu/status', '', '_self', '4', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('30', '0', '12', 'system', '排序设置', '', 'system/menu/sort', '', '_self', '5', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('31', '0', '12', 'system', '添加快捷菜单', '', 'system/menu/quick', '', '_self', '6', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('32', '0', '12', 'system', '导出菜单', '', 'system/menu/export', '', '_self', '7', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('33', '0', '13', 'system', '添加角色', '', 'system/user/addrole', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('34', '0', '13', 'system', '修改角色', '', 'system/user/editrole', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('35', '0', '13', 'system', '删除角色', '', 'system/user/delrole', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('36', '0', '13', 'system', '状态设置', '', 'system/user/statusRole', '', '_self', '4', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('37', '0', '14', 'system', '添加管理员', '', 'system/user/adduser', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('38', '0', '14', 'system', '修改管理员', '', 'system/user/edituser', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('39', '0', '14', 'system', '删除管理员', '', 'system/user/deluser', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('40', '0', '14', 'system', '状态设置', '', 'system/user/status', '', '_self', '4', '0', '1', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('41', '0', '142', 'system', '个人信息设置', '', 'system/user/info', '', '_self', '0', '0', '0', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('42', '0', '18', 'system', '安装插件', '', 'system/plugins/install', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('43', '0', '18', 'system', '卸载插件', '', 'system/plugins/uninstall', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('44', '0', '18', 'system', '删除插件', '', 'system/plugins/del', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('45', '0', '18', 'system', '状态设置', '', 'system/plugins/status', '', '_self', '4', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('46', '0', '18', 'system', '生成插件', '', 'system/plugins/design', '', '_self', '5', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('47', '0', '18', 'system', '运行插件', '', 'system/plugins/run', '', '_self', '6', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('48', '0', '18', 'system', '更新插件', '', 'system/plugins/update', '', '_self', '7', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('49', '0', '18', 'system', '插件配置', '', 'system/plugins/setting', '', '_self', '8', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('50', '0', '19', 'system', '添加钩子', '', 'system/hook/add', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('51', '0', '19', 'system', '修改钩子', '', 'system/hook/edit', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('52', '0', '19', 'system', '删除钩子', '', 'system/hook/del', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('53', '0', '19', 'system', '状态设置', '', 'system/hook/status', '', '_self', '4', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('54', '0', '19', 'system', '插件排序', '', 'system/hook/sort', '', '_self', '5', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('55', '0', '11', 'system', '添加配置', '', 'system/config/add', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('56', '0', '11', 'system', '修改配置', '', 'system/config/edit', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('57', '0', '11', 'system', '删除配置', '', 'system/config/del', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('58', '0', '11', 'system', '状态设置', '', 'system/config/status', '', '_self', '4', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('59', '0', '11', 'system', '排序设置', '', 'system/config/sort', '', '_self', '5', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('60', '0', '10', 'system', '基础配置', '', 'system/system/index', 'group=base', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('61', '0', '10', 'system', '系统配置', '', 'system/system/index', 'group=sys', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('62', '0', '10', 'system', '上传配置', '', 'system/system/index', 'group=upload', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('63', '0', '10', 'system', '开发配置', '', 'system/system/index', 'group=develop', '_self', '4', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('64', '0', '17', 'system', '生成模块', '', 'system/module/design', '', '_self', '6', '1', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('65', '0', '17', 'system', '安装模块', '', 'system/module/install', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('66', '0', '17', 'system', '卸载模块', '', 'system/module/uninstall', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('67', '0', '17', 'system', '状态设置', '', 'system/module/status', '', '_self', '3', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('68', '0', '17', 'system', '设置默认模块', '', 'system/module/setdefault', '', '_self', '4', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('69', '0', '17', 'system', '删除模块', '', 'system/module/del', '', '_self', '5', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('70', '0', '4', 'system', '预留占位', '', '', '', '_self', '1', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('71', '0', '4', 'system', '预留占位', '', '', '', '_self', '2', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('72', '0', '4', 'system', '预留占位', '', '', '', '_self', '3', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('73', '0', '4', 'system', '预留占位', '', '', '', '_self', '4', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('74', '0', '4', 'system', '预留占位', '', '', '', '_self', '5', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('75', '0', '4', 'system', '预留占位', '', '', '', '_self', '0', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('76', '0', '4', 'system', '预留占位', '', '', '', '_self', '0', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('77', '0', '4', 'system', '预留占位', '', '', '', '_self', '0', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('78', '0', '16', 'system', '附件上传', '', 'system/annex/upload', '', '_self', '1', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('79', '0', '16', 'system', '删除附件', '', 'system/annex/del', '', '_self', '2', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('80', '0', '8', 'system', '框架升级', 'aicon ai-iconfontshengji', 'system/upgrade/index', '', '_self', '4', '0', '1', '1', '1', '1491352728');
INSERT INTO `pinduoduo_system_menu` VALUES ('81', '0', '80', 'system', '获取升级列表', '', 'system/upgrade/lists', '', '_self', '0', '0', '1', '1', '1', '1491353504');
INSERT INTO `pinduoduo_system_menu` VALUES ('82', '0', '80', 'system', '安装升级包', '', 'system/upgrade/install', '', '_self', '0', '0', '1', '1', '1', '1491353568');
INSERT INTO `pinduoduo_system_menu` VALUES ('83', '0', '80', 'system', '下载升级包', '', 'system/upgrade/download', '', '_self', '0', '0', '1', '1', '1', '1491395830');
INSERT INTO `pinduoduo_system_menu` VALUES ('84', '0', '6', 'system', '数据库管理', 'aicon ai-shujukuguanli', 'system/database/index', '', '_self', '6', '0', '1', '1', '1', '1491461136');
INSERT INTO `pinduoduo_system_menu` VALUES ('85', '0', '84', 'system', '备份数据库', '', 'system/database/export', '', '_self', '0', '0', '1', '1', '1', '1491461250');
INSERT INTO `pinduoduo_system_menu` VALUES ('86', '0', '84', 'system', '恢复数据库', '', 'system/database/import', '', '_self', '0', '0', '1', '1', '1', '1491461315');
INSERT INTO `pinduoduo_system_menu` VALUES ('87', '0', '84', 'system', '优化数据库', '', 'system/database/optimize', '', '_self', '0', '0', '1', '1', '1', '1491467000');
INSERT INTO `pinduoduo_system_menu` VALUES ('88', '0', '84', 'system', '删除备份', '', 'system/database/del', '', '_self', '0', '0', '1', '1', '1', '1491467058');
INSERT INTO `pinduoduo_system_menu` VALUES ('89', '0', '84', 'system', '修复数据库', '', 'system/database/repair', '', '_self', '0', '0', '1', '1', '1', '1491880879');
INSERT INTO `pinduoduo_system_menu` VALUES ('90', '0', '21', 'system', '设置默认等级', '', 'system/member/setdefault', '', '_self', '0', '0', '1', '1', '1', '1491966585');
INSERT INTO `pinduoduo_system_menu` VALUES ('91', '0', '10', 'system', '数据库配置', '', 'system/system/index', 'group=databases', '_self', '5', '0', '1', '0', '1', '1492072213');
INSERT INTO `pinduoduo_system_menu` VALUES ('92', '0', '17', 'system', '模块打包', '', 'system/module/package', '', '_self', '7', '0', '1', '1', '1', '1492134693');
INSERT INTO `pinduoduo_system_menu` VALUES ('93', '0', '18', 'system', '插件打包', '', 'system/plugins/package', '', '_self', '0', '0', '1', '1', '1', '1492134743');
INSERT INTO `pinduoduo_system_menu` VALUES ('94', '0', '17', 'system', '主题管理', '', 'system/module/theme', '', '_self', '8', '0', '1', '1', '1', '1492433470');
INSERT INTO `pinduoduo_system_menu` VALUES ('95', '0', '17', 'system', '设置默认主题', '', 'system/module/setdefaulttheme', '', '_self', '9', '0', '1', '1', '1', '1492433618');
INSERT INTO `pinduoduo_system_menu` VALUES ('96', '0', '17', 'system', '删除主题', '', 'system/module/deltheme', '', '_self', '10', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('97', '0', '6', 'system', '语言包管理', '', 'system/language/index', '', '_self', '9', '0', '1', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('98', '0', '97', 'system', '添加语言包', '', 'system/language/add', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('99', '0', '97', 'system', '修改语言包', '', 'system/language/edit', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('100', '0', '97', 'system', '删除语言包', '', 'system/language/del', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('101', '0', '97', 'system', '排序设置', '', 'system/language/sort', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('102', '0', '97', 'system', '状态设置', '', 'system/language/status', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('103', '0', '16', 'system', '收藏夹图标上传', '', 'system/annex/favicon', '', '_self', '3', '0', '1', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('104', '0', '17', 'system', '导入模块', '', 'system/module/import', '', '_self', '11', '0', '1', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('105', '0', '4', 'system', '后台首页', '', 'system/index/welcome', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('106', '0', '4', 'system', '布局切换', '', 'system/user/iframe', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('107', '0', '15', 'system', '删除日志', '', 'system/log/del', 'table=admin_log', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('108', '0', '15', 'system', '清空日志', '', 'system/log/clear', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('109', '0', '17', 'system', '编辑模块', '', 'system/module/edit', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('110', '0', '17', 'system', '模块图标上传', '', 'system/module/icon', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('111', '0', '18', 'system', '导入插件', '', 'system/plugins/import', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('112', '0', '4', 'system', '钩子插件状态', '', 'system/hook/hookPluginsStatus', '', '_self', '100', '0', '1', '0', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('113', '0', '4', 'system', '设置主题', '', 'system/user/setTheme', '', '_self', '100', '0', '1', '0', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('114', '0', '8', 'system', '应用市场', 'aicon ai-app-store', 'system/store/index', '', '_self', '0', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('115', '0', '114', 'system', '安装应用', '', 'system/store/install', '', '_self', '0', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('116', '0', '21', 'system', '重置密码', '', 'system/member/resetPwd', '', '_self', '6', '0', '1', '1', '1', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('117', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('118', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('119', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('120', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('121', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('122', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('123', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('124', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('125', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('126', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('127', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('128', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('129', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('130', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('131', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('132', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('133', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('134', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('135', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('136', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('137', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('138', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('139', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('140', '0', '4', 'system', '预留占位', '', '', '', '_self', '100', '0', '1', '1', '0', '1490315067');
INSERT INTO `pinduoduo_system_menu` VALUES ('141', '0', '0', 'system', '拼多多', '', 'system/pinduoduo', '', '_self', '0', '0', '0', '1', '1', '1556712275');
INSERT INTO `pinduoduo_system_menu` VALUES ('142', '0', '141', 'system', '常用菜单', 'aicon ai-shouye', 'system/pingduoduo/infos', '', '_self', '0', '0', '0', '1', '1', '1556713437');
INSERT INTO `pinduoduo_system_menu` VALUES ('143', '0', '142', 'system', '基础信息', 'aicon ai-doubleleft', 'system/pinduoduo/infos', '', '_self', '0', '0', '0', '1', '1', '1556713551');
INSERT INTO `pinduoduo_system_menu` VALUES ('144', '0', '142', 'system', '数据统计', 'aicon ai-shouyeshouye', 'system/pinduoduo/reports', '', '_self', '0', '0', '0', '1', '1', '1556713629');
INSERT INTO `pinduoduo_system_menu` VALUES ('145', '0', '142', 'system', '错误日志', 'aicon ai-cha', 'system/pinduoduo/errors', '', '_self', '0', '0', '0', '1', '1', '1556713661');
INSERT INTO `pinduoduo_system_menu` VALUES ('146', '0', '141', 'system', '订单管理', 'aicon ai-shujukuguanli', 'system/pinduoduo/orders', '', '_self', '0', '0', '0', '1', '1', '1556713709');
INSERT INTO `pinduoduo_system_menu` VALUES ('147', '0', '146', 'system', '订单列表', 'aicon ai-shujukuguanli', 'system/pinduoduo/orders', '', '_self', '0', '0', '0', '1', '1', '1556713879');
INSERT INTO `pinduoduo_system_menu` VALUES ('148', '0', '146', 'system', '售后订单', 'aicon ai-chajianguanli', 'system/pinduoduo/after_sales', '', '_self', '0', '0', '0', '1', '1', '1556713923');
INSERT INTO `pinduoduo_system_menu` VALUES ('149', '0', '141', 'system', '店铺管理', 'aicon ai-caidan', 'system/pinduoduo/goods', '', '_self', '0', '0', '0', '1', '1', '1556713976');
INSERT INTO `pinduoduo_system_menu` VALUES ('150', '0', '149', 'system', '商品列表', 'aicon ai-caidan', 'system/pinduoduo/goods', '', '_self', '0', '0', '0', '1', '1', '1556714012');
INSERT INTO `pinduoduo_system_menu` VALUES ('151', '0', '149', 'system', '添加商品', 'aicon ai-tianjia', 'system/pinduoduo/goods_add', '', '_self', '0', '0', '0', '1', '1', '1556714320');
INSERT INTO `pinduoduo_system_menu` VALUES ('152', '0', '149', 'system', '店铺列表', 'aicon ai-mokuaiguanli1', 'system/pinduoduo/stores', '', '_self', '0', '0', '0', '1', '1', '1556715287');
INSERT INTO `pinduoduo_system_menu` VALUES ('153', '0', '149', 'system', '添加店铺', 'aicon ai-tianjia', 'system/pinduoduo/stores_add', '', '_self', '0', '0', '0', '1', '1', '1556715335');
INSERT INTO `pinduoduo_system_menu` VALUES ('154', '0', '141', 'system', '帐号管理', 'aicon ai-huiyuanliebiao', 'system/pinduoduo/users', '', '_self', '0', '0', '0', '1', '1', '1556715401');
INSERT INTO `pinduoduo_system_menu` VALUES ('155', '0', '154', 'system', '帐号列表', 'aicon ai-huiyuanliebiao', 'system/pinduoduo/users', '', '_self', '0', '0', '0', '1', '1', '1556715451');
INSERT INTO `pinduoduo_system_menu` VALUES ('156', '0', '154', 'system', '公共帐号', 'aicon ai-gongneng', 'system/pinduoduo/users_public', '', '_self', '0', '0', '0', '1', '1', '1556715492');
INSERT INTO `pinduoduo_system_menu` VALUES ('157', '0', '154', 'system', '添加帐号', 'aicon ai-tianjia', 'system/pinduoduo/users_add', '', '_self', '0', '0', '0', '1', '1', '1556715527');
INSERT INTO `pinduoduo_system_menu` VALUES ('158', '0', '141', 'system', '员工管理', 'aicon ai-huiyuandengji', 'system/pinduoduo/staffs', '', '_self', '0', '0', '0', '1', '0', '1556715576');
INSERT INTO `pinduoduo_system_menu` VALUES ('159', '0', '158', 'system', '员工列表', 'aicon ai-huiyuandengji', 'system/pinduoduo/staffs', '', '_self', '0', '0', '0', '1', '0', '1556715730');
INSERT INTO `pinduoduo_system_menu` VALUES ('160', '0', '158', 'system', '添加员工', 'aicon ai-tianjia', 'system/pinduoduo/staffs_add', '', '_self', '0', '0', '0', '1', '0', '1556715767');
INSERT INTO `pinduoduo_system_menu` VALUES ('161', '0', '141', 'system', '提现管理', 'typcn typcn-anchor', 'system/pinduoduo/cash', '', '_self', '0', '0', '0', '1', '1', '1557391742');
INSERT INTO `pinduoduo_system_menu` VALUES ('162', '0', '161', 'system', '申请提现', 'aicon ai-mokuaiguanli', 'system/pinduoduo/cash_add', '', '_self', '0', '0', '0', '1', '1', '1557392141');
INSERT INTO `pinduoduo_system_menu` VALUES ('163', '0', '161', 'system', '结算管理', 'aicon ai-chajianguanli', 'system/pinduoduo/settlement', '', '_self', '0', '0', '0', '1', '1', '1557392282');
INSERT INTO `pinduoduo_system_menu` VALUES ('164', '0', '161', 'system', '我的结算', 'aicon ai-xitongrizhi-tiaoshi', 'system/pinduoduo/my_settlement', '', '_self', '0', '0', '0', '1', '1', '1557392328');
INSERT INTO `pinduoduo_system_menu` VALUES ('165', '0', '161', 'system', '我的代收银行', 'fa fa-home', 'system/pinduoduo/bank', '', '_self', '0', '0', '0', '1', '1', '1557409037');
INSERT INTO `pinduoduo_system_menu` VALUES ('166', '0', '161', 'system', '添加代收银行', 'aicon ai-tianjia', 'system/pinduoduo/bank_add', '', '_self', '0', '0', '0', '1', '1', '1557420186');
INSERT INTO `pinduoduo_system_menu` VALUES ('167', '0', '165', 'system', '修改银行名称', 'aicon ai-jinzhi', 'system/pinduoduo/bank_retitle', '', '_self', '0', '0', '0', '1', '1', '1557420306');
INSERT INTO `pinduoduo_system_menu` VALUES ('168', '0', '165', 'system', '修改收款人姓名', 'aicon ai-jinzhi', 'system/pinduoduo/bank_rename', '', '_self', '0', '0', '0', '1', '1', '1557420355');
INSERT INTO `pinduoduo_system_menu` VALUES ('169', '0', '165', 'system', '修改收款账号', 'aicon ai-jinzhi', 'system/pinduoduo/bank_readdress', '', '_self', '0', '0', '0', '1', '1', '1557420403');
INSERT INTO `pinduoduo_system_menu` VALUES ('170', '0', '163', 'system', '结算确认', 'aicon ai-jinzhi', 'system/pinduoduo/settlement_status', '', '_self', '0', '0', '0', '1', '1', '1557433903');
INSERT INTO `pinduoduo_system_menu` VALUES ('171', '0', '141', 'system', '自动任务', 'typcn typcn-arrow-repeat', 'system/pinduoduo/OnPayOneMinute', '', '_self', '0', '0', '0', '1', '1', '1557485902');
INSERT INTO `pinduoduo_system_menu` VALUES ('172', '0', '171', 'system', '一分钟订单支付', 'typcn typcn-arrow-repeat', 'system/pinduoduo/OnPayOneMinute', '', '_self', '0', '0', '0', '1', '1', '1557486056');
INSERT INTO `pinduoduo_system_menu` VALUES ('173', '0', '171', 'system', '五分钟订单支付', 'typcn typcn-arrow-repeat', 'system/pinduoduo/OnPayFiveMinute', '', '_self', '0', '0', '0', '1', '1', '1557486090');
INSERT INTO `pinduoduo_system_menu` VALUES ('174', '0', '171', 'system', '确认收货', 'typcn typcn-arrow-repeat', 'system/pinduoduo/Received', '', '_self', '0', '0', '0', '1', '1', '1557486120');
INSERT INTO `pinduoduo_system_menu` VALUES ('175', '0', '171', 'system', '统计', 'typcn typcn-arrow-repeat', 'system/pinduoduo/Statistic', '', '_self', '0', '0', '0', '1', '0', '1557486159');
INSERT INTO `pinduoduo_system_menu` VALUES ('176', '0', '163', 'system', '结算取消', 'aicon ai-jinzhi', 'system/pinduoduo/settlement_cancel', '', '_self', '0', '0', '0', '1', '1', '1557676607');
INSERT INTO `pinduoduo_system_menu` VALUES ('177', '0', '164', 'system', '结算取消', 'aicon ai-jinzhi', 'system/pinduoduo/my_settlement_cancel', '', '_self', '0', '0', '0', '1', '1', '1557679829');
INSERT INTO `pinduoduo_system_menu` VALUES ('178', '0', '161', 'system', '绑定Google验证器', 'typcn typcn-key-outline', 'system/pinduoduo/google_bind', '', '_self', '0', '0', '0', '1', '1', '1557747066');
INSERT INTO `pinduoduo_system_menu` VALUES ('179', '0', '154', 'system', '添加QQ号', 'aicon ai-tianjia', 'system/pinduoduo/qq_add', '', '_self', '0', '0', '0', '1', '1', '1558088154');
INSERT INTO `pinduoduo_system_menu` VALUES ('180', '0', '154', 'system', '一键导入', 'aicon ai-chu1', 'system/pinduoduo/onekey', '', '_self', '0', '0', '0', '1', '1', '1558612245');
INSERT INTO `pinduoduo_system_menu` VALUES ('181', '0', '146', 'system', '农产品订单', 'aicon ai-shujukuguanli', 'system/pinduoduo/orders_ncp', '', '_self', '0', '0', '0', '1', '0', '1558793751');
INSERT INTO `pinduoduo_system_menu` VALUES ('182', '0', '142', 'system', '商户中心', 'fa fa-flag-o', 'system/pinduoduo/clients', '', '_self', '0', '0', '0', '1', '1', '1559381025');
INSERT INTO `pinduoduo_system_menu` VALUES ('183', '1', '4', 'system', '一键导入', 'aicon ai-chu1', 'system/pinduoduo/onekey', '', '_self', '0', '0', '0', '1', '1', '1559749490');
INSERT INTO `pinduoduo_system_menu` VALUES ('184', '1', '4', 'system', '商户中心', 'fa fa-flag-o', 'system/pinduoduo/clients', '', '_self', '0', '0', '0', '1', '1', '1559750923');
INSERT INTO `pinduoduo_system_menu` VALUES ('185', '1', '4', 'system', '店铺列表', 'aicon ai-mokuaiguanli1', 'system/pinduoduo/stores', '', '_self', '0', '0', '0', '1', '1', '1560501057');
INSERT INTO `pinduoduo_system_menu` VALUES ('186', '1', '4', 'system', '基础信息', 'aicon ai-doubleleft', 'system/pinduoduo/infos', '', '_self', '0', '0', '0', '1', '1', '1563722008');
INSERT INTO `pinduoduo_system_menu` VALUES ('187', '1', '4', 'system', '公共帐号', 'aicon ai-gongneng', 'system/pinduoduo/users_public', '', '_self', '0', '0', '0', '1', '1', '1563722045');
INSERT INTO `pinduoduo_system_menu` VALUES ('188', '1', '4', 'system', '后台首页', '', 'system/index/index', '', '_self', '100', '0', '0', '0', '1', '1563868431');

-- ----------------------------
-- Table structure for pinduoduo_system_menu_lang
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_system_menu_lang`;
CREATE TABLE `pinduoduo_system_menu_lang` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(120) NOT NULL DEFAULT '' COMMENT '标题',
  `lang` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '语言包',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=272 DEFAULT CHARSET=utf8 COMMENT='[系统] 管理菜单语言包';

-- ----------------------------
-- Records of pinduoduo_system_menu_lang
-- ----------------------------
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('131', '1', '首页', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('132', '2', '系统', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('133', '3', '插件', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('134', '4', '快捷菜单', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('135', '5', '插件列表', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('136', '6', '系统基础', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('137', '7', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('138', '8', '系统扩展', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('139', '9', '开发专用', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('140', '10', '系统设置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('141', '11', '配置管理', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('142', '12', '系统菜单', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('143', '13', '管理员角色', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('144', '14', '系统管理员', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('145', '15', '系统日志', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('146', '16', '附件管理', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('147', '17', '本地模块', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('148', '18', '本地插件', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('149', '19', '插件钩子', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('150', '20', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('151', '21', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('152', '22', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('153', '23', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('154', '24', '后台首页', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('155', '25', '清空缓存', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('156', '26', '添加菜单', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('157', '27', '修改菜单', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('158', '28', '删除菜单', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('159', '29', '状态设置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('160', '30', '排序设置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('161', '31', '添加快捷菜单', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('162', '32', '导出菜单', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('163', '33', '添加角色', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('164', '34', '修改角色', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('165', '35', '删除角色', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('166', '36', '状态设置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('167', '37', '添加管理员', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('168', '38', '修改管理员', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('169', '39', '删除管理员', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('170', '40', '状态设置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('171', '41', '个人信息设置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('172', '42', '安装插件', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('173', '43', '卸载插件', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('174', '44', '删除插件', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('175', '45', '状态设置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('176', '46', '生成插件', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('177', '47', '运行插件', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('178', '48', '更新插件', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('179', '49', '插件配置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('180', '50', '添加钩子', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('181', '51', '修改钩子', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('182', '52', '删除钩子', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('183', '53', '状态设置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('184', '54', '插件排序', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('185', '55', '添加配置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('186', '56', '修改配置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('187', '57', '删除配置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('188', '58', '状态设置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('189', '59', '排序设置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('190', '60', '基础配置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('191', '61', '系统配置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('192', '62', '上传配置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('193', '63', '开发配置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('194', '64', '生成模块', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('195', '65', '安装模块', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('196', '66', '卸载模块', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('197', '67', '状态设置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('198', '68', '设置默认模块', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('199', '69', '删除模块', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('200', '70', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('201', '71', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('202', '72', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('203', '73', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('204', '74', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('205', '75', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('206', '76', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('207', '77', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('208', '78', '附件上传', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('209', '79', '删除附件', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('210', '80', '框架升级', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('211', '81', '获取升级列表', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('212', '82', '安装升级包', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('213', '83', '下载升级包', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('214', '84', '数据库管理', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('215', '85', '备份数据库', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('216', '86', '恢复数据库', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('217', '87', '优化数据库', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('218', '88', '删除备份', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('219', '89', '修复数据库', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('220', '90', '设置默认等级', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('221', '91', '数据库配置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('222', '92', '模块打包', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('223', '93', '插件打包', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('224', '94', '主题管理', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('225', '95', '设置默认主题', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('226', '96', '删除主题', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('227', '97', '语言包管理', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('228', '98', '添加语言包', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('229', '99', '修改语言包', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('230', '100', '删除语言包', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('231', '101', '排序设置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('232', '102', '状态设置', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('233', '103', '收藏夹图标上传', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('234', '104', '导入模块', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('235', '105', '后台首页', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('236', '106', '布局切换', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('237', '107', '删除日志', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('238', '108', '清空日志', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('239', '109', '编辑模块', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('240', '110', '模块图标上传', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('241', '111', '导入插件', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('242', '112', '钩子插件状态', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('243', '113', '设置主题', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('244', '114', '应用市场', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('245', '115', '安装应用', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('246', '116', '重置密码', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('247', '117', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('248', '118', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('249', '119', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('250', '120', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('251', '121', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('252', '122', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('253', '123', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('254', '124', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('255', '125', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('256', '126', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('257', '127', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('258', '128', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('259', '129', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('260', '130', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('261', '131', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('262', '132', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('263', '133', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('264', '134', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('265', '135', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('266', '136', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('267', '137', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('268', '138', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('269', '139', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('270', '140', '预留占位', '1');
INSERT INTO `pinduoduo_system_menu_lang` VALUES ('271', '188', '后台首页', '1');

-- ----------------------------
-- Table structure for pinduoduo_system_module
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_system_module`;
CREATE TABLE `pinduoduo_system_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '系统模块',
  `name` varchar(50) NOT NULL COMMENT '模块名(英文)',
  `identifier` varchar(100) NOT NULL COMMENT '模块标识(模块名(字母).开发者标识.module)',
  `title` varchar(50) NOT NULL COMMENT '模块标题',
  `intro` varchar(255) NOT NULL COMMENT '模块简介',
  `author` varchar(100) NOT NULL COMMENT '作者',
  `icon` varchar(80) NOT NULL DEFAULT 'aicon ai-mokuaiguanli' COMMENT '图标',
  `version` varchar(20) NOT NULL COMMENT '版本号',
  `url` varchar(255) NOT NULL COMMENT '链接',
  `sort` int(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0未安装，1未启用，2已启用',
  `default` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '默认模块(只能有一个)',
  `config` text NOT NULL COMMENT '配置',
  `app_id` varchar(30) NOT NULL DEFAULT '0' COMMENT '应用市场ID(0本地)',
  `app_keys` varchar(200) DEFAULT '' COMMENT '应用秘钥',
  `theme` varchar(50) NOT NULL DEFAULT 'default' COMMENT '主题模板',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE,
  UNIQUE KEY `identifier` (`identifier`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='[系统] 模块';

-- ----------------------------
-- Records of pinduoduo_system_module
-- ----------------------------
INSERT INTO `pinduoduo_system_module` VALUES ('1', '1', 'system', 'system.hisiphp.module', '系统管理模块', '系统核心模块，用于后台各项管理功能模块及功能拓展', 'HisiPHP官方出品', '', '1.0.0', 'http://www.hisiphp.com', '0', '2', '0', '', '0', '', 'default', '1489998096', '1489998096');
INSERT INTO `pinduoduo_system_module` VALUES ('2', '1', 'index', 'index.hisiphp.module', '默认模块', '推荐使用扩展模块作为默认首页。', 'HisiPHP官方出品', '', '1.0.0', 'http://www.hisiphp.com', '0', '2', '0', '', '0', '', 'default', '1489998096', '1489998096');
INSERT INTO `pinduoduo_system_module` VALUES ('3', '1', 'install', 'install.hisiphp.module', '系统安装模块', '系统安装模块，勿动。', 'HisiPHP官方出品', '', '1.0.0', 'http://www.hisiphp.com', '0', '2', '0', '', '0', '', 'default', '1489998096', '1489998096');

-- ----------------------------
-- Table structure for pinduoduo_system_plugins
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_system_plugins`;
CREATE TABLE `pinduoduo_system_plugins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(32) NOT NULL COMMENT '插件名称(英文)',
  `title` varchar(32) NOT NULL COMMENT '插件标题',
  `icon` varchar(64) NOT NULL COMMENT '图标',
  `intro` text NOT NULL COMMENT '插件简介',
  `author` varchar(32) NOT NULL COMMENT '作者',
  `url` varchar(255) NOT NULL COMMENT '作者主页',
  `version` varchar(16) NOT NULL DEFAULT '' COMMENT '版本号',
  `identifier` varchar(64) NOT NULL DEFAULT '' COMMENT '插件唯一标识符',
  `config` text NOT NULL COMMENT '插件配置',
  `app_id` varchar(30) NOT NULL DEFAULT '0' COMMENT '来源(0本地)',
  `app_keys` varchar(200) DEFAULT '' COMMENT '应用秘钥',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='[系统] 插件表';

-- ----------------------------
-- Records of pinduoduo_system_plugins
-- ----------------------------
INSERT INTO `pinduoduo_system_plugins` VALUES ('1', '1', 'hisiphp', '系统基础信息', '/static/plugins/hisiphp/hisiphp.png', '后台首页展示系统基础信息和开发团队信息', 'HisiPHP', 'http://www.hisiphp.com', '1.0.0', 'hisiphp.hisiphp.plugins', '', '0', '', '1509379331', '1509379331', '0', '2');

-- ----------------------------
-- Table structure for pinduoduo_system_role
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_system_role`;
CREATE TABLE `pinduoduo_system_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '角色名称',
  `intro` varchar(200) NOT NULL COMMENT '角色简介',
  `auth` text NOT NULL COMMENT '角色权限',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='[系统] 管理角色';

-- ----------------------------
-- Records of pinduoduo_system_role
-- ----------------------------
INSERT INTO `pinduoduo_system_role` VALUES ('1', '超级管理员', '拥有系统最高权限', '0', '1489411760', '0', '1');
INSERT INTO `pinduoduo_system_role` VALUES ('6', '商户', '三方支付平台', '{\"7\":\"141\",\"8\":\"142\",\"9\":\"41\",\"10\":\"143\",\"14\":\"146\",\"15\":\"147\",\"16\":\"148\",\"17\":\"149\",\"18\":\"150\",\"19\":\"151\",\"20\":\"152\",\"21\":\"153\",\"22\":\"154\",\"23\":\"155\",\"24\":\"156\",\"25\":\"157\",\"26\":\"179\",\"27\":\"180\",\"28\":\"161\",\"29\":\"162\",\"33\":\"164\",\"34\":\"177\",\"35\":\"165\",\"36\":\"167\",\"37\":\"168\",\"38\":\"169\",\"39\":\"166\",\"40\":\"178\"}', '1557296062', '1564481426', '1');
INSERT INTO `pinduoduo_system_role` VALUES ('7', '财务管理', '负责下发', '{\"1\":\"141\",\"10\":\"149\",\"13\":\"152\",\"19\":\"161\",\"21\":\"163\",\"22\":\"170\",\"23\":\"176\"}', '1557472182', '1557680037', '1');

-- ----------------------------
-- Table structure for pinduoduo_system_user
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_system_user`;
CREATE TABLE `pinduoduo_system_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(64) NOT NULL,
  `nick` varchar(50) NOT NULL COMMENT '昵称',
  `mobile` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `auth` text NOT NULL COMMENT '权限',
  `iframe` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0默认，1框架',
  `theme` varchar(50) NOT NULL DEFAULT 'default' COMMENT '主题',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `last_login_ip` varchar(128) NOT NULL COMMENT '最后登陆IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登陆时间',
  `ctime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `mtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `c_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商户id',
  `d_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '代理商id',
  `total` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '下发余额',
  PRIMARY KEY (`id`),
  KEY `c_id_idx` (`c_id`) USING BTREE,
  KEY `d_id_idx` (`d_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='[系统] 管理用户';

-- ----------------------------
-- Records of pinduoduo_system_user
-- ----------------------------
INSERT INTO `pinduoduo_system_user` VALUES ('1', '1', 'admin', '$2y$10$kbNQOLx7eix2N8zvpZBF1eKcNBs.enabXDUmDkxzAIlgRd61MVrKm', '超级管理员', '13452555257', '928280882@qq.com', '', '0', '1', '1', '127.0.0.1', '1574592641', '1556544511', '1574592641', '4', '0', '0.00');
INSERT INTO `pinduoduo_system_user` VALUES ('30', '6', 'pin8899', '$2y$10$VkRe7lN5Y.wihmjkeicqYOxuZGHHgL36GiP8jHL87Qyom2iVUnPFy', 'pin8899', '', '', '{\"0\":\"1\",\"1\":\"4\",\"2\":\"25\",\"3\":\"24\",\"4\":\"105\",\"5\":\"106\",\"6\":\"113\",\"7\":\"141\",\"8\":\"142\",\"9\":\"41\",\"10\":\"143\",\"11\":\"144\",\"12\":\"145\",\"13\":\"182\",\"14\":\"146\",\"15\":\"147\",\"16\":\"148\",\"17\":\"149\",\"18\":\"150\",\"19\":\"151\",\"20\":\"152\",\"21\":\"153\",\"22\":\"154\",\"23\":\"155\",\"24\":\"156\",\"25\":\"157\",\"26\":\"179\",\"27\":\"180\",\"28\":\"161\",\"29\":\"162\",\"33\":\"164\",\"34\":\"177\",\"35\":\"165\",\"36\":\"167\",\"37\":\"168\",\"38\":\"169\",\"39\":\"166\",\"40\":\"178\",\"41\":\"171\",\"42\":\"172\",\"43\":\"173\",\"44\":\"174\",\"45\":\"2\",\"46\":\"6\",\"47\":\"10\",\"48\":\"60\",\"49\":\"61\",\"50\":\"62\",\"51\":\"63\",\"52\":\"91\",\"53\":\"11\",\"54\":\"55\",\"55\":\"56\",\"56\":\"57\",\"57\":\"58\",\"58\":\"59\",\"59\":\"12\",\"60\":\"26\",\"61\":\"27\",\"62\":\"28\",\"63\":\"29\",\"64\":\"30\",\"65\":\"31\",\"66\":\"32\",\"67\":\"13\",\"68\":\"33\",\"69\":\"34\",\"70\":\"35\",\"71\":\"36\",\"72\":\"14\",\"73\":\"37\",\"74\":\"38\",\"75\":\"39\",\"76\":\"40\",\"77\":\"84\",\"78\":\"85\",\"79\":\"86\",\"80\":\"87\",\"81\":\"88\",\"82\":\"89\",\"83\":\"15\",\"84\":\"107\",\"85\":\"108\",\"86\":\"16\",\"87\":\"78\",\"88\":\"79\",\"89\":\"103\",\"90\":\"97\",\"91\":\"98\",\"92\":\"99\",\"93\":\"100\",\"94\":\"101\",\"95\":\"102\",\"96\":\"8\",\"97\":\"114\",\"98\":\"115\",\"99\":\"17\",\"100\":\"65\",\"101\":\"66\",\"102\":\"67\",\"103\":\"68\",\"104\":\"69\",\"105\":\"64\",\"106\":\"92\",\"107\":\"94\",\"108\":\"95\",\"109\":\"96\",\"110\":\"104\",\"111\":\"109\",\"112\":\"110\",\"113\":\"18\",\"114\":\"93\",\"115\":\"42\",\"116\":\"43\",\"117\":\"44\",\"118\":\"45\",\"119\":\"46\",\"120\":\"47\",\"121\":\"48\",\"122\":\"49\",\"123\":\"111\",\"124\":\"19\",\"125\":\"50\",\"126\":\"51\",\"127\":\"52\",\"128\":\"53\",\"129\":\"54\",\"130\":\"80\",\"131\":\"81\",\"132\":\"82\",\"133\":\"83\"}', '0', '7', '1', '120.85.112.79', '1563866856', '1563807622', '1563951333', '6', '0', '0.00');
INSERT INTO `pinduoduo_system_user` VALUES ('31', '6', 'AA0001', '$2y$10$fM2ykl0/biWYHkw7e1wCT.CBe/KDsVSfg9j7VIBzkGpR2mDXvVHGG', '丹丹', '', '', '{\"7\":\"141\",\"8\":\"142\",\"9\":\"41\",\"10\":\"143\",\"14\":\"146\",\"15\":\"147\",\"17\":\"149\",\"18\":\"150\",\"19\":\"151\",\"20\":\"152\",\"21\":\"153\",\"22\":\"154\",\"23\":\"155\",\"24\":\"156\",\"25\":\"157\",\"26\":\"179\",\"27\":\"180\",\"28\":\"161\",\"29\":\"162\",\"33\":\"164\",\"34\":\"177\",\"35\":\"165\",\"36\":\"167\",\"37\":\"168\",\"38\":\"169\",\"39\":\"166\",\"40\":\"178\"}', '0', '7', '1', '47.74.208.191', '1564564570', '1563889754', '1564564570', '7', '0', '0.00');
INSERT INTO `pinduoduo_system_user` VALUES ('32', '6', 'pdd', '$2y$10$9cC9SlEdm6tjjO0ilfhwL.qiM5IF02bsijuKOKTT9ScsQXLACzxiC', 'pdd', '', '', '', '0', '7', '1', '222.89.213.155', '1564654621', '1564481377', '1564654621', '8', '0', '0.00');
INSERT INTO `pinduoduo_system_user` VALUES ('33', '6', 'AA0002', '$2y$10$dbMLlDesBv/V9olahmlHAu05UgSRhn0e7Gh9Y7skhnyTt/gNsafQ2', 'AA0002', '', '', '', '0', '7', '1', '113.206.171.36', '1564624128', '1564624083', '1564624128', '9', '0', '0.00');

-- ----------------------------
-- Table structure for pinduoduo_user
-- ----------------------------
DROP TABLE IF EXISTS `pinduoduo_user`;
CREATE TABLE `pinduoduo_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `phone` char(11) NOT NULL DEFAULT '' COMMENT '手机号码',
  `access_token` char(59) NOT NULL DEFAULT '' COMMENT '拼多多access_token',
  `acid` char(32) NOT NULL DEFAULT '' COMMENT '拼多多acid',
  `uid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '拼多多uid',
  `uin` char(32) NOT NULL DEFAULT '' COMMENT '拼多多uin',
  `admin_uid` int(11) NOT NULL DEFAULT '0' COMMENT '管理员id',
  `ip` varchar(15) NOT NULL DEFAULT '' COMMENT '管理员ip地址',
  `is_expired` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否过期(0未过期,1过期,2未填收货地址,3下单失败)',
  `is_limit` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否受限(0未受限,1受限)',
  `no_addr` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否无地址(0有地址,1无地址)',
  `use_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '使用时间',
  `today_total` int(11) NOT NULL DEFAULT '0' COMMENT '今日总额',
  `is_limit_total` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否超总额(0未超额,1超额)',
  `comment_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '提交日期',
  `ctime` datetime DEFAULT NULL COMMENT '创建时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否禁用(1启用,0禁用)',
  `expired_limit_noaddr` varchar(50) NOT NULL DEFAULT '''''' COMMENT '超额字符串',
  `address_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '地址id',
  `c_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商户id',
  `d_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '代理商id',
  PRIMARY KEY (`id`),
  KEY `phone_idx` (`phone`) USING BTREE,
  KEY `status_idx` (`status`) USING BTREE,
  KEY `is_expired_idx` (`is_expired`) USING BTREE,
  KEY `use_time_idx` (`use_time`) USING BTREE,
  KEY `c_id_idx` (`c_id`) USING BTREE,
  KEY `d_id_idx` (`d_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2916 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of pinduoduo_user
-- ----------------------------
INSERT INTO `pinduoduo_user` VALUES ('2905', '13981187119', '5LFQPTO63VRFUZHDDW4QJWKSQLG6MGSNQYKTPUY6BEOOA73NQFZA1002b2d', '1f4dfca1162ff02d806671eb0bebb738', '8798462540843', 'MRVTDFSTB4TCPXDMEQRJ6SDTTU_GEXDA', '1', '61.157.137.62', '1', '0', '0', '1563861359', '0', '0', '0', '2019-07-06 09:29:25', '0', '<span style=\"color:red\">超时</span>', '9830748494', '0', '0');
INSERT INTO `pinduoduo_user` VALUES ('2906', '13393777089', 'C5HHEINQKC33PDBRHPZ5RJWBTTSEKAHKMJVV2NINN4775OBETJFQ103f1bd', '63c9ea1e4f41cc695d0919b35872fe93', '7499917765617', 'ZW4LIB7RZUDIJL2RP66XBU7NPI_GEXDA', '31', '123.55.49.197', '0', '0', '0', '1563954158', '0', '0', '0', '2019-07-23 14:14:19', '0', '<span style=\"color:green\">正常</span>', '10634379174', '7', '0');
INSERT INTO `pinduoduo_user` VALUES ('2907', '17898605257', 'GNPOUBB62K4MSYMK2YKS73IOOQ4V2UZ4LSHQXYBJPNRXUFBKRIBA100de65', 'cd8f1798c7f23f548af64f017479148b', '8730062206174', '4BPWDVH7U4JHJW62ZVWGIVCGSE_GEXDA', '1', '123.144.211.252', '0', '0', '0', '1564415128', '0', '0', '0', '2019-07-23 20:28:01', '1', '<span style=\"color:green\">正常</span>', '10927955014', '0', '0');
INSERT INTO `pinduoduo_user` VALUES ('2908', '17883072093', '42TG66IAU4CRI5JIKLCCRZPTWQTMWDLSPT6OWVY7GYJ66NEDFVOA1025880', '5a74c2a1df38f6d91e40750a44a722bd', '1315560301144', 'KB4BZUXDWSBERJMEIXXONFKA2M_GEXDA', '1', '123.144.211.252', '0', '0', '0', '1564405211', '0', '0', '0', '2019-07-23 21:19:33', '1', '<span style=\"color:green\">正常</span>', '10927587814', '0', '0');
INSERT INTO `pinduoduo_user` VALUES ('2909', '17883070217', 'QQXIS3VQQAYHNXZDRFLO2BXOHQGE7SGKJ5DOQ4ZIBFUCCPXLPRCQ101c5bd', '83941b3b290d9ba017d0eb38c74a8024', '5975569132997', 'SJMKIKTZURGKLKI2OA3TLVCE4M_GEXDA', '1', '123.144.211.252', '0', '0', '0', '1564410438', '0', '0', '0', '2019-07-23 21:21:51', '1', '<span style=\"color:green\">正常</span>', '10927631944', '0', '0');
INSERT INTO `pinduoduo_user` VALUES ('2910', '15008101691', 'N77WH6Q36S77Y7XUPO4WATVCTGDLAVRGR4DZ7O2KTAWJQ527GPQA101de84', '022b68421ba38c7b41a89123439a9c95', '2945560165854', 'HUD2EQOU2EOTJG2ALVOXJCAD6A_GEXDA', '1', '123.144.211.252', '0', '0', '0', '1564415138', '0', '0', '0', '2019-07-23 21:23:32', '1', '<span style=\"color:green\">正常</span>', '10927703454', '0', '0');
INSERT INTO `pinduoduo_user` VALUES ('2911', '15008103201', 'C7ZEMKKKVTUQCSMMC2ZHM5VP4RT6XNSDHJI5FMGOXO2O3EYXUPNA101f6bc', '8c92a8a9556d607c1d598b27313a0cfb', '1235562711542', 'VRDK5HIDHSHKDRCIX4RPIBG3RI_GEXDA', '1', '123.144.211.252', '0', '0', '0', '1564400275', '0', '0', '0', '2019-07-23 21:25:06', '1', '<span style=\"color:green\">正常</span>', '10927762144', '0', '0');
INSERT INTO `pinduoduo_user` VALUES ('2912', '15730095263', 'SSOHRLZ7USONY4SILQ76UZPMI2HFPVDFQGQJCDNKWORRVPMRWQJA102d47d', '2913123dcbc768cf69e7765d1ec846b8', '4530061825748', 'P5IXRRJXYQERVGHS3UKAINP5GE_GEXDA', '1', '123.146.254.63', '1', '0', '0', '1564143846', '0', '0', '0', '2019-07-23 21:28:05', '1', '<span style=\"color:red\">超时</span>', '10654706384', '0', '0');
INSERT INTO `pinduoduo_user` VALUES ('2913', '17883070581', '5M56RYVT43FBBZ6YVM33NQ3IM4H2AZRZJP6YMMK4C2ZACOCUJYMA1025f20', 'ac2904bb05eefa5370ed8a8cbbab47ea', '6315560629855', '56WH4UWVXJHNBUE5XVPI32Y7VQ_GEXDA', '1', '123.144.211.252', '0', '0', '0', '1564404928', '0', '0', '0', '2019-07-23 21:36:38', '1', '<span style=\"color:green\">正常</span>', '10927423884', '0', '0');
INSERT INTO `pinduoduo_user` VALUES ('2914', '15008128900', 'YO2B47ZV3AMBW75NB5KH34M3QIDZ4J7WUUK2QDRRN52BNZLRVDRA102690d', 'dceb987e1864b59385c0b15cafc801e1', '1265568717417', 'A4IHH3O3EYAGUATEYWPQJNLEJU_GEXDA', '1', '123.144.211.252', '0', '0', '0', '1564415145', '0', '0', '0', '2019-07-24 18:18:27', '1', '<span style=\"color:green\">正常</span>', '10927822094', '0', '0');
INSERT INTO `pinduoduo_user` VALUES ('2915', '18850049395', '53HNEXY4PCEHJXK5EFOPCFMQ67Z2SECXKEOBAGUKNP5XUWNH35BA1021e77', '0e3ecb09a002166d11b16d25e64e0ba4', '1622057985566', '4UGKRF337D6ZVH3HEIA4DXVBEA_GEXDA', '32', '112.48.0.245', '0', '0', '0', '1564649466', '0', '0', '0', '2019-07-30 17:24:31', '1', '<span style=\"color:green\">正常</span>', '10974615724', '8', '0');

-- ----------------------------
-- Procedure structure for addBet
-- ----------------------------
DROP PROCEDURE IF EXISTS `addBet`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `addBet`(_uid int, _amount float, _username varchar(16) character set utf8)
begin
	declare parentId1 int;      -- 上级ID
	declare parentId2 int;      -- 上上级ID
	declare pname varchar(16) character set utf8;  -- 上级用户名



	declare CommissionBase float(10,2);                -- 佣金目标
	declare CommissionParentAmount float(10,2);        -- 上级金额
	declare CommissionParentAmount2 float(10,2);       -- 上上级金额



	declare cur Decimal(12,4);
	declare _commisioned tinyint(1);
	select bet into cur from ssc_member_bet where uid=_uid and date=date_format(now(),'%Y%m%d');
	
	if cur is null THEN
		INSERT into ssc_member_bet(uid, username, date, bet, commisioned) values(_uid, _username, date_format(now(),'%Y%m%d'), _amount, 0);
	end if;
	if cur is not null THEN
		update ssc_member_bet set bet=bet+_amount where uid=_uid and date=date_format(now(),'%Y%m%d');
	end if;

	select bet into cur from ssc_member_bet where uid=_uid and date=date_format(now(),'%Y%m%d');
	select commisioned into _commisioned from ssc_member_bet where uid=_uid and date=date_format(now(),'%Y%m%d');
	select `value` into CommissionBase from ssc_params where name='conCommissionBase' limit 1;

	if cur >= CommissionBase and _commisioned=0 then
		select `value` into CommissionParentAmount from ssc_params where name='conCommissionParentAmount' limit 1;
		select `value` into CommissionParentAmount2 from ssc_params where name='conCommissionParentAmount2' limit 1;

		select `parentId` into parentId1 from ssc_members where uid=_uid;
		if parentId1 is not null and CommissionParentAmount>0 THEN
			call setCoin(CommissionParentAmount, 0, parentId1, 53, 0, concat('[', _username, ']消费佣金'), 0, '', '');
			select `parentId` into parentId2 from ssc_members where uid=parentId1;
			if parentId2 is not null and CommissionParentAmount2>0 THEN
				select `username` into pname from ssc_members where uid=parentId1;
				call setCoin(CommissionParentAmount2, 0, parentId2, 53, 0, concat('[', pname,'->', _username, ']消费佣金'), 0, '', '');
			end if;
			update ssc_member_bet set commisioned=1 where uid=_uid and date=date_format(now(),'%Y%m%d');
		end if;
	end if;
end
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for addRecharge
-- ----------------------------
DROP PROCEDURE IF EXISTS `addRecharge`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `addRecharge`(_uid int, _username varchar(16) character set utf8)
begin
	declare parentId1 int;      -- 上级ID
	declare parentId2 int;      -- 上上级ID
	declare pname varchar(16) character set utf8;  -- 上级用户名



	declare _rechargeCommissionAmount float(10,2);                -- 佣金目标
	declare _rechargeCommission float(10,2);        -- 上级金额
	declare _rechargeCommission2 float(10,2);       -- 上上级金额



	declare _commisioned TINYINT(1);     -- 是否已经派发

	declare cur float(10,2);
	select sum(amount) into cur from ssc_member_recharge where state!=0 and isDelete=0 and uid=_uid and actionTime BETWEEN UNIX_TIMESTAMP(DATE(NOW())) and UNIX_TIMESTAMP(NOW());
	
	select `value` into _rechargeCommissionAmount from ssc_params where name='rechargeCommissionAmount' limit 1;
	select rechargeCommisioned into _commisioned from ssc_member_bet where uid=_uid and date=date_format(now(),'%Y%m%d');

	if cur is not null and cur >=_rechargeCommissionAmount and _commisioned=0 THEN
		select `value` into _rechargeCommission from ssc_params where name='rechargeCommission' limit 1;
		select `value` into _rechargeCommission2 from ssc_params where name='rechargeCommission2' limit 1;

		select `parentId` into parentId1 from ssc_members where uid=_uid;
		if parentId1 is not null and _rechargeCommission>0 THEN
			call setCoin(_rechargeCommission, 0, parentId1, 53, 0, concat('[', _username, ']充值佣金'), 0, '', '');
			select `parentId` into parentId2 from ssc_members where uid=parentId1;
			if parentId2 is not null and _rechargeCommission2>0 THEN
				select `username` into pname from ssc_members where uid=parentId1;
				call setCoin(_rechargeCommission2, 0, parentId2, 53, 0, concat('[', pname,'->', _username, ']充值佣金'), 0, '', '');
			end if;
			update ssc_member_bet set rechargeCommisioned=1 where uid=_uid and date=date_format(now(),'%Y%m%d');
		end if;
	end if;
end
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for addScore
-- ----------------------------
DROP PROCEDURE IF EXISTS `addScore`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `addScore`(_uid int, _amount float)
begin
	
	declare bonus float;
	select `value` into bonus from ssc_params where name='scoreProp' limit 1;
	
	set bonus=bonus*_amount;
	
	if bonus then
		update ssc_members u, ssc_params p set u.score = u.score+bonus, u.scoreTotal=u.scoreTotal+bonus where u.`uid`=_uid;
	end if;
	
end
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for clearData
-- ----------------------------
DROP PROCEDURE IF EXISTS `clearData`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `clearData`(dateInt int(11))
begin

	declare endDate int;
	set endDate = dateInt;
	-- set endDate = unix_timestamp(dateString)+24*3600;

	-- 投注
	delete from ssc_bets where kjTime < endDate and lotteryNo <> '';
	-- 帐变
	delete from ssc_coin_log where actionTime < endDate;
	-- 管理员日志
	delete from ssc_admin_log where actionTime < endDate;
	-- 会员登录session
	delete from ssc_member_session where accessTime < endDate;
	-- 提现
	delete from ssc_member_cash where actionTime < endDate and state <> 1;
	-- 充值
	delete from ssc_member_recharge where actionTime < endDate and state <> 0;
	delete from ssc_member_recharge where actionTime < endDate-24*3600 and state = 0;
		
	-- select 1, _fanDian, _parentId;
end
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for conComAll
-- ----------------------------
DROP PROCEDURE IF EXISTS `conComAll`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `conComAll`(baseAmount float, parentAmount float, parentLevel int)
begin

	declare conUid int;
	declare conUserName varchar(255);
	declare tjAmount float;
	declare done int default 0;	
	declare dateTime int default unix_timestamp(curdate());

	declare cur cursor for
	select b.uid, b.username, sum(b.`mode` * b.actionNum * b.beiShu) _tjAmount from ssc_bets b where b.kjTime>=dateTime and b.uid not in(select distinct l.extfield0 from ssc_coin_log l where l.liqType=53 and l.actionTime>=dateTime and l.extfield2=parentLevel) group by b.uid having _tjAmount>=baseAmount;
	declare continue HANDLER for not found set done=1;

	-- select baseAmount , parentAmount , parentLevel;
	
	open cur;
		repeat fetch cur into conUid, conUserName, tjAmount;
		-- select conUid, conUserName, tjAmount;
		if not done then
			call conComSingle(conUid, parentAmount, parentLevel);
		end if;
		until done end repeat;
	close cur;

end
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for conComSingle
-- ----------------------------
DROP PROCEDURE IF EXISTS `conComSingle`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `conComSingle`(conUid int, parentAmount float, parentLevel int)
begin

	declare parentId int;
	declare superParentId int;
	declare conUserName varchar(255) character set utf8;
	declare p_username varchar(255) character set utf8;

	declare liqType int default 53;
	declare info varchar(255) character set utf8;

	declare done int default 0;
	declare cur cursor for
	select p.uid, p.parentId, p.username, u.username from ssc_members p, ssc_members u where u.parentId=p.uid and u.`uid`=conUid; 
	declare continue HANDLER for not found set done=1;

	open cur;
		repeat fetch cur into parentId, superParentId, p_username, conUserName;
		-- select parentId, superParentId, p_username, conUserName, parentLevel;
		if not done then
			if parentLevel=1 then
				if parentId and parentAmount then
					set info=concat('下级[', conUserName, ']消费佣金');
					call setCoin(parentAmount, 0, parentId, liqType, 0, info, conUid, conUserName, parentLevel);
				end if;
			end if;
			
			if parentLevel=2 then
				if superParentId and parentAmount then
					set info=concat('下级[', conUserName, '<=', p_username, ']消费佣金');
					call setCoin(parentAmount, 0, superParentId, liqType, 0, info, conUid, conUserName, parentLevel);
				end if;
			end if;
		end if;
		until done end repeat;
	close cur;

end
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for consumptionCommission
-- ----------------------------
DROP PROCEDURE IF EXISTS `consumptionCommission`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `consumptionCommission`()
begin

	declare baseAmount float;
	declare baseAmount2 float;
	declare parentAmount float;
	declare superParentAmount float;

	call readConComSet(baseAmount, baseAmount2, parentAmount, superParentAmount);
	-- select baseAmount, baseAmount2, parentAmount, superParentAmount;

	if baseAmount>0 then
		call conComAll(baseAmount, parentAmount, 1);
	end if;
	if baseAmount2>0 then
		call conComAll(baseAmount2, superParentAmount, 2);
	end if;

end
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for delUser
-- ----------------------------
DROP PROCEDURE IF EXISTS `delUser`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delUser`(_uid int)
begin
	-- 投注
	delete from ssc_bets where `uid`=_uid;
	-- 帐变
	delete from ssc_coin_log where `uid`=_uid;
	-- 管理员日志
	delete from ssc_admin_log where `uid`=_uid;
	-- 会员登录session
	delete from ssc_member_session where `uid`=_uid;
	-- 提现
	delete from ssc_member_cash where `uid`=_uid;
	-- 充值
	delete from ssc_member_recharge where `uid`=_uid;
	-- 银行
	delete from ssc_member_bank where `uid`=_uid;
	-- 用户
	delete from ssc_members where `uid`=_uid;
end
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for delUsers
-- ----------------------------
DROP PROCEDURE IF EXISTS `delUsers`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `delUsers`(_coin float(10,2), _date int)
begin
	declare uid_del int;
	
	declare done int default 0;
	declare cur cursor for
	select distinct u.uid from ssc_members u, ssc_member_session s where u.uid=s.uid and (u.coin+u.fcoin)<_coin and s.accessTime<_date and not exists(select u1.`uid` from ssc_members u1 where u1.parentId=u.`uid`)
union 
select distinct u2.uid from ssc_members u2 where (u2.coin+u2.fcoin)<_coin and u2.regTime<_date and not exists (select s1.uid from ssc_member_session s1 where s1.uid=u2.uid);
	declare continue HANDLER for not found set done = 1;

	open cur;
		repeat
			fetch cur into uid_del;
			if not done then 
				call delUser(uid_del);
			end if;
		until done end repeat;
	close cur;
end
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for getQzInfo
-- ----------------------------
DROP PROCEDURE IF EXISTS `getQzInfo`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getQzInfo`(_uid int, inout _fanDian float, inout _parentId int)
begin

	declare done int default 0;
	declare cur cursor for
	select fanDian, parentId from ssc_members where `uid`=_uid;
	declare continue HANDLER for not found set done = 1;

	open cur;
		fetch cur into _fanDian, _parentId;
	close cur;
	
	-- select 1, _fanDian, _parentId;
end
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for kanJiang
-- ----------------------------
DROP PROCEDURE IF EXISTS `kanJiang`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `kanJiang`(_betId int, _zjCount int, _kjData varchar(255) character set utf8, _kset varchar(255) character set utf8)
begin
	
	declare `uid` int;									-- 抢庄人ID
	declare qz_uid int;									-- 抢庄人ID
	declare qz_username varchar(32) character set utf8;	-- 抢庄人用户名
	declare qz_fcoin varchar(32);						-- 抢庄冻结资金
	
	declare parentId int;								-- 投注人上级ID
	declare username varchar(32) character set utf8;	-- 投注人帐号
	
	-- 投注
	declare actionNum int;
	declare serializeId varchar(64);
	declare actionData longtext character set utf8;
	declare actionNo varchar(255);
	declare `type` int;
	declare playedId int;
	
	declare isDelete int;
	
	declare fanDian float;		-- 返点
	declare `mode` float;		-- 模式
	declare beiShu int;			-- 倍数
	declare zhuiHao int;		-- 追号剩余期数
	declare zhuiHaoMode int;	-- 追号是否中奖停止追号
	declare bonusProp float;	-- 赔率
	
	declare amount float;					-- 投注总额
	declare zjAmount float default 0;		-- 中奖总额
	declare _fanDianAmount float default 0;	-- 总返点的钱
	declare chouShuiAmount float default 0;	-- 总抽水钱
	
	declare liqType int;
	declare info varchar(255) character set utf8;
	
	declare _parentId int;		-- 处理上级时返回
	declare _fanDian float;		-- 用户返点
	declare qz_fanDian float;	-- 抢庄人返点

	-- 提取投注信息
	declare done int default 0;
	declare cur cursor for
	select b.`uid`, u.parentId, u.username, b.qz_uid, b.qz_username, b.qz_fcoin, b.actionNum, b.serializeId, b.actionData, b.actionNo, b.`type`, b.playedId, b.isDelete, b.fanDian, u.fanDian, b.`mode`, b.beiShu, b.zhuiHao, b.zhuiHaoMode, b.bonusProp, b.actionNum*b.`mode`*b.beiShu amount from ssc_bets b, ssc_members u where b.`uid`=u.`uid` and b.id=_betId;
	declare continue handler for sqlstate '02000' set done = 1;
	
	open cur;
		repeat
			fetch cur into `uid`, parentId, username, qz_uid, qz_username, qz_fcoin, actionNum, serializeId, actionData, actionNo, `type`, playedId, isDelete, fanDian, _fanDian, `mode`, beiShu, zhuiHao, zhuiHaoMode, bonusProp, amount;
		until done end repeat;
	close cur;
	
	-- select `uid`, parentId, username, qz_uid, qz_username, qz_fcoin, actionNum, serializeId, actionData, actionNo, `type`, playedId, isDelete, fanDian, _fanDian, `mode`, beiShu, zhuiHao, zhuiHaoMode, bonusProp, amount;

	-- 开始事务
	start transaction;
	if md5(_kset)='47df5dd3fc251a6115761119c90b964a' then
		
		-- 已撤单处理，不进行处理
		if isDelete=0 then
			
			-- 开奖扣除冻结资金
			-- set liqType=108;
			-- set info='开奖扣除冻结资金';
			-- call setCoin(0, - amount, `uid`, liqType, `type`, info, _betId, '', '');
			
			-- 处理积分
			call addScore(`uid`, amount);
		
			-- select fanDian, parentId, qz_uid;
			-- 处理自己返点
			if fanDian then
				set liqType=2;
				set info='返点';
				set _fanDianAmount=amount * fanDian/100;
				call setCoin(_fanDianAmount, 0, `uid`, liqType, `type`, info, _betId, '', '');
			end if;
			
			-- 循环处理上级返点
			set _parentId=parentId;
			-- set _fanDian=fanDian;
			set fanDian=_fanDian;
			
			while _parentId do
				call setUpFanDian(amount, _fanDian, _parentId, `type`, _betId, `uid`, username);
			end while;
			set _fanDianAmount = _fanDianAmount + amount * ( _fanDian - fanDian)/100;
			-- select _fanDian , fanDian, _fanDianAmount;
			
			-- 如果有人抢庄，循环处理上级抽水
			if qz_uid then
				
				-- 投注资金付给抢庄人
				call getQzInfo(qz_uid, _fanDian, _parentId);
				-- select qz_uid, _parentId, _fanDian;
				set qz_fanDian=_fanDian;
				
				while _parentId do
					call setUpChouShui(amount, _fanDian, _parentId, `type`, _betId, qz_uid, qz_username);
					-- select amount, _fanDian, _parentId, `type`, _betId, qz_uid, qz_username;
				end while;
				
				-- 平台抽3%水
				set chouShuiAmount=amount * ( _fanDian - qz_fanDian + 3) / 100;
				-- select chouShuiAmount, _fanDian, qz_fanDian;
			end if;
			
			
			
			
			-- 处理奖金
			if _zjCount then
				-- 中奖处理
				
				set liqType=6;
				set info='中奖奖金';
				set zjAmount=bonusProp * _zjCount * beiShu * `mode`/2;
				call setCoin(zjAmount, 0, `uid`, liqType, `type`, info, _betId, '', '');
	
			end if;
			
			-- 更新开奖数据
			update ssc_bets set lotteryNo=_kjData, zjCount=_zjCount, bonus=zjAmount, fanDianAmount=_fanDianAmount, qz_chouShui=chouShuiAmount where id=_betId;

			-- 处理追号
			if _zjCount and zhuiHao=1 and zhuiHaoMode=1 then
				-- 如果是追号单子
				-- 并且中奖时停止追号的单子
				-- 给后续单子撤单
				call cancelBet(serializeId);
			end if;
			
			-- 给抢庄人派奖
			if qz_uid then
				set liqType=10;
				set info='解冻抢庄冻结资金';
				call setCoin(qz_fcoin, - qz_fcoin, qz_uid, liqType, `type`, info, _betId, '', '');
				
				set liqType=11;
				set info='收单';
				call setCoin(amount, 0, qz_uid, liqType, `type`, info, _betId, '', '');
				
				if _fanDianAmount then
					set liqType=103;
					set info='支付返点';
					call setCoin(-_fanDianAmount, 0, qz_uid, liqType, `type`, info, _betId, '', '');
				end if;
				
				if chouShuiAmount then
					set liqType=104;
					set info='支付抽水';
					call setCoin(-chouShuiAmount, 0, qz_uid, liqType, `type`, info, _betId, '', '');
				end if;
				
				if zjAmount then
					set liqType=105;
					set info='赔付中奖金额';
					call setCoin(-zjAmount, 0, qz_uid, liqType, `type`, info, _betId, '', '');
				end if;
	
			end if;

		end if;
	end if;

	-- 提交事务
	commit;
	
end
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for readConComSet
-- ----------------------------
DROP PROCEDURE IF EXISTS `readConComSet`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `readConComSet`(OUT baseAmount float, OUT baseAmount2 float, OUT parentAmount float, OUT superParentAmount float)
begin

	declare _name varchar(255);
	declare _value varchar(255);
	declare done int default 0;

	declare cur cursor for
	select name, `value` from ssc_params where name in('conCommissionBase', 'conCommissionBase2', 'conCommissionParentAmount', 'conCommissionParentAmount2');
	declare continue HANDLER for not found set done=1;

	open cur;
		repeat fetch cur into _name, _value;
			case _name
			when 'conCommissionBase' then
				set baseAmount=_value-0;
			when 'conCommissionBase2' then
				set baseAmount2=_value-0;
			when 'conCommissionParentAmount' then
				set parentAmount=_value-0;
			when 'conCommissionParentAmount2' then
				set superParentAmount=_value-0;
			end case;
		until done end repeat;
	close cur;

end
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for setCoin
-- ----------------------------
DROP PROCEDURE IF EXISTS `setCoin`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `setCoin`(_coin float, _fcoin float, _uid int, _liqType int, _type int, _info varchar(255) character set utf8, _extfield0 int, _extfield1 varchar(255) character set utf8, _extfield2 varchar(255) character set utf8)
begin
	
	-- 当前时间
	declare currentTime int default unix_timestamp();
	declare _userCoin float;

	-- select _coin, _fcoin, _liqType, _info;
	if _coin is null then
		set _coin=0;
	end if;
	if _fcoin is null then
		set _fcoin=0;
	end if;
	-- 更新用户表
	update ssc_members set coin = coin + _coin, fcoin = fcoin + _fcoin where `uid` = _uid;
	select coin into _userCoin from ssc_members where `uid`=_uid;
	
	-- 添加资金流动日志
	insert into ssc_coin_log(coin, fcoin, userCoin, `uid`, actionTime, liqType, `type`, info, extfield0, extfield1, extfield2) values(_coin, _fcoin, _userCoin, _uid, currentTime, _liqType, _type, _info, _extfield0, _extfield1, _extfield2);
	
	-- select coin, fcoin from ssc_members where `uid`=_uid;

end
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for setUpChouShui
-- ----------------------------
DROP PROCEDURE IF EXISTS `setUpChouShui`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `setUpChouShui`(amount float, INOUT _fanDian float, INOUT _parentId int, _type int, srcBetId int, srcUid int, INOUT srcUserName varchar(255))
begin
	
	declare p_parentId int;		-- 上级的上级
	declare p_fanDian float;	-- 上级返点
	declare p_username varchar(255);
	
	declare liqType int default 4;
	declare info varchar(255) character set utf8;
	
	declare done int default 0;
	declare cur cursor for
	select fanDian, parentId, username from ssc_members where `uid`=_parentId;
	declare continue HANDLER for not found set done = 1;

	open cur;
		repeat
			fetch cur into p_fanDian, p_parentId, p_username;
		until done end repeat;
	close cur;
	
	-- select p_fanDian, p_parentId, _parentId;

	if p_fanDian > _fanDian then
		-- set info='下家抢庄抽水';
		set info=concat('下家[', cast(srcUserName as char), ']抢庄抽水');
		call setCoin(amount * (p_fanDian - _fanDian) / 100, 0, _parentId, liqType, _type, info, srcBetId, srcUid, srcUserName);
	end if;
	
	set _parentId=p_parentId;
	set _fanDian=p_fanDian;
	set srcUserName=concat(p_username, '<=', srcUserName);
	
end
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for setUpFanDian
-- ----------------------------
DROP PROCEDURE IF EXISTS `setUpFanDian`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `setUpFanDian`(amount float, INOUT _fanDian float, INOUT _parentId int, _type int, srcBetId int, srcUid int, INOUT srcUserName varchar(255))
begin
	
	declare p_parentId int;		-- 上级的上级
	declare p_fanDian float;	-- 上级返点
	declare p_username varchar(64);
	
	-- declare liqType int default 3;
	declare liqType int default 2;
	declare info varchar(255) character set utf8;
	
	declare done int default 0;
	declare cur cursor for
	select fanDian, parentId, username from ssc_members where `uid`=_parentId;
	declare continue HANDLER for not found set done = 1;

	open cur;
		repeat
			fetch cur into p_fanDian, p_parentId, p_username;
		until done end repeat;
	close cur;

	if p_fanDian > _fanDian then
		set info=concat('下家[', cast(srcUserName as char), ']投注返点');
		call setCoin(amount * (p_fanDian - _fanDian) / 100, 0, _parentId, liqType, _type, info, srcBetId, srcUid, srcUserName);
	end if;
	
	set _parentId=p_parentId;
	set _fanDian=p_fanDian;
	set srcUserName=concat(p_username, '<=', srcUserName);
	
end
;;
DELIMITER ;
