-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2017 at 10:04 AM
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
-- Table structure for table `betaalwijze`
--

CREATE TABLE IF NOT EXISTS `betaalwijze` (
  `idBetaalwijze` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(80) NOT NULL,
  `beschrijving` varchar(80) NOT NULL,
  PRIMARY KEY (`idBetaalwijze`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `betaalwijze`
--

INSERT INTO `betaalwijze` (`idBetaalwijze`, `naam`, `beschrijving`) VALUES
(1, 'iDeal', 'iDeal'),
(2, 'Paypal', 'Paypal'),
(3, 'Mastercard', 'Mastercard'),
(4, 'Overboeking', 'Overboeking');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `idContact` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(255) NOT NULL,
  `emailAdres` varchar(255) NOT NULL,
  `telefoonnummer` int(15) NOT NULL,
  `bericht` varchar(5000) NOT NULL,
  PRIMARY KEY (`idContact`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `favorieten`
--

CREATE TABLE IF NOT EXISTS `favorieten` (
  `idFavorieten` int(11) NOT NULL AUTO_INCREMENT,
  `idProduct` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idFavorieten`),
  KEY `fk_Favorieten_Producten` (`idProduct`),
  KEY `fk_Favorieten_Users` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `favorieten`
--

INSERT INTO `favorieten` (`idFavorieten`, `idProduct`, `idUser`) VALUES
(6, 985634, 25);

-- --------------------------------------------------------

--
-- Table structure for table `klacht`
--

CREATE TABLE IF NOT EXISTS `klacht` (
  `idKlacht` int(11) NOT NULL AUTO_INCREMENT,
  `idUserKlacht` int(11) NOT NULL,
  `klacht` varchar(5000) NOT NULL,
  PRIMARY KEY (`idKlacht`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `klacht`
--

INSERT INTO `klacht` (`idKlacht`, `idUserKlacht`, `klacht`) VALUES
(3, 23, 'Ik kreeg een errormelding toen ik iets wilde bestellen'),
(4, 25, 'De website werkt niet');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `idOrder` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `totaalPrijs` float NOT NULL,
  `orderdatum` date NOT NULL,
  PRIMARY KEY (`idOrder`),
  KEY `fk_Order_Users` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`idOrder`, `idUser`, `totaalPrijs`, `orderdatum`) VALUES
(64, 23, 323, '2017-09-07'),
(65, 25, 78000, '2017-09-08');

-- --------------------------------------------------------

--
-- Table structure for table `orderregel`
--

CREATE TABLE IF NOT EXISTS `orderregel` (
  `idOrderregel` int(11) NOT NULL AUTO_INCREMENT,
  `idProductOr` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `prijsOr` float NOT NULL,
  `aantal` int(11) NOT NULL,
  `verkochtViaMeestVerkocht` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idOrderregel`),
  KEY `Fk_Orderregel_Producten_idx` (`idProductOr`),
  KEY `Fk_Orderregel_Order_idx` (`idOrder`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `orderregel`
--

INSERT INTO `orderregel` (`idOrderregel`, `idProductOr`, `idOrder`, `prijsOr`, `aantal`, `verkochtViaMeestVerkocht`) VALUES
(37, 985636, 64, 200, 1, 1),
(38, 985641, 64, 123, 1, 0),
(39, 985633, 65, 78000, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `producten`
--

CREATE TABLE IF NOT EXISTS `producten` (
  `idProduct` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(80) NOT NULL,
  `beschrijving` varchar(2000) NOT NULL,
  `prijs` float NOT NULL,
  `foto` varchar(100) NOT NULL,
  `beschikbaar` tinyint(1) NOT NULL,
  `aantalBeschikbaar` int(11) NOT NULL,
  `aantalVerkocht` int(11) NOT NULL,
  `isAccessoire` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `dagProduct` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idProduct`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=985643 ;

--
-- Dumping data for table `producten`
--

INSERT INTO `producten` (`idProduct`, `naam`, `beschrijving`, `prijs`, `foto`, `beschikbaar`, `aantalBeschikbaar`, `aantalVerkocht`, `isAccessoire`, `type`, `dagProduct`) VALUES
(985632, 'Tesla Model X', 'Tesla Model X', 95000, 'teslaModelX.jpg', 1, 2, 3, 0, 1, 0),
(985633, 'Tesla Model S', 'Model S is ontworpen om de veiligste en de sensationeelste sedan op de weg te zijn. Met ongeï¿½venaarde prestaties die worden geleverd door Tesla', 78000, 'teslaModelS.jpg', 1, 18, 2, 0, 1, 0),
(985634, 'Tesla Model 3', 'Het is altijd Elon Musk’s (CEO Tesla) bedoeling geweest om een betaalbare middenklasse elektrische wagen te bouwen. Om dat doel te verwezenlijken heeft Tesla de strategie om eerst een aantal duurdere modellen te ontwikkelen die het uiteindelijke doel, de Model 3 en andere kleinere EV’s, moeten financieren. De duurdere modellen, met name de Roadster, de Model S en de Model X, zorgen er ook voor dat het pad geëffend wordt wat betreft de perceptie rond EV’s en ze laten Tesla toe nieuwe technologie te ontwikkelen die zal gebruikt worden in de Model 3.', 33000, 'teslaModel3.jpg', 1, 4, 6, 0, 1, 1),
(985635, 'Tesla Model X Lader', 'A Tesla needs power to drive', 100, 'charger.jpg', 1, 50, 0, 1, 1, 0),
(985636, 'Tesla Replacement Key', 'Locked out? Here''s the solution', 200, 'teslaKey.jpg', 1, 376, 23, 1, 1, 0),
(985637, 'Tesla Kit', 'Fix small problems on your tesla with this kit', 50, 'teslaKit.jpg', 1, 155, 0, 1, 1, 0),
(985641, '123', '123', 123, 'teslaModelX.jpg', 1, 112, 12, 0, 1, 0),
(985642, '123', '123', 123, 'teslaModelX.jpg', 1, 122, 2, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rollen`
--

CREATE TABLE IF NOT EXISTS `rollen` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(80) NOT NULL,
  `beschrijving` varchar(80) NOT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rollen`
--

INSERT INTO `rollen` (`idRol`, `naam`, `beschrijving`) VALUES
(1, 'Admin', 'Admin kan alles'),
(2, 'Klant', 'Klant kan niet alles');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `idType` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(255) NOT NULL,
  `beschrijving` varchar(255) NOT NULL,
  PRIMARY KEY (`idType`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`idType`, `naam`, `beschrijving`) VALUES
(1, 'EV', 'Electric Verhicle'),
(6, 'SUV', 'SUV');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(80) NOT NULL,
  `emailAdres` varchar(80) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `adres` varchar(80) NOT NULL,
  `woonplaats` varchar(80) NOT NULL,
  `betaalwijze` int(11) NOT NULL,
  `rol` int(11) NOT NULL,
  `geactiveerd` tinyint(1) NOT NULL,
  `activatiedatum` date NOT NULL,
  `geblokkeerd` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUser`),
  KEY `fk_Users_Betaalwijze` (`betaalwijze`),
  KEY `fk_Users_Rollen` (`rol`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUser`, `naam`, `emailAdres`, `wachtwoord`, `adres`, `woonplaats`, `betaalwijze`, `rol`, `geactiveerd`, `activatiedatum`, `geblokkeerd`) VALUES
(20, 'Marielle van Dijk', 'marielle@mail.nl', 'ae4d8004e89142217b9319417361d15c', 'Kamille 1', 'Culemborg', 1, 1, 0, '2017-09-07', 0),
(21, 'Marielle van Dijk', 'marielle_xo@live.nl', '68f6002f53c0f1d5fa2e6648961af6fb', 'Kamille 12', 'Utrecht', 1, 1, 1, '2017-09-07', 0),
(23, 'Hatim van den Heuvel', 'HatimvandenHeuvel@dayrep.com', '9cccd64b5e548b7d82cb65cff3e9a170', 'Voorstraat 7', 'Lekkerkerk', 1, 2, 1, '2017-09-07', 0),
(24, 'Walterus Bosveld', 'WalterusBosveld@teleworm.us', 'cb546d271e9d84d3a7854b7594d8d747', 'Ringweg 16', 'Spaarndam', 1, 1, 1, '2017-09-08', 0),
(25, 'Marielle van Dijk', 'marielle1@mail.nl', 'e8636ea013e682faf61f56ce1cb1ab5c', 'Kamille 12', 'Culemborg', 4, 1, 1, '2017-09-08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `winkelmand`
--

CREATE TABLE IF NOT EXISTS `winkelmand` (
  `idWinkelmand` int(11) NOT NULL AUTO_INCREMENT,
  `idUserWm` int(11) NOT NULL,
  `idProductWm` int(11) NOT NULL,
  `aantalWm` int(11) NOT NULL,
  `dagProductWm` int(11) NOT NULL,
  `fromMeestVerkocht` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idWinkelmand`),
  KEY `idProduct` (`idProductWm`),
  KEY `idUser` (`idUserWm`),
  KEY `idUser_2` (`idUserWm`),
  KEY `idProduct_2` (`idProductWm`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=283 ;

--
-- Dumping data for table `winkelmand`
--

INSERT INTO `winkelmand` (`idWinkelmand`, `idUserWm`, `idProductWm`, `aantalWm`, `dagProductWm`, `fromMeestVerkocht`) VALUES
(281, 23, 985633, 1, 0, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorieten`
--
ALTER TABLE `favorieten`
  ADD CONSTRAINT `fk_Favorieten_Producten` FOREIGN KEY (`idProduct`) REFERENCES `producten` (`idProduct`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Favorieten_Users` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_Order_Users` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orderregel`
--
ALTER TABLE `orderregel`
  ADD CONSTRAINT `Fk_Orderregel_Order` FOREIGN KEY (`idOrder`) REFERENCES `order` (`idOrder`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Fk_Orderregel_Producten` FOREIGN KEY (`idProductOr`) REFERENCES `producten` (`idProduct`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_Users_Betaalwijze` FOREIGN KEY (`betaalwijze`) REFERENCES `betaalwijze` (`idBetaalwijze`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Users_Rollen` FOREIGN KEY (`rol`) REFERENCES `rollen` (`idRol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `winkelmand`
--
ALTER TABLE `winkelmand`
  ADD CONSTRAINT `fk_Winkelmand_Producten` FOREIGN KEY (`idProductWm`) REFERENCES `producten` (`idProduct`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Winkelmand_Users` FOREIGN KEY (`idUserWm`) REFERENCES `users` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
