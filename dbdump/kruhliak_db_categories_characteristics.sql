-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: localhost    Database: kruhliak_db
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.18.04.1

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
-- Table structure for table `categories_characteristics`
--

DROP TABLE IF EXISTS `categories_characteristics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories_characteristics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_categories_characteristics_category_idx` (`category_id`),
  CONSTRAINT `fk_categories_characteristics_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories_characteristics`
--

LOCK TABLES `categories_characteristics` WRITE;
/*!40000 ALTER TABLE `categories_characteristics` DISABLE KEYS */;
INSERT INTO `categories_characteristics` VALUES (1,'# of cores',7,'2019-01-04 12:47:50',NULL),(2,'Generation',7,'2019-01-04 12:47:50',NULL),(3,'Socket type',7,'2019-01-04 12:47:50',NULL),(4,'Integrated GPU',7,'2019-01-04 12:47:50',NULL),(6,'# of buttons',6,'2019-01-04 12:49:12',NULL),(7,'Interface',6,'2019-01-04 12:49:12',NULL),(8,'Color',6,'2019-01-04 12:49:12',NULL),(9,'OS compatible',6,'2019-01-04 12:49:12',NULL),(11,'Inches',3,'2019-01-04 12:50:15',NULL),(12,'Refresh rate',3,'2019-01-04 12:50:15',NULL),(13,'Response time',3,'2019-01-04 12:50:15',NULL),(14,'View angle',3,'2019-01-04 12:50:15',NULL),(16,'Memory value',8,'2019-01-04 12:51:41',NULL),(17,'Memory type',8,'2019-01-04 12:51:41',NULL),(18,'Cooling system',8,'2019-01-04 12:51:41',NULL),(19,'Maximum resolution',8,'2019-01-04 12:51:41',NULL);
/*!40000 ALTER TABLE `categories_characteristics` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-23 18:44:26
