-- MySQL dump 10.13  Distrib 5.7.12, for Linux (x86_64)
--
-- Host: localhost    Database: project
-- ------------------------------------------------------
-- Server version	5.7.12-0ubuntu1

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
-- Table structure for table `Clients`
--

DROP TABLE IF EXISTS `Clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Clients` (
  `Id` int(2) NOT NULL AUTO_INCREMENT,
  `Name` varchar(40) NOT NULL,
  `Business` varchar(40) NOT NULL,
  `SenderLat` float NOT NULL,
  `SenderLong` float NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Clients`
--

LOCK TABLES `Clients` WRITE;
/*!40000 ALTER TABLE `Clients` DISABLE KEYS */;
INSERT INTO `Clients` VALUES (1,'Will Christie','WTC',39.7555,-105.221),(2,'Paul Laliberte','PRKL',39.7392,-104.99),(3,'Kylee Budai','K.B',30.015,-105.271),(4,'Nicholas Johnston','NIJO',39.9205,-105.087),(5,'Bill Christie','BTC',39.8028,-105.088);
/*!40000 ALTER TABLE `Clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Drones`
--

DROP TABLE IF EXISTS `Drones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Drones` (
  `Id` int(6) NOT NULL AUTO_INCREMENT,
  `Status` int(1) NOT NULL,
  `Details` varchar(128) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=111119 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Drones`
--

LOCK TABLES `Drones` WRITE;
/*!40000 ALTER TABLE `Drones` DISABLE KEYS */;
INSERT INTO `Drones` VALUES (111111,1,'in transit'),(111113,1,'in transit'),(111114,1,'deliver complete'),(111115,1,'delivery complete'),(111116,1,'in transit'),(111117,1,'in transit'),(111118,0,'returning');
/*!40000 ALTER TABLE `Drones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `OrderStatus`
--

DROP TABLE IF EXISTS `OrderStatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OrderStatus` (
  `Status` int(1) NOT NULL AUTO_INCREMENT,
  `Description` varchar(128) NOT NULL,
  PRIMARY KEY (`Status`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `OrderStatus`
--

LOCK TABLES `OrderStatus` WRITE;
/*!40000 ALTER TABLE `OrderStatus` DISABLE KEYS */;
INSERT INTO `OrderStatus` VALUES (1,'in transit'),(2,'delivered');
/*!40000 ALTER TABLE `OrderStatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Orders`
--

DROP TABLE IF EXISTS `Orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Orders` (
  `OrderId` int(6) NOT NULL AUTO_INCREMENT,
  `ClientId` int(2) NOT NULL,
  `DroneId` int(6) NOT NULL,
  `OrderTimestamp` int(10) NOT NULL,
  `RecieverLat` float NOT NULL,
  `RecieverLong` float NOT NULL,
  `Status` int(1) NOT NULL,
  PRIMARY KEY (`OrderId`)
) ENGINE=MyISAM AUTO_INCREMENT=121119 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Orders`
--

LOCK TABLES `Orders` WRITE;
/*!40000 ALTER TABLE `Orders` DISABLE KEYS */;
INSERT INTO `Orders` VALUES (121112,1,111111,2016061512,39.8367,-105.037,1),(121113,1,111113,2016061501,39.9528,-105.169,1),(121114,2,111114,2016052611,39.9778,-105.132,2),(121115,3,111115,2016042803,39.9614,-105.511,2),(121116,4,111116,2016061504,39.0639,-108.551,1),(121117,5,111117,2016061409,40.0861,-105.939,1),(121118,5,111118,2016061404,37.9375,-107.812,2);
/*!40000 ALTER TABLE `Orders` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-16 13:17:12
