-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2021 at 01:32 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinicsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `id` int(65) NOT NULL,
  `username` varchar(65) NOT NULL,
  `password` varchar(65) NOT NULL,
  `user_type` int(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`id`, `username`, `password`, `user_type`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 3),
(5, 'joel', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(6, 'testing', '81dc9bdb52d04dc20036dbd8313ed055', 1);

-- --------------------------------------------------------

--
-- Table structure for table `diagnose_to_seek`
--

CREATE TABLE `diagnose_to_seek` (
  `id` int(65) NOT NULL,
  `patient_id` int(65) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `diagnosis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diagnose_to_seek`
--

INSERT INTO `diagnose_to_seek` (`id`, `patient_id`, `date`, `time`, `diagnosis`) VALUES
(4, 42, '2021-10-06', '04:02:48', 'diagnosis testing');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_record`
--

CREATE TABLE `doctor_record` (
  `id` int(65) NOT NULL,
  `firstname` varchar(65) NOT NULL,
  `middlename` varchar(65) NOT NULL,
  `lastname` varchar(65) NOT NULL,
  `contact_number` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_time_in`
--

CREATE TABLE `doctor_time_in` (
  `id` int(65) NOT NULL,
  `doctor_id` int(65) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor_time_in`
--

INSERT INTO `doctor_time_in` (`id`, `doctor_id`, `date`, `time`) VALUES
(1, 1, '2021-10-05', '16:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `env_sanitation_rescident_record`
--

CREATE TABLE `env_sanitation_rescident_record` (
  `id` int(65) NOT NULL,
  `firstname` varchar(65) NOT NULL,
  `middlename` varchar(65) NOT NULL,
  `lastname` varchar(65) NOT NULL,
  `age` int(65) NOT NULL,
  `purok` varchar(65) NOT NULL,
  `has_compospit` tinyint(1) NOT NULL,
  `has_garden` tinyint(1) NOT NULL,
  `has_cr` tinyint(1) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` int(65) NOT NULL,
  `patient_id` int(65) NOT NULL,
  `given_medicine` text NOT NULL,
  `date` datetime NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient_checkup_dates`
--

CREATE TABLE `patient_checkup_dates` (
  `id` int(65) NOT NULL,
  `patient_id` int(65) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient_record`
--

CREATE TABLE `patient_record` (
  `id` int(65) NOT NULL,
  `firstname` varchar(65) NOT NULL,
  `middlename` varchar(65) NOT NULL,
  `lastname` varchar(65) NOT NULL,
  `fullname` text NOT NULL,
  `age` int(65) NOT NULL,
  `gender` varchar(65) NOT NULL,
  `height` varchar(65) NOT NULL,
  `weight` varchar(65) NOT NULL,
  `civil_status` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_record`
--

INSERT INTO `patient_record` (`id`, `firstname`, `middlename`, `lastname`, `fullname`, `age`, `gender`, `height`, `weight`, `civil_status`) VALUES
(42, 'Joel ', 'John', 'Centeno', 'Joel  John Centeno', 22, 'Male', '178 cm', '75 lbs', 'Single');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_management`
--

CREATE TABLE `prescription_management` (
  `id` int(65) NOT NULL,
  `patient_id` int(65) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_highblood_maintenance`
--

CREATE TABLE `schedule_highblood_maintenance` (
  `id` int(65) NOT NULL,
  `patient_id` int(65) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `is_given_medicine` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_pregnant_immunization`
--

CREATE TABLE `schedule_pregnant_immunization` (
  `id` int(65) NOT NULL,
  `patient_id` int(65) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `is_given_medicine` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_tuberculosis_maintenance`
--

CREATE TABLE `schedule_tuberculosis_maintenance` (
  `id` int(65) NOT NULL,
  `patient_id` int(65) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `is_given_medicine` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_underweight_children`
--

CREATE TABLE `schedule_underweight_children` (
  `id` int(65) NOT NULL,
  `patient_id` int(65) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `is_given_medicine` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `symptoms_complains`
--

CREATE TABLE `symptoms_complains` (
  `id` int(65) NOT NULL,
  `patient_id` int(65) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `complain` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `symptoms_complains`
--

INSERT INTO `symptoms_complains` (`id`, `patient_id`, `date`, `time`, `complain`) VALUES
(2, 42, '2021-10-24', '08:53:48', 'test 2'),
(3, 0, '2021-10-24', '09:10:04', 'third complain'),
(6, 0, '2021-10-24', '10:43:03', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(65) NOT NULL,
  `fullname` varchar(65) NOT NULL,
  `email` varchar(65) NOT NULL,
  `mobile_number` int(65) NOT NULL,
  `address` int(65) NOT NULL,
  `credentials_id` int(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `mobile_number`, `address`, `credentials_id`) VALUES
(1, 'joel', 'joel@gmail.com', 123, 0, 5),
(2, 'Testing', 'testing@gmail.com', 2147483647, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `vital_signs_measure`
--

CREATE TABLE `vital_signs_measure` (
  `id` int(65) NOT NULL,
  `patient_id` int(65) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `vital_measure` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diagnose_to_seek`
--
ALTER TABLE `diagnose_to_seek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_record`
--
ALTER TABLE `doctor_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_time_in`
--
ALTER TABLE `doctor_time_in`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `env_sanitation_rescident_record`
--
ALTER TABLE `env_sanitation_rescident_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_checkup_dates`
--
ALTER TABLE `patient_checkup_dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_record`
--
ALTER TABLE `patient_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescription_management`
--
ALTER TABLE `prescription_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_highblood_maintenance`
--
ALTER TABLE `schedule_highblood_maintenance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_pregnant_immunization`
--
ALTER TABLE `schedule_pregnant_immunization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_tuberculosis_maintenance`
--
ALTER TABLE `schedule_tuberculosis_maintenance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_underweight_children`
--
ALTER TABLE `schedule_underweight_children`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `symptoms_complains`
--
ALTER TABLE `symptoms_complains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vital_signs_measure`
--
ALTER TABLE `vital_signs_measure`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `credentials`
--
ALTER TABLE `credentials`
  MODIFY `id` int(65) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `diagnose_to_seek`
--
ALTER TABLE `diagnose_to_seek`
  MODIFY `id` int(65) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `doctor_record`
--
ALTER TABLE `doctor_record`
  MODIFY `id` int(65) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `doctor_time_in`
--
ALTER TABLE `doctor_time_in`
  MODIFY `id` int(65) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `env_sanitation_rescident_record`
--
ALTER TABLE `env_sanitation_rescident_record`
  MODIFY `id` int(65) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` int(65) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patient_checkup_dates`
--
ALTER TABLE `patient_checkup_dates`
  MODIFY `id` int(65) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_record`
--
ALTER TABLE `patient_record`
  MODIFY `id` int(65) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `prescription_management`
--
ALTER TABLE `prescription_management`
  MODIFY `id` int(65) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule_highblood_maintenance`
--
ALTER TABLE `schedule_highblood_maintenance`
  MODIFY `id` int(65) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule_pregnant_immunization`
--
ALTER TABLE `schedule_pregnant_immunization`
  MODIFY `id` int(65) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule_tuberculosis_maintenance`
--
ALTER TABLE `schedule_tuberculosis_maintenance`
  MODIFY `id` int(65) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule_underweight_children`
--
ALTER TABLE `schedule_underweight_children`
  MODIFY `id` int(65) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `symptoms_complains`
--
ALTER TABLE `symptoms_complains`
  MODIFY `id` int(65) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(65) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vital_signs_measure`
--
ALTER TABLE `vital_signs_measure`
  MODIFY `id` int(65) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
