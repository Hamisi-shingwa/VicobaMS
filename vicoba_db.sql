-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2023 at 07:30 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vicoba_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `credit`
--

CREATE TABLE `credit` (
  `id` int(24) NOT NULL,
  `type` varchar(24) NOT NULL,
  `amount` int(6) NOT NULL,
  `reciept_no` varchar(25) NOT NULL,
  `utoken` varchar(255) NOT NULL,
  `groupname` varchar(32) NOT NULL,
  `time` timestamp(5) NOT NULL DEFAULT current_timestamp(5) ON UPDATE current_timestamp(5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `realbalance`
--

CREATE TABLE `realbalance` (
  `id` int(11) NOT NULL,
  `amount` varchar(24) NOT NULL,
  `utoken` varchar(255) NOT NULL,
  `groupname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(23) NOT NULL,
  `transaction_type` varchar(10) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `av_balance` varchar(10) NOT NULL,
  `reciept_no` varchar(255) NOT NULL,
  `utoken` varchar(200) NOT NULL,
  `groupname` varchar(24) NOT NULL,
  `withdraw_permision` varchar(20) NOT NULL,
  `time` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(23) NOT NULL,
  `fullname` varchar(240) NOT NULL,
  `groupname` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `status` varchar(23) NOT NULL,
  `password` varchar(255) NOT NULL,
  `utoken` varchar(200) NOT NULL,
  `userphoto` varchar(255) NOT NULL DEFAULT 'null',
  `userdocs` varchar(255) DEFAULT 'null'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `groupname`, `address`, `email`, `status`, `password`, `utoken`, `userphoto`, `userdocs`) VALUES
(1, 'fullname', '', 'Chini ya mashamba ya kahawa', 'accountance@gmail.com', 'bank', '$2y$10$HQ7pGetU.q.zaoO0DcOdVeFfuoMRIho6duh1WlCnaDSmtAQb4m/ii', '7520646b9a33b063b', 'null', 'null'),
(2, 'Zaina juma mlema', 'zaibenkstreet', 'Chini ya mashamba ya kahawa', 'zai@gmail.com', 'admin', '$2y$10$FWQ.q3NufhwSZXmai5DAH.7ZljbOBiGdqqz57uPRIhkX/xTAtrYC6', '4317646b9aa8d13ff', '../../assets/server/1646b9aa8c987e6.67370829.png', '../../assets/server/1646b9aa8d06b52.11598903.png'),
(4, 'muhusi Malaika', 'zaibenkstreet', 'Mwanza', 'm@gmail.com', 'normal', '$2y$10$mzOiejAQpMXlBYiyzorlbek04V31ikQyo/DTfLSLHQoPyc4B1Prwu', '8269646b9c481674e', 'null', 'null'),
(5, 'Happy ', 'zaibenkstreet', 'Arusha sombetini', 'happy@gmail.com', 'normal', '$2y$10$cMh1J8eruYq9mH5LGc4BuOzd37UTiBIsZqO6fWjqcZ84NSCr6mnxK', '4445646b9c7010c57', 'null', 'null');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `credit`
--
ALTER TABLE `credit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `realbalance`
--
ALTER TABLE `realbalance`
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
-- AUTO_INCREMENT for table `credit`
--
ALTER TABLE `credit`
  MODIFY `id` int(24) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `realbalance`
--
ALTER TABLE `realbalance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(23) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(23) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
