-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 14, 2019 at 08:46 AM
-- Server version: 5.7.19
-- PHP Version: 7.0.23

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
  `arecode` varchar(50) DEFAULT NULL,
  `arename` varchar(800) DEFAULT NULL,
  `arestatus` int(11) DEFAULT '1',
  `row_delete` int(11) DEFAULT '0',
  `operation` varchar(80) DEFAULT NULL,
  `operation_userid` varchar(50) DEFAULT NULL,
  `operation_date` varchar(50) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `sid` int(11) DEFAULT NULL,
  PRIMARY KEY (`AREAID`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
CREATE TABLE IF NOT EXISTS `branch` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `bname` varchar(50) DEFAULT NULL,
  `semster_no` int(11) DEFAULT '8',
  `bstatus` int(11) DEFAULT '1',
  `row_delete` int(11) DEFAULT '0',
  `operation_date` varchar(50) DEFAULT NULL,
  `operation_userid` varchar(50) DEFAULT NULL,
  `operation` varchar(50) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `challan_type`
--

INSERT INTO `challan_type` (`CT_ID`, `ct_no`, `ct_detail`, `ct_tv_id`, `ct_amount`, `ct_status`, `operation`, `operation_userid`, `operation_date`, `row_delete`) VALUES
(1, '3/181', 'Without Licence', NULL, '500', 1, NULL, NULL, NULL, 0),
(2, '30/1924544', 'Without Number (Without Registration)444', '', '50022', 0, 'update', 0x31, '2019-10-11 12:04:48', 0),
(3, '25/855', 'dfghjkl;', '', '711', 1, 'insert', 0x31, '2019-10-11 11:12:05', 0),
(4, '28/985', 'ghfhfgfg', '2', '454', 1, 'Delete', 0x31, '2019-10-11 11:12:06', 1),
(5, '85/787', 'hjkh', '', '', 1, 'Delete', 0x31, '2019-10-11 11:12:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `fmessage` text,
  `tid` int(11) DEFAULT NULL,
  `sid` int(11) DEFAULT NULL,
  `ftime` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `row_delete` int(11) DEFAULT '0',
  `operation` varchar(50) DEFAULT NULL,
  `operation_date` varchar(50) DEFAULT NULL,
  `operation_userid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`FID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fine`
--

INSERT INTO `fine` (`FID`, `fine_name`, `fine_vehicle_no`, `fine_vehicle_type`, `fine_gruop`, `total_fine`, `fine_userid`, `fine_username`, `fine_area`, `fine_transaction_id`, `row_delete`, `status`, `operation`, `operation_userid`, `operation_date`, `ip`) VALUES
(1, 'Kishan', '252415212', 'Truck', '[1,2]', '1000', '3', 'Kishan Kumar', '1', '85544144', 0, 1, 'insert', '3', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master`
--

DROP TABLE IF EXISTS `master`;
CREATE TABLE IF NOT EXISTS `master` (
  `MID` int(11) NOT NULL AUTO_INCREMENT,
  `days_name` varchar(50) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL COMMENT 'for college it work as branch',
  `section` varchar(50) DEFAULT NULL COMMENT 'for college it work as semester',
  `slotsub1` varchar(800) DEFAULT NULL,
  `slotsub2` varchar(800) DEFAULT NULL,
  `slotsub3` varchar(800) DEFAULT NULL,
  `slotsub4` varchar(800) DEFAULT NULL,
  `slotsub5` varchar(800) DEFAULT NULL,
  `slotsub6` varchar(800) DEFAULT NULL,
  `slotsub7` varchar(800) DEFAULT NULL,
  `slotteacher1` varchar(800) DEFAULT NULL,
  `slotteacher2` varchar(800) DEFAULT NULL,
  `slotteacher3` varchar(800) DEFAULT NULL,
  `slotteacher4` varchar(800) DEFAULT NULL,
  `slotteacher5` varchar(800) DEFAULT NULL,
  `slotteacher6` varchar(800) DEFAULT NULL,
  `slotteacher7` varchar(800) DEFAULT NULL,
  `slotroom1` varchar(800) DEFAULT NULL,
  `slotroom2` varchar(800) DEFAULT NULL,
  `slotroom3` varchar(800) DEFAULT NULL,
  `slotroom4` varchar(800) DEFAULT NULL,
  `slotroom5` varchar(800) DEFAULT NULL,
  `slotroom6` varchar(800) DEFAULT NULL,
  `slotroom7` varchar(800) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `operation_userid` varchar(800) DEFAULT NULL,
  `operation` varchar(800) DEFAULT NULL,
  `ip` varchar(800) DEFAULT NULL,
  `operation_date` varchar(800) DEFAULT NULL,
  `row_delete` int(11) DEFAULT '0',
  PRIMARY KEY (`MID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `RNO` int(11) NOT NULL AUTO_INCREMENT,
  `rname` varchar(800) DEFAULT NULL,
  `rfloor` varchar(50) DEFAULT NULL,
  `rtype` varchar(50) DEFAULT NULL,
  `row_delete` int(11) DEFAULT '0',
  `operation` varchar(800) DEFAULT NULL,
  `operation_userid` varchar(800) DEFAULT NULL,
  `operation_date` varchar(800) DEFAULT NULL,
  `ip` varchar(800) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '1 for Assign 0 for not assign room',
  PRIMARY KEY (`RNO`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

DROP TABLE IF EXISTS `semester`;
CREATE TABLE IF NOT EXISTS `semester` (
  `SNO` int(11) NOT NULL AUTO_INCREMENT,
  `sname` varchar(50) DEFAULT NULL,
  `sstatus` int(11) DEFAULT '1',
  `row_delete` int(11) DEFAULT '0',
  PRIMARY KEY (`SNO`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `SUBID` int(11) NOT NULL AUTO_INCREMENT,
  `subcode` varchar(50) DEFAULT NULL,
  `subname` varchar(800) DEFAULT NULL,
  `substatus` int(11) DEFAULT '1',
  `row_delete` int(11) DEFAULT '0',
  `operation` varchar(80) DEFAULT NULL,
  `operation_userid` varchar(50) DEFAULT NULL,
  `operation_date` varchar(50) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `bid` int(11) DEFAULT NULL,
  `semid` int(11) DEFAULT NULL,
  `roomid` int(11) DEFAULT NULL,
  PRIMARY KEY (`SUBID`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

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
  `user_role` int(4) NOT NULL DEFAULT '0' COMMENT '0-Main admin, 1-Principle,2-Teacher,3-Student',
  `user_name` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_mobile` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_email` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_pass` text COLLATE utf8mb4_unicode_ci,
  `user_img` text COLLATE utf8mb4_unicode_ci,
  `user_address` text COLLATE utf8mb4_unicode_ci,
  `user_city` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_state` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_branch` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'this is only for student',
  `user_section` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'this is only for student',
  `user_status` tinyint(1) DEFAULT '1' COMMENT '1-Active',
  `area` int(11) DEFAULT NULL,
  `operation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operation_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `row_delete` tinyint(1) DEFAULT '0',
  `ip` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operation_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operation_userid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`USER_ID`),
  KEY `role` (`user_role`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`USER_ID`, `user_role`, `user_name`, `user_mobile`, `user_email`, `user_pass`, `user_img`, `user_address`, `user_city`, `user_state`, `user_branch`, `user_section`, `user_status`, `area`, `operation`, `operation_date`, `row_delete`, `ip`, `operation_id`, `operation_userid`) VALUES
(1, 0, 'Master', '9876543210', 'admin@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', 'assets/profile/user/User1.jpg', 'Bhilaif', 'Durg', 'C.G.', NULL, NULL, 1, NULL, 'update', '2019-05-14 07:02:24', 0, '::1', NULL, '1'),
(3, 2, 'Kishan Kumar', '98736524', 'Kishankumar199711@gmail.com', 'MjAyY2I5NjJhYzU5MDc1Yjk2NGIwNzE1MmQyMzRiNzA=', 'assets/profile/user/Teacher3.jpg', 'Bhilai', 'Dur', 'C.', NULL, NULL, 1, NULL, 'update', '2019-05-14 07:00:10', 0, NULL, NULL, '1'),
(4, 2, 'Vikash Dewanga', '', 'vikash@gmail.com', 'MzkzNjM1YTczNzZhZWY1OGNlYWZiZTM2OTE0MTAwNmI=', 'assets/profile/user/Teacher1.jpg', 'Bhilai', '', '', NULL, NULL, 1, NULL, 'update', '2019-05-08 06:44:12', 0, NULL, NULL, '4'),
(5, 2, 'Kamran Ansari', '', 'kamranansari@gmail.com', 'NjQ3OGE2Y2EyZmM4YmZmMWZlZWIzYTM0ZWMxNjE3ODY=', 'assets/profile/user/Teacher2.jpg', '', '', '', NULL, NULL, 1, NULL, 'Delete', '2019-05-14 04:31:05', 1, NULL, NULL, '1'),
(6, 2, 'Zahir', '', 'zahir@gmail.com', 'YjhkOGNhM2RjMzQxNzcxZTU1YWU4NzFhOTU3MWU5ZmI=', 'assets/profile/user/User.jpg', '', '', '', NULL, NULL, 1, NULL, 'update', '2019-05-11 07:49:25', 0, NULL, NULL, '6'),
(7, 2, 'Ravi', '9876543210', 'ravi@gmail.com', 'NjNkZDNlMTU0Y2E2ZDk0OGZjMzgwZmE1NzYzNDNiYTY=', NULL, '', '', '', NULL, NULL, 1, NULL, 'Delete', '2019-10-11 04:55:30', 1, NULL, NULL, '1'),
(8, 2, 'Manish', '6543210789', 'manish@gmial.com', 'MjAyY2I5NjJhYzU5MDc1Yjk2NGIwNzE1MmQyMzRiNzA=', 'assets/profile/user/Teacher4.jpg', 'fdgsd', 'Raipur', 'C.G.', NULL, NULL, 1, NULL, 'update', '2019-10-11 04:56:00', 0, NULL, NULL, '1'),
(9, 2, 'Amar', '', 'amar@gmail.com', 'ODFkYzliZGI1MmQwNGRjMjAwMzZkYmQ4MzEzZWQwNTU=', NULL, '', '', '', NULL, NULL, 1, NULL, 'update', '2019-10-11 04:55:30', 0, NULL, NULL, '1'),
(10, 2, 'Kajal', '9878527410', 'kajal@gmail.com', 'OThmN2UxZDZlNTNiMzE5NTE5YmQ4MDkzZjE1M2QxM2M=', 'assets/profile/user/Teacher.png', '', '', '', NULL, NULL, 1, NULL, 'Delete', '2019-10-11 04:55:41', 1, NULL, NULL, '1'),
(11, 2, 'new teacher', '9876543210', 'Kisdhan@gmail.com', 'MjAyY2I5NjJhYzU5MDc1Yjk2NGIwNzE1MmQyMzRiNzA=', NULL, 'fghjkl', '45645', 'C.G.', NULL, NULL, 1, NULL, 'update', '2019-05-14 07:01:11', 0, NULL, NULL, '1'),
(12, 3, 'student1', '9876543210', 'student@gmail.com', 'ZDQxZDhjZDk4ZjAwYjIwNGU5ODAwOTk4ZWNmODQyN2U=', NULL, 'First Address', 'Bhilai', 'C.G.', '2', '4', 1, NULL, 'insert', '2019-05-14 13:04:16', 0, NULL, NULL, '1'),
(13, 3, 'stude', '', 'studen2t@gmail.com', 'MjAyY2I5NjJhYzU5MDc1Yjk2NGIwNzE1MmQyMzRiNzA=', 'assets/profile/user/Student1.jpg', 'Firs', 'Bhilaisddf', 'C.G.', '2', '4', 1, 11, 'Area Change', '2019-05-15 06:42:27', 0, NULL, NULL, '1'),
(15, 3, 'student3', '9876543210', 'student3@gmail.com', 'NTU1M2NmYWY3NTFhNGIxNDk2MGI3NTgxYTIwYmMxNDI=', 'assets/profile/user/Student3.jpg', 'sd', 'sa', 's', '1', '4', 1, 1, 'Area Change', '2019-05-15 05:10:26', 0, NULL, NULL, '1'),
(16, 3, 'k', '9898989898', 'kishan@gmail.com', 'OGE4NzAzZTQ0NzQ0M2MyM2M1ODcyODZiNWRkMjc0NDQ=', NULL, 'bn', 'Durg', 'C.G', '1', '2', 1, NULL, 'Delete', '2019-10-11 06:22:37', 1, NULL, NULL, '1'),
(17, 2, 'Vikash Dewangandfgbhn', '7899637410', 'vikashdewangufn@gmail.com', 'MjAyY2I5NjJhYzU5MDc1Yjk2NGIwNzE1MmQyMzRiNzA=', 'assets/profile/user/Thana_Incharge1.jpg', 'Testsdfghj', 'Bhilaisdf', 'C.G.asdf', NULL, NULL, 1, NULL, 'update', '2019-10-11 05:05:34', 0, NULL, NULL, '1'),
(18, 3, 'Swcondfsdhfq', '987654', 'stusadudent@gmail.com', 'MDI4YWU1MmI4ZDAyNGEzMzA4NTA5YmQ5Yzg4ZDZhZjQ=', NULL, 'sdfghjkl', 'sahf', 'kjf', NULL, NULL, 1, NULL, 'Delete', '2019-10-11 06:22:51', 1, NULL, NULL, '1'),
(19, 3, 'asdffghjklff', '9876543212', 'adff@gmail.com', 'MjAyY2I5NjJhYzU5MDc1Yjk2NGIwNzE1MmQyMzRiNzA=', 'assets/profile/user/Staff1.jpg', 'gfhjkl;sadfghjkf', 'Bhilaidfghjk', 'C.G.dfghjk', NULL, NULL, 1, NULL, 'update', '2019-10-11 06:28:25', 0, NULL, NULL, '1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
