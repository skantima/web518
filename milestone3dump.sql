-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2018 at 06:24 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/ `web_prj` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `web_prj`;

--
-- Database: `web_prj`
--

-- --------------------------------------------------------

--
-- Table structure for table `archive_info`
--

CREATE TABLE `archive_info` (
  `arch_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `archive_action` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `archive_info`
--

INSERT INTO `archive_info` (`arch_id`, `group_id`, `archive_action`) VALUES
(6, 1, 'unarchive'),
(8, 2, 'unarchive'),
(9, 3, 'unarchive'),
(10, 4, 'unarchive');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `comment_Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` text NOT NULL,
  `owner_id` int(11) NOT NULL,
  `privacy` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `owner_id`, `privacy`) VALUES
(1, 'Global', 0, 'public'),
(2, 'Electronics', 1, 'private'),
(3, 'Music', 2, 'private'),
(4, 'Bingo', 6, 'public');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_content` text NOT NULL,
  `code_content` text NOT NULL,
  `image_content` text NOT NULL,
  `link_content` text NOT NULL,
  `post_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_content`, `code_content`, `image_content`, `link_content`, `post_timestamp`, `group_id`) VALUES
(140, 7, 'Is this similar to OLX?', '', '', '', '2018-10-16 03:04:26', 2),
(317, 6, 'Hello people', '', '', '', '2018-11-13 21:24:56', 4),
(393, 20, 's', '', '', '', '2018-11-18 04:21:20', 4),
(394, 20, 'asd', '', '', '', '2018-11-18 04:59:22', 4),
(451, 6, 'Third milestone is due....:(', '', '', '', '2018-11-20 05:24:42', 1),
(452, 1, 'Thanksgiving holidays.......! yaaay', '', '', '', '2018-11-20 05:25:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rating_info`
--

CREATE TABLE `rating_info` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `rating_action` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating_info`
--

INSERT INTO `rating_info` (`user_id`, `post_id`, `rating_action`) VALUES
(1, 141, 'dislike'),
(1, 146, 'like'),
(2, 141, 'dislike'),
(6, 140, 'like'),
(6, 141, 'dislike'),
(6, 196, 'dislike'),
(6, 264, 'like'),
(6, 266, 'like'),
(6, 279, 'dislike'),
(6, 280, 'dislike'),
(6, 281, 'like'),
(6, 317, 'like'),
(6, 337, 'like'),
(6, 387, 'like'),
(6, 388, 'like'),
(6, 393, 'like'),
(20, 193, 'like'),
(20, 197, 'like'),
(20, 208, 'dislike'),
(20, 210, 'like'),
(20, 211, 'like'),
(20, 249, 'like'),
(20, 267, 'like'),
(20, 377, 'dislike'),
(20, 393, 'dislike');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(30) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `user_image` text NOT NULL,
  `posts` text,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `email_id`, `password`, `user_image`, `posts`, `comments`) VALUES
(1, 'Tow Mater', 'mater@rsprings.gov', '@mater', '1.png', 'yes', 'yes'),
(2, 'Sally Carrera', 'porsche@rsprings.gov', '@sally', '', NULL, ''),
(3, 'Doc Hudson', 'hornet@rsprings.gov', '@doc', '', NULL, ''),
(4, 'Finn McMissile', 'topsecret@agent.org', '@mcmissile', '', NULL, ''),
(5, 'Lighting McQueen', 'kachow@rusteze.com', '@mcqueen', '', NULL, ''),
(6, 'Hari T', 'hari', 'hari', '6.png', 'yes', 'yes'),
(7, 'Saketh K', 'saketh', 'saketh', '', 'yes', ''),
(20, 'admin', 'admin', 'admin', '', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `ugroup_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`ugroup_id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(4, 2, 1),
(5, 2, 2),
(6, 3, 1),
(7, 3, 2),
(8, 4, 1),
(9, 4, 3),
(10, 5, 1),
(12, 6, 1),
(13, 6, 2),
(14, 1, 3),
(15, 2, 3),
(17, 7, 2),
(119, 20, 1),
(120, 6, 4),
(121, 20, 4),
(122, 20, 2),
(123, 20, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archive_info`
--
ALTER TABLE `archive_info`
  ADD PRIMARY KEY (`arch_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `group_id_2` (`group_id`);

--
-- Indexes for table `rating_info`
--
ALTER TABLE `rating_info`
  ADD UNIQUE KEY `UC_rating_info` (`user_id`,`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`ugroup_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `group_id` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archive_info`
--
ALTER TABLE `archive_info`
  MODIFY `arch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=453;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `ugroup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`);

--
-- Constraints for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD CONSTRAINT `user_groups_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `user_groups_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
