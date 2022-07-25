-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2022 at 03:07 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `001`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_status`
--

CREATE TABLE `app_status` (
  `id` int(11) NOT NULL,
  `shop` varchar(25) NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `app_status`
--

INSERT INTO `app_status` (`id`, `shop`) VALUES
(1, 'normal');

-- --------------------------------------------------------

--
-- Table structure for table `button`
--

CREATE TABLE `button` (
  `id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `count_qty_box`
--

CREATE TABLE `count_qty_box` (
  `id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `count_qty_box`
--

INSERT INTO `count_qty_box` (`id`, `qty`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ok_message`
--

CREATE TABLE `ok_message` (
  `id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ok_message2`
--

CREATE TABLE `ok_message2` (
  `id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pokayoke_data_part`
--

CREATE TABLE `pokayoke_data_part` (
  `id` int(11) NOT NULL,
  `local` varchar(255) DEFAULT NULL,
  `shopping` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pokayoke_data_part`
--

INSERT INTO `pokayoke_data_part` (`id`, `local`, `shopping`) VALUES
(1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pokayoke_kanban`
--

CREATE TABLE `pokayoke_kanban` (
  `id` int(11) NOT NULL,
  `api` varchar(255) DEFAULT NULL,
  `cust` varchar(255) DEFAULT NULL,
  `uniq` varchar(255) DEFAULT NULL,
  `ref` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pokayoke_kanban`
--

INSERT INTO `pokayoke_kanban` (`id`, `api`, `cust`, `uniq`, `ref`) VALUES
(1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `qty_type`
--

CREATE TABLE `qty_type` (
  `id` int(11) NOT NULL,
  `data_part` varchar(25) DEFAULT NULL,
  `data` varchar(255) DEFAULT NULL,
  `part_name_1L` varchar(255) DEFAULT NULL,
  `part_name_1N` varchar(255) DEFAULT NULL,
  `barcode_1N` varchar(255) DEFAULT NULL,
  `barcode_1L` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qty_type`
--

INSERT INTO `qty_type` (`id`, `data_part`, `data`, `part_name_1L`, `part_name_1N`, `barcode_1N`, `barcode_1L`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting_qrcode`
--

CREATE TABLE `setting_qrcode` (
  `id` int(11) NOT NULL,
  `left_qrcode` int(11) NOT NULL DEFAULT 146,
  `up_qrcode` int(11) NOT NULL DEFAULT 102,
  `left_label` int(11) NOT NULL DEFAULT 147,
  `up_label` int(11) NOT NULL DEFAULT 109,
  `darkness` int(11) NOT NULL DEFAULT 15
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting_qrcode`
--

INSERT INTO `setting_qrcode` (`id`, `left_qrcode`, `up_qrcode`, `left_label`, `up_label`, `darkness`) VALUES
(1, 145, 104, 146, 109, 20);

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `id` int(11) NOT NULL,
  `number` varchar(100) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`id`, `number`, `user`) VALUES
(1, 'EXP-001', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `temp_data_part`
--

CREATE TABLE `temp_data_part` (
  `id` int(11) NOT NULL,
  `data` varchar(255) NOT NULL,
  `code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `temp_data_pic`
--

CREATE TABLE `temp_data_pic` (
  `id` int(11) NOT NULL,
  `pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temp_data_pic`
--

INSERT INTO `temp_data_pic` (`id`, `pic`) VALUES
(1, '62111KK030C012');

-- --------------------------------------------------------

--
-- Table structure for table `temp_production`
--

CREATE TABLE `temp_production` (
  `id` int(11) NOT NULL,
  `npk_op` varchar(10) DEFAULT NULL,
  `pn_cust` varchar(255) DEFAULT NULL,
  `pic` varchar(100) DEFAULT NULL,
  `pn_api_exp` varchar(255) DEFAULT NULL,
  `part_name` varchar(255) DEFAULT NULL,
  `dock` varchar(25) DEFAULT NULL,
  `pos` varchar(5) DEFAULT NULL,
  `job_num` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `qty_exp` int(11) DEFAULT NULL,
  `count_qty_oem` int(11) DEFAULT NULL,
  `count_qty_exp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temp_production`
--

INSERT INTO `temp_production` (`id`, `npk_op`, `pn_cust`, `pic`, `pn_api_exp`, `part_name`, `dock`, `pos`, `job_num`, `address`, `qty_exp`, `count_qty_oem`, `count_qty_exp`) VALUES
(1, '1565', '62111KK030C0', '62111KK030C012', 'JI4DOR-GBCS66BK12', 'BOARD COWL SIDE TRIM RH 62111-KK030-C0', '1L', 'RH', '7939', 'A8', 10, 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `temp_qty_count`
--

CREATE TABLE `temp_qty_count` (
  `id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temp_qty_count`
--

INSERT INTO `temp_qty_count` (`id`, `qty`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `temp_shop`
--

CREATE TABLE `temp_shop` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `npk` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temp_shop`
--

INSERT INTO `temp_shop` (`id`, `name`, `npk`) VALUES
(1, 'Irfan Malik', '1565');

-- --------------------------------------------------------

--
-- Table structure for table `trash_data_part`
--

CREATE TABLE `trash_data_part` (
  `id` bigint(20) NOT NULL,
  `code` varchar(255) NOT NULL,
  `datetime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trash_data_part`
--

INSERT INTO `trash_data_part` (`id`, `code`, `datetime`) VALUES
(3, '21007688JI4ACL-GDAQ66BK00', '2021-09-24 11:21:00'),
(4, '21007688JI4DOR-GCSB66GY10', '2021-09-24 13:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `uniq_code`
--

CREATE TABLE `uniq_code` (
  `id` int(11) NOT NULL,
  `cycle` int(11) NOT NULL DEFAULT 1,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uniq_code`
--

INSERT INTO `uniq_code` (`id`, `cycle`, `date`) VALUES
(1, 454, 'Wed Feb 02 2022 07:00:00 GMT+0700 (Western Indones');

-- --------------------------------------------------------

--
-- Table structure for table `uniq_code_qr`
--

CREATE TABLE `uniq_code_qr` (
  `id` int(11) NOT NULL,
  `cycle` int(11) NOT NULL DEFAULT 1,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uniq_code_qr`
--

INSERT INTO `uniq_code_qr` (`id`, `cycle`, `date`) VALUES
(1, 125, '2021-09-08');

-- --------------------------------------------------------

--
-- Table structure for table `warning_message`
--

CREATE TABLE `warning_message` (
  `id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `warning_message2`
--

CREATE TABLE `warning_message2` (
  `id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_status`
--
ALTER TABLE `app_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `button`
--
ALTER TABLE `button`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `count_qty_box`
--
ALTER TABLE `count_qty_box`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ok_message`
--
ALTER TABLE `ok_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ok_message2`
--
ALTER TABLE `ok_message2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pokayoke_data_part`
--
ALTER TABLE `pokayoke_data_part`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pokayoke_kanban`
--
ALTER TABLE `pokayoke_kanban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qty_type`
--
ALTER TABLE `qty_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting_qrcode`
--
ALTER TABLE `setting_qrcode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_data_part`
--
ALTER TABLE `temp_data_part`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_data_pic`
--
ALTER TABLE `temp_data_pic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_production`
--
ALTER TABLE `temp_production`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_qty_count`
--
ALTER TABLE `temp_qty_count`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_shop`
--
ALTER TABLE `temp_shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trash_data_part`
--
ALTER TABLE `trash_data_part`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uniq_code`
--
ALTER TABLE `uniq_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uniq_code_qr`
--
ALTER TABLE `uniq_code_qr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warning_message`
--
ALTER TABLE `warning_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warning_message2`
--
ALTER TABLE `warning_message2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_status`
--
ALTER TABLE `app_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `button`
--
ALTER TABLE `button`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `count_qty_box`
--
ALTER TABLE `count_qty_box`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ok_message`
--
ALTER TABLE `ok_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ok_message2`
--
ALTER TABLE `ok_message2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pokayoke_data_part`
--
ALTER TABLE `pokayoke_data_part`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pokayoke_kanban`
--
ALTER TABLE `pokayoke_kanban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `qty_type`
--
ALTER TABLE `qty_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setting_qrcode`
--
ALTER TABLE `setting_qrcode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `station`
--
ALTER TABLE `station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temp_data_part`
--
ALTER TABLE `temp_data_part`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_data_pic`
--
ALTER TABLE `temp_data_pic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temp_production`
--
ALTER TABLE `temp_production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temp_qty_count`
--
ALTER TABLE `temp_qty_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temp_shop`
--
ALTER TABLE `temp_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trash_data_part`
--
ALTER TABLE `trash_data_part`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `uniq_code`
--
ALTER TABLE `uniq_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `uniq_code_qr`
--
ALTER TABLE `uniq_code_qr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `warning_message`
--
ALTER TABLE `warning_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warning_message2`
--
ALTER TABLE `warning_message2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
