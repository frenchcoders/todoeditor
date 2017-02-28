-- MySQL dump 10.16  Distrib 10.1.20-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.1.20-MariaDB

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
-- Table structure for table `todoelems`
--

DROP TABLE IF EXISTS `todoelems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `todoelems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `todolist_id` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `todoelems`
--

LOCK TABLES `todoelems` WRITE;
/*!40000 ALTER TABLE `todoelems` DISABLE KEYS */;
INSERT INTO `todoelems` VALUES (13,'Suppressions des éléments de listes des tâches en même temps que la liste des tâches',14,1,1488078145),(14,'Support de la connexion des utilisateurs',14,0,1488078162),(15,'Ajouter le nom de l\'utilisateur qui a crée une liste des tâches à cette liste des tâches ',14,0,1488078188),(16,'Suppression des listes des tâches ',14,1,1488078197),(17,'Suppression des éléments de listes des tâches ',14,1,1488078208),(18,'Modification métadonnées des listes des tâches',14,1,1488078217),(19,'Modification des éléments de liste des tâches ',14,1,1488078230),(20,'Curseur \" pointer \" sur les éléments cliquables',14,1,1488078243),(21,'Titres adaptés dans les barres de titres sur tout le script',14,1,1488078266),(23,'Liste de tâches publiques et privées',14,0,1488078352),(24,'Commentaires sur les éléments de listes de tâches',14,0,1488078400),(25,'Liste de tâches collaboratives / autorisations / invitations',14,0,1488144260),(26,'Possibilité d\'annuler le mode \" modification \" sur les métadonnées de todolists',14,1,1488147083),(27,'Possibilité d\'annuler le mode \" modification \" sur les éléments de listes des tâches',14,1,1488147104),(28,'Bouton de retour à la page principale lors de la modification d\'une todolist',14,1,1488147149),(29,'Compteur du nombre de tâches lors de l\'affichage d\'une todolist',14,0,1488147169),(30,'Reset des champs après la validation de l\'ajout d\'une liste de tâche ou d\'un élément de liste de tâche',14,1,1488147199),(32,'Ancres lors de l\'édition de todolists / d\'éléments de todolists',14,0,1488164386),(33,'Adapter le scroll lors de l\'ajout d\'un élément de todolist',14,1,1488164424),(34,'Désactiver l\'autocomplete sur tous les champs textuels',14,0,1488193458),(44,'Faire clignoter en vert les éléments de liste de tâches nouvellement ajoutés pour les mettre en valeur',14,1,1488210878),(63,'Nettoyer les tables du script des éléments résiduels inutiles',14,1,1488212092),(64,'Scrolltop lors du click sur le bouton \" modifier \" lors de l\'édition des éléments de listes de tâches',14,0,1488212415);
/*!40000 ALTER TABLE `todoelems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `todolists`
--

DROP TABLE IF EXISTS `todolists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `todolists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `timestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `todolists`
--

LOCK TABLES `todolists` WRITE;
/*!40000 ALTER TABLE `todolists` DISABLE KEYS */;
INSERT INTO `todolists` VALUES (14,'Tâches à accomplir en vue de finaliser une première version du script de gestion de listes des tâches','Tâches à accomplir pour améliorer et finaliser le script de gestion de liste de tâches co-écrit par @Thts et @ScorDesigner',1488078109);
/*!40000 ALTER TABLE `todolists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-02-28 15:02:52
