-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.30 - MySQL Community Server (GPL)
-- Server OS:                    Linux
-- Date/time:                    2013-03-07 22:32:24
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table lliure_site.ll_produtos
DROP TABLE IF EXISTS `ll_produtos`;
CREATE TABLE `ll_produtos` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`idCat` INT(11) NULL DEFAULT '0',
	`nome` VARCHAR(200) NOT NULL,
	`foto` VARCHAR(200) NULL DEFAULT NULL,
	`descricao` TEXT NOT NULL,
	`destaque` ENUM('0','1') NULL DEFAULT '0',
	`status` ENUM('0','1') NULL DEFAULT '1',
	`tipo` ENUM('1','2') NOT NULL,
	`permicao` VARCHAR(256) NULL DEFAULT NULL,
	`conf_valor` ENUM('1','0') NOT NULL DEFAULT '0',
	`valor` DOUBLE NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	INDEX `idCat` (`idCat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.


-- Dumping structure for table lliure_site.ll_produtos_fotos
DROP TABLE IF EXISTS `ll_produtos_fotos`;
CREATE TABLE IF NOT EXISTS `ll_produtos_fotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idProd` int(11) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `descricao` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
