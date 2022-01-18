/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.18-MariaDB : Database - woolworths
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`woolworths` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `woolworths`;

/*Table structure for table `config` */

DROP TABLE IF EXISTS `config`;

CREATE TABLE `config` (
  `SSID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `store_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sys_id` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`SSID`,`store_name`,`sys_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='Contains the configuration data for each eInk tag to setup from';

/*Data for the table `config` */

/*Table structure for table `eink_tags` */

DROP TABLE IF EXISTS `eink_tags`;

CREATE TABLE `eink_tags` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The ID of the item',
  `product_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'The product name',
  `unit_quantity` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'The quantity of the item',
  `unit_of_measurement` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'For example, litres or grams',
  `product_price` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'The actual retail price of the item',
  `breakdown_price` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'The breakdown price of the item',
  `breakdown_divisor` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'The breakdown divisor (EG: per)',
  `breakdown_quantity` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'The breakdown quantity',
  `breakdown_unit` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'The breakdown unit (EG: litres or grams)',
  `ip_address` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'The IP address of the tag which contains this matching database entry information',
  `mac_address` varchar(18) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'The MACaddress of the tag which contains this matching database entry information',
  `barcode_data` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'The barcode data which will on the tags screen',
  `barcode_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'The barcode ID information',
  `sub_barcode_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'The sub-barcode ID information',
  `qr_code_data` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'The QR code data',
  `sale_mode` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Enabled if the user has selected this tag to have a sale price',
  `half_price_mode` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Enabled if the user has selected this tag to be half price',
  `half_price_value` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_sale_price` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'The actual value of when half price mode is enabled (EG: this would be half of the ''product_price'' data entry)',
  `created_at` datetime(6) NOT NULL COMMENT 'The data that this entry was last modified',
  `updated_at` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='Contains all the eInk data/information set for each tag';

/*Data for the table `eink_tags` */

insert  into `eink_tags`(`ID`,`product_name`,`unit_quantity`,`unit_of_measurement`,`product_price`,`breakdown_price`,`breakdown_divisor`,`breakdown_quantity`,`breakdown_unit`,`ip_address`,`mac_address`,`barcode_data`,`barcode_id`,`sub_barcode_id`,`qr_code_data`,`sale_mode`,`half_price_mode`,`half_price_value`,`product_sale_price`,`created_at`,`updated_at`) values 
(4,'Pepsi Cola','100','ml','14','4','per','100','ml','10.10.11.10','12:12:12:12:12:11','4567','1','2','1234','83','false',NULL,'100','2021-06-12 03:27:56.000000','2021-06-15 03:28:09.000000'),
(74,'This','100','gramms','$12.','$12.','of','100','gramms','localhost:8000',NULL,NULL,NULL,NULL,NULL,'true','true',NULL,NULL,'2021-06-17 09:38:07.000000',NULL),
(76,'Hello','100','gramms','$4.2','$5.3','per','100','gramms','localhost:8000',NULL,NULL,NULL,NULL,NULL,'false','true',NULL,NULL,'2021-06-17 09:39:36.000000',NULL),
(78,'AAA','100','gramms','$5.3','$3.3','per','100','gramms','localhost:8000',NULL,NULL,NULL,NULL,NULL,'true','true',NULL,NULL,'2021-06-18 06:28:12.000000',NULL),
(79,'qwe','100','gramms','$10.9','$10.9','per','100','gramms','localhost:8000',NULL,NULL,NULL,NULL,NULL,'true','true',NULL,NULL,'2021-06-18 18:41:09.000000',NULL),
(82,'qwe','100','gramms','$4.2','$3.3','per','100','gramms','localhost',NULL,NULL,NULL,NULL,NULL,'true','true',NULL,NULL,'2021-06-19 02:23:38.000000',NULL);

/*Table structure for table `error_list` */

DROP TABLE IF EXISTS `error_list`;

CREATE TABLE `error_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID, Primary',
  `err_type_id` int(11) NOT NULL COMMENT 'ErrorType table ID',
  `user` varchar(60) NOT NULL COMMENT 'Current User Email',
  `account` int(11) DEFAULT 0,
  `tag_id` int(11) DEFAULT NULL COMMENT 'Tag ID',
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `error_list` */

insert  into `error_list`(`id`,`err_type_id`,`user`,`account`,`tag_id`,`updated_at`) values 
(1,2,'111@111.com',1,NULL,'2021-08-03 22:12:37'),
(2,2,'Yanetolstiy@bk.ru',1,NULL,'2021-08-26 02:37:40');

/*Table structure for table `error_type` */

DROP TABLE IF EXISTS `error_type`;

CREATE TABLE `error_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(30) NOT NULL COMMENT 'Short Key of Error Type',
  `description` varchar(100) NOT NULL COMMENT 'Description of type',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `error_type` */

insert  into `error_type`(`id`,`name`,`description`) values 
(1,'NN_SUCESS','Hello!'),
(2,'CE_SYSID','System Identification is needed to use.'),
(3,'WN_WARNING','Warning Error!');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1);

/*Table structure for table `notice` */

DROP TABLE IF EXISTS `notice`;

CREATE TABLE `notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_id` int(11) DEFAULT NULL,
  `serverity` int(11) DEFAULT NULL COMMENT '0:notice,1:warning,2:critical',
  `error` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show` tinyint(1) DEFAULT NULL COMMENT '0:show,1:hide',
  `discover_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `notice` */

insert  into `notice`(`id`,`tag_id`,`serverity`,`error`,`show`,`discover_date`) values 
(1,NULL,0,'Schedule(Check Battery Levels) Updated!',NULL,NULL),
(2,NULL,2,'System Identification is needed to use.',0,'2021-08-11 22:12:57'),
(3,NULL,0,'Schedule(Backup the Database) Updated!',NULL,NULL);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `password_resets` */

/*Table structure for table `repeat_on_login` */

DROP TABLE IF EXISTS `repeat_on_login`;

CREATE TABLE `repeat_on_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flag` int(11) DEFAULT 1,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `repeat_on_login` */

insert  into `repeat_on_login`(`id`,`flag`,`updated_at`) values 
(1,1,'2021-07-23 02:37:56');

/*Table structure for table `scan_settings` */

DROP TABLE IF EXISTS `scan_settings`;

CREATE TABLE `scan_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `network_band` varchar(255) DEFAULT NULL,
  `vendor_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `scan_settings` */

insert  into `scan_settings`(`id`,`network_band`,`vendor_name`) values 
(1,'10.10.11.2/24','Giga-byte Technology');

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server_address` varchar(30) DEFAULT NULL,
  `ip_from` varchar(30) DEFAULT NULL,
  `ip_to` varchar(30) DEFAULT NULL,
  `store_location` varchar(60) DEFAULT NULL,
  `system_id` varchar(30) DEFAULT NULL,
  `system_ver` varchar(30) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `settings` */

insert  into `settings`(`id`,`server_address`,`ip_from`,`ip_to`,`store_location`,`system_id`,`system_ver`,`updated_at`) values 
(1,'192.168.10.1',NULL,NULL,NULL,NULL,'1.0.0','2021-07-26 10:57:56');

/*Table structure for table `task_name` */

DROP TABLE IF EXISTS `task_name`;

CREATE TABLE `task_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'task name using schedule',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `task_name` */

insert  into `task_name`(`id`,`name`) values 
(1,'Automatically Update Prices'),
(2,'Check Battery Levels'),
(3,'Backup the Database'),
(4,'Custom Event');

/*Table structure for table `units` */

DROP TABLE IF EXISTS `units`;

CREATE TABLE `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `units` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `users_email_unique` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(5,'Matt','test@test.com',NULL,'$2y$10$tEQrQHAFsz4ObrJB8q.mXuUxOzMin74GJctZAlqNTso3vg6GrU1su',NULL,'2021-06-02 11:09:42','2021-06-02 11:09:42'),
(8,'Ivan','Yanetolstiy@bk.ru',NULL,'$2y$10$Lg01NzJTBFbKUUyIUc2ehugQDORqXOAxTwNnfaf2FC55T8whBGOJe',NULL,'2021-06-09 21:40:25','2021-06-09 21:40:25'),
(9,'Administrator','yanetolstiy@ru.com',NULL,'$2y$10$x4Ln5gCDQr3NTIYjKDPQjeU98Q6l/PoujZA44eIGvrTev5ErTmzzK',NULL,'2021-07-20 05:53:04','2021-07-20 05:53:04'),
(13,'AAA','aaa@aaa.gmail',NULL,'$2y$10$5RgrTSNWV4hvAin81U3CF.cV3fFMLg1fTgd6F20IlufoEwWxbuKXa',NULL,'2021-07-22 06:31:57','2021-07-22 06:31:57'),
(14,'AAA','qwe@aaa.gmail',NULL,'$2y$10$WBlCK8RKRLOMv/c9n9q7AeYfyNnxFeFvWbFPypjm6hKs8VIVb6wty',NULL,'2021-07-22 06:38:54','2021-07-22 06:38:54'),
(15,'Administrator','111@111.com',NULL,'$2y$10$80o.yTpB15guY2fcUUjsZePmrHZ.L2mYxPyk.mQocNmljEMpWsv6y',NULL,'2021-07-22 06:39:59','2021-07-22 06:39:59'),
(16,'BBB','qwe@test.com',NULL,'$2y$10$PZok0/k95e8laUGaTxiVH.r7sx9NDeKh1RhSmUW1DUm1WWnnh60/G',NULL,'2021-07-22 06:45:23','2021-07-22 06:45:23'),
(17,'AAA','a@b.com',NULL,'$2y$10$QifjecRVRdoH6Q5cpHUpYev5.A0mDh8/ZPfwY3l18TQfDvFr3RQo6',NULL,'2021-07-22 17:55:40','2021-07-22 17:55:40'),
(18,'BBB','2@2.com',NULL,'$2y$10$isu./dfijdlA4aazCzUDvOzjI0shTFnuWcNXR2UhmCUpj6YAxj.3G',NULL,'2021-07-22 17:57:20','2021-07-22 17:57:20');

/*Table structure for table `week_schedule` */

DROP TABLE IF EXISTS `week_schedule`;

CREATE TABLE `week_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itaskid` int(11) DEFAULT NULL COMMENT '0-3',
  `strweekday` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ihour` int(11) DEFAULT NULL,
  `iminute` int(11) DEFAULT NULL COMMENT '0,30',
  `ihalfday` int(11) DEFAULT NULL COMMENT '0:am,1:pm',
  `strcolor` int(11) DEFAULT NULL COMMENT '0-5',
  `command_type` int(11) DEFAULT NULL COMMENT '0:proc_open,1:exec',
  `strcommand` text COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `week_schedule` */

insert  into `week_schedule`(`id`,`itaskid`,`strweekday`,`ihour`,`iminute`,`ihalfday`,`strcolor`,`command_type`,`strcommand`) values 
(78,2,'Mon',12,0,0,0,0,NULL),
(80,3,'Thu',12,0,0,1,0,NULL),
(81,3,'Fri',12,30,0,2,0,NULL),
(82,2,'Tue',9,0,0,3,0,NULL);

/* Trigger structure for table `eink_tags` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `insert_tag` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `insert_tag` AFTER INSERT ON `eink_tags` FOR EACH ROW BEGIN
	INSERT INTO `notice`(tag_id,serverity,error) VALUE(NULL,0,CONCAT('Tag(',new.product_name,') Added!'));
    END */$$


DELIMITER ;

/* Trigger structure for table `eink_tags` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `update_tag` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `update_tag` AFTER UPDATE ON `eink_tags` FOR EACH ROW BEGIN
	INSERT INTO `notice`(tag_id,serverity,error) VALUE(NULL,0,CONCAT('Tag(',new.product_name,') Updated!'));
    END */$$


DELIMITER ;

/* Trigger structure for table `eink_tags` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `delete_tag` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `delete_tag` AFTER DELETE ON `eink_tags` FOR EACH ROW BEGIN
	INSERT INTO `notice`(tag_id,serverity,error) VALUE(NULL,0,CONCAT('Tag(',old.product_name,') Deleted!'));
    END */$$


DELIMITER ;

/* Trigger structure for table `settings` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `insert_setting` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `insert_setting` AFTER INSERT ON `settings` FOR EACH ROW BEGIN
	INSERT INTO `notice`(tag_id,serverity,error) VALUE(NULL,0,'System has been verified');
    END */$$


DELIMITER ;

/* Trigger structure for table `settings` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `update_setting` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `update_setting` AFTER UPDATE ON `settings` FOR EACH ROW BEGIN
	INSERT INTO `notice`(tag_id,serverity,error) VALUE(NULL,0,'System has been changed');
    END */$$


DELIMITER ;

/* Trigger structure for table `week_schedule` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `insert_schedule` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `insert_schedule` AFTER INSERT ON `week_schedule` FOR EACH ROW BEGIN
	SET @name=(SELECT a.name FROM `task_name` AS a WHERE a.id=new.itaskid);
	INSERT INTO `notice`(tag_id,serverity,error) VALUE(NULL,0,CONCAT('Schedule(',@name,') Added!'));
    END */$$


DELIMITER ;

/* Trigger structure for table `week_schedule` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `update_schedule` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `update_schedule` AFTER UPDATE ON `week_schedule` FOR EACH ROW BEGIN
	SET @name=(select a.name from `task_name` as a where a.id=new.itaskid);
	INSERT INTO `notice`(tag_id,serverity,error) VALUE(NULL,0,concat('Schedule(',@name,') Updated!'));
    END */$$


DELIMITER ;

/* Trigger structure for table `week_schedule` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `delete_schedule` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `delete_schedule` AFTER DELETE ON `week_schedule` FOR EACH ROW BEGIN
	SET @name=(SELECT a.name FROM `task_name` AS a WHERE a.id=old.itaskid);
	INSERT INTO `notice`(tag_id,serverity,error) VALUE(NULL,0,CONCAT('Schedule(',@name,') Deleted!'));
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
