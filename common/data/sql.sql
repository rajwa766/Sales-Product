-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: sales
-- ------------------------------------------------------
-- Server version	5.7.14

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
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_detail_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_account_order1_idx` (`order_id`),
  KEY `fk_account_payment_detail1_idx` (`payment_detail_id`),
  CONSTRAINT `fk_account_order1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_account_payment_detail1` FOREIGN KEY (`payment_detail_id`) REFERENCES `payment_detail` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` VALUES ('customer','14',1514469004),('customer','15',1514470930),('customer','16',1514471982),('customer','18',1514566489),('general','11',1514022715),('general','12',1514027235),('general','17',1514562704),('general','6',1514027334),('seller','13',1514028687),('super_admin','1',1514021944);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('/*',2,NULL,NULL,NULL,1514022420,1514022420),('/admin/*',2,NULL,NULL,NULL,1514021828,1514021828),('/admin/assignment/*',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/assignment/assign',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/assignment/index',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/assignment/revoke',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/assignment/view',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/default/*',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/default/index',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/menu/*',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/menu/create',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/menu/delete',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/menu/index',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/menu/update',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/menu/view',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/permission/*',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/permission/assign',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/permission/create',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/permission/delete',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/permission/index',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/permission/remove',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/permission/update',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/permission/view',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/role/*',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/role/assign',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/role/create',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/role/delete',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/role/index',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/role/remove',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/role/update',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/role/view',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/route/*',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/route/assign',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/route/create',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/route/index',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/route/refresh',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/route/remove',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/rule/*',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/rule/create',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/rule/delete',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/rule/index',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/rule/update',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/rule/view',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/user/*',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/activate',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/change-password',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/delete',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/index',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/login',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/logout',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/request-password-reset',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/reset-password',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/signup',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/view',2,NULL,NULL,NULL,1514021827,1514021827),('/category/*',2,NULL,NULL,NULL,1514468712,1514468712),('/category/create',2,NULL,NULL,NULL,1514468715,1514468715),('/category/delete',2,NULL,NULL,NULL,1514468715,1514468715),('/category/index',2,NULL,NULL,NULL,1514468715,1514468715),('/category/update',2,NULL,NULL,NULL,1514468715,1514468715),('/category/view',2,NULL,NULL,NULL,1514468715,1514468715),('/customer/*',2,NULL,NULL,NULL,1514468716,1514468716),('/customer/create',2,NULL,NULL,NULL,1514468716,1514468716),('/customer/delete',2,NULL,NULL,NULL,1514468716,1514468716),('/customer/index',2,NULL,NULL,NULL,1514468715,1514468715),('/customer/update',2,NULL,NULL,NULL,1514468716,1514468716),('/customer/view',2,NULL,NULL,NULL,1514468716,1514468716),('/debug/*',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/default/*',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/default/db-explain',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/default/download-mail',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/default/index',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/default/toolbar',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/default/view',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/user/*',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/user/reset-identity',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/user/set-identity',2,NULL,NULL,NULL,1514022418,1514022418),('/gii/*',2,NULL,NULL,NULL,1514022419,1514022419),('/gii/default/*',2,NULL,NULL,NULL,1514022419,1514022419),('/gii/default/action',2,NULL,NULL,NULL,1514022419,1514022419),('/gii/default/diff',2,NULL,NULL,NULL,1514022419,1514022419),('/gii/default/index',2,NULL,NULL,NULL,1514022419,1514022419),('/gii/default/preview',2,NULL,NULL,NULL,1514022419,1514022419),('/gii/default/view',2,NULL,NULL,NULL,1514022419,1514022419),('/order/*',2,NULL,NULL,NULL,1514468716,1514468716),('/order/create',2,NULL,NULL,NULL,1514468716,1514468716),('/order/customer-level',2,NULL,NULL,NULL,1514468716,1514468716),('/order/delete',2,NULL,NULL,NULL,1514468716,1514468716),('/order/index',2,NULL,NULL,NULL,1514468716,1514468716),('/order/level',2,NULL,NULL,NULL,1514468716,1514468716),('/order/parentuser',2,NULL,NULL,NULL,1514468716,1514468716),('/order/update',2,NULL,NULL,NULL,1514468716,1514468716),('/order/view',2,NULL,NULL,NULL,1514468716,1514468716),('/product-order/*',2,NULL,NULL,NULL,1514468716,1514468716),('/product-order/create',2,NULL,NULL,NULL,1514468716,1514468716),('/product-order/delete',2,NULL,NULL,NULL,1514468716,1514468716),('/product-order/index',2,NULL,NULL,NULL,1514468716,1514468716),('/product-order/update',2,NULL,NULL,NULL,1514468716,1514468716),('/product-order/view',2,NULL,NULL,NULL,1514468716,1514468716),('/product/*',2,NULL,NULL,NULL,1514468716,1514468716),('/product/create',2,NULL,NULL,NULL,1514468716,1514468716),('/product/delete',2,NULL,NULL,NULL,1514468716,1514468716),('/product/index',2,NULL,NULL,NULL,1514468716,1514468716),('/product/update',2,NULL,NULL,NULL,1514468716,1514468716),('/product/view',2,NULL,NULL,NULL,1514468716,1514468716),('/site/*',2,NULL,NULL,NULL,1514022419,1514022419),('/site/about',2,NULL,NULL,NULL,1514022419,1514022419),('/site/captcha',2,NULL,NULL,NULL,1514022419,1514022419),('/site/contact',2,NULL,NULL,NULL,1514022419,1514022419),('/site/error',2,NULL,NULL,NULL,1514022419,1514022419),('/site/index',2,NULL,NULL,NULL,1514022419,1514022419),('/site/login',2,NULL,NULL,NULL,1514022419,1514022419),('/site/logout',2,NULL,NULL,NULL,1514022419,1514022419),('/site/request-password-reset',2,NULL,NULL,NULL,1514022419,1514022419),('/site/reset-password',2,NULL,NULL,NULL,1514022419,1514022419),('/site/signup',2,NULL,NULL,NULL,1514022419,1514022419),('/stock-in/*',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-in/create',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-in/delete',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-in/index',2,NULL,NULL,NULL,1514468716,1514468716),('/stock-in/update',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-in/view',2,NULL,NULL,NULL,1514468716,1514468716),('/stock-out/*',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-out/create',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-out/delete',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-out/index',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-out/update',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-out/view',2,NULL,NULL,NULL,1514468717,1514468717),('/user-product-level/*',2,NULL,NULL,NULL,1514531193,1514531193),('/user-product-level/create',2,NULL,NULL,NULL,1514531193,1514531193),('/user-product-level/delete',2,NULL,NULL,NULL,1514531193,1514531193),('/user-product-level/getunits',2,NULL,NULL,NULL,1514562795,1514562795),('/user-product-level/index',2,NULL,NULL,NULL,1514531193,1514531193),('/user-product-level/levelpakages',2,NULL,NULL,NULL,1514562795,1514562795),('/user-product-level/update',2,NULL,NULL,NULL,1514531193,1514531193),('/user-product-level/view',2,NULL,NULL,NULL,1514531193,1514531193),('/user/*',2,NULL,NULL,NULL,1514022420,1514022420),('/user/allcustomer',2,NULL,NULL,NULL,1514470389,1514470389),('/user/allcustomers',2,NULL,NULL,NULL,1514562795,1514562795),('/user/alllevel',2,NULL,NULL,NULL,1514025121,1514025121),('/user/create',2,NULL,NULL,NULL,1514022420,1514022420),('/user/customer',2,NULL,NULL,NULL,1514470389,1514470389),('/user/delete',2,NULL,NULL,NULL,1514022420,1514022420),('/user/index',2,NULL,NULL,NULL,1514022420,1514022420),('/user/level',2,NULL,NULL,NULL,1514468717,1514468717),('/user/parentuser',2,NULL,NULL,NULL,1514468717,1514468717),('/user/update',2,NULL,NULL,NULL,1514022420,1514022420),('/user/view',2,NULL,NULL,NULL,1514022420,1514022420),('customer',1,NULL,NULL,NULL,1514468736,1514468736),('general',1,NULL,NULL,NULL,1514021798,1514021798),('seller',1,NULL,NULL,NULL,1514028055,1514028055),('super_admin',1,NULL,NULL,NULL,1514021782,1514021782);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` VALUES ('super_admin','/*'),('super_admin','/admin/*'),('super_admin','/admin/assignment/*'),('super_admin','/admin/assignment/assign'),('super_admin','/admin/assignment/index'),('super_admin','/admin/assignment/revoke'),('super_admin','/admin/assignment/view'),('super_admin','/admin/default/*'),('super_admin','/admin/default/index'),('super_admin','/admin/menu/*'),('super_admin','/admin/menu/create'),('super_admin','/admin/menu/delete'),('super_admin','/admin/menu/index'),('super_admin','/admin/menu/update'),('super_admin','/admin/menu/view'),('super_admin','/admin/permission/*'),('super_admin','/admin/permission/assign'),('super_admin','/admin/permission/create'),('super_admin','/admin/permission/delete'),('super_admin','/admin/permission/index'),('super_admin','/admin/permission/remove'),('super_admin','/admin/permission/update'),('super_admin','/admin/permission/view'),('super_admin','/admin/role/*'),('super_admin','/admin/role/assign'),('super_admin','/admin/role/create'),('super_admin','/admin/role/delete'),('super_admin','/admin/role/index'),('super_admin','/admin/role/remove'),('super_admin','/admin/role/update'),('super_admin','/admin/role/view'),('super_admin','/admin/route/*'),('super_admin','/admin/route/assign'),('super_admin','/admin/route/create'),('super_admin','/admin/route/index'),('super_admin','/admin/route/refresh'),('super_admin','/admin/route/remove'),('super_admin','/admin/rule/*'),('super_admin','/admin/rule/create'),('super_admin','/admin/rule/delete'),('super_admin','/admin/rule/index'),('super_admin','/admin/rule/update'),('super_admin','/admin/rule/view'),('super_admin','/admin/user/*'),('super_admin','/admin/user/activate'),('super_admin','/admin/user/change-password'),('super_admin','/admin/user/delete'),('super_admin','/admin/user/index'),('super_admin','/admin/user/login'),('super_admin','/admin/user/logout'),('super_admin','/admin/user/request-password-reset'),('super_admin','/admin/user/reset-password'),('super_admin','/admin/user/signup'),('super_admin','/admin/user/view'),('super_admin','/category/*'),('super_admin','/category/create'),('super_admin','/category/delete'),('super_admin','/category/index'),('super_admin','/category/update'),('super_admin','/category/view'),('super_admin','/customer/*'),('super_admin','/customer/create'),('super_admin','/customer/delete'),('super_admin','/customer/index'),('super_admin','/customer/update'),('super_admin','/customer/view'),('seller','/debug/*'),('super_admin','/debug/*'),('super_admin','/debug/default/*'),('super_admin','/debug/default/db-explain'),('super_admin','/debug/default/download-mail'),('super_admin','/debug/default/index'),('super_admin','/debug/default/toolbar'),('super_admin','/debug/default/view'),('super_admin','/debug/user/*'),('super_admin','/debug/user/reset-identity'),('super_admin','/debug/user/set-identity'),('super_admin','/gii/*'),('super_admin','/gii/default/*'),('super_admin','/gii/default/action'),('super_admin','/gii/default/diff'),('super_admin','/gii/default/index'),('super_admin','/gii/default/preview'),('super_admin','/gii/default/view'),('super_admin','/order/*'),('customer','/order/create'),('general','/order/create'),('super_admin','/order/create'),('customer','/order/customer-level'),('general','/order/customer-level'),('super_admin','/order/customer-level'),('super_admin','/order/delete'),('customer','/order/index'),('general','/order/index'),('super_admin','/order/index'),('customer','/order/level'),('general','/order/level'),('super_admin','/order/level'),('customer','/order/parentuser'),('general','/order/parentuser'),('super_admin','/order/parentuser'),('customer','/order/update'),('general','/order/update'),('super_admin','/order/update'),('customer','/order/view'),('general','/order/view'),('super_admin','/order/view'),('super_admin','/product-order/*'),('super_admin','/product-order/create'),('super_admin','/product-order/delete'),('super_admin','/product-order/index'),('super_admin','/product-order/update'),('super_admin','/product-order/view'),('super_admin','/product/*'),('super_admin','/product/create'),('super_admin','/product/delete'),('super_admin','/product/index'),('super_admin','/product/update'),('super_admin','/product/view'),('customer','/site/*'),('general','/site/*'),('seller','/site/*'),('super_admin','/site/*'),('general','/site/about'),('super_admin','/site/about'),('general','/site/captcha'),('super_admin','/site/captcha'),('general','/site/contact'),('super_admin','/site/contact'),('general','/site/error'),('super_admin','/site/error'),('general','/site/index'),('super_admin','/site/index'),('general','/site/login'),('super_admin','/site/login'),('general','/site/logout'),('super_admin','/site/logout'),('general','/site/request-password-reset'),('super_admin','/site/request-password-reset'),('general','/site/reset-password'),('super_admin','/site/reset-password'),('general','/site/signup'),('super_admin','/site/signup'),('super_admin','/stock-in/*'),('super_admin','/stock-in/create'),('super_admin','/stock-in/delete'),('super_admin','/stock-in/index'),('super_admin','/stock-in/update'),('super_admin','/stock-in/view'),('super_admin','/stock-out/*'),('super_admin','/stock-out/create'),('super_admin','/stock-out/delete'),('super_admin','/stock-out/index'),('super_admin','/stock-out/update'),('super_admin','/stock-out/view'),('super_admin','/user-product-level/*'),('super_admin','/user-product-level/create'),('super_admin','/user-product-level/delete'),('customer','/user-product-level/getunits'),('general','/user-product-level/getunits'),('super_admin','/user-product-level/getunits'),('super_admin','/user-product-level/index'),('customer','/user-product-level/levelpakages'),('general','/user-product-level/levelpakages'),('super_admin','/user-product-level/levelpakages'),('super_admin','/user-product-level/update'),('super_admin','/user-product-level/view'),('customer','/user/*'),('general','/user/*'),('super_admin','/user/*'),('customer','/user/allcustomer'),('general','/user/allcustomer'),('super_admin','/user/allcustomer'),('customer','/user/allcustomers'),('general','/user/allcustomers'),('super_admin','/user/allcustomers'),('customer','/user/alllevel'),('general','/user/alllevel'),('super_admin','/user/alllevel'),('general','/user/create'),('super_admin','/user/create'),('general','/user/customer'),('super_admin','/user/customer'),('general','/user/delete'),('super_admin','/user/delete'),('general','/user/index'),('super_admin','/user/index'),('general','/user/level'),('super_admin','/user/level'),('customer','/user/parentuser'),('general','/user/parentuser'),('super_admin','/user/parentuser'),('general','/user/update'),('super_admin','/user/update'),('general','/user/view'),('super_admin','/user/view');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `post_code` varchar(45) DEFAULT NULL,
  `district` varchar(45) DEFAULT NULL,
  `province` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `name` varchar(450) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_image_product1_idx` (`product_id`),
  CONSTRAINT `fk_image_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image`
--

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1513230445),('m130524_201442_init',1513230450);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_ref_no` varchar(45) DEFAULT NULL,
  `shipper` varchar(45) DEFAULT NULL,
  `cod` varchar(45) DEFAULT NULL,
  `additional_requirements` varchar(45) DEFAULT NULL,
  `file` varchar(250) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `order_request_id` int(11) NOT NULL,
  `entity_id` int(11) DEFAULT NULL,
  `entity_type` int(11) DEFAULT NULL,
  `requested_date` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_user1_idx` (`user_id`),
  CONSTRAINT `fk_order_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (1,'','','',NULL,NULL,1,NULL,6,NULL,2,NULL,NULL,NULL,NULL,NULL),(2,'fsdf','2','',NULL,NULL,1,NULL,6,NULL,4,NULL,NULL,NULL,NULL,NULL),(3,'','','',NULL,NULL,1,NULL,5,NULL,2,NULL,NULL,NULL,NULL,NULL),(4,'','','',NULL,NULL,1,NULL,17,NULL,3,NULL,17,17,'2017-12-29 16:53:01','2017-12-29 16:53:01');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_detail`
--

DROP TABLE IF EXISTS `payment_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_method` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_detail`
--

LOCK TABLES `payment_detail` WRITE;
/*!40000 ALTER TABLE `payment_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` text,
  `price` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_category_idx` (`category_id`),
  CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,NULL,'Bey dey','This is a single product special aalooo',780);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_order`
--

DROP TABLE IF EXISTS `product_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `order_price` double DEFAULT NULL,
  `requested_quantity` int(11) DEFAULT NULL,
  `requested_price` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_order_order1_idx` (`order_id`),
  CONSTRAINT `fk_product_order_order1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_order`
--

LOCK TABLES `product_order` WRITE;
/*!40000 ALTER TABLE `product_order` DISABLE KEYS */;
INSERT INTO `product_order` VALUES (1,1,5000,390,5000,390),(2,2,5000,390,5000,390),(3,2,4000,400,4000,400),(4,2,3000,410,3000,410),(5,3,5000,390,5000,390),(6,4,4000,400,4000,400);
/*!40000 ALTER TABLE `product_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_in`
--

DROP TABLE IF EXISTS `stock_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_in` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `initial_quantity` int(11) DEFAULT NULL,
  `remaining_quantity` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_stock_in_product1_idx` (`product_id`),
  KEY `fk_stock_in_user1_idx` (`user_id`),
  CONSTRAINT `fk_stock_in_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_in_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_in`
--

LOCK TABLES `stock_in` WRITE;
/*!40000 ALTER TABLE `stock_in` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock_in` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_out`
--

DROP TABLE IF EXISTS `stock_out`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_out` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `stock_in_id` int(11) NOT NULL,
  `product_order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_stock_out_stock_in1_idx` (`stock_in_id`),
  KEY `fk_stock_out_product_order1_idx` (`product_order_id`),
  CONSTRAINT `fk_stock_out_product_order1` FOREIGN KEY (`product_order_id`) REFERENCES `product_order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_out_stock_in1` FOREIGN KEY (`stock_in_id`) REFERENCES `stock_in` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_out`
--

LOCK TABLES `stock_out` WRITE;
/*!40000 ALTER TABLE `stock_out` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock_out` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(6) DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `link` varchar(450) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `user_level_id` int(11) DEFAULT NULL,
  `phone_no` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(5000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  KEY `fk_user_user_level1_idx` (`user_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','Uek95ngbqlOBh-jaQ0Gv3SQ9FD4CGFC3','$2y$13$dOgQuJVwIEy7JLEEb.RhhOf2eHwMkzVEgf7vpdS1t0DbuwkI/Zcea',NULL,'admin@admin.com',1,1513230560,'site/odrer/1',1514033004,0,1,'','','0','0','Admin',''),(2,NULL,NULL,NULL,NULL,NULL,1,1513678022,NULL,1513678022,NULL,NULL,'','','0','0',NULL,NULL),(3,NULL,'Bnr9mbgWr7nBdN9BtRtdJRxNykqXq8jL',NULL,NULL,NULL,1,1513678350,NULL,1513678350,NULL,NULL,'','','0','0',NULL,NULL),(4,NULL,NULL,NULL,NULL,NULL,1,1513678683,NULL,1513678683,NULL,NULL,'','','0','0',NULL,NULL),(5,'user','0eGXqA5NW3w4_Wmnu3NoEOpHV7OXrYwp','$2y$13$WvYWGP4VQ7AGnKk1lzLl8.iNA0vvxPKJZD0M2CrjUNwWBQa0VDDjy',NULL,'bas@gmail.com',1,1513765621,NULL,1513765621,NULL,NULL,'','','0','0',NULL,NULL),(6,'sajid','cHVjEJdfuLQrtPbWkwLh6sPFIStW8pve','$2y$13$.RCnYcjTNrE2humyyawfIuhkKWJlCSvZIdOtvybqzC7L5LEVmWZcq',NULL,'john@gmail.com',1,1513871106,NULL,1513953254,1,2,'03008332781','223 E. Concord Street, Orlando','Florida','USA',NULL,NULL),(7,'safi','sF_JuqRNiIAmNvuz39eQWAFx4Y_JvnH6','$2y$13$dFWI5U3kWSR9txuRQSsUTOzTf89FxG8oCgyhHbfbI4Tl8/y19oZo2',NULL,'raj@gmail.com',1,1513871278,NULL,1513871278,1,2,'03008332781','thirty to streek khan poor, bareek road london','','',NULL,NULL),(8,'usman','1WBgxJMAO2xLYW7bWI9yRTnQz2soXipC','$2y$13$jM1folT1M6f2WfY0b3PIhe2JVWa6FmLDeKdoEHbtCPkarFHDka25q',NULL,'usman@gmail.com',1,1513871916,NULL,1513871916,2,4,'','','','',NULL,NULL),(9,'bashir','3c02RedtIOOjO8VtrWFs8yfFUFgnTF9M','$2y$13$e1bww0eaNdXtutyk.40f5u65s5.FsWt4D.mJYGrePabZPki5DrTvi',NULL,'bashir@gmail.com',1,1513937847,NULL,1513937847,1,2,'03008332781','thirty to streek khan poor, bareek road london','islamabad','Pakistan',NULL,NULL),(11,'freed','-Hzl0E11S2v_n4iLYrn-Tc3riWEMWNB6','$2y$13$AFM19pgPRv2uDOzZ1b7IdOyxSBYG0T84MWtQ4w324HZLKl9i0jXzG',NULL,'fareed@gmail.com',1,1514022715,NULL,1514022715,1,2,'03008332781','thirty to streek khan poor, bareek road london','islamabad','Pakistan',NULL,NULL),(12,'Meherbab','nBUFSZoTuoCAzEEVBPpOC9jLtuxOf-w2','$2y$13$vINcyhpBmcProKtL0.8lIOE752Xq9nHeikjic7u9GTlo.UGUOZgvS',NULL,'meherbac@gmail.com',1,1514027235,NULL,1514027235,6,4,'03008332781','thirty to streek khan poor, bareek road london','islamabad','Pakistan',NULL,NULL),(13,'habib','aEEBEZoX_LjdF2EY_wJ06eqA802pymYB','$2y$13$17bV4f8h7ZSVv.WV3JaKpO2BJZNB1wa0D795gES6b6cJj.tg.Wn1C',NULL,'habib@gmail.com',1,1514028686,NULL,1514028686,1,3,'03008332781','thirty to streek khan poor, bareek road london','islamabad','Pakistan',NULL,NULL),(14,'aslam','RoRnVZLXoYCqtdNftqXUVAJrN6AQtwUs','$2y$13$ZVHVkaTQcGG4MmrKN3/JXOj7e7lQ4M/l.IgGKVe7zaoavG5qtJGEi',NULL,'aslam@centangle.com',1,1514469004,NULL,1514469004,NULL,NULL,NULL,NULL,NULL,NULL,'aslam','muhammad'),(15,'naeem','ttr-XrlpUdATzhgEcIeAB9zUN_gFzz-h','$2y$13$FmFFgC68xFX3edVTU/hrRuO5qpodVxKZlLs9kO51fXDVCOpEykQRO',NULL,'naeem@gmail.com',1,1514470929,NULL,1514470929,NULL,NULL,'98765','','','Thailand ','Naeem','Khan'),(16,'asad','Iir_lnTyuQimSyOhf__S2xYmgQW_2Nws','$2y$13$Nd7mSBlaPalUXGN0TccwYOPJ8dDE6j2cLSUp8v3Qwy8XLUJK9weG2',NULL,'asad@gmail.com',1,1514471982,NULL,1514471982,NULL,NULL,'','','','Thailand ','asad','asad'),(17,'shuja','n-opqEJ35nt9iziHqVBS0Yv_NUtHdd4-','$2y$13$XoCEnmW.92W0tdSflggFQO3Fh9wWeXZqyZ9oF6j5P.Y47A2Pdr1ZW',NULL,'shuja@gmail.com',1,1514562704,NULL,1514562704,1,2,'03008332781','thirty to streek khan poor, bareek road london','islamabad','Thailand ','shuja','shuja'),(18,'badar','_Th8jiBfwxDt0kaYnPYCWREF_Q0bTUxM','$2y$13$tqZlyul3PBZ4DSWVE7p19eEf0V1EMuiiebfaJjM1uZfBY4I9L9KhG',NULL,'badar@gmail.com',1,1514566488,NULL,1514566488,NULL,NULL,'03008332781','thirty to streek khan poor','islamabad','Thailand ','badar','badar');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_product_level`
--

DROP TABLE IF EXISTS `user_product_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_product_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `units` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `user_level_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_product_level_product1_idx` (`product_id`),
  KEY `fk_user_product_level_user_level1_idx` (`user_level_id`),
  CONSTRAINT `fk_user_product_level_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_product_level_user_level1` FOREIGN KEY (`user_level_id`) REFERENCES `users_level` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_product_level`
--

LOCK TABLES `user_product_level` WRITE;
/*!40000 ALTER TABLE `user_product_level` DISABLE KEYS */;
INSERT INTO `user_product_level` VALUES (1,1,50000,600,1),(2,1,5000,390,2),(3,1,4000,400,2),(4,1,3000,410,2),(5,1,2000,420,2),(6,1,1000,410,2),(7,1,1000,440,4),(8,1,500,480,6),(9,1,250,520,10),(10,1,100,550,11),(11,1,50,590,12),(12,1,10,630,13);
/*!40000 ALTER TABLE `user_product_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_level`
--

DROP TABLE IF EXISTS `users_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(450) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `max_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_level`
--

LOCK TABLES `users_level` WRITE;
/*!40000 ALTER TABLE `users_level` DISABLE KEYS */;
INSERT INTO `users_level` VALUES (1,'Super Admin',0,1),(2,'Management Team',1,20),(3,'Management Team Seller',1,-1),(4,'Super Vip Team ',2,100),(5,'Super Vip Team Seller',2,-1),(6,'VIP Team',4,1000),(8,'VIP Team Sellers',4,-1),(10,'PRO Level',6,-1),(11,'INTER Level',6,-1),(12,'ADVANCE Level',6,-1),(13,'BEGIN Level',6,-1);
/*!40000 ALTER TABLE `users_level` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-29 22:47:50
