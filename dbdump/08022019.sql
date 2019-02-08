-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: kruhliak_db
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(45) CHARACTER SET utf8 NOT NULL,
  `role` varchar(45) CHARACTER SET utf8 NOT NULL DEFAULT 'secondary',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'mainadmin','$2y$10$JeqN3LCisV3WRpP6g0/OvuosVp8kVhrzA4IfH.8l4RTPiwGHhCbLy','main@admin.com','main','2019-01-25 16:40:38',NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) CHARACTER SET utf8 NOT NULL,
  `service_title` varchar(45) CHARACTER SET utf8 NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (0,'All products','all','2019-01-11 22:20:15',NULL),(3,'Monitors','monitor','2019-01-03 22:51:58','2019-02-05 14:46:31'),(5,'Motherboards','motherboard','2019-01-03 22:51:58','2019-02-05 14:46:28'),(6,'Mouses','mouse','2019-01-03 22:51:58',NULL),(7,'Processors','processor','2019-01-03 22:51:58','2019-01-26 16:44:04'),(8,'Video cards','videocard','2019-01-03 22:51:58','2019-01-29 14:05:44'),(29,'Headsets','headset','2019-01-26 11:40:44',NULL),(31,'SSD','ssd','2019-01-28 18:53:51','2019-01-29 13:05:51'),(35,'RAM','ram','2019-01-29 13:28:52',NULL),(36,'Keyboards','keyboard','2019-02-04 11:49:00',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories_characteristics`
--

LOCK TABLES `categories_characteristics` WRITE;
/*!40000 ALTER TABLE `categories_characteristics` DISABLE KEYS */;
INSERT INTO `categories_characteristics` VALUES (1,'# of cores',7,'2019-01-04 12:47:50',NULL),(2,'Generation',7,'2019-01-04 12:47:50',NULL),(3,'Socket type',7,'2019-01-04 12:47:50',NULL),(4,'Integrated GPU',7,'2019-01-04 12:47:50',NULL),(8,'Color',6,'2019-01-04 12:49:12',NULL),(9,'OS compatible',6,'2019-01-04 12:49:12',NULL),(11,'Inches',3,'2019-01-04 12:50:15','2019-02-04 11:59:45'),(12,'Refresh rate',3,'2019-01-04 12:50:15',NULL),(13,'Response time',3,'2019-01-04 12:50:15','2019-01-29 17:06:18'),(14,'View angle',3,'2019-01-04 12:50:15','2019-01-30 14:19:33'),(16,'Memory value',8,'2019-01-04 12:51:41',NULL),(17,'Memory type',8,'2019-01-04 12:51:41',NULL),(18,'Cooling system',8,'2019-01-04 12:51:41',NULL),(19,'Maximum resolution',8,'2019-01-04 12:51:41',NULL),(20,'# of buttons',6,'2019-01-28 16:56:59','2019-01-28 16:57:53'),(21,'Interface',6,'2019-01-28 17:02:09',NULL),(22,'Capacity',31,'2019-01-28 18:54:32','2019-01-29 17:03:53'),(23,'Write speed',31,'2019-01-28 18:54:56','2019-01-29 17:03:53'),(24,'Read speed',31,'2019-01-28 18:55:04','2019-01-29 17:03:54'),(25,'Form-factor',31,'2019-01-28 18:55:15','2019-01-29 17:03:55');
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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orders_personal_idx` (`personal_id`),
  CONSTRAINT `fk_orders_personal` FOREIGN KEY (`personal_id`) REFERENCES `users_personal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (9,4,'21497','New','2019-01-20 21:53:06','2019-02-07 10:12:42'),(11,5,'7788','New','2019-01-20 21:56:54','2019-02-06 20:58:28'),(12,6,'6207','New','2019-01-20 21:57:49','2019-02-06 15:49:06'),(14,8,'19316','New','2019-01-27 17:21:02','2019-02-06 16:09:28');
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_delivery`
--

LOCK TABLES `orders_delivery` WRITE;
/*!40000 ALTER TABLE `orders_delivery` DISABLE KEYS */;
INSERT INTO `orders_delivery` VALUES (10,'Self-withdrawal','02.02.2019','7-19',9,'2019-01-20 21:53:06','2019-02-06 21:52:57'),(12,'Courier','None','None',11,'2019-01-20 21:56:54',NULL),(13,'Courier','None','None',12,'2019-01-20 21:57:49',NULL),(15,'Courier','None','None',14,'2019-01-27 17:21:02','2019-02-06 16:23:57');
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
  `count` int(11) NOT NULL DEFAULT '1',
  `endprice` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orders_products_order_idx` (`order_id`),
  KEY `fk_orders_products_product_idx` (`product_id`),
  CONSTRAINT `fk_orders_products_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_products_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_products`
--

LOCK TABLES `orders_products` WRITE;
/*!40000 ALTER TABLE `orders_products` DISABLE KEYS */;
INSERT INTO `orders_products` VALUES (14,9,53,1,'6207','2019-01-20 21:53:06','2019-02-06 21:39:36'),(18,12,53,1,'6207','2019-01-20 21:57:49',NULL),(20,14,48,1,'19316','2019-01-27 17:21:02','2019-02-06 16:09:28'),(23,11,49,1,'7788','2019-02-06 11:46:06',NULL),(24,9,54,1,'15290','2019-02-06 15:48:24','2019-02-07 10:12:42');
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
  `title` varchar(45) NOT NULL,
  `service_title` varchar(45) CHARACTER SET latin1 NOT NULL,
  `warranty` varchar(45) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `description` text,
  `category_id` int(11) NOT NULL,
  `price` varchar(10) NOT NULL,
  `visible` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_products_category_idx` (`category_id`),
  CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (45,'Intel Core i3','corei3','3 years','Неплохой 4-х ядерный процессор без двойных потоков','Новый процессор Intel Core i3-7100 7-го поколения, с кодовым названием микроархитектуры Kaby Lake. Предназначен для настольной платформы Intel LGA 1151.\r\n\r\nIntel Core i3-7100 производится по стандарту 14-нм техпроцесса, имеет 2 ядра, которые работают в 4 потока на штатной тактовой частоте 3.9 ГГц. Объем кэш-памяти 3 уровня равен 3 МБ. Имеет 2-х канальный контроллер памяти DDR4 / DDR3L.\r\n\r\nВысокая скорость, которая вам действительно необходима\r\nМощные быстродействующие процессоры Intel Core 7-го поколения с малым временем отклика способны удовлетворить всем вашим потребностям. Открывайте файлы и программы быстро, переключайтесь между приложениями и веб-страницами без задержек.\r\n\r\nРазвлечения с эффектом погружения\r\nОцените ультравысокую четкость воспроизведения контента, чистоту и резкость изображения в разрешении 4K. Благодаря увеличенному в 4 раза по сравнению с экранами Full HD количеству точек вы получите более четкие и чистые изображения и как никогда полный эффект присутствия.',7,'3999','true','2019-01-04 17:36:27','2019-02-05 10:32:36'),(46,'Intel Core i5','corei5','3 years','Хороший 4-х ядерный процессор','Intel Core i5-7640X — младший процессор для настольной платформы Intel LGA 2066. Данный процессор имеет 4 ядра, которые работают на штатной тактовой частоте 4.0 ГГц, и 4.2 ГГц в режиме Turbo Boost. Из особенностей стоит выделить 2-х кaнaльный контроллер пaмяти DDR4 и рaзблокировaнный множитель. Процессор Intel Core i5 справится с самыми ресурсоемкими задачами – вы увидите и ощутите разницу при просмотре контента в формате HD или 3D, работе в многозадачном режиме или при воспроизведении мультимедиа. Процессор Intel Core i5 содержит передовые технологии, которые обеспечивают более быструю и плавную работу, а также более широкие возможности и качество изображения при выполнении всех ваших любимых ресурсоемких задач – от редактирования фильмов до самых захватывающих игр.',7,'7099','false','2019-01-04 17:38:47','2019-02-05 10:33:33'),(47,'Intel Core i7','corei7','3 years','Отличный 4-х ядерный процессор','Новый процессор Intel Core i7-8700K 8-го поколения, с кодовым названием микроархитектуры Coffee Lake. Предназначен для настольной платформы Intel LGA 1151. Принадлежит к семейству высокопроизводительных процессоров Core i7. Intel Core i7-8700K производится по стандарту 14-нм техпроцесса, имеет 6 ядер, которые работают в 12 потоков со штатной тактовой частотой 3.7 ГГц, 4.7 ГГц в режиме Turbo Boost. Объем кэш-памяти 3 уровня равен 12 МБ. Имеет 2-х канальный контроллер памяти DDR4.',7,'12250','true','2019-01-04 17:39:32',NULL),(48,'Intel Core i9','corei9','3 years','Отличный 4-х ядерный процессор','Процессор INTEL Core™ i9 9900K (BX80684I99900K) с кодовым названием микроархитектуры Coffee Lake-S Refresh. Предназначен для настольной платформы Intel LGA 1151. Принадлежит к семейству высокопроизводительных процессоров Core i9. Процессор INTEL Core™ i9 9900K производится по стандарту 14-нм техпроцесса, имеет 8 ядер, которые работают в 14 потоков со штатной тактовой частотой 3.6 ГГц, 5.0 ГГц в режиме Turbo Boost. Объем кэш-памяти 3 уровня равен 14 МБ. Имеет 2-х канальный контроллер памяти DDR4.',7,'19316','true','2019-01-04 17:40:31',NULL),(49,'AMD Ryzen 5 2600X','ryzen5','5 years','Отличный 6-и ядерный процессор','Особенности микроархитектуры Zen В новой архитектуре AMD Zen используется мощный механизм исполнения, а также поддерживается функция одновременной многопоточности (SMT). Ядра Zen разработаны для эффективного использования имеющихся ресурсов микроархитектуры для обеспечения максимальной вычислительной производительности. Новая трехуровневая кэш-память с низкой задержкой и новые алгоритмы предварительной выборки значительно уменьшают количество кэш-промахов и увеличивают пропускную способность по сравнению с предыдущей микроархитектурой. Производительность и эффективность для приложений следующего поколения Облачные вычисления, производительность промышленного уровня, технологии виртуальной реальности, игры и безопасность данных открывают новые горизонты и требуют более высокого уровня производительности вычислений при максимальной энергоэффективности. Изначально инженеры компании AMD разработали новую архитектуру Zen таким образом, чтобы она могла соответствовать и даже превосходить высокие требования, касающиеся производительности и эффективности, не только приложений следующего, но и дальнейших поколений.',7,'7788','true','2019-01-04 17:41:39',NULL),(50,'AMD Ryzen 7 1700','ryzen7','5 years','Отличный 8-и ядерный процессор','Особенности: Два потока на ядро Частота 3.0/3.7 ГГц 16 МБ общей кэш-памяти третьего уровня Большая унифицированная кэш-память второго уровня Кэш декодированных инструкций Два блока со стандартом шифрования AES для обеспечения безопасности Высокоэффективные FinFET-транзисторы',7,'7517','true','2019-01-04 17:43:32',NULL),(52,'A4Tech Bloody V7M','a4techv7m','1 year','﻿Отличная компьютерная мышь','Bloody V7M представляет собой мышь с высоким разрешением и высокочувствительным оптическим сенсором 200 — 3200 DPI. \r\nБлагодаря металлическим ножкам мышь отлично скользит по всем видам игровых поверхностей. Игровые мыши Bloody — это сочитание передовых технологий и креативного дизайна. \r\nЧтобы бороться против сильного противника с большим арсеналом, выбирайте мыши Bloody. Инновационная технология Holeless с двумя оптическими линзами, делает курсор Bloody четче остальных мышей в 54 раза, фильтрует нежелательный свет, исключает попадание пыли или жидкости внутрь устройства. Три уникальных режима стрельбы обеспечат полный комфорт и абсолютную точность действий в игре: Кнопка 1 — Красный режим для левой кнопки — однократный выстрел Кнопка N — Зеленый режим для непрекращающейся очереди из выстрелов Кнопка 3 — желтый режим для левой кнопки — троекратный выстрел для абсолютной победы над врагом',6,'649','true','2019-01-04 17:47:55','2019-02-05 17:54:36'),(53,'Asus PCI-Ex GeForce GTX 1050 Ti','gtx1050ti','3 years','﻿﻿Отличная видео карта','OASUS Cerberus GeForce GTX 1050 Ti — це високопродуктивна графічна карта, яка спроектована з підвищеною надійністю й ігровою продуктивністю. Asus тестує карти максимально з новітніми іграми та здійснює великі випробування надійності та порівняльний аналіз із великим навантаженням у 15 разів довше, ніж зазвичай.',8,'6207','true','2019-01-04 17:51:00',NULL),(54,'Monitor 27\'\' MSI Optix MAG27C','opticmag27c','1 year','﻿﻿﻿Отличный 144Гц монитор','<strong>Optix MAG24C</strong> – это игровой монитор с изогнутым экраном, обладающий VA-матрицей с низким временем отклика (1 мс) и повышенной частотой обновления (144 Гц). Воплощая в себе самые современные технологии, включая адаптивную синхронизацию Adaptive Sync, эта модель будет прекрасным выбором для компьютерных игр, в том числе соревновательных.',3,'15290','true','2019-01-04 17:52:00','2019-01-28 16:04:24'),(56,'Kingston SSDNow A400','nowa400','3 years','Хороший и недорогой SSD диск','Очень красноречивое описание товара',31,'749','true','2019-01-28 18:56:22',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
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
  `value` varchar(45) CHARACTER SET utf8 DEFAULT 'No info',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_products_characteristics_product_idx` (`product_id`),
  KEY `fk_products_characteristics_characteristic_idx` (`characteristic_id`),
  CONSTRAINT `fk_products_characteristics_characteristic` FOREIGN KEY (`characteristic_id`) REFERENCES `categories_characteristics` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_characteristics_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_characteristics`
--

LOCK TABLES `products_characteristics` WRITE;
/*!40000 ALTER TABLE `products_characteristics` DISABLE KEYS */;
INSERT INTO `products_characteristics` VALUES (3,45,3,'s1151','2019-01-06 13:01:44',NULL),(4,45,4,'Intel UHD 630','2019-01-06 13:01:44',NULL),(6,46,1,'4','2019-01-06 13:07:25',NULL),(7,46,2,'Seven','2019-01-06 13:07:25',NULL),(8,46,3,'s1151','2019-01-06 13:07:25',NULL),(9,46,4,'Intel UHD 630','2019-01-06 13:07:25',NULL),(13,47,3,'s1151','2019-01-06 13:07:58',NULL),(14,47,4,'Intel UHD 630','2019-01-06 13:07:58',NULL),(16,48,1,'18','2019-01-06 13:08:51',NULL),(17,48,2,'Six','2019-01-06 13:08:51',NULL),(18,48,3,'s1151','2019-01-06 13:08:51',NULL),(19,48,4,'Intel UHD 630','2019-01-06 13:08:51',NULL),(21,49,1,'6','2019-01-06 13:10:27',NULL),(22,49,2,'First','2019-01-06 13:10:27',NULL),(23,49,3,'AM4','2019-01-06 13:10:27',NULL),(24,49,4,'No','2019-01-06 13:10:27',NULL),(26,50,1,'8','2019-01-06 13:10:44',NULL),(27,50,2,'First','2019-01-06 13:10:44',NULL),(28,50,3,'AM4','2019-01-06 13:10:44',NULL),(29,50,4,'No','2019-01-06 13:10:44',NULL),(36,54,11,'27\'\'','2019-01-06 13:14:46',NULL),(37,54,12,'144 Hz','2019-01-06 13:14:46',NULL),(38,54,13,'1ms','2019-01-06 13:14:46',NULL),(39,54,14,'178°','2019-01-06 13:14:46',NULL),(41,53,16,'4 GB','2019-01-06 13:25:41','2019-02-05 17:49:19'),(42,53,17,'GDDR5','2019-01-06 13:25:41',NULL),(43,53,18,'Dual fan','2019-01-06 13:25:41',NULL),(44,53,19,'7680x4320','2019-01-06 13:25:41',NULL),(45,47,1,'4','2019-01-25 15:40:51',NULL),(53,52,20,'8','2019-01-28 17:06:03',NULL),(54,52,21,'USB','2019-01-28 17:06:07',NULL),(55,45,2,'Seven','2019-01-28 17:13:09',NULL),(57,52,9,'Linux','2019-01-28 17:18:21',NULL),(59,52,8,'White','2019-01-28 17:22:03',NULL),(60,45,1,'4','2019-01-28 17:24:17','2019-02-05 20:34:09'),(61,47,2,'Seven','2019-01-28 19:03:02',NULL),(65,56,25,'2,5\'\'','2019-01-28 19:03:52','2019-02-04 23:47:31'),(73,56,22,'120 Gb','2019-02-04 23:44:38',NULL),(74,56,23,'320 Mb/s','2019-02-05 10:28:00',NULL),(80,56,24,'500 Mb/s','2019-02-05 13:48:49',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (0,'unregistered','unregistered','unregistered_user','2019-01-23 16:30:33','2019-02-07 17:37:10'),(10,'Igrec','$2y$10$zrf9CHyv3jaUwRscPM58suDcTsEa0f.TDeQL1NBVby.SNSchpWjRS','asdsadasd@mail.ru','2019-01-07 11:28:52',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_addresses`
--

LOCK TABLES `users_addresses` WRITE;
/*!40000 ALTER TABLE `users_addresses` DISABLE KEYS */;
INSERT INTO `users_addresses` VALUES (7,'Khravkorsa','adsadd','213-24','61115',4,'2019-01-20 21:53:06','2019-02-06 20:55:37'),(9,'Test','TestTest','123-123','2323',5,'2019-01-20 21:56:54',NULL),(10,'Test','Test','123-2323','',6,'2019-01-20 21:57:49','2019-02-07 18:34:38'),(12,'testforadmin','testforadmin','123-222','',8,'2019-01-27 17:21:02',NULL);
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
  CONSTRAINT `fk_users_personal_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_personal`
--

LOCK TABLES `users_personal` WRITE;
/*!40000 ALTER TABLE `users_personal` DISABLE KEYS */;
INSERT INTO `users_personal` VALUES (4,'Ihor','Kruhliak','121232432','id.igrec@gmail.com',0,'2019-01-20 21:53:06','2019-02-07 18:30:28'),(5,'Test','TestTest','123123123','',0,'2019-01-20 21:56:54','2019-02-07 18:30:29'),(6,'TestTest','TestTest','123123123','',0,'2019-01-20 21:57:49','2019-02-07 18:30:30'),(8,'testforadmin','testforadmin','09123123123','',0,'2019-01-27 17:21:02','2019-02-07 18:50:27');
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

-- Dump completed on 2019-02-08 14:34:42
