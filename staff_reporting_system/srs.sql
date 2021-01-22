-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2020 at 02:01 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `srs`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `no` int(40) NOT NULL,
  `dat` text NOT NULL,
  `class` text NOT NULL,
  `cteacher` varchar(40) NOT NULL,
  `present` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`no`, `dat`, `class`, `cteacher`, `present`) VALUES
(1, '15-03-2020', 'FY-COMPUTER', 'aditi@gmail.com', 66),
(2, '16-03-2020', 'FY-COMPUTER', 'aditi@gmail.com', 67);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `nam` text NOT NULL,
  `department` varchar(20) NOT NULL,
  `strength` int(20) NOT NULL,
  `cteacher` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`nam`, `department`, `strength`, `cteacher`) VALUES
('fy', 'computer', 70, 'aditi@gmail.com'),
('sy', 'it', 60, 'arpita@gmail.com'),
('sy', 'computer', 70, 'bhavana@gmail.com'),
('ky', 'civil', 70, 'daksha@gmail.com'),
('fy', 'mechanical', 80, 'mayuri@gmail.com'),
('ty', 'computer', 70, 'nikita@gmail.com'),
('fy', 'it', 60, 'pallavi@gmail.com'),
('ty', 'it', 60, 'pooja@gmail.com'),
('fy', 'civil', 50, 'pradnya@gmail.com'),
('sy', 'civil', 50, 'pratiksha@gmail.com'),
('sy', 'mechanical', 80, 'radhika@gmail.com'),
('ty', 'civil', 50, 'shraddha@gmail.com'),
('ty', 'mechanical', 80, 'varsha@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_name` varchar(20) NOT NULL,
  `id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_name`, `id`) VALUES
('computer', 1),
('it', 2),
('mechanical', 3),
('civil', 4);

-- --------------------------------------------------------

--
-- Table structure for table `extra_lectures`
--

CREATE TABLE `extra_lectures` (
  `id` int(11) NOT NULL,
  `dept_name` varchar(20) NOT NULL,
  `class_name` text NOT NULL,
  `dat` varchar(10) NOT NULL,
  `from_time` varchar(10) NOT NULL,
  `to_time` varchar(10) NOT NULL,
  `subject` text NOT NULL,
  `faculty` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `extra_lectures`
--

INSERT INTO `extra_lectures` (`id`, `dept_name`, `class_name`, `dat`, `from_time`, `to_time`, `subject`, `faculty`) VALUES
(1, 'computer', 'fy', '17-03-2020', '14:00', '14:30', 'discrete structures', 'aditi@gmail.com'),
(2, 'civil', 'ky', '16-03-2020', '10:30', '11:00', 'tom', 'daksha@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `notice_id` int(11) NOT NULL,
  `notice_subject` varchar(250) NOT NULL,
  `notice_text` text NOT NULL,
  `notice_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`notice_id`, `notice_subject`, `notice_text`, `notice_date`) VALUES
(1, 'this is a test', 'this is first test after adding datepicker.\r\nlet us hope it works', '15-03-2020'),
(2, 'what is going on here', 'this is a really bad situation', '15-03-2020'),
(4, 'welcome', 'the college welcomes daksha saraf', '15-03-2020');

--
-- Triggers `notices`
--
DELIMITER $$
CREATE TRIGGER `add_status` AFTER INSERT ON `notices` FOR EACH ROW BEGIN
INSERT INTO notices_status (notice_id, teacher) SELECT NEW.notice_id, teachers.email FROM notices JOIN teachers ON NEW.notice_id = notices.notice_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `clear_status` BEFORE DELETE ON `notices` FOR EACH ROW BEGIN
delete from notices_status where notice_id = OLD.notice_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `notices_status`
--

CREATE TABLE `notices_status` (
  `notice_id` int(11) NOT NULL,
  `teacher` varchar(40) NOT NULL,
  `notice_status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `notices_status`
--

INSERT INTO `notices_status` (`notice_id`, `teacher`, `notice_status`) VALUES
(1, 'aditi@gmail.com', 1),
(1, 'arpita@gmail.com', 1),
(1, 'bhavana@gmail.com', 0),
(1, 'mayuri@gmail.com', 0),
(1, 'nikita@gmail.com', 1),
(1, 'pallavi@gmail.com', 0),
(1, 'pooja@gmail.com', 0),
(1, 'pradnya@gmail.com', 0),
(1, 'pratiksha@gmail.com', 0),
(1, 'radhika@gmail.com', 0),
(1, 'shraddha@gmail.com', 0),
(1, 'varsha@gmail.com', 0),
(2, 'aditi@gmail.com', 1),
(2, 'arpita@gmail.com', 1),
(2, 'bhavana@gmail.com', 0),
(2, 'mayuri@gmail.com', 0),
(2, 'nikita@gmail.com', 0),
(2, 'pallavi@gmail.com', 0),
(2, 'pooja@gmail.com', 0),
(2, 'pradnya@gmail.com', 0),
(2, 'pratiksha@gmail.com', 0),
(2, 'radhika@gmail.com', 0),
(2, 'shraddha@gmail.com', 0),
(2, 'varsha@gmail.com', 0),
(4, 'aditi@gmail.com', 1),
(4, 'arpita@gmail.com', 0),
(4, 'bhavana@gmail.com', 0),
(4, 'daksha@gmail.com', 1),
(4, 'mayuri@gmail.com', 0),
(4, 'nikita@gmail.com', 0),
(4, 'pallavi@gmail.com', 0),
(4, 'pooja@gmail.com', 0),
(4, 'pradnya@gmail.com', 0),
(4, 'pratiksha@gmail.com', 0),
(4, 'radhika@gmail.com', 0),
(4, 'shraddha@gmail.com', 0),
(4, 'varsha@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` text NOT NULL,
  `position` text NOT NULL,
  `dept` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`name`, `surname`, `email`, `password`, `position`, `dept`) VALUES
('aditi', 'lachake', 'aditi@gmail.com', 'aditi@123', 'principal', 'computer'),
('arpita', 'wagh', 'arpita@gmail.com', 'arpita@123', 'teacher', 'it'),
('bhavana', 'gore', 'bhavana@gmail.com', 'bhavana@123', 'teacher', 'computer'),
('daksha', 'saraf', 'daksha@gmail.com', 'daksha@123', 'teacher', 'civil'),
('mayuri', 'bhand', 'mayuri@gmail.com', 'mayuri@123', 'teacher', 'mechanical'),
('nikita', 'kale', 'nikita@gmail.com', 'nikita@123', 'teacher', 'computer'),
('pallavi', 'shete', 'pallavi@gmail.com', 'pallavi@123', 'teacher', 'it'),
('pooja', 'rathi', 'pooja@gmail.com', 'pooja@123', 'teacher', 'it'),
('pradnya', 'rathi', 'pradnya@gmail.com', 'pradnya@123', 'teacher', 'civil'),
('pratiksha', 'kale', 'pratiksha@gmail.com', 'pratiksha@123', 'teacher', 'civil'),
('radhika', 'mutha', 'radhika@gmail.com', 'radhika@123', 'teacher', 'mechanical'),
('shraddha', 'gandhi', 'shraddha@gmail.com', 'shraddha@123', 'teacher', 'civil'),
('varsha', 'nagale', 'varsha@gmail.com', 'varsha@123', 'teacher', 'mechanical');

--
-- Triggers `teachers`
--
DELIMITER $$
CREATE TRIGGER `remove_class_when_teacher` BEFORE DELETE ON `teachers` FOR EACH ROW BEGIN
DELETE FROM class WHERE cteacher = OLD.email;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `teacher_class_leveler` AFTER INSERT ON `teachers` FOR EACH ROW BEGIN
INSERT INTO class VALUES ("NotAssigned","NotAssigned","0",NEW.email);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` int(40) NOT NULL,
  `dept_name` varchar(20) NOT NULL,
  `class_name` text NOT NULL,
  `day` text NOT NULL,
  `from_time` varchar(10) NOT NULL,
  `to_time` varchar(10) NOT NULL,
  `subject` text NOT NULL,
  `faculty` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `dept_name`, `class_name`, `day`, `from_time`, `to_time`, `subject`, `faculty`) VALUES
(1, 'computer', 'fy', 'monday', '09:00', '09:30', 'maths', 'aditi@gmail.com'),
(2, 'computer', 'fy', 'monday', '09:30', '10:00', 'c programming', 'bhavana@gmail.com'),
(3, 'computer', 'fy', 'monday', '10:00', '10:30', 'data structures', 'nikita@gmail.com'),
(4, 'computer', 'fy', 'monday', '10:30', '11:00', 'oop', 'aditi@gmail.com'),
(5, 'computer', 'fy', 'monday', '11:15', '11:45', 'electronics', 'bhavana@gmail.com'),
(6, 'it', 'sy', 'monday', '09:00', '09:30', 'computer graphics', 'arpita@gmail.com'),
(7, 'civil', 'ky', 'monday', '09:00', '09:30', 'som', 'daksha@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`cteacher`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extra_lectures`
--
ALTER TABLE `extra_lectures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `no` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `extra_lectures`
--
ALTER TABLE `extra_lectures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
