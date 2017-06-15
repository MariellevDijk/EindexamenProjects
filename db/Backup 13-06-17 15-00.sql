-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2017 at 02:57 PM
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
CREATE DATABASE IF NOT EXISTS `examendatabase` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `examendatabase`;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`idOrder`, `idUser`, `totaalPrijs`, `orderdatum`) VALUES
(28, 10, 86, '2017-06-11'),
(30, 10, 48, '2017-06-13'),
(31, 10, 95000, '2017-06-13');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `orderregel`
--

INSERT INTO `orderregel` (`idOrderregel`, `idProduct`, `idOrder`, `prijsOr`, `aantal`) VALUES
(1, 1, 28, 40, 2),
(2, 4, 28, 46, 2),
(4, 4, 30, 48, 2),
(5, 985632, 31, 95000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `producten`
--

CREATE TABLE IF NOT EXISTS `producten` (
  `idProduct` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(80) NOT NULL,
  `beschrijving` varchar(80) NOT NULL,
  `prijs` float NOT NULL,
  `foto` varchar(100) NOT NULL,
  `beschikbaar` tinyint(1) NOT NULL,
  `aantalBeschikbaar` int(11) NOT NULL,
  `aantalVerkocht` int(11) NOT NULL,
  PRIMARY KEY (`idProduct`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=985633 ;

--
-- Dumping data for table `producten`
--

INSERT INTO `producten` (`idProduct`, `naam`, `beschrijving`, `prijs`, `foto`, `beschikbaar`, `aantalBeschikbaar`, `aantalVerkocht`) VALUES
(1, 'Saw', 'saw', 20, 'saw.jpg', 1, 8, 2),
(4, 'Saw 2', 'Saw 2', 23, 'saw.jpg', 1, 45, 5),
(985632, 'Tesla Model X', 'Tesla Model X', 95000, 'teslaModelX.jpg', 1, 4, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUser`, `naam`, `emailAdres`, `wachtwoord`, `adres`, `woonplaats`, `betaalwijze`, `rol`, `geactiveerd`, `activatiedatum`, `geblokkeerd`) VALUES
(10, 'Marielle van Dijk', 'marielle@mail.nl', '202cb962ac59075b964b07152d234b70', 'Kamille 1', 'Culemborg', 2, 2, 1, '2017-06-10', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=248 ;

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
  ADD CONSTRAINT `Fk_Orderregel_Producten` FOREIGN KEY (`idProduct`) REFERENCES `producten` (`idProduct`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Fk_Orderregel_Order` FOREIGN KEY (`idOrder`) REFERENCES `order` (`idOrder`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
