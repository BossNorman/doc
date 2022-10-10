-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2022 at 07:54 AM
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
-- Database: `doc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `admin_email_address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `admin_password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `admin_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_email_address`, `admin_password`, `admin_name`) VALUES
(1, 'admin@admin.com', 'password', 'BossNorman');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_table`
--

CREATE TABLE `appointment_table` (
  `appointment_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_schedule_id` int(11) NOT NULL,
  `reason_for_appointment` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_comment` mediumtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `appointment_table`
--

INSERT INTO `appointment_table` (`appointment_id`, `doctor_id`, `patient_id`, `doctor_schedule_id`, `reason_for_appointment`, `status`, `doctor_comment`) VALUES
(14, 1, 3, 25, 'hi, are you available tonight? ara-ara', 'Completed', 'oh yesss. meet me at my clinic. 3'),
(15, 0, 3, 0, 'hello', 'Booked', ''),
(16, 1, 3, 27, 'hi. do you want to taste my mother made? ; *', 'Accept', ''),
(17, 1, 3, 28, 'doc, masakit ang puso ko!\r\nkapag wala ka.\r\nayieee!', 'Reject', ''),
(18, 1, 3, 29, 'doc, nababaliw na ata ako\r\n\r\nkapag wala ka\r\nayeiii!', 'Booked', '');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedule_table`
--

CREATE TABLE `doctor_schedule_table` (
  `doctor_schedule_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `doctor_schedule_date` date NOT NULL,
  `doctor_schedule_day` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') COLLATE utf8_unicode_ci NOT NULL,
  `doctor_schedule_start_time` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_schedule_end_time` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `average_consulting_time` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctor_schedule_table`
--

INSERT INTO `doctor_schedule_table` (`doctor_schedule_id`, `doctor_id`, `doctor_schedule_date`, `doctor_schedule_day`, `doctor_schedule_start_time`, `doctor_schedule_end_time`, `average_consulting_time`) VALUES
(25, 1, '2022-10-09', 'Sunday', '07:00', '08:00', 10),
(27, 1, '2022-10-09', 'Sunday', '08:00', '09:00', 5),
(28, 1, '2022-10-09', 'Sunday', '09:00', '10:00', 10),
(29, 1, '2022-10-09', 'Sunday', '14:00', '15:30', 25);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_table`
--

CREATE TABLE `doctor_table` (
  `doctor_id` int(11) NOT NULL,
  `doctor_email_address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_profile_image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_phone_no` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_address` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `doctor_date_of_birth` date NOT NULL,
  `doctor_degree` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `specs_id` int(5) NOT NULL,
  `doctor_prc` int(10) NOT NULL,
  `clinic_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `clinic_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL,
  `doctor_added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctor_table`
--

INSERT INTO `doctor_table` (`doctor_id`, `doctor_email_address`, `doctor_password`, `doctor_name`, `doctor_profile_image`, `doctor_phone_no`, `doctor_address`, `doctor_date_of_birth`, `doctor_degree`, `specs_id`, `doctor_prc`, `clinic_name`, `clinic_address`, `doctor_status`, `doctor_added_on`) VALUES
(1, 'johndoe@gmail.com', 'password', 'Dr. John Doe', '../images/10872.jpg', '7539518520', '56, Metro Manila, PHL', '1985-10-29', 'MBBS MS', 3, 1234567, 'John Clinic', 'Naval, Biliran', 'Active', '2022-02-15 17:04:59'),
(2, 'jude@gmail.com', 'password', 'Dr. Jude Suarez', '../images/385593837.jpg', '753852963', '105, Metro Manila, PHL', '1982-08-10', 'MBBS MD(Cardiac)', 1, 1234567, 'Jude Clinic', 'Culaba, Biliran', 'Active', '2022-02-18 15:00:32'),
(7, 'doctor1@mail.com', '12345', 'Dr. Doc1', '../images/1762591762.jpg', '09876543211', 'Manila', '1984-06-05', 'BSCS', 1, 1234567, 'Clinic 1', 'Naval, Biliran', 'Active', '2022-10-02 16:23:29');

-- --------------------------------------------------------

--
-- Table structure for table `patient_table`
--

CREATE TABLE `patient_table` (
  `patient_id` int(11) NOT NULL,
  `patient_email_address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `patient_password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patient_first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patient_last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `patient_date_of_birth` date NOT NULL,
  `patient_gender` enum('Male','Female','Other') COLLATE utf8_unicode_ci NOT NULL,
  `patient_address` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `patient_phone_no` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `patient_maritial_status` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `patient_added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `patient_table`
--

INSERT INTO `patient_table` (`patient_id`, `patient_email_address`, `patient_password`, `patient_first_name`, `patient_last_name`, `patient_date_of_birth`, `patient_gender`, `patient_address`, `patient_phone_no`, `patient_maritial_status`, `patient_added_on`) VALUES
(3, 'patient1@gmail.com', '12345', 'Patient1', 'Sample', '1990-02-01', 'Male', '12, Davao, PHL', '85745635210', 'Single', '2022-02-18 16:34:55'),
(4, 'dieqcohr@gmail.com', 'password', 'Dieqcohr', 'Rufino', '2001-04-05', 'Male', '476, Las Piñas, PHL', '7539518520', 'Married', '2022-02-19 18:28:23'),
(5, 'krystel@programmer.net', 'password', 'Krystel', 'Suarez', '1995-07-25', 'Female', '8292, Quezon, PHL', '75394511442', 'Single', '2022-02-23 17:50:06'),
(6, 'patient@gmail.com', '12345', 'Dummy', 'Account', '1990-06-12', 'Male', 'Manila', '09876543211', 'Single', '2022-10-03 17:27:07'),
(7, 'sample1@gmail.com', 'sample123', 'Sample', 'Sample', '2001-03-01', 'Male', 'Naval', '09876543211', 'Married', '2022-10-05 09:12:57');

-- --------------------------------------------------------

--
-- Table structure for table `specialization_table`
--

CREATE TABLE `specialization_table` (
  `specs_id` int(5) NOT NULL,
  `specs_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specialization_table`
--

INSERT INTO `specialization_table` (`specs_id`, `specs_name`) VALUES
(1, 'Allergology'),
(2, 'General Practice'),
(3, 'Internal medicine'),
(4, 'Anesthesia'),
(5, 'Pulmonology'),
(6, 'Occupational medicine'),
(7, 'Ophthalmology'),
(8, 'Urology'),
(9, 'Hemalogy'),
(10, 'Surgery'),
(11, 'Gynecology'),
(12, 'Angiology'),
(13, 'Hand surgery'),
(14, 'Dermatology'),
(15, 'Cardiology'),
(16, 'Endocrinology'),
(17, 'Infectiology'),
(18, 'Pediatrics'),
(19, 'Child psychiatry'),
(20, 'Gastroenterology'),
(21, 'Oral surgery'),
(22, 'Maxillo surgery'),
(23, 'Neurology'),
(24, 'Nephrology'),
(25, 'Otolaryngology'),
(26, 'Pathology'),
(27, 'Plastic Surgery'),
(28, 'Psychiatry'),
(29, 'Radiology'),
(30, 'Forensic medicine'),
(31, 'Rheumatology'),
(32, 'Tropical medicine'),
(33, 'Oncology'),
(34, 'Dentistry'),
(35, 'Acupuncture'),
(36, 'Geriatric medicine'),
(37, 'Homeopathy'),
(38, 'Orthodontics'),
(39, 'Orthopedics'),
(40, 'Manual medicine'),
(41, 'Sports medicine');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appointment_table`
--
ALTER TABLE `appointment_table`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `doctor_schedule_table`
--
ALTER TABLE `doctor_schedule_table`
  ADD PRIMARY KEY (`doctor_schedule_id`);

--
-- Indexes for table `doctor_table`
--
ALTER TABLE `doctor_table`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `patient_table`
--
ALTER TABLE `patient_table`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `specialization_table`
--
ALTER TABLE `specialization_table`
  ADD PRIMARY KEY (`specs_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment_table`
--
ALTER TABLE `appointment_table`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `doctor_schedule_table`
--
ALTER TABLE `doctor_schedule_table`
  MODIFY `doctor_schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `doctor_table`
--
ALTER TABLE `doctor_table`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `patient_table`
--
ALTER TABLE `patient_table`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `specialization_table`
--
ALTER TABLE `specialization_table`
  MODIFY `specs_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
