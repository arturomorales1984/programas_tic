/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : libros

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-04-15 21:49:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for libros
-- ----------------------------
DROP TABLE IF EXISTS `libros`;
CREATE TABLE `libros` (
  `codigo_libro` varchar(10) NOT NULL,
  `nombre_libro` varchar(255) DEFAULT NULL,
  `autor` varchar(255) DEFAULT NULL,
  `fecha_edicion` date DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`codigo_libro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of libros
-- ----------------------------
INSERT INTO `libros` VALUES ('0001', 'Matematica', 'Jairo Lopez', '2010-08-05', '50.00');
