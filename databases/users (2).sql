-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 01:45 PM
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
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `surname` varchar(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` mediumtext NOT NULL,
  `status` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `phone` int(11) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `surname`, `username`, `email`, `password`, `status`, `role`, `gender`, `birthdate`, `phone`, `profile_picture`) VALUES
(38, 'adm', 'adm', 'admin', 'adm.admin@gmail.com', '$2y$10$WfJXMrRl4U6c3bN8.wa0f.yCloOEIk6n.KWi2nlhlXwcsTqkeW6u2', 1, 1, 0, NULL, 0, NULL),
(53, 'mouadh', 'aaa', 'test', 'erguez.mohamed@protonmail.com', '$2y$10$n8lBw60q.Ny2xdOn7X7pm.fbmDMXBRdO8dzV3hh.9yKIMS.Rexo9C', 0, 0, 0, '2004-02-02', 123456789, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
