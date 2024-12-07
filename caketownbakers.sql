-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Sep 28, 2024 at 01:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `caketownbakers`
--

-- --------------------------------------------------------

--
-- Table structure for table `cakes`
--

CREATE TABLE `cakes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `average_rating` decimal(3,1) DEFAULT 0.0,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cakes`
--

INSERT INTO `cakes` (`id`, `name`, `image`, `average_rating`, `price`) VALUES
(1, 'Chocolate Cake', '../images/chock_cake.png', 4.5, 15.00),
(2, 'Red Velvet Cake', 'images/red_velvet_cake.png', 4.7, 18.00),
(3, 'Vanilla Cake', 'images/vanilla.png', 4.2, 12.00),
(4, 'Cheesecake', 'images/cheese_cake.png', 4.8, 20.00),
(5, 'Lemon Cake', 'images/lemon_cake.png', 4.3, 14.00),
(6, 'Strawberry Shortcake', 'images/strawberry_shortcake.png', 0.0, 16.00),
(7, 'Black Forest Cake', 'images/black_forest_cake.png', 0.0, 22.00),
(8, 'Carrot Cake', 'images/carrot_cake.png', 0.0, 14.00),
(9, 'Red Velvet Cheesecake', 'images/red_velvet_cheesecake.png', 0.0, 25.00),
(10, 'Mango Mousse Cake', 'images/mango_mousse_cake.png', 0.0, 17.00),
(11, 'Tiramisu', 'images/tiramisu.png', 0.0, 18.00),
(12, 'Pineapple Cake', 'images/pineapple_upside_down_cake.png', 0.0, 15.00);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `cake_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `fname`, `cake_id`, `comment`, `rating`, `created_at`) VALUES
(61, 'ss', 4, 'cxzczxczxcx', 4, '2024-09-27 02:09:00'),
(64, 'ss', 4, 'sdasdd', 5, '2024-09-27 02:13:40'),
(66, 'ss', 4, 'DFSD', 4, '2024-09-27 02:24:54'),
(69, 'ss', 4, 'ASDASD', 5, '2024-09-27 02:28:34'),
(86, 'ss', 3, 'sdasd', 5, '2024-09-27 02:52:31'),
(87, 'ss', 4, 'das', 0, '2024-09-27 12:36:48'),
(88, 'ss', 4, 'asdsa', 3, '2024-09-27 12:36:51'),
(89, 'Lakmi', 4, 'fefe', 0, '2024-09-28 10:36:05');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `mobile` int(11) NOT NULL,
  `postalCode` int(11) NOT NULL,
  `cardNumber` text NOT NULL,
  `cardType` varchar(50) NOT NULL,
  `expDate` varchar(50) NOT NULL,
  `cvv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `address`, `mobile`, `postalCode`, `cardNumber`, `cardType`, `expDate`, `cvv`) VALUES
(26, 'Kasuni Fernando', 'kasuni@gmail.comm', '381/4,Makumbura,Pannipitiya', 771687613, 10230, '1111-7777-8888-9999', 'Paypal', '01/25', 456),
(71, 'Lakmi Dissanayake', 'lakmi@gmail.com', 'Malabe', 764459303, 10230, '7788-7788-9988-4565', 'Visa', '01/25', 789),
(76, 'Lakmi Dissanayake', 'lakmi1820@gmail.com', '381/4,Makumbura,Pannipitiya', 777706152, 10230, '5555-6666-7878-3456', 'Visa', '03/24', 903),
(77, 'Senura Perera', 'dulajperera34senura@gmail.com', '381/4,Makumbura,Pannipitiya', 771687613, 10230, '1111-8888-9999-8888', 'MasterCard', '01/28', 789),
(78, 'Senura Perera', 'dulajperera34senura@gmail.com', '381/4,Makumbura,Pannipitiya', 771687613, 10230, '7777-8888-9999-5555', 'Visa', '01/25', 789);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` text NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `email` text NOT NULL,
  `pass` text NOT NULL,
  `contact` text NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fname`, `lname`, `email`, `pass`, `contact`, `type`) VALUES
('USER125481', 'diluni', 'wathsani', 'diluni@gmail.com', '$2y$10$RC/', '0716158854', 'user'),
('USER125482', 'sandun', 'wathsana', 'sandun@gmail.com', '$2y$10$Vg5', '0716234524', 'admin'),
('USER125483', 'bimsarani', 'alahakoon', 'abc@gmail.com', '$2y$10$Yky', 'asd23', 'admin'),
('USER125484', 'senali', 'perera', 's@gmail.com', '$2y$10$pBX', 'asd45', 'user'),
('USER125485', 'lakmi', 'perera', 'l@gmail.com', '$2y$10$di9', 'a234', 'admin'),
('USER125486', 'a', 'b', 'a@gmail.com', '$2y$10$gui', 'bb', 'admin'),
('USER125487', 'abc', 'b', 'a@gmail.com', '$2y$10$0kz', '22', 'user'),
('USER125488', 'nuwan', 'nuwan', 'nuwan@gmail.com', '$2y$10$kEY', '0768840107', 'user'),
('USER125489', 'nuwan', 'nuwan', 'nuwan@gmail.com', '$2y$10$Ck6', '0768840107', 'admin'),
('USER125490', 'ppp', 'ppp', 'ppp@gmail.com', '$2y$10$jum', '0768840107', 'admin'),
('USER125491', 'ppp', 'ppp', 'ppp@gmail.com', '$2y$10$q75', '0768840107', 'admin'),
('USER125492', 'ooo', 'ooo', 'ooo@gmail.com', '$2y$10$CPZ', '123', 'user'),
('USER125493', 'uu', 'uu', 'uu@gmail.com', '$2y$10$SCX', '565', 'admin'),
('USER125494', 'yy', 'yy', 'yy@gmail.com', '$2y$10$fw.', '5354324', 'user'),
('USER125495', 'ss', 'ss', 'ss@gmail.com', '$2y$10$akT', '312', 'user'),
('USER125496', 'Senura', 'Perera', 'senura@gmail.com', '$2y$10$Y4k', '0771687589', 'admin'),
('USER125497', 'Senura', 'Perera', 'senura@gmail.com', '$2y$10$c3s', '0771687589', 'user'),
('USER125498', 'Senura', 'Perera', 'senura@gmail.com', '$2y$10$ORs', '0771687589', 'user'),
('USER125499', 'Lakmi', 'Dissanayake', 'lakmid@gmail.com', '$2y$10$IHX3pmgvt4pVUUcgo9XOju3gce5cbFOYcxOPlk2QovSnufndWFH32', '0771687589', 'user'),
('USER125500', 'Lakmi ', 'Dissanayake', 'lakmid@gmail.com', '$2y$10$SAHEwnKPxPfRzYFpvfRNa.fApSlg/DAmFlgvh.F33/3EIYZO0FbWW', '0764459303', 'admin'),
('USER125501', 'Lakmi', 'Dissanayake', 'lakmiadmin@gmail.com', '$2y$10$EQF0SlX/B0Weu/hguOYFaeKHYwv78M9eYDE7r38HTK0/1vJDeXEJi', '0764459303', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cakes`
--
ALTER TABLE `cakes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fname` (`fname`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cakes`
--
ALTER TABLE `cakes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
