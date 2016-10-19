-- MySQL dump 10.13  Distrib 5.6.32, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: dbColumbarium
-- ------------------------------------------------------
-- Server version	5.6.32-1+deb.sury.org~trusty+0.1

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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_000001_create_table_cheque',1),('2014_10_12_100000_create_password_resets_table',1),('2016_05_07_025809_create_additional',1),('2016_05_11_023255_create_service',1),('2016_05_13_160849_create_package',1),('2016_05_14_074638_create_building',1),('2016_05_14_112309_create_floor',1),('2016_05_15_005319_create_block',1),('2016_05_16_092513_create_interest',1),('2016_06_13_130607_create_table_customer_v1',1),('2016_06_14_052635_create_table_reservation',1),('2016_06_14_053202_create_table_reservation_details',1),('2016_06_18_141158_create_table_room',1),('2016_06_18_141709_alter_table_block_v1',1),('2016_06_18_142514_alter_table_unit_category_v1',1),('2016_06_19_150606_drop_table_floor_detail',1),('2016_06_19_150759_create_table_room_type',1),('2016_06_19_151050_create_table_room_detail',1),('2016_06_23_124250_create_table_downpayment',1),('2016_06_23_125955_create_table_position',1),('2016_06_23_130156_alter_table_users_v1',1),('2016_06_25_050517_alter_table_reservation_details_v1',1),('2016_06_25_072548_create_table_buy_unit',1),('2016_06_25_072945_create_table_buy_unit_detail',1),('2016_06_25_073817_alter_table_unit_v1',1),('2016_06_26_221222_create_table_transaction_purchase',1),('2016_06_26_221223_create_table_transaction_purchase_detail',1),('2016_06_26_221224_create_table_collection',1),('2016_06_26_221956_create_table_collection_detail',1),('2016_07_01_130804_alter_table_room_v1',1),('2016_07_01_131109_alter_table_block_v2',1),('2016_07_01_131323_create_table_service_type',1),('2016_07_01_131701_alter_table_service_v1',1),('2016_07_03_222958_alter_table_block_v3',1),('2016_07_03_223513_alter_table_unit_category_v2',1),('2016_07_06_210558_alter_table_package_additionals_v1',1),('2016_07_06_210855_alter_table_package_services_v1',1),('2016_07_07_134724_create_table_business_dependency',1),('2016_07_10_230239_create_table_at_need',1),('2016_07_10_231453_create_table_at_need_detail',1),('2016_07_14_100057_create_table_unit_service',1),('2016_07_15_103222_create_table_relationship',1),('2016_07_15_103407_create_table_deceased',1),('2016_07_15_104257_create_table_storage_type',1),('2016_07_15_105219_create_table_unit_type_storage',1),('2016_07_15_180625_create_table_unit_deceased',1),('2016_07_15_180626_create_table_transaction_deceased',1),('2016_07_16_213851_create_table_transaction_deceased_detail',1),('2016_07_20_101848_create_table_transaction_ownership',1),('2016_07_21_114823_create_table_schedule_time',1),('2016_07_21_115118_create_table_schedule_log',1),('2016_07_21_115119_create_table_schedule_service',1),('2016_07_21_115453_create_table_schedule_day',1),('2016_07_21_120445_create_table_schedule_detail',1),('2016_07_21_192305_create_table_schedule_detail_log',1),('2016_07_22_123837_create_table_downpayment_payment',1),('2016_08_24_190838_create_table_transaction_unit',1),('2016_08_24_190857_create_table_transaction_unit_detail',1),('2016_08_25_114345_create_table_collection_payment_detail',1),('2016_09_08_145355_create_table_discount',1),('2016_09_08_150135_create_table_discount_rate',1),('2016_09_08_171810_create_table_assign_discount',1),('2016_09_18_111904_create_table_transaction_unit_discount',1),('2016_09_18_140349_create_table_downpayment_discount',1),('2016_09_21_115521_create_table_notification',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblAdditional`
--

DROP TABLE IF EXISTS `tblAdditional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblAdditional` (
  `intAdditionalId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strAdditionalName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `strAdditionalDesc` text COLLATE utf8_unicode_ci,
  `intAdditionalCategoryIdFK` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intAdditionalId`),
  UNIQUE KEY `tbladditional_stradditionalname_unique` (`strAdditionalName`),
  KEY `tbladditional_intadditionalcategoryidfk_foreign` (`intAdditionalCategoryIdFK`),
  CONSTRAINT `tbladditional_intadditionalcategoryidfk_foreign` FOREIGN KEY (`intAdditionalCategoryIdFK`) REFERENCES `tblAdditionalCategory` (`intAdditionalCategoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblAdditional`
--

LOCK TABLES `tblAdditional` WRITE;
/*!40000 ALTER TABLE `tblAdditional` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblAdditional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblAdditionalCategory`
--

DROP TABLE IF EXISTS `tblAdditionalCategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblAdditionalCategory` (
  `intAdditionalCategoryId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strAdditionalCategoryName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intAdditionalCategoryId`),
  UNIQUE KEY `tbladditionalcategory_stradditionalcategoryname_unique` (`strAdditionalCategoryName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblAdditionalCategory`
--

LOCK TABLES `tblAdditionalCategory` WRITE;
/*!40000 ALTER TABLE `tblAdditionalCategory` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblAdditionalCategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblAdditionalPrice`
--

DROP TABLE IF EXISTS `tblAdditionalPrice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblAdditionalPrice` (
  `intAdditionalPriceId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intAdditionalIdFK` int(10) unsigned NOT NULL,
  `deciPrice` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intAdditionalPriceId`),
  KEY `tbladditionalprice_intadditionalidfk_foreign` (`intAdditionalIdFK`),
  CONSTRAINT `tbladditionalprice_intadditionalidfk_foreign` FOREIGN KEY (`intAdditionalIdFK`) REFERENCES `tblAdditional` (`intAdditionalId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblAdditionalPrice`
--

LOCK TABLES `tblAdditionalPrice` WRITE;
/*!40000 ALTER TABLE `tblAdditionalPrice` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblAdditionalPrice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblAssignDiscount`
--

DROP TABLE IF EXISTS `tblAssignDiscount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblAssignDiscount` (
  `intAssignDiscountId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intServiceIdFK` int(10) unsigned DEFAULT NULL,
  `intTransactionId` int(11) DEFAULT NULL,
  `intDiscountIdFK` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intAssignDiscountId`),
  UNIQUE KEY `tblassigndiscount_intserviceidfk_intdiscountidfk_unique` (`intServiceIdFK`,`intDiscountIdFK`),
  UNIQUE KEY `tblassigndiscount_inttransactionid_intdiscountidfk_unique` (`intTransactionId`,`intDiscountIdFK`),
  KEY `tblassigndiscount_intdiscountidfk_foreign` (`intDiscountIdFK`),
  CONSTRAINT `tblassigndiscount_intdiscountidfk_foreign` FOREIGN KEY (`intDiscountIdFK`) REFERENCES `tblDiscount` (`intDiscountId`),
  CONSTRAINT `tblassigndiscount_intserviceidfk_foreign` FOREIGN KEY (`intServiceIdFK`) REFERENCES `tblService` (`intServiceId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblAssignDiscount`
--

LOCK TABLES `tblAssignDiscount` WRITE;
/*!40000 ALTER TABLE `tblAssignDiscount` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblAssignDiscount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblAtNeed`
--

DROP TABLE IF EXISTS `tblAtNeed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblAtNeed` (
  `intAtNeedId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intCustomerIdFK` int(10) unsigned NOT NULL,
  `intPaymentType` int(11) NOT NULL,
  `deciAmountPaid` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intAtNeedId`),
  KEY `tblatneed_intcustomeridfk_foreign` (`intCustomerIdFK`),
  CONSTRAINT `tblatneed_intcustomeridfk_foreign` FOREIGN KEY (`intCustomerIdFK`) REFERENCES `tblCustomer` (`intCustomerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblAtNeed`
--

LOCK TABLES `tblAtNeed` WRITE;
/*!40000 ALTER TABLE `tblAtNeed` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblAtNeed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblAtNeedDetail`
--

DROP TABLE IF EXISTS `tblAtNeedDetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblAtNeedDetail` (
  `intAtNeedDetailId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intAtNeedIdFK` int(10) unsigned NOT NULL,
  `intInterestIdFK` int(10) unsigned NOT NULL,
  `intUnitIdFK` int(10) unsigned NOT NULL,
  `intUnitCategoryPriceIdFK` int(10) unsigned NOT NULL,
  `intInterestRateIdFK` int(10) unsigned NOT NULL,
  `boolDownpayment` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intAtNeedDetailId`),
  KEY `tblatneeddetail_intatneedidfk_foreign` (`intAtNeedIdFK`),
  KEY `tblatneeddetail_intinterestidfk_foreign` (`intInterestIdFK`),
  KEY `tblatneeddetail_intunitidfk_foreign` (`intUnitIdFK`),
  KEY `tblatneeddetail_intunitcategorypriceidfk_foreign` (`intUnitCategoryPriceIdFK`),
  KEY `tblatneeddetail_intinterestrateidfk_foreign` (`intInterestRateIdFK`),
  CONSTRAINT `tblatneeddetail_intatneedidfk_foreign` FOREIGN KEY (`intAtNeedIdFK`) REFERENCES `tblAtNeed` (`intAtNeedId`),
  CONSTRAINT `tblatneeddetail_intinterestidfk_foreign` FOREIGN KEY (`intInterestIdFK`) REFERENCES `tblInterest` (`intInterestId`),
  CONSTRAINT `tblatneeddetail_intinterestrateidfk_foreign` FOREIGN KEY (`intInterestRateIdFK`) REFERENCES `tblInterestRate` (`intInterestRateId`),
  CONSTRAINT `tblatneeddetail_intunitcategorypriceidfk_foreign` FOREIGN KEY (`intUnitCategoryPriceIdFK`) REFERENCES `tblUnitCategoryPrice` (`intUnitCategoryPriceId`),
  CONSTRAINT `tblatneeddetail_intunitidfk_foreign` FOREIGN KEY (`intUnitIdFK`) REFERENCES `tblUnit` (`intUnitId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblAtNeedDetail`
--

LOCK TABLES `tblAtNeedDetail` WRITE;
/*!40000 ALTER TABLE `tblAtNeedDetail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblAtNeedDetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblBlock`
--

DROP TABLE IF EXISTS `tblBlock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblBlock` (
  `intBlockId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `intRoomIdFK` int(10) unsigned NOT NULL,
  `intBlockNo` int(11) NOT NULL,
  `intUnitTypeIdFK` int(10) unsigned NOT NULL,
  PRIMARY KEY (`intBlockId`),
  UNIQUE KEY `tblblock_introomidfk_intblockno_unique` (`intRoomIdFK`,`intBlockNo`),
  KEY `tblblock_intunittypeidfk_foreign` (`intUnitTypeIdFK`),
  CONSTRAINT `tblblock_introomidfk_foreign` FOREIGN KEY (`intRoomIdFK`) REFERENCES `tblRoom` (`intRoomId`),
  CONSTRAINT `tblblock_intunittypeidfk_foreign` FOREIGN KEY (`intUnitTypeIdFK`) REFERENCES `tblRoomType` (`intRoomTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblBlock`
--

LOCK TABLES `tblBlock` WRITE;
/*!40000 ALTER TABLE `tblBlock` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblBlock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblBuilding`
--

DROP TABLE IF EXISTS `tblBuilding`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblBuilding` (
  `intBuildingId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strBuildingName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `strBuildingLocation` text COLLATE utf8_unicode_ci NOT NULL,
  `strBuildingCode` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intBuildingId`),
  UNIQUE KEY `tblbuilding_strbuildingname_unique` (`strBuildingName`),
  UNIQUE KEY `tblbuilding_strbuildingcode_unique` (`strBuildingCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblBuilding`
--

LOCK TABLES `tblBuilding` WRITE;
/*!40000 ALTER TABLE `tblBuilding` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblBuilding` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblBusinessDependency`
--

DROP TABLE IF EXISTS `tblBusinessDependency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblBusinessDependency` (
  `intBusinessDependencyId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strBusinessDependencyName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deciBusinessDependencyValue` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intBusinessDependencyId`),
  UNIQUE KEY `tblbusinessdependency_strbusinessdependencyname_unique` (`strBusinessDependencyName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblBusinessDependency`
--

LOCK TABLES `tblBusinessDependency` WRITE;
/*!40000 ALTER TABLE `tblBusinessDependency` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblBusinessDependency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblBuyUnit`
--

DROP TABLE IF EXISTS `tblBuyUnit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblBuyUnit` (
  `intBuyUnitId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intCustomerIdFK` int(10) unsigned NOT NULL,
  `intPaymentType` int(11) NOT NULL,
  `deciAmountPaid` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intBuyUnitId`),
  KEY `tblbuyunit_intcustomeridfk_foreign` (`intCustomerIdFK`),
  CONSTRAINT `tblbuyunit_intcustomeridfk_foreign` FOREIGN KEY (`intCustomerIdFK`) REFERENCES `tblCustomer` (`intCustomerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblBuyUnit`
--

LOCK TABLES `tblBuyUnit` WRITE;
/*!40000 ALTER TABLE `tblBuyUnit` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblBuyUnit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblBuyUnitDetail`
--

DROP TABLE IF EXISTS `tblBuyUnitDetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblBuyUnitDetail` (
  `intBuyUnitDetail` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intBuyUnitIdFK` int(10) unsigned NOT NULL,
  `intUnitIdFK` int(10) unsigned NOT NULL,
  `intUnitCategoryPriceIdFK` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intBuyUnitDetail`),
  KEY `tblbuyunitdetail_intbuyunitidfk_foreign` (`intBuyUnitIdFK`),
  KEY `tblbuyunitdetail_intunitidfk_foreign` (`intUnitIdFK`),
  KEY `tblbuyunitdetail_intunitcategorypriceidfk_foreign` (`intUnitCategoryPriceIdFK`),
  CONSTRAINT `tblbuyunitdetail_intbuyunitidfk_foreign` FOREIGN KEY (`intBuyUnitIdFK`) REFERENCES `tblBuyUnit` (`intBuyUnitId`),
  CONSTRAINT `tblbuyunitdetail_intunitcategorypriceidfk_foreign` FOREIGN KEY (`intUnitCategoryPriceIdFK`) REFERENCES `tblUnitCategoryPrice` (`intUnitCategoryPriceId`),
  CONSTRAINT `tblbuyunitdetail_intunitidfk_foreign` FOREIGN KEY (`intUnitIdFK`) REFERENCES `tblUnit` (`intUnitId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblBuyUnitDetail`
--

LOCK TABLES `tblBuyUnitDetail` WRITE;
/*!40000 ALTER TABLE `tblBuyUnitDetail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblBuyUnitDetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblCheque`
--

DROP TABLE IF EXISTS `tblCheque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblCheque` (
  `intChequeId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strBankName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `strReceiver` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `strChequeNo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateCheque` date NOT NULL,
  `strAccountHolderName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `strAccountNo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`intChequeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblCheque`
--

LOCK TABLES `tblCheque` WRITE;
/*!40000 ALTER TABLE `tblCheque` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblCheque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblCollection`
--

DROP TABLE IF EXISTS `tblCollection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblCollection` (
  `intCollectionId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intCustomerIdFK` int(10) unsigned NOT NULL,
  `intUnitIdFK` int(10) unsigned DEFAULT NULL,
  `intUnitCategoryPriceIdFK` int(10) unsigned DEFAULT NULL,
  `intInterestRateIdFK` int(10) unsigned DEFAULT NULL,
  `intServicePriceIdFK` int(10) unsigned DEFAULT NULL,
  `intPackagePriceIdFK` int(10) unsigned DEFAULT NULL,
  `intTPurchaseDetailIdFK` int(10) unsigned DEFAULT NULL,
  `dateCollectionStart` date NOT NULL,
  `boolFinish` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intCollectionId`),
  KEY `tblcollection_intcustomeridfk_foreign` (`intCustomerIdFK`),
  KEY `tblcollection_intunitidfk_foreign` (`intUnitIdFK`),
  KEY `tblcollection_intunitcategorypriceidfk_foreign` (`intUnitCategoryPriceIdFK`),
  KEY `tblcollection_intinterestrateidfk_foreign` (`intInterestRateIdFK`),
  KEY `tblcollection_intservicepriceidfk_foreign` (`intServicePriceIdFK`),
  KEY `tblcollection_intpackagepriceidfk_foreign` (`intPackagePriceIdFK`),
  KEY `tblcollection_inttpurchasedetailidfk_foreign` (`intTPurchaseDetailIdFK`),
  CONSTRAINT `tblcollection_intcustomeridfk_foreign` FOREIGN KEY (`intCustomerIdFK`) REFERENCES `tblCustomer` (`intCustomerId`),
  CONSTRAINT `tblcollection_intinterestrateidfk_foreign` FOREIGN KEY (`intInterestRateIdFK`) REFERENCES `tblInterestRate` (`intInterestRateId`),
  CONSTRAINT `tblcollection_intpackagepriceidfk_foreign` FOREIGN KEY (`intPackagePriceIdFK`) REFERENCES `tblPackagePrice` (`intPackagePriceId`),
  CONSTRAINT `tblcollection_intservicepriceidfk_foreign` FOREIGN KEY (`intServicePriceIdFK`) REFERENCES `tblServicePrice` (`intServicePriceId`),
  CONSTRAINT `tblcollection_inttpurchasedetailidfk_foreign` FOREIGN KEY (`intTPurchaseDetailIdFK`) REFERENCES `tblTPurchaseDetail` (`intTPurchaseDetailId`),
  CONSTRAINT `tblcollection_intunitcategorypriceidfk_foreign` FOREIGN KEY (`intUnitCategoryPriceIdFK`) REFERENCES `tblUnitCategoryPrice` (`intUnitCategoryPriceId`),
  CONSTRAINT `tblcollection_intunitidfk_foreign` FOREIGN KEY (`intUnitIdFK`) REFERENCES `tblUnit` (`intUnitId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblCollection`
--

LOCK TABLES `tblCollection` WRITE;
/*!40000 ALTER TABLE `tblCollection` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblCollection` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblCollectionPayment`
--

DROP TABLE IF EXISTS `tblCollectionPayment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblCollectionPayment` (
  `intCollectionPaymentId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intCollectionIdFK` int(10) unsigned NOT NULL,
  `intPaymentType` int(11) NOT NULL,
  `deciAmountPaid` decimal(8,2) NOT NULL,
  `intChequeIdFK` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intCollectionPaymentId`),
  KEY `tblcollectionpayment_intcollectionidfk_foreign` (`intCollectionIdFK`),
  KEY `tblcollectionpayment_intchequeidfk_foreign` (`intChequeIdFK`),
  CONSTRAINT `tblcollectionpayment_intchequeidfk_foreign` FOREIGN KEY (`intChequeIdFK`) REFERENCES `tblCheque` (`intChequeId`),
  CONSTRAINT `tblcollectionpayment_intcollectionidfk_foreign` FOREIGN KEY (`intCollectionIdFK`) REFERENCES `tblCollection` (`intCollectionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblCollectionPayment`
--

LOCK TABLES `tblCollectionPayment` WRITE;
/*!40000 ALTER TABLE `tblCollectionPayment` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblCollectionPayment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblCollectionPaymentDetail`
--

DROP TABLE IF EXISTS `tblCollectionPaymentDetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblCollectionPaymentDetail` (
  `intCollectionPaymentDetailId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intCollectionPaymentIdFK` int(10) unsigned NOT NULL,
  `dateDue` date NOT NULL,
  PRIMARY KEY (`intCollectionPaymentDetailId`),
  KEY `tblcollectionpaymentdetail_intcollectionpaymentidfk_foreign` (`intCollectionPaymentIdFK`),
  CONSTRAINT `tblcollectionpaymentdetail_intcollectionpaymentidfk_foreign` FOREIGN KEY (`intCollectionPaymentIdFK`) REFERENCES `tblCollectionPayment` (`intCollectionPaymentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblCollectionPaymentDetail`
--

LOCK TABLES `tblCollectionPaymentDetail` WRITE;
/*!40000 ALTER TABLE `tblCollectionPaymentDetail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblCollectionPaymentDetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblCustomer`
--

DROP TABLE IF EXISTS `tblCustomer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblCustomer` (
  `intCustomerId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strFirstName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `strMiddleName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `strLastName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `strAddress` text COLLATE utf8_unicode_ci NOT NULL,
  `strContactNo` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `dateBirthday` date NOT NULL,
  `intGender` int(11) NOT NULL,
  `intCivilStatus` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intCustomerId`),
  UNIQUE KEY `tblcustomer_strfirstname_strmiddlename_strlastname_unique` (`strFirstName`,`strMiddleName`,`strLastName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblCustomer`
--

LOCK TABLES `tblCustomer` WRITE;
/*!40000 ALTER TABLE `tblCustomer` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblCustomer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblDeceased`
--

DROP TABLE IF EXISTS `tblDeceased`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblDeceased` (
  `intDeceasedId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strFirstName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `strMiddleName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `strLastName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dateDeath` date NOT NULL,
  `dateBirth` date NOT NULL,
  `intGender` int(11) NOT NULL,
  `dateInterment` date DEFAULT NULL,
  `timeInterment` time DEFAULT NULL,
  `intRelationshipIdFK` int(10) unsigned NOT NULL,
  `intCustomerIdFK` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intDeceasedId`),
  UNIQUE KEY `uqName` (`strFirstName`,`strMiddleName`,`strLastName`),
  KEY `tbldeceased_intrelationshipidfk_foreign` (`intRelationshipIdFK`),
  KEY `tbldeceased_intcustomeridfk_foreign` (`intCustomerIdFK`),
  CONSTRAINT `tbldeceased_intcustomeridfk_foreign` FOREIGN KEY (`intCustomerIdFK`) REFERENCES `tblCustomer` (`intCustomerId`),
  CONSTRAINT `tbldeceased_intrelationshipidfk_foreign` FOREIGN KEY (`intRelationshipIdFK`) REFERENCES `tblRelationship` (`intRelationshipId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblDeceased`
--

LOCK TABLES `tblDeceased` WRITE;
/*!40000 ALTER TABLE `tblDeceased` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblDeceased` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblDiscount`
--

DROP TABLE IF EXISTS `tblDiscount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblDiscount` (
  `intDiscountId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strDiscountName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intDiscountId`),
  UNIQUE KEY `tbldiscount_strdiscountname_unique` (`strDiscountName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblDiscount`
--

LOCK TABLES `tblDiscount` WRITE;
/*!40000 ALTER TABLE `tblDiscount` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblDiscount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblDiscountRate`
--

DROP TABLE IF EXISTS `tblDiscountRate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblDiscountRate` (
  `intDiscountRateId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intDiscountIdFK` int(10) unsigned NOT NULL,
  `intDiscountType` int(11) NOT NULL,
  `deciDiscountRate` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intDiscountRateId`),
  KEY `tbldiscountrate_intdiscountidfk_foreign` (`intDiscountIdFK`),
  CONSTRAINT `tbldiscountrate_intdiscountidfk_foreign` FOREIGN KEY (`intDiscountIdFK`) REFERENCES `tblDiscount` (`intDiscountId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblDiscountRate`
--

LOCK TABLES `tblDiscountRate` WRITE;
/*!40000 ALTER TABLE `tblDiscountRate` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblDiscountRate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblDownpayment`
--

DROP TABLE IF EXISTS `tblDownpayment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblDownpayment` (
  `intDownpaymentId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intCustomerIdFK` int(10) unsigned NOT NULL,
  `intUnitIdFK` int(10) unsigned NOT NULL,
  `intUnitCategoryPriceIdFK` int(10) unsigned NOT NULL,
  `boolPaid` tinyint(1) NOT NULL DEFAULT '0',
  `boolSwitch` tinyint(1) NOT NULL DEFAULT '0',
  `intInterestRateIdFK` int(10) unsigned NOT NULL,
  `boolNoPaymentWarning` tinyint(1) NOT NULL,
  `boolNotFullWarning` tinyint(1) NOT NULL,
  `dateDueDate` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intDownpaymentId`),
  KEY `tbldownpayment_intcustomeridfk_foreign` (`intCustomerIdFK`),
  KEY `tbldownpayment_intunitidfk_foreign` (`intUnitIdFK`),
  KEY `tbldownpayment_intunitcategorypriceidfk_foreign` (`intUnitCategoryPriceIdFK`),
  KEY `tbldownpayment_intinterestrateidfk_foreign` (`intInterestRateIdFK`),
  CONSTRAINT `tbldownpayment_intcustomeridfk_foreign` FOREIGN KEY (`intCustomerIdFK`) REFERENCES `tblCustomer` (`intCustomerId`),
  CONSTRAINT `tbldownpayment_intinterestrateidfk_foreign` FOREIGN KEY (`intInterestRateIdFK`) REFERENCES `tblInterestRate` (`intInterestRateId`),
  CONSTRAINT `tbldownpayment_intunitcategorypriceidfk_foreign` FOREIGN KEY (`intUnitCategoryPriceIdFK`) REFERENCES `tblUnitCategoryPrice` (`intUnitCategoryPriceId`),
  CONSTRAINT `tbldownpayment_intunitidfk_foreign` FOREIGN KEY (`intUnitIdFK`) REFERENCES `tblUnit` (`intUnitId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblDownpayment`
--

LOCK TABLES `tblDownpayment` WRITE;
/*!40000 ALTER TABLE `tblDownpayment` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblDownpayment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblDownpaymentDiscount`
--

DROP TABLE IF EXISTS `tblDownpaymentDiscount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblDownpaymentDiscount` (
  `intDownpaymentDiscountId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intDownpaymentIdFK` int(10) unsigned NOT NULL,
  `intDiscountRateIdFK` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intDownpaymentDiscountId`),
  KEY `tbldownpaymentdiscount_intdownpaymentidfk_foreign` (`intDownpaymentIdFK`),
  KEY `tbldownpaymentdiscount_intdiscountrateidfk_foreign` (`intDiscountRateIdFK`),
  CONSTRAINT `tbldownpaymentdiscount_intdiscountrateidfk_foreign` FOREIGN KEY (`intDiscountRateIdFK`) REFERENCES `tblDiscountRate` (`intDiscountRateId`),
  CONSTRAINT `tbldownpaymentdiscount_intdownpaymentidfk_foreign` FOREIGN KEY (`intDownpaymentIdFK`) REFERENCES `tblDownpayment` (`intDownpaymentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblDownpaymentDiscount`
--

LOCK TABLES `tblDownpaymentDiscount` WRITE;
/*!40000 ALTER TABLE `tblDownpaymentDiscount` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblDownpaymentDiscount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblDownpaymentPayment`
--

DROP TABLE IF EXISTS `tblDownpaymentPayment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblDownpaymentPayment` (
  `intDownpaymentPaymentId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intDownpaymentIdFK` int(10) unsigned NOT NULL,
  `deciAmountPaid` decimal(8,2) NOT NULL,
  `intPaymentType` int(11) NOT NULL,
  `intChequeIdFK` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intDownpaymentPaymentId`),
  KEY `tbldownpaymentpayment_intdownpaymentidfk_foreign` (`intDownpaymentIdFK`),
  KEY `tbldownpaymentpayment_intchequeidfk_foreign` (`intChequeIdFK`),
  CONSTRAINT `tbldownpaymentpayment_intchequeidfk_foreign` FOREIGN KEY (`intChequeIdFK`) REFERENCES `tblCheque` (`intChequeId`),
  CONSTRAINT `tbldownpaymentpayment_intdownpaymentidfk_foreign` FOREIGN KEY (`intDownpaymentIdFK`) REFERENCES `tblDownpayment` (`intDownpaymentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblDownpaymentPayment`
--

LOCK TABLES `tblDownpaymentPayment` WRITE;
/*!40000 ALTER TABLE `tblDownpaymentPayment` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblDownpaymentPayment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblFloor`
--

DROP TABLE IF EXISTS `tblFloor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblFloor` (
  `intFloorId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intFloorNo` int(11) NOT NULL,
  `intBuildingIdFK` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intFloorId`),
  KEY `tblfloor_intbuildingidfk_foreign` (`intBuildingIdFK`),
  CONSTRAINT `tblfloor_intbuildingidfk_foreign` FOREIGN KEY (`intBuildingIdFK`) REFERENCES `tblBuilding` (`intBuildingId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblFloor`
--

LOCK TABLES `tblFloor` WRITE;
/*!40000 ALTER TABLE `tblFloor` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblFloor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblFloorType`
--

DROP TABLE IF EXISTS `tblFloorType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblFloorType` (
  `intFloorTypeId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strFloorTypeName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `boolUnit` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intFloorTypeId`),
  UNIQUE KEY `tblfloortype_strfloortypename_unique` (`strFloorTypeName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblFloorType`
--

LOCK TABLES `tblFloorType` WRITE;
/*!40000 ALTER TABLE `tblFloorType` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblFloorType` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblInterest`
--

DROP TABLE IF EXISTS `tblInterest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblInterest` (
  `intInterestId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intNoOfYear` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intInterestId`),
  UNIQUE KEY `tblinterest_intnoofyear_unique` (`intNoOfYear`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblInterest`
--

LOCK TABLES `tblInterest` WRITE;
/*!40000 ALTER TABLE `tblInterest` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblInterest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblInterestRate`
--

DROP TABLE IF EXISTS `tblInterestRate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblInterestRate` (
  `intInterestRateId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intAtNeed` int(11) NOT NULL,
  `intInterestIdFK` int(10) unsigned NOT NULL,
  `deciInterestRate` decimal(5,4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intInterestRateId`),
  KEY `tblinterestrate_intinterestidfk_foreign` (`intInterestIdFK`),
  CONSTRAINT `tblinterestrate_intinterestidfk_foreign` FOREIGN KEY (`intInterestIdFK`) REFERENCES `tblInterest` (`intInterestId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblInterestRate`
--

LOCK TABLES `tblInterestRate` WRITE;
/*!40000 ALTER TABLE `tblInterestRate` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblInterestRate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblNotification`
--

DROP TABLE IF EXISTS `tblNotification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblNotification` (
  `intNotificationId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intNotificationType` int(11) NOT NULL,
  `intCollectionIdFK` int(10) unsigned DEFAULT NULL,
  `intDownpaymentIdFK` int(10) unsigned DEFAULT NULL,
  `intScheduleDetailIdFK` int(10) unsigned DEFAULT NULL,
  `boolRead` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intNotificationId`),
  KEY `tblnotification_intcollectionidfk_foreign` (`intCollectionIdFK`),
  KEY `tblnotification_intdownpaymentidfk_foreign` (`intDownpaymentIdFK`),
  KEY `tblnotification_intscheduledetailidfk_foreign` (`intScheduleDetailIdFK`),
  CONSTRAINT `tblnotification_intcollectionidfk_foreign` FOREIGN KEY (`intCollectionIdFK`) REFERENCES `tblCollection` (`intCollectionId`),
  CONSTRAINT `tblnotification_intdownpaymentidfk_foreign` FOREIGN KEY (`intDownpaymentIdFK`) REFERENCES `tblDownpayment` (`intDownpaymentId`),
  CONSTRAINT `tblnotification_intscheduledetailidfk_foreign` FOREIGN KEY (`intScheduleDetailIdFK`) REFERENCES `tblScheduleDetail` (`intScheduleDetailId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblNotification`
--

LOCK TABLES `tblNotification` WRITE;
/*!40000 ALTER TABLE `tblNotification` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblNotification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblPackage`
--

DROP TABLE IF EXISTS `tblPackage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblPackage` (
  `intPackageId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strPackageName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `strPackageDesc` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intPackageId`),
  UNIQUE KEY `tblpackage_strpackagename_unique` (`strPackageName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblPackage`
--

LOCK TABLES `tblPackage` WRITE;
/*!40000 ALTER TABLE `tblPackage` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblPackage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblPackageAdditional`
--

DROP TABLE IF EXISTS `tblPackageAdditional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblPackageAdditional` (
  `intPackageAdditionalId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intPackageIdFK` int(10) unsigned NOT NULL,
  `intAdditionalIdFK` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `intQuantity` int(11) NOT NULL,
  PRIMARY KEY (`intPackageAdditionalId`),
  KEY `tblpackageadditional_intpackageidfk_foreign` (`intPackageIdFK`),
  KEY `tblpackageadditional_intadditionalidfk_foreign` (`intAdditionalIdFK`),
  CONSTRAINT `tblpackageadditional_intadditionalidfk_foreign` FOREIGN KEY (`intAdditionalIdFK`) REFERENCES `tblAdditional` (`intAdditionalId`),
  CONSTRAINT `tblpackageadditional_intpackageidfk_foreign` FOREIGN KEY (`intPackageIdFK`) REFERENCES `tblPackage` (`intPackageId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblPackageAdditional`
--

LOCK TABLES `tblPackageAdditional` WRITE;
/*!40000 ALTER TABLE `tblPackageAdditional` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblPackageAdditional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblPackagePrice`
--

DROP TABLE IF EXISTS `tblPackagePrice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblPackagePrice` (
  `intPackagePriceId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intPackageIdFK` int(10) unsigned NOT NULL,
  `deciPrice` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intPackagePriceId`),
  KEY `tblpackageprice_intpackageidfk_foreign` (`intPackageIdFK`),
  CONSTRAINT `tblpackageprice_intpackageidfk_foreign` FOREIGN KEY (`intPackageIdFK`) REFERENCES `tblPackage` (`intPackageId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblPackagePrice`
--

LOCK TABLES `tblPackagePrice` WRITE;
/*!40000 ALTER TABLE `tblPackagePrice` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblPackagePrice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblPackageService`
--

DROP TABLE IF EXISTS `tblPackageService`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblPackageService` (
  `intPackageServiceId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intPackageIdFK` int(10) unsigned NOT NULL,
  `intServiceIdFK` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `intQuantity` int(11) NOT NULL,
  PRIMARY KEY (`intPackageServiceId`),
  KEY `tblpackageservice_intpackageidfk_foreign` (`intPackageIdFK`),
  KEY `tblpackageservice_intserviceidfk_foreign` (`intServiceIdFK`),
  CONSTRAINT `tblpackageservice_intpackageidfk_foreign` FOREIGN KEY (`intPackageIdFK`) REFERENCES `tblPackage` (`intPackageId`),
  CONSTRAINT `tblpackageservice_intserviceidfk_foreign` FOREIGN KEY (`intServiceIdFK`) REFERENCES `tblService` (`intServiceId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblPackageService`
--

LOCK TABLES `tblPackageService` WRITE;
/*!40000 ALTER TABLE `tblPackageService` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblPackageService` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblPosition`
--

DROP TABLE IF EXISTS `tblPosition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblPosition` (
  `intPositionId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strPositionName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `intUserAuth` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intPositionId`),
  UNIQUE KEY `tblposition_strpositionname_unique` (`strPositionName`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblPosition`
--

LOCK TABLES `tblPosition` WRITE;
/*!40000 ALTER TABLE `tblPosition` DISABLE KEYS */;
INSERT INTO `tblPosition` VALUES (1,'Admin',1,'2016-10-17 05:35:07','2016-10-17 05:35:07');
/*!40000 ALTER TABLE `tblPosition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblRelationship`
--

DROP TABLE IF EXISTS `tblRelationship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblRelationship` (
  `intRelationshipId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strRelationshipName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intRelationshipId`),
  UNIQUE KEY `tblrelationship_strrelationshipname_unique` (`strRelationshipName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblRelationship`
--

LOCK TABLES `tblRelationship` WRITE;
/*!40000 ALTER TABLE `tblRelationship` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblRelationship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblRequirement`
--

DROP TABLE IF EXISTS `tblRequirement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblRequirement` (
  `intRequirementId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strRequirementName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `strRequirementDesc` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intRequirementId`),
  UNIQUE KEY `tblrequirement_strrequirementname_unique` (`strRequirementName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblRequirement`
--

LOCK TABLES `tblRequirement` WRITE;
/*!40000 ALTER TABLE `tblRequirement` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblRequirement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblReservation`
--

DROP TABLE IF EXISTS `tblReservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblReservation` (
  `intReservationId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intCustomerIdFK` int(10) unsigned NOT NULL,
  `deciAmountPaid` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intReservationId`),
  KEY `tblreservation_intcustomeridfk_foreign` (`intCustomerIdFK`),
  CONSTRAINT `tblreservation_intcustomeridfk_foreign` FOREIGN KEY (`intCustomerIdFK`) REFERENCES `tblCustomer` (`intCustomerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblReservation`
--

LOCK TABLES `tblReservation` WRITE;
/*!40000 ALTER TABLE `tblReservation` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblReservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblReservationDetail`
--

DROP TABLE IF EXISTS `tblReservationDetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblReservationDetail` (
  `intReservationDetailId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intReservationIdFK` int(10) unsigned NOT NULL,
  `intUnitIdFK` int(10) unsigned NOT NULL,
  `intInterestIdFK` int(10) unsigned NOT NULL,
  `intUnitCategoryPriceIdFK` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `intInterestRateIdFK` int(10) unsigned NOT NULL,
  PRIMARY KEY (`intReservationDetailId`),
  KEY `tblreservationdetail_intreservationidfk_foreign` (`intReservationIdFK`),
  KEY `tblreservationdetail_intunitidfk_foreign` (`intUnitIdFK`),
  KEY `tblreservationdetail_intinterestidfk_foreign` (`intInterestIdFK`),
  KEY `tblreservationdetail_intunitcategorypriceidfk_foreign` (`intUnitCategoryPriceIdFK`),
  KEY `tblreservationdetail_intinterestrateidfk_foreign` (`intInterestRateIdFK`),
  CONSTRAINT `tblreservationdetail_intinterestidfk_foreign` FOREIGN KEY (`intInterestIdFK`) REFERENCES `tblInterest` (`intInterestId`),
  CONSTRAINT `tblreservationdetail_intinterestrateidfk_foreign` FOREIGN KEY (`intInterestRateIdFK`) REFERENCES `tblInterestRate` (`intInterestRateId`),
  CONSTRAINT `tblreservationdetail_intreservationidfk_foreign` FOREIGN KEY (`intReservationIdFK`) REFERENCES `tblReservation` (`intReservationId`),
  CONSTRAINT `tblreservationdetail_intunitcategorypriceidfk_foreign` FOREIGN KEY (`intUnitCategoryPriceIdFK`) REFERENCES `tblUnitCategoryPrice` (`intUnitCategoryPriceId`),
  CONSTRAINT `tblreservationdetail_intunitidfk_foreign` FOREIGN KEY (`intUnitIdFK`) REFERENCES `tblUnit` (`intUnitId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblReservationDetail`
--

LOCK TABLES `tblReservationDetail` WRITE;
/*!40000 ALTER TABLE `tblReservationDetail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblReservationDetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblRoom`
--

DROP TABLE IF EXISTS `tblRoom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblRoom` (
  `intRoomId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intFloorIdFK` int(10) unsigned NOT NULL,
  `intMaxBlock` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `strRoomName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`intRoomId`),
  UNIQUE KEY `tblroom_strroomname_intflooridfk_unique` (`strRoomName`,`intFloorIdFK`),
  KEY `tblroom_intflooridfk_foreign` (`intFloorIdFK`),
  CONSTRAINT `tblroom_intflooridfk_foreign` FOREIGN KEY (`intFloorIdFK`) REFERENCES `tblFloor` (`intFloorId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblRoom`
--

LOCK TABLES `tblRoom` WRITE;
/*!40000 ALTER TABLE `tblRoom` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblRoom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblRoomDetail`
--

DROP TABLE IF EXISTS `tblRoomDetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblRoomDetail` (
  `intRoomDetailId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intRoomIdFK` int(10) unsigned NOT NULL,
  `intRoomTypeIdFK` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intRoomDetailId`),
  UNIQUE KEY `tblroomdetail_introomidfk_introomtypeidfk_unique` (`intRoomIdFK`,`intRoomTypeIdFK`),
  KEY `tblroomdetail_introomtypeidfk_foreign` (`intRoomTypeIdFK`),
  CONSTRAINT `tblroomdetail_introomidfk_foreign` FOREIGN KEY (`intRoomIdFK`) REFERENCES `tblRoom` (`intRoomId`),
  CONSTRAINT `tblroomdetail_introomtypeidfk_foreign` FOREIGN KEY (`intRoomTypeIdFK`) REFERENCES `tblRoomType` (`intRoomTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblRoomDetail`
--

LOCK TABLES `tblRoomDetail` WRITE;
/*!40000 ALTER TABLE `tblRoomDetail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblRoomDetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblRoomType`
--

DROP TABLE IF EXISTS `tblRoomType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblRoomType` (
  `intRoomTypeId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strRoomTypeName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `boolUnit` tinyint(1) NOT NULL,
  `strUnitTypeName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intRoomTypeId`),
  UNIQUE KEY `tblroomtype_strroomtypename_unique` (`strRoomTypeName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblRoomType`
--

LOCK TABLES `tblRoomType` WRITE;
/*!40000 ALTER TABLE `tblRoomType` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblRoomType` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblSDLog`
--

DROP TABLE IF EXISTS `tblSDLog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblSDLog` (
  `intSDLogId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intSDIdFK` int(10) unsigned NOT NULL,
  `intScheduleStatus` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intSDLogId`),
  KEY `tblsdlog_intsdidfk_foreign` (`intSDIdFK`),
  CONSTRAINT `tblsdlog_intsdidfk_foreign` FOREIGN KEY (`intSDIdFK`) REFERENCES `tblScheduleDetail` (`intScheduleDetailId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblSDLog`
--

LOCK TABLES `tblSDLog` WRITE;
/*!40000 ALTER TABLE `tblSDLog` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblSDLog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblSchedService`
--

DROP TABLE IF EXISTS `tblSchedService`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblSchedService` (
  `intSchedServiceId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intSLogIdFK` int(10) unsigned NOT NULL,
  `intScheduleTimeIdFK` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intSchedServiceId`),
  UNIQUE KEY `tblschedservice_intslogidfk_intscheduletimeidfk_unique` (`intSLogIdFK`,`intScheduleTimeIdFK`),
  KEY `tblschedservice_intscheduletimeidfk_foreign` (`intScheduleTimeIdFK`),
  CONSTRAINT `tblschedservice_intscheduletimeidfk_foreign` FOREIGN KEY (`intScheduleTimeIdFK`) REFERENCES `tblScheduleTime` (`intScheduleTimeId`),
  CONSTRAINT `tblschedservice_intslogidfk_foreign` FOREIGN KEY (`intSLogIdFK`) REFERENCES `tblScheduleLog` (`intScheduleLogId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblSchedService`
--

LOCK TABLES `tblSchedService` WRITE;
/*!40000 ALTER TABLE `tblSchedService` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblSchedService` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblScheduleDay`
--

DROP TABLE IF EXISTS `tblScheduleDay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblScheduleDay` (
  `intScheduleDayId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dateSchedule` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intScheduleDayId`),
  UNIQUE KEY `tblscheduleday_dateschedule_unique` (`dateSchedule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblScheduleDay`
--

LOCK TABLES `tblScheduleDay` WRITE;
/*!40000 ALTER TABLE `tblScheduleDay` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblScheduleDay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblScheduleDetail`
--

DROP TABLE IF EXISTS `tblScheduleDetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblScheduleDetail` (
  `intScheduleDetailId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intSchedServiceIdFK` int(10) unsigned NOT NULL,
  `intScheduleDayIdFK` int(10) unsigned NOT NULL,
  `intTPDetailIdFK` int(10) unsigned DEFAULT NULL,
  `intCollectionIdFK` int(10) unsigned DEFAULT NULL,
  `intDeceasedIdFK` int(10) unsigned DEFAULT NULL,
  `strRemarks` text COLLATE utf8_unicode_ci NOT NULL,
  `intMinuteDelayCaused` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intScheduleDetailId`),
  KEY `tblscheduledetail_intschedserviceidfk_foreign` (`intSchedServiceIdFK`),
  KEY `tblscheduledetail_intscheduledayidfk_foreign` (`intScheduleDayIdFK`),
  KEY `tblscheduledetail_inttpdetailidfk_foreign` (`intTPDetailIdFK`),
  KEY `tblscheduledetail_intdeceasedidfk_foreign` (`intDeceasedIdFK`),
  KEY `tblscheduledetail_intcollectionidfk_foreign` (`intCollectionIdFK`),
  CONSTRAINT `tblscheduledetail_intcollectionidfk_foreign` FOREIGN KEY (`intCollectionIdFK`) REFERENCES `tblCollection` (`intCollectionId`),
  CONSTRAINT `tblscheduledetail_intdeceasedidfk_foreign` FOREIGN KEY (`intDeceasedIdFK`) REFERENCES `tblDeceased` (`intDeceasedId`),
  CONSTRAINT `tblscheduledetail_intschedserviceidfk_foreign` FOREIGN KEY (`intSchedServiceIdFK`) REFERENCES `tblSchedService` (`intSchedServiceId`),
  CONSTRAINT `tblscheduledetail_intscheduledayidfk_foreign` FOREIGN KEY (`intScheduleDayIdFK`) REFERENCES `tblScheduleDay` (`intScheduleDayId`),
  CONSTRAINT `tblscheduledetail_inttpdetailidfk_foreign` FOREIGN KEY (`intTPDetailIdFK`) REFERENCES `tblTPurchaseDetail` (`intTPurchaseDetailId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblScheduleDetail`
--

LOCK TABLES `tblScheduleDetail` WRITE;
/*!40000 ALTER TABLE `tblScheduleDetail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblScheduleDetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblScheduleLog`
--

DROP TABLE IF EXISTS `tblScheduleLog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblScheduleLog` (
  `intScheduleLogId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intScheduleLogNo` int(11) NOT NULL,
  `intServiceCategoryIdFK` int(10) unsigned NOT NULL,
  `intRoomIdFK` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intScheduleLogId`),
  KEY `tblschedulelog_intservicecategoryidfk_foreign` (`intServiceCategoryIdFK`),
  KEY `tblschedulelog_introomidfk_foreign` (`intRoomIdFK`),
  CONSTRAINT `tblschedulelog_introomidfk_foreign` FOREIGN KEY (`intRoomIdFK`) REFERENCES `tblRoom` (`intRoomId`),
  CONSTRAINT `tblschedulelog_intservicecategoryidfk_foreign` FOREIGN KEY (`intServiceCategoryIdFK`) REFERENCES `tblServiceCategory` (`intServiceCategoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblScheduleLog`
--

LOCK TABLES `tblScheduleLog` WRITE;
/*!40000 ALTER TABLE `tblScheduleLog` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblScheduleLog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblScheduleTime`
--

DROP TABLE IF EXISTS `tblScheduleTime`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblScheduleTime` (
  `intScheduleTimeId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `timeStart` time NOT NULL,
  `timeEnd` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intScheduleTimeId`),
  UNIQUE KEY `tblscheduletime_timestart_unique` (`timeStart`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblScheduleTime`
--

LOCK TABLES `tblScheduleTime` WRITE;
/*!40000 ALTER TABLE `tblScheduleTime` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblScheduleTime` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblService`
--

DROP TABLE IF EXISTS `tblService`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblService` (
  `intServiceId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strServiceName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `strServiceDesc` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `intServiceCategoryIdFK` int(10) unsigned NOT NULL,
  PRIMARY KEY (`intServiceId`),
  UNIQUE KEY `tblservice_strservicename_unique` (`strServiceName`),
  KEY `tblservice_intservicecategoryidfk_foreign` (`intServiceCategoryIdFK`),
  CONSTRAINT `tblservice_intservicecategoryidfk_foreign` FOREIGN KEY (`intServiceCategoryIdFK`) REFERENCES `tblServiceCategory` (`intServiceCategoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblService`
--

LOCK TABLES `tblService` WRITE;
/*!40000 ALTER TABLE `tblService` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblService` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblServiceCategory`
--

DROP TABLE IF EXISTS `tblServiceCategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblServiceCategory` (
  `intServiceCategoryId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strServiceCategoryName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `intServiceType` int(11) NOT NULL,
  `intServiceSchedulePerDay` int(11) NOT NULL,
  `intServiceDayInterval` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intServiceCategoryId`),
  UNIQUE KEY `tblservicecategory_strservicecategoryname_unique` (`strServiceCategoryName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblServiceCategory`
--

LOCK TABLES `tblServiceCategory` WRITE;
/*!40000 ALTER TABLE `tblServiceCategory` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblServiceCategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblServicePrice`
--

DROP TABLE IF EXISTS `tblServicePrice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblServicePrice` (
  `intServicePriceId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intServiceIdFK` int(10) unsigned NOT NULL,
  `deciPrice` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intServicePriceId`),
  KEY `tblserviceprice_intserviceidfk_foreign` (`intServiceIdFK`),
  CONSTRAINT `tblserviceprice_intserviceidfk_foreign` FOREIGN KEY (`intServiceIdFK`) REFERENCES `tblService` (`intServiceId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblServicePrice`
--

LOCK TABLES `tblServicePrice` WRITE;
/*!40000 ALTER TABLE `tblServicePrice` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblServicePrice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblServiceRequirement`
--

DROP TABLE IF EXISTS `tblServiceRequirement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblServiceRequirement` (
  `intServiceRequirementId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intServiceIdFK` int(10) unsigned NOT NULL,
  `intRequirementIdFK` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intServiceRequirementId`),
  KEY `tblservicerequirement_intserviceidfk_foreign` (`intServiceIdFK`),
  KEY `tblservicerequirement_intrequirementidfk_foreign` (`intRequirementIdFK`),
  CONSTRAINT `tblservicerequirement_intrequirementidfk_foreign` FOREIGN KEY (`intRequirementIdFK`) REFERENCES `tblRequirement` (`intRequirementId`),
  CONSTRAINT `tblservicerequirement_intserviceidfk_foreign` FOREIGN KEY (`intServiceIdFK`) REFERENCES `tblService` (`intServiceId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblServiceRequirement`
--

LOCK TABLES `tblServiceRequirement` WRITE;
/*!40000 ALTER TABLE `tblServiceRequirement` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblServiceRequirement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblStorageType`
--

DROP TABLE IF EXISTS `tblStorageType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblStorageType` (
  `intStorageTypeId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `strStorageTypeName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intStorageTypeId`),
  UNIQUE KEY `tblstoragetype_strstoragetypename_unique` (`strStorageTypeName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblStorageType`
--

LOCK TABLES `tblStorageType` WRITE;
/*!40000 ALTER TABLE `tblStorageType` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblStorageType` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblTDeceasedDetail`
--

DROP TABLE IF EXISTS `tblTDeceasedDetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblTDeceasedDetail` (
  `intTDeceasedDetailId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intTDeceasedIdFK` int(10) unsigned NOT NULL,
  `intUDeceasedIdFK` int(10) unsigned NOT NULL,
  `intServiceIdFK` int(10) unsigned DEFAULT NULL,
  `intServicePriceIdFK` int(10) unsigned DEFAULT NULL,
  `dateReturn` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intTDeceasedDetailId`),
  UNIQUE KEY `tbltdeceaseddetail_inttdeceasedidfk_intudeceasedidfk_unique` (`intTDeceasedIdFK`,`intUDeceasedIdFK`),
  KEY `tbltdeceaseddetail_intudeceasedidfk_foreign` (`intUDeceasedIdFK`),
  KEY `tbltdeceaseddetail_intserviceidfk_foreign` (`intServiceIdFK`),
  KEY `tbltdeceaseddetail_intservicepriceidfk_foreign` (`intServicePriceIdFK`),
  CONSTRAINT `tbltdeceaseddetail_intserviceidfk_foreign` FOREIGN KEY (`intServiceIdFK`) REFERENCES `tblService` (`intServiceId`),
  CONSTRAINT `tbltdeceaseddetail_intservicepriceidfk_foreign` FOREIGN KEY (`intServicePriceIdFK`) REFERENCES `tblServicePrice` (`intServicePriceId`),
  CONSTRAINT `tbltdeceaseddetail_inttdeceasedidfk_foreign` FOREIGN KEY (`intTDeceasedIdFK`) REFERENCES `tblTransactionDeceased` (`intTransactionDeceasedId`),
  CONSTRAINT `tbltdeceaseddetail_intudeceasedidfk_foreign` FOREIGN KEY (`intUDeceasedIdFK`) REFERENCES `tblUnitDeceased` (`intUnitDeceasedId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblTDeceasedDetail`
--

LOCK TABLES `tblTDeceasedDetail` WRITE;
/*!40000 ALTER TABLE `tblTDeceasedDetail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblTDeceasedDetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblTPurchaseDetail`
--

DROP TABLE IF EXISTS `tblTPurchaseDetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblTPurchaseDetail` (
  `intTPurchaseDetailId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intTPurchaseIdFK` int(10) unsigned NOT NULL,
  `intTPurchaseDetailType` int(11) NOT NULL,
  `intAdditionalIdFK` int(10) unsigned DEFAULT NULL,
  `intAdditionalPriceIdFK` int(10) unsigned DEFAULT NULL,
  `intServiceIdFK` int(10) unsigned DEFAULT NULL,
  `intServicePriceIdFK` int(10) unsigned DEFAULT NULL,
  `intPackageIdFK` int(10) unsigned DEFAULT NULL,
  `intPackagePriceIdFK` int(10) unsigned DEFAULT NULL,
  `intQuantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intTPurchaseDetailId`),
  KEY `tbltpurchasedetail_inttpurchaseidfk_foreign` (`intTPurchaseIdFK`),
  KEY `tbltpurchasedetail_intadditionalidfk_foreign` (`intAdditionalIdFK`),
  KEY `tbltpurchasedetail_intadditionalpriceidfk_foreign` (`intAdditionalPriceIdFK`),
  KEY `tbltpurchasedetail_intserviceidfk_foreign` (`intServiceIdFK`),
  KEY `tbltpurchasedetail_intservicepriceidfk_foreign` (`intServicePriceIdFK`),
  KEY `tbltpurchasedetail_intpackageidfk_foreign` (`intPackageIdFK`),
  KEY `tbltpurchasedetail_intpackagepriceidfk_foreign` (`intPackagePriceIdFK`),
  CONSTRAINT `tbltpurchasedetail_intadditionalidfk_foreign` FOREIGN KEY (`intAdditionalIdFK`) REFERENCES `tblAdditional` (`intAdditionalId`),
  CONSTRAINT `tbltpurchasedetail_intadditionalpriceidfk_foreign` FOREIGN KEY (`intAdditionalPriceIdFK`) REFERENCES `tblAdditionalPrice` (`intAdditionalPriceId`),
  CONSTRAINT `tbltpurchasedetail_intpackageidfk_foreign` FOREIGN KEY (`intPackageIdFK`) REFERENCES `tblPackage` (`intPackageId`),
  CONSTRAINT `tbltpurchasedetail_intpackagepriceidfk_foreign` FOREIGN KEY (`intPackagePriceIdFK`) REFERENCES `tblPackagePrice` (`intPackagePriceId`),
  CONSTRAINT `tbltpurchasedetail_intserviceidfk_foreign` FOREIGN KEY (`intServiceIdFK`) REFERENCES `tblService` (`intServiceId`),
  CONSTRAINT `tbltpurchasedetail_intservicepriceidfk_foreign` FOREIGN KEY (`intServicePriceIdFK`) REFERENCES `tblServicePrice` (`intServicePriceId`),
  CONSTRAINT `tbltpurchasedetail_inttpurchaseidfk_foreign` FOREIGN KEY (`intTPurchaseIdFK`) REFERENCES `tblTransactionPurchase` (`intTransactionPurchaseId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblTPurchaseDetail`
--

LOCK TABLES `tblTPurchaseDetail` WRITE;
/*!40000 ALTER TABLE `tblTPurchaseDetail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblTPurchaseDetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblTransactionDeceased`
--

DROP TABLE IF EXISTS `tblTransactionDeceased`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblTransactionDeceased` (
  `intTransactionDeceasedId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intPaymentType` int(11) DEFAULT NULL,
  `intChequeIdFK` int(10) unsigned DEFAULT NULL,
  `intTransactionType` int(11) NOT NULL,
  `deciAmountPaid` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intTransactionDeceasedId`),
  KEY `tbltransactiondeceased_intchequeidfk_foreign` (`intChequeIdFK`),
  CONSTRAINT `tbltransactiondeceased_intchequeidfk_foreign` FOREIGN KEY (`intChequeIdFK`) REFERENCES `tblCheque` (`intChequeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblTransactionDeceased`
--

LOCK TABLES `tblTransactionDeceased` WRITE;
/*!40000 ALTER TABLE `tblTransactionDeceased` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblTransactionDeceased` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblTransactionOwnership`
--

DROP TABLE IF EXISTS `tblTransactionOwnership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblTransactionOwnership` (
  `intTransactionOwnershipId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intPrevOwnerIdFK` int(10) unsigned NOT NULL,
  `intNewOwnerIdFK` int(10) unsigned NOT NULL,
  `intUnitIdFK` int(10) unsigned NOT NULL,
  `deciAmountPaid` decimal(8,2) NOT NULL,
  `intPaymentType` int(11) NOT NULL,
  `intChequeIdFK` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intTransactionOwnershipId`),
  KEY `tbltransactionownership_intprevowneridfk_foreign` (`intPrevOwnerIdFK`),
  KEY `tbltransactionownership_intnewowneridfk_foreign` (`intNewOwnerIdFK`),
  KEY `tbltransactionownership_intunitidfk_foreign` (`intUnitIdFK`),
  KEY `tbltransactionownership_intchequeidfk_foreign` (`intChequeIdFK`),
  CONSTRAINT `tbltransactionownership_intchequeidfk_foreign` FOREIGN KEY (`intChequeIdFK`) REFERENCES `tblCheque` (`intChequeId`),
  CONSTRAINT `tbltransactionownership_intnewowneridfk_foreign` FOREIGN KEY (`intNewOwnerIdFK`) REFERENCES `tblCustomer` (`intCustomerId`),
  CONSTRAINT `tbltransactionownership_intprevowneridfk_foreign` FOREIGN KEY (`intPrevOwnerIdFK`) REFERENCES `tblCustomer` (`intCustomerId`),
  CONSTRAINT `tbltransactionownership_intunitidfk_foreign` FOREIGN KEY (`intUnitIdFK`) REFERENCES `tblUnit` (`intUnitId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblTransactionOwnership`
--

LOCK TABLES `tblTransactionOwnership` WRITE;
/*!40000 ALTER TABLE `tblTransactionOwnership` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblTransactionOwnership` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblTransactionPurchase`
--

DROP TABLE IF EXISTS `tblTransactionPurchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblTransactionPurchase` (
  `intTransactionPurchaseId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intCustomerIdFK` int(10) unsigned NOT NULL,
  `intPaymentType` int(11) NOT NULL,
  `intChequeIdFK` int(10) unsigned DEFAULT NULL,
  `intPaymentMode` int(11) NOT NULL,
  `deciAmountPaid` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intTransactionPurchaseId`),
  KEY `tbltransactionpurchase_intcustomeridfk_foreign` (`intCustomerIdFK`),
  KEY `tbltransactionpurchase_intchequeidfk_foreign` (`intChequeIdFK`),
  CONSTRAINT `tbltransactionpurchase_intchequeidfk_foreign` FOREIGN KEY (`intChequeIdFK`) REFERENCES `tblCheque` (`intChequeId`),
  CONSTRAINT `tbltransactionpurchase_intcustomeridfk_foreign` FOREIGN KEY (`intCustomerIdFK`) REFERENCES `tblCustomer` (`intCustomerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblTransactionPurchase`
--

LOCK TABLES `tblTransactionPurchase` WRITE;
/*!40000 ALTER TABLE `tblTransactionPurchase` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblTransactionPurchase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblTransactionUnit`
--

DROP TABLE IF EXISTS `tblTransactionUnit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblTransactionUnit` (
  `intTransactionUnitId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intCustomerIdFK` int(10) unsigned NOT NULL,
  `deciAmountPaid` decimal(8,2) NOT NULL,
  `intPaymentType` int(11) NOT NULL,
  `intChequeIdFK` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intTransactionUnitId`),
  KEY `tbltransactionunit_intcustomeridfk_foreign` (`intCustomerIdFK`),
  KEY `tbltransactionunit_intchequeidfk_foreign` (`intChequeIdFK`),
  CONSTRAINT `tbltransactionunit_intchequeidfk_foreign` FOREIGN KEY (`intChequeIdFK`) REFERENCES `tblCheque` (`intChequeId`),
  CONSTRAINT `tbltransactionunit_intcustomeridfk_foreign` FOREIGN KEY (`intCustomerIdFK`) REFERENCES `tblCustomer` (`intCustomerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblTransactionUnit`
--

LOCK TABLES `tblTransactionUnit` WRITE;
/*!40000 ALTER TABLE `tblTransactionUnit` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblTransactionUnit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblTransactionUnitDetail`
--

DROP TABLE IF EXISTS `tblTransactionUnitDetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblTransactionUnitDetail` (
  `intTransactionUnitDetailId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intTransactionUnitIdFK` int(10) unsigned NOT NULL,
  `intUnitIdFK` int(10) unsigned NOT NULL,
  `intUnitCategoryPriceIdFK` int(10) unsigned NOT NULL,
  `intTransactionType` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intTransactionUnitDetailId`),
  KEY `tbltransactionunitdetail_inttransactionunitidfk_foreign` (`intTransactionUnitIdFK`),
  KEY `tbltransactionunitdetail_intunitidfk_foreign` (`intUnitIdFK`),
  KEY `tbltransactionunitdetail_intunitcategorypriceidfk_foreign` (`intUnitCategoryPriceIdFK`),
  CONSTRAINT `tbltransactionunitdetail_inttransactionunitidfk_foreign` FOREIGN KEY (`intTransactionUnitIdFK`) REFERENCES `tblTransactionUnit` (`intTransactionUnitId`),
  CONSTRAINT `tbltransactionunitdetail_intunitcategorypriceidfk_foreign` FOREIGN KEY (`intUnitCategoryPriceIdFK`) REFERENCES `tblUnitCategoryPrice` (`intUnitCategoryPriceId`),
  CONSTRAINT `tbltransactionunitdetail_intunitidfk_foreign` FOREIGN KEY (`intUnitIdFK`) REFERENCES `tblUnit` (`intUnitId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblTransactionUnitDetail`
--

LOCK TABLES `tblTransactionUnitDetail` WRITE;
/*!40000 ALTER TABLE `tblTransactionUnitDetail` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblTransactionUnitDetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblTransactionUnitDiscount`
--

DROP TABLE IF EXISTS `tblTransactionUnitDiscount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblTransactionUnitDiscount` (
  `intTransactionUnitDiscountId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intTransactionUnitIdFK` int(10) unsigned NOT NULL,
  `intDiscountRateIdFK` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intTransactionUnitDiscountId`),
  KEY `tbltransactionunitdiscount_inttransactionunitidfk_foreign` (`intTransactionUnitIdFK`),
  KEY `tbltransactionunitdiscount_intdiscountrateidfk_foreign` (`intDiscountRateIdFK`),
  CONSTRAINT `tbltransactionunitdiscount_intdiscountrateidfk_foreign` FOREIGN KEY (`intDiscountRateIdFK`) REFERENCES `tblDiscountRate` (`intDiscountRateId`),
  CONSTRAINT `tbltransactionunitdiscount_inttransactionunitidfk_foreign` FOREIGN KEY (`intTransactionUnitIdFK`) REFERENCES `tblTransactionUnit` (`intTransactionUnitId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblTransactionUnitDiscount`
--

LOCK TABLES `tblTransactionUnitDiscount` WRITE;
/*!40000 ALTER TABLE `tblTransactionUnitDiscount` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblTransactionUnitDiscount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblUnit`
--

DROP TABLE IF EXISTS `tblUnit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblUnit` (
  `intUnitId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intBlockIdFK` int(10) unsigned NOT NULL,
  `intUnitCategoryIdFK` int(10) unsigned NOT NULL,
  `intColumnNo` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `intUnitStatus` int(11) NOT NULL,
  `intCustomerIdFK` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`intUnitId`),
  KEY `tblunit_intblockidfk_foreign` (`intBlockIdFK`),
  KEY `tblunit_intunitcategoryidfk_foreign` (`intUnitCategoryIdFK`),
  KEY `tblunit_intcustomeridfk_foreign` (`intCustomerIdFK`),
  CONSTRAINT `tblunit_intblockidfk_foreign` FOREIGN KEY (`intBlockIdFK`) REFERENCES `tblBlock` (`intBlockId`),
  CONSTRAINT `tblunit_intcustomeridfk_foreign` FOREIGN KEY (`intCustomerIdFK`) REFERENCES `tblCustomer` (`intCustomerId`),
  CONSTRAINT `tblunit_intunitcategoryidfk_foreign` FOREIGN KEY (`intUnitCategoryIdFK`) REFERENCES `tblUnitCategory` (`intUnitCategoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblUnit`
--

LOCK TABLES `tblUnit` WRITE;
/*!40000 ALTER TABLE `tblUnit` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblUnit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblUnitCategory`
--

DROP TABLE IF EXISTS `tblUnitCategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblUnitCategory` (
  `intUnitCategoryId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intLevelNo` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `intFloorIdFK` int(10) unsigned NOT NULL,
  `intUnitTypeIdFK` int(10) unsigned NOT NULL,
  PRIMARY KEY (`intUnitCategoryId`),
  KEY `tblunitcategory_intflooridfk_foreign` (`intFloorIdFK`),
  KEY `tblunitcategory_intunittypeidfk_foreign` (`intUnitTypeIdFK`),
  CONSTRAINT `tblunitcategory_intflooridfk_foreign` FOREIGN KEY (`intFloorIdFK`) REFERENCES `tblFloor` (`intFloorId`),
  CONSTRAINT `tblunitcategory_intunittypeidfk_foreign` FOREIGN KEY (`intUnitTypeIdFK`) REFERENCES `tblRoomType` (`intRoomTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblUnitCategory`
--

LOCK TABLES `tblUnitCategory` WRITE;
/*!40000 ALTER TABLE `tblUnitCategory` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblUnitCategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblUnitCategoryPrice`
--

DROP TABLE IF EXISTS `tblUnitCategoryPrice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblUnitCategoryPrice` (
  `intUnitCategoryPriceId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intUnitCategoryIdFK` int(10) unsigned NOT NULL,
  `deciPrice` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intUnitCategoryPriceId`),
  KEY `tblunitcategoryprice_intunitcategoryidfk_foreign` (`intUnitCategoryIdFK`),
  CONSTRAINT `tblunitcategoryprice_intunitcategoryidfk_foreign` FOREIGN KEY (`intUnitCategoryIdFK`) REFERENCES `tblUnitCategory` (`intUnitCategoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblUnitCategoryPrice`
--

LOCK TABLES `tblUnitCategoryPrice` WRITE;
/*!40000 ALTER TABLE `tblUnitCategoryPrice` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblUnitCategoryPrice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblUnitDeceased`
--

DROP TABLE IF EXISTS `tblUnitDeceased`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblUnitDeceased` (
  `intUnitDeceasedId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intDeceasedIdFK` int(10) unsigned NOT NULL,
  `intUnitIdFK` int(10) unsigned DEFAULT NULL,
  `intStorageTypeIdFK` int(10) unsigned NOT NULL,
  `boolBorrowed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intUnitDeceasedId`),
  UNIQUE KEY `tblunitdeceased_intunitidfk_intdeceasedidfk_unique` (`intUnitIdFK`,`intDeceasedIdFK`),
  KEY `tblunitdeceased_intdeceasedidfk_foreign` (`intDeceasedIdFK`),
  KEY `tblunitdeceased_intstoragetypeidfk_foreign` (`intStorageTypeIdFK`),
  CONSTRAINT `tblunitdeceased_intdeceasedidfk_foreign` FOREIGN KEY (`intDeceasedIdFK`) REFERENCES `tblDeceased` (`intDeceasedId`),
  CONSTRAINT `tblunitdeceased_intstoragetypeidfk_foreign` FOREIGN KEY (`intStorageTypeIdFK`) REFERENCES `tblStorageType` (`intStorageTypeId`),
  CONSTRAINT `tblunitdeceased_intunitidfk_foreign` FOREIGN KEY (`intUnitIdFK`) REFERENCES `tblUnit` (`intUnitId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblUnitDeceased`
--

LOCK TABLES `tblUnitDeceased` WRITE;
/*!40000 ALTER TABLE `tblUnitDeceased` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblUnitDeceased` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblUnitService`
--

DROP TABLE IF EXISTS `tblUnitService`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblUnitService` (
  `intUnitServiceId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intUnitTypeIdFK` int(10) unsigned NOT NULL,
  `intServiceTypeId` int(11) NOT NULL,
  `intServiceIdFK` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`intUnitServiceId`),
  UNIQUE KEY `tblunitservice_intunittypeidfk_intservicetypeid_unique` (`intUnitTypeIdFK`,`intServiceTypeId`),
  KEY `tblunitservice_intserviceidfk_foreign` (`intServiceIdFK`),
  CONSTRAINT `tblunitservice_intserviceidfk_foreign` FOREIGN KEY (`intServiceIdFK`) REFERENCES `tblService` (`intServiceId`),
  CONSTRAINT `tblunitservice_intunittypeidfk_foreign` FOREIGN KEY (`intUnitTypeIdFK`) REFERENCES `tblRoomType` (`intRoomTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblUnitService`
--

LOCK TABLES `tblUnitService` WRITE;
/*!40000 ALTER TABLE `tblUnitService` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblUnitService` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblUnitTypeStorage`
--

DROP TABLE IF EXISTS `tblUnitTypeStorage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblUnitTypeStorage` (
  `intUnitTypeStorageId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `intUnitTypeIdFK` int(10) unsigned NOT NULL,
  `intStorageTypeIdFK` int(10) unsigned NOT NULL,
  `intQuantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`intUnitTypeStorageId`),
  UNIQUE KEY `tblunittypestorage_intunittypeidfk_intstoragetypeidfk_unique` (`intUnitTypeIdFK`,`intStorageTypeIdFK`),
  KEY `tblunittypestorage_intstoragetypeidfk_foreign` (`intStorageTypeIdFK`),
  CONSTRAINT `tblunittypestorage_intstoragetypeidfk_foreign` FOREIGN KEY (`intStorageTypeIdFK`) REFERENCES `tblStorageType` (`intStorageTypeId`),
  CONSTRAINT `tblunittypestorage_intunittypeidfk_foreign` FOREIGN KEY (`intUnitTypeIdFK`) REFERENCES `tblRoomType` (`intRoomTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblUnitTypeStorage`
--

LOCK TABLES `tblUnitTypeStorage` WRITE;
/*!40000 ALTER TABLE `tblUnitTypeStorage` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblUnitTypeStorage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `strFirstName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `strMiddleName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `strLastName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `strAddress` text COLLATE utf8_unicode_ci NOT NULL,
  `dateBirthday` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `intPositionIdFK` int(10) unsigned NOT NULL,
  `strPhotoDirectory` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `uqName` (`strFirstName`,`strMiddleName`,`strLastName`),
  UNIQUE KEY `users_strphotodirectory_unique` (`strPhotoDirectory`),
  KEY `users_intpositionidfk_foreign` (`intPositionIdFK`),
  CONSTRAINT `users_intpositionidfk_foreign` FOREIGN KEY (`intPositionIdFK`) REFERENCES `tblPosition` (`intPositionId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'ken_layug@yahoo.com','$2y$10$XjVlaLL3llF8y.62.U7dn.X2a.VkvNZZB6VZlHA1OYl60kGTC5kYu',NULL,'2016-10-17 05:35:07','2016-10-17 05:35:07','Ken','Malit','Layug','QC','1996-11-08',NULL,1,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'dbColumbarium'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-17 13:35:51
