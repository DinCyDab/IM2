-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2024 at 11:17 AM
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
  `password` varchar(50) NOT NULL,
  `role` enum('Regular','Administrator') DEFAULT 'Regular',
  `account_status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_ID`, `created_date`, `created_time`, `password`, `role`, `account_status`) VALUES
('0001', '2024-06-28', '19:42:05', '$2y$10$IF7UGA69sIwxQ2Auc6W0BuTCdrnMT1KEE2qtZc3FMFY', 'Regular', 'Active'),
('0002', '2024-06-28', '19:47:58', '$2y$10$jfveeJ45dgeVJ9E.fg.7Gu0SOA9iBkE2O8.VcpzwU3W', 'Regular', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `assignment_ID` int(11) NOT NULL,
  `branch_ID` int(11) DEFAULT NULL,
  `staff_ID` varchar(20) NOT NULL,
  `assignment_date` date DEFAULT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `note` varchar(100) DEFAULT NULL,
  `assignment_status` enum('Present','Absent') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`assignment_ID`, `branch_ID`, `staff_ID`, `assignment_date`, `time_in`, `time_out`, `note`, `assignment_status`) VALUES
(3, 3, '0003', '2024-07-04', '00:00:00', '00:00:00', '', 'Present'),
(9, 3, '0002', '2024-07-04', '16:16:00', '04:16:00', 'late', 'Present'),
(17, 3, '0001', '2024-07-03', '08:57:00', '16:57:00', 'Too early', 'Present'),
(18, NULL, '0002', '2024-07-03', NULL, NULL, NULL, NULL),
(19, NULL, '0003', '2024-07-03', NULL, NULL, NULL, NULL),
(20, NULL, '0001', '2024-07-05', NULL, NULL, NULL, NULL),
(21, NULL, '0003', '2024-07-05', NULL, NULL, NULL, NULL),
(22, 1, '0001', '2024-07-12', '00:00:00', '00:00:00', '', 'Present'),
(23, NULL, '0002', '2024-07-12', NULL, NULL, NULL, NULL),
(24, NULL, '0003', '2024-07-12', NULL, NULL, NULL, NULL);

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
(1, 'tipolo', '2023-01-24', 'Tipolo Street', 'Maguikay', 'Mandaue', 'Cebu', '6014', '09123456789', 'Active'),
(3, 'Test Branch', '2020-02-04', '', '', '', '', '', '', 'Active');

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
(10, 'Liempoer', 'TESTing', 300.00, 'Active'),
(11, 'Spring Rolls', 'Spring Roller', 10.00, 'Active'),
(12, 'Chicken', 'Chickenazor', 250.00, 'Active');

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
  `total_sold_qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salesreport`
--

INSERT INTO `salesreport` (`report_ID`, `account_ID`, `branch_ID`, `product_ID`, `report_date`, `report_time`, `cooked_qty`, `reheat_qty`, `total_display_qty`, `left_over_qty`, `total_sold_qty`) VALUES
(9, '0001', 1, 10, '2024-06-30', '14:50:57', 5, 5, 5, 5, 5),
(10, '0001', 1, 11, '2024-06-30', '14:50:57', 5, 5, 5, 5, 5),
(11, '0001', 1, 12, '2024-06-30', '14:50:57', 5, 5, 5, 5, 5),
(12, '0001', 1, 11, '2024-06-30', '15:13:50', 20, 20, 20, 2, 2),
(13, '0001', 1, 12, '2024-06-30', '15:13:50', 2, 2, 2, 2, 2),
(14, '0001', 1, 10, '2024-06-30', '15:15:21', 5, 5, 5, 5, 5),
(15, '0001', 1, 10, '2024-06-30', '15:15:43', 5, 5, 5, 5, 5),
(16, '0002', 3, 10, '2024-06-30', '15:37:01', 40, 2, 2, 2, 2),
(17, '0002', 3, 10, '2024-06-30', '19:21:08', 5, 5, 5, 5, 5),
(18, '0002', 3, 11, '2024-06-30', '19:21:08', 5, 5, 5, 5, 5),
(19, '0002', 3, 12, '2024-06-30', '19:21:08', 5, 55, 5, 5, 5);

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
('0001', 'Dabon', 'Dino Cyrano', 'Azucenas', '628', 'M.L. Quezon', 'Maguikay', 'Mandaue', 'Cebu', '6014', '2000-09-24', 'Male', '09955430188', '09323995999', 'dcdabon1231@gmail.com', '', '', 'Production', '2024-06-28', 528.00, 'Active'),
('0002', 'Test', 'Testing', 'Test', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '0000-00-00', 0.00, 'Active'),
('0003', 'test', 'test', 'test', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '0000-00-00', 0.00, 'Active');

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
  MODIFY `assignment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  MODIFY `report_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
