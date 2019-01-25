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
-- Table structure for table `products_characteristics`
--

DROP TABLE IF EXISTS `products_characteristics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_characteristics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `characteristic_id` int(11) NOT NULL,
  `value` varchar(45) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_products_characteristics_product_idx` (`product_id`),
  KEY `fk_products_characteristics_characteristic_idx` (`characteristic_id`),
  CONSTRAINT `fk_products_characteristics_characteristic` FOREIGN KEY (`characteristic_id`) REFERENCES `categories_characteristics` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_characteristics_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_characteristics`
--

LOCK TABLES `products_characteristics` WRITE;
/*!40000 ALTER TABLE `products_characteristics` DISABLE KEYS */;
INSERT INTO `products_characteristics` VALUES (1,45,1,'4','2019-01-06 13:01:44',NULL),(2,45,2,'Seven','2019-01-06 13:01:44',NULL),(3,45,3,'s1151','2019-01-06 13:01:44',NULL),(4,45,4,'Intel UHD 630','2019-01-06 13:01:44',NULL),(6,46,1,'4','2019-01-06 13:07:25',NULL),(7,46,2,'Seven','2019-01-06 13:07:25',NULL),(8,46,3,'s1151','2019-01-06 13:07:25',NULL),(9,46,4,'Intel UHD 630','2019-01-06 13:07:25',NULL),(11,47,1,'4','2019-01-06 13:07:58',NULL),(12,47,2,'Seven','2019-01-06 13:07:58',NULL),(13,47,3,'s1151','2019-01-06 13:07:58',NULL),(14,47,4,'Intel UHD 630','2019-01-06 13:07:58',NULL),(16,48,1,'18','2019-01-06 13:08:51',NULL),(17,48,2,'Six','2019-01-06 13:08:51',NULL),(18,48,3,'s1151','2019-01-06 13:08:51',NULL),(19,48,4,'Intel UHD 630','2019-01-06 13:08:51',NULL),(21,49,1,'6','2019-01-06 13:10:27',NULL),(22,49,2,'First','2019-01-06 13:10:27',NULL),(23,49,3,'AM4','2019-01-06 13:10:27',NULL),(24,49,4,'No','2019-01-06 13:10:27',NULL),(26,50,1,'8','2019-01-06 13:10:44',NULL),(27,50,2,'First','2019-01-06 13:10:44',NULL),(28,50,3,'AM4','2019-01-06 13:10:44',NULL),(29,50,4,'No','2019-01-06 13:10:44',NULL),(31,52,6,'8','2019-01-06 13:13:18',NULL),(32,52,7,'USB','2019-01-06 13:13:18',NULL),(33,52,8,'Black','2019-01-06 13:13:18',NULL),(34,52,9,'Windows','2019-01-06 13:13:18',NULL),(36,54,11,'27\"','2019-01-06 13:14:46',NULL),(37,54,12,'144Hz','2019-01-06 13:14:46',NULL),(38,54,13,'1ms','2019-01-06 13:14:46',NULL),(39,54,14,'178°','2019-01-06 13:14:46',NULL),(41,53,16,'4 GB','2019-01-06 13:25:41',NULL),(42,53,17,'GDDR5','2019-01-06 13:25:41',NULL),(43,53,18,'Dual fan','2019-01-06 13:25:41',NULL),(44,53,19,'7680x4320','2019-01-06 13:25:41',NULL);
/*!40000 ALTER TABLE `products_characteristics` ENABLE KEYS */;
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
