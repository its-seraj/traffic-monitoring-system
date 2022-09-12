-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 27, 2022 at 03:59 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `traffic`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

DROP TABLE IF EXISTS `area`;
CREATE TABLE IF NOT EXISTS `area` (
  `AREAID` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) DEFAULT NULL,
  `arecode` varchar(50) DEFAULT NULL,
  `arename` varchar(800) DEFAULT NULL,
  `arestatus` int(11) DEFAULT '1',
  `row_delete` int(11) DEFAULT '0',
  `operation` varchar(80) DEFAULT NULL,
  `operation_userid` varchar(50) DEFAULT NULL,
  `operation_date` varchar(50) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`AREAID`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`AREAID`, `sid`, `arecode`, `arename`, `arestatus`, `row_delete`, `operation`, `operation_userid`, `operation_date`, `ip`) VALUES
(1, 1, '201', 'Risali Sector 1', 1, 0, 'update', '1', '2022-04-26 22:07:23', NULL),
(2, 1, '202', 'Risali Sector 2', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(3, 1, '203', 'Risali Sector 3', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(4, 1, '204', 'Risali Sector 4', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(5, 1, '205', 'Risali Sector 5', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(6, 2, '301', 'Supela Sector 1', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(7, 2, '302', 'Supela Sector 2', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(8, 2, '303', 'Supela Sector 3', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(9, 2, '304', 'Supela Sector 4', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(10, 2, '305', 'Supela Sector 5', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(11, 3, '401', 'Bhilai Sector 1', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(12, 3, '402', 'Bhilai Sector 2', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(13, 3, '403', 'Bhilai Sector 3', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(14, 3, '404', 'Bhilai Sector 4', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(15, 3, '405', 'Bhilai Sector 5', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(16, 4, '501', 'Durg Sector 1', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(17, 4, '502', 'Durg Sector 2', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(18, 4, '503', 'Durg Sector 3', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(19, 4, '504', 'Durg Sector 4', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(20, 4, '505', 'Durg Sector 5', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(21, 5, '101', 'Danora Sector 1', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(22, 5, '102', 'Durg Sector 2', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(23, 5, '103', 'Durg Sector 3', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(24, 5, '104', 'Durg Sector 4', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(25, 5, '105', 'Durg Sector 5', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL),
(26, 3, '605', 'Bhilai Camp ', 1, 0, 'insert', '1', '2022-04-26 22:07:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `A_ID` int(11) NOT NULL AUTO_INCREMENT,
  `a_type` tinyint(11) DEFAULT NULL COMMENT '0-TA, 1-Staff',
  `ta_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `a_date` date DEFAULT NULL COMMENT 'attendance date',
  `area_id` int(11) DEFAULT NULL,
  `area_name` int(11) DEFAULT NULL,
  `a_status` tinyint(11) DEFAULT NULL COMMENT '0-NA, 1-Present, 2-Absent, 3-Leave',
  `row_delete` tinyint(1) NOT NULL DEFAULT '0',
  `operation` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operation_date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operation_userid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`A_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`A_ID`, `a_type`, `ta_id`, `staff_id`, `a_date`, `area_id`, `area_name`, `a_status`, `row_delete`, `operation`, `operation_date`, `operation_userid`, `ip`) VALUES
(19, 1, NULL, 5, '2019-10-31', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(20, 1, NULL, 6, '2019-10-31', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(21, 1, NULL, 7, '2019-10-31', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(22, 1, NULL, 8, '2019-10-31', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(23, 1, NULL, 5, '2019-11-01', 1, 201, 2, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(24, 1, NULL, 6, '2019-11-01', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(25, 1, NULL, 7, '2019-11-01', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(26, 1, NULL, 8, '2019-11-01', 1, 201, 3, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(27, 1, NULL, 5, '2019-11-02', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(28, 1, NULL, 6, '2019-11-02', 1, 201, 2, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(29, 1, NULL, 7, '2019-11-02', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(30, 1, NULL, 8, '2019-11-02', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(35, 1, NULL, 5, '2019-11-04', 1, 201, 3, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(36, 1, NULL, 6, '2019-11-04', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(37, 1, NULL, 7, '2019-11-04', 1, 201, 2, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(38, 1, NULL, 8, '2019-11-04', 1, 201, 3, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(39, 1, NULL, 5, '2019-11-03', 1, 201, 0, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(40, 1, NULL, 6, '2019-11-03', 1, 201, 0, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(41, 1, NULL, 7, '2019-11-03', 1, 201, 0, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(42, 1, NULL, 8, '2019-11-03', 1, 201, 0, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(43, 1, NULL, 5, '2019-11-05', 1, 201, 2, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(44, 1, NULL, 6, '2019-11-05', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(45, 1, NULL, 7, '2019-11-05', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(46, 1, NULL, 8, '2019-11-05', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(47, 1, NULL, 5, '2019-11-06', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(48, 1, NULL, 6, '2019-11-06', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(49, 1, NULL, 7, '2019-11-06', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(50, 1, NULL, 8, '2019-11-06', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(51, 1, NULL, 5, '2019-11-07', 1, 201, 2, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(52, 1, NULL, 6, '2019-11-07', 1, 201, 3, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(53, 1, NULL, 7, '2019-11-07', 1, 201, 3, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(54, 1, NULL, 8, '2019-11-07', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(55, 1, NULL, 5, '2019-11-08', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(56, 1, NULL, 6, '2019-11-08', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(57, 1, NULL, 7, '2019-11-08', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(58, 1, NULL, 8, '2019-11-08', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(59, 1, NULL, 5, '2019-11-09', 1, 201, 3, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(60, 1, NULL, 6, '2019-11-09', 1, 201, 2, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(61, 1, NULL, 7, '2019-11-09', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL),
(62, 1, NULL, 8, '2019-11-09', 1, 201, 1, 0, '2022-04-26 22:06:40', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `challan_type`
--

DROP TABLE IF EXISTS `challan_type`;
CREATE TABLE IF NOT EXISTS `challan_type` (
  `CT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ct_no` varchar(1000) DEFAULT NULL,
  `ct_detail` varchar(5000) DEFAULT NULL,
  `ct_tv_id` varchar(100) DEFAULT NULL,
  `ct_amount` varchar(100) DEFAULT NULL,
  `ct_status` int(11) NOT NULL DEFAULT '1',
  `operation` varchar(50) DEFAULT NULL,
  `operation_userid` varbinary(100) DEFAULT NULL,
  `operation_date` varchar(100) DEFAULT NULL,
  `row_delete` int(11) DEFAULT '0',
  PRIMARY KEY (`CT_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `challan_type`
--

INSERT INTO `challan_type` (`CT_ID`, `ct_no`, `ct_detail`, `ct_tv_id`, `ct_amount`, `ct_status`, `operation`, `operation_userid`, `operation_date`, `row_delete`) VALUES
(1, '3/181', 'Without Licences ', '1', '500', 1, 'update', 0x31, '2022-04-26 22:04:44', 0),
(2, '122/177', 'No Parking', '', '200', 1, 'Delete', 0x31, '2022-04-26 22:04:44', 1),
(3, '125/177', 'Seat Belt', '', '200', 1, 'insert', 0x31, '2022-04-26 22:04:44', 0),
(4, '129', 'Without Helmet', '', '500', 1, 'insert', 0x31, '2022-04-26 22:04:44', 0),
(5, '100', 'Black Film', '', '2000', 1, 'insert', 0x31, '2022-04-26 22:04:44', 0),
(6, '66/192', 'Without Parmit', '', '20000', 1, 'update', 0x31, '2022-04-26 22:04:44', 0),
(7, '85/965', 'Without Paper', '', '5000', 1, 'insert', 0x31, '2022-04-26 22:04:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fine`
--

DROP TABLE IF EXISTS `fine`;
CREATE TABLE IF NOT EXISTS `fine` (
  `FID` int(11) NOT NULL AUTO_INCREMENT,
  `fine_name` varchar(8000) DEFAULT NULL,
  `fine_vehicle_no` varchar(5000) DEFAULT NULL,
  `fine_vehicle_type` varchar(1000) DEFAULT NULL,
  `fine_gruop` varchar(1000) DEFAULT NULL,
  `total_fine` varchar(200) DEFAULT NULL,
  `fine_userid` varchar(200) DEFAULT NULL,
  `fine_username` varchar(500) DEFAULT NULL,
  `fine_area` varchar(200) DEFAULT NULL,
  `fine_transaction_id` varchar(100) DEFAULT NULL,
  `row_delete` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `operation` varchar(100) DEFAULT 'insert',
  `operation_userid` varchar(100) DEFAULT NULL,
  `operation_date` varchar(100) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `fine_Date` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`FID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fine`
--

INSERT INTO `fine` (`FID`, `fine_name`, `fine_vehicle_no`, `fine_vehicle_type`, `fine_gruop`, `total_fine`, `fine_userid`, `fine_username`, `fine_area`, `fine_transaction_id`, `row_delete`, `status`, `operation`, `operation_userid`, `operation_date`, `ip`, `fine_Date`) VALUES
(1, 'Rahul Soni', 'CG-AS1415', 'Car', '[\"3\",\"5\"]', '[\"200\",\"2000\"]', '8', 'Sagar', '1', '250145', 0, 1, 'insert', '8', '2022-04-26 22:03:27', NULL, '2022-04-26 22:03:27'),
(2, 'Rahul Soni', 'CG-AS1415', 'Car', '[\"3\",\"5\"]', '[\"200\",\"2000\"]', '8', 'Sagar', '1', '250145', 0, 1, 'insert', '8', '2022-04-26 22:03:27', NULL, '2022-04-26 22:03:27'),
(3, 'Rahul Soni2', '154112', 'Bike', '[\"3\",\"4\"]', '[\"200\",\"500\"]', '8', 'Sagar', '1', '7894560', 0, 1, 'insert', '8', '2022-04-26 22:03:27', NULL, '2022-04-26 22:03:27');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `NID` int(11) NOT NULL AUTO_INCREMENT,
  `nTitle` varchar(5000) DEFAULT NULL,
  `nCode` varchar(100) DEFAULT NULL,
  `ndescription` text,
  `file` varchar(5000) DEFAULT NULL,
  `nstatus` int(11) DEFAULT '1',
  `row_delete` int(11) DEFAULT '0',
  `operation` varchar(20) DEFAULT 'insert',
  `operation_userid` varchar(20) DEFAULT NULL,
  `operation_date` varchar(20) NOT NULL,
  PRIMARY KEY (`NID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`NID`, `nTitle`, `nCode`, `ndescription`, `file`, `nstatus`, `row_delete`, `operation`, `operation_userid`, `operation_date`) VALUES
(4, 'This is for new jobs', '1245', 'New rule of the traffic system for the more detail please download the below file.', 'assets/notification/notification2.jpg', 1, 1, 'Delete', '1', '2019-10-28 11:58:41'),
(5, 'Rule of Center', '2546', 'All Rule...', NULL, 1, 1, 'Delete', '1', '2019-10-30 16:16:57'),
(6, 'New jobs in Traffic Police', '12345', 'CG Govt has taken the action against the new vacancy in the traffic police for more information please read below notification. ', 'assets/notification/notification3.jpg', 1, 0, 'insert', '1', '2019-10-30 23:34:43'),
(7, 'New Rule ', '12346', 'There has new rule which is used in the apply on the 22-10-2019 read more ', 'assets/notification/notification4.jpg', 1, 0, 'insert', '1', '2019-10-30 23:36:07');

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

DROP TABLE IF EXISTS `station`;
CREATE TABLE IF NOT EXISTS `station` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `sname` varchar(50) DEFAULT NULL,
  `sstatus` int(11) DEFAULT '1',
  `row_delete` int(11) DEFAULT '0',
  `operation_date` varchar(50) DEFAULT NULL,
  `operation_userid` varchar(50) DEFAULT NULL,
  `operation` varchar(50) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`sid`, `sname`, `sstatus`, `row_delete`, `operation_date`, `operation_userid`, `operation`, `ip`) VALUES
(1, 'Anand Nagar Police', 1, 0, '2022-04-26 21:59:36', '1', 'insert', NULL),
(2, 'Piplani Police', 1, 0, '2022-04-26 21:59:36', '1', 'insert', NULL),
(3, 'DC Police', 1, 0, '2022-04-26 21:59:36', '1', 'insert', NULL),
(4, 'Ghautam Police', 1, 0, '2022-04-26 21:59:36', '1', 'insert', NULL),
(5, 'Washington Police', 1, 0, '2022-04-26 21:59:36', '1', 'insert', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `type_vehicle`
--

DROP TABLE IF EXISTS `type_vehicle`;
CREATE TABLE IF NOT EXISTS `type_vehicle` (
  `TV_ID` int(11) NOT NULL AUTO_INCREMENT,
  `tv_sort_name` varchar(1000) DEFAULT NULL,
  `tv_name` varchar(1000) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `row_delete` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(50) DEFAULT NULL,
  `operation_user` varchar(50) DEFAULT NULL,
  `operation` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`TV_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_vehicle`
--

INSERT INTO `type_vehicle` (`TV_ID`, `tv_sort_name`, `tv_name`, `status`, `row_delete`, `ip`, `operation_user`, `operation`) VALUES
(1, 'MC', 'Moter Cycle', 1, 0, NULL, NULL, NULL),
(2, 'LMV', 'Light Motor Vehicle', 1, 0, NULL, NULL, NULL),
(3, 'MMV', 'mechanic of Motor Vehicle', 1, 0, NULL, NULL, NULL),
(4, 'HMV', 'heavy motor vehicle', 1, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `USER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_role` int(4) NOT NULL DEFAULT '0' COMMENT '0-Main admin, 1-TI,2-Staff',
  `user_name` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_mobile` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_email` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_pass` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_img` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_city` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_state` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_branch` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'this is only for student',
  `user_section` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'this is only for student',
  `user_status` tinyint(1) DEFAULT '1' COMMENT '1-Active',
  `area` int(11) DEFAULT NULL,
  `operation` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operation_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `row_delete` tinyint(1) DEFAULT '0',
  `ip` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operation_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operation_userid` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`USER_ID`),
  KEY `role` (`user_role`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USER_ID`, `user_role`, `user_name`, `user_mobile`, `user_email`, `user_pass`, `user_img`, `user_address`, `user_city`, `user_state`, `user_branch`, `user_section`, `user_status`, `area`, `operation`, `operation_date`, `row_delete`, `ip`, `operation_id`, `operation_userid`) VALUES
(1, 0, 'Master', '9876543210', 'admin@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', 'assets/profile/user/User1.jpg', 'Bhilaif', 'Durg', 'C.G.', NULL, NULL, 1, 1, 'update', '2022-04-26 21:53:02', 0, '::1', NULL, '1'),
(2, 2, 'Ajay Dewangan', '9876543210', 'ajay@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', 'assets/profile/user/Thana_Incharge3.jpg', 'Bhilai', 'Durg', 'C.G.', NULL, NULL, 1, 1, 'Station Change', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(3, 2, 'wadekar', '9876584123', 'wadekar@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, 'Durg', 'Durg', 'C.G.', NULL, NULL, 1, 3, 'Station Change', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(4, 2, 'Chulbul Pandey', '7418529635', 'chulbul@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, 'Danora', 'Durg', 'C.G.', NULL, NULL, 1, 2, 'Station Change', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(5, 3, 'Singham', '741852412578', 'singham@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, 'Supela', 'Durg', 'C.G.', NULL, NULL, 1, 1, 'update', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(6, 3, 'Amar Babu', '7894568521', 'amar@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, 'Bhilai', 'Durg', 'C.G.', NULL, NULL, 1, 1, 'Area Change', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(7, 3, 'Kajal Sahani', '7894568547', 'kajal@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, 'Bhilai', 'Durg', 'C.G.', NULL, NULL, 1, 1, 'Area Change', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(8, 3, 'Sagar', '9876543210', 'sagar@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, 'Bhilai', 'Durg', 'C.G.', NULL, NULL, 1, 1, 'update', '2022-04-26 21:53:02', 0, NULL, NULL, '8'),
(9, 3, 'Suresh', '9876543210', 'suresh@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, 'BHilai', 'Durg', 'C.G.', NULL, NULL, 1, 2, 'Area Change', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(10, 3, 'Jignesh', '9876543210', 'jignesh@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, 'Bhilai', 'Durg', 'C.G.', NULL, NULL, 1, 2, 'Area Change', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(11, 3, 'Aasha', '9876543210', 'aasha@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, 'Bhilai', 'Durg', 'C.G.', NULL, NULL, 1, 2, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(12, 3, 'Rashmi', '', 'rashmi@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, 'Bhilai', 'Durg', 'c', NULL, NULL, 1, 2, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(13, 3, 'Mamta', '9876543210', 'mamta@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, 'Bhilai', '', '', NULL, NULL, 1, 3, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(14, 3, 'Rohini', '9876543210', 'rohini@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, 'Bhilai', 'Durg', 'C.G.', NULL, NULL, 1, 3, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(15, 3, 'Vishal', '', 'vishal@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, 'Bhilai', '', '', NULL, NULL, 1, 3, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(16, 3, 'Pranjal', '', 'pranjal@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, 'Bhilai', 'Durg', '', NULL, NULL, 1, 3, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(17, 3, 'Adil', '9876543210', 'adil@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, 'Bhilai', 'Durg', 'C.G.', NULL, NULL, 1, 4, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(18, 3, 'sanjay', '', 'sanjay@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, '', 'Durg', '', NULL, NULL, 1, 4, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(19, 3, 'Rahul', '', 'rahul@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, 'Bhilai', 'Durg', '', NULL, NULL, 1, 4, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(20, 3, 'Aakash', '', 'aakash@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, '', '', '', NULL, NULL, 1, 4, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(21, 3, 'Rohit', '', 'rohit@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, '\r\n', '', '', NULL, NULL, 1, 5, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(22, 3, 'Raj', '', 'raj@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, '', '', '', NULL, NULL, 1, 5, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(23, 3, 'Ganesh', '', 'ganesh@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, '', '', '', NULL, NULL, 1, 5, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(24, 3, 'Gurendra', '', 'gurendra@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, '', '', '', NULL, NULL, 1, 5, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(25, 3, 'Rajkumari', '', 'Rajkumari@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, '', '', '', NULL, NULL, 1, 6, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(26, 3, 'Shifa', '', 'shifa@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, '', '', '', NULL, NULL, 1, 6, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(27, 3, 'Rajkumar', '', 'rajkumar@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, '', '', '', NULL, NULL, 1, 6, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(28, 3, 'Aada', '', 'aada@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, '', '', '', NULL, NULL, 1, 6, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(29, 3, 'Aliya', '', 'aliya@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, '', '', '', NULL, NULL, 1, 7, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(30, 3, 'Varun', '', 'varun@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, '', '', '', NULL, NULL, 1, 7, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(31, 3, 'Arun', '', 'arun@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, '', '', '', NULL, NULL, 1, 7, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1'),
(32, 3, 'Ved', '', 'ved@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, '', '', '', NULL, NULL, 1, 7, 'insert', '2022-04-26 21:53:02', 0, NULL, NULL, '1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
