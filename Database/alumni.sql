-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 09, 2023 at 01:38 PM
-- Server version: 5.7.33
-- PHP Version: 8.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `email`, `password`) VALUES
(5, 'admin@admin.com', '482c811da5d5b4bc6d497ffa98491e38'),
(6, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `all_post`
--

CREATE TABLE `all_post` (
  `post_id` int(11) NOT NULL,
  `post_content` varchar(1000) DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `post_date` date NOT NULL,
  `post_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `event_title` varchar(255) DEFAULT NULL,
  `event_banner` varchar(4000) DEFAULT NULL,
  `event_description` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `image`) VALUES
(4, 'test', 'Elena Miledi2.jpg'),
(5, 'work1', 'work1.png');

-- --------------------------------------------------------

--
-- Table structure for table `login_codes`
--

CREATE TABLE `login_codes` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `code` varchar(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_codes`
--

INSERT INTO `login_codes` (`id`, `student_id`, `code`, `created_at`) VALUES
(1, 500, '709048', '2023-07-16 15:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `pdf_filename` varchar(4900) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `batch` varchar(10) NOT NULL,
  `department` varchar(255) NOT NULL,
  `session_year` varchar(255) NOT NULL,
  `photo` varchar(4900) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `currently_worked` varchar(255) DEFAULT NULL,
  `livein` varchar(100) DEFAULT NULL,
  `coverphoto` varchar(5000) DEFAULT NULL,
  `verification` varchar(6) DEFAULT NULL,
  `verify` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `last_name`, `father_name`, `mother_name`, `date_of_birth`, `batch`, `department`, `session_year`, `photo`, `mobile`, `email`, `pass`, `currently_worked`, `livein`, `coverphoto`, `verification`, `verify`) VALUES
(1, 'ds', 'ss', 'sf', 'gs', '2023-12-01', '10', 'CSE', '10', 'photo_uploads/Elena Miledi.jpg', '01766601932', 'saju@mail.com', 'saju', 'lynkto', NULL, NULL, NULL, 0),
(11, 'a', 's', 'd', 'f', '2011-11-11', '1', 'CSE', '2011', 'photo_uploads/Allie Haze.jpg', '11', 't@mail.com', '123', 'a', NULL, NULL, '732451', 1),
(1602049, 'Sazzad', 'Saju', 'Robert De Niro', 'Verenika', '1996-11-18', '10', 'CSE', '2016', 'photo_uploads/circle-cropped (2).png', '01766601932', 'sazzadsaju17@gmail.com', '123', 'lynkto', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `verify`
--

CREATE TABLE `verify` (
  `student_id` int(11) NOT NULL,
  `date_of_birth` date NOT NULL,
  `session_year` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verify`
--

INSERT INTO `verify` (`student_id`, `date_of_birth`, `session_year`) VALUES
(1, '2023-12-01', '10'),
(11, '2011-11-11', '2011'),
(1602049, '1996-11-18', '2016');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `all_post`
--
ALTER TABLE `all_post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_codes`
--
ALTER TABLE `login_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `verify`
--
ALTER TABLE `verify`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminlogin`
--
ALTER TABLE `adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `all_post`
--
ALTER TABLE `all_post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login_codes`
--
ALTER TABLE `login_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
