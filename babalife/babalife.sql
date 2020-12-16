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

 Date: 16/12/2020 20:37:45
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父节点id（0顶级id）',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `icon` varchar(100) NOT NULL DEFAULT '' COMMENT '菜单图标',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '菜单路径',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '菜单状态（0关闭，1开启）',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '菜单排序',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0菜单，1按钮',
  `authority` varchar(100) NOT NULL DEFAULT '' COMMENT '权限标识',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='后台菜单表';

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
BEGIN;
INSERT INTO `admin_menu` VALUES (27, 0, '系统管理', 'layui-icon-set', '', 1, 0, 1607671475, 1607858082, 0, '');
INSERT INTO `admin_menu` VALUES (30, 27, '角色管理', 'layui-icon-username', '/admin/role/index', 1, 0, 1607671930, 1607907721, 0, '');
INSERT INTO `admin_menu` VALUES (32, 27, '菜单管理', 'layui-icon-menu-fill', '/admin/menu', 1, 0, 1607860767, 1607948451, 0, 'menu');
INSERT INTO `admin_menu` VALUES (71, 32, '菜单添加', '', '', 1, 0, 1607920488, 1607920488, 1, 'menu:add');
INSERT INTO `admin_menu` VALUES (72, 32, '菜单删除', '', '', 1, 0, 1607920497, 1607920510, 1, 'menu:delete');
INSERT INTO `admin_menu` VALUES (73, 32, '菜单更新', '', '', 1, 0, 1607920526, 1607923492, 1, 'menu:update');
INSERT INTO `admin_menu` VALUES (74, 27, '用户管理', 'layui-icon-user', '/admin/user', 1, 0, 1607990710, 1607990736, 0, 'user');
COMMIT;

-- ----------------------------
-- Table structure for admin_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE `admin_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '角色名称',
  `desc` varchar(255) NOT NULL DEFAULT '' COMMENT '角色描述',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='后台用户角色';

-- ----------------------------
-- Records of admin_role
-- ----------------------------
BEGIN;
INSERT INTO `admin_role` VALUES (3, '王大', '不知道', 1607859043, 1607923832);
INSERT INTO `admin_role` VALUES (8, '超级管理员', '拥有至高无上的权利', 1607860391, 1607860391);
INSERT INTO `admin_role` VALUES (9, '张国荣', '演员', 1607923824, 1607923824);
COMMIT;

-- ----------------------------
-- Table structure for admin_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_menu`;
CREATE TABLE `admin_role_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL COMMENT '角色ID',
  `menu_ids` varchar(255) NOT NULL COMMENT '菜单IDS',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='角色菜单关联表';

-- ----------------------------
-- Records of admin_role_menu
-- ----------------------------
BEGIN;
INSERT INTO `admin_role_menu` VALUES (1, 3, '27,32,72,73');
INSERT INTO `admin_role_menu` VALUES (2, 8, '27,32,72,73');
INSERT INTO `admin_role_menu` VALUES (3, 9, '27,32,71');
COMMIT;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='后台用户表';

-- ----------------------------
-- Records of admin_user
-- ----------------------------
BEGIN;
INSERT INTO `admin_user` VALUES (1, 'admin', 'admin', '超级管理员', '', 0, 1, 0, 0);
COMMIT;

-- ----------------------------
-- Table structure for admin_user_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_role`;
CREATE TABLE `admin_user_role` (
  `user_id` int(10) unsigned NOT NULL COMMENT '后台用户 admin_user.id',
  `role_id` int(10) unsigned NOT NULL COMMENT '后台角色 admin_role.id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户角色关联表';

-- ----------------------------
-- Records of admin_user_role
-- ----------------------------
BEGIN;
INSERT INTO `admin_user_role` VALUES (1, 3);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
