-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 04 déc. 2024 à 14:55
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `chatroom_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `messages` varchar(300) DEFAULT NULL,
  `timee` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `messages`, `timee`) VALUES
(1, 'hello ', '2024-11-20 12:22:42'),
(2, 'slm', '2024-11-20 12:37:49'),
(3, 'hey', '2024-11-20 12:38:21');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `username`, `message`, `timestamp`, `user_id`) VALUES
(277, 'bilal', 'hey', '2024-11-29 17:11:11', 362),
(278, 'bilal', 'GIF:https://media2.giphy.com/media/ltIFdjNAasOwVvKhvx/200.gif?cid=ea2ca7086ajb0sd37m9p0665y6a5u112gu1wgav1r0peh9g5&ep=v1_gifs_search&rid=200.gif&ct=g', '2024-11-29 17:11:20', 362),
(279, 'bilal', 'GIF:https://media1.giphy.com/media/xT8qBhUUelhfFfl7Py/200.gif?cid=ea2ca7083emgkayofbojq7sfhavqylug5wfldrowa6od4ibj&ep=v1_gifs_search&rid=200.gif&ct=g', '2024-11-29 17:55:49', 362),
(280, 'wassim', 'GIF:https://media0.giphy.com/media/axojFOM91kAE6vO8xI/200.gif?cid=ea2ca708x73u00lrjml0kmvrj1pl58if89f9pafcx3vnn1dz&ep=v1_gifs_search&rid=200.gif&ct=g', '2024-11-30 14:23:30', 366),
(281, 'wassime', 'hey😍', '2024-11-30 14:23:36', 367),
(282, 'lwes', 'hey😍', '2024-11-30 14:35:37', 370),
(283, 'bilal', 'GIF:https://media0.giphy.com/media/axojFOM91kAE6vO8xI/200.gif?cid=ea2ca708x73u00lrjml0kmvrj1pl58if89f9pafcx3vnn1dz&ep=v1_gifs_search&rid=200.gif&ct=g', '2024-11-30 14:36:28', 362),
(284, 'lwes', 'GIF:https://media3.giphy.com/media/MKtUb2n7LQgbn0ti1f/200.gif?cid=ea2ca7080gsfgk2u6u16nk2t6rg6owxjmmyaup3dbmtbwfa8&ep=v1_gifs_search&rid=200.gif&ct=g', '2024-11-30 14:36:34', 370),
(285, 'lwes', 'GIF:https://media1.giphy.com/media/3ohc0QQkTH6YK8g4zS/200.gif?cid=ea2ca7082inbw1qjzc9t0b8jczrzqtxlslem0uxlhr5rcfud&ep=v1_gifs_search&rid=200.gif&ct=g', '2024-12-01 01:11:39', 370),
(286, 'lwes', 'hey😁', '2024-12-01 01:11:45', 370),
(287, 'wassim', 'hey', '2024-12-01 01:23:10', 366),
(288, 'king', 'hey', '2024-12-01 01:23:21', 374),
(289, 'wassim', 'hey', '2024-12-01 01:26:42', 366),
(290, 'wass', 'hey', '2024-12-01 01:26:59', 376),
(291, 'lwes', 'hey', '2024-12-01 01:30:45', 370),
(292, 'wassim', 'hey', '2024-12-01 01:30:50', 366),
(293, 'wassim', 'hey', '2024-12-01 01:31:33', 366),
(294, 'king', 'hey', '2024-12-01 01:37:14', 374),
(295, 'wassim', 'hey😍', '2024-12-01 01:51:20', 366),
(296, 'ysf', 'hey😃', '2024-12-01 01:51:44', 386),
(297, 'king', 'hey', '2024-12-01 01:52:25', 374),
(298, 'wassim', 'hey', '2024-12-01 01:52:26', 366),
(299, 'wassim', 'hey', '2024-12-01 01:52:32', 366),
(300, 'wassim', 'GIF:https://media4.giphy.com/media/l0HU4yUROHjIbAo9y/200.gif?cid=ea2ca7082inbw1qjzc9t0b8jczrzqtxlslem0uxlhr5rcfud&ep=v1_gifs_search&rid=200.gif&ct=g', '2024-12-01 01:52:36', 366),
(301, 'king', 'GIF:https://media4.giphy.com/media/ypBiWaKJ6zuQvnFAGe/200.gif?cid=ea2ca708hjm4airo87xebv9n5vjj96257igscujuyt6b5aej&ep=v1_gifs_search&rid=200.gif&ct=g', '2024-12-01 01:52:41', 374),
(302, 'king', 'hey', '2024-12-01 01:53:46', 374),
(303, 'hey', 'hey', '2024-12-01 03:11:09', 389),
(304, 'ssqs', 'hey', '2024-12-01 03:11:18', 390),
(305, 'wassim', 'hey', '2024-12-01 16:06:01', 366),
(306, 'wass', 'hey', '2024-12-01 16:06:04', 376),
(307, 'wassim', 'GIF:https://media4.giphy.com/media/l0HU4yUROHjIbAo9y/200.gif?cid=ea2ca708y88g8w6ozdtpyuqz8w1kbknvl3hvzxl778c9yn6p&ep=v1_gifs_search&rid=200.gif&ct=g', '2024-12-01 16:06:33', 366),
(308, 'wass', 'GIF:https://media0.giphy.com/media/8Api4UUrmvMtVGI8gq/200.gif?cid=ea2ca708cf43sp2rjbp4e5jpmo42x6bh84hxjdeqh0nbfpo8&ep=v1_gifs_search&rid=200.gif&ct=g', '2024-12-01 16:06:38', 376),
(309, 'wassim', 'hey', '2024-12-04 13:29:46', 366),
(310, 'wassim', '😄', '2024-12-04 13:29:49', 366),
(311, 'wassim', 'GIF:https://media3.giphy.com/media/l0HU4yUROHjIbAo9y/200.gif?cid=ea2ca708nham3rd9a3gqoowl0t653tajrfehwt7n7ldz046t&ep=v1_gifs_search&rid=200.gif&ct=g', '2024-12-04 13:29:51', 366),
(312, 'wassim', 'hey ', '2024-12-04 13:49:49', 366);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `join_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `chatroom` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `join_date`, `chatroom`) VALUES
(362, 'bilal', '2024-11-29 16:10:44', 'room6'),
(365, 'bilal', '2024-11-29 16:55:46', 'room1'),
(366, 'wassim', '2024-11-30 13:22:34', 'room'),
(367, 'wassime', '2024-11-30 13:22:52', 'room'),
(370, 'lwes', '2024-11-30 13:35:31', 'room'),
(371, 'bilal', '2024-11-30 13:36:01', 'room'),
(372, 'lwes', '2024-12-01 00:11:09', 'room1'),
(373, 'wassim', '2024-12-01 00:23:07', 'room'),
(374, 'king', '2024-12-01 00:23:18', 'room1'),
(375, 'wassim', '2024-12-01 00:26:38', 'room1'),
(376, 'wass', '2024-12-01 00:26:57', 'room2'),
(377, 'wassim', '2024-12-01 00:30:28', 'room1'),
(378, 'lwes', '2024-12-01 00:30:36', 'room1'),
(379, 'wassim', '2024-12-01 00:31:31', 'lwes'),
(380, 'wassim', '2024-12-01 00:32:29', 'room1'),
(384, 'king', '2024-12-01 00:37:11', 'king'),
(385, 'wassim', '2024-12-01 00:51:05', 'room'),
(386, 'ysf', '2024-12-01 00:51:37', 'room'),
(387, 'wassim', '2024-12-01 00:52:18', 'room'),
(388, 'king', '2024-12-01 00:52:22', 'room'),
(389, 'hey', '2024-12-01 02:10:33', 'hey'),
(390, 'ssqs', '2024-12-01 02:11:16', 'ss'),
(391, 'wassim', '2024-12-01 15:05:48', 'room'),
(392, 'wass', '2024-12-01 15:05:58', 'sss'),
(393, 'wassim', '2024-12-04 12:29:44', 'room1'),
(394, 'wassim', '2024-12-04 12:49:47', 'room');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=395;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
