-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: organik
-- ------------------------------------------------------
-- Server version	8.0.28

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tablo_ayarlar`
--

DROP TABLE IF EXISTS `tablo_ayarlar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tablo_ayarlar` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Resim1` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Resim2` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Resim3` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Baslik` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Aciklama` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Metalar` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tablo_blog`
--

DROP TABLE IF EXISTS `tablo_blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tablo_blog` (
  `ID` int NOT NULL,
  `Resim` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `BuyukResim` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Baslik` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `KisaBilgi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Detay` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Tarih` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `SiraNo` int DEFAULT NULL,
  `Anasayfa` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `AnasayfaSabit` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Slider` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Kategori` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tablo_danismanlar`
--

DROP TABLE IF EXISTS `tablo_danismanlar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tablo_danismanlar` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Resim` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Baslik` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Unvan` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Veri1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Veri2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Veri3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Veri4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Veri5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Veri6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `SiraNo` int DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tablo_ebulten`
--

DROP TABLE IF EXISTS `tablo_ebulten`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tablo_ebulten` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `KayitTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tablo_haberler`
--

DROP TABLE IF EXISTS `tablo_haberler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tablo_haberler` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Resim` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `BuyukResim` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Baslik` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `KisaBilgi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Detay` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Tarih` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `SiraNo` int DEFAULT NULL,
  `Anasayfa` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `AnasayfaSabit` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Slider` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Kategori` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tablo_hizmetler`
--

DROP TABLE IF EXISTS `tablo_hizmetler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tablo_hizmetler` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Resim` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ResimBuyuk` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Resim2` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Resim3` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Resim2Hover` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Baslik` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Baslik2` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Veri1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Veri2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Veri3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Veri4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Veri5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Veri6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Veri7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Veri8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Veri9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Veri10` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Veri11` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Veri12` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `BaslikTab1` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `BaslikTab2` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `BaslikTab3` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `BaslikTab4` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `BaslikTab5` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `SiraNo` int DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tablo_iletisim`
--

DROP TABLE IF EXISTS `tablo_iletisim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tablo_iletisim` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `AdiSoyadi` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telefon` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Adres` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Konu` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Mesaj` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `KayitTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Okundu` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2211 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tablo_iletisim_bilgileri`
--

DROP TABLE IF EXISTS `tablo_iletisim_bilgileri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tablo_iletisim_bilgileri` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Adres` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Adres2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `TelNo` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `FaxNo` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Facebook` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Twitter` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Youtube` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Instagram` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Linkedin` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Whatsapp` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Maps` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Maps2` text CHARACTER SET utf8 COLLATE utf8_turkish_ci,
  `Resim` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tablo_login`
--

DROP TABLE IF EXISTS `tablo_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tablo_login` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `Unvan` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Adi` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Soyadi` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Telefon` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Parola` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `KayitTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Resim` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Hakkimda` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Facebook` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Twitter` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Instagram` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Youtube` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tablo_metinler`
--

DROP TABLE IF EXISTS `tablo_metinler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tablo_metinler` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Metin0` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Metin1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Metin2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Metin3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Metin4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Metin5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Metin6` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Metin7` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Metin8` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Metin9` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Metin10` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Metin11` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Metin12` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Metin13` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Metin14` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Metin15` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tablo_referanslar`
--

DROP TABLE IF EXISTS `tablo_referanslar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tablo_referanslar` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Resim` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Resim2` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Baslik` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `SiraNo` int DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tablo_sayfalar`
--

DROP TABLE IF EXISTS `tablo_sayfalar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tablo_sayfalar` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Resim` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Baslik` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `KisaBilgi` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `Detay` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `SiraNo` int DEFAULT NULL,
  `Link` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tablo_slider`
--

DROP TABLE IF EXISTS `tablo_slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tablo_slider` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Resim` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Icon` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Baslik` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '#',
  `Baslik2` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Link` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Detay` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `SiraNo` int DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tablo_url`
--

DROP TABLE IF EXISTS `tablo_url`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tablo_url` (
  `UrlID` int NOT NULL AUTO_INCREMENT,
  `Link` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Sayfa` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ID` int DEFAULT NULL,
  `Title` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Description` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`UrlID`)
) ENGINE=MyISAM AUTO_INCREMENT=1594 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping events for database 'organik'
--

--
-- Dumping routines for database 'organik'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-16 11:44:07
