-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2016 at 03:21 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `videotheek`
--

-- --------------------------------------------------------

--
-- Table structure for table `acteur`
--

CREATE TABLE IF NOT EXISTS `acteur` (
  `idActeur` int(11) NOT NULL,
  `naam` varchar(45) NOT NULL,
  PRIMARY KEY (`idActeur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acteur`
--

INSERT INTO `acteur` (`idActeur`, `naam`) VALUES
(1, 'Christian Bale'),
(2, 'Ben Affleck');

-- --------------------------------------------------------

--
-- Table structure for table `bestelling`
--

CREATE TABLE IF NOT EXISTS `bestelling` (
  `idBestelling` int(11) NOT NULL,
  `idVideo` int(11) NOT NULL,
  `idKlant` int(11) NOT NULL,
  `afleverdatum` datetime NOT NULL,
  `ophaaldatum` datetime NOT NULL,
  `prijs` float NOT NULL,
  PRIMARY KEY (`idBestelling`),
  KEY `Fk_Bestelling_Videos_idx` (`idVideo`),
  KEY `Fk_Bestelling_Users_idx` (`idKlant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `idGenre` int(11) NOT NULL,
  `Genre` varchar(100) NOT NULL,
  PRIMARY KEY (`idGenre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`idGenre`, `Genre`) VALUES
(1, 'Action'),
(2, 'Adventure');

-- --------------------------------------------------------

--
-- Table structure for table `klachten`
--

CREATE TABLE IF NOT EXISTS `klachten` (
  `idKlacht` int(11) NOT NULL,
  `idKlant` int(11) NOT NULL,
  `klacht` varchar(255) NOT NULL,
  PRIMARY KEY (`idKlacht`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `idKlant` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `adres` varchar(45) NOT NULL,
  `woonplaats` varchar(45) NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `geblokkeerd` tinyint(1) NOT NULL DEFAULT '0',
  `activatiedatum` datetime NOT NULL,
  `userrole` enum('klant','bezorger','baliemedewerker','eigenaar','admin') NOT NULL DEFAULT 'klant',
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`idKlant`),
  UNIQUE KEY `emailadres_UNIQUE` (`email`),
  UNIQUE KEY `adresregel1_UNIQUE` (`adres`),
  UNIQUE KEY `adres` (`adres`),
  UNIQUE KEY `adres_2` (`adres`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`idKlant`, `naam`, `email`, `adres`, `woonplaats`, `activated`, `geblokkeerd`, `activatiedatum`, `userrole`, `password`) VALUES
(1, 'Marielle van Dijk', 'test@test.test', 'Kamille 1', 'Culemborg', 0, 0, '2016-10-12 14:41:44', 'klant', 'f9353f3182cf896f4ab3053749a4e443'),
(3, 'Marielle van Dijk', 'test@test.123', 'Kamille 2', 'Culemborg', 0, 0, '2016-10-12 14:44:07', 'klant', '408b170b0ea2dd6d5d19637b111c0a8d'),
(4, 'Marielle van Dijk', 'test@test.3', 'Kamille 3', 'Culemborg', 0, 0, '2016-10-12 14:46:20', 'klant', '202cb962ac59075b964b07152d234b70'),
(5, 'Marielle van Dijk', 'test@test.4', 'Kamille 4', 'Culemborg', 1, 0, '2016-10-12 14:53:12', 'baliemedewerker', '202cb962ac59075b964b07152d234b70'),
(6, 'Admin de Admin', 'admin@mail.nl', 'Admin', 'Admin', 1, 0, '2016-10-12 15:01:36', 'admin', '202cb962ac59075b964b07152d234b70'),
(7, 'Bezorger de Bezorger', 'bezorger@mail.nl', 'Bezorger', 'Bezorger', 1, 0, '2016-10-12 15:02:17', 'bezorger', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `reservering`
--

CREATE TABLE IF NOT EXISTS `reservering` (
  `idReservering` int(11) NOT NULL,
  `idKlant` int(11) NOT NULL,
  `idVideo` int(11) NOT NULL,
  PRIMARY KEY (`idReservering`,`idKlant`,`idVideo`),
  KEY `Fk_Reserveringen_Klant_idx` (`idKlant`),
  KEY `Fk_Reserveringen_Video_idx` (`idVideo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `idVideo` int(11) NOT NULL,
  `titel` varchar(45) NOT NULL,
  `beschrijving` varchar(255) NOT NULL,
  `fotopad` varchar(100) NOT NULL,
  `prijs` float NOT NULL DEFAULT '7.5',
  `aantalBeschikbaar` int(11) NOT NULL,
  PRIMARY KEY (`idVideo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`idVideo`, `titel`, `beschrijving`, `fotopad`, `prijs`, `aantalBeschikbaar`) VALUES
(1, 'The Dank Knight', 'BATMAN', 'the_dark_knight.jpg', 7.5, 12),
(2, 'Batman vs Suupaman', 'Suupaman', 'batman_vs_superman.jpg', 7.5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `videoacteur`
--

CREATE TABLE IF NOT EXISTS `videoacteur` (
  `idVideoActeur` int(11) NOT NULL,
  `idVideo` int(11) NOT NULL,
  `idActeur` int(11) NOT NULL,
  PRIMARY KEY (`idVideoActeur`),
  KEY `Fk_VideoActeur_Videos_idx` (`idVideo`),
  KEY `Fk_VideoActeur_Acteur_idx` (`idActeur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `videoacteur`
--

INSERT INTO `videoacteur` (`idVideoActeur`, `idVideo`, `idActeur`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `videogenre`
--

CREATE TABLE IF NOT EXISTS `videogenre` (
  `idVideoGenre` int(11) NOT NULL,
  `idVideo` int(11) NOT NULL,
  `idGenre` int(11) NOT NULL,
  PRIMARY KEY (`idVideoGenre`),
  KEY `Fk_VideoGenre_Genre_idx` (`idGenre`),
  KEY `Fk_VideoGenre_Videos_idx` (`idVideo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `videogenre`
--

INSERT INTO `videogenre` (`idVideoGenre`, `idVideo`, `idGenre`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `winkelmand`
--

CREATE TABLE IF NOT EXISTS `winkelmand` (
  `idWinkelmand` int(11) NOT NULL,
  `idVideo` int(11) NOT NULL,
  `idKlant` int(11) NOT NULL,
  PRIMARY KEY (`idWinkelmand`),
  KEY `Fk_Winkelmand_Video_idx` (`idVideo`),
  KEY `Fk_Winkelmand_Users_idx` (`idKlant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bestelling`
--
ALTER TABLE `bestelling`
  ADD CONSTRAINT `Fk_Bestelling_Videos` FOREIGN KEY (`idVideo`) REFERENCES `video` (`idVideo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `reservering`
--
ALTER TABLE `reservering`
  ADD CONSTRAINT `Fk_Reserveringen_Video` FOREIGN KEY (`idVideo`) REFERENCES `video` (`idVideo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `videoacteur`
--
ALTER TABLE `videoacteur`
  ADD CONSTRAINT `Fk_VideoActeur_Acteur` FOREIGN KEY (`idActeur`) REFERENCES `acteur` (`idActeur`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Fk_VideoActeur_Videos` FOREIGN KEY (`idVideo`) REFERENCES `video` (`idVideo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `videogenre`
--
ALTER TABLE `videogenre`
  ADD CONSTRAINT `Fk_VideoGenre_Genre` FOREIGN KEY (`idGenre`) REFERENCES `genre` (`idGenre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Fk_VideoGenre_Videos` FOREIGN KEY (`idVideo`) REFERENCES `video` (`idVideo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `winkelmand`
--
ALTER TABLE `winkelmand`
  ADD CONSTRAINT `Fk_Winkelmand_Video` FOREIGN KEY (`idVideo`) REFERENCES `video` (`idVideo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
