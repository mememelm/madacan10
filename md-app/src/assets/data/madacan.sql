-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 29 août 2020 à 20:42
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
-- Base de données :  `madacan`
--

-- --------------------------------------------------------

--
-- Structure de la table `exercise`
--

DROP TABLE IF EXISTS `exercise`;
CREATE TABLE IF NOT EXISTS `exercise` (
  `exerciseId` int(15) NOT NULL AUTO_INCREMENT,
  `exerciseContent` varchar(3000) NOT NULL,
  `exerciseDoing` int(1) NOT NULL,
  `exerciseStatus` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`exerciseId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `formationId` int(11) NOT NULL AUTO_INCREMENT,
  `formationName` varchar(30) NOT NULL,
  PRIMARY KEY (`formationId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `formationdoing`
--

DROP TABLE IF EXISTS `formationdoing`;
CREATE TABLE IF NOT EXISTS `formationdoing` (
  `formationdoingId` int(15) NOT NULL AUTO_INCREMENT,
  `formationdoingName` varchar(30) NOT NULL,
  `formationdoingLevel` int(2) NOT NULL,
  `formationdoingType` varchar(30) NOT NULL,
  PRIMARY KEY (`formationdoingId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='formationdoingType = text, input file (video, pdf)';

-- --------------------------------------------------------

--
-- Structure de la table `support`
--

DROP TABLE IF EXISTS `support`;
CREATE TABLE IF NOT EXISTS `support` (
  `supportId` int(15) NOT NULL,
  `supportType` varchar(10) NOT NULL,
  `supportContent` varchar(3000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='support content = input file by type file';

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `testId` int(15) NOT NULL AUTO_INCREMENT,
  `testContent` varchar(55533) NOT NULL,
  `testResult` int(3) NOT NULL,
  `testDate` date NOT NULL,
  `testStatus` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`testId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userImmatriculation` int(15) NOT NULL,
  `userFirstname` varchar(30) NOT NULL,
  `userLastname` varchar(30) NOT NULL,
  `userBirth` date NOT NULL,
  `userEmploiment` varchar(30) NOT NULL,
  `userStatus` varchar(30) NOT NULL,
  PRIMARY KEY (`userImmatriculation`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
