CREATE DATABASE IF NOT EXISTS order_db;
USE order_db;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stop_lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_long` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stop_long` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1;

