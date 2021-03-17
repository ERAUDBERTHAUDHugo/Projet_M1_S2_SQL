-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 17 mars 2021 à 15:18
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_project`
--

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `question_id` int(11) NOT NULL,
  `question_text` varchar(1000) DEFAULT NULL,
  `question_answer` varchar(1000) DEFAULT NULL,
  `quiz_id` int(11) NOT NULL,
  PRIMARY KEY (`question_id`),
  KEY `quizz_id` (`quiz_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`question_id`, `question_text`, `question_answer`, `quiz_id`) VALUES
(0, 'Affichez les informations sur les fournisseurs', 'SELECT * FROM `fournisseur` ', 0),
(1, 'Afficher les pièces', 'SELECT * FROM `piece`', 0);

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `quiz_id` int(11) NOT NULL,
  `quiz_name` varchar(50) DEFAULT NULL,
  `quiz_difficulty` varchar(50) DEFAULT NULL,
  `quiz_description` varchar(1000) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `quiz_database` varchar(50) NOT NULL,
  PRIMARY KEY (`quiz_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `quiz_name`, `quiz_difficulty`, `quiz_description`, `user_id`, `quiz_database`) VALUES
(0, 'Quiz notions base', 'Facile', 'Testez vos connaissances en réalisant des requêtes de base SQL.', 0, 'cycle_v3'),
(1, 'Quiz tri de données', 'Moyen', 'Appliquez vos connaissances pour trier d\'informations sélectionnées d\'une base de donnée. ', 2, 'cycle_v3'),
(2, 'Quiz avancé', 'Difficile', 'Réalisez des requêtes avancées.', 1, 'cycle_v3'),
(3, 'Quiz test', 'Moyen', 'Faites des requêtes SQL avec une étude de cas particulière.', 2, 'cycle_v3');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_adress` varchar(50) DEFAULT NULL,
  `user_last_name` varchar(50) NOT NULL,
  `user_first_name` varchar(50) NOT NULL,
  `user_password` varchar(50) DEFAULT NULL,
  `user_role` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user_answer`
--

DROP TABLE IF EXISTS `user_answer`;
CREATE TABLE IF NOT EXISTS `user_answer` (
  `user_answer_id` int(11) NOT NULL,
  `user_answer_text` varchar(50) DEFAULT NULL,
  `user_answer_time` datetime DEFAULT NULL,
  `question_id` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`user_answer_id`),
  UNIQUE KEY `question_id` (`question_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
