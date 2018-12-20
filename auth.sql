/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50721
Source Host           : localhost:3306
Source Database       : auth

Target Server Type    : MYSQL
Target Server Version : 50721
File Encoding         : 65001

Date: 2018-12-20 16:45:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tp_admin`
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE `tp_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(100) NOT NULL DEFAULT '' COMMENT '密码',
  `create_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_admin
-- ----------------------------
INSERT INTO `tp_admin` VALUES ('1', 'admin', '21218cca77804d2ba1922c33e0151105', '1532215468');
INSERT INTO `tp_admin` VALUES ('7', 'yanghuan', '21218cca77804d2ba1922c33e0151105', '1545345353');

-- ----------------------------
-- Table structure for `tp_admin_role`
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin_role`;
CREATE TABLE `tp_admin_role` (
  `admin_id` int(11) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户与角色的关系表'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_admin_role
-- ----------------------------
INSERT INTO `tp_admin_role` VALUES ('7', '25');
INSERT INTO `tp_admin_role` VALUES ('1', '1');

-- ----------------------------
-- Table structure for `tp_huodong`
-- ----------------------------
DROP TABLE IF EXISTS `tp_huodong`;
CREATE TABLE `tp_huodong` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `activity_name` varchar(255) NOT NULL DEFAULT '' COMMENT '活动名',
  `yuyue_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `activity_logo` varchar(100) NOT NULL DEFAULT '' COMMENT '活动logo',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:停用 2 启用',
  `desc` text NOT NULL COMMENT '描述',
  `start_time` int(11) NOT NULL DEFAULT '0',
  `end_time` int(11) NOT NULL DEFAULT '0',
  `view_num` int(11) NOT NULL DEFAULT '0' COMMENT '访问次数',
  `zan_num` int(11) NOT NULL DEFAULT '0' COMMENT '该活动被赞次数',
  `item_num` int(11) NOT NULL DEFAULT '0' COMMENT '该项目参与的项目数',
  `create_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_huodong
-- ----------------------------
INSERT INTO `tp_huodong` VALUES ('1', '最美全家福', '0.00', 'desc/20181220\\6424893ce4c3499871e48ea6537d059f.png', '2', '<p style=\"color:#333333;font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;text-align:center;\">\n	<img width=\"50\" height=\"34\" title=\"1.png\" alt=\"global_DF7F0810-057A-8BD2-8A67-D83A4B4F2\" src=\"http://img.a.mvote.net/imgsource/global_DF7F0810-057A-8BD2-8A67-D83A4B4F2DB6_src.png\" border=\"0\" style=\"height:34px;width:50px;\" /><span style=\"line-height:37.8px;font-family:黑体;font-size:16px;\">‍</span><span style=\"font-size:16px;\">‍‍‍‍‍‍‍‍‍‍‍</span><strong><span style=\"line-height:32.4px;color:#FF0000;font-family:微软雅黑;font-size:16px;\">2018重庆市</span></strong><strong><span style=\"line-height:32.4px;color:#FF0000;font-family:微软雅黑, &quot;microsoft yahei&quot;;font-size:16px;\">“最美家庭”评选</span></strong><span style=\"font-size:12px;\">‍‍</span><img width=\"50\" height=\"34\" alt=\"global_19A971EA-DD88-5E57-DA7D-8ADCF5C3A\" src=\"http://img.a.mvote.net/imgsource/global_19A971EA-DD88-5E57-DA7D-8ADCF5C3AC64_src.png\" border=\"0\" style=\"height:34px;width:50px;\" /> \n</p>\n<p style=\"color:#333333;font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;text-align:center;\">\n	<span style=\"line-height:37.8px;font-family:黑体;font-size:21px;\">‍</span>‍<span style=\"line-height:25.2px;\">主办单位</span> \n</p>\n<p style=\"font-size:14px;background-color:#FFFFFF;text-align:center;\">\n	<span><b>重庆市伊莲摄影有限公司</b></span> \n</p>\n<div style=\"color:#333333;background-color:#FFFFFF;\">\n	<p style=\"font-size:14px;font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;text-align:center;\">\n		<strong><span style=\"line-height:32.4px;color:#C00000;font-family:微软雅黑, &quot;microsoft yahei&quot;;font-size:18px;\"><img width=\"80\" height=\"21\" alt=\"global_39D7DD95-599C-A3D0-FBE4-97DF0E14D\" src=\"http://img.a.mvote.net/imgsource/global_39D7DD95-599C-A3D0-FBE4-97DF0E14DE49_src.png\" border=\"0\" style=\"height:21px;width:80px;\" />&nbsp;评选范围</span></strong><img width=\"80\" height=\"21\" alt=\"global_39D7DD95-599C-A3D0-FBE4-97DF0E14D\" src=\"http://img.a.mvote.net/imgsource/global_39D7DD95-599C-A3D0-FBE4-97DF0E14DE49_src.png\" border=\"0\" style=\"height:21px;width:80px;\" /><strong><span style=\"line-height:32.4px;color:#C00000;font-family:微软雅黑, &quot;microsoft yahei&quot;;font-size:18px;\"></span></strong> \n	</p>\n	<p style=\"text-align:center;\">\n		<span><span style=\"font-size:21px;\">渝北最美家庭</span></span> \n	</p>\n	<p style=\"font-size:14px;font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;text-align:center;\">\n		<span style=\"line-height:37.8px;font-family:仿宋_gb2312;font-size:21px;\">‍</span><strong><span style=\"line-height:32.4px;color:#C00000;font-family:微软雅黑, &quot;microsoft yahei&quot;;font-size:18px;\"><img width=\"80\" height=\"21\" alt=\"global_39D7DD95-599C-A3D0-FBE4-97DF0E14D\" src=\"http://img.a.mvote.net/imgsource/global_39D7DD95-599C-A3D0-FBE4-97DF0E14DE49_src.png\" border=\"0\" style=\"height:21px;width:80px;\" />&nbsp;评选条件&nbsp;<strong><img width=\"80\" height=\"21\" alt=\"global_39D7DD95-599C-A3D0-FBE4-97DF0E14D\" src=\"http://img.a.mvote.net/imgsource/global_39D7DD95-599C-A3D0-FBE4-97DF0E14DE49_src.png\" border=\"0\" style=\"height:21px;width:80px;\" /></strong></span></strong> \n	</p>\n	<p style=\"font-size:14px;font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\">\n		<span style=\"line-height:25.2px;font-family:微软雅黑, &quot;microsoft yahei&quot;;\">&nbsp; 1、拥护党的路线、方针、政策，政治合格，遵纪守法，品行端正。</span> \n	</p>\n	<p style=\"font-size:14px;font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\">\n		<span style=\"line-height:25.2px;font-family:微软雅黑, &quot;microsoft yahei&quot;;\">&nbsp; 2、切实全面履行护理职责，工作到位，为患者提供全面、全程优质护理服务，经常与患者沟通交流，给予心理护理。</span> \n	</p>\n	<p style=\"font-size:14px;font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\">\n		<span style=\"line-height:25.2px;font-family:微软雅黑, &quot;microsoft yahei&quot;;\">&nbsp; 3、对待患者热情、细心、耐心，态度好，工作认真、踏实、严谨，富有爱心，受到患者好评。</span> \n	</p>\n	<p style=\"font-size:14px;font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\">\n		<span style=\"line-height:25.2px;font-family:微软雅黑, &quot;microsoft yahei&quot;;\">&nbsp; 4、具有团队合作精神，沟通协调能力强，工作积极主动、配合默契，赢得同行、患者和社会认可。</span> \n	</p>\n	<p style=\"font-size:14px;font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\">\n		<span style=\"line-height:25.2px;font-family:微软雅黑, &quot;microsoft yahei&quot;;\">&nbsp; 5、认真钻研、不断进取，爱岗敬业，工作能力突出，在开展优质护理服务工作中，充分发挥模范带头作用。</span> \n	</p>\n	<p style=\"font-size:14px;font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\">\n		<span style=\"line-height:25.2px;font-family:微软雅黑, &quot;microsoft yahei&quot;;\">&nbsp; 6、主动接受护理新理念，学习护理新技术，在临床护理、护理教学、护理管理和护理科研等方面成绩显著。</span> \n	</p>\n	<p style=\"font-size:14px;font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\">\n		<span style=\"line-height:25.2px;font-family:微软雅黑, &quot;microsoft yahei&quot;;\">&nbsp; 7、近三年内未发生护理差错事故，同时为2016年先进工作者。</span> \n	</p>\n</div>', '1544889600', '1545393844', '303', '30', '0', '1544926885');
INSERT INTO `tp_huodong` VALUES ('2', '最美小姐姐', '0.00', 'desc/20181216\\9ffcd27ddf7742df10b33ed574cffde8.png', '1', '<img src=\"/uploads/desc/20181220\\f09389274e992f1477d6a53325081953.png\" alt=\"\" />水电费', '1544889600', '1545926400', '0', '0', '0', '1544941758');

-- ----------------------------
-- Table structure for `tp_item`
-- ----------------------------
DROP TABLE IF EXISTS `tp_item`;
CREATE TABLE `tp_item` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '参加活动信息表',
  `activity_id` int(11) NOT NULL DEFAULT '0' COMMENT '活动表（huodong）的ID',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `tel` varchar(20) NOT NULL DEFAULT '' COMMENT '电话号码',
  `item_img` varchar(100) NOT NULL DEFAULT '' COMMENT '参选图片',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:男  2 女  3 未知',
  `desc` text NOT NULL COMMENT '描述',
  `zan_num` int(11) NOT NULL DEFAULT '0' COMMENT '被赞次数',
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_item
-- ----------------------------
INSERT INTO `tp_item` VALUES ('2', '1', '杨欢', '13425998555', 'desc/20181220\\3bebec8cb92ecc9e15caa19136b05157.png', '我是标题2', '1', '<p style=\"text-align:center;\">\n	<span style=\"font-size:24px;\">1.我是李四</span> \n</p>\n<p style=\"text-align:center;\">\n	<img src=\"/uploads/desc/20181216\\14e33c81f2e34c540de150e8364e7bd8.png\" alt=\"\" /> \n</p>\n<p style=\"text-align:left;\">\n	<br />\n</p>\n<p>\n	<span style=\"font-size:16px;\"><span style=\"line-height:2;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"line-height:3;\">阿斯顿发送到阿斯顿发送到发送到发所多付付付付付付付付付付付付付付付付付付付付付付付付所所得到的多多多多多多多多多多多多多多多多多多所得到的多多多付所得到的多多付多多多多多多多多多多多多多多多多多多多多多多多</span></span></span> \n</p>\n<p>\n	<br />\n</p>', '10', '1544073364');
INSERT INTO `tp_item` VALUES ('3', '1', '李四', '13425998550', 'desc/20181220\\0cebdb7b48a2b33e32fc457901d88546.png', '我是最美家庭', '1', '阿斯顿发', '11', '1544948240');
INSERT INTO `tp_item` VALUES ('4', '2', '张三', '13425998558', 'desc/20181217\\c257f8805139471bdd7099cf2d1ce26d.png', '我是张三', '2', '<p style=\"color:#333333;font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;\">\n	<span style=\"font-family:微软雅黑, &quot;microsoft yahei&quot;;font-size:16px;\">我程青青是一名儿科护理人员，于2009年毕业于江西宜春职业技术学院。在贵溪市中医院工作1年多。于2011年通过考试（人事代理）考入人民医院。从2011年开始一直在儿科工作至今。一直以来，我不断的努力，提高自己的专业水平，用饱满的工作热情，更积极向上的精神面貌，更高度的责任心，更多的耐心和包容心，为自己喜爱的儿科护理工作奉献青春。同时也获得单位领导和同事的认可，曾被评为“优秀护士”“先进个人”等。</span>\n</p>\n<p style=\"color:#333333;font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;\">\n	<span style=\"font-family:微软雅黑, &quot;microsoft yahei&quot;;font-size:16px;\">&nbsp; &nbsp; &nbsp;在儿科护理工作中每天都上演打针，输液，抽血，抢救等等。我早已习惯在嘈杂的环境中，及时准确地处理病情，耐心的安抚患儿和家属。为了减轻患儿的病痛，减少家属的紧张情绪，不断加强自身的专业水平，穿刺技术、抢救工作等。每次操作完自我总结，为了下一次做到更完美。虽然我们工作简单而又平凡，但却充满了爱。我乐于与患儿的生命同行，让患儿因为我们护理减轻痛苦，因我的健康指导而有收获，因我的安慰而家属树立信心。</span>\n</p>\n<p style=\"color:#333333;font-family:&quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;font-size:14px;background-color:#FFFFFF;\">\n	<span style=\"font-family:微软雅黑, &quot;microsoft yahei&quot;;font-size:16px;\">&nbsp; &nbsp; &nbsp;我热爱儿科护理工作，愿将自己的青春奉献给这份事业，去帮助那些需要帮助的“小天使”。我需要更努力，不断完善自我，做一名更加出色的儿科护理工作者。</span>\n</p>', '1', '1545012576');
INSERT INTO `tp_item` VALUES ('5', '2', '李四', '13425998554', 'desc/20181216\\2d1f10012ddce4c6c2fab037484d3050.png', '我是最美家庭', '1', '阿斯顿发', '10', '1544948240');

-- ----------------------------
-- Table structure for `tp_role`
-- ----------------------------
DROP TABLE IF EXISTS `tp_role`;
CREATE TABLE `tp_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '角色名',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:启用  0 禁用',
  `header_img` varchar(100) NOT NULL DEFAULT '' COMMENT '头像',
  `create_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_role
-- ----------------------------
INSERT INTO `tp_role` VALUES ('25', '收银员', '1', 'avatars/2018-11-22/ML9OPimi61TVDeZIKQUc1sofpLMNCf4HG8Equ6GY.png', '1542705313');

-- ----------------------------
-- Table structure for `tp_role_rule`
-- ----------------------------
DROP TABLE IF EXISTS `tp_role_rule`;
CREATE TABLE `tp_role_rule` (
  `role_id` int(11) NOT NULL DEFAULT '0' COMMENT '角色ID',
  `rule_id` int(11) NOT NULL DEFAULT '0' COMMENT '规则ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_role_rule
-- ----------------------------
INSERT INTO `tp_role_rule` VALUES ('26', '18');
INSERT INTO `tp_role_rule` VALUES ('25', '10');
INSERT INTO `tp_role_rule` VALUES ('25', '1');
INSERT INTO `tp_role_rule` VALUES ('25', '3');
INSERT INTO `tp_role_rule` VALUES ('25', '2');
INSERT INTO `tp_role_rule` VALUES ('25', '4');
INSERT INTO `tp_role_rule` VALUES ('25', '16');
INSERT INTO `tp_role_rule` VALUES ('25', '17');
INSERT INTO `tp_role_rule` VALUES ('25', '60');
INSERT INTO `tp_role_rule` VALUES ('25', '5');
INSERT INTO `tp_role_rule` VALUES ('25', '6');
INSERT INTO `tp_role_rule` VALUES ('25', '40');
INSERT INTO `tp_role_rule` VALUES ('25', '41');
INSERT INTO `tp_role_rule` VALUES ('25', '42');
INSERT INTO `tp_role_rule` VALUES ('25', '44');
INSERT INTO `tp_role_rule` VALUES ('25', '45');
INSERT INTO `tp_role_rule` VALUES ('25', '46');
INSERT INTO `tp_role_rule` VALUES ('25', '47');
INSERT INTO `tp_role_rule` VALUES ('25', '48');
INSERT INTO `tp_role_rule` VALUES ('25', '49');
INSERT INTO `tp_role_rule` VALUES ('25', '43');
INSERT INTO `tp_role_rule` VALUES ('25', '50');
INSERT INTO `tp_role_rule` VALUES ('25', '51');
INSERT INTO `tp_role_rule` VALUES ('25', '52');
INSERT INTO `tp_role_rule` VALUES ('25', '53');
INSERT INTO `tp_role_rule` VALUES ('25', '54');
INSERT INTO `tp_role_rule` VALUES ('25', '55');
INSERT INTO `tp_role_rule` VALUES ('25', '56');
INSERT INTO `tp_role_rule` VALUES ('25', '57');

-- ----------------------------
-- Table structure for `tp_rule`
-- ----------------------------
DROP TABLE IF EXISTS `tp_rule`;
CREATE TABLE `tp_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `controller_action` varchar(50) NOT NULL DEFAULT '' COMMENT '控制器-方法（以controller-action）格式',
  `controller_action_name` varchar(100) NOT NULL DEFAULT '' COMMENT '名称',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级ID',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 : 显示  0 ：不显示',
  `create_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_rule
-- ----------------------------
INSERT INTO `tp_rule` VALUES ('1', 'Role-index', '角色管理', '10', '1', '1542158823');
INSERT INTO `tp_rule` VALUES ('2', 'Role-lists', 'ajax请求路径角色列表', '3', '0', '1542096924');
INSERT INTO `tp_rule` VALUES ('3', 'Role-index', '角色列表', '1', '1', '1542251774');
INSERT INTO `tp_rule` VALUES ('4', 'Role-edit', '编辑角色', '3', '1', '1542087230');
INSERT INTO `tp_rule` VALUES ('5', 'Admin-index', '管理员列表', '1', '1', '1542087280');
INSERT INTO `tp_rule` VALUES ('6', 'Admin-edit', '编辑管理员', '5', '1', '1542087469');
INSERT INTO `tp_rule` VALUES ('8', '-', '用户管理', '11', '1', '1542158867');
INSERT INTO `tp_rule` VALUES ('9', 'User-index', '用户列表', '8', '1', '1542088952');
INSERT INTO `tp_rule` VALUES ('10', '-', '权限', '0', '1', '1542158794');
INSERT INTO `tp_rule` VALUES ('11', '-', '用户', '0', '1', '1542158805');
INSERT INTO `tp_rule` VALUES ('12', 'Rule-index', '规则管理', '10', '1', '1542158794');
INSERT INTO `tp_rule` VALUES ('13', 'Rule-index', '规则列表', '12', '1', '1542158794');
INSERT INTO `tp_rule` VALUES ('14', 'Role-del', '删除角色', '3', '1', '1542249919');
INSERT INTO `tp_rule` VALUES ('15', 'Admin-del', '删除管理员', '5', '1', '1542249971');
INSERT INTO `tp_rule` VALUES ('16', 'Index-index', '登录进来首页', '3', '0', '1545294751');
INSERT INTO `tp_rule` VALUES ('17', 'Index-blank', '首页数据', '16', '0', '1542251087');
INSERT INTO `tp_rule` VALUES ('40', '-', '预约活动', '0', '1', '1545288331');
INSERT INTO `tp_rule` VALUES ('41', '-', '活动管理', '40', '1', '1545288354');
INSERT INTO `tp_rule` VALUES ('42', 'huodong-index', '活动列表', '41', '1', '1545288400');
INSERT INTO `tp_rule` VALUES ('43', 'item-index', '参选人列表', '41', '1', '1545288434');
INSERT INTO `tp_rule` VALUES ('44', 'huodong-lists', '活动列表数据', '42', '0', '1545288516');
INSERT INTO `tp_rule` VALUES ('45', 'huodong-del', '删除活动列表数据', '42', '0', '1545288536');
INSERT INTO `tp_rule` VALUES ('46', 'huodong-add', '添加活动', '42', '0', '1545288555');
INSERT INTO `tp_rule` VALUES ('47', 'huodong-doAdd', '执行添加活动', '42', '0', '1545288638');
INSERT INTO `tp_rule` VALUES ('48', 'huodong-doEdit', '执行编辑活动', '42', '0', '1545288617');
INSERT INTO `tp_rule` VALUES ('49', 'huodong-edit', '编辑活动', '42', '0', '1545288693');
INSERT INTO `tp_rule` VALUES ('50', 'item-lists', '参选人数据', '43', '0', '1545288727');
INSERT INTO `tp_rule` VALUES ('51', 'item-del', '删除参选人', '43', '0', '1545288744');
INSERT INTO `tp_rule` VALUES ('52', 'item-add', '添加参选人', '43', '0', '1545288779');
INSERT INTO `tp_rule` VALUES ('53', 'item-doAdd', '执行添加参选人', '43', '0', '1545288795');
INSERT INTO `tp_rule` VALUES ('54', 'item-edit', '编辑参选人', '43', '0', '1545288814');
INSERT INTO `tp_rule` VALUES ('55', 'item-doEdit', '执行编辑参选人', '43', '0', '1545288849');
INSERT INTO `tp_rule` VALUES ('56', 'item-uploadLogo', '上传logo', '43', '0', '1545288923');
INSERT INTO `tp_rule` VALUES ('57', 'item-uploadImg', '编辑器上传图片', '43', '0', '1545288945');
INSERT INTO `tp_rule` VALUES ('58', 'user-lists', '用户列表数据', '9', '0', '1545293416');
INSERT INTO `tp_rule` VALUES ('59', 'user-del', '用户删除', '9', '0', '1545293452');
INSERT INTO `tp_rule` VALUES ('60', 'admin-lists', '管理员列表数据', '3', '0', '1545295251');

-- ----------------------------
-- Table structure for `tp_user`
-- ----------------------------
DROP TABLE IF EXISTS `tp_user`;
CREATE TABLE `tp_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `openid` varchar(80) NOT NULL,
  `headimgurl` varchar(255) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `nickname` varchar(50) NOT NULL COMMENT '昵称',
  `city` varchar(10) DEFAULT NULL COMMENT '省/自治区',
  `province` varchar(11) DEFAULT NULL COMMENT '市',
  `country` varchar(11) DEFAULT NULL COMMENT '国',
  `phone` varchar(11) DEFAULT NULL,
  `addtime` char(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `man_name` varchar(20) DEFAULT NULL,
  `wowan_name` varchar(20) DEFAULT NULL,
  `man_birthday` varchar(20) DEFAULT NULL,
  `woman_birthday` varchar(20) DEFAULT NULL,
  `wedding_day` varchar(20) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `man_phone` varchar(20) DEFAULT NULL,
  `woman_phone` varchar(20) DEFAULT NULL,
  `lz_time` varchar(20) DEFAULT NULL COMMENT '领证日期',
  `wedding_status` tinyint(1) DEFAULT NULL COMMENT '是否拍摄婚纱',
  `area` varchar(50) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `yy_phone` varchar(11) DEFAULT NULL,
  `balance` float(11,2) NOT NULL DEFAULT '0.00',
  `is_fans` tinyint(1) NOT NULL DEFAULT '1',
  `first_location` varchar(255) DEFAULT '0' COMMENT '首次地理位置',
  `last_location` varchar(255) DEFAULT '0' COMMENT '最后一次',
  `unionid` varchar(100) DEFAULT NULL COMMENT 'unionid',
  `first_leader` int(10) NOT NULL DEFAULT '0' COMMENT '第一级',
  `second_leader` int(10) NOT NULL DEFAULT '0' COMMENT '第二级',
  `third_leader` int(10) NOT NULL DEFAULT '0' COMMENT '第三级',
  `brokerage` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '佣金',
  `qrcode_url` varchar(100) NOT NULL DEFAULT '' COMMENT '我的二维码邀请链接',
  PRIMARY KEY (`id`),
  KEY `openid` (`openid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_user
-- ----------------------------
INSERT INTO `tp_user` VALUES ('5', 'oydWg0dRUVqoPoaB0HaZ8PgHJSgU', 'http://thirdwx.qlogo.cn/mmopen/vi_32/L2evTRZXmJNobbtD5Z0VDT7BnNLPThiaP2CHRlT6k7s9JCUp7N13zkjonPSZMrGoFdyYMmbICIPERaJB0iaKxMVg/132', '1', '杨欢5', '荣昌', '重庆', '中国', '', '1543905397', '1', '', '', '', '', '', '', '', '', '', null, '', null, '', '0.00', '0', '0', '0', '', '0', '0', '0', '0.00', '');

-- ----------------------------
-- Table structure for `tp_zan`
-- ----------------------------
DROP TABLE IF EXISTS `tp_zan`;
CREATE TABLE `tp_zan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '点赞表',
  `item_id` int(11) NOT NULL COMMENT 'item表的ID',
  `user_id` int(11) NOT NULL COMMENT '点赞的人',
  `huodong_id` int(11) NOT NULL DEFAULT '0' COMMENT 'huodong表的ID',
  `create_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_zan
-- ----------------------------
INSERT INTO `tp_zan` VALUES ('31', '5', '5', '1', '1545116636');
INSERT INTO `tp_zan` VALUES ('32', '3', '5', '1', '1545292709');
