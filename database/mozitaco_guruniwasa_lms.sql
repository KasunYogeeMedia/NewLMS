-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 04, 2023 at 09:21 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mozitaco_guruniwasa_lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `lmsclass`
--

CREATE TABLE `lmsclass` (
  `cid` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmsclass`
--

INSERT INTO `lmsclass` (`cid`, `name`, `add_date`, `status`) VALUES
(1, 'Sinhala Medium', '2022-10-12 12:15:23', 'Publish'),
(2, 'English Medium', '2022-10-12 12:15:52', 'Publish'),
(3, 'All', '2022-11-23 11:56:34', 'Publish');

-- --------------------------------------------------------

--
-- Table structure for table `lmsclasstute`
--

CREATE TABLE `lmsclasstute` (
  `ctuid` int NOT NULL,
  `tid` int NOT NULL,
  `class` int NOT NULL DEFAULT '1',
  `subject` int NOT NULL DEFAULT '1',
  `month` varchar(50) NOT NULL DEFAULT '1',
  `ctype` varchar(50) NOT NULL,
  `title` text NOT NULL,
  `tdocument` varchar(500) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lmsclasstute_std`
--

CREATE TABLE `lmsclasstute_std` (
  `ctuid` int NOT NULL,
  `tid` int DEFAULT NULL,
  `class` int NOT NULL DEFAULT '1',
  `subject` int NOT NULL DEFAULT '1',
  `month` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1',
  `ctype` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1',
  `title` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tdocument` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lmsclasstute_std`
--

INSERT INTO `lmsclasstute_std` (`ctuid`, `tid`, `class`, `subject`, `month`, `ctype`, `title`, `tdocument`, `add_date`, `status`) VALUES
(28, 35, 2, 12, '1', 'Notes', 'test', 'sample.pdf.pdf', '2023-01-04 04:26:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lmsdb`
--

CREATE TABLE `lmsdb` (
  `id` int NOT NULL,
  `dbname` varchar(400) NOT NULL,
  `username` varchar(400) NOT NULL,
  `password` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmsdb`
--

INSERT INTO `lmsdb` (`id`, `dbname`, `username`, `password`) VALUES
(1, 'mozitaco_guruniwasa_lms', 'mozitaco_guruniwasa_lms', 'i?tuuNYXHtR(');

-- --------------------------------------------------------

--
-- Table structure for table `lmsebook`
--

CREATE TABLE `lmsebook` (
  `ctuid` int NOT NULL,
  `tid` int NOT NULL,
  `class` int NOT NULL,
  `subject` int NOT NULL,
  `ctype` varchar(50) NOT NULL,
  `title` text NOT NULL,
  `tdocument` varchar(500) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmsebook`
--

INSERT INTO `lmsebook` (`ctuid`, `tid`, `class`, `subject`, `ctype`, `title`, `tdocument`, `add_date`, `status`) VALUES
(7, 35, 1, 6, 'Student Achevements', 'Sample Achevementfb', 'user8-128x128.jpg.jpg', '2023-01-04 04:25:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lmsgetway`
--

CREATE TABLE `lmsgetway` (
  `id` int NOT NULL,
  `app_id` varchar(4000) NOT NULL,
  `hash_salt` varchar(4000) NOT NULL,
  `a_token` varchar(4000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmsgetway`
--

INSERT INTO `lmsgetway` (`id`, `app_id`, `hash_salt`, `a_token`) VALUES
(1, 'O3RP1189E0E4B71049D0F', '3PP41189E0E4B71049D3B', 'ec18f1ad505692f18d988fc3bd55ff923f514609cc0260b59f313a8b45a9815b8f358981a0f48bbf.IOD11189E0E4B71049D5F');

-- --------------------------------------------------------

--
-- Table structure for table `lmslesson`
--

CREATE TABLE `lmslesson` (
  `lid` int NOT NULL,
  `tid` int NOT NULL,
  `type` varchar(50) NOT NULL,
  `class` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `title` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_sinhala_ci NOT NULL,
  `available_days` varchar(100) NOT NULL DEFAULT '30',
  `no_of_views_per_day` int NOT NULL DEFAULT '10',
  `cover` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `video` varchar(1000) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmslesson`
--

INSERT INTO `lmslesson` (`lid`, `tid`, `type`, `class`, `subject`, `title`, `available_days`, `no_of_views_per_day`, `cover`, `video`, `add_date`, `status`) VALUES
(777, 35, 'general', '2', '11', 'Test Video', '30', 10, NULL, 'https://www.youtube.com/embed/fsDe5iAJfBc', '2022-12-30 13:44:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lmsregister`
--

CREATE TABLE `lmsregister` (
  `reid` int NOT NULL,
  `stnumber` varchar(200) NOT NULL,
  `email` varchar(400) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `dob` varchar(400) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `school` varchar(400) NOT NULL,
  `district` varchar(200) NOT NULL,
  `town` varchar(400) DEFAULT NULL,
  `pcontactnumber` varchar(20) DEFAULT NULL,
  `pemail` varchar(200) DEFAULT NULL,
  `pname` varchar(4000) DEFAULT NULL,
  `contactnumber` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `level` int NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(500) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `relogin` int NOT NULL,
  `reloging_ip` int NOT NULL,
  `payment` int NOT NULL,
  `verifycode` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lmssms`
--

CREATE TABLE `lmssms` (
  `id` int NOT NULL,
  `sa_token` varchar(4000) NOT NULL,
  `sender_id` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmssms`
--

INSERT INTO `lmssms` (`id`, `sa_token`, `sender_id`) VALUES
(1, '27|reicnWZOqu6gH96YONqqrkKp8F7ilNPOp5nREtjP', ' Atlas Learn ');

-- --------------------------------------------------------

--
-- Table structure for table `lmsstudent_subject`
--

CREATE TABLE `lmsstudent_subject` (
  `ssid` int NOT NULL,
  `student` int NOT NULL DEFAULT '0',
  `subject` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lmssubject`
--

CREATE TABLE `lmssubject` (
  `sid` int NOT NULL,
  `class_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmssubject`
--

INSERT INTO `lmssubject` (`sid`, `class_id`, `name`, `add_date`, `status`) VALUES
(1, 1, 'Grade 6', '2022-10-12 15:38:42', 'Publish'),
(2, 1, 'Grade 7', '2022-10-12 15:39:02', 'Publish'),
(3, 1, 'Grade 8', '2022-10-12 15:39:12', 'Publish'),
(4, 1, 'Grade 9', '2022-10-12 15:39:23', 'Publish'),
(5, 1, 'Grade 10', '2022-10-12 15:39:47', 'Publish'),
(6, 1, 'Grade 11', '2022-10-12 15:39:57', 'Publish'),
(7, 2, 'Grade 6', '2022-10-12 15:40:16', 'Publish'),
(8, 2, 'Grade 7', '2022-10-12 15:40:32', 'Publish'),
(9, 2, 'Grade 8', '2022-10-12 15:40:45', 'Publish'),
(10, 2, 'Grade 9', '2022-10-12 15:40:59', 'Publish'),
(11, 2, 'Grade 10', '2022-10-12 15:41:12', 'Publish'),
(12, 2, 'Grade 11', '2022-10-12 15:41:29', 'Publish'),
(13, 3, 'All Grades', '2022-11-23 11:57:16', 'Publish');

-- --------------------------------------------------------

--
-- Table structure for table `lmssubject_tealmsr`
--

CREATE TABLE `lmssubject_tealmsr` (
  `stid` int NOT NULL,
  `subject` int NOT NULL DEFAULT '0',
  `tealmsr` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lmstealmsr`
--

CREATE TABLE `lmstealmsr` (
  `tid` int NOT NULL,
  `systemid` int NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `district` varchar(100) NOT NULL,
  `contactnumber` varchar(50) NOT NULL,
  `pcontactno` varchar(50) NOT NULL,
  `school` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(500) NOT NULL,
  `town` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `joindate` date NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmstealmsr`
--

INSERT INTO `lmstealmsr` (`tid`, `systemid`, `fullname`, `district`, `contactnumber`, `pcontactno`, `school`, `username`, `password`, `image`, `town`, `birthday`, `gender`, `joindate`, `add_date`, `status`) VALUES
(35, 1672407335, 'Test Student', 'Gampaha', '123456789', '112233445', 'Sample College', 'kasun.yogeemedia@gmail.com', '100ce3939dc720f78063dd4cc70638f8', '1672823705reg.jpg', 'Sample City', '2022-12-01', 'Male', '2022-12-29', '2023-01-04 09:15:05', 1),
(36, 1672823528, 'Test smart student 2', 'Nuwara Eliya', '112233445', '12312312', 'Sample 2 College', 'kasun.yogeemedia2@gmail.com', '93d48f415041f2562a7c37e364ba6425', '1672823731reg.jpg', 'Sample 2 City', '2023-01-01', 'Male', '2023-01-01', '2023-01-04 09:15:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lmstealmsr_multiple`
--

CREATE TABLE `lmstealmsr_multiple` (
  `tealmsr_id` int NOT NULL,
  `tealmsr_system_id` int NOT NULL,
  `tealmsr_type` int NOT NULL,
  `tealmsr_contain_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmstealmsr_multiple`
--

INSERT INTO `lmstealmsr_multiple` (`tealmsr_id`, `tealmsr_system_id`, `tealmsr_type`, `tealmsr_contain_id`) VALUES
(403, 1672407335, 2, 2),
(404, 1672407335, 3, 11),
(405, 1672407335, 3, 6),
(406, 1672407335, 3, 12),
(409, 1672823528, 2, 3),
(410, 1672823528, 3, 5);

-- --------------------------------------------------------

--
-- Table structure for table `lmsurl`
--

CREATE TABLE `lmsurl` (
  `id` int NOT NULL,
  `url` varchar(4000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmsurl`
--

INSERT INTO `lmsurl` (`id`, `url`) VALUES
(1, 'http://localhost/NewLMS/');

-- --------------------------------------------------------

--
-- Table structure for table `lmsusers`
--

CREATE TABLE `lmsusers` (
  `user_id` int NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `admintype` varchar(20) NOT NULL,
  `admin` varchar(20) NOT NULL,
  `students` varchar(20) NOT NULL,
  `teachers` varchar(20) NOT NULL,
  `class` varchar(20) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `lesson` varchar(20) NOT NULL,
  `payments` varchar(20) NOT NULL,
  `class_schedule` varchar(20) NOT NULL,
  `mail` varchar(20) NOT NULL,
  `joining_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmsusers`
--

INSERT INTO `lmsusers` (`user_id`, `user_name`, `user_email`, `user_pass`, `admintype`, `admin`, `students`, `teachers`, `class`, `subject`, `lesson`, `payments`, `class_schedule`, `mail`, `joining_date`, `status`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$PO1NRNtexDZlefvtOw/ELe6T/uwDBkpt7JUnMoaS9O1QkDkDJILBa', 'Super Admin', 'True', 'True', 'True', 'True', 'True', 'True', 'True', 'True', 'True', '2022-02-09 03:43:58', '1');

-- --------------------------------------------------------

--
-- Table structure for table `lms_pdf`
--

CREATE TABLE `lms_pdf` (
  `ctuid` int NOT NULL,
  `class` int NOT NULL,
  `subject` int NOT NULL,
  `ctype` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_sinhala_ci NOT NULL,
  `tdocument` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ol_result`
--

CREATE TABLE `ol_result` (
  `ctuid` int NOT NULL,
  `stName` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `class` int NOT NULL DEFAULT '1',
  `subject` int NOT NULL DEFAULT '1',
  `month` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1',
  `ctype` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '1',
  `title` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tdocument` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ol_result`
--

INSERT INTO `ol_result` (`ctuid`, `stName`, `class`, `subject`, `month`, `ctype`, `title`, `tdocument`, `add_date`, `status`) VALUES
(28, 'Sample Student', 1, 1, 'A', '123456', 'Sample Batch', 'user8-128x128.jpg.jpg', '2023-01-03 12:08:09', 1),
(29, 'fdvbasdfvsd', 1, 1, 'B', 'aedvbasdb', 'avsdvasdv', 'sample.pdf.pdf', '2023-01-03 12:09:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `reg_prefix` varchar(3) NOT NULL,
  `application_name` varchar(400) NOT NULL,
  `main_logo` varchar(4000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `reg_prefix`, `application_name`, `main_logo`) VALUES
(1, 'SMP', 'Sample', 'logo.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lmsclass`
--
ALTER TABLE `lmsclass`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `lmsclasstute`
--
ALTER TABLE `lmsclasstute`
  ADD PRIMARY KEY (`ctuid`);

--
-- Indexes for table `lmsclasstute_std`
--
ALTER TABLE `lmsclasstute_std`
  ADD PRIMARY KEY (`ctuid`);

--
-- Indexes for table `lmsdb`
--
ALTER TABLE `lmsdb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lmsebook`
--
ALTER TABLE `lmsebook`
  ADD PRIMARY KEY (`ctuid`);

--
-- Indexes for table `lmsgetway`
--
ALTER TABLE `lmsgetway`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lmslesson`
--
ALTER TABLE `lmslesson`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `lmsregister`
--
ALTER TABLE `lmsregister`
  ADD PRIMARY KEY (`reid`),
  ADD UNIQUE KEY `contactnumber` (`contactnumber`),
  ADD UNIQUE KEY `fullname` (`fullname`);

--
-- Indexes for table `lmssms`
--
ALTER TABLE `lmssms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lmsstudent_subject`
--
ALTER TABLE `lmsstudent_subject`
  ADD PRIMARY KEY (`ssid`);

--
-- Indexes for table `lmssubject`
--
ALTER TABLE `lmssubject`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `lmssubject_tealmsr`
--
ALTER TABLE `lmssubject_tealmsr`
  ADD PRIMARY KEY (`stid`);

--
-- Indexes for table `lmstealmsr`
--
ALTER TABLE `lmstealmsr`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `lmstealmsr_multiple`
--
ALTER TABLE `lmstealmsr_multiple`
  ADD PRIMARY KEY (`tealmsr_id`);

--
-- Indexes for table `lmsurl`
--
ALTER TABLE `lmsurl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lmsusers`
--
ALTER TABLE `lmsusers`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `lms_pdf`
--
ALTER TABLE `lms_pdf`
  ADD PRIMARY KEY (`ctuid`);

--
-- Indexes for table `ol_result`
--
ALTER TABLE `ol_result`
  ADD PRIMARY KEY (`ctuid`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lmsclass`
--
ALTER TABLE `lmsclass`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lmsclasstute`
--
ALTER TABLE `lmsclasstute`
  MODIFY `ctuid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `lmsclasstute_std`
--
ALTER TABLE `lmsclasstute_std`
  MODIFY `ctuid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `lmsdb`
--
ALTER TABLE `lmsdb`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lmsebook`
--
ALTER TABLE `lmsebook`
  MODIFY `ctuid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lmsgetway`
--
ALTER TABLE `lmsgetway`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lmslesson`
--
ALTER TABLE `lmslesson`
  MODIFY `lid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=778;

--
-- AUTO_INCREMENT for table `lmsregister`
--
ALTER TABLE `lmsregister`
  MODIFY `reid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lmssms`
--
ALTER TABLE `lmssms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lmsstudent_subject`
--
ALTER TABLE `lmsstudent_subject`
  MODIFY `ssid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lmssubject`
--
ALTER TABLE `lmssubject`
  MODIFY `sid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `lmssubject_tealmsr`
--
ALTER TABLE `lmssubject_tealmsr`
  MODIFY `stid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lmstealmsr`
--
ALTER TABLE `lmstealmsr`
  MODIFY `tid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `lmstealmsr_multiple`
--
ALTER TABLE `lmstealmsr_multiple`
  MODIFY `tealmsr_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=411;

--
-- AUTO_INCREMENT for table `lmsurl`
--
ALTER TABLE `lmsurl`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lmsusers`
--
ALTER TABLE `lmsusers`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lms_pdf`
--
ALTER TABLE `lms_pdf`
  MODIFY `ctuid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ol_result`
--
ALTER TABLE `ol_result`
  MODIFY `ctuid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
