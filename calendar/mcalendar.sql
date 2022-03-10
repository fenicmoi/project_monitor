-- phpMyAdmin SQL Dump
-- version 2.9.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Oct 12, 2013 at 11:45 PM
-- Server version: 5.0.27
-- PHP Version: 5.2.1
-- 
-- Database: `mcalendar`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `calendar`
-- 

CREATE TABLE `calendar` (
  `calendar_id` int(11) NOT NULL auto_increment,
  `manager_id` tinyint(3) NOT NULL,
  `calendar_stdate` date NOT NULL,
  `calendar_sttime` time NOT NULL,
  `calendar_endate` date NOT NULL,
  `calendar_entime` time NOT NULL,
  `calendar_title` varchar(200) collate utf8_unicode_ci NOT NULL,
  `calendar_own` varchar(150) collate utf8_unicode_ci NOT NULL,
  `calendar_detail` text collate utf8_unicode_ci NOT NULL,
  `calendar_location` varchar(200) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`calendar_id`),
  KEY `bran_id` (`manager_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

-- 
-- Dumping data for table `calendar`
-- 

INSERT INTO `calendar` VALUES (3, 2, '2013-03-25', '09:00:00', '2013-03-27', '16:00:00', 'สัมภาษ์', 'กองแผน', 'สัมภาษ์', 'sdfs');
INSERT INTO `calendar` VALUES (9, 5, '2013-03-24', '13:00:00', '2013-04-05', '16:30:00', 'จัดทำแผน IT', '5900', 'จัดทำแผน IT 56', 'ชั้น 3');
INSERT INTO `calendar` VALUES (10, 5, '2013-04-24', '09:00:00', '2013-04-27', '12:00:00', 'dd', 'rrrrrr', 'ffff', 'hhhh');
INSERT INTO `calendar` VALUES (11, 2, '2013-04-27', '08:30:00', '2013-05-05', '12:00:00', 'ปืนวางตัว"ชไนเดอร์แลง"สืบทอดตำแหน่งดิยาบี้ ', 'aaaadasd asdasd', '"ปืนใหญ่"อาร์เซน่อลเล็งคว้าตัวมอร์แกน ชไนเดอร์แลงห้องเครื่องจากค่าย"นักบุญ"เซาแธมป์ตันเข้ามาเป็นตัวแทนของอาบู ดิยาบี้ที่มีอาการบาดเจ็บตามรุมเร้าอยู่ตลอด ', 'อิมิเรต สเตเดียม');
INSERT INTO `calendar` VALUES (12, 2, '2013-04-25', '08:00:00', '2013-04-25', '10:00:00', 'ป๋าลูบปาก!เอฟเอเลือก''''เว็บบ์''''ตัดสินผีVSสิงห์ ', '"ปีศาจแดง"แมนเชสเตอร์ ยูไนเต็ด', 'เรียกว่าฤกษ์ดีมีชัยไปกว่าครึ่งสำหรับ แมนเชสเตอร์ ยูไนเต็ด ที่เตรียมเปิดบ้านรอรับการมาเยือนของ เชลซี เมื่อ ฮาวเวิร์ด เว็บบ์ ผู้ตัดสินจอมเฮี้ยบได้รับการแต่งตั้งลงทำหน้าที่ชี้ขาดในวันอาทิตย์นี้ ', 'โอลแทรฟอร์ด แมนเชสเตอร์ ยูไนเต็ด');
INSERT INTO `calendar` VALUES (13, 2, '2013-05-08', '08:00:00', '2013-05-08', '10:00:00', 'ปิดเทอม!หงส์เตรียมส่ง"หัวขิง"ผ่าตัดไหล่ ', 'sssss', '"หงส์แดง"ลิเวอร์พูลเตรียมดำเนินการส่งตัวสตีเฟ่น เจอร์ราร์ดห้องเครื่องกัปตันทีมเข้ารับการผ่าตัดรักษาอาการบาดเจ็บไหล่และจะทำให้เขาหมดสิทธิ์ช่วยทีมในเกมนัดที่เหลือของซีซั่นนี้', 'เมอร์ซี่ไซด์ ');
INSERT INTO `calendar` VALUES (14, 5, '2013-05-02', '09:00:00', '2013-05-04', '12:00:00', 'RVP รับเหมือนฝันได้แชมป์พรีเมียร์-บอกแทบรอชูถ้วยไม่ไหว', '088-777-777', 'โรบิน ฟาน เพอร์ซี่ดาวยิงดัตช์แมนของ"ปีศาจแดง"แมนเชสเตอร์ ยูไนเต็ดยอมรับว่าเขารู้สึกเหมือนกับฝันไปเลยทีเดียวที่ได้แชมป์พรีเมียร์ ลีกและแทบจะรอไม่ไหวแล้วกับการจะได้ชูถ้วยแชมป์ ', 'โอลด์ แทร็ฟฟอร์ด');
INSERT INTO `calendar` VALUES (15, 2, '2013-05-28', '08:00:00', '2013-07-03', '16:00:00', 'dddd', 'qwwqqwe', 'ffffffff afdasda s', 'wweqwe ');

-- --------------------------------------------------------

-- 
-- Table structure for table `counter`
-- 

CREATE TABLE `counter` (
  `sign_date` datetime NOT NULL,
  `sign_ip` varchar(20) character set tis620 NOT NULL default '',
  KEY `sign_date` (`sign_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Dumping data for table `counter`
-- 

INSERT INTO `counter` VALUES ('2013-01-22 14:02:19', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:28:22', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:29:45', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:29:55', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:29:57', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:30:14', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:30:15', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:30:28', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:30:28', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:30:31', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:32:01', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:32:12', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:32:16', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:32:29', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:32:59', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:33:24', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:41:03', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:43:50', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:44:07', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:44:25', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:44:33', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:44:54', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:45:03', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:45:37', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:46:10', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:46:39', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:46:50', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:47:36', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:47:56', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:48:06', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:48:21', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:49:07', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:49:15', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:49:49', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:50:08', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:53:22', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:53:33', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:53:39', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:53:45', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 14:53:59', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 15:03:33', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 15:04:30', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 15:05:05', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 15:06:37', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 15:06:47', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 15:07:27', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 15:07:49', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 15:07:58', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 15:08:36', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 15:08:46', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 15:09:07', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 15:09:33', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 15:14:36', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 15:25:21', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 15:57:25', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 15:57:43', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-22 15:59:06', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-01-25 13:16:06', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-02-11 15:10:03', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-02-14 10:43:58', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-02-19 10:38:04', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 09:57:08', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 09:57:12', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 09:58:30', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 09:59:01', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 09:59:16', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:00:16', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:01:15', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:01:24', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:01:49', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:02:22', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:02:36', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:04:21', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:04:34', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:04:50', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:06:41', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:07:07', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:07:39', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:07:58', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:08:06', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:08:31', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:08:41', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:08:47', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:08:53', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:09:05', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:09:27', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:09:43', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:09:50', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:09:57', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:10:16', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:10:21', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:10:36', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:10:55', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:11:10', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:11:19', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:11:24', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:11:39', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:12:00', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:12:06', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:12:17', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:12:32', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:13:07', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:13:47', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:15:27', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:17:49', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:21:13', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:21:14', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:21:42', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:22:36', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:22:48', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:23:22', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:23:30', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:23:39', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:24:19', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:37:02', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:38:49', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:38:49', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:38:50', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:39:26', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:39:53', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:40:08', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:42:02', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:42:39', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:43:07', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:43:37', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:45:00', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:45:16', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:45:29', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:48:05', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 10:50:36', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 11:11:04', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 12:00:21', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 12:02:55', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-19 12:16:19', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-20 01:01:13', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-20 20:39:09', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-20 23:17:11', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-25 19:21:15', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-25 22:59:32', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-03-27 02:18:11', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-04-02 18:35:32', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-04-09 15:15:28', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-04-18 08:31:57', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-04-23 13:22:28', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-04-23 13:30:15', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-04-29 23:22:48', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-04-30 15:55:30', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-05-07 00:34:43', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-05-07 00:43:03', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-05-07 00:56:30', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-05-07 15:23:59', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-05-07 15:54:00', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-05-18 00:39:55', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-06-03 09:59:37', '127.0.0.1');
INSERT INTO `counter` VALUES ('2013-06-10 14:36:45', '127.0.0.1');

-- --------------------------------------------------------

-- 
-- Table structure for table `counter_hit`
-- 

CREATE TABLE `counter_hit` (
  `count_hit` bigint(20) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- 
-- Dumping data for table `counter_hit`
-- 

INSERT INTO `counter_hit` VALUES (2750);

-- --------------------------------------------------------

-- 
-- Table structure for table `manager`
-- 

CREATE TABLE `manager` (
  `manager_id` int(11) NOT NULL auto_increment,
  `secretary_id` int(3) NOT NULL,
  `manager_pos` tinyint(3) NOT NULL,
  `manager_pic` varchar(15) collate utf8_unicode_ci NOT NULL,
  `manager_pname` varchar(50) collate utf8_unicode_ci NOT NULL,
  `manager_name` varchar(50) collate utf8_unicode_ci NOT NULL,
  `manager_sname` varchar(50) collate utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY  (`manager_id`),
  KEY `cars_gear` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `manager`
-- 

INSERT INTO `manager` VALUES (2, 1, 102, '1363793201.jpg', 'นาย', 'ทวีชัย', 'หทัยรัตนกุล', 0);
INSERT INTO `manager` VALUES (5, 1, 101, '1363794008.jpg', 'นาย', 'โจเซ่', 'มูรินโญ่', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `member`
-- 

CREATE TABLE `member` (
  `member_id` int(5) NOT NULL auto_increment,
  `member_name` varchar(50) collate utf8_unicode_ci NOT NULL,
  `member_loginname` varchar(15) character set tis620 NOT NULL default '',
  `member_password` varchar(50) character set tis620 NOT NULL default '',
  `lastsign_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `member_pri` tinyint(1) NOT NULL,
  PRIMARY KEY  (`member_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `member`
-- 

INSERT INTO `member` VALUES (1, 'KATOY KGB', 'katoy', '81dc9bdb52d04dc20036dbd8313ed055', '2012-01-18 00:00:00', 2);
INSERT INTO `member` VALUES (2, 'admin', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '0000-00-00 00:00:00', 1);
INSERT INTO `member` VALUES (3, 'web', 'webmaster', '81dc9bdb52d04dc20036dbd8313ed055', '0000-00-00 00:00:00', 2);

-- --------------------------------------------------------

-- 
-- Table structure for table `position`
-- 

CREATE TABLE `position` (
  `pos_id` tinyint(3) NOT NULL auto_increment,
  `pos_name` varchar(100) character set tis620 NOT NULL,
  PRIMARY KEY  (`pos_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=121 ;

-- 
-- Dumping data for table `position`
-- 

INSERT INTO `position` VALUES (101, 'ผู้ว่าราชการ');
INSERT INTO `position` VALUES (102, 'รองผู้ว่าราชการ');

-- --------------------------------------------------------

-- 
-- Table structure for table `useronline`
-- 

CREATE TABLE `useronline` (
  `SID` varchar(100) character set tis620 NOT NULL default '',
  `time` varchar(15) character set tis620 NOT NULL default '',
  `DAY` char(3) character set tis620 NOT NULL default '',
  `member` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`SID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Dumping data for table `useronline`
-- 

INSERT INTO `useronline` VALUES ('2291ffac47c7c3a9951493ae7dd85a3e', '1381420406', '282', '2');
