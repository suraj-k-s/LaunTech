-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2023 at 12:31 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_launtech`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_packagebooking`
--

CREATE TABLE `tbl_packagebooking` (
  `packagebooking_id` int(30) NOT NULL,
  `packagebooking_date` varchar(100) NOT NULL,
  `packagebooking_status` int(11) NOT NULL DEFAULT 0,
  `package_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_packagebooking`
--

INSERT INTO `tbl_packagebooking` (`packagebooking_id`, `packagebooking_date`, `packagebooking_status`, `package_id`, `user_id`) VALUES
(1, '2023-09-11', 0, 3, 9),
(12, '2023-09-11', 0, 4, 9),
(13, '2023-09-11', 0, 4, 9),
(18, '2023-09-19', 1, 5, 8),
(21, '2023-09-19', 1, 7, 8),
(23, '2023-09-19', 1, 7, 7),
(25, '2023-09-25', 1, 6, 8),
(26, '2023-09-25', 1, 6, 8),
(27, '2023-10-09', 0, 7, 9),
(28, '2023-10-09', 0, 6, 9),
(29, '2023-10-09', 0, 7, 9),
(30, '2023-10-09', 0, 7, 9),
(31, '2023-10-09', 0, 7, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_packagebooking`
--
ALTER TABLE `tbl_packagebooking`
  ADD PRIMARY KEY (`packagebooking_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_packagebooking`
--
ALTER TABLE `tbl_packagebooking`
  MODIFY `packagebooking_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
