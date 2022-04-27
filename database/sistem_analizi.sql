-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 18 Oca 2021, 21:26:21
-- Sunucu sürümü: 5.7.31
-- PHP Sürümü: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `sistem_analizi`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `odemeler`
--

DROP TABLE IF EXISTS `odemeler`;
CREATE TABLE IF NOT EXISTS `odemeler` (
  `odeme_id` int(11) NOT NULL AUTO_INCREMENT,
  `ogr_id` int(11) NOT NULL,
  `odeme_sekli` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `odenen_ucret` float NOT NULL,
  `kalan_ucret` int(11) NOT NULL,
  PRIMARY KEY (`odeme_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogr_kayit`
--

DROP TABLE IF EXISTS `ogr_kayit`;
CREATE TABLE IF NOT EXISTS `ogr_kayit` (
  `ogr_id` int(11) NOT NULL AUTO_INCREMENT,
  `ogr_ad` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `ogr_soyad` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `ogr_sinif` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `ogr_borc` float NOT NULL,
  PRIMARY KEY (`ogr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siniflar`
--

DROP TABLE IF EXISTS `siniflar`;
CREATE TABLE IF NOT EXISTS `siniflar` (
  `sinif_id` int(11) NOT NULL AUTO_INCREMENT,
  `sinif_ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kontenjan` int(11) NOT NULL,
  `fiyat` int(11) NOT NULL,
  PRIMARY KEY (`sinif_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
