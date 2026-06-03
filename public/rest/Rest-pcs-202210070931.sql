-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: 10.130.223.26    Database: pcs
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.22-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cfrm_qty`
--

DROP TABLE IF EXISTS `cfrm_qty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cfrm_qty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Qty_NIK` text NOT NULL,
  `MM_CODE` int(11) NOT NULL,
  `Paint_id` int(11) NOT NULL,
  `Park_id` int(11) NOT NULL,
  `CURE_TIME` text NOT NULL,
  `dateTIME` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ip_cust_exp`
--

DROP TABLE IF EXISTS `ip_cust_exp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ip_cust_exp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `IP_CODE` int(11) NOT NULL,
  `Exp_Time` time NOT NULL DEFAULT '00:00:00',
  `is_active` int(11) NOT NULL DEFAULT 1,
  `Added_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip_cust_exp_un` (`IP_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ip_outside`
--

DROP TABLE IF EXISTS `ip_outside`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ip_outside` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `IP_CODE` int(11) NOT NULL,
  `DEFECT` text DEFAULT NULL,
  `POSISI` text DEFAULT NULL,
  `METODE` text DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `CAT_IP` int(11) NOT NULL DEFAULT 0,
  `Date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip_outside_un` (`IP_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mman`
--

DROP TABLE IF EXISTS `mman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `MM_CODE` int(11) NOT NULL,
  `Paint_id` int(11) NOT NULL,
  `Park_id` int(11) NOT NULL,
  `CURE_TIME` text NOT NULL,
  `dateTIME` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24358 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `painting`
--

DROP TABLE IF EXISTS `painting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `painting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `WM_CODE` int(8) NOT NULL DEFAULT 0,
  `WM_GROUP` text NOT NULL,
  `WM_SHIFT` int(11) NOT NULL,
  `WM_NAME_WM_SURNAME` text DEFAULT NULL,
  `MCH` text NOT NULL,
  `MAT_IP_CODE` int(8) NOT NULL DEFAULT 0,
  `MAT_DESC` text DEFAULT NULL,
  `Amount` int(2) DEFAULT NULL,
  `On_Insert` text NOT NULL,
  `CURE_TIME` text NOT NULL,
  `Count_Printed` int(11) DEFAULT NULL,
  `Park` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24427 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `painting_format`
--

DROP TABLE IF EXISTS `painting_format`;
/*!50001 DROP VIEW IF EXISTS `painting_format`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `painting_format` (
  `id` tinyint NOT NULL,
  `WM_CODE` tinyint NOT NULL,
  `WM_GROUP` tinyint NOT NULL,
  `WM_SHIFT` tinyint NOT NULL,
  `WM_NAME_WM_SURNAME` tinyint NOT NULL,
  `MCH` tinyint NOT NULL,
  `MAT_IP_CODE` tinyint NOT NULL,
  `MAT_DESC` tinyint NOT NULL,
  `Amount` tinyint NOT NULL,
  `On_Insert` tinyint NOT NULL,
  `CURE_TIME` tinyint NOT NULL,
  `Count_Printed` tinyint NOT NULL,
  `Park` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `parking`
--

DROP TABLE IF EXISTS `parking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slot` varchar(100) NOT NULL,
  `id_paint` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `parking_m`
--

DROP TABLE IF EXISTS `parking_m`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parking_m` (
  `id` int(11) NOT NULL,
  `slot` varchar(100) DEFAULT NULL,
  `id_paint` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `report_movingman`
--

DROP TABLE IF EXISTS `report_movingman`;
/*!50001 DROP VIEW IF EXISTS `report_movingman`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `report_movingman` (
  `id` tinyint NOT NULL,
  `NIK` tinyint NOT NULL,
  `Code_Machine` tinyint NOT NULL,
  `IP_CODE` tinyint NOT NULL,
  `MAT_DESC` tinyint NOT NULL,
  `Amount` tinyint NOT NULL,
  `CURE_TIME` tinyint NOT NULL,
  `Parked` tinyint NOT NULL,
  `CheckOut` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `trolley`
--

DROP TABLE IF EXISTS `trolley`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trolley` (
  `TR_CODE` varchar(5) DEFAULT NULL,
  `TR_STATUS` int(11) NOT NULL DEFAULT 0,
  `TR_LOC` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `created_at` varchar(50) DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `QC_ID` text NOT NULL COMMENT 'QC ID',
  `Full_Name` text NOT NULL COMMENT 'Full Name',
  `pass` text NOT NULL COMMENT 'Password',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COMMENT='datatable demo table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `v_parking_filled`
--

DROP TABLE IF EXISTS `v_parking_filled`;
/*!50001 DROP VIEW IF EXISTS `v_parking_filled`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_parking_filled` (
  `MAT_IP_CODE` tinyint NOT NULL,
  `MAT_DESC` tinyint NOT NULL,
  `slot` tinyint NOT NULL,
  `Amount` tinyint NOT NULL,
  `On_Insert` tinyint NOT NULL,
  `CURE_TIME` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_tbl_allprint`
--

DROP TABLE IF EXISTS `v_tbl_allprint`;
/*!50001 DROP VIEW IF EXISTS `v_tbl_allprint`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_tbl_allprint` (
  `MCH` tinyint NOT NULL,
  `IP_CODE` tinyint NOT NULL,
  `MAT_DESC` tinyint NOT NULL,
  `AMOUNT` tinyint NOT NULL,
  `SLOT` tinyint NOT NULL,
  `PRINT_OUT` tinyint NOT NULL,
  `CURING_TIME` tinyint NOT NULL,
  `USERNAME` tinyint NOT NULL,
  `GROUP_PAINT` tinyint NOT NULL,
  `SHIFT` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_tbl_allprint_1`
--

DROP TABLE IF EXISTS `v_tbl_allprint_1`;
/*!50001 DROP VIEW IF EXISTS `v_tbl_allprint_1`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_tbl_allprint_1` (
  `MCH` tinyint NOT NULL,
  `IP_CODE` tinyint NOT NULL,
  `MAT_DESC` tinyint NOT NULL,
  `AMOUNT` tinyint NOT NULL,
  `SLOT` tinyint NOT NULL,
  `PRINT_OUT` tinyint NOT NULL,
  `CURING_TIME` tinyint NOT NULL,
  `HOURS` tinyint NOT NULL,
  `EXPIRED_TIME` tinyint NOT NULL,
  `USERNAME` tinyint NOT NULL,
  `GROUP_PAINT` tinyint NOT NULL,
  `SHIFT` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_tbl_allprint_status`
--

DROP TABLE IF EXISTS `v_tbl_allprint_status`;
/*!50001 DROP VIEW IF EXISTS `v_tbl_allprint_status`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_tbl_allprint_status` (
  `MCH` tinyint NOT NULL,
  `IP_CODE` tinyint NOT NULL,
  `MAT_DESC` tinyint NOT NULL,
  `AMOUNT` tinyint NOT NULL,
  `SLOT` tinyint NOT NULL,
  `PRINT_OUT` tinyint NOT NULL,
  `CURING_TIME` tinyint NOT NULL,
  `HOURS` tinyint NOT NULL,
  `GT_STATUS` tinyint NOT NULL,
  `EXPIRED_TIME` tinyint NOT NULL,
  `USERNAME` tinyint NOT NULL,
  `GROUP_PAINT` tinyint NOT NULL,
  `SHIFT` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_tbl_allprint_status_ok`
--

DROP TABLE IF EXISTS `v_tbl_allprint_status_ok`;
/*!50001 DROP VIEW IF EXISTS `v_tbl_allprint_status_ok`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_tbl_allprint_status_ok` (
  `MCH` tinyint NOT NULL,
  `IP_CODE` tinyint NOT NULL,
  `MAT_DESC` tinyint NOT NULL,
  `AMOUNT` tinyint NOT NULL,
  `SLOT` tinyint NOT NULL,
  `PRINT_OUT` tinyint NOT NULL,
  `CURING_TIME` tinyint NOT NULL,
  `HOURS` tinyint NOT NULL,
  `GT_STATUS` tinyint NOT NULL,
  `EXPIRED_TIME` tinyint NOT NULL,
  `USERNAME` tinyint NOT NULL,
  `GROUP_PAINT` tinyint NOT NULL,
  `SHIFT` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_tbl_checkout`
--

DROP TABLE IF EXISTS `v_tbl_checkout`;
/*!50001 DROP VIEW IF EXISTS `v_tbl_checkout`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_tbl_checkout` (
  `IP_CODE` tinyint NOT NULL,
  `MAT_DESC` tinyint NOT NULL,
  `MCH` tinyint NOT NULL,
  `AMOUNT` tinyint NOT NULL,
  `SLOT` tinyint NOT NULL,
  `USERNAME` tinyint NOT NULL,
  `GROUP_PAINT` tinyint NOT NULL,
  `SHIFT` tinyint NOT NULL,
  `PRINT_OUT` tinyint NOT NULL,
  `CURE_TIME` tinyint NOT NULL,
  `CHECKOUT_TIME` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_tbl_checkout_1`
--

DROP TABLE IF EXISTS `v_tbl_checkout_1`;
/*!50001 DROP VIEW IF EXISTS `v_tbl_checkout_1`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_tbl_checkout_1` (
  `IP_CODE` tinyint NOT NULL,
  `MAT_DESC` tinyint NOT NULL,
  `MCH` tinyint NOT NULL,
  `AMOUNT` tinyint NOT NULL,
  `SLOT` tinyint NOT NULL,
  `USERNAME` tinyint NOT NULL,
  `GROUP_PAINT` tinyint NOT NULL,
  `SHIFT` tinyint NOT NULL,
  `PRINT_OUT` tinyint NOT NULL,
  `HOURS` tinyint NOT NULL,
  `EXPIRED_TIME` tinyint NOT NULL,
  `CURE_TIME` tinyint NOT NULL,
  `CHECKOUT_TIME` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_tbl_list_parking`
--

DROP TABLE IF EXISTS `v_tbl_list_parking`;
/*!50001 DROP VIEW IF EXISTS `v_tbl_list_parking`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_tbl_list_parking` (
  `IP_CODE` tinyint NOT NULL,
  `MCH` tinyint NOT NULL,
  `MAT_DESC` tinyint NOT NULL,
  `SLOT` tinyint NOT NULL,
  `AMOUNT` tinyint NOT NULL,
  `USERNAME` tinyint NOT NULL,
  `PRINT_OUT` tinyint NOT NULL,
  `CURE_TIME` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_tbl_list_parking_1`
--

DROP TABLE IF EXISTS `v_tbl_list_parking_1`;
/*!50001 DROP VIEW IF EXISTS `v_tbl_list_parking_1`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_tbl_list_parking_1` (
  `IP_CODE` tinyint NOT NULL,
  `MCH` tinyint NOT NULL,
  `MAT_DESC` tinyint NOT NULL,
  `SLOT` tinyint NOT NULL,
  `AMOUNT` tinyint NOT NULL,
  `USERNAME` tinyint NOT NULL,
  `PRINT_OUT` tinyint NOT NULL,
  `CURE_TIME` tinyint NOT NULL,
  `HOURS` tinyint NOT NULL,
  `EXPIRED_TIME` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_tbl_list_parking_status`
--

DROP TABLE IF EXISTS `v_tbl_list_parking_status`;
/*!50001 DROP VIEW IF EXISTS `v_tbl_list_parking_status`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_tbl_list_parking_status` (
  `IP_CODE` tinyint NOT NULL,
  `MCH` tinyint NOT NULL,
  `MAT_DESC` tinyint NOT NULL,
  `SLOT` tinyint NOT NULL,
  `AMOUNT` tinyint NOT NULL,
  `USERNAME` tinyint NOT NULL,
  `PRINT_OUT` tinyint NOT NULL,
  `CURE_TIME` tinyint NOT NULL,
  `HOURS` tinyint NOT NULL,
  `EXPIRED_TIME` tinyint NOT NULL,
  `GT_STATUS` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_tbl_statistik`
--

DROP TABLE IF EXISTS `v_tbl_statistik`;
/*!50001 DROP VIEW IF EXISTS `v_tbl_statistik`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_tbl_statistik` (
  `MAT_IP_CODE` tinyint NOT NULL,
  `Total` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'pcs'
--

--
-- Dumping routines for database 'pcs'
--
/*!50003 DROP PROCEDURE IF EXISTS `allprint_Shift1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`painting`@`%` PROCEDURE `allprint_Shift1`(tgl date)
begin
	SET tgl = IFNULL(tgl, now());
	SELECT *
	FROM pcs.painting
	WHERE 
	str_to_date(On_Insert, '%d/%m/%Y %H.%i') BETWEEN DATE_FORMAT(date(tgl),'%Y/%m/%d 00:00:00') 
	AND DATE_FORMAT(date(tgl),'%Y/%m/%d 08:00:00');
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `allprint_Shift2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`painting`@`%` PROCEDURE `allprint_Shift2`(tgl date)
begin
	SET tgl = IFNULL(tgl, now());
	SELECT id, WM_CODE, WM_GROUP, WM_SHIFT, WM_NAME_WM_SURNAME, MCH, MAT_IP_CODE, MAT_DESC, Amount, On_Insert, CURE_TIME, Count_Printed, Park
	FROM pcs.painting
	WHERE 
	str_to_date(On_Insert, '%d/%m/%Y %H.%i') BETWEEN DATE_FORMAT(date(tgl),'%Y/%m/%d 08:00:00') 
	AND DATE_FORMAT(date(tgl),'%Y/%m/%d 16:00:00');
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `allprint_Shift3` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`painting`@`%` PROCEDURE `allprint_Shift3`(IN `tgl` DATE)
begin
	SET tgl = IFNULL(tgl, now());
	SELECT id, WM_CODE, WM_GROUP, WM_SHIFT, WM_NAME_WM_SURNAME, MCH, MAT_IP_CODE, MAT_DESC, Amount, On_Insert, CURE_TIME, Count_Printed, Park
	FROM pcs.painting
	WHERE 
	str_to_date(On_Insert, '%d/%m/%Y %H.%i') BETWEEN DATE_FORMAT(date(tgl),'%Y/%m/%d 17:00:00') 
	AND DATE_FORMAT(date(tgl),'%Y/%m/%d 23:59:00');
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `painting_format`
--

/*!50001 DROP TABLE IF EXISTS `painting_format`*/;
/*!50001 DROP VIEW IF EXISTS `painting_format`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`painting`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `painting_format` AS select `painting`.`id` AS `id`,`painting`.`WM_CODE` AS `WM_CODE`,`painting`.`WM_GROUP` AS `WM_GROUP`,`painting`.`WM_SHIFT` AS `WM_SHIFT`,`painting`.`WM_NAME_WM_SURNAME` AS `WM_NAME_WM_SURNAME`,`painting`.`MCH` AS `MCH`,`painting`.`MAT_IP_CODE` AS `MAT_IP_CODE`,`painting`.`MAT_DESC` AS `MAT_DESC`,`painting`.`Amount` AS `Amount`,str_to_date(`painting`.`On_Insert`,'%d/%m/%Y %H.%i') AS `On_Insert`,str_to_date(`painting`.`CURE_TIME`,'%d/%m/%Y %H.%i') AS `CURE_TIME`,`painting`.`Count_Printed` AS `Count_Printed`,`painting`.`Park` AS `Park` from `painting` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `report_movingman`
--

/*!50001 DROP TABLE IF EXISTS `report_movingman`*/;
/*!50001 DROP VIEW IF EXISTS `report_movingman`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `report_movingman` AS select `a`.`id` AS `id`,`a`.`MM_CODE` AS `NIK`,`b`.`MCH` AS `Code_Machine`,`b`.`MAT_IP_CODE` AS `IP_CODE`,`b`.`MAT_DESC` AS `MAT_DESC`,`b`.`Amount` AS `Amount`,`b`.`CURE_TIME` AS `CURE_TIME`,`c`.`slot` AS `Parked`,`a`.`dateTIME` AS `CheckOut` from ((`mman` `a` join `painting` `b`) join `parking` `c`) where `a`.`Paint_id` = `b`.`id` and `a`.`Park_id` = `c`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_parking_filled`
--

/*!50001 DROP TABLE IF EXISTS `v_parking_filled`*/;
/*!50001 DROP VIEW IF EXISTS `v_parking_filled`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`painting`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `v_parking_filled` AS select `b`.`MAT_IP_CODE` AS `MAT_IP_CODE`,`b`.`MAT_DESC` AS `MAT_DESC`,`a`.`slot` AS `slot`,`b`.`Amount` AS `Amount`,`b`.`On_Insert` AS `On_Insert`,`b`.`CURE_TIME` AS `CURE_TIME` from (`parking` `a` left join `painting` `b` on(`a`.`id_paint` = `b`.`id`)) where `a`.`id_paint` > 0 order by `b`.`MAT_IP_CODE` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_tbl_allprint`
--

/*!50001 DROP TABLE IF EXISTS `v_tbl_allprint`*/;
/*!50001 DROP VIEW IF EXISTS `v_tbl_allprint`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_tbl_allprint` AS select `painting`.`MCH` AS `MCH`,`painting`.`MAT_IP_CODE` AS `IP_CODE`,`painting`.`MAT_DESC` AS `MAT_DESC`,`painting`.`Amount` AS `AMOUNT`,`painting`.`Park` AS `SLOT`,str_to_date(`painting`.`On_Insert`,'%d/%m/%Y %H.%i') AS `PRINT_OUT`,str_to_date(`painting`.`CURE_TIME`,'%d/%m/%Y %H.%i') AS `CURING_TIME`,`painting`.`WM_NAME_WM_SURNAME` AS `USERNAME`,`painting`.`WM_GROUP` AS `GROUP_PAINT`,`painting`.`WM_SHIFT` AS `SHIFT` from `painting` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_tbl_allprint_1`
--

/*!50001 DROP TABLE IF EXISTS `v_tbl_allprint_1`*/;
/*!50001 DROP VIEW IF EXISTS `v_tbl_allprint_1`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_tbl_allprint_1` AS select `v_tbl_allprint`.`MCH` AS `MCH`,`v_tbl_allprint`.`IP_CODE` AS `IP_CODE`,`v_tbl_allprint`.`MAT_DESC` AS `MAT_DESC`,`v_tbl_allprint`.`AMOUNT` AS `AMOUNT`,`v_tbl_allprint`.`SLOT` AS `SLOT`,`v_tbl_allprint`.`PRINT_OUT` AS `PRINT_OUT`,`v_tbl_allprint`.`CURING_TIME` AS `CURING_TIME`,timediff(current_timestamp(),`v_tbl_allprint`.`PRINT_OUT`) AS `HOURS`,`v_tbl_allprint`.`PRINT_OUT` + interval 120 hour AS `EXPIRED_TIME`,`v_tbl_allprint`.`USERNAME` AS `USERNAME`,`v_tbl_allprint`.`GROUP_PAINT` AS `GROUP_PAINT`,`v_tbl_allprint`.`SHIFT` AS `SHIFT` from `v_tbl_allprint` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_tbl_allprint_status`
--

/*!50001 DROP TABLE IF EXISTS `v_tbl_allprint_status`*/;
/*!50001 DROP VIEW IF EXISTS `v_tbl_allprint_status`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`painting`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `v_tbl_allprint_status` AS select `v_tbl_allprint_1`.`MCH` AS `MCH`,`v_tbl_allprint_1`.`IP_CODE` AS `IP_CODE`,`v_tbl_allprint_1`.`MAT_DESC` AS `MAT_DESC`,`v_tbl_allprint_1`.`AMOUNT` AS `AMOUNT`,`v_tbl_allprint_1`.`SLOT` AS `SLOT`,`v_tbl_allprint_1`.`PRINT_OUT` AS `PRINT_OUT`,`v_tbl_allprint_1`.`CURING_TIME` AS `CURING_TIME`,`v_tbl_allprint_1`.`HOURS` AS `HOURS`,case when `v_tbl_allprint_1`.`HOURS` > '120:00:00' then 'EXPIRED' when `v_tbl_allprint_1`.`HOURS` between '110:00:00' and '120:00:00' then 'TO EXPIRE' else 'NORMAL' end AS `GT_STATUS`,`v_tbl_allprint_1`.`EXPIRED_TIME` AS `EXPIRED_TIME`,`v_tbl_allprint_1`.`USERNAME` AS `USERNAME`,`v_tbl_allprint_1`.`GROUP_PAINT` AS `GROUP_PAINT`,`v_tbl_allprint_1`.`SHIFT` AS `SHIFT` from `v_tbl_allprint_1` order by `v_tbl_allprint_1`.`PRINT_OUT` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_tbl_allprint_status_ok`
--

/*!50001 DROP TABLE IF EXISTS `v_tbl_allprint_status_ok`*/;
/*!50001 DROP VIEW IF EXISTS `v_tbl_allprint_status_ok`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_tbl_allprint_status_ok` AS select `v_tbl_allprint_status`.`MCH` AS `MCH`,`v_tbl_allprint_status`.`IP_CODE` AS `IP_CODE`,`v_tbl_allprint_status`.`MAT_DESC` AS `MAT_DESC`,`v_tbl_allprint_status`.`AMOUNT` AS `AMOUNT`,`v_tbl_allprint_status`.`SLOT` AS `SLOT`,date_format(`v_tbl_allprint_status`.`PRINT_OUT`,'%d/%m/%Y %H:%i:%s') AS `PRINT_OUT`,date_format(`v_tbl_allprint_status`.`CURING_TIME`,'%d/%m/%Y %H:%i:%s') AS `CURING_TIME`,`v_tbl_allprint_status`.`HOURS` AS `HOURS`,`v_tbl_allprint_status`.`GT_STATUS` AS `GT_STATUS`,date_format(`v_tbl_allprint_status`.`EXPIRED_TIME`,'%d/%m/%Y %H:%i:%s') AS `EXPIRED_TIME`,`v_tbl_allprint_status`.`USERNAME` AS `USERNAME`,`v_tbl_allprint_status`.`GROUP_PAINT` AS `GROUP_PAINT`,`v_tbl_allprint_status`.`SHIFT` AS `SHIFT` from `v_tbl_allprint_status` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_tbl_checkout`
--

/*!50001 DROP TABLE IF EXISTS `v_tbl_checkout`*/;
/*!50001 DROP VIEW IF EXISTS `v_tbl_checkout`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_tbl_checkout` AS select `p`.`MAT_IP_CODE` AS `IP_CODE`,`p`.`MAT_DESC` AS `MAT_DESC`,`p`.`MCH` AS `MCH`,`p`.`Amount` AS `AMOUNT`,`p`.`Park` AS `SLOT`,`p`.`WM_NAME_WM_SURNAME` AS `USERNAME`,`p`.`WM_GROUP` AS `GROUP_PAINT`,`p`.`WM_SHIFT` AS `SHIFT`,str_to_date(`p`.`On_Insert`,'%d/%m/%Y %H.%i') AS `PRINT_OUT`,str_to_date(`p`.`CURE_TIME`,'%d/%m/%Y %H.%i') AS `CURE_TIME`,str_to_date(`m`.`dateTIME`,'%d/%m/%Y %H.%i') AS `CHECKOUT_TIME` from ((`painting` `p` join `parking` `pr`) join `mman` `m`) where `m`.`Paint_id` = `p`.`id` and `m`.`Park_id` = `pr`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_tbl_checkout_1`
--

/*!50001 DROP TABLE IF EXISTS `v_tbl_checkout_1`*/;
/*!50001 DROP VIEW IF EXISTS `v_tbl_checkout_1`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_tbl_checkout_1` AS select `v_tbl_checkout`.`IP_CODE` AS `IP_CODE`,`v_tbl_checkout`.`MAT_DESC` AS `MAT_DESC`,`v_tbl_checkout`.`MCH` AS `MCH`,`v_tbl_checkout`.`AMOUNT` AS `AMOUNT`,`v_tbl_checkout`.`SLOT` AS `SLOT`,`v_tbl_checkout`.`USERNAME` AS `USERNAME`,`v_tbl_checkout`.`GROUP_PAINT` AS `GROUP_PAINT`,`v_tbl_checkout`.`SHIFT` AS `SHIFT`,`v_tbl_checkout`.`PRINT_OUT` AS `PRINT_OUT`,timediff(current_timestamp(),`v_tbl_checkout`.`PRINT_OUT`) AS `HOURS`,`v_tbl_checkout`.`PRINT_OUT` + interval 120 hour AS `EXPIRED_TIME`,`v_tbl_checkout`.`CURE_TIME` AS `CURE_TIME`,`v_tbl_checkout`.`CHECKOUT_TIME` AS `CHECKOUT_TIME` from `v_tbl_checkout` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_tbl_list_parking`
--

/*!50001 DROP TABLE IF EXISTS `v_tbl_list_parking`*/;
/*!50001 DROP VIEW IF EXISTS `v_tbl_list_parking`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_tbl_list_parking` AS select `b`.`MAT_IP_CODE` AS `IP_CODE`,`b`.`MCH` AS `MCH`,`b`.`MAT_DESC` AS `MAT_DESC`,`a`.`slot` AS `SLOT`,`b`.`Amount` AS `AMOUNT`,`b`.`WM_NAME_WM_SURNAME` AS `USERNAME`,str_to_date(`b`.`On_Insert`,'%d/%m/%Y %H.%i') AS `PRINT_OUT`,`b`.`CURE_TIME` AS `CURE_TIME` from (`parking` `a` left join `painting` `b` on(`a`.`id_paint` = `b`.`id`)) where `a`.`id_paint` > 0 order by `b`.`MAT_IP_CODE` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_tbl_list_parking_1`
--

/*!50001 DROP TABLE IF EXISTS `v_tbl_list_parking_1`*/;
/*!50001 DROP VIEW IF EXISTS `v_tbl_list_parking_1`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_tbl_list_parking_1` AS select `v_tbl_list_parking`.`IP_CODE` AS `IP_CODE`,`v_tbl_list_parking`.`MCH` AS `MCH`,`v_tbl_list_parking`.`MAT_DESC` AS `MAT_DESC`,`v_tbl_list_parking`.`SLOT` AS `SLOT`,`v_tbl_list_parking`.`AMOUNT` AS `AMOUNT`,`v_tbl_list_parking`.`USERNAME` AS `USERNAME`,`v_tbl_list_parking`.`PRINT_OUT` AS `PRINT_OUT`,`v_tbl_list_parking`.`CURE_TIME` AS `CURE_TIME`,timediff(current_timestamp(),`v_tbl_list_parking`.`PRINT_OUT`) AS `HOURS`,`v_tbl_list_parking`.`PRINT_OUT` + interval 120 hour AS `EXPIRED_TIME` from `v_tbl_list_parking` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_tbl_list_parking_status`
--

/*!50001 DROP TABLE IF EXISTS `v_tbl_list_parking_status`*/;
/*!50001 DROP VIEW IF EXISTS `v_tbl_list_parking_status`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_tbl_list_parking_status` AS select `v_tbl_list_parking_1`.`IP_CODE` AS `IP_CODE`,`v_tbl_list_parking_1`.`MCH` AS `MCH`,`v_tbl_list_parking_1`.`MAT_DESC` AS `MAT_DESC`,`v_tbl_list_parking_1`.`SLOT` AS `SLOT`,`v_tbl_list_parking_1`.`AMOUNT` AS `AMOUNT`,`v_tbl_list_parking_1`.`USERNAME` AS `USERNAME`,`v_tbl_list_parking_1`.`PRINT_OUT` AS `PRINT_OUT`,`v_tbl_list_parking_1`.`CURE_TIME` AS `CURE_TIME`,`v_tbl_list_parking_1`.`HOURS` AS `HOURS`,`v_tbl_list_parking_1`.`EXPIRED_TIME` AS `EXPIRED_TIME`,case when `v_tbl_list_parking_1`.`HOURS` > '120:00:00' then 'EXPIRED' when `v_tbl_list_parking_1`.`HOURS` between '110:00:00' and '120:00:00' then 'TO EXPIRE' else 'NORMAL' end AS `GT_STATUS` from `v_tbl_list_parking_1` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_tbl_statistik`
--

/*!50001 DROP TABLE IF EXISTS `v_tbl_statistik`*/;
/*!50001 DROP VIEW IF EXISTS `v_tbl_statistik`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`painting`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `v_tbl_statistik` AS select `b`.`MAT_IP_CODE` AS `MAT_IP_CODE`,sum(`b`.`Amount`) AS `Total` from (`parking` `a` left join `painting` `b` on(`a`.`id_paint` = `b`.`id`)) where `a`.`id_paint` > 0 group by `b`.`MAT_IP_CODE` order by sum(`b`.`Amount`) desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-10-07  9:34:20
