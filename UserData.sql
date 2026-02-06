-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 06, 2026 at 10:00 AM
-- Server version: 8.0.45-0ubuntu0.24.04.1
-- PHP Version: 8.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `UserData`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` text,
  `status` tinyint(1) DEFAULT '1',
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile_img`, `name`, `email`, `mobile`, `gender`, `date_of_birth`, `address`, `status`, `is_deleted`) VALUES
(1, '1770370872_boy.jpeg', 'Jay Patel', 'jaypatel@gmail.com', '1234569874', 'Male', '2005-06-09', 'Ahemdabad', 0, 0),
(2, '1770371320_g1.jpeg', 'Khusi', 'khusi@gmail.com', '7894563214', 'Female', '2011-02-02', 'Nadiad', 1, 0),
(3, '1770371569_b3.jpeg', 'Raj Shah', 'raj@gmail.com', '8523698552', 'Male', '2004-08-20', 'Anand', 0, 0),
(4, '1770371687_g4.png', 'Charmi Kansara', 'charmi@gmail.com', '7539512584', 'Female', '2000-05-03', 'Thaltej', 0, 0),
(5, '1770371785_b2.jpeg', 'Bitu Parjapati', 'bitupra@gmail.com', '7413698526', 'Male', '2003-11-22', 'Ahemdabad', 1, 0),
(6, '1770372007_b1.jpeg', 'subham jain', 'subham@gmail.com', '7415568892', 'Male', '2006-11-02', 'Surat', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
