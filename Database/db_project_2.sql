-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 15 avr. 2021 à 15:08
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
-- Structure de la table `equipe`
--

DROP TABLE IF EXISTS `equipe`;
CREATE TABLE IF NOT EXISTS `equipe` (
  `equipe_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipe_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`equipe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `equipe`
--

INSERT INTO `equipe` (`equipe_id`, `equipe_name`) VALUES
(1, 'Admin'),
(2, 'CSI3');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `groupe_id` int(11) NOT NULL AUTO_INCREMENT,
  `groupe_name` varchar(50) DEFAULT NULL,
  `equipe_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`groupe_id`),
  KEY `equipe_id` (`equipe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`groupe_id`, `groupe_name`, `equipe_id`) VALUES
(1, 'Admin', 0),
(2, 'TP1_1', 1),
(3, 'Groupe_45', 1);

-- --------------------------------------------------------

--
-- Structure de la table `part_of`
--

DROP TABLE IF EXISTS `part_of`;
CREATE TABLE IF NOT EXISTS `part_of` (
  `user_id` int(11) NOT NULL,
  `groupe_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`groupe_id`),
  KEY `groupe_id` (`groupe_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_text` varchar(1000) DEFAULT NULL,
  `question_answer` varchar(1000) DEFAULT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_points` int(11) DEFAULT '0',
  PRIMARY KEY (`question_id`),
  KEY `quizz_id` (`quiz_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`question_id`, `question_text`, `question_answer`, `quiz_id`, `question_points`) VALUES
(1, 'Affichez les informations sur les fournisseurs', 'SELECT * FROM `fournisseur` ', 0, 5),
(2, 'Affichez les informations sur les fournisseurs', 'SELECT * FROM `fournisseur` ', 0, 5),
(3, 'Affichez les informations sur les fournisseurs', 'SELECT * FROM `fournisseur` ', 0, 5),
(4, 'Afficher les pièces', 'SELECT * FROM `piece`', 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `quiz_id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_name` varchar(50) DEFAULT NULL,
  `quiz_difficulty` varchar(50) DEFAULT NULL,
  `quiz_description` varchar(1000) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `quiz_database` varchar(50) NOT NULL,
  `quiz_img` varchar(50) NOT NULL,
  PRIMARY KEY (`quiz_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `quiz_name`, `quiz_difficulty`, `quiz_description`, `user_id`, `quiz_database`, `quiz_img`) VALUES
(1, 'Quiz notions base', 'Facile', 'Testez vos connaissances en réalisant des requêtes de base SQL.', 0, 'cycle_v3', ''),
(2, 'Quiz notions base', 'Facile', 'Testez vos connaissances en réalisant des requêtes de base SQL.', 0, 'cycle_v3', ''),
(3, 'Quiz notions base', 'Facile', 'Testez vos connaissances en réalisant des requêtes de base SQL.', 0, 'cycle_v3', ''),
(4, 'Quiz tri de données', 'Moyen', 'Appliquez vos connaissances pour trier d\'informations sélectionnées d\'une base de donnée. ', 0, 'cycle_v3', ''),
(5, 'Quiz avancé', 'Difficile', 'Réalisez des requêtes avancées.', 0, 'cycle_v3', ''),
(6, 'Quiz test', 'Moyen', 'Faites des requêtes SQL avec une étude de cas particulière.', 0, 'cycle_v3', '');

-- --------------------------------------------------------

--
-- Structure de la table `tp`
--

DROP TABLE IF EXISTS `tp`;
CREATE TABLE IF NOT EXISTS `tp` (
  `tp_id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `equipe_id` int(11) NOT NULL,
  PRIMARY KEY (`tp_id`),
  KEY `quiz_id` (`quiz_id`),
  KEY `equipe_id` (`equipe_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  `user_score` int(11) DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_adress`, `user_last_name`, `user_first_name`, `user_password`, `user_role`, `user_score`) VALUES
(0, 'kjekdjezkdjeez', 'Goedert', 'Thibault', 'motdepasse', 0, 152),
(1, 'hafdf', 'Choukhi', 'Imane', '12345', 0, 54),
(2, 'adresse', 'Lala', 'Nono', '0000', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_answer`
--

DROP TABLE IF EXISTS `user_answer`;
CREATE TABLE IF NOT EXISTS `user_answer` (
  `user_answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_answer_text` varchar(50) DEFAULT NULL,
  `user_answer_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `question_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_score` int(11) DEFAULT NULL,
  `valide` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_answer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_answer`
--

INSERT INTO `user_answer` (`user_answer_id`, `user_answer_text`, `user_answer_time`, `question_id`, `user_id`, `question_score`, `valide`, `quiz_id`) VALUES
(8, 'Bonne réponse!', '2021-03-29 11:49:23', 0, 0, 5, 1, 0),
(9, 'Bonne réponse!', '2021-03-29 11:50:12', 0, 0, 5, 1, 0),
(10, 'Requête invalide', '2021-03-29 11:50:43', 0, 0, 0, 0, 0),
(11, 'Requête invalide', '2021-04-02 18:41:34', 0, 0, 0, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
