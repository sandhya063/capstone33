-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2024 at 03:15 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jewelry_shop_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `Id` int(50) NOT NULL,
  `Unit_no` int(10) NOT NULL,
  `Address_line_1` varchar(50) NOT NULL,
  `Address_line_2` varchar(50) DEFAULT NULL,
  `City` varchar(20) NOT NULL,
  `Region` varchar(20) NOT NULL,
  `Postcode` varchar(10) NOT NULL,
  `Country` varchar(20) NOT NULL,
  `User_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`Id`, `Unit_no`, `Address_line_1`, `Address_line_2`, `City`, `Region`, `Postcode`, `Country`, `User_id`) VALUES
(1, 101, '123 Main St', 'Apt 1', 'New York', 'NY', '10001', 'USA', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id` int(50) NOT NULL,
  `Type` varchar(20) NOT NULL DEFAULT 'Admin'
) ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id`, `Type`) VALUES
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Id` int(50) NOT NULL,
  `Type` varchar(20) NOT NULL DEFAULT 'Customer'
) ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Id`, `Type`) VALUES
(1, 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Id` int(50) NOT NULL,
  `User_id` int(50) DEFAULT NULL,
  `Total_price` float NOT NULL,
  `Order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `Status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Id`, `User_id`, `Total_price`, `Order_date`, `Status`) VALUES
(1, 1, 500, '2022-02-09 15:45:00', 'Pending'),
(2, 2, 150, '2022-02-09 16:00:00', 'Shipped');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `Id` int(50) NOT NULL,
  `Order_id` int(50) DEFAULT NULL,
  `Product_id` int(50) DEFAULT NULL,
  `Quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`Id`, `Order_id`, `Product_id`, `Quantity`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `Id` int(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1,
  `Delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `Date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `Date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`Id`, `Name`, `Description`, `Status`, `Delete_flag`, `Date_created`, `Date_updated`) VALUES
(1, 'Rings', 'A variety of gold, silver, and diamond rings.', 1, 0, '2022-02-09 13:05:12', '2022-02-09 14:31:40'),
(2, 'Necklaces', 'Elegant necklaces for all occasions.', 1, 0, '2022-02-09 13:05:12', '2022-02-09 14:31:40');

-- --------------------------------------------------------

--
-- Table structure for table `product_item`
--

CREATE TABLE `product_item` (
  `Id` int(50) NOT NULL,
  `Category_id` int(50) DEFAULT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Price` float NOT NULL DEFAULT 0,
  `Image_path` varchar(255) DEFAULT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT 1,
  `Delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `Date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `Date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_item`
--

INSERT INTO `product_item` (`Id`, `Category_id`, `Name`, `Description`, `Price`, `Image_path`, `Status`, `Delete_flag`, `Date_created`, `Date_updated`) VALUES
(1, 1, 'Gold Ring', '18k gold ring with diamond.', 499, 'img/jewelry/gold_ring.jpg', 1, 0, '2022-02-09 13:05:12', '2024-06-01 00:44:45'),
(2, 2, 'Pearl Necklace', 'Elegant pearl necklace.', 150, 'img/jewelry/pearl_necklace.jpg', 1, 0, '2022-02-09 13:05:12', '2022-02-09 14:31:40');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `Id` int(50) NOT NULL,
  `Customer_id` int(50) NOT NULL,
  `Shop_order_id` int(50) NOT NULL,
  `Rating` int(10) NOT NULL,
  `Comment` text NOT NULL,
  `Date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`Id`, `Customer_id`, `Shop_order_id`, `Rating`, `Comment`, `Date_created`) VALUES
(1, 1, 1, 5, 'Great service and fast delivery! The product quality is also excellent.', '2024-05-31 00:04:07');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `Id` int(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone_no` varchar(20) NOT NULL,
  `Supplied_item` varchar(50) NOT NULL,
  `Unit_no` int(10) NOT NULL,
  `Address_line_1` varchar(50) NOT NULL,
  `Address_line_2` varchar(50) DEFAULT NULL,
  `City` varchar(20) NOT NULL,
  `Region` varchar(20) NOT NULL,
  `Postcode` varchar(10) NOT NULL,
  `Country` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`Id`, `Name`, `Email`, `Phone_no`, `Supplied_item`, `Unit_no`, `Address_line_1`, `Address_line_2`, `City`, `Region`, `Postcode`, `Country`) VALUES
(1, 'Gold Suppliers Inc.', 'contact@goldsuppliers.com', '5551234567', 'Gold', 100, '789 Gold St', '', 'Denver', 'CO', '80201', 'USA');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `FName` varchar(50) NOT NULL,
  `LName` varchar(50) NOT NULL,
  `Phone_no` varchar(20) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `FName`, `LName`, `Phone_no`, `Password`, `Email`, `Type`, `gender`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Test', 'User', '1234567890', 'Test123', 'testuser@example.com', 'Customer', 'Male', 0, '2022-02-09 11:03:40', '2024-05-30 22:22:27'),
(2, 'Saksesh', 'Bartaula', '0449706306', '10062000', 'k200576@student.kent.edu.au', 'Admin', 'Male', 0, '2022-02-09 11:03:40', '2024-05-30 22:24:05');

-- --------------------------------------------------------

--
-- Table structure for table `variation`
--

CREATE TABLE `variation` (
  `Id` int(50) NOT NULL,
  `Product_id` int(50) DEFAULT NULL,
  `Name` varchar(100) NOT NULL,
  `Value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `variation`
--

INSERT INTO `variation` (`Id`, `Product_id`, `Name`, `Value`) VALUES
(1, 1, 'Size', '6'),
(2, 1, 'Size', '7'),
(3, 2, 'Length', '18 inches');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `User_id` (`User_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `User_id` (`User_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Order_id` (`Order_id`),
  ADD KEY `Product_id` (`Product_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `product_item`
--
ALTER TABLE `product_item`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Category_id` (`Category_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_Customer_id` (`Customer_id`),
  ADD KEY `FK_Shop_order_id` (`Shop_order_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `variation`
--
ALTER TABLE `variation`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Product_id` (`Product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_item`
--
ALTER TABLE `product_item`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `variation`
--
ALTER TABLE `variation`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `user` (`Id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`Order_id`) REFERENCES `orders` (`Id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`Product_id`) REFERENCES `product_item` (`Id`);

--
-- Constraints for table `product_item`
--
ALTER TABLE `product_item`
  ADD CONSTRAINT `product_item_ibfk_1` FOREIGN KEY (`Category_id`) REFERENCES `product_category` (`Id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK_Customer_id` FOREIGN KEY (`Id`) REFERENCES `user` (`Id`),
  ADD CONSTRAINT `FK_Shop_order_id` FOREIGN KEY (`Shop_order_id`) REFERENCES `orders` (`Id`);

--
-- Constraints for table `variation`
--
ALTER TABLE `variation`
  ADD CONSTRAINT `variation_ibfk_1` FOREIGN KEY (`Product_id`) REFERENCES `product_item` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
