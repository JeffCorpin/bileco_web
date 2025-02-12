-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2025 at 07:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bileco_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `accountnum` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contactnumber` varchar(20) NOT NULL,
  `hashedpassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `accountnum`, `firstname`, `middlename`, `lastname`, `suffix`, `address`, `email`, `contactnumber`, `hashedpassword`) VALUES
(1, '01-2345-6789', 'Bileco', '', '', '', 'Caraycaray Naval, Biliran', 'bileco@gmail.com', '09543287123', '$2y$10$LnFQnBXf/BxXZ4e2ErplBe9cdtwt8j8IsCPfm24w29OeT.GJBPm36');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `bill` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `date`, `bill`) VALUES
(1, '2024-09-19', '1202'),
(2, '2024-10-20', '2303'),
(3, '2024-11-22', '1401'),
(4, '2024-12-20', '1901'),
(5, '2025-01-29', '2011');

-- --------------------------------------------------------

--
-- Table structure for table `consumer`
--

CREATE TABLE `consumer` (
  `id` int(11) NOT NULL,
  `accountnum` varchar(255) NOT NULL,
  `firstname` varchar(225) NOT NULL,
  `middlename` varchar(225) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `address` varchar(225) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactnumber` varchar(255) NOT NULL,
  `hashedpassword` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consumer`
--

INSERT INTO `consumer` (`id`, `accountnum`, `firstname`, `middlename`, `lastname`, `suffix`, `address`, `email`, `contactnumber`, `hashedpassword`, `profile_image`) VALUES
(6, '01-0954-2134', 'Francis  ', 'C.', 'Po', '', 'Marvel Culaba, Biliran', 'hadz@gmail.com', '09876543210', '$2y$10$cSQkmgvsnSeN4BU97mmDFuKzy.fSzPx38WtcOAS8vw6iueiH4wauG', './uploads/707aa46a32fa04f2315b38122ddd54ca.png'),
(14, '11-1234-1234', 'Jeff', 'P.', 'Corpin', 'Jr.', 'Brgy. San Roque Biliran, Biliran', 'jeffcorpin03@gmail.com', '09874653123', '$2y$10$7p1YcOOIKrnbThZe41qzdOTeWZCrg3gFMHH4agTzjpFNHfcAy7TNy', './uploads/06d7ae56b33216bce052c17ba73085af.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consumer`
--
ALTER TABLE `consumer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `consumer`
--
ALTER TABLE `consumer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
