-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3333
-- Generation Time: May 19, 2017 at 04:45 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cartitems`
--

CREATE TABLE `cartitems` (
  `ID` int(11) NOT NULL,
  `sessionID` varchar(50) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `createdTS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `parent` varchar(50) DEFAULT NULL,
  `layer` int(11) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `postDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `name`, `parent`, `layer`, `description`, `status`, `postDate`) VALUES
(1, 'Electric Bicycle', NULL, 1, 'Electric Bicycle', 0, '2017-05-15'),
(2, 'Electric Scooter', NULL, 1, 'Electric Scooter', 0, '2017-05-15'),
(3, 'Scooter', NULL, 1, 'Electric Scooter', 0, '2017-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `invoiceStatus` varchar(10) DEFAULT NULL,
  `sendStatus` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `ID` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` varchar(4000) DEFAULT NULL,
  `response` varchar(4000) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `postDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creatDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `ID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `origProductID` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orderpayment`
--

CREATE TABLE `orderpayment` (
  `ID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) DEFAULT '0',
  `userID` int(11) NOT NULL,
  `paymentID` int(11) DEFAULT NULL,
  `invoiceID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postalCode` varchar(6) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phoneNumber` varchar(10) NOT NULL,
  `totalBeforeTax` decimal(10,2) NOT NULL,
  `shippingBeforeTax` decimal(10,2) NOT NULL,
  `taxes` decimal(10,2) NOT NULL,
  `totalWithShippingAndTaxes` decimal(10,2) NOT NULL,
  `dateTimePlaced` datetime NOT NULL,
  `dateTimeShipped` datetime DEFAULT NULL,
  `status` enum('placed','shipped','cancelled','delivered') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `passresets`
--

CREATE TABLE `passresets` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `secretToken` varchar(50) NOT NULL,
  `expiryDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `paymentStatus` varchar(10) DEFAULT NULL,
  `paymentWay` varchar(10) DEFAULT NULL,
  `paymentDetails` varchar(100) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `payStatus` int(11) DEFAULT '0',
  `payDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `catID` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `title` varchar(200) NOT NULL,
  `imageData1` longblob,
  `imageMimeType1` varchar(100) NOT NULL,
  `imageName1` varchar(100) DEFAULT NULL,
  `imageData2` longblob,
  `imageMimeType2` varchar(100) DEFAULT NULL,
  `imageName2` varchar(100) DEFAULT NULL,
  `imageData3` longblob,
  `imageMimeType3` varchar(100) DEFAULT NULL,
  `imageName3` varchar(100) DEFAULT NULL,
  `modelNo` int(11) DEFAULT NULL,
  `modelName` varchar(50) DEFAULT NULL,
  `fullName` varchar(250) DEFAULT NULL,
  `desc1` varchar(100) NOT NULL,
  `desc2` varchar(100) DEFAULT NULL,
  `desc3` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT '1',
  `discount` decimal(3,2) DEFAULT NULL,
  `postDate` date DEFAULT NULL,
  `updateDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ID`, `catID`, `name`, `title`, `imageData1`, `imageMimeType1`, `imageName1`, `imageData2`, `imageMimeType2`, `imageName2`, `imageData3`, `imageMimeType3`, `imageName3`, `modelNo`, `modelName`, `fullName`, `desc1`, `desc2`, `desc3`, `price`, `stock`, `discount`, `postDate`, `updateDate`) VALUES
(1, 1, '', 'dfsfds', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'fdsaf', '', 'fdsa', NULL, NULL, '111.00', 111, '1.00', '2017-05-17', NULL),
(2, 1, '', 'yun', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 'good yun', '', 'good yun bike', NULL, NULL, '399.99', 200, '1.00', '2017-05-17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `addressLine1` varchar(100) DEFAULT NULL,
  `addressLine2` varchar(100) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `TYPE` int(11) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `status` int(11) DEFAULT '0',
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `name`, `email`, `password`, `fname`, `lname`, `phone`, `addressLine1`, `addressLine2`, `state`, `city`, `code`, `TYPE`, `role`, `status`, `last_login`) VALUES
(7, 'Jerry', 'Jerry@123.com', '$2y$10$erdahXcf.UC5ZbYph05haOli8tlgg0TcO5B7AarUSZwuQ5DUklM.u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', 0, '2017-05-17 18:36:43'),
(8, 'admin', 'admin@admin.org', '$2y$10$x5bXQG8.5cPuaz67dTEJae1cnpHT/jRRPSvM6mA8yF/XIalnHVFCO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', 0, '2017-05-18 20:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `productID1` int(11) DEFAULT NULL,
  `productID2` int(11) DEFAULT NULL,
  `productID3` int(11) DEFAULT NULL,
  `productID4` int(11) DEFAULT NULL,
  `productID5` int(11) DEFAULT NULL,
  `productID6` int(11) DEFAULT NULL,
  `productID7` int(11) DEFAULT NULL,
  `productID8` int(11) DEFAULT NULL,
  `productID9` int(11) DEFAULT NULL,
  `productID10` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cartitems`
--
ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `sessionID_2` (`sessionID`,`productID`),
  ADD KEY `sessionID` (`sessionID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `invoices_userIDfk_1` (`userID`),
  ADD KEY `invoices_ordersIDfk_1` (`orderID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `origProductID` (`origProductID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indexes for table `orderpayment`
--
ALTER TABLE `orderpayment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `passresets`
--
ALTER TABLE `passresets`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `userID` (`userID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `payments_userIDfk_1` (`userID`),
  ADD KEY `payments_ordersIDfk_1` (`orderID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `products_categoriesIDfk_1` (`catID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `wishlist_userIDfk_1` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cartitems`
--
ALTER TABLE `cartitems`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orderpayment`
--
ALTER TABLE `orderpayment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `passresets`
--
ALTER TABLE `passresets`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ordersIDfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`ID`),
  ADD CONSTRAINT `invoices_userIDfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `orderpayment`
--
ALTER TABLE `orderpayment`
  ADD CONSTRAINT `orderpayment_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`ID`),
  ADD CONSTRAINT `orderpayment_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`ID`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ordersIDfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`ID`),
  ADD CONSTRAINT `payments_userIDfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_categoriesIDfk_1` FOREIGN KEY (`catID`) REFERENCES `categories` (`ID`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_userIDfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
