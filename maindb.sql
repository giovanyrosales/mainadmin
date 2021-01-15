CREATE DATABASE  IF NOT EXISTS `maindb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `maindb`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: maindb
-- ------------------------------------------------------
-- Server version	5.7.24

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
-- Table structure for table `areagestion`
--

DROP TABLE IF EXISTS `areagestion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `areagestion` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `linea_id` bigint(20) unsigned NOT NULL,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `areagestion_linea_id_foreign` (`linea_id`),
  CONSTRAINT `areagestion_linea_id_foreign` FOREIGN KEY (`linea_id`) REFERENCES `linea` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areagestion`
--

LOCK TABLES `areagestion` WRITE;
/*!40000 ALTER TABLE `areagestion` DISABLE KEYS */;
/*!40000 ALTER TABLE `areagestion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bitacora` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `proyecto_id` bigint(20) unsigned NOT NULL,
  `num` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `observaciones` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bitacora_proyecto_id_foreign` (`proyecto_id`),
  CONSTRAINT `bitacora_proyecto_id_foreign` FOREIGN KEY (`proyecto_id`) REFERENCES `proyecto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
INSERT INTO `bitacora` VALUES (24,1,24,'2020-12-01','dsdasdsadasd'),(25,1,25,'2020-11-09','Bitacora con foto prueba final'),(26,1,26,'2020-11-21','Prueba de bitacora con mas de una foto'),(27,2,1,'2021-01-12','Observaciones de Bitacora 1');
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bitfotos`
--

DROP TABLE IF EXISTS `bitfotos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bitfotos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bitacora_id` bigint(20) unsigned NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bitfotos_bitacora_id_foreign` (`bitacora_id`),
  CONSTRAINT `bitfotos_bitacora_id_foreign` FOREIGN KEY (`bitacora_id`) REFERENCES `bitacora` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitfotos`
--

LOCK TABLES `bitfotos` WRITE;
/*!40000 ALTER TABLE `bitfotos` DISABLE KEYS */;
INSERT INTO `bitfotos` VALUES (3,24,'asda','z0suxO5pczYFUTV7k8Re0.29738600_1604944450.JPG'),(4,25,'titulofoto','ddnwqsGN.jpg'),(5,26,'foto 1','W3Y3UuUn.JPG'),(6,26,'foto 2','V62fsEIg.jpg'),(7,26,'foto 3','Km9ziTYh.jpg'),(8,27,'Titulo Bitacora 1','gepkJLuA.jpg');
/*!40000 ALTER TABLE `bitfotos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bolson`
--

DROP TABLE IF EXISTS `bolson`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bolson` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `montoini` decimal(8,2) NOT NULL,
  `saldo` decimal(8,2) NOT NULL,
  `cuenta_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bolson_cuenta_id_foreign` (`cuenta_id`),
  CONSTRAINT `bolson_cuenta_id_foreign` FOREIGN KEY (`cuenta_id`) REFERENCES `cuenta` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bolson`
--

LOCK TABLES `bolson` WRITE;
/*!40000 ALTER TABLE `bolson` DISABLE KEYS */;
INSERT INTO `bolson` VALUES (1,'Cuenta Bolson de Prueba 2021','2021-01-12',255000.00,250000.00,1);
/*!40000 ALTER TABLE `bolson` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuenta`
--

DROP TABLE IF EXISTS `cuenta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuenta` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuenta`
--

LOCK TABLES `cuenta` WRITE;
/*!40000 ALTER TABLE `cuenta` DISABLE KEYS */;
INSERT INTO `cuenta` VALUES (1,'Cuenta de Prueba 541','54110'),(2,'codigo esp. 2','54578');
/*!40000 ALTER TABLE `cuenta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cuentaproy`
--

DROP TABLE IF EXISTS `cuentaproy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuentaproy` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `proyecto_id` bigint(20) unsigned NOT NULL,
  `cuenta_id` bigint(20) unsigned NOT NULL,
  `montoini` decimal(8,2) NOT NULL,
  `saldo` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cuentaproy_proyecto_id_foreign` (`proyecto_id`),
  KEY `cuentaproy_cuenta_id_foreign` (`cuenta_id`),
  CONSTRAINT `cuentaproy_cuenta_id_foreign` FOREIGN KEY (`cuenta_id`) REFERENCES `cuenta` (`id`),
  CONSTRAINT `cuentaproy_proyecto_id_foreign` FOREIGN KEY (`proyecto_id`) REFERENCES `proyecto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuentaproy`
--

LOCK TABLES `cuentaproy` WRITE;
/*!40000 ALTER TABLE `cuentaproy` DISABLE KEYS */;
/*!40000 ALTER TABLE `cuentaproy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_partida`
--

DROP TABLE IF EXISTS `detalle_partida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_partida` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cantidad` decimal(8,2) NOT NULL,
  `material_id` bigint(20) unsigned NOT NULL,
  `unidad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partida_id` bigint(20) unsigned NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detalle_partida_partida_id_foreign` (`partida_id`),
  KEY `detalle_partida_material_id_foreign` (`material_id`),
  CONSTRAINT `detalle_partida_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materiales` (`id`),
  CONSTRAINT `detalle_partida_partida_id_foreign` FOREIGN KEY (`partida_id`) REFERENCES `partida` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_partida`
--

LOCK TABLES `detalle_partida` WRITE;
/*!40000 ALTER TABLE `detalle_partida` DISABLE KEYS */;
INSERT INTO `detalle_partida` VALUES (3,4.00,1,'plg',3,NULL),(4,3.00,1,'plg',3,NULL),(5,9.00,10,'mts',3,NULL),(6,8.00,9,'mts',3,NULL),(7,1.00,2,'plg',3,NULL),(8,5.00,4,'qq',3,NULL),(9,4.00,11,'pliego',4,NULL),(10,14.00,9,'mts',5,NULL),(11,223.00,9,'mts',4,NULL),(12,12.00,7,'mts',4,NULL),(13,1.00,2,'plg',6,NULL),(14,3.00,3,'plg',6,NULL),(15,100.00,2,'plg',7,NULL),(16,45.00,3,'plg',7,NULL),(17,5.00,3,'plg',8,NULL),(18,200.00,9,'mts',8,NULL),(19,45.00,11,'pliego',9,NULL),(20,35.00,10,'mts',9,NULL),(21,45.00,2,'plg',10,NULL),(22,67.00,8,'mts',10,NULL),(23,60.00,7,'mts',10,NULL),(24,90.00,12,'pliego',11,NULL);
/*!40000 ALTER TABLE `detalle_partida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuentef`
--

DROP TABLE IF EXISTS `fuentef`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuentef` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuentef`
--

LOCK TABLES `fuentef` WRITE;
/*!40000 ALTER TABLE `fuentef` DISABLE KEYS */;
INSERT INTO `fuentef` VALUES (1,'88','Fuente de Financiamiento prueba 1');
/*!40000 ALTER TABLE `fuentef` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuenter`
--

DROP TABLE IF EXISTS `fuenter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuenter` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fuentef_id` bigint(20) unsigned NOT NULL,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fuenter_fuentef_id_foreign` (`fuentef_id`),
  CONSTRAINT `fuenter_fuentef_id_foreign` FOREIGN KEY (`fuentef_id`) REFERENCES `fuentef` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuenter`
--

LOCK TABLES `fuenter` WRITE;
/*!40000 ALTER TABLE `fuenter` DISABLE KEYS */;
INSERT INTO `fuenter` VALUES (1,1,'565','Fuente de Recursos prueba 1');
/*!40000 ALTER TABLE `fuenter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `linea`
--

DROP TABLE IF EXISTS `linea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `linea` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linea`
--

LOCK TABLES `linea` WRITE;
/*!40000 ALTER TABLE `linea` DISABLE KEYS */;
INSERT INTO `linea` VALUES (1,'11','Linea de trabajo prueba 1'),(2,'22','Linea de Trabajo prueba 2');
/*!40000 ALTER TABLE `linea` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materiales`
--

DROP TABLE IF EXISTS `materiales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materiales` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cod` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unidad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pu` decimal(8,2) NOT NULL,
  `clasificacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiales`
--

LOCK TABLES `materiales` WRITE;
/*!40000 ALTER TABLE `materiales` DISABLE KEYS */;
INSERT INTO `materiales` VALUES (1,'1','Material de prueba','plg',65.50,'materiales'),(2,'1','material 1','plg',6.00,'materiales'),(3,'1','material 2','plg',9.00,'materiales'),(4,'1','material 3','qq',5.00,'materiales'),(5,'1','material 4','plg',8.00,'materiales'),(6,'1','material 5','plg',7.00,'mano_de_obra'),(7,'1','material 6','mts',8.00,'materiales'),(8,'1','material 7','mts',4.00,'materiales'),(9,'1','material 8','mts',75.00,'materiales'),(10,'1','material 9','mts',1.00,'materiales'),(11,'1','material 10','pliego',45.00,'materiales'),(12,'2','Material 11','pliego',25.50,'materiales');
/*!40000 ALTER TABLE `materiales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materiales_proyecto`
--

DROP TABLE IF EXISTS `materiales_proyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materiales_proyecto` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cantidad` decimal(8,2) NOT NULL,
  `material_id` bigint(20) unsigned NOT NULL,
  `proyecto_id` bigint(20) unsigned NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `materiales_proyecto_proyecto_id_foreign` (`proyecto_id`),
  KEY `materiales_proyecto_material_id_foreign` (`material_id`),
  CONSTRAINT `materiales_proyecto_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materiales` (`id`),
  CONSTRAINT `materiales_proyecto_proyecto_id_foreign` FOREIGN KEY (`proyecto_id`) REFERENCES `proyecto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiales_proyecto`
--

LOCK TABLES `materiales_proyecto` WRITE;
/*!40000 ALTER TABLE `materiales_proyecto` DISABLE KEYS */;
INSERT INTO `materiales_proyecto` VALUES (1,5.00,3,2,'1'),(2,45.00,11,2,'1'),(3,35.00,10,2,'1'),(4,45.00,2,3,'1'),(5,67.00,8,3,'1'),(6,60.00,7,3,'1'),(7,90.00,12,2,'1');
/*!40000 ALTER TABLE `materiales_proyecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2020_09_28_195836_create_proyecto_table',1),(3,'2020_09_28_202833_create_materiales_table',1),(4,'2020_09_29_160516_create_cuenta_table',1),(5,'2020_09_29_160609_create_bolson_table',1),(6,'2020_09_29_160610_create_tipomovi_table',1),(7,'2020_09_29_160838_create_movibolson_table',1),(8,'2020_10_05_181059_create_cuentaproy_table',1),(9,'2020_10_12_214015_create_permission_tables',1),(10,'2020_10_13_160933_create_materiales_proyecto_table',1),(11,'2020_10_13_162330_create_partida_table',1),(12,'2020_10_13_170424_create_detalle_partida_table',1),(13,'2020_10_23_200456_create_fuentef_table',1),(14,'2020_10_23_203521_create_fuenter_table',1),(15,'2020_10_23_214051_create_linea_table',1),(16,'2020_10_23_214106_create_areagestion_table',1),(17,'2020_11_04_170057_create_bitacora_table',2),(18,'2020_11_04_170344_create_bitfotos_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\User',1),(2,'App\\User',2),(3,'App\\User',3);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movibolson`
--

DROP TABLE IF EXISTS `movibolson`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movibolson` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `bolson_id` bigint(20) unsigned NOT NULL,
  `cuenta_id` bigint(20) unsigned NOT NULL,
  `aumenta` decimal(8,2) DEFAULT NULL,
  `disminuye` decimal(8,2) DEFAULT NULL,
  `fecha` date NOT NULL,
  `tipomovi_id` bigint(20) unsigned NOT NULL,
  `proyecto_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `movibolson_proyecto_id_foreign` (`proyecto_id`),
  KEY `movibolson_bolson_id_foreign` (`bolson_id`),
  KEY `movibolson_cuenta_id_foreign` (`cuenta_id`),
  KEY `movibolson_tipomovi_id_foreign` (`tipomovi_id`),
  CONSTRAINT `movibolson_bolson_id_foreign` FOREIGN KEY (`bolson_id`) REFERENCES `bolson` (`id`),
  CONSTRAINT `movibolson_cuenta_id_foreign` FOREIGN KEY (`cuenta_id`) REFERENCES `cuenta` (`id`),
  CONSTRAINT `movibolson_proyecto_id_foreign` FOREIGN KEY (`proyecto_id`) REFERENCES `proyecto` (`id`),
  CONSTRAINT `movibolson_tipomovi_id_foreign` FOREIGN KEY (`tipomovi_id`) REFERENCES `tipomovi` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movibolson`
--

LOCK TABLES `movibolson` WRITE;
/*!40000 ALTER TABLE `movibolson` DISABLE KEYS */;
/*!40000 ALTER TABLE `movibolson` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partida`
--

DROP TABLE IF EXISTS `partida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partida` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cantidadp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proyecto_id` bigint(20) unsigned NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `partida_proyecto_id_foreign` (`proyecto_id`),
  CONSTRAINT `partida_proyecto_id_foreign` FOREIGN KEY (`proyecto_id`) REFERENCES `proyecto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partida`
--

LOCK TABLES `partida` WRITE;
/*!40000 ALTER TABLE `partida` DISABLE KEYS */;
INSERT INTO `partida` VALUES (3,'3','partida de pruebaSS','7 mts2',1,NULL),(4,'4','Partida Prueba 2','5 pies3',1,NULL),(5,'5','partida de prueba 3333','10 mts',1,NULL),(6,'1','Muro de partida 1','1',2,NULL),(7,'2','muro prueba','1',2,NULL),(8,'3','Partida 2 de prueba','1',2,NULL),(9,'4','partida de prueba 3','1',2,NULL),(10,'1','muro','1',3,NULL),(11,'5','pared','1',2,NULL);
/*!40000 ALTER TABLE `partida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'todos','web','2020-10-28 02:42:44','2020-10-28 02:42:44');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyecto`
--

DROP TABLE IF EXISTS `proyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyecto` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ubicacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuentef` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contraparte` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechaini` date DEFAULT NULL,
  `fechafin` date DEFAULT NULL,
  `fecha` date NOT NULL,
  `areagestion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linea` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fuenter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `naturaleza` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ejecutor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `formulador` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encargado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codcontable` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acuerdoapertura` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acuerdocierre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `proyecto_codigo_unique` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyecto`
--

LOCK TABLES `proyecto` WRITE;
/*!40000 ALTER TABLE `proyecto` DISABLE KEYS */;
INSERT INTO `proyecto` VALUES (1,NULL,'Proyecto de prueba 1','Col. Guadalupe, Metapan','1',NULL,'2020-10-28',NULL,'2020-10-27','1','1','1','privativo',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,NULL,'Proyecto de prueba 2021','Metapan','1','no','2021-01-12',NULL,'2021-01-12','1','2','1','desarrollosocial','Ejecutor 1','Formulador 1','Supervisor 1','Encargado 1','45434544',NULL,NULL,NULL),(3,NULL,'Proyecto de prueba 3 2021','Metapan','1','no','2021-01-14',NULL,'2021-01-13','1','1','1','desarrollosocial','ej','fr','sr','en',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `proyecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(1,2),(1,3);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'uaci','web','2020-10-28 02:42:44','2020-10-28 02:42:44'),(2,'presupuesto','web','2020-10-28 02:42:44','2020-10-28 02:42:44'),(3,'Formulador','web','2020-10-28 02:42:44','2020-10-28 02:42:44');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipomovi`
--

DROP TABLE IF EXISTS `tipomovi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipomovi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipomovi`
--

LOCK TABLES `tipomovi` WRITE;
/*!40000 ALTER TABLE `tipomovi` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipomovi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_usuario_unique` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Giovany','Rosales','uaci','$2y$10$T3klfgaf6lJcIz77jN7Dx.veXZ7Z2z256WuHDr7zNg0R2qYDBpn6m','75335897'),(2,'Giovany','Rosales','presupuesto','$2y$10$XV.ULexhmx8s3bN1PdBvuesZtocO/p9CROMQu8CbHI1truiD3i9py','75335897'),(3,'Giovany','Rosales','ingenieria','$2y$10$DXOA8getIAldj0BTprArtetPV2NJLiYL2ekKRWdMtl9jgYFN33wr.','75335897');
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

-- Dump completed on 2021-01-15 10:38:22
