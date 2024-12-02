-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 02, 2024 at 12:39 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `our_cafeteria`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `Account_ID` int NOT NULL AUTO_INCREMENT,
  `Voucher_ID` int NOT NULL,
  `Expense` decimal(10,2) NOT NULL,
  `Salary` decimal(10,2) NOT NULL,
  PRIMARY KEY (`Account_ID`),
  KEY `Voucher_ID` (`Voucher_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
CREATE TABLE IF NOT EXISTS `bill` (
  `Bill_ID` int NOT NULL AUTO_INCREMENT,
  `Order_ID` int DEFAULT NULL,
  `Total_Amount` decimal(10,2) DEFAULT NULL,
  `Bill_Date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Bill_ID`),
  KEY `Order_ID` (`Order_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`Bill_ID`, `Order_ID`, `Total_Amount`, `Bill_Date`) VALUES
(1, 2, 15.00, '2024-11-13 22:11:57'),
(2, 2, 15.00, '2024-11-13 23:18:49'),
(3, 2, 15.00, '2024-11-13 23:18:56'),
(4, 2, 15.00, '2024-11-13 23:19:07'),
(5, 2, 15.00, '2024-11-13 23:19:21'),
(6, 2, 15.00, '2024-11-13 23:19:30'),
(7, 2, 15.00, '2024-11-13 23:42:52'),
(8, 3, 165.00, '2024-11-13 23:45:48'),
(9, 3, 165.00, '2024-11-14 13:03:00'),
(10, 2, 15.00, '2024-11-15 20:16:48'),
(11, 3, 165.00, '2024-11-19 15:57:19'),
(12, 4, 165.00, '2024-11-19 16:00:06'),
(13, 5, 15.00, '2024-11-21 20:46:33'),
(14, 6, 30.00, '2024-11-21 21:15:16'),
(15, 6, 30.00, '2024-11-21 21:21:34'),
(16, 7, 30.00, '2024-11-21 21:38:38'),
(17, 8, 55.00, '2024-11-22 22:37:33'),
(18, 10, 20.00, '2024-11-22 22:51:30'),
(19, 10, 20.00, '2024-11-22 23:09:07'),
(20, 10, 20.00, '2024-11-22 23:11:28'),
(21, 10, 20.00, '2024-11-22 23:13:24'),
(22, 10, 20.00, '2024-11-22 23:15:42'),
(23, 10, 20.00, '2024-11-22 23:16:39'),
(24, 10, 20.00, '2024-11-22 23:17:41'),
(25, 10, 20.00, '2024-11-22 23:23:50'),
(26, 10, 20.00, '2024-11-22 23:24:01'),
(27, 3, 165.00, '2024-11-22 23:26:22'),
(28, 3, 165.00, '2024-11-22 23:26:41'),
(29, 3, 165.00, '2024-11-22 23:26:52'),
(30, 2, 15.00, '2024-11-22 23:29:30'),
(31, 2, 15.00, '2024-11-22 23:30:11'),
(32, 2, 15.00, '2024-11-22 23:30:59'),
(33, 3, 165.00, '2024-11-22 23:37:06'),
(34, 3, 165.00, '2024-11-22 23:39:21'),
(35, 11, 10.00, '2024-11-22 23:46:17'),
(36, 12, 25.00, '2024-11-22 23:49:07'),
(37, 13, 20.00, '2024-11-22 23:51:51'),
(38, 14, 20.00, '2024-11-22 23:55:16'),
(39, 15, 20.00, '2024-11-23 00:02:19'),
(40, 19, 20.00, '2024-11-23 19:27:55'),
(41, 21, 100.00, '2024-11-23 19:41:22'),
(42, 24, 90.00, '2024-11-24 10:54:02'),
(43, 28, 90.00, '2024-11-27 18:43:53'),
(44, 29, 90.00, '2024-11-27 18:57:20'),
(45, 28, 90.00, '2024-11-27 19:11:29'),
(46, 26, 20.00, '2024-11-27 19:12:00'),
(47, 28, 90.00, '2024-11-27 19:14:47'),
(48, 28, 90.00, '2024-11-27 19:15:25'),
(49, 22, 100.00, '2024-11-27 19:15:31'),
(50, 23, 100.00, '2024-11-27 19:15:37'),
(51, 23, 100.00, '2024-11-27 19:19:17'),
(52, 31, 90.00, '2024-11-27 19:19:23'),
(53, 32, 90.00, '2024-11-27 19:22:15'),
(54, 31, 90.00, '2024-11-27 19:57:58'),
(55, 31, 90.00, '2024-11-27 19:58:42'),
(56, 34, 90.00, '2024-11-27 20:03:14'),
(57, 35, 20.00, '2024-12-01 12:33:16'),
(58, 36, 90.00, '2024-12-02 09:20:08'),
(59, 26, 20.00, '2024-12-02 09:55:33'),
(60, 37, 90.00, '2024-12-02 10:05:09');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `Customer_ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `Phone_Number` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`Customer_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_ID`, `Name`, `Phone_Number`) VALUES
(1, 'Nahid Hasan', '01311348672'),
(2, 'Nayon', '01355555555'),
(3, 'Jahid Hasan', '01844865303'),
(4, 'Sanjid Hasan', '01355868488'),
(5, 'Ratul Hasan', '01308001812'),
(6, 'Jubair Hasan', '01501212122'),
(11, 'Hera Sharma', '01797100698'),
(9, 'Fahim Hasan', '01581818418'),
(10, 'Roman Hasan', '01585857878'),
(12, 'Pranto', '01355585858');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `Menu_ID` int NOT NULL AUTO_INCREMENT,
  `Category` varchar(50) DEFAULT NULL,
  `Item_Name` varchar(100) DEFAULT NULL,
  `Availability` enum('yes','no') DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`Menu_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`Menu_ID`, `Category`, `Item_Name`, `Availability`, `Price`) VALUES
(1, 'Lunch', 'Rice', 'no', 15.00),
(2, 'Drink', 'Mojo', 'yes', 20.00),
(3, 'Breakfast', 'Parata', 'yes', 5.00),
(4, 'Lunch', 'Mutton', 'no', 150.00),
(5, 'Dinner', 'Birini', 'yes', 70.00),
(6, 'Breakfast', 'Pasta', 'yes', 40.00);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `Order_ID` int NOT NULL AUTO_INCREMENT,
  `Order_Date_Time` datetime NOT NULL,
  `Table_Number` int NOT NULL,
  `Status` enum('Pending','Completed','Cancelled') DEFAULT 'Pending',
  `Feedback` text,
  `Customer_ID` int DEFAULT NULL,
  PRIMARY KEY (`Order_ID`),
  KEY `Customer_ID` (`Customer_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`Order_ID`, `Order_Date_Time`, `Table_Number`, `Status`, `Feedback`, `Customer_ID`) VALUES
(1, '2024-11-13 19:23:34', 8, '', 'Nice', 1),
(2, '2024-11-13 22:10:02', 1, '', 'nice', 1),
(3, '2024-11-13 23:45:36', 7, '', 'Age khai', 1),
(4, '2024-11-19 15:59:52', 7, '', 'pore bolbo', 2),
(10, '2024-11-22 16:50:10', 5, '', 'Not Bad', 3),
(13, '2024-11-22 17:50:56', 6, '', 'Good', 1),
(14, '2024-11-22 17:55:05', 8, '', 'Very Nice', 2),
(28, '2024-11-27 12:41:43', 2, 'Pending', 'Nice', 5),
(16, '2024-11-22 18:04:56', 8, '', 'Super', 1),
(17, '2024-11-22 18:05:04', 8, '', NULL, 2),
(18, '2024-11-22 18:40:24', 8, '', NULL, 2),
(19, '2024-11-23 13:27:40', 5, '', NULL, 1),
(20, '2024-11-23 13:32:30', 1, '', NULL, 2),
(21, '2024-11-23 13:41:07', 9, '', 'Joss', 2),
(22, '2024-11-23 13:51:41', 9, 'Pending', NULL, 2),
(23, '2024-11-23 13:51:45', 9, 'Pending', NULL, 2),
(24, '2024-11-23 14:10:35', 6, '', NULL, 3),
(26, '2024-11-25 04:52:18', 18, '', NULL, 4),
(31, '2024-11-27 13:18:17', 1, 'Pending', 'Nice', 8),
(29, '2024-11-27 12:56:29', 1, '', 'Nice', 6),
(32, '2024-11-27 13:21:38', 1, '', 'Nice', 9),
(33, '2024-11-27 13:56:51', 1, 'Pending', NULL, 10),
(34, '2024-11-27 14:02:54', 1, '', NULL, 11),
(35, '2024-12-01 06:32:17', 18, '', NULL, 12),
(36, '2024-12-02 03:17:39', 1, 'Pending', NULL, 6),
(37, '2024-12-02 04:04:06', 1, '', NULL, 11);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `Order_Item_ID` int NOT NULL AUTO_INCREMENT,
  `Order_ID` int DEFAULT NULL,
  `Menu_ID` int DEFAULT NULL,
  `Quantity` int DEFAULT NULL,
  PRIMARY KEY (`Order_Item_ID`),
  KEY `Order_ID` (`Order_ID`),
  KEY `Menu_ID` (`Menu_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`Order_Item_ID`, `Order_ID`, `Menu_ID`, `Quantity`) VALUES
(1, 2, 1, 1),
(2, 3, 1, 1),
(3, 3, 4, 1),
(4, 4, 3, 3),
(5, 4, 4, 1),
(6, 5, 1, 1),
(7, 6, 2, 1),
(8, 6, 3, 2),
(9, 7, 2, 1),
(10, 7, 3, 2),
(11, 8, 2, 2),
(12, 8, 3, 3),
(13, 9, 2, 1),
(14, 10, 2, 1),
(15, 11, 3, 2),
(16, 12, 2, 1),
(17, 12, 3, 1),
(18, 13, 2, 1),
(19, 14, 2, 1),
(20, 15, 2, 1),
(21, 16, 2, 1),
(22, 19, 2, 1),
(23, 20, 3, 1),
(24, 21, 2, 5),
(25, 22, 2, 5),
(26, 23, 2, 5),
(27, 24, 2, 1),
(28, 24, 5, 1),
(29, 25, 2, 50),
(30, 26, 2, 1),
(31, 28, 2, 1),
(32, 28, 5, 1),
(33, 29, 2, 1),
(34, 29, 5, 1),
(35, 31, 2, 1),
(36, 31, 5, 1),
(37, 32, 2, 1),
(38, 32, 5, 1),
(39, 34, 2, 1),
(40, 34, 5, 1),
(41, 35, 2, 1),
(42, 36, 2, 1),
(43, 36, 5, 1),
(44, 37, 2, 1),
(45, 37, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `Staff_ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `Role` varchar(50) DEFAULT NULL,
  `Availability` enum('yes','no') DEFAULT NULL,
  `Salary` decimal(10,2) DEFAULT NULL,
  `Phone_Number` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`Staff_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`Staff_ID`, `Name`, `Role`, `Availability`, `Salary`, `Phone_Number`) VALUES
(3, 'Hera Sharma', 'Waiter', 'yes', 200.00, '01333333333'),
(2, 'Nahid Hasan', 'Owner', 'yes', 0.00, '01311348672'),
(4, 'Mohaiminul Islam', 'Boss', 'yes', 2500.00, '01568585698');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

DROP TABLE IF EXISTS `voucher`;
CREATE TABLE IF NOT EXISTS `voucher` (
  `Voucher_ID` int NOT NULL AUTO_INCREMENT,
  `Date` date DEFAULT NULL,
  `Type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Voucher_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voucher_element`
--

DROP TABLE IF EXISTS `voucher_element`;
CREATE TABLE IF NOT EXISTS `voucher_element` (
  `Ingredient_ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `Quantity` decimal(10,2) DEFAULT NULL,
  `Unit_Price` decimal(10,2) DEFAULT NULL,
  `Purchase_Date` date DEFAULT NULL,
  PRIMARY KEY (`Ingredient_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
