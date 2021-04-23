-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 23 avr. 2021 à 15:52
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
-- Structure de la table `equipe`
--

DROP TABLE IF EXISTS `equipe`;
CREATE TABLE IF NOT EXISTS `equipe` (
  `equipe_id` int NOT NULL AUTO_INCREMENT,
  `equipe_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`equipe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `equipe`
--

INSERT INTO `equipe` (`equipe_id`, `equipe_name`) VALUES
(1, 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `groupe_id` int NOT NULL AUTO_INCREMENT,
  `groupe_name` varchar(50) DEFAULT NULL,
  `equipe_id` int DEFAULT NULL,
  PRIMARY KEY (`groupe_id`),
  KEY `equipe_id` (`equipe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`groupe_id`, `groupe_name`, `equipe_id`) VALUES
(1, 'Admin', 1),
(2, 'ModuleX', 2),
(3, 'Groupe_45', 2);

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

--
-- Déchargement des données de la table `part_of`
--

INSERT INTO `part_of` (`user_id`, `groupe_id`) VALUES
(90, 1);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `question_id` int NOT NULL AUTO_INCREMENT,
  `question_intitule` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `question_text` varchar(1000) DEFAULT NULL,
  `question_answer` varchar(1000) DEFAULT NULL,
  `quiz_id` int NOT NULL,
  `question_points` int DEFAULT '0',
  PRIMARY KEY (`question_id`),
  KEY `quizz_id` (`quiz_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`question_id`, `question_intitule`, `question_text`, `question_answer`, `quiz_id`, `question_points`) VALUES
(1, 'question 1', 'Affichez les informations sur les fournisseurs', 'SELECT * FROM `fournisseur` ', 1, 5),
(2, 'question 2', 'Afficher les pièces', 'SELECT * FROM `type_piece`', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `quiz_id` int NOT NULL AUTO_INCREMENT,
  `quiz_name` varchar(50) DEFAULT NULL,
  `quiz_difficulty` varchar(50) DEFAULT NULL,
  `quiz_description` varchar(1000) DEFAULT NULL,
  `user_id` int NOT NULL,
  `quiz_database` varchar(50) NOT NULL,
  `quiz_img` varchar(50) NOT NULL,
  PRIMARY KEY (`quiz_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `quiz_name`, `quiz_difficulty`, `quiz_description`, `user_id`, `quiz_database`, `quiz_img`) VALUES
(1, 'Quiz notions base', 'Facile', 'Testez vos connaissances en réalisant des requêtes de base SQL.', 90, 'cycle_v3', 'Imgtest1.PNG');

-- --------------------------------------------------------

--
-- Structure de la table `tp`
--

DROP TABLE IF EXISTS `tp`;
CREATE TABLE IF NOT EXISTS `tp` (
  `tp_id` int NOT NULL AUTO_INCREMENT,
  `tp_name` varchar(50) NOT NULL,
  `quiz_id` int NOT NULL,
  `equipe_id` int NOT NULL,
  PRIMARY KEY (`tp_id`),
  KEY `quiz_id` (`quiz_id`),
  KEY `equipe_id` (`equipe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tp`
--

INSERT INTO `tp` (`tp_id`, `tp_name`, `quiz_id`, `equipe_id`) VALUES
(36, 'TP_Test', 1, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_adress`, `user_last_name`, `user_first_name`, `user_password`, `user_role`, `user_score`) VALUES
(90, 'Admin', 'Delannoy', 'Dominique', 'motdepasseadmin', 0, 0),
(91, 'hugo.eraud-berthaud@student.junia.com', 'eraud-berthaud', 'hugo', 'default', 1, 0),
(92, 'theo.deloose@student.junia.com', 'deloose', 'theo', 'default', 1, 0),
(93, 'johan.roux@student.junia.com', 'roux', 'johan', 'default', 1, 0),
(94, 'lastname.namee@student.junia.com', 'namee', 'lastname', 'default', 1, 0),
(95, 'ertgt.jledfl@student.junia.com', 'jledfl', 'ertgt', 'default', 1, 0),
(96, 'jilerjf.efghert@student.junia.com', 'efghert', 'jilerjf', 'default', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_answer`
--

DROP TABLE IF EXISTS `user_answer`;
CREATE TABLE IF NOT EXISTS `user_answer` (
  `user_answer_id` int NOT NULL AUTO_INCREMENT,
  `user_answer_query` varchar(1000) NOT NULL,
  `user_answer_text` varchar(50) DEFAULT NULL,
  `user_answer_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `question_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `question_score` int DEFAULT NULL,
  `valide` int DEFAULT NULL,
  `quiz_id` int DEFAULT NULL,
  PRIMARY KEY (`user_answer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=187 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_answer`
--

INSERT INTO `user_answer` (`user_answer_id`, `user_answer_query`, `user_answer_text`, `user_answer_time`, `question_id`, `user_id`, `question_score`, `valide`, `quiz_id`) VALUES
(186, 'SELECT * FROM `type_piece`', 'Requête invalide', '2021-04-23 16:44:00', 1, 90, 0, 0, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
