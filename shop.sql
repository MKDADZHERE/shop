-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 14, 2023 at 05:34 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ordering` int(11) DEFAULT NULL,
  `visibility` tinyint(4) NOT NULL DEFAULT '0',
  `allow_comment` tinyint(4) NOT NULL DEFAULT '0',
  `allow_ads` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `ordering`, `visibility`, `allow_comment`, `allow_ads`) VALUES
(9, 'Hand Made ', 'hand made items ', 0, 0, 0, 0),
(10, 'computer', 'computer ', 0, 0, 0, 0),
(11, 'cell phones', 'cell phones', 0, 0, 0, 0),
(12, 'clothing', 'clothing', 0, 0, 0, 0),
(14, '14', 'tools', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `c_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `stats` tinyint(4) NOT NULL,
  `date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `price` varchar(255) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `add_date` date NOT NULL,
  `made` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pho` varchar(255) NOT NULL,
  `stats` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `rating` smallint(6) NOT NULL,
  `approve` tinyint(4) NOT NULL DEFAULT '0',
  `cart_id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `name`, `description`, `price`, `add_date`, `made`, `pho`, `stats`, `rating`, `approve`, `cart_id`, `mem_id`) VALUES
(9, 'one', 'one', 'one', '2022-08-07', 'one', '', '1', 0, 1, 10, 1),
(10, '13 nine', '13 nine', '13 nine', '2022-08-07', '13 nine', '', '1', 0, 1, 11, 1),
(11, '13 pro ', 'pro', '$1200', '2022-08-07', 'india', '', '1', 0, 1, 10, 1),
(12, '13 pro max', 'pro mac', '$1500', '2022-08-07', 'sy', '', '1', 0, 1, 10, 1),
(13, '14 iphone', 'full', '$2000', '2022-08-07', 'india', '', '1', 0, 1, 10, 1),
(15, 'pial', 'pial', 'pial', '2023-02-14', 'pial', '', '3', 0, 1, 9, 39);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Fullname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT '0',
  `trs` int(11) NOT NULL DEFAULT '0',
  `reg` int(11) NOT NULL DEFAULT '0',
  `Date` date NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `Fullname`, `GroupID`, `trs`, `reg`, `Date`, `avatar`) VALUES
(1, 'mkdad', '601f1889667efaebb33b8c12572835da3f027f78', 'm@m', 'm', 1, 0, 0, '0000-00-00', ''),
(20, 'mkjiu', '', 's@s', 'm', 0, 0, 1, '0000-00-00', ''),
(21, 'reem ', '1efcfaab69361232b5e5e39265464be84f6e484f', 'mmm@m', 'm', 0, 0, 1, '2022-07-30', ''),
(28, 'alifffffffffff', '', 'ali@ali', 'ali', 0, 0, 1, '0000-00-00', ''),
(29, ',,,,', '5e64242584177632e82b74bce395a59987309e9d', 'llll@Lll', '111', 0, 0, 1, '2022-08-02', ''),
(31, 'ddddd', '3c363836cf4e16666669a25da280a1865c2d2874', 'ddddd@ddddd', 'ddddd', 0, 0, 1, '0000-00-00', ''),
(32, 'dddddddddd', '9062ff4fb860c9c664ac7380b471f2a44c038238', 'ddddd@ddddd', 'ddddd', 0, 0, 1, '2022-08-09', ''),
(33, 'bbbbbbbbb', 'a6fd29167cbd2a7c9a4a5c6ed99d080e5d14b346', 'bbb@b', 'bbb', 0, 0, 1, '2022-08-09', ''),
(35, 'lololo', '8aa40001b9b39cb257fe646a561a80840c806c55', '', '', 0, 0, 1, '2022-08-10', ''),
(36, 'jaber', '1ef8d9d22f66ad00d84b01664faa2700d05b3957', 'jaber@j.com', 'mook', 0, 0, 1, '2022-08-13', '464_117-1178133_bmw-m4-gts-wallpaper-hd.jpg'),
(37, '444444444444444444', '4f8ea16c7f7e827b8294cd42eaa055c8f836c04f', '444444444@d.com', 'q', 0, 0, 1, '2022-08-13', '437_IMG-20210626-WA0011.jpg'),
(38, 'mkdadzhere', '9938681061', '', '', 0, 0, 1, '0000-00-00', ''),
(39, 'pial', '9fc7a926b1207658dafa01fdbddc5c109cfbe2af', 'piap@kiit.ac', 'ds', 0, 0, 1, '2023-02-14', '211_٢٠١٩١٢٠٩_١٨٣٥١٦.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `items_comments` (`item_id`),
  ADD KEY `user_comments` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `mk` (`mem_id`),
  ADD KEY `cat_1` (`cart_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `items_comments` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_comments` FOREIGN KEY (`user_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`cart_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mk` FOREIGN KEY (`mem_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
