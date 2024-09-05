-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 05, 2024 at 11:16 AM
-- Server version: 5.7.33-log
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atellie`
--

-- --------------------------------------------------------

--
-- Table structure for table `buskets`
--

CREATE TABLE `buskets` (
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `cnt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buskets`
--

INSERT INTO `buskets` (`order_id`, `item_id`, `cnt`) VALUES
(1, 1, 2),
(1, 3, 2),
(2, 1, 1),
(2, 3, 1),
(3, 1, 1),
(4, 1, 1),
(5, 1, 1),
(6, 2, 1),
(7, 1, 2),
(7, 2, 1),
(8, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `text`) VALUES
(1, 'kate (04.09.2024) написал(а): Качество супер!!'),
(2, 'kate (04.09.2024) написал(а): Заказала платье, быстро сняли мерки, быстро пошили, все очень нравится!!!'),
(3, 'Наташа (04.09.2024) написал(а): Люблю это ателье!');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `picture` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `picture`, `type_id`) VALUES
(1, 'Пальто', 5000, 'palto.jpg', 1),
(2, 'Платье по колено', 3000, 'dress.jpg', 4),
(3, 'Широкие брюки со стрелками', 4000, 'bruki_1.jpg', 3),
(4, 'Платье в пол', 3000, 'dress_1.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `hide` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `state_id`, `hide`) VALUES
(1, 1, 2, 1),
(2, 1, 2, 0),
(3, 1, 2, 0),
(4, 2, 2, 1),
(5, 1, 1, 0),
(6, 2, 2, 0),
(7, 2, 2, 1),
(8, 2, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`) VALUES
(1, 'Открыт'),
(2, 'Завершен');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(1, 'Верхняя одежда'),
(2, 'Футболки и майки'),
(3, 'Брюки и штаны'),
(4, 'Платья'),
(7, 'Юбки');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `pass`, `email`) VALUES
(1, 'kate', 'user01', '123', 'kate mail ru'),
(2, 'Наташа!', 'user0', '1234', 'natalia @ mail ru');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buskets`
--
ALTER TABLE `buskets`
  ADD PRIMARY KEY (`order_id`,`item_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `color_id` (`type_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `state_id` (`state_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
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
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buskets`
--
ALTER TABLE `buskets`
  ADD CONSTRAINT `buskets_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `buskets_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
