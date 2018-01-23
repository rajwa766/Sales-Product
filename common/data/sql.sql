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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accout_type` varchar(45) DEFAULT NULL,
  `account_name` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `account_description` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `updated_on` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_account_user2_idx` (`user_id`),
  CONSTRAINT `fk_account_user2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (1,'1','jan-recivable','Account to calculate profit',NULL,NULL,NULL,NULL,575);
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
INSERT INTO `auth_assignment` VALUES ('customer','569',1516093581),('customer','570',1516093854),('customer','574',1516343873),('general','11',1514022715),('general','12',1514027235),('general','13',1514028687),('general','14',1514469004),('general','15',1514470930),('general','16',1514471982),('general','17',1514562704),('general','18',1514566489),('general','19',1514584106),('general','20',1514584170),('general','21',1514813516),('general','22',1514814724),('general','23',1514817003),('general','24',1515052281),('general','259',1515763153),('general','260',1515763154),('general','261',1515763155),('general','262',1515763156),('general','263',1515763159),('general','264',1515763161),('general','265',1515763163),('general','266',1515763164),('general','267',1515763167),('general','268',1515763168),('general','269',1515763169),('general','27',1515414891),('general','270',1515763170),('general','271',1515763173),('general','272',1515763174),('general','273',1515763176),('general','274',1515763178),('general','275',1515763179),('general','276',1515763180),('general','277',1515763183),('general','278',1515763184),('general','279',1515763185),('general','28',1515414974),('general','280',1515763186),('general','281',1515763188),('general','282',1515763189),('general','283',1515763190),('general','284',1515763191),('general','285',1515763193),('general','286',1515763194),('general','287',1515763195),('general','288',1515763196),('general','289',1515763197),('general','29',1515415162),('general','290',1515763198),('general','291',1515763199),('general','292',1515763201),('general','293',1515763202),('general','294',1515763203),('general','295',1515763204),('general','296',1515763205),('general','297',1515763207),('general','298',1515763208),('general','299',1515763208),('general','30',1515416192),('general','300',1515763209),('general','301',1515763210),('general','302',1515763211),('general','303',1515763212),('general','304',1515763213),('general','305',1515763214),('general','306',1515763215),('general','307',1515763216),('general','308',1515763218),('general','309',1515763219),('general','31',1515483459),('general','310',1515763220),('general','311',1515763221),('general','312',1515763222),('general','313',1515763223),('general','314',1515763224),('general','315',1515763226),('general','316',1515763227),('general','317',1515763228),('general','318',1515763230),('general','319',1515763231),('general','320',1515763233),('general','321',1515763234),('general','322',1515763235),('general','323',1515763236),('general','324',1515763237),('general','333',1515763341),('general','334',1515763342),('general','335',1515763343),('general','336',1515763344),('general','337',1515763346),('general','338',1515763348),('general','339',1515763351),('general','340',1515763352),('general','341',1515763355),('general','342',1515763356),('general','343',1515763357),('general','344',1515763358),('general','345',1515763360),('general','346',1515763362),('general','347',1515763364),('general','348',1515763366),('general','349',1515763367),('general','350',1515763368),('general','351',1515763371),('general','352',1515763372),('general','353',1515763373),('general','354',1515763374),('general','355',1515763376),('general','356',1515763377),('general','357',1515763378),('general','358',1515763379),('general','359',1515763381),('general','36',1515510313),('general','360',1515763382),('general','361',1515763383),('general','362',1515763385),('general','363',1515763386),('general','364',1515763387),('general','365',1515763388),('general','366',1515763390),('general','367',1515763390),('general','368',1515763392),('general','369',1515763393),('general','370',1515763394),('general','371',1515763396),('general','372',1515763397),('general','373',1515763397),('general','374',1515763398),('general','375',1515763399),('general','376',1515763400),('general','377',1515763401),('general','378',1515763402),('general','379',1515763403),('general','380',1515763404),('general','381',1515763405),('general','382',1515763407),('general','383',1515763408),('general','384',1515763409),('general','385',1515763410),('general','386',1515763411),('general','387',1515763412),('general','388',1515763413),('general','389',1515763414),('general','390',1515763415),('general','391',1515763416),('general','392',1515763418),('general','393',1515763419),('general','394',1515763420),('general','395',1515763421),('general','396',1515763422),('general','397',1515763423),('general','398',1515763424),('general','40',1515511939),('general','407',1515763534),('general','408',1515763535),('general','409',1515763536),('general','41',1515511999),('general','410',1515763537),('general','411',1515763540),('general','412',1515763542),('general','413',1515763545),('general','414',1515763546),('general','415',1515763549),('general','416',1515763550),('general','417',1515763551),('general','418',1515763552),('general','419',1515763554),('general','42',1515672378),('general','420',1515763556),('general','421',1515763558),('general','422',1515763560),('general','423',1515763561),('general','424',1515763562),('general','425',1515763565),('general','426',1515763566),('general','427',1515763567),('general','428',1515763568),('general','429',1515763569),('general','43',1515672605),('general','430',1515763570),('general','431',1515763571),('general','432',1515763572),('general','433',1515763575),('general','434',1515763576),('general','435',1515763577),('general','436',1515763578),('general','437',1515763579),('general','438',1515763580),('general','439',1515763581),('general','440',1515763583),('general','441',1515763584),('general','442',1515763585),('general','443',1515763587),('general','444',1515763587),('general','445',1515763589),('general','446',1515763590),('general','447',1515763591),('general','448',1515763592),('general','449',1515763593),('general','450',1515763594),('general','451',1515763595),('general','452',1515763595),('general','453',1515763596),('general','454',1515763597),('general','455',1515763598),('general','456',1515763601),('general','457',1515763602),('general','458',1515763602),('general','459',1515763603),('general','460',1515763604),('general','461',1515763605),('general','462',1515763606),('general','463',1515763608),('general','464',1515763609),('general','465',1515763610),('general','466',1515763612),('general','467',1515763612),('general','468',1515763614),('general','469',1515763615),('general','470',1515763616),('general','471',1515763617),('general','472',1515763618),('general','481',1515765710),('general','482',1515765711),('general','483',1515765712),('general','484',1515765713),('general','485',1515765714),('general','486',1515765716),('general','487',1515765717),('general','488',1515765718),('general','489',1515765719),('general','490',1515765720),('general','491',1515765721),('general','492',1515765722),('general','493',1515765723),('general','494',1515765724),('general','495',1515765726),('general','496',1515765727),('general','497',1515765728),('general','498',1515765729),('general','499',1515765730),('general','500',1515765731),('general','501',1515765734),('general','502',1515765736),('general','503',1515765737),('general','504',1515765738),('general','505',1515765739),('general','506',1515765740),('general','507',1515765741),('general','508',1515765742),('general','509',1515765743),('general','510',1515765744),('general','511',1515765745),('general','512',1515765746),('general','513',1515765747),('general','514',1515765748),('general','515',1515765749),('general','516',1515765750),('general','517',1515765752),('general','518',1515765753),('general','519',1515765754),('general','520',1515765755),('general','521',1515765756),('general','522',1515765758),('general','523',1515765759),('general','524',1515765759),('general','525',1515765760),('general','526',1515765761),('general','527',1515765762),('general','528',1515765763),('general','529',1515765764),('general','530',1515765767),('general','531',1515765768),('general','532',1515765769),('general','533',1515765770),('general','534',1515765771),('general','535',1515765772),('general','536',1515765773),('general','537',1515765774),('general','538',1515765775),('general','539',1515765776),('general','540',1515765777),('general','541',1515765778),('general','542',1515765780),('general','543',1515765781),('general','544',1515765783),('general','545',1515765784),('general','546',1515765785),('general','547',1515765786),('general','548',1515765789),('general','549',1515765789),('general','550',1515765790),('general','551',1515765791),('general','552',1515765792),('general','553',1515765793),('general','554',1515765794),('general','555',1515765795),('general','556',1515765796),('general','557',1515765798),('general','558',1515765798),('general','559',1515765800),('general','560',1515765801),('general','561',1515765802),('general','562',1515765803),('general','563',1515765804),('general','564',1515765805),('general','565',1515765806),('general','566',1515765807),('general','567',1515765808),('general','568',1515765810),('general','572',1516106680),('general','573',1516281881),('general','6',1514027334),('seller','575',1516686919),('super_admin','1',1514021944);
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
INSERT INTO `auth_item` VALUES ('/*',2,NULL,NULL,NULL,1514022420,1514022420),('/admin/*',2,NULL,NULL,NULL,1514021828,1514021828),('/admin/assignment/*',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/assignment/assign',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/assignment/index',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/assignment/revoke',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/assignment/view',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/default/*',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/default/index',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/menu/*',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/menu/create',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/menu/delete',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/menu/index',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/menu/update',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/menu/view',2,NULL,NULL,NULL,1514021824,1514021824),('/admin/permission/*',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/permission/assign',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/permission/create',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/permission/delete',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/permission/index',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/permission/remove',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/permission/update',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/permission/view',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/role/*',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/role/assign',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/role/create',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/role/delete',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/role/index',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/role/remove',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/role/update',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/role/view',2,NULL,NULL,NULL,1514021825,1514021825),('/admin/route/*',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/route/assign',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/route/create',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/route/index',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/route/refresh',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/route/remove',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/rule/*',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/rule/create',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/rule/delete',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/rule/index',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/rule/update',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/rule/view',2,NULL,NULL,NULL,1514021826,1514021826),('/admin/user/*',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/activate',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/change-password',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/delete',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/index',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/login',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/logout',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/request-password-reset',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/reset-password',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/signup',2,NULL,NULL,NULL,1514021827,1514021827),('/admin/user/view',2,NULL,NULL,NULL,1514021827,1514021827),('/category/*',2,NULL,NULL,NULL,1514468712,1514468712),('/category/create',2,NULL,NULL,NULL,1514468715,1514468715),('/category/delete',2,NULL,NULL,NULL,1514468715,1514468715),('/category/index',2,NULL,NULL,NULL,1514468715,1514468715),('/category/update',2,NULL,NULL,NULL,1514468715,1514468715),('/category/view',2,NULL,NULL,NULL,1514468715,1514468715),('/customer/*',2,NULL,NULL,NULL,1514468716,1514468716),('/customer/create',2,NULL,NULL,NULL,1514468716,1514468716),('/customer/delete',2,NULL,NULL,NULL,1514468716,1514468716),('/customer/index',2,NULL,NULL,NULL,1514468715,1514468715),('/customer/update',2,NULL,NULL,NULL,1514468716,1514468716),('/customer/view',2,NULL,NULL,NULL,1514468716,1514468716),('/debug/*',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/default/*',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/default/db-explain',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/default/download-mail',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/default/index',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/default/toolbar',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/default/view',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/user/*',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/user/reset-identity',2,NULL,NULL,NULL,1514022418,1514022418),('/debug/user/set-identity',2,NULL,NULL,NULL,1514022418,1514022418),('/gii/*',2,NULL,NULL,NULL,1514022419,1514022419),('/gii/default/*',2,NULL,NULL,NULL,1514022419,1514022419),('/gii/default/action',2,NULL,NULL,NULL,1514022419,1514022419),('/gii/default/diff',2,NULL,NULL,NULL,1514022419,1514022419),('/gii/default/index',2,NULL,NULL,NULL,1514022419,1514022419),('/gii/default/preview',2,NULL,NULL,NULL,1514022419,1514022419),('/gii/default/view',2,NULL,NULL,NULL,1514022419,1514022419),('/order/*',2,NULL,NULL,NULL,1514468716,1514468716),('/order/ajaxreport',2,NULL,NULL,NULL,1515187250,1515187250),('/order/approved',2,NULL,NULL,NULL,1515048076,1515048076),('/order/avi',2,NULL,NULL,NULL,1515048076,1515048076),('/order/cancel',2,NULL,NULL,NULL,1515048075,1515048075),('/order/create',2,NULL,NULL,NULL,1514468716,1514468716),('/order/createreturn',2,NULL,NULL,NULL,1515048076,1515048076),('/order/createtransfer',2,NULL,NULL,NULL,1515486110,1515486110),('/order/customer-level',2,NULL,NULL,NULL,1514468716,1514468716),('/order/delete',2,NULL,NULL,NULL,1514468716,1514468716),('/order/get-reports',2,NULL,NULL,NULL,1515187250,1515187250),('/order/index',2,NULL,NULL,NULL,1514468716,1514468716),('/order/inventory-reports',2,NULL,NULL,NULL,1515486110,1515486110),('/order/level',2,NULL,NULL,NULL,1514468716,1514468716),('/order/parentuser',2,NULL,NULL,NULL,1514468716,1514468716),('/order/parentuseradmin',2,NULL,NULL,NULL,1516366728,1516366728),('/order/pending',2,NULL,NULL,NULL,1514889580,1514889580),('/order/return',2,NULL,NULL,NULL,1515048076,1515048076),('/order/status-reports',2,NULL,NULL,NULL,1515680200,1515680200),('/order/statusreport',2,NULL,NULL,NULL,1515680201,1515680201),('/order/transfer',2,NULL,NULL,NULL,1515486110,1515486110),('/order/update',2,NULL,NULL,NULL,1514468716,1514468716),('/order/view',2,NULL,NULL,NULL,1514468716,1514468716),('/product-order/*',2,NULL,NULL,NULL,1514468716,1514468716),('/product-order/create',2,NULL,NULL,NULL,1514468716,1514468716),('/product-order/delete',2,NULL,NULL,NULL,1514468716,1514468716),('/product-order/index',2,NULL,NULL,NULL,1514468716,1514468716),('/product-order/update',2,NULL,NULL,NULL,1514468716,1514468716),('/product-order/view',2,NULL,NULL,NULL,1514468716,1514468716),('/product/*',2,NULL,NULL,NULL,1514468716,1514468716),('/product/create',2,NULL,NULL,NULL,1514468716,1514468716),('/product/delete',2,NULL,NULL,NULL,1514468716,1514468716),('/product/index',2,NULL,NULL,NULL,1514468716,1514468716),('/product/update',2,NULL,NULL,NULL,1514468716,1514468716),('/product/view',2,NULL,NULL,NULL,1514468716,1514468716),('/shipping-address/*',2,NULL,NULL,NULL,1514889580,1514889580),('/shipping-address/create',2,NULL,NULL,NULL,1514889580,1514889580),('/shipping-address/delete',2,NULL,NULL,NULL,1514889580,1514889580),('/shipping-address/index',2,NULL,NULL,NULL,1514889580,1514889580),('/shipping-address/update',2,NULL,NULL,NULL,1514889580,1514889580),('/shipping-address/view',2,NULL,NULL,NULL,1514889580,1514889580),('/site/*',2,NULL,NULL,NULL,1514022419,1514022419),('/site/about',2,NULL,NULL,NULL,1514022419,1514022419),('/site/captcha',2,NULL,NULL,NULL,1514022419,1514022419),('/site/contact',2,NULL,NULL,NULL,1514022419,1514022419),('/site/error',2,NULL,NULL,NULL,1514022419,1514022419),('/site/index',2,NULL,NULL,NULL,1514022419,1514022419),('/site/language',2,NULL,NULL,NULL,1515680201,1515680201),('/site/login',2,NULL,NULL,NULL,1514022419,1514022419),('/site/logout',2,NULL,NULL,NULL,1514022419,1514022419),('/site/request-password-reset',2,NULL,NULL,NULL,1514022419,1514022419),('/site/reset-password',2,NULL,NULL,NULL,1514022419,1514022419),('/site/signup',2,NULL,NULL,NULL,1514022419,1514022419),('/stock-in/*',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-in/allstock',2,NULL,NULL,NULL,1515187250,1515187250),('/stock-in/approve',2,NULL,NULL,NULL,1514889580,1514889580),('/stock-in/cancel',2,NULL,NULL,NULL,1515187250,1515187250),('/stock-in/create',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-in/delete',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-in/getunits',2,NULL,NULL,NULL,1515187250,1515187250),('/stock-in/index',2,NULL,NULL,NULL,1514468716,1514468716),('/stock-in/update',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-in/view',2,NULL,NULL,NULL,1514468716,1514468716),('/stock-out/*',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-out/create',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-out/delete',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-out/index',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-out/update',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-out/view',2,NULL,NULL,NULL,1514468717,1514468717),('/stock-status/*',2,NULL,NULL,NULL,1516366729,1516366729),('/stock-status/create',2,NULL,NULL,NULL,1516366729,1516366729),('/stock-status/delete',2,NULL,NULL,NULL,1516366729,1516366729),('/stock-status/index',2,NULL,NULL,NULL,1516366729,1516366729),('/stock-status/update',2,NULL,NULL,NULL,1516366729,1516366729),('/stock-status/view',2,NULL,NULL,NULL,1516366729,1516366729),('/user-product-level/*',2,NULL,NULL,NULL,1514531193,1514531193),('/user-product-level/create',2,NULL,NULL,NULL,1514531193,1514531193),('/user-product-level/delete',2,NULL,NULL,NULL,1514531193,1514531193),('/user-product-level/getunits',2,NULL,NULL,NULL,1514562795,1514562795),('/user-product-level/getunitsprice',2,NULL,NULL,NULL,1515486110,1515486110),('/user-product-level/index',2,NULL,NULL,NULL,1514531193,1514531193),('/user-product-level/levelpakages',2,NULL,NULL,NULL,1514562795,1514562795),('/user-product-level/update',2,NULL,NULL,NULL,1514531193,1514531193),('/user-product-level/view',2,NULL,NULL,NULL,1514531193,1514531193),('/user/*',2,NULL,NULL,NULL,1514022420,1514022420),('/user/allcustomer',2,NULL,NULL,NULL,1514470389,1514470389),('/user/allcustomers',2,NULL,NULL,NULL,1514562795,1514562795),('/user/alllevel',2,NULL,NULL,NULL,1514025121,1514025121),('/user/create',2,NULL,NULL,NULL,1514022420,1514022420),('/user/customer',2,NULL,NULL,NULL,1514470389,1514470389),('/user/delete',2,NULL,NULL,NULL,1514022420,1514022420),('/user/getuseraddress',2,NULL,NULL,NULL,1514889580,1514889580),('/user/import',2,NULL,NULL,NULL,1516366729,1516366729),('/user/index',2,NULL,NULL,NULL,1514022420,1514022420),('/user/level',2,NULL,NULL,NULL,1514468717,1514468717),('/user/parentuser',2,NULL,NULL,NULL,1514468717,1514468717),('/user/update',2,NULL,NULL,NULL,1514022420,1514022420),('/user/view',2,NULL,NULL,NULL,1514022420,1514022420),('customer',1,NULL,NULL,NULL,1514468736,1514468736),('general',1,NULL,NULL,NULL,1514021798,1514021798),('seller',1,NULL,NULL,NULL,1514028055,1514028055),('super_admin',1,NULL,NULL,NULL,1514021782,1514021782);
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
INSERT INTO `auth_item_child` VALUES ('super_admin','/*'),('super_admin','/admin/*'),('super_admin','/admin/assignment/*'),('super_admin','/admin/assignment/assign'),('super_admin','/admin/assignment/index'),('super_admin','/admin/assignment/revoke'),('super_admin','/admin/assignment/view'),('super_admin','/admin/default/*'),('super_admin','/admin/default/index'),('super_admin','/admin/menu/*'),('super_admin','/admin/menu/create'),('super_admin','/admin/menu/delete'),('super_admin','/admin/menu/index'),('super_admin','/admin/menu/update'),('super_admin','/admin/menu/view'),('super_admin','/admin/permission/*'),('super_admin','/admin/permission/assign'),('super_admin','/admin/permission/create'),('super_admin','/admin/permission/delete'),('super_admin','/admin/permission/index'),('super_admin','/admin/permission/remove'),('super_admin','/admin/permission/update'),('super_admin','/admin/permission/view'),('super_admin','/admin/role/*'),('super_admin','/admin/role/assign'),('super_admin','/admin/role/create'),('super_admin','/admin/role/delete'),('super_admin','/admin/role/index'),('super_admin','/admin/role/remove'),('super_admin','/admin/role/update'),('super_admin','/admin/role/view'),('super_admin','/admin/route/*'),('super_admin','/admin/route/assign'),('super_admin','/admin/route/create'),('super_admin','/admin/route/index'),('super_admin','/admin/route/refresh'),('super_admin','/admin/route/remove'),('super_admin','/admin/rule/*'),('super_admin','/admin/rule/create'),('super_admin','/admin/rule/delete'),('super_admin','/admin/rule/index'),('super_admin','/admin/rule/update'),('super_admin','/admin/rule/view'),('super_admin','/admin/user/*'),('super_admin','/admin/user/activate'),('super_admin','/admin/user/change-password'),('super_admin','/admin/user/delete'),('super_admin','/admin/user/index'),('super_admin','/admin/user/login'),('super_admin','/admin/user/logout'),('super_admin','/admin/user/request-password-reset'),('super_admin','/admin/user/reset-password'),('super_admin','/admin/user/signup'),('super_admin','/admin/user/view'),('super_admin','/category/*'),('super_admin','/category/create'),('super_admin','/category/delete'),('super_admin','/category/index'),('super_admin','/category/update'),('super_admin','/category/view'),('super_admin','/customer/*'),('general','/customer/create'),('super_admin','/customer/create'),('super_admin','/customer/delete'),('general','/customer/index'),('super_admin','/customer/index'),('super_admin','/customer/update'),('general','/customer/view'),('super_admin','/customer/view'),('seller','/debug/*'),('super_admin','/debug/*'),('super_admin','/debug/default/*'),('super_admin','/debug/default/db-explain'),('super_admin','/debug/default/download-mail'),('super_admin','/debug/default/index'),('super_admin','/debug/default/toolbar'),('super_admin','/debug/default/view'),('super_admin','/debug/user/*'),('super_admin','/debug/user/reset-identity'),('super_admin','/debug/user/set-identity'),('super_admin','/gii/*'),('super_admin','/gii/default/*'),('super_admin','/gii/default/action'),('super_admin','/gii/default/diff'),('super_admin','/gii/default/index'),('super_admin','/gii/default/preview'),('super_admin','/gii/default/view'),('super_admin','/order/*'),('general','/order/ajaxreport'),('super_admin','/order/ajaxreport'),('general','/order/approved'),('super_admin','/order/approved'),('general','/order/avi'),('super_admin','/order/avi'),('general','/order/cancel'),('super_admin','/order/cancel'),('customer','/order/create'),('general','/order/create'),('super_admin','/order/create'),('general','/order/createreturn'),('super_admin','/order/createreturn'),('general','/order/createtransfer'),('super_admin','/order/createtransfer'),('customer','/order/customer-level'),('general','/order/customer-level'),('super_admin','/order/customer-level'),('super_admin','/order/delete'),('general','/order/get-reports'),('super_admin','/order/get-reports'),('customer','/order/index'),('general','/order/index'),('super_admin','/order/index'),('general','/order/inventory-reports'),('super_admin','/order/inventory-reports'),('customer','/order/level'),('general','/order/level'),('super_admin','/order/level'),('customer','/order/parentuser'),('general','/order/parentuser'),('super_admin','/order/parentuser'),('general','/order/parentuseradmin'),('general','/order/pending'),('super_admin','/order/pending'),('general','/order/return'),('super_admin','/order/return'),('general','/order/status-reports'),('super_admin','/order/status-reports'),('general','/order/statusreport'),('super_admin','/order/statusreport'),('general','/order/transfer'),('super_admin','/order/transfer'),('customer','/order/update'),('general','/order/update'),('super_admin','/order/update'),('customer','/order/view'),('general','/order/view'),('super_admin','/order/view'),('super_admin','/product-order/*'),('super_admin','/product-order/create'),('super_admin','/product-order/delete'),('general','/product-order/index'),('super_admin','/product-order/index'),('super_admin','/product-order/update'),('super_admin','/product-order/view'),('super_admin','/product/*'),('super_admin','/product/create'),('super_admin','/product/delete'),('super_admin','/product/index'),('super_admin','/product/update'),('super_admin','/product/view'),('super_admin','/shipping-address/*'),('super_admin','/shipping-address/create'),('super_admin','/shipping-address/delete'),('super_admin','/shipping-address/index'),('super_admin','/shipping-address/update'),('super_admin','/shipping-address/view'),('customer','/site/*'),('general','/site/*'),('seller','/site/*'),('super_admin','/site/*'),('general','/site/about'),('super_admin','/site/about'),('general','/site/captcha'),('super_admin','/site/captcha'),('general','/site/contact'),('super_admin','/site/contact'),('general','/site/error'),('super_admin','/site/error'),('general','/site/index'),('super_admin','/site/index'),('super_admin','/site/language'),('general','/site/login'),('super_admin','/site/login'),('general','/site/logout'),('super_admin','/site/logout'),('general','/site/request-password-reset'),('super_admin','/site/request-password-reset'),('general','/site/reset-password'),('super_admin','/site/reset-password'),('general','/site/signup'),('super_admin','/site/signup'),('super_admin','/stock-in/*'),('general','/stock-in/allstock'),('super_admin','/stock-in/allstock'),('general','/stock-in/approve'),('super_admin','/stock-in/approve'),('super_admin','/stock-in/cancel'),('super_admin','/stock-in/create'),('super_admin','/stock-in/delete'),('general','/stock-in/getunits'),('super_admin','/stock-in/getunits'),('super_admin','/stock-in/index'),('super_admin','/stock-in/update'),('super_admin','/stock-in/view'),('super_admin','/stock-out/*'),('super_admin','/stock-out/create'),('super_admin','/stock-out/delete'),('super_admin','/stock-out/index'),('super_admin','/stock-out/update'),('super_admin','/stock-out/view'),('general','/stock-status/*'),('super_admin','/user-product-level/*'),('super_admin','/user-product-level/create'),('super_admin','/user-product-level/delete'),('customer','/user-product-level/getunits'),('general','/user-product-level/getunits'),('super_admin','/user-product-level/getunits'),('general','/user-product-level/getunitsprice'),('super_admin','/user-product-level/getunitsprice'),('super_admin','/user-product-level/index'),('customer','/user-product-level/levelpakages'),('general','/user-product-level/levelpakages'),('super_admin','/user-product-level/levelpakages'),('super_admin','/user-product-level/update'),('super_admin','/user-product-level/view'),('general','/user/*'),('super_admin','/user/*'),('customer','/user/allcustomer'),('general','/user/allcustomer'),('super_admin','/user/allcustomer'),('customer','/user/allcustomers'),('general','/user/allcustomers'),('super_admin','/user/allcustomers'),('customer','/user/alllevel'),('general','/user/alllevel'),('super_admin','/user/alllevel'),('general','/user/create'),('super_admin','/user/create'),('general','/user/customer'),('super_admin','/user/customer'),('general','/user/delete'),('super_admin','/user/delete'),('super_admin','/user/getuseraddress'),('general','/user/index'),('super_admin','/user/index'),('general','/user/level'),('super_admin','/user/level'),('customer','/user/parentuser'),('general','/user/parentuser'),('super_admin','/user/parentuser'),('customer','/user/update'),('general','/user/update'),('super_admin','/user/update'),('customer','/user/view'),('general','/user/view'),('super_admin','/user/view');
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
-- Table structure for table `gl`
--

DROP TABLE IF EXISTS `gl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` varchar(45) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `payment_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_gl_payment_detail1_idx` (`payment_detail_id`),
  KEY `fk_gl_order1_idx` (`order_id`),
  KEY `fk_gl_account1_idx` (`account_id`),
  CONSTRAINT `fk_gl_account1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_gl_order1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_gl_payment_detail1` FOREIGN KEY (`payment_detail_id`) REFERENCES `payment_detail` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gl`
--

LOCK TABLES `gl` WRITE;
/*!40000 ALTER TABLE `gl` DISABLE KEYS */;
/*!40000 ALTER TABLE `gl` ENABLE KEYS */;
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
-- Table structure for table `level_percentage`
--

DROP TABLE IF EXISTS `level_percentage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `level_percentage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `is_company_wide` bit(1) DEFAULT NULL,
  `percentage` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `level_percentage`
--

LOCK TABLES `level_percentage` WRITE;
/*!40000 ALTER TABLE `level_percentage` DISABLE KEYS */;
INSERT INTO `level_percentage` VALUES (1,4,2,'\0','10'),(2,6,4,'\0','5'),(3,6,2,'\0','5');
/*!40000 ALTER TABLE `level_percentage` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=400 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (295,NULL,NULL,NULL,NULL,NULL,481,1,1,NULL,5000,NULL,1,1,'2018-01-12 14:01:49','2018-01-12 14:01:49'),(296,NULL,NULL,NULL,NULL,NULL,482,1,481,NULL,1000,NULL,1,1,'2018-01-12 14:01:50','2018-01-12 14:01:50'),(297,NULL,NULL,NULL,NULL,NULL,483,1,482,NULL,500,NULL,1,1,'2018-01-12 14:01:52','2018-01-12 14:01:52'),(298,NULL,NULL,NULL,NULL,NULL,484,1,483,NULL,50,NULL,1,1,'2018-01-12 14:01:53','2018-01-12 14:01:53'),(299,NULL,NULL,NULL,NULL,NULL,485,1,483,NULL,10,NULL,1,1,'2018-01-12 14:01:54','2018-01-12 14:01:54'),(300,NULL,NULL,NULL,NULL,NULL,486,1,1,NULL,5000,NULL,1,1,'2018-01-12 14:01:56','2018-01-12 14:01:56'),(301,NULL,NULL,NULL,NULL,NULL,487,1,483,NULL,50,NULL,1,1,'2018-01-12 14:01:57','2018-01-12 14:01:57'),(302,NULL,NULL,NULL,NULL,NULL,488,1,1,NULL,5000,NULL,1,1,'2018-01-12 14:01:58','2018-01-12 14:01:58'),(303,NULL,NULL,NULL,NULL,NULL,489,1,1,NULL,5000,NULL,1,1,'2018-01-12 14:01:59','2018-01-12 14:01:59'),(304,NULL,NULL,NULL,NULL,NULL,490,1,483,NULL,100,NULL,1,1,'2018-01-12 14:02:00','2018-01-12 14:02:00'),(305,NULL,NULL,NULL,NULL,NULL,491,1,1,NULL,5000,NULL,1,1,'2018-01-12 14:02:01','2018-01-12 14:02:01'),(306,NULL,NULL,NULL,NULL,NULL,492,1,1,NULL,5000,NULL,1,1,'2018-01-12 14:02:02','2018-01-12 14:02:02'),(307,NULL,NULL,NULL,NULL,NULL,493,1,483,NULL,10,NULL,1,1,'2018-01-12 14:02:03','2018-01-12 14:02:03'),(308,NULL,NULL,NULL,NULL,NULL,494,1,483,NULL,50,NULL,1,1,'2018-01-12 14:02:04','2018-01-12 14:02:04'),(309,NULL,NULL,NULL,NULL,NULL,495,1,1,NULL,5000,NULL,1,1,'2018-01-12 14:02:06','2018-01-12 14:02:06'),(310,NULL,NULL,NULL,NULL,NULL,496,1,1,NULL,5000,NULL,1,1,'2018-01-12 14:02:07','2018-01-12 14:02:07'),(311,NULL,NULL,NULL,NULL,NULL,497,1,483,NULL,10,NULL,1,1,'2018-01-12 14:02:08','2018-01-12 14:02:08'),(312,NULL,NULL,NULL,NULL,NULL,498,1,483,NULL,10,NULL,1,1,'2018-01-12 14:02:09','2018-01-12 14:02:09'),(313,NULL,NULL,NULL,NULL,NULL,499,1,482,NULL,500,NULL,1,1,'2018-01-12 14:02:10','2018-01-12 14:02:10'),(314,NULL,NULL,NULL,NULL,NULL,500,1,483,NULL,10,NULL,1,1,'2018-01-12 14:02:11','2018-01-12 14:02:11'),(315,NULL,NULL,NULL,NULL,NULL,501,1,483,NULL,10,NULL,1,1,'2018-01-12 14:02:14','2018-01-12 14:02:14'),(316,NULL,NULL,NULL,NULL,NULL,502,1,499,NULL,10,NULL,1,1,'2018-01-12 14:02:15','2018-01-12 14:02:15'),(317,NULL,NULL,NULL,NULL,NULL,503,1,1,NULL,5000,NULL,1,1,'2018-01-12 14:02:16','2018-01-12 14:02:16'),(318,NULL,NULL,NULL,NULL,NULL,504,1,499,NULL,10,NULL,1,1,'2018-01-12 14:02:17','2018-01-12 14:02:17'),(319,NULL,NULL,NULL,NULL,NULL,505,1,1,NULL,5000,NULL,1,1,'2018-01-12 14:02:18','2018-01-12 14:02:18'),(320,NULL,NULL,NULL,NULL,NULL,506,1,1,NULL,5000,NULL,1,1,'2018-01-12 14:02:20','2018-01-12 14:02:20'),(321,NULL,NULL,NULL,NULL,NULL,507,1,499,NULL,10,NULL,1,1,'2018-01-12 14:02:21','2018-01-12 14:02:21'),(322,NULL,NULL,NULL,NULL,NULL,509,1,483,NULL,10,NULL,1,1,'2018-01-12 14:02:23','2018-01-12 14:02:23'),(323,NULL,NULL,NULL,NULL,NULL,510,1,1,NULL,5000,NULL,1,1,'2018-01-12 14:02:24','2018-01-12 14:02:24'),(324,NULL,NULL,NULL,NULL,NULL,511,1,1,NULL,5000,NULL,1,1,'2018-01-12 14:02:25','2018-01-12 14:02:25'),(325,NULL,NULL,NULL,NULL,NULL,512,1,1,NULL,5000,NULL,1,1,'2018-01-12 14:02:26','2018-01-12 14:02:26'),(326,NULL,NULL,NULL,NULL,NULL,514,1,499,NULL,100,NULL,1,1,'2018-01-12 14:02:28','2018-01-12 14:02:28'),(327,NULL,NULL,NULL,NULL,NULL,515,1,499,NULL,10,NULL,1,1,'2018-01-12 14:02:29','2018-01-12 14:02:29'),(328,NULL,NULL,NULL,NULL,NULL,516,1,483,NULL,10,NULL,1,1,'2018-01-12 14:02:30','2018-01-12 14:02:30'),(329,NULL,NULL,NULL,NULL,NULL,517,1,483,NULL,10,NULL,1,1,'2018-01-12 14:02:32','2018-01-12 14:02:32'),(330,NULL,NULL,NULL,NULL,NULL,518,1,511,NULL,1000,NULL,1,1,'2018-01-12 14:02:33','2018-01-12 14:02:33'),(331,NULL,NULL,NULL,NULL,NULL,519,1,483,NULL,10,NULL,1,1,'2018-01-12 14:02:34','2018-01-12 14:02:34'),(332,NULL,NULL,NULL,NULL,NULL,520,0,482,NULL,500,NULL,1,1,'2018-01-12 14:02:35','2018-01-12 14:02:35'),(333,NULL,NULL,NULL,NULL,NULL,521,1,1,NULL,5000,NULL,1,1,'2018-01-12 14:02:36','2018-01-12 14:02:36'),(334,NULL,NULL,NULL,NULL,NULL,522,1,1,NULL,5000,NULL,1,1,'2018-01-12 14:02:37','2018-01-12 14:02:37'),(335,NULL,NULL,NULL,NULL,NULL,523,1,499,NULL,10,NULL,1,1,'2018-01-12 14:02:38','2018-01-12 14:02:38'),(336,NULL,NULL,NULL,NULL,NULL,524,0,482,NULL,500,NULL,1,1,'2018-01-12 14:02:39','2018-01-12 14:02:39'),(337,NULL,NULL,NULL,NULL,NULL,525,0,524,NULL,10,NULL,1,1,'2018-01-12 14:02:40','2018-01-12 14:02:40'),(338,NULL,NULL,NULL,NULL,NULL,526,0,1,NULL,5000,NULL,1,1,'2018-01-12 14:02:41','2018-01-12 14:02:41'),(339,NULL,NULL,NULL,NULL,NULL,527,0,524,NULL,10,NULL,1,1,'2018-01-12 14:02:42','2018-01-12 14:02:42'),(340,NULL,NULL,NULL,NULL,NULL,528,1,499,NULL,10,NULL,1,1,'2018-01-12 14:02:43','2018-01-12 14:02:43'),(341,NULL,NULL,NULL,NULL,NULL,529,0,520,NULL,10,NULL,1,1,'2018-01-12 14:02:44','2018-01-12 14:02:44'),(342,NULL,NULL,NULL,NULL,NULL,530,1,483,NULL,100,NULL,1,1,'2018-01-12 14:02:46','2018-01-12 14:02:46'),(343,NULL,NULL,NULL,NULL,NULL,531,1,521,NULL,1000,NULL,1,1,'2018-01-12 14:02:47','2018-01-12 14:02:47'),(344,NULL,NULL,NULL,NULL,NULL,532,0,524,NULL,10,NULL,1,1,'2018-01-12 14:02:49','2018-01-12 14:02:49'),(345,NULL,NULL,NULL,NULL,NULL,533,1,505,NULL,1000,NULL,1,1,'2018-01-12 14:02:50','2018-01-12 14:02:50'),(346,NULL,NULL,NULL,NULL,NULL,534,0,508,NULL,500,NULL,1,1,'2018-01-12 14:02:51','2018-01-12 14:02:51'),(347,NULL,NULL,NULL,NULL,NULL,535,0,1,NULL,5000,NULL,1,1,'2018-01-12 14:02:52','2018-01-12 14:02:52'),(348,NULL,NULL,NULL,NULL,NULL,537,1,522,NULL,1000,NULL,1,1,'2018-01-12 14:02:54','2018-01-12 14:02:54'),(349,NULL,NULL,NULL,NULL,NULL,538,1,522,NULL,1000,NULL,1,1,'2018-01-12 14:02:55','2018-01-12 14:02:55'),(350,NULL,NULL,NULL,NULL,NULL,539,0,536,NULL,10,NULL,1,1,'2018-01-12 14:02:56','2018-01-12 14:02:56'),(351,NULL,NULL,NULL,NULL,NULL,540,1,518,NULL,500,NULL,1,1,'2018-01-12 14:02:57','2018-01-12 14:02:57'),(352,NULL,NULL,NULL,NULL,NULL,541,0,534,NULL,100,NULL,1,1,'2018-01-12 14:02:58','2018-01-12 14:02:58'),(353,NULL,NULL,NULL,NULL,NULL,542,1,492,NULL,1000,NULL,1,1,'2018-01-12 14:02:59','2018-01-12 14:02:59'),(354,NULL,NULL,NULL,NULL,NULL,543,1,499,NULL,10,NULL,1,1,'2018-01-12 14:03:01','2018-01-12 14:03:01'),(355,NULL,NULL,NULL,NULL,NULL,544,0,524,NULL,10,NULL,1,1,'2018-01-12 14:03:02','2018-01-12 14:03:02'),(356,NULL,NULL,NULL,NULL,NULL,545,1,540,NULL,10,NULL,1,1,'2018-01-12 14:03:03','2018-01-12 14:03:03'),(357,NULL,NULL,NULL,NULL,NULL,546,1,540,NULL,10,NULL,1,1,'2018-01-12 14:03:05','2018-01-12 14:03:05'),(358,NULL,NULL,NULL,NULL,NULL,547,0,1,NULL,5000,NULL,1,1,'2018-01-12 14:03:06','2018-01-12 14:03:06'),(359,NULL,NULL,NULL,NULL,NULL,548,1,540,NULL,10,NULL,1,1,'2018-01-12 14:03:08','2018-01-12 14:03:08'),(360,NULL,NULL,NULL,NULL,NULL,549,0,520,NULL,10,NULL,1,1,'2018-01-12 14:03:09','2018-01-12 14:03:09'),(361,NULL,NULL,NULL,NULL,NULL,550,0,520,NULL,10,NULL,1,1,'2018-01-12 14:03:10','2018-01-12 14:03:10'),(362,NULL,NULL,NULL,NULL,NULL,551,1,481,NULL,1000,NULL,1,1,'2018-01-12 14:03:11','2018-01-12 14:03:11'),(363,NULL,NULL,NULL,NULL,NULL,552,0,524,NULL,10,NULL,1,1,'2018-01-12 14:03:12','2018-01-12 14:03:12'),(364,NULL,NULL,NULL,NULL,NULL,553,0,534,NULL,10,NULL,1,1,'2018-01-12 14:03:13','2018-01-12 14:03:13'),(365,NULL,NULL,NULL,NULL,NULL,554,0,536,NULL,10,NULL,1,1,'2018-01-12 14:03:14','2018-01-12 14:03:14'),(366,NULL,NULL,NULL,NULL,NULL,555,0,1,NULL,5000,NULL,1,1,'2018-01-12 14:03:15','2018-01-12 14:03:15'),(367,NULL,NULL,NULL,NULL,NULL,556,1,510,NULL,1000,NULL,1,1,'2018-01-12 14:03:16','2018-01-12 14:03:16'),(368,NULL,NULL,NULL,NULL,NULL,557,1,505,NULL,1000,NULL,1,1,'2018-01-12 14:03:17','2018-01-12 14:03:17'),(369,NULL,NULL,NULL,NULL,NULL,558,0,508,NULL,500,NULL,1,1,'2018-01-12 14:03:18','2018-01-12 14:03:18'),(370,NULL,NULL,NULL,NULL,NULL,559,0,1,NULL,5000,NULL,1,1,'2018-01-12 14:03:19','2018-01-12 14:03:19'),(371,NULL,NULL,NULL,NULL,NULL,560,1,540,NULL,100,NULL,1,1,'2018-01-12 14:03:21','2018-01-12 14:03:21'),(372,NULL,NULL,NULL,NULL,NULL,561,0,520,NULL,10,NULL,1,1,'2018-01-12 14:03:22','2018-01-12 14:03:22'),(373,NULL,NULL,NULL,NULL,NULL,562,0,1,NULL,5000,NULL,1,1,'2018-01-12 14:03:23','2018-01-12 14:03:23'),(374,NULL,NULL,NULL,NULL,NULL,563,0,536,NULL,10,NULL,1,1,'2018-01-12 14:03:24','2018-01-12 14:03:24'),(375,NULL,NULL,NULL,NULL,NULL,565,0,520,NULL,50,NULL,1,1,'2018-01-12 14:03:26','2018-01-12 14:03:26'),(376,NULL,NULL,NULL,NULL,NULL,566,1,512,NULL,1000,NULL,1,1,'2018-01-12 14:03:27','2018-01-12 14:03:27'),(377,NULL,NULL,NULL,NULL,NULL,567,0,1,NULL,5000,NULL,1,1,'2018-01-12 14:03:28','2018-01-12 14:03:28'),(378,'','','',NULL,NULL,569,0,1,NULL,NULL,NULL,1,1,'2018-01-16 09:06:21','2018-01-16 09:06:21'),(379,'','','',NULL,NULL,569,0,1,NULL,NULL,NULL,1,1,'2018-01-16 09:07:30','2018-01-16 09:07:30'),(380,'','','',NULL,NULL,570,0,1,NULL,NULL,NULL,1,1,'2018-01-16 09:10:54','2018-01-16 09:10:54'),(381,'','','',NULL,NULL,570,0,1,NULL,NULL,NULL,1,1,'2018-01-16 09:11:40','2018-01-16 09:11:40'),(382,'','','',NULL,NULL,568,0,1,NULL,700,NULL,1,1,'2018-01-16 09:14:31','2018-01-16 09:14:31'),(383,'','','',NULL,NULL,481,0,1,NULL,7000,NULL,1,1,'2018-01-16 09:15:49','2018-01-16 09:15:49'),(384,'','','',NULL,NULL,486,0,1,NULL,7000,NULL,1,1,'2018-01-16 09:17:00','2018-01-16 09:17:00'),(385,'','','',NULL,NULL,481,0,1,NULL,7000,NULL,1,1,'2018-01-16 09:19:47','2018-01-16 09:19:47'),(386,'','','',NULL,NULL,570,0,1,NULL,700,NULL,NULL,NULL,'2018-01-16 09:20:45','2018-01-16 09:20:45'),(387,'','','',NULL,NULL,481,8,1,NULL,3000,NULL,481,481,'2018-01-16 11:16:14','2018-01-16 11:16:14'),(388,'','','',NULL,NULL,486,6,481,NULL,788,NULL,481,481,'2018-01-16 11:42:24','2018-01-16 11:42:24'),(389,'','','',NULL,NULL,486,5,481,NULL,788,NULL,481,481,'2018-01-16 11:42:53','2018-01-16 11:42:53'),(390,NULL,NULL,NULL,NULL,NULL,571,0,481,NULL,1000,NULL,481,481,'2018-01-16 12:43:09','2018-01-16 12:43:09'),(391,NULL,NULL,NULL,NULL,NULL,572,1,481,NULL,1200,NULL,481,481,'2018-01-16 12:44:38','2018-01-16 12:44:38'),(392,'','','',NULL,NULL,570,1,481,NULL,1200,NULL,1,1,'2018-01-18 10:08:44','2018-01-18 10:08:44'),(393,NULL,NULL,NULL,NULL,NULL,573,0,1,NULL,89,NULL,1,1,'2018-01-18 13:24:40','2018-01-18 13:24:40'),(394,'','','',NULL,NULL,574,0,1,NULL,1000,NULL,1,1,'2018-01-19 06:37:53','2018-01-19 06:37:53'),(395,'','','',NULL,NULL,481,4,1,NULL,1000,NULL,1,1,'2018-01-19 06:51:13','2018-01-19 06:51:13'),(396,'','','',NULL,NULL,571,0,481,NULL,1000,NULL,1,1,'2018-01-19 09:59:35','2018-01-19 09:59:35'),(397,'','','',NULL,NULL,568,0,1,NULL,1000,NULL,1,1,'2018-01-19 14:20:26','2018-01-19 14:20:26'),(398,'','','',NULL,NULL,568,0,1,NULL,599,NULL,1,1,'2018-01-21 08:14:19','2018-01-21 08:14:19'),(399,NULL,NULL,NULL,NULL,NULL,575,1,499,NULL,100,NULL,1,1,'2018-01-23 05:55:18','2018-01-23 05:55:18');
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
) ENGINE=InnoDB AUTO_INCREMENT=405 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_order`
--

LOCK TABLES `product_order` WRITE;
/*!40000 ALTER TABLE `product_order` DISABLE KEYS */;
INSERT INTO `product_order` VALUES (303,295,5000,390,5000,390,1),(304,296,1000,440,1000,440,1),(305,297,500,480,500,480,1),(306,298,50,590,50,590,1),(307,299,10,630,10,630,1),(308,300,5000,390,5000,390,1),(309,301,50,590,50,590,1),(310,302,5000,390,5000,390,1),(311,303,5000,390,5000,390,1),(312,304,100,550,100,550,1),(313,305,5000,390,5000,390,1),(314,306,5000,390,5000,390,1),(315,307,10,630,10,630,1),(316,308,50,590,50,590,1),(317,309,5000,390,5000,390,1),(318,310,5000,390,5000,390,1),(319,311,10,630,10,630,1),(320,312,10,630,10,630,1),(321,313,500,480,500,480,1),(322,314,10,630,10,630,1),(323,315,10,630,10,630,1),(324,316,10,630,10,630,1),(325,317,5000,390,5000,390,1),(326,318,10,630,10,630,1),(327,319,5000,390,5000,390,1),(328,320,5000,390,5000,390,1),(329,321,10,630,10,630,1),(330,322,10,630,10,630,1),(331,323,5000,390,5000,390,1),(332,324,5000,390,5000,390,1),(333,325,5000,390,5000,390,1),(334,326,100,550,100,550,1),(335,327,10,630,10,630,1),(336,328,10,630,10,630,1),(337,329,10,630,10,630,1),(338,330,1000,440,1000,440,1),(339,331,10,630,10,630,1),(340,332,500,480,500,480,1),(341,333,5000,390,5000,390,1),(342,334,5000,390,5000,390,1),(343,335,10,630,10,630,1),(344,336,500,480,500,480,1),(345,337,10,630,10,630,1),(346,338,5000,390,5000,390,1),(347,339,10,630,10,630,1),(348,340,10,630,10,630,1),(349,341,10,630,10,630,1),(350,342,100,550,100,550,1),(351,343,1000,440,1000,440,1),(352,344,10,630,10,630,1),(353,345,1000,440,1000,440,1),(354,346,500,480,500,480,1),(355,347,5000,390,5000,390,1),(356,348,1000,440,1000,440,1),(357,349,1000,440,1000,440,1),(358,350,10,630,10,630,1),(359,351,500,480,500,480,1),(360,352,100,550,100,550,1),(361,353,1000,440,1000,440,1),(362,354,10,630,10,630,1),(363,355,10,630,10,630,1),(364,356,10,630,10,630,1),(365,357,10,630,10,630,1),(366,358,5000,390,5000,390,1),(367,359,10,630,10,630,1),(368,360,10,630,10,630,1),(369,361,10,630,10,630,1),(370,362,1000,440,1000,440,1),(371,363,10,630,10,630,1),(372,364,10,630,10,630,1),(373,365,10,630,10,630,1),(374,366,5000,390,5000,390,1),(375,367,1000,440,1000,440,1),(376,368,1000,440,1000,440,1),(377,369,500,480,500,480,1),(378,370,5000,390,5000,390,1),(379,371,100,550,100,550,1),(380,372,10,630,10,630,1),(381,373,5000,390,5000,390,1),(382,374,10,630,10,630,1),(383,375,50,590,50,590,1),(384,376,1000,440,1000,440,1),(385,377,5000,390,5000,390,1),(386,379,NULL,760,NULL,760,1),(387,380,NULL,760,NULL,760,1),(388,381,NULL,760,NULL,760,1),(389,382,700,760,700,760,1),(390,383,7000,390,7000,390,1),(391,384,7000,390,7000,390,1),(392,385,7000,390,7000,390,1),(393,386,700,760,700,760,1),(394,387,3000,760,3000,760,1),(395,389,788,760,788,760,1),(396,391,1200,440,1200,440,1),(397,392,1200,760,1200,760,1),(398,393,89,NULL,89,NULL,1),(399,394,1000,NULL,1000,NULL,1),(400,395,1000,410,1000,410,1),(401,396,1000,440,1000,440,1),(402,397,1000,760,1000,760,1),(403,398,599,760,599,760,1),(404,399,100,550,100,550,1);
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
  `email` varchar(100) DEFAULT NULL,
  `phone_no` varchar(100) DEFAULT NULL,
  `mobile_no` varchar(100) DEFAULT NULL,
  `postal_code` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `address` varchar(455) DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_shipping_address_order1_idx` (`order_id`),
  CONSTRAINT `fk_shipping_address_order1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping_address`
--

LOCK TABLES `shipping_address` WRITE;
/*!40000 ALTER TABLE `shipping_address` DISABLE KEYS */;
INSERT INTO `shipping_address` VALUES (1,'saesdfjid@gmail.com','03008332781','03008332781','082','islamabad','Karachi','Pakistan','thirty to streek khan poor',379),(2,'sajid@gmail.com','03008332781','03008332781','082','islamabad','Karachi','Pakistan','thirty to streek khan poor',381),(3,'','','','','','','','',382),(4,'lsranrock1234@gmail.com','0987169644','','','','pakisean','','how it goes',385),(5,'sajid@gmail.com','03008332781','03008332781','082','islamabad','Karachi','Pakistan','thirty to streek khan poor',386),(6,'sajid@gmail.com','','03008332781','','','','','',392),(7,'sajiffffffffd@gmail.com','03008332781','03008332781','082','islamabad','Karachi','Pakistan','thirty to streek khan poor',394),(8,'naeem@gmail.com','03008332781','03008332781','','islamabad','','Thailand ','thirty to streek khan poor, bareek road london',396),(9,'','','','','','','','',397),(10,'','','','','','','','',398);
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
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_in`
--

LOCK TABLES `stock_in` WRITE;
/*!40000 ALTER TABLE `stock_in` DISABLE KEYS */;
INSERT INTO `stock_in` VALUES (72,'2018-01-12 13:25:06',80000,0,200,1,1),(73,'2018-01-12 14:01:49',5000,0,390,1,481),(74,'2018-01-12 14:01:51',1000,0,440,1,482),(75,'2018-01-12 14:01:52',500,50,480,1,483),(76,'2018-01-12 14:01:53',50,50,590,1,484),(77,'2018-01-12 14:01:54',10,10,630,1,485),(78,'2018-01-12 14:01:56',5000,5000,390,1,486),(79,'2018-01-12 14:01:57',50,50,590,1,487),(80,'2018-01-12 14:01:58',5000,5000,390,1,488),(81,'2018-01-12 14:01:59',5000,5000,390,1,489),(82,'2018-01-12 14:02:00',100,100,550,1,490),(83,'2018-01-12 14:02:01',5000,5000,390,1,491),(84,'2018-01-12 14:02:02',5000,4000,390,1,492),(85,'2018-01-12 14:02:03',10,10,630,1,493),(86,'2018-01-12 14:02:04',50,50,590,1,494),(87,'2018-01-12 14:02:06',5000,5000,390,1,495),(88,'2018-01-12 14:02:07',5000,5000,390,1,496),(89,'2018-01-12 14:02:08',10,10,630,1,497),(90,'2018-01-12 14:02:09',10,10,630,1,498),(91,'2018-01-12 14:02:10',500,230,480,1,499),(92,'2018-01-12 14:02:11',10,10,630,1,500),(93,'2018-01-12 14:02:14',10,10,630,1,501),(94,'2018-01-12 14:02:16',10,10,630,1,502),(95,'2018-01-12 14:02:17',5000,5000,390,1,503),(96,'2018-01-12 14:02:18',10,10,630,1,504),(97,'2018-01-12 14:02:19',5000,3000,390,1,505),(98,'2018-01-12 14:02:20',5000,5000,390,1,506),(99,'2018-01-12 14:02:21',10,10,630,1,507),(100,'2018-01-12 14:02:23',10,10,630,1,509),(101,'2018-01-12 14:02:24',5000,4000,390,1,510),(102,'2018-01-12 14:02:25',5000,4000,390,1,511),(103,'2018-01-12 14:02:26',5000,4000,390,1,512),(104,'2018-01-12 14:02:28',100,100,550,1,514),(105,'2018-01-12 14:02:29',10,10,630,1,515),(106,'2018-01-12 14:02:30',10,10,630,1,516),(107,'2018-01-12 14:02:32',10,10,630,1,517),(108,'2018-01-12 14:02:33',1000,500,440,1,518),(109,'2018-01-12 14:02:34',10,10,630,1,519),(110,'2018-01-12 14:02:36',5000,4000,390,1,521),(111,'2018-01-12 14:02:37',5000,3000,390,1,522),(112,'2018-01-12 14:02:38',10,10,630,1,523),(113,'2018-01-12 14:02:43',10,10,630,1,528),(114,'2018-01-12 14:02:47',100,100,550,1,530),(115,'2018-01-12 14:02:48',1000,1000,440,1,531),(116,'2018-01-12 14:02:50',1000,1000,440,1,533),(117,'2018-01-12 14:02:54',1000,1000,440,1,537),(118,'2018-01-12 14:02:55',1000,1000,440,1,538),(119,'2018-01-12 14:02:57',500,370,480,1,540),(120,'2018-01-12 14:03:00',1000,1000,440,1,542),(121,'2018-01-12 14:03:01',10,10,630,1,543),(122,'2018-01-12 14:03:04',10,10,630,1,545),(123,'2018-01-12 14:03:05',10,10,630,1,546),(124,'2018-01-12 14:03:08',10,10,630,1,548),(125,'2018-01-12 14:03:11',1000,1000,440,1,551),(126,'2018-01-12 14:03:16',1000,1000,440,1,556),(127,'2018-01-12 14:03:17',1000,1000,440,1,557),(128,'2018-01-12 14:03:21',100,100,550,1,560),(129,'2018-01-12 14:03:27',1000,1000,440,1,566),(130,'2018-01-16 12:44:39',1200,1200,440,1,572),(133,'2018-01-19 06:57:58',1000,1000,410,1,1),(141,'2018-01-19 10:22:09',1200,1200,760,1,570),(142,'2018-01-23 05:55:19',100,100,550,1,575);
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
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_out`
--

LOCK TABLES `stock_out` WRITE;
/*!40000 ALTER TABLE `stock_out` DISABLE KEYS */;
INSERT INTO `stock_out` VALUES (1,5000,'2018-01-12 14:01:49',72,303),(2,1000,'2018-01-12 14:01:51',73,304),(3,500,'2018-01-12 14:01:52',74,305),(4,50,'2018-01-12 14:01:53',75,306),(5,10,'2018-01-12 14:01:54',75,307),(6,5000,'2018-01-12 14:01:56',72,308),(7,50,'2018-01-12 14:01:57',75,309),(8,5000,'2018-01-12 14:01:58',72,310),(9,5000,'2018-01-12 14:01:59',72,311),(10,100,'2018-01-12 14:02:00',75,312),(11,5000,'2018-01-12 14:02:01',72,313),(12,5000,'2018-01-12 14:02:02',72,314),(13,10,'2018-01-12 14:02:03',75,315),(14,50,'2018-01-12 14:02:04',75,316),(15,5000,'2018-01-12 14:02:06',72,317),(16,5000,'2018-01-12 14:02:07',72,318),(17,10,'2018-01-12 14:02:08',75,319),(18,10,'2018-01-12 14:02:09',75,320),(19,500,'2018-01-12 14:02:10',74,321),(20,10,'2018-01-12 14:02:11',75,322),(21,10,'2018-01-12 14:02:14',75,323),(22,10,'2018-01-12 14:02:16',91,324),(23,5000,'2018-01-12 14:02:17',72,325),(24,10,'2018-01-12 14:02:18',91,326),(25,5000,'2018-01-12 14:02:19',72,327),(26,5000,'2018-01-12 14:02:20',72,328),(27,10,'2018-01-12 14:02:21',91,329),(28,10,'2018-01-12 14:02:23',75,330),(29,5000,'2018-01-12 14:02:24',72,331),(30,5000,'2018-01-12 14:02:25',72,332),(31,5000,'2018-01-12 14:02:26',72,333),(32,100,'2018-01-12 14:02:28',91,334),(33,10,'2018-01-12 14:02:29',91,335),(34,10,'2018-01-12 14:02:30',75,336),(35,10,'2018-01-12 14:02:32',75,337),(36,1000,'2018-01-12 14:02:33',102,338),(37,10,'2018-01-12 14:02:34',75,339),(38,5000,'2018-01-12 14:02:36',72,341),(39,5000,'2018-01-12 14:02:37',72,342),(40,10,'2018-01-12 14:02:38',91,343),(41,10,'2018-01-12 14:02:43',91,348),(42,100,'2018-01-12 14:02:47',75,350),(43,1000,'2018-01-12 14:02:48',110,351),(44,1000,'2018-01-12 14:02:50',97,353),(45,1000,'2018-01-12 14:02:54',111,356),(46,1000,'2018-01-12 14:02:55',111,357),(47,500,'2018-01-12 14:02:57',108,359),(48,1000,'2018-01-12 14:03:00',84,361),(49,10,'2018-01-12 14:03:01',91,362),(50,10,'2018-01-12 14:03:04',119,364),(51,10,'2018-01-12 14:03:05',119,365),(52,10,'2018-01-12 14:03:08',119,367),(53,1000,'2018-01-12 14:03:11',73,370),(54,1000,'2018-01-12 14:03:16',101,375),(55,1000,'2018-01-12 14:03:17',97,376),(56,100,'2018-01-12 14:03:21',119,379),(57,1000,'2018-01-12 14:03:27',103,384),(58,1200,'2018-01-16 12:44:39',73,396),(61,1000,'2018-01-19 06:57:58',73,400),(69,1200,'2018-01-19 10:22:09',73,397),(70,100,'2018-01-23 05:55:18',91,404);
/*!40000 ALTER TABLE `stock_out` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_status`
--

DROP TABLE IF EXISTS `stock_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `below_percentage` varchar(45) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_stock_status_user1_idx` (`user_id`),
  KEY `fk_stock_status_product1_idx` (`product_id`),
  CONSTRAINT `fk_stock_status_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_status_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_status`
--

LOCK TABLES `stock_status` WRITE;
/*!40000 ALTER TABLE `stock_status` DISABLE KEYS */;
INSERT INTO `stock_status` VALUES (1,'60',1,1);
/*!40000 ALTER TABLE `stock_status` ENABLE KEYS */;
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
  `company_user` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  KEY `fk_user_user_level1_idx` (`user_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=576 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','Uek95ngbqlOBh-jaQ0Gv3SQ9FD4CGFC3','$2y$13$dOgQuJVwIEy7JLEEb.RhhOf2eHwMkzVEgf7vpdS1t0DbuwkI/Zcea',NULL,'admin@admin.com',1,1513230560,'site/odrer/1',1516369817,0,1,'03008332781',NULL,NULL,NULL,NULL,'thirty to streek khan poor, bareek road london','islamabad','Thailand','Admin','',0),(481,'BD00010','QqTabZPb0QqoEy3Jj10aAIYpf3o5WW6X','$2y$13$TxSrhXeTlnt94tl.1c6dQexUUiqTqWk9ik8aJX8Fg/2hk86Dpji9O',NULL,'lsranrock1234@gmail.com',1,1515765709,NULL,1515765709,1,2,'0987169644',NULL,NULL,'กระบี่',NULL,'127/1 ม.1 ต.หนองทะเล อ.เมือง จ.กระบี่ 81180',NULL,NULL,'นาย อรัญ เริงสมุทร์ TBC',NULL,1),(482,'BD00038','Lf24tSbzjxjy7W4tqQwWEzuH1I6CfRbf','$2y$13$DMPXMWkEDPCS1dT7ZyuJL.FOkEtLW8fXY6tmZBfT.5TUb3YSOAjT.',NULL,'P_thip2522@hotmail.com',1,1515765710,NULL,1515765710,481,4,'0948609708',NULL,NULL,'นครศรีธรรมราช',NULL,'โรงพยาบาลขนอม 91 หมู่ 3 ต.ขนอม. อ.ขนอม จ. นครศรีธรรมราช 80210',NULL,NULL,'กัญญภัทร์   ใจจง',NULL,0),(483,'BD00022','-aWsu224o5Z_dkGfDghqibzOOR7oIpQX','$2y$13$XSQ9fF2ULht0Y6.HIjk76u3FMe3.EAQU85EVf5LcVQ6pk6h3RmdGa',NULL,'Apairat.kanviya@gmail.com',1,1515765712,NULL,1515765712,482,6,'0980418586',NULL,NULL,'สงขลา',NULL,'13 ม.1ถ.เทศบาล2 ต.พะวง อ.หาดใหญ่',NULL,NULL,'กัญญ์วิญาณ์.  อภัยรัตน์',NULL,0),(484,'BD00001','Rcmcr-4U9iDjzl1FXTgBi06REcAj9Ox_','$2y$13$.FgtgFyU9arzljxzlx85Q.joX/57tIUzoyqC3Y0d2C2cO1awxsuFu',NULL,'Punnee5698@gmail',1,1515765713,NULL,1515765713,483,12,'0996105698',NULL,NULL,'สุราษฎร์ธานี',NULL,'434/68ม.5ต.ท่าทองใหม่อ.กาญจนดิษฐ์ ',NULL,NULL,'พรรณี มนจิตร์โท',NULL,0),(485,'BD00004','oK6G6MnryY1JihcublpMciXZ2pqcoIJ1','$2y$13$BoGpnfLD4DUTAYVYx.3QpeUEPPMh7J7YDFYJ18A6cBUm443Ojiuwe',NULL,'deecenteracc@gmail.com',1,1515765714,NULL,1515765714,483,13,'0992623999',NULL,NULL,'ภูเก็ต',NULL,'องค์การบริหารส่วนตำบลสาคู ต.สาคู อ.ถลาง จ.ภูเก็ต 83110',NULL,NULL,'นางสาวพิมพ์ณภัส อุไรวงศ์',NULL,0),(486,'BD00014','9DdV74BQwfsbLu9HjxZn0MA2868G14Rr','$2y$13$w9LNYVKV0FcYaPbYsgonf.W2vm6loekK/QeWxEim/ee4l1SOahEgC',NULL,'asia_pim2@hotmail.com',1,1515765716,NULL,1515765716,1,2,'0986426995',NULL,NULL,'ปราจีนบุรี ',NULL,'บ้านสวนพฤกษา เดอร์มาสเตอร์เขาดิน 169/409 ม.8 ต.ท่าตูม อ.ศรีมหาโพธิ์ ',NULL,NULL,'ศรธนฉัตร  ฐิรพงษ์วัฒนา(ทีมคุณรดา)',NULL,0),(487,'BD00018','uIKeOkrfxjQcvrEAj51-A--2Ji8Hc74B','$2y$13$Kh/pfDlqA/UW4oIRNIGwM.RZLnl.xbNPtYCe199pBreDDA4fzsLs.',NULL,'Plapatcha@gmail.com',1,1515765717,NULL,1515765717,483,12,'0982891405',NULL,NULL,'กระบี่',NULL,'41 ม.1 ต.เขาคราม อ.มือง',NULL,NULL,'อัมรินทร์ เกียงเอีย (ทีม อ.เมต์)',NULL,0),(488,'BD00026','Si3q-x3p-imYdp5_cyn2ABCZ1SxMxWsk','$2y$13$bGznUj1ksIEHDOl3ASOUUu0qDgvoonk/lSoyFHNzfU0hkbn4oWDEi',NULL,'Boonsanong05@gmail.com',1,1515765718,NULL,1515765718,1,2,'0973544422',NULL,NULL,'สงขลา',NULL,'25 ม.3 ตำบลวัดสน อำเภอระโนด จังหวัดสงขลา 90140',NULL,NULL,'บุญสนอง อุบล',NULL,0),(489,'BD00028','MeJ5oQeAT24DPRdvsHKfCn_McxhrSQ0z','$2y$13$yel8y6gffxdLtw.Y0Neh0OtDXWIScNfDZXy9G1FyunC8EAJ178s..',NULL,'sukhita9@hotmail.com',1,1515765719,NULL,1515765719,1,2,'0962682062',NULL,NULL,'นครศรีธรรมราช',NULL,'559/86 มบ.พีแลนด์.  ถ.อ้อมค่าย ม.1. ต.ปากพูน อ.เมืองนครศรีธรรมราช',NULL,NULL,'สุขิตา  คันธิก',NULL,0),(490,'BD00032','qmTY51yl3g7UzMDn_G4uCrmNEQkeMcGH','$2y$13$QSqs5wtQEqoj9FK.QKsNNOtE5aiEqKlHTvWkh2k15ReY5HBxOkgDy',NULL,'vr.natty@gmail.com',1,1515765720,NULL,1515765720,483,11,'0954205611',NULL,NULL,'ภูเก็ต',NULL,'59/32 ม.4 ต.กะทู้ อ.กะทู้ จ.ภูเก็ต 83120',NULL,NULL,'นางสาวจันทร์เพ็ญ. ใสเย็น',NULL,0),(491,'BD00034','PgipdXOuz2EdZ792QojRWg34SUZv2WUl','$2y$13$WgEFt2C9YM/TiQ17eSVi4.b0MAiijCMGxKcXr5b5Z//rDf8vkoWxe',NULL,'pchantamunee@gmail.com',1,1515765721,NULL,1515765721,1,2,'0952656391',NULL,NULL,'สุราษฎร์ธานี 84000',NULL,'11/229  ม.3 ซ.สุทธิรักษ์  ถ.เลี่ยงเมือง ต.มะขามเตี้ย อ.เมืองสฎ.',NULL,NULL,'นางภัทรพร  จันทมุณี',NULL,0),(492,'BD00035','iuGh0WXl9U-YO5GDmpHKFWkW0eF21vkL','$2y$13$mhPzw7CIDvA0oXDI1LkECuMqJkCx8ZoAsRwPyIoZToREQ5yFE.1P.',NULL,'Jittra_za@icloud.com',1,1515765722,NULL,1515765722,1,2,'0952621315',NULL,NULL,'นครศรีธรรมราช',NULL,'263/1ม.3ต.หินตก อ.ร่อนพิบูลย์',NULL,NULL,'จิตตรา จันทร์อุทัย',NULL,0),(493,'BD00040','uHJkoTYdFrI1IWLUK9uF3UvpqMG96fZr','$2y$13$uPJW/MgKpBOC5sOwV0N03eacEPo3HSsgKu1mLXNGAwuhQ0b/5KwBu',NULL,'saranyaboonrid@gmail.com',1,1515765723,NULL,1515765723,483,13,'0948061269',NULL,NULL,'ภูเก็ต',NULL,'59/32 หมู่ที่ 4 ตำบลกะทู้ อำเภอกะทู้',NULL,NULL,'นางสาวสรัญญา บุญฤทธิ์',NULL,0),(494,'BD00041','Rkndk89bpb-can4XogeYedGmLXBkXClJ','$2y$13$vxK21FRUR9f7tQxuLjJyk.g.HSqq.e1axU5mXPpZVh.8EMOAJZjBq',NULL,'Plapatcha@hotmail.com',1,1515765724,NULL,1515765724,483,12,'0944246461',NULL,NULL,'กระบี่',NULL,'41 ม.1 ต.เขาคราม อ.เมือง',NULL,NULL,'ณภัทร เกียงเอีย (ทีม อ.เมต์)',NULL,0),(495,'BD00046','V9kBMayBaHobrukb9CHyQc77dJS1ynT_','$2y$13$Td/9XS3MpyqM735sklVIQOUxyCxvtjhcSAxBjOMzM4UZbvcJU3nO.',NULL,'miwchapayom06@hotmail.com',1,1515765726,NULL,1515765726,1,2,'0942963954',NULL,NULL,'ภูเก็ต',NULL,'17/87 ม.2 ถ.เจ้าฟ้าตะวันออก ต.วิชิต อ.เมือง จ.ภูเก็ต 83000',NULL,NULL,'อรพิน เสนทอง',NULL,0),(496,'BD00047','rNrXdP26M_PDJbPZONCnkmMbTT5TETQm','$2y$13$iqjcHHRdnRlbQSlfQPitQuJj.TWsFWvcbhJc/uIeo0COg409raCVS',NULL,'Bunny.bearring@gmail.com',1,1515765727,NULL,1515765727,1,2,'0941565273',NULL,NULL,'สุราษฎร์ธานี',NULL,'39/1ม.5 ต.ทรัพย์ทวี อ.บ้านนาเดิม จ.สุราษฎร์ธานี 84240',NULL,NULL,'เจนจิรา ทองวิเศษ',NULL,0),(497,'BD00048','GsiMbHhBqQDAhGMSTIDBu8lIsxeOFIk4','$2y$13$tgrc3l8W6p4B4QDzT1.NA./O9CqjQzlesXUqjkPdCjMTLqWlPh656',NULL,'Kaewkhaw23.1988@gmail.com',1,1515765728,NULL,1515765728,483,13,'0939516956',NULL,NULL,'สุราษฎร์ธานี  84260',NULL,'218 ม.7 ต.เคียนซา  อ.เคียนซา',NULL,NULL,'นางสาวจิราพร  แก้วขาว (สายอ.อุ๊)',NULL,0),(498,'BD00050','RrSeTyVOy5thQo620m4Cawx2IPuB_l56','$2y$13$ILrxgaSmQelI5rUm3r.u6epEfPV3FifwIojxa3lXi3KxHnv5bB5F.',NULL,'Save7@gmail.com',1,1515765729,NULL,1515765729,483,13,'0937834785',NULL,NULL,'นครศรีธรรมราช',NULL,'29/1ม.4 ถ.ประชาบำรุง ต.หินตก อ.ร่อนพิบูลย์ จ.นครศรีธรรมราช 80350',NULL,NULL,'สุนีย์รัตน์ ชุมแก้ว',NULL,0),(499,'BD00051','g33znAq7r4IsbxpmKlEdsYwBkb0gxlKU','$2y$13$ZZL2tqIid5zpmYN4KBMAIO/4b3G29C6/AoDGw1fIs9s5FQmyx6rRa',NULL,'Saveeya7@gmail.com',1,1515765730,NULL,1515765730,482,6,'0937725080',NULL,NULL,'ภูเก็ต',NULL,'23/153 ม.5 ถ.ประชาอุทิศ ต.รัษฎา อ.เมืองภูเก็ต จ.ภูเก็ต 83000',NULL,NULL,'นางสาวซาวียะห์. โดเระ',NULL,0),(500,'BD00053','CB5JKvOf1V_zDllEA2QaU1WtXca1wcI4','$2y$13$Iq1qbx3k6fHbyVHr8vX7n..iM4IXSEGCteQUD5hWIYNuwTN8piKSm',NULL,'phukpuk789@gmail.com',1,1515765731,NULL,1515765731,483,13,'0937438887',NULL,NULL,'ภูเก็ต',NULL,'ฉลองคอนโดวิว 138/8. หมู่ 4 ต. ราไวย์ อ. เมือง จ. ภูเก็ต 83130',NULL,NULL,'นางสาวชัชฎาภรณ์ ประเสริฐสังข์ุ',NULL,NULL),(501,'BD00063','hAJP842PRbt9GpNxjQFZ8t6Kk9zCiZBt','$2y$13$5jQ6ZK7OFURHN57e/7B/Tuzu9s9zymiD63ESymYz3KT.aLxV9ZtUi',NULL,'ginja@gmail.com',1,1515765734,NULL,1515765734,483,13,'0925713993',NULL,NULL,'พังงา',NULL,'2/12 ม.5 ต.ท้ายเหมือง อ.ท้ายเหมือง จ.พังงา 82120',NULL,NULL,'นางสาวกรรณิกา รัตนพันธ์',NULL,0),(502,'BD00070','dzZ7te7kFZwEWZC87CVQ2i12N218uV5C','$2y$13$Z1dNWbwDUcvmKEuhpFPyMuGvD3ylaaRtoxKCp3TNo/rQGtDzLu9G2',NULL,'Aimmy.kamp@gmail',1,1515765735,NULL,1515765735,499,13,'0899737390',NULL,NULL,'ระยอง',NULL,'0',NULL,NULL,'รักษณาลี โสมาบุตร',NULL,0),(503,'BD00071','GDoHLqW506kXLNT-RGG8qXYq0XceGfFY','$2y$13$Z3QqgCvei2Yd4um4f7IWeu1x.Yq/Cy6FzPIm2clExKeHOeVFmDh7q',NULL,'Jarunee Darakai@gmail.com',1,1515765736,NULL,1515765736,1,2,'0898759773',NULL,NULL,'นครศรีธรรมราช',NULL,'322 ม.2 ต.หินตก อ.ร่อนพิบูลย์ จ.นครศรีธรรมราช 80350',NULL,NULL,'จารุณีย์ ดารากัย',NULL,0),(504,'BD00072','go2_A4m-UnW568Z9iUAqJVABnZn7azQ3','$2y$13$nSA1jPQRGwx9g2dI.F3EHeD5QCpqV5QLggCTjExlpSN2naR/ym0p2',NULL,'Nadeeya1900@gmail.com',1,1515765737,NULL,1515765737,499,13,'0898669992',NULL,NULL,'ภูเก็ต',NULL,'72/142 หมู่ 7 ต.รัษฎา อ.เมืองภูเก็ต ',NULL,NULL,'อันนาดียาร์ เบ็ญอ้าหมาด',NULL,0),(505,'BD00073','XLxise2d4ay_Ca_8c8RLAFz6KhLex4QW','$2y$13$19W8FjfzvxwX0pWzlgWq/eIiXGlfqc15meZgi8DYP39fBy41lByT2',NULL,'Wanna_na@live.com',1,1515765738,NULL,1515765738,1,2,'0897963956',NULL,NULL,'พัทลุง',NULL,'223  ม.5  ต.โคกม่วง  อ.เขาชัยสน  จ.พัทลุง',NULL,NULL,'นางวรรณา  สุขสวัสดิ์',NULL,0),(506,'BD00074','SOKljxOkUYYDTCFOyQHCfHsbWtnDaA6X','$2y$13$rPtAo5JJLPh.C6IvsOmFLOaKnUlZzmbc8tpVRPA.qXmTiJfgk7Bry',NULL,'Nitcha4256@gmail.com',1,1515765739,NULL,1515765739,1,2,'0897914256',NULL,NULL,'พัทลุง',NULL,'2/3 ม.7 ต.ชัยบุรี อ.เมือง',NULL,NULL,'ณิชชา  ธัญธรชูหนู',NULL,0),(507,'BD00075','D8T_9SMjOONTg5uBDQbvRIV9O74jvA0u','$2y$13$tdK/PEdSsWlpRgXgtOdmp.3WGhUSJlV.11oFT.vbxFLWqn5d6.fQW',NULL,'deacc@gmail.com',1,1515765741,NULL,1515765741,499,13,'0897343348',NULL,NULL,'พัทลุง',NULL,'262 ม.10 ต.ป่าบอน อ. ป่าบอน จ.พัทลุง 93170',NULL,NULL,'นางสาวสุภาวรรณ อุไรวงศ์',NULL,0),(508,'BD00076','mqwdS1-sShrHjTLqkwRAetE4JuTU-Usj','$2y$13$9yQCw8DbiwUsNTMmJnYTJOoI1Ls6LFFSGgbBSECssjAyg7saMrczu',NULL,'khunwo_ffranat@hotmail.com',1,1515765742,NULL,1515765742,NULL,4,'0896120928',NULL,NULL,'นครศรีธรรมราช',NULL,'33/3 ม. 2ต. เสาธง อ. ร่อนพิบูลย์',NULL,NULL,'วรนาฏ สุทธิพิทักษ์',NULL,0),(509,'BD00078','P_PXNxhpsL0qp5KCPdvW0XpB3ioQsFAu','$2y$13$kg/uHX8trdxxTo4Ft16zCOk.N//8W6Y6wREnjiIGmKJ0HQ1L20JWm',NULL,'deeracc@gmail.com',1,1515765742,NULL,1515765742,483,13,'0895905274',NULL,NULL,'พังงา',NULL,'10 ม.1 ต.ท่านา อ.กะปง จ.พังงา 82170',NULL,NULL,'นาวสาวปภัชญา ทิพย์รงค์',NULL,0),(510,'BD00079','K6VKho0I9VZHvxxlHKJ5PTCzZQ5h6Cqi','$2y$13$Z/KMx7CDCWx5fhkYTJBrLuKKcoGBSVy55akc3a4ZV7r4TXf4kkoIy',NULL,'mali2505@hotmail.com',1,1515765744,NULL,1515765744,1,2,'0895540564',NULL,NULL,'นครศรีธรรมราช',NULL,'20/129 หมู่บ้านนครเลควิวซอย 14 ต. ปากนคร อ.เมือง',NULL,NULL,'นางลฎาภา ดำจันทร์',NULL,0),(511,'BD00080','R7bgdwhct6136hy7GGr0_hROtlh5H8kC','$2y$13$kbETWBpiPe.iQKRhjRWkPOvac8PagQlj/rxInurooN8H2sgDEgsSC',NULL,'sriseema.laor@gmail.com',1,1515765745,NULL,1515765745,1,2,'0895178047',NULL,NULL,'นครศรีธรรมราช',NULL,'118/1 ม.1 ต.ปากพูน อ.เมือง จ.นครศรีธรรมราช  80000',NULL,NULL,'ละออ ศรีสุมา(สายอาจารย์เมต์)',NULL,0),(512,'BD00081','rzCXcD9xJLD-kNY_AVOI2sWnVc7HDap_','$2y$13$RWNH4sNlVCKw/FQUxabViuQC5nZZATnz/sIdVZP2Md5hG6Pi5SFfi',NULL,'srisuma.lauri@gmail.com',1,1515765746,NULL,1515765746,1,2,'0895178047',NULL,NULL,'นครศรีธรรมราช',NULL,'118/1 ม.1 ต.ปากพูน อ.เมือง จ.นครศรีธรรมราช 80000',NULL,NULL,'นภัสกร ศรีสุมา(สายอาจารย์เมต์)',NULL,0),(513,'BD00082','rOOXmM-JuFbWJ9LABUxNUa6ZksouL0__','$2y$13$d1PnlBluSkHOautnqqloG.GRMxnU0/t/5DLYePmVX75WZywGUsndm',NULL,'Saransiri555@gmail.com',1,1515765747,NULL,1515765747,NULL,NULL,'0894662339',NULL,NULL,'สงขลา',NULL,'59/17 ม.สุธาทิพย์ ถ.สาครมงคล2 ต.หาดใหญ่ อ.หาดใหญ่',NULL,NULL,'ศรัณย์สิริ สมบูรณ์',NULL,0),(514,'BD00083','YgVxgQPsLpVpMoLcPMa82H9iQYZk9Ijd','$2y$13$vwVQ2x8eBYbf4PsidTLfJeWWqi91uw1qcb0pF8PEHgvg42fExVLlS',NULL,'Wanlika 0099 @gmail.com',1,1515765748,NULL,1515765748,499,11,'0894620099',NULL,NULL,'พัทลุง',NULL,'112 ม.7 ต.หานโพธิ์ อ.เขาชัยสน จ.พัทลุง 93130',NULL,NULL,'น.สวัลลิกา ลักษณะ',NULL,0),(515,'BD00084','fn79aZAl--ISxZrfGz5tiDwmV-_clSUv','$2y$13$80x0jC2E67fLVHN3RFdVAu1ldufz2PVAsN2oiMa05.6eew6/3qxL6',NULL,'jinnnn@gmail.com',1,1515765749,NULL,1515765749,499,13,'0892996068',NULL,NULL,'พังงา',NULL,'สภ.ตะกั่วป่า อ.ตะกั่วป่า จ.พังงา 82110',NULL,NULL,'นางสาวเพ็ญพักตร์  ภัทชวงค์',NULL,0),(516,'BD00085','LE03lUxLGhpAjHOTUwKOXL1rzGEdPNba','$2y$13$w8OeOCITXPQhXsGUcFDHO.bT24oFQVD8zvAqkxyfLZ5WcRflwDarO',NULL,'nafees_sial@hotmail.com',1,1515765750,NULL,1515765750,483,13,'0890611741',NULL,NULL,'นครศรีธรรมราช',NULL,'156/8 moo.3 t.thasla nakhon si thammarat',NULL,NULL,'Nafees ul hassan',NULL,0),(517,'BD00088','HsWDg_Qz5V6Ajm-kzl7cXcOvSBzLOHTd','$2y$13$K582murfO8ZccoHdzJ9lu.LioA0.8smcXby0uWXnfEKsCy832xoDK',NULL,'Wannidapromthong84@gmail.com',1,1515765751,NULL,1515765751,483,13,'0885398989',NULL,NULL,'สกลนคร',NULL,'43  ม.13 บ.บัวหลวง ต.สว่าง อ .พรรณานิคม  จ.สกลนคร 47130',NULL,NULL,'ธาริณี เหล็กอ่อน',NULL,0),(518,'BD00089','fD1jKBGHvITZgnlVffMr7S_KMb-Fl0CJ','$2y$13$gvbELZW3Jjv5nTS.Y0skLOtsx4feTfRCWP5rey35mZ3YFfwRE0KZC',NULL,'Kukkuy93@hotmail.com',1,1515765753,NULL,1515765753,511,4,'0878968391',NULL,NULL,'นครศรีธรรมราช',NULL,'27 ซ.พิทักษ์ธรรม ถ.เอเซีย ต.โพธิ์เสด็จ อ.เมือง',NULL,NULL,'จรัสศรี รักษาวงศ์ (ทีมกฤตพล คันธิก)',NULL,NULL),(519,'BD00091','5lhzNSc-P_5hWN0GLH4BOphfkZMIvQWU','$2y$13$XF4WNLMKzdWqljwt9k0S2eBQxMPpqHPMhjrTqlYxPiTE7p3sofduq',NULL,'deecent8956eracc@gmail.com',1,1515765754,NULL,1515765754,483,13,'0878827511',NULL,NULL,'พังงา',NULL,'24/59  ม.1 ต.ลำแก่น อ.ท้ายเหมือง จ.พังงา 82210',NULL,NULL,'นางสาววรรณภา บุญตาม',NULL,0),(520,'BD00092','szjYZpEWbwjt6tqXefwBZEWUjckCj-Sf','$2y$13$C0p2ir0YnvDMLvF4X14NLewED2RnWok6OFT.6ogjHRSSKJAsjYsDK',NULL,'butsaben@ gmail.com',1,1515765755,NULL,1515765755,482,6,'0874671830',NULL,NULL,'ตรัง',NULL,'43/23 ถ.โรงเรียน  อุดมลาภซ.3ต.ทับเทียง อ.เมือง',NULL,NULL,'รัตน์ใจ นกแก้ว ทีมเมย์',NULL,NULL),(521,'BD00093','2RiEpoTgfJxVz4aYswY50LCfURLouBw5','$2y$13$Tw7bnzCeLIbCaVMmrsnnfuv3gQMOGL7Z5H/wU0sshsTZo10JYYwty',NULL,'srisuma.laor@gmail.com',1,1515765756,NULL,1515765756,1,2,'0874627812',NULL,NULL,'นครศรีธรรมราช',NULL,'118/1 ม.1 ต.ปากพูน อ.เมือง จ.นครศรีธรรมราช 80000',NULL,NULL,'อรสา แทบทับ(สายอาจารย์เมต์)',NULL,0),(522,'BD00094','9gmMPgrldFKsYymZoU1xgp4oYxH1r6JR','$2y$13$jqUyL.ph4u9EJWeYahoi7O7l2Hxkt0soUky3IWWnINQy6NUK7QdtW',NULL,'1srisuma.laor@gmail.com',1,1515765757,NULL,1515765757,1,2,'0874627812',NULL,NULL,'นครศรีธรรมราช',NULL,'118/1 ม.1 ต.ปากพูน อ.เมือง จ.นครศรีธรรมราช 80000',NULL,NULL,'สุราษ รักษ์เส้ง(สายอาจารย์เมต์)',NULL,0),(523,'BD00096','KkNSP1WOA3S7GtTTsgACSqr_j9s-bi7I','$2y$13$snQVnmt8v11zbfPQT.9Y/OyhvJFRQy47DJpWCIOA1e3QxyQa9ETgG',NULL,'patcharee_ jim2010@hotmail.com',1,1515765758,NULL,1515765758,499,13,'0867405995',NULL,NULL,'นครศรีธรรมราช',NULL,'45 ซอยศรีธรรมโศก1ต.ในเมืองอ.เมือง',NULL,NULL,'พัชรี แก้วประจุ',NULL,NULL),(524,'BD00097','wQwKW9TuFkjV2usQvScoxEr6ALc7Yf0K','$2y$13$KlrEeXxKnBgBx1TtdY5XzefdSQZH3jtAa/Yl7LIIOFh3hV2LDLazy',NULL,'wankaewj@gmail.com',1,1515765759,NULL,1515765759,482,6,'0864923621',NULL,NULL,'ตรัง',NULL,'48/19 ถ.พัทลุง ซ.6 อ.เมือง',NULL,NULL,'จิราพร หวานแก้ว ทีมเมย์ ',NULL,NULL),(525,'BD00098','bHImcOOq49QRUtk-VSVgQQ0amQFm0mye','$2y$13$3AVuAmdoJaA3EQUD3aDtM.Ifs1S6NqAtfVEBMz3QhtgVHK6wcPylu',NULL,'bangfee.2544@gmail.com',1,1515765760,NULL,1515765760,524,13,'0863795776',NULL,NULL,'นครศรีธรรมราช',NULL,'274 ม.1 ต.วังหิน อ.บางขัน',NULL,NULL,'เอกรัฐ รัญจวน',NULL,NULL),(526,'BD00100','Q1ORBE6zP4fS9TcDc_T-KhuJDUonaCZX','$2y$13$6qXlSb.RueBztr1O4/Gwsu.noHuf.h2Be.PxoTFjoREgnOgmM/EyO',NULL,'Kukkuy69@hotmail.com',1,1515765761,NULL,1515765761,1,2,'0863293683',NULL,NULL,'นครศรีธรรมราช',NULL,'464/1 ม.1 ต.ปากพูน อ.เมือง',NULL,NULL,'กฤตพล คันธิก',NULL,NULL),(527,'BD00102','d8uXubk-m5TjxoRLmb-6tWxMjRM-u1r6','$2y$13$Q./0ZCXg0E4xQGKI5Yd6d.DqynAkTrL2NoFXA0LT.JPK7.CpEn/OO',NULL,'Nivatsaya8369@hotmail.com',1,1515765762,NULL,1515765762,524,13,'0862938369',NULL,NULL,'พัทลุง',NULL,'84/1ม.4ต.คลองทรายขาว อ.กงหรา',NULL,NULL,'พุทธพร. นิลพัฒน์ (ทีมพี่เมย์)',NULL,NULL),(528,'BD00103','hG5ybcmDiy1TfNNJC7MI_-2oZbKnTzAM','$2y$13$POp5cz1odssiZRTikTV/Yu/bSR7ZobLqZ0aNO4OzvBywAtHBi1B2G',NULL,'2deecenteracc@gmail.com',1,1515765763,NULL,1515765763,499,13,'0862809344',NULL,NULL,'พังงา',NULL,'การไฟฟ้าส่วนภูมิภาค อ.ท้ายเหมือง 199/13 ม.9 ต.ท้ายเหมือง อ.ท้ายเหมือง จ.พังงา 82120',NULL,NULL,'นางสาวบังอร มิตรวงศ์',NULL,NULL),(529,'BD00105','EekzcAwaW8D84mAMMwe11pVaXOLEAeQ9','$2y$13$bXYiH9QRessrjDYrJDVEXO5g/W23Lwr/74Cp/gnrNrkgoqoxn4AIS',NULL,'1deecenteracc@gmail.com',1,1515765764,NULL,1515765764,520,13,'0858885850',NULL,NULL,'ภูเก็ต',NULL,'โรงเรียนภูเก็ตวิทยาลัย 73/3 ถ.เทพกระษัตรี ต.ตลาดใหญ่ อ.เมืองภูเก็ต จ.ภูเก็ต 83000',NULL,NULL,'นายณัฐพงศ์ ประทีป ณ ถลาง',NULL,NULL),(530,'BD00112','cwJKvJzxij9xMrrLRMTDlgNvJmMVpKXm','$2y$13$nBun60IS/gdtnElrA4udT.j3vVAF3GX/0QuqejZXnLUlCW7UMDdHa',NULL,'Dosit4141Bonmak@gmail.com',1,1515765766,NULL,1515765766,483,11,'0850691107',NULL,NULL,'นครศรีธรรมราช',NULL,'562ม.3 ต.หินตก อ.ร่อนพิบูลย์',NULL,NULL,'กัลยารัตน์ จันทร์อุทัย',NULL,NULL),(531,'BD00113','CYr0E9MBcGpa6zFe0lJEn7fQKIBu1P-9','$2y$13$6TyLCexU45yYdz8Q3J/SU.P70k0XREiRMQBv5QXwJ9.IsDgSQj6Ye',NULL,'Dosit4142Bonmak@gmail.com',1,1515765767,NULL,1515765767,521,4,'0849977018',NULL,NULL,'สงขลา',NULL,'9/6  ม.6 ต.ท่าข้าม อ.หาดใหญ่',NULL,NULL,'นส.พิมพ์พิศา  จิโรจลากิน',NULL,NULL),(532,'BD00117','CbO7xUiUIcIFi25v5QdiWCKS7etLGB1f','$2y$13$hJDF2.VyLjRkHPfebiY8muesA4VChAtroAX.Zdgh2T2RiSP7EN3VK',NULL,'Banjawan.Sumakorn@gmail.com',1,1515765769,NULL,1515765769,524,13,'0847465069',NULL,NULL,'สุราษฎร์ธานี',NULL,'35/9 ม3 ต.กรูด  อ.พุนพิน',NULL,NULL,'นางเบญจวรรณ  สุมาการ',NULL,NULL),(533,'BD00121','ox3GujXMDmfl8kzf8e7_JxbYAOyN67oR','$2y$13$gmYv0u4e2/bAlsgDY8uVNOQcT4L.IcGEWDdzVsYg4Yd2S9boqBw1a',NULL,'Saidy_32@hotmail.com',1,1515765770,NULL,1515765770,505,4,'0844438576',NULL,NULL,'กระบี่',NULL,'46/1ม.3 ต.ศาลาด่าน อ.เกาะลันตา',NULL,NULL,'ณัฐวดี งดงาม',NULL,NULL),(534,'BD00122','og-f36DoCtfx8dZ9JXlityFMDX1Mzuiv','$2y$13$vTWXfItd8K3t0Y9/EsI4d.fOD2tDHEbB.XmWFSRJMZwx2pyT.na16',NULL,'NICHAPAT 5382@GMAIL.COM',1,1515765771,NULL,1515765771,508,6,'0841471593',NULL,NULL,'สตูล',NULL,'130  ม.2 ต.ย่ายซื่อ อ.ควนโดน ',NULL,NULL,'นส.ณิชาภัทร  ศรุตไวทยะ (ทีมพี่นา)',NULL,NULL),(535,'BD00123','j7UWOwNwsR7GJ20ts2usRIjP_OsDQXap','$2y$13$vBEdu6.g7do19/LdArs/oudBUS6LfsIW.YgTPZcOwYK2sc.Aljflq',NULL,'butsaben@gmail.com',1,1515765772,NULL,1515765772,1,2,'0835426356',NULL,NULL,'ตรัง',NULL,'48/19 ถ.พัทลุง ซ.6 ถ.พัทลุง ต.ทับเทียง อ.เมือง ',NULL,NULL,'บุษเบญ บริสุทธิ์',NULL,NULL),(536,'BD00124','Oy0jT4xn7JK4sf5AnKsnR1j6sdRhmVMH','$2y$13$zYzprAI3t3HO.smSzVQjG.X3d96xDv.u4jpbsIlbtjbQwGVwoG.z.',NULL,'Pratrue.jia@hotmail.com',1,1515765773,NULL,1515765773,NULL,6,'0835040864',NULL,NULL,'นครศรีธรรมราช',NULL,'50/64  .ะฒนาการคูขวาง  ต.ท่าวัง  อ.เมือง',NULL,NULL,'นส.ภัทรวดี เพชรจุ้ย ทีมพี่นา',NULL,NULL),(537,'BD00125','SNLfVXk3odaBKWpHeApKQFSYNim2k34w','$2y$13$U5aiuOaIjrDffXSZoz70a.Ej5TTUjRIyEfLcGnAoLJM9qM8q.GTTK',NULL,'Pratrue.34@hotmail.com',1,1515765774,NULL,1515765774,522,4,'0833994159',NULL,NULL,'พัทลุง',NULL,'121 ม.11  ต.เขาชัยสน อ.เขาชัยสน',NULL,NULL,'นางการย์สิริ  วรงค์สวัสดิ์',NULL,NULL),(538,'BD00126','CbtHaoN6GcdeBedFavdWV__S7_gaCsFT','$2y$13$p09xZNwnFLR/JrqgvyOWkOqrAlxZg8gzR6EwxbVXTug5..ruqN/qa',NULL,'b.thanom@gmail.com',1,1515765775,NULL,1515765775,522,4,'0831903828',NULL,NULL,'สุราษฎร์ธานี',NULL,'180/97 ม.1 หมู่บ้านโพธิ์แก้ว 2 ถ.สราษฎร์-นาสาร ต.ขุนทะเล อ.เมือง จ.สุราษฎร์ธานี 84100',NULL,NULL,'ถนอม ห่อวงศ์สกุล',NULL,NULL),(539,'BD00128','NfO2LP54hd-cGsmYayrGUNnRfYjWJIr2','$2y$13$F/Pi1bcYmkrMOrZOxxmXEuJbTFqya50nrz8IEWk2kfJXD3CIwhjki',NULL,'Kingandair lovely @hotmail.com',1,1515765776,NULL,1515765776,536,13,'0828082869',NULL,NULL,'จันทบุรี',NULL,'23/3 ม.7 ต.มะขาม อ.มะขาม จ.จันทบุรี 22150',NULL,NULL,'ตุลยา กิจผดุง(ทีมMRJa by gift)',NULL,NULL),(540,'BD00129','YHVm70A8lTUPLW_j3h1ruUHyi5FYzTsF','$2y$13$3FhDZ8j.1WXVSlJ.tlXrmeq3K7UkxJMaANlL/R0ap35qIwGd7U8Sq',NULL,'Fon.dome@hotmail.com',1,1515765777,NULL,1515765777,518,6,'0824536356',NULL,NULL,'ตรัง',NULL,'ศรีตรังตรวจสภาพรถ 352/2 ถนนห้วยยอด ตำบลทับเที่ยง อ.เมือง ',NULL,NULL,'จารุณี คงรอด',NULL,NULL),(541,'BD00130','MasdYusr-V5cW7NUVjQmVzq6tP8efouo','$2y$13$bhhSw0/cnZqZChAECPnug.MA.L6cVijS8XHiTjgoRc4oH6Ov3nFdm',NULL,'nattanan8040@hotmail.com',1,1515765778,NULL,1515765778,534,11,'0824149365',NULL,NULL,'ตรัง',NULL,'ณัฐนันท์ ชูเชิด (แผนกบริการ) บริษัทโตโยต้าเมืองตรัง 392/1 ถ.ห้วยยอด ต.ทับเที่ยง อ.เมือง',NULL,NULL,'ณัฐนันท์ ชูเชิด',NULL,NULL),(542,'BD00131','es2hCtRZWmb6A5XPMAAZx6jdP9kXDHN8','$2y$13$JZsqgDsem1WHE28SlTFIo.azYBs9YT97X46yVXEKnIXytoZNCAlZa',NULL,'Punnapha2510@gmail.com',1,1515765779,NULL,1515765779,492,4,'0819792510',NULL,NULL,'ตรัง ',NULL,'206/55 ถ.วิเศษกุล อ.เมือง จ.ตรัง',NULL,NULL,'พรรณี สิทธิชัย',NULL,NULL),(543,'BD00133','t2oqZxFHT-NB-UE81aFv3--2DuDzIsuS','$2y$13$q3JIb1j7/hdqpRUgOwrW6ecrBaieVASvQKdK0jGlKU0M1f1Rg8aBq',NULL,'Namkannapa@gmail.com',1,1515765781,NULL,1515765781,499,13,'0818928324',NULL,NULL,'สุราษฎร์ธานี',NULL,'50/5 ถ.เจริญลาภ ต.ท่าข้าม อ.พุนพิน จ.สุราษฎร์ธานี',NULL,NULL,'กาญจน์นภา ศรีเชื้อ',NULL,NULL),(544,'BD00134','ezNsdkmAqbl5MUtHBmvZ7KWa855_K53R','$2y$13$Rwv7gjBsOIStK5.JbjFyMeCLPw6bddCDnr0p.FVIe7pwp8P7wiZqy',NULL,'deecenteracc34@gmail.com',1,1515765782,NULL,1515765782,524,13,'0818915575',NULL,NULL,'ภูเก็ต',NULL,'1/27 ม.4 ถ.วิเศษ ต.ราไวย์ อ.เมืองภูเก็ต จ.ภูเก็ต 83130',NULL,NULL,'นางสาวจริยาพร หลังทอง',NULL,NULL),(545,'BD00135','VfHsU_EUlMKhsPlScZfifx7bK7n7YK-8','$2y$13$TMoZwqOSsumSrOWLoiGr4.jcqMHVnD3bVUc/NIx6Xu6XDsGwHYdLS',NULL,'deecenteracc56@gmail.com',1,1515765783,NULL,1515765783,540,13,'0817882272',NULL,NULL,'ภูเก็ต',NULL,'26/1 ถ.แม่หลวน ต.ตลาดเหนือ อ.เมืองภูเก็ต จ.ภูเก็ต 83000',NULL,NULL,'นางสาวดวงใจ นุวรรณ์',NULL,NULL),(546,'BD00136','26UuVs2LZQkaJ3Dw_PBz5gZSH8wyMjjV','$2y$13$k6yDYTmoBCnt5DYBsZIRw.OUoubtTxvXbIDvEaJPE0AKftaSZTU/2',NULL,'deecenteracc8999@gmail.com',1,1515765785,NULL,1515765785,540,13,'0817523538',NULL,NULL,'พังงา',NULL,'1/8 ม.4 ต.ท้ายเหมือง อ.ท้ายเหมือง จ.พังงา 82120',NULL,NULL,'นายฐานิศร์ พรกรัณ',NULL,NULL),(547,'BD00137','8RoH8Yp8ZVFGXCVRvb6hPFYzWrdjw70S','$2y$13$hB0JZOtRno66H2BLKjcxr.GAEuP7i./0PVwJx4OgWPnsNxs.xkgLe',NULL,'Yayaying.aia2@gmail.com',1,1515765786,NULL,1515765786,1,2,'0815366562',NULL,NULL,'ตรัง',NULL,'40/7 ถ.โคกขัน ต.ทับเที่ยง อ.เมือง ',NULL,NULL,'ศศทัด รักเพชร',NULL,NULL),(548,'BD00141','guLOxTMmBVPa45nrvC0H5zK4watjFqnr','$2y$13$mlFX77wPRhwNBQGAUFfgYuXPfNl3hkQ4L/RTLjTWsr/UIVEHsWEqS',NULL,'deecenter1acc@gmail.com',1,1515765788,NULL,1515765788,540,13,'0812711550',NULL,NULL,'ภูเก็ต',NULL,'องค์การบริหารส่วนจังหวัดภูเก็ต ต.ตลาดใหญ่ อ.เมืองภูเก็ต จ.ภูเก็ต 83000',NULL,NULL,'นางสาวอุราพร แก้วเจือ',NULL,NULL),(549,'BD00142','o9hZexgm7z9bOjnomIupbE6P2jTE-4Qg','$2y$13$LyRhn2/WE4WMRncGxrliw.wtxw8lSr/fX7rALvSDchBTG3eP70ZSe',NULL,'deecenter2acc@gmail.com',1,1515765789,NULL,1515765789,520,13,'0811884815',NULL,NULL,'ภูเก็ต',NULL,'151/34 ม.4 ต.ไม้ขาว อ.ถลาง จ.ภูเก็ต 83110',NULL,NULL,'นายอชิรดิษย์ จันทนุ',NULL,NULL),(550,'BD00143','uT6kjQgyo_0VJzpH5gAbEbmOuBCr5ynu','$2y$13$AB7vEtLPUNEc1nPcxuADEuJP0BDXEX.vqMFKRA98C2yPNjsA8E0Uq',NULL,'deecenter3acc@gmail.com',1,1515765790,NULL,1515765790,520,13,'0811870209',NULL,NULL,'ภูเก็ต',NULL,'151/34 ม.4 ต.ไม้ขาว อ.ถลาง จ.ภูเก็ต 83110',NULL,NULL,'นางสาวเพ็ญศิริ ทรัพย์สุนทรกุล',NULL,NULL),(551,'BD00145','d8PA5tOt3DXEOTWCWvTcPdwjbBre3KY-','$2y$13$2NvjilDuq1n7fbEDPFD8nO2Q9s3my9II1K8mmfhwCFW7wh7hE98fK',NULL,'Gifzza@hotmail.com',1,1515765791,NULL,1515765791,481,4,'0808832858',NULL,NULL,'นครศรีธรรมราช',NULL,'9/1 ม 5 ต ท่างิ้ว อ เมือง',NULL,NULL,'สรณีย์ กิจผดุง',NULL,NULL),(552,'BD00148','ybCacz9WWCA3I8tbZyZ_aEdz9tH5pwvu','$2y$13$EI.ut915NsyUHjJNmwLJhegsOCd549c6S62QgS3DA6L9YInTrOx2y',NULL,'deecenteracc1@gmail.com',1,1515765792,NULL,1515765792,524,13,'0805940443',NULL,NULL,'กรุงเทพมหานคร',NULL,'360 ซ.อ่อนนุช 54 แขวงสวนหลวง กรุงเทพฯ 10250',NULL,NULL,'นางสาวพัณณ์วรา ผ่องปัญญา',NULL,NULL),(553,'BD00149','g7IydpZgvTlEx78qeo-9HZJmWVWGgyw3','$2y$13$STUyCmI8UvDCTjdLEDwWx.Kk2.4KnpYJkpvIrToWW3reMlvYQOQlW',NULL,'deecenteracc2@gmail.com',1,1515765793,NULL,1515765793,534,13,'0805940443',NULL,NULL,'กรุงเทพมหานคร',NULL,'360 ซ.อ่อนนุช54 แขวงสวนหลวง เขตสวนหลวง กทม.10250',NULL,NULL,'นายเอกชัย. ผ่องปัญญา',NULL,NULL),(554,'BD00150','Ek3YGMolibNyMAVD5v5AhItk0-T_Dlj0','$2y$13$tbJbnRGhdnhWtrj9KfPAguEmXB14q1X4GY6ILkxbCqTRcG068g57K',NULL,'deecerteracc3@gmail.com',1,1515765794,NULL,1515765794,536,13,'0805929772',NULL,NULL,'กรุงเทพมหานคร',NULL,'จ.ส.ต.หญิง ณิชกานต์ อุไรวงศ์ กองบังคับการปราบปราม 1096 ถ.พหลโยธิน แขวงจอมพล เขตจตุจักร กทม.10900',NULL,NULL,'นางสาวณิชกานต์ อุไรวงศ์',NULL,NULL),(555,'BD00153','gdr1ufQeV2diXRvTmv4l5PzLSTD0Fvti','$2y$13$Rb0a31jjHDief4E7TNds7eaevCwE9F63TNh/ZC2FRcQFrQt4Wmk0W',NULL,'Pengseng .w@gmail.com',1,1515765795,NULL,1515765795,1,2,'0801698916',NULL,NULL,'กระบี่',NULL,'92/3 ม 5 ต พรุดินนา อ คลองท่อม',NULL,NULL,'วิทยา เป้งเซ่ง',NULL,NULL),(556,'BD00154','7zTP9NI7Pz1tjOA6703lJfvIns3b1sER','$2y$13$/8ze6ljFP/He8a2n2f..ueEoydi188ywaLxGf0dkPVYjI2NRjigWO',NULL,'Pengseng .wx@gmail.com',1,1515765796,NULL,1515765796,510,4,'0800369823',NULL,NULL,'พัทลุง',NULL,'156  ม.6  ต.โคกม่วง  อ.เขาชัยสน',NULL,NULL,'นางสาวณิรชา  รุยัน',NULL,NULL),(557,'BD00159','LKVlZyX603vUJytojwdPOiQr8Azx6Iqu','$2y$13$uw5WU7CkgAb/PVWn6Ub7gucIy.Qb0gDef14oyy2x74bCy7f0XIBeG',NULL,'again_jeab@hotmail',1,1515765797,NULL,1515765797,505,4,'0648546916',NULL,NULL,'ตรัง',NULL,'150/1 ม.4 ต.บางรัก อ.เมือง ',NULL,NULL,'วรรณพร มะนะโส',NULL,NULL),(558,'BD00161','OM9Tr76HpMDICiMMzknPw_keuWQ-nki7','$2y$13$Au4z.0VPHcL1qgLtHH437eRYnJTooZlRKGOUMEVHI4XhpUBrDxeeC',NULL,'wilaiwan123420@gmail.com',1,1515765798,NULL,1515765798,508,6,'0645245663',NULL,NULL,'นครศรีธรรมราช',NULL,'133/4ม. 6ต. ควนพัง อ. ร่อนพิบูลย์',NULL,NULL,'วิไลวรรณ อิสลาม',NULL,NULL),(559,'BD00164','Nz0A_kW8XPbOvqQNRzFPUaDSb548aWEn','$2y$13$N6F0KFg7wLq0lfOqY.HpZe3objtoDzM5w3k7dk270Rk1f4HRHdXwK',NULL,'May.3929@gmail.com',1,1515765799,NULL,1515765799,1,2,'0636424297',NULL,NULL,'สุราษฎร์ธานี',NULL,'ม สงขลานครินทร์ วิทยาเขตสุราษฎร์ธานี',NULL,NULL,'ธนัชพรรณ เพ็ชรรัตน์ (สายอาจารย์เมต์)',NULL,NULL),(560,'BD00165','WGuYAp-MEpX3ygLJjN-OZ3q4I13XIq5w','$2y$13$HejgSXtrpbvKkO1Z6EA48.TouRDLHfEgFY1k..65YD4m7JBimYIGW',NULL,'jittra5385@gmail.com',1,1515765801,NULL,1515765801,540,11,'0636180981',NULL,NULL,'นครศรีธรรมราช',NULL,'562ม.3ต.หินตกอ.ร่อนพิบูลย์',NULL,NULL,'กาญจนา จันทร์อุทัย',NULL,NULL),(561,'BD00169','JUWhJvFLl2kTXXoHzrGDHTmn4yS9Psz0','$2y$13$dHn4/08EnI5ViTYMg7IDRufYBhn/2cewSiFBUXpItPmkxUlJ7E2/e',NULL,'Supawadeethngk@gmail.com',1,1515765802,NULL,1515765802,520,13,'0633624419',NULL,NULL,'นครศรีธรรมราช',NULL,'136/2 ม 1 ต.ท้ายสำเภา อ.พระพรหม ',NULL,NULL,'สุภาวดี ทองแก้ว(MRJa by gift)',NULL,NULL),(562,'BD00172','8j_T9Zh_Te4V1ban3Xxj_EFxjHTO3KLc','$2y$13$uDCCGo/tQ1q8f7dqLpqoyuCKQPs8KIkqP3lSva9GSRRb8bChT8yuK',NULL,'Jasabyjai@yahoo.com',1,1515765803,NULL,1515765803,1,2,'0629746565',NULL,NULL,'นครศรีธรรมราช',NULL,'555/126. ม.1 บ้านขายไก่ ถนนอ้อมค่าย อำเภอเมือง',NULL,NULL,'นางพุธิตา ไชยสุภา',NULL,NULL),(563,'BD00173','XYjCRPcfMkS0vOEdmJO1kYT1q4qjO8UB','$2y$13$NjvLnioc1lV1cIddNh9.4ubJQKYtctDlSzndYksrgoItbkPUP7MHa',NULL,'happyfeetaum@gmail.com',1,1515765804,NULL,1515765804,536,13,'0629244584',NULL,NULL,'นครศรีธรรมราช',NULL,'ร้านช.ปัทมาพร  36   ซ.1 ถนนชัยชุมพล ต.ปากแพรก อ.ทุ่งสง 80110',NULL,NULL,'นางสาวชุตินาถ กันตะเพ็ชร์',NULL,NULL),(564,'BD00175','LnNC6bzQwOLH9tQtg7p6fimbaqSHnAwj','$2y$13$JR4TOiIgZmQHF5KPfycgX.qnKOWfTh6wjdKVY7Qxms3LaFL7iB4Hm',NULL,'suppachai3103@gmail.com',1,1515765805,NULL,1515765805,NULL,NULL,'0623828378',NULL,NULL,'นครศรีธรรมราช',NULL,'236ม.3 ต.หินตก อ.ร่อนพิบูลย์',NULL,NULL,'พีรดา โต้ะโดย',NULL,NULL),(565,'BD00176','mYInS0kHTv1MucvHedJgteqhrvxEXu0t','$2y$13$O3I1Z/JOZ44ym6.nzAnDcOOeGo5QZwm5sKsLONFIngKHSXKppr4mi',NULL,'jiranan.tahea@gmail.com',1,1515765806,NULL,1515765806,520,12,'0623808402',NULL,NULL,'นครศรีธรรมราช',NULL,'562ม.3ต.หินตก อ.ร่อนพิบูลย์',NULL,NULL,'สุชาดา แหยมอุบล',NULL,NULL),(566,'BD00178','Tf_NGeeeMeX_2jHZFaT9elEtjVIFYLV1','$2y$13$qeIq1W8olRj9hA83hRO4OOhCDYo2jRGkMWFBcrDwqLq6BaEkP4Y5.',NULL,'k.angkananon@gmail.com',1,1515765807,NULL,1515765807,512,4,'0623249853',NULL,NULL,'สุราษฎร์ธานี',NULL,'คณะวิทยาการจัดการ มหาวิทยาลัยราชภัฎสุราษฏร์ธานี 272 ม. 9 ต.ขนอม อ.ขนอม จ.สุราษฏร์ธานี 84100',NULL,NULL,'เกวลิน อังคณานนท์',NULL,NULL),(567,'BD00180','nmKkLKXG5kTeOViO1AM1O2q3Z1yy_3Ps','$2y$13$63/Yxb3xXds3oD7HaVymQO0wiegbM9jt0RJnPbyd/GClEhKgmnA3q',NULL,'Chalit 1984@icloud.com',1,1515765808,NULL,1515765808,1,2,'0617969567',NULL,NULL,'ตรัง',NULL,'187/4ถ.กันตังซ.9ต.ทับเที่ยงอ.เมือง',NULL,NULL,'ชลิตตา กิ่งวชิรา',NULL,NULL),(568,'','r-cx6vHiQLFS2nArUtMycErw9quqJ2GU','$2y$13$KP.aegIQsSyFr9MUw2qpY.OQhRr6gpCbTBrsUrmyxhYGhRfejuv4e',NULL,'',1,1515765809,NULL,1515765809,NULL,NULL,'',NULL,NULL,'',NULL,'',NULL,NULL,'',NULL,NULL),(569,'saesdfjid@gmail.com','n-Fzq6KCfPm0vHT59KNO6yq_vk2AM5vy','$2y$13$E/oPUO8.MdYLlgHlRmeq5uSFr/MRhfcpOLddyqd/TMVwYHjU9jCTa',NULL,'saesdfjid@gmail.com',1,1516093581,NULL,1516093581,NULL,NULL,'03008332781','03008332781','islamabad','Karachi','082','thirty to streek khan poor',NULL,'Pakistan',NULL,NULL,NULL),(570,'sajid@gmail.com','BYuk0ntTBUptaoZLI-XIve6BzUTaollP','$2y$13$tJE7jLSO/UGGN6ekOR1t9.2jP0G6/LQUgKLPf33ssZpb8NdDuYzUm',NULL,'sajid@gmail.com',1,1516093854,NULL,1516093854,NULL,NULL,'03008332781','03008332781','islamabad','Karachi','082','thirty to streek khan poor',NULL,'Pakistan',NULL,NULL,NULL),(571,'naeem','WDCLo1-jH_BPzPMtq9UpbeKmT4U_xqZS','$2y$13$2rvnK/VMfEp60xs0hl8.EOAPlzgt7MD2P.QDPdX6le2EeX411.bLi',NULL,'naeem@gmail.com',1,1516106588,NULL,1516106588,481,4,'03008332781',NULL,NULL,NULL,NULL,'thirty to streek khan poor, bareek road london','islamabad','Thailand ','Naeem','Khan',NULL),(572,'badar','tfsnh4Wd5G7-bGg_rgG51RAFeE7OMQux','$2y$13$.9hOvOG15GJz1FTtfa0zF.Aluo4qhdiQgHL8TShNBVmqrL/ETNA/K',NULL,'badar@gmail.com',1,1516106677,NULL,1516106677,481,4,'03008332781',NULL,NULL,NULL,NULL,'thirty to streek khan poor, bareek road london','islamabad','Thailand ','badar','Khan',NULL),(573,'naeemqqqq','2--D6C8QeENoDdIuaWCt47RZr9-sszbs','$2y$13$gDSCsLET6gOa7jBrm0VoUO4fPHk5PNPutVL6aWBWWaXF7vvhKxDYy',NULL,'naeeqqqm@gmail.com',1,1516281880,NULL,1516281880,1,2,'03008332781',NULL,NULL,NULL,NULL,'thirty to streek khan poor, bareek road london','islamabad','Thailand ','Naeemqwq','Khanqw',1),(574,'sajiffffffffd@gmail.com','3TXdM9LcaqEBikXs4xHX6x1IqloZ3tDw','$2y$13$0ueuGcpnT2B3YuOI4tXSX.JIBLsP/TStnALtsPErgL4kicOJC0v3O',NULL,'sajiffffffffd@gmail.com',1,1516343873,NULL,1516343873,NULL,NULL,'03008332781','03008332781','islamabad','Karachi','082','thirty to streek khan poor',NULL,'Pakistan',NULL,NULL,0),(575,'jan','jdOuLk2KdW0wj2y5VczTt-9m6E910t-j','$2y$13$ZKZBQK5fcA9IUssogi4obuEg3ilfzvpcxFcWF45tETc2IYa1eJBIG',NULL,'jan@gmail.com',1,1516686918,NULL,1516686918,499,11,'03008332781',NULL,NULL,NULL,NULL,'thirty to streek khan poor, bareek road london','islamabad','Thailand ','jan','jan',0);
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
INSERT INTO `users_level` VALUES (1,'Super Admin',0,20),(2,'Management Team',1,20),(3,'Management Team Seller',1,-1),(4,'Super Vip Team ',2,100),(5,'Super Vip Team Seller',2,-1),(6,'VIP Team',4,1000),(8,'VIP Team Sellers',4,-1),(10,'PRO Level',6,-1),(11,'INTER Level',6,-1),(12,'ADVANCE Level',6,-1),(13,'BEGIN Level',6,-1);
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

-- Dump completed on 2018-01-23 11:08:18
