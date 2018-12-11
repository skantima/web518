-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2018 at 07:06 AM
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
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chat_content` text NOT NULL,
  `chat_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `chat_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`chat_id`, `user_id`, `chat_content`, `chat_timestamp`, `chat_user_id`) VALUES
(22, 6, 'asd', '2018-12-06 16:21:12', 16),
(23, 1, 'Hi Hari', '2018-12-06 16:48:09', 61),
(24, 6, 'Hey Mater', '2018-12-06 16:50:30', 16),
(32, 6, 'kk', '2018-12-07 01:14:23', 26),
(33, 6, 'Hi panda', '2018-12-07 04:13:24', 16);

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

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `user_id`, `comment`, `comment_Timestamp`) VALUES
(220, 455, 6, '1', '2018-11-20 21:39:10'),
(221, 455, 6, '2', '2018-11-20 21:39:12'),
(222, 469, 6, 'asd', '2018-12-05 04:24:17'),
(223, 469, 6, 's', '2018-12-05 04:26:37'),
(224, 469, 6, 'ss', '2018-12-05 04:27:02');

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
-- Table structure for table `otp_expiry`
--

CREATE TABLE `otp_expiry` (
  `otp_id` int(11) NOT NULL,
  `otp` text NOT NULL,
  `is_expired` int(11) NOT NULL,
  `create_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `file_content` text NOT NULL,
  `link_content` text NOT NULL,
  `post_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `post_content`, `code_content`, `image_content`, `file_content`, `link_content`, `post_timestamp`, `group_id`) VALUES
(140, 7, 'Is this similar to OLX?', '', '', '', '', '2018-10-16 03:04:26', 2),
(317, 6, 'Hello people', '', '', '', '', '2018-11-13 21:24:56', 4),
(393, 20, 's', '', '', '', '', '2018-11-18 04:21:20', 4),
(394, 20, 'asd', '', '', '', '', '2018-11-18 04:59:22', 4),
(451, 6, 'Third milestone is due....:(', '', '', '', '', '2018-11-20 05:24:42', 1),
(452, 1, 'Thanksgiving holidays.......! yaaay', '', '', '', '', '2018-11-20 05:25:30', 1),
(453, 6, 'a', '', '', '', '', '2018-11-20 21:22:42', 4),
(454, 6, '&lt;!DOCTYPE HTML&gt;\n&lt;html&gt;\n    &lt;head&gt;\n        &lt;title&gt;Register&lt;/title&gt;\n    &lt;/head&gt;\n    &lt;body&gt;\n        &lt;form action=&quot;register.php&quot; method=&quot;POST&quot;&gt;\n            Username: &lt;input type=&quot;text&quot; name=&quot;username&quot;&gt;\n            &lt;br/&gt;\n            Password: &lt;input type=&quot;password&quot; name=&quot;password&quot;&gt;\n            &lt;br/&gt;\n            Confirm Password: &lt;input type=&quot;password&quot; name=&quot;confirmPassword&quot;&gt;\n            &lt;br/&gt;\n            Email: &lt;input type=&quot;text&quot; name=&quot;email&quot;&gt;\n            &lt;br/&gt;\n            &lt;input type=&quot;submit&quot; name=&quot;submit&quot; value=&quot;Register&quot;&gt; or &lt;a href=&quot;login.php&quot;&gt;Log in&lt;/a&gt;\n        &lt;/form&gt;\n    &lt;/body&gt;\n&lt;/html&gt;\n&lt;?php\n    require(\'connect.php\');\n    $username = $_POST[\'username\'];\n    $password = $_POST[\'password\'];\n    $confirmPassword = $_POST[\'confirmPassword\'];\n    $email = $_POST[\'email\'];\n\n    if(isset($_POST[&quot;submit&quot;])){\n        if($query = mysql_query(&quot;INSERT INTO users (\'id\', \'username\', \'password\', \'email\') VALUES(\'\', \'&quot;.$username.&quot;\', \'&quot;.$password.&quot;\', \'&quot;.$email.&quot;\')&quot;)){\n            echo &quot;Success&quot;;\n        }else{\n            echo &quot;Failure&quot; . mysql_error();\n        }\n    }\n?&gt;', '', '', '', '', '2018-11-20 21:38:54', 1),
(455, 6, '', '&lt;!DOCTYPE HTML&gt;\n&lt;html&gt;\n    &lt;head&gt;\n        &lt;title&gt;Register&lt;/title&gt;\n    &lt;/head&gt;\n    &lt;body&gt;\n        &lt;form action=&quot;register.php&quot; method=&quot;POST&quot;&gt;\n            Username: &lt;input type=&quot;text&quot; name=&quot;username&quot;&gt;\n            &lt;br/&gt;\n            Password: &lt;input type=&quot;password&quot; name=&quot;password&quot;&gt;\n            &lt;br/&gt;\n            Confirm Password: &lt;input type=&quot;password&quot; name=&quot;confirmPassword&quot;&gt;\n            &lt;br/&gt;\n            Email: &lt;input type=&quot;text&quot; name=&quot;email&quot;&gt;\n            &lt;br/&gt;\n            &lt;input type=&quot;submit&quot; name=&quot;submit&quot; value=&quot;Register&quot;&gt; or &lt;a href=&quot;login.php&quot;&gt;Log in&lt;/a&gt;\n        &lt;/form&gt;\n    &lt;/body&gt;\n&lt;/html&gt;\n&lt;?php\n    require(\'connect.php\');\n    $username = $_POST[\'username\'];\n    $password = $_POST[\'password\'];\n    $confirmPassword = $_POST[\'confirmPassword\'];\n    $email = $_POST[\'email\'];\n\n    if(isset($_POST[&quot;submit&quot;])){\n        if($query = mysql_query(&quot;INSERT INTO users (\'id\', \'username\', \'password\', \'email\') VALUES(\'\', \'&quot;.$username.&quot;\', \'&quot;.$password.&quot;\', \'&quot;.$email.&quot;\')&quot;)){\n            echo &quot;Success&quot;;\n        }else{\n            echo &quot;Failure&quot; . mysql_error();\n        }\n    }\n?&gt;', '', '', '', '2018-11-20 21:39:01', 1),
(456, 6, 'asdasd', '', '', '', '', '2018-12-04 03:20:50', 1),
(457, 6, 'asdasd', '', '', '', '', '2018-12-04 03:21:23', 1),
(458, 6, 'asd', '', '', '', '', '2018-12-04 03:22:52', 1),
(459, 6, 'asdasdasd', '', '', '', '', '2018-12-04 03:30:39', 3),
(460, 6, 'asdasd', '', '', '', '', '2018-12-04 03:32:26', 1),
(469, 6, 'asdsss', '', '', '', '', '2018-12-05 04:24:12', 1),
(515, 6, '', 'a\n  g', '', '', '', '2018-12-11 00:18:50', 1),
(518, 6, '', '', '', 'CHECK IN.pdf', '', '2018-12-11 00:20:38', 1),
(519, 6, '', '', '', 'axis bank reference number.txt', '', '2018-12-11 00:37:37', 1);

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
  `img_num` text NOT NULL,
  `posts` text,
  `chat` text NOT NULL,
  `comments` text NOT NULL,
  `security` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `email_id`, `password`, `user_image`, `img_num`, `posts`, `chat`, `comments`, `security`) VALUES
(1, 'Tow Mater', 'mater@rsprings.gov', '@mater', '1.png', '0', 'yes', 'yes', 'yes', 0),
(2, 'Sally Carrera', 'porsche@rsprings.gov', '@sally', '', '0', NULL, '', '', 0),
(3, 'Doc Hudson', 'hornet@rsprings.gov', '@doc', 'https://www.gravatar.com/avatar/936cb3b6e701c67af2337eac72f8451d', '1', 'yes', 'yes', '', 0),
(4, 'Finn McMissile', 'topsecret@agent.org', '@mcmissile', '', '0', NULL, '', '', 0),
(5, 'Lighting McQueen', 'kachow@rusteze.com', '@mcqueen', '', '0', NULL, '', '', 0),
(6, 'Hari T', 'hari', 'hari', '', '0', 'yes', 'yes', 'yes', 0),
(7, 'Saketh K', 'saketh', 'saketh', '', '0', 'yes', '', '', 0),
(20, 'admin', 'admin', 'admin', '', '0', 'yes', '', 'yes', 0),
(22, 'hsquare', 'hariharan0907@gmail.com', 'hari', '', '0', 'NULL', '', '', 0);

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
(123, 20, 3),
(147, 22, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archive_info`
--
ALTER TABLE `archive_info`
  ADD PRIMARY KEY (`arch_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

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
-- Indexes for table `otp_expiry`
--
ALTER TABLE `otp_expiry`
  ADD PRIMARY KEY (`otp_id`);

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
  MODIFY `arch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `otp_expiry`
--
ALTER TABLE `otp_expiry`
  MODIFY `otp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=520;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `ugroup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

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
