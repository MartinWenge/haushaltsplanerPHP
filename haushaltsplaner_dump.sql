-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: haushaltsplaner
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
-- Table structure for table `aufgaben`
--

DROP TABLE IF EXISTS `aufgaben`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aufgaben` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(127) NOT NULL,
  `haeufigkeit` varchar(127) DEFAULT NULL,
  `beschreibung` varchar(255) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `aufwand` int(11) DEFAULT NULL,
  `bild` varchar(255) DEFAULT NULL,
  `kategorie` varchar(127) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aufgaben`
--

LOCK TABLES `aufgaben` WRITE;
/*!40000 ALTER TABLE `aufgaben` DISABLE KEYS */;
INSERT INTO `aufgaben` VALUES (1,'Wäsche waschen','alle zwei Tage','Wäsche sortieren, Waschmaschine befüllen, Waschmittel rein und starten',10,15,'figures/aufgabe_waescheWaschen_640.jpg','Wäsche'),(2,'Wäsche trocknen','alle zwei Tage','Wäsche aus der Waschmaschine holen und aufhängen oder im Trockner trocknen',20,30,'figures/aufgabe_waescheTrocknen_640.jpg','Wäsche'),(3,'Wäsche legen','alle zwei Tage','trockene Wäsche legen und in den passenden Schrank einräumen',20,30,'figures/aufgabe_waescheLegen_640.jpg','Wäsche'),(4,'Boden wischen','einmal pro Woche','in allen Zimmer, die es nötig haben, den Boden nass wischen',100,45,'figures/aufgabe_bodenWischen_640.jpg','Putzen'),(5,'Wechselsachen und Windeln in der Kita auffüllen','alle zwei Wochen','Nachschauen, ob im Kindergarten noch genügend passende und dem Wetter angepasste Wechselsachen und falls nötig Windeln da sind. Bei Bedarf auffüllen.',40,20,'figures/aufgabe_wechselsachen_640.jpg','Kinder'),(6,'Wechselsachen in der Schule auffüllen','alle zwei Wochen','Nachschauen, ob in der Schule noch genügend, dem aktuellen Wetter entsprechende Wechselsachen da sind. Bei Bedarf auffüllen.',40,20,'figures/aufgabe_wechselsachen_640.jpg','Kinder');
/*!40000 ALTER TABLE `aufgaben` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-27 20:01:49
