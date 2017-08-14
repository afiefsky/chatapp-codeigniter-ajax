-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2017 at 01:14 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `topic` text,
  `user_id` int(11) DEFAULT NULL COMMENT 'created_by',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `topic`, `user_id`, `created_at`) VALUES
(1, 'Codeigniter', 1, '2017-07-27 13:18:52'),
(2, 'School', 1, '2017-08-01 05:15:05'),
(3, '1_chatroom', 1, '2017-08-02 02:40:33'),
(4, '4_chatroom', 4, '2017-08-02 02:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `chats_messages`
--

CREATE TABLE `chats_messages` (
  `id` int(11) NOT NULL,
  `chat_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text,
  `is_image` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chats_messages`
--

INSERT INTO `chats_messages` (`id`, `chat_id`, `user_id`, `content`, `is_image`, `created_at`) VALUES
(233, 3, 1, 'test', 0, '2017-08-03 08:22:03'),
(234, 3, 1, 'halo', 0, '2017-08-03 08:23:31'),
(235, 3, 1, 'wtf', 0, '2017-08-03 08:33:57'),
(236, 3, 1, 'ava4.jpg', 1, '2017-08-03 08:34:37'),
(237, 3, 1, 'test', 0, '2017-08-03 08:42:33'),
(238, 3, 1, 'test', 0, '2017-08-03 08:44:02'),
(239, 3, 1, 'ava5.jpg', 1, '2017-08-03 09:34:48'),
(240, 3, 1, 'eromanga_sensei-sagiri_izumi-anime-(17819).jpg', 1, '2017-08-03 09:45:27'),
(241, 3, 1, '5Lns4jE1.jpg', 1, '2017-08-03 09:45:39'),
(242, 3, 1, 'Kirim', 0, '2017-08-04 06:17:44'),
(243, 3, 1, 'eromanga_sensei-sagiri_izumi-anime-(17819)1.jpg', 1, '2017-08-04 06:17:53'),
(244, 3, 1, 'test', 0, '2017-08-04 06:31:30'),
(245, 3, 1, 'halo', 0, '2017-08-04 06:31:33'),
(246, 3, 1, 'om', 0, '2017-08-04 06:31:35'),
(247, 3, 4, 'hello', 0, '2017-08-04 12:14:23'),
(248, 3, 1, 'starrynight2.jpg', 1, '2017-08-05 08:08:22'),
(249, 4, 1, 'hy', 0, '2017-08-05 13:35:05'),
(250, 4, 4, 'hello', 0, '2017-08-05 13:35:21'),
(251, 4, 4, 'test', 0, '2017-08-05 13:35:33'),
(252, 3, 8, 'hay', 0, '2017-08-09 06:01:35'),
(253, 3, 8, 'wee anjing', 0, '2017-08-09 06:07:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `division` varchar(100) NOT NULL,
  `avatar` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `first_name`, `last_name`, `division`, `avatar`) VALUES
(1, 'afiefsky', 'nothing', 'afiefsky@gmail.com', 'Muhammad Afief', 'Farista', '', ''),
(4, 'tsabitkun', 'nothing', 'tsabitkun@gmail.com', 'Tsabit Abdul', 'Aziz', '', ''),
(5, 'falon', 'nothing', 'falonvoa@gmail.com', '', '', '', ''),
(6, 'havok', 'nothing', 'havok@gmail.com', 'Havok', 'Blaster', '', ''),
(7, 'agus', 'nothing', 'agus', 'Agus', 'Mulyadi', 'Staff Dosen', NULL),
(8, 'wan_gaazid', 'qwerty86', 'wanspartangaazid@gmail.com', 'wawan', 'setiawan', 'humas', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_chats`
--

CREATE TABLE `users_chats` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_chats`
--

INSERT INTO `users_chats` (`id`, `user_id`, `chat_id`, `created_at`) VALUES
(1, 1, 3, '2017-08-02 02:43:49'),
(2, 4, 4, '2017-08-02 02:43:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats_messages`
--
ALTER TABLE `chats_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_chats`
--
ALTER TABLE `users_chats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `chats_messages`
--
ALTER TABLE `chats_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users_chats`
--
ALTER TABLE `users_chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
