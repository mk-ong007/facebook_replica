-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 26, 2021 at 10:58 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meet_my_friend`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `created_at`) VALUES
(1, 'test@gmail.com', '$2y$10$4zwTx2LvWirsJ1Kow8MF2O1Z8LAtI6Dy7aNYA82liOA.tsnoybuPa', '2021-05-31 12:04:29');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `created_at`) VALUES
(1, 1, 2, 'hello, this my first message', 1623395592),
(2, 1, 2, 'hello, this my second message', 1623396065),
(3, 1, 2, 'hello, this my third message', 1623396176),
(4, 1, 3, 'Hii', 1623396269),
(5, 3, 1, 'Hello, Manish How are you..?', 1623398680),
(6, 3, 1, 'it is checking purpose...', 1623398773),
(7, 3, 1, 'it\'s final checking..', 1623398867),
(8, 3, 1, 'final', 1623398959),
(9, 1, 3, 'ok', 1623416581),
(10, 3, 1, 'its not working...', 1623416807),
(11, 1, 3, 'is it working right now...', 1623422148),
(12, 3, 1, 'are you sure.', 1623422269),
(13, 1, 3, 'yess', 1623422317),
(14, 1, 3, 'hii', 1623834237),
(15, 1, 3, 'hii', 1623835323),
(16, 1, 3, 'hii', 1623933896),
(17, 1, 3, 'hii', 1623935127),
(18, 1, 3, 'hello', 1623935130),
(19, 1, 3, 'i am manish.', 1623935144),
(20, 3, 1, 'hii', 1623936779),
(21, 3, 1, 'hello', 1623936787),
(22, 3, 1, 'hello1', 1623937456),
(23, 3, 1, '123', 1623937891),
(24, 3, 1, '12', 1623937958),
(25, 3, 1, 'hii', 1623938293),
(26, 3, 1, 'hello', 1623938298),
(27, 3, 1, 'hii', 1623938311),
(28, 3, 1, '11111111', 1623938344),
(29, 3, 1, '111', 1623938417),
(30, 3, 1, '111', 1623938419),
(31, 3, 1, '111', 1623938419),
(32, 3, 1, '111', 1623938420),
(33, 3, 1, '11111', 1623938425),
(34, 3, 1, '1111', 1623938427),
(35, 3, 1, '1111', 1623938430),
(36, 3, 1, 'hii', 1623938795),
(37, 3, 1, 'hii', 1623938880),
(38, 3, 1, 'hello', 1623939140),
(39, 3, 1, 'hllo', 1623939222),
(40, 3, 1, 'hee', 1623939291),
(41, 3, 1, '1111', 1623939309),
(42, 3, 7, 'hii', 1623941562),
(43, 3, 0, 'hiii', 1623941884),
(44, 3, 2, 'hii', 1623941935),
(45, 3, 2, 'hii', 1623942167),
(46, 3, 2, 'hello', 1623942176),
(47, 2, 1, 'hiiii.....', 1623942392),
(48, 2, 1, 'helloo', 1623942405),
(49, 1, 3, 'helloo', 1624011877),
(50, 7, 2, 'hi', 1624012037),
(51, 7, 2, 'hello', 1624012075),
(52, 7, 2, '111', 1624012155),
(53, 7, 2, '111', 1624012160),
(54, 1, 3, 'hyy', 1624015244),
(55, 1, 7, 'hii', 1624029545),
(56, 1, 7, 'hello', 1624029570),
(57, 1, 7, 'hi', 1624440700);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `writer_id` int(11) NOT NULL,
  `writer_name` varchar(200) NOT NULL,
  `writer_dp` text NOT NULL,
  `post_content` text NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `likes` int(11) NOT NULL DEFAULT 0,
  `liker_id` text DEFAULT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `writer_id`, `writer_name`, `writer_dp`, `post_content`, `views`, `likes`, `liker_id`, `created_at`) VALUES
(1, 1, 'Manish Dholpuriya', 'a6707d9e859d3c018316eb7fbf266a79.png', 'Hello, This is my first post.', 0, 2, '8,7', 1623080754),
(2, 7, 'Garima Sharma', '3da862c0a00c4c6484903921a7d65cf2.png', 'Hello, This is my first post.', 0, 1, '7', 1623080803),
(3, 1, 'Manish Dholpuriya', 'a6707d9e859d3c018316eb7fbf266a79.png', 'Helloooooooooooooo', 0, 0, '', 1623141467),
(5, 1, 'Manish Dholpuriya', 'a6707d9e859d3c018316eb7fbf266a79.png', '<img class=\'Medium img-fluid img-thumbnail\'  src=https://meetmyfriend.oppcodevision.com/src/uploads/postPics/57f84859cdd30b928b4efd6b82cd2915.jpeg>', 0, 1, '1', 1623225833),
(6, 1, 'Manish Dholpuriya', 'a6707d9e859d3c018316eb7fbf266a79.png', 'Hello, This is my first post with an image<br><img class=\'img-fluid img-thumbnail\'  src=/src/uploads/postPics/cf044abfa75002250ccb31b6c89dccd4.png>', 0, 1, '7', 1623225929),
(10, 1, 'Manish Dholpuriya', 'a6707d9e859d3c018316eb7fbf266a79.png', '<img class=\'img-fluid img-thumbnail\'  src=/src/uploads/postPics/b007ead57a3265bcca57a5a0b1895042.gif>', 0, 0, '', 1623226301),
(12, 1, 'Manish Dholpuriya', 'a6707d9e859d3c018316eb7fbf266a79.png', '123', 0, 0, '', 1624440812);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `profile_pic` text DEFAULT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` text NOT NULL DEFAULT '\'no email\'',
  `mobile_number` text NOT NULL DEFAULT '\'no mobile no\'',
  `password` text NOT NULL,
  `dob` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `friends_id` text DEFAULT NULL,
  `friend_request_id` text DEFAULT NULL,
  `friend_request_send_id` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile_pic`, `first_name`, `last_name`, `email`, `mobile_number`, `password`, `dob`, `gender`, `friends_id`, `friend_request_id`, `friend_request_send_id`, `status`, `created_at`) VALUES
(1, 'a6707d9e859d3c018316eb7fbf266a79.png', 'Manish', 'Dholpuriya', 'manish@gmail.com', '', '$2y$10$iL7e6wW8wITYPkRNPTPtxe8VacP.qRjJ7EP1VbZFwsBG1.GlGrj32', '2000-05-13', 'Male', '4,7', '', '2', 1, 1622794418),
(2, NULL, 'mk', 'mk', '', '8976543222', '$2y$10$dPFjLfyak4VRDybECyW2FuiI00C1h9PVSDvvaKsQjQETpGJKUyrNK', '2021-05-30', 'Female', '3', '1', '4', 0, 1632793518),
(3, 'de11a4e08f8cb9498816c2ef0860a2d1.png', 'test', 'test', 'test@gmail.com', '', '$2y$10$t6A9EGfgRI14qwwd0vW75OkLnSUXON/DOPGUvQdwr8.xbk/rK8PIC', '2021-05-03', 'Male', '2', '', '4', 0, 1627794518),
(4, NULL, 'hello', 'world', '', '9876543211', '$2y$10$T.B7gND//fZiECvcAibg8uihHqaSqOkzfCVk4T0OPSeFRwiLv/44e', '2021-05-29', 'Male', '1', '2,3', NULL, 1, 1622794618),
(5, '1cef91ded56a8c9d7f78024050820894.png', 'test1', 'test1', 'test1@gmail.com', '', '$2y$10$LmxZTyslFcBanWrp09Q4J.CgPd0P6SFzSR7v4icmGIdFpgbdSiUOq', '2021-05-12', 'Female', NULL, '', NULL, 0, 1620794516),
(6, '0c3727685c0ed70e266f6fbedd11c668.jpg', 'Kartik', 'Dholpuriya', 'kd@gmail.com', '', '$2y$10$deRV4CSdJei845v.OiG1N.Wkd1kmDiahDmhN/HEl2J0uIfB9HCqHK', '2021-05-23', 'Male', NULL, '', NULL, 0, 1621794510),
(7, '3da862c0a00c4c6484903921a7d65cf2.png', 'Garima', 'Sharma', 'gs@gmail.com', '', '$2y$10$MVNdnr3afYUcZBL7Obo2P.qbFLwpKQMfrsXExFMpPAdL.m8UANN3K', '2021-05-05', 'Female', '1', '', '', 0, 1612494518),
(8, NULL, 'Sapna', 'Kanwar', 'sk@gmail.com', '1111111111', '$2y$10$sd34WTLXVk5sBdiVbEOrd.oMY2tPhG5hbdz3DmDRyk9QE26/PDU5y', '1995-02-05', 'Female', '', '', '', 1, 1622794018);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
