-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 26 mars 2021 à 14:17
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
-- Base de données : `db_project`
--

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `question_id` int NOT NULL,
  `question_text` varchar(1000) DEFAULT NULL,
  `question_answer` varchar(1000) DEFAULT NULL,
  `quiz_id` int NOT NULL,
  `question_points` int DEFAULT '0',
  PRIMARY KEY (`question_id`),
  KEY `quizz_id` (`quiz_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`question_id`, `question_text`, `question_answer`, `quiz_id`, `question_points`) VALUES
(0, 'Affichez les informations sur les fournisseurs', 'SELECT * FROM `fournisseur` ', 0, 5),
(1, 'Afficher les pièces', 'SELECT * FROM `piece`', 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `quiz_id` int NOT NULL,
  `quiz_name` varchar(50) DEFAULT NULL,
  `quiz_difficulty` varchar(50) DEFAULT NULL,
  `quiz_description` varchar(1000) DEFAULT NULL,
  `user_id` int NOT NULL,
  `quiz_database` varchar(50) NOT NULL,
  PRIMARY KEY (`quiz_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `quiz_name`, `quiz_difficulty`, `quiz_description`, `user_id`, `quiz_database`) VALUES
(0, 'Quiz notions base', 'Facile', 'Testez vos connaissances en réalisant des requêtes de base SQL.', 0, 'cycle_v3'),
(1, 'Quiz tri de données', 'Moyen', 'Appliquez vos connaissances pour trier d\'informations sélectionnées d\'une base de donnée. ', 0, 'cycle_v3'),
(2, 'Quiz avancé', 'Difficile', 'Réalisez des requêtes avancées.', 0, 'cycle_v3'),
(3, 'Quiz test', 'Moyen', 'Faites des requêtes SQL avec une étude de cas particulière.', 0, 'cycle_v3');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_adress` varchar(50) DEFAULT NULL,
  `user_last_name` varchar(50) NOT NULL,
  `user_first_name` varchar(50) NOT NULL,
  `user_password` varchar(50) DEFAULT NULL,
  `user_role` tinyint DEFAULT NULL,
  `user_score` int DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_adress`, `user_last_name`, `user_first_name`, `user_password`, `user_role`, `user_score`) VALUES
(0, 'kjekdjezkdjeez', 'Goedert', 'Thibault', 'motdepasse', 0, 32),
(1, 'hafdf', 'Choukhi', 'Imane', '12345', 0, 54),
(2, 'adresse', 'Lala', 'Nono', '0000', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_answer`
--

DROP TABLE IF EXISTS `user_answer`;
CREATE TABLE IF NOT EXISTS `user_answer` (
  `user_answer_id` int NOT NULL,
  `user_answer_text` varchar(50) DEFAULT NULL,
  `user_answer_time` datetime DEFAULT NULL,
  `question_id` varchar(50) NOT NULL,
  `user_id` int NOT NULL,
  `question_score` int DEFAULT '0',
  `valide` int DEFAULT NULL,
  `quiz_id` int DEFAULT NULL,
  PRIMARY KEY (`user_answer_id`),
  UNIQUE KEY `question_id` (`question_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_answer`
--

INSERT INTO `user_answer` (`user_answer_id`, `user_answer_text`, `user_answer_time`, `question_id`, `user_id`, `question_score`, `valide`, `quiz_id`) VALUES
(0, 'Reponse', '2021-03-18 21:03:01', '0', 0, 2, 1, 0),
(1, 'Reponse&&&z', '2021-03-19 11:50:20', '1', 1, 3, 1, 0),
(2, 'omhsa', '2021-03-19 09:51:16', '3', 1, 2, 1, 0),
(3, 'Reponseaaz', '2021-03-22 10:05:28', '4', 1, 5, 0, 0),
(5, 'test', '2021-03-22 21:39:58', '9', 0, 6, 1, 2),
(7, 'test', '2021-03-22 21:42:59', '8', 0, 6, 1, 0),
(9, 'testrep', '2021-03-25 10:40:35', '11', 0, 9, 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
