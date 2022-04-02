-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2022 at 03:02 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_preadvising`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladviser_presubject`
--

CREATE TABLE `tbladviser_presubject` (
  `id` int(11) NOT NULL,
  `lec` varchar(10) NOT NULL,
  `lab` varchar(10) NOT NULL,
  `units` varchar(10) NOT NULL,
  `grades` varchar(20) NOT NULL,
  `total_grades` varchar(20) NOT NULL,
  `school_year` varchar(50) NOT NULL,
  `remarks` varchar(20) NOT NULL,
  `yearlevel` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `adviser_id_fk` int(200) NOT NULL,
  `student_id` int(200) NOT NULL,
  `subject_id_fk` int(200) NOT NULL,
  `curri_id` int(200) NOT NULL,
  `college_id_fk` int(200) NOT NULL,
  `course_id_fk` int(200) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladviser_presubject`
--

INSERT INTO `tbladviser_presubject` (`id`, `lec`, `lab`, `units`, `grades`, `total_grades`, `school_year`, `remarks`, `yearlevel`, `semester`, `adviser_id_fk`, `student_id`, `subject_id_fk`, `curri_id`, `college_id_fk`, `course_id_fk`, `date_created`) VALUES
(1, '2', '3', '3', '1.0', '3', '2022-2023', 'PASSED', '1', '1st', 3, 1, 1, 1, 1, 1, '2022-04-01 07:47:55'),
(2, '3', '3', '4', '1.0', '4', '2022-2023', 'PASSED', '1', '1st', 3, 1, 2, 1, 1, 1, '2022-04-01 07:47:55'),
(3, '3', '0', '3', '1.50', '4.5', '2022-2023', 'PASSED', '1', '1st', 3, 1, 3, 1, 1, 1, '2022-04-01 07:47:56'),
(4, '3', '0', '3', '1.75', '5.25', '2022-2023', 'PASSED', '1', '1st', 3, 1, 4, 1, 1, 1, '2022-04-01 07:47:56'),
(5, '3', '0', '3', '1.25', '3.75', '2022-2023', 'PASSED', '1', '1st', 3, 1, 5, 1, 1, 1, '2022-04-01 07:47:57'),
(6, '3', '0', '3', '1.50', '4.5', '2022-2023', 'PASSED', '1', '1st', 3, 1, 6, 1, 1, 1, '2022-04-01 07:47:57'),
(7, '0', '0', '2', '1.50', '3', '2022-2023', 'PASSED', '1', '1st', 3, 1, 7, 1, 1, 1, '2022-04-01 07:47:57'),
(8, '0', '0', '3', '1.75', '5.25', '2022-2023', 'PASSED', '1', '1st', 3, 1, 8, 1, 1, 1, '2022-04-01 07:47:57'),
(9, '0', '0', '2', '1.25', '2.5', '2022-2023', 'PASSED', '1', '1st', 3, 1, 9, 1, 1, 1, '2022-04-01 07:47:57'),
(10, '3', '3', '4', '1.0', '4', '2022-2023', 'PASSED', '1', '2nd', 3, 1, 11, 1, 1, 1, '2022-04-01 07:48:59'),
(11, '3', '0', '3', '1.50', '4.5', '2022-2023', 'PASSED', '1', '2nd', 3, 1, 10, 1, 1, 1, '2022-04-01 07:49:00'),
(12, '3', '0', '3', '1.75', '5.25', '2022-2023', 'PASSED', '1', '2nd', 3, 1, 12, 1, 1, 1, '2022-04-01 07:49:00'),
(13, '3', '0', '3', '1.50', '4.5', '2022-2023', 'PASSED', '1', '2nd', 3, 1, 15, 1, 1, 1, '2022-04-01 07:49:00'),
(14, '0', '0', '3', '1.50', '4.5', '2022-2023', 'PASSED', '1', '2nd', 3, 1, 17, 1, 1, 1, '2022-04-01 07:49:01'),
(15, '3', '0', '3', '1.50', '4.5', '2022-2023', 'PASSED', '1', '2nd', 3, 1, 13, 1, 1, 1, '2022-04-01 07:50:34'),
(16, '3', '0', '3', '1.75', '5.25', '2022-2023', 'PASSED', '1', '2nd', 3, 1, 14, 1, 1, 1, '2022-04-01 07:50:34'),
(17, '0', '0', '2', '1.50', '3', '2022-2023', 'PASSED', '1', '2nd', 3, 1, 16, 1, 1, 1, '2022-04-01 07:50:34'),
(18, '0', '0', '2', '1.50', '3', '2022-2023', 'PASSED', '1', '2nd', 3, 1, 18, 1, 1, 1, '2022-04-01 07:50:34'),
(19, '3', '3', '4', '1.0', '4', '2022-2023', 'PASSED', '2', '1st', 3, 1, 19, 1, 1, 1, '2022-04-01 07:51:47'),
(20, '0', '3', '1', '1.50', '1.5', '2022-2023', 'PASSED', '2', '1st', 3, 1, 22, 1, 1, 1, '2022-04-01 07:51:47'),
(21, '3', '3', '4', '1.50', '6', '2022-2023', 'PASSED', '2', '1st', 3, 1, 23, 1, 1, 1, '2022-04-01 07:51:47'),
(22, '2', '3', '3', '1.0', '3', '2022-2023', 'PASSED', '2', '2nd', 3, 1, 30, 1, 1, 1, '2022-04-01 07:51:47'),
(23, '3', '0', '3', '1.50', '4.5', '2022-2023', 'PASSED', '2', '1st', 3, 1, 20, 1, 1, 1, '2022-04-01 07:51:48'),
(24, '3', '3', '4', '1.75', '7', '2022-2023', 'PASSED', '2', '1st', 3, 1, 21, 1, 1, 1, '2022-04-01 07:51:48'),
(25, '3', '3', '4', '1.50', '6', '2022-2023', 'PASSED', '2', '2nd', 3, 1, 27, 1, 1, 1, '2022-04-01 07:51:48'),
(26, '3', '0', '3', '1.50', '4.5', '2022-2023', 'PASSED', '2', '2nd', 3, 1, 28, 1, 1, 1, '2022-04-01 07:51:48'),
(27, '3', '0', '3', '1.50', '4.5', '2022-2023', 'PASSED', '2', '1st', 3, 1, 24, 1, 1, 1, '2022-04-01 07:51:48'),
(28, '3', '0', '3', '1.75', '5.25', '2022-2023', 'PASSED', '2', '1st', 3, 1, 25, 1, 1, 1, '2022-04-01 07:53:48'),
(29, '0', '0', '2', '1.75', '3.5', '2022-2023', 'PASSED', '2', '1st', 3, 1, 26, 1, 1, 1, '2022-04-01 07:53:48'),
(30, '3', '3', '4', '1.50', '6', '2022-2023', 'PASSED', '2', '2nd', 3, 1, 32, 1, 1, 1, '2022-04-01 07:54:31'),
(31, '2', '3', '3', '1.0', '3', '2022-2023', 'PASSED', '3', '1st', 3, 1, 37, 1, 1, 1, '2022-04-01 07:54:31'),
(32, '2', '3', '3', '1.50', '4.5', '2022-2023', 'PASSED', '2', '2nd', 3, 1, 29, 1, 1, 1, '2022-04-01 07:54:32'),
(33, '2', '3', '3', '1.50', '4.5', '2022-2023', 'PASSED', '2', '2nd', 3, 1, 31, 1, 1, 1, '2022-04-01 07:55:57'),
(34, '0', '0', '2', '1.50', '3', '2022-2023', 'PASSED', '2', '2nd', 3, 1, 33, 1, 1, 1, '2022-04-01 07:55:58'),
(35, '3', '3', '4', '1.0', '4', '2022-2023', 'PASSED', '3', '2nd', 3, 1, 43, 1, 1, 1, '2022-04-01 07:56:54'),
(36, '3', '0', '3', '1.25', '3.75', '2022-2023', 'PASSED', '3', '1st', 3, 1, 34, 1, 1, 1, '2022-04-01 07:56:54'),
(37, '2', '0', '2', '1.75', '3.5', '2022-2023', 'PASSED', '3', '1st', 3, 1, 35, 1, 1, 1, '2022-04-01 07:56:55'),
(38, '3', '3', '4', '1.75', '7', '2022-2023', 'PASSED', '3', '1st', 3, 1, 36, 1, 1, 1, '2022-04-01 07:56:55'),
(39, '3', '3', '4', '1.50', '6', '2022-2023', 'PASSED', '3', '1st', 3, 1, 38, 1, 1, 1, '2022-04-01 07:56:55'),
(40, '2', '3', '3', '1.50', '4.5', '2022-2023', 'PASSED', '3', '1st', 3, 1, 40, 1, 1, 1, '2022-04-01 07:56:55'),
(41, '2', '3', '3', '1.50', '4.5', '2022-2023', 'PASSED', '3', '1st', 3, 1, 39, 1, 1, 1, '2022-04-01 07:58:34'),
(42, '2', '3', '3', '1.25', '3.75', '2022-2023', 'PASSED', '3', '2nd', 3, 1, 42, 1, 1, 1, '2022-04-01 08:00:33'),
(43, '2', '3', '3', '1.50', '4.5', '2022-2023', 'PASSED', '3', '2nd', 3, 1, 44, 1, 1, 1, '2022-04-01 08:00:33'),
(44, '3', '0', '3', '1.50', '4.5', '2022-2023', 'PASSED', '3', '2nd', 3, 1, 41, 1, 1, 1, '2022-04-01 08:01:40'),
(45, '2', '3', '3', '1.25', '3.75', '2022-2023', 'PASSED', '3', '2nd', 3, 1, 45, 1, 1, 1, '2022-04-01 08:01:40'),
(46, '3', '0', '3', '1.50', '4.5', '2022-2023', 'PASSED', '3', '2nd', 3, 1, 46, 1, 1, 1, '2022-04-01 08:01:40'),
(47, '3', '0', '3', '1.0', '3', '2022-2023', 'PASSED', '4', '2nd', 3, 1, 49, 1, 1, 1, '2022-04-01 08:02:59'),
(48, '3', '0', '3', '1.0', '3', '2022-2023', 'PASSED', '4', '1st', 3, 1, 47, 1, 1, 1, '2022-04-01 08:03:00'),
(49, '3', '0', '3', '1.25', '3.75', '2022-2023', 'PASSED', '4', '1st', 3, 1, 48, 1, 1, 1, '2022-04-01 08:03:34'),
(50, '3', '0', '3', '1.50', '4.5', '2022-2023', 'PASSED', '4', '2nd', 3, 1, 50, 1, 1, 1, '2022-04-01 08:07:10'),
(51, '3', '0', '3', '1.50', '4.5', '2022-2023', 'PASSED', '4', '2nd', 3, 1, 51, 1, 1, 1, '2022-04-01 08:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbladviser_send_sub_to_stud`
--

CREATE TABLE `tbladviser_send_sub_to_stud` (
  `id` int(11) NOT NULL,
  `lec` varchar(10) NOT NULL,
  `lab` varchar(20) NOT NULL,
  `units` varchar(10) NOT NULL,
  `yearlevel` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `school_year` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `adviser_id_fk` int(200) NOT NULL,
  `student_id_fk` int(200) NOT NULL,
  `subject_id_fk` int(200) NOT NULL,
  `curri_id_fk` int(200) NOT NULL,
  `college_id_fk` int(200) NOT NULL,
  `course_id_fk` int(200) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblcollege`
--

CREATE TABLE `tblcollege` (
  `id` int(200) NOT NULL,
  `collegecode` varchar(50) NOT NULL,
  `college` varchar(100) NOT NULL,
  `seal` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `admin_exist` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcollege`
--

INSERT INTO `tblcollege` (`id`, `collegecode`, `college`, `seal`, `date_created`, `admin_exist`) VALUES
(1, 'CCS', 'College of Computing Studies', 'ccs.jpg', '2022-01-29 11:36:01', 1),
(2, 'CN', 'College of Nursing', 'cn-.png', '2022-01-29 16:09:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblcourse`
--

CREATE TABLE `tblcourse` (
  `id` int(200) NOT NULL,
  `coursecode` varchar(50) NOT NULL,
  `course` varchar(100) NOT NULL,
  `college_id_fk` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcourse`
--

INSERT INTO `tblcourse` (`id`, `coursecode`, `course`, `college_id_fk`) VALUES
(1, 'BSCS', 'Bachelor of Science in Computer Science', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcurriculum`
--

CREATE TABLE `tblcurriculum` (
  `id` int(11) NOT NULL,
  `curr_code` varchar(100) NOT NULL,
  `cmo` varchar(50) NOT NULL,
  `board_reso` varchar(50) NOT NULL,
  `effectiveSY` varchar(100) NOT NULL,
  `other_details` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `college_id_fk` int(200) DEFAULT NULL,
  `course_id_fk` int(200) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcurriculum`
--

INSERT INTO `tblcurriculum` (`id`, `curr_code`, `cmo`, `board_reso`, `effectiveSY`, `other_details`, `status`, `college_id_fk`, `course_id_fk`, `date_created`) VALUES
(1, 'BSCS(2022)', 'CMO1', 'BR1', '2022', 'NONE', '1', 1, 1, '2022-01-31 00:18:43'),
(2, 'BSCS(2018)', 'CMO2', 'BR2', '2018', 'NONE', '1', 1, 1, '2022-02-15 19:28:02');

-- --------------------------------------------------------

--
-- Table structure for table `tblprereq`
--

CREATE TABLE `tblprereq` (
  `id` int(11) NOT NULL,
  `subject_id` varchar(100) NOT NULL,
  `subject_under` varchar(100) NOT NULL,
  `curri_id_fk` int(200) NOT NULL,
  `course_id_fk` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblprereq`
--

INSERT INTO `tblprereq` (`id`, `subject_id`, `subject_under`, `curri_id_fk`, `course_id_fk`) VALUES
(1, '4', '10', 1, 1),
(2, '2', '11', 1, 1),
(3, '4', '12', 1, 1),
(4, '6', '15', 1, 1),
(5, '8', '17', 1, 1),
(6, '11', '19', 1, 1),
(7, '10', '20', 1, 1),
(8, '10', '21', 1, 1),
(9, '11', '22', 1, 1),
(10, '11', '23', 1, 1),
(11, '12', '24', 1, 1),
(12, '10', '27', 1, 1),
(13, '23', '27', 1, 1),
(14, '10', '28', 1, 1),
(15, '23', '28', 1, 1),
(16, '23', '29', 1, 1),
(17, '11', '30', 1, 1),
(18, '19', '32', 1, 1),
(19, '28', '34', 1, 1),
(20, '29', '34', 1, 1),
(21, '32', '35', 1, 1),
(22, '32', '36', 1, 1),
(23, '19', '37', 1, 1),
(24, '32', '37', 1, 1),
(25, '32', '38', 1, 1),
(26, '32', '40', 1, 1),
(27, '37', '42', 1, 1),
(28, '27', '43', 1, 1),
(29, '34', '44', 1, 1),
(30, '41', '47', 1, 1),
(31, '42', '49', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblrequest_account`
--

CREATE TABLE `tblrequest_account` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `req_usertype` varchar(20) NOT NULL,
  `college_id_fk` int(200) NOT NULL,
  `course_id_fk` int(200) NOT NULL,
  `user_id_fk` int(200) NOT NULL,
  `date_requested` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblschool_year`
--

CREATE TABLE `tblschool_year` (
  `id` int(11) NOT NULL,
  `school_year` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblschool_year`
--

INSERT INTO `tblschool_year` (`id`, `school_year`, `status`, `date_created`) VALUES
(1, '2022-2023', 'Activated', '2022-02-27 20:46:51'),
(2, '2024-2025', 'Deactivated', '2022-03-09 14:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudent_grade_sub`
--

CREATE TABLE `tblstudent_grade_sub` (
  `id` int(11) NOT NULL,
  `grades` varchar(100) NOT NULL,
  `remarks` varchar(20) NOT NULL,
  `submission_status` varchar(100) NOT NULL,
  `yearlevel` varchar(20) NOT NULL,
  `student_id_fk` int(200) NOT NULL,
  `college_id_fk` int(200) NOT NULL,
  `subject_id_fk` int(200) NOT NULL,
  `curri_id_fk` int(200) NOT NULL,
  `course_id_fk` int(200) NOT NULL,
  `date_submitted` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblstudent_list`
--

CREATE TABLE `tblstudent_list` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middle` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `suffix` varchar(10) NOT NULL,
  `status` varchar(50) NOT NULL,
  `college_status` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `college_id_fk` int(200) NOT NULL,
  `course_id_fk` int(200) NOT NULL,
  `curri_id_fk` int(200) NOT NULL,
  `adviser_id_fk` int(50) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblstudent_list`
--

INSERT INTO `tblstudent_list` (`id`, `firstname`, `middle`, `lastname`, `suffix`, `status`, `college_status`, `email`, `contact`, `college_id_fk`, `course_id_fk`, `curri_id_fk`, `adviser_id_fk`, `date_created`) VALUES
(1, 'Sandy', 'G.', 'Pueblo', '', 'Enrolled', 'Regular', 'sadzpueblo26@gmail.com', '09059172562', 1, 1, 1, 3, '2022-03-11 09:24:18');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudent_pdf`
--

CREATE TABLE `tblstudent_pdf` (
  `id` int(11) NOT NULL,
  `pdf_grade` varchar(200) NOT NULL,
  `submission_status` varchar(50) NOT NULL,
  `yearlevel` varchar(20) NOT NULL,
  `student_id_fk` int(200) NOT NULL,
  `curri_id_fk` int(200) NOT NULL,
  `college_id_fk` int(200) NOT NULL,
  `course_id_fk` int(200) NOT NULL,
  `date_submitted` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblsubject`
--

CREATE TABLE `tblsubject` (
  `id` int(11) NOT NULL,
  `subject_code` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `lec` int(10) NOT NULL,
  `lab` int(10) NOT NULL,
  `units` int(10) NOT NULL,
  `yearlevel` varchar(20) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `prerequisite` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `curr_id_fk` int(20) NOT NULL,
  `college_id_fk` int(20) NOT NULL,
  `course_id_fk` int(20) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsubject`
--

INSERT INTO `tblsubject` (`id`, `subject_code`, `description`, `lec`, `lab`, `units`, `yearlevel`, `semester`, `prerequisite`, `status`, `curr_id_fk`, `college_id_fk`, `course_id_fk`, `date_created`) VALUES
(1, 'CC 100', 'INTRODUCTION TO COMPUTING', 2, 3, 3, '1', '1st', 'NONE', '1', 1, 1, 1, '2022-02-02 12:21:10'),
(2, 'CC 101', 'COMPUTER PROGRAMMING 1', 3, 3, 4, '1', '1st', 'NONE', '1', 1, 1, 1, '2022-02-02 17:39:57'),
(3, 'CAS 101', 'PURPOSIVE COMMUNICATION', 3, 0, 3, '1', '1st', 'NONE', '1', 1, 1, 1, '2022-02-02 17:42:10'),
(4, 'MATH 100', 'MATHEMATICS IN THE MODERN WORLD', 3, 0, 3, '1', '1st', 'NONE', '1', 1, 1, 1, '2022-02-02 17:44:00'),
(5, 'US 101', 'UNDERSTANDING THE SELF', 3, 0, 3, '1', '1st', 'NONE', '1', 1, 1, 1, '2022-02-02 17:45:04'),
(6, 'FIL 101', 'KOMUNIKASYON AKADEMIKONG FILIPINO', 3, 0, 3, '1', '1st', 'NONE', '1', 1, 1, 1, '2022-02-02 17:46:12'),
(7, 'PE 101', 'PHYSICAL EDUCATION 1', 0, 0, 2, '1', '1st', 'NONE', '1', 1, 1, 1, '2022-02-02 17:47:13'),
(8, 'NSTP 1', 'NATIONAL SERVICE TRAINING PROGRAM 1', 0, 0, 3, '1', '1st', 'NONE', '1', 1, 1, 1, '2022-02-02 17:48:29'),
(9, 'EUTH A', 'EUTHENICS A', 0, 0, 2, '1', '1st', 'NONE', '1', 1, 1, 1, '2022-02-02 17:49:00'),
(10, 'CS 111', 'DISCRETE STRUCTURES 1', 3, 0, 3, '1', '2nd', 'HAVE', '1', 1, 1, 1, '2022-02-02 17:52:48'),
(11, 'CC 102', 'COMPUTER PROGRAMMING 2', 3, 3, 4, '1', '2nd', 'HAVE', '1', 1, 1, 1, '2022-02-02 17:54:09'),
(12, 'MATH 103', 'CALCULUS 1', 3, 0, 3, '1', '2nd', 'HAVE', '1', 1, 1, 1, '2022-02-02 17:55:11'),
(13, 'CW 101', 'THE CONTEMPORARY WORLD', 3, 0, 3, '1', '2nd', 'NONE', '1', 1, 1, 1, '2022-02-02 17:55:54'),
(14, 'STS 100', 'SCIENCE, TECHNOLOGY AND SOCIETY', 3, 0, 3, '1', '2nd', 'NONE', '1', 1, 1, 1, '2022-02-02 17:56:33'),
(15, 'FIL 102', 'RETORIKA', 3, 0, 3, '1', '2nd', 'HAVE', '1', 1, 1, 1, '2022-02-02 17:57:13'),
(16, 'PE 102', 'PHYSICAL EDUCATION 2', 0, 0, 2, '1', '2nd', 'NONE', '1', 1, 1, 1, '2022-02-02 17:57:48'),
(17, 'NSTP 2', 'NATIONAL SERVICE TRAINING PROGRAM 2', 0, 0, 3, '1', '2nd', 'HAVE', '1', 1, 1, 1, '2022-02-02 17:58:20'),
(18, 'EUTH B', 'EUTHENICS B', 0, 0, 2, '1', '2nd', 'NONE', '1', 1, 1, 1, '2022-02-02 17:58:40'),
(19, 'CS 121', 'OBJECT-ORIENTED PROGRAMMING', 3, 3, 4, '2', '1st', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:00:55'),
(20, 'CS 123', 'DISCRETE STRUCTURES 2', 3, 0, 3, '2', '1st', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:01:46'),
(21, 'CS 125', 'DIGITAL DESIGN', 3, 3, 4, '2', '1st', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:03:00'),
(22, 'CS 127', 'HUMAN COMPUTER INTERACTION', 0, 3, 1, '2', '1st', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:03:50'),
(23, 'CC 103', 'DATA STRUCTURES AND ALGORITHMS', 3, 3, 4, '2', '1st', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:04:50'),
(24, 'MATH 104', 'CALCULUS 2', 3, 0, 3, '2', '1st', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:05:33'),
(25, 'LIT 101', 'PHILIPPINE LITERATURE', 3, 0, 3, '2', '1st', 'NONE', '1', 1, 1, 1, '2022-02-02 18:06:17'),
(26, 'PE 103', 'PHYSICAL EDUCATION 3', 0, 0, 2, '2', '1st', 'NONE', '1', 1, 1, 1, '2022-02-02 18:06:49'),
(27, 'CS 120', 'ARCHITECTURE AND ORGANIZATION', 3, 3, 4, '2', '2nd', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:08:16'),
(28, 'CS 122', 'DESIGN AND ANALYSIS OF ALGORITHMS', 3, 0, 3, '2', '2nd', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:09:34'),
(29, 'CS 124', 'PROGRAMMING LANGUAGES', 2, 3, 3, '2', '2nd', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:10:53'),
(30, 'CS 126', 'NETWORKS AND COMMUNICATIONS', 2, 3, 3, '2', '2nd', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:15:47'),
(31, 'CS 128', 'CS ELECTIVE 1', 2, 3, 3, '2', '2nd', 'NONE', '1', 1, 1, 1, '2022-02-02 18:16:34'),
(32, 'CC 104', 'INFORMATION MANAGEMENT', 3, 3, 4, '2', '2nd', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:17:26'),
(33, 'PE 104', 'PHYSICAL EDUCATION 4', 0, 0, 2, '2', '2nd', 'NONE', '1', 1, 1, 1, '2022-02-02 18:18:09'),
(34, 'CS 131', 'AUTOMATA THEORY AND FORMAL LANGUAGES', 3, 0, 3, '3', '1st', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:19:40'),
(35, 'CS 133', 'INFORMATION ASSURANCE AND SECURITY', 2, 0, 2, '3', '1st', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:29:15'),
(36, 'CS 135', 'ADVANCED DATABASE SYSTEMS', 3, 3, 4, '3', '1st', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:30:23'),
(37, 'CS 137', 'SOFTWARE ENGINEERING 1', 2, 3, 3, '3', '1st', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:31:13'),
(38, 'CS 139', 'WEB PROGRAMMING AND DEVELOPMENT', 3, 3, 4, '3', '1st', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:32:29'),
(39, 'CS 140', 'CS ELECTIVE 2', 2, 3, 3, '3', '1st', 'NONE', '1', 1, 1, 1, '2022-02-02 18:32:57'),
(40, 'CC 105', 'APPLICATION DEVELOPMENT AND EMERGING TECHNOLOGIES', 2, 3, 3, '3', '1st', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:34:13'),
(41, 'CS 130', 'CS THESIS 1', 3, 0, 3, '3', '2nd', 'NONE', '1', 1, 1, 1, '2022-02-02 18:34:49'),
(42, 'CS 132', 'SOFTWARE ENGINEERING 2', 2, 3, 3, '3', '2nd', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:35:41'),
(43, 'CS 134', 'OPERATING SYSTEMS', 3, 3, 4, '3', '2nd', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:36:29'),
(44, 'CS 136', 'MODELING AND SIMULATION', 2, 3, 3, '3', '2nd', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:37:19'),
(45, 'CS 138', 'CS ELECTIVE 3', 2, 3, 3, '3', '2nd', 'NONE', '1', 1, 1, 1, '2022-02-02 18:37:44'),
(46, 'ETHICS 101', 'ETHICS', 3, 0, 3, '3', '2nd', 'NONE', '1', 1, 1, 1, '2022-02-02 18:38:12'),
(47, 'CS 143', 'THESIS 2', 3, 0, 3, '4', '1st', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:39:04'),
(48, 'HIST 100', 'LIFE AND WORKS OF RIZAL', 3, 0, 3, '4', '1st', 'NONE', '1', 1, 1, 1, '2022-02-02 18:39:45'),
(49, 'CS 142', 'SOCIAL ISSUES AND PROFESSIONAL PRACTICE', 3, 0, 3, '4', '2nd', 'HAVE', '1', 1, 1, 1, '2022-02-02 18:40:43'),
(50, 'HIST 101', 'READINGS IN PHILIPPINE HISTORY', 3, 0, 3, '4', '2nd', 'NONE', '1', 1, 1, 1, '2022-02-02 18:41:22'),
(51, 'A&H 100', 'ART APPRECIATION', 3, 0, 3, '4', '2nd', 'NONE', '1', 1, 1, 1, '2022-02-02 18:41:54'),
(52, 'CS 141', 'PRACTICUM / INDUSTRY IMMERSION', 0, 27, 3, '3', 'summer', 'NONE', '1', 1, 1, 1, '2022-02-15 10:00:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `curri_id` int(200) DEFAULT NULL,
  `college_id_fk` int(200) DEFAULT NULL,
  `course_id_fk` int(200) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `firstname`, `lastname`, `email`, `password`, `usertype`, `status`, `contact`, `curri_id`, `college_id_fk`, `course_id_fk`, `date_created`) VALUES
(1, 'Superadmin', 'Superadmin', 'superadmin', 'superadmin', 'Superadmin', '1', '0', 0, 0, 0, '2022-01-28 17:53:49'),
(2, 'Admin', 'Admin', 'admin', 'admin', 'Admin', '1', '09434734634', 0, 1, 0, '2022-01-30 12:49:50'),
(3, 'Adviser', 'Adviser', 'adviser', 'adviser', 'Adviser', '1', '09434834634', NULL, 1, 1, '2022-01-30 22:06:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladviser_presubject`
--
ALTER TABLE `tbladviser_presubject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblpre_id_fk1` (`student_id`),
  ADD KEY `tblpre_id_fk2` (`subject_id_fk`),
  ADD KEY `tblpre_id_fk3` (`curri_id`),
  ADD KEY `tblpre_id_fk4` (`college_id_fk`),
  ADD KEY `tblpre_id_fk5` (`course_id_fk`),
  ADD KEY `tblpre_id_fk6` (`adviser_id_fk`);

--
-- Indexes for table `tbladviser_send_sub_to_stud`
--
ALTER TABLE `tbladviser_send_sub_to_stud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblsend_id_fk2` (`curri_id_fk`),
  ADD KEY `tblsend_id_fk3` (`college_id_fk`),
  ADD KEY `tblsend_id_fk4` (`subject_id_fk`),
  ADD KEY `tblsend_id_fk5` (`course_id_fk`),
  ADD KEY `tblsend_id_fk1` (`student_id_fk`),
  ADD KEY `tblsend_id_fk6` (`adviser_id_fk`);

--
-- Indexes for table `tblcollege`
--
ALTER TABLE `tblcollege`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcourse`
--
ALTER TABLE `tblcourse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblcourse_ibfk_1` (`college_id_fk`);

--
-- Indexes for table `tblcurriculum`
--
ALTER TABLE `tblcurriculum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblcur_id_fk1` (`college_id_fk`),
  ADD KEY `tblcur_id_fk2` (`course_id_fk`);

--
-- Indexes for table `tblprereq`
--
ALTER TABLE `tblprereq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblpreq_id_fk1` (`curri_id_fk`),
  ADD KEY `tblpreq_id_fk2` (`course_id_fk`);

--
-- Indexes for table `tblrequest_account`
--
ALTER TABLE `tblrequest_account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblreq_id_fk1` (`college_id_fk`),
  ADD KEY `tblreq_id_fk2` (`course_id_fk`),
  ADD KEY `tblreq_id_fk3` (`user_id_fk`);

--
-- Indexes for table `tblschool_year`
--
ALTER TABLE `tblschool_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstudent_grade_sub`
--
ALTER TABLE `tblstudent_grade_sub`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblgr_id_fk1` (`student_id_fk`),
  ADD KEY `tblgr_id_fk2` (`curri_id_fk`),
  ADD KEY `tblgr_id_fk3` (`course_id_fk`),
  ADD KEY `tblgr_id_fk4` (`college_id_fk`),
  ADD KEY `tblgr_id_fk5` (`subject_id_fk`);

--
-- Indexes for table `tblstudent_list`
--
ALTER TABLE `tblstudent_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblcollege_idfk1` (`college_id_fk`),
  ADD KEY `tblcourse_idfk2` (`course_id_fk`),
  ADD KEY `tblcurriculum_idfk3` (`curri_id_fk`),
  ADD KEY `tbladviser_idfk4` (`adviser_id_fk`);

--
-- Indexes for table `tblstudent_pdf`
--
ALTER TABLE `tblstudent_pdf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblpdf_id_fk1` (`student_id_fk`),
  ADD KEY `tblpdf_id_fk2` (`curri_id_fk`),
  ADD KEY `tblpdf_id_fk3` (`college_id_fk`),
  ADD KEY `tblpdf_id_fk4` (`course_id_fk`);

--
-- Indexes for table `tblsubject`
--
ALTER TABLE `tblsubject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblsub_ibfk_1` (`college_id_fk`),
  ADD KEY `tblsub_ibfk_2` (`course_id_fk`),
  ADD KEY `tblsub_ibfk_3` (`curr_id_fk`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbluser_ibfk_1` (`college_id_fk`),
  ADD KEY `tbluser_ibfk_2` (`course_id_fk`),
  ADD KEY `tbluser_ibfk_3` (`curri_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladviser_presubject`
--
ALTER TABLE `tbladviser_presubject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbladviser_send_sub_to_stud`
--
ALTER TABLE `tbladviser_send_sub_to_stud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblcollege`
--
ALTER TABLE `tblcollege`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblcourse`
--
ALTER TABLE `tblcourse`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcurriculum`
--
ALTER TABLE `tblcurriculum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblprereq`
--
ALTER TABLE `tblprereq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tblrequest_account`
--
ALTER TABLE `tblrequest_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblschool_year`
--
ALTER TABLE `tblschool_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblstudent_grade_sub`
--
ALTER TABLE `tblstudent_grade_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblstudent_list`
--
ALTER TABLE `tblstudent_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblstudent_pdf`
--
ALTER TABLE `tblstudent_pdf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblsubject`
--
ALTER TABLE `tblsubject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbladviser_presubject`
--
ALTER TABLE `tbladviser_presubject`
  ADD CONSTRAINT `tblpre_id_fk1` FOREIGN KEY (`student_id`) REFERENCES `tbluser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblpre_id_fk2` FOREIGN KEY (`subject_id_fk`) REFERENCES `tblsubject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblpre_id_fk3` FOREIGN KEY (`curri_id`) REFERENCES `tblcurriculum` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblpre_id_fk4` FOREIGN KEY (`college_id_fk`) REFERENCES `tblcollege` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblpre_id_fk5` FOREIGN KEY (`course_id_fk`) REFERENCES `tblcourse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblpre_id_fk6` FOREIGN KEY (`adviser_id_fk`) REFERENCES `tbluser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbladviser_send_sub_to_stud`
--
ALTER TABLE `tbladviser_send_sub_to_stud`
  ADD CONSTRAINT `tblsend_id_fk1` FOREIGN KEY (`student_id_fk`) REFERENCES `tblstudent_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblsend_id_fk2` FOREIGN KEY (`curri_id_fk`) REFERENCES `tblcurriculum` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblsend_id_fk3` FOREIGN KEY (`college_id_fk`) REFERENCES `tblcollege` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblsend_id_fk4` FOREIGN KEY (`subject_id_fk`) REFERENCES `tblsubject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblsend_id_fk5` FOREIGN KEY (`course_id_fk`) REFERENCES `tblcourse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblsend_id_fk6` FOREIGN KEY (`adviser_id_fk`) REFERENCES `tbluser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcourse`
--
ALTER TABLE `tblcourse`
  ADD CONSTRAINT `tblcourse_ibfk_1` FOREIGN KEY (`college_id_fk`) REFERENCES `tblcollege` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcurriculum`
--
ALTER TABLE `tblcurriculum`
  ADD CONSTRAINT `tblcur_id_fk1` FOREIGN KEY (`college_id_fk`) REFERENCES `tblcollege` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblcur_id_fk2` FOREIGN KEY (`course_id_fk`) REFERENCES `tblcourse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblprereq`
--
ALTER TABLE `tblprereq`
  ADD CONSTRAINT `tblpreq_id_fk1` FOREIGN KEY (`curri_id_fk`) REFERENCES `tblcurriculum` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblpreq_id_fk2` FOREIGN KEY (`course_id_fk`) REFERENCES `tblcourse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblrequest_account`
--
ALTER TABLE `tblrequest_account`
  ADD CONSTRAINT `tblreq_id_fk1` FOREIGN KEY (`college_id_fk`) REFERENCES `tblcollege` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblreq_id_fk2` FOREIGN KEY (`course_id_fk`) REFERENCES `tblcourse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblreq_id_fk3` FOREIGN KEY (`user_id_fk`) REFERENCES `tbluser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblstudent_grade_sub`
--
ALTER TABLE `tblstudent_grade_sub`
  ADD CONSTRAINT `tblgr_id_fk1` FOREIGN KEY (`student_id_fk`) REFERENCES `tbluser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblgr_id_fk2` FOREIGN KEY (`curri_id_fk`) REFERENCES `tblcurriculum` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblgr_id_fk3` FOREIGN KEY (`course_id_fk`) REFERENCES `tblcourse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblgr_id_fk4` FOREIGN KEY (`college_id_fk`) REFERENCES `tblcollege` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblgr_id_fk5` FOREIGN KEY (`subject_id_fk`) REFERENCES `tblsubject` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblstudent_list`
--
ALTER TABLE `tblstudent_list`
  ADD CONSTRAINT `tbladviser_idfk4` FOREIGN KEY (`adviser_id_fk`) REFERENCES `tbluser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblcollege_idfk1` FOREIGN KEY (`college_id_fk`) REFERENCES `tblcollege` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblcourse_idfk2` FOREIGN KEY (`course_id_fk`) REFERENCES `tblcourse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblcurriculum_idfk3` FOREIGN KEY (`curri_id_fk`) REFERENCES `tblcurriculum` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblstudent_pdf`
--
ALTER TABLE `tblstudent_pdf`
  ADD CONSTRAINT `tblpdf_id_fk1` FOREIGN KEY (`student_id_fk`) REFERENCES `tbluser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblpdf_id_fk2` FOREIGN KEY (`curri_id_fk`) REFERENCES `tblcurriculum` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblpdf_id_fk3` FOREIGN KEY (`college_id_fk`) REFERENCES `tblcollege` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblpdf_id_fk4` FOREIGN KEY (`course_id_fk`) REFERENCES `tblcourse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblsubject`
--
ALTER TABLE `tblsubject`
  ADD CONSTRAINT `tblsub_ibfk_1` FOREIGN KEY (`college_id_fk`) REFERENCES `tblcollege` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblsub_ibfk_2` FOREIGN KEY (`course_id_fk`) REFERENCES `tblcourse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblsub_ibfk_3` FOREIGN KEY (`curr_id_fk`) REFERENCES `tblcurriculum` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD CONSTRAINT `tbluser_ibfk_1` FOREIGN KEY (`college_id_fk`) REFERENCES `tblcollege` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbluser_ibfk_2` FOREIGN KEY (`course_id_fk`) REFERENCES `tblcourse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbluser_ibfk_3` FOREIGN KEY (`curri_id`) REFERENCES `tblcurriculum` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
