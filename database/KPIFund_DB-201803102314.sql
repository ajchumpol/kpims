-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2018 at 11:14 PM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `KPIFund_DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `kpi_attach_issdet`
--

CREATE TABLE `kpi_attach_issdet` (
  `att_id` int(11) NOT NULL,
  `subcokpi_id` int(11) NOT NULL,
  `issdet_id` int(11) NOT NULL,
  `att_label` varchar(100) COLLATE utf8_bin NOT NULL,
  `att_path` text COLLATE utf8_bin NOT NULL,
  `att_create` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kpi_attach_issdet`
--

INSERT INTO `kpi_attach_issdet` (`att_id`, `subcokpi_id`, `issdet_id`, `att_label`, `att_path`, `att_create`) VALUES
(9, 2, 28, '1511689893.docx', 'attachs/files/1511689893.docx', '2017-11-26 10:51:33'),
(10, 1, 29, '1511696794.pdf', 'attachs/files/1511696794.pdf', '2017-11-26 12:46:34'),
(11, 1, 7, '1511709547.pdf', 'attachs/files/1511709547.pdf', '2017-11-26 22:19:07'),
(12, 1, 8, '1511773115.pdf', 'attachs/files/1511773115.pdf', '2017-11-27 15:58:35'),
(13, 7, 9, 'เอกสารทดสอบ01.pdf', 'attachs/files/เอกสารทดสอบ01.pdf', '2017-12-26 12:13:03');

-- --------------------------------------------------------

--
-- Table structure for table `kpi_capital_type`
--

CREATE TABLE `kpi_capital_type` (
  `capt_id` int(11) NOT NULL,
  `capt_name` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kpi_capital_type`
--

INSERT INTO `kpi_capital_type` (`capt_id`, `capt_name`) VALUES
(1, 'เพื่อการกู้ยืม'),
(2, 'เพื่อการจำหน่ายและการผลิต'),
(3, 'เพื่อการบริการ'),
(4, 'เพื่อการสงเคราะห์และสวัสดิการสังคม'),
(5, 'เพื่อการสนับสนุนส่งเสริม');

-- --------------------------------------------------------

--
-- Table structure for table `kpi_codoc_cokpi_subcokpi`
--

CREATE TABLE `kpi_codoc_cokpi_subcokpi` (
  `doc_id` int(11) NOT NULL,
  `cokpi_id` int(11) NOT NULL,
  `subcokpi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kpi_codoc_cokpi_subcokpi`
--

INSERT INTO `kpi_codoc_cokpi_subcokpi` (`doc_id`, `cokpi_id`, `subcokpi_id`) VALUES
(9, 3, 1),
(9, 3, 2),
(9, 4, 3),
(9, 4, 4),
(9, 5, 5),
(9, 5, 6),
(9, 6, 7),
(10, 3, 1),
(10, 3, 2),
(10, 4, 3),
(10, 4, 4),
(10, 5, 5),
(10, 5, 6),
(10, 6, 7),
(11, 3, 1),
(11, 3, 2),
(11, 4, 3),
(11, 4, 4),
(11, 5, 5),
(11, 5, 6),
(11, 6, 7);

-- --------------------------------------------------------

--
-- Table structure for table `kpi_codoc_crit_cokpi`
--

CREATE TABLE `kpi_codoc_crit_cokpi` (
  `doc_id` int(11) NOT NULL,
  `cri_id` int(11) NOT NULL,
  `cokpi_id` int(11) NOT NULL,
  `cokpi_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kpi_codoc_crit_cokpi`
--

INSERT INTO `kpi_codoc_crit_cokpi` (`doc_id`, `cri_id`, `cokpi_id`, `cokpi_score`) VALUES
(9, 2, 3, 1),
(9, 2, 4, 1),
(9, 3, 5, 1),
(9, 3, 6, 1),
(10, 2, 3, 2),
(10, 2, 4, 2),
(10, 3, 5, 2),
(10, 3, 6, 2),
(11, 2, 3, 9),
(11, 2, 4, 7),
(11, 3, 5, 8),
(11, 3, 6, 8);

-- --------------------------------------------------------

--
-- Table structure for table `kpi_codoc_subcokpi_issdet`
--

CREATE TABLE `kpi_codoc_subcokpi_issdet` (
  `doc_id` int(11) NOT NULL,
  `subcokpi_id` int(11) NOT NULL,
  `issdet_id` int(11) NOT NULL,
  `gra_id` int(11) NOT NULL,
  `issdet_ch_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kpi_codoc_subcokpi_issdet`
--

INSERT INTO `kpi_codoc_subcokpi_issdet` (`doc_id`, `subcokpi_id`, `issdet_id`, `gra_id`, `issdet_ch_score`) VALUES
(9, 1, 1, 1, 5),
(9, 1, 2, 1, 5),
(9, 2, 3, 3, 5),
(9, 5, 4, 1, 5),
(9, 5, 5, 1, 5),
(9, 7, 6, 3, 5),
(10, 1, 1, 1, 2),
(10, 1, 2, 1, 2),
(10, 2, 3, 3, 5),
(10, 5, 4, 1, 3),
(10, 5, 5, 1, 3),
(10, 7, 6, 3, 5),
(11, 1, 1, 1, 5),
(11, 1, 2, 1, 3),
(11, 2, 3, 3, 5),
(11, 5, 4, 1, 4),
(11, 5, 5, 1, 4),
(11, 7, 6, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `kpi_cokpi`
--

CREATE TABLE `kpi_cokpi` (
  `cokpi_id` int(11) NOT NULL,
  `cokpi_title` varchar(100) COLLATE utf8_bin NOT NULL,
  `cokpi_wei` int(11) NOT NULL,
  `cokpi_app` text COLLATE utf8_bin NOT NULL,
  `cokpi_unit` varchar(20) COLLATE utf8_bin NOT NULL,
  `cokpi_comment` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kpi_cokpi`
--

INSERT INTO `kpi_cokpi` (`cokpi_id`, `cokpi_title`, `cokpi_wei`, `cokpi_app`, `cokpi_unit`, `cokpi_comment`) VALUES
(3, 'ตัวชี้วัด 1.1 การดำเนินการทดสอบ', 6, 'ทดสอบแนวทางกำหนดตัวชี้วัด 1.1', '1', 'ทดสอบการระบุหมายเหตุ 1.1'),
(4, 'ตัวชี้วัด 1.2 การดำเนินการทดสอบ', 6, 'ทดสอบแนวทางกำหนดตัวชี้วัด 1.2', '1', 'ทดสอบหมายเหตุตัวชี้วัด 1.2'),
(5, 'ตัวชี้วัด 2.1 การดำเนินการทดสอบ', 10, '', '1', ''),
(6, 'ตัวชี้วัด 2.2 การดำเนินการทดสอบ', 10, 'แนวทางกำหนดตัวชี้วัด ตัวชี้วัด 2.2 การดำเนินการทดสอบ', '1', 'หมายเหตุ ตัวชี้วัด 2.2 การดำเนินการทดสอบ');

-- --------------------------------------------------------

--
-- Table structure for table `kpi_cokpi_crit`
--

CREATE TABLE `kpi_cokpi_crit` (
  `cri_id` int(11) NOT NULL,
  `cokpi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kpi_cokpi_crit`
--

INSERT INTO `kpi_cokpi_crit` (`cri_id`, `cokpi_id`) VALUES
(2, 3),
(2, 4),
(3, 5),
(3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `kpi_cokpi_subcokpi`
--

CREATE TABLE `kpi_cokpi_subcokpi` (
  `cokpi_id` int(11) NOT NULL,
  `subcokpi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kpi_cokpi_subcokpi`
--

INSERT INTO `kpi_cokpi_subcokpi` (`cokpi_id`, `subcokpi_id`) VALUES
(3, 1),
(3, 2),
(4, 3),
(4, 4),
(5, 5),
(5, 6),
(6, 7);

-- --------------------------------------------------------

--
-- Table structure for table `kpi_criterion`
--

CREATE TABLE `kpi_criterion` (
  `cri_id` int(11) NOT NULL,
  `cri_year` int(4) NOT NULL DEFAULT '9999',
  `capt_id` int(11) DEFAULT NULL,
  `cri_title` varchar(100) COLLATE utf8_bin NOT NULL,
  `cri_wei_min` tinyint(4) NOT NULL,
  `cri_wei_max` tinyint(4) NOT NULL,
  `cri_kpi_app` text COLLATE utf8_bin NOT NULL,
  `cri_kpi_appexa` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kpi_criterion`
--

INSERT INTO `kpi_criterion` (`cri_id`, `cri_year`, `capt_id`, `cri_title`, `cri_wei_min`, `cri_wei_max`, `cri_kpi_app`, `cri_kpi_appexa`) VALUES
(2, 9999, NULL, 'ด้านที่ 1 การเงิน', 10, 10, 'ตัวชี้วัดด้านการเงินแบ่งกลุ่มตามประเภททุนหมุนเวียน 5 ประเภท ได้แก่ 1. เพื่อการกู้ยืม 2. เพื่อการจำหน่ายและการผลิต 3. เพื่อการบริการ 4. เพื่อการสงเคราะห์และสวัสดิการสังคม 5. เพื่อการสนับสนุนและส่งเสริม', 'ตัวอย่างตัวชี้วัด อัตราการปล่อยสินเชื่อ อัตราหนี้ค้างชำระ รายได้ดอกเบี้ย'),
(3, 9999, NULL, 'ด้านที่ 2 การสนองประโยชน์ต่อผู้มีส่วนได้ส่วนเสีย', 20, 10, 'พิจารณาการดำเนินงานที่ตอบสนองความต้องการความคาดหวังของผู้มีส่วนได้ส่วนเสีย', 'ตัวอย่างตัวชี้วัด'),
(4, 9999, NULL, 'ด้านที่ 3 ทดสอบการเพิ่มข้อมูลเกณฑ์ฯ', 20, 30, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `kpi_document`
--

CREATE TABLE `kpi_document` (
  `doc_id` int(11) NOT NULL,
  `doc_label` varchar(10) COLLATE utf8_bin NOT NULL,
  `doc_title` varchar(200) COLLATE utf8_bin NOT NULL,
  `doc_year` int(4) NOT NULL,
  `doc_comment` text COLLATE utf8_bin NOT NULL,
  `doc_status` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'D' COMMENT 'D - Draft, S - Submitted and C - Committed',
  `doc_create_by` int(11) NOT NULL,
  `doc_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `doc_edit_by` int(11) NOT NULL,
  `doc_edit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kpi_document`
--

INSERT INTO `kpi_document` (`doc_id`, `doc_label`, `doc_title`, `doc_year`, `doc_comment`, `doc_status`, `doc_create_by`, `doc_create`, `doc_edit_by`, `doc_edit`) VALUES
(9, 'DOC-0001', 'กรอบหลักเกณฑ์การประเมินผลการดำเนินงานทุนหมุนเวียน ประจำปีบัญชี 2560', 2560, '', 'C', 3, '2017-10-10 10:03:43', 5, '2018-03-10 15:54:04'),
(10, 'DOC-0002', 'กรอบหลักเกณฑ์การประเมินผลการดำเนินงานทุนหมุนเวียน ประจำปีบัญชี 2560', 2560, '', 'S', 3, '2017-10-13 22:45:25', 3, '2018-03-10 15:26:40'),
(11, 'DOC-0003', 'กรอบหลักเกณฑ์การประเมินผลการดำเนินงานทุนหมุนเวียน ประจำปีบัญชี 2560', 2560, '', 'S', 3, '2017-10-22 07:42:36', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kpi_doc_crit`
--

CREATE TABLE `kpi_doc_crit` (
  `doc_id` int(11) NOT NULL,
  `cri_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `kpi_grade`
--

CREATE TABLE `kpi_grade` (
  `gra_id` int(11) NOT NULL,
  `gra_score1` int(2) NOT NULL,
  `gra_title1` text COLLATE utf8_bin NOT NULL,
  `gra_score2` int(2) NOT NULL,
  `gra_title2` text COLLATE utf8_bin NOT NULL,
  `gra_score3` int(2) NOT NULL,
  `gra_title3` text COLLATE utf8_bin NOT NULL,
  `gra_score4` int(2) NOT NULL,
  `gra_title4` text COLLATE utf8_bin NOT NULL,
  `gra_score5` int(2) NOT NULL,
  `gra_title5` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kpi_grade`
--

INSERT INTO `kpi_grade` (`gra_id`, `gra_score1`, `gra_title1`, `gra_score2`, `gra_title2`, `gra_score3`, `gra_title3`, `gra_score4`, `gra_title4`, `gra_score5`, `gra_title5`) VALUES
(1, 1, '80 วัน', 2, '75 วัน', 3, '70 วัน', 4, '65 วัน', 5, '60 วัน'),
(3, 1, 'ไม่สามารถดำเนินงาน', 2, '', 3, '', 4, '', 5, 'ดำเนินงานสำเร็จได้');

-- --------------------------------------------------------

--
-- Table structure for table `kpi_logs`
--

CREATE TABLE `kpi_logs` (
  `log_id` int(11) NOT NULL,
  `log_action` text COLLATE utf8_bin NOT NULL,
  `log_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `kpi_sessions`
--

CREATE TABLE `kpi_sessions` (
  `user_id` int(11) NOT NULL,
  `ses_ip` varchar(50) COLLATE utf8_bin NOT NULL,
  `ses_times` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ses_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `kpi_sub_cokpi`
--

CREATE TABLE `kpi_sub_cokpi` (
  `subcokpi_id` int(11) NOT NULL,
  `subcokpi_title` varchar(100) COLLATE utf8_bin NOT NULL,
  `subcokpi_def` text COLLATE utf8_bin NOT NULL,
  `subcokpi_comment` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kpi_sub_cokpi`
--

INSERT INTO `kpi_sub_cokpi` (`subcokpi_id`, `subcokpi_title`, `subcokpi_def`, `subcokpi_comment`) VALUES
(1, 'ตัวชี้วัดที่ 1.1.1 การดำเนินการทดสอบ', 'คำนิยาม ตัวชี้วัดที่ 1.1.1 การดำเนินการทดสอบ', 'หมายเหตุ ตัวชี้วัดที่ 1.1.1 การดำเนินการทดสอบ'),
(2, 'ตัวชี้วัดที่ 1.1.2 การดำเนินการทดสอบ', '', ''),
(3, 'ตัวชี้วัดที่ 1.2.1 การดำเนินการทดสอบ', '', ''),
(4, 'ตัวชี้วัดที่ 1.2.2 การดำเนินการทดสอบ', '', ''),
(5, 'ตัวชี้วัด 2.1.1 การดำเนินการทดสอบ', 'คำนิยาม ตัวชี้วัด 2.1.1 การดำเนินการทดสอบ', 'หมายเหตุ ตัวชี้วัด 2.1.1 การดำเนินการทดสอบ'),
(6, 'ตัวชี้วัด 2.1.2 การดำเนินการทดสอบ', 'คำนิยาม ตัวชี้วัด 2.1.2 การดำเนินการทดสอบ', 'ตัวอย่าง ตัวชี้วัด 2.1.2 การดำเนินการทดสอบ'),
(7, 'ตัวชี้วัด 2.2.1 การดำเนินการทดสอบ', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `kpi_sub_issuesdetail`
--

CREATE TABLE `kpi_sub_issuesdetail` (
  `issdet_id` int(11) NOT NULL,
  `subcokpi_id` int(11) NOT NULL,
  `issdet_title` varchar(100) COLLATE utf8_bin NOT NULL,
  `issdet_wei` int(11) NOT NULL,
  `gra_id` int(11) NOT NULL,
  `issdet_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kpi_sub_issuesdetail`
--

INSERT INTO `kpi_sub_issuesdetail` (`issdet_id`, `subcokpi_id`, `issdet_title`, `issdet_wei`, `gra_id`, `issdet_score`) VALUES
(1, 1, '(1) การดำเนินการทดสอบ ตัวชี้วัดที่ 1.1.1', 20, 1, 0),
(2, 1, '(2) การดำเนินการทดสอบ ตัวชี้วัดที่ 1.1.1', 20, 1, 0),
(3, 2, '(1) การดำเนินการทดสอบ ตัวชี้วัดที่ 1.1.2', 20, 3, 0),
(4, 5, '(1) ประเด็นย่อยตัวชี้วัด 2.1.1 การดำเนินการทดสอบ', 20, 1, 0),
(5, 5, '(2) ประเด็นย่อยตัวชี้วัด 2.1.1 การดำเนินการทดสอบ', 20, 1, 0),
(6, 7, '(1) ประเด็นย่อยตัวชี้วัด 2.2.1 การดำเนินการทดสอบ', 20, 3, 0),
(7, 1, '(3) การดำเนินการทดสอบ ตัวชี้วัดที่ 1.1.1', 15, 1, 0),
(8, 1, '(4) การดำเนินการทดสอบ ตัวชี้วัดที่ 1.1.1', 18, 1, 0),
(9, 7, '(2) ประเด็นย่อยตัวชี้วัด 2.2.1 การดำเนินการทดสอบ', 20, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kpi_user`
--

CREATE TABLE `kpi_user` (
  `user_id` int(11) NOT NULL,
  `user_flname` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `user_bd` datetime DEFAULT NULL,
  `user_email` varchar(100) COLLATE utf8_bin NOT NULL,
  `user_password` text COLLATE utf8_bin NOT NULL,
  `user_address` tinytext COLLATE utf8_bin NOT NULL,
  `type_id` int(11) NOT NULL,
  `user_photo` varchar(255) COLLATE utf8_bin NOT NULL,
  `user_logged_in` bit(1) NOT NULL,
  `user_confirmed` bit(1) NOT NULL,
  `user_deleted` bit(1) NOT NULL,
  `user_create` datetime NOT NULL,
  `user_edited` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kpi_user`
--

INSERT INTO `kpi_user` (`user_id`, `user_flname`, `user_name`, `user_bd`, `user_email`, `user_password`, `user_address`, `type_id`, `user_photo`, `user_logged_in`, `user_confirmed`, `user_deleted`, `user_create`, `user_edited`) VALUES
(1, 'KPI Admin', 'Administrator', '1990-09-02 00:00:00', 'chumpol.mok@cpc.ac.th', '$2y$10$xRmn5zUBy/pXGcu6ibqg9O/StyTjfNSI5EBRcUX1IWwgG1TT3Htka', 'Dindaeng, Bangkok', 1, 'images/profiles/admin.png-1505579425', b'0', b'1', b'0', '2017-08-31 00:00:00', '2017-11-08 09:58:49'),
(2, 'นายชุมพร ณ ดินแดง', 'chumpol', '2017-10-14 00:00:00', 'chumpol.mokarat@gmail.com', '$2y$10$.vPxdVroXqvPFYI5VjDwkeqcG4xZGgDnyqiuBnPqBTuPdDXiF2aqy', '', 2, 'images/profiles/kpi_avatar.png', b'0', b'1', b'0', '2017-09-09 20:18:28', '2017-10-14 18:03:16'),
(3, 'นางสาวเอ บีซีดีอี', 'Staff01', '1996-02-14 00:00:00', 'staff.one@gmail.com', '$2y$10$5OAv5RdplAzrvd5P/VKq8OPCrMEjjMA3YR1gIpmTFT2YRcOCF7D7S', '', 3, 'images/profiles/kpi_avatar.png', b'0', b'1', b'0', '2017-09-16 22:52:56', '2017-10-08 12:46:51'),
(4, 'Boss KPI', 'Boss01', '1995-11-11 00:00:00', 'boss.one@gmail.com', '$2y$10$CFaha16weHvoNaBvQT0RH.Ftdt3naPzMKUluccY20.Lvvn07YhUbu', 'Dindaeng', 2, 'images/profiles/kpi_avatar.png', b'0', b'1', b'0', '2017-11-08 10:01:04', '0000-00-00 00:00:00'),
(5, 'นาย Super admin', 'Superadmin', '0000-00-00 00:00:00', 'super.admin@mail.com', '$2y$10$isRmhnrvquzA0cq6XadFjOCyA8/6GUx.DCZ8MENpZhbPSzXI2X1PG', '', 5, 'images/profiles/kpi_avatar.png', b'0', b'1', b'0', '2017-11-26 22:07:21', '0000-00-00 00:00:00'),
(6, 'นาย Cgd user01', 'Cgduser01', '0000-00-00 00:00:00', 'cgd.user@email.com', '$2y$10$x3yUECoGIFFpXLCwHb.ct.oOBBw9H8AcC5OY1Z/xqxVUsxZGmxOke', '', 4, 'images/profiles/kpi_avatar.png', b'0', b'1', b'0', '2017-11-26 22:08:03', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kpi_user_type`
--

CREATE TABLE `kpi_user_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kpi_user_type`
--

INSERT INTO `kpi_user_type` (`type_id`, `type_name`) VALUES
(1, 'Administrator'),
(2, 'Board'),
(3, 'Officer'),
(4, 'Officer-CGD'),
(5, 'Super-Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kpi_attach_issdet`
--
ALTER TABLE `kpi_attach_issdet`
  ADD PRIMARY KEY (`att_id`);

--
-- Indexes for table `kpi_capital_type`
--
ALTER TABLE `kpi_capital_type`
  ADD PRIMARY KEY (`capt_id`);

--
-- Indexes for table `kpi_cokpi`
--
ALTER TABLE `kpi_cokpi`
  ADD PRIMARY KEY (`cokpi_id`);

--
-- Indexes for table `kpi_criterion`
--
ALTER TABLE `kpi_criterion`
  ADD PRIMARY KEY (`cri_id`);

--
-- Indexes for table `kpi_document`
--
ALTER TABLE `kpi_document`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `kpi_grade`
--
ALTER TABLE `kpi_grade`
  ADD PRIMARY KEY (`gra_id`);

--
-- Indexes for table `kpi_logs`
--
ALTER TABLE `kpi_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `kpi_sub_cokpi`
--
ALTER TABLE `kpi_sub_cokpi`
  ADD PRIMARY KEY (`subcokpi_id`);

--
-- Indexes for table `kpi_sub_issuesdetail`
--
ALTER TABLE `kpi_sub_issuesdetail`
  ADD PRIMARY KEY (`issdet_id`);

--
-- Indexes for table `kpi_user`
--
ALTER TABLE `kpi_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `kpi_user_type`
--
ALTER TABLE `kpi_user_type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kpi_attach_issdet`
--
ALTER TABLE `kpi_attach_issdet`
  MODIFY `att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `kpi_capital_type`
--
ALTER TABLE `kpi_capital_type`
  MODIFY `capt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `kpi_cokpi`
--
ALTER TABLE `kpi_cokpi`
  MODIFY `cokpi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `kpi_criterion`
--
ALTER TABLE `kpi_criterion`
  MODIFY `cri_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kpi_document`
--
ALTER TABLE `kpi_document`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `kpi_grade`
--
ALTER TABLE `kpi_grade`
  MODIFY `gra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kpi_logs`
--
ALTER TABLE `kpi_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kpi_sub_cokpi`
--
ALTER TABLE `kpi_sub_cokpi`
  MODIFY `subcokpi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `kpi_sub_issuesdetail`
--
ALTER TABLE `kpi_sub_issuesdetail`
  MODIFY `issdet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `kpi_user`
--
ALTER TABLE `kpi_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `kpi_user_type`
--
ALTER TABLE `kpi_user_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
