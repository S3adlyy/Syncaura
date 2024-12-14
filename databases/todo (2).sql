-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 05:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `date_plan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`id`, `nom`, `date_plan`) VALUES
(97, 'bb plan', '2024-11-30 00:00:00'),
(103, 'pla 4', '2024-11-30 00:00:00'),
(108, 'mmm', '2024-11-30 00:00:00'),
(110, 'okayy', '2024-11-30 00:00:00'),
(111, 'm77', '2024-12-01 00:00:00'),
(113, 'hiii', '2024-12-01 00:00:00'),
(114, 'jhnh', '2024-12-02 00:00:00'),
(116, 'plan2', '2024-12-02 00:00:00'),
(117, 'WEB', '2024-12-02 00:00:00'),
(119, 'ggg', '2024-12-05 00:00:00'),
(120, 'k77', '2024-12-06 00:00:00'),
(126, 'crkiijj', '2024-12-06 00:00:00'),
(127, 'vbv', '2024-12-06 00:00:00'),
(128, 'eses', '2024-12-06 00:00:00'),
(129, 'aszez', '2024-12-06 00:00:00'),
(130, 'plan nowww', '2024-12-06 19:44:04');

-- --------------------------------------------------------

--
-- Table structure for table `tache`
--

CREATE TABLE `tache` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `etat` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tachee`
--

CREATE TABLE `tachee` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `etat` enum('To Do','In Progress','Done') DEFAULT NULL,
  `plan_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tachee`
--

INSERT INTO `tachee` (`id`, `nom`, `date`, `etat`, `plan_name`) VALUES
(141, 'nbn', '2024-12-01 02:47:02', 'Done', 'm77'),
(142, 'knk', '2024-12-01 02:57:44', 'In Progress', 'm77'),
(172, 'ttt', '2024-12-05 22:12:00', 'Done', 'WEB'),
(184, 'yhy', '2024-12-06 19:14:27', 'In Progress', 'bb plan'),
(186, 'OKOKL', '2024-12-06 19:28:40', 'In Progress', 'bb plan'),
(187, 'AZZZSZ', '2024-12-06 19:28:47', 'Done', 'bb plan'),
(192, 'DVBB', '2024-12-06 19:29:24', 'To Do', 'bb plan'),
(194, 'ggb', '2024-12-06 23:05:16', 'To Do', 'eses'),
(196, 'yyy', '2024-12-07 03:54:56', 'To Do', 'bb plan'),
(197, 'hhh', '2024-12-07 04:05:27', 'To Do', 'bb plan'),
(198, 'yhyh', '2024-12-07 04:27:52', 'To Do', 'bb plan'),
(220, 'TGGGG', '2024-12-07 22:10:43', 'To Do', 'mmm'),
(273, '7', '2024-12-08 00:38:59', 'To Do', 'mmm'),
(302, '8', '2024-12-08 01:26:55', 'In Progress', 'okayy'),
(303, '5', '2024-12-08 01:27:19', 'In Progress', 'okayy'),
(304, '1', '2024-12-08 01:27:26', 'In Progress', 'okayy'),
(307, '66', '2024-12-08 01:29:14', 'To Do', 'okayy'),
(308, '4', '2024-12-08 01:30:07', 'Done', 'okayy'),
(309, '2', '2024-12-08 01:30:16', 'Done', 'okayy'),
(310, '3', '2024-12-08 01:30:21', 'Done', 'okayy'),
(314, '5', '2024-12-08 01:56:30', 'Done', 'pla 4'),
(315, '6', '2024-12-08 01:56:34', 'Done', 'pla 4'),
(316, '2', '2024-12-08 01:56:38', 'Done', 'pla 4'),
(317, '1', '2024-12-08 03:04:52', 'To Do', 'eses'),
(318, '2', '2024-12-08 03:04:57', 'In Progress', 'eses'),
(319, '3', '2024-12-08 03:05:05', 'In Progress', 'eses'),
(333, 'hghg', '2024-12-08 05:15:29', 'Done', 'hiii'),
(335, 'jfj', '2024-12-08 05:15:45', 'Done', 'hiii'),
(336, 'jjf', '2024-12-08 05:15:57', 'Done', 'hiii');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`),
  ADD KEY `idx_nom` (`nom`);

--
-- Indexes for table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_id` (`plan_id`);

--
-- Indexes for table `tachee`
--
ALTER TABLE `tachee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_plan_name` (`plan_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `tache`
--
ALTER TABLE `tache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tachee`
--
ALTER TABLE `tachee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=337;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tache`
--
ALTER TABLE `tache`
  ADD CONSTRAINT `tache_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `plan` (`id`);

--
-- Constraints for table `tachee`
--
ALTER TABLE `tachee`
  ADD CONSTRAINT `fk_plan_name` FOREIGN KEY (`plan_name`) REFERENCES `plan` (`nom`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
