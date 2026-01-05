-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2026 at 10:54 AM
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
-- Table structure for table `doctorschedule`
--

CREATE TABLE `doctorschedule` (
  `doctorName` varchar(100) DEFAULT NULL,
  `speciality` varchar(100) DEFAULT NULL,
  `day` varchar(50) DEFAULT NULL,
  `timeSlot` varchar(100) DEFAULT NULL,
  `appointmentFee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctorschedule`
--

INSERT INTO `doctorschedule` (`doctorName`, `speciality`, `day`, `timeSlot`, `appointmentFee`) VALUES
('Dr. Nusrat Jahan', 'Neurology', 'Sunday', '10:00 AM - 12:00 PM', 700),
('Dr. Nusrat Jahan', 'Neurology', 'Sunday', '04:00 PM - 06:00 PM', 1000),
('Dr. Nusrat Jahan', 'Neurology', 'Tuesday', '02:00 PM - 04:00 PM', 600),
('Dr. Nusrat Jahan', 'Neurology', 'Wednesday', '12:00 PM - 02:00 PM', 1200),
('Dr. Nusrat Jahan', 'Neurology', 'Friday', '12:00 PM - 02:00 PM', 1400),
('Dr. Hasan Ali', 'Cardiology', 'Sunday', '10:00 AM - 12:00 PM', 600),
('Dr. Hasan Ali', 'Cardiology', 'Tuesday', '10:00 AM - 12:00 PM', 700),
('Dr. Hasan Ali', 'Cardiology', 'Monday', '02:00 PM - 04:00 PM', 650),
('Dr. Hasan Ali', 'Cardiology', 'Friday', '04:00 PM - 06:00 PM', 800),
('Dr. Hasan Ali', 'Cardiology', 'Wednesday', '10:00 AM - 12:00 PM', 700),
('Dr. Kamal Hossain', 'Orthopedics', 'Sunday', '08:00 PM - 10:00 PM', 800),
('Dr. Kamal Hossain', 'Orthopedics', 'Monday', '10:00 AM - 12:00 PM', 700),
('Dr. Kamal Hossain', 'Orthopedics', 'Tuesday', '12:00 PM - 02:00 PM', 800),
('Dr. Kamal Hossain', 'Orthopedics', 'Wednesday', '04:00 PM - 06:00 PM', 700),
('Dr. Kamal Hossain', 'Orthopedics', 'Wednesday', '12:00 PM - 02:00 PM', 700),
('Dr. Farzana Rahman', 'Gynecology', 'Sunday', '10:00 AM - 12:00 PM', 600),
('Dr. Farzana Rahman', 'Gynecology', 'Monday', '12:00 PM - 02:00 PM', 700),
('Dr. Farzana Rahman', 'Gynecology', 'Tuesday', '10:00 AM - 12:00 PM', 700),
('Dr. Farzana Rahman', 'Gynecology', 'Friday', '02:00 PM - 04:00 PM', 800),
('Dr. Farzana Rahman', 'Gynecology', 'Saturday', '12:00 PM - 02:00 PM', 600),
('Dr. Imran Khan', 'Dermatology', 'Sunday', '08:00 PM - 10:00 PM', 900),
('Dr. Imran Khan', 'Dermatology', 'Monday', '12:00 PM - 02:00 PM', 800),
('Dr. Imran Khan', 'Dermatology', 'Tuesday', '02:00 PM - 04:00 PM', 800),
('Dr. Imran Khan', 'Dermatology', 'Friday', '02:00 PM - 04:00 PM', 900);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
