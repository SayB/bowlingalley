-- MySQL dump 10.13  Distrib 5.6.37-82.2, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: scores
-- ------------------------------------------------------
-- Server version	5.6.37-82.2

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
/*!50112 SELECT COUNT(*) INTO @is_rocksdb_supported FROM INFORMATION_SCHEMA.SESSION_VARIABLES WHERE VARIABLE_NAME='rocksdb_bulk_load' */;
/*!50112 SET @save_old_rocksdb_bulk_load = IF (@is_rocksdb_supported, 'SET @old_rocksdb_bulk_load = @@rocksdb_bulk_load', 'SET @dummy_old_rocksdb_bulk_load = 0') */;
/*!50112 PREPARE s FROM @save_old_rocksdb_bulk_load */;
/*!50112 EXECUTE s */;
/*!50112 SET @enable_bulk_load = IF (@is_rocksdb_supported, 'SET SESSION rocksdb_bulk_load = 1', 'SET @dummy_rocksdb_bulk_load = 0') */;
/*!50112 PREPARE s FROM @enable_bulk_load */;
/*!50112 EXECUTE s */;
/*!50112 DEALLOCATE PREPARE s */;

--
-- Table structure for table `frames`
--

DROP TABLE IF EXISTS `frames`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `frames` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `roll` int(11) NOT NULL,
  `pins` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frames`
--

LOCK TABLES `frames` WRITE;
/*!40000 ALTER TABLE `frames` DISABLE KEYS */;
INSERT INTO `frames` VALUES (1,1,1,1,10,'2017-11-26 23:41:53','2017-11-26 23:41:53'),(2,1,1,2,0,'2017-11-26 23:42:12','2017-11-26 23:42:12'),(3,1,2,1,10,'2017-11-26 23:42:12','2017-11-26 23:42:12'),(4,1,2,2,0,'2017-11-26 23:42:12','2017-11-26 23:42:12'),(5,1,3,1,10,'2017-11-26 23:42:13','2017-11-26 23:42:13'),(6,1,3,2,0,'2017-11-26 23:42:13','2017-11-26 23:42:13'),(7,1,4,1,10,'2017-11-26 23:42:13','2017-11-26 23:42:13'),(8,1,4,2,0,'2017-11-26 23:42:13','2017-11-26 23:42:13'),(9,1,5,1,10,'2017-11-26 23:42:13','2017-11-26 23:42:13'),(10,1,5,2,0,'2017-11-26 23:42:13','2017-11-26 23:42:13'),(11,1,6,1,10,'2017-11-26 23:42:13','2017-11-26 23:42:13'),(12,1,6,2,0,'2017-11-26 23:42:13','2017-11-26 23:42:13'),(13,1,7,1,10,'2017-11-26 23:42:13','2017-11-26 23:42:13'),(14,1,7,2,0,'2017-11-26 23:42:13','2017-11-26 23:42:13'),(15,1,8,1,10,'2017-11-26 23:42:13','2017-11-26 23:42:13'),(16,1,8,2,0,'2017-11-26 23:42:13','2017-11-26 23:42:13'),(17,1,9,1,10,'2017-11-26 23:42:13','2017-11-26 23:42:13'),(18,1,9,2,0,'2017-11-26 23:42:13','2017-11-26 23:42:13'),(19,1,10,1,10,'2017-11-26 23:42:13','2017-11-26 23:42:13'),(20,1,10,2,10,'2017-11-26 23:42:13','2017-11-26 23:42:13'),(21,1,10,3,10,'2017-11-26 23:42:13','2017-11-26 23:42:13'),(22,2,1,1,10,'2017-11-26 23:49:41','2017-11-26 23:49:41'),(23,2,1,2,0,'2017-11-26 23:49:41','2017-11-26 23:49:41'),(24,2,2,1,10,'2017-11-26 23:49:41','2017-11-26 23:49:41'),(25,2,2,2,0,'2017-11-26 23:49:41','2017-11-26 23:49:41'),(26,2,3,1,10,'2017-11-26 23:49:41','2017-11-26 23:49:41'),(27,2,3,2,0,'2017-11-26 23:49:42','2017-11-26 23:49:42'),(28,2,4,1,10,'2017-11-26 23:49:42','2017-11-26 23:49:42'),(29,2,4,2,0,'2017-11-26 23:49:42','2017-11-26 23:49:42'),(30,2,5,1,10,'2017-11-26 23:49:42','2017-11-26 23:49:42'),(31,2,5,2,0,'2017-11-26 23:49:42','2017-11-26 23:49:42'),(32,2,6,1,10,'2017-11-26 23:49:42','2017-11-26 23:49:42'),(33,2,6,2,0,'2017-11-26 23:49:42','2017-11-26 23:49:42'),(34,2,7,1,10,'2017-11-26 23:49:42','2017-11-26 23:49:42'),(35,2,7,2,0,'2017-11-26 23:49:42','2017-11-26 23:49:42'),(36,2,8,1,10,'2017-11-26 23:49:42','2017-11-26 23:49:42'),(37,2,8,2,0,'2017-11-26 23:49:42','2017-11-26 23:49:42'),(38,2,9,1,10,'2017-11-26 23:49:42','2017-11-26 23:49:42'),(39,2,9,2,0,'2017-11-26 23:49:42','2017-11-26 23:49:42'),(40,2,10,1,10,'2017-11-26 23:49:42','2017-11-26 23:49:42'),(41,2,10,2,10,'2017-11-26 23:49:42','2017-11-26 23:49:42'),(42,2,10,3,10,'2017-11-26 23:49:42','2017-11-26 23:49:42'),(43,3,1,1,2,'2017-11-26 23:52:41','2017-11-26 23:52:41'),(44,3,1,2,2,'2017-11-26 23:52:41','2017-11-26 23:52:41'),(45,3,2,1,1,'2017-11-26 23:52:41','2017-11-26 23:52:41'),(46,3,2,2,4,'2017-11-26 23:52:41','2017-11-26 23:52:41'),(47,3,3,1,6,'2017-11-26 23:52:41','2017-11-26 23:52:41'),(48,3,3,2,4,'2017-11-26 23:52:41','2017-11-26 23:52:41'),(49,3,4,1,10,'2017-11-26 23:52:41','2017-11-26 23:52:41'),(50,3,4,2,0,'2017-11-26 23:52:41','2017-11-26 23:52:41'),(51,3,5,1,10,'2017-11-26 23:52:41','2017-11-26 23:52:41'),(52,3,5,2,0,'2017-11-26 23:52:41','2017-11-26 23:52:41'),(53,3,6,1,10,'2017-11-26 23:52:41','2017-11-26 23:52:41'),(54,3,6,2,0,'2017-11-26 23:52:41','2017-11-26 23:52:41'),(55,3,7,1,10,'2017-11-26 23:52:41','2017-11-26 23:52:41'),(56,3,7,2,0,'2017-11-26 23:52:41','2017-11-26 23:52:41'),(57,3,8,1,10,'2017-11-26 23:52:41','2017-11-26 23:52:41'),(58,3,8,2,0,'2017-11-26 23:52:41','2017-11-26 23:52:41'),(59,3,9,1,10,'2017-11-26 23:52:41','2017-11-26 23:52:41'),(60,3,9,2,0,'2017-11-26 23:52:41','2017-11-26 23:52:41'),(61,3,10,1,10,'2017-11-26 23:52:41','2017-11-26 23:52:41'),(62,3,10,2,10,'2017-11-26 23:52:41','2017-11-26 23:52:41'),(63,3,10,3,10,'2017-11-26 23:52:41','2017-11-26 23:52:41');
/*!40000 ALTER TABLE `frames` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES (1,1,1650,'2017-11-26 23:41:49','2017-11-26 23:41:49'),(2,1,300,'2017-11-26 23:49:41','2017-11-26 23:49:41'),(3,1,239,'2017-11-26 23:52:41','2017-11-26 23:52:41');
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `password` varchar(655) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Sohaib','Muneer','sohaib.muneer@gmail.com','2017-11-22 18:09:14','2017-11-22 18:09:14','$2a$06$L4ZNemBipjG8EpOQJyvLpuDiXwGKgFJpz/raaRpLwrXC4bpO4Nue6');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!50112 SET @disable_bulk_load = IF (@is_rocksdb_supported, 'SET SESSION rocksdb_bulk_load = @old_rocksdb_bulk_load', 'SET @dummy_rocksdb_bulk_load = 0') */;
/*!50112 PREPARE s FROM @disable_bulk_load */;
/*!50112 EXECUTE s */;
/*!50112 DEALLOCATE PREPARE s */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-27  5:03:57