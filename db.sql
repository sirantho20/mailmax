-- MySQL dump 10.13  Distrib 5.5.29, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: imail
-- ------------------------------------------------------
-- Server version	5.5.29-0ubuntu0.12.10.1

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_name` varchar(45) DEFAULT NULL,
  `package` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` int(11) DEFAULT NULL,
  `signup_date` date DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `cos` varchar(45) DEFAULT NULL,
  `resellerAccount` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `account_package_idx` (`package`),
  KEY `fk_account_1` (`resellerAccount`),
  CONSTRAINT `account_package` FOREIGN KEY (`package`) REFERENCES `package` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_account_1` FOREIGN KEY (`resellerAccount`) REFERENCES `resellerAccounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (5,'Softcube Limited',4,'info@softcube.co',244304946,'2013-04-22','a','0000',1);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_accounts`
--

DROP TABLE IF EXISTS `email_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `middle_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `account` int(11) DEFAULT NULL,
  `job_title` varchar(45) DEFAULT NULL,
  `department` varchar(45) DEFAULT NULL,
  `office` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `emailaccount_account_idx` (`account`),
  CONSTRAINT `emailaccount_account` FOREIGN KEY (`account`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_accounts`
--

LOCK TABLES `email_accounts` WRITE;
/*!40000 ALTER TABLE `email_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` int(11) DEFAULT NULL,
  `duration_months` int(11) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `Amount` varchar(45) DEFAULT NULL,
  `invoiceDate` date DEFAULT NULL,
  `dueDate` date DEFAULT NULL,
  `overDue` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_account_idx` (`account`),
  CONSTRAINT `invoice_account` FOREIGN KEY (`account`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice`
--

LOCK TABLES `invoice` WRITE;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package`
--

DROP TABLE IF EXISTS `package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_name` varchar(45) NOT NULL,
  `email_limit` int(11) NOT NULL,
  `space_limit` int(11) NOT NULL,
  `duration_months` int(11) NOT NULL,
  `domain_limit` int(11) NOT NULL,
  `package_price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package`
--

LOCK TABLES `package` WRITE;
/*!40000 ALTER TABLE `package` DISABLE KEYS */;
INSERT INTO `package` VALUES (4,'Basic',50,5000,12,1,250),(5,'Standard',100,10000,12,2,450),(6,'Premium',250,75000,12,4,895);
/*!40000 ALTER TABLE `package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(45) DEFAULT NULL,
  `Date` date NOT NULL,
  `paymentMethod` varchar(45) NOT NULL,
  `invoice` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_invoice_idx` (`invoice`),
  CONSTRAINT `payment_invoice` FOREIGN KEY (`invoice`) REFERENCES `invoice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resellerAccounts`
--

DROP TABLE IF EXISTS `resellerAccounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resellerAccounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_name` varchar(45) DEFAULT NULL,
  `reseller_package` int(11) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_resellerAccounts_1` (`reseller_package`),
  CONSTRAINT `fk_resellerAccounts_1` FOREIGN KEY (`reseller_package`) REFERENCES `resellerPackages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resellerAccounts`
--

LOCK TABLES `resellerAccounts` WRITE;
/*!40000 ALTER TABLE `resellerAccounts` DISABLE KEYS */;
INSERT INTO `resellerAccounts` VALUES (1,'Softcube Limited',NULL,'aafetsrom@softcube.co','0244304946','a');
/*!40000 ALTER TABLE `resellerAccounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resellerInvoice`
--

DROP TABLE IF EXISTS `resellerInvoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resellerInvoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reseller_account` int(11) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `invoice_period_start` datetime DEFAULT NULL,
  `invoice_period_end` datetime DEFAULT NULL,
  `invoice_due_date` datetime DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_resellerInvoice_1` (`reseller_account`),
  CONSTRAINT `fk_resellerInvoice_1` FOREIGN KEY (`reseller_account`) REFERENCES `resellerAccounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resellerInvoice`
--

LOCK TABLES `resellerInvoice` WRITE;
/*!40000 ALTER TABLE `resellerInvoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `resellerInvoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resellerPackages`
--

DROP TABLE IF EXISTS `resellerPackages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resellerPackages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `packageName` varchar(45) DEFAULT NULL,
  `space_limit` int(11) DEFAULT NULL,
  `duration_months` int(11) DEFAULT NULL,
  `domain_limit` int(11) DEFAULT NULL,
  `package_price` float DEFAULT NULL,
  `resellerAccount` int(11) DEFAULT NULL,
  `account_limit` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resellerPackages`
--

LOCK TABLES `resellerPackages` WRITE;
/*!40000 ALTER TABLE `resellerPackages` DISABLE KEYS */;
/*!40000 ALTER TABLE `resellerPackages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reseller_payment`
--

DROP TABLE IF EXISTS `reseller_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reseller_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reseller_invoice` int(11) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `amount_paid` float DEFAULT NULL,
  `payment_method` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reseller_payment_1` (`reseller_invoice`),
  CONSTRAINT `fk_reseller_payment_1` FOREIGN KEY (`reseller_invoice`) REFERENCES `resellerInvoice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reseller_payment`
--

LOCK TABLES `reseller_payment` WRITE;
/*!40000 ALTER TABLE `reseller_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `reseller_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `pword` varchar(200) NOT NULL,
  `created` date NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) NOT NULL,
  `mobile` int(11) DEFAULT NULL,
  `account` int(11) DEFAULT NULL,
  `superAdmin` char(1) DEFAULT NULL,
  `is_reseller` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `user_account_idx` (`account`),
  CONSTRAINT `user_account` FOREIGN KEY (`account`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (5,'softcube','Anthony','00c40739440b7f20a2071fe7a8b8f835','2013-04-22','aafetsrom@softcube.co','Afetsrom',244304946,NULL,'y','y');
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

-- Dump completed on 2013-04-22 20:35:45
