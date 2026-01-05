-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2026 at 04:34 PM
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
(1, 'Admin', 23, '2003-04-19', 'Male', 'A+', 'admin@hospital.com', 'admin1234', '01517261455', 'Admin', '', '../../Profile/Model/1767620678.png'),
(2, 'Rina Akter', 28, '1997-03-15', 'Female', 'A+', 'reception@hospital.com', 'RinaAkter123', '01710000002', 'Receptionist', NULL, NULL),
(3, 'Dr. Hasan Ali', 45, '1980-02-12', 'Male', 'B+', 'hasan@hospital.com', 'DrHasanAli123', '01710000003', 'Doctor', 'Cardiology', NULL),
(4, 'Dr. Nusrat Jahan', 38, '1987-07-08', 'Female', 'O+', 'nusrat@hospital.com', 'DrNusratJahan123', '01710000004', 'Doctor', 'Neurology', NULL),
(5, 'Dr. Kamal Hossain', 50, '1975-09-21', 'Male', 'A-', 'kamal@hospital.com', 'DrKamalHossain123', '01710000005', 'Doctor', 'Orthopedics', NULL),
(6, 'Dr. Farzana Rahman', 42, '1983-11-30', 'Female', 'AB+', 'farzana@hospital.com', 'DrFarzanaRahman123', '01710000006', 'Doctor', 'Gynecology', NULL),
(7, 'Dr. Imran Khan', 35, '1990-05-17', 'Male', 'B-', 'imran@hospital.com', 'DrImranKhan123', '01710000007', 'Doctor', 'Dermatology', NULL),
(8, 'Nurse Salma', 30, '1995-04-10', 'Female', 'O+', 'salma@hospital.com', 'NurseSalma123', '01710000008', 'Nurse', NULL, NULL),
(9, 'Nurse Rahima', 33, '1992-06-18', 'Female', 'A+', 'rahima@hospital.com', 'NurseRahima123', '01710000009', 'Nurse', NULL, NULL),
(10, 'Nurse Jamal', 36, '1989-08-05', 'Male', 'B+', 'jamal@hospital.com', 'NurseJamal123', '01710000010', 'Nurse', NULL, NULL),
(11, 'Nurse Tania', 29, '1996-01-22', 'Female', 'AB-', 'tania@hospital.com', 'NurseTania123', '01710000011', 'Nurse', NULL, NULL),
(12, 'Nurse Arif', 34, '1991-12-03', 'Male', 'O-', 'arif@hospital.com', 'NurseArif123', '01710000012', 'Nurse', NULL, NULL),
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
(32, 'Ruma Khatun', 36, '2026-01-14', 'Male', 'A+', 'ruma@gmail.com', 'ruma123', '01517261455', 'Receptionist', NULL, NULL),
(33, 'Sefat', 23, '2000-12-12', 'Male', 'A+', 'sefatdr@gmail.com', 'sifat1234', '01611794849', 'Doctor', 'Cardiology', NULL),
(34, 'Antor', 23, '2003-06-08', 'Male', 'A+', 'antor@gmail.com', '123456', '01912345678', 'Nurse', NULL, NULL),
(35, 'Akber', 23, '1959-02-05', 'Male', 'B+', 'akber@gmail.com', 'akber123', '01557886093', 'Patient', '', '');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `serial` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
