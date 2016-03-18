-- MySQL dump 10.13  Distrib 5.6.21, for Win32 (x86)
--
-- Host: localhost    Database: vivo_inventario
-- ------------------------------------------------------
-- Server version	5.6.21

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

DROP TABLE IF EXISTS `deposito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deposito` (
  `depo_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '{"user-control":"hidden"}',
  `depo_empresa` varchar(400) NOT NULL COMMENT '{"user-control":"text"}',
  `depo_centro` int(100) NOT NULL COMMENT '{"user-control":"text"}',
  `depo_regiao` varchar(100) NOT NULL COMMENT '{"user-control":"text"}',
  `depo_tipo_logradouro` varchar(100) NOT NULL COMMENT '{"user-control":"text"}',
  `depo_logradouro` text NOT NULL COMMENT '{"user-control":"text"}',
  `depo_numero` varchar(50) NOT NULL COMMENT '{"user-control":"text"}',
  `depo_bairro` varchar(50) NOT NULL COMMENT '{"user-control":"text"}',
  `depo_complemento` varchar(50) NOT NULL COMMENT '{"user-control":"text"}',
  `depo_cidade` varchar(100) NOT NULL COMMENT '{"user-control":"text"}',
  `depo_cep` varchar(25) NOT NULL COMMENT '{"user-control":"text"}',
  `depo_status` varchar(50) NOT NULL COMMENT '{"user-control":"select", "datasource-type":"literal", "datasource-literal":"status", "required":"yes"}',
  `depo_livre1` varchar(100) NOT NULL COMMENT '{"user-control":"text"}',
  `depo_livre2` varchar(100) NOT NULL COMMENT '{"user-control":"text"}',
  `depo_livre3` varchar(100) NOT NULL COMMENT '{"user-control":"text"}',
  `depo_observacao` text COMMENT '{"user-control":"text"}',
  `depo_excluido` smallint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`depo_id`),
  UNIQUE KEY `id` (`depo_id`),
  UNIQUE KEY `empresa` (`depo_empresa`),
  KEY `depo_centro` (`depo_centro`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deposito`
--

LOCK TABLES `deposito` WRITE;
/*!40000 ALTER TABLE `deposito` DISABLE KEYS */;
INSERT INTO `deposito` VALUES (1,'empresa',1,'regiao','tipo_logradouro','logradouro','numero','bairro','complemento','cidade','cep','Ativo','livre1','','','observacao',0),(3,'empresa2',1001,'regiao','tipo_logradouro','logradouro','numero','bairro','complemento','cidade','cep','Ativo','livre1','','','observacao',0),(4,'empresa3',1112332,'regiao','tipo_logradouro','logradouro','numero','bairro','complemento','cidade','cep','Ativo','livre1','','','observacao',0);
/*!40000 ALTER TABLE `deposito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etiquetas`
--

DROP TABLE IF EXISTS `etiquetas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etiquetas` (
  `etiq_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT '{"user-control":"hidden"}',
  `etiq_depo_centro` bigint(11) NOT NULL COMMENT '{"user-control":"select", "datasource-type":"sql", "datasource-sql":"select.centro", "required":"yes"}',
  `etiq_mate_material` bigint(11) NOT NULL COMMENT '{"user-control":"select", "datasource-type":"sql", "datasource-sql":"select.material", "required":"yes"}',
  `etiq_quantidade` int(50) NOT NULL COMMENT '{"user-control":"text"}',
  `etiq_observacao` text COMMENT '{"user-control":"text"}',
  `etiq_cod_final` varchar(50) NOT NULL,
  `etiq_cod_leitura1` varchar(50) NOT NULL,
  `etiq_cod_leitura2` varchar(50) NOT NULL,
  `etiq_cod_leitura3` varchar(50) NOT NULL,
  `etiq_excluido` smallint(11) NOT NULL,
  PRIMARY KEY (`etiq_id`),
  UNIQUE KEY `etiq_id` (`etiq_id`),
  KEY `etiq_mate_material` (`etiq_mate_material`),
  KEY `etiq_depo_centro` (`etiq_depo_centro`),
  KEY `etiq_cod_leitura1` (`etiq_cod_leitura1`),
  KEY `etiq_cod_leitura2` (`etiq_cod_leitura2`),
  KEY `etiq_cod_leitura3` (`etiq_cod_leitura3`),
  KEY `etiq_cod_final` (`etiq_cod_final`),
  CONSTRAINT `etiquetas_ibfk_1` FOREIGN KEY (`etiq_mate_material`) REFERENCES `materiais` (`mate_id`),
  CONSTRAINT `etiquetas_ibfk_2` FOREIGN KEY (`etiq_depo_centro`) REFERENCES `deposito` (`depo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etiquetas`
--

LOCK TABLES `etiquetas` WRITE;
/*!40000 ALTER TABLE `etiquetas` DISABLE KEYS */;
INSERT INTO `etiquetas` VALUES (1,3,1,12,'e','','','','',1),(2,3,1,9,'editado','','','','',1),(3,3,1,1,'ee','','','','',1),(4,1,1,2,'3','','','','',1),(5,1,1,2,'3','','','','',1),(6,1,1,0,'observacao','','','','',1),(7,3,1,0,NULL,'','','','',1),(8,1,1,0,'observacao','','','','',1),(9,1,1,0,'observacao','','','','',1),(10,1,1,0,'observacao','','','','',1),(11,1,1,0,'observacao','','','','',1),(12,1,1,0,'observacao','','','','',1),(13,1,1,0,'observacao','','','','',1),(14,1,1,0,'observacao','','','','',1),(15,1,1,0,'observacao','','','','',0),(16,1,1,0,'observacao','','','','',1),(18,3,1,0,'observacao','','','','',1),(19,1,1,0,'observacao','','','','',0),(20,3,2,2,'oi','','','','',0);
/*!40000 ALTER TABLE `etiquetas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materiais`
--

DROP TABLE IF EXISTS `materiais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materiais` (
  `mate_id` bigint(11) NOT NULL AUTO_INCREMENT COMMENT '{"user-control":"hidden"}',
  `mate_codigo` varchar(200) NOT NULL COMMENT '{"user-control":"text"}',
  `mate_nome` text NOT NULL COMMENT '{"user-control":"text"}',
  `mate_unidade_medida` text NOT NULL COMMENT '{"user-control":"text"}',
  `mate_valor_unitario` varchar(100) NOT NULL COMMENT '{"user-control":"text"}',
  `mate_livre1` varchar(200) NOT NULL COMMENT '{"user-control":"text"}',
  `mate_livre2` varchar(200) NOT NULL COMMENT '{"user-control":"text"}',
  `mate_livre3` varchar(200) NOT NULL COMMENT '{"user-control":"text"}',
  `mate_observacao` varchar(400) DEFAULT NULL COMMENT '{"user-control":"text"}',
  `mate_excluido` smallint(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mate_id`),
  UNIQUE KEY `id` (`mate_id`),
  UNIQUE KEY `codigo` (`mate_codigo`),
  KEY `mate_id` (`mate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiais`
--

LOCK TABLES `materiais` WRITE;
/*!40000 ALTER TABLE `materiais` DISABLE KEYS */;
INSERT INTO `materiais` VALUES (1,'codigo','material 1','unidade_de_medida','valor_unitario','livre1','livre2','livre3','observacao',0),(2,'111414141','materrer','unidade_medida','valor_unitario','livre1','livre2','livre3','observacao',0);
/*!40000 ALTER TABLE `materiais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `usua_id` int(11) NOT NULL COMMENT '{"user-control":"hidden"}',
  `usua_nome` text NOT NULL COMMENT '{"user-control":"text", "required":"yes"}',
  `usua_email` text NOT NULL COMMENT '{"user-control":"text", "required":"yes", "typeof":"email"}',
  `usua_senha` text NOT NULL COMMENT '{"user-control":"password", "required":"yes"}',
  `usua_tipo` text NOT NULL COMMENT '{"user-control":"select", "datasource-type":"literal", "datasource-literal":"tipo", "required":"yes"}',
  `usua_status` text NOT NULL COMMENT '{"user-control":"select", "datasource-type":"literal", "datasource-literal":"status", "required":"yes"}',
  `usua_celular` text NOT NULL COMMENT '{"user-control":"text", "required":"yes", "typeof":"phone"}',
  `usua_excluido` smallint(6) NOT NULL COMMENT '{"removed":"yes"}'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
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

-- Dump completed on 2016-03-17 17:49:42
