-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2016 at 09:08 PM
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
(2, 'Ben Affleck'),
(3, 'Heath Ledger'),
(4, 'Aaron Eckhart'),
(5, 'Henry Cavill'),
(6, 'Amy Adams'),
(7, 'Chris Evans'),
(8, 'Robert Downey Jr.'),
(9, 'Scarlett Johansson'),
(10, 'Kristen Bell'),
(11, 'Idina Menzel'),
(12, 'Jonathan Groff'),
(13, 'Leonardo DiCaprio'),
(14, 'Joseph Gordon-Levitt'),
(15, 'Ellen Page'),
(16, 'Matthew McConaughey'),
(17, 'Anne Hathaway'),
(18, 'Jessica Chastain'),
(19, 'Morgan Freeman'),
(20, 'Brad Pitt'),
(21, 'Kevin Spacey'),
(22, 'Ginnifer Goodwin'),
(23, 'Jason Bateman'),
(24, 'Idris Elba');

-- --------------------------------------------------------

--
-- Table structure for table `bestelling`
--

CREATE TABLE IF NOT EXISTS `bestelling` (
  `idBestelling` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idVideo` int(11) NOT NULL,
  `videoTitel` varchar(50) NOT NULL,
  `idKlant` int(11) NOT NULL,
  `afleverdatum` date NOT NULL,
  `aflevertijd` datetime NOT NULL,
  `ophaaldatum` date NOT NULL,
  `ophaaltijd` datetime NOT NULL,
  `prijs` float NOT NULL,
  PRIMARY KEY (`idBestelling`),
  KEY `Fk_Bestelling_Videos_idx` (`idVideo`),
  KEY `Fk_Bestelling_Users_idx` (`idKlant`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `bestelling`
--

INSERT INTO `bestelling` (`idBestelling`, `idVideo`, `videoTitel`, `idKlant`, `afleverdatum`, `aflevertijd`, `ophaaldatum`, `ophaaltijd`, `prijs`) VALUES
(5, 1, '', 11, '2016-10-19', '0000-00-00 00:00:00', '2016-10-26', '0000-00-00 00:00:00', 9.5),
(6, 4, '', 11, '2016-10-28', '0000-00-00 00:00:00', '2016-11-04', '0000-00-00 00:00:00', 9.5),
(7, 4, '', 11, '2016-10-28', '0000-00-00 00:00:00', '2016-11-04', '0000-00-00 00:00:00', 9.5),
(8, 4, '', 11, '2016-10-25', '0000-00-00 00:00:00', '2016-11-01', '0000-00-00 00:00:00', 9.5),
(9, 4, '', 11, '2016-10-28', '0000-00-00 00:00:00', '2016-11-04', '0000-00-00 00:00:00', 9.5),
(10, 4, '', 11, '2016-10-28', '0000-00-00 00:00:00', '2016-11-04', '0000-00-00 00:00:00', 9.5),
(11, 4, '', 11, '2016-10-28', '0000-00-00 00:00:00', '2016-11-04', '0000-00-00 00:00:00', 9.5),
(12, 4, '', 11, '2016-10-28', '0000-00-00 00:00:00', '2016-11-04', '0000-00-00 00:00:00', 9.5),
(13, 4, '', 11, '2016-10-22', '0000-00-00 00:00:00', '2016-10-29', '0000-00-00 00:00:00', 9.5),
(14, 4, '', 11, '2016-10-19', '0000-00-00 00:00:00', '2016-10-26', '0000-00-00 00:00:00', 9.5),
(15, 4, '', 11, '2016-10-19', '0000-00-00 00:00:00', '2016-10-26', '0000-00-00 00:00:00', 9.5),
(16, 4, '', 11, '2016-10-14', '0000-00-00 00:00:00', '2016-10-21', '0000-00-00 00:00:00', 9.5),
(17, 4, '', 11, '2016-10-24', '0000-00-00 00:00:00', '2016-10-31', '0000-00-00 00:00:00', 9.5),
(18, 4, '', 11, '2016-10-17', '0000-00-00 00:00:00', '2016-10-24', '0000-00-00 00:00:00', 9.5),
(19, 1, '', 11, '2016-10-21', '0000-00-00 00:00:00', '2016-10-28', '0000-00-00 00:00:00', 9.5),
(20, 1, '', 11, '2016-10-30', '0000-00-00 00:00:00', '2016-11-06', '0000-00-00 00:00:00', 9.5),
(21, 1, '', 18, '2016-10-25', '0000-00-00 00:00:00', '2016-11-01', '0000-00-00 00:00:00', 9.5),
(22, 8, 'Zootopia', 11, '2016-10-25', '0000-00-00 00:00:00', '2016-11-01', '0000-00-00 00:00:00', 9.5),
(24, 4, 'Frozen', 11, '2016-10-18', '0000-00-00 00:00:00', '2016-10-25', '0000-00-00 00:00:00', 9.5),
(25, 1, 'The Dark Knight', 11, '2016-10-29', '0000-00-00 00:00:00', '2016-11-05', '0000-00-00 00:00:00', 9.5);

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
(2, 'Adventure'),
(3, 'Crime'),
(4, 'Drama'),
(5, 'Sci-Fi'),
(6, 'Animation'),
(7, 'Comedy'),
(8, 'Mystery');

-- --------------------------------------------------------

--
-- Table structure for table `klachten`
--

CREATE TABLE IF NOT EXISTS `klachten` (
  `idKlacht` int(11) NOT NULL AUTO_INCREMENT,
  `idKlant` int(11) NOT NULL,
  `klacht` varchar(255) NOT NULL,
  `emailKlant` varchar(255) NOT NULL,
  PRIMARY KEY (`idKlacht`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `klachten`
--

INSERT INTO `klachten` (`idKlacht`, `idKlant`, `klacht`, `emailKlant`) VALUES
(3, 11, '123', 'klant@mail.nl'),
(5, 11, '123', 'klant@mail.nl'),
(6, 11, '123', 'klant@mail.nl');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`idKlant`, `naam`, `email`, `adres`, `woonplaats`, `activated`, `geblokkeerd`, `activatiedatum`, `userrole`, `password`) VALUES
(11, 'Klant de Klant', 'klant@mail.nl', 'klantadres 1', 'klantstad', 1, 0, '2016-10-12 20:15:24', 'klant', '202cb962ac59075b964b07152d234b70'),
(12, 'Admin de Admin', 'admin@mail.nl', 'Adminstraat 1', 'Adminstad', 1, 0, '2016-10-12 20:16:06', 'admin', '202cb962ac59075b964b07152d234b70'),
(14, 'Bezorger de Bezorger', 'bezorger@mail.nl', 'Bezorgeradres 1', 'Bezorgerstad', 1, 0, '2016-10-12 20:17:35', 'bezorger', '202cb962ac59075b964b07152d234b70'),
(15, 'Baliemedewerker de Baliemedewerker', 'baliemedewerker@mail.nl', 'Baliemedewerkeradres 1', 'Baliemedewerkerstad', 1, 0, '2016-10-12 20:18:52', 'baliemedewerker', '202cb962ac59075b964b07152d234b70'),
(16, 'Eigenaar de Eigenaar', 'eigenaar@mail.nl', 'Eigenaarstraat 1', 'Eigenaarstad', 1, 0, '2016-10-12 20:19:26', 'eigenaar', '202cb962ac59075b964b07152d234b70'),
(17, 'Geblokkeerd', 'geblokkeerd@mail.nl', 'Geblokkeerdstraat 1', 'Blokkeerstad', 1, 1, '2016-10-12 23:48:11', 'klant', '202cb962ac59075b964b07152d234b70'),
(18, 'TestKlant', 'testklant@mail.nl', 'Testklant straat', 'KlantTest', 1, 0, '2016-10-14 09:44:41', 'klant', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `reservering`
--

CREATE TABLE IF NOT EXISTS `reservering` (
  `idReservering` int(11) NOT NULL AUTO_INCREMENT,
  `idKlant` int(11) NOT NULL,
  `idVideo` int(11) NOT NULL,
  `titel` varchar(255) NOT NULL,
  PRIMARY KEY (`idReservering`,`idKlant`,`idVideo`),
  KEY `Fk_Reserveringen_Klant_idx` (`idKlant`),
  KEY `Fk_Reserveringen_Video_idx` (`idVideo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `reservering`
--

INSERT INTO `reservering` (`idReservering`, `idKlant`, `idVideo`, `titel`) VALUES
(30, 11, 6, 'Interstellar');

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
  `beschikbaar` tinyint(1) NOT NULL DEFAULT '1',
  `aantalverhuurd` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idVideo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`idVideo`, `titel`, `beschrijving`, `fotopad`, `prijs`, `aantalBeschikbaar`, `beschikbaar`, `aantalverhuurd`) VALUES
(1, 'The Dark Knight', 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, the caped crusader must come to terms with one of the greatest psychological tests of his ability to fight injustice.', 'the_dark_knight.jpg', 7.5, 8, 0, 30),
(2, 'Batman VS Superman: Dawn Of Justice', 'Fearing that the actions of Superman are left unchecked, Batman takes on the Man of Steel, while the world wrestles with what kind of a hero it really needs.', 'batman_vs_superman.jpg', 7.5, 10, 1, 0),
(3, 'Captain America: Civil War', 'Political interference in the Avengers'' activities causes a rift between former allies Captain America and Iron Man.', 'captain_america_civil_war.jpg', 7.5, 1, 1, 0),
(4, 'Frozen', 'When the newly crowned Queen Elsa accidentally uses her power to turn things into ice to curse her home in infinite winter, her sister, Anna, teams up with a mountain man, his playful reindeer, and a snowman to change the weather condition.', 'frozen.jpg', 7.5, 0, 1, 2),
(5, 'Inception', 'A thief, who steals corporate secrets through use of dream-sharing technology, is given the inverse task of planting an idea into the mind of a CEO.', 'inception.jpg', 7.5, 0, 1, 0),
(6, 'Interstellar', 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity''s survival.', 'Interstellar.jpg', 7.5, 0, 1, 0),
(7, 'Se7en', 'Two detectives, a rookie and a veteran, hunt a serial killer who uses the seven deadly sins as his modus operandi.', 'se7en.jpg', 7.5, 0, 1, 0),
(8, 'Zootopia', 'In a city of anthropomorphic animals, a rookie bunny cop and a cynical con artist fox must work together to uncover a conspiracy.', 'zootopia.jpg', 7.5, 7, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `videoacteur`
--

CREATE TABLE IF NOT EXISTS `videoacteur` (
  `idVideoActeur` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idVideo` int(11) NOT NULL,
  `idActeur` int(11) NOT NULL,
  PRIMARY KEY (`idVideoActeur`),
  KEY `Fk_VideoActeur_Videos_idx` (`idVideo`),
  KEY `Fk_VideoActeur_Acteur_idx` (`idActeur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `videoacteur`
--

INSERT INTO `videoacteur` (`idVideoActeur`, `idVideo`, `idActeur`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 4),
(4, 2, 2),
(5, 2, 5),
(6, 2, 6),
(7, 3, 7),
(8, 3, 8),
(9, 3, 9),
(10, 4, 10),
(11, 4, 11),
(12, 4, 12),
(13, 5, 13),
(14, 5, 14),
(15, 5, 15),
(16, 6, 16),
(17, 6, 17),
(18, 6, 18),
(19, 7, 19),
(20, 7, 20),
(21, 7, 21),
(22, 8, 22),
(23, 8, 23),
(24, 8, 24);

-- --------------------------------------------------------

--
-- Table structure for table `videogenre`
--

CREATE TABLE IF NOT EXISTS `videogenre` (
  `idVideoGenre` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idVideo` int(11) NOT NULL,
  `idGenre` int(11) NOT NULL,
  PRIMARY KEY (`idVideoGenre`),
  KEY `Fk_VideoGenre_Genre_idx` (`idGenre`),
  KEY `Fk_VideoGenre_Videos_idx` (`idVideo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `videogenre`
--

INSERT INTO `videogenre` (`idVideoGenre`, `idVideo`, `idGenre`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 4),
(4, 2, 1),
(5, 2, 2),
(6, 2, 5),
(7, 3, 1),
(8, 3, 2),
(9, 3, 5),
(10, 4, 6),
(11, 4, 2),
(12, 4, 7),
(13, 5, 1),
(14, 5, 2),
(15, 5, 5),
(16, 6, 2),
(17, 6, 4),
(18, 6, 5),
(19, 7, 3),
(20, 7, 4),
(21, 7, 8),
(22, 8, 6),
(23, 8, 2),
(24, 8, 7);

-- --------------------------------------------------------

--
-- Table structure for table `winkelmand`
--

CREATE TABLE IF NOT EXISTS `winkelmand` (
  `idWinkelmand` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idVideo` int(11) NOT NULL,
  `titel` varchar(50) NOT NULL,
  `idKlant` int(11) NOT NULL,
  `prijs` float NOT NULL,
  PRIMARY KEY (`idWinkelmand`),
  KEY `Fk_Winkelmand_Video_idx` (`idVideo`),
  KEY `Fk_Winkelmand_Users_idx` (`idKlant`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `winkelmand`
--

INSERT INTO `winkelmand` (`idWinkelmand`, `idVideo`, `titel`, `idKlant`, `prijs`) VALUES
(55, 1, 'The Dark Knight', 12, 7.5),
(57, 2, 'Batman VS Superman: Dawn Of Justice', 11, 7.5);

--
-- Constraints for dumped tables
--

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
