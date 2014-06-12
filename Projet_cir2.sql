-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 12 Juin 2014 à 09:11
-- Version du serveur: 5.5.37
-- Version de PHP: 5.4.4-14+deb7u9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `administrateur`
--

-- --------------------------------------------------------

--
-- Structure de la table `PROJECT`
--

CREATE TABLE IF NOT EXISTS `PROJECT` (
  `PROJECT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(20) DEFAULT NULL,
  `DATE_BUTOIRE` datetime DEFAULT NULL,
  PRIMARY KEY (`PROJECT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=84 ;

-- --------------------------------------------------------

--
-- Structure de la table `RESULT`
--

CREATE TABLE IF NOT EXISTS `RESULT` (
  `LOGIN` char(8) NOT NULL,
  `PROJECT_ID` int(11) NOT NULL,
  `TEST_NUM` int(11) NOT NULL,
  `SUBTEST_NUM` int(11) NOT NULL,
  `STATUS` tinyint(1) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PROJECT_ID`,`TEST_NUM`,`LOGIN`,`SUBTEST_NUM`),
  KEY `FK_RESULT` (`LOGIN`),
  KEY `FK_RESULT2` (`PROJECT_ID`,`TEST_NUM`,`SUBTEST_NUM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `STUDENT`
--

CREATE TABLE IF NOT EXISTS `STUDENT` (
  `LOGIN` char(8) NOT NULL,
  `LASTNAME` varchar(20) DEFAULT NULL,
  `FIRSTNAME` varchar(20) DEFAULT NULL,
  `MAIL` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`LOGIN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `STUDENT`
--

INSERT INTO `STUDENT` (`LOGIN`, `LASTNAME`, `FIRSTNAME`, `MAIL`) VALUES
('student', 'student', 'student', 'student@test.fr');

-- --------------------------------------------------------

--
-- Structure de la table `SUBTEST`
--

CREATE TABLE IF NOT EXISTS `SUBTEST` (
  `PROJECT_ID` int(11) NOT NULL,
  `TEST_NUM` int(11) NOT NULL,
  `SUBTEST_NUM` int(11) NOT NULL,
  `KIND` varchar(20) DEFAULT NULL,
  `VALEUR` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`PROJECT_ID`,`TEST_NUM`,`SUBTEST_NUM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `TEACHER`
--

CREATE TABLE IF NOT EXISTS `TEACHER` (
  `LOGIN` varchar(10) NOT NULL,
  `LASTNAME` varchar(20) DEFAULT NULL,
  `FIRSTNAME` varchar(20) DEFAULT NULL,
  `MAIL` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`LOGIN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `TEACHER_PROJECT`
--

CREATE TABLE IF NOT EXISTS `TEACHER_PROJECT` (
  `LOGIN` varchar(10) NOT NULL,
  `PROJECT_ID` int(11) NOT NULL,
  PRIMARY KEY (`LOGIN`,`PROJECT_ID`),
  KEY `FK_TEACHER_PROJECT2` (`PROJECT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `TEST`
--

CREATE TABLE IF NOT EXISTS `TEST` (
  `PROJECT_ID` int(11) NOT NULL,
  `TEST_NUM` int(11) NOT NULL,
  `NAME` varchar(20) DEFAULT NULL,
  `MARK` float DEFAULT NULL,
  PRIMARY KEY (`PROJECT_ID`,`TEST_NUM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `RESULT`
--
ALTER TABLE `RESULT`
  ADD CONSTRAINT `FK_RESULT` FOREIGN KEY (`LOGIN`) REFERENCES `STUDENT` (`LOGIN`),
  ADD CONSTRAINT `FK_RESULT2` FOREIGN KEY (`PROJECT_ID`, `TEST_NUM`, `SUBTEST_NUM`) REFERENCES `SUBTEST` (`PROJECT_ID`, `TEST_NUM`, `SUBTEST_NUM`);

--
-- Contraintes pour la table `SUBTEST`
--
ALTER TABLE `SUBTEST`
  ADD CONSTRAINT `FK_TEST_SUBTEST` FOREIGN KEY (`PROJECT_ID`, `TEST_NUM`) REFERENCES `TEST` (`PROJECT_ID`, `TEST_NUM`);

--
-- Contraintes pour la table `TEACHER_PROJECT`
--
ALTER TABLE `TEACHER_PROJECT`
  ADD CONSTRAINT `FK_TEACHER_PROJECT` FOREIGN KEY (`LOGIN`) REFERENCES `TEACHER` (`LOGIN`),
  ADD CONSTRAINT `FK_TEACHER_PROJECT2` FOREIGN KEY (`PROJECT_ID`) REFERENCES `PROJECT` (`PROJECT_ID`);

--
-- Contraintes pour la table `TEST`
--
ALTER TABLE `TEST`
  ADD CONSTRAINT `FK_TEST_PROJECT` FOREIGN KEY (`PROJECT_ID`) REFERENCES `PROJECT` (`PROJECT_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
