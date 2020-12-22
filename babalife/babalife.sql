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

 Date: 22/12/2020 21:31:42
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
INSERT INTO `admin_menu` VALUES (27, 0, '系统管理', 'layui-icon-set', '', 1, 0, 1607671475, 1608175974, 0, '');
INSERT INTO `admin_menu` VALUES (30, 27, '角色管理', 'layui-icon-username', '/admin/role/index', 1, 0, 1607671930, 1608175985, 0, '');
INSERT INTO `admin_menu` VALUES (32, 27, '菜单管理', 'layui-icon-menu-fill', '/admin/menu', 1, 0, 1607860767, 1608124318, 0, 'menu');
INSERT INTO `admin_menu` VALUES (71, 32, '菜单添加', '', '', 1, 0, 1607920488, 1608175839, 1, 'menu:add');
INSERT INTO `admin_menu` VALUES (72, 32, '菜单删除', '', '', 1, 0, 1607920497, 1608124320, 1, 'menu:delete');
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
INSERT INTO `admin_role` VALUES (3, '超级管理员', '不知道', 1607859043, 1608124024);
INSERT INTO `admin_role` VALUES (8, '测试角色', '拥有至高无上的权利', 1607860391, 1608128289);
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
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='角色菜单关联表';

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='后台用户表';

-- ----------------------------
-- Records of admin_user
-- ----------------------------
BEGIN;
INSERT INTO `admin_user` VALUES (10, 'admin', 'c3284d0f94606de1fd2af172aba15bf3', '123', '127.0.0.1', 0, 1, 1608129334, 1608175897);
INSERT INTO `admin_user` VALUES (11, '啊啊啊', 'c3284d0f94606de1fd2af172aba15bf3', 'aa', '127.0.0.1', 0, 1, 1608129354, 1608175897);
COMMIT;

-- ----------------------------
-- Table structure for admin_user_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_role`;
CREATE TABLE `admin_user_role` (
  `user_id` int(10) unsigned NOT NULL COMMENT '后台用户 admin_user.id',
  `role_id` int(10) unsigned NOT NULL COMMENT '后台角色 admin_role.id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户角色关联表';

-- ----------------------------
-- Records of admin_user_role
-- ----------------------------
BEGIN;
INSERT INTO `admin_user_role` VALUES (1, 8);
INSERT INTO `admin_user_role` VALUES (7, 9);
INSERT INTO `admin_user_role` VALUES (8, 3);
INSERT INTO `admin_user_role` VALUES (9, 3);
INSERT INTO `admin_user_role` VALUES (10, 8);
INSERT INTO `admin_user_role` VALUES (11, 3);
COMMIT;

-- ----------------------------
-- Table structure for im_chat_group
-- ----------------------------
DROP TABLE IF EXISTS `im_chat_group`;
CREATE TABLE `im_chat_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `account` varchar(20) NOT NULL COMMENT '群号',
  `group_name` varchar(60) NOT NULL COMMENT '群名称',
  `des` varchar(200) NOT NULL DEFAULT '' COMMENT '群描述',
  `number` int(10) unsigned NOT NULL COMMENT '群人数',
  `approval` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0无需验证，1需验证',
  `group_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1正常，2全体禁言',
  `avatar` varchar(128) NOT NULL DEFAULT '/static/images/default_image.png' COMMENT '群组头像',
  `belong` int(255) unsigned NOT NULL COMMENT '群主',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='聊天群表';

-- ----------------------------
-- Records of im_chat_group
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for im_chat_member
-- ----------------------------
DROP TABLE IF EXISTS `im_chat_member`;
CREATE TABLE `im_chat_member` (
  `id` int(11) NOT NULL COMMENT '主键ID',
  `group_id` int(10) unsigned NOT NULL COMMENT '群ID',
  `member_id` int(10) unsigned NOT NULL COMMENT '用户ID',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1正常，2为该群黑名单',
  `add_time` int(10) unsigned DEFAULT NULL COMMENT '加群时间',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '3' COMMENT '1群主，2管理员，3会员',
  `forbidden_speach_time` int(11) unsigned DEFAULT NULL COMMENT '禁言到某个时间',
  `nick_name` varchar(50) NOT NULL COMMENT '群员的群昵称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='群员表';

-- ----------------------------
-- Records of im_chat_member
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for im_chat_message
-- ----------------------------
DROP TABLE IF EXISTS `im_chat_message`;
CREATE TABLE `im_chat_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `msg_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1请求添加用户，2系统通知（添加好友），3请求加群，4系统消息（添加群），5全体会员消息',
  `send` int(255) unsigned NOT NULL COMMENT '消息发送者',
  `receive` int(255) unsigned NOT NULL COMMENT '消息接受者',
  `msg_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1未读，2同意，3拒绝，4同意且返回消息已读，5拒绝且返回消息已读，6全体消息已读',
  `remark` varchar(128) DEFAULT NULL COMMENT '附加消息',
  `send_time` int(10) unsigned DEFAULT NULL COMMENT '发送消息时间',
  `read_time` int(10) unsigned DEFAULT NULL COMMENT '读消息时间',
  `receive_group` int(255) unsigned DEFAULT NULL COMMENT '接受消息的群主',
  `handle_group` int(255) unsigned DEFAULT NULL COMMENT '处理消息的群主',
  `my_group` int(255) unsigned DEFAULT NULL COMMENT '好友分组',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='通知表';

-- ----------------------------
-- Records of im_chat_message
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for im_chat_my_friend
-- ----------------------------
DROP TABLE IF EXISTS `im_chat_my_friend`;
CREATE TABLE `im_chat_my_friend` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned NOT NULL COMMENT '分组ID',
  `member_id` int(10) unsigned NOT NULL COMMENT '好友ID',
  `nick_name` varchar(128) DEFAULT NULL COMMENT '好友昵称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员分组下的好友列表';

-- ----------------------------
-- Records of im_chat_my_friend
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for im_chat_my_group
-- ----------------------------
DROP TABLE IF EXISTS `im_chat_my_group`;
CREATE TABLE `im_chat_my_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL COMMENT '会员ID',
  `group_name` varchar(128) NOT NULL COMMENT '分组名称',
  `weight` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '好友分组的排列顺序，越小越靠前',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员好友分组表';

-- ----------------------------
-- Records of im_chat_my_group
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for im_chat_my_member
-- ----------------------------
DROP TABLE IF EXISTS `im_chat_my_member`;
CREATE TABLE `im_chat_my_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(128) NOT NULL COMMENT '账号',
  `password` char(32) NOT NULL COMMENT '密码',
  `salt` varchar(20) NOT NULL COMMENT '秘钥',
  `birthday` int(255) DEFAULT NULL COMMENT '生日',
  `nick_name` varchar(50) NOT NULL DEFAULT '匿名' COMMENT '昵称',
  `sex` tinyint(1) NOT NULL DEFAULT '3' COMMENT '1男 2女 3保密',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '在线状态，0不在线，1在线',
  `signature` varchar(200) DEFAULT NULL COMMENT '签名',
  `email` varchar(128) DEFAULT NULL COMMENT '邮箱',
  `phone` varchar(20) DEFAULT NULL COMMENT '电话',
  `blood_type` varchar(32) DEFAULT '其他血型' COMMENT '血型，A、B、AB、O 其他血型',
  `job` tinyint(1) DEFAULT NULL COMMENT '1 互联网',
  `avatar` varchar(128) NOT NULL DEFAULT '/static/images/default_image.png' COMMENT '头像',
  `qq` varchar(20) DEFAULT NULL COMMENT 'qq号',
  `create_time` int(10) unsigned NOT NULL COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL COMMENT '更新时间',
  `login_time` int(10) unsigned NOT NULL COMMENT '上一次登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员表';

-- ----------------------------
-- Records of im_chat_my_member
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for im_chat_record
-- ----------------------------
DROP TABLE IF EXISTS `im_chat_record`;
CREATE TABLE `im_chat_record` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `send` int(255) unsigned NOT NULL COMMENT '发送者',
  `receive` int(255) unsigned NOT NULL COMMENT '接受者',
  `content` varchar(1024) NOT NULL DEFAULT '' COMMENT '发送内容',
  `send_time` int(10) unsigned NOT NULL COMMENT '发送时间',
  `type` enum('friend','group') NOT NULL DEFAULT 'friend' COMMENT '聊天类型',
  `is_read` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0未读，1已读',
  PRIMARY KEY (`id`),
  KEY `send` (`send`) USING BTREE,
  KEY `receive` (`receive`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='聊天记录表';

-- ----------------------------
-- Records of im_chat_record
-- ----------------------------
BEGIN;
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
