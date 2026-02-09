-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2025 at 08:24 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grade_assist`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_calendar`
--

CREATE TABLE `academic_calendar` (
  `id` int(11) NOT NULL,
  `class_start` date NOT NULL,
  `class_end` date NOT NULL,
  `1semester_start` date NOT NULL,
  `1semester_end` date NOT NULL,
  `2semester_start` date NOT NULL,
  `2semester_end` date NOT NULL,
  `1quarter_start` date NOT NULL,
  `1quarter_end` date NOT NULL,
  `2quarter_start` date NOT NULL,
  `2quarter_end` date NOT NULL,
  `3quarter_start` date NOT NULL,
  `3quarter_end` date NOT NULL,
  `4quarter_start` date NOT NULL,
  `4quarter_end` date NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academic_calendar`
--

INSERT INTO `academic_calendar` (`id`, `class_start`, `class_end`, `1semester_start`, `1semester_end`, `2semester_start`, `2semester_end`, `1quarter_start`, `1quarter_end`, `2quarter_start`, `2quarter_end`, `3quarter_start`, `3quarter_end`, `4quarter_start`, `4quarter_end`, `dateCreated`, `dateUpdated`) VALUES
(1, '2024-08-26', '2025-05-23', '2024-08-26', '2024-12-20', '2025-01-13', '2025-05-23', '2024-08-26', '2024-10-11', '2024-10-14', '2024-12-20', '2025-01-13', '2025-03-21', '2025-03-24', '2025-05-23', '2025-03-22 13:58:12', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `month_id` int(11) NOT NULL,
  `daysPresent` varchar(50) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `datUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `class_id`, `school_year_id`, `month_id`, `daysPresent`, `dateCreated`, `datUpdated`) VALUES
(1, 57, 1, 1, 1, '4', '2025-03-22 15:15:21', '2025-03-22 15:27:54'),
(2, 57, 1, 1, 2, '20', '2025-03-22 15:15:21', '2025-03-22 15:27:54'),
(3, 57, 1, 1, 3, '23', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(4, 57, 1, 1, 4, '21', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(5, 57, 1, 1, 5, '15', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(6, 57, 1, 1, 6, '15', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(7, 57, 1, 1, 7, '20', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(8, 57, 1, 1, 8, '21', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(9, 57, 1, 1, 9, '22', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(10, 56, 1, 1, 1, '5', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(11, 56, 1, 1, 2, '21', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(12, 56, 1, 1, 3, '23', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(13, 56, 1, 1, 4, '21', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(14, 56, 1, 1, 5, '15', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(15, 56, 1, 1, 6, '15', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(16, 56, 1, 1, 7, '20', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(17, 56, 1, 1, 8, '21', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(18, 56, 1, 1, 9, '22', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(19, 55, 1, 1, 1, '5', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(20, 55, 1, 1, 2, '20', '2025-03-22 15:15:21', '2025-03-22 15:27:54'),
(21, 55, 1, 1, 3, '23', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(22, 55, 1, 1, 4, '21', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(23, 55, 1, 1, 5, '15', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(24, 55, 1, 1, 6, '15', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(25, 55, 1, 1, 7, '20', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(26, 55, 1, 1, 8, '21', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(27, 55, 1, 1, 9, '22', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(28, 21, 1, 1, 1, '5', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(29, 21, 1, 1, 2, '21', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(30, 21, 1, 1, 3, '23', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(31, 21, 1, 1, 4, '21', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(32, 21, 1, 1, 5, '15', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(33, 21, 1, 1, 6, '15', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(34, 21, 1, 1, 7, '20', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(35, 21, 1, 1, 8, '21', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(36, 21, 1, 1, 9, '22', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(37, 54, 1, 1, 1, '5', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(38, 54, 1, 1, 2, '20', '2025-03-22 15:15:21', '2025-03-22 15:27:54'),
(39, 54, 1, 1, 3, '23', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(40, 54, 1, 1, 4, '21', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(41, 54, 1, 1, 5, '15', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(42, 54, 1, 1, 6, '15', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(43, 54, 1, 1, 7, '20', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(44, 54, 1, 1, 8, '21', '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(45, 54, 1, 1, 9, '22', '2025-03-22 15:15:21', '2025-03-22 15:15:21');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `section` varchar(50) NOT NULL,
  `gradeLevel` varchar(50) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `section`, `gradeLevel`, `faculty_id`, `school_year_id`, `dateCreated`, `dateUpdated`) VALUES
(1, 'Loyalty', 'Grade 7', 1, 1, '2025-03-22 14:12:37', '2025-03-22 14:12:37'),
(3, 'Freedom', 'Grade 8', 5, 1, '2025-10-03 13:30:23', '2025-10-03 13:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `class_students`
--

CREATE TABLE `class_students` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_students`
--

INSERT INTO `class_students` (`id`, `class_id`, `student_id`, `school_year_id`, `dateCreated`, `dateUpdated`) VALUES
(1, 1, 21, 1, '2025-03-22 14:25:35', '2025-03-22 14:25:35'),
(4, 1, 54, 1, '2025-03-22 15:11:14', '2025-03-22 15:11:14'),
(5, 1, 55, 1, '2025-03-22 15:11:14', '2025-03-22 15:11:14'),
(6, 1, 56, 1, '2025-03-22 15:11:14', '2025-03-22 15:11:14'),
(7, 1, 57, 1, '2025-03-22 15:11:14', '2025-03-22 15:11:14');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `emp_number` varchar(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `rank` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `emp_number`, `firstName`, `middleName`, `lastName`, `gender`, `rank`, `designation`, `department`, `status`, `dateCreated`, `dateUpdated`) VALUES
(1, '01594', 'Lorenjane', 'Esguerra', 'Balan', 'Female', 'Assoc. Prof. I', 'Faculty', 'High School', 'Permanent', '2025-02-20 15:17:54', '2025-02-20 15:17:54'),
(2, '01234', 'Erwin ', 'Reyes', 'Ardid', 'Male', 'Assoc. Prof. I', 'Registrar', 'Elementary', 'Permanent', '2025-02-20 15:25:41', '2025-02-20 15:25:41'),
(3, '01595', 'Maria', 'Corpuz', 'Agua', 'Female', 'Instructor I', 'Faculty', 'High School', 'Permanent', '2025-03-22 11:53:21', '2025-03-22 11:53:21'),
(4, '01596', 'Jose ', 'Leon', 'Carreon', 'Male', 'Instructor II', 'Faculty', 'High School', 'Permanent', '2025-03-22 11:54:02', '2025-03-22 11:54:02'),
(5, '01597', 'Jesus', 'Cruz', 'Dellima', 'Male', 'Instructor III', 'Faculty', 'High School', 'Permanent', '2025-03-22 11:54:50', '2025-03-22 11:54:50'),
(6, '01598', 'Isaac', 'Tan', 'Eras', 'Male', 'Asst. Prof. I', 'Faculty', 'High School', 'Permanent', '2025-03-22 11:55:25', '2025-03-22 11:55:25'),
(7, '01599', 'Margaret', 'Alonzo', 'Ferrer', 'Female', 'Instructor III', 'Faculty', 'High School', 'Permanent', '2025-03-22 11:56:08', '2025-03-22 11:56:08'),
(8, '01600', 'Jullina', 'Emeri', 'Galvez', 'Female', 'Instructor I', 'Faculty', 'High School', 'Temporary', '2025-03-22 11:56:34', '2025-03-22 11:56:34'),
(9, '01601', 'Ara', 'Grant', 'Herra', 'Female', 'Instructor I', 'Faculty', 'Elementary', 'Temporary', '2025-03-22 11:57:01', '2025-03-22 11:57:01'),
(10, '01602', 'Brian', 'Fara', 'Ilao', 'Male', 'Instructor I', 'Faculty', 'Elementary', 'Temporary', '2025-03-22 11:57:23', '2025-03-22 11:57:23'),
(11, '01603', 'Cynthia', 'Eroll', 'Jaro', 'Female', 'Instructor III', 'Faculty', 'Elementary', 'Permanent', '2025-03-22 11:58:02', '2025-03-22 11:58:02'),
(12, '01604', 'David', 'Driz', 'Lira', 'Male', 'Instructor I', 'Faculty', 'Elementary', 'Temporary', '2025-03-22 11:58:28', '2025-03-22 11:58:28'),
(13, '01605', 'Ezra', 'Cruz', 'Mendez', 'Female', 'Instructor I', 'Faculty', 'Elementary', 'Permanent', '2025-03-22 11:58:57', '2025-03-22 11:58:57'),
(14, '01606', 'Faith', 'Blas', 'Perez', 'Female', 'Instructor II', 'Faculty', 'Elementary', 'Permanent', '2025-03-22 11:59:26', '2025-03-22 11:59:26'),
(15, '01607', 'Grace', 'Arias', 'Quinia', 'Female', 'Instructor III', 'Faculty', 'Elementary', 'Permanent', '2025-03-22 12:00:00', '2025-03-22 12:00:00'),
(16, '01111', 'Alejandro', 'Roa', 'Velez', 'Male', 'Assoc. Prof. V', 'Principal', 'High School', 'Permanent', '2025-03-22 12:03:02', '2025-03-22 12:03:02'),
(17, '01592', 'Cristine', 'Perez', 'Dacillo', 'Female', 'Asst. Prof. II', 'Chairperson', 'Elementary', 'Permanent', '2025-03-22 12:03:36', '2025-03-22 12:03:36'),
(18, '01593', 'Roy', 'Tee', 'Villa', 'Male', 'Asst. Prof. I', 'Chairperson', 'High School', 'Permanent', '2025-03-22 12:03:59', '2025-03-22 12:03:59');

-- --------------------------------------------------------

--
-- Table structure for table `filter`
--

CREATE TABLE `filter` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `school_year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `quarter` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filter`
--

INSERT INTO `filter` (`id`, `user_id`, `school_year`, `semester`, `quarter`, `dateCreated`, `dateUpdated`) VALUES
(1, 42, 1, 1, 1, '2025-03-22 15:22:31', '2025-03-22 15:22:31');

-- --------------------------------------------------------

--
-- Table structure for table `grading_system`
--

CREATE TABLE `grading_system` (
  `id` int(11) NOT NULL,
  `written` int(50) NOT NULL,
  `performance` int(50) NOT NULL,
  `assessment` bigint(50) NOT NULL,
  `subjectArea` varchar(50) NOT NULL,
  `level` varchar(100) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grading_system`
--

INSERT INTO `grading_system` (`id`, `written`, `performance`, `assessment`, `subjectArea`, `level`, `dateCreated`, `dateUpdated`) VALUES
(1, 40, 40, 20, 'Science', 'Elementary', '2025-03-22 12:05:40', '2025-03-22 12:05:40'),
(2, 40, 40, 20, 'Math', 'Elementary', '2025-03-22 12:09:05', '2025-03-22 12:09:05'),
(3, 30, 50, 20, 'English', 'Elementary', '2025-03-22 12:09:37', '2025-03-22 12:09:37'),
(4, 30, 50, 20, 'Filipino', 'Elementary', '2025-03-22 12:09:58', '2025-03-22 12:09:58'),
(5, 30, 50, 20, 'AP', 'Elementary', '2025-03-22 12:10:21', '2025-03-22 12:10:21'),
(6, 30, 50, 20, 'ESP', 'Elementary', '2025-03-22 12:10:36', '2025-03-22 12:10:36'),
(7, 20, 60, 20, 'MAPEH', 'Elementary', '2025-03-22 13:45:44', '2025-03-22 13:45:44'),
(8, 20, 60, 20, 'EPP', 'Elementary', '2025-03-22 13:45:59', '2025-03-22 13:45:59'),
(9, 30, 50, 20, 'Filipino', 'High School', '2025-03-22 13:46:34', '2025-03-22 13:46:34'),
(10, 30, 50, 20, 'English', 'High School', '2025-03-22 13:46:53', '2025-03-22 13:46:53'),
(11, 30, 50, 20, 'AP', 'High School', '2025-03-22 13:47:11', '2025-03-22 13:47:11'),
(12, 30, 50, 20, 'AP', 'High School', '2025-03-22 13:47:27', '2025-03-22 13:47:27'),
(13, 30, 50, 20, 'ESP', 'High School', '2025-03-22 13:47:44', '2025-03-22 13:47:44'),
(14, 40, 40, 20, 'Science', 'High School', '2025-03-22 13:47:55', '2025-03-22 13:47:55'),
(15, 40, 40, 20, 'Math', 'High School', '2025-03-22 13:48:09', '2025-03-22 13:48:09'),
(16, 20, 60, 20, 'MAPEH', 'High School', '2025-03-22 13:48:26', '2025-03-22 13:48:26'),
(17, 20, 60, 20, 'TLE', 'High School', '2025-03-22 13:48:40', '2025-03-22 13:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `loads`
--

CREATE TABLE `loads` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `mapeh_name` varchar(50) NOT NULL,
  `class_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `hours_per_week` varchar(50) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loads`
--

INSERT INTO `loads` (`id`, `subject_id`, `mapeh_name`, `class_id`, `faculty_id`, `school_year_id`, `semester`, `hours_per_week`, `dateCreated`, `dateUpdated`) VALUES
(1, 3, '', 1, 18, 1, 0, '5', '2025-03-22 14:13:37', '2025-03-22 14:15:07'),
(2, 3, '', 2, 18, 1, 0, '5', '2025-03-22 14:14:52', '2025-03-22 14:14:52'),
(3, 3, '', 2, 18, 1, 0, '5', '2025-03-22 14:15:35', '2025-03-22 14:15:35'),
(4, 6, '', 1, 1, 1, 0, '3', '2025-03-22 14:17:06', '2025-03-22 14:17:06'),
(5, 3, '', 1, 18, 1, 0, '5', '2025-03-22 14:17:45', '2025-03-22 14:17:45'),
(6, 5, '', 1, 18, 1, 0, '3', '2025-03-22 14:18:19', '2025-03-22 14:18:19'),
(7, 1, '', 1, 3, 1, 0, '3', '2025-03-22 14:19:48', '2025-03-22 14:19:48'),
(9, 4, '', 1, 5, 1, 0, '3', '2025-03-22 14:21:19', '2025-03-22 14:21:19'),
(10, 5, '', 1, 6, 1, 0, '3', '2025-03-22 14:21:40', '2025-03-22 14:21:40'),
(11, 7, '', 1, 6, 1, 0, '3', '2025-03-22 14:21:51', '2025-03-22 14:21:51'),
(12, 8, '', 1, 7, 1, 0, '3', '2025-03-22 14:22:18', '2025-03-22 14:22:18'),
(13, 9, '', 1, 7, 1, 0, '3', '2025-03-22 14:22:36', '2025-03-22 14:22:36'),
(14, 10, 'Music 7', 1, 7, 1, 0, '4', '2025-03-22 14:22:51', '2025-03-22 14:22:51'),
(15, 10, 'Arts 7', 1, 7, 1, 0, '4', '2025-03-22 14:22:51', '2025-03-22 14:22:51'),
(16, 10, 'Physical Education 7', 1, 7, 1, 0, '4', '2025-03-22 14:22:51', '2025-03-22 14:22:51'),
(17, 10, 'Health 7', 1, 7, 1, 0, '4', '2025-03-22 14:22:51', '2025-03-22 14:22:51'),
(18, 1, '', 1, 18, 1, 0, '3', '2025-10-03 14:11:30', '2025-10-03 14:11:45');

-- --------------------------------------------------------

--
-- Table structure for table `months`
--

CREATE TABLE `months` (
  `id` int(11) NOT NULL,
  `monthName` varchar(100) NOT NULL,
  `daysInMonth` varchar(50) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `months`
--

INSERT INTO `months` (`id`, `monthName`, `daysInMonth`, `school_year_id`, `dateCreated`, `dateUpdated`) VALUES
(1, 'August', '5', 1, '2025-03-22 13:58:13', '2025-03-22 14:09:41'),
(2, 'September', '21', 1, '2025-03-22 13:58:13', '2025-03-22 14:09:41'),
(3, 'October', '23', 1, '2025-03-22 13:58:13', '2025-03-22 14:09:41'),
(4, 'November', '21', 1, '2025-03-22 13:58:13', '2025-03-22 14:09:41'),
(5, 'December', '15', 1, '2025-03-22 13:58:13', '2025-03-22 14:09:41'),
(6, 'January', '15', 1, '2025-03-22 13:58:13', '2025-03-22 14:09:41'),
(7, 'February', '20', 1, '2025-03-22 13:58:13', '2025-03-22 14:09:41'),
(8, 'March', '21', 1, '2025-03-22 13:58:13', '2025-03-22 14:09:41'),
(9, 'April', '22', 1, '2025-03-22 13:58:13', '2025-03-22 14:09:41');

-- --------------------------------------------------------

--
-- Table structure for table `observe_values_k`
--

CREATE TABLE `observe_values_k` (
  `id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `quarter_1` varchar(50) NOT NULL,
  `quarter_2` varchar(50) NOT NULL,
  `quarter_3` varchar(50) NOT NULL,
  `quarter_4` varchar(50) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `observe_values_sh`
--

CREATE TABLE `observe_values_sh` (
  `id` int(11) NOT NULL,
  `core_value` int(11) NOT NULL,
  `behavior_statement` int(11) NOT NULL,
  `quarter_1` varchar(50) NOT NULL,
  `quarter_2` varchar(50) NOT NULL,
  `quarter_3` varchar(50) NOT NULL,
  `quarter_4` varchar(50) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `observe_values_sh`
--

INSERT INTO `observe_values_sh` (`id`, `core_value`, `behavior_statement`, `quarter_1`, `quarter_2`, `quarter_3`, `quarter_4`, `student_id`, `class_id`, `school_year_id`, `dateCreated`, `dateUpdated`) VALUES
(1, 1, 1, 'AO', 'AO', 'AO', 'AO', 57, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(2, 1, 2, 'AO', 'AO', 'AO', 'AO', 57, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(3, 2, 3, 'AO', 'AO', 'AO', 'AO', 57, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(4, 2, 4, 'AO', 'AO', 'AO', 'AO', 57, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(5, 3, 5, 'AO', 'AO', 'AO', 'AO', 57, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(6, 4, 6, 'AO', 'AO', 'AO', 'AO', 57, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(7, 4, 7, 'AO', 'AO', 'AO', 'AO', 57, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(8, 1, 1, 'AO', 'AO', 'AO', 'AO', 56, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(9, 1, 2, 'AO', 'AO', 'AO', 'AO', 56, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(10, 2, 3, 'AO', 'AO', 'AO', 'AO', 56, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(11, 2, 4, 'AO', 'AO', 'AO', 'AO', 56, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(12, 3, 5, 'AO', 'AO', 'AO', 'AO', 56, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(13, 4, 6, 'AO', 'AO', 'AO', 'AO', 56, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(14, 4, 7, 'AO', 'AO', 'AO', 'AO', 56, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(15, 1, 1, 'AO', 'AO', 'AO', 'AO', 55, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(16, 1, 2, 'AO', 'AO', 'AO', 'AO', 55, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(17, 2, 3, 'AO', 'AO', 'AO', 'AO', 55, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(18, 2, 4, 'AO', 'AO', 'AO', 'AO', 55, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(19, 3, 5, 'AO', 'AO', 'AO', 'AO', 55, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(20, 4, 6, 'AO', 'AO', 'AO', 'AO', 55, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(21, 4, 7, 'AO', 'AO', 'AO', 'AO', 55, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(22, 1, 1, 'AO', 'AO', 'AO', 'AO', 21, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(23, 1, 2, 'AO', 'AO', 'AO', 'AO', 21, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(24, 2, 3, 'AO', 'AO', 'AO', 'AO', 21, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(25, 2, 4, 'AO', 'AO', 'AO', 'AO', 21, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(26, 3, 5, 'AO', 'AO', 'AO', 'AO', 21, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(27, 4, 6, 'AO', 'AO', 'AO', 'AO', 21, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(28, 4, 7, 'AO', 'AO', 'AO', 'AO', 21, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(29, 1, 1, 'AO', 'AO', 'AO', 'AO', 54, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(30, 1, 2, 'AO', 'AO', 'AO', 'AO', 54, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(31, 2, 3, 'AO', 'AO', 'AO', 'AO', 54, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(32, 2, 4, 'AO', 'AO', 'AO', 'AO', 54, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(33, 3, 5, 'AO', 'AO', 'AO', 'AO', 54, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(34, 4, 6, 'AO', 'AO', 'AO', 'AO', 54, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21'),
(35, 4, 7, 'AO', 'AO', 'AO', 'AO', 54, 1, 1, '2025-03-22 15:15:21', '2025-03-22 15:15:21');

-- --------------------------------------------------------

--
-- Table structure for table `performance_task`
--

CREATE TABLE `performance_task` (
  `id` int(11) NOT NULL,
  `pps1` varchar(11) NOT NULL,
  `pps2` varchar(11) NOT NULL,
  `pps3` varchar(11) NOT NULL,
  `pps4` varchar(11) NOT NULL,
  `pps5` varchar(11) NOT NULL,
  `pps6` varchar(11) NOT NULL,
  `pps7` varchar(11) NOT NULL,
  `pps8` varchar(11) NOT NULL,
  `pps9` varchar(11) NOT NULL,
  `pps10` varchar(11) NOT NULL,
  `load_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `quarter` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `performance_task`
--

INSERT INTO `performance_task` (`id`, `pps1`, `pps2`, `pps3`, `pps4`, `pps5`, `pps6`, `pps7`, `pps8`, `pps9`, `pps10`, `load_id`, `school_year_id`, `quarter`, `dateCreated`, `dateUpdated`) VALUES
(1, '50', '40', '', '', '', '', '', '', '', '', 4, 1, 1, '2025-03-22 15:19:25', '2025-03-22 15:19:56'),
(2, '35', '', '', '', '', '', '', '', '', '', 4, 1, 2, '2025-03-22 15:24:53', '2025-03-22 15:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `pt_score`
--

CREATE TABLE `pt_score` (
  `id` int(11) NOT NULL,
  `pt1` varchar(11) NOT NULL,
  `pt2` varchar(11) NOT NULL,
  `pt3` varchar(11) NOT NULL,
  `pt4` varchar(11) NOT NULL,
  `pt5` varchar(11) NOT NULL,
  `pt6` varchar(11) NOT NULL,
  `pt7` varchar(11) NOT NULL,
  `pt8` varchar(11) NOT NULL,
  `pt9` varchar(11) NOT NULL,
  `pt10` varchar(11) NOT NULL,
  `pt_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `quarter` int(11) NOT NULL,
  `load_id` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pt_score`
--

INSERT INTO `pt_score` (`id`, `pt1`, `pt2`, `pt3`, `pt4`, `pt5`, `pt6`, `pt7`, `pt8`, `pt9`, `pt10`, `pt_id`, `student_id`, `school_year_id`, `quarter`, `load_id`, `dateCreated`, `dateUpdated`) VALUES
(1, '45', '38', '', '', '', '', '', '', '', '', 1, 57, 1, 1, 4, '2025-03-22 15:19:44', '2025-03-22 15:20:20'),
(2, '45', '38', '', '', '', '', '', '', '', '', 1, 56, 1, 1, 4, '2025-03-22 15:19:44', '2025-03-22 15:20:20'),
(3, '45', '40', '', '', '', '', '', '', '', '', 1, 55, 1, 1, 4, '2025-03-22 15:19:44', '2025-03-22 15:20:20'),
(4, '45', '40', '', '', '', '', '', '', '', '', 1, 21, 1, 1, 4, '2025-03-22 15:19:44', '2025-03-22 15:20:20'),
(5, '45', '40', '', '', '', '', '', '', '', '', 1, 54, 1, 1, 4, '2025-03-22 15:19:44', '2025-03-22 15:20:20'),
(6, '20', '', '', '', '', '', '', '', '', '', 2, 57, 1, 2, 4, '2025-03-22 15:25:09', '2025-03-22 15:25:09'),
(7, '20', '', '', '', '', '', '', '', '', '', 2, 56, 1, 2, 4, '2025-03-22 15:25:09', '2025-03-22 15:25:09'),
(8, '15', '', '', '', '', '', '', '', '', '', 2, 55, 1, 2, 4, '2025-03-22 15:25:09', '2025-03-22 15:25:09'),
(9, '20', '', '', '', '', '', '', '', '', '', 2, 21, 1, 2, 4, '2025-03-22 15:25:09', '2025-03-22 15:25:09'),
(10, '25', '', '', '', '', '', '', '', '', '', 2, 54, 1, 2, 4, '2025-03-22 15:25:09', '2025-03-22 15:25:09');

-- --------------------------------------------------------

--
-- Table structure for table `qa_score`
--

CREATE TABLE `qa_score` (
  `id` int(11) NOT NULL,
  `score` varchar(11) NOT NULL,
  `qa_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `quarter` int(11) NOT NULL,
  `load_id` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qa_score`
--

INSERT INTO `qa_score` (`id`, `score`, `qa_id`, `student_id`, `school_year_id`, `quarter`, `load_id`, `dateCreated`, `dateUpdated`) VALUES
(1, '55', 1, 57, 1, 1, 4, '2025-03-22 15:21:07', '2025-03-22 15:21:07'),
(2, '52', 1, 56, 1, 1, 4, '2025-03-22 15:21:07', '2025-03-22 15:21:07'),
(3, '50', 1, 55, 1, 1, 4, '2025-03-22 15:21:07', '2025-03-22 15:21:07'),
(4, '55', 1, 21, 1, 1, 4, '2025-03-22 15:21:07', '2025-03-22 15:21:07'),
(5, '58', 1, 54, 1, 1, 4, '2025-03-22 15:21:07', '2025-03-22 15:21:07'),
(6, '54', 2, 57, 1, 2, 4, '2025-03-22 15:25:32', '2025-03-22 15:25:32'),
(7, '52', 2, 56, 1, 2, 4, '2025-03-22 15:25:32', '2025-03-22 15:25:32'),
(8, '52', 2, 55, 1, 2, 4, '2025-03-22 15:25:32', '2025-03-22 15:25:32'),
(9, '55', 2, 21, 1, 2, 4, '2025-03-22 15:25:32', '2025-03-22 15:25:32'),
(10, '58', 2, 54, 1, 2, 4, '2025-03-22 15:25:32', '2025-03-22 15:25:32');

-- --------------------------------------------------------

--
-- Table structure for table `quarterly_assessment`
--

CREATE TABLE `quarterly_assessment` (
  `id` int(11) NOT NULL,
  `ps` varchar(11) NOT NULL,
  `load_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `quarter` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quarterly_assessment`
--

INSERT INTO `quarterly_assessment` (`id`, `ps`, `load_id`, `school_year_id`, `quarter`, `dateCreated`, `dateUpdated`) VALUES
(1, '60', 4, 1, 1, '2025-03-22 15:20:46', '2025-03-22 15:20:46'),
(2, '60', 4, 1, 2, '2025-03-22 15:25:16', '2025-03-22 15:25:16');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `sr_code` varchar(50) NOT NULL,
  `lrn` int(50) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `contactNumber` varchar(50) NOT NULL,
  `homeAddress` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `fatherName` varchar(50) NOT NULL,
  `fatherOccupation` varchar(50) NOT NULL,
  `fatherContact` varchar(50) NOT NULL,
  `fatherEmail` varchar(50) NOT NULL,
  `motherName` varchar(50) NOT NULL,
  `motherOccupation` varchar(50) NOT NULL,
  `motherContact` varchar(50) NOT NULL,
  `motherEmail` varchar(50) NOT NULL,
  `guardianName` varchar(50) NOT NULL,
  `guardianOccupation` varchar(50) NOT NULL,
  `guardianContact` varchar(50) NOT NULL,
  `guardianEmail` varchar(50) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `sr_code`, `lrn`, `firstName`, `middleName`, `lastName`, `gender`, `birthday`, `contactNumber`, `homeAddress`, `email`, `religion`, `fatherName`, `fatherOccupation`, `fatherContact`, `fatherEmail`, `motherName`, `motherOccupation`, `motherContact`, `motherEmail`, `guardianName`, `guardianOccupation`, `guardianContact`, `guardianEmail`, `dateCreated`, `dateUpdated`) VALUES
(54, '2272460', 2147483647, 'Jhon Stephen', 'Mendoza', 'Villacrusis', 'Male', '2009-04-07', '9171239874', 'Nasugbu, Batangas', 'jhon.stephen@gmail.com', '', 'Catholic', 'Juan Villacrusis', 'Teacher', '9145896', 'Juan@gmail.com', '', '', '', '', '', '', '', '2025-03-22 15:10:30', '2025-03-22 15:10:30'),
(55, '2272461', 2147483647, 'Zachary Wayne', 'Penales', 'Matsumoto', 'Male', '2008-03-15', '9184563258', 'Nasugbu, Batangas', 'wayne@gmail.com', '', 'Catholic', '', '', '', '', '', '', '', '', '', '', '', '2025-03-22 15:10:30', '2025-03-22 15:10:30'),
(56, '2272462', 2147483647, 'Unico Renzo', 'Ruzol', 'Mallorca', 'Male', '2009-08-02', '9088112365', 'Nasugbu, Batangas', 'renzo@gmail.com', 'Cat', 'Catholic', '', '', '', '', '', '', '', '', '', '', '', '2025-03-22 15:10:30', '2025-03-22 15:12:22'),
(57, '2272463', 2147483647, 'Mycka Julia', 'Bendicio', 'Corpuz', 'Female', '2009-07-10', '9085469632', 'Nasugbu, Batangas', 'julia@gmail.com', '', 'Catholic', '', '', '', '', '', '', '', '', '', '', '', '2025-03-22 15:10:30', '2025-03-22 15:10:30');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `courseCode` varchar(50) NOT NULL,
  `courseTitle` varchar(100) NOT NULL,
  `gradeLevel` varchar(100) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `subjectType` varchar(50) NOT NULL,
  `subjectArea` varchar(100) NOT NULL,
  `contactHours` varchar(50) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `courseCode`, `courseTitle`, `gradeLevel`, `semester`, `subjectType`, `subjectArea`, `contactHours`, `dateCreated`, `dateUpdated`) VALUES
(1, 'Filipino 7', 'Panitikang Panrehiyon at Panuntunang Pambaralila', 'Grade 7', '', '', 'Language', '3', '2025-03-22 13:50:50', '2025-03-22 13:50:50'),
(2, 'English 7', 'Communication Arts Skills with Philippine Literature', 'Grade 7', '', '', 'Language', '4', '2025-03-22 13:51:36', '2025-03-22 13:51:36'),
(3, 'Mathematics 7', 'Algebra 1', 'Grade 7', '', '', 'Math', '5', '2025-03-22 13:52:11', '2025-03-22 13:52:11'),
(4, 'Science 7', 'Earth Science', 'Grade 7', '', '', 'Science', '3', '2025-03-22 13:52:39', '2025-03-22 13:52:39'),
(5, 'Technology 7', 'Robotics', 'Grade 7', '', '', 'TLE', '3', '2025-03-22 13:53:17', '2025-03-22 13:53:17'),
(6, 'Computer Science 7', 'Introduction to Computer Programming', 'Grade 7', '', '', 'TLE', '3', '2025-03-22 13:53:43', '2025-03-22 13:53:43'),
(7, 'Drawing 1', 'Freehand, Mechanical, Architectural, and Introduction to AutoCAD', 'Grade 7', '', '', 'TLE', '3', '2025-03-22 13:54:31', '2025-03-22 13:54:31'),
(8, 'Araling Panlipunan 7', 'Araling Asyano', 'Grade 7', '', '', 'AP', '3', '2025-03-22 13:55:04', '2025-03-22 13:55:04'),
(9, 'Edukasyon sa Pagpapahalaga 7', 'Pananagutang Pansarili', 'Grade 7', '', '', 'ESP', '2', '2025-03-22 13:55:36', '2025-03-22 13:55:36'),
(10, 'MAPEH 7', 'Music, Arts, Physical Education, and Health', 'Grade 7', '', '', 'MAPEH', '4', '2025-03-22 13:56:05', '2025-03-22 13:56:05');

-- --------------------------------------------------------

--
-- Table structure for table `subject_grades`
--

CREATE TABLE `subject_grades` (
  `id` int(11) NOT NULL,
  `q1_grade` varchar(50) NOT NULL,
  `q2_grade` varchar(50) NOT NULL,
  `q3_grade` varchar(50) NOT NULL,
  `q4_grade` varchar(50) NOT NULL,
  `load_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject_grades`
--

INSERT INTO `subject_grades` (`id`, `q1_grade`, `q2_grade`, `q3_grade`, `q4_grade`, `load_id`, `school_year_id`, `student_id`, `dateCreated`, `dateUpdated`) VALUES
(1, '95', '', '', '', 4, 1, 57, '2025-03-22 15:28:40', '2025-03-22 15:28:40'),
(2, '94', '', '', '', 4, 1, 56, '2025-03-22 15:28:40', '2025-03-22 15:28:40'),
(3, '95', '', '', '', 4, 1, 55, '2025-03-22 15:28:40', '2025-03-22 15:28:40'),
(4, '95', '', '', '', 4, 1, 21, '2025-03-22 15:28:40', '2025-03-22 15:28:40'),
(5, '95', '', '', '', 4, 1, 54, '2025-03-22 15:28:40', '2025-03-22 15:28:40');

-- --------------------------------------------------------

--
-- Table structure for table `submit_grades`
--

CREATE TABLE `submit_grades` (
  `id` int(11) NOT NULL,
  `load_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `quarter` int(11) NOT NULL DEFAULT '1',
  `status` varchar(50) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submit_grades`
--

INSERT INTO `submit_grades` (`id`, `load_id`, `faculty_id`, `quarter`, `status`, `dateCreated`, `dateUpdated`) VALUES
(1, 4, 1, 1, 'submit', '2025-03-22 15:28:40', '2025-03-22 15:28:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `userType` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `online_status` varchar(50) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `image`, `userType`, `user_id`, `status`, `online_status`, `dateCreated`, `dateUpdated`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '', 'admin', 0, 'enabled', 'online', '2024-06-24 15:57:18', '2025-10-08 19:21:36'),
(42, '01594', '21232f297a57a5a743894a0e4a801fc3', 'lorenjane.balan@gmail.com', '', 'faculty', 1, 'enabled', 'online', '2025-02-20 15:17:54', '2025-10-09 11:07:27'),
(43, '01234', '21232f297a57a5a743894a0e4a801fc3', '', '', 'registrar', 2, 'enabled', 'online', '2025-02-20 15:25:41', '2025-10-09 11:05:09'),
(44, '2272458', 'ce39108646533d11722fd039998bb653', 'maria.perez@gmail.com', '', 'student', 21, 'enabled', 'online', '2025-02-20 15:32:33', '2025-10-02 17:10:59'),
(45, '2272458', 'b796de94c4cb2cc0f0d46f4ab06c1fd4', 'maria.perez@gmail.com', '', 'parent', 21, 'enabled', 'offline', '2025-02-20 15:32:33', '2025-02-20 15:32:33'),
(46, '01595', '21232f297a57a5a743894a0e4a801fc3', '', '', 'faculty', 3, 'enabled', 'offline', '2025-03-22 11:53:21', '2025-10-09 11:07:14'),
(47, '01596', '94f94d77741ac308c335659fc73beaa1', '', '', 'faculty', 4, 'enabled', 'offline', '2025-03-22 11:54:02', '2025-03-22 11:54:02'),
(48, '01597', 'c2920402e27985161522eefd3748cc32', '', '', 'faculty', 5, 'enabled', 'offline', '2025-03-22 11:54:50', '2025-03-22 11:54:50'),
(49, '01598', 'd825f8ed0a2020e9cceb9f684e8e9c9f', '', '', 'faculty', 6, 'enabled', 'offline', '2025-03-22 11:55:25', '2025-03-22 11:55:25'),
(50, '01599', '14985993db3bb40287b5621c9508f87a', '', '', 'faculty', 7, 'enabled', 'offline', '2025-03-22 11:56:08', '2025-03-22 11:56:08'),
(51, '01600', 'f74f8d2ee43e95d49a686888643d547b', '', '', 'faculty', 8, 'enabled', 'offline', '2025-03-22 11:56:34', '2025-03-22 11:56:34'),
(52, '01601', 'c1354533494e90770958e3965e52213e', '', '', 'faculty', 9, 'enabled', 'offline', '2025-03-22 11:57:01', '2025-03-22 11:57:01'),
(53, '01602', 'ae1fbd51849d1d62e4473ec5dda6666b', '', '', 'faculty', 10, 'enabled', 'offline', '2025-03-22 11:57:23', '2025-03-22 11:57:23'),
(54, '01603', '370192a1aed957b83c7e4f32357e6fa0', '', '', 'faculty', 11, 'enabled', 'offline', '2025-03-22 11:58:02', '2025-03-22 11:58:02'),
(55, '01604', 'e7c9dce0f2eaab313aab4938813de071', '', '', 'faculty', 12, 'enabled', 'offline', '2025-03-22 11:58:28', '2025-03-22 11:58:28'),
(56, '01605', '8c10df71d1d4eb263152b8446a937a3f', '', '', 'faculty', 13, 'enabled', 'offline', '2025-03-22 11:58:57', '2025-03-22 11:58:57'),
(57, '01606', 'd0707d3ec74c85b23c1604eb93b2514e', '', '', 'faculty', 14, 'enabled', 'offline', '2025-03-22 11:59:26', '2025-03-22 11:59:26'),
(58, '01607', '8e444cf26ce0ca0dc6a3fe1f133ae90c', '', '', 'faculty', 15, 'enabled', 'offline', '2025-03-22 12:00:00', '2025-03-22 12:00:00'),
(59, '01111', 'd38e0c1cbf1fe0255e8fe326ed376d98', '', '', 'principal', 16, 'enabled', 'offline', '2025-03-22 12:03:02', '2025-03-22 12:03:02'),
(60, '01592', 'b3a7d578c30e55849cbdd1b9492441cc', '', '', 'chairperson', 17, 'enabled', 'offline', '2025-03-22 12:03:36', '2025-03-22 12:03:36'),
(61, '01593', '1238331d0e8f88bc9c56e84e2c15ae64', '', '', 'chairperson', 18, 'enabled', 'offline', '2025-03-22 12:03:59', '2025-03-22 12:03:59'),
(62, '2272459', 'dd6b57f83fc82051694011bb97e00ae0', 'maria.perez@gmail.com', '', 'student', 22, 'enabled', 'offline', '2025-03-22 14:31:32', '2025-03-22 14:31:32'),
(63, '2272459', '747215b2dd208a8c284603bfd30a605e', 'maria.perez@gmail.com', '', 'parent', 22, 'enabled', 'offline', '2025-03-22 14:31:32', '2025-03-22 14:31:32'),
(64, '2272460', '61beb2ec831d9f1f96a715226e7d99bd', '', '', 'student', 23, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(65, '2272460', '6d21d39a7bd06233deacafc5279e65b7', '', '', 'parent', 23, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(66, '2272461', '2718295e59d571615320ffaaf073ae67', '', '', 'student', 24, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(67, '2272461', '123f5c4fcada0dae6145f56da33a32ce', '', '', 'parent', 24, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(68, '2272462', '5ef40c30880f4692ff02915ec2de5e6d', '', '', 'student', 25, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(69, '2272462', '3eeb66ac9b3cdb3d6d6b76088f7ce1fb', '', '', 'parent', 25, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(70, '2272463', 'f255089893fb1837465170b1d8e4f1f0', '', '', 'student', 26, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(71, '2272463', '1326507d793eb01c4036561758e376ea', '', '', 'parent', 26, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(72, '2272464', '988b20361729e71a3eb3d2450402a7cb', '', '', 'student', 27, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(73, '2272464', 'd588b80a9726a750d3df574800438c66', '', '', 'parent', 27, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(74, '2272465', 'ec61634b1fa13124b34f54bbd72c67cd', '', '', 'student', 28, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(75, '2272465', '9bbaaef6a94fe1662227a9652c86a589', '', '', 'parent', 28, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(76, '2272466', '7c4e5864a5ac7fe699fce376d0260665', '', '', 'student', 29, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(77, '2272466', 'd46e802832ba88b7e37cb545dc5fa92a', '', '', 'parent', 29, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(78, '2272467', 'c7a1e12d7e6d9a03bc440823f8fc95a7', '', '', 'student', 30, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(79, '2272467', 'c7153ec24ea60a654fa62596fed3081b', '', '', 'parent', 30, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(80, '2272468', 'f3fde035daf6bdb3fb4f1bfad87ed793', '', '', 'student', 31, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(81, '2272468', '620e305b8fa4a871621dcef829e97764', '', '', 'parent', 31, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(82, '2272469', '470ccafc072cd23a385afcc2b58ef8eb', '', '', 'student', 32, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(83, '2272469', 'f83bd622feef745468c9e37c44dd974d', '', '', 'parent', 32, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(84, '2272470', '4469e2f025ba7c28e7654f5bb82064fa', '', '', 'student', 33, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(85, '2272470', '731ad3b71a67150cdd9f2372eadf5b3d', '', '', 'parent', 33, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(86, '2272471', 'b27f7a6c3d898d981bddbe872bd40a02', '', '', 'student', 34, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(87, '2272471', '5ef4717377feea7e90782d53771cf55b', '', '', 'parent', 34, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(88, '2272472', '3f0472cb53d1c8b9a204e02e4d4f5fa0', '', '', 'student', 35, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(89, '2272472', 'b774591487ba116c74addae433a951e4', '', '', 'parent', 35, 'enabled', 'offline', '2025-03-22 14:36:21', '2025-03-22 14:36:21'),
(90, '2272460', '61beb2ec831d9f1f96a715226e7d99bd', '', '', 'student', 36, 'enabled', 'offline', '2025-03-22 14:49:06', '2025-03-22 14:49:06'),
(91, '2272460', '6d21d39a7bd06233deacafc5279e65b7', '', '', 'parent', 36, 'enabled', 'offline', '2025-03-22 14:49:06', '2025-03-22 14:49:06'),
(92, '2272461', 'be14eab765765445e4a80dc4812dd562', '', '', 'student', 37, 'enabled', 'offline', '2025-03-22 14:49:06', '2025-03-22 14:49:06'),
(93, '2272461', '123f5c4fcada0dae6145f56da33a32ce', '', '', 'parent', 37, 'enabled', 'offline', '2025-03-22 14:49:06', '2025-03-22 14:49:06'),
(94, '2272462', 'abc6311eb068d918b982f1b8d01fb644', '', '', 'student', 38, 'enabled', 'offline', '2025-03-22 14:49:06', '2025-03-22 14:49:06'),
(95, '2272462', '3eeb66ac9b3cdb3d6d6b76088f7ce1fb', '', '', 'parent', 38, 'enabled', 'offline', '2025-03-22 14:49:06', '2025-03-22 14:49:06'),
(96, '2272463', 'b1322d70dbb537f9937b0f0fd45fd8af', '', '', 'student', 39, 'enabled', 'offline', '2025-03-22 14:49:06', '2025-03-22 14:49:06'),
(97, '2272463', '1326507d793eb01c4036561758e376ea', '', '', 'parent', 39, 'enabled', 'offline', '2025-03-22 14:49:06', '2025-03-22 14:49:06'),
(98, '2272460', 'c8f04c3ccef6087169fe4ab3688f4c80', 'Nasugbu, Batangas', '', 'student', 40, 'enabled', 'offline', '2025-03-22 14:55:09', '2025-03-22 14:55:09'),
(99, '2272460', '6d21d39a7bd06233deacafc5279e65b7', 'Nasugbu, Batangas', '', 'parent', 40, 'enabled', 'offline', '2025-03-22 14:55:09', '2025-03-22 14:55:09'),
(100, '2272461', 'f343ede61ed2b23804db9dfc18a310ec', 'Nasugbu, Batangas', '', 'student', 41, 'enabled', 'offline', '2025-03-22 14:55:09', '2025-03-22 14:55:09'),
(101, '2272461', '123f5c4fcada0dae6145f56da33a32ce', 'Nasugbu, Batangas', '', 'parent', 41, 'enabled', 'offline', '2025-03-22 14:55:09', '2025-03-22 14:55:09'),
(102, '2272462', 'be691cc3b54f912683ae9580488277c5', 'Nasugbu, Batangas', '', 'student', 42, 'enabled', 'offline', '2025-03-22 14:55:09', '2025-03-22 14:55:09'),
(103, '2272462', '3eeb66ac9b3cdb3d6d6b76088f7ce1fb', 'Nasugbu, Batangas', '', 'parent', 42, 'enabled', 'offline', '2025-03-22 14:55:09', '2025-03-22 14:55:09'),
(104, '2272463', '7edadb6742f728110f6feb94a34b87e2', 'Nasugbu, Batangas', '', 'student', 43, 'enabled', 'offline', '2025-03-22 14:55:09', '2025-03-22 14:55:09'),
(105, '2272463', '1326507d793eb01c4036561758e376ea', 'Nasugbu, Batangas', '', 'parent', 43, 'enabled', 'offline', '2025-03-22 14:55:09', '2025-03-22 14:55:09'),
(106, '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', 'student', 44, 'enabled', 'offline', '2025-03-22 14:55:09', '2025-03-22 14:55:09'),
(107, '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', 'parent', 44, 'enabled', 'offline', '2025-03-22 14:55:09', '2025-03-22 14:55:09'),
(108, '2272460', 'c8f04c3ccef6087169fe4ab3688f4c80', 'Nasugbu, Batangas', '', 'student', 45, 'enabled', 'offline', '2025-03-22 15:01:44', '2025-03-22 15:01:44'),
(109, '2272460', '6d21d39a7bd06233deacafc5279e65b7', 'Nasugbu, Batangas', '', 'parent', 45, 'enabled', 'offline', '2025-03-22 15:01:44', '2025-03-22 15:01:44'),
(110, '2272461', 'f343ede61ed2b23804db9dfc18a310ec', 'Nasugbu, Batangas', '', 'student', 46, 'enabled', 'offline', '2025-03-22 15:01:44', '2025-03-22 15:01:44'),
(111, '2272461', '123f5c4fcada0dae6145f56da33a32ce', 'Nasugbu, Batangas', '', 'parent', 46, 'enabled', 'offline', '2025-03-22 15:01:44', '2025-03-22 15:01:44'),
(112, '2272462', 'be691cc3b54f912683ae9580488277c5', 'Nasugbu, Batangas', '', 'student', 47, 'enabled', 'offline', '2025-03-22 15:01:44', '2025-03-22 15:01:44'),
(113, '2272462', '3eeb66ac9b3cdb3d6d6b76088f7ce1fb', 'Nasugbu, Batangas', '', 'parent', 47, 'enabled', 'offline', '2025-03-22 15:01:44', '2025-03-22 15:01:44'),
(114, '2272463', '7edadb6742f728110f6feb94a34b87e2', 'Nasugbu, Batangas', '', 'student', 48, 'enabled', 'offline', '2025-03-22 15:01:44', '2025-03-22 15:01:44'),
(115, '2272463', '1326507d793eb01c4036561758e376ea', 'Nasugbu, Batangas', '', 'parent', 48, 'enabled', 'offline', '2025-03-22 15:01:44', '2025-03-22 15:01:44'),
(116, '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', 'student', 49, 'enabled', 'offline', '2025-03-22 15:01:44', '2025-03-22 15:01:44'),
(117, '', 'd41d8cd98f00b204e9800998ecf8427e', '', '', 'parent', 49, 'enabled', 'offline', '2025-03-22 15:01:44', '2025-03-22 15:01:44'),
(118, '2272460', 'd8ea09b3c2d4479bfa85437169810161', 'Nasugbu, Batangas', '', 'student', 50, 'enabled', 'offline', '2025-03-22 15:06:36', '2025-03-22 15:06:36'),
(119, '2272460', '6d21d39a7bd06233deacafc5279e65b7', 'Nasugbu, Batangas', '', 'parent', 50, 'enabled', 'offline', '2025-03-22 15:06:36', '2025-03-22 15:06:36'),
(120, '2272461', '92a67d9e1bd4feb3a2be469757b3f7c0', 'Nasugbu, Batangas', '', 'student', 51, 'enabled', 'offline', '2025-03-22 15:06:36', '2025-03-22 15:06:36'),
(121, '2272461', '123f5c4fcada0dae6145f56da33a32ce', 'Nasugbu, Batangas', '', 'parent', 51, 'enabled', 'offline', '2025-03-22 15:06:36', '2025-03-22 15:06:36'),
(122, '2272462', 'c25cf58601646fc62d5bf1a652dd0026', 'Nasugbu, Batangas', '', 'student', 52, 'enabled', 'offline', '2025-03-22 15:06:36', '2025-03-22 15:06:36'),
(123, '2272462', '3eeb66ac9b3cdb3d6d6b76088f7ce1fb', 'Nasugbu, Batangas', '', 'parent', 52, 'enabled', 'offline', '2025-03-22 15:06:36', '2025-03-22 15:06:36'),
(124, '2272463', 'a61332aa1d8bf164eec5cab263eb40d0', 'Nasugbu, Batangas', '', 'student', 53, 'enabled', 'offline', '2025-03-22 15:06:36', '2025-03-22 15:06:36'),
(125, '2272463', '1326507d793eb01c4036561758e376ea', 'Nasugbu, Batangas', '', 'parent', 53, 'enabled', 'offline', '2025-03-22 15:06:36', '2025-03-22 15:06:36'),
(126, '2272460', 'd8ea09b3c2d4479bfa85437169810161', 'jhon.stephen@gmail.com', '', 'student', 54, 'enabled', 'offline', '2025-03-22 15:10:30', '2025-03-22 15:10:30'),
(127, '2272460', '6d21d39a7bd06233deacafc5279e65b7', 'jhon.stephen@gmail.com', '', 'parent', 54, 'enabled', 'offline', '2025-03-22 15:10:30', '2025-03-22 15:10:30'),
(128, '2272461', '92a67d9e1bd4feb3a2be469757b3f7c0', 'wayne@gmail.com', '', 'student', 55, 'enabled', 'offline', '2025-03-22 15:10:30', '2025-03-22 15:10:30'),
(129, '2272461', '123f5c4fcada0dae6145f56da33a32ce', 'wayne@gmail.com', '', 'parent', 55, 'enabled', 'offline', '2025-03-22 15:10:30', '2025-03-22 15:10:30'),
(130, '2272462', 'c25cf58601646fc62d5bf1a652dd0026', 'renzo@gmail.com', '', 'student', 56, 'enabled', 'offline', '2025-03-22 15:10:30', '2025-03-22 15:10:30'),
(131, '2272462', '3eeb66ac9b3cdb3d6d6b76088f7ce1fb', 'renzo@gmail.com', '', 'parent', 56, 'enabled', 'offline', '2025-03-22 15:10:30', '2025-03-22 15:10:30'),
(132, '2272463', 'a61332aa1d8bf164eec5cab263eb40d0', 'julia@gmail.com', '', 'student', 57, 'enabled', 'offline', '2025-03-22 15:10:30', '2025-03-22 15:10:30'),
(133, '2272463', '1326507d793eb01c4036561758e376ea', 'julia@gmail.com', '', 'parent', 57, 'enabled', 'offline', '2025-03-22 15:10:30', '2025-03-22 15:10:30');

-- --------------------------------------------------------

--
-- Table structure for table `written_works`
--

CREATE TABLE `written_works` (
  `id` int(11) NOT NULL,
  `wps1` varchar(11) NOT NULL,
  `wps2` varchar(11) NOT NULL,
  `wps3` varchar(11) NOT NULL,
  `wps4` varchar(11) NOT NULL,
  `wps5` varchar(11) NOT NULL,
  `wps6` varchar(11) NOT NULL,
  `wps7` varchar(11) NOT NULL,
  `wps8` varchar(11) NOT NULL,
  `wps9` varchar(11) NOT NULL,
  `wps10` varchar(11) NOT NULL,
  `load_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `quarter` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `written_works`
--

INSERT INTO `written_works` (`id`, `wps1`, `wps2`, `wps3`, `wps4`, `wps5`, `wps6`, `wps7`, `wps8`, `wps9`, `wps10`, `load_id`, `school_year_id`, `quarter`, `dateCreated`, `dateUpdated`) VALUES
(1, '10', '25', '15', '', '', '', '', '', '', '', 4, 1, 1, '2025-03-22 15:16:29', '2025-03-22 15:18:37'),
(2, '25', '', '', '', '', '', '', '', '', '', 4, 1, 2, '2025-03-22 15:24:27', '2025-03-22 15:24:27');

-- --------------------------------------------------------

--
-- Table structure for table `ww_score`
--

CREATE TABLE `ww_score` (
  `id` int(11) NOT NULL,
  `w1` varchar(11) NOT NULL,
  `w2` varchar(11) NOT NULL,
  `w3` varchar(11) NOT NULL,
  `w4` varchar(11) NOT NULL,
  `w5` varchar(11) NOT NULL,
  `w6` varchar(11) NOT NULL,
  `w7` varchar(11) NOT NULL,
  `w8` varchar(11) NOT NULL,
  `w9` varchar(11) NOT NULL,
  `w10` varchar(11) NOT NULL,
  `ww_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `quarter` int(11) NOT NULL,
  `load_id` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ww_score`
--

INSERT INTO `ww_score` (`id`, `w1`, `w2`, `w3`, `w4`, `w5`, `w6`, `w7`, `w8`, `w9`, `w10`, `ww_id`, `student_id`, `school_year_id`, `quarter`, `load_id`, `dateCreated`, `dateUpdated`) VALUES
(1, '9', '25', '15', '', '', '', '', '', '', '', 1, 57, 1, 1, 4, '2025-03-22 15:18:02', '2025-03-22 15:19:12'),
(2, '9', '22', '15', '', '', '', '', '', '', '', 1, 56, 1, 1, 4, '2025-03-22 15:18:02', '2025-03-22 15:19:12'),
(3, '10', '25', '15', '', '', '', '', '', '', '', 1, 55, 1, 1, 4, '2025-03-22 15:18:02', '2025-03-22 15:19:12'),
(4, '9', '22', '15', '', '', '', '', '', '', '', 1, 21, 1, 1, 4, '2025-03-22 15:18:02', '2025-03-22 15:19:12'),
(5, '8', '20', '15', '', '', '', '', '', '', '', 1, 54, 1, 1, 4, '2025-03-22 15:18:02', '2025-03-22 15:19:12'),
(6, '20', '', '', '', '', '', '', '', '', '', 2, 57, 1, 2, 4, '2025-03-22 15:24:45', '2025-03-22 15:24:45'),
(7, '20', '', '', '', '', '', '', '', '', '', 2, 56, 1, 2, 4, '2025-03-22 15:24:45', '2025-03-22 15:24:45'),
(8, '15', '', '', '', '', '', '', '', '', '', 2, 55, 1, 2, 4, '2025-03-22 15:24:45', '2025-03-22 15:24:45'),
(9, '20', '', '', '', '', '', '', '', '', '', 2, 21, 1, 2, 4, '2025-03-22 15:24:45', '2025-03-22 15:24:45'),
(10, '25', '', '', '', '', '', '', '', '', '', 2, 54, 1, 2, 4, '2025-03-22 15:24:45', '2025-03-22 15:24:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_calendar`
--
ALTER TABLE `academic_calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_students`
--
ALTER TABLE `class_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filter`
--
ALTER TABLE `filter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grading_system`
--
ALTER TABLE `grading_system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loads`
--
ALTER TABLE `loads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `months`
--
ALTER TABLE `months`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `observe_values_k`
--
ALTER TABLE `observe_values_k`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `observe_values_sh`
--
ALTER TABLE `observe_values_sh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `performance_task`
--
ALTER TABLE `performance_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pt_score`
--
ALTER TABLE `pt_score`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qa_score`
--
ALTER TABLE `qa_score`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quarterly_assessment`
--
ALTER TABLE `quarterly_assessment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_grades`
--
ALTER TABLE `subject_grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submit_grades`
--
ALTER TABLE `submit_grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `written_works`
--
ALTER TABLE `written_works`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ww_score`
--
ALTER TABLE `ww_score`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_calendar`
--
ALTER TABLE `academic_calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `class_students`
--
ALTER TABLE `class_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `filter`
--
ALTER TABLE `filter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `grading_system`
--
ALTER TABLE `grading_system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `loads`
--
ALTER TABLE `loads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `months`
--
ALTER TABLE `months`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `observe_values_k`
--
ALTER TABLE `observe_values_k`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `observe_values_sh`
--
ALTER TABLE `observe_values_sh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `performance_task`
--
ALTER TABLE `performance_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pt_score`
--
ALTER TABLE `pt_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `qa_score`
--
ALTER TABLE `qa_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `quarterly_assessment`
--
ALTER TABLE `quarterly_assessment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subject_grades`
--
ALTER TABLE `subject_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `submit_grades`
--
ALTER TABLE `submit_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `written_works`
--
ALTER TABLE `written_works`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ww_score`
--
ALTER TABLE `ww_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
