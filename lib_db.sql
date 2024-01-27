-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2024 at 06:13 PM
-- Server version: 8.0.25
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lib_db`
--
CREATE DATABASE IF NOT EXISTS `lib_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `lib_db`;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int NOT NULL,
  `serial_no` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `copies` int NOT NULL,
  `category` varchar(30) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `serial_no`, `title`, `author`, `copies`, `category`) VALUES
(1, '132370086', 'Introduction to Computing', 'Jane Doe', 14, 'Educational'),
(2, '231256670086', 'Cinderella', 'Jane Doe', 25, 'Educational, Fiction'),
(4, '67850003', 'Done Tomorrow', 'Estella', 4, 'Fiction');

-- --------------------------------------------------------

--
-- Table structure for table `borrowers`
--

CREATE TABLE `borrowers` (
  `id` int NOT NULL,
  `full_name` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `id_presented` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(230) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `joined_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowers`
--

INSERT INTO `borrowers` (`id`, `full_name`, `id_presented`, `address`, `status`, `joined_at`) VALUES
(1, 'Juan Dela Cruz', 'National ID', 'Cainta, Rizal', 'ineligible', '2024-01-27'),
(2, 'John Hombre Doe', 'PhilHealth', 'Lot 1 Blk 3 Green Homes Subdivision Brgy San Pablo Sta. Rosa , Laguna', 'suspended', '2024-01-27'),
(4, 'John Hombre Doe', 'asdasdasda', 'Lot 1 Blk 3 Green Homes Subdivision Brgy San Pablo Sta. Rosa , Laguna', 'ineligible', '2024-01-27');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `borrower_id` int NOT NULL,
  `book_serial_no` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `borrowed_at` date DEFAULT NULL,
  `returned_at` date DEFAULT NULL,
  `processed_by` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `borrower_id`, `book_serial_no`, `borrowed_at`, `returned_at`, `processed_by`, `status`) VALUES
(1, 1, '132370086', '2024-01-19', '2024-01-27', 'admin', 'complete'),
(2, 4, '67850003', '2024-01-27', NULL, 'admin', 'borrowed'),
(9, 1, '132370086', '2024-01-27', '2024-01-27', 'admin', 'complete'),
(10, 4, '132370086', '2024-01-27', '2024-01-27', 'admin', 'complete'),
(11, 1, '132370086', '2024-01-27', NULL, 'admin', 'borrowed'),
(12, 4, '132370086', '2024-01-27', '2024-01-27', 'admin', 'complete'),
(13, 4, '132370086', '2024-01-27', NULL, 'admin', 'borrowed');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `first_name` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `middle_name` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_name` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `username`, `password`, `role`, `is_active`) VALUES
(1, 'ADMIN', 'ADMIN', 'ADMIN', 'admin', '123', 'admin', 1),
(2, 'asasdassas', 'asda', 'sdasd', 'asddasdas', 'asdfghjkl', 'admin', 1),
(3, 'Joh', '', 'Doe', 'admin2', 'tempopass123', 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrowers`
--
ALTER TABLE `borrowers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `borrowers`
--
ALTER TABLE `borrowers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
