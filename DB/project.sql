-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2026 at 04:39 PM
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
(4, 'Antor', 'antor@gmail.com', 'Dr. Kamal Hossain', 'Orthopedics', 'Wednesday', '12:00 PM - 02:00 PM', 800.00, 'completed', 'card', 'Card: 123145', '2026-01-03 14:20:33'),
(5, 'Antor', 'antor@gmail.com', 'Dr. Farzana Rahman', 'Gynecology', 'Sunday', '12:00 PM - 02:00 PM', 700.00, 'completed', 'card', 'Card: 123145', '2026-01-03 14:20:33'),
(6, 'Antor', 'antor@gmail.com', 'Dr. Nusrat Jahan', 'Neurology', 'Wednesday', '12:00 PM - 02:00 PM', 1200.00, 'completed', 'mobile', 'Mobile: 01315666305', '2026-01-03 14:22:02'),
(8, 'Mehedi Hasan', 'mehedi@gmail.com', 'Dr. Nusrat Jahan', 'Neurology', 'Sunday', '04:00 PM - 06:00 PM', 700.00, 'completed', 'card', 'Card: 123456789', '2026-01-03 15:38:58'),
(9, 'Mehedi Hasan', 'mehedi@gmail.com', 'Dr. Kamal Hossain', 'Orthopedics', 'Monday', '10:00 AM - 12:00 PM', 700.00, 'completed', 'card', 'Card: 123456789', '2026-01-03 15:38:58'),
(12, 'Rakib Hossain', 'rakib@gmail.com', 'Dr. Imran Khan', 'Dermatology', 'Monday', '12:00 PM - 02:00 PM', 800.00, 'completed', 'mobile', 'Mobile: 01315666305', '2026-01-03 15:43:07'),
(13, 'Rakib Hossain', 'rakib@gmail.com', 'Dr. Farzana Rahman', 'Gynecology', 'Saturday', '12:00 PM - 02:00 PM', 600.00, 'completed', 'mobile', 'Mobile: 01315666305', '2026-01-03 15:43:07');

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

-- --------------------------------------------------------

--
-- Table structure for table `nurseschedule`
--

CREATE TABLE `nurseschedule` (
  `id` int(11) NOT NULL,
  `nurseName` varchar(100) NOT NULL,
  `timeSlot` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nurseschedule`
--

INSERT INTO `nurseschedule` (`id`, `nurseName`, `timeSlot`) VALUES
(1, 'Nurse Salma', '04:00 PM - 12:00 AM (TUES, WED)'),
(2, 'Nurse Rahima', '12:00 AM - 08:00 AM (THU, FRI, SAT)'),
(3, 'Nurse Jamal', '08:00 AM - 04:00 PM (SUN, MON)'),
(4, 'Nurse Tania', '04:00 PM - 12:00 AM (TUES, WED)'),
(5, 'Nurse Arif', '12:00 AM - 08:00 AM (THU, FRI, SAT)');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL,
  `doctorName` varchar(100) NOT NULL,
  `patientName` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `diagnosis` text NOT NULL,
  `treatment` text NOT NULL,
  `medication` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `doctorName`, `patientName`, `age`, `diagnosis`, `treatment`, `medication`, `created_at`) VALUES
(11, 'Dr. Rahman', 'shihab', 23, 'qwe', 'asd', 'zxc', '2026-01-02 05:24:59'),
(12, 'Array', 'kabir', 20, 'qwe', 'hgfvb b ', 'hgfbcvb', '2026-01-02 05:30:58'),
(13, '', 'xyz', 20, 'wewdewfsdf', 'sdfsf', 'ewrfsdf', '2026-01-02 08:32:21'),
(14, 'Dr. Hasan Ali', 'xyz', 20, 'wewdewfsdf', 'sdfsf', 'ewrfsdf', '2026-01-02 08:38:25'),
(15, 'Dr. Nusrat Jahan', 'Md.Shaharia Hossen', 0, 'shdgshjd', 'ndmsznnx', 'dm,mcnxzm,nc', '2026-01-02 09:01:29'),
(16, 'Dr. Nusrat Jahan', 'Md.Shaharia Hossen', 0, 'shdgshjd', 'ndmsznnx', 'dm,mcnxzm,nc', '2026-01-02 09:14:54'),
(17, 'Dr. Nusrat Jahan', 'Md.Shaharia Hossen', 0, 'shdgshjd', 'ndmsznnx', 'dm,mcnxzm,nc', '2026-01-02 09:15:06'),
(18, 'Dr. Nusrat Jahan', 'Md.Shaharia Hossen', 0, 'shdgshjd', 'ndmsznnx', 'dm,mcnxzm,nc', '2026-01-02 09:24:31'),
(19, 'Dr. Nusrat Jahan', 'Md.Shaharia Hossen', 24, 'dsfsdf', 'dsfdcvfdgv', 'dfgv', '2026-01-02 09:24:47'),
(20, 'Dr. Nusrat Jahan', 'Md.Shaharia Hossen', 20, 'ewrdffd', 'dffv', 'asdf', '2026-01-02 09:25:13'),
(21, 'Dr. Nusrat Jahan', 'Md.Shaharia Hossen', 12, 'qwe', 'ddc', 'hhbh', '2026-01-02 09:26:17'),
(22, 'Dr. Nusrat Jahan', 'Md.Shaharia Hossen', 12, 'qwe', 'ddc', 'hhbh', '2026-01-02 09:26:22'),
(23, 'Dr. Nusrat Jahan', 'Md.Shaharia Hossen', 12, 'qwe', 'ddc', 'hhbh', '2026-01-02 09:26:37'),
(24, 'Dr. Nusrat Jahan', 'Md.Shaharia Hossen', 12, 'qwe', 'ddc', 'hhbh', '2026-01-02 09:28:33'),
(25, 'Dr. Nusrat Jahan', 'Md.Shaharia Hossen', 20, 'iooi9', 'kuilkili', 'klilki', '2026-01-03 03:08:37'),
(26, 'Dr. Nusrat Jahan', 'Md.Shaharia Hossen', 20, 'iooi9', 'kuilkili', 'klilki', '2026-01-03 03:17:05'),
(27, 'Dr. Nusrat Jahan', 'Md.Shaharia Hossen', 60, 'dcvv', 'dfghy', 'fndkfj', '2026-01-03 03:46:56'),
(28, 'Dr. Nusrat Jahan', 'Md.Shaharia Hossen', 60, 'abc', 'abc', 'abc', '2026-01-03 15:46:19'),
(29, 'Dr. Nusrat Jahan', 'Md.Shaharia Hossen', 50, 'qwe', 'qwe', 'qwe', '2026-01-03 16:27:52');

-- --------------------------------------------------------

--
-- Table structure for table `useractivity`
--

CREATE TABLE `useractivity` (
  `session_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_role` enum('Admin','Doctor','Nurse','Receptionist','Patient') NOT NULL,
  `login_time` datetime NOT NULL DEFAULT current_timestamp(),
  `logout_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useractivity`
--

INSERT INTO `useractivity` (`session_id`, `user_name`, `user_email`, `user_role`, `login_time`, `logout_time`) VALUES
(3, 'Admin', 'admin@hospital.com', 'Admin', '2026-01-03 17:05:59', '2026-01-03 17:11:16'),
(4, 'Admin', 'admin@hospital.com', 'Admin', '2026-01-03 17:11:18', NULL),
(5, 'Admin', 'admin@hospital.com', 'Admin', '2026-01-03 20:30:22', '2026-01-03 21:15:39'),
(6, 'Admin', 'admin@hospital.com', 'Admin', '2026-01-03 21:15:43', NULL),
(7, 'Admin', 'admin@hospital.com', 'Admin', '2026-01-04 15:37:36', '2026-01-04 15:41:48'),
(8, 'Admin', 'admin@hospital.com', 'Admin', '2026-01-04 15:41:49', '2026-01-04 16:14:25'),
(9, 'Admin', 'admin@hospital.com', 'Admin', '2026-01-04 16:14:27', '2026-01-04 16:15:00'),
(10, 'Admin', 'admin@hospital.com', 'Admin', '2026-01-05 19:39:43', '2026-01-05 20:25:47'),
(11, 'Admin', 'admin@hospital.com', 'Admin', '2026-01-05 20:26:37', NULL),
(12, 'Admin', 'admin@hospital.com', 'Admin', '2026-01-05 21:17:29', NULL),
(13, 'Admin', 'admin@hospital.com', 'Admin', '2026-01-05 23:01:39', '2026-01-05 23:01:43'),
(14, 'Admin', 'admin@hospital.com', 'Admin', '2026-01-06 13:16:08', NULL),
(15, 'Admin', 'admin@hospital.com', 'Admin', '2026-01-06 13:16:52', '2026-01-06 13:17:08'),
(16, 'Admin', 'admin@hospital.com', 'Admin', '2026-01-06 13:17:24', '2026-01-06 13:17:37'),
(17, 'Sefat', 'sefatdr@gmail.com', 'Doctor', '2026-01-06 13:17:53', '2026-01-06 13:47:20'),
(18, 'Sefat', 'sefatdr@gmail.com', 'Doctor', '2026-01-06 13:47:22', '2026-01-06 13:47:46'),
(19, 'Dr. Nusrat Jahan', 'nusrat@hospital.com', 'Doctor', '2026-01-06 13:48:50', '2026-01-06 14:10:15'),
(20, 'Nurse Tania', 'tania@hospital.com', 'Nurse', '2026-01-06 14:10:51', '2026-01-06 14:15:27'),
(21, 'Admin', 'admin@hospital.com', 'Admin', '2026-01-07 19:03:33', '2026-01-07 19:23:22'),
(22, 'kabir', 'kabir69@gmail.com', 'Patient', '2026-01-07 19:24:28', '2026-01-07 19:38:13'),
(23, 'kabir', 'kabir69@gmail.com', 'Patient', '2026-01-07 19:39:49', '2026-01-07 20:02:13'),
(24, 'Admin', 'admin@hospital.com', 'Admin', '2026-01-07 20:02:20', NULL),
(25, 'Admin', 'admin@hospital.com', 'Admin', '2026-01-07 21:08:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `serial` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` int(10) UNSIGNED NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `bloodgroup` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `role` enum('Admin','Doctor','Nurse','Patient','Receptionist') NOT NULL,
  `speciality` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`serial`, `name`, `age`, `dob`, `gender`, `bloodgroup`, `email`, `password`, `mobile`, `role`, `speciality`, `image`) VALUES
(1, 'Admin', 22, '2003-04-19', 'Male', 'A+', 'admin@hospital.com', 'admin1234', '01517261455', 'Admin', '', '../../Profile/Model/1767620678.png'),
(2, 'Rina Akter', 28, '1997-03-15', 'Female', 'A+', 'reception@hospital.com', 'RinaAkter123', '01710000002', 'Receptionist', NULL, NULL),
(3, 'Dr. Hasan Ali', 49, '1980-02-12', 'Male', 'B+', 'hasan@hospital.com', 'admin1234', '01710000003', 'Doctor', 'Cardiology', NULL),
(4, 'Dr. Nusrat Jahan', 38, '1987-07-08', 'Female', 'O+', 'nusrat@hospital.com', 'DrNusratJahan123', '01710000004', 'Doctor', 'Neurology', NULL),
(5, 'Dr. Kamal Hossain', 50, '1975-09-21', 'Male', 'A-', 'kamal@hospital.com', 'DrKamalHossain123', '01710000005', 'Doctor', 'Orthopedics', NULL),
(6, 'Dr. Farzana Rahman', 42, '1983-11-30', 'Female', 'AB+', 'farzana@hospital.com', 'DrFarzanaRahman123', '01710000006', 'Doctor', 'Gynecology', NULL),
(7, 'Dr. Imran Khan', 35, '1990-05-17', 'Male', 'B-', 'imran@hospital.com', 'DrImranKhan123', '01710000007', 'Doctor', 'Dermatology', NULL),
(8, 'Nurse Salma', 30, '1995-04-10', 'Female', 'O+', 'salma@hospital.com', 'NurseSalma123', '01710000008', 'Nurse', NULL, NULL),
(9, 'Nurse Rahima', 35, '1992-06-18', 'Female', 'A+', 'rahima@hospital.com', 'NurseRahima123', '01710000009', 'Nurse', NULL, NULL),
(10, 'Nurse Jamal', 36, '1989-08-05', 'Male', 'B+', 'jamal@hospital.com', 'NurseJamal123', '01710000010', 'Nurse', NULL, NULL),
(11, 'Nurse Tania', 29, '1996-01-22', 'Female', 'AB-', 'tania@hospital.com', 'NurseTania123', '01710000011', 'Nurse', NULL, NULL),
(12, 'Nurse Arif', 34, '1991-12-03', 'Male', 'O-', 'arif@hospital.com', 'NurseArif123', '01710000019', 'Nurse', NULL, NULL),
(13, 'Asif Akber', 22, '2003-04-19', 'Male', 'A+', 'asif@gmail.com', 'Asif123', '01810000001', 'Patient', NULL, NULL),
(14, 'Mehedi Hasan', 27, '1998-02-14', 'Male', 'A+', 'mehedi@gmail.com', 'MehediHasan123', '01810000002', 'Patient', NULL, NULL),
(15, 'Sadia Islam', 24, '2001-06-30', 'Female', 'B+', 'sadia@gmail.com', 'SadiaIslam123', '01810000003', 'Patient', NULL, NULL),
(16, 'Rakib Hossain', 31, '1994-10-09', 'Male', 'AB+', 'rakib@gmail.com', 'RakibHossain123', '01810000004', 'Patient', NULL, NULL),
(17, 'Nabila Khan', 26, '1999-12-19', 'Female', 'O-', 'nabila@gmail.com', 'NabilaKhan123', '01810000005', 'Patient', NULL, NULL),
(21, 'Sefat', 25, '2000-12-12', 'Male', 'O+', 'sefat@gmail.com', 'sefat123', '01800000006', 'Patient', '', ''),
(26, 'Dr. Ariful Islam', 32, '2026-01-15', 'Male', 'A+', 'drarif@hospital.com', 'drarif123', '01611794849', 'Doctor', 'Neurology', NULL),
(27, 'Dr. Kabir', 69, '2026-01-03', 'Male', 'A+', 'drkabir@hospital.com', 'drkabir13', '01912345678', 'Doctor', 'Gynecology', NULL),
(28, 'Nurse Shihab', 35, '1990-07-11', 'Male', 'A+', 'shihab@hospital.com', 'shihab123', '01315666305', 'Nurse', NULL, NULL),
(29, 'Khalid', 20, '2005-02-02', 'Male', 'A+', 'khalid@gmail.com', 'khalid123', '01912345678', 'Patient', NULL, NULL),
(30, 'Asif', 26, '2026-01-27', 'Male', 'A+', 'asifdr@gmail.com', 'asif1234', '01611794849', 'Doctor', 'Cardiology', NULL),
(32, 'Ruma Khatun', 36, '2026-01-14', 'Male', 'A+', 'ruma@gmail.com', 'ruma123', '01517261456', 'Receptionist', NULL, NULL),
(35, 'Akber', 23, '1959-02-05', 'Male', 'B+', 'akber@gmail.com', 'akber12', '01557886093', 'Patient', '', ''),
(37, 'Sefat', 29, '1995-12-12', 'Male', 'A+', 'sefatsefat@gmail.com', 'sefat1212', '01517261455', 'Doctor', 'Dermatology', NULL),
(48, 'atkiya', 24, '1995-12-16', 'Male', 'A+', 'atkiya@gmail.com', 'atkiya456', '01611794849', 'Nurse', NULL, NULL),
(49, 'Nurse Tamanna', 20, '2005-12-06', 'Male', 'A+', 'tamanna@gmail.com', 'tamanna123', '01517261665', 'Nurse', NULL, NULL),
(50, 'Sefat', 23, '2026-01-15', 'Male', 'A+', 'sefatal@gmail.com', 'sefatal123', '01557881262', 'Receptionist', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointmentsandbill`
--
ALTER TABLE `appointmentsandbill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nurseschedule`
--
ALTER TABLE `nurseschedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `useractivity`
--
ALTER TABLE `useractivity`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`serial`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointmentsandbill`
--
ALTER TABLE `appointmentsandbill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `nurseschedule`
--
ALTER TABLE `nurseschedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `useractivity`
--
ALTER TABLE `useractivity`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `serial` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
