-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3333
-- Generation Time: May 26, 2017 at 07:32 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `fbid` varchar(50) DEFAULT NULL,
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
  `status` enum('Normal','Blocked') DEFAULT 'Normal',
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `name`, `email`, `password`, `fbid`, `fname`, `lname`, `phone`, `addressLine1`, `addressLine2`, `state`, `city`, `code`, `TYPE`, `role`, `status`, `last_login`) VALUES
(7, 'Jerry003', 'yangjun3461@gmail.com', '$2y$10$erdahXcf.UC5ZbYph05haOli8tlgg0TcO5B7AarUSZwuQ5DUklM.u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', 'Blocked', '2017-05-17 18:36:43'),
(8, 'jerry', 'jerry@123.com', '$2y$10$.M5jQxGIKDtSxdQgFDBdxeX0Ta8SpTQyRSQxJJ11m/.AQPm9dgquK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', 'Normal', '2017-05-18 19:51:49'),
(9, 'admin', 'admin@123.com', '$2y$10$f.LGHKm.a/r8hHTpIUHg4.jZFIxqUdCaxBh0WbrxkEVtbrmKf3DaC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', 'Normal', '2017-05-19 04:56:24'),
(10, 'jerry001', 'jerry001@123.com', '$2y$10$VEeRSOQ6JL4FDRFyIn.znO8zShimef0JYPePqdqByNGj843InCyXu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', 'Normal', '2017-05-21 02:42:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `fbid` (`fbid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
