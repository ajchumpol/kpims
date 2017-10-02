-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2017 at 07:44 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kpifund_db`
--

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
(3, 'เพื่อการบริการ');

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
(4, 'ตัวชี้วัด 2.1 ทดสอบการดำเนินงาน', 5, 'แนวทางกำหนดตัวชี้วัด 2.1 ทดสอบการดำเนินงาน', '1', 'หมายเหตุตัวชี้วัด 2.1 ทดสอบการดำเนินงาน'),
(5, 'ตัวชี้วัด 1.2 การดำเนินการทดสอบ', 5, 'ทดสอบแนวทางกำหนดตัวชี้วัด 1.2', '1', 'ทดสอบหมายเหตุแนวทางกำหนดตัวชี้วัด 1.2');

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
(3, 4),
(2, 5);

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
(3, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `kpi_criterion`
--

CREATE TABLE `kpi_criterion` (
  `cri_id` int(11) NOT NULL,
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

INSERT INTO `kpi_criterion` (`cri_id`, `capt_id`, `cri_title`, `cri_wei_min`, `cri_wei_max`, `cri_kpi_app`, `cri_kpi_appexa`) VALUES
(2, NULL, 'ด้านที่ 1 การเงิน', 10, 10, 'ตัวชี้วัดด้านการเงินแบ่งกลุ่มตามประเภททุนหมุนเวียน 5 ประเภท ได้แก่ ...', 'ตัวอย่างตัวชี้วัด ...'),
(3, NULL, 'ด้านที่ 2 การสนองประโยชน์ต่อผู้มีส่วนได้ส่วนเสีย', 20, 10, 'ทดสอบแนวทางกำหนดตัวชี้วัดด้านที่ 2', 'ทดสอบตัวอย่างแนวทางกำหนดตัวชี้วัดด้านที่ 2');

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
(1, 'ตัวชี้วัด 1.1.1 การดำเนินการทำสอบ', 'การดำเนินการทำสอบคำนิยาม 1.1.1', 'การดำเนินการทำสอบคำหมายเหตุ 1.1.1'),
(2, 'ตัวชี้วัด 1.1.2 การดำเนินการทำสอบ', 'การดำเนินการทำสอบคำนิยาม 1.1.2', 'การดำเนินการทำสอบคำหมายเหตุ 1.1.2'),
(4, 'ตัวชี้วัด 1.1.3 การดำเนินการทำสอบ', 'การดำเนินการทำสอบคำนิยาม 1.1.3', 'การดำเนินการทำสอบคำหมายเหตุ 1.1.3'),
(5, 'ตัวชี้วัด 1.2.1 การดำเนินการทดสอบ', 'คำนิยามการดำเนินการทดสอบ ตัวชี้วัดย่อย 1.2.1', 'หมายเหตุการดำเนินการทดสอบ ตัวชี้วัดย่อย 1.2.1');

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
(1, 'KPI Admin', 'Administrator', '1990-09-02 00:00:00', 'kpi.info@gmail.com', '$2y$10$KJfehOA6nuzHEvTRA./ASeyKr1Am7HdFHUf9w5TS265deSYe..UKK', 'Dindaeng, Bangkok', 1, 'images/profiles/kpi_avatar.png', b'1111111111111111111111111111111', b'1111111111111111111111111111111', b'1111111111111111111111111111111', '2017-08-31 00:00:00', '2017-09-13 10:58:30'),
(2, '', 'chumpol', NULL, 'chumpol.mok@cpc.ac.th', '$2y$10$sAFi.GBgGcGcpMydb6RyUulh0AOGi9waN1qd5sxPJ/HRYg9g71KHS', '', 1, 'images/profiles/kpi_avatar.png', b'1111111111111111111111111111111', b'1111111111111111111111111111111', b'1111111111111111111111111111111', '2017-09-09 20:18:28', '0000-00-00 00:00:00');

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
(2, 'Supervisor'),
(3, 'Staff');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `kpi_capital_type`
--
ALTER TABLE `kpi_capital_type`
  MODIFY `capt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kpi_cokpi`
--
ALTER TABLE `kpi_cokpi`
  MODIFY `cokpi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kpi_criterion`
--
ALTER TABLE `kpi_criterion`
  MODIFY `cri_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `subcokpi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kpi_sub_issuesdetail`
--
ALTER TABLE `kpi_sub_issuesdetail`
  MODIFY `issdet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kpi_user`
--
ALTER TABLE `kpi_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kpi_user_type`
--
ALTER TABLE `kpi_user_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
