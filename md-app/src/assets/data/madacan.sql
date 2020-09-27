-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  Dim 27 sep. 2020 à 17:11
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `madacan`
--

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

DROP TABLE IF EXISTS `evaluation`;
CREATE TABLE IF NOT EXISTS `evaluation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `reponse` text NOT NULL,
  `note` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `evaluation`
--

INSERT INTO `evaluation` (`id`, `user_id`, `question_id`, `reponse`, `note`, `created`, `modified`) VALUES
(1, 1, 1, 'Harena mila vitana', 15, '2020-09-27 09:18:44', '2020-09-27 15:03:58'),
(2, 1, 1, 'kkkkkkkk2', 5, '2020-09-27 09:31:23', '2020-09-27 09:31:23'),
(3, 1, 1, 'qsq', 2, '2020-09-27 09:54:12', '2020-09-27 09:54:12'),
(12, 1, 1, 'YES no', 15, '2020-09-27 15:02:56', '2020-09-27 15:02:56');

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) NOT NULL,
  `description` text,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id`, `intitule`, `description`, `created`, `modified`) VALUES
(1, 'KAKAKAKAKKAKAK', 'Formationazy API Cake', '2020-09-26 19:05:48', '2020-09-27 07:44:34'),
(2, 'APi Cake', 'Formationazy API Cake', '2020-09-27 06:03:23', '2020-09-27 06:03:23'),
(3, 'APi Cake', 'Formationazy API Cake', '2020-09-27 06:04:42', '2020-09-27 06:04:42'),
(4, 'APi Cake', 'Formationazy API Cake', '2020-09-27 06:11:11', '2020-09-27 06:11:11'),
(5, 'APi Cake', 'Formationazy API Cake', '2020-09-27 06:13:27', '2020-09-27 06:13:27'),
(6, 'APi Cake', 'Formationazy API Cake', '2020-09-27 06:13:44', '2020-09-27 06:13:44'),
(7, 'APi Cake', 'Formationazy API Cake', '2020-09-27 06:14:45', '2020-09-27 06:14:45'),
(8, 'APi Cake', 'Formationazy API Cake', '2020-09-27 06:14:57', '2020-09-27 06:14:57'),
(9, 'APi Cake NAZ', 'Formationazy API Cake', '2020-09-27 06:57:21', '2020-09-27 06:57:21'),
(10, 'APi Cake NAZ 2', 'Formationazy API Cake', '2020-09-27 07:05:10', '2020-09-27 07:05:10'),
(11, 'Tatie nazy', 'Sefo fitiavana nazy', '2020-09-27 07:05:47', '2020-09-27 07:05:47'),
(12, 'aaaaaaaaa', 'ddddddddddd', '2020-09-27 07:08:26', '2020-09-27 07:08:26'),
(13, 'APi Cake NAZ 2555', 'Formationazy API Cake', '2020-09-27 07:08:38', '2020-09-27 07:08:38'),
(14, 'APi Cake NAZ WA', 'Formationazy API Cake', '2020-09-27 07:11:58', '2020-09-27 07:11:58'),
(15, 'APi Cake NAZ WA2', 'Formationazy API Cake', '2020-09-27 07:14:24', '2020-09-27 07:14:24'),
(16, 'APi Cake NAZ WA2', 'Formationazy API Cake', '2020-09-27 07:18:28', '2020-09-27 07:18:28'),
(17, 'APi Cake NAZ WA2', 'Formationazy API Cake', '2020-09-27 07:19:16', '2020-09-27 07:19:16'),
(18, 'APi Cake NAZ WA2', 'Formationazy API Cake', '2020-09-27 07:19:50', '2020-09-27 07:19:50'),
(19, 'lm', 'kl', '2020-09-27 07:20:07', '2020-09-27 07:20:07'),
(20, 'APi Cake NAZ WA2', 'Formationazy API Cake', '2020-09-27 07:20:45', '2020-09-27 07:20:45'),
(21, 'APi Cake NAZ WA2', 'Formationazy API Cake', '2020-09-27 07:21:47', '2020-09-27 07:21:47'),
(22, 'APi 12 Cake NAZ WA2', 'Formationazy API Cake', '2020-09-27 07:22:10', '2020-09-27 07:22:10'),
(23, 'APi 12 Cake NAZ WA2', 'Formationazy API Cake', '2020-09-27 07:25:50', '2020-09-27 07:25:50'),
(24, 'APi 12 Cake NAZ WA2', 'Formationazy API Cake', '2020-09-27 07:27:08', '2020-09-27 07:27:08'),
(26, 'APi 12 Cake NAZ WA2', 'Formationazy API Cake', '2020-09-27 07:31:25', '2020-09-27 07:31:25');

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formation_id` int(11) DEFAULT NULL,
  `intitule` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `formation_id` (`formation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `module`
--

INSERT INTO `module` (`id`, `formation_id`, `intitule`, `description`, `created`, `modified`) VALUES
(1, 12, 'Module Cake', 'Formation cake', '2020-09-29 00:00:00', '2020-09-30 00:00:00'),
(2, 12, 'Mmr failed B Noob', 'MMR mila vitana', '2020-09-27 15:45:07', '2020-09-27 15:48:09');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `enonce` text NOT NULL,
  `type` int(11) NOT NULL,
  `reponse` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `module_id`, `enonce`, `type`, `reponse`, `created`, `modified`, `deleted`) VALUES
(1, 1, 'Qui est', 1, 'AAAAAAAAAAAA', '2020-09-22 00:00:00', '2020-09-30 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `support`
--

DROP TABLE IF EXISTS `support`;
CREATE TABLE IF NOT EXISTS `support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `description` text,
  `type` int(11) NOT NULL DEFAULT '1',
  `origine` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `support`
--

INSERT INTO `support` (`id`, `module_id`, `description`, `type`, `origine`, `url`, `created`, `modified`) VALUES
(1, 2, 'Support PDF', 1, 'sss', 'sssssssss', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `naissance` datetime DEFAULT NULL,
  `inscription` datetime NOT NULL,
  `level` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `connected` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `phone`, `adresse`, `naissance`, `inscription`, `level`, `active`, `password`, `connected`, `created`, `modified`, `deleted`) VALUES
(1, 'RAMIARINJAONA', 'Harilanto Patrick', 'rami.patrick301@gmail.com', '+261346897006', 'Ambohidroa', '1989-09-16 00:00:00', '2020-09-23 11:14:12', 1, 1, '', 1, '2020-09-30 00:00:00', '2020-09-24 00:00:00', '2020-09-30 07:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `user_formation`
--

DROP TABLE IF EXISTS `user_formation`;
CREATE TABLE IF NOT EXISTS `user_formation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `formation_id` int(11) NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `formation_id` (`formation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `evaluation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `evaluation_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`);

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module_ibfk_1` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`);

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

--
-- Contraintes pour la table `support`
--
ALTER TABLE `support`
  ADD CONSTRAINT `support_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

--
-- Contraintes pour la table `user_formation`
--
ALTER TABLE `user_formation`
  ADD CONSTRAINT `user_formation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_formation_ibfk_2` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
