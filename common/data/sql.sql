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
INSERT INTO `auth_assignment` VALUES ('customer','14',1514469004),('customer','15',1514470930),('customer','16',1514471982),('customer','18',1514566489),('customer','22',1514814724),('customer','24',1515052281),('general','11',1514022715),('general','12',1514027235),('general','17',1514562704),('general','19',1514584106),('general','21',1514813516),('general','23',1514817003),('general','6',1514027334),('seller','13',1514028687),('seller','20',1514584170),('super_admin','1',1514021944);
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
INSERT INTO `auth_item` VALUES ('/*',2,NULL,NULL,NULL,1514022420,1514022420),('/admin/*',2,NULL,NULL,NULL,1514021828,1514021828),('/admin/assignment/*',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/assignment/assign',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/assignment/index',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/assignment/revoke',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/assignment/view',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/default/*',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/default/index',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/menu/*',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/menu/create',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/menu/delete',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/menu/index',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/menu/update',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/menu/view',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/permission/*',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/permission/assign',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/permission/create',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/permission/delete',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/permission/index',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/permission/remove',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/permission/update',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/permission/view',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/role/*',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/role/assign',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/role/create',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/role/delete',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/role/index',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/role/remove',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/role/update',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/role/view',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/route/*',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/route/assign',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/route/create',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/route/index',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/route/refresh',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/route/remove',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/rule/*',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/rule/create',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/rule/delete',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/rule/index',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/rule/update',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/rule/view',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/user/*',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/activate',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/change-password',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/delete',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/index',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/login',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/logout',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/request-password-reset',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/reset-password',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/signup',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/view',2,NULL,NULL,NULL,1514021827,1514021827),('/category/*',2,NULL,NULL,NULL,1514468712,1514468712),('/category/create',2,NULL,NULL,NULL,1514468715,1514468715),('/category/delete',2,NULL,NULL,NULL,1514468715,1514468715),('/category/index',2,NULL,NULL,NULL,1514468715,1514468715),('/category/update',2,NULL,NULL,NULL,1514468715,1514468715),('/category/view',2,NULL,NULL,NULL,1514468715,1514468715),('/customer/*',2,NULL,NULL,NULL,1514468716,1514468716),('/customer/create',2,NULL,NULL,NULL,1514468716,1514468716),('/customer/delete',2,NULL,NULL,NULL,1514468716,1514468716),('/customer/index',2,NULL,NULL,NULL,1514468715,1514468715),('/customer/update',2,NULL,NULL,NULL,1514468716,1514468716),('/customer/view',2,NULL,NULL,NULL,1514468716,1514468716),('/debug/*',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/default/*',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/default/db-explain',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/default/download-mail',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/default/index',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/default/toolbar',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/default/view',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/user/*',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/user/reset-identity',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/user/set-identity',2,NULL,NULL,NULL,1514022418,1514022418),('/gii/*',2,NULL,NULL,NULL,1514022419,1514022419),('/gii/default/*',2,NULL,NULL,NULL,1514022419,1514022419),('/gii/default/action',2,NULL,NULL,NULL,1514022419,1514022419),('/gii/default/diff',2,NULL,NULL,NULL,1514022419,1514022419),('/gii/default/index',2,NULL,NULL,NULL,1514022419,1514022419),('/gii/default/preview',2,NULL,NULL,NULL,1514022419,1514022419),('/gii/default/view',2,NULL,NULL,NULL,1514022419,1514022419),('/order/*',2,NULL,NULL,NULL,1514468716,1514468716),('/order/approved',2,NULL,NULL,NULL,1515048076,1515048076),('/order/avi',2,NULL,NULL,NULL,1515048076,1515048076),('/order/cancel',2,NULL,NULL,NULL,1515048075,1515048075),('/order/create',2,NULL,NULL,NULL,1514468716,1514468716),('/order/createreturn',2,NULL,NULL,NULL,1515048076,1515048076),('/order/customer-level',2,NULL,NULL,NULL,1514468716,1514468716),('/order/delete',2,NULL,NULL,NULL,1514468716,1514468716),('/order/index',2,NULL,NULL,NULL,1514468716,1514468716),('/order/level',2,NULL,NULL,NULL,1514468716,1514468716),('/order/parentuser',2,NULL,NULL,NULL,1514468716,1514468716),('/order/pending',2,NULL,NULL,NULL,1514889580,1514889580),('/order/return',2,NULL,NULL,NULL,1515048076,1515048076),('/order/update',2,NULL,NULL,NULL,1514468716,1514468716),('/order/view',2,NULL,NULL,NULL,1514468716,1514468716),('/product-order/*',2,NULL,NULL,NULL,1514468716,1514468716),('/product-order/create',2,NULL,NULL,NULL,1514468716,1514468716),('/product-order/delete',2,NULL,NULL,NULL,1514468716,1514468716),('/product-order/index',2,NULL,NULL,NULL,1514468716,1514468716),('/product-order/update',2,NULL,NULL,NULL,1514468716,1514468716),('/product-order/view',2,NULL,NULL,NULL,1514468716,1514468716),('/product/*',2,NULL,NULL,NULL,1514468716,1514468716),('/product/create',2,NULL,NULL,NULL,1514468716,1514468716),('/product/delete',2,NULL,NULL,NULL,1514468716,1514468716),('/product/index',2,NULL,NULL,NULL,1514468716,1514468716),('/product/update',2,NULL,NULL,NULL,1514468716,1514468716),('/product/view',2,NULL,NULL,NULL,1514468716,1514468716),('/shipping-address/*',2,NULL,NULL,NULL,1514889580,1514889580),('/shipping-address/create',2,NULL,NULL,NULL,1514889580,1514889580),('/shipping-address/delete',2,NULL,NULL,NULL,1514889580,1514889580),('/shipping-address/index',2,NULL,NULL,NULL,1514889580,1514889580),('/shipping-address/update',2,NULL,NULL,NULL,1514889580,1514889580),('/shipping-address/view',2,NULL,NULL,NULL,1514889580,1514889580),('/site/*',2,NULL,NULL,NULL,1514022419,1514022419),('/site/about',2,NULL,NULL,NULL,1514022419,1514022419),('/site/captcha',2,NULL,NULL,NULL,1514022419,1514022419),('/site/contact',2,NULL,NULL,NULL,1514022419,1514022419),('/site/error',2,NULL,NULL,NULL,1514022419,1514022419),('/site/index',2,NULL,NULL,NULL,1514022419,1514022419),('/site/login',2,NULL,NULL,NULL,1514022419,1514022419),('/site/logout',2,NULL,NULL,NULL,1514022419,1514022419),('/site/request-password-reset',2,NULL,NULL,NULL,1514022419,1514022419),('/site/reset-password',2,NULL,NULL,NULL,1514022419,1514022419),('/site/signup',2,NULL,NULL,NULL,1514022419,1514022419),('/stock-in/*',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-in/approve',2,NULL,NULL,NULL,1514889580,1514889580),('/stock-in/create',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-in/delete',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-in/index',2,NULL,NULL,NULL,1514468716,1514468716),('/stock-in/update',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-in/view',2,NULL,NULL,NULL,1514468716,1514468716),('/stock-out/*',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-out/create',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-out/delete',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-out/index',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-out/update',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-out/view',2,NULL,NULL,NULL,1514468717,1514468717),('/user-product-level/*',2,NULL,NULL,NULL,1514531193,1514531193),('/user-product-level/create',2,NULL,NULL,NULL,1514531193,1514531193),('/user-product-level/delete',2,NULL,NULL,NULL,1514531193,1514531193),('/user-product-level/getunits',2,NULL,NULL,NULL,1514562795,1514562795),('/user-product-level/index',2,NULL,NULL,NULL,1514531193,1514531193),('/user-product-level/levelpakages',2,NULL,NULL,NULL,1514562795,1514562795),('/user-product-level/update',2,NULL,NULL,NULL,1514531193,1514531193),('/user-product-level/view',2,NULL,NULL,NULL,1514531193,1514531193),('/user/*',2,NULL,NULL,NULL,1514022420,1514022420),('/user/allcustomer',2,NULL,NULL,NULL,1514470389,1514470389),('/user/allcustomers',2,NULL,NULL,NULL,1514562795,1514562795),('/user/alllevel',2,NULL,NULL,NULL,1514025121,1514025121),('/user/create',2,NULL,NULL,NULL,1514022420,1514022420),('/user/customer',2,NULL,NULL,NULL,1514470389,1514470389),('/user/delete',2,NULL,NULL,NULL,1514022420,1514022420),('/user/getuseraddress',2,NULL,NULL,NULL,1514889580,1514889580),('/user/index',2,NULL,NULL,NULL,1514022420,1514022420),('/user/level',2,NULL,NULL,NULL,1514468717,1514468717),('/user/parentuser',2,NULL,NULL,NULL,1514468717,1514468717),('/user/update',2,NULL,NULL,NULL,1514022420,1514022420),('/user/view',2,NULL,NULL,NULL,1514022420,1514022420),('customer',1,NULL,NULL,NULL,1514468736,1514468736),('general',1,NULL,NULL,NULL,1514021798,1514021798),('seller',1,NULL,NULL,NULL,1514028055,1514028055),('super_admin',1,NULL,NULL,NULL,1514021782,1514021782);
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
INSERT INTO `auth_item_child` VALUES ('super_admin','/*'),('super_admin','/admin/*'),('super_admin','/admin/assignment/*'),('super_admin','/admin/assignment/assign'),('super_admin','/admin/assignment/index'),('super_admin','/admin/assignment/revoke'),('super_admin','/admin/assignment/view'),('super_admin','/admin/default/*'),('super_admin','/admin/default/index'),('super_admin','/admin/menu/*'),('super_admin','/admin/menu/create'),('super_admin','/admin/menu/delete'),('super_admin','/admin/menu/index'),('super_admin','/admin/menu/update'),('super_admin','/admin/menu/view'),('super_admin','/admin/permission/*'),('super_admin','/admin/permission/assign'),('super_admin','/admin/permission/create'),('super_admin','/admin/permission/delete'),('super_admin','/admin/permission/index'),('super_admin','/admin/permission/remove'),('super_admin','/admin/permission/update'),('super_admin','/admin/permission/view'),('super_admin','/admin/role/*'),('super_admin','/admin/role/assign'),('super_admin','/admin/role/create'),('super_admin','/admin/role/delete'),('super_admin','/admin/role/index'),('super_admin','/admin/role/remove'),('super_admin','/admin/role/update'),('super_admin','/admin/role/view'),('super_admin','/admin/route/*'),('super_admin','/admin/route/assign'),('super_admin','/admin/route/create'),('super_admin','/admin/route/index'),('super_admin','/admin/route/refresh'),('super_admin','/admin/route/remove'),('super_admin','/admin/rule/*'),('super_admin','/admin/rule/create'),('super_admin','/admin/rule/delete'),('super_admin','/admin/rule/index'),('super_admin','/admin/rule/update'),('super_admin','/admin/rule/view'),('super_admin','/admin/user/*'),('super_admin','/admin/user/activate'),('super_admin','/admin/user/change-password'),('super_admin','/admin/user/delete'),('super_admin','/admin/user/index'),('super_admin','/admin/user/login'),('super_admin','/admin/user/logout'),('super_admin','/admin/user/request-password-reset'),('super_admin','/admin/user/reset-password'),('super_admin','/admin/user/signup'),('super_admin','/admin/user/view'),('super_admin','/category/*'),('super_admin','/category/create'),('super_admin','/category/delete'),('super_admin','/category/index'),('super_admin','/category/update'),('super_admin','/category/view'),('super_admin','/customer/*'),('super_admin','/customer/create'),('super_admin','/customer/delete'),('super_admin','/customer/index'),('super_admin','/customer/update'),('super_admin','/customer/view'),('seller','/debug/*'),('super_admin','/debug/*'),('super_admin','/debug/default/*'),('super_admin','/debug/default/db-explain'),('super_admin','/debug/default/download-mail'),('super_admin','/debug/default/index'),('super_admin','/debug/default/toolbar'),('super_admin','/debug/default/view'),('super_admin','/debug/user/*'),('super_admin','/debug/user/reset-identity'),('super_admin','/debug/user/set-identity'),('super_admin','/gii/*'),('super_admin','/gii/default/*'),('super_admin','/gii/default/action'),('super_admin','/gii/default/diff'),('super_admin','/gii/default/index'),('super_admin','/gii/default/preview'),('super_admin','/gii/default/view'),('customer','/order/*'),('super_admin','/order/*'),('super_admin','/order/approved'),('super_admin','/order/avi'),('super_admin','/order/cancel'),('customer','/order/create'),('general','/order/create'),('super_admin','/order/create'),('super_admin','/order/createreturn'),('customer','/order/customer-level'),('general','/order/customer-level'),('super_admin','/order/customer-level'),('super_admin','/order/delete'),('customer','/order/index'),('general','/order/index'),('super_admin','/order/index'),('customer','/order/level'),('general','/order/level'),('super_admin','/order/level'),('customer','/order/parentuser'),('general','/order/parentuser'),('super_admin','/order/parentuser'),('super_admin','/order/pending'),('super_admin','/order/return'),('customer','/order/update'),('general','/order/update'),('super_admin','/order/update'),('customer','/order/view'),('general','/order/view'),('super_admin','/order/view'),('super_admin','/product-order/*'),('super_admin','/product-order/create'),('super_admin','/product-order/delete'),('super_admin','/product-order/index'),('super_admin','/product-order/update'),('super_admin','/product-order/view'),('super_admin','/product/*'),('super_admin','/product/create'),('super_admin','/product/delete'),('super_admin','/product/index'),('super_admin','/product/update'),('super_admin','/product/view'),('super_admin','/shipping-address/*'),('super_admin','/shipping-address/create'),('super_admin','/shipping-address/delete'),('super_admin','/shipping-address/index'),('super_admin','/shipping-address/update'),('super_admin','/shipping-address/view'),('customer','/site/*'),('general','/site/*'),('seller','/site/*'),('super_admin','/site/*'),('general','/site/about'),('super_admin','/site/about'),('general','/site/captcha'),('super_admin','/site/captcha'),('general','/site/contact'),('super_admin','/site/contact'),('general','/site/error'),('super_admin','/site/error'),('general','/site/index'),('super_admin','/site/index'),('general','/site/login'),('super_admin','/site/login'),('general','/site/logout'),('super_admin','/site/logout'),('general','/site/request-password-reset'),('super_admin','/site/request-password-reset'),('general','/site/reset-password'),('super_admin','/site/reset-password'),('general','/site/signup'),('super_admin','/site/signup'),('super_admin','/stock-in/*'),('super_admin','/stock-in/approve'),('super_admin','/stock-in/create'),('super_admin','/stock-in/delete'),('super_admin','/stock-in/index'),('super_admin','/stock-in/update'),('super_admin','/stock-in/view'),('super_admin','/stock-out/*'),('super_admin','/stock-out/create'),('super_admin','/stock-out/delete'),('super_admin','/stock-out/index'),('super_admin','/stock-out/update'),('super_admin','/stock-out/view'),('super_admin','/user-product-level/*'),('super_admin','/user-product-level/create'),('super_admin','/user-product-level/delete'),('customer','/user-product-level/getunits'),('general','/user-product-level/getunits'),('super_admin','/user-product-level/getunits'),('super_admin','/user-product-level/index'),('customer','/user-product-level/levelpakages'),('general','/user-product-level/levelpakages'),('super_admin','/user-product-level/levelpakages'),('super_admin','/user-product-level/update'),('super_admin','/user-product-level/view'),('customer','/user/*'),('general','/user/*'),('super_admin','/user/*'),('customer','/user/allcustomer'),('general','/user/allcustomer'),('super_admin','/user/allcustomer'),('customer','/user/allcustomers'),('general','/user/allcustomers'),('super_admin','/user/allcustomers'),('customer','/user/alllevel'),('general','/user/alllevel'),('super_admin','/user/alllevel'),('general','/user/create'),('super_admin','/user/create'),('general','/user/customer'),('super_admin','/user/customer'),('general','/user/delete'),('super_admin','/user/delete'),('super_admin','/user/getuseraddress'),('general','/user/index'),('super_admin','/user/index'),('general','/user/level'),('super_admin','/user/level'),('customer','/user/parentuser'),('general','/user/parentuser'),('super_admin','/user/parentuser'),('general','/user/update'),('super_admin','/user/update'),('general','/user/view'),('super_admin','/user/view');
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
  `status` int(11) DEFAULT '0',
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (19,'','','',NULL,NULL,23,1,1,NULL,3,NULL,1,1,'2018-01-03 11:57:45','2018-01-03 11:57:45'),(20,'','','',NULL,NULL,24,0,1,NULL,1,NULL,1,1,'2018-01-04 08:00:32','2018-01-04 08:00:32'),(21,'fsdf','','',NULL,NULL,23,0,1,NULL,2,NULL,23,23,'2018-01-04 09:12:45','2018-01-04 09:12:45'),(22,'fsdf','','',NULL,NULL,24,0,23,NULL,3,NULL,23,23,'2018-01-04 09:13:49','2018-01-04 09:13:49'),(23,'4444','','',NULL,NULL,23,1,1,NULL,5,NULL,1,1,'2018-01-04 09:17:14','2018-01-04 09:17:14'),(24,'','','',NULL,NULL,23,1,1,NULL,5,NULL,1,1,'2018-01-04 18:48:14','2018-01-04 18:48:14'),(25,'','','',NULL,NULL,23,1,1,NULL,11,NULL,1,1,'2018-01-04 18:49:27','2018-01-04 18:49:27');
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
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_order_order1_idx` (`order_id`),
  KEY `fk_product_order_product1_idx` (`product_id`),
  CONSTRAINT `fk_product_order_order1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_order_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_order`
--

LOCK TABLES `product_order` WRITE;
/*!40000 ALTER TABLE `product_order` DISABLE KEYS */;
INSERT INTO `product_order` VALUES (24,19,2000,420,2000,420,1),(25,19,2000,420,2000,420,1),(26,19,4000,400,4000,400,1),(27,20,50000,600,50000,600,1),(28,20,50000,600,50000,600,1),(29,21,5000,390,5000,390,1),(30,22,4000,400,4000,400,1),(31,23,4000,400,4000,400,1),(32,23,2000,420,2000,420,1),(33,24,4000,400,4000,400,1),(34,24,2000,420,2000,420,1),(35,25,1000,440,1000,440,1),(36,25,50,590,50,590,1);
/*!40000 ALTER TABLE `product_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipping_address`
--

DROP TABLE IF EXISTS `shipping_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shipping_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_no` varchar(100) DEFAULT NULL,
  `mobile_no` varchar(100) DEFAULT NULL,
  `postal_code` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping_address`
--

LOCK TABLES `shipping_address` WRITE;
/*!40000 ALTER TABLE `shipping_address` DISABLE KEYS */;
INSERT INTO `shipping_address` VALUES (1,19,'sajid@gmail.com','03008332781','','','','','Thailand '),(2,20,'badar@gmail.com','03008332781','','','','','Thailand '),(3,21,'badar@gmail.com','03008332781','','','','','Thailand '),(4,22,'badar@gmail.com','03008332781','','','','','Thailand '),(5,23,'sajid@gmail.com','03008332781','','','','','Thailand '),(6,24,'sajid@gmail.com','03008332781','','','','','Thailand '),(7,25,'sajid@gmail.com','03008332781','','','','','Thailand ');
/*!40000 ALTER TABLE `shipping_address` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_in`
--

LOCK TABLES `stock_in` WRITE;
/*!40000 ALTER TABLE `stock_in` DISABLE KEYS */;
INSERT INTO `stock_in` VALUES (1,'2018-01-02 09:49:37',26000,0,780,1,1),(2,'2018-01-03 12:46:16',16000,8950,420,1,23),(3,'2018-01-03 12:46:16',14000,14000,420,1,23),(4,'2018-01-03 12:46:16',10000,10000,400,1,23),(5,'2018-01-03 12:47:47',8000,8000,420,1,23),(6,'2018-01-03 12:47:47',6000,6000,420,1,23),(7,'2018-01-03 12:47:47',2000,2000,400,1,23),(8,'2018-01-04 09:25:33',12000,8000,400,1,1),(9,'2018-01-04 09:25:33',10000,10000,420,1,1),(10,'2018-01-04 18:48:30',2000,2000,400,1,23),(11,'2018-01-04 18:48:30',2000,2000,400,1,23),(12,'2018-01-04 18:48:30',2000,2000,420,1,23),(13,'2018-01-04 18:49:38',1000,1000,440,1,1),(14,'2018-01-04 18:49:38',50,50,590,1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_out`
--

LOCK TABLES `stock_out` WRITE;
/*!40000 ALTER TABLE `stock_out` DISABLE KEYS */;
INSERT INTO `stock_out` VALUES (1,2000,NULL,1,24),(2,2000,NULL,1,25),(3,4000,NULL,1,26),(9,2000,NULL,1,24),(10,2000,NULL,1,25),(11,4000,NULL,1,26),(12,2000,'2018-01-03 12:47:47',1,24),(13,2000,'2018-01-03 12:47:47',1,25),(14,4000,'2018-01-03 12:47:47',1,26),(15,4000,'2018-01-04 09:25:33',2,31),(16,2000,'2018-01-04 09:25:33',2,32),(17,2000,'2018-01-04 18:48:30',1,33),(18,2000,'2018-01-04 18:48:30',8,33),(19,2000,'2018-01-04 18:48:30',8,34),(20,1000,'2018-01-04 18:49:38',2,35),(21,50,'2018-01-04 18:49:38',2,36);
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
  `mobile_no` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `district` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','Uek95ngbqlOBh-jaQ0Gv3SQ9FD4CGFC3','$2y$13$dOgQuJVwIEy7JLEEb.RhhOf2eHwMkzVEgf7vpdS1t0DbuwkI/Zcea',NULL,'admin@admin.com',1,1513230560,'site/odrer/1',1514033004,0,1,'',NULL,NULL,NULL,NULL,'','0','Thailand','Admin',''),(23,'sajid','pU3FsS335QAR26DcGwB12abkHZWtEmge','$2y$13$JuxwsoHND74z5D4tYdGdyunNthateNCtD.wyq5ZluCbnavSZ72LRS',NULL,'sajid@gmail.com',1,1514817003,NULL,1514817003,1,2,'03008332781',NULL,NULL,NULL,NULL,'thirty to streek khan poor, bareek road london','islamabad','Thailand ','sajid','ali'),(24,'badar','4pXFVjkEy4e-fJcNotE-93erA9i796Fu','$2y$13$hhs3d3J2W6xPjOaC7wL5jeb4/ibf6iXeTLEa119VF2Bo8Qu/P/omC',NULL,'badar@gmail.com',1,1515052280,NULL,1515052280,NULL,NULL,'03008332781',NULL,NULL,NULL,NULL,'thirty to streek khan poor','','Thailand ','badar','Khan');
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

-- Dump completed on 2018-01-05 15:33:18
