/*
Navicat MySQL Data Transfer

Source Server         : mysql2
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : rulemanage

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2017-09-23 12:29:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `chaos_admin_nav`
-- ----------------------------
DROP TABLE IF EXISTS `chaos_admin_nav`;
CREATE TABLE `chaos_admin_nav` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜单表',
  `pid` int(11) unsigned DEFAULT '0' COMMENT '所属菜单',
  `name` varchar(15) DEFAULT '' COMMENT '菜单名称',
  `mca` varchar(255) DEFAULT '' COMMENT '模块、控制器、方法',
  `ico` varchar(20) DEFAULT '' COMMENT 'font-awesome图标',
  `order_number` int(11) unsigned DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of chaos_admin_nav
-- ----------------------------
INSERT INTO `chaos_admin_nav` VALUES ('44', '2', '菜单管理', 'admin/nav/index', '', null);
INSERT INTO `chaos_admin_nav` VALUES ('45', '2', '菜单添加', 'admin/nav/add', '', null);
INSERT INTO `chaos_admin_nav` VALUES ('2', '0', '系统设置', 'admin/nav/index', '', '1');
INSERT INTO `chaos_admin_nav` VALUES ('68', '2', '权限管理', 'admin/authRule/index', '', null);
INSERT INTO `chaos_admin_nav` VALUES ('69', '2', '权限添加', 'admin/authRule/add', '', null);
INSERT INTO `chaos_admin_nav` VALUES ('71', '2', '用户组管理', 'admin/authRule/group', '', null);
INSERT INTO `chaos_admin_nav` VALUES ('72', '2', '添加用户组', 'admin/authRule/addGroup', '', null);
INSERT INTO `chaos_admin_nav` VALUES ('73', '2', '用户列表', 'admin/AuthRule/adminUserList', '', null);
INSERT INTO `chaos_admin_nav` VALUES ('74', '2', '添加用户', 'admin/AuthRule/addUser', '', null);
INSERT INTO `chaos_admin_nav` VALUES ('75', '0', '首页', 'admin/index/index', '', null);
INSERT INTO `chaos_admin_nav` VALUES ('76', '75', '业务列表', 'admin/Business/index', '', null);
INSERT INTO `chaos_admin_nav` VALUES ('77', '76', '业务添加', 'Admin/business/add', '', null);
INSERT INTO `chaos_admin_nav` VALUES ('78', '76', '菜单修改', 'admin/business/edit', '', null);
INSERT INTO `chaos_admin_nav` VALUES ('79', '76', '菜单删除', 'admin/business/delete', '', null);
INSERT INTO `chaos_admin_nav` VALUES ('80', '75', '耗材列表', 'admin/supplie/index', '', null);
INSERT INTO `chaos_admin_nav` VALUES ('81', '80', '耗材添加', 'admin/supplie/add', '', null);
INSERT INTO `chaos_admin_nav` VALUES ('82', '80', '耗材修改', 'admin/supplie/edit', '', null);
INSERT INTO `chaos_admin_nav` VALUES ('83', '80', '耗材删除', 'admin/supplie/delete', '', null);
INSERT INTO `chaos_admin_nav` VALUES ('85', '75', '前台用户管理', 'admin/FrontUser/index', '', null);
INSERT INTO `chaos_admin_nav` VALUES ('86', '85', '前台用户修改', 'admin/FrontUser/add', '', null);
INSERT INTO `chaos_admin_nav` VALUES ('87', '85', '前台用户修改', 'admin/FrontUser/edit', '', null);
INSERT INTO `chaos_admin_nav` VALUES ('88', '85', '前台用户删除', 'admin/FrontUser/delete', '', null);
INSERT INTO `chaos_admin_nav` VALUES ('92', '75', '前台用户数据', 'admin/FrontUser/listItems', '', null);

-- ----------------------------
-- Table structure for `chaos_auth_group`
-- ----------------------------
DROP TABLE IF EXISTS `chaos_auth_group`;
CREATE TABLE `chaos_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of chaos_auth_group
-- ----------------------------
INSERT INTO `chaos_auth_group` VALUES ('1', '管理员', '1', '19,5,6,7,8,10,18,24,25,26,27,28,13,14,15,16,20,21,22,23,46,29,30,31,33,34,35,36,37,38,39,40,41,42,44');
INSERT INTO `chaos_auth_group` VALUES ('4', 'test', '1', '');
INSERT INTO `chaos_auth_group` VALUES ('5', 'test2', '1', '');
INSERT INTO `chaos_auth_group` VALUES ('7', '普通用户', '1', '');

-- ----------------------------
-- Table structure for `chaos_auth_group_access`
-- ----------------------------
DROP TABLE IF EXISTS `chaos_auth_group_access`;
CREATE TABLE `chaos_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of chaos_auth_group_access
-- ----------------------------
INSERT INTO `chaos_auth_group_access` VALUES ('1', '1');
INSERT INTO `chaos_auth_group_access` VALUES ('2', '1');
INSERT INTO `chaos_auth_group_access` VALUES ('17', '1');
INSERT INTO `chaos_auth_group_access` VALUES ('18', '1');

-- ----------------------------
-- Table structure for `chaos_auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `chaos_auth_rule`;
CREATE TABLE `chaos_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `pid` mediumint(8) NOT NULL,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of chaos_auth_rule
-- ----------------------------
INSERT INTO `chaos_auth_rule` VALUES ('27', '5', 'admin/AuthRule/editUser', '修改用户', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('5', '19', 'admin/nav/index', '菜单管理', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('6', '5', 'admin/nav/add', '菜单添加', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('7', '5', 'admin/nav/delete', '菜单删除', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('8', '5', 'admin/nav/edit', '菜单添加', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('29', '0', 'admin/index/index', '首页', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('10', '5', 'admin/nav/order', '菜单排序', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('18', '5', 'admin/authRule/group', '用户组管理', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('13', '19', 'admin/authRule/index', '权限管理', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('14', '13', 'admin/authRule/add', '权限添加', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('15', '13', 'admin/authRule/delete', '权限删除', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('16', '13', 'admin/authRule/edit', '权限修改', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('19', '0', 'admin/nav/', '系统管理', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('20', '19', 'admin/authRule', '用户组权限管理', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('21', '20', 'admin/authRule/ruleGroup', '用户组权限分配', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('22', '20', 'admin/authRule/deleteGroup', '删除用户组', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('23', '20', 'admin/authRule/editGroup', '用户组修改', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('24', '5', 'admin/authRule/addGroup', '添加用户组', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('25', '5', 'admin/AuthRule/adminUserList', '用户列表', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('26', '5', 'admin/AuthRule/addUser', '添加用户', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('28', '5', 'admin/AuthRule/editUserGroup', '修改用户所属组', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('30', '29', 'admin/Business/index', '业务列表', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('31', '30', 'Admin/business/add', '业务添加', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('34', '30', 'admin/business/edit', '菜单修改', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('33', '30', 'admin/business/delete', '菜单删除', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('35', '29', 'admin/supplie/index', '耗材列表', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('36', '35', 'admin/supplie/add', '耗材添加', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('37', '35', 'admin/supplie/edit', '耗材修改', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('38', '35', 'admin/supplie/delete', '耗材删除', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('39', '29', 'admin/FrontUser/index', '前台用户管理', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('40', '39', 'admin/FrontUser/add', '前台用户修改', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('41', '39', 'admin/FrontUser/edit', '前台用户修改', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('42', '39', 'admin/FrontUser/delete', '前台用户删除', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('44', '39', 'admin/FrontUser/listItems', '前台用户数据', '1', '1', '');
INSERT INTO `chaos_auth_rule` VALUES ('46', '19', 'admin/AuthRule/changePassword', '修改密码', '1', '1', '');

-- ----------------------------
-- Table structure for `chaos_business`
-- ----------------------------
DROP TABLE IF EXISTS `chaos_business`;
CREATE TABLE `chaos_business` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `businessname` varchar(255) DEFAULT NULL,
  `percent` double(11,2) DEFAULT NULL,
  `sids` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of chaos_business
-- ----------------------------
INSERT INTO `chaos_business` VALUES ('6', '40%返款的业务', '40.00', '2,3');
INSERT INTO `chaos_business` VALUES ('13', '123', '123.00', '2,3,4,5');

-- ----------------------------
-- Table structure for `chaos_front_nav`
-- ----------------------------
DROP TABLE IF EXISTS `chaos_front_nav`;
CREATE TABLE `chaos_front_nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mca` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of chaos_front_nav
-- ----------------------------
INSERT INTO `chaos_front_nav` VALUES ('1', '0', '数据添加', 'admin/front/calculateReturn');
INSERT INTO `chaos_front_nav` VALUES ('2', '0', '数据列表', 'admin/front/listData');

-- ----------------------------
-- Table structure for `chaos_front_user`
-- ----------------------------
DROP TABLE IF EXISTS `chaos_front_user`;
CREATE TABLE `chaos_front_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `front_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lock` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of chaos_front_user
-- ----------------------------
INSERT INTO `chaos_front_user` VALUES ('2', 'chaos', '12345', '0');
INSERT INTO `chaos_front_user` VALUES ('3', 'admin', 'admin', '0');

-- ----------------------------
-- Table structure for `chaos_itemreturn`
-- ----------------------------
DROP TABLE IF EXISTS `chaos_itemreturn`;
CREATE TABLE `chaos_itemreturn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `createtime` datetime DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `bid` int(255) DEFAULT NULL,
  `comsume` double(11,2) DEFAULT NULL,
  `sid` int(255) DEFAULT NULL,
  `scount` int(11) DEFAULT NULL,
  `returntype` int(11) DEFAULT NULL,
  `returncash` double(11,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of chaos_itemreturn
-- ----------------------------
INSERT INTO `chaos_itemreturn` VALUES ('102', '2017-09-22 13:56:03', '2', '13', '121.00', '5', '7', null, '79.95');

-- ----------------------------
-- Table structure for `chaos_supplie`
-- ----------------------------
DROP TABLE IF EXISTS `chaos_supplie`;
CREATE TABLE `chaos_supplie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suppliename` varchar(255) DEFAULT NULL,
  `price` double(11,2) DEFAULT NULL,
  `bid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of chaos_supplie
-- ----------------------------
INSERT INTO `chaos_supplie` VALUES ('2', '耗材21', '13.50', '6');
INSERT INTO `chaos_supplie` VALUES ('3', '耗材3', '14.00', '6');
INSERT INTO `chaos_supplie` VALUES ('4', '成本12元的耗材', '12.00', '6');
INSERT INTO `chaos_supplie` VALUES ('5', '8元耗材', '8.00', '6');
INSERT INTO `chaos_supplie` VALUES ('6', '草药1', '12.00', '11');

-- ----------------------------
-- Table structure for `chaos_user`
-- ----------------------------
DROP TABLE IF EXISTS `chaos_user`;
CREATE TABLE `chaos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `openid` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of chaos_user
-- ----------------------------
INSERT INTO `chaos_user` VALUES ('1', 'chaos', '827ccb0eea8a706c4c34a16891f84e7b', 'oVijbsvpDEoQ_GUyjBK7yUptjl3E', null);
INSERT INTO `chaos_user` VALUES ('18', 'chaos1', '827ccb0eea8a706c4c34a16891f84e7b', null, null);
INSERT INTO `chaos_user` VALUES ('17', 'admin', '7b9a960fca0f271de3950ea226b3d47f', null, null);
