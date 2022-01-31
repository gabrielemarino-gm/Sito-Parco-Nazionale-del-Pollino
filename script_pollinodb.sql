CREATE DATABASE  IF NOT EXISTS `pollinodb` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `pollinodb`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: pollinodb
-- ------------------------------------------------------
-- Server version	5.7.28

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
-- Table structure for table `articoli`
--

DROP TABLE IF EXISTS `articoli`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articoli` (
  `idarticoli` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(100) DEFAULT NULL,
  `testo_articolo` longtext,
  `data_articolo` datetime DEFAULT NULL,
  `scrittore` varchar(45) DEFAULT NULL,
  `img_path_articolo` varchar(100) DEFAULT NULL,
  `valido` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idarticoli`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articoli`
--

LOCK TABLES `articoli` WRITE;
/*!40000 ALTER TABLE `articoli` DISABLE KEYS */;
INSERT INTO `articoli` VALUES (5,'Sgombero neve nell’area del Pollino','Sono 84mila euro le somme stanziate nel bilancio di previsione 2022 in dotazione ai comuni che hanno partecipato al bando del Parco nazionale del Pollino in merito al servizio di sgombero neve sulle strade di alta montagna.\r\n\r\nLe somme stanziate dall’Ente costituiscono, da diversi anni, una strategia per sostenere il turismo invernale e contribuire alla viabilità in sicurezza delle zone montane e i collegamenti tra comuni delle aree interne.\r\n\r\n«Una strategia che da sempre ci vede impegnati in prima linea per evitare i disagi nel periodo invernale e sostenere i comuni nell’azione di pulizia delle strade nel periodo invernale con il servizio di sgombero neve e spargimento sale sulle arterie di montagna» sottolinea il presidente Domenico Pappaterra, diventata negli anni un esempio a livello nazionale.\r\n\r\nIn particolare quest’anno sono 16 comuni che hanno presentato domanda di finanziamento entro i termini previsti dal bando ad evidenza pubblica del Parco nazionale del Pollino, di cui 14 le municipalità che riceveranno le somme messe a disposizione dall’area protetta calabro','2022-01-31 11:36:40','gabriele','../foto/articoli/5',0),(8,'Sgombero neve nell’area del Pollino','Sono 84mila euro le somme stanziate nel bilancio di previsione 2022 in dotazione ai comuni che hanno partecipato al bando del Parco nazionale del Pollino in merito al servizio di sgombero neve sulle strade di alta montagna.\r\n\r\nLe somme stanziate dall’Ente costituiscono, da diversi anni, una strategia per sostenere il turismo invernale e contribuire alla viabilità in sicurezza delle zone montane e i collegamenti tra comuni delle aree interne.','2022-01-31 15:42:06','cicciovarca','../foto/articoli/8',1),(9,'Parco del Pollino, cosa vedere tra natura e borghi','Il Parco Nazionale del Pollino si estende ai confini fra la Basilicata, l’antica Lucania e la Calabria. Comprende un massiccio montuoso che dal mar Tirreno giunge fino allo Ionio, interessando circa duecento mila ettari di superficie. Sul versante lucano, meta del nostro viaggio, le montagne presentano un’altitudine oscillante fra i mille e i duemila metri.','2022-01-31 21:52:13','cicciovarca','../foto/articoli/9',1);
/*!40000 ALTER TABLE `articoli` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commenti`
--

DROP TABLE IF EXISTS `commenti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commenti` (
  `idcommenti` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` varchar(45) NOT NULL,
  `testo_commento` longtext NOT NULL,
  `data_commento` datetime NOT NULL,
  `username` varchar(45) NOT NULL,
  PRIMARY KEY (`idcommenti`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commenti`
--

LOCK TABLES `commenti` WRITE;
/*!40000 ALTER TABLE `commenti` DISABLE KEYS */;
INSERT INTO `commenti` VALUES (1,'65','Bellissima','2022-01-30 10:32:31','gabriele'),(2,'65','Piumaaa :)','2022-01-30 10:32:53','cicciovarca'),(3,'65','Ciao','2022-01-30 11:36:33','gabriele'),(4,'44','Bellissimo','2022-01-31 09:28:50','gabriele'),(7,'64','Buongiorno a te!','2022-01-31 14:18:51','franceska'),(8,'64','Ciao','2022-01-31 14:22:52','franceska'),(9,'58','Ciao','2022-01-31 21:04:27','gabriele');
/*!40000 ALTER TABLE `commenti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventi`
--

DROP TABLE IF EXISTS `eventi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `eventi` (
  `ideventi` int(11) NOT NULL AUTO_INCREMENT,
  `nome_evento` varchar(100) DEFAULT NULL,
  `luogo` varchar(45) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `descrizione` longtext,
  `organizzatore` varchar(45) DEFAULT NULL,
  `img_path` varchar(100) DEFAULT NULL,
  `data_caricamento` datetime DEFAULT NULL,
  `ora` int(11) DEFAULT NULL,
  `minuti` int(11) DEFAULT NULL,
  PRIMARY KEY (`ideventi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventi`
--

LOCK TABLES `eventi` WRITE;
/*!40000 ALTER TABLE `eventi` DISABLE KEYS */;
INSERT INTO `eventi` VALUES (1,'Camminata nel bosco','Colle Dell\'Impiso','2022-02-05','Camminata all\'interno di un sentiero per principianti, per raggiungere il piano di Vaquarro partendo da Colle Dell\'Impiso','gabriele','../foto/eventi/1','2022-01-31 21:35:24',10,30);
/*!40000 ALTER TABLE `eventi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guide_da_validare`
--

DROP TABLE IF EXISTS `guide_da_validare`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guide_da_validare` (
  `id_guida_da_validare` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `cognome` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `non_validata` int(11) NOT NULL,
  PRIMARY KEY (`id_guida_da_validare`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guide_da_validare`
--

LOCK TABLES `guide_da_validare` WRITE;
/*!40000 ALTER TABLE `guide_da_validare` DISABLE KEYS */;
INSERT INTO `guide_da_validare` VALUES (2,'Simone','Sallorenzo','simonesallorenzo@pollino.it','sallorenzocondueelle','$2y$10$GdSeT1/36V8IzD7xTyYjWO9tJeTNU//fWdUi.d3lQsPXCrNpASFgG',1),(3,'Lucia','Minervino','luciaminervino@pollino.it','lucia','$2y$10$a2pQZ6jjPH0vQ/Fs.rIK0.dA.M9huf/Ur/zEKehsXQukFv4ULoei6',1),(4,'Alessio','Stigliano','alessiostigliano@theshow.it','alessiodeitheshow','$2y$10$ZiDyW3dG9VwCPSeFUAolDeHPmcuqM24.LF5kVvhsecXsM4hd58kny',1),(5,'Alessio','Ancona','alessioancona@roma.it','alessio','$2y$10$wGfU6pQ5Iw0GfTD7TvlYWOjkr2xtWmKasBMejgwmobN/gwbOHutq2',0),(6,'Gianluca','Milano','gianlucamilano@milano.com','gianluca','$2y$10$JsGPLaScq6IDoqIkLllutO5dSOPRnmaRJUfsByl/4IJkTom9.9IU2',0);
/*!40000 ALTER TABLE `guide_da_validare` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `iscrizione_evento`
--

DROP TABLE IF EXISTS `iscrizione_evento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `iscrizione_evento` (
  `idiscrizione_evento` int(11) NOT NULL AUTO_INCREMENT,
  `idevento` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idiscrizione_evento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iscrizione_evento`
--

LOCK TABLES `iscrizione_evento` WRITE;
/*!40000 ALTER TABLE `iscrizione_evento` DISABLE KEYS */;
INSERT INTO `iscrizione_evento` VALUES (1,4,'gabriele'),(2,1,'cicciovarca'),(3,1,'nikolas');
/*!40000 ALTER TABLE `iscrizione_evento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mi_piace`
--

DROP TABLE IF EXISTS `mi_piace`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mi_piace` (
  `idmi_piace` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  PRIMARY KEY (`idmi_piace`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mi_piace`
--

LOCK TABLES `mi_piace` WRITE;
/*!40000 ALTER TABLE `mi_piace` DISABLE KEYS */;
INSERT INTO `mi_piace` VALUES (1,64,'franceska'),(2,58,'gabriele'),(3,57,'gabriele'),(4,64,'admin'),(6,65,'admin');
/*!40000 ALTER TABLE `mi_piace` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `idpost` int(11) NOT NULL AUTO_INCREMENT,
  `testo` longtext,
  `data` datetime DEFAULT NULL,
  `img_path` varchar(100) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idpost`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (18,'Ciao Amici del Pollino, questo è il mio primo post!','2022-01-28 16:22:52',NULL,'gabriele'),(44,'Nuove foto dal Pollino!','2022-01-28 22:22:56','../foto/post/44','gabriele'),(47,'Oggi Stelle sul Pollino','2022-01-29 12:53:27','../foto/post/47','gabriele'),(49,'Ciao, da Novacco tutto bene!','2022-01-29 15:48:31','../foto/post/49','gabriele'),(59,'Ciao amici del Pollino!','2022-01-29 17:03:03',NULL,'cicciovarca'),(64,'Buongiorno','2022-01-29 19:47:21','../foto/post/64','Nicolass'),(65,'Il mio cane si diverte un mondo!','2022-01-29 19:57:48','../foto/post/65','franceska');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_da_validare`
--

DROP TABLE IF EXISTS `post_da_validare`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_da_validare` (
  `idpost_da_validare` int(11) NOT NULL AUTO_INCREMENT,
  `testo` longtext,
  `data` datetime DEFAULT NULL,
  `img_path` varchar(100) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idpost_da_validare`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_da_validare`
--

LOCK TABLES `post_da_validare` WRITE;
/*!40000 ALTER TABLE `post_da_validare` DISABLE KEYS */;
INSERT INTO `post_da_validare` VALUES (3,'Sei buono a nulla','2022-01-31 22:08:09','','gabriele');
/*!40000 ALTER TABLE `post_da_validare` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utenti`
--

DROP TABLE IF EXISTS `utenti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utenti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  `guida` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `cognome` varchar(45) NOT NULL,
  `admin` int(10) unsigned zerofill NOT NULL DEFAULT '0000000000',
  `imgPath` varchar(100) DEFAULT NULL,
  `data_nascita` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utenti`
--

LOCK TABLES `utenti` WRITE;
/*!40000 ALTER TABLE `utenti` DISABLE KEYS */;
INSERT INTO `utenti` VALUES (46,'gabriele','$2y$10$ArK6GMVB9foyYa54irQK3ehveMITQE6TDCH0.FDu2DBuGWdUUEAfa','marinogabriele@pollino.it',1,'Gabriele','Marino',0000000000,'../foto/profilo/gabriele.png','0000-00-00'),(47,'admin','$2y$10$yJVCOGcnhxk6URR7peKBGuk6QxUBMRg/7x2sNV1zVJQD0vTJ5xK3G','admindelpollino@pollino.it',0,'Admin','Admin',0000000001,'../foto/profilo/default.png','0000-00-00'),(54,'cicciovarca','$2y$10$PMxqng/2kwtDxSF0StabIu9qOI8bB9sUT90BZKEDqvueytr09PF0m','francescovarcasia@pollino.it',1,'Francesco','Varcasia',0000000000,'../foto/profilo/cicciovarca.png','0000-00-00'),(55,'nikolas','$2y$10$pcuaaR011Z4KoKGF9Yui/eRe4eoi.Bv6ShDoogkaG1JE6PVUGc7Yy','nicolascrescente@pollino.it',0,'Nicolas','Crescente',0000000000,'../foto/profilo/nikolas.png','0000-00-00'),(56,'Nicolass','$2y$10$E1mkG3LF0PAJ33cxBLcgGeOtDrgq4.gYirL9iMIr/oh7zX/SNgVjK','marinonicolaantonio@gmail.com',0,'Nicola','Marino',0000000000,'../foto/profilo/default.png','0000-00-00'),(57,'franceska','$2y$10$d1kl5TBZEzsHZCbiL3in.OMrOltNcz9x9OnuIQGmwAbeqDf.pUQLS','francescamarino@gmail.com',0,'Francesca','Marino',0000000000,'../foto/profilo/franceska.png','0000-00-00'),(58,'fede','$2y$10$k4mBIGXUdkZp0a7DrZO6H.eB10QRhSGBmCtBDOUinYji35BILKByu','federicadonnici@castrovillari.com',0,'Federica','Donnici',0000000000,'../foto/profilo/default.png','0000-00-00');
/*!40000 ALTER TABLE `utenti` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-31 22:09:05
