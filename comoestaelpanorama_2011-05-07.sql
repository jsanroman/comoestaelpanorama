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

INSERT INTO `ccaa` (`id`, `nombre`) VALUES ('1','andalucia'),
('2','aragon'),
('3','asturias'),
('4','baleares'),
('5','canarias'),						
('6','cantabria'),
('7','castilla y leon'),
('8','castilla la mancha'),
('9','cataluña'),
('10','comunidad valenciana'),
('11','extremadura'),
('12','galicia'),
('13','madrid'),
('14','murcia'),
('15','navarra'),
('16','pais vasco'),
('17','rioja'),
('18','ceuta'),
('19','melilla');

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

INSERT INTO `provincia` (`id`, `nombre`,`ccaa_id`) VALUES (1, 'Álava', 16),
(2, 'Albacete', 8),
(3, 'Alicante', 10),
(4, 'Almería', 1),
(5, 'Ávila', 7),
(6, 'Badajoz',11),
(7, 'Baleares (Illes)',4),
(8, 'Barcelona',9),
(9, 'Burgos',7),
(10, 'Cáceres',11),
(11, 'Cádiz',1),
(12, 'Castellón',10),
(13, 'Ciudad Real',08),
(14, 'Córdoba',1),
(15, 'A Coruña',12),
(16, 'Cuenca',8),
(17, 'Girona',9),
(18, 'Granada',1),
(19, 'Guadalajara',8),
(20, 'Guipúzcoa',16),
(21, 'Huelva',1),
(22, 'Huesca',2),
(23, 'Jaén',1),
(24, 'León',7),
(25, 'Lleida',9),
(26, 'La Rioja',17),
(27, 'Lugo',12),
(28, 'Madrid',13),
(29, 'Málaga',1),
(30, 'Murcia',14),
(31, 'Navarra',15),
(32, 'Ourense',12),
(33, 'Asturias',3),
(34, 'Palencia',7),
(35, 'Las Palmas',5),
(36, 'Pontevedra',12),
(37, 'Salamanca',7),
(38, 'Santa Cruz de Tenerife',5),
(39, 'Cantabria',6),
(40, 'Segovia',7),
(41, 'Sevilla',1),
(42, 'Soria',7),
(43, 'Tarragona',9),
(44, 'Teruel',2),
(45, 'Toledo',8),
(46, 'Valencia',10),
(47, 'Valladolid',7),
(48, 'Vizcaya',6),
(49, 'Zamora',7),
(50, 'Zaragoza',2),
(51, 'Ceuta',18),
(52, 'Melilla',19);

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
