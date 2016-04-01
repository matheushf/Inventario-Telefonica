-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: vivo_inventario
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

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
-- Table structure for table `deposito`
--

DROP DATABASE `vivo_inventario`;
CREATE DATABASE `vivo_inventario`;

USE `vivo_inventario`;

DROP TABLE IF EXISTS `deposito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deposito` (
  `depo_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '{"user-control":"hidden"}',
  `depo_empresa` varchar(400) COLLATE utf8_unicode_ci NOT NULL COMMENT '{"user-control":"text"}',
  `depo_centro` int(100) NOT NULL COMMENT '{"user-control":"text"}',
  `depo_regiao` varchar(100) CHARACTER SET latin1 DEFAULT NULL COMMENT '{"user-control":"text"}',
  `depo_tipo_logradouro` varchar(100) CHARACTER SET latin1 DEFAULT NULL COMMENT '{"user-control":"text"}',
  `depo_logradouro` varchar(300) CHARACTER SET utf8 NOT NULL COMMENT '{"user-control":"text"}',
  `depo_numero` varchar(50) CHARACTER SET latin1 DEFAULT NULL COMMENT '{"user-control":"text"}',
  `depo_bairro` varchar(50) CHARACTER SET latin1 DEFAULT NULL COMMENT '{"user-control":"text"}',
  `depo_complemento` varchar(50) CHARACTER SET latin1 DEFAULT NULL COMMENT '{"user-control":"text"}',
  `depo_cidade` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT '{"user-control":"text"}',
  `depo_cep` varchar(25) CHARACTER SET latin1 DEFAULT NULL COMMENT '{"user-control":"text"}',
  `depo_status` varchar(50) CHARACTER SET latin1 DEFAULT NULL COMMENT '{"user-control":"select", "datasource-type":"literal", "datasource-literal":"status", "required":"yes"}',
  `depo_livre1` varchar(100) CHARACTER SET latin1 DEFAULT NULL COMMENT '{"user-control":"text"}',
  `depo_livre2` varchar(100) CHARACTER SET latin1 DEFAULT NULL COMMENT '{"user-control":"text"}',
  `depo_livre3` varchar(100) CHARACTER SET latin1 DEFAULT NULL COMMENT '{"user-control":"text"}',
  `depo_observacao` varchar(400) CHARACTER SET utf8 NOT NULL COMMENT '{"user-control":"text"}',
  `depo_leitura` int(11) DEFAULT '1' COMMENT '{"user-control":"hidden"}',
  PRIMARY KEY (`depo_id`),
  UNIQUE KEY `id` (`depo_id`),
  UNIQUE KEY `depo_centro_2` (`depo_centro`),
  KEY `depo_centro` (`depo_centro`),
  KEY `depo_id` (`depo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=781 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deposito`
--

LOCK TABLES `deposito` WRITE;
/*!40000 ALTER TABLE `deposito` DISABLE KEYS */;
INSERT INTO `deposito` VALUES (590,'TESTE',1124,NULL,NULL,'',NULL,NULL,NULL,'CIDADE 1',NULL,'','','','','',2),(591,'TESTE',2046,NULL,NULL,'',NULL,NULL,NULL,'CIDADE 6',NULL,'','','','','',1),(595,'TESTE',1520,NULL,NULL,'',NULL,NULL,NULL,'CIDADE 4',NULL,'','','','','',1),(598,'TESTE',1519,NULL,NULL,'',NULL,NULL,NULL,'CIDADE 3',NULL,'','','','','',1),(614,'TESTE',1857,NULL,NULL,'',NULL,NULL,NULL,'CIDADE 5',NULL,'','','','','',1),(633,'TESTE',2066,NULL,NULL,'',NULL,NULL,NULL,'CIDADE 7',NULL,'','','','','',1),(730,'TESTE',5041,NULL,NULL,'',NULL,NULL,NULL,'CIDADE 9',NULL,'','','','','',1),(751,'TESTE',2150,NULL,NULL,'',NULL,NULL,NULL,'CIDADE 8',NULL,'','','','','',1),(779,'TESTE',1234,NULL,NULL,'',NULL,NULL,NULL,'CIDADE 2',NULL,'','','','','',1),(780,'empresa',0,'regiao','tipo_logradouro','','numero','bairro','complemento','cidade','cep','Ativo','livre1',NULL,NULL,'',1);
/*!40000 ALTER TABLE `deposito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etiquetas`
--

DROP TABLE IF EXISTS `etiquetas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etiquetas` (
  `etiq_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '{"user-control":"hidden"}',
  `etiq_depo_centro` bigint(11) NOT NULL COMMENT '{"user-control":"select", "datasource-type":"sql", "datasource-sql":"select.centro", "required":"yes"}',
  `etiq_mate_material` bigint(11) NOT NULL COMMENT '{"user-control":"select", "datasource-type":"sql", "datasource-sql":"select.material", "required":"yes"}',
  `etiq_quantidade` int(50) NOT NULL COMMENT '{"user-control":"text"}',
  `etiq_observacao` varchar(300) CHARACTER SET utf8 NOT NULL COMMENT '{"user-control":"text"}',
  `etiq_cod_final` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '{"user-control":"hidden"}',
  `etiq_cod_leitura1` varchar(100) DEFAULT NULL COMMENT '{"no-update":"yes"}',
  `etiq_cod_leitura2` varchar(50) DEFAULT NULL COMMENT '{"user-control":"password", "required":"yes", "no-update":"yes"}',
  `etiq_cod_leitura3` varchar(50) DEFAULT NULL COMMENT '{"user-control":"password", "required":"yes", "no-update":"yes"}',
  `etiq_leitura` smallint(11) NOT NULL DEFAULT '1' COMMENT '{"user-control":"hidden"}',
  PRIMARY KEY (`etiq_id`),
  UNIQUE KEY `etiq_id` (`etiq_id`),
  UNIQUE KEY `etiq_cod_final_2` (`etiq_cod_final`),
  KEY `etiq_mate_material` (`etiq_mate_material`),
  KEY `etiq_depo_centro` (`etiq_depo_centro`),
  KEY `etiq_cod_leitura1` (`etiq_cod_leitura1`),
  KEY `etiq_cod_leitura2` (`etiq_cod_leitura2`),
  KEY `etiq_cod_leitura3` (`etiq_cod_leitura3`),
  KEY `etiq_cod_final` (`etiq_cod_final`),
  CONSTRAINT `etiquetas_ibfk_1` FOREIGN KEY (`etiq_mate_material`) REFERENCES `materiais` (`mate_id`),
  CONSTRAINT `etiquetas_ibfk_2` FOREIGN KEY (`etiq_depo_centro`) REFERENCES `deposito` (`depo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1181 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etiquetas`
--

LOCK TABLES `etiquetas` WRITE;
/*!40000 ALTER TABLE `etiquetas` DISABLE KEYS */;
INSERT INTO `etiquetas` VALUES (1178,590,121,1,'','1124-0056-0003-0','1-1124-0056-0003-0','2-1124-0056-0003-0',NULL,3),(1179,779,138,2,'','1234-0056-0003-0',NULL,NULL,NULL,1),(1180,598,137,1,'','1519-0186-0004-2',NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `etiquetas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventario`
--

DROP TABLE IF EXISTS `inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventario` (
  `inve_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `inve_data` datetime NOT NULL,
  `inve_etiq_id` bigint(11) NOT NULL,
  `inve_mate_id` bigint(11) NOT NULL,
  `inve_depo_id` bigint(11) NOT NULL,
  `inve_qtde_lvut` int(50) NOT NULL,
  `inve_qtde_exec` int(50) NOT NULL,
  `inve_qtde_amed` int(50) NOT NULL,
  `inve_qtde_total` int(50) NOT NULL,
  `inve_valor_unitario` double NOT NULL,
  `inve_valor_total` double NOT NULL,
  `inve_qtde_exec_eps` int(50) NOT NULL,
  `inve_qtde_amed_eps` int(50) NOT NULL,
  `inve_soma` double NOT NULL,
  UNIQUE KEY `inve_id` (`inve_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventario`
--

LOCK TABLES `inventario` WRITE;
/*!40000 ALTER TABLE `inventario` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leitura`
--

DROP TABLE IF EXISTS `leitura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leitura` (
  `leit_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `leit_data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `leit_quantidade_aferida` int(20) NOT NULL,
  `leit_id_material` int(50) NOT NULL,
  `leit_loc_material` varchar(250) NOT NULL,
  `leit_etiq_id` bigint(11) NOT NULL,
  `leit_mate_id` bigint(11) NOT NULL,
  `leit_livre1` varchar(200) DEFAULT NULL,
  `leit_livre2` varchar(200) DEFAULT NULL,
  `leit_cod_leitura` varchar(50) NOT NULL,
  `leit_nu_leitura` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`leit_id`),
  UNIQUE KEY `inve_id_2` (`leit_id`),
  UNIQUE KEY `leit_cod_leitura` (`leit_cod_leitura`),
  KEY `inve_id` (`leit_id`),
  KEY `inve_id_material` (`leit_id_material`),
  KEY `inve_etiq_id` (`leit_etiq_id`),
  KEY `inve_mate_id` (`leit_mate_id`),
  CONSTRAINT `fk_inve_etiq` FOREIGN KEY (`leit_etiq_id`) REFERENCES `etiquetas` (`etiq_id`),
  CONSTRAINT `fk_inve_mate` FOREIGN KEY (`leit_mate_id`) REFERENCES `materiais` (`mate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leitura`
--

LOCK TABLES `leitura` WRITE;
/*!40000 ALTER TABLE `leitura` DISABLE KEYS */;
INSERT INTO `leitura` VALUES (47,'2016-03-31 03:48:36',1,0,'Longe ',1178,121,'liv1','liv2','1-1124-0056-0003-0',1),(48,'2016-03-31 03:49:45',2,0,'loc2',1178,121,'l2','l2','2-1124-0056-0003-0',2);
/*!40000 ALTER TABLE `leitura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materiais`
--

DROP TABLE IF EXISTS `materiais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materiais` (
  `mate_id` bigint(11) NOT NULL AUTO_INCREMENT COMMENT '{"user-control":"hidden"}',
  `mate_codigo` varchar(200) CHARACTER SET latin1 NOT NULL COMMENT '{"user-control":"text"}',
  `mate_nome` varchar(400) CHARACTER SET utf8 NOT NULL COMMENT '{"user-control":"text"}',
  `mate_unidade_medida` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '{"user-control":"text"}',
  `mate_valor_unitario` varchar(100) CHARACTER SET latin1 NOT NULL COMMENT '{"user-control":"text"}',
  `mate_livre1` varchar(200) CHARACTER SET latin1 DEFAULT NULL COMMENT '{"user-control":"text"}',
  `mate_livre2` varchar(200) CHARACTER SET latin1 DEFAULT NULL COMMENT '{"user-control":"text"}',
  `mate_livre3` varchar(200) CHARACTER SET latin1 DEFAULT NULL COMMENT '{"user-control":"text"}',
  `mate_observacao` varchar(400) CHARACTER SET latin1 DEFAULT NULL COMMENT '{"user-control":"text"}',
  PRIMARY KEY (`mate_id`),
  UNIQUE KEY `id` (`mate_id`),
  UNIQUE KEY `codigo` (`mate_codigo`),
  KEY `mate_id` (`mate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiais`
--

LOCK TABLES `materiais` WRITE;
/*!40000 ALTER TABLE `materiais` DISABLE KEYS */;
INSERT INTO `materiais` VALUES (119,'0041-0050-6','RÃ‰GUA ALIMENTAÃ‡ÃƒO 4 TOMADAS 110/220V','U','R$  -','','','',NULL),(120,'0056-0002-2','IDENTIFICADOR PARA DROP Ã“PTICO','U','R$  -','','','',NULL),(121,'0056-0003-0','ALÃ‡A PREFORM P/ DROP Ã“PT ASU ATÃ‰ 12 FO','U','R$  -','','','',NULL),(122,'0060-0004-5','CONECTOR LINEAR IMPREGNADO MÃšLTIPLO 101','U','R$  -','','','',NULL),(123,'0087-0010-9','LNB OTIMIZADO HD DTH','U','R$  -','','','',NULL),(124,'0087-0029-0','STB IPTV CISCO ISB7100 LOW COST C/HDMI','U','R$  -','','','',NULL),(125,'0087-0032-0','STB IPTV ZYXEL 2102NANO LOW COST S/HDMI','U','R$  -','','','',NULL),(126,'0087-0035-4','STB IPTV CISCO ISB7150 SD/HD C/HDMI','U','R$  -','','','',NULL),(127,'0092-0341-9','MODEM/ROUTER  ADSL WIFI  BHS FIBER HOME','U','R$  -','','','',NULL),(128,'0092-0455-5','ROTEADOR WI-FI PADRÃƒO N PIRELLI E4001N','U','R$  -','','','',NULL),(129,'0092-0457-1','ROTEADOR WI-FI N IPV6 D-LINK DSL-2750B','U','R$  -','','','',NULL),(130,'0092-0461-0','MODEM WI-FI BHS FIBRA D-LINK DMG-6661','U','R$  -','','','',NULL),(131,'0092-0486-5','CONECTOR OPT FAC SC/APC DROP ROC','U','R$  -','','','',NULL),(132,'0092-0488-1','MODEM FIBRA DLINK VOIP DMG-6661B2','U','R$  -','','','',NULL),(133,'0092-0489-0','MODEM WIFI BHS FIBRA MITRASTAR','U','R$  -','','','',NULL),(134,'0099-0008-0','CUNHA PLÃSTICA P/ DROP Ã“PTICO ROC/FIG 8','U','R$  -','','','',NULL),(135,'0106-1285-8','SET TOP BOX IPTV LOW COST PACE','U','R$  -','','','',NULL),(136,'0106-1286-6','SET TOP BOX HD + PVR - IPTV PACE','U','R$  -','','','',NULL),(137,'0186-0004-2','CAIXA DIST OPT EDIF CONECT - 12 PIG TAIL','U','R$  -','','','',NULL),(138,'0186-0007-7','CAIXA DIST Ã“PT INT 12 FO-CDOI RISER / BA','U','R$  -','','','',NULL),(139,'0186-0008-5','DIST GERAL Ã“PT INT 72 FO-DGOI RISER - BA','U','R$  -','','','',NULL),(140,'0186-0018-2','CORDAO FO MONOFIBRA 3M SC/APC-SC/APC','U','R$  -','','','',NULL),(141,'0186-0022-0','DGOI CONECTORIZADO (DGOI C) - 48 FO','U','R$  -','','','',NULL),(142,'0186-0024-7','DGOI CONECTORIZADO (DGOI C) - 72 FO','U','R$  -','','','',NULL),(143,'0186-0025-5','ESTICADOR PLAS FIX DROP Ã“P AS COMP FIG 8','U','R$  -','','','',NULL),(144,'0186-0030-1','DROP OPTICO PRÃ‰-C FIG8 COMP OPTITAP 50M','U','R$  -','','','',NULL),(145,'0186-0031-0','DROP OPTICO PRÃ‰-C FIG8 COMP OPTITAP 100M','U','R$  -','','','',NULL),(146,'0186-0033-6','DROP OPTICO PRÃ‰-C FIG8 COMP OPTITAP 150M','U','R$  -','','','',NULL),(147,'0186-0034-4','DROP OPTICO PRÃ‰-C FIG8 COMP OPTITAP 220M','U','R$  -','','','',NULL),(148,'0186-0036-0','DGOI CONECT MODULAR 144F - PAREDE','U','R$  -','','','',NULL),(149,'0186-0038-7','DROP OPTICO PRÃ‰-C FIG8 COMP OPTITAP 300M','U','R$  -','','','',NULL),(150,'0186-0041-7','CAIXA DIST. OPT EDIF. CONECT - 8 SPLITTE','U','R$  -','','','',NULL),(151,'0192-0016-1','SPLITTER DE ASSINANTE PARA ADSL','U','R$  -','','','',NULL),(152,'0192-0201-6','ACCESS POIT WI-FI - FTTX','U','R$  -','','','',NULL),(153,'0192-0215-6','SPLITTER OPT. PASSÃVO 1:2 3,5dB-FTTH','U','R$  -','','','',NULL),(154,'0192-0216-4','SPLITTER OPT. PASSÃVO 1:4-7,0dB-FTTH','U','R$  -','','','',NULL),(155,'0192-0218-0','CONJ. EMENDA CABO OPT. SUBT 144F AC FTTH','U','R$  -','','','',NULL),(156,'0192-0219-9','SPLITTER Ã“PT. PASSÃVO 1:8-10,4dB-FTTH','U','R$  -','','','',NULL),(157,'codigo','nome','unidade_medida','valor_unitario','livre1','livre2','livre3','observacao');
/*!40000 ALTER TABLE `materiais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `usua_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '{"user-control":"hidden"}',
  `usua_nome` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '{"user-control":"text", "required":"yes"}',
  `usua_email` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '{"user-control":"text", "required":"yes", "typeof":"email"}',
  `usua_senha` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '{"user-control":"password", "required":"yes"}',
  `usua_tipo` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '{"user-control":"select", "datasource-type":"literal", "datasource-literal":"tipo", "required":"yes"}',
  `usua_status` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '{"user-control":"select", "datasource-type":"literal", "datasource-literal":"status", "required":"yes"}',
  `usua_celular` varchar(50) CHARACTER SET utf8 DEFAULT NULL COMMENT '{"user-control":"text", "required":"yes", "typeof":"phone"}',
  PRIMARY KEY (`usua_id`),
  UNIQUE KEY `usua_email` (`usua_email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'teste','email@email.com','2e6f9b0d5885b6010f9167787445617f553a735f','Admin','Ativo','0');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-31  8:37:55
