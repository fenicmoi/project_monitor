-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 10 มี.ค. 2022 เมื่อ 10:08 AM
-- เวอร์ชันของเซิร์ฟเวอร์: 10.4.10-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectmonitor`
--

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `budget_type`
--

DROP TABLE IF EXISTS `budget_type`;
CREATE TABLE IF NOT EXISTS `budget_type` (
  `bid` int(3) NOT NULL AUTO_INCREMENT COMMENT 'รหัสแหล่งงบประมาณ',
  `bname` varchar(200) NOT NULL COMMENT 'ชื่อแหล่งงบประมาณ',
  `status` int(1) NOT NULL COMMENT 'สถานะ',
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='แหล่งงบประมาณ';

--
-- dump ตาราง `budget_type`
--

INSERT INTO `budget_type` (`bid`, `bname`, `status`) VALUES
(15, 'งบจังหวัด', 1),
(16, 'งบกลุ่มจังหวัด', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
