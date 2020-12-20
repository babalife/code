/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50728
 Source Host           : 127.0.0.1:3306
 Source Schema         : babalife

 Target Server Type    : MySQL
 Target Server Version : 50728
 File Encoding         : 65001

 Date: 21/12/2020 02:31:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父节点id（0顶级id）',
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `icon` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '菜单图标',
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '菜单路径',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '菜单状态（0关闭，1开启）',
  `sort` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '菜单排序',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  `type` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0菜单，1按钮',
  `authority` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '权限标识',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 79 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '后台菜单表' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
INSERT INTO `admin_menu` VALUES (27, 0, '系统管理', 'layui-icon-set', '', 1, 255, 1607671475, 1608476472, 0, '');
INSERT INTO `admin_menu` VALUES (30, 27, '角色管理', 'layui-icon-username', '/admin/role/index', 1, 1, 1607671930, 1608483217, 0, 'role');
INSERT INTO `admin_menu` VALUES (74, 27, '用户管理', 'layui-icon-user', '/admin/user', 1, 0, 1607990710, 1608392821, 0, 'user');
INSERT INTO `admin_menu` VALUES (75, 27, '菜单管理', 'layui-icon-menu-fill', '/admin/menu/index', 1, 2, 1608212289, 1608212365, 0, 'menu');
INSERT INTO `admin_menu` VALUES (76, 0, '答题管理', 'layui-icon-file-b', '/admin/answer', 1, 1, 1608474962, 1608483408, 0, '');
INSERT INTO `admin_menu` VALUES (78, 0, '考试管理', 'layui-icon-template-1', '/admin/paper', 1, 0, 1608475934, 1608476396, 0, '');

-- ----------------------------
-- Table structure for admin_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE `admin_role`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '角色名称',
  `desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '角色描述',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '后台用户角色' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of admin_role
-- ----------------------------
INSERT INTO `admin_role` VALUES (1, '超级管理员', '拥有至高无上的权利', 1608474097, 1608474097);
INSERT INTO `admin_role` VALUES (5, 'test', '测试角色', 1608476899, 1608477226);

-- ----------------------------
-- Table structure for admin_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_menu`;
CREATE TABLE `admin_role_menu`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(10) UNSIGNED NOT NULL COMMENT '角色ID',
  `menu_ids` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '菜单IDS',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '角色菜单关联表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_role_menu
-- ----------------------------
INSERT INTO `admin_role_menu` VALUES (1, 1, '27,30,74,75,76,78');
INSERT INTO `admin_role_menu` VALUES (5, 5, '78,76');

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '管理员账号',
  `password` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '管理员密码',
  `nick_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '管理员名称',
  `last_login_ip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '最后一次登录ip',
  `last_login_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后一次登录时间',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '管理员状态，0未开启，1开启',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `update_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '后台用户表' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES (1, 'admin', 'bf5c8a5cc5c8fbb73559e1e1f677ad3e', 'admin', '127.0.0.1', 1608483095, 1, 1608383449, 1608483095);
INSERT INTO `admin_user` VALUES (5, 'test', '091fa6351d75d5e9d225348b8749d430', 'test', '127.0.0.1', 1608476918, 1, 1608476895, 1608477169);

-- ----------------------------
-- Table structure for admin_user_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_role`;
CREATE TABLE `admin_user_role`  (
  `user_id` int(10) UNSIGNED NOT NULL COMMENT '后台用户 admin_user.id',
  `role_id` int(10) UNSIGNED NOT NULL COMMENT '后台角色 admin_role.id'
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户角色关联表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_user_role
-- ----------------------------
INSERT INTO `admin_user_role` VALUES (1, 1);
INSERT INTO `admin_user_role` VALUES (2, 1);
INSERT INTO `admin_user_role` VALUES (2, 1);
INSERT INTO `admin_user_role` VALUES (3, 1);
INSERT INTO `admin_user_role` VALUES (4, 1);
INSERT INTO `admin_user_role` VALUES (5, 5);

SET FOREIGN_KEY_CHECKS = 1;
