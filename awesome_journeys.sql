-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Nov 20, 2013 alle 21:36
-- Versione del server: 5.6.12-log
-- Versione PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `awesome_journeys`
--
CREATE DATABASE IF NOT EXISTS `awesome_journeys` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `awesome_journeys`;

-- --------------------------------------------------------

--
-- Struttura della tabella `accomodation`
--

CREATE TABLE IF NOT EXISTS `accomodation` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `stay` int(11) NOT NULL,
  `template` int(11) NOT NULL,
  `check_in` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `template` (`template`),
  KEY `stay` (`stay`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dump dei dati per la tabella `accomodation`
--

INSERT INTO `accomodation` (`ID`, `stay`, `template`, `check_in`) VALUES
(3, 1, 7, '0000-00-00 00:00:00'),
(4, 1, 8, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `accomodation_template`
--

CREATE TABLE IF NOT EXISTS `accomodation_template` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `description` text,
  `category` varchar(20) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `link` varchar(100) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `location` (`location`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dump dei dati per la tabella `accomodation_template`
--

INSERT INTO `accomodation_template` (`ID`, `address`, `type`, `description`, `category`, `name`, `link`, `photo`, `location`) VALUES
(1, '2199 Kalia Road, Oahu, HI 96815 (Waikiki)', 'Hotel', 'Halekulani has been hosting visitors to Waikiki Beach for nearly 100 years. Today its reputation for gracious hospitality, impeccable service and magnificent cuisine is unequaled on Oahu and renowned throughout the world.', '5', 'Halekulani', 'http://www.halekulani.com/', 'halekulani.jpg', 'Honolulu'),
(2, '129 Paoakalani Avenue, Oahu, HI 96815 (Waikiki)', 'Hotel', 'Located steps from Waikiki Beach and world-class shopping and dining, Hotel Renew by Aston offers guests a personalized and intimate experience that leaves them feeling renewed and rejuvenated. As Oahu’s only true designer boutique hotel, Hotel Renew by Aston is casually elegant oasis of tranquility – a subtle and calming contrast to the vibrant energy of Waikiki. Balance and harmony are the hallmarks of the overall design vision, which is immediately evident upon entering the property. Hotel Renew by Aston provides guests a beautiful and elegant beachside retreat that places their well-being ahead of everything else. The 72-room hotel echoes the natural environment of Oahu, incorporating basic natural elements such as water, earth, and fire into the overall design.', '3', 'Hotel Renew by Aston', 'http://www.hotelrenew.com/', 'renew.jpg', 'Honolulu'),
(3, '2569 Cartwright Rd, Oahu, HI 96815', 'Ostello', NULL, NULL, 'Waikiki Backpackers Hostel', NULL, NULL, 'Honolulu'),
(4, 'Radmansgatan 69, 11360, Svezia (Norrmalm)', 'Hotel', NULL, '2', 'Hotel Bakfickan', NULL, NULL, 'Stoccolma'),
(5, 'Grona gangen 1 | Box 1616, SE-111 86 , Svezia', 'Hotel', NULL, '5', 'Hotel Skeppsholmen', 'http://www.hotelskeppsholmen.com/index.asp', 'skeppsholmen.jpg', 'Stoccolma'),
(6, 'Stora Sallskapets Vag 51, 12731, Svezia ', 'Campeggio', NULL, NULL, 'Bredang Camping', NULL, NULL, 'Stoccolma'),
(7, 'Route Ramey, 11020, Italia', 'Hotel', NULL, '3', 'Le Rocher', 'http://lerocherhotel.com/', 'rocher.jpg', 'Champoluc'),
(8, 'Localita Alpe Salere Superiore, 11020, Italia', 'Rifugio', NULL, NULL, 'Rifugio Belvedere', NULL, NULL, 'Champoluc');

-- --------------------------------------------------------

--
-- Struttura della tabella `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `stay` int(11) NOT NULL,
  `template` int(11) NOT NULL,
  `duration` time NOT NULL,
  `start_date` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `template` (`template`),
  KEY `stay` (`stay`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `activity`
--

INSERT INTO `activity` (`ID`, `stay`, `template`, `duration`, `start_date`) VALUES
(1, 1, 7, '00:00:00', '0000-00-00 00:00:00'),
(2, 1, 8, '00:00:00', '0000-00-00 00:00:00'),
(3, 1, 9, '00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `activity_template`
--

CREATE TABLE IF NOT EXISTS `activity_template` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `expected_duration` time DEFAULT NULL,
  `description` text,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `location` (`location`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dump dei dati per la tabella `activity_template`
--

INSERT INTO `activity_template` (`ID`, `name`, `address`, `expected_duration`, `description`, `location`) VALUES
(1, 'Waikiki Aquarium', '2777 Kalakaua Avenue, Wakiki, Oahu, HI 96815 (Diamond Head - Kapahulu - St. Louis)', NULL, NULL, 'Honolulu'),
(2, 'Beach Sunset Yoga Hawaii', '2335 Kalakaua Ave, #110-536, Oahu, HI', NULL, NULL, 'Honolulu'),
(3, 'Pacific Aviation Museum Pearl Harbor', '319 Lexington Blvd, Hanger 37, Oahu, HI 96818', NULL, NULL, 'Honolulu'),
(4, 'Opera House (Operan)', 'Jakobs Torg 2, 103 22 , Svezia', NULL, NULL, 'Stoccolma'),
(5, 'Museo di Vasa', 'Galarvarvsvagen 14 | Djurgarden, Svezia', NULL, NULL, 'Stoccolma'),
(6, 'Visita al parco Djurgarden', 'Stoccolma, Svezia', NULL, NULL, 'Stoccolma'),
(7, 'Granturismo mountain bike', 'Champoluc-Frachey, Gressoney', NULL, 'Sullo sfondo la catena del Monte Rosa con oltre 20 cime al di sopra dei 4000 metri. Alle sue falde, un intreccio di percorsi da scoprire in mountain bike. Tracciati estivi di media montagna rispondono al desiderio di tranquillità della gita fuori porta delle famiglie.', 'Champoluc'),
(8, 'Downhill Frachey', 'Alpe Ciarcerio 1992 mt. s.l.m. / Frachey 1623 mt. s.l.m', NULL, 'Paradiso per mountain-bikers, la pista di downhill si compone di un tracciato che parte dall’arrivo del trenino di Frachey e raggiunge il parcheggio alla base della funicolare, per una lunghezza di tre chilometri e un dislivello di 350 metri, tra salti e discese mozzafiato.', 'Frachey'),
(9, 'Downhill Punta Jolanda', 'Punta Jolanda 2218 mt. s.l.m. / Edelboden 1653 mt. s.l.m.', NULL, 'Imperdibile per chi vive la mountain bike come uno sport adrenalinico, la pista di downhill è situata nell’area degli impianti di risalita di Gressoney?La?Trinité, tra le località di Punta Jolanda e di Edelboden Superiore. Il percorso inizia a fianco della stazione di arrivo della seggiovia di Punta Jolanda, a 2238 metri d’altezza.', 'Edelboden');

-- --------------------------------------------------------

--
-- Struttura della tabella `creator`
--

CREATE TABLE IF NOT EXISTS `creator` (
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `role` varchar(8) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `creator`
--

INSERT INTO `creator` (`username`, `password`, `role`) VALUES
('admin@aj.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'ta'),
('guido.guidi@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'customer'),
('nives.palumbo@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'customer');

-- --------------------------------------------------------

--
-- Struttura della tabella `itinerary`
--

CREATE TABLE IF NOT EXISTS `itinerary` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `category` varchar(50) NOT NULL,
  `tag` varchar(100) DEFAULT NULL,
  `photo` varchar(30) DEFAULT NULL,
  `creator` varchar(30) NOT NULL,
  `state` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `itinerary`
--

INSERT INTO `itinerary` (`ID`, `name`, `description`, `category`, `tag`, `photo`, `creator`, `state`) VALUES
(1, 'Honolulu', 'Vacanza di 7 giorni e 7 notti alla scoperta di Honolulu, la splendida capitale delle Hawaii.', 'cities', NULL, 'honolulu.jpg', 'admin@aj.com', 2),
(2, 'Stoccolma', NULL, 'cities', NULL, 'stoccolma.jpg', 'admin@aj.com', 2),
(3, 'Escursione in montagna', NULL, 'mountain', NULL, 'mountain1.jpg', 'admin@aj.com', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `journey`
--

CREATE TABLE IF NOT EXISTS `journey` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `itinerary` int(11) NOT NULL,
  `creator` varchar(30) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `publish_date` date DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `journey`
--

INSERT INTO `journey` (`ID`, `start_date`, `end_date`, `price`, `itinerary`, `creator`, `published`, `publish_date`) VALUES
(1, '2013-08-24', '2013-09-07', '800', 1, 'admin@aj.com', 1, '2013-05-15'),
(2, '2013-08-01', '2013-08-15', '750', 2, 'admin@aj.com', 1, '2013-07-01'),
(3, '2013-09-30', '2013-10-03', '200', 3, 'admin@aj.com', 1, '2013-08-23');

-- --------------------------------------------------------

--
-- Struttura della tabella `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `location` varchar(255) NOT NULL,
  PRIMARY KEY (`location`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `location`
--

INSERT INTO `location` (`location`) VALUES
('Champoluc'),
('Edelboden'),
('Frachey'),
('Honolulu'),
('Stoccolma');

-- --------------------------------------------------------

--
-- Struttura della tabella `personal_data`
--

CREATE TABLE IF NOT EXISTS `personal_data` (
  `username` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `personal_data`
--

INSERT INTO `personal_data` (`username`, `name`, `surname`, `address`, `telephone`) VALUES
('admin@aj.com', 'Admin', 'Admin', 'Awesome Journeys', '0000-000000'),
('guido.guidi@gmail.com', 'Guido', 'Guidi', 'a casa mia', '98765'),
('nives.palumbo@gmail.com', 'Nives', 'Palumbo', 'via arduino 24 samone', '3401518469');

-- --------------------------------------------------------

--
-- Struttura della tabella `stay_template`
--

CREATE TABLE IF NOT EXISTS `stay_template` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `start_location` varchar(50) NOT NULL,
  `end_location` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `start_location` (`start_location`),
  KEY `end_location` (`end_location`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `stay_template`
--

INSERT INTO `stay_template` (`ID`, `start_location`, `end_location`) VALUES
(1, 'Champoluc', 'Champoluc'),
(2, 'Honolulu', 'Honolulu'),
(3, 'Stoccolma', 'Stoccolma');

-- --------------------------------------------------------

--
-- Struttura della tabella `transport`
--

CREATE TABLE IF NOT EXISTS `transport` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `stay` int(11) NOT NULL,
  `template` int(11) NOT NULL,
  `start_hour` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `duration` time NOT NULL,
  `start_location` varchar(50) NOT NULL,
  `end_location` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `template` (`template`),
  KEY `stay` (`stay`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struttura della tabella `transport_template`
--

CREATE TABLE IF NOT EXISTS `transport_template` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle` varchar(20) NOT NULL,
  `start_location` varchar(50) NOT NULL,
  `end_location` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `accomodation`
--
ALTER TABLE `accomodation`
  ADD CONSTRAINT `accomodation_ibfk_1` FOREIGN KEY (`template`) REFERENCES `accomodation_template` (`ID`),
  ADD CONSTRAINT `accomodation_ibfk_2` FOREIGN KEY (`stay`) REFERENCES `stay_template` (`ID`);

--
-- Limiti per la tabella `accomodation_template`
--
ALTER TABLE `accomodation_template`
  ADD CONSTRAINT `accomodation_template_ibfk_1` FOREIGN KEY (`location`) REFERENCES `location` (`location`);

--
-- Limiti per la tabella `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`template`) REFERENCES `activity_template` (`ID`),
  ADD CONSTRAINT `activity_ibfk_2` FOREIGN KEY (`stay`) REFERENCES `stay_template` (`ID`);

--
-- Limiti per la tabella `stay_template`
--
ALTER TABLE `stay_template`
  ADD CONSTRAINT `stay_template_ibfk_1` FOREIGN KEY (`start_location`) REFERENCES `location` (`location`),
  ADD CONSTRAINT `stay_template_ibfk_2` FOREIGN KEY (`end_location`) REFERENCES `location` (`location`);

--
-- Limiti per la tabella `transport`
--
ALTER TABLE `transport`
  ADD CONSTRAINT `transport_ibfk_1` FOREIGN KEY (`stay`) REFERENCES `stay_template` (`ID`),
  ADD CONSTRAINT `transport_ibfk_2` FOREIGN KEY (`template`) REFERENCES `transport_template` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
