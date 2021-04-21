-- MySQL dump 10.13  Distrib 5.7.31, for Win64 (x86_64)
--
-- Host: localhost    Database: 4a79d4bbb0d34afee090b8ff9b235da30
-- ------------------------------------------------------
-- Server version	5.7.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `equipe`
--

DROP TABLE IF EXISTS `equipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipe` (
  `equipe_id` int(11) NOT NULL,
  `equipe_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`equipe_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipe`
--

LOCK TABLES `equipe` WRITE;
/*!40000 ALTER TABLE `equipe` DISABLE KEYS */;
INSERT INTO `equipe` VALUES (0,'Admin'),(1,'CSI3');
/*!40000 ALTER TABLE `equipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groupe` (
  `groupe_id` int(11) NOT NULL,
  `groupe_name` varchar(50) DEFAULT NULL,
  `equipe_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`groupe_id`),
  KEY `equipe_id` (`equipe_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groupe`
--

LOCK TABLES `groupe` WRITE;
/*!40000 ALTER TABLE `groupe` DISABLE KEYS */;
INSERT INTO `groupe` VALUES (0,'Admin',0),(1,'ModuleX',1),(3,'Groupe_45',1);
/*!40000 ALTER TABLE `groupe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `part_of`
--

DROP TABLE IF EXISTS `part_of`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `part_of` (
  `user_id` int(11) NOT NULL,
  `groupe_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`groupe_id`),
  KEY `groupe_id` (`groupe_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `part_of`
--

LOCK TABLES `part_of` WRITE;
/*!40000 ALTER TABLE `part_of` DISABLE KEYS */;
INSERT INTO `part_of` VALUES (0,0),(1,1),(3,1);
/*!40000 ALTER TABLE `part_of` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `question_intitule` varchar(50) NOT NULL,
  `question_text` varchar(1000) DEFAULT NULL,
  `question_answer` varchar(1000) DEFAULT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_points` int(11) DEFAULT '0',
  PRIMARY KEY (`question_id`),
  KEY `quizz_id` (`quiz_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (0,'question 1','Affichez les informations sur les fournisseurs','SELECT * FROM `fournisseur` ',0,5),(1,'question 2','Afficher les pièces','SELECT * FROM `piece`',0,3);
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz` (
  `quiz_id` int(11) NOT NULL,
  `quiz_name` varchar(50) DEFAULT NULL,
  `quiz_difficulty` varchar(50) DEFAULT NULL,
  `quiz_description` varchar(1000) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `quiz_database` varchar(50) NOT NULL,
  `quiz_img` varchar(50) NOT NULL,
  PRIMARY KEY (`quiz_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz`
--

LOCK TABLES `quiz` WRITE;
/*!40000 ALTER TABLE `quiz` DISABLE KEYS */;
INSERT INTO `quiz` VALUES (0,'Quiz notions base','Facile','Testez vos connaissances en réalisant des requêtes de base SQL.',0,'cycle_v3',''),(1,'Quiz tri de données','Moyen','Appliquez vos connaissances pour trier d\'informations sélectionnées d\'une base de donnée. ',0,'cycle_v3',''),(2,'Quiz avancé','Difficile','Réalisez des requêtes avancées.',0,'cycle_v3',''),(3,'Quiz test','Moyen','Faites des requêtes SQL avec une étude de cas particulière.',0,'cycle_v3','');
/*!40000 ALTER TABLE `quiz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tp`
--

DROP TABLE IF EXISTS `tp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tp` (
  `tp_id` int(11) NOT NULL AUTO_INCREMENT,
  `tp_name` varchar(50) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `equipe_id` int(11) NOT NULL,
  PRIMARY KEY (`tp_id`),
  KEY `quiz_id` (`quiz_id`),
  KEY `equipe_id` (`equipe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp`
--

LOCK TABLES `tp` WRITE;
/*!40000 ALTER TABLE `tp` DISABLE KEYS */;
INSERT INTO `tp` VALUES (29,'TP0',3,0),(27,'TP9',0,0),(28,'TP3',1,1),(30,'TP22',1,0);
/*!40000 ALTER TABLE `tp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_answer`
--

DROP TABLE IF EXISTS `user_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_answer` (
  `user_answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_answer_query` varchar(1000) NOT NULL,
  `user_answer_text` varchar(50) DEFAULT NULL,
  `user_answer_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `question_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_score` int(11) DEFAULT NULL,
  `valide` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_answer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_answer`
--

LOCK TABLES `user_answer` WRITE;
/*!40000 ALTER TABLE `user_answer` DISABLE KEYS */;
INSERT INTO `user_answer` VALUES (82,'xczzzzzzzzzzz','Requête invalide','2021-04-21 16:43:58',0,0,0,0,0),(81,'SELECT `user_last_name` FROM `users` WHERE `user_id`= 0','Requête invalide','2021-04-21 16:34:18',1,0,0,0,0),(80,'th','Requête invalide','2021-04-21 16:34:11',0,0,0,0,0),(79,'','Requête invalide','2021-04-21 16:29:42',1,0,0,0,0),(78,'','Requête invalide','2021-04-21 16:29:26',0,0,0,0,0),(77,'','Requête invalide','2021-04-21 16:27:29',1,0,0,0,0),(76,'SELECT * FROM `type_piece`','Requête valide','2021-04-21 16:27:01',0,0,5,1,0),(75,'SELECT * FROM `type_piece`','Requête valide','2021-04-21 16:26:49',1,0,3,1,0),(74,'','Requête invalide','2021-04-21 16:22:34',0,0,0,0,0),(73,'nonnnnnnnnnnnn','Requête invalide','2021-04-21 16:22:23',1,0,0,0,0),(72,'ouiiiiiiiiiiii','Requête invalide','2021-04-21 16:22:13',0,0,0,0,0);
/*!40000 ALTER TABLE `user_answer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_adress` varchar(50) DEFAULT NULL,
  `user_last_name` varchar(50) NOT NULL,
  `user_first_name` varchar(50) NOT NULL,
  `user_password` varchar(50) DEFAULT NULL,
  `user_role` tinyint(4) DEFAULT NULL,
  `user_score` int(11) DEFAULT '0',
  `user_group` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (0,'kjekdjezkdjeez','Goedert','Thibault','motdepasse',0,178,0),(1,'hafdf','Choukhi','Imane','12345',0,54,1),(2,'adresse','Lala','Nono','0000',1,0,1),(3,'adresse','Hello','Name ','12345',1,0,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-22  1:10:48
