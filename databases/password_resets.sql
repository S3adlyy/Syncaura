-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 07:06 PM
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
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `expires`, `created_at`) VALUES
(1, 'erguez.mohamed@gmail.com', '04c5a2f2bead3bf9717615376334edac925a21b2be8d00c90f06339e0d43423e437bfdb21d942fc2555086c8d77676e2e5ef', 1733936407, '2024-12-11 16:00:07'),
(2, 'erguez.mohamed@gmail.com', '403d4f90411111319a1313fd86bb1d84bd78c8474d0a0af24ed37b092c591b09096ee5ddff84c38554661174018d4960df88', 1733936408, '2024-12-11 16:00:08'),
(3, 'erguez.mohamed@gmail.com', '236484eeaa8062615b82306daa7591175b11c574b5b32504cd9d1063e52b4f75d08e1aaeb84de31a3abee6ee4977d97a3b21', 1733936572, '2024-12-11 16:02:52'),
(4, 'erguez.mohamed@gmail.com', '23b742da771732437a34ee065827354e60c9410c56eee266d7c64004f4b292431c90394ece666fb9638997d0e8e1ec7f7e58', 1733936581, '2024-12-11 16:03:01'),
(5, 'erguez.mohamed@gmail.com', 'fce9ea2060c47e668e5cdcc9ff2f3ee688944a4fc81bfd2b142607af22eab171843c476595ee6a73cd92ec58b8a3314c0089', 1733936756, '2024-12-11 16:05:56'),
(6, 'erguez.mohamed@gmail.com', '3480c50dcce96fd2ca56f0b2b632a8f1fcc4333680b0f535d305a17be822aecad0f0f52792afbbdaadecbc73acfa841e77a7', 1733936932, '2024-12-11 16:08:52'),
(7, 'erguez.mohamed@gmail.com', '147cee248bbe071e91d392dd31b4856455adc105c0895d382aff5f66171eca76e6d30d1d0d48a96987ceea01912d5d53921d', 1733937031, '2024-12-11 16:10:31'),
(8, 'erguez.mohamed@gmail.com', '6a06023965040bfb388ab219410cf3b099ad80868a7ddca917a9dd74e210f5c6f64b3782699619e415fc420d91e7e795a8c4', 1733937048, '2024-12-11 16:10:48'),
(9, 'mohamed.erguez@gmail.com', '66aaea4dd7cc5bc60afef84679aa1f383724791ba8a19ce115ca4c56b792f00826bc7bc320bea4adce2bba3cd941aaca25c3', 1733937256, '2024-12-11 16:14:16'),
(10, 'mohamed.erguez@gmail.com', '487d1c8accb57d733fa35d70e3688d24513733277ba4a6ab6caf3218d85a5e734e2ea008c227c803bfa2c126679d82a25d6d', 1733937284, '2024-12-11 16:14:44'),
(11, 'mohamed.erguez@gmail.com', '877a4f7d040491da8480e4012f9001ccc0c2a4654aeca163906b9d941659288f3203017d4b005d0da9cf138a9f5cfa91b14b', 1733941817, '2024-12-11 17:30:17'),
(12, 'mohamed.erguez@gmail.com', '479d98c48bb72642a942b55184a02a96a50790157a8d30889a0b172005b8686a33e53e24ed47fbbc8838965be5b34eb5a4d9', 1733941926, '2024-12-11 17:32:06'),
(13, 'mohamed.erguez@gmail.com', 'd19540ebe97e8e4d1043887eec78585821653f9a43c587f74166d9d3d43c6a3341f92da4ba1f2ce3ce66f81189b22a7f3a19', 1733941931, '2024-12-11 17:32:11'),
(14, 'mohamed.erguez@gmail.com', '3cbea6870a39a3507e181b1a9bc69aa48735b9150a4b7947c5214481423e518d100dacc2f0582ac8a650f14b3baf8d94859c', 1733942014, '2024-12-11 17:33:34'),
(15, 'mohamed.erguez@gmail.com', '73993bd271759eef6b9bd6449e171a1ee3e03a6a2d889c2f903643e28c868a518778bdddbe5b7fa8f5cd589c0a32f45475b5', 1733942689, '2024-12-11 17:44:49'),
(16, 'mohamed.erguez@gmail.com', '2469c6a7797c4ef3a392f90b94eac58211d93bbc24918e9ece1e0254055b7c98b4215b83c9474060567d6944853c5171c6c2', 1733942780, '2024-12-11 17:46:20'),
(17, 'mohamed.erguez@gmail.com', '37c9adacb7831cfec090428b6a26af77c21c46d89d948aab8c00ada86c92d224506868978eb3f405d18c820c3da837604256', 1733942845, '2024-12-11 17:47:25'),
(19, 'mohamed.erguez@gmail.com', '41b1700b7a29a32946879841a8455f8476f036ebeb3212a180c40bef804229f829334e0b8e0ebbb7555069f2c311b6b7bda1', 1733944270, '2024-12-11 18:11:10'),
(20, 'mohamed.erguez@gmail.com', '23f6b59a4c3329bccf0e5be31fd86c13c31294d73f6907979e559b503cdfb646ce66ccac945e3b63d55cc8270b044a268ed1', 1733945317, '2024-12-11 18:28:37'),
(21, 'mohamed.erguez@gmail.com', 'f7fdb944de62f5b9472d603b38565441e63fa4aa7cab95f51aab95e898afdd44ffeebf16a92a789d9b5058f6747bb02cdce0', 1733945592, '2024-12-11 18:33:12'),
(22, 'mohamed.erguez@gmail.com', 'b3cfa29f8fc67c5bd819b7554b4a28846411bae956d451e5279a9b2e7ad1105091a5aa8a233aa7a85757470b8eec98b6cccb', 1734007804, '2024-12-12 11:50:04'),
(23, 'mohamed.erguez@gmail.com', '0dcb00a1379efabd0b1b5787345c9cc41afdede9c60101ca8fd36f360632f405007d414e32ddbac3b61bf87109b319a65b89', 1734007820, '2024-12-12 11:50:20'),
(24, 'mohamed.erguez@gmail.com', '864b29930df8fff2c1e2c04e40935bf99b521efed7a445adab6160d8ebc9305818862da3bbc820013f4ba29427fb208bb07d', 1734008139, '2024-12-12 11:55:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
