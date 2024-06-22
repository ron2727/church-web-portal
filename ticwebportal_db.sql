-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 08, 2023 at 06:27 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticwebportal_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ban_duration`
--

CREATE TABLE `ban_duration` (
  `id` int(11) NOT NULL,
  `user_id` varchar(45) NOT NULL,
  `date_duration` varchar(20) NOT NULL,
  `time_duration` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `baptism_consent`
--

CREATE TABLE `baptism_consent` (
  `id` int(11) NOT NULL,
  `form_id` varchar(45) NOT NULL,
  `f_given_name` varchar(45) NOT NULL,
  `f_lastname` varchar(45) NOT NULL,
  `f_english_name` varchar(45) NOT NULL,
  `f_religion` varchar(45) NOT NULL,
  `f_attend_worship` varchar(45) NOT NULL,
  `f_others` text NOT NULL,
  `m_given_name` varchar(45) NOT NULL,
  `m_lastname` varchar(45) NOT NULL,
  `m_english_name` varchar(45) NOT NULL,
  `m_religion` varchar(45) NOT NULL,
  `m_attend_worship` varchar(45) NOT NULL,
  `m_others` text NOT NULL,
  `date` date NOT NULL,
  `contact_num` varchar(45) NOT NULL,
  `archived` varchar(20) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `baptism_consent`
--

INSERT INTO `baptism_consent` (`id`, `form_id`, `f_given_name`, `f_lastname`, `f_english_name`, `f_religion`, `f_attend_worship`, `f_others`, `m_given_name`, `m_lastname`, `m_english_name`, `m_religion`, `m_attend_worship`, `m_others`, `date`, `contact_num`, `archived`) VALUES
(7, '643befa8717f8', 'John', 'Dela Cruz', '', 'Catholic', 'Yes', '', 'Dela Cruz', 'Maria', 'Maria', 'Catholic', 'Yes', '', '2023-04-16', '09564196459', 'no'),
(8, '643bf01086fe2', 'Jones', 'Dela Cruz', '', 'Catholic', 'Yes', '', 'Jona', 'Dela Cruz', 'Jona', 'Catholic', 'Yes', '', '2023-04-16', '09564196459', 'yes'),
(9, '6443ba892c514', 'Dela Cruz', 'John Doe', '', 'Catholic', 'Yes', '', 'Dela Cruz', 'Mary', '', 'Catholic', 'Yes', '', '2023-04-22', '09682480123', 'no'),
(10, '6443bacfe5b80', 'Dela Cruz', 'John Doe', '', 'Catholic', 'Yes', '', 'Dela Cruz', 'Mary', '', 'Catholic', 'Yes', '', '2023-04-22', '09682480123', 'no'),
(11, '6443bb0696ee1', 'Dela Cruz', 'John Doe', '', 'Catholic', 'Yes', '', 'Dela Cruz', 'Mary', '', 'Catholic', 'Yes', '', '2023-04-22', '09682480123', 'no'),
(12, '6443bb13cd6ea', 'Dela Cruz', 'John Doe', '', 'Catholic', 'Yes', '', 'Dela Cruz', 'Mary', '', 'Catholic', 'Yes', '', '2023-04-22', '09682480123', 'no'),
(13, '6443bb4f4abe1', 'Dela Cruz', 'John Doe', '', 'Catholic', 'Yes', '', 'Dela Cruz', 'Mary', '', 'Catholic', 'Yes', '', '2023-04-22', '09682480123', 'no'),
(15, '645b674d7776b', 'Jake', 'Abad', '', '', '', '', 'Jen', 'Abad', '', '', '', '', '2023-05-10', '09564196789', 'no'),
(16, '645fdf588b8fa', 'Rodel', 'Buere', '', '', '', '', 'Raquel', 'Rosario', '', '', '', '', '2023-05-13', '09564196459', 'no'),
(17, '646090438e93a', 'Rodel', 'Buere', '', '', '', '', 'Raquel', 'Rosario', '', '', '', '', '2023-05-14', '09564196459', 'no'),
(18, '6460a25ff1b80', 'Anthony', 'Angeles', '', '', '', '', 'Jona', 'Angeles', '', '', '', '', '2023-05-14', '09564196459', 'no'),
(19, '6460acd6e0374', 'Jake', 'Dela Cruz', '', '', '', '', 'Jen', 'Dela Cruz', '', '', '', '', '2023-05-14', '09564196459', 'no'),
(20, '6460ad5198a5a', 'Jake', 'Dela Cruz', '', '', '', '', 'Jen', 'Dela Cruz', '', '', '', '', '2023-05-14', '09564196459', 'no'),
(21, '6460adae2c207', 'Jake', 'Dela Cruz', '', '', '', '', 'Jen', 'Dela Cruz', '', '', '', '', '2023-05-14', '09564196459', 'no'),
(22, '64f99a542fbbd', 'tset', 'ets', 'setset', 'setset', 'No', 'setset', 'se', 'setset', 'tstset', '', '', '', '2023-09-07', '09561967897', 'no'),
(23, '64fab72641016', '', 'Hello', '', '1', '', '', '', '', '', '', '', '', '2023-09-08', '09564196459', 'no'),
(24, '6502cacfd19f7', 'JohnRon', 'Buere', '', 'Catholic', '', 'asdasd', 'Jen', 'Dela Cruz', '', 'Catholic', '', '', '2023-09-14', '09564196781', 'no'),
(25, '6502cb583b0f2', 'Dela Cruz', 'John Doe', '', '', '', '', 'JohnRon', 'Buere', '', 'Catholic', '', '', '2023-09-14', '09682480123', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `baptism_form`
--

CREATE TABLE `baptism_form` (
  `form_id` varchar(45) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `service` varchar(45) NOT NULL,
  `baptism_type` varchar(20) NOT NULL,
  `sched_date` varchar(45) NOT NULL,
  `time_from` varchar(45) NOT NULL,
  `time_to` varchar(45) NOT NULL,
  `certificate_no` varchar(45) NOT NULL,
  `date_of_application` date NOT NULL,
  `title` varchar(10) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(45) NOT NULL,
  `telephone` varchar(45) NOT NULL,
  `date_of_birth` date NOT NULL,
  `nationality` varchar(45) NOT NULL,
  `occupation` varchar(45) NOT NULL,
  `marital_status` varchar(45) NOT NULL,
  `kingdom_group` varchar(45) NOT NULL,
  `date_of_salvation` date NOT NULL,
  `attend_worship` varchar(10) NOT NULL,
  `starting_from` date NOT NULL,
  `testimony` text NOT NULL,
  `pre_req1` varchar(10) NOT NULL,
  `pre_req2` varchar(10) NOT NULL,
  `prev_religion` varchar(45) NOT NULL,
  `age` varchar(45) NOT NULL,
  `image` varchar(45) NOT NULL,
  `status` varchar(20) NOT NULL,
  `archived` varchar(20) NOT NULL DEFAULT 'no',
  `birth_certificate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `baptism_form`
--

INSERT INTO `baptism_form` (`form_id`, `user_id`, `service`, `baptism_type`, `sched_date`, `time_from`, `time_to`, `certificate_no`, `date_of_application`, `title`, `firstname`, `lastname`, `address`, `email`, `telephone`, `date_of_birth`, `nationality`, `occupation`, `marital_status`, `kingdom_group`, `date_of_salvation`, `attend_worship`, `starting_from`, `testimony`, `pre_req1`, `pre_req2`, `prev_religion`, `age`, `image`, `status`, `archived`, `birth_certificate`) VALUES
('643befa8717f8', '', 'Baptism', 'child', '09/23/2023', '09:00', '10:00', '', '2023-04-16', '', 'Juan', 'Delacruz', 'Rizal', 'kikobuere27@gmail.com', '', '2023-04-17', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '0', 'BAP-IMG645e421c91856.jpg', 'Pending', 'yes', ''),
('64fab72641016', '642f922e2eb13', 'Baptism', 'child', '09/23/2023', '10:00', '11:00', '', '2023-09-08', '', 'Jamesssasdasdasd', 'Abando', 'Rizal', 'zaynee27@gmail.com', '', '2022-01-08', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '1', '', 'Completed', 'yes', 'PSA-IMG64fab726415d4.png'),
('64fad971d62a0', '642f922e2eb13', 'Baptism', 'youth', '09/16/2023', '15:00', '17:00', '', '2023-09-08', '', 'JohnRon', 'Buere', 'rizalsasdasdasdasdas', '', '0956419789', '2005-09-08', '', '', 'Single', 'Vineyard1', '2023-09-08', 'Yes', '2023-09-08', '', 'Yes', 'Yes', 'Islam', '18', '', 'Completed', 'yes', 'PSA-IMG64fad971d62b6.png'),
('6502cacfd19f7', '642f922e2eb13', 'Baptism', 'child', '09/23/2023', '10:00', '11:00', '', '2023-09-14', '', 'Juan', 'Delacruz', 'Rizal', 'zaynee27@gmail.com', '', '2023-01-31', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '0', '', 'Completed', 'yes', 'PSA-IMG6502cacfd2517.png'),
('6502cb583b0f2', '642f922e2eb13', 'Baptism', 'child', '09/23/2023', '09:00', '10:00', '', '2023-09-14', '', 'Jamesaadasdasd', 'Delacruza', 'Rizal', 'zaynee27@gmail.com', '', '2022-09-01', '', '', '', '', '0000-00-00', '', '0000-00-00', '', '', '', '', '1', '', 'Completed', 'yes', 'PSA-IMG6502cb583b7ad.png');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` varchar(45) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` varchar(45) NOT NULL,
  `comment` mediumtext NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `post_id`, `user_id`, `comment`, `date`, `time`, `status`) VALUES
('645f5370d02e8', 1, '642f922e2eb13', 'Hello', '2023-05-13', '17:08:00', 'Active'),
('645f5dd809b23', 3, '643747e2a6ed7', 'Hello', '2023-05-13', '17:52:24', 'Banned'),
('6461669227875', 3, '642f922e2eb13', 'test', '2023-05-15', '06:54:10', 'Active'),
('646167238f6b1', 3, '642f922e2eb13', 'test', '2023-05-15', '06:56:35', 'Active'),
('646168ee19c0e', 3, '642f922e2eb13', 'hi', '2023-05-15', '07:04:14', 'Active'),
('6461690e9910f', 4, '642f922e2eb13', 'Hi', '2023-05-15', '07:04:46', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `title` varchar(90) NOT NULL,
  `place` varchar(90) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `description` longtext NOT NULL,
  `image` mediumtext NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `status`, `title`, `place`, `date`, `time`, `description`, `image`, `month`, `year`) VALUES
(1, 'Past', 'Christmass Party', 'San Juan Taytay, Rizal', '2022-12-23', '17:00:00', '<p>There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration in some form, by injected humour or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum you need to be sure there isnt anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition injected humour or non-characteristic words etc.</p>', 'EVENT-IMG640b20cff3b08.jpg', 'December', '2022'),
(2, 'Past', 'GLC True Life Retreat 2023', 'San Juan Taytay, Rizal', '2023-04-28', '08:00:00', '<p><strong>GLC True Life Retreat 2023</strong></p>', 'EVENT-IMG6437334c197dd.jpg', 'April', '2023'),
(3, 'Past', 'New Years Party', 'San Juan Taytay, Rizal', '2022-12-31', '13:00:00', '', 'EVENT-IMG640b3e4f9bd1d.jpg', 'December', '2022'),
(4, 'Past', 'Mass Gathering', 'San Juan Taytay, Rizal', '2022-11-25', '21:00:00', '', 'EVENT-IMG640b3e5b72abd.jpg', 'November', '2022'),
(5, 'Past', 'Youth Gathering', 'Cainta Rizal', '2022-04-08', '21:00:00', '', 'EVENT-IMG640b3e6a5ec80.jpg', 'April', '2022'),
(6, 'Past', 'GROUNDED: Discipleship in a Woke Culture', 'San Juan Taytay, Rizal', '2023-02-06', '09:00:00', '<p>GROUNDED: Discipleship in a Woke Culture</p>', 'EVENT-IMG643734d74f595.png', 'February', '2023'),
(9, 'Past', 'Demo', 'San Juan Taytay, Rizal', '2022-04-19', '20:00:00', '<p>Test</p>', 'EVENT-IMG643fd1711d94b.', 'April', '2022');

-- --------------------------------------------------------

--
-- Table structure for table `forum_like`
--

CREATE TABLE `forum_like` (
  `id` int(11) NOT NULL,
  `user_id` varchar(45) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_like`
--

INSERT INTO `forum_like` (`id`, `user_id`, `post_id`) VALUES
(15, '642f922e2eb13', 1),
(16, '642f922e2eb13', 5);

-- --------------------------------------------------------

--
-- Table structure for table `forum_notification`
--

CREATE TABLE `forum_notification` (
  `notification_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` varchar(45) NOT NULL,
  `source_id` varchar(45) NOT NULL,
  `type` varchar(20) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `view` varchar(20) NOT NULL DEFAULT 'no',
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum_notification`
--

INSERT INTO `forum_notification` (`notification_id`, `post_id`, `user_id`, `source_id`, `type`, `date`, `time`, `view`, `date_time`) VALUES
(1, 3, '643747e2a6ed7', '641431df83d8a', 'banned1', '2023-05-13', '17:23:00', 'yes', '2023-05-13 17:23:00'),
(2, 3, '643747e2a6ed7', '641431df83d8a', 'banned1', '2023-05-13', '17:39:47', 'yes', '2023-05-13 17:39:47'),
(3, 3, '643747e2a6ed7', '641431df83d8a', 'banned1', '2023-05-13', '17:45:19', 'no', '2023-05-13 17:45:19'),
(4, 3, '643747e2a6ed7', '641431df83d8a', 'banned1', '2023-05-13', '17:45:19', 'no', '2023-05-13 17:45:19'),
(5, 3, '643747e2a6ed7', '641431df83d8a', 'banned1', '2023-05-13', '17:45:20', 'no', '2023-05-13 17:45:20'),
(6, 3, '643747e2a6ed7', '641431df83d8a', 'banned1', '2023-05-13', '17:45:21', 'no', '2023-05-13 17:45:21'),
(7, 3, '643747e2a6ed7', '641431df83d8a', 'banned1', '2023-05-13', '17:45:21', 'no', '2023-05-13 17:45:21'),
(8, 3, '643747e2a6ed7', '641431df83d8a', 'banned1', '2023-05-13', '17:47:32', 'no', '2023-05-13 17:47:32'),
(9, 3, '643747e2a6ed7', '641431df83d8a', 'banned1', '2023-05-13', '17:48:53', 'no', '2023-05-13 17:48:53'),
(10, 3, '643747e2a6ed7', '641431df83d8a', 'banned1', '2023-05-13', '17:50:02', 'no', '2023-05-13 17:50:02'),
(11, 3, '643747e2a6ed7', '641431df83d8a', 'banned1', '2023-05-13', '17:50:41', 'no', '2023-05-13 17:50:41'),
(12, 3, '643747e2a6ed7', '641431df83d8a', 'banned1', '2023-05-13', '17:52:12', 'yes', '2023-05-13 17:52:12'),
(13, 3, '643747e2a6ed7', '641431df83d8a', 'banned3', '2023-05-13', '17:53:25', 'yes', '2023-05-13 17:53:25'),
(14, 3, '643747e2a6ed7', '641431df83d8a', 'banned3', '2023-05-13', '17:56:54', 'yes', '2023-05-13 17:56:54'),
(15, 3, '643747e2a6ed7', '642f922e2eb13', 'comment', '2023-05-15', '06:54:10', 'no', '2023-05-15 06:54:10'),
(16, 3, '643747e2a6ed7', '642f922e2eb13', 'comment', '2023-05-15', '06:56:35', 'no', '2023-05-15 06:56:35'),
(17, 3, '643747e2a6ed7', '642f922e2eb13', 'comment', '2023-05-15', '07:04:14', 'yes', '2023-05-15 07:04:14');

-- --------------------------------------------------------

--
-- Table structure for table `forum_report`
--

CREATE TABLE `forum_report` (
  `id` int(11) NOT NULL,
  `source` int(11) NOT NULL,
  `created_by` varchar(45) NOT NULL,
  `reported_by` varchar(45) NOT NULL,
  `type` varchar(20) NOT NULL,
  `reason` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `funeral_form`
--

CREATE TABLE `funeral_form` (
  `form_id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `tracking_number` varchar(45) NOT NULL,
  `service` varchar(45) NOT NULL,
  `sched_date` varchar(45) NOT NULL,
  `time_from` varchar(45) NOT NULL,
  `time_to` varchar(45) NOT NULL,
  `deceased_fname` varchar(45) NOT NULL,
  `deceased_lname` varchar(45) NOT NULL,
  `deceased_mname` varchar(45) NOT NULL,
  `deceased_birthday` date NOT NULL,
  `deceased_birthplace_city` varchar(45) NOT NULL,
  `deceased_birthplace_province` varchar(45) NOT NULL,
  `deceased_birthplace_country` varchar(45) NOT NULL,
  `deceased_dateofdeath` date NOT NULL,
  `deceased_natureofdeath` varchar(45) NOT NULL,
  `deceased_church_deno` varchar(45) DEFAULT NULL,
  `deceased_dateofbaptism` date DEFAULT NULL,
  `deceased_church_membership_ptd` varchar(45) DEFAULT NULL,
  `applicant_fname` varchar(45) NOT NULL,
  `applicant_lname` varchar(45) NOT NULL,
  `applicant_mname` varchar(45) NOT NULL,
  `applicant_birthday` date NOT NULL,
  `applicant_address` text NOT NULL,
  `applicant_rttd` varchar(45) NOT NULL,
  `applicant_pftb` varchar(45) NOT NULL,
  `applicant_ns_place` varchar(45) NOT NULL,
  `applicant_ns_date` date NOT NULL,
  `applicant_ns_time` time NOT NULL,
  `applicant_fs_place` varchar(45) NOT NULL,
  `applicant_fs_date` date NOT NULL,
  `applicant_fs_time` time NOT NULL,
  `applicant_contactnum` varchar(11) DEFAULT NULL,
  `applicant_email` varchar(45) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `archived` varchar(20) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `funeral_form`
--

INSERT INTO `funeral_form` (`form_id`, `user_id`, `tracking_number`, `service`, `sched_date`, `time_from`, `time_to`, `deceased_fname`, `deceased_lname`, `deceased_mname`, `deceased_birthday`, `deceased_birthplace_city`, `deceased_birthplace_province`, `deceased_birthplace_country`, `deceased_dateofdeath`, `deceased_natureofdeath`, `deceased_church_deno`, `deceased_dateofbaptism`, `deceased_church_membership_ptd`, `applicant_fname`, `applicant_lname`, `applicant_mname`, `applicant_birthday`, `applicant_address`, `applicant_rttd`, `applicant_pftb`, `applicant_ns_place`, `applicant_ns_date`, `applicant_ns_time`, `applicant_fs_place`, `applicant_fs_date`, `applicant_fs_time`, `applicant_contactnum`, `applicant_email`, `status`, `archived`) VALUES
(1, '', 'TIC74665819348', 'Funeral', '04/20/2023', '10:00', '11:00', 'Nataniel', 'Abad', 'Cruz', '1950-04-19', 'Taytay, Rizal', 'Rizal', 'Philippines', '2023-04-20', 'Accident', '', '0000-00-00', '', 'Nathan', 'Abanto', 'Alcoy', '1990-04-20', 'San Juan, Taytay Rizal', 'Sibling', 'Burial', '', '0000-00-00', '00:00:00', '', '0000-00-00', '00:00:00', '09564196782', 'nathanabanto27@gmail.com', 'Completed', 'yes'),
(2, '', 'TIC65748291668', 'Funeral', '04/26/2023', '09:00', '10:00', 'Juan', 'Indiana', '', '1950-04-23', 'Angongo', 'Rizal', 'Philippines', '2023-04-23', '', '', '0000-00-00', '', 'Nick', 'Sarmiento', '', '1990-04-23', 'Angono, Rizal', 'Select Relationship to the deceased...', 'Select Preferences for the body...', '', '0000-00-00', '00:00:00', '', '0000-00-00', '00:00:00', '09687854123', 'kikobuere27@gmail.com', 'Completed', 'yes'),
(10, '', 'TIC98226631686', 'Funeral', '05/10/2023', '11:00', '12:00', 'Fin', 'Indiana', '', '1950-05-10', 'Taytay', 'Rizal', 'Philippines', '2023-05-10', 'Natural Death', '', '0000-00-00', '', 'Pen', 'Indiana', '', '1990-05-10', 'Taytay, Rizal', 'Child', 'Burial', '', '0000-00-00', '00:00:00', '', '0000-00-00', '00:00:00', '09564196786', 'kikobuere27@gmail.com', 'Completed', 'yes'),
(11, '', 'TIC92283932292', 'Funeral', '05/16/2023', '10:00', '11:00', 'Jak', 'Indiana', '', '1945-05-14', 'Taytay', 'Rizal', 'Philippines', '2023-05-14', 'Natural Death', NULL, NULL, NULL, 'Mary', 'Indian', '', '1990-05-14', 'Taytay, Rizal', 'Select Relationship to the deceased...', 'Select Preferences for the body...', '', '0000-00-00', '00:00:00', '', '0000-00-00', '00:00:00', '09564196786', 'kikobuere27@gmail.com', 'Pending', 'no'),
(12, '642f922e2eb13', '', 'Funeral', '10/09/2023', '09:00', '10:00', 'radas', 'dasdas', '', '2023-10-01', 'Angongo', 'Rizal', '', '2023-10-07', '', NULL, NULL, NULL, 'Mary', 'Doe', '', '1998-10-07', 'Angono, Rizal', 'Select Relationship to the deceased...', 'Select Preferences for the body...', '', '0000-00-00', '00:00:00', '', '0000-00-00', '00:00:00', '09687854123', 'zaynee27@gmail.com', 'Pending', 'no'),
(13, '642f922e2eb13', '', 'Funeral', '10/09/2023', '10:00', '11:00', 'asdas', 'dasd', '', '2023-10-07', 'Taytay', 'Rizal', '', '2023-10-07', '', NULL, NULL, NULL, 'asdasd', 'asdasd', '', '2023-10-07', 'Angono, Rizal', 'Select Relationship to the deceased...', 'Select Preferences for the body...', '', '0000-00-00', '00:00:00', '', '0000-00-00', '00:00:00', '09564196786', 'zaynee27@gmail.com', 'Pending', 'no'),
(14, '642f922e2eb13', '', 'Funeral', '10/09/2023', '11:00', '12:00', 'asdasaa123', 'dasd', '', '2023-10-07', 'Taytay', 'Rizal', '', '2023-10-07', '', '', '0000-00-00', '', 'asdasd123', 'asdasd123', '', '2023-10-07', 'Angono, Rizal', 'Select Relationship to the deceased...', 'Select Preferences for the body...', '', '0000-00-00', '00:00:00', '', '0000-00-00', '00:00:00', '09564196786', 'zaynee27@gmail.com', 'Pending', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `pastor`
--

CREATE TABLE `pastor` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `position` varchar(20) NOT NULL,
  `description` tinytext NOT NULL,
  `image` varchar(45) NOT NULL,
  `privacy` varchar(20) NOT NULL DEFAULT 'visible'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pastor`
--

INSERT INTO `pastor` (`id`, `name`, `position`, `description`, `image`, `privacy`) VALUES
(3, 'Pastor Rafael Ciocon', 'Assistant Pastor', 'Since its founding, the Taytay Immanuel Church. Pastor Rafael Ciocon at a young age, he was Introduced by his parents to the church environment\r\n\r\nSince its founding, the Taytay Immanuel Church. Pastor Rafael Ciocon at a young age', 'PROF-IMG6432103546486.png', 'visible'),
(4, 'Sis. Evelyn Siocon', 'Women Ministry', '', 'PROF-IMG64321170ba7f2.png', 'visible'),
(5, 'Bro Alberto Lopoy Jr.', 'Youth Ministry', '', 'PROF-IMG643211e8b1e2a.png', 'visible');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `user_id` varchar(45) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `text` longtext NOT NULL,
  `views` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `privacy` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `user_id`, `topic_id`, `text`, `views`, `date`, `time`, `privacy`, `status`) VALUES
(1, '642f922e2eb13', 1, '<p>12345</p>', 14, '2023-05-13', '16:56:00', 'Private', 'Active'),
(2, '642f922e2eb13', 1, '<p>asdasdasdasd</p>', 15, '2023-05-13', '17:12:00', 'Private', 'Active'),
(3, '643747e2a6ed7', 2, '<p>This is music</p>', 80, '2023-05-13', '17:19:00', 'Music Team', 'Active'),
(4, '642f922e2eb13', 1, '<h1 style=\"text-align: center; \"><em style=\"\"><del style=\"\"><strong>h12323</strong></del></em></h1>', 53, '2023-05-13', '21:23:00', 'Private', 'Active'),
(5, '643747e2a6ed7', 1, '<p>Hello this is for events</p>', 36, '2023-05-15', '07:08:00', 'Locked', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `reply_id` int(11) NOT NULL,
  `comment_id` varchar(45) NOT NULL,
  `user_id` varchar(45) NOT NULL,
  `reply` mediumtext NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`reply_id`, `comment_id`, `user_id`, `reply`, `date`, `time`) VALUES
(3, '645f5370d02e8', '642f922e2eb13', 'Hi', '2023-05-13', '17:08:04'),
(4, '645f5370d02e8', '642f922e2eb13', 'What your Name', '2023-05-13', '17:08:10'),
(5, '646167238f6b1', '642f922e2eb13', 'test3', '2023-05-15', '06:56:43'),
(6, '646167238f6b1', '642f922e2eb13', '1', '2023-05-15', '07:03:44'),
(7, '6461669227875', '642f922e2eb13', '2', '2023-05-15', '07:03:51'),
(8, '646167238f6b1', '642f922e2eb13', '3', '2023-05-15', '07:03:54'),
(9, '6461669227875', '642f922e2eb13', '4', '2023-05-15', '07:03:57'),
(10, '646167238f6b1', '642f922e2eb13', '4', '2023-05-15', '07:04:01'),
(11, '6461669227875', '642f922e2eb13', '5', '2023-05-15', '07:04:03'),
(12, '646168ee19c0e', '642f922e2eb13', 'hello', '2023-05-15', '07:04:20'),
(13, '6461690e9910f', '642f922e2eb13', 'Hello', '2023-05-15', '07:04:53');

-- --------------------------------------------------------

--
-- Table structure for table `reported_comment`
--

CREATE TABLE `reported_comment` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_id` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL,
  `reported_by` varchar(45) NOT NULL,
  `reason` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reported_comment`
--

INSERT INTO `reported_comment` (`id`, `post_id`, `comment_id`, `created_by`, `reported_by`, `reason`) VALUES
(1, 3, '645f5dd809b23', '643747e2a6ed7', '642f922e2eb13', 'Sexual exploitation');

-- --------------------------------------------------------

--
-- Table structure for table `reported_member`
--

CREATE TABLE `reported_member` (
  `id` int(11) NOT NULL,
  `user_id` varchar(45) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reported_member`
--

INSERT INTO `reported_member` (`id`, `user_id`, `type`) VALUES
(8, '643747e2a6ed7', 'post'),
(9, '643747e2a6ed7', 'post'),
(10, '643747e2a6ed7', 'post'),
(11, '643747e2a6ed7', 'post'),
(12, '643747e2a6ed7', 'post'),
(13, '643747e2a6ed7', 'comment'),
(14, '643747e2a6ed7', 'comment');

-- --------------------------------------------------------

--
-- Table structure for table `reported_post`
--

CREATE TABLE `reported_post` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `created_by` varchar(45) NOT NULL,
  `reported_by` varchar(45) NOT NULL,
  `reason` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reported_post`
--

INSERT INTO `reported_post` (`id`, `post_id`, `created_by`, `reported_by`, `reason`) VALUES
(1, 3, '643747e2a6ed7', '642f922e2eb13', 'False Information'),
(2, 5, '643747e2a6ed7', '641431df83d8a', 'Hate speech');

-- --------------------------------------------------------

--
-- Table structure for table `reported_topic`
--

CREATE TABLE `reported_topic` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `created_by` varchar(45) NOT NULL,
  `reported_by` varchar(45) NOT NULL,
  `reason` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reschedule_child`
--

CREATE TABLE `reschedule_child` (
  `id` int(11) NOT NULL,
  `tracking_number` varchar(45) NOT NULL,
  `baptism_date` varchar(20) NOT NULL,
  `time_from` varchar(20) NOT NULL,
  `time_to` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reschedule_child`
--

INSERT INTO `reschedule_child` (`id`, `tracking_number`, `baptism_date`, `time_from`, `time_to`, `status`) VALUES
(2, 'TIC92547391373', '07/29/2023', '10:00 AM', '11:00 AM', 'pending'),
(4, 'TIC81183243566', '06/24/2023', '10:00 AM', '11:00 AM', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `reschedule_wedding`
--

CREATE TABLE `reschedule_wedding` (
  `id` int(11) NOT NULL,
  `tracking_number` varchar(45) NOT NULL,
  `wedding_date` varchar(45) NOT NULL,
  `time_from` varchar(20) NOT NULL,
  `time_to` varchar(20) NOT NULL,
  `rehersal_date` varchar(45) NOT NULL,
  `time_refrom` varchar(20) NOT NULL,
  `time_reto` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reschedule_wedding`
--

INSERT INTO `reschedule_wedding` (`id`, `tracking_number`, `wedding_date`, `time_from`, `time_to`, `rehersal_date`, `time_refrom`, `time_reto`, `status`) VALUES
(2, 'TIC31198996861', '06/30/2023', '01:00 PM', '04:00 PM', '06/25/2023', '10:00 AM', '12:00 PM', 'approved'),
(3, 'TIC39679514871', '06/30/2023', '01:00 PM', '04:00 PM', '06/25/2023', '10:00 AM', '12:00 PM', 'approved'),
(4, 'TIC91575155769', '06/30/2023', '01:00 PM', '04:00 PM', '06/25/2023', '10:00 AM', '12:00 PM', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `scheduling`
--

CREATE TABLE `scheduling` (
  `id` int(11) NOT NULL,
  `sched_date` varchar(45) NOT NULL,
  `time_from` varchar(45) NOT NULL,
  `time_to` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scheduling`
--

INSERT INTO `scheduling` (`id`, `sched_date`, `time_from`, `time_to`) VALUES
(12, '05/01/2023', '10:00', '12:00'),
(13, '05/01/2023', '13:00', '15:00'),
(14, '05/08/2023', '10:00', '12:00'),
(15, '05/08/2023', '13:00', '15:00'),
(16, '05/31/2023', '10:00', '12:00'),
(17, '05/31/2023', '13:00', '15:00'),
(19, '05/25/2023', '10:00', '12:00'),
(20, '05/25/2023', '13:00', '15:00'),
(21, '05/10/2023', '10:00', '12:00'),
(22, '05/10/2023', '13:00', '15:00'),
(23, '04/30/2023', '10:00', '12:00'),
(24, '04/30/2023', '13:00', '15:00'),
(25, '04/29/2023', '10:00', '12:00'),
(26, '04/29/2023', '13:00', '15:00'),
(27, '05/02/2023', '10:00', '12:00');

-- --------------------------------------------------------

--
-- Table structure for table `scheduling_baptism`
--

CREATE TABLE `scheduling_baptism` (
  `id` int(11) NOT NULL,
  `sched_date` varchar(45) NOT NULL,
  `time_from` varchar(45) NOT NULL,
  `time_to` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scheduling_baptism`
--

INSERT INTO `scheduling_baptism` (`id`, `sched_date`, `time_from`, `time_to`) VALUES
(1, '04/16/2023', '10:00', '12:00'),
(2, '04/16/2023', '10:00', '12:00'),
(3, '04/16/2023', '10:00', '12:00'),
(4, '04/16/2023', '10:00', '12:00'),
(5, '04/30/2023', '10:00', '12:00'),
(6, '04/23/2023', '10:00', '12:00'),
(7, '04/23/2023', '10:00', '12:00'),
(8, '04/23/2023', '10:00', '12:00'),
(9, '04/23/2023', '10:00', '12:00'),
(10, '04/30/2023', '10:00', '12:00');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL,
  `user_id` varchar(45) NOT NULL,
  `privacy` varchar(20) NOT NULL,
  `topic` varchar(200) NOT NULL,
  `description` varchar(300) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `user_id`, `privacy`, `topic`, `description`, `date`, `time`, `status`) VALUES
(1, '641431df83d8a', 'Anyone', 'Events', '<p><strong>Hello</strong></p>', '2023-05-10', '21:44:00', 'Active'),
(2, '642f922e2eb13', 'Music Team', 'Music Team Only', '<p>This is for music team group only</p>', '2023-05-13', '17:09:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `user_id` varchar(45) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'Member',
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `ministry` varchar(20) NOT NULL,
  `certificate_baptism` varchar(45) NOT NULL,
  `profile` varchar(45) NOT NULL DEFAULT 'default_profile.png',
  `bio` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`user_id`, `role`, `status`, `email`, `password`, `firstname`, `lastname`, `ministry`, `certificate_baptism`, `profile`, `bio`) VALUES
('641431df83d8a', 'Admin', 'Active', 'taytayimmanuelchurchportal@gmail.com', '123123123', 'Taytay Immanuel', 'Church', '', '', 'tic_logo.png', 'This is a test This is a test This is a '),
('642f922e2eb13', 'Member', 'Verified', 'zaynee27@gmail.com', '123123123', 'JohnRon', 'Buere', 'Youth', 'CERBAP-IMG642f922e2ed77.jpg', 'default_profile.png', '123123123123123'),
('64316bdc29726', 'Member', 'Verified', 'jamescruz12@gmail.com', '123456789', 'James', 'Cruz', 'Youth', 'CERBAP-IMG64316bdc29733.jpg', 'default_profile.png', 'Hello Im james'),
('64316c2156e70', 'Member', 'Verified', 'patrickrubin45@gmail.com', '123123123', 'Patrick', 'Rubin', 'Kids', 'CERBAP-IMG64316c2156e74.jpg', 'default_profile.png', ''),
('64316c693c92b', 'Member', 'Verified', 'kenhernan03@gmail.com', '123456789', 'Ken', 'Hernan', 'Music Team', 'CERBAP-IMG64316c693c92f.jpg', 'default_profile.png', ''),
('643747e2a6ed7', 'Member', 'Verified', 'kikobuere27@gmail.com', '123123123', 'Mark', 'Dumawit', 'Music Team', 'CERBAP-IMG643747e2a6ef6.jpg', 'default_profile.png', ''),
('645fd9527f3dd', 'Member', 'Verified', 'jonespaul@gmail.com', '123123123', 'Jones', 'Paul', 'Adult', 'CERBAP-IMG645fd9527f3e2.JPG', 'default_profile.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `wedding_form`
--

CREATE TABLE `wedding_form` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `service` varchar(45) NOT NULL,
  `applicant` varchar(20) NOT NULL,
  `sched_date` varchar(45) NOT NULL,
  `time_from` varchar(45) NOT NULL,
  `time_to` varchar(45) NOT NULL,
  `sched_redate` varchar(45) NOT NULL,
  `time_refrom` varchar(45) NOT NULL,
  `time_reto` varchar(45) NOT NULL,
  `bride_fname` varchar(45) NOT NULL,
  `bride_lname` varchar(45) NOT NULL,
  `bride_address` text NOT NULL,
  `bride_phone` varchar(45) NOT NULL,
  `bride_email` varchar(45) NOT NULL,
  `bride_date_of_bap` date NOT NULL,
  `bride_deno_of_ch` varchar(45) NOT NULL,
  `bride_pres_ch_mem` varchar(45) NOT NULL,
  `bride_pastor_name` varchar(45) NOT NULL,
  `bride_pastor_phone` varchar(45) NOT NULL,
  `bride_pastor_email` varchar(45) NOT NULL,
  `bride_f_name` varchar(45) NOT NULL,
  `bride_f_phone` varchar(45) NOT NULL,
  `bride_m_name` varchar(45) NOT NULL,
  `bride_m_phone` varchar(45) NOT NULL,
  `bride_parent_add` text NOT NULL,
  `groom_fname` varchar(45) NOT NULL,
  `groom_lname` varchar(45) NOT NULL,
  `groom_address` text NOT NULL,
  `groom_phone` varchar(45) NOT NULL,
  `groom_email` varchar(45) NOT NULL,
  `groom_date_of_bap` date NOT NULL,
  `groom_deno_of_ch` varchar(45) NOT NULL,
  `groom_pres_ch_mem` varchar(45) NOT NULL,
  `groom_pastor_name` varchar(45) NOT NULL,
  `groom_pastor_phone` varchar(45) NOT NULL,
  `groom_pastor_email` varchar(45) NOT NULL,
  `groom_f_name` varchar(45) NOT NULL,
  `groom_f_phone` varchar(45) NOT NULL,
  `groom_m_name` varchar(45) NOT NULL,
  `groom_m_phone` varchar(45) NOT NULL,
  `groom_parent_add` text NOT NULL,
  `pastor_perform_ser` varchar(45) NOT NULL,
  `number_guests` varchar(45) NOT NULL,
  `maid_of_honor` varchar(45) NOT NULL,
  `best_man` varchar(45) NOT NULL,
  `bridemaids` longtext NOT NULL,
  `groomen` longtext NOT NULL,
  `flower_girl` varchar(45) NOT NULL,
  `ring_bearear` varchar(45) NOT NULL,
  `ushers` longtext NOT NULL,
  `pianist` varchar(45) NOT NULL,
  `soloist` varchar(45) NOT NULL,
  `other_musicians` varchar(45) NOT NULL,
  `sound_technician` varchar(45) NOT NULL,
  `photographer` varchar(45) NOT NULL,
  `other_information` longtext NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  `archived` varchar(20) NOT NULL DEFAULT 'no',
  `m_license` varchar(100) NOT NULL,
  `m_counseling` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wedding_form`
--

INSERT INTO `wedding_form` (`id`, `user_id`, `service`, `applicant`, `sched_date`, `time_from`, `time_to`, `sched_redate`, `time_refrom`, `time_reto`, `bride_fname`, `bride_lname`, `bride_address`, `bride_phone`, `bride_email`, `bride_date_of_bap`, `bride_deno_of_ch`, `bride_pres_ch_mem`, `bride_pastor_name`, `bride_pastor_phone`, `bride_pastor_email`, `bride_f_name`, `bride_f_phone`, `bride_m_name`, `bride_m_phone`, `bride_parent_add`, `groom_fname`, `groom_lname`, `groom_address`, `groom_phone`, `groom_email`, `groom_date_of_bap`, `groom_deno_of_ch`, `groom_pres_ch_mem`, `groom_pastor_name`, `groom_pastor_phone`, `groom_pastor_email`, `groom_f_name`, `groom_f_phone`, `groom_m_name`, `groom_m_phone`, `groom_parent_add`, `pastor_perform_ser`, `number_guests`, `maid_of_honor`, `best_man`, `bridemaids`, `groomen`, `flower_girl`, `ring_bearear`, `ushers`, `pianist`, `soloist`, `other_musicians`, `sound_technician`, `photographer`, `other_information`, `status`, `archived`, `m_license`, `m_counseling`) VALUES
(1, 'TIC31198996861', 'Wedding', 'groom', '06/27/2023', '09:00', '12:00', '06/22/2023', '10:00', '12:00', 'John', 'Doe', 'Angono, Rizal', '095641234656', 'asdasd27@gmail.com', '2023-04-17', '', '', '', 'Bride Pastor Phone', 'Bride Pastor Email', 'Bride Father Name', '09564196787', 'Bride Mother Name', '09564196781', '', 'Mary Jane', 'Dela Cruz', 'Angono, Rizal', '09682480102', 'kikobuere27@gmail.com', '2023-04-17', '', '', 'Groom Pastor Name', 'Name Pastor Phone', 'Name Pastor  Email', 'Groom Father Name', '09564196785', 'Groom Mother Name', '09564196784', '', '', '', '', '', '', '', 'Flower Girl', 'RingBearer', '', 'Pianist', 'Soloist', 'Other Musicians', 'Sound Technician', 'Photographer', '', 'Completed', 'yes', '', ''),
(10, 'TIC58665394974', 'Wedding', 'groom', '07/30/2023', '13:00', '16:00', '07/25/2023', '10:00', '12:00', 'Anne', 'Abad', 'Taytay, Rizal', '095641234656', 'kikobuere27@gmail.com', '0000-00-00', '', '', '', '', '', '', '', '', '', '', 'Gin', 'Cruz', 'Taytay, Rizal', '09682480102', 'kikobuere27@gmail.com', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Completed', 'yes', '', ''),
(11, 'TIC39679514871', 'Wedding', 'groom', '06/29/2023', '13:00', '16:00', '06/24/2023', '10:00', '12:00', 'Anne', 'Abad', 'Taytay, Rizal', '095641234656', 'asdasdasdas@gmail.com', '0000-00-00', '', '', '', '', '', '', '', '', '', '', 'Gin', 'Cruz', 'Taytay, Rizal', '09682480102', 'kikobuere27@gmail.com', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Completed', 'yes', '', ''),
(14, 'TIC91575155769', 'Wedding', 'groom', '06/30/2023', '13:00', '16:00', '06/25/2023', '10:00', '12:00', 'Jennie', 'Rose', 'Taytay, Rizal', '095641234656', 'kikobuere27@gmail.com', '0000-00-00', '', '', '', '', '', '', '', '', '', '', 'Tristan', 'Cruz', 'Taytay, Rizal', '09682480102', 'kikobuere27@gmail.com', '2023-05-31', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Pending', 'no', 'MLICENSE-IMG645fccceca178.jpg', 'MCOUNSELING-IMG645fccceca328.JPG'),
(15, 'TIC39863771939', 'Wedding', 'bride', '06/29/2023', '09:00', '12:00', '06/24/2023', '13:00', '15:00', 'Lisa', 'Enares', 'Taytay, Rizal', '095641234656', 'kikobuere27@gmail.com', '0000-00-00', '', '', '', '', '', '', '', '', '', '', 'Tim', 'Johnson', 'Taytay, Rizal', '09682480102', 'kikobuere27@gmail.com', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Completed', 'yes', 'MLICENSE-IMG645fdbeb20e79.jpg', 'MCOUNSELING-IMG645fdbeb20fbb.JPG'),
(16, 'TIC75182892417', 'Wedding', 'bride', '06/30/2023', '09:00', '12:00', '06/23/2023', '13:00', '15:00', 'Jennie', 'Rose', 'Taytay Rizal', '095641234656', 'kikobuere27@gmail.com', '0000-00-00', '', '', '', '', '', '', '', '', '', '', 'Tristan', 'De Leon', 'Taytay Rizal', '09682480102', 'kikobuere27@gmail.com', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Pending', 'no', 'MLICENSE-IMG6460aebc89503.jpg', 'MCOUNSELING-IMG6460aebc8965a.JPG'),
(17, '642f922e2eb13', 'Wedding', 'groom', '11/17/2023', '09:00', '12:00', '11/06/2023', '13:00', '15:00', 'test', 'testest', 'aasdasdasd', '4545465', 'janedeleon@gmail.com', '2023-10-28', '', '', '', '', '', '', '', '', '', '', 'asdasdasd', 'asdasdsa', 'rizal', '09682480102', 'asdas27@gmail.com', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Pending', 'no', 'MLICENSE-IMG651fc0ff8a2d1.png', 'MCOUNSELING-IMG651fc0ff8a45e.png'),
(18, '642f922e2eb13', 'Wedding', 'groom', '11/17/2023', '13:00', '16:00', '11/06/2023', '10:00', '12:00', 'test1', 'testest2', 'aasdasdasdasdas213123123', '4545465', 'janedeleon@gmail.com', '2023-10-28', '', '', '', '', '', '', '', '', '', '', 'asdasdasd', 'asdasdsa', 'rizal', '09682480102', 'asdas27@gmail.com', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Pending', 'no', 'MLICENSE-IMG651fc21e6a3f9.png', 'MCOUNSELING-IMG651fc21e6a553.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ban_duration`
--
ALTER TABLE `ban_duration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `baptism_consent`
--
ALTER TABLE `baptism_consent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `baptism_form`
--
ALTER TABLE `baptism_form`
  ADD PRIMARY KEY (`form_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `forum_like`
--
ALTER TABLE `forum_like`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_notification`
--
ALTER TABLE `forum_notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `forum_report`
--
ALTER TABLE `forum_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funeral_form`
--
ALTER TABLE `funeral_form`
  ADD PRIMARY KEY (`form_id`);

--
-- Indexes for table `pastor`
--
ALTER TABLE `pastor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`reply_id`);

--
-- Indexes for table `reported_comment`
--
ALTER TABLE `reported_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reported_member`
--
ALTER TABLE `reported_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reported_post`
--
ALTER TABLE `reported_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reported_topic`
--
ALTER TABLE `reported_topic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reschedule_child`
--
ALTER TABLE `reschedule_child`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reschedule_wedding`
--
ALTER TABLE `reschedule_wedding`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scheduling`
--
ALTER TABLE `scheduling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scheduling_baptism`
--
ALTER TABLE `scheduling_baptism`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wedding_form`
--
ALTER TABLE `wedding_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ban_duration`
--
ALTER TABLE `ban_duration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `baptism_consent`
--
ALTER TABLE `baptism_consent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `forum_like`
--
ALTER TABLE `forum_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `forum_notification`
--
ALTER TABLE `forum_notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `forum_report`
--
ALTER TABLE `forum_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `funeral_form`
--
ALTER TABLE `funeral_form`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pastor`
--
ALTER TABLE `pastor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reported_comment`
--
ALTER TABLE `reported_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reported_member`
--
ALTER TABLE `reported_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reported_post`
--
ALTER TABLE `reported_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reported_topic`
--
ALTER TABLE `reported_topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reschedule_child`
--
ALTER TABLE `reschedule_child`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reschedule_wedding`
--
ALTER TABLE `reschedule_wedding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `scheduling`
--
ALTER TABLE `scheduling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `scheduling_baptism`
--
ALTER TABLE `scheduling_baptism`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wedding_form`
--
ALTER TABLE `wedding_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
