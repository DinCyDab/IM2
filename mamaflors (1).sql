-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2024 at 07:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mamaflors`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_ID` varchar(20) NOT NULL,
  `created_date` date DEFAULT curdate(),
  `created_time` time DEFAULT curtime(),
  `password` varchar(100) NOT NULL,
  `role` enum('Administrator','Owner','Regular') DEFAULT 'Regular',
  `account_status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_ID`, `created_date`, `created_time`, `password`, `role`, `account_status`) VALUES
('0001', '2024-07-16', '08:14:12', '$2y$10$mOl4sZWY.PhrM8pGP7wJge1rNHXO4SOcXvJZNMN6brsb0b7hkgD5K', 'Owner', 'Active'),
('0002', '2024-07-16', '09:57:07', '$2y$10$cYjVCBrLV6431dYfY2.Ru.2MqfBdfjVtPS0fe4KRUwBiESm4BrtfC', 'Administrator', 'Active'),
('0003', '2024-07-16', '10:15:38', '$2y$10$hjNoGWB3lKxriXcslXvg8euwA94o.tZcc/IKfLZZuk2oGSKsPQxDW', 'Regular', 'Active'),
('0004', '2024-07-16', '11:33:43', '$2y$10$BVmbOJUi1ldBqgb51Ie8Ie5yZLYWTrT3RkVP5hi6zgEEnLRrSsl7m', 'Regular', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `assignment_ID` int(11) NOT NULL,
  `branch_ID` int(11) DEFAULT NULL,
  `staff_ID` varchar(20) NOT NULL,
  `assignment_date` date DEFAULT NULL,
  `note` varchar(100) DEFAULT NULL,
  `assignment_status` enum('Present','Absent','Late','Off') DEFAULT 'Off',
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`assignment_ID`, `branch_ID`, `staff_ID`, `assignment_date`, `note`, `assignment_status`, `time_in`, `time_out`) VALUES
(187, NULL, '0001', '2024-07-17', NULL, 'Off', NULL, NULL),
(188, NULL, '0002', '2024-07-17', NULL, 'Off', NULL, NULL),
(190, NULL, '0001', '2024-07-18', NULL, 'Off', NULL, NULL),
(191, NULL, '0002', '2024-07-18', NULL, 'Off', NULL, NULL),
(192, NULL, '0003', '2024-07-18', NULL, 'Off', NULL, NULL),
(193, NULL, '0001', '2024-07-16', NULL, 'Off', NULL, NULL),
(195, 17, '0003', '2024-07-16', '', 'Late', '11:15:25', NULL),
(217, NULL, '0004', '2024-07-16', NULL, 'Off', NULL, NULL),
(218, NULL, '0003', '2024-07-17', NULL, 'Off', NULL, NULL),
(219, NULL, '0004', '2024-07-17', NULL, 'Off', NULL, NULL),
(220, 18, '0002', '2024-07-16', '', 'Late', '12:40:52', NULL),
(221, NULL, '0004', '2024-07-18', NULL, 'Off', NULL, NULL),
(222, NULL, '0001', '2024-07-09', NULL, 'Late', '08:00:24', NULL),
(223, NULL, '0002', '2024-07-09', NULL, 'Present', '07:02:15', NULL),
(224, NULL, '0003', '2024-07-09', NULL, 'Present', '07:57:00', NULL),
(225, NULL, '0004', '2024-07-09', NULL, 'Late', '12:52:00', NULL),
(226, NULL, '0001', '2024-07-10', NULL, 'Present', '07:00:24', NULL),
(227, NULL, '0002', '2024-07-10', NULL, 'Present', '08:01:00', NULL),
(228, NULL, '0003', '2024-07-10', NULL, 'Late', '08:00:24', NULL),
(229, NULL, '0004', '2024-07-10', NULL, 'Late', '13:00:13', NULL),
(230, NULL, '0001', '2024-07-11', NULL, 'Absent', NULL, NULL),
(231, NULL, '0002', '2024-07-11', NULL, 'Present', '07:00:24', NULL),
(232, NULL, '0003', '2024-07-11', NULL, 'Present', '07:00:24', NULL),
(233, NULL, '0004', '2024-07-11', NULL, 'Absent', NULL, NULL),
(234, NULL, '0001', '2024-07-12', NULL, 'Present', '07:00:24', NULL),
(235, NULL, '0002', '2024-07-12', NULL, 'Present', '07:00:24', NULL),
(236, NULL, '0003', '2024-07-12', NULL, 'Absent', NULL, NULL),
(237, NULL, '0004', '2024-07-12', NULL, 'Present', '07:00:24', NULL),
(238, NULL, '0001', '2024-07-13', NULL, 'Present', '07:00:24', NULL),
(239, NULL, '0002', '2024-07-13', NULL, 'Late', '08:00:24', NULL),
(240, NULL, '0003', '2024-07-13', NULL, 'Present', '07:00:24', NULL),
(241, NULL, '0004', '2024-07-13', NULL, 'Present', '07:00:24', NULL),
(242, NULL, '0001', '2024-07-14', NULL, 'Present', '07:00:24', NULL),
(243, NULL, '0002', '2024-07-14', NULL, 'Present', '07:00:24', NULL),
(244, NULL, '0003', '2024-07-14', NULL, 'Present', '07:00:24', NULL),
(245, NULL, '0004', '2024-07-14', NULL, 'Present', '07:00:24', NULL),
(246, NULL, '0001', '2024-07-15', NULL, 'Present', '07:00:24', NULL),
(247, NULL, '0002', '2024-07-15', NULL, 'Present', '07:00:24', NULL),
(248, NULL, '0003', '2024-07-15', NULL, 'Present', '07:00:24', NULL),
(249, NULL, '0004', '2024-07-15', NULL, 'Present', '07:00:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_ID` int(11) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `established_date` date DEFAULT NULL,
  `street_name` varchar(50) DEFAULT NULL,
  `barangay` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `postal_code` varchar(50) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `branch_status` enum('Active','Inactive') DEFAULT 'Active'
) ;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_ID`, `branch_name`, `established_date`, `street_name`, `barangay`, `city`, `province`, `postal_code`, `contact_number`, `branch_status`) VALUES
(16, 'Tipolo', '2022-02-02', 'Tipolo', '', 'Mandaue', 'Cebu', '6000', '09423881714', 'Active'),
(17, 'Lapu Lapu', '2023-03-03', 'Ubos', '', 'Lapu Lapu', 'Cebu', '6000', '09451235472', 'Active'),
(18, 'Tisa', '2024-05-24', 'Tisa', '', 'Cebu', 'Cebu', '6000', '09527369182', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_ID` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_description` varchar(100) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `product_status` enum('Active','Inactive') DEFAULT 'Active'
) ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_ID`, `product_name`, `product_description`, `product_price`, `product_status`) VALUES
(38, 'Lechon Manok', 'Grilled Chicken', 270.00, 'Active'),
(39, 'Liempo', 'Pork Liempo', 280.00, 'Active'),
(40, 'Lumpia', 'Spring Roll', 10.00, 'Active'),
(41, 'Fried Chicken', '', 30.00, 'Active'),
(42, 'Sisig', 'Pork Sisig', 35.00, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `salesreport`
--

CREATE TABLE `salesreport` (
  `report_ID` int(11) NOT NULL,
  `account_ID` varchar(20) NOT NULL,
  `branch_ID` int(11) NOT NULL,
  `product_ID` int(11) NOT NULL,
  `report_date` date DEFAULT curdate(),
  `report_time` time DEFAULT curtime(),
  `cooked_qty` int(11) DEFAULT NULL,
  `reheat_qty` int(11) DEFAULT NULL,
  `total_display_qty` int(11) DEFAULT NULL,
  `left_over_qty` int(11) DEFAULT NULL,
  `total_sold_qty` int(11) DEFAULT NULL,
  `status` enum('Pending','Confirmed') DEFAULT 'Pending',
  `estimated_revenue` decimal(10,2) DEFAULT NULL,
  `remittance` decimal(10,2) DEFAULT NULL,
  `pull_out_qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesreport`
--

INSERT INTO `salesreport` (`report_ID`, `account_ID`, `branch_ID`, `product_ID`, `report_date`, `report_time`, `cooked_qty`, `reheat_qty`, `total_display_qty`, `left_over_qty`, `total_sold_qty`, `status`, `estimated_revenue`, `remittance`, `pull_out_qty`) VALUES
(134, '0003', 17, 38, '2024-07-16', '12:06:25', 5, 5, 5, 5, 5, 'Confirmed', 1350.00, 1350.00, 5),
(135, '0003', 17, 39, '2024-07-16', '12:06:25', 5, 5, 5, 5, 5, 'Confirmed', 500.00, 500.00, 5),
(136, '0003', 17, 41, '2024-07-16', '12:18:02', 5, 5, 5, 5, 5, 'Confirmed', 150.00, 150.00, 5),
(137, '0004', 18, 41, '2024-07-11', '13:08:28', 10, 8, 18, 14, 4, 'Pending', NULL, 120.00, 0),
(138, '0004', 18, 38, '2024-07-11', '13:09:43', 2, 3, 5, 2, 3, 'Pending', NULL, 810.00, 0),
(139, '0004', 18, 40, '2024-07-11', '13:10:28', 10, 10, 20, 20, 0, 'Pending', NULL, 0.00, 0),
(140, '0003', 17, 38, '2024-07-15', '13:47:49', 5, 5, 5, 5, 5, 'Pending', NULL, 500.00, 5);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_ID` varchar(20) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `house_number` varchar(20) DEFAULT NULL,
  `street_name` varchar(50) DEFAULT NULL,
  `barangay` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `contact_1` varchar(20) DEFAULT NULL,
  `contact_2` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `SSN` varchar(50) DEFAULT NULL,
  `TIN` varchar(50) DEFAULT NULL,
  `position_title` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_ID`, `last_name`, `first_name`, `middle_name`, `house_number`, `street_name`, `barangay`, `city`, `province`, `postal_code`, `birth_date`, `gender`, `contact_1`, `contact_2`, `email`, `SSN`, `TIN`, `position_title`, `start_date`, `salary`, `status`) VALUES
('0001', 'Dabon', 'Dino Cyrano', 'Azucenas', '628', 'M.L. Quezon Street', 'Maguikay', 'Mandaue', 'Cebu', '6014', '2000-09-24', 'Male', '09955430188', '09323995999', 'dcdabon1231@gmail.com', '', '', 'Manager', '2024-07-16', 528.00, 'Active'),
('0002', 'Ramo', 'Justin', '', '257', 'Cabancalan', 'Porok 1', 'Mandaue', 'Cebu', '6000', '2004-01-01', 'Male', '09123456789', '', 'justinramo@gmail.com', '', '', 'Production', '2024-07-16', 528.00, 'Active'),
('0003', 'Linao', 'Carl Andrew', '', '512', 'Street Name', 'Barangay', 'Lapu Lapu', 'Cebu', '6000', '2004-02-02', 'Male', '09121231234', '', 'carlandrew@gmail.com', '', '', 'Staff', '2024-02-02', 528.00, 'Active'),
('0004', 'Calihog', 'Kenneth', '', '582', 'Street Name', 'Barangay', 'City', 'Province', '6000', '2004-07-05', 'Male', '09258271925', '', 'kennethcalihog@gmail.com', '', '', 'Staff', '2024-07-16', 528.00, 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_ID`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`assignment_ID`),
  ADD KEY `assignment_branch_FK` (`branch_ID`),
  ADD KEY `assignment_staff_FK` (`staff_ID`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_ID`);

--
-- Indexes for table `salesreport`
--
ALTER TABLE `salesreport`
  ADD PRIMARY KEY (`report_ID`),
  ADD KEY `Report_Branch_FK` (`branch_ID`),
  ADD KEY `Report_Product_FK` (`product_ID`),
  ADD KEY `Report_Account_FK` (`account_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `assignment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salesreport`
--
ALTER TABLE `salesreport`
  MODIFY `report_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_FK` FOREIGN KEY (`account_ID`) REFERENCES `staff` (`staff_ID`);

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_branch_FK` FOREIGN KEY (`branch_ID`) REFERENCES `branch` (`branch_ID`),
  ADD CONSTRAINT `assignment_staff_FK` FOREIGN KEY (`staff_ID`) REFERENCES `staff` (`staff_ID`);

--
-- Constraints for table `salesreport`
--
ALTER TABLE `salesreport`
  ADD CONSTRAINT `Report_Account_FK` FOREIGN KEY (`account_ID`) REFERENCES `account` (`account_ID`),
  ADD CONSTRAINT `Report_Branch_FK` FOREIGN KEY (`branch_ID`) REFERENCES `branch` (`branch_ID`),
  ADD CONSTRAINT `Report_Product_FK` FOREIGN KEY (`product_ID`) REFERENCES `product` (`product_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
