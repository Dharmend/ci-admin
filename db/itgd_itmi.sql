-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2018 at 08:02 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itgd_itmi`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faqs`
--

CREATE TABLE `tbl_faqs` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` tinytext NOT NULL,
  `published` tinyint(1) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `createdby` int(4) NOT NULL,
  `updatedby` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_faqs`
--

INSERT INTO `tbl_faqs` (`id`, `question`, `answer`, `published`, `created_datetime`, `updated_datetime`, `createdby`, `updatedby`) VALUES
(2, 'hello ITMI 2', '<p>sdsfsda fda d fdsa dasfas thsdfsadf dasf df dsafsaf s af</p>', 1, '2018-11-05 00:00:00', '2018-11-05 14:30:02', 1, 1),
(3, 'this is 3rd one', '<p>hellsssfs</p>', 1, '2018-11-05 14:42:45', '2018-11-05 14:42:52', 1, 1),
(4, 'question 4', '<p>question 4</p>', 1, '2018-11-05 14:43:40', '0000-00-00 00:00:00', 1, 0),
(5, 'question 5', '<p>question 5</p>', 1, '2018-11-05 14:43:48', '0000-00-00 00:00:00', 1, 0),
(6, 'question 6', '<p>question 6</p>', 1, '2018-11-05 14:43:57', '0000-00-00 00:00:00', 1, 0),
(7, 'question 7', '<p>question 7</p>', 1, '2018-11-05 14:44:04', '0000-00-00 00:00:00', 1, 0),
(8, 'question 8', '<p>question 8</p>', 1, '2018-11-05 14:44:11', '0000-00-00 00:00:00', 1, 0),
(9, 'question 9', '<p>question 9</p>', 1, '2018-11-05 14:44:58', '2018-11-05 14:44:58', 1, 0),
(10, 'question 10', '<p>question 10</p>', 0, '2018-11-05 14:45:08', '2018-11-05 14:45:08', 1, 0),
(11, 'question 11', '<p>question 11</p>', 1, '2018-11-05 14:45:20', '2018-11-05 14:45:20', 1, 0),
(12, 'question 12', '<p>question 12</p>', 0, '2018-11-05 14:45:29', '2018-11-05 14:45:29', 1, 0),
(13, 'question 13', '<p>question 13</p>', 1, '2018-11-05 14:45:47', '2018-11-05 14:49:21', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_homepage_accordion`
--

CREATE TABLE `tbl_homepage_accordion` (
  `id` int(5) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `image_order` int(2) NOT NULL,
  `createdby` tinyint(3) NOT NULL,
  `updatedby` tinyint(3) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_homepage_accordion`
--

INSERT INTO `tbl_homepage_accordion` (`id`, `image_path`, `image_order`, `createdby`, `updatedby`, `created_datetime`, `updated_datetime`, `published`) VALUES
(1, 'http://itmi-admin.aajtak.in/assets/uploads/hp_slider/1-bj-page1.jpg', 1, 1, 0, '2018-11-12 08:13:30', '2018-11-12 08:13:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_last_login`
--

CREATE TABLE `tbl_last_login` (
  `id` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `sessionData` varchar(2048) NOT NULL,
  `machineIp` varchar(1024) NOT NULL,
  `userAgent` varchar(128) NOT NULL,
  `agentString` varchar(1024) NOT NULL,
  `platform` varchar(128) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_last_login`
--

INSERT INTO `tbl_last_login` (`id`, `userId`, `sessionData`, `machineIp`, `userAgent`, `agentString`, `platform`, `createdDtm`) VALUES
(1, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 65.0.3325.181', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Windows 10', '2018-04-11 19:36:04'),
(2, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 65.0.3325.181', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Windows 10', '2018-04-12 12:23:30'),
(3, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 65.0.3325.181', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Windows 10', '2018-04-12 15:50:32'),
(4, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 65.0.3325.181', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Windows 10', '2018-04-13 13:31:31'),
(5, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 65.0.3325.181', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Windows 10', '2018-04-16 12:16:03'),
(6, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 65.0.3325.181', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Windows 10', '2018-04-18 19:04:12'),
(7, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 65.0.3325.181', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Windows 10', '2018-04-19 12:22:16'),
(8, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 65.0.3325.181', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Windows 10', '2018-04-23 11:15:08'),
(9, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 65.0.3325.181', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Windows 10', '2018-04-23 15:01:57'),
(10, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 65.0.3325.181', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Windows 10', '2018-04-23 19:02:34'),
(11, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 65.0.3325.181', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Windows 10', '2018-04-24 12:59:21'),
(12, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 65.0.3325.181', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Windows 10', '2018-04-25 11:41:13'),
(13, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 65.0.3325.181', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Windows 10', '2018-04-26 14:43:52'),
(14, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 65.0.3325.181', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36', 'Windows 10', '2018-04-27 16:31:20'),
(15, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 67.0.3396.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'Windows 10', '2018-07-26 19:05:26'),
(16, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 67.0.3396.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'Windows 10', '2018-07-26 19:06:02'),
(17, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 67.0.3396.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'Windows 10', '2018-07-27 15:22:47'),
(18, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 67.0.3396.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'Windows 10', '2018-07-30 13:33:48'),
(19, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 67.0.3396.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'Windows 10', '2018-07-31 11:06:34'),
(20, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 67.0.3396.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'Windows 10', '2018-08-01 11:07:25'),
(21, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 67.0.3396.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'Windows 10', '2018-08-01 15:17:55'),
(22, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 67.0.3396.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'Windows 10', '2018-08-01 17:51:43'),
(23, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 67.0.3396.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'Windows 10', '2018-08-02 11:50:38'),
(24, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 67.0.3396.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'Windows 10', '2018-08-02 16:13:52'),
(25, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 67.0.3396.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'Windows 10', '2018-08-04 11:55:53'),
(26, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 67.0.3396.99', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'Windows 10', '2018-08-04 16:10:41'),
(27, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 68.0.3440.84', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.84 Safari/537.36', 'Windows 10', '2018-08-07 17:48:54'),
(28, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 68.0.3440.84', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.84 Safari/537.36', 'Windows 10', '2018-08-07 18:26:56'),
(29, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 68.0.3440.106', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36', 'Windows 10', '2018-08-13 18:26:17'),
(30, 1, '{\"role\":\"1\",\"siteId\":\"0\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Windows 10', '2018-10-26 12:46:16'),
(31, 1, '{\"role\":\"1\",\"siteId\":\"0\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Windows 10', '2018-10-29 13:32:36'),
(32, 1, '{\"role\":\"1\",\"siteId\":\"0\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Windows 10', '2018-11-05 16:01:02'),
(33, 1, '{\"role\":\"1\",\"siteId\":\"0\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Windows 10', '2018-11-05 23:34:32'),
(34, 1, '{\"role\":\"1\",\"siteId\":\"0\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Windows 10', '2018-11-06 11:31:35'),
(35, 1, '{\"role\":\"1\",\"siteId\":\"0\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Windows 10', '2018-11-06 13:02:50'),
(36, 3, '{\"role\":\"3\",\"siteId\":\"0\",\"roleText\":\"Guest\",\"name\":\"Employee\"}', '127.0.0.1', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Windows 10', '2018-11-06 13:12:17'),
(37, 3, '{\"role\":\"3\",\"siteId\":\"0\",\"roleText\":\"Guest\",\"name\":\"Employee\"}', '127.0.0.1', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Windows 10', '2018-11-06 15:24:28'),
(38, 1, '{\"role\":\"1\",\"siteId\":\"0\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Windows 10', '2018-11-06 15:47:43'),
(39, 1, '{\"role\":\"1\",\"siteId\":\"0\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Windows 10', '2018-11-09 10:07:04'),
(40, 1, '{\"role\":\"1\",\"siteId\":\"0\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Windows 10', '2018-11-12 11:42:08'),
(41, 1, '{\"role\":\"1\",\"siteId\":\"0\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Windows 10', '2018-11-12 17:50:51'),
(42, 1, '{\"role\":\"1\",\"siteId\":\"0\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Windows 10', '2018-11-13 10:47:48'),
(43, 1, '{\"role\":\"1\",\"siteId\":\"0\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 70.0.3538.77', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 'Windows 10', '2018-11-13 13:38:07'),
(44, 1, '{\"role\":\"1\",\"siteId\":\"0\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 70.0.3538.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', 'Windows 10', '2018-11-16 16:27:24'),
(45, 1, '{\"role\":\"1\",\"siteId\":\"0\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 70.0.3538.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', 'Windows 10', '2018-11-16 16:29:42'),
(46, 1, '{\"role\":\"1\",\"siteId\":\"0\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '127.0.0.1', 'Chrome 70.0.3538.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', 'Windows 10', '2018-11-19 12:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profile`
--

CREATE TABLE `tbl_profile` (
  `id` int(11) NOT NULL,
  `profile_category` int(2) NOT NULL,
  `profile_name` varchar(100) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `profile_title` varchar(255) NOT NULL,
  `profile_short_description` tinytext NOT NULL,
  `profile_long_description` longtext NOT NULL,
  `associated_programmes` tinytext NOT NULL,
  `published` tinyint(1) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `createdby` int(4) NOT NULL,
  `updatedby` int(4) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` tinytext NOT NULL,
  `meta_description` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_profile`
--

INSERT INTO `tbl_profile` (`id`, `profile_category`, `profile_name`, `profile_image`, `profile_title`, `profile_short_description`, `profile_long_description`, `associated_programmes`, `published`, `created_datetime`, `updated_datetime`, `createdby`, `updatedby`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
(1, 2, 'rahul kanwal', 'http://itmi-admin.aajtak.in/assets/uploads/profile/1-bj-page6.jpg', 'Managing Editor, TV today', 'sdafdsfsd f sdfsd', '<p>sdf sdf sdf sdf dsf s</p>', '', 1, '0000-00-00 00:00:00', '2018-11-12 13:49:57', 1, 1, 'dsddfds', 'fsdfdsa fsd', 'sdfsdf as'),
(2, 2, 'Test', 'http://itmi-admin.aajtak.in/assets/uploads/profile/dummy_user.png', 'Manageing Director', 'this is for testing purpose', '<p>this is for testing purpose</p>', '', 1, '2018-11-09 05:39:02', '2018-11-12 13:49:19', 1, 1, 'test', 'test', 'test'),
(3, 2, 'sfdsf 1', 'http://itmi-admin.aajtak.in/assets/uploads/profile/1-Mem-page.jpg', 'asdfadsf', 'sdfdsaf', '<p>asdfasdf</p>', '', 1, '2018-11-12 13:53:46', '2018-11-12 14:05:57', 1, 1, 'asdf', 'asdf', 'asdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profile_category`
--

CREATE TABLE `tbl_profile_category` (
  `id` int(5) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `createdby` tinyint(3) NOT NULL,
  `updatedby` tinyint(3) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` tinytext NOT NULL,
  `meta_description` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_profile_category`
--

INSERT INTO `tbl_profile_category` (`id`, `cat_name`, `published`, `created_datetime`, `updated_datetime`, `createdby`, `updatedby`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
(2, 'Core Faculty - ITMI', 1, '2018-11-12 13:36:55', '2018-11-12 13:36:55', 1, 0, 'Core Faculty', 'Core Faculty', 'Core Faculty');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_programme_category`
--

CREATE TABLE `tbl_programme_category` (
  `id` int(5) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `createdby` tinyint(3) NOT NULL,
  `updatedby` tinyint(3) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` tinytext NOT NULL,
  `meta_description` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_programme_category`
--

INSERT INTO `tbl_programme_category` (`id`, `cat_name`, `published`, `created_datetime`, `updated_datetime`, `createdby`, `updatedby`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
(1, 'One Year', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '', '', ''),
(2, '2 Years', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_programme_details`
--

CREATE TABLE `tbl_programme_details` (
  `id` int(11) NOT NULL,
  `programme_id` int(11) NOT NULL,
  `block_name` varchar(255) NOT NULL,
  `block_description` text NOT NULL,
  `block_order` int(3) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `is_career_block` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_programme_details`
--

INSERT INTO `tbl_programme_details` (`id`, `programme_id`, `block_name`, `block_description`, `block_order`, `published`, `is_career_block`) VALUES
(6, 2, 'Structure', '<p>This is a one-year programme, including six months on-campus and six months of internship in the TV Today Network system&#39;s various channels and departments. The internship is uniquely structured to include training in the most important functions of a news channel. Our trainees are then seriously considered for final employment in the TV Today Network.</p>\r\n', 1, 1, 0),
(7, 2, 'Academic Approach', '<p>As our flagship programme, the one-year diploma prepares you to ‘hit the ground running’ in your career. You will learn what it takes to be a journalist, and then roll up your sleeves and get down to actually practising what you learn in the classrooms, labs, studios, library and outdoors. When you graduate from the programme, you should hope to join one of the hundreds of news channels in the country. As news on FM radio becomes a reality, you should also be aware of the immense opportunities there.</p>\r\n', 2, 1, 0),
(8, 2, 'Academic Input', '<p>This is a practical-heavy programme—less than half your programme will be in classrooms; your tenure will be largely entail hands-on learning in simulated settings on campus, field work, and an internship in our sophisticated studios. A final project is required.</p>\r\n', 3, 1, 0),
(9, 2, 'Curricular Input', '<p>Introduction to Journalism & News</p>\r\n\r\n<p>News Writing & Scripting</p>\r\n\r\n<p>News Production</p>\r\n\r\n<p>Editing</p>\r\n\r\n<p>Camera</p>\r\n\r\n<p>Newsgathering & Reporting</p>\r\n\r\n<ul>\r\n <li>Business Journalism</li>\r\n <li>Sports Journalism</li>\r\n <li>Political Journalism</li>\r\n <li>Investigative Journalism</li>\r\n <li>Crime Reporting</li>\r\n <li>Entertainment & Lifestyle Reporting</li>\r\n</ul>\r\n\r\n<p>Documentaries & Features</p>\r\n\r\n<p>Radio Broadcasting</p>\r\n\r\n<p>Judicial System & Constitution</p>\r\n\r\n<p>Media Laws & Ethics</p>\r\n', 4, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_programme_info`
--

CREATE TABLE `tbl_programme_info` (
  `id` int(11) NOT NULL,
  `programme_category` tinyint(3) NOT NULL,
  `title` varchar(255) NOT NULL,
  `structure_info` text NOT NULL,
  `faculty` varchar(155) NOT NULL,
  `career_opportunity` text NOT NULL,
  `youtube_video` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `createdby` int(4) NOT NULL,
  `updatedby` int(4) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` tinytext NOT NULL,
  `meta_description` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_programme_info`
--

INSERT INTO `tbl_programme_info` (`id`, `programme_category`, `title`, `structure_info`, `faculty`, `career_opportunity`, `youtube_video`, `published`, `created_datetime`, `updated_datetime`, `createdby`, `updatedby`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
(2, 1, 'Time Postgraduate Diploma in Broadcast Journalism', '<p>sfsfdsfsdaf</p>', '3', '<p>sadfadsfasdf</p>\r\n', 'dsfdfdsfsdf', 1, '2018-11-09 11:32:49', '2018-11-12 15:42:30', 1, 1, 'One year Postgraduate diploma in Broadcast Journalism', 'get jobs in Anchoring, job in production ,job in reporting ,job in Camera and Editing, One year Postgraduate diploma in Broadcast Journalism', 'We provide one year post graduate diploma in Broadcast Journalism , it is one of the best journalism course in India. It include 6 month internship with aaj tak. A great platform to get jobs in Anchoring , production , reporting , Camera and Editing.'),
(3, 1, 'dsfdsfdsf', '<p>sdfsdafadsfsdafdasd</p>\r\n\r\n<p> </p>\r\n\r\n<p>asdfdadsfasd</p>\r\n\r\n<p>fsadf</p>\r\n\r\n<p>dasfasdf</p>', '1,3', '<p>asdfdadsfsdafasdf</p>\r\n\r\n<p>sdaf</p>\r\n\r\n<p>sda</p>\r\n\r\n<p>fdsaf</p>\r\n', 'youtube..', 1, '2018-11-12 15:26:34', '2018-11-12 15:42:11', 1, 1, 'adsdfdasf', 'asdfdasf', 'asdfsasdfas');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reset_password`
--

CREATE TABLE `tbl_reset_password` (
  `id` bigint(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activation_id` varchar(32) NOT NULL,
  `agent` varchar(512) NOT NULL,
  `client_ip` varchar(32) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` bigint(20) NOT NULL DEFAULT '1',
  `createdDtm` datetime NOT NULL,
  `updatedBy` bigint(20) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`) VALUES
(1, 'System Administrator'),
(2, 'Manager'),
(3, 'Guest');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staticpages`
--

CREATE TABLE `tbl_staticpages` (
  `id` int(11) NOT NULL,
  `page_type` tinyint(3) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `body_content` longtext NOT NULL,
  `published` tinyint(1) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `createdby` int(4) NOT NULL,
  `updatedby` int(4) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` tinytext NOT NULL,
  `meta_description` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_staticpages`
--

INSERT INTO `tbl_staticpages` (`id`, `page_type`, `page_title`, `body_content`, `published`, `created_datetime`, `updated_datetime`, `createdby`, `updatedby`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
(4, 2, 'Admission Procedure', '<ul>\r\n <li>Please note that ITMI does not guarantee placements: being hired is a reflection of how well you develop your abilities here. However, we make every possible effort to place you well and gainfully in the communication industries. The scope for recruitment includes our own publications and channels.<br>\r\n <br>\r\n Each year, we will form a Placement Committee under the Dean&#39;s Chairmanship. This body will seek out opportunities in the industries and endeavour to provide platforms for recruitment, both on- and off-campus. We have been developing formal and informal associations with organizations that will consider ITMI trainees for hiring.</li>\r\n</ul>', 1, '2018-11-13 13:27:56', '2018-11-13 13:27:56', 1, 0, 'ssdfdsfs', 'sdfddsfsd', 'sdfdsdfsd');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_testimonials`
--

CREATE TABLE `tbl_testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `video_url` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `createdby` int(4) NOT NULL,
  `updatedby` int(4) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` tinytext NOT NULL,
  `meta_description` tinytext NOT NULL,
  `intro` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_testimonials`
--

INSERT INTO `tbl_testimonials` (`id`, `name`, `image_path`, `video_url`, `published`, `created_datetime`, `updated_datetime`, `createdby`, `updatedby`, `meta_title`, `meta_keywords`, `meta_description`, `intro`) VALUES
(2, 'sdfsdfa', 'http://itmi-admin.aajtak.in/assets/uploads/testimonials/1-bj-page2.jpg', 'asdfadsfasd', 1, '2018-11-13 11:04:43', '2018-11-13 11:04:47', 1, 1, 'asddfasdf', 'asddfasdf', 'asddfddasf', 'asdfadsfa');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `email` varchar(128) NOT NULL COMMENT 'login email',
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `mobile` varchar(20) DEFAULT NULL,
  `siteId` int(11) NOT NULL,
  `roleId` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `email`, `password`, `name`, `mobile`, `siteId`, `roleId`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'admin@admin.com', '$2y$10$0PGAh3U8/iqO5CfJllRtVeJjqFVQ6o4f9C6BebsCfNQ6tOuA1pHxa', 'System Administrator', '1', 0, 1, 0, 0, '2015-07-01 18:56:49', 1, '2018-07-26 15:35:51'),
(2, 'manager@example.com', '$2y$10$quODe6vkNma30rcxbAHbYuKYAZQqUaflBgc4YpV9/90ywd.5Koklm', 'Manager', '9898989898', 0, 2, 0, 1, '2016-12-09 17:49:56', 1, '2018-11-19 07:58:42'),
(3, 'employee@example.com', '$2y$10$0PGAh3U8/iqO5CfJllRtVeJjqFVQ6o4f9C6BebsCfNQ6tOuA1pHxa', 'Employee', '11111', 0, 3, 0, 1, '2016-12-09 17:50:22', 3, '2018-01-04 07:58:28'),
(9, 'sczx@kasd.com', '$2y$10$1tSQdLCgdSm5sorbgQwFf.2hHqGPHa0qHMO8ybGOf9X60Ak3rfAXi', 'Zc', '11111', 0, 3, 0, 1, '2018-04-11 16:29:11', NULL, NULL),
(10, 'asd@hgasd.com', '$2y$10$2/5MLJl4ZxqPbrVvsFq0yeeMfufkRGKGBu0fQZfa.ECZgHmTP8nbi', 'Asdasd', '11111', 1, 2, 0, 1, '2018-04-11 16:31:37', 1, '2018-04-11 16:39:20'),
(11, 'parmendra.kumar@gmail.com', '$2y$10$u6VxxYJIg2mI9Y4KHrp6luI1UCqxruXMmgR1a5bCuuZfEL.xogasy', 'Dsfdsf', '9898989898', 0, 3, 1, 1, '2018-11-19 08:01:19', 1, '2018-11-19 08:01:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `tbl_faqs`
--
ALTER TABLE `tbl_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_homepage_accordion`
--
ALTER TABLE `tbl_homepage_accordion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_profile`
--
ALTER TABLE `tbl_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_profile_category`
--
ALTER TABLE `tbl_profile_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_programme_category`
--
ALTER TABLE `tbl_programme_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_programme_details`
--
ALTER TABLE `tbl_programme_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_programme_info`
--
ALTER TABLE `tbl_programme_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `tbl_staticpages`
--
ALTER TABLE `tbl_staticpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_testimonials`
--
ALTER TABLE `tbl_testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_faqs`
--
ALTER TABLE `tbl_faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_homepage_accordion`
--
ALTER TABLE `tbl_homepage_accordion`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_profile`
--
ALTER TABLE `tbl_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_profile_category`
--
ALTER TABLE `tbl_profile_category`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_programme_category`
--
ALTER TABLE `tbl_programme_category`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_programme_details`
--
ALTER TABLE `tbl_programme_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_programme_info`
--
ALTER TABLE `tbl_programme_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_reset_password`
--
ALTER TABLE `tbl_reset_password`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_staticpages`
--
ALTER TABLE `tbl_staticpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_testimonials`
--
ALTER TABLE `tbl_testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
