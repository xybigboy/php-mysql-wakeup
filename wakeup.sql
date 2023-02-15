/*
 Navicat Premium Data Transfer

 Source Server         : 192.168.110.17excl
 Source Server Type    : MySQL
 Source Server Version : 50738
 Source Host           : 192.168.110.17:3307
 Source Schema         : excl

 Target Server Type    : MySQL
 Target Server Version : 50738
 File Encoding         : 65001

 Date: 15/02/2023 17:22:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for wakeup
-- ----------------------------
DROP TABLE IF EXISTS `wakeup`;
CREATE TABLE `wakeup`  (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '-',
  `ipaddr` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '-',
  `mac` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '-',
  `up_time` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '-',
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `code` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '-',
  PRIMARY KEY (`id`, `ipaddr`) USING BTREE,
  INDEX `学号`(`ipaddr`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 828 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
