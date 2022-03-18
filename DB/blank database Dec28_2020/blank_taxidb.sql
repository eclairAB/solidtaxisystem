-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2020 at 01:10 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taxidb`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `a_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `m_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ac_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`a_id`, `f_name`, `m_name`, `l_name`, `username`, `password`, `ac_id`) VALUES
(2, 'Michael Angelo', '', 'Nacario', 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `account_class`
--

CREATE TABLE `account_class` (
  `ac_id` int(11) NOT NULL,
  `ac_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_class`
--

INSERT INTO `account_class` (`ac_id`, `ac_text`) VALUES
(1, 'Admin'),
(2, 'Cashier'),
(3, 'Gas Pump Attendant'),
(4, 'Guard'),
(5, 'Dispatcher'),
(6, 'Maintenance'),
(7, 'Taxi Monitoring'),
(8, 'Reports'),
(12, 'Remit Officer'),
(14, 'Encoder'),
(16, 'Gas Monitoring');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `b_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `others_reason` text DEFAULT NULL,
  `others_amount` decimal(18,2) NOT NULL,
  `discount_reason` text DEFAULT NULL,
  `discount_amount` decimal(18,2) NOT NULL,
  `overall_total` decimal(18,2) NOT NULL,
  `b_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing_payments`
--

CREATE TABLE `billing_payments` (
  `b_pay_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `amount_payed` decimal(18,2) NOT NULL,
  `pay_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing_products`
--

CREATE TABLE `billing_products` (
  `bp_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `p_current_price` decimal(18,2) NOT NULL,
  `p_current_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing_receipt`
--

CREATE TABLE `billing_receipt` (
  `br_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `receipt_name` varchar(255) NOT NULL,
  `receipt_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `billing_taxi`
--

CREATE TABLE `billing_taxi` (
  `bt_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `t_current_rent_price` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `d_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `m_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `dc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver_class`
--

CREATE TABLE `driver_class` (
  `dc_id` int(11) NOT NULL,
  `dc_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver_remitance`
--

CREATE TABLE `driver_remitance` (
  `d_rem_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `remit` decimal(18,2) NOT NULL,
  `d_rem_date` datetime NOT NULL,
  `remitance_type` varchar(255) NOT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `driver_years`
--

CREATE TABLE `driver_years` (
  `dy_id` int(11) NOT NULL,
  `year_start` int(11) NOT NULL,
  `year_end` int(11) NOT NULL,
  `d_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gas`
--

CREATE TABLE `gas` (
  `g_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `gas_amount` decimal(18,2) NOT NULL,
  `current_gas_price` decimal(18,2) NOT NULL,
  `odo` decimal(18,2) NOT NULL,
  `total_trip` decimal(18,2) NOT NULL,
  `gas_time` datetime NOT NULL,
  `b_id` int(11) NOT NULL,
  `tank_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gas_inventory`
--

CREATE TABLE `gas_inventory` (
  `gt_id` int(11) NOT NULL,
  `refill_amount` decimal(18,2) NOT NULL,
  `gt_date` datetime NOT NULL,
  `tank_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gas_monitoring`
--

CREATE TABLE `gas_monitoring` (
  `gm_id` int(11) NOT NULL,
  `gas_amount` decimal(11,2) NOT NULL,
  `monitored_date` datetime NOT NULL,
  `tank_no` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gas_price`
--

CREATE TABLE `gas_price` (
  `gp_id` int(11) NOT NULL,
  `gp_price` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gas_price`
--

INSERT INTO `gas_price` (`gp_id`, `gp_price`) VALUES
(1, '50.00');

-- --------------------------------------------------------

--
-- Table structure for table `in_out`
--

CREATE TABLE `in_out` (
  `io_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `in_time` datetime DEFAULT NULL,
  `out_time` datetime DEFAULT NULL,
  `b_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `l_id` int(11) NOT NULL,
  `action` text NOT NULL,
  `l_time` datetime NOT NULL,
  `a_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `p_text` varchar(255) NOT NULL,
  `p_price` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `taxi`
--

CREATE TABLE `taxi` (
  `t_id` int(11) NOT NULL,
  `body_no` varchar(255) NOT NULL,
  `plate_no` varchar(255) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `tc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `taxi_change_oil`
--

CREATE TABLE `taxi_change_oil` (
  `tco_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `odo` decimal(18,2) NOT NULL,
  `tco_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `taxi_class`
--

CREATE TABLE `taxi_class` (
  `tc_id` int(11) NOT NULL,
  `tc_text` varchar(255) NOT NULL,
  `rental_price` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `taxi_maintenance`
--

CREATE TABLE `taxi_maintenance` (
  `tm_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `tmp_id` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `tm_date` datetime NOT NULL,
  `job_order_number` varchar(255) DEFAULT NULL,
  `others` text DEFAULT NULL,
  `amount` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `taxi_maintenance_jobs`
--

CREATE TABLE `taxi_maintenance_jobs` (
  `tmp_id` int(11) NOT NULL,
  `tmp_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`a_id`),
  ADD UNIQUE KEY `a_id` (`a_id`);

--
-- Indexes for table `account_class`
--
ALTER TABLE `account_class`
  ADD PRIMARY KEY (`ac_id`),
  ADD UNIQUE KEY `ac_id` (`ac_id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`b_id`),
  ADD UNIQUE KEY `b_id` (`b_id`);

--
-- Indexes for table `billing_payments`
--
ALTER TABLE `billing_payments`
  ADD PRIMARY KEY (`b_pay_id`),
  ADD UNIQUE KEY `b_pay_id` (`b_pay_id`);

--
-- Indexes for table `billing_products`
--
ALTER TABLE `billing_products`
  ADD PRIMARY KEY (`bp_id`),
  ADD UNIQUE KEY `bp_id` (`bp_id`);

--
-- Indexes for table `billing_receipt`
--
ALTER TABLE `billing_receipt`
  ADD PRIMARY KEY (`br_id`),
  ADD UNIQUE KEY `br_id` (`br_id`);

--
-- Indexes for table `billing_taxi`
--
ALTER TABLE `billing_taxi`
  ADD PRIMARY KEY (`bt_id`),
  ADD UNIQUE KEY `bt_id` (`bt_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`d_id`),
  ADD UNIQUE KEY `d_id` (`d_id`);

--
-- Indexes for table `driver_class`
--
ALTER TABLE `driver_class`
  ADD PRIMARY KEY (`dc_id`),
  ADD UNIQUE KEY `dc_id` (`dc_id`);

--
-- Indexes for table `driver_remitance`
--
ALTER TABLE `driver_remitance`
  ADD PRIMARY KEY (`d_rem_id`);

--
-- Indexes for table `driver_years`
--
ALTER TABLE `driver_years`
  ADD PRIMARY KEY (`dy_id`),
  ADD UNIQUE KEY `dy_id` (`dy_id`);

--
-- Indexes for table `gas`
--
ALTER TABLE `gas`
  ADD PRIMARY KEY (`g_id`),
  ADD UNIQUE KEY `g_id` (`g_id`);

--
-- Indexes for table `gas_inventory`
--
ALTER TABLE `gas_inventory`
  ADD PRIMARY KEY (`gt_id`),
  ADD UNIQUE KEY `gt_id` (`gt_id`);

--
-- Indexes for table `gas_monitoring`
--
ALTER TABLE `gas_monitoring`
  ADD PRIMARY KEY (`gm_id`);

--
-- Indexes for table `gas_price`
--
ALTER TABLE `gas_price`
  ADD PRIMARY KEY (`gp_id`),
  ADD UNIQUE KEY `gp_id` (`gp_id`);

--
-- Indexes for table `in_out`
--
ALTER TABLE `in_out`
  ADD PRIMARY KEY (`io_id`),
  ADD UNIQUE KEY `io_id` (`io_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`l_id`),
  ADD UNIQUE KEY `l_id` (`l_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`),
  ADD UNIQUE KEY `p_id` (`p_id`);

--
-- Indexes for table `taxi`
--
ALTER TABLE `taxi`
  ADD PRIMARY KEY (`t_id`),
  ADD UNIQUE KEY `t_id` (`t_id`);

--
-- Indexes for table `taxi_change_oil`
--
ALTER TABLE `taxi_change_oil`
  ADD PRIMARY KEY (`tco_id`),
  ADD UNIQUE KEY `tco_id` (`tco_id`);

--
-- Indexes for table `taxi_class`
--
ALTER TABLE `taxi_class`
  ADD PRIMARY KEY (`tc_id`),
  ADD UNIQUE KEY `tc_id` (`tc_id`);

--
-- Indexes for table `taxi_maintenance`
--
ALTER TABLE `taxi_maintenance`
  ADD PRIMARY KEY (`tm_id`),
  ADD UNIQUE KEY `tm_id` (`tm_id`);

--
-- Indexes for table `taxi_maintenance_jobs`
--
ALTER TABLE `taxi_maintenance_jobs`
  ADD PRIMARY KEY (`tmp_id`),
  ADD UNIQUE KEY `tmp_id` (`tmp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `account_class`
--
ALTER TABLE `account_class`
  MODIFY `ac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billing_payments`
--
ALTER TABLE `billing_payments`
  MODIFY `b_pay_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billing_products`
--
ALTER TABLE `billing_products`
  MODIFY `bp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billing_receipt`
--
ALTER TABLE `billing_receipt`
  MODIFY `br_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billing_taxi`
--
ALTER TABLE `billing_taxi`
  MODIFY `bt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `driver_class`
--
ALTER TABLE `driver_class`
  MODIFY `dc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `driver_remitance`
--
ALTER TABLE `driver_remitance`
  MODIFY `d_rem_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `driver_years`
--
ALTER TABLE `driver_years`
  MODIFY `dy_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gas`
--
ALTER TABLE `gas`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gas_inventory`
--
ALTER TABLE `gas_inventory`
  MODIFY `gt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gas_monitoring`
--
ALTER TABLE `gas_monitoring`
  MODIFY `gm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gas_price`
--
ALTER TABLE `gas_price`
  MODIFY `gp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `in_out`
--
ALTER TABLE `in_out`
  MODIFY `io_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxi`
--
ALTER TABLE `taxi`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxi_change_oil`
--
ALTER TABLE `taxi_change_oil`
  MODIFY `tco_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxi_class`
--
ALTER TABLE `taxi_class`
  MODIFY `tc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxi_maintenance`
--
ALTER TABLE `taxi_maintenance`
  MODIFY `tm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxi_maintenance_jobs`
--
ALTER TABLE `taxi_maintenance_jobs`
  MODIFY `tmp_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
