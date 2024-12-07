-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: haushaltsplaner
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(127) NOT NULL,
  `birthday` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'test','$2y$10$xrubiNriB2PAJgQSdjGILerv9djVUR.6jLtP.B6Pude3yAt0VpRfq','test@test.com','2000-01-01');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aufgaben`
--

DROP TABLE IF EXISTS `aufgaben`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aufgaben` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) NOT NULL,
  `haeufigkeit` int(11) DEFAULT NULL,
  `beschreibung` varchar(255) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `aufwand` int(11) DEFAULT NULL,
  `bild` varchar(255) DEFAULT NULL,
  `kategorie` varchar(127) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aufgaben`
--

LOCK TABLES `aufgaben` WRITE;
/*!40000 ALTER TABLE `aufgaben` DISABLE KEYS */;
INSERT INTO `aufgaben` VALUES (1,'Wäsche waschen',2,'Wäsche sortieren, Waschmaschine befüllen, Waschmittel rein und starten',10,15,'figures/aufgabe_waescheWaschen_640.jpg','Wäsche'),(2,'Wäsche trocknen',2,'Wäsche aus der Waschmaschine holen und aufhängen oder im Trockner trocknen',20,30,'figures/aufgabe_waescheTrocknen_640.jpg','Wäsche'),(3,'Wäsche legen',2,'trockene Wäsche legen und in den passenden Schrank einräumen',20,30,'figures/aufgabe_waescheLegen_640.jpg','Wäsche'),(4,'Boden wischen',4,'in allen Zimmer, die es nötig haben, den Boden nass wischen',100,45,'figures/aufgabe_bodenWischen_640.jpg','Putzen'),(5,'Wechselsachen und Windeln in der Kita auffüllen',5,'Nachschauen, ob in der Kita noch genug Wechselsachen und Windeln da sind, bei Bedarf auffüllen.',40,20,'figures/aufgabe_auffuellenwindeln_640.jpg','Kinder'),(6,'Wechselsachen in der Schule auffüllen',5,'Nachschauen, ob in der Schule noch genug Wechselsachen da sind, bei Bedarf auffüllen.',40,20,'figures/aufgabe_wechselsachen_640.jpg','Kinder'),(7,'Papiermüll wegschaffen',5,'Papiermüll zu Hause sammeln und ins die großen Papiertonnen oder zum Wertstoffhof schaffen',100,60,'figures/aufgabe_papiermuell_640.jpg','Abfall'),(8,'Pfandflaschen wegschaffen',5,'Pfandflaschen (Einweg, Mehrweg) zu Hause sammeln und wegschaffen',100,60,'figures/aufgabe_pfandwegschaffen_640.jpg','Abfall'),(9,'Reifenwechsel',7,'Um Ostern Sommereifen, im Oktober Winterreifen aufs Auto machen.',200,120,'figures/aufgabe_reifenwechsel_640.jpg','Auto'),(10,'Durchsicht',8,'Durchsicht/Hauptuntersuchung im Autohaus machen lassen',200,120,'figures/aufgabe_durchsicht_640.jpg','Auto');
/*!40000 ALTER TABLE `aufgaben` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lookuphaeufigkeit`
--

DROP TABLE IF EXISTS `lookuphaeufigkeit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lookuphaeufigkeit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) NOT NULL,
  `days` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lookuphaeufigkeit`
--

LOCK TABLES `lookuphaeufigkeit` WRITE;
/*!40000 ALTER TABLE `lookuphaeufigkeit` DISABLE KEYS */;
INSERT INTO `lookuphaeufigkeit` VALUES (1,'jeden Tag',1),(2,'alle zwei Tage',2),(3,'alle drei Tage',3),(4,'einmal pro Woche',7),(5,'alle zwei Wochen',14),(6,'einmal im Monat',30),(7,'alle sechs Monate',183),(8,'einmal im Jahr',365);
/*!40000 ALTER TABLE `lookuphaeufigkeit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aufgabenId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `date` varchar(50) DEFAULT NULL,
  `isDone` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,1,1,'2024-11-30',1),(2,1,1,'2024-12-27',0);
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-07 20:44:10
