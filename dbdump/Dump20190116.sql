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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `service_title` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (0,'All products','all','2019-01-11 22:20:15',NULL),(1,'Headsets','headset','2019-01-03 22:47:56',NULL),(2,'RAM','ram','2019-01-03 22:49:13',NULL),(3,'Monitors','monitor','2019-01-03 22:51:58',NULL),(4,'Keyboards','keyboard','2019-01-03 22:51:58',NULL),(5,'Motherboards','motherboard','2019-01-03 22:51:58',NULL),(6,'Mouses','mouse','2019-01-03 22:51:58',NULL),(7,'Processors','processor','2019-01-03 22:51:58',NULL),(8,'Video cards','videocard','2019-01-03 22:51:58',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `personal_id` int(11) NOT NULL,
  `total_price` varchar(20) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT 'New',
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orders_personal_idx` (`personal_id`),
  KEY `fk_orders_user_idx` (`user_id`),
  CONSTRAINT `fk_orders_personal` FOREIGN KEY (`personal_id`) REFERENCES `users_personal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (2,1,'3000','New',10,'2019-01-08 11:10:50',NULL),(3,1,'123123','New',10,'2019-01-08 11:12:45',NULL),(7,12,'7998','New',NULL,'2019-01-15 15:29:35',NULL),(8,13,'6207','New',NULL,'2019-01-15 15:31:24',NULL),(9,14,'6207','New',NULL,'2019-01-15 15:33:00',NULL),(10,15,'6207','New',NULL,'2019-01-15 15:34:40',NULL),(11,16,'30580','New',NULL,'2019-01-15 15:38:03',NULL),(12,17,'3999','New',NULL,'2019-01-16 14:37:19',NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_delivery`
--

DROP TABLE IF EXISTS `orders_delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_delivery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL DEFAULT 'Courier',
  `date` varchar(45) NOT NULL DEFAULT 'None',
  `time` varchar(45) NOT NULL DEFAULT 'None',
  `order_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orders_delivery_order_idx` (`order_id`),
  CONSTRAINT `fk_orders_delivery_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_delivery`
--

LOCK TABLES `orders_delivery` WRITE;
/*!40000 ALTER TABLE `orders_delivery` DISABLE KEYS */;
INSERT INTO `orders_delivery` VALUES (1,'Courier','2010-01-10','10-18',2,'2019-01-08 13:04:21',NULL),(4,'Courier','None','None',3,'2019-01-15 15:15:46',NULL),(6,'Courier','None','None',7,'2019-01-15 15:29:35',NULL),(7,'Courier','None','None',8,'2019-01-15 15:31:24',NULL),(8,'Courier','None','None',9,'2019-01-15 15:33:01',NULL),(9,'Courier','None','None',10,'2019-01-15 15:34:40',NULL),(10,'Courier','None','None',11,'2019-01-15 15:38:03',NULL),(11,'Courier','None','None',12,'2019-01-16 14:37:19',NULL);
/*!40000 ALTER TABLE `orders_delivery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_products`
--

DROP TABLE IF EXISTS `orders_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `endprice` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orders_products_order_idx` (`order_id`),
  KEY `fk_orders_products_product_idx` (`product_id`),
  CONSTRAINT `fk_orders_products_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_products_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_products`
--

LOCK TABLES `orders_products` WRITE;
/*!40000 ALTER TABLE `orders_products` DISABLE KEYS */;
INSERT INTO `orders_products` VALUES (1,2,50,2,'0','2019-01-08 11:32:15',NULL),(2,2,54,4,'0','2019-01-08 11:32:15',NULL),(3,3,48,45,'0','2019-01-08 17:16:59',NULL),(4,3,49,23,'0','2019-01-08 17:16:59',NULL),(5,11,54,2,'30580','2019-01-15 15:38:03',NULL),(6,12,45,1,'3999','2019-01-16 14:37:19',NULL);
/*!40000 ALTER TABLE `orders_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) CHARACTER SET latin1 NOT NULL,
  `service_title` varchar(45) CHARACTER SET latin1 NOT NULL,
  `warranty` varchar(45) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `description` text,
  `category_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_products_category_idx` (`category_id`),
  CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (45,'Intel Core i3','corei3','3 years','Неплохой 4-х ядерный процессор','Новый процессор Intel Core i3-7100 7-го поколения, с кодовым названием микроархитектуры Kaby Lake. Предназначен для настольной платформы Intel LGA 1151.\n\nIntel Core i3-7100 производится по стандарту 14-нм техпроцесса, имеет 2 ядра, которые работают в 4 потока на штатной тактовой частоте 3.9 ГГц. Объем кэш-памяти 3 уровня равен 3 МБ. Имеет 2-х канальный контроллер памяти DDR4 / DDR3L.\n\nВысокая скорость, которая вам действительно необходима\nМощные быстродействующие процессоры Intel Core 7-го поколения с малым временем отклика способны удовлетворить всем вашим потребностям. Открывайте файлы и программы быстро, переключайтесь между приложениями и веб-страницами без задержек.\n\nРазвлечения с эффектом погружения\nОцените ультравысокую четкость воспроизведения контента, чистоту и резкость изображения в разрешении 4K. Благодаря увеличенному в 4 раза по сравнению с экранами Full HD количеству точек вы получите более четкие и чистые изображения и как никогда полный эффект присутствия.',7,'2019-01-04 17:36:27',NULL),(46,'Intel Core i5','corei5','3 years','Хороший 4-х ядерный процессор','Intel Core i5-7640X — младший процессор для настольной платформы Intel LGA 2066. Данный процессор имеет 4 ядра, которые работают на штатной тактовой частоте 4.0 ГГц, и 4.2 ГГц в режиме Turbo Boost. Из особенностей стоит выделить 2-х кaнaльный контроллер пaмяти DDR4 и рaзблокировaнный множитель. Процессор Intel Core i5 справится с самыми ресурсоемкими задачами – вы увидите и ощутите разницу при просмотре контента в формате HD или 3D, работе в многозадачном режиме или при воспроизведении мультимедиа. Процессор Intel Core i5 содержит передовые технологии, которые обеспечивают более быструю и плавную работу, а также более широкие возможности и качество изображения при выполнении всех ваших любимых ресурсоемких задач – от редактирования фильмов до самых захватывающих игр.',7,'2019-01-04 17:38:47',NULL),(47,'Intel Core i7','corei7','3 years','Отличный 4-х ядерный процессор','Новый процессор Intel Core i7-8700K 8-го поколения, с кодовым названием микроархитектуры Coffee Lake. Предназначен для настольной платформы Intel LGA 1151. Принадлежит к семейству высокопроизводительных процессоров Core i7. Intel Core i7-8700K производится по стандарту 14-нм техпроцесса, имеет 6 ядер, которые работают в 12 потоков со штатной тактовой частотой 3.7 ГГц, 4.7 ГГц в режиме Turbo Boost. Объем кэш-памяти 3 уровня равен 12 МБ. Имеет 2-х канальный контроллер памяти DDR4.',7,'2019-01-04 17:39:32',NULL),(48,'Intel Core i9','corei9','3 years','Отличный 4-х ядерный процессор','Процессор INTEL Core™ i9 9900K (BX80684I99900K) с кодовым названием микроархитектуры Coffee Lake-S Refresh. Предназначен для настольной платформы Intel LGA 1151. Принадлежит к семейству высокопроизводительных процессоров Core i9. Процессор INTEL Core™ i9 9900K производится по стандарту 14-нм техпроцесса, имеет 8 ядер, которые работают в 14 потоков со штатной тактовой частотой 3.6 ГГц, 5.0 ГГц в режиме Turbo Boost. Объем кэш-памяти 3 уровня равен 14 МБ. Имеет 2-х канальный контроллер памяти DDR4.',7,'2019-01-04 17:40:31',NULL),(49,'AMD Ryzen 5 2600X','ryzen5','5 years','Отличный 6-и ядерный процессор','Особенности микроархитектуры Zen В новой архитектуре AMD Zen используется мощный механизм исполнения, а также поддерживается функция одновременной многопоточности (SMT). Ядра Zen разработаны для эффективного использования имеющихся ресурсов микроархитектуры для обеспечения максимальной вычислительной производительности. Новая трехуровневая кэш-память с низкой задержкой и новые алгоритмы предварительной выборки значительно уменьшают количество кэш-промахов и увеличивают пропускную способность по сравнению с предыдущей микроархитектурой. Производительность и эффективность для приложений следующего поколения Облачные вычисления, производительность промышленного уровня, технологии виртуальной реальности, игры и безопасность данных открывают новые горизонты и требуют более высокого уровня производительности вычислений при максимальной энергоэффективности. Изначально инженеры компании AMD разработали новую архитектуру Zen таким образом, чтобы она могла соответствовать и даже превосходить высокие требования, касающиеся производительности и эффективности, не только приложений следующего, но и дальнейших поколений.',7,'2019-01-04 17:41:39',NULL),(50,'AMD Ryzen 7 1700','ryzen7','5 years','Отличный 8-и ядерный процессор','Особенности: Два потока на ядро Частота 3.0/3.7 ГГц 16 МБ общей кэш-памяти третьего уровня Большая унифицированная кэш-память второго уровня Кэш декодированных инструкций Два блока со стандартом шифрования AES для обеспечения безопасности Высокоэффективные FinFET-транзисторы',7,'2019-01-04 17:43:32',NULL),(52,'A4Tech Bloody V7M USB Black','a4techv7m','1 year','﻿Отличная компьютерная мышь','Bloody V7M представляет собой мышь с высоким разрешением и высокочувствительным оптическим сенсором 200 — 3200 DPI. \nБлагодаря металлическим ножкам мышь отлично скользит по всем видам игровых поверхностей. Игровые мыши Bloody — это сочитание передовых технологий и креативного дизайна. \nЧтобы бороться против сильного противника с большим арсеналом, выбирайте мыши Bloody. Инновационная технология Holeless с двумя оптическими линзами, делает курсор Bloody четче остальных мышей в 54 раза, фильтрует нежелательный свет, исключает попадание пыли или жидкости внутрь устройства. Три уникальных режима стрельбы обеспечат полный комфорт и абсолютную точность действий в игре: Кнопка 1 — Красный режим для левой кнопки — однократный выстрел Кнопка N — Зеленый режим для непрекращающейся очереди из выстрелов Кнопка 3 — желтый режим для левой кнопки — троекратный выстрел для абсолютной победы над врагом',6,'2019-01-04 17:47:55',NULL),(53,'Asus PCI-Ex GeForce GTX 1050 Ti','gtx1050ti','3 years','﻿﻿Отличная видео карта','OASUS Cerberus GeForce GTX 1050 Ti — це високопродуктивна графічна карта, яка спроектована з підвищеною надійністю й ігровою продуктивністю. Asus тестує карти максимально з новітніми іграми та здійснює великі випробування надійності та порівняльний аналіз із великим навантаженням у 15 разів довше, ніж зазвичай.',8,'2019-01-04 17:51:00',NULL),(54,'Monitor 27\" MSI Optix MAG27C','opticmag27c','1 year','﻿﻿﻿Отличный 144Гц монитор','Optix MAG24C – это игровой монитор с изогнутым экраном, обладающий VA-матрицей с низким временем отклика (1 мс) и повышенной частотой обновления (144 Гц). Воплощая в себе самые современные технологии, включая адаптивную синхронизацию Adaptive Sync, эта модель будет прекрасным выбором для компьютерных игр, в том числе соревновательных.',3,'2019-01-04 17:52:00',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_availability`
--

DROP TABLE IF EXISTS `products_availability`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products_availability` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_products_availability_product_idx` (`product_id`),
  CONSTRAINT `fk_products_availability_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_availability`
--

LOCK TABLES `products_availability` WRITE;
/*!40000 ALTER TABLE `products_availability` DISABLE KEYS */;
INSERT INTO `products_availability` VALUES (1,45,3999,0,'2019-01-06 16:21:15',NULL),(2,46,7099,0,'2019-01-06 16:21:15',NULL),(3,47,12250,0,'2019-01-06 16:21:15',NULL),(4,48,19316,0,'2019-01-06 16:21:15',NULL),(5,49,7788,0,'2019-01-06 16:21:15',NULL),(6,50,7517,0,'2019-01-06 16:21:15',NULL),(7,52,649,0,'2019-01-06 16:21:15',NULL),(8,53,6207,0,'2019-01-06 16:21:15',NULL),(9,54,15290,0,'2019-01-06 16:21:15',NULL);
/*!40000 ALTER TABLE `products_availability` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(45) CHARACTER SET utf8 NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (10,'Igrec','$2y$10$zrf9CHyv3jaUwRscPM58suDcTsEa0f.TDeQL1NBVby.SNSchpWjRS','asdsadasd@mail.ru','2019-01-07 11:28:52',NULL),(11,'asdsadsad','$2y$10$87CCBWw9IjsIbequPUM3reNCeFSaCA3VldKRr4j/tZ9vwIRF36ate','asdasdasd@mail.ru','2019-01-07 11:56:58',NULL),(12,'admin','$2y$10$rTeQp1sdfmwO4M.CyYzNQ.Ivv1RweqbHvH2ePlHnDr/v5w5FsCLxa','admin@gmail.com','2019-01-07 15:57:36',NULL),(13,'asdsadasd','$2y$10$80Gz0U8jBCPueJcgUZt8o.fMH4rKWuK/GRA1a9T2BG16bDHLMtdfO','asdasdasd@gmail.com','2019-01-07 19:44:13',NULL),(14,'admincheg','$2y$10$iS5Vd.41bBQpbvOlCke0CesiaBAnWA5dajAcR8hQ4iaVnfcEbMa6S','dsa@mail.ru','2019-01-09 17:38:16',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_addresses`
--

DROP TABLE IF EXISTS `users_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `apartments_numbers` varchar(45) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `personal_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_addresses_personal_idx` (`personal_id`),
  CONSTRAINT `fk_users_addresses_personal` FOREIGN KEY (`personal_id`) REFERENCES `users_personal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_addresses`
--

LOCK TABLES `users_addresses` WRITE;
/*!40000 ALTER TABLE `users_addresses` DISABLE KEYS */;
INSERT INTO `users_addresses` VALUES (1,'Kharkov','ul. Severina Potockogo','32-148','1',1,'2019-01-08 13:07:07',NULL),(3,'Kyiv','st Chepakabru','39b-2-34','1',1,'2019-01-08 14:55:22',NULL),(4,'sadsad','sadasd','213-323','',13,'2019-01-15 15:31:24',NULL),(5,'sadasd','sadsd','123-2323','',14,'2019-01-15 15:33:00',NULL),(6,'sdadsa','21312sadsad','dsadas','',15,'2019-01-15 15:34:40',NULL),(7,'sadasd','sadsad','213123','',16,'2019-01-15 15:38:03',NULL),(8,'Kharkov','severinz potockogo','32-148','61115',17,'2019-01-16 14:37:19',NULL);
/*!40000 ALTER TABLE `users_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_personal`
--

DROP TABLE IF EXISTS `users_personal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_personal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(45) CHARACTER SET utf8 NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(45) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_person_user_idx` (`user_id`),
  CONSTRAINT `fk_users_person_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_personal`
--

LOCK TABLES `users_personal` WRITE;
/*!40000 ALTER TABLE `users_personal` DISABLE KEYS */;
INSERT INTO `users_personal` VALUES (1,'Ihor','Kruhliak','380965412175','id.igrec@gmail.com',10,'2019-01-08 11:09:57',NULL),(12,'sadasd','sadasdas','213123121','',NULL,'2019-01-15 15:29:35',NULL),(13,'Firts','ASD','123213123','',NULL,'2019-01-15 15:31:24',NULL),(14,'sssssss','sssssssss','21312312213','',NULL,'2019-01-15 15:33:00',NULL),(15,'sadsad','sadsadsad','213123213123','',NULL,'2019-01-15 15:34:40',NULL),(16,'First','Last','095213213','',NULL,'2019-01-15 15:38:03',NULL),(17,'Ihorka','Kruhliak','0965412175','mail@mail.ru',NULL,'2019-01-16 14:37:19',NULL);
/*!40000 ALTER TABLE `users_personal` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-16 16:41:12
