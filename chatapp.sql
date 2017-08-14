-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2017 at 08:36 AM
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
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `topic`, `created_at`) VALUES
(11, '15', '2017-08-13 04:33:24'),
(12, '14', '2017-08-13 04:42:42'),
(13, '54', '2017-08-14 01:21:04'),
(14, '91', '2017-08-14 01:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `chats_details`
--

CREATE TABLE `chats_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(12, 11, 1, 'halo falon', 0, '2017-08-13 04:33:32'),
(13, 11, 5, 'iya halo', 0, '2017-08-13 04:33:40'),
(14, 11, 1, 'kenapa?', 0, '2017-08-13 04:33:44'),
(15, 11, 5, 'ada apa?', 0, '2017-08-13 04:33:46'),
(16, 11, 1, 'gapapa sih', 0, '2017-08-13 04:33:49'),
(17, 11, 5, 'gimana lu aja deh', 0, '2017-08-13 04:33:52'),
(18, 11, 1, 'iya wes iya', 0, '2017-08-13 04:33:57'),
(19, 11, 5, 'yaterus mau gimana lagi?', 0, '2017-08-13 04:34:03'),
(20, 11, 5, 'halo fif', 0, '2017-08-13 04:59:39'),
(21, 12, 1, 'halo fif', 0, '2017-08-13 17:19:56'),
(22, 12, 4, 'iya halo', 0, '2017-08-13 17:28:56'),
(23, 12, 4, 'gimana?', 0, '2017-08-13 17:28:59'),
(24, 12, 4, 'test', 0, '2017-08-13 17:36:13'),
(25, 12, 4, 'hqdefault.jpg', 1, '2017-08-13 17:36:34'),
(26, 12, 1, 'ieu aing di dieu', 0, '2017-08-13 18:03:24'),
(27, 12, 4, 'iyaa', 0, '2017-08-13 18:03:29'),
(28, 12, 4, 'gimana sih', 0, '2017-08-13 18:03:31'),
(29, 12, 1, 'berisik oey', 0, '2017-08-13 18:03:42'),
(30, 12, 4, 'gandeng ai sia', 0, '2017-08-13 18:03:47'),
(31, 11, 1, 'hadir', 0, '2017-08-14 01:20:07'),
(32, 11, 1, 'halo fif', 0, '2017-08-14 01:20:14'),
(33, 11, 5, 'iyaaa', 0, '2017-08-14 01:20:58'),
(34, 12, 4, 'hayy bro', 0, '2017-08-14 01:21:00'),
(35, 13, 5, 'halo bit', 0, '2017-08-14 01:21:09'),
(36, 13, 5, '167003.jpg', 1, '2017-08-14 01:21:21'),
(37, 14, 9, 'hello', 0, '2017-08-14 01:25:16');

-- --------------------------------------------------------

--
-- Table structure for table `uri_segments`
--

CREATE TABLE `uri_segments` (
  `id` int(11) NOT NULL,
  `first` int(11) NOT NULL,
  `second` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uri_segments`
--

INSERT INTO `uri_segments` (`id`, `first`, `second`, `chat_id`, `created_at`) VALUES
(8, 1, 5, 11, '2017-08-13 04:33:24'),
(9, 1, 4, 12, '2017-08-13 04:42:42'),
(10, 5, 4, 13, '2017-08-14 01:21:04'),
(11, 9, 1, 14, '2017-08-14 01:24:51');

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
  `avatar` text,
  `is_logged_in` tinyint(1) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `first_name`, `last_name`, `division`, `avatar`, `is_logged_in`, `last_login`) VALUES
(1, 'afiefsky', 'nothing', 'afiefsky@gmail.com', 'Muhammad Afief', 'Farista', '', 'YO2jGz3.jpg', 1, '2017-08-13 17:00:00'),
(4, 'tsabitkun', 'nothing', 'tsabitkun@gmail.com', 'Tsabit Abdul', 'Aziz', '', 'logo.png', 0, '2017-08-14 01:22:09'),
(5, 'falon', 'nothing', 'falonvoa@gmail.com', 'Falon', 'Trecks', '', '167003.jpg', 1, '2017-08-13 17:00:00'),
(6, 'havok', 'nothing', 'havok@gmail.com', 'Havok', 'Blaster', '', '', 0, '2017-08-13 04:47:02'),
(7, 'agus', 'nothing', 'agus', 'Agus', 'Mulyadi', 'Staff Dosen', NULL, 0, '2017-08-13 04:47:02'),
(8, 'wan_gaazid', 'qwerty86', 'wanspartangaazid@gmail.com', 'wawan', 'setiawan', 'humas', NULL, 0, '2017-08-13 04:47:02'),
(9, 'setiawan', 'qwerty12345', 'setiawan@gmail.com', 'wawan', 'Setiawan', 'humas publikasi', 'IMG_20160109_120132_1_1.jpg', 0, '2017-08-14 01:32:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats_details`
--
ALTER TABLE `chats_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats_messages`
--
ALTER TABLE `chats_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uri_segments`
--
ALTER TABLE `uri_segments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `chats_details`
--
ALTER TABLE `chats_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `chats_messages`
--
ALTER TABLE `chats_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `uri_segments`
--
ALTER TABLE `uri_segments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
