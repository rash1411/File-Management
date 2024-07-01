-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2024 at 02:09 PM
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
-- Database: `file_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `application_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `training_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `user_id` int(11) NOT NULL,
  `applicant_remarks` varchar(250) DEFAULT NULL,
  `time_created` datetime DEFAULT NULL,
  `ad_gh_review` tinyint(1) DEFAULT 0,
  `ad_gh_remarks` varchar(250) DEFAULT NULL,
  `ad_status` varchar(50) DEFAULT NULL,
  `ad_gh_id` int(11) NOT NULL,
  `ad_gh_time` datetime DEFAULT NULL,
  `head_tcp_hr` tinyint(1) DEFAULT 0,
  `head_tcp_hr_remarks` varchar(250) DEFAULT NULL,
  `head_tcp_hr_status` varchar(50) DEFAULT NULL,
  `head_tcp_hr_time` datetime DEFAULT NULL,
  `ad_tcp_hr` tinyint(1) DEFAULT 0,
  `ad_tcp_hr_remarks` varchar(250) DEFAULT NULL,
  `ad_tcp_hr_status` varchar(50) DEFAULT NULL,
  `ad_tcp_hr_time` datetime DEFAULT NULL,
  `director` tinyint(1) DEFAULT 0,
  `director_remarks` varchar(250) DEFAULT NULL,
  `director_status` varchar(50) DEFAULT NULL,
  `director_time` datetime DEFAULT NULL,
  `is_deleted` enum('YES','NO') NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'IT Audit'),
(2, 'Antivirus / Firewall'),
(3, 'Windows / Ubuntu  OS guidelines'),
(4, 'Internet guidelines'),
(5, 'IT Hardware Security'),
(6, 'IT Software Security'),
(9, 'DRONA guidelines'),
(10, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `letter_number` varchar(255) NOT NULL,
  `letter_date` date NOT NULL,
  `received_from` varchar(255) NOT NULL,
  `remarks` text DEFAULT NULL,
  `file_name` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `category_id`, `subject`, `letter_number`, `letter_date`, `received_from`, `remarks`, `file_name`, `upload_date`) VALUES
(1, 2, 'Other', '12', '2024-06-03', 'ejide', '6ur7ujiohp', 'To whom it may concern.docx', '2024-06-28 18:30:00'),
(2, 6, 'Other', '12', '2024-05-28', 'ejide', 'dwqd', 'web p-22.docx', '2024-06-26 18:30:00'),
(4, 5, 'good', '3445', '2024-05-27', 'direcrtor', 'nice', 'LFX Cover letter.docx', '2024-06-24 17:09:38'),
(5, 7, 'goodwill', '2345', '2024-06-20', 'director', 'nice', 'web p-22.docx', '2024-06-28 18:30:00'),
(6, 4, 'goodwill', '3738', '2024-06-18', 'principal', 'good', 'LFX Cover letter.docx', '2024-06-24 17:44:52'),
(9, 6, 'xqw', '2222', '2024-07-01', 'ednd', 'wedewdf', 'ski-sgg 29 jun.pdf', '2024-06-29 18:30:00'),
(10, 5, 'Ticket', '1234', '2024-06-28', 'director', 'good work', 'Web p-23.pdf', '2024-06-28 18:30:00'),
(13, 1, 'first', '1', '2024-06-20', 'first', 'first', 'poster slp vi.pdf', '2024-06-29 13:19:28'),
(14, 1, 'second', '2', '2024-06-21', 'second', 'second', 'madhupur-ski 3 july.pdf', '2024-06-29 13:20:00'),
(15, 6, 'fourth', '4', '2024-06-28', 'Director', 'good', 'madhpur-ski 3 july p2.pdf', '2024-06-29 13:41:43');

-- --------------------------------------------------------

--
-- Table structure for table `id_cadre`
--

CREATE TABLE `id_cadre` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` enum('YES','NO') NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id_cadre`
--

INSERT INTO `id_cadre` (`id`, `name`, `is_created`, `is_deleted`) VALUES
(101, 'test cadre', '2022-07-19 02:06:45', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `id_desig`
--

CREATE TABLE `id_desig` (
  `id` int(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `desig_fullname` varchar(50) NOT NULL,
  `cadre_id` int(4) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` enum('YES','NO') NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id_desig`
--

INSERT INTO `id_desig` (`id`, `name`, `desig_fullname`, `cadre_id`, `is_created`, `is_deleted`) VALUES
(1011, 'RiTik VasHisT', 'RiTik VasHisT', 1, '2022-07-18 02:16:39', 'NO'),
(1012, 'test desig', 'Testing Designation', 101, '2022-07-19 02:07:27', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `id_emp`
--

CREATE TABLE `id_emp` (
  `id` int(6) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `gen` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `cadre_id` tinyint(4) NOT NULL,
  `desig_id` int(5) NOT NULL,
  `internal_desig_id` int(4) NOT NULL,
  `group_id` int(5) NOT NULL,
  `user_type` char(9) NOT NULL,
  `telephone_no` varchar(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` enum('YES','NO') NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id_emp`
--

INSERT INTO `id_emp` (`id`, `first_name`, `middle_name`, `last_name`, `gen`, `dob`, `mobile_no`, `email_id`, `cadre_id`, `desig_id`, `internal_desig_id`, `group_id`, `user_type`, `telephone_no`, `username`, `password`, `status`, `is_created`, `is_deleted`) VALUES
(101, 'Ritik', '', 'Vashist', 'Male', '2001-09-01', '9911330906', 'ritikvashist0109@gmail.com', 101, 1011, 101, 101, 'admin', '130', 'ritik', '12', 1, '2022-07-10 05:29:01', 'NO'),
(102, 'Rishabh', '', 'Vashist', 'Male', '2022-07-11', '9911330906', 'rsgv0212@gmail.com', 101, 101, 101, 101, 'user', '', 'ri', '12', 1, '2022-07-10 06:09:23', 'NO'),
(103, 'Kshitij Dwivedi', '', '', 'Male', '2022-07-18', '8383917575', 'test@gmail.com', 101, 1011, 101, 102, 'user', '', 'kshitij', '517d7a57bd7e6c167fab9cb519ce5849', 1, '2022-07-18 04:37:24', 'NO'),
(104, 'testing code', '', '', 'Male', '2022-07-18', '8383917575', 'test@gmail.com', 0, 1011, 101, 102, 'admin', '', 'test', '12', 1, '2022-07-19 02:06:12', 'NO'),
(105, 'test ad', '', '', 'Male', '2022-07-12', '5587545', '', 0, 1011, 0, 103, 'user', '', 'testad', 'bf58f1fbf92896ef64cf6265a5889c42', 1, '2022-07-25 23:42:59', 'NO'),
(106, 'test gh', '', '', '', '0000-00-00', '', '', 0, 1011, 0, 103, 'user', '', 'testgh', 'c3e4bfdc7e40ac65a58068e88018c93f', 1, '2022-07-25 23:44:42', 'NO'),
(107, 'director', '', '', '', '0000-00-00', '', '', 0, 1011, 0, 104, 'user', '', 'director', '3d4e992d8d8a7d848724aa26ed7f4176', 1, '2022-07-26 01:12:27', 'NO'),
(108, 'TEST', '', 'Vashist', 'Male', '2001-09-01', '9911330906', 'ritikvashist0109@gmail.com', 101, 1011, 101, 101, 'user', '130', 'testkd', 'b6519cc4217f22ea078ebbbed345537c', 1, '2022-07-09 23:59:01', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `id_group`
--

CREATE TABLE `id_group` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(15) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `gh_id` int(6) NOT NULL,
  `ad_id` int(5) NOT NULL,
  `va1_id` int(6) NOT NULL,
  `va2_id` int(6) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` enum('YES','NO') NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id_group`
--

INSERT INTO `id_group` (`id`, `name`, `fullname`, `gh_id`, `ad_id`, `va1_id`, `va2_id`, `is_created`, `is_deleted`) VALUES
(101, 'Ritik Vashist G', 'Group 1', 0, 0, 101, 101, '2022-07-18 02:21:08', 'NO'),
(102, 'Testing Group', 'Testing Group Dummy', 0, 103, 0, 0, '2022-07-19 02:09:23', 'NO'),
(103, 'TCP-HR', 'Training Cell', 106, 105, 0, 0, '2022-07-23 06:14:13', 'NO'),
(104, 'Director', 'Director', 107, 0, 0, 0, '2022-07-26 01:11:14', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `id_internaldesig`
--

CREATE TABLE `id_internaldesig` (
  `id` int(4) NOT NULL,
  `shortname` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` enum('YES','NO') NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id_internaldesig`
--

INSERT INTO `id_internaldesig` (`id`, `shortname`, `fullname`, `is_created`, `is_deleted`) VALUES
(1, 'Director', 'Director', '2022-08-10 07:42:18', 'NO'),
(2, 'AD', 'Associate Director', '2022-08-10 07:42:18', 'NO'),
(3, 'GH', 'Group Head', '2022-08-10 07:42:18', 'NO'),
(4, 'Employee', 'Employee', '2022-08-10 07:42:18', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `old_emp`
--

CREATE TABLE `old_emp` (
  `id` int(6) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `gen` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `cadre_id` tinyint(4) NOT NULL,
  `desig_id` int(5) NOT NULL,
  `internal_desig_id` int(4) NOT NULL,
  `group_id` int(5) NOT NULL,
  `user_type` char(9) NOT NULL,
  `telephone_no` varchar(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `is_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` enum('YES','NO') NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `training_details`
--

CREATE TABLE `training_details` (
  `training_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `user_id` int(11) NOT NULL,
  `training_title` varchar(100) NOT NULL,
  `training_details` varchar(250) NOT NULL,
  `training_type` varchar(50) NOT NULL,
  `training_type_detail` varchar(50) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `duration` int(11) GENERATED ALWAYS AS (to_days(`end_date`) - to_days(`start_date`)) VIRTUAL,
  `org_institute` varchar(100) NOT NULL,
  `institute_address` varchar(100) NOT NULL,
  `training_mode` varchar(10) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `pin_dop_pis` varchar(11) DEFAULT NULL,
  `drona_email_id` varchar(319) DEFAULT NULL,
  `gender` enum('MALE','FEMALE','PREFER NOT TO SAY') NOT NULL DEFAULT 'PREFER NOT TO SAY',
  `qualification` varchar(255) NOT NULL,
  `research_paper` enum('YES','NO') DEFAULT 'NO',
  `title_of_paper` varchar(255) DEFAULT NULL,
  `paper_submitted` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `training_fee` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `amount` int(11) DEFAULT 0,
  `cheque_in_favour` varchar(255) DEFAULT NULL,
  `payable_at` varchar(255) DEFAULT NULL,
  `last_date_fee_submission` date DEFAULT NULL,
  `is_confirmed` enum('YES','NO') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `is_admin`) VALUES
(1, 'rahul', '1234', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `training_id` (`training_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `ad_gh_id` (`ad_gh_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_cadre`
--
ALTER TABLE `id_cadre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_desig`
--
ALTER TABLE `id_desig`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_emp`
--
ALTER TABLE `id_emp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_group`
--
ALTER TABLE `id_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ad_id` (`ad_id`);

--
-- Indexes for table `id_internaldesig`
--
ALTER TABLE `id_internaldesig`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `old_emp`
--
ALTER TABLE `old_emp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_details`
--
ALTER TABLE `training_details`
  ADD PRIMARY KEY (`training_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `application_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `id_cadre`
--
ALTER TABLE `id_cadre`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `id_desig`
--
ALTER TABLE `id_desig`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1013;

--
-- AUTO_INCREMENT for table `id_emp`
--
ALTER TABLE `id_emp`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `id_group`
--
ALTER TABLE `id_group`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `id_internaldesig`
--
ALTER TABLE `id_internaldesig`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `old_emp`
--
ALTER TABLE `old_emp`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `training_details`
--
ALTER TABLE `training_details`
  MODIFY `training_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`training_id`) REFERENCES `training_details` (`training_id`),
  ADD CONSTRAINT `application_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `old_emp` (`id`),
  ADD CONSTRAINT `application_ibfk_3` FOREIGN KEY (`ad_gh_id`) REFERENCES `old_emp` (`id`);

--
-- Constraints for table `training_details`
--
ALTER TABLE `training_details`
  ADD CONSTRAINT `training_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `old_emp` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
