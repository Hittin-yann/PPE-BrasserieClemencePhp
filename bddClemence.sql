-- --------------------------------------------------------
-- Hôte:                         www.barsio.fr
-- Version du serveur:           5.5.5-10.3.22-MariaDB-0+deb10u1 - Debian 10
-- Serveur OS:                   debian-linux-gnu
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Export de la structure de la base pour brasserie
CREATE DATABASE IF NOT EXISTS `brasserie` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `brasserie`;


-- Export de la structure de table brasserie. biere
CREATE TABLE IF NOT EXISTS `biere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Export de données de la table brasserie.biere: ~10 rows (environ)
DELETE FROM `biere`;
/*!40000 ALTER TABLE `biere` DISABLE KEYS */;
INSERT INTO `biere` (`id`, `nom`) VALUES
	(1, 'La Douceur Basique'),
	(2, 'La Douceur Tradi'),
	(3, 'La Sagesse'),
	(4, 'La rédemption'),
	(5, 'La Bienveillante'),
	(6, 'L\'absolution'),
	(7, 'La Bonté'),
	(8, 'La tolérante'),
	(9, 'La Mieleuse'),
	(10, 'Le Pêché');
/*!40000 ALTER TABLE `biere` ENABLE KEYS */;


-- Export de la structure de table brasserie. brassin
CREATE TABLE IF NOT EXISTS `brassin` (
  `code` varchar(15) NOT NULL,
  `dateBrass` date NOT NULL,
  `dateMiseBout` date NOT NULL,
  `volume` double NOT NULL,
  `id` int(11) NOT NULL,
  `pourAlcool` double(2,1) NOT NULL,
  PRIMARY KEY (`code`),
  KEY `Brassin_Biere_FK` (`id`),
  CONSTRAINT `Brassin_Biere_FK` FOREIGN KEY (`id`) REFERENCES `biere` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Export de données de la table brasserie.brassin: ~1 rows (environ)
DELETE FROM `brassin`;
/*!40000 ALTER TABLE `brassin` DISABLE KEYS */;
INSERT INTO `brassin` (`code`, `dateBrass`, `dateMiseBout`, `volume`, `id`, `pourAlcool`) VALUES
	('B00017062020', '2020-06-17', '2020-06-17', 50, 8, 5.8);
/*!40000 ALTER TABLE `brassin` ENABLE KEYS */;


-- Export de la structure de table brasserie. mouvement
CREATE TABLE IF NOT EXISTS `mouvement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `contenance` double NOT NULL DEFAULT 0,
  `nbBouteilles` int(11) NOT NULL,
  `code` varchar(15) NOT NULL,
  `stockDebMois` int(5) DEFAULT NULL,
  `stockRealise` int(5) DEFAULT NULL,
  `sortiesVendues` int(5) DEFAULT NULL,
  `sortiesDeg` int(5) DEFAULT NULL,
  `stockFinMois` int(5) DEFAULT NULL,
  `volSorties` double(2,2) DEFAULT NULL,
  `coutDouanes` double(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Mouvement_Brassin_FK` (`code`),
  CONSTRAINT `Mouvement_Brassin_FK` FOREIGN KEY (`code`) REFERENCES `brassin` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Export de données de la table brasserie.mouvement: ~1 rows (environ)
DELETE FROM `mouvement`;
/*!40000 ALTER TABLE `mouvement` DISABLE KEYS */;
INSERT INTO `mouvement` (`id`, `date`, `contenance`, `nbBouteilles`, `code`, `stockDebMois`, `stockRealise`, `sortiesVendues`, `sortiesDeg`, `stockFinMois`, `volSorties`, `coutDouanes`) VALUES
	(3, '2020-06-17', 0.33, 50, 'B00017062020', 0, 50, 10, 2, 38, 0.00, 2.00);
/*!40000 ALTER TABLE `mouvement` ENABLE KEYS */;


-- Export de la structure de table brasserie. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log` varchar(20) DEFAULT NULL,
  `mdp` varchar(30) DEFAULT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Export de données de la table brasserie.user: ~1 rows (environ)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `log`, `mdp`, `nom`, `prenom`) VALUES
	(2, 'lchevalot', '0550002D', 'CHEVALOT', 'Lucas');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
