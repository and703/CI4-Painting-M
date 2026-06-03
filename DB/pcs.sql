-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2022 at 03:05 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pcs`
--
CREATE DATABASE IF NOT EXISTS `pcs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pcs`;

-- --------------------------------------------------------

--
-- Table structure for table `cfrm_qty`
--

DROP TABLE IF EXISTS `cfrm_qty`;
CREATE TABLE IF NOT EXISTS `cfrm_qty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Qty_NIK` text NOT NULL,
  `MM_CODE` int(11) NOT NULL,
  `Paint_id` int(11) NOT NULL,
  `Park_id` int(11) NOT NULL,
  `CURE_TIME` text NOT NULL,
  `dateTIME` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cfrm_qty`
--

INSERT INTO `cfrm_qty` (`id`, `Qty_NIK`, `MM_CODE`, `Paint_id`, `Park_id`, `CURE_TIME`, `dateTIME`) VALUES
(1, '0', 55107317, 20, 6, '27/01/2022 11.57', '27/01/2022 09.49'),
(2, 'QC001', 55107317, 22, 8, '27/01/2022 11.58', '27/01/2022 11.50'),
(3, 'QC001', 55107317, 19, 5, '27/01/2022 11.57', '27/01/2022 11.51'),
(4, 'QC001', 55107317, 23, 5, '27/01/2022 14.54', '27/01/2022 11.54'),
(5, 'QC001', 55107317, 24, 5, '27/01/2022 14.55', '27/01/2022 11.58'),
(6, 'QC001', 55107317, 25, 5, '28/01/2022 13.13', '28/01/2022 11.27');

-- --------------------------------------------------------

--
-- Table structure for table `mman`
--

DROP TABLE IF EXISTS `mman`;
CREATE TABLE IF NOT EXISTS `mman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `MM_CODE` int(11) NOT NULL,
  `Paint_id` int(11) NOT NULL,
  `Park_id` int(11) NOT NULL,
  `CURE_TIME` text NOT NULL,
  `dateTIME` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mman`
--

INSERT INTO `mman` (`id`, `MM_CODE`, `Paint_id`, `Park_id`, `CURE_TIME`, `dateTIME`) VALUES
(1, 55174719, 2, 2, '', '18/01/2022 14.20'),
(2, 55174719, 4, 2, '', '18/01/2022 14.22'),
(3, 55174719, 5, 3, '', '18/01/2022 14.28'),
(4, 55174719, 6, 4, '', '18/01/2022 14.30'),
(5, 55174719, 3, 1, '', '18/01/2022 15.16'),
(6, 0, 11, 5, '', '21/01/2022 10.26'),
(7, 0, 7, 1, '', '21/01/2022 11.41'),
(8, 0, 13, 1, '', '24/01/2022 12.31'),
(9, 55107317, 9, 3, '', '24/01/2022 12.35'),
(10, 0, 8, 2, '', '25/01/2022 09.15'),
(11, 55107317, 7, 1, '', '26/01/2022 09.02'),
(12, 0, 18, 6, '', '27/01/2022 08.52'),
(13, 0, 12, 5, '', '27/01/2022 08.54'),
(14, 55107317, 21, 7, '', '27/01/2022 09.43'),
(15, 55107317, 20, 6, '', '27/01/2022 09.49'),
(16, 55107317, 22, 8, '', '27/01/2022 11.50'),
(17, 55107317, 19, 5, '', '27/01/2022 11.51'),
(18, 55107317, 23, 5, '', '27/01/2022 11.54'),
(19, 55107317, 24, 5, '', '27/01/2022 11.58'),
(20, 55107317, 10, 4, '', '28/01/2022 10.29'),
(21, 55107317, 25, 5, '', '28/01/2022 11.27');

-- --------------------------------------------------------

--
-- Table structure for table `painting`
--

DROP TABLE IF EXISTS `painting`;
CREATE TABLE IF NOT EXISTS `painting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `WM_CODE` int(8) NOT NULL DEFAULT 0,
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
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `painting`
--

INSERT INTO `painting` (`id`, `WM_CODE`, `WM_NAME_WM_SURNAME`, `MCH`, `MAT_IP_CODE`, `MAT_DESC`, `Amount`, `On_Insert`, `CURE_TIME`, `Count_Printed`, `Park`) VALUES
(1, 55174719, 'Sandi  Hardiansyah', 'A1', 25840, '90/90 - 18M/C REINF 57P CiDemR', 36, '18/01/2022 14.16', '18/01/2022 17.16', 1, 'P001'),
(2, 55174719, 'Sandi  Hardiansyah', 'M1', 27710, '130/70-12REINFTL 62P ANGSCR', 36, '18/01/2022 14.17', '18/01/2022 17.17', 1, 'P002'),
(3, 55174719, 'Sandi  Hardiansyah', 'A1', 25840, '90/90 - 18M/C REINF 57P CiDemR', 36, '18/01/2022 14.21', '18/01/2022 17.21', 1, 'P001'),
(4, 55174719, 'Sandi  Hardiansyah', 'A1', 27710, '130/70-12REINFTL 62P ANGSCR', 36, '18/01/2022 14.21', '18/01/2022 17.21', 1, 'P002'),
(5, 55174719, 'Sandi  Hardiansyah', 'M1', 25840, '90/90 - 18M/C REINF 57P CiDemR', 36, '18/01/2022 14.21', '18/01/2022 17.21', 1, 'P003'),
(6, 55174719, 'Sandi  Hardiansyah', 'M1', 27710, '130/70-12REINFTL 62P ANGSCR', 36, '18/01/2022 14.21', '18/01/2022 17.21', 1, 'P004'),
(7, 55174719, 'Sandi  Hardiansyah', 'A1', 25840, '90/90 - 18M/C REINF 57P CiDemR', 36, '21/01/2022 10.20', '21/01/2022 13.20', 1, 'P001'),
(8, 55174719, 'Sandi  Hardiansyah', 'A1', 27710, '130/70-12REINFTL 62P ANGSCR', 36, '21/01/2022 10.20', '21/01/2022 13.20', 1, 'P002'),
(9, 55174719, 'Sandi  Hardiansyah', 'M1', 25840, '90/90 - 18M/C REINF 57P CiDemR', 36, '21/01/2022 10.21', '21/01/2022 13.21', 1, 'P003'),
(10, 55174719, 'Sandi  Hardiansyah', 'A1', 27710, '130/70-12REINFTL 62P ANGSCR', 36, '21/01/2022 10.21', '21/01/2022 13.21', 1, 'P004'),
(11, 55174719, 'Sandi  Hardiansyah', 'M1', 25840, '90/90 - 18M/C REINF 57P CiDemR', 36, '21/01/2022 10.22', '21/01/2022 13.22', 1, 'P005'),
(12, 55107317, 'Jajang Nurjaman', 'A1', 25840, '90/90 - 18M/C REINF 57P CiDemR', 36, '21/01/2022 10.33', '21/01/2022 13.33', 1, 'P005'),
(13, 55174719, 'Sandi  Hardiansyah', 'M1', 25840, '90/90 - 18M/C REINF 57P CiDemR', 36, '24/01/2022 12.23', '24/01/2022 15.23', 1, 'P001'),
(14, 55174719, 'Sandi  Hardiansyah', 'A1', 25840, '90/90 - 18M/C REINF 57P CiDemR', 36, '24/01/2022 12.34', '24/01/2022 15.34', 1, 'P001'),
(15, 55107317, 'Jajang Nurjaman', 'M1', 27710, '130/70-12REINFTL 62P ANGSCR', 36, '26/01/2022 09.20', '26/01/2022 12.20', 1, 'P001'),
(16, 55107317, 'Jajang Nurjaman', 'A1', 25840, '90/90 - 18M/C REINF 57P CiDemR', 36, '26/01/2022 09.20', '26/01/2022 12.20', 1, 'P002'),
(17, 55107317, 'Jajang Nurjaman', 'A1', 27710, '130/70-12REINFTL 62P ANGSCR', 36, '26/01/2022 16.09', '26/01/2022 19.09', 1, 'P003'),
(18, 55107317, 'Jajang Nurjaman', 'M1', 25840, '90/90 - 18M/C REINF 57P CiDemR', 36, '26/01/2022 16.09', '26/01/2022 19.09', 1, 'P006'),
(19, 55174719, 'Sandi  Hardiansyah', 'M1', 25840, '90/90 - 18M/C REINF 57P CiDemR', 36, '27/01/2022 08.57', '27/01/2022 11.57', 1, 'P005'),
(20, 55174719, 'Sandi  Hardiansyah', 'A1', 25840, '90/90 - 18M/C REINF 57P CiDemR', 36, '27/01/2022 08.57', '27/01/2022 11.57', 1, 'P006'),
(21, 55174719, 'Sandi  Hardiansyah', 'A1', 27710, '130/70-12REINFTL 62P ANGSCR', 36, '27/01/2022 08.57', '27/01/2022 11.57', 1, 'P007'),
(22, 55174719, 'Sandi  Hardiansyah', 'A1', 27710, '130/70-12REINFTL 62P ANGSCR', 363, '27/01/2022 08.58', '27/01/2022 11.58', 1, 'P008'),
(23, 55174719, 'Sandi  Hardiansyah', 'A1', 25840, '90/90 - 18M/C REINF 57P CiDemR', 36, '27/01/2022 11.54', '27/01/2022 14.54', 1, 'P005'),
(24, 55174719, 'Sandi  Hardiansyah', 'M1', 25840, '90/90 - 18M/C REINF 57P CiDemR', 36, '27/01/2022 11.55', '27/01/2022 14.55', 1, 'P005'),
(25, 55174719, 'Sandi  Hardiansyah', 'A1', 25840, '90/90 - 18M/C REINF 57P CiDemR', 36, '28/01/2022 10.13', '28/01/2022 13.13', 1, 'P005'),
(26, 55174719, 'Sandi  Hardiansyah', 'M1', 25840, '90/90 - 18M/C REINF 57P CiDemR', 36, '28/01/2022 10.13', '28/01/2022 13.13', 1, 'P006'),
(27, 55174719, 'Sandi  Hardiansyah', 'A1', 27710, '130/70-12REINFTL 62P ANGSCR', 36, '28/01/2022 10.13', '28/01/2022 13.13', 1, 'P007'),
(28, 55174719, 'Sandi  Hardiansyah', 'M1', 27710, '130/70-12REINFTL 62P ANGSCR', 36, '28/01/2022 10.13', '28/01/2022 13.13', 1, 'P008'),
(29, 55174719, 'Sandi  Hardiansyah', 'M1', 25840, '90/90 - 18M/C REINF 57P CiDemR', 36, '28/01/2022 10.14', '28/01/2022 13.14', 1, 'P009'),
(30, 55174719, 'Sandi  Hardiansyah', 'M1', 25840, '90/90 - 18M/C REINF 57P CiDemR', 36, '28/01/2022 10.21', '28/01/2022 13.21', 1, 'P010'),
(31, 55107317, 'Jajang Nurjaman', 'A1', 25840, '90/90 - 18M/C REINF 57P CiDemR', 34, '28/01/2022 11.11', '28/01/2022 14.11', 1, 'P004');

-- --------------------------------------------------------

--
-- Table structure for table `parking`
--

DROP TABLE IF EXISTS `parking`;
CREATE TABLE IF NOT EXISTS `parking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slot` varchar(100) NOT NULL,
  `id_paint` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parking`
--

INSERT INTO `parking` (`id`, `slot`, `id_paint`) VALUES
(1, 'P001', 15),
(2, 'P002', 16),
(3, 'P003', 17),
(4, 'P004', 31),
(5, 'P005', 0),
(6, 'P006', 26),
(7, 'P007', 27),
(8, 'P008', 28),
(9, 'P009', 29),
(10, 'P010', 30),
(11, 'P011', 0),
(12, 'P012', 0),
(13, 'P013', 0),
(14, 'P014', 0),
(15, 'P015', 0),
(16, 'P016', 0),
(17, 'P017', 0),
(18, 'P018', 0),
(19, 'P019', 0),
(20, 'P020', 0),
(21, 'P021', 0),
(22, 'P022', 0),
(23, 'P023', 0),
(24, 'P024', 0),
(25, 'P025', 0),
(26, 'P026', 0),
(27, 'P027', 0),
(28, 'P028', 0),
(29, 'P029', 0),
(30, 'P030', 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `report_movingman`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `report_movingman`;
CREATE TABLE IF NOT EXISTS `report_movingman` (
`id` int(11)
,`NIK` int(11)
,`Code_Machine` text
,`IP_CODE` int(8)
,`MAT_DESC` text
,`Amount` int(2)
,`CURE_TIME` text
,`Parked` varchar(100)
,`CheckOut` text
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `QC_ID` text NOT NULL COMMENT 'QC ID',
  `Full_Name` text NOT NULL COMMENT 'Full Name',
  `pass` text NOT NULL COMMENT 'Password',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 COMMENT='datatable demo table';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `QC_ID`, `Full_Name`, `pass`, `created_at`, `updated_at`) VALUES
(11, 'QC001', 'Quality 1', 'Pzero7744', '2022-01-26 09:36:02', '2022-01-26 09:36:02'),
(12, 'QC002', 'Quality 2', 'Control9173', '2022-01-26 09:36:02', '2022-01-26 09:36:02'),
(13, 'QC003', 'Quality 3', 'Diablo4571', '2022-01-26 09:39:31', '2022-01-26 09:39:31'),
(14, 'QC004', 'Quality 4', 'Metzeler0493', '2022-01-26 09:39:31', '2022-01-26 09:39:31');

-- --------------------------------------------------------

--
-- Structure for view `report_movingman`
--
DROP TABLE IF EXISTS `report_movingman`;

DROP VIEW IF EXISTS `report_movingman`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `report_movingman`  AS SELECT `a`.`id` AS `id`, `a`.`MM_CODE` AS `NIK`, `b`.`MCH` AS `Code_Machine`, `b`.`MAT_IP_CODE` AS `IP_CODE`, `b`.`MAT_DESC` AS `MAT_DESC`, `b`.`Amount` AS `Amount`, `b`.`CURE_TIME` AS `CURE_TIME`, `c`.`slot` AS `Parked`, `a`.`dateTIME` AS `CheckOut` FROM ((`mman` `a` join `painting` `b`) join `parking` `c`) WHERE `a`.`Paint_id` = `b`.`id` AND `a`.`Park_id` = `c`.`id` ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
