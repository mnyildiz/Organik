-- Organik TR/EN/DE content migration
-- Run only after taking a full database backup.
-- Existing Turkish tables and rows are not modified.

SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS `tablo_ayarlar_ceviri` (
  `CeviriID` int NOT NULL AUTO_INCREMENT,
  `KayitID` int NOT NULL,
  `DilKodu` char(2) NOT NULL,
  `Baslik` text,
  `Aciklama` text,
  `YayinDurumu` tinyint(1) NOT NULL DEFAULT 0,
  `GuncellemeTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CeviriID`),
  UNIQUE KEY `uq_ayarlar_ceviri` (`KayitID`,`DilKodu`),
  KEY `ix_ayarlar_ceviri_dil` (`DilKodu`,`YayinDurumu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `tablo_blog_ceviri` (
  `CeviriID` int NOT NULL AUTO_INCREMENT,
  `KayitID` int NOT NULL,
  `DilKodu` char(2) NOT NULL,
  `Baslik` varchar(250) DEFAULT NULL,
  `KisaBilgi` text,
  `Detay` longtext,
  `Kategori` varchar(100) DEFAULT NULL,
  `YayinDurumu` tinyint(1) NOT NULL DEFAULT 0,
  `GuncellemeTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CeviriID`),
  UNIQUE KEY `uq_blog_ceviri` (`KayitID`,`DilKodu`),
  KEY `ix_blog_ceviri_dil` (`DilKodu`,`YayinDurumu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `tablo_haberler_ceviri` (
  `CeviriID` int NOT NULL AUTO_INCREMENT,
  `KayitID` int NOT NULL,
  `DilKodu` char(2) NOT NULL,
  `Baslik` varchar(250) DEFAULT NULL,
  `KisaBilgi` text,
  `Detay` longtext,
  `Kategori` varchar(100) DEFAULT NULL,
  `YayinDurumu` tinyint(1) NOT NULL DEFAULT 0,
  `GuncellemeTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CeviriID`),
  UNIQUE KEY `uq_haberler_ceviri` (`KayitID`,`DilKodu`),
  KEY `ix_haberler_ceviri_dil` (`DilKodu`,`YayinDurumu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `tablo_danismanlar_ceviri` (
  `CeviriID` int NOT NULL AUTO_INCREMENT,
  `KayitID` int NOT NULL,
  `DilKodu` char(2) NOT NULL,
  `Baslik` varchar(250) DEFAULT NULL,
  `Unvan` varchar(250) DEFAULT NULL,
  `Veri1` longtext,
  `Veri2` longtext,
  `Veri3` longtext,
  `Veri4` longtext,
  `Veri5` longtext,
  `Veri6` longtext,
  `YayinDurumu` tinyint(1) NOT NULL DEFAULT 0,
  `GuncellemeTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CeviriID`),
  UNIQUE KEY `uq_danismanlar_ceviri` (`KayitID`,`DilKodu`),
  KEY `ix_danismanlar_ceviri_dil` (`DilKodu`,`YayinDurumu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `tablo_hizmetler_ceviri` (
  `CeviriID` int NOT NULL AUTO_INCREMENT,
  `KayitID` int NOT NULL,
  `DilKodu` char(2) NOT NULL,
  `Baslik` varchar(250) DEFAULT NULL,
  `Baslik2` varchar(250) DEFAULT NULL,
  `Veri1` longtext,
  `Veri2` longtext,
  `Veri3` longtext,
  `Veri4` longtext,
  `Veri5` longtext,
  `Veri6` longtext,
  `Veri7` longtext,
  `Veri8` longtext,
  `Veri9` longtext,
  `Veri10` longtext,
  `Veri11` longtext,
  `Veri12` longtext,
  `BaslikTab1` varchar(250) DEFAULT NULL,
  `BaslikTab2` varchar(250) DEFAULT NULL,
  `BaslikTab3` varchar(250) DEFAULT NULL,
  `BaslikTab4` varchar(250) DEFAULT NULL,
  `BaslikTab5` varchar(250) DEFAULT NULL,
  `YayinDurumu` tinyint(1) NOT NULL DEFAULT 0,
  `GuncellemeTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CeviriID`),
  UNIQUE KEY `uq_hizmetler_ceviri` (`KayitID`,`DilKodu`),
  KEY `ix_hizmetler_ceviri_dil` (`DilKodu`,`YayinDurumu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `tablo_metinler_ceviri` (
  `CeviriID` int NOT NULL AUTO_INCREMENT,
  `KayitID` int NOT NULL,
  `DilKodu` char(2) NOT NULL,
  `Metin0` longtext,
  `Metin1` longtext,
  `Metin2` longtext,
  `Metin3` longtext,
  `Metin4` longtext,
  `Metin5` longtext,
  `Metin6` longtext,
  `Metin7` longtext,
  `Metin8` longtext,
  `Metin9` longtext,
  `Metin10` longtext,
  `Metin11` longtext,
  `Metin12` longtext,
  `Metin13` longtext,
  `Metin14` longtext,
  `Metin15` longtext,
  `YayinDurumu` tinyint(1) NOT NULL DEFAULT 0,
  `GuncellemeTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CeviriID`),
  UNIQUE KEY `uq_metinler_ceviri` (`KayitID`,`DilKodu`),
  KEY `ix_metinler_ceviri_dil` (`DilKodu`,`YayinDurumu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `tablo_slider_ceviri` (
  `CeviriID` int NOT NULL AUTO_INCREMENT,
  `KayitID` int NOT NULL,
  `DilKodu` char(2) NOT NULL,
  `Baslik` varchar(1000) DEFAULT NULL,
  `Baslik2` varchar(250) DEFAULT NULL,
  `Detay` longtext,
  `Link` varchar(500) DEFAULT NULL,
  `YayinDurumu` tinyint(1) NOT NULL DEFAULT 0,
  `GuncellemeTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CeviriID`),
  UNIQUE KEY `uq_slider_ceviri` (`KayitID`,`DilKodu`),
  KEY `ix_slider_ceviri_dil` (`DilKodu`,`YayinDurumu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `tablo_referanslar_ceviri` (
  `CeviriID` int NOT NULL AUTO_INCREMENT,
  `KayitID` int NOT NULL,
  `DilKodu` char(2) NOT NULL,
  `Baslik` varchar(250) DEFAULT NULL,
  `YayinDurumu` tinyint(1) NOT NULL DEFAULT 0,
  `GuncellemeTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CeviriID`),
  UNIQUE KEY `uq_referanslar_ceviri` (`KayitID`,`DilKodu`),
  KEY `ix_referanslar_ceviri_dil` (`DilKodu`,`YayinDurumu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `tablo_iletisim_bilgileri_ceviri` (
  `CeviriID` int NOT NULL AUTO_INCREMENT,
  `KayitID` int NOT NULL,
  `DilKodu` char(2) NOT NULL,
  `Adres` longtext,
  `Adres2` longtext,
  `YayinDurumu` tinyint(1) NOT NULL DEFAULT 0,
  `GuncellemeTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CeviriID`),
  UNIQUE KEY `uq_iletisim_bilgileri_ceviri` (`KayitID`,`DilKodu`),
  KEY `ix_iletisim_bilgileri_ceviri_dil` (`DilKodu`,`YayinDurumu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `tablo_sayfalar_ceviri` (
  `CeviriID` int NOT NULL AUTO_INCREMENT,
  `KayitID` int NOT NULL,
  `DilKodu` char(2) NOT NULL,
  `Baslik` varchar(250) DEFAULT NULL,
  `KisaBilgi` longtext,
  `Detay` longtext,
  `Link` varchar(500) DEFAULT NULL,
  `YayinDurumu` tinyint(1) NOT NULL DEFAULT 0,
  `GuncellemeTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CeviriID`),
  UNIQUE KEY `uq_sayfalar_ceviri` (`KayitID`,`DilKodu`),
  KEY `ix_sayfalar_ceviri_dil` (`DilKodu`,`YayinDurumu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `tablo_url_ceviri` (
  `CeviriID` int NOT NULL AUTO_INCREMENT,
  `UrlID` int NOT NULL,
  `DilKodu` char(2) NOT NULL,
  `Link` varchar(191) DEFAULT NULL,
  `Title` varchar(250) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `YayinDurumu` tinyint(1) NOT NULL DEFAULT 0,
  `GuncellemeTarihi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CeviriID`),
  UNIQUE KEY `uq_url_ceviri_kayit` (`UrlID`,`DilKodu`),
  UNIQUE KEY `uq_url_ceviri_link` (`DilKodu`,`Link`),
  KEY `ix_url_ceviri_dil` (`DilKodu`,`YayinDurumu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
