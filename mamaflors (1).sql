-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2024 at 08:30 AM
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
  `account_ID` int(11) NOT NULL,
  `created_date` date DEFAULT curdate(),
  `created_time` time DEFAULT curtime(),
  `password` varchar(50) NOT NULL,
  `role` enum('Regular','Administrator') DEFAULT 'Regular',
  `account_status` enum('Active','Inactive') DEFAULT 'Active'
) ;

-- --------------------------------------------------------

--
-- Table structure for table `assignment_attendance`
--

CREATE TABLE `assignment_attendance` (
  `assignment_ID` int(11) NOT NULL,
  `branch_ID` int(11) NOT NULL,
  `staff_ID` int(11) NOT NULL,
  `assign_date` date DEFAULT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `note` varchar(100) DEFAULT NULL,
  `attendance_status` enum('Present','Absent') DEFAULT NULL
) ;

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
(1, 'Tipolo', '2023-01-24', '', '', '', '', '', '', 'Active');

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
(9, 'testing', 'test', 123.00, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `salesreport`
--

CREATE TABLE `salesreport` (
  `report_ID` int(11) NOT NULL,
  `account_ID` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_ID` int(11) NOT NULL,
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
(1, 'Dabon', 'Dino', 'Azucenas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '0000-00-00', NULL, 'Active'),
(2, 'Dabon', 'Dino Cyrano', 'Azucenas', '628', 'M.L. Quezon', 'Maguikay', 'Mandaue', 'City', '6000', '2000-09-24', 'Male', '09955430188', '09323995999', 'dcdabon1231@gmail.com', '', '', 'Production Staff', '2024-01-24', 528.00, 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_ID`);

--
-- Indexes for table `assignment_attendance`
--
ALTER TABLE `assignment_attendance`
  ADD PRIMARY KEY (`assignment_ID`),
  ADD KEY `attendance_branch_FK` (`branch_ID`),
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
  ADD KEY `Report_Account_FK` (`account_ID`),
  ADD KEY `Report_Branch_FK` (`branch_ID`),
  ADD KEY `Report_Product_FK` (`product_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment_attendance`
--
ALTER TABLE `assignment_attendance`
  MODIFY `assignment_ID` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `report_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_FK` FOREIGN KEY (`account_ID`) REFERENCES `staff` (`staff_ID`);

--
-- Constraints for table `assignment_attendance`
--
ALTER TABLE `assignment_attendance`
  ADD CONSTRAINT `assignment_staff_FK` FOREIGN KEY (`staff_ID`) REFERENCES `staff` (`staff_ID`),
  ADD CONSTRAINT `attendance_branch_FK` FOREIGN KEY (`branch_ID`) REFERENCES `branch` (`branch_ID`);

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
