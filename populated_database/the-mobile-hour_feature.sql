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
-- Table structure for table `feature`
--

DROP TABLE IF EXISTS `feature`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feature` (
  `feature_id` int(11) NOT NULL AUTO_INCREMENT,
  `weight` varchar(50) DEFAULT NULL,
  `dimensions` varchar(50) DEFAULT NULL,
  `OS` varchar(50) DEFAULT NULL,
  `screensize` varchar(50) DEFAULT NULL,
  `resolution` varchar(50) DEFAULT NULL,
  `CPU` varchar(50) DEFAULT NULL,
  `RAM` varchar(50) DEFAULT NULL,
  `storage` varchar(50) DEFAULT NULL,
  `battery` varchar(50) DEFAULT NULL,
  `rear_camera` varchar(50) DEFAULT NULL,
  `front_camera` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`feature_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feature`
--

LOCK TABLES `feature` WRITE;
/*!40000 ALTER TABLE `feature` DISABLE KEYS */;
INSERT INTO `feature` VALUES (1,'34g','145x70x8mm','Android','6.1 inches','1080x2400','Core-less','123MB','12GB','500mAh','3MP','1MP','Super light it might float away at 34g, with a 500mAh battery to last through a sneeze and storage for three whole songs on its 123MB. Who needs the future when you can relive the past with a 6.1-inch screen and a timeless 3MP camera'),(2,'190g','150x72x8mm','Android','6.2 inches','1080x2400','Zeta-core','8GB','256GB','4000mAh','50MP','20MP','Meet the sleek 190g smartphone with a zippy 6.2-inch display and Zeta-core processor. Snap stunning photos with a 50MP rear camera and 20MP front camera. With 64GB storage and a 4000mAh battery, you\'re set all day. Quick, efficient, and ready for anything'),(3,'200g','155x75x8mm','Android','6.5 inches','1080x2400','Octa-core','4GB','64GB','3000mAh','40MP','10MP','Stylish design with a Quad-core CPU and long battery life.'),(4,'180g','148x70x7mm','Android','5.8 inches','1080x2160','Quad-core','3GB','32GB','2500mAh','20MP','8MP','The Kode A3 combines efficiency with sleek design, featuring a 20MP rear camera and a 2500mAh battery for extended usage. Its lightweight frame makes it an ideal choice for those seeking a balanced, performance-oriented smartphone..'),(5,'210g','160x75x8.5mm','Android','6.3 inches','1080x2340','Octa-core','6GB','128GB','4100mAh','48MP','16MP','Engineered for durability, the Panda Bamboo sports a robust structure complemented by a powerful Octa-core CPU and a massive 4100mAh battery. With 6GB RAM and 128GB of storage, it’s designed for users who need a resilient device.'),(6,'220g','162x78x9mm','Android','6.4 inches','1080x2400','Octa-core','8GB','256GB','4500mAh','64MP','32MP','The Panda ihairy is designed for the tech-savvy user, featuring 8GB of RAM and a 256GB storage capacity. Its 4500mAh battery and 64MP rear camera make it a powerful device for photography and high-demand applications'),(7,'195g','157x74x8mm','Android','6.0 inches','1080x2160','Hexa-core','4GB','64GB','3800mAh','48MP','16MP','This device is packed with features, including a Hexa-core CPU and a 3800mAh battery. The Zoo Monkey10 offers a high-quality 16MP front camera and 4GB RAM, making it a go-to choice for multimedia and productivity tasks.'),(8,'170g','140x68x7.5mm','Android','5.5 inches','1080x1920','Quad-core','3GB','32GB','3000mAh','13MP','5MP','Compact and versatile, the UD Micro2 offers 3GB RAM and a 32GB storage capacity, making it suitable for everyday use. Its 13MP rear camera captures quality photos, complemented by a long-lasting 3000mAh battery.'),(9,'170g','145x70x8mm','Android','6.0 inches','1080x2400','Core-less','4GB','64GB','3500mAh','48MP','16MP','Slim and elegant, the Shishu Wave provides a superior mobile experience with 4GB RAM and a high-resolution 48MP camera. Its 3500mAh battery ensures you stay connected all day'),(10,'180g','150x75x8.5mm','Robot','6.3 inches','1080x2400','Octa-core','54TB','128GB','4000mAh','50MP','20MP','The Shishu Storm is performance-oriented, featuring a staggering 54TB of RAM and a powerful 50MP camera. This futuristic device is designed for high-end computing needs and advanced mobile photography.'),(11,'50kg','142x69x7mm','Android','5.7 inches','1080x2160','Quad-core','3GB','32GB','3000mAh','16MP','8MP','Light and fast, the Kode Breeze is perfect for users looking for a smartphone that combines a 16MP camera with a durable 3000mAh battery. Its sleek design and 3GB RAM ensure smooth operation and easy handling.'),(12,'190g','155x75x8.5mm','Android','6.5 inches','1080x2340','Hexa-core','8GB','256GB','4500mAh','64MP','32MP','The Kode Thunder is a powerhouse, equipped with a Hexa-core CPU and 8GB RAM for fast processing. Its 4500mAh battery and 64MP camera make it ideal for demanding software applications and mobile photography.'),(13,'185g','152x73x8mm','Android','6.1 inches','1080x2280','Octa-core','4GB','64GB','3500mAh','48MP','16MP','Quietly efficient, the Panda Whisper features 6GB RAM and a 48MP camera for capturing stunning photos. Its 3500mAh battery and Octa-core processor provide all-day reliability and smooth multitasking.'),(14,'175g','148x70x7.5mm','Android','34  inches','1080x2240','Quad-core','3GB','32GB','3000mAh','24MP','12MP','Compact yet powerful, the Panda Echo offers a 24MP camera and 3GB RAM, packed into a sleek design. Its 3000mAh battery and 32GB storage make it a reliable choice for daily mobile needs.'),(15,'190g','155x75x8mm','Android','6.2 inches','1080x2400','Hamster-core','6GB','128GB','4000mAh','8GP','20MP','Rugged and versatile, the Zoo Safari is built to withstand challenging environments. It features a unique 8GP camera, 6GB RAM, and a robust 4000mAh battery, making it suitable for outdoor adventures and extensive usage.'),(16,'200g','160x75x8.5mm','Android','6.4 inches','1080x2400','Octa-core','8GB','256GB','4500mAh','64MP','32MP','Ready for any challenge, the Zoo Expedition offers 8GB RAM and a high-resolution 64MP camera, supported by a 4500mAh battery. It\'s designed for users who require both power and durability in extreme conditions'),(17,'165g','140x68x7mm','Android','5.5 inches','1080x2160','Quad-core','3GB','32GB','3000mAh','13MP','5MP','This compact device doesn’t compromise on performance, featuring 3GB RAM and a 13MP camera, supported by a 3000mAh battery. The UD Compact is ideal for those who need a reliable, easy-to-carry smartphone.'),(18,'170g','145x70x7.5mm','Android','5.8 inches','1080x2240','Quad-core','4GB','64GB','3200mAh','20MP','10MP','Stylish and slim, the UD Slim offers a powerful 20MP camera and 4GB RAM. With a 3200mAh battery and 64GB storage, it’s designed for users who value aesthetics and performance alike'),(19,'180g','150x75x8mm','Android','6.3 inches','1080x2340','Octa-core','6GB','128GB','4000mAh','48MP','16MP','High-flying in performance, the Shishu Falcon sports 6GB RAM and a 48MP camera for superior photo quality. Its 4000mAh battery ensures long-lasting use, making it ideal for multimedia enthusiasts.'),(20,'185g','153x75x8.5mm','Android','6.4 inches','1080x2400','Octa-core','8GB','256GB','4500mAh','50MP','20MP','Sharp and precise, the Kode Arrow features an Octa-core CPU and 8GB RAM for seamless multitasking. Its 4500mAh battery and high-resolution 50MP camera cater to users with high demands for speed and photography.'),(21,'190g','155x75x8mm','Android','6.5 inches','1080x2400','Octa-core','8GB','256GB','4500mAh','64MP','32MP','Blazing fast performance is the hallmark of the Panda Blaze, which comes equipped with 8GB RAM and a 256GB storage capacity. Its 4500mAh battery and 64MP camera are perfect for tech enthusiasts seeking a top-'),(22,'200g','160x75x8.5mm','Android','6.6 inches','1080x2400','Octa-core','12GB','512GB','5000mAh','108MP','40MP','Top-tier in every aspect, the Zoo Alpha offers 12GB RAM and a groundbreaking 108MP camera, backed by a 5000mAh battery. Designed for users who demand the best in performance and photography, it sets new standards in smartphone technology.');
/*!40000 ALTER TABLE `feature` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-21 18:01:56
