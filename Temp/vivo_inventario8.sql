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

DROP DATABASE `vivo_inventario`;
CREATE DATABASE `vivo_inventario`;

USE `vivo_inventario`;

--
-- Table structure for table `deposito`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=1182 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etiquetas`
--

LOCK TABLES `etiquetas` WRITE;
/*!40000 ALTER TABLE `etiquetas` DISABLE KEYS */;
INSERT INTO `etiquetas` VALUES (1178,590,121,2,'','1124-0056-0003-0','1-1124-0056-0003-0','2-1124-0056-0003-0',NULL,2),(1179,779,138,2,'','1234-0056-0003-0',NULL,NULL,NULL,1),(1180,598,137,1,'','1519-0186-0004-2',NULL,NULL,NULL,1),(1181,598,152,2,'','1519-0192-0201-6','1-1519-0192-0201-6',NULL,NULL,2);
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
  `inve_qtd_cpcon` int(50) NOT NULL,
  `inve_soma` double NOT NULL,
  `inve_dif_final_qtd` int(50) NOT NULL,
  `inve_dif_negativa` double NOT NULL,
  `inve_dif_positiva` int(50) NOT NULL,
  `inve_acura_fisica` int(50) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leitura`
--

LOCK TABLES `leitura` WRITE;
/*!40000 ALTER TABLE `leitura` DISABLE KEYS */;
INSERT INTO `leitura` VALUES (47,'2016-03-31 03:48:36',10,0,'Longe ',1178,121,'liv1','liv2','1-1124-0056-0003-0',1),(48,'2016-03-31 03:49:45',15,0,'loc2',1178,121,'l2','l2','2-1124-0056-0003-0',2),(49,'2016-03-31 03:49:45',30,0,'loc2',1178,121,'l2','l2','3-1124-0056-0003-0',3),(51,'2016-03-31 20:16:12',10,0,'loc_mate',1181,152,'livre1','livre2','1-1519-0192-0201-6',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=372 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materiais`
--

LOCK TABLES `materiais` WRITE;
/*!40000 ALTER TABLE `materiais` DISABLE KEYS */;
INSERT INTO `materiais` VALUES (151,'TESTE','TESTE','TESTE','0',NULL,NULL,NULL,NULL),(197,'0041-0050-6','REGUA ALIMENTACAO 4 TOMADAS 110/220V','U','20.27','','','',NULL),(198,'0056-0002-2','IDENTIFICADOR PARA DROP OPTICO','U','0.54','','','',NULL),(200,'0060-0004-5','CONECTOR LINEAR IMPREGNADO MULTIPLO 101','U','0.26','','','',NULL),(201,'0087-0010-9','LNB OTIMIZADO HD DTH','U','40.04','','','',NULL),(202,'0087-0029-0','STB IPTV CISCO ISB7100 LOW COST C/HDMI','U','3.86','','','',NULL),(203,'0087-0035-4','STB IPTV CISCO ISB7150 SD/HD C/HDMI','U','1','','','',NULL),(204,'0092-0455-5','ROTEADOR WI-FI PADRAO N PIRELLI E4001N','U','1.21','','','',NULL),(205,'0092-0457-1','ROTEADOR WI-FI N IPV6 D-LINK DSL-2750B','U','58.16','','','',NULL),(206,'0092-0461-0','MODEM WI-FI BHS FIBRA D-LINK DMG-6661','U','0.17','','','',NULL),(207,'0092-0486-5','CONECTOR OPT FAC SC/APC DROP ROC','U','15.38','','','',NULL),(208,'0092-0488-1','MODEM FIBRA DLINK VOIP DMG-6661B2','U','234.4','','','',NULL),(209,'0092-0489-0','MODEM WIFI BHS FIBRA MITRASTAR','U','397.85','','','',NULL),(210,'0099-0008-0','CUNHA PLASTICA P/ DROP OPTICO ROC/FIG 8','U','1.06','','','',NULL),(211,'0106-1285-8','SET TOP BOX IPTV LOW COST PACE','U','225.08','','','',NULL),(212,'0106-1286-6','SET TOP BOX HD + PVR - IPTV PACE','U','387.33','','','',NULL),(213,'0130-0005-5','TOMADA MODULAR PARA PAREDE OU PISO','U','3.46','','','',NULL),(214,'0155-0005-5','CABO UTP CAT-3 2 PARES X 24 AWG','M','0.37','','','',NULL),(215,'0186-0004-2','CAIXA DIST OPT EDIF CONECT - 12 PIG TAIL','U','148.58','','','',NULL),(216,'0186-0007-7','CAIXA DIST OPT INT 12 FO-CDOI RISER / BA','U','32.41','','','',NULL),(217,'0186-0008-5','DIST GERAL OPT INT 72 FO-DGOI RISER - BA','U','99.5','','','',NULL),(218,'0186-0018-2','CORDAO FO MONOFIBRA 3M SC/APC-SC/APC','U','10.78','','','',NULL),(219,'0186-0022-0','DGOI CONECTORIZADO (DGOI C) - 48 FO','U','1146.87','','','',NULL),(220,'0186-0024-7','DGOI CONECTORIZADO (DGOI C) - 72 FO','U','3483.48','','','',NULL),(221,'0186-0025-5','ESTICADOR PLAS FIX DROP OP AS COMP FIG 8','U','0.37','','','',NULL),(222,'0186-0030-1','DROP OPTICO PRE-C FIG8 COMP OPTITAP 50M','U','80.3','','','',NULL),(223,'0186-0031-0','DROP OPTICO PRE-C FIG8 COMP OPTITAP 100M','U','107.67','','','',NULL),(224,'0186-0033-6','DROP OPTICO PRE-C FIG8 COMP OPTITAP 150M','U','138.43','','','',NULL),(225,'0186-0034-4','DROP OPTICO PRE-C FIG8 COMP OPTITAP 220M','U','180.02','','','',NULL),(226,'0186-0036-0','DGOI CONECT MODULAR 144F - PAREDE','U','R$ -','','','',NULL),(227,'0186-0038-7','DROP OPTICO PRE-C FIG8 COMP OPTITAP 300M','U','225.5','','','',NULL),(228,'0186-0041-7','CAIXA DIST. OPT EDIF. CONECT - 8 SPLITTE','U','249.16','','','',NULL),(229,'0192-0016-1','SPLITTER DE ASSINANTE PARA ADSL','U','6.42','','','',NULL),(230,'0192-0218-0','CONJ. EMENDA CABO OPT. SUBT 144F AC FTTH','U','1181.82','','','',NULL),(231,'0192-0232-6','PONTO TERMINACAO OPTICA-PTO-FTTH','U','5.4','','','',NULL),(232,'0192-0278-4','MICROFILTRO COMBINADO','U','4.13','','','',NULL),(233,'0192-0291-1','MODEM ADSL ETH HUAWEI 880 C/FONTE','U','R$ -','','','',NULL),(234,'0192-0344-6','KIT SPEEDY BHS VDSL ARCADYAN','U','142.77','','','',NULL),(235,'0192-0345-4','MODEM WIFI BHS FIBRA','U','367.33','','','',NULL),(236,'0192-0349-7','TERM REDE OPTICA ONT HUAWEI HG8240','U','0.04','','','',NULL),(237,'0192-0371-8','KIT SPEEDY ADSL 2 ETH COLETEK','U','41.93','','','',NULL),(238,'0192-0373-0','KIT SPEEDY BHS COLETEK','U','81.09','','','',NULL),(239,'0192-0374-9','KIT SPEEDY BHS DATACOM','U','65.12','','','',NULL),(240,'0192-0376-2','ROTEADOR N WIFI IPV6 COLETEK','U','70.26','','','',NULL),(241,'0192-0377-3','MODEM WIFI BHS FIBRA SAGEMCOM','U','250.29','','','',NULL),(242,'0192-0381-7','EQUIP ONT INTEROPERAVEL - BLU-CASTLE','U','137.64','','','',NULL),(243,'0219-0022-1','KIT DERIVACAO FIST-GCO DERIVACAO RAYCHEM','U','16.88','','','',NULL),(244,'0219-0024-8','CADEADO CORRENTE ARMARIO DISTRIBUICAO','U','82.93','','','',NULL),(245,'0219-0028-0','FIO ESPINAR ISOLADO REFORCADO FEIR-125MM','ROL','26.17','','','',NULL),(246,'0230-0031-7','TAMPAO DUTO VAGO TDV-PVC 100/PEAD 110MM','U','15.61','','','',NULL),(247,'0241-0035-8','TERMINAL CONEXAO TESTE ATERRAMENTO-TCTA1','U','56.14','','','',NULL),(248,'0251-0001-7','FIO TELEF EXTERNO FE-AA-80 PEAD-X','M','0.32','','','',NULL),(249,'0252-0015-1','CABO TEL CTP-APL 40-  50 COM PAR PILOTO','M','3.56','','','',NULL),(250,'0252-0023-2','CABO TEL CTP-APL 40- 900 COM PAR PILOTO','M','72.69','','','',NULL),(251,'0252-0032-1','CABO TEL CTP-APL 50-  30 COM PAR PILOTO','M','3.3','','','',NULL),(252,'0256-0046-0','SUPORTE DIELETRICO CABO OPTICO 11 A 19MM','U','12.41','','','',NULL),(253,'0256-0230-6','ALCA PLASTICA P/ FIO FEB-65 E FE-AA-80','U','0.69','','','',NULL),(254,'0256-0231-4','LACO PRE-FORMADO P/FIO FEB-65 E FE-AA-80','U','0.22','','','',NULL),(255,'0256-0234-9','LACO PREFORM P/ DROP OPT ASU ATE 12 FO','U','1.42','','','',NULL),(256,'0256-0239-0','ALCA PREF P/CFOA-SM-AS-36-S COMPACTO','U','6.2','','','',NULL),(257,'0256-0240-3','LACO PREF P/CFOA-SM-AS-36-S COMPACTO','U','3.1','','','',NULL),(258,'0258-0020-5','BLOCO DG CONT CILIN NF CJ 100 PARES REDE','U','150.69','','','',NULL),(259,'0258-0023-0','BLOCO DG CONT CILIN NF CJ 600 PARES','U','835.15','','','',NULL),(260,'0258-0027-2','CONJ EMENDA OPTICA SUBT ACES 144 F.O.','CJ','588.19','','','',NULL),(262,'0258-0069-8','ARMARIO DISTR ALUMINIO ARD-AL 14PEDESTAL','U','1573.41','','','',NULL),(263,'0258-0140-6','BLOCO TERM BER-10 COMPACTO BASTID CILIND','U','8.57','','','',NULL),(264,'0258-0143-0','SUPORTE PERFIL CILINDRICO 600P BL BER-10','U','76.54','','','',NULL),(265,'0258-0144-9','BLOCO TERM BER-10 NA BASTIDOR CILINDRICO','U','16.32','','','',NULL),(266,'0258-0149-0','SUPORTE PERFIL CILINDRICO 50P BL BER-10','U','39.97','','','',NULL),(267,'0258-0163-5','PONTO TERMINAL DE REDE-OPTICO (PTR-O)','U','15.79','','','',NULL),(268,'0260-0030-0','CONECTOR TOPO UNIVER EMENDA DERIVA UP-3','U','0.11','','','',NULL),(269,'0260-0031-8','CONECTOR TOPO UNIVER EMENDA DIRETA UP-2','U','0.06','','','',NULL),(270,'0260-0032-6','CONJUNTO EMENDA MECANICA CEPM-4','U','464.74','','','',NULL),(271,'0260-0033-4','CONJUNTO EMENDA MECANICA CEPM-3','U','476.06','','','',NULL),(272,'0260-0035-0','CONJUNTO EMENDA MECANICA CEPM-1','U','336.53','','','',NULL),(273,'0260-0044-0','CONECTOR TOPO EMENDA SANGRIA UPD IMPREG','U','0.14','','','',NULL),(274,'0260-0077-6','CONECTOR MODULAR 25 P EMENDA DIRETA','U','3.94','','','',NULL),(275,'0260-0093-8','CONJUNTO BLOQUEIO PRESSAO ENFAIX CBP-II','CJ','19.95','','','',NULL),(276,'0260-0094-6','CONJUNTO BLOQUEIO PRESSAO ENFAIX CBP-III','CJ','24.76','','','',NULL),(277,'0260-0095-4','RESINA BLOQUEIO PRESSURIZACAO E UMIDADE','U','16.49','','','',NULL),(278,'0260-0122-5','CONJ EMENDA AEREA NAO SELADA CEANS 200','CJ','16.7','','','',NULL),(279,'0260-0123-3','CONECTOR MODULAR 25 P EMENDA DERIVADA','U','2.54','','','',NULL),(280,'0260-0136-5','CONECTOR PICABOND UNIVERSAL VERDE','U','0.25','','','',NULL),(281,'0260-0142-0','CONECTOR PICABOND  AZUL','U','0.23','','','',NULL),(282,'0260-0193-4','MANTA TERMOCONTRATIL TIPO 1 15 A 35MM','CJ','39.19','','','',NULL),(283,'0260-0202-7','DISCO FECHAMENTO LATERAL CEPM1','U','85.2','','','',NULL),(284,'0260-0203-5','DISCO FECHAMENTO LATERAL CEPM4','U','111.2','','','',NULL),(285,'0260-0204-3','DISCO FECHAMENTO LATERAL CEPM3','U','111.25','','','',NULL),(286,'0260-0205-1','DISCO FECHAMENTO LATERAL CEPM2','U','73.86','','','',NULL),(287,'0260-0209-4','TAMPAO DUTO OCUPADO (RESINA)','CJ','28.61','','','',NULL),(288,'0260-0217-5','CONJ EMENDA E TERMINAL ACESSO-CERTA 10P','CJ','57.34','','','',NULL),(289,'0260-0218-3','CONJ EMENDA E TERMINAL ACESSO-CERTA 20P','CJ','99.87','','','',NULL),(290,'0319-0084-4','BASTIDOR P/15 BLOCOS C/CONECT BLINDAGEM','U','8.22','','','',NULL),(291,'0341-0028-8','MODULO PROT C/BARRA TERRA BL BER-10 NA','CX','33.14','','','',NULL),(292,'0345-0014-6','TRANSDUTOR PRESSAO INTERNO TPI','U','404.29','','','',NULL),(293,'0351-0019-2','FIO TELEF FDG-60-2 PRETO E BRANCO','M','0.16','','','',NULL),(294,'0351-0021-4','FIO TELEF FDG-50-2 PRETO E LARANJA','M','0.12','','','',NULL),(295,'0351-0024-9','FIO TELEF FDG-60-2 VERMELHO E BRANCO','M','0.16','','','',NULL),(296,'0358-0013-5','MODULO PROT MP-R BL CONT CILINDRICO','U','6.22','','','',NULL),(297,'0358-0023-2','BLOCO TERMINAL INTERNO 10 PARES BLI-10','U','0.77','','','',NULL),(298,'0358-0054-2','TAMPA ADAPTADORA','U','0.03','','','',NULL),(299,'0380-8798-7','DROP OPT COMP INT CFOI-SM-CM-1-BA-LSZH','M','1.01','','','',NULL),(300,'0380-8805-3','CTOP 8 CABO DROP COM SPLITTER 1:8','U','403.12','','','',NULL),(301,'0380-8933-5','PTO CONECTORIZADO PTO-C FTTH','U','5.9','','','',NULL),(302,'0380-8934-3','CONECTOR OPT FAC SC/APC DROP FIG8 COMPAC','U','11.85','','','',NULL),(303,'0380-8935-1','CTO CONECT DE POSTE COM SPLITTER 1 8','U','400.74','','','',NULL),(304,'0386-0548-1','SUB-BASTIDOR 12 FO BEO-DIO 1 U E 19','U','99.31','','','',NULL),(305,'0386-0549-0','PIG TAIL FIBRA SM COMP 3M CONECTOR SC/PC','U','7.02','','','',NULL),(306,'0386-1115-5','BASTIDOR PARA DGO DE CENTRAL TELEFONICA','U','1571.14','','','',NULL),(307,'0386-1249-6','BASTIDOR DISTR. GERAL OPT DGO MOD. DG600','U','20441.48','','','',NULL),(308,'0387-0033-6','ANTENA PARABOLICA RECEPT 60CM DTH CMD','U','36.59','','','',NULL),(309,'0387-0037-9','CABO COAXIAL RG6 BRANCO DTH CMD','M','0.51','','','',NULL),(310,'0387-0041-7','SET TOP BOX TECNOTREND S271 DTH CMD','U','0.01','','','',NULL),(311,'0387-0042-5','SMART CARD DTH CMD','U','31','','','',NULL),(312,'0387-0043-3','SPLITTER 1:2 PASS-RESIDENCIAL-CMD','U','3.24','','','',NULL),(313,'0387-0051-4','SET TOP BOX IPTV QUANTENA LOW COST CISCO','U','299.25','','','',NULL),(314,'0387-0056-5','SET TOP BOX ECHOSTAR DSB626BR/ECDB636BR','U','5.32','','','',NULL),(315,'0387-0066-2','SPLITTER1:4 4SAIDAS OUt PASSG.DC-DTH.CMD','U','3.71','','','',NULL),(316,'0387-0077-8','SET TOP BOX ZINWELL ZDX 7510NA DTH CMD','U','0.5','','','',NULL),(317,'0387-0114-6','SET TOP BOX HD DTH LOW COST SAGEM','U','R$ -','','','',NULL),(318,'0387-0141-3','CONECTOR COMPRESSAO TP F RG6 MACHO DTH','U','0.62','','','',NULL),(319,'0387-0144-8','SET TOP BOX HD - DTH','U','167.04','','','',NULL),(320,'0387-0150-2','SET TOP BOX SD DTH LOW COST','U','124.75','','','',NULL),(321,'0387-0165-0','SET TOP BOX SD DTH LOW COST ECHOSTAR','U','2.24','','','',NULL),(322,'0387-0167-7','SET TOP BOX SD DTH LOW COST EASYDIGITAL]','U','R$ -','','','',NULL),(323,'0387-0170-7','SET TOP BOX HD PVR - IPTV CISCO','U','478.95','','','',NULL),(324,'0391-0578-4','TERM. REDE OPTICA ONT ALCATEL I-240G-P','U','20.82','','','',NULL),(325,'0392-1051-0','SPLITTER RESISTIVO 1:2','U','3.42','','','',NULL),(326,'0392-1052-9','SPLITTER RESISTIVO 1:4','U','4.38','','','',NULL),(327,'0430-0003-7','SUBDUTO AGRUPADO SDA4 POLIETILENO','M','6.73','','','',NULL),(328,'0430-0006-1','SUBDUTO SINGELO LISO POLIETILENO','M','1.03','','','',NULL),(329,'0452-0002-5','CABO FO CFOA-SM-DD-S-12 - TS','M','1.74','','','',NULL),(330,'0452-0004-1','CABO FO CFOA-SM-DD-G-144','M','10.34','','','',NULL),(331,'0452-0013-0','CABO FO CFOA-SM-AS-080-G-36','M','3.3','','','',NULL),(332,'0452-0015-7','CABO FO CFOA-SM-DD-G-48','M','3.72','','','',NULL),(333,'0452-0020-3','CABO FO CFOA-SM-DD-S-36 - TS','M','3.29','','','',NULL),(334,'0452-0022-0','CABO FO CFOA-SM-DD-S-72 - TS','M','5.17','','','',NULL),(335,'0452-0046-7','CABO FO CFOA-SM-DD-G-36','M','3.03','','','',NULL),(336,'0452-0047-5','CABO FO CFOA-SM-DD-G-24','M','2.37','','','',NULL),(337,'0452-0049-1','CABO FO CFOA-SM-DD-G-12','M','1.63','','','',NULL),(338,'0452-0056-4','CABO FO CFOA-SM-AS-080-G-12','M','2.13','','','',NULL),(339,'0452-0060-2','CABO FO CFOA-SM-AS-080-G-24','M','3','','','',NULL),(340,'0452-0061-0','CABO FO CFOA-SM-DD-G-72','M','5.32','','','',NULL),(341,'0452-0093-9','CABO FO CFOI-BLI-UB 24 LSZH MICROMODULO','M','3.25','','','',NULL),(342,'0452-0094-7','CABO FO CFOI-BLI-UB 48 LSZH MICROMODULO','M','6.18','','','',NULL),(343,'0452-0097-1','CABO FO CFOI-SM-UB-36 DIF','M','3.94','','','',NULL),(344,'0452-0107-2','CFOA-SM-AS80 MINI-RA 12F NR','M','1.25','','','',NULL),(345,'0452-0108-0','CFOA-SM-AS80-S 36F NR (COMPACTO)','M','2.9','','','',NULL),(346,'0456-0018-0','CONJ ANCORAGEM CABO FO VAO 80M ATE 36FO','U','6.57','','','',NULL),(347,'0456-0022-8','CONJ ANCORAGEM CABO FO VAO 200M ATE 12FO','U','10.71','','','',NULL),(348,'0456-0027-2','CONJ EMEN CABO OPT AEREO SUBT 12 A 24 FO','CJ','124.92','','','',NULL),(349,'0456-0028-3','CONJ EMEN CABO OPT AEREO SUBT 36 A 48 FO','CJ','134.29','','','',NULL),(350,'0456-0029-4','CONJ EMEN CABO OPT AEREO SUBT 60 A 72 FO','CJ','143.62','','','',NULL),(352,'0458-0011-1','CTO-CAIXA DE TERMINACAO OPT. DE FACHADA','U','353.9','','','',NULL),(353,'0460-0009-7','CONJ EMENDA OPTICA SUBT TRONCO 144 F.O.','U','366.21','','','',NULL),(354,'0460-0011-9','CONJUNTO EMENDA CABO OPTICO AEREO 72 FO','U','164.26','','','',NULL),(355,'0460-0012-7','CONJUNTO EMENDA CABO OPTICO AEREO 36 FO','U','149.99','','','',NULL),(356,'0460-0013-5','CONJUNTO EMENDA CABO OPTICO SUBT 12 FO','U','181.49','','','',NULL),(357,'0460-0014-3','CONJUNTO EMENDA CABO OPTICO AEREO 48 FIB','U','163.7','','','',NULL),(358,'0460-0015-1','CONJUNTO EMENDA CABO OPTICO SUBT 24 FO','U','173.42','','','',NULL),(359,'0460-0016-0','CONJUNTO EMENDA CABO OPTICO SUBT 48 FO','U','194.8','','','',NULL),(360,'0460-0017-8','CONJUNTO EMENDA CABO OPTICO AEREO 24 FO','U','139.67','','','',NULL),(361,'0460-0021-6','CONJUNTO EMENDA CABO OPTICO AEREO 12 FIB','U','143.49','','','',NULL),(362,'0460-0022-4','CONJUNTO EMENDA CABO OPTICO SUBT 36 FO','U','182.69','','','',NULL),(363,'0460-0023-2','CONJUNTO EMENDA CABO OPTICO SUBT 72 FO','U','180.79','','','',NULL),(364,'0460-0034-8','KIT DERIVACAO REXTEL MODELO UCAO','U','22.01','','','',NULL),(365,'0460-0035-6','KIT DERIVACAO QUADRAC MODELO CEO-Q','U','15.24','','','',NULL),(366,'0460-0038-0','KIT DERIVACAO TYCO MODELO FOSC 100-BM','U','19.18','','','',NULL),(367,'0460-0039-9','KIT DERIVACAO TYCO MODELO FIST-TAP','U','10.13','','','',NULL),(368,'0460-0042-9','CTOS- CX TERM OPT SUBT P/ COND. RESID','U','179.58','','','',NULL),(369,'0460-0043-7','KIT DERIVACAO ETK MODELO SOFS-12/72 FO','U','23.25','','','',NULL),(370,'0486-0053-9','DROP OPT PREC ROC CONECT OPTITAP 300 M','U','233.23','','','',NULL),(371,'0056-0003-0','ALCA PREFORM P/ DROP OPT ASU ATE 12 FO','U','4.72',NULL,NULL,NULL,NULL);
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

-- Dump completed on 2016-03-31 17:57:00
