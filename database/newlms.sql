-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2022 at 02:16 PM
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
-- Database: `newlms`
--

-- --------------------------------------------------------

--
-- Table structure for table `exam_submissions`
--

CREATE TABLE `exam_submissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `filename` text NOT NULL,
  `time` datetime NOT NULL,
  `marks` int(11) DEFAULT NULL,
  `remark` text NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lmsclass`
--

CREATE TABLE `lmsclass` (
  `cid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmsclass`
--

INSERT INTO `lmsclass` (`cid`, `name`, `add_date`, `status`) VALUES
(4, 'Sinhala Medium', '2022-10-09 06:50:58', 'Publish'),
(7, 'For All', '2022-10-09 06:51:47', 'Publish'),
(6, 'English Medium', '2022-10-09 06:51:21', 'Publish');

-- --------------------------------------------------------

--
-- Table structure for table `lmsclasstute`
--

CREATE TABLE `lmsclasstute` (
  `ctuid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `subject` int(11) NOT NULL,
  `month` varchar(50) NOT NULL,
  `ctype` varchar(50) NOT NULL,
  `title` text NOT NULL,
  `tdocument` varchar(500) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmsclasstute`
--

INSERT INTO `lmsclasstute` (`ctuid`, `tid`, `class`, `subject`, `month`, `ctype`, `title`, `tdocument`, `add_date`, `status`) VALUES
(14, 14, 0, 0, 'A', '1234', 'Sample', '809780.jpg', '2022-10-06 07:40:22', 1),
(15, 16, 0, 0, 'B', '112233', 'Sample batch', '887735.jpg', '2022-10-09 04:47:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lmsclasstute_std`
--

CREATE TABLE `lmsclasstute_std` (
  `ctuid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `subject` int(11) NOT NULL,
  `month` varchar(50) CHARACTER SET latin1 NOT NULL,
  `ctype` varchar(50) CHARACTER SET latin1 NOT NULL,
  `title` text CHARACTER SET latin1 NOT NULL,
  `tdocument` varchar(500) CHARACTER SET latin1 NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lmsclasstute_std`
--

INSERT INTO `lmsclasstute_std` (`ctuid`, `tid`, `class`, `subject`, `month`, `ctype`, `title`, `tdocument`, `add_date`, `status`) VALUES
(14, 14, 4, 18, 'A', '1234', 'Sample ascxsc', '809780.jpg', '2022-10-06 16:40:28', 1),
(15, 16, 5, 0, 'January', 'School Papers', 'sample savhgv', '769530.jpg', '2022-10-07 10:05:22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lmsclass_schlmsle`
--

CREATE TABLE `lmsclass_schlmsle` (
  `classid` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `subject` int(11) NOT NULL,
  `tealmsr` varchar(50) NOT NULL,
  `lesson` varchar(1000) NOT NULL,
  `classdate` date NOT NULL,
  `class_start_time` time NOT NULL,
  `class_end_time` time NOT NULL,
  `classlink` text NOT NULL,
  `cpassword` varchar(100) NOT NULL,
  `classtype` varchar(20) NOT NULL,
  `image` varchar(500) NOT NULL,
  `add_date` varchar(20) NOT NULL,
  `classstatus` varchar(20) NOT NULL,
  `add_date2` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmsclass_schlmsle`
--

INSERT INTO `lmsclass_schlmsle` (`classid`, `level`, `subject`, `tealmsr`, `lesson`, `classdate`, `class_start_time`, `class_end_time`, `classlink`, `cpassword`, `classtype`, `image`, `add_date`, `classstatus`, `add_date2`) VALUES
(1, 3, 14, '12', 'Lesson 01', '2022-07-27', '18:00:00', '20:00:00', 'https://us06web.zoom.us/j/85774668516', '12345', 'Free Class', '1658458946Chaminda_copy.jpg', '2022-07-22 08:32:26', '1', '2022-07-22 03:02:26'),
(2, 3, 15, '13', 'Lesson 01', '2022-07-31', '16:00:00', '18:00:00', 'https://us06web.zoom.us/j/85774668516', '12345', 'Free Class', '1658458925Nilanthi_copy.jpg', '2022-07-22 08:32:05', '1', '2022-07-22 03:02:05'),
(7, 3, 14, '12', 'Lesson 03', '2022-07-19', '19:35:00', '21:35:00', 'https://us06web.zoom.us/j/85774668516', '12345', 'Online Class', '1658458855Chaminda_copy.jpg', '2022-07-22 08:30:55', '1', '2022-07-22 03:00:55'),
(4, 3, 15, '13', 'lesson 02', '2022-07-26', '16:00:00', '18:00:00', 'https://us06web.zoom.us/j/85774668516', '12345', 'Online Class', '1658458908Nilanthi_copy.jpg', '2022-07-22 08:31:48', '1', '2022-07-22 03:01:48'),
(5, 3, 14, '12', 'lesson 03', '2022-07-25', '18:00:00', '20:00:00', 'https://us06web.zoom.us/j/85774668516', '12345', 'Paper Class', '1658458892Chaminda_copy.jpg', '2022-07-22 08:31:32', '1', '2022-07-22 03:01:32'),
(6, 3, 15, '13', 'lesson 03', '2022-07-30', '18:00:00', '20:00:00', 'https://us06web.zoom.us/j/85774668516', '12345', 'Paper Class', '1658458876Nilanthi_copy.jpg', '2022-07-22 08:31:16', '1', '2022-07-22 03:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `lmscomments`
--

CREATE TABLE `lmscomments` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `tealmsr` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `rate` int(11) NOT NULL,
  `review` text NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmscomments`
--

INSERT INTO `lmscomments` (`id`, `uid`, `tealmsr`, `title`, `rate`, `review`, `add_date`, `status`) VALUES
(42, 1, 12, 'Test', 3, 'Good', '2022-07-19 10:58:12', '1'),
(45, 10, 12, 'Test', 3, 'Good', '2022-07-21 07:40:27', '1');

-- --------------------------------------------------------

--
-- Table structure for table `lmsdb`
--

CREATE TABLE `lmsdb` (
  `id` int(11) NOT NULL,
  `dbname` varchar(400) NOT NULL,
  `username` varchar(400) NOT NULL,
  `password` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmsdb`
--

INSERT INTO `lmsdb` (`id`, `dbname`, `username`, `password`) VALUES
(1, 'newlms', 'root', '');

-- --------------------------------------------------------

--
-- Table structure for table `lmsebook`
--

CREATE TABLE `lmsebook` (
  `ctuid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `subject` int(11) NOT NULL,
  `month` varchar(50) NOT NULL,
  `ctype` varchar(50) NOT NULL,
  `title` text NOT NULL,
  `tdocument` varchar(500) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmsebook`
--

INSERT INTO `lmsebook` (`ctuid`, `tid`, `class`, `subject`, `month`, `ctype`, `title`, `tdocument`, `add_date`, `status`) VALUES
(1, 14, 4, 18, 'January', 'Ebook', 'sample ', '895852.jpg', '2022-10-06 10:25:38', 1),
(3, 14, 4, 18, '', 'Select Class Type', 'Sample', '320450.jpg', '2022-10-06 10:13:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lmsgallery`
--

CREATE TABLE `lmsgallery` (
  `id` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lmsgetway`
--

CREATE TABLE `lmsgetway` (
  `id` int(11) NOT NULL,
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
  `lid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `class` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `title` varchar(500) NOT NULL,
  `available_days` varchar(100) NOT NULL,
  `no_of_views_per_day` int(11) NOT NULL,
  `cover` varchar(500) NOT NULL,
  `video` varchar(1000) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmslesson`
--

INSERT INTO `lmslesson` (`lid`, `tid`, `type`, `class`, `subject`, `title`, `available_days`, `no_of_views_per_day`, `cover`, `video`, `add_date`, `status`) VALUES
(734, 14, 'lesson_explanations', '4', '18', 'Sample Video Title', '20', 5, '863893.png', 'https://www.youtube.com/watch?v=_yMDC21GtwA&list=RD_yMDC21GtwA&start_radio=1', '2022-10-05 22:57:46', 1),
(735, 14, 'general', '7', '20', 'Science of life', '', 0, '106792.jpg', 'https://www.youtube.com/watch?v=_yMDC21GtwA&list=RD_yMDC21GtwA&start_radio=1', '2022-10-10 01:08:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lmsmail`
--

CREATE TABLE `lmsmail` (
  `mid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lmsonlineexams`
--

CREATE TABLE `lmsonlineexams` (
  `exid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `class` varchar(400) NOT NULL,
  `subject` int(11) NOT NULL,
  `examname` varchar(200) NOT NULL,
  `edate` datetime NOT NULL,
  `exam_end_date` datetime NOT NULL,
  `starttime` time DEFAULT NULL,
  `endtime` time DEFAULT NULL,
  `edocument` varchar(500) NOT NULL,
  `quizcount` int(11) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmsonlineexams`
--

INSERT INTO `lmsonlineexams` (`exid`, `tid`, `class`, `subject`, `examname`, `edate`, `exam_end_date`, `starttime`, `endtime`, `edocument`, `quizcount`, `add_date`, `status`) VALUES
(3, 12, '3', 14, 'exam 01', '2022-07-19 20:57:00', '2022-07-26 20:57:00', NULL, NULL, '598375.pdf', 5, '2022-07-19 15:28:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lmspayment`
--

CREATE TABLE `lmspayment` (
  `pid` int(11) NOT NULL,
  `fileName` varchar(50) DEFAULT NULL,
  `userID` int(11) NOT NULL,
  `feeID` int(11) NOT NULL,
  `pay_sub_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `accountnumber` varchar(50) NOT NULL DEFAULT '0',
  `bank` varchar(100) NOT NULL,
  `branch` varchar(100) NOT NULL DEFAULT 'Online Class',
  `paymentMethod` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `expiredate` date NOT NULL,
  `session_id` varchar(20) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT 0,
  `pay_month` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmspayment`
--

INSERT INTO `lmspayment` (`pid`, `fileName`, `userID`, `feeID`, `pay_sub_id`, `amount`, `accountnumber`, `bank`, `branch`, `paymentMethod`, `created_at`, `expiredate`, `session_id`, `status`, `order_status`, `pay_month`) VALUES
(1, NULL, 1, 12, 14, 500, '0', 'Pay bank', 'Online Class', 'Manual', '2022-07-18 15:37:57', '2022-07-31', '0', 1, 0, '2022-07-01'),
(2, 'MbSq7nFjVP.jpg', 2, 12, 14, 500, '0', 'Pay Bank', 'Online Class', 'Bank', '2022-07-18 18:41:31', '2022-07-31', '0', 1, 0, '2022-07-01'),
(3, 'UaIcGYx05T.jpeg', 3, 13, 15, 500, '0', 'Pay Bank', 'Online Class', 'Bank', '2022-07-18 21:09:46', '2022-07-31', '0', 1, 0, '2022-07-01'),
(4, 'MEW7whsPZb.jpg', 3, 12, 14, 500, '0', 'Pay Bank', 'Online Class', 'Bank', '2022-07-19 08:53:10', '2022-07-31', '0', 1, 0, '2022-07-01'),
(5, 'jFkufn7D2G.jpeg', 4, 13, 15, 500, '0', 'Pay Bank', 'Online Class', 'Bank', '2022-07-19 14:35:39', '2022-07-31', '0', 1, 0, '2022-07-01'),
(6, '', 5, 12, 14, 150, '0', 'Pay Online', 'Online Class', 'Card', '2022-07-19 20:29:36', '2022-07-31', '0', 1, 1, '2022-07-01'),
(7, 'jFz34RuJLu.png', 5, 13, 15, 500, '0', 'Pay Bank', 'Online Class', 'Bank', '2022-07-19 20:43:48', '2022-07-31', '0', 2, 0, '2022-07-01'),
(8, NULL, 5, 13, 15, 500, '0', 'Pay bank', 'Online Class', 'Manual', '2022-07-19 20:54:19', '2022-07-31', '0', 1, 0, '2022-07-01'),
(9, 'uKMkV4mj3l.png', 6, 12, 14, 150, '0', 'Pay Bank', 'Online Class', 'Bank', '2022-07-19 22:41:54', '2022-07-31', '0', 2, 0, '2022-07-01'),
(10, 'cZY2VUvJCB.png', 9, 12, 14, 150, '0', 'Pay Bank', 'Online Class', 'Bank', '2022-07-20 13:29:24', '2022-07-31', '0', 1, 0, '2022-07-01'),
(11, 'v76RnagBJX.jpg', 10, 12, 14, 150, '0', 'Pay Bank', 'Online Class', 'Bank', '2022-07-21 13:00:31', '2022-07-31', '0', 1, 0, '2022-07-01');

-- --------------------------------------------------------

--
-- Table structure for table `lmsregister`
--

CREATE TABLE `lmsregister` (
  `reid` int(11) NOT NULL,
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
  `level` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(500) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(20) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `relogin` int(11) NOT NULL,
  `reloging_ip` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `verifycode` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmsregister`
--

INSERT INTO `lmsregister` (`reid`, `stnumber`, `email`, `fullname`, `dob`, `gender`, `school`, `district`, `town`, `pcontactnumber`, `pemail`, `pname`, `contactnumber`, `address`, `level`, `password`, `image`, `add_date`, `status`, `ip_address`, `relogin`, `reloging_ip`, `payment`, `verifycode`) VALUES
(12, '002', 'kasun.yogeemedia@gmail.com', 'Sample name 1', '2022-09-02', 'male', 'Sample school', 'Ampara', 'Gampaha', NULL, NULL, NULL, '754694764', 'sample address', 4, 'd54d1702ad0f8326224b817c796763c9', '', '2022-10-07 05:23:15', '1', 'cybNuyfDMb', 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `lmsrequest_relogin`
--

CREATE TABLE `lmsrequest_relogin` (
  `relog_id` int(11) NOT NULL,
  `relog_user` int(11) NOT NULL,
  `relog_status` int(11) NOT NULL,
  `req_ip_add` varchar(255) NOT NULL,
  `relog_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lmsreq_subject`
--

CREATE TABLE `lmsreq_subject` (
  `sub_req_id` int(11) NOT NULL,
  `sub_req_reg_no` varchar(50) NOT NULL,
  `sub_req_sub_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmsreq_subject`
--

INSERT INTO `lmsreq_subject` (`sub_req_id`, `sub_req_reg_no`, `sub_req_sub_id`) VALUES
(22, '754694764', 18);

-- --------------------------------------------------------

--
-- Table structure for table `lmssms`
--

CREATE TABLE `lmssms` (
  `id` int(11) NOT NULL,
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
  `ssid` int(11) NOT NULL,
  `student` int(11) NOT NULL DEFAULT 0,
  `subject` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lmssubject`
--

CREATE TABLE `lmssubject` (
  `sid` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmssubject`
--

INSERT INTO `lmssubject` (`sid`, `class_id`, `name`, `add_date`, `status`) VALUES
(18, 6, 'English Grade 6', '2022-10-09 06:52:36', 'Publish'),
(19, 4, 'Sinhala Grade 6', '2022-10-09 06:52:58', 'Publish'),
(20, 7, 'All', '2022-10-09 06:53:09', 'Publish');

-- --------------------------------------------------------

--
-- Table structure for table `lmssubject_tealmsr`
--

CREATE TABLE `lmssubject_tealmsr` (
  `stid` int(11) NOT NULL,
  `subject` int(11) NOT NULL DEFAULT 0,
  `tealmsr` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lmstealmsr`
--

CREATE TABLE `lmstealmsr` (
  `tid` int(11) NOT NULL,
  `systemid` int(11) NOT NULL,
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
  `add_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmstealmsr`
--

INSERT INTO `lmstealmsr` (`tid`, `systemid`, `fullname`, `district`, `contactnumber`, `pcontactno`, `school`, `username`, `password`, `image`, `town`, `birthday`, `gender`, `joindate`, `add_date`, `status`) VALUES
(14, 1663314456, 'English Medium Student', 'sample', '1234567898', '112233445', 'sample school', 'sample1@email.com', 'd54d1702ad0f8326224b817c796763c9', '', 'sample', '2022-09-08', 'Male', '2022-02-09', '2022-10-11 04:50:44', 1),
(16, 1665077021, 'Sinhala Medium Student', 'Sample', '1234567898', '1122334455', 'School 2', 'sample2@email.com', '100ce3939dc720f78063dd4cc70638f8', '1665463924istockphoto-1161352480-612x612.jpg', 'Gampaha', '2022-10-02', 'Male', '2022-10-05', '2022-10-11 04:52:04', 1),
(18, 1665298894, 'All Subject Student', 'Gampaha', '123456789', '45678912', 'School 3', 'sample3@email.com', 'd54d1702ad0f8326224b817c796763c9', '1665460452istockphoto-1161352480-612x612.jpg', 'Gampaha', '2022-10-02', 'Male', '2022-10-04', '2022-10-11 12:09:14', 1),
(20, 1665490195, 'TEST', 'Gampaha', '123456789', '11224537532', 'Sample schoolvwe', 'sample4@email.com', '3354045a397621cd92406f1f98cde292', '', 'Sample', '2022-10-03', 'Male', '2022-10-02', '2022-10-11 12:10:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lmstealmsr_multiple`
--

CREATE TABLE `lmstealmsr_multiple` (
  `tealmsr_id` int(11) NOT NULL,
  `tealmsr_system_id` int(11) NOT NULL,
  `tealmsr_type` int(11) NOT NULL,
  `tealmsr_contain_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmstealmsr_multiple`
--

INSERT INTO `lmstealmsr_multiple` (`tealmsr_id`, `tealmsr_system_id`, `tealmsr_type`, `tealmsr_contain_id`) VALUES
(18, 1658135903, 2, 3),
(19, 1658135903, 3, 15),
(57, 1658135781, 2, 1),
(58, 1658135781, 3, 14),
(119, 1665133756, 2, 5),
(120, 1665133756, 3, 20),
(155, 1665463372, 2, 7),
(156, 1665463372, 3, 20),
(163, 1663314456, 2, 6),
(164, 1663314456, 3, 18),
(169, 1665077021, 2, 4),
(170, 1665077021, 3, 19),
(183, 1665298894, 2, 6),
(184, 1665298894, 2, 7),
(185, 1665298894, 2, 4),
(186, 1665298894, 3, 20),
(187, 1665298894, 3, 18),
(188, 1665298894, 3, 19),
(189, 1665490195, 2, 7),
(190, 1665490195, 3, 20);

-- --------------------------------------------------------

--
-- Table structure for table `lmsurl`
--

CREATE TABLE `lmsurl` (
  `id` int(11) NOT NULL,
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
  `user_id` int(11) NOT NULL,
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
  `joining_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lmsusers`
--

INSERT INTO `lmsusers` (`user_id`, `user_name`, `user_email`, `user_pass`, `admintype`, `admin`, `students`, `teachers`, `class`, `subject`, `lesson`, `payments`, `class_schedule`, `mail`, `joining_date`, `status`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$PO1NRNtexDZlefvtOw/ELe6T/uwDBkpt7JUnMoaS9O1QkDkDJILBa', 'Super Admin', 'True', 'True', 'True', 'True', 'True', 'True', 'True', 'True', 'True', '2022-02-09 03:43:58', '1');

-- --------------------------------------------------------

--
-- Table structure for table `lms_answer`
--

CREATE TABLE `lms_answer` (
  `lms_answer_id` int(11) NOT NULL,
  `lms_answer_user` int(11) NOT NULL,
  `lms_answer_paper` int(11) NOT NULL,
  `lms_answer_q` int(11) NOT NULL,
  `lms_answer_a` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_answer`
--

INSERT INTO `lms_answer` (`lms_answer_id`, `lms_answer_user`, `lms_answer_paper`, `lms_answer_q`, `lms_answer_a`) VALUES
(1, 1, 2, 2, 2),
(2, 2, 4, 4, 3),
(3, 3, 3, 3, 1),
(4, 5, 3, 3, 2),
(5, 5, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `lms_exam_details`
--

CREATE TABLE `lms_exam_details` (
  `lms_exam_id` int(11) NOT NULL,
  `lms_exam_add_user` int(11) NOT NULL,
  `lms_exam_system_id` int(11) NOT NULL,
  `lms_exam_name` varchar(255) NOT NULL,
  `lms_exam_subject` int(11) NOT NULL,
  `lms_exam_question` int(11) NOT NULL,
  `lms_exam_time_duration` int(11) NOT NULL,
  `lms_exam_start_time` datetime NOT NULL,
  `lms_exam_end_time` datetime NOT NULL,
  `lms_exam_add_time` datetime NOT NULL,
  `lms_exam_pay_type` int(11) NOT NULL COMMENT '1=pay, 0=free'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_exam_details`
--

INSERT INTO `lms_exam_details` (`lms_exam_id`, `lms_exam_add_user`, `lms_exam_system_id`, `lms_exam_name`, `lms_exam_subject`, `lms_exam_question`, `lms_exam_time_duration`, `lms_exam_start_time`, `lms_exam_end_time`, `lms_exam_add_time`, `lms_exam_pay_type`) VALUES
(6, 12, 1658459759, 'Exam 01', 14, 1, 1, '2022-07-22 08:45:00', '2022-07-29 08:45:00', '2022-07-22 08:45:59', 0),
(7, 12, 1658460103, 'Exam 01', 14, 1, 1, '2022-07-22 08:51:00', '2022-07-29 08:54:00', '2022-07-22 08:51:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lms_exam_report`
--

CREATE TABLE `lms_exam_report` (
  `lms_report_id` int(11) NOT NULL,
  `exam_report_user` int(11) NOT NULL,
  `exam_report_paper` int(11) NOT NULL,
  `exam_report_faced` int(11) NOT NULL,
  `exam_report_corect` int(11) NOT NULL,
  `exam_report_percent` int(11) NOT NULL,
  `exam_report_complet_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_exam_report`
--

INSERT INTO `lms_exam_report` (`lms_report_id`, `exam_report_user`, `exam_report_paper`, `exam_report_faced`, `exam_report_corect`, `exam_report_percent`, `exam_report_complet_time`) VALUES
(1, 1, 2, 1, 0, 0, '2022-07-18 15:53:34'),
(2, 2, 4, 1, 0, 0, '2022-07-18 19:10:25'),
(3, 3, 3, 1, 0, 0, '2022-07-18 21:12:19'),
(4, 5, 3, 1, 1, 100, '2022-07-19 20:34:25'),
(5, 5, 1, 1, 0, 0, '2022-07-19 20:34:53'),
(6, 12, 0, 0, 0, 0, '2022-09-30 16:17:27'),
(7, 12, 0, 0, 0, 0, '2022-09-30 16:18:24');

-- --------------------------------------------------------

--
-- Table structure for table `lms_mcq_questions`
--

CREATE TABLE `lms_mcq_questions` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `ans_1` text NOT NULL,
  `ans_2` text NOT NULL,
  `ans_3` text NOT NULL,
  `ans_4` text NOT NULL,
  `ans` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_mcq_questions`
--

INSERT INTO `lms_mcq_questions` (`id`, `exam_id`, `question`, `ans_1`, `ans_2`, `ans_3`, `ans_4`, `ans`) VALUES
(1, 1, '<p>01</p>\r\n', '1', '2', '3', '4', 4),
(2, 2, '<p>02</p>\r\n', '1', '2', '3', '4', 3),
(3, 3, '<p>03</p>\r\n', '1', '2', '3', '4', 2),
(4, 4, '<p>04</p>\r\n', '1', '2', '3', '4', 1),
(5, 5, '<p>Test</p>\r\n', '1', '2', '3', '4', 3),
(6, 6, '<p>Obage gama kumakda</p>\r\n', 'kelaniya', 'kiribathgoda', 'Gampaha', 'Minuwangoda', 3),
(7, 7, '<p>1</p>\r\n', '1', '2', '3', '4', 3);

-- --------------------------------------------------------

--
-- Table structure for table `lms_pdf`
--

CREATE TABLE `lms_pdf` (
  `ctuid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `subject` int(11) NOT NULL,
  `month` varchar(50) CHARACTER SET latin1 NOT NULL,
  `ctype` varchar(50) CHARACTER SET latin1 NOT NULL,
  `title` text CHARACTER SET latin1 NOT NULL,
  `tdocument` varchar(500) CHARACTER SET latin1 NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lms_pdf`
--

INSERT INTO `lms_pdf` (`ctuid`, `tid`, `class`, `subject`, `month`, `ctype`, `title`, `tdocument`, `add_date`, `status`) VALUES
(2, 14, 4, 18, 'March', 'Free Class', 'sample2', '396558.jpg', '2022-08-06 03:27:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lms_teacher_payment_history`
--

CREATE TABLE `lms_teacher_payment_history` (
  `lms_teacher_payment_history_id` int(11) NOT NULL,
  `lms_teacher_payment_history_tid` int(11) NOT NULL,
  `lms_teacher_payment_company_amount` float NOT NULL,
  `lms_teacher_payment_history_amount` float NOT NULL,
  `lms_teacher_payment_history_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paper_image`
--

CREATE TABLE `paper_image` (
  `pi_id` int(11) NOT NULL,
  `pi_exam_id` int(11) NOT NULL,
  `pi_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paper_marks`
--

CREATE TABLE `paper_marks` (
  `mid` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quizno` tinyint(4) NOT NULL,
  `answerstatus` tinyint(1) NOT NULL,
  `add_date` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `reg_prefix` varchar(3) NOT NULL,
  `application_name` varchar(400) NOT NULL,
  `main_logo` varchar(4000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `reg_prefix`, `application_name`, `main_logo`) VALUES
(1, 'SMP', 'Sample', 'logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_attandance`
--

CREATE TABLE `user_attandance` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `subjectid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exam_submissions`
--
ALTER TABLE `exam_submissions`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `lmsclass_schlmsle`
--
ALTER TABLE `lmsclass_schlmsle`
  ADD PRIMARY KEY (`classid`);

--
-- Indexes for table `lmscomments`
--
ALTER TABLE `lmscomments`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `lmsgallery`
--
ALTER TABLE `lmsgallery`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `lmsmail`
--
ALTER TABLE `lmsmail`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `lmsonlineexams`
--
ALTER TABLE `lmsonlineexams`
  ADD PRIMARY KEY (`exid`);

--
-- Indexes for table `lmspayment`
--
ALTER TABLE `lmspayment`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `lmsregister`
--
ALTER TABLE `lmsregister`
  ADD PRIMARY KEY (`reid`),
  ADD UNIQUE KEY `contactnumber` (`contactnumber`),
  ADD UNIQUE KEY `fullname` (`fullname`);

--
-- Indexes for table `lmsrequest_relogin`
--
ALTER TABLE `lmsrequest_relogin`
  ADD PRIMARY KEY (`relog_id`);

--
-- Indexes for table `lmsreq_subject`
--
ALTER TABLE `lmsreq_subject`
  ADD PRIMARY KEY (`sub_req_id`);

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
-- Indexes for table `lms_answer`
--
ALTER TABLE `lms_answer`
  ADD PRIMARY KEY (`lms_answer_id`);

--
-- Indexes for table `lms_exam_details`
--
ALTER TABLE `lms_exam_details`
  ADD PRIMARY KEY (`lms_exam_id`);

--
-- Indexes for table `lms_exam_report`
--
ALTER TABLE `lms_exam_report`
  ADD PRIMARY KEY (`lms_report_id`);

--
-- Indexes for table `lms_mcq_questions`
--
ALTER TABLE `lms_mcq_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_pdf`
--
ALTER TABLE `lms_pdf`
  ADD PRIMARY KEY (`ctuid`);

--
-- Indexes for table `lms_teacher_payment_history`
--
ALTER TABLE `lms_teacher_payment_history`
  ADD PRIMARY KEY (`lms_teacher_payment_history_id`);

--
-- Indexes for table `paper_image`
--
ALTER TABLE `paper_image`
  ADD PRIMARY KEY (`pi_id`);

--
-- Indexes for table `paper_marks`
--
ALTER TABLE `paper_marks`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_attandance`
--
ALTER TABLE `user_attandance`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exam_submissions`
--
ALTER TABLE `exam_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lmsclass`
--
ALTER TABLE `lmsclass`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lmsclasstute`
--
ALTER TABLE `lmsclasstute`
  MODIFY `ctuid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `lmsclasstute_std`
--
ALTER TABLE `lmsclasstute_std`
  MODIFY `ctuid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `lmsclass_schlmsle`
--
ALTER TABLE `lmsclass_schlmsle`
  MODIFY `classid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lmscomments`
--
ALTER TABLE `lmscomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `lmsdb`
--
ALTER TABLE `lmsdb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lmsebook`
--
ALTER TABLE `lmsebook`
  MODIFY `ctuid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lmsgallery`
--
ALTER TABLE `lmsgallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lmsgetway`
--
ALTER TABLE `lmsgetway`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lmslesson`
--
ALTER TABLE `lmslesson`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=736;

--
-- AUTO_INCREMENT for table `lmsmail`
--
ALTER TABLE `lmsmail`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lmsonlineexams`
--
ALTER TABLE `lmsonlineexams`
  MODIFY `exid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lmspayment`
--
ALTER TABLE `lmspayment`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `lmsregister`
--
ALTER TABLE `lmsregister`
  MODIFY `reid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lmsrequest_relogin`
--
ALTER TABLE `lmsrequest_relogin`
  MODIFY `relog_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lmsreq_subject`
--
ALTER TABLE `lmsreq_subject`
  MODIFY `sub_req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `lmssms`
--
ALTER TABLE `lmssms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lmsstudent_subject`
--
ALTER TABLE `lmsstudent_subject`
  MODIFY `ssid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lmssubject`
--
ALTER TABLE `lmssubject`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `lmssubject_tealmsr`
--
ALTER TABLE `lmssubject_tealmsr`
  MODIFY `stid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lmstealmsr`
--
ALTER TABLE `lmstealmsr`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `lmstealmsr_multiple`
--
ALTER TABLE `lmstealmsr_multiple`
  MODIFY `tealmsr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `lmsurl`
--
ALTER TABLE `lmsurl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lmsusers`
--
ALTER TABLE `lmsusers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lms_answer`
--
ALTER TABLE `lms_answer`
  MODIFY `lms_answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lms_exam_details`
--
ALTER TABLE `lms_exam_details`
  MODIFY `lms_exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lms_exam_report`
--
ALTER TABLE `lms_exam_report`
  MODIFY `lms_report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lms_mcq_questions`
--
ALTER TABLE `lms_mcq_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lms_pdf`
--
ALTER TABLE `lms_pdf`
  MODIFY `ctuid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lms_teacher_payment_history`
--
ALTER TABLE `lms_teacher_payment_history`
  MODIFY `lms_teacher_payment_history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paper_image`
--
ALTER TABLE `paper_image`
  MODIFY `pi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paper_marks`
--
ALTER TABLE `paper_marks`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_attandance`
--
ALTER TABLE `user_attandance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
