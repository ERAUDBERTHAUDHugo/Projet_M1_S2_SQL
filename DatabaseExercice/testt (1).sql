-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 12 avr. 2021 à 12:08
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `testt`
--

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

DROP TABLE IF EXISTS `equipe`;
CREATE TABLE IF NOT EXISTS `equipe` (
  `equipe_id` int NOT NULL,
  `equipe_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`equipe_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `groupe_id` int NOT NULL,
  `groupe_name` varchar(50) DEFAULT NULL,
  `equipe_id` int DEFAULT NULL,
  PRIMARY KEY (`groupe_id`),
  KEY `equipe_id` (`equipe_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `part_of`
--

DROP TABLE IF EXISTS `part_of`;
CREATE TABLE IF NOT EXISTS `part_of` (
  `user_id` int NOT NULL,
  `groupe_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`groupe_id`),
  KEY `groupe_id` (`groupe_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `question_id` varchar(50) NOT NULL,
  `question_text` varchar(50) DEFAULT NULL,
  `question_answer` varchar(50) DEFAULT NULL,
  `quizz_id` int NOT NULL,
  PRIMARY KEY (`question_id`),
  KEY `quizz_id` (`quizz_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `quizz`
--

DROP TABLE IF EXISTS `quizz`;
CREATE TABLE IF NOT EXISTS `quizz` (
  `quizz_id` int NOT NULL,
  `quizz_name` varchar(50) DEFAULT NULL,
  `quizz_difficulty` varchar(50) DEFAULT NULL,
  `quizz_description` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`quizz_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tp`
--

DROP TABLE IF EXISTS `tp`;
CREATE TABLE IF NOT EXISTS `tp` (
  `tp_id` int NOT NULL,
  `quizz_id` int NOT NULL,
  `equipe_id` int NOT NULL,
  PRIMARY KEY (`tp_id`),
  KEY `quizz_id` (`quizz_id`),
  KEY `equipe_id` (`equipe_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL,
  `user_address` varchar(50) DEFAULT NULL,
  `user_lastname` varchar(50) DEFAULT NULL,
  `user_firstname` varchar(50) DEFAULT NULL,
  `user_score` varchar(50) DEFAULT NULL,
  `user_password` varchar(50) DEFAULT NULL,
  `user_role` binary(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user_answer`
--

DROP TABLE IF EXISTS `user_answer`;
CREATE TABLE IF NOT EXISTS `user_answer` (
  `user_answer_id` int NOT NULL,
  `user_answer_text` varchar(50) DEFAULT NULL,
  `valid` int DEFAULT NULL,
  `user_answer_time` datetime DEFAULT NULL,
  `tp_id` int NOT NULL,
  `question_id` varchar(50) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`user_answer_id`),
  UNIQUE KEY `question_id` (`question_id`),
  KEY `tp_id` (`tp_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
