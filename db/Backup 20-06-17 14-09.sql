-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2017 at 02:09 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `betaalwijze`
--

INSERT INTO `betaalwijze` (`idBetaalwijze`, `naam`, `beschrijving`) VALUES
(1, 'iDeal', 'iDeal'),
(2, 'Mastercard', 'Mastercard'),
(3, 'Paypal', 'Paypal'),
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
  `idFavorieten` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`idFavorieten`),
  KEY `fk_Favorieten_Producten` (`idProduct`),
  KEY `fk_Favorieten_Users` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`idOrder`, `idUser`, `totaalPrijs`, `orderdatum`) VALUES
(31, 10, 95000, '2017-06-13'),
(32, 13, 95300, '2017-06-15');

-- --------------------------------------------------------

--
-- Table structure for table `orderregel`
--

CREATE TABLE IF NOT EXISTS `orderregel` (
  `idOrderregel` int(11) NOT NULL AUTO_INCREMENT,
  `idProduct` int(11) NOT NULL,
  `idOrder` int(11) NOT NULL,
  `prijsOr` float NOT NULL,
  `aantal` int(11) NOT NULL,
  PRIMARY KEY (`idOrderregel`),
  KEY `Fk_Orderregel_Producten_idx` (`idProduct`),
  KEY `Fk_Orderregel_Order_idx` (`idOrder`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `orderregel`
--

INSERT INTO `orderregel` (`idOrderregel`, `idProduct`, `idOrder`, `prijsOr`, `aantal`) VALUES
(5, 985632, 31, 95000, 1),
(6, 985632, 32, 95000, 1),
(7, 985635, 32, 300, 3);

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
  PRIMARY KEY (`idProduct`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=985638 ;

--
-- Dumping data for table `producten`
--

INSERT INTO `producten` (`idProduct`, `naam`, `beschrijving`, `prijs`, `foto`, `beschikbaar`, `aantalBeschikbaar`, `aantalVerkocht`, `isAccessoire`) VALUES
(985632, 'Tesla Model X', 'Tesla Model X', 95000, 'teslaModelX.jpg', 1, 3, 2, 0),
(985633, 'Tesla Model S', 'Model S is ontworpen om de veiligste en de sensationeelste sedan op de weg te zijn. Met ongeëvenaarde prestaties die worden geleverd door Tesla''s unieke elektrische aandrijflijn, accelereert Model S van 0 tot 100 km/u in slechts 2,7 seconden. Met de Autopilot functies van Model S wordt rijden op de snelweg niet alleen veiliger, maar ook stressvrij.', 78000, 'teslaModelS.jpg', 1, 20, 0, 0),
(985634, 'Tesla Model 3', 'Het is altijd Elon Musk’s (CEO Tesla) bedoeling geweest om een betaalbare middenklasse elektrische wagen te bouwen. Om dat doel te verwezenlijken heeft Tesla de strategie om eerst een aantal duurdere modellen te ontwikkelen die het uiteindelijke doel, de Model 3 en andere kleinere EV’s, moeten financieren. De duurdere modellen, met name de Roadster, de Model S en de Model X, zorgen er ook voor dat het pad geëffend wordt wat betreft de perceptie rond EV’s en ze laten Tesla toe nieuwe technologie te ontwikkelen die zal gebruikt worden in de Model 3.', 33000, 'teslaModel3.jpg', 1, 10, 0, 0),
(985635, 'Tesla Model X Lader', 'A Tesla needs power to drive', 100, 'charger.jpg', 1, 47, 3, 1),
(985636, 'Tesla Replacement Key', 'Locked out? Here''s the solution', 200, 'teslaKey.jpg', 1, 400, 0, 1),
(985637, 'Tesla Kit', 'Fix small problems on your tesla with this kit', 50, 'teslaKit.jpg', 1, 155, 0, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUser`, `naam`, `emailAdres`, `wachtwoord`, `adres`, `woonplaats`, `betaalwijze`, `rol`, `geactiveerd`, `activatiedatum`, `geblokkeerd`) VALUES
(10, 'Marielle van Dijk', 'marielle@mail.nl', '202cb962ac59075b964b07152d234b70', 'Kamille 1', 'Culemborg', 2, 2, 1, '2017-06-10', 0),
(11, 'Marielle van Dijk', 'marielle2@mail.nl', 'cc86dee7f6cf9b13b0d307600f8c4167', 'Kamille 12', 'Culemborg', 4, 2, 0, '2017-06-15', 0),
(12, 'Richard', 'R.van.Stroe@hotmail.com', '6df11ccdc5a8802385bce173a1a43859', 'Maliebaan 12', 'Utrecht', 2, 2, 0, '2017-06-15', 0),
(13, '', 'richard@mail.nl', '15de21c670ae7c3f6f3f1f37029303c9', 'Maliebaan 12', 'Utrecht', 2, 2, 1, '2017-06-15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `winkelmand`
--

CREATE TABLE IF NOT EXISTS `winkelmand` (
  `idWinkelmand` int(11) NOT NULL AUTO_INCREMENT,
  `idUserWm` int(11) NOT NULL,
  `idProductWm` int(11) NOT NULL,
  `aantalWm` int(11) NOT NULL,
  PRIMARY KEY (`idWinkelmand`),
  KEY `idProduct` (`idProductWm`),
  KEY `idUser` (`idUserWm`),
  KEY `idUser_2` (`idUserWm`),
  KEY `idProduct_2` (`idProductWm`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=251 ;

--
-- Dumping data for table `winkelmand`
--

INSERT INTO `winkelmand` (`idWinkelmand`, `idUserWm`, `idProductWm`, `aantalWm`) VALUES
(248, 10, 985632, 1);

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
  ADD CONSTRAINT `Fk_Orderregel_Producten` FOREIGN KEY (`idProduct`) REFERENCES `producten` (`idProduct`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
