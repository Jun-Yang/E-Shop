-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2017 at 06:07 AM
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
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id1` int(11) NOT NULL,
  `product_id2` int(11) DEFAULT NULL,
  `product_id3` int(11) DEFAULT NULL,
  `product_id4` int(11) DEFAULT NULL,
  `product_id5` int(11) DEFAULT NULL,
  `product_id6` int(11) DEFAULT NULL,
  `product_id7` int(11) DEFAULT NULL,
  `product_id8` int(11) DEFAULT NULL,
  `product_id9` int(11) DEFAULT NULL,
  `product_id10` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `parent` varchar(50) DEFAULT NULL,
  `layer` int(11) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `posted_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent`, `layer`, `description`, `status`, `posted_date`) VALUES
(1, 'Electric Bicycle', NULL, 1, 'Electric Bicycle', 0, '2017-05-15'),
(2, 'Electric Scooter', NULL, 1, 'Electric Scooter', 0, '2017-05-15'),
(3, 'Self-Balancing Scooter', NULL, 1, 'Electric Self-Balancing Scooter', 0, '2017-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_status` varchar(10) DEFAULT NULL,
  `send_status` varchar(10) DEFAULT NULL
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
  `posted_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_products_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `addressLine1` varchar(100) NOT NULL,
  `addressLine2` varchar(100) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) DEFAULT NULL,
  `abbr_province` varchar(5) DEFAULT NULL,
  `city_code` varchar(20) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `abbr_country` varchar(4) DEFAULT NULL,
  `cartId` int(11) DEFAULT NULL,
  `shiped` varchar(5) DEFAULT 'false',
  `shipped_date` date DEFAULT NULL,
  `Shipping_Method` int(11) DEFAULT NULL,
  `ship_status` varchar(10) DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_status` varchar(10) DEFAULT NULL,
  `payment_way` varchar(10) DEFAULT NULL,
  `payment_details` varchar(100) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `pay_status` int(11) DEFAULT '0',
  `pay_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `image_data1` longblob NOT NULL,
  `image_mime_type1` varchar(100) NOT NULL,
  `image_name1` varchar(100) DEFAULT NULL,
  `image_data2` longblob,
  `image_mime_type2` varchar(100) DEFAULT NULL,
  `image_name2` varchar(100) DEFAULT NULL,
  `image_data3` longblob,
  `image_mime_type3` varchar(100) DEFAULT NULL,
  `image_name3` varchar(100) DEFAULT NULL,
  `model_no` int(11) DEFAULT NULL,
  `model_name` varchar(50) DEFAULT NULL,
  `full_name` varchar(250) NOT NULL,
  `desc1` varchar(100) NOT NULL,
  `desc2` varchar(100) DEFAULT NULL,
  `desc3` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT '1',
  `discount` decimal(3,2) DEFAULT NULL,
  `posted_date` date DEFAULT NULL,
  `update_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `cat_id`, `name`, `title`, `image_data1`, `image_mime_type1`, `image_name1`, `image_data2`, `image_mime_type2`, `image_name2`, `image_data3`, `image_mime_type3`, `image_name3`, `model_no`, `model_name`, `full_name`, `desc1`, `desc2`, `desc3`, `price`, `stock`, `discount`, `posted_date`, `update_date`) VALUES
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
  `password` varchar(40) NOT NULL,
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
(1, 'chen', 'cc@123.com', 'AAaa11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', 0, '2017-05-16 17:36:07'),
(2, 'chenc', 'aa@123.com', 'AAaa11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', 0, '2017-05-16 17:41:36'),
(3, 'mike', 'mike@123.com', 'AAaa11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', 0, '2017-05-16 18:06:33'),
(4, 'yu1', 'yu@111.com', 'AAaa11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', 0, '2017-05-17 01:53:08');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id1` int(11) DEFAULT NULL,
  `product_id2` int(11) DEFAULT NULL,
  `product_id3` int(11) DEFAULT NULL,
  `product_id4` int(11) DEFAULT NULL,
  `product_id5` int(11) DEFAULT NULL,
  `product_id6` int(11) DEFAULT NULL,
  `product_id7` int(11) DEFAULT NULL,
  `product_id8` int(11) DEFAULT NULL,
  `product_id9` int(11) DEFAULT NULL,
  `product_id10` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `carts_user_id_FK1` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `invoices_user_idfk_1` (`user_id`),
  ADD KEY `invoices_orders_idfk_1` (`order_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `orders_user_idfk_1` (`user_id`),
  ADD KEY `order_products_id` (`order_products_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `payments_user_idfk_1` (`user_id`),
  ADD KEY `payments_orders_idfk_1` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_categories_idfk_1` (`cat_id`);

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
  ADD KEY `wishlist_user_idfk_1` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_FK1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_orders_idfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`ID`),
  ADD CONSTRAINT `invoices_user_idfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`order_products_id`) REFERENCES `order_products` (`id`),
  ADD CONSTRAINT `orders_user_idfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`);

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`ID`),
  ADD CONSTRAINT `order_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_orders_idfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`ID`),
  ADD CONSTRAINT `payments_user_idfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_categories_idfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_user_idfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
