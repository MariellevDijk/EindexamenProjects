-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2017 at 12:56 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `examendatabase`
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
  `videoTitel` varchar(999) NOT NULL,
  `idKlant` int(11) NOT NULL,
  `afleverdatum` date NOT NULL,
  `aflevertijd` time NOT NULL,
  `ophaaldatum` date NOT NULL,
  `ophaaltijd` time NOT NULL,
  `prijs` float NOT NULL,
  PRIMARY KEY (`idBestelling`),
  KEY `Fk_Bestelling_Artikelen_idx` (`idVideo`),
  KEY `Fk_Bestelling_Users_idx` (`idKlant`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `bestelling`
--

INSERT INTO `bestelling` (`idBestelling`, `idVideo`, `videoTitel`, `idKlant`, `afleverdatum`, `aflevertijd`, `ophaaldatum`, `ophaaltijd`, `prijs`) VALUES
(3, 13, '', 1, '2016-11-18', '10:00:00', '2016-12-04', '11:45:00', 19.55),
(4, 20, '', 1, '2017-05-31', '16:45:00', '2017-06-07', '10:00:00', 24.5);

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
(8, 'Mystery'),
(9, 'Horror'),
(10, 'Adult');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `klachten`
--

INSERT INTO `klachten` (`idKlacht`, `idKlant`, `klacht`, `emailKlant`) VALUES
(9, 1, 'Ik ben niet blij met jullie service, kunnen jullie hier wat aan doen?', 'klant@mail.nl'),
(10, 1, 'Ik heb een klacht', 'klant@mail.nl');

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
  `activatiedatum` date NOT NULL,
  `userrole` enum('klant','bezorger','baliemedewerker','eigenaar','admin') NOT NULL DEFAULT 'klant',
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`idKlant`),
  UNIQUE KEY `emailadres_UNIQUE` (`email`),
  UNIQUE KEY `adresregel1_UNIQUE` (`adres`),
  UNIQUE KEY `adres` (`adres`),
  UNIQUE KEY `adres_2` (`adres`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`idKlant`, `naam`, `email`, `adres`, `woonplaats`, `activated`, `geblokkeerd`, `activatiedatum`, `userrole`, `password`) VALUES
(1, 'Klant', 'klant@mail.nl', 'klantstraat', 'klantStad', 1, 0, '2016-11-02', 'klant', '202cb962ac59075b964b07152d234b70'),
(2, 'Baliemedewerker', 'baliemedewerker@mail.nl', 'baliemedewerkerstraat 1', 'baliemedewerkerstad', 1, 0, '2016-11-02', 'baliemedewerker', '202cb962ac59075b964b07152d234b70'),
(3, 'Bezorger de Bezorger', 'bezorger@mail.nl', 'Bezorgerstraat 1', 'Bezorgerstad', 1, 0, '2016-11-02', 'bezorger', '202cb962ac59075b964b07152d234b70'),
(4, 'Eigenaar de Eigenaar', 'eigenaar@mail.nl', 'Eigenaarstraat 1', 'Eigenaarstad', 1, 0, '2016-11-02', 'eigenaar', '202cb962ac59075b964b07152d234b70'),
(5, 'Admin de Admin', 'admin@mail.nl', 'Adminstraat 1', 'Adminstad', 1, 0, '2016-11-02', 'admin', '202cb962ac59075b964b07152d234b70'),
(6, 'Niet geactiveerd', 'nietgeactiveerd@mail.nl', 'nietActiveerstraat 1', 'NietActiveerStad', 0, 0, '2016-11-02', 'klant', 'df24040a771d5b0ae63d7c57290d619a'),
(7, 'Geblokkeerd', 'geblokkeerd@mail.nl', 'Geblokkeerdstraat 1', 'Geblokkeerdstad', 1, 1, '2016-11-02', 'klant', '202cb962ac59075b964b07152d234b70'),
(8, 'Klant 2', 'klant2@mail.nl', 'Klantstraat 2', 'KlantStad', 1, 0, '2016-11-02', 'klant', '202cb962ac59075b964b07152d234b70'),
(9, 'Klant 3', 'klant3@mail.nl', 'Klantstraat 3', 'KlantStad', 1, 0, '2016-11-02', 'klant', '202cb962ac59075b964b07152d234b70'),
(10, 'Klant 4', 'klant4@mail.nl', 'Klantstraat 4', 'KlantStad', 1, 0, '2016-11-02', 'klant', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `reservering`
--

CREATE TABLE IF NOT EXISTS `reservering` (
  `idReservering` int(11) NOT NULL AUTO_INCREMENT,
  `idKlant` int(11) NOT NULL,
  `idVideo` int(11) NOT NULL,
  `titel` varchar(255) NOT NULL,
  `prijs` float NOT NULL DEFAULT '7.5',
  `datumReservatie` date NOT NULL,
  `datumVideoBeschikbaar` date NOT NULL,
  `reactieDatumKlant` date NOT NULL,
  PRIMARY KEY (`idReservering`,`idKlant`,`idVideo`),
  KEY `Fk_Reserveringen_Klant_idx` (`idKlant`),
  KEY `Fk_Reserveringen_Video_idx` (`idVideo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

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
  `datumToegevoegd` date NOT NULL,
  `nieuw` tinyint(4) NOT NULL DEFAULT '0',
  `datumNietNieuw` date NOT NULL,
  PRIMARY KEY (`idVideo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`idVideo`, `titel`, `beschrijving`, `fotopad`, `prijs`, `aantalBeschikbaar`, `beschikbaar`, `aantalverhuurd`, `datumToegevoegd`, `nieuw`, `datumNietNieuw`) VALUES
(1, 'Annabelle', 'A couple begins to experience terrifying supernatural occurrences involving a vintage doll shortly after their home is invaded by satanic cultists.', 'annabelle.jpg', 7.5, 10, 1, 0, '2016-11-03', 1, '2016-12-03'),
(11, 'ABC', 'ABC', 'ABC', 7.5, 0, 0, 30, '2016-10-05', 0, '2016-11-09'),
(12, 'Avatar', 'A paraplegic marine dispatched to the moon Pandora on a unique mission becomes torn between following his orders and protecting the world he feels is his home.', 'avatar.jpg', 7.5, 20, 0, 0, '2016-11-03', 0, '2016-12-03'),
(13, 'Broken', 'The story of a young girl in North London whose life changes after witnessing a violent attack.', 'broken.jpg', 7.5, 8, 1, 1, '2016-11-03', 0, '2016-12-03'),
(14, 'Eye', 'A woman receives an eye transplant that allows her to see into the supernatural world.', 'eye.jpg', 7.5, 5, 1, 0, '2016-11-03', 0, '2016-12-03'),
(15, 'Frozen', 'When the newly crowned Queen Elsa accidentally uses her power to turn things into ice to curse her home in infinite winter, her sister, Anna, teams up with a mountain man, his playful reindeer, and a snowman to change the weather condition.', 'frozen.jpg', 7.5, 10, 1, 0, '2016-11-03', 1, '2016-12-03'),
(16, 'Jurassic Park', 'During a preview tour, a theme park suffers a major power breakdown that allows its cloned dinosaur exhibits to run amok', 'jurassicpark.jpg', 7.5, 8, 1, 0, '2016-11-03', 0, '2016-12-03'),
(17, 'Life of Pi', 'A young man who survives a disaster at sea is hurtled into an epic journey of adventure and discovery. While cast away, he forms an unexpected connection with another survivor: a fearsome Bengal tiger.', 'lifeofpi.jpg', 7.5, 21, 0, 30, '2016-11-03', 0, '2016-12-03'),
(18, 'Finding Nemo', 'After his son is captured in the Great Barrier Reef and taken to Sydney, a timid clownfish sets out on a journey to bring him home.', 'nemo.jpg', 7.5, 12, 1, 0, '2016-11-03', 0, '2016-12-03'),
(19, 'Popeye', 'The adventures of the sailor man and his friends in the seaside town of Sweethaven.', 'popeye.jpg', 7.5, 16, 1, 0, '2016-11-03', 0, '2016-12-03'),
(20, 'Saw VI', 'Agent Strahm is dead, and FBI agent Erickson draws nearer to Hoffman. Meanwhile, a pair of insurance executives find themselves in another game set by jigsaw.', 'saw.jpg', 7.5, -1, 1, 1, '2016-11-03', 0, '2016-12-03'),
(21, 'Tangled', 'The magically long-haired Rapunzel has spent her entire life in a tower, but now that a runaway thief has stumbled upon her, she is about to discover the world for the first time, and who she really is.', 'tangled.jpg', 7.5, 12, 1, 0, '2016-11-03', 0, '2016-12-03'),
(22, 'Zombieland', 'A shy student trying to reach his family in Ohio, a gun-toting tough guy trying to find the last Twinkie, and a pair of sisters trying to get to an amusement park join forces to travel across a zombie-filled America.', 'zombieland.jpg', 7.5, 18, 1, 0, '2016-11-03', 0, '2016-12-03'),
(23, 'Avatar 2', 'Avatar test', 'avatar.jpg', 7.5, 50, 0, 0, '2017-05-11', 0, '2017-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `videoacteur`
--

CREATE TABLE IF NOT EXISTS `videoacteur` (
  `idVideoActeur` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idVideo` int(11) NOT NULL,
  `idActeur` int(11) NOT NULL,
  PRIMARY KEY (`idVideoActeur`),
  KEY `Fk_VideoActeur_Artikelen_idx` (`idVideo`),
  KEY `Fk_VideoActeur_Acteur_idx` (`idActeur`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=161 ;

--
-- Dumping data for table `videoacteur`
--

INSERT INTO `videoacteur` (`idVideoActeur`, `idVideo`, `idActeur`) VALUES
(1, 1, 1),
(2, 1, 2),
(79, 11, 24),
(80, 11, 23),
(81, 11, 22),
(82, 11, 21),
(83, 11, 20),
(84, 11, 19),
(85, 11, 18),
(86, 11, 17),
(87, 11, 16),
(88, 11, 15),
(89, 11, 14),
(90, 11, 13),
(91, 11, 12),
(92, 11, 11),
(93, 11, 10),
(94, 11, 9),
(95, 11, 8),
(96, 11, 7),
(97, 11, 6),
(98, 11, 5),
(99, 11, 4),
(100, 11, 3),
(101, 12, 15),
(102, 12, 11),
(103, 12, 1),
(104, 12, 10),
(105, 12, 17),
(106, 13, 5),
(107, 13, 17),
(108, 13, 21),
(109, 13, 20),
(110, 13, 12),
(111, 14, 3),
(112, 14, 22),
(113, 14, 21),
(114, 14, 17),
(115, 14, 14),
(116, 15, 5),
(117, 15, 24),
(118, 15, 11),
(119, 15, 6),
(120, 15, 23),
(121, 16, 3),
(122, 16, 11),
(123, 16, 21),
(124, 16, 6),
(125, 16, 23),
(126, 17, 2),
(127, 17, 20),
(128, 17, 3),
(129, 17, 23),
(130, 17, 12),
(131, 18, 11),
(132, 18, 6),
(133, 18, 5),
(134, 18, 18),
(135, 18, 21),
(136, 19, 24),
(137, 19, 20),
(138, 19, 12),
(139, 19, 15),
(140, 19, 21),
(141, 20, 4),
(142, 20, 7),
(143, 20, 1),
(144, 20, 3),
(145, 20, 23),
(146, 21, 6),
(147, 21, 2),
(148, 21, 20),
(149, 21, 22),
(150, 21, 24),
(151, 22, 20),
(152, 22, 2),
(153, 22, 4),
(154, 22, 14),
(155, 22, 8),
(156, 23, 16),
(157, 23, 24),
(158, 23, 23),
(159, 23, 2),
(160, 23, 14);

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
  KEY `Fk_VideoGenre_Artikelen_idx` (`idVideo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=137 ;

--
-- Dumping data for table `videogenre`
--

INSERT INTO `videogenre` (`idVideoGenre`, `idVideo`, `idGenre`) VALUES
(1, 1, 1),
(2, 1, 2),
(91, 11, 10),
(92, 11, 9),
(93, 11, 8),
(94, 11, 7),
(95, 11, 6),
(96, 11, 5),
(97, 11, 4),
(98, 11, 3),
(99, 11, 2),
(100, 11, 1),
(101, 12, 1),
(102, 12, 2),
(103, 12, 5),
(104, 13, 4),
(105, 13, 8),
(106, 13, 3),
(107, 14, 2),
(108, 14, 1),
(109, 14, 9),
(110, 15, 6),
(111, 15, 1),
(112, 15, 4),
(113, 16, 6),
(114, 16, 1),
(115, 16, 7),
(116, 17, 6),
(117, 17, 9),
(118, 17, 4),
(119, 18, 7),
(120, 18, 6),
(121, 18, 2),
(122, 19, 1),
(123, 19, 7),
(124, 19, 2),
(125, 20, 1),
(126, 20, 9),
(127, 20, 8),
(128, 21, 6),
(129, 21, 7),
(130, 21, 2),
(131, 22, 1),
(132, 22, 9),
(133, 22, 5),
(134, 23, 3),
(135, 23, 10),
(136, 23, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

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
  ADD CONSTRAINT `Fk_VideoActeur_Artikelen` FOREIGN KEY (`idVideo`) REFERENCES `video` (`idVideo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `videogenre`
--
ALTER TABLE `videogenre`
  ADD CONSTRAINT `Fk_VideoGenre_Genre` FOREIGN KEY (`idGenre`) REFERENCES `genre` (`idGenre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Fk_VideoGenre_Artikelen` FOREIGN KEY (`idVideo`) REFERENCES `video` (`idVideo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
