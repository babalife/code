/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : babalife

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 12/12/2020 11:32:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL COMMENT '管理员账号',
  `password` varchar(255) NOT NULL COMMENT '管理员密码',
  `nick_name` varchar(30) NOT NULL DEFAULT '' COMMENT '管理员名称',
  `last_login_ip` varchar(255) NOT NULL DEFAULT '' COMMENT '最后一次登录ip',
  `last_login_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后一次登录时间',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '管理员状态，0未开启，1开启',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='后台用户表';

-- ----------------------------
-- Records of admin_user
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for admin_user_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_role`;
CREATE TABLE `admin_user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '角色名称',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '角色描述',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='后台用户角色';

-- ----------------------------
-- Records of admin_user_role
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父节点id（0顶级id）',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `icon` varchar(100) NOT NULL DEFAULT '' COMMENT '菜单图标',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '菜单路径',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '菜单状态（0关闭，1开启）',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '菜单排序',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='后台菜单表';

-- ----------------------------
-- Records of menu
-- ----------------------------
BEGIN;
INSERT INTO `menu` VALUES (27, 0, '用户', 'layui-icon-user', 'fdsa', 1, 0, 1607671475, 1607739598);
INSERT INTO `menu` VALUES (28, 0, 'dfsafdsa', 'layui-icon-rate-half', 'fdsaf', 0, 0, 1607671607, 1607672864);
INSERT INTO `menu` VALUES (30, 27, '角色管理', 'layui-icon-username', '/admin/role/index', 1, 0, 1607671930, 1607739377);
INSERT INTO `menu` VALUES (26, 0, '不知道', 'layui-icon-login-weibo', '/admin/index', 1, 0, 1607669764, 1607671803);
INSERT INTO `menu` VALUES (31, 27, 'dsafgdsafsda', 'layui-icon-rate-half', 'fdsafdsa', 1, 0, 1607739594, 1607739594);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
