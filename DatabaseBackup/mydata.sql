-- MySQL dump 10.13  Distrib 5.7.31, for Win64 (x86_64)
--
-- Host: localhost    Database: db_project
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
  `equipe_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipe_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`equipe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipe`
--

LOCK TABLES `equipe` WRITE;
/*!40000 ALTER TABLE `equipe` DISABLE KEYS */;
INSERT INTO `equipe` VALUES (1,'Admin'),(2,'CSI3');
/*!40000 ALTER TABLE `equipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groupe` (
  `groupe_id` int(11) NOT NULL AUTO_INCREMENT,
  `groupe_name` varchar(50) DEFAULT NULL,
  `equipe_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`groupe_id`),
  KEY `equipe_id` (`equipe_id`)
) ENGINE=MyISAM AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groupe`
--

LOCK TABLES `groupe` WRITE;
/*!40000 ALTER TABLE `groupe` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `part_of` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_libele` varchar(255) NOT NULL,
  `question_text` varchar(1000) DEFAULT NULL,
  `question_answer` varchar(1000) DEFAULT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_points` int(11) DEFAULT '0',
  PRIMARY KEY (`question_id`),
  KEY `quizz_id` (`quiz_id`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (1,'','Affichez les informations sur les fournisseurs','SELECT * FROM `fournisseur` ',1,5),(2,'','Affichez les informations sur les fournisseurs','SELECT * FROM `fournisseur` ',1,5),(3,'','Affichez les informations sur les fournisseurs','SELECT * FROM `fournisseur` ',1,5),(4,'','Afficher les pièces','SELECT * FROM `piece`',1,3),(70,'Test3_Question10','Intitulé_Question10','Reponse_Question10',33,1),(69,'Test3_Question9','Intitulé_Question9','Reponse_Question9',33,1),(68,'Test3_Question8','Intitulé_Question8','Reponse_Question8',33,1),(67,'Test3_Question7','Intitulé_Question7','Reponse_Question7',33,1),(66,'Test3_Question6','Intitulé_Question6','Reponse_Question6',33,1),(65,'Test3_Question5','Intitulé_Question5','Reponse_Question5',33,1),(64,'Test3_Question4','Intitulé_Question4','Reponse_Question4',33,1),(63,'Test3_Question3','Intitulé_Question3','Reponse_Question3',33,1),(62,'Test3_Question2','Intitulé_Question2','Reponse_Question2',33,1),(61,'﻿Test3_Question1','Intitulé_Question1','Reponse_Question1',33,1),(60,'Test3_Question10','Intitulé_Question10','Reponse_Question10',32,1),(59,'Test3_Question9','Intitulé_Question9','Reponse_Question9',32,1),(58,'Test3_Question8','Intitulé_Question8','Reponse_Question8',32,1),(57,'Test3_Question7','Intitulé_Question7','Reponse_Question7',32,1),(56,'Test3_Question6','Intitulé_Question6','Reponse_Question6',32,1),(55,'Test3_Question5','Intitulé_Question5','Reponse_Question5',32,1),(54,'Test3_Question4','Intitulé_Question4','Reponse_Question4',32,1),(53,'Test3_Question3','Intitulé_Question3','Reponse_Question3',32,1),(52,'Test3_Question2','Intitulé_Question2','Reponse_Question2',32,1),(51,'﻿Test3_Question1','Intitulé_Question1','Reponse_Question1',32,1),(71,'﻿Test3_Question1','Intitulé_Question1','Reponse_Question1',34,1),(72,'Test3_Question2','Intitulé_Question2','Reponse_Question2',34,1),(73,'Test3_Question3','Intitulé_Question3','Reponse_Question3',34,1),(74,'Test3_Question4','Intitulé_Question4','Reponse_Question4',34,1),(75,'Test3_Question5','Intitulé_Question5','Reponse_Question5',34,1),(76,'Test3_Question6','Intitulé_Question6','Reponse_Question6',34,1),(77,'Test3_Question7','Intitulé_Question7','Reponse_Question7',34,1),(78,'Test3_Question8','Intitulé_Question8','Reponse_Question8',34,1),(79,'Test3_Question9','Intitulé_Question9','Reponse_Question9',34,1),(80,'Test3_Question10','Intitulé_Question10','Reponse_Question10',34,1);
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz` (
  `quiz_id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_name` varchar(50) DEFAULT NULL,
  `quiz_difficulty` varchar(50) DEFAULT NULL,
  `quiz_description` varchar(1000) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `quiz_database` varchar(50) NOT NULL,
  `quiz_img` varchar(50) NOT NULL,
  PRIMARY KEY (`quiz_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz`
--

LOCK TABLES `quiz` WRITE;
/*!40000 ALTER TABLE `quiz` DISABLE KEYS */;
INSERT INTO `quiz` VALUES (1,'Quiz notions base','Facile','Testez vos connaissances en réalisant des requêtes de base SQL.',0,'cycle_v3',''),(2,'Quiz notions base','Facile','Testez vos connaissances en réalisant des requêtes de base SQL.',0,'cycle_v3',''),(3,'Quiz notions base','Facile','Testez vos connaissances en réalisant des requêtes de base SQL.',0,'cycle_v3','');
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
  `quiz_id` int(11) NOT NULL,
  `equipe_id` int(11) NOT NULL,
  PRIMARY KEY (`tp_id`),
  KEY `quiz_id` (`quiz_id`),
  KEY `equipe_id` (`equipe_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tp`
--

LOCK TABLES `tp` WRITE;
/*!40000 ALTER TABLE `tp` DISABLE KEYS */;
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
  `user_answer_text` varchar(50) DEFAULT NULL,
  `user_answer_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `question_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_score` int(11) DEFAULT NULL,
  `valide` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_answer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_answer`
--

LOCK TABLES `user_answer` WRITE;
/*!40000 ALTER TABLE `user_answer` DISABLE KEYS */;
INSERT INTO `user_answer` VALUES (8,'Bonne réponse!','2021-03-29 11:49:23',5,0,5,1,2),(9,'Bonne réponse!','2021-03-29 11:50:12',6,0,5,1,2),(10,'Requête invalide','2021-03-29 11:50:43',7,0,0,0,2),(11,'Requête invalide','2021-04-02 18:41:34',8,0,0,0,2),(12,'Requête invalide','2021-04-15 17:43:53',0,0,0,0,1),(13,'Requête invalide','2021-04-15 17:44:32',0,0,0,0,1),(14,'Requête invalide','2021-04-15 17:45:41',0,0,0,0,1),(15,'Requête invalide','2021-04-19 18:17:22',0,0,0,0,2),(16,'Requête invalide','2021-04-19 18:17:26',1,0,0,0,2),(17,'Requête invalide','2021-04-20 13:44:24',0,0,0,0,1),(18,'Requête invalide','2021-04-20 13:48:32',0,0,0,0,1),(19,'Requête invalide','2021-04-20 13:48:35',1,0,0,0,1),(20,'Requête invalide','2021-04-20 13:48:37',2,0,0,0,1),(21,'Requête invalide','2021-04-20 13:48:40',3,0,0,0,1),(22,'Requête invalide','2021-04-20 13:52:23',4,0,0,0,1),(23,'Requête invalide','2021-04-20 13:52:30',3,0,0,0,1);
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
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (0,'y','Goedert','Thibault','y',0,152),(1,'hafdf','Choukhi','Imane','12345',0,54),(2,'adresse','Lala','Nono','0000',1,0),(95,'lmane.choukhi@student.junia.com','choukhi','lmane','default',1,0),(94,'hugo.eraud-berthaud@student.junia.com','eraud-berthaud','hugo','default',1,0),(96,'thibault.goedert@student.junia.com','goedert','thibault','default',1,0),(97,'erwin.tayem@student.junia.com','tayem','erwin','default',1,0);
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

-- Dump completed on 2021-04-20 21:43:10
