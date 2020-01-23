-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 20, 2020 at 03:46 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phonetech_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bid_tb`
--

CREATE TABLE `bid_tb` (
  `id` int(11) NOT NULL,
  `problem_id` int(11) NOT NULL,
  `tech_id` int(11) NOT NULL,
  `repairdays` varchar(50) NOT NULL,
  `currentdate` date DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bid_tb`
--

INSERT INTO `bid_tb` (`id`, `problem_id`, `tech_id`, `repairdays`, `currentdate`, `status`) VALUES
(2, 9, 19, '1', '2019-12-18', 'inactive'),
(3, 3, 0, '3', '2019-12-18', 'inactive'),
(4, 4, 7, '3', '2019-12-18', 'inactive'),
(5, 5, 0, '10', '2019-12-18', 'inactive'),
(6, 6, 0, '5', '2019-12-18', 'inactive'),
(7, 7, 0, '10', '2019-12-18', 'inactive'),
(8, 2, 0, '2', '2019-12-18', 'inactive'),
(9, 3, 0, '1', '2019-12-18', 'inactive'),
(10, 4, 0, '9', '2019-12-18', 'inactive'),
(11, 7, 0, '2', '2019-12-18', 'inactive'),
(36, 8, 2, '2', '2020-01-20', 'inactive'),
(37, 8, 19, '10', '2020-01-20', 'inactive'),
(38, 8, 1, '5', '2020-01-20', 'inactive'),
(39, 12, 19, '1', '2020-01-20', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `customer_account`
--

CREATE TABLE `customer_account` (
  `Customer_ID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `type` varchar(255) NOT NULL,
  `ContactNumber` varchar(255) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_account`
--

INSERT INTO `customer_account` (`Customer_ID`, `FirstName`, `LastName`, `Username`, `Password`, `type`, `ContactNumber`, `Email`, `Address`, `status`) VALUES
(1, 'Mark', 'Zuck', 'tech22', '123', 'Technician', '12', 'technician@gmail.com', 'Secret', 'Active'),
(2, 'Tania', 'Manaya', 'tech2', '123', 'Technician', '2147483647', 'jepp@gmail.com', 'baliwasan', 'Active'),
(3, 'piolo', 'richards', 'sample', '123', 'Customer', '2147483647', 'sample@gmail.com', 'baliwasan', 'Active'),
(4, 'Steve', 'Jobs', 'admin', 'admin', 'Administrator', '639152401964', 'phonetech.zam@gmail.com', 'baliwasan', 'Active'),
(7, 'Ramon', 'Suzuki', 'customer1', '123', 'Customer', '639152401964', 'customer1@gmail.com', '123', 'Active'),
(8, 'Yamaha', ' Uzamaki', 'technician1', '123', 'Technician', '639152401964', 'technician1@gmail.com', '123', 'Active'),
(10, 'Adrian', 'Sanoapo', 'test', '123', 'Technician', '639152401964', 'admiN@gmail.com', '12312', 'Active'),
(11, 'Larry', 'Bird', 'test2', '123', 'Technician', '639152401964', 'customer1@gmail.com', '123', 'Active'),
(19, 'Axl', 'Cuyugan', 'axlcuyugan', '123', 'Technician', '639152401964', 'axlcuyugan05@gmail.com', '12312', 'Active'),
(20, 'ramon', 'magsaysay', 'magsaysay', '123', 'Technician', '9123981239', 'asd@gmail.com', '12124', 'Pending'),
(21, 'technician', 'customer1', 'admin123', '123', 'Technician', '123', 'axlcuyugan05@gmail.com', '123', 'Pending'),
(22, 'technician', '12', 'admin1234', '123', 'Technician', '0915240196', 'axlcuyugan05@gmail.com', '123', 'Pending'),
(23, 'technician1', 'qwe', 'axlcuyugan123', '123', 'Technician', '123', 'customer1@gmail.com', '12312', 'Pending'),
(24, 'technician', 'Cuyugan', 'axlcuyugan12312312', '123', 'Technician', '9152401964', 'customer1@gmail.com', '123', 'Pending'),
(25, 'technician', 'customer1', 'axlcuyugan123123', '123', 'Technician', '0915240196', 'customer1@gmail.com', '123', 'Pending'),
(26, 'Axl', 'customer1', 'customer1123123', '123', 'Customer', '0915240196', 'customer1@gmail.com', '123', 'Active'),
(27, 'customer1', 'customer1', 'customer1123123123', '123', 'Technician', '0915240196', 'customer1@gmail.com', '123', 'Pending'),
(28, 'Axl', 'customer1', 'customer1123123123123', '123', 'Technician', '0915240196', 'customer1@gmail.com', 'Secret', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `payment_breakdown`
--

CREATE TABLE `payment_breakdown` (
  `id` int(11) NOT NULL,
  `bid_id` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `descr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_breakdown`
--

INSERT INTO `payment_breakdown` (`id`, `bid_id`, `price`, `descr`) VALUES
(34, 2, '400', 'Service Fee'),
(35, 2, '100', 'materials'),
(37, 36, '200', 'materials'),
(38, 36, '300', 'service fee'),
(39, 37, '200', 'materials'),
(40, 37, '100', 'Service Fee'),
(41, 38, '500', 'materials'),
(42, 38, '1000', 'Service'),
(43, 39, '12312', 'materials');

-- --------------------------------------------------------

--
-- Table structure for table `problem_tb`
--

CREATE TABLE `problem_tb` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tech_id` int(11) DEFAULT NULL,
  `serialNumber` varchar(255) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `problem` varchar(50) NOT NULL,
  `currentdate` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'No Technician'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `problem_tb`
--

INSERT INTO `problem_tb` (`id`, `user_id`, `tech_id`, `serialNumber`, `brand`, `problem`, `currentdate`, `status`) VALUES
(2, 3, 19, 'ZPZA34ICIM', 'samsung', 'screen', '2020-01-20 22:39:39', 'Finished'),
(3, 3, 0, '1S9ABCON4R', 'samsung', 'Screen', '2020-01-18 18:44:37', 'No Technician'),
(4, 7, 0, 'D4ACXKSRFY', 'samsung', 'Screen', '2020-01-18 18:44:37', 'No Technician'),
(5, 7, 0, '19CBVLI2YB', 'samsung', 'Screen', '2020-01-18 18:44:37', 'No Technician'),
(6, 7, 0, '8ADMBSDL9Q', 'Iphone', 'LCD', '2020-01-18 18:44:37', 'No Technician'),
(7, 7, 0, '87E3DZQEZN', 'Iphone', 'Motherboard', '2020-01-18 18:44:37', 'No Technician'),
(8, 7, 1, 'UW739YSXNM', 'samsung', 'LCD broken', '2020-01-20 21:43:02', 'In Progress'),
(9, 7, 19, '8WIDNS82', 'Iphone 11', 'Too expensive to handle', '2020-01-20 21:39:28', 'In Progress'),
(10, 7, 0, 'wh', 'uhh', 'sdqw', '2020-01-19 16:57:16', 'No Technician'),
(11, 7, 0, 'wh', 'Iphone 11', 'Too expensive to handle', '2020-01-19 04:35:29', 'No Technician'),
(12, 7, 19, '123123QWEQWE', 'Huwawawei', 'Too expensive to handle', '2020-01-20 22:39:14', 'In Progress');

-- --------------------------------------------------------

--
-- Table structure for table `rating_tb`
--

CREATE TABLE `rating_tb` (
  `id` int(11) NOT NULL,
  `problem_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating_tb`
--

INSERT INTO `rating_tb` (`id`, `problem_id`, `rating`, `comment`) VALUES
(1, 9, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis'),
(2, 8, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bid_tb`
--
ALTER TABLE `bid_tb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `problem_id` (`problem_id`);

--
-- Indexes for table `customer_account`
--
ALTER TABLE `customer_account`
  ADD PRIMARY KEY (`Customer_ID`);

--
-- Indexes for table `payment_breakdown`
--
ALTER TABLE `payment_breakdown`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bid_id` (`bid_id`);

--
-- Indexes for table `problem_tb`
--
ALTER TABLE `problem_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating_tb`
--
ALTER TABLE `rating_tb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `problem_id` (`problem_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bid_tb`
--
ALTER TABLE `bid_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `customer_account`
--
ALTER TABLE `customer_account`
  MODIFY `Customer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `payment_breakdown`
--
ALTER TABLE `payment_breakdown`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `problem_tb`
--
ALTER TABLE `problem_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rating_tb`
--
ALTER TABLE `rating_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bid_tb`
--
ALTER TABLE `bid_tb`
  ADD CONSTRAINT `bid_tb_ibfk_1` FOREIGN KEY (`problem_id`) REFERENCES `problem_tb` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_breakdown`
--
ALTER TABLE `payment_breakdown`
  ADD CONSTRAINT `payment_breakdown_ibfk_1` FOREIGN KEY (`bid_id`) REFERENCES `bid_tb` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rating_tb`
--
ALTER TABLE `rating_tb`
  ADD CONSTRAINT `rating_tb_ibfk_1` FOREIGN KEY (`problem_id`) REFERENCES `problem_tb` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
