# Sequel Pro dump
# Version 2492
# http://code.google.com/p/sequel-pro
#
# Host: 127.0.0.1 (MySQL 5.1.53)
# Database: comoestaelpanorama
# Generation Time: 2011-05-07 02:34:25 +0200
# ************************************************************

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table ccaa
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ccaa`;

CREATE TABLE `ccaa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `puntuacion` int(11) DEFAULT NULL,
  `lat` varchar(25) DEFAULT NULL,
  `lng` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table dato
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dato`;

CREATE TABLE `dato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `localidad_id` int(11) DEFAULT NULL,
  `provincia_id` int(11) DEFAULT NULL,
  `ccaa_id` int(11) DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
  `anho` int(11) DEFAULT NULL,
  `dato` bigint(20) DEFAULT NULL,
  `tipo_dato` varchar(2) DEFAULT NULL,
  `timestamp` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table localidad
# ------------------------------------------------------------

DROP TABLE IF EXISTS `localidad`;

CREATE TABLE `localidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `provincia_id` int(11) DEFAULT NULL,
  `puntuacion` int(11) DEFAULT NULL,
  `poblacion` int(11) DEFAULT NULL,
  `lat` varchar(25) DEFAULT NULL,
  `lng` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table provincia
# ------------------------------------------------------------

DROP TABLE IF EXISTS `provincia`;

CREATE TABLE `provincia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `ccaa_id` int(11) DEFAULT NULL,
  `puntuacion` int(11) DEFAULT NULL,
  `poblacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table visitante
# ------------------------------------------------------------

DROP TABLE IF EXISTS `visitante`;

CREATE TABLE `visitante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` int(11) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `ciudad` varchar(255) DEFAULT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `ccaa` varchar(255) DEFAULT NULL,
  `latitud` varchar(45) DEFAULT NULL,
  `longitud` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;






/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
