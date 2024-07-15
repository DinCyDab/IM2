-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2024 at 08:05 AM
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
  `role` enum('Regular','Administrator') DEFAULT 'Regular',
  `account_status` enum('Active','Inactive') DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_ID`, `created_date`, `created_time`, `password`, `role`, `account_status`) VALUES
('0001', '2024-06-28', '19:42:05', '$2y$10$IF7UGA69sIwxQ2Auc6W0BuTCdrnMT1KEE2qtZc3FMFY', 'Regular', 'Active'),
('0002', '2024-06-28', '19:47:58', '$2y$10$jfveeJ45dgeVJ9E.fg.7Gu0SOA9iBkE2O8.VcpzwU3W', 'Regular', 'Active'),
('0004', '2024-07-04', '19:44:16', '$2y$10$nlHDg1IYEcmfixnt6l4YaODLsWBgvRY/iPvU8TsPFqoSt.VRG2K/6', 'Regular', 'Active'),
('0005', '2024-07-05', '10:03:07', '$2y$10$Dy4WnIfKDI/8u5ibcpR0Hewjm5dYat9PwTUrQ08mV4BBuabp/T2VS', 'Administrator', 'Active');

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
(3, 3, '0003', '2024-07-04', '', 'Present', NULL, NULL),
(9, 1, '0002', '2024-07-04', 'late', 'Absent', NULL, NULL),
(17, 3, '0001', '2024-07-03', 'Too early', 'Present', NULL, NULL),
(18, NULL, '0002', '2024-07-03', NULL, NULL, NULL, NULL),
(19, NULL, '0003', '2024-07-03', NULL, NULL, NULL, NULL),
(29, NULL, '0001', '2024-07-05', NULL, NULL, NULL, NULL),
(30, NULL, '0002', '2024-07-05', NULL, NULL, NULL, NULL),
(31, 1, '0003', '2024-07-05', 'too early for time in', 'Present', NULL, NULL),
(33, 3, '0005', '2024-07-05', '', 'Present', '22:13:37', NULL),
(34, 1, '0001', '2024-07-06', '', 'Present', NULL, NULL),
(35, 3, '0002', '2024-07-06', '', 'Present', NULL, NULL),
(36, NULL, '0003', '2024-07-06', NULL, NULL, NULL, NULL),
(38, 1, '0005', '2024-07-06', '', 'Present', '22:13:37', NULL),
(39, 3, '0001', '2024-07-07', '', 'Present', NULL, NULL),
(40, NULL, '0002', '2024-07-07', NULL, NULL, NULL, NULL),
(41, NULL, '0003', '2024-07-07', NULL, NULL, NULL, NULL),
(43, NULL, '0005', '2024-07-07', NULL, NULL, '22:13:37', NULL),
(44, 3, '0001', '2024-08-08', NULL, NULL, NULL, NULL),
(45, 1, '0002', '2024-08-08', NULL, NULL, NULL, NULL),
(46, NULL, '0003', '2024-08-08', NULL, NULL, NULL, NULL),
(47, NULL, '0004', '2024-08-08', NULL, 'Present', '22:13:33', NULL),
(48, NULL, '0005', '2024-08-08', NULL, NULL, '22:13:37', NULL),
(69, NULL, '0001', '2024-07-01', NULL, NULL, NULL, NULL),
(70, NULL, '0002', '2024-07-01', NULL, NULL, NULL, NULL),
(71, NULL, '0003', '2024-07-01', NULL, NULL, NULL, NULL),
(72, 1, '0004', '2024-07-01', '', 'Present', '22:13:33', NULL),
(73, NULL, '0005', '2024-07-01', NULL, NULL, '22:13:37', NULL),
(74, NULL, '0001', '2024-07-02', NULL, NULL, NULL, NULL),
(75, NULL, '0002', '2024-07-02', NULL, NULL, NULL, NULL),
(76, NULL, '0003', '2024-07-02', NULL, NULL, NULL, NULL),
(77, 1, '0004', '2024-07-02', '', 'Present', '22:13:33', NULL),
(78, NULL, '0005', '2024-07-02', NULL, NULL, '22:13:37', NULL),
(82, 3, '0004', '2024-07-03', '', 'Present', '22:13:33', NULL),
(83, NULL, '0005', '2024-07-03', NULL, NULL, '22:13:37', NULL),
(84, NULL, '0001', '2024-07-04', NULL, NULL, NULL, NULL),
(87, 1, '0004', '2024-07-04', '', 'Present', '22:13:33', NULL),
(88, NULL, '0005', '2024-07-04', NULL, NULL, '22:13:37', NULL),
(89, NULL, '0001', '2024-07-29', NULL, NULL, NULL, NULL),
(90, NULL, '0002', '2024-07-29', NULL, NULL, NULL, NULL),
(91, NULL, '0003', '2024-07-29', NULL, NULL, NULL, NULL),
(92, NULL, '0004', '2024-07-29', NULL, 'Present', '22:13:33', NULL),
(93, NULL, '0005', '2024-07-29', NULL, NULL, '22:13:37', NULL),
(94, NULL, '0001', '2024-07-30', NULL, NULL, NULL, NULL),
(95, NULL, '0002', '2024-07-30', NULL, NULL, NULL, NULL),
(96, NULL, '0003', '2024-07-30', NULL, NULL, NULL, NULL),
(97, 1, '0004', '2024-07-30', '', 'Absent', '22:13:33', NULL),
(98, NULL, '0005', '2024-07-30', NULL, NULL, '22:13:37', NULL),
(99, NULL, '0001', '2024-07-31', NULL, NULL, NULL, NULL),
(100, NULL, '0002', '2024-07-31', NULL, NULL, NULL, NULL),
(101, NULL, '0003', '2024-07-31', NULL, NULL, NULL, NULL),
(102, NULL, '0004', '2024-07-31', NULL, 'Present', '22:13:33', NULL),
(103, NULL, '0005', '2024-07-31', NULL, NULL, '22:13:37', NULL),
(104, NULL, '0001', '2024-07-08', NULL, NULL, NULL, NULL),
(105, NULL, '0002', '2024-07-08', NULL, NULL, NULL, NULL),
(106, NULL, '0003', '2024-07-08', NULL, NULL, NULL, NULL),
(107, 1, '0004', '2024-07-08', '', 'Absent', '22:13:33', NULL),
(108, 3, '0005', '2024-07-08', '', 'Present', '22:13:37', NULL),
(115, 1, '0004', '2024-07-05', '', 'Present', '22:13:33', NULL),
(129, NULL, '0001', '2024-07-09', NULL, NULL, NULL, NULL),
(130, NULL, '0002', '2024-07-09', NULL, NULL, NULL, NULL),
(131, NULL, '0003', '2024-07-09', NULL, NULL, NULL, NULL),
(132, 14, '0004', '2024-07-09', '', 'Present', '22:13:33', NULL),
(133, 14, '0005', '2024-07-09', '', 'Absent', '22:13:37', NULL),
(134, NULL, '0001', '2024-07-10', NULL, NULL, NULL, NULL),
(135, NULL, '0002', '2024-07-10', NULL, NULL, NULL, NULL),
(136, NULL, '0003', '2024-07-10', NULL, NULL, NULL, NULL),
(137, 1, '0004', '2024-07-10', '', 'Absent', '22:13:33', NULL),
(138, NULL, '0005', '2024-07-10', NULL, NULL, '22:13:37', NULL),
(144, NULL, '0001', '2024-07-18', NULL, NULL, NULL, NULL),
(145, NULL, '0002', '2024-07-18', NULL, NULL, NULL, NULL),
(146, NULL, '0003', '2024-07-18', NULL, NULL, NULL, NULL),
(147, NULL, '0004', '2024-07-18', '', '', '22:13:33', NULL),
(148, NULL, '0005', '2024-07-18', NULL, NULL, '22:13:37', NULL),
(154, NULL, '0001', '2024-07-11', NULL, 'Absent', NULL, NULL),
(155, NULL, '0002', '2024-07-11', NULL, 'Absent', NULL, NULL),
(156, NULL, '0003', '2024-07-11', NULL, 'Absent', NULL, NULL),
(157, 3, '0004', '2024-07-11', 'Late', 'Present', '22:18:47', NULL),
(158, NULL, '0005', '2024-07-11', NULL, 'Absent', '22:13:37', NULL),
(159, NULL, '0001', '2024-07-12', NULL, 'Absent', NULL, NULL),
(160, NULL, '0002', '2024-07-12', NULL, 'Absent', NULL, NULL),
(161, NULL, '0003', '2024-07-12', NULL, 'Absent', NULL, NULL),
(162, 1, '0004', '2024-07-12', '', 'Present', '17:20:37', NULL),
(163, NULL, '0005', '2024-07-12', NULL, 'Present', '17:21:02', NULL),
(169, NULL, '0001', '2024-07-14', NULL, 'Absent', NULL, NULL),
(170, NULL, '0002', '2024-07-14', NULL, 'Absent', NULL, NULL),
(171, NULL, '0003', '2024-07-14', NULL, 'Absent', NULL, NULL),
(172, NULL, '0004', '2024-07-14', NULL, 'Absent', NULL, NULL),
(173, NULL, '0005', '2024-07-14', NULL, 'Absent', NULL, NULL),
(174, NULL, '0001', '2024-07-15', NULL, 'Absent', NULL, NULL),
(175, NULL, '0002', '2024-07-15', NULL, 'Absent', NULL, NULL),
(176, NULL, '0003', '2024-07-15', NULL, 'Absent', NULL, NULL),
(177, 1, '0004', '2024-07-15', '', 'Present', '09:08:30', NULL),
(178, NULL, '0005', '2024-07-15', NULL, 'Present', '09:09:58', NULL),
(179, NULL, '0001', '2024-07-13', NULL, 'Off', NULL, NULL),
(180, NULL, '0002', '2024-07-13', NULL, 'Off', NULL, NULL),
(181, NULL, '0003', '2024-07-13', NULL, 'Off', NULL, NULL),
(182, NULL, '0004', '2024-07-13', NULL, 'Off', NULL, NULL),
(183, NULL, '0005', '2024-07-13', NULL, 'Off', NULL, NULL);

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
(1, 'Tipolo', '2023-01-24', 'Tipolo Street', 'Maguikay', 'Mandaue', 'Cebu', '6014', '09123456789', 'Active'),
(3, 'Lapu Lapu', '2020-02-04', '', '', '', '', '', '', 'Active'),
(14, 'Ibabao', '0000-00-00', '', '', '', '', '', '', 'Active');

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
(10, 'Liempoer', 'Baboy na Liemp', 300.00, 'Active'),
(11, 'Spring Rolls', 'Spring Rolled', 10.00, 'Active'),
(12, 'Chicken', 'Gi luto na Chicken', 270.00, 'Active');

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
(26, '0004', 1, 10, '2024-06-20', '18:15:43', 20, 10, 10, 10, 25, 'Confirmed', 7500.00, NULL, NULL),
(28, '0005', 3, 10, '2024-07-05', '19:08:23', 15, 5, 5, 5, 15, 'Confirmed', 4500.00, NULL, NULL),
(104, '0004', 1, 10, '2024-07-08', '22:44:48', 5, 5, 5, 5, 5, 'Confirmed', 1500.00, NULL, NULL),
(105, '0004', 1, 12, '2024-07-08', '22:44:48', 5, 5, 5, 5, 5, 'Confirmed', 1350.00, NULL, NULL),
(118, '0004', 1, 10, '2024-07-09', '12:50:14', 5, 5, 5, 5, 5, 'Confirmed', 1500.00, 1500.00, 5),
(121, '0004', 1, 10, '2024-07-09', '13:30:51', 5, 5, 5, 5, 5, 'Confirmed', 1500.00, 5.00, 5),
(122, '0004', 1, 11, '2024-07-09', '13:30:51', 5, 5, 5, 5, 5, 'Confirmed', 5.00, 5.00, 55),
(123, '0004', 14, 10, '2024-07-09', '23:01:52', 5, 5, 5, 5, 5, 'Confirmed', 1500.00, 5.00, 5),
(124, '0004', 14, 11, '2024-07-09', '23:01:52', 5, 5, 5, 5, 5, 'Confirmed', 50.00, 5.00, 5),
(132, '0004', 1, 12, '2024-07-12', '17:20:58', 5, 5, 5, 5, 5, 'Confirmed', 5.00, 5.00, 5),
(133, '0004', 1, 11, '2024-07-15', '12:17:44', 5, 5, 5, 5, 5, 'Confirmed', 50.00, 5.00, 5);

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
('0003', 'test', 'test', 'test', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '0000-00-00', 0.00, 'Active'),
('0004', 'testing', 'testing', 'testing', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '0000-00-00', 0.00, 'Active'),
('0005', 'dab', 'dab', 'd', '', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '0000-00-00', 0.00, 'Active');

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
  MODIFY `assignment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

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
  MODIFY `report_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

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
