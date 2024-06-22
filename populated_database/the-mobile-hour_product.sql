-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: the-mobile-hour
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_model` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_on_hand` int(11) NOT NULL,
  `feature_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `feature_id` (`feature_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`feature_id`) REFERENCES `feature` (`feature_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Shishu Cellfish','CF-100','SHISHU',599.99,120,1),(2,'Shishu Fish ','FS-200','SHISHU',699.99,115,2),(3,'Kode Calender 3','CL-300','KODE',499.95,101,3),(4,'Kode A3','A3-100','KODE',299.99,205,4),(5,'Panda Bamboo','BM-400','PANDA',549.99,152,5),(6,'Panda Blue','IH-500','PANDA',649.99,107,6),(7,'Zoo Monkey','M10-600','ZOO',399.99,80,7),(8,'UD Micro2','M2-700','UD',249.99,120,8),(9,'Shishu Wave','SW-300','SHISHU',399.99,80,9),(10,'Shishu Storm','SS-400','SHISHU',499.99,100,10),(11,'Kode Breeze','KB-100','KODE',299.99,124,11),(12,'Kode Thunder','KT-500','KODE',599.99,150,12),(13,'Panda Whisper','PW-200','PANDA',399.99,145,13),(14,'Panda Echo','PE-300','PANDA',349.99,108,14),(15,'Zoo Safari','ZS-600','ZOO',449.99,90,15),(16,'Zoo Expedition','ZE-700','ZOO',599.99,80,16),(17,'UD Compact','UC-100','UD',249.99,100,17),(18,'UD Slim','US-200','UD',299.99,90,18),(19,'Shishu Falcon','SF-500','SHISHU',499.99,100,19),(20,'Kode Arrow','KA-300','KODE',549.99,90,20),(21,'Panda Blaze','PB-600','PANDA',599.99,80,21),(22,'Zoo Alpha','ZA-800','ZOO',799.99,70,22);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-21 18:01:55
