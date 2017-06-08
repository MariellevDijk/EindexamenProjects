-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2016 at 11:48 PM
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
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` tinyint(10) unsigned NOT NULL AUTO_INCREMENT,
  `naam` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `userrole` enum('klant','eigenaar','geblokkeerd','baliemedewerker','admin','bezorger') NOT NULL DEFAULT 'klant',
  `activated` enum('no','yes') NOT NULL DEFAULT 'no',
  `activationdate` datetime NOT NULL,
  `adres` varchar(255) NOT NULL,
  `woonplaats` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `naam`, `email`, `password`, `userrole`, `activated`, `activationdate`, `adres`, `woonplaats`) VALUES
(1, '', 'test@test.test', '202cb962ac59075b964b07152d234b70', 'klant', 'yes', '2016-10-04 02:22:16', '', ''),
(27, '', 'klant@mail.nl', '202cb962ac59075b964b07152d234b70', 'klant', 'yes', '2016-10-05 13:56:33', '', ''),
(28, '', 'eigenaar@mail.nl', '202cb962ac59075b964b07152d234b70', 'eigenaar', 'yes', '2016-10-05 13:57:33', '', ''),
(29, '', 'geblokkeerd@mail.nl', '202cb962ac59075b964b07152d234b70', 'geblokkeerd', 'yes', '2016-10-05 13:58:10', '', ''),
(30, '', 'baliemedewerker@mail.nl', '202cb962ac59075b964b07152d234b70', 'baliemedewerker', 'yes', '2016-10-05 13:58:41', '', ''),
(31, '', 'admin@mail.nl', '202cb962ac59075b964b07152d234b70', 'admin', 'yes', '2016-10-05 13:59:11', '', ''),
(32, '', 'bezorger@mail.nl', '202cb962ac59075b964b07152d234b70', 'bezorger', 'yes', '2016-10-05 13:59:35', '', ''),
(33, '', 't@t.t', '89cba30897771ae0de8a01e36699fc23', 'klant', 'no', '2016-10-06 09:43:02', '', ''),
(34, '', 'a@a.a', '202cb962ac59075b964b07152d234b70', 'klant', 'yes', '2016-10-06 09:51:59', '', ''),
(35, '', '1@1.1', '202cb962ac59075b964b07152d234b70', 'klant', 'yes', '2016-10-06 15:47:29', '', ''),
(37, 'Marielle v Dijk', 'dijk@marielle.nl', '68ef8a4dc8dd60eea1abfc21ca00d358', 'klant', 'no', '2016-10-06 23:42:22', 'marielle', 'dijk'),
(38, 'Marielle van Dijk1', 'marielle@mar.ielel', 'e8636ea013e682faf61f56ce1cb1ab5c', 'klant', 'yes', '2016-10-06 23:43:48', 'Mar', 'Ielle');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` tinyint(10) unsigned NOT NULL AUTO_INCREMENT,
  `titel` varchar(50) NOT NULL,
  `beschrijving` varchar(500) NOT NULL,
  `genres` varchar(100) NOT NULL,
  `acteurs` varchar(200) NOT NULL,
  `fotopad` varchar(50) NOT NULL,
  `prijs` varchar(6) NOT NULL DEFAULT '7,50',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `titel`, `beschrijving`, `genres`, `acteurs`, `fotopad`, `prijs`) VALUES
(1, 'The Dark Knight', 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, the caped crusader must come to terms with one of the greatest psychological tests of his ability to fight injustice.', 'Action, Crime, Drama', 'Christian Bale, Heath Ledger, Aaron Eckhart', 'the_dark_knight.jpg', '7,50'),
(2, 'Batman VS Superman: Dawn Of Justice', 'Fearing that the actions of Superman are left unchecked, Batman takes on the Man of Steel, while the world wrestles with what kind of a hero it really needs.', 'Action, Adventure, Sci-Fi', 'Ben Affleck, Henry Cavill, Amy Adams', 'batman_vs_superman.jpg', '7,50'),
(3, 'Captain America: Civil War', 'Political interference in the Avengers'' activities causes a rift between former allies Captain America and Iron Man.', 'Action, Adventure, Sci-Fi', 'Chris Evans, Robert Downey Jr., Scarlett Johansson', 'captain_america_civil_war.jpg', '7,50'),
(4, 'Frozen', 'When the newly crowned Queen Elsa accidentally uses her power to turn things into ice to curse her home in infinite winter, her sister, Anna, teams up with a mountain man, his playful reindeer, and a snowman to change the weather condition.', 'Animation, Adventure, Comedy', 'Kristen Bell, Idina Menzel, Jonathan Groff', 'frozen.jpg', '7,50'),
(5, 'Inception', 'A thief, who steals corporate secrets through use of dream-sharing technology, is given the inverse task of planting an idea into the mind of a CEO.', 'Action, Adventure, Sci-Fi', 'Leonardo DiCaprio, Joseph Gordon-Levitt, Ellen Page', 'inception.jpg', '7,50'),
(6, 'Interstellar', 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity''s survival.', 'Adventure, Drama, Sci-Fi', ' Matthew McConaughey, Anne Hathaway, Jessica Chastain', 'Interstellar.jpg', '7,50'),
(7, 'Se7en', 'Two detectives, a rookie and a veteran, hunt a serial killer who uses the seven deadly sins as his modus operandi.', 'Crime, Drama, Mystery', 'Morgan Freeman, Brad Pitt, Kevin Spacey', 'se7en.jpg', '7,50'),
(8, 'Zootopia', 'In a city of anthropomorphic animals, a rookie bunny cop and a cynical con artist fox must work together to uncover a conspiracy.', 'Animation, Adventure, Comedy', ' Ginnifer Goodwin, Jason Bateman, Idris Elba', 'zootopia.jpg', '7,50'),
(19, 'q', 'q', 'q', 'q', 'q.JPG', '7,50');

-- --------------------------------------------------------

--
-- Table structure for table `winkelmand`
--

CREATE TABLE IF NOT EXISTS `winkelmand` (
  `id` tinyint(10) unsigned NOT NULL AUTO_INCREMENT,
  `klantid` tinyint(10) NOT NULL,
  `titel` varchar(50) NOT NULL,
  `prijs` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `winkelmand`
--

INSERT INTO `winkelmand` (`id`, `klantid`, `titel`, `prijs`) VALUES
(5, 27, 'The Dark Knight', '7,50'),
(7, 27, 'The Dark Knight', '7,50'),
(8, 34, 'Batman VS Superman: Dawn Of Justice', '7,50');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
