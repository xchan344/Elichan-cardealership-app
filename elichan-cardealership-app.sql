-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: elichan-cardealership-app
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `account` (
  `a_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`a_id`),
  CONSTRAINT `e_id` FOREIGN KEY (`a_id`) REFERENCES `employee` (`e_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cars` (
  `c_id` int NOT NULL AUTO_INCREMENT,
  `m_id` int NOT NULL,
  `car_name` varchar(45) NOT NULL,
  PRIMARY KEY (`c_id`),
  KEY `m_id_idx` (`m_id`),
  CONSTRAINT `m_id` FOREIGN KEY (`m_id`) REFERENCES `manufacturer` (`m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cars`
--

LOCK TABLES `cars` WRITE;
/*!40000 ALTER TABLE `cars` DISABLE KEYS */;
INSERT INTO `cars` VALUES (1,2,'Vitara'),(2,1,'Everest'),(3,5,'Urus'),(4,4,'Stonic'),(5,2,'Celerio GL'),(6,3,'HighLander'),(7,5,'Urus Capcule'),(8,3,'Alphard'),(9,2,'Soluto'),(10,1,'Rangers');
/*!40000 ALTER TABLE `cars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee` (
  `e_id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `birthdate` date NOT NULL,
  `p_id` int NOT NULL,
  `contact` varchar(13) NOT NULL,
  PRIMARY KEY (`e_id`),
  KEY `p_id_idx` (`p_id`),
  CONSTRAINT `p_id` FOREIGN KEY (`p_id`) REFERENCES `position` (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,'Christian','Dela Gente','1997-01-19',1,'09567214995'),(2,'Elizalde','Ulson Pogi','2001-06-28',2,'09125872375'),(3,'Keanu','Reeves','1976-03-24',3,'09238746273'),(4,'Chuck','Norris','1946-02-26',3,'09347563475'),(5,'Bob','Marley','1957-08-01',4,'09237462734'),(6,'Michael','Jordan','1957-11-03',5,'09734637454'),(7,'Elon','Musk','1945-06-17',6,'09237637643'),(8,'Steve','Jobs','1967-02-26',7,'09384765734'),(9,'Bruce','Lee','1967-08-15',8,'09243785637'),(10,'Jet','Lee','1969-07-15',8,'09347583479');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manufacturer`
--

DROP TABLE IF EXISTS `manufacturer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `manufacturer` (
  `m_id` int NOT NULL AUTO_INCREMENT,
  `m_name` varchar(45) NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manufacturer`
--

LOCK TABLES `manufacturer` WRITE;
/*!40000 ALTER TABLE `manufacturer` DISABLE KEYS */;
INSERT INTO `manufacturer` VALUES (1,'Ford'),(2,'Suzuki'),(3,'Toyota'),(4,'Kia'),(5,'Lamborghini');
/*!40000 ALTER TABLE `manufacturer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `position`
--

DROP TABLE IF EXISTS `position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `position` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `position_type` varchar(45) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `position`
--

LOCK TABLES `position` WRITE;
/*!40000 ALTER TABLE `position` DISABLE KEYS */;
INSERT INTO `position` VALUES (1,'CEO'),(2,'General Manager'),(3,'Manager'),(4,'Marketing Director'),(5,'Front Desk'),(6,'Senior Mechanic'),(7,'IT'),(8,'Clerk');
/*!40000 ALTER TABLE `position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaction` (
  `t_id` int NOT NULL AUTO_INCREMENT,
  `customer_fname` varchar(45) NOT NULL,
  `customer_lname` varchar(45) NOT NULL,
  `c_id` int NOT NULL,
  `tt_id` int NOT NULL,
  `price` int NOT NULL,
  `ts_id` int NOT NULL,
  `t_date` date NOT NULL,
  PRIMARY KEY (`t_id`),
  KEY `c_id_idx` (`c_id`),
  KEY `tt_id_idx` (`tt_id`),
  KEY `ts_id_idx` (`ts_id`),
  CONSTRAINT `c_id` FOREIGN KEY (`c_id`) REFERENCES `cars` (`c_id`),
  CONSTRAINT `ts_id` FOREIGN KEY (`ts_id`) REFERENCES `transaction_status` (`ts_id`),
  CONSTRAINT `tt_id` FOREIGN KEY (`tt_id`) REFERENCES `transaction_type` (`tt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` VALUES (1,'Kendrick ','Espidido',5,1,750000,1,'2022-06-28'),(2,'Hector','Herrera',2,2,8600,1,'2022-06-28'),(3,'Lexter','Gevela',9,2,4840,1,'2022-06-28'),(4,'Allan','Amon',1,3,500,3,'2022-06-28'),(5,'Ehd','Caluag',6,1,2000000,2,'2022-06-28'),(6,'Manny','Pacquiao',3,1,29900000,1,'2022-06-28'),(7,'Vice','Ganda',4,2,13600,1,'2022-06-28'),(8,'Dora','Explorer',7,3,600,3,'2022-06-28'),(9,'Naruto','Uzumaki',8,1,4160000,2,'2022-06-28'),(10,'Kendrick','Espidido',10,1,1200000,2,'2022-06-28'),(11,'Manny','Pacquiao',8,1,4200000,1,'2023-03-02'),(12,'Sponge','Bob',5,2,3290,1,'2023-02-01'),(14,'Spider','Man',3,3,460,1,'2023-02-24'),(15,'Ash','Kechum',9,1,780000,1,'2023-03-01'),(16,'Cardo','Dalisay',10,1,200000,2,'2023-03-03'),(17,'Bella','Porch',4,1,835000,1,'2023-03-04'),(18,'Bruno','Mars',1,1,913000,1,'2023-03-05'),(19,'Bruno','Earth',2,1,350000,2,'2023-03-07'),(20,'Ferdinand','Marcos',5,1,710000,1,'2023-03-08'),(21,'Pia','Wurtzbach',2,2,4233,1,'2023-03-08'),(22,'Liza','Zoberano',8,1,240000,2,'2023-03-09'),(23,'Lelouch','Lamperouge',9,1,780000,1,'2023-03-09'),(24,'Light','Yagami',6,1,2000000,1,'2023-03-10'),(25,'Dio','Brando',2,1,1800000,1,'2023-03-11'),(26,'Joseph','Joestar',8,1,4160000,1,'2023-03-12'),(27,'Gon','Freecs',10,1,300000,2,'2023-03-13'),(28,'Levi','Ackerman',8,1,320000,2,'2023-03-15'),(29,'Jotaro','Kujo',8,1,400000,2,'2023-03-16'),(30,'Roronoa','Zoro',8,1,540000,2,'2023-03-19'),(31,'Light','Yagami',4,1,299999,2,'2023-03-18'),(32,'Shinji','Ikari',9,2,40000,1,'2023-03-19'),(33,'Edward','Elric',5,2,12100,1,'2023-03-21'),(39,'Kendrick','Espidido',4,3,600,1,'2023-06-06'),(40,'Kendrick','Espidido',7,2,12500,1,'2023-06-06'),(41,'Kendrick','Espidido',8,2,14500,1,'2023-06-06'),(42,'Kendrick','Espidido',8,2,14500,1,'2023-06-06');
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_status`
--

DROP TABLE IF EXISTS `transaction_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaction_status` (
  `ts_id` int NOT NULL AUTO_INCREMENT,
  `transaction_status_name` varchar(45) NOT NULL,
  PRIMARY KEY (`ts_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_status`
--

LOCK TABLES `transaction_status` WRITE;
/*!40000 ALTER TABLE `transaction_status` DISABLE KEYS */;
INSERT INTO `transaction_status` VALUES (1,'Fully Paid'),(2,'Partially Paid'),(3,'NA');
/*!40000 ALTER TABLE `transaction_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_type`
--

DROP TABLE IF EXISTS `transaction_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaction_type` (
  `tt_id` int NOT NULL AUTO_INCREMENT,
  `transaction_type_name` varchar(45) NOT NULL,
  PRIMARY KEY (`tt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_type`
--

LOCK TABLES `transaction_type` WRITE;
/*!40000 ALTER TABLE `transaction_type` DISABLE KEYS */;
INSERT INTO `transaction_type` VALUES (1,'Bought'),(2,'Repair'),(3,'Consult');
/*!40000 ALTER TABLE `transaction_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2023-06-06 23:36:18
