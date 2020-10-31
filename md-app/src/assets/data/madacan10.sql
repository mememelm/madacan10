-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 12 oct. 2020 à 17:58
-- Version du serveur :  10.4.10-MariaDB
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
-- Base de données :  `madacan10`
--

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `answersId` int(11) NOT NULL AUTO_INCREMENT,
  `answersContent` varchar(255) NOT NULL,
  `answersState` tinyint(1) DEFAULT NULL,
  `questionsId` int(11) NOT NULL,
  PRIMARY KEY (`answersId`),
  KEY `questionsId` (`questionsId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `evaluations`
--

DROP TABLE IF EXISTS `evaluations`;
CREATE TABLE IF NOT EXISTS `evaluations` (
  `evaluationsId` int(11) NOT NULL AUTO_INCREMENT,
  `evaluationsResult` int(3) NOT NULL,
  `evaluationsDate` date NOT NULL,
  `evaluationsScore` tinyint(1) NOT NULL DEFAULT 0,
  `usersId` int(11) NOT NULL,
  PRIMARY KEY (`evaluationsId`),
  KEY `usersId` (`usersId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

DROP TABLE IF EXISTS `formations`;
CREATE TABLE IF NOT EXISTS `formations` (
  `formationsId` int(11) NOT NULL AUTO_INCREMENT,
  `formationsName` varchar(30) NOT NULL,
  `usersId` int(11) NOT NULL,
  PRIMARY KEY (`formationsId`),
  KEY `usersId` (`usersId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `modulesId` int(11) NOT NULL AUTO_INCREMENT,
  `modulesName` varchar(30) NOT NULL,
  `modulesLevel` int(2) NOT NULL,
  `modulesType` varchar(30) NOT NULL,
  `formationsId` int(11) NOT NULL,
  PRIMARY KEY (`modulesId`),
  KEY `formationsId` (`formationsId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='formationdoingType = text, input file (video, pdf)';

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `questionsId` int(11) NOT NULL AUTO_INCREMENT,
  `questionsContent` varchar(255) NOT NULL,
  `modulesId` int(11) NOT NULL,
  PRIMARY KEY (`questionsId`),
  KEY `modulesId` (`modulesId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `supports`
--

DROP TABLE IF EXISTS `supports`;
CREATE TABLE IF NOT EXISTS `supports` (
  `supportsId` int(11) NOT NULL AUTO_INCREMENT,
  `supportsType` varchar(10) NOT NULL,
  `supportsContent` varchar(255) NOT NULL,
  `questionsId` int(11) NOT NULL,
  PRIMARY KEY (`supportsId`),
  KEY `questionsId` (`questionsId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='support content = input file by type file';

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `usersId` int(11) NOT NULL AUTO_INCREMENT,
  `usersImmatriculation` int(15) NOT NULL,
  `usersFirstname` varchar(30) NOT NULL,
  `usersLastname` varchar(30) NOT NULL,
  `usersBirth` date NOT NULL,
  `usersEmploiment` varchar(30) NOT NULL,
  `usersStatus` varchar(30) NOT NULL,
  `usersAccess` varchar(30) NOT NULL,
  PRIMARY KEY (`usersId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
