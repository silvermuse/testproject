/*
 Navicat MariaDB Data Transfer

 Source Server         : Localhost
 Source Server Type    : MariaDB
 Source Server Version : 110103 (11.1.3-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : devtest

 Target Server Type    : MariaDB
 Target Server Version : 110103 (11.1.3-MariaDB)
 File Encoding         : 65001

 Date: 04/10/2025 16:29:12
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for addon_prices
-- ----------------------------
DROP TABLE IF EXISTS `addon_prices`;
CREATE TABLE `addon_prices` (
  `type` varchar(255) NOT NULL,
  `price` decimal(10,2) DEFAULT 0.00,
  `applicable_sizes` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of addon_prices
-- ----------------------------
BEGIN;
INSERT INTO `addon_prices` (`type`, `price`, `applicable_sizes`, `created_at`) VALUES ('extra_cheese', 6.00, NULL, '2025-10-04 16:00:28');
INSERT INTO `addon_prices` (`type`, `price`, `applicable_sizes`, `created_at`) VALUES ('pepperoni_medium', 5.00, 'medium', '2025-10-04 16:00:15');
INSERT INTO `addon_prices` (`type`, `price`, `applicable_sizes`, `created_at`) VALUES ('pepperoni_small', 3.00, 'small', '2025-10-04 16:00:01');
COMMIT;

-- ----------------------------
-- Table structure for pizza_prices
-- ----------------------------
DROP TABLE IF EXISTS `pizza_prices`;
CREATE TABLE `pizza_prices` (
  `size` varchar(30) NOT NULL,
  `price` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`size`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pizza_prices
-- ----------------------------
BEGIN;
INSERT INTO `pizza_prices` (`size`, `price`, `created_at`) VALUES ('large', 30.00, '2025-10-04 15:59:42');
INSERT INTO `pizza_prices` (`size`, `price`, `created_at`) VALUES ('medium', 22.00, '2025-10-04 15:59:30');
INSERT INTO `pizza_prices` (`size`, `price`, `created_at`) VALUES ('small', 15.00, '2025-10-04 15:59:19');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
