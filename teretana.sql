-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2024 at 03:22 PM
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
-- Database: `teretana`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`, `created_at`) VALUES
(2, 'djordje', '$2y$10$W9pxiS6NliXOIIGb9MBcsuwu1YyAY48yDVFhs4pAiz7kd0HaNGDHe', '2024-02-26');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `photo_path` varchar(255) NOT NULL,
  `training_plan_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `access_card_pdf_path` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `first_name`, `last_name`, `email`, `phone_number`, `photo_path`, `training_plan_id`, `trainer_id`, `access_card_pdf_path`, `created_at`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', '123-456-7890', '/photos/john_doe.jpg', 1, 1, '/access_cards/john_doe_card.pdf', '2024-02-01'),
(3, 'Đorđe', 'Tornjanski', 'djordjepeka124@gmail.com', '213', '', 1, 1, '', '2024-02-04'),
(4, 'Đorđe', 'Tornjanski', 'djordjepeka124@gmail.com', '213', '', 1, 3, '', '2024-02-27'),
(5, 'Đorđe', 'Tornjanski', 'djordjepeka124@gmail.com', '213', '', 1, 4, '', '2024-02-27'),
(6, 'Đorđe', 'Tornjanski', 'djordjepeka124@gmail.com', '213', '', 2, 5, '', '2024-02-27'),
(7, 'Đorđe', 'Tornjanski', 'nenad@gmail.com', '213', '', 3, 1, '', '2024-02-27'),
(8, 'Đorđe', 'Tornjanski', 'djordjepeka124@gmail.com', '213', '', 3, 2, '', '2024-02-27'),
(9, 'Đorđe', 'Tornjanski', 'djordjepeka124@gmail.com', '213', '', 3, 1, '', '2024-02-27'),
(10, 'Đorđe', 'Tornjanski', 'djordjepeka124@gmail.com', '213', '', 2, 1, 'access_cards/access_card10.pdf', '2024-02-27'),
(11, 'Đorđe', 'Tornjanski', 'djordjepeka124@gmail.com', '213', '', 4, 3, 'access_cards/access_card11.pdf', '2024-02-28'),
(12, 'Đorđe', 'Tornjanski', 'djordjepeka124@gmail.com', '213', '', 3, 5, 'access_cards/access_card12.pdf', '2024-02-28'),
(13, 'Đorđe', 'Tornjanski', 'djordjepeka124@gmail.com', '213', '', 2, 3, 'access_cards/access_card13.pdf', '2024-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `trainer_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`trainer_id`, `first_name`, `last_name`, `email`, `phone_number`, `created_at`) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', '123-456-7890', '2024-02-28'),
(2, 'Jane', 'Smith', 'jane.smith@example.com', '987-654-3210', '2024-02-28'),
(3, 'Alice', 'Johnson', 'alice.johnson@example.com', '555-123-4567', '2024-02-28'),
(4, 'Bob', 'Williams', 'bob.williams@example.com', '444-789-1234', '2024-02-28'),
(5, 'Emily', 'Brown', 'emily.brown@example.com', '321-987-6543', '2024-02-28'),
(6, 'Test', 'Test', 'nenad@gmail.com', '2324324', '2024-02-29');

-- --------------------------------------------------------

--
-- Table structure for table `training_plans`
--

CREATE TABLE `training_plans` (
  `plan_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sessions` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `training_plans`
--

INSERT INTO `training_plans` (`plan_id`, `name`, `sessions`, `price`, `created_at`) VALUES
(2, '12 sessions plan', 12, '20', '2023-12-12'),
(3, '30 sessions plan', 30, '50', '2023-10-16'),
(4, 'novi plan', 25, '40', '2024-02-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`trainer_id`);

--
-- Indexes for table `training_plans`
--
ALTER TABLE `training_plans`
  ADD PRIMARY KEY (`plan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `trainer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `training_plans`
--
ALTER TABLE `training_plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
