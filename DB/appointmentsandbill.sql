-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2026 at 03:43 PM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointmentsandbill`
--

CREATE TABLE `appointmentsandbill` (
  `id` int(11) NOT NULL,
  `patientName` varchar(100) NOT NULL,
  `patientEmail` varchar(100) NOT NULL,
  `doctorName` varchar(100) NOT NULL,
  `speciality` varchar(100) NOT NULL,
  `day` varchar(50) NOT NULL,
  `timeSlot` varchar(20) NOT NULL,
  `appointmentFee` decimal(10,2) NOT NULL,
  `status` enum('pending','confirmed','cancelled','completed') DEFAULT 'pending',
  `paymentMethod` enum('card','mobile') DEFAULT NULL,
  `card_mobile_data` varchar(100) DEFAULT NULL,
  `datetime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointmentsandbill`
--

INSERT INTO `appointmentsandbill` (`id`, `patientName`, `patientEmail`, `doctorName`, `speciality`, `day`, `timeSlot`, `appointmentFee`, `status`, `paymentMethod`, `card_mobile_data`, `datetime`) VALUES
(1, '', '', '', '', '', '', 0.00, 'cancelled', NULL, NULL, '2026-01-03 17:13:13'),
(2, 'Md.Shaharia Hossen', '23-52473-2@student.aiub.edu', 'Dr. Nusrat Jahan', 'Neurology', 'Sunday', '10:00 AM - 12:00 PM', 700.00, 'completed', '', 'Mobile payment', '2026-01-03 14:11:18'),
(3, 'Md.Shaharia Hossen', '23-52473-2@student.aiub.edu', 'Dr. Hasan Ali', 'Cardiology', 'Tuesday', '10:00 AM - 12:00 PM', 700.00, 'completed', '', 'Mobile payment', '2026-01-03 14:11:18'),
(4, 'Antor', 'antor@gmail.com', 'Dr. Kamal Hossain', 'Orthopedics', 'Wednesday', '12:00 PM - 02:00 PM', 800.00, 'completed', 'card', 'Card: 123145', '2026-01-03 14:20:33'),
(5, 'Antor', 'antor@gmail.com', 'Dr. Farzana Rahman', 'Gynecology', 'Sunday', '12:00 PM - 02:00 PM', 700.00, 'completed', 'card', 'Card: 123145', '2026-01-03 14:20:33'),
(6, 'Antor', 'antor@gmail.com', 'Dr. Nusrat Jahan', 'Neurology', 'Wednesday', '12:00 PM - 02:00 PM', 1200.00, 'completed', 'mobile', 'Mobile: 01315666305', '2026-01-03 14:22:02'),
(8, 'Mehedi Hasan', 'mehedi@gmail.com', 'Dr. Nusrat Jahan', 'Neurology', 'Sunday', '04:00 PM - 06:00 PM', 700.00, 'completed', 'card', 'Card: 123456789', '2026-01-03 15:38:58'),
(9, 'Mehedi Hasan', 'mehedi@gmail.com', 'Dr. Kamal Hossain', 'Orthopedics', 'Monday', '10:00 AM - 12:00 PM', 700.00, 'completed', 'card', 'Card: 123456789', '2026-01-03 15:38:58'),
(10, 'Sadia Islam', 'sadia@gmail.com', 'Dr. Hasan Ali', 'Cardiology', 'Monday', '02:00 PM - 04:00 PM', 650.00, 'confirmed', NULL, NULL, '2026-01-03 20:39:55'),
(11, 'Sadia Islam', 'sadia@gmail.com', 'Dr. Farzana Rahman', 'Gynecology', 'Friday', '02:00 PM - 04:00 PM', 800.00, 'confirmed', NULL, NULL, '2026-01-03 20:40:07'),
(12, 'Rakib Hossain', 'rakib@gmail.com', 'Dr. Imran Khan', 'Dermatology', 'Monday', '12:00 PM - 02:00 PM', 800.00, 'completed', 'mobile', 'Mobile: 01315666305', '2026-01-03 15:43:07'),
(13, 'Rakib Hossain', 'rakib@gmail.com', 'Dr. Farzana Rahman', 'Gynecology', 'Saturday', '12:00 PM - 02:00 PM', 600.00, 'completed', 'mobile', 'Mobile: 01315666305', '2026-01-03 15:43:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointmentsandbill`
--
ALTER TABLE `appointmentsandbill`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointmentsandbill`
--
ALTER TABLE `appointmentsandbill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
