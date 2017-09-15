-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2017 at 05:54 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(2, NULL, 'bbbbbbb', 20, 10, 'xxxxx', 'yyyyyyyy');

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
(1, 'KPI Admin', 'Administrator', '1990-09-02 00:00:00', 'kpi.info@gmail.com', '$2y$10$KJfehOA6nuzHEvTRA./ASeyKr1Am7HdFHUf9w5TS265deSYe..UKK', 'Dindaeng, Bangkok', 1, 'images/profiles/kpi_avatar.png', b'0', b'1', b'0', '2017-08-31 00:00:00', '2017-09-13 10:58:30'),
(2, '', 'chumpol', NULL, 'chumpol.mok@cpc.ac.th', '$2y$10$sAFi.GBgGcGcpMydb6RyUulh0AOGi9waN1qd5sxPJ/HRYg9g71KHS', '', 1, 'images/profiles/kpi_avatar.png', b'0', b'1', b'0', '2017-09-09 20:18:28', '0000-00-00 00:00:00');

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
-- Indexes for table `kpi_criterion`
--
ALTER TABLE `kpi_criterion`
  ADD PRIMARY KEY (`cri_id`);

--
-- Indexes for table `kpi_logs`
--
ALTER TABLE `kpi_logs`
  ADD PRIMARY KEY (`log_id`);

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
  MODIFY `capt_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kpi_criterion`
--
ALTER TABLE `kpi_criterion`
  MODIFY `cri_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kpi_logs`
--
ALTER TABLE `kpi_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;
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
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
