-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2022 at 09:35 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `railway_booking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_coach_data`
--

CREATE TABLE `master_coach_data` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('Reservation','General') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_coach_data`
--

INSERT INTO `master_coach_data` (`id`, `name`, `type`) VALUES
(1, 'S1', 'Reservation'),
(2, 'S2', 'Reservation'),
(3, 'G1', 'General'),
(4, 'G2', 'General');

-- --------------------------------------------------------

--
-- Table structure for table `master_seat_data`
--

CREATE TABLE `master_seat_data` (
  `id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_seat_data`
--

INSERT INTO `master_seat_data` (`id`, `coach_id`, `name`) VALUES
(3, 1, '1'),
(4, 3, '2'),
(5, 2, '3'),
(6, 1, '4'),
(7, 4, '5'),
(8, 2, '6'),
(9, 1, '7');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `FIRST_NAME` varchar(255) NOT NULL,
  `LAST_NAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `STATUS` enum('Active','Inactive') NOT NULL,
  `TYPE` enum('Admin','User') NOT NULL,
  `CREATED_DATE` datetime NOT NULL,
  `UPDATED_DATE` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `FIRST_NAME`, `LAST_NAME`, `EMAIL`, `username`, `password`, `STATUS`, `TYPE`, `CREATED_DATE`, `UPDATED_DATE`) VALUES
(1, 'Admin', 'User', 'admin@ymail.com', 'admin', 'e6e061838856bf47e1de730719fb2609', 'Active', 'Admin', '2022-06-22 09:39:28', '2022-06-22 09:39:28'),
(3, 'TEST', 'USER', 'testUser@ymail.com', 'TestUser', 'e6e061838856bf47e1de730719fb2609', 'Active', 'User', '2022-06-22 04:38:56', '2022-06-22 04:38:56'),
(4, 'Iam', 'User', 'IAMUSER@ymail.com', 'IAMUSER', 'e6e061838856bf47e1de730719fb2609', 'Active', 'User', '2022-06-26 09:10:13', '2022-06-26 09:10:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_bookings`
--

CREATE TABLE `user_bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `journey_date` date NOT NULL,
  `begening` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `no_of_persons` int(11) NOT NULL,
  `status` enum('pending','cancelled','confirmed','completed') NOT NULL,
  `type` enum('Reservation','General') NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_bookings`
--

INSERT INTO `user_bookings` (`id`, `user_id`, `journey_date`, `begening`, `destination`, `no_of_persons`, `status`, `type`, `created_date`, `updated_date`) VALUES
(5, 4, '2022-06-28', 'Chandigarh', 'Delhi', 3, 'pending', 'Reservation', '2022-06-27 09:32:41', '2022-06-27 09:32:41'),
(6, 4, '2022-06-29', 'Banglore', 'Delhi', 2, 'pending', 'General', '2022-06-27 09:34:08', '2022-06-27 09:34:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_bookings_details`
--

CREATE TABLE `user_bookings_details` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `proof_type` varchar(255) NOT NULL,
  `identityfication_number` varchar(255) NOT NULL,
  `alloted_seat_no` varchar(255) DEFAULT NULL,
  `status` enum('pending','cancelled','confirmed','completed') NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_bookings_details`
--

INSERT INTO `user_bookings_details` (`id`, `booking_id`, `full_name`, `age`, `proof_type`, `identityfication_number`, `alloted_seat_no`, `status`, `created_date`, `updated_date`) VALUES
(2, 5, 'aa', '12', 'VOTER_CARD', 'test123456', NULL, 'pending', '2022-06-27 09:32:41', '2022-06-27 09:32:41'),
(3, 6, 'qe', '2', 'PAN_CARD', 'test123456', NULL, 'pending', '2022-06-27 09:34:08', '2022-06-27 09:34:08'),
(4, 6, 'da', '2', 'AADHAR_CARD', 'test123456', NULL, 'pending', '2022-06-27 09:34:08', '2022-06-27 09:34:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_booking_logs`
--

CREATE TABLE `user_booking_logs` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `description` tinytext NOT NULL,
  `create_by_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_booking_logs`
--

INSERT INTO `user_booking_logs` (`id`, `booking_id`, `description`, `create_by_id`) VALUES
(1, 5, 'New booking created by Iam User', 4),
(2, 6, 'New booking created by Iam User', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_coach_data`
--
ALTER TABLE `master_coach_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_seat_data`
--
ALTER TABLE `master_seat_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_bookings`
--
ALTER TABLE `user_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_bookings_details`
--
ALTER TABLE `user_bookings_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `user_booking_logs`
--
ALTER TABLE `user_booking_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `create_by_id` (`create_by_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_coach_data`
--
ALTER TABLE `master_coach_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_seat_data`
--
ALTER TABLE `master_seat_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_bookings`
--
ALTER TABLE `user_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_bookings_details`
--
ALTER TABLE `user_bookings_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_booking_logs`
--
ALTER TABLE `user_booking_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_bookings`
--
ALTER TABLE `user_bookings`
  ADD CONSTRAINT `user_bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_bookings_details`
--
ALTER TABLE `user_bookings_details`
  ADD CONSTRAINT `user_bookings_details_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `user_bookings` (`id`);

--
-- Constraints for table `user_booking_logs`
--
ALTER TABLE `user_booking_logs`
  ADD CONSTRAINT `user_booking_logs_ibfk_1` FOREIGN KEY (`create_by_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
