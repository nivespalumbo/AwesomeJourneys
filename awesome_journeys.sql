-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Feb 08, 2014 alle 16:07
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
CREATE DATABASE IF NOT EXISTS `awesome_journeys` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `awesome_journeys`;

-- --------------------------------------------------------

--
-- Struttura della tabella `accomodation`
--

CREATE TABLE IF NOT EXISTS `accomodation` (
  `ID` int(11) NOT NULL,
  `template` int(11) NOT NULL,
  `numero_disponibilita` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `template` (`template`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `accomodation`
--

INSERT INTO `accomodation` (`ID`, `template`, `numero_disponibilita`) VALUES
(3, 7, 7),
(4, 8, 7),
(22, 1, NULL),
(23, 2, NULL),
(24, 3, NULL),
(25, 4, NULL),
(26, 5, NULL),
(27, 6, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `accomodation_in_stay_template`
--

CREATE TABLE IF NOT EXISTS `accomodation_in_stay_template` (
  `stay_template` int(11) NOT NULL,
  `accomodation_id` int(11) NOT NULL,
  PRIMARY KEY (`stay_template`,`accomodation_id`),
  KEY `accomodation_id` (`accomodation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `accomodation_in_stay_template`
--

INSERT INTO `accomodation_in_stay_template` (`stay_template`, `accomodation_id`) VALUES
(8, 3),
(8, 4),
(9, 22),
(9, 23),
(9, 24),
(10, 25),
(10, 26),
(10, 27);

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
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dump dei dati per la tabella `accomodation_template`
--

INSERT INTO `accomodation_template` (`ID`, `address`, `type`, `description`, `category`, `name`, `link`, `photo`, `location`) VALUES
(1, '2199 Kalia Road, Oahu, HI 96815 (Waikiki)', 'Hotel', 'Halekulani has been hosting visitors to Waikiki Beach for nearly 100 years. Today its reputation for gracious hospitality, impeccable service and magnificent cuisine is unequaled on Oahu and renowned throughout the world.', '5', 'Halekulani', 'http://www.halekulani.com/', 'halekulani.jpg', 'Honolulu'),
(2, '129 Paoakalani Avenue, Oahu, HI 96815 (Waikiki)', 'Hotel', 'Located steps from Waikiki Beach and world-class shopping and dining, Hotel Renew by Aston offers guests a personalized and intimate experience that leaves them feeling renewed and rejuvenated. As Oahu’s only true designer boutique hotel, Hotel Renew by Aston is casually elegant oasis of tranquility – a subtle and calming contrast to the vibrant energy of Waikiki. Balance and harmony are the hallmarks of the overall design vision, which is immediately evident upon entering the property. Hotel Renew by Aston provides guests a beautiful and elegant beachside retreat that places their well-being ahead of everything else. The 72-room hotel echoes the natural environment of Oahu, incorporating basic natural elements such as water, earth, and fire into the overall design.', '3', 'Hotel Renew by Aston', 'http://www.hotelrenew.com/', NULL, 'Honolulu'),
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
  `ID` int(11) NOT NULL,
  `template` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `template` (`template`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `activity`
--

INSERT INTO `activity` (`ID`, `template`) VALUES
(15, 2),
(14, 4),
(20, 4),
(21, 4),
(13, 6),
(5, 7),
(6, 8),
(7, 9);

-- --------------------------------------------------------

--
-- Struttura della tabella `activity_in_stay`
--

CREATE TABLE IF NOT EXISTS `activity_in_stay` (
  `id_stay` int(11) NOT NULL,
  `id_activity` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `persons` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_stay`,`id_activity`),
  KEY `id_activity` (`id_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `activity_in_stay`
--

INSERT INTO `activity_in_stay` (`id_stay`, `id_activity`, `date`, `persons`) VALUES
(50, 5, '2014-07-27', 2),
(50, 7, '2014-08-01', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `activity_in_stay_template`
--

CREATE TABLE IF NOT EXISTS `activity_in_stay_template` (
  `stay_template` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  PRIMARY KEY (`stay_template`,`activity_id`),
  KEY `activity_id` (`activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `activity_in_stay_template`
--

INSERT INTO `activity_in_stay_template` (`stay_template`, `activity_id`) VALUES
(8, 5),
(8, 6),
(8, 7);

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
  `available_from` date DEFAULT NULL,
  `available_to` date DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dump dei dati per la tabella `activity_template`
--

INSERT INTO `activity_template` (`ID`, `name`, `address`, `expected_duration`, `description`, `location`, `available_from`, `available_to`) VALUES
(1, 'Waikiki Aquarium', '2777 Kalakaua Avenue, Wakiki, Oahu, HI 96815 (Diamond Head - Kapahulu - St. Louis)', NULL, NULL, 'Honolulu', NULL, NULL),
(2, 'Beach Sunset Yoga Hawaii', '2335 Kalakaua Ave, #110-536, Oahu, HI', NULL, NULL, 'Honolulu', '2014-04-01', '2014-09-30'),
(3, 'Pacific Aviation Museum Pearl Harbor', '319 Lexington Blvd, Hanger 37, Oahu, HI 96818', NULL, NULL, 'Honolulu', NULL, NULL),
(4, 'Opera House (Operan)', 'Jakobs Torg 2, 103 22 , Svezia', NULL, NULL, 'Stoccolma', NULL, NULL),
(5, 'Museo di Vasa', 'Galarvarvsvagen 14 | Djurgarden, Svezia', NULL, NULL, 'Stoccolma', NULL, NULL),
(6, 'Visita al parco Djurgarden', 'Stoccolma, Svezia', NULL, NULL, 'Stoccolma', NULL, NULL),
(7, 'Granturismo mountain bike', 'Champoluc-Frachey, Gressoney', NULL, 'Sullo sfondo la catena del Monte Rosa con oltre 20 cime al di sopra dei 4000 metri. Alle sue falde, un intreccio di percorsi da scoprire in mountain bike. Tracciati estivi di media montagna rispondono al desiderio di tranquillità della gita fuori porta delle famiglie.', 'Champoluc', '2014-06-15', '2014-09-15'),
(8, 'Downhill Frachey', 'Alpe Ciarcerio 1992 mt. s.l.m. / Frachey 1623 mt. s.l.m', NULL, 'Paradiso per mountain-bikers, la pista di downhill si compone di un tracciato che parte dall’arrivo del trenino di Frachey e raggiunge il parcheggio alla base della funicolare, per una lunghezza di tre chilometri e un dislivello di 350 metri, tra salti e discese mozzafiato.', 'Frachey', '2014-06-15', '2014-09-15'),
(9, 'Downhill Punta Jolanda', 'Punta Jolanda 2218 mt. s.l.m. / Edelboden 1653 mt. s.l.m.', NULL, 'Imperdibile per chi vive la mountain bike come uno sport adrenalinico, la pista di downhill è situata nell’area degli impianti di risalita di Gressoney?La?Trinité, tra le località di Punta Jolanda e di Edelboden Superiore. Il percorso inizia a fianco della stazione di arrivo della seggiovia di Punta Jolanda, a 2238 metri d’altezza.', 'Edelboden', '2014-06-15', '2014-09-15');

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
('guido.guidi@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'customer');

-- --------------------------------------------------------

--
-- Struttura della tabella `itinerary`
--

CREATE TABLE IF NOT EXISTS `itinerary` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `photo` varchar(255) DEFAULT NULL,
  `itinerary_creator` varchar(30) NOT NULL,
  `state` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `start_location` varchar(100) NOT NULL,
  `end_location` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `itinerary_creator` (`itinerary_creator`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dump dei dati per la tabella `itinerary`
--

INSERT INTO `itinerary` (`ID`, `name`, `description`, `photo`, `itinerary_creator`, `state`, `published`, `start_location`, `end_location`) VALUES
(1, 'Honolulu', 'Vacanza di 7 giorni e 7 notti alla scoperta di Honolulu, la splendida capitale delle Hawaii.', 'honolulu.jpg', 'admin@aj.com', 1, 1, 'Honolulu', NULL),
(2, 'Stoccolma', 'Perdetevi nelle bellissime viuzze di Gamla Stan, il centro storico di Stoccolma. Negozietti di ogni genere (antiquariato, elmetti alla Asterix, troll..) e caffè.', 'stoccolma.jpg', 'admin@aj.com', 1, 1, 'Stoccolma', NULL),
(3, 'Escursione in montagna', NULL, 'mountain1.jpg', 'admin@aj.com', 1, 1, 'Champoluc', NULL),
(45, 'Il mio itinerario', 'il mio itinerario', NULL, 'guido.guidi@gmail.com', 0, 0, '', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `itinerary_brick`
--

CREATE TABLE IF NOT EXISTS `itinerary_brick` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `start_location` varchar(50) NOT NULL,
  `end_location` varchar(50) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `type` int(11) NOT NULL,
  `id_itinerary` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `id_itinerary` (`id_itinerary`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dump dei dati per la tabella `itinerary_brick`
--

INSERT INTO `itinerary_brick` (`ID`, `start_location`, `end_location`, `start_date`, `end_date`, `type`, `id_itinerary`) VALUES
(50, 'Champoluc', 'Champoluc', '2014-07-16 00:00:00', '2014-08-15 00:00:00', 0, 45);

-- --------------------------------------------------------

--
-- Struttura della tabella `journey`
--

CREATE TABLE IF NOT EXISTS `journey` (
  `id_journey` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `itinerary` int(11) NOT NULL,
  `creator` varchar(30) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `publish_date` date DEFAULT NULL,
  PRIMARY KEY (`id_journey`),
  KEY `itinerary` (`itinerary`),
  KEY `creator` (`creator`),
  KEY `creator_2` (`creator`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `journey`
--

INSERT INTO `journey` (`id_journey`, `start_date`, `end_date`, `itinerary`, `creator`, `published`, `publish_date`) VALUES
(1, '2014-04-01', '2013-09-07', 1, 'admin@aj.com', 1, '2013-05-15'),
(2, '2014-02-14', '2013-08-15', 2, 'admin@aj.com', 1, '2013-07-01'),
(3, '2014-07-13', '2013-10-03', 3, 'admin@aj.com', 1, '2013-08-23');

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
('guido.guidi@gmail.com', 'Guido', 'Guidi', 'a casa mia', '98765');

-- --------------------------------------------------------

--
-- Struttura della tabella `stay`
--

CREATE TABLE IF NOT EXISTS `stay` (
  `ID` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `accomodation_id` int(11) DEFAULT NULL,
  `accomodation_date` date DEFAULT NULL,
  `accomodation_duration` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `template_id` (`template_id`),
  KEY `accomodation_id` (`accomodation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `stay`
--

INSERT INTO `stay` (`ID`, `template_id`, `accomodation_id`, `accomodation_date`, `accomodation_duration`) VALUES
(50, 8, 3, '2014-07-16', 15);

-- --------------------------------------------------------

--
-- Struttura della tabella `stay_template`
--

CREATE TABLE IF NOT EXISTS `stay_template` (
  `ID` int(11) NOT NULL,
  `start_location` varchar(50) NOT NULL,
  `end_location` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `stay_template`
--

INSERT INTO `stay_template` (`ID`, `start_location`, `end_location`, `name`, `description`, `type`) VALUES
(8, 'Champoluc', 'Champoluc', 'Mountain Bike', 'I migliori itinerari da fare in bici', 0),
(9, 'Honolulu', 'Honolulu', 'Hawaii!', 'Visita alla capitale', 0),
(10, 'Stoccolma', 'Stoccolma', 'Stoccolma', '', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `stay_template_component`
--

CREATE TABLE IF NOT EXISTS `stay_template_component` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `is_composite` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dump dei dati per la tabella `stay_template_component`
--

INSERT INTO `stay_template_component` (`ID`, `type`, `is_composite`) VALUES
(3, 2, 0),
(4, 2, 0),
(5, 1, 0),
(6, 1, 0),
(7, 1, 0),
(8, 0, 1),
(9, 0, 1),
(10, 0, 1),
(13, 1, 0),
(14, 1, 0),
(15, 1, 0),
(16, 3, 0),
(17, 3, 0),
(18, 3, 0),
(19, 3, 0),
(20, 1, 0),
(21, 1, 0),
(22, 2, 0),
(23, 2, 0),
(24, 2, 0),
(25, 2, 0),
(26, 2, 0),
(27, 2, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `stay_template_structure`
--

CREATE TABLE IF NOT EXISTS `stay_template_structure` (
  `id_parent` int(11) NOT NULL,
  `id_child` int(11) NOT NULL,
  PRIMARY KEY (`id_parent`,`id_child`),
  KEY `id_child` (`id_child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `transfer`
--

CREATE TABLE IF NOT EXISTS `transfer` (
  `ID` int(11) NOT NULL,
  `transport_id` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `transport_id` (`transport_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `transport`
--

CREATE TABLE IF NOT EXISTS `transport` (
  `ID` int(11) NOT NULL,
  `template` int(11) NOT NULL,
  `duration` time NOT NULL,
  `from_location` varchar(50) NOT NULL,
  `to_location` varchar(50) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `template` (`template`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `transport`
--

INSERT INTO `transport` (`ID`, `template`, `duration`, `from_location`, `to_location`, `start_date`) VALUES
(16, 7, '01:00:00', 'Torino Porta Nuova', 'Ivrea', NULL),
(17, 8, '01:00:00', 'Ivrea', 'Aosta', NULL),
(18, 9, '00:45:00', 'Aosta', 'Champoluc', NULL),
(19, 1, '00:15:00', 'Champoluc', 'Frachey', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `transport_in_stay_template`
--

CREATE TABLE IF NOT EXISTS `transport_in_stay_template` (
  `stay_template` int(11) NOT NULL,
  `transport_id` int(11) NOT NULL,
  PRIMARY KEY (`stay_template`,`transport_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `transport_template`
--

CREATE TABLE IF NOT EXISTS `transport_template` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `vehicle` varchar(20) NOT NULL,
  `start_location` varchar(50) NOT NULL,
  `end_location` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dump dei dati per la tabella `transport_template`
--

INSERT INTO `transport_template` (`ID`, `name`, `description`, `vehicle`, `start_location`, `end_location`) VALUES
(1, NULL, NULL, 'Autobus', 'Champoluc', 'Frachey'),
(2, NULL, NULL, 'Aereo', 'Milano Malpensa', 'Honolulu'),
(3, NULL, NULL, 'Aereo', 'Milano Malpensa', 'Berlino'),
(4, NULL, NULL, 'Aereo', 'Berlino', 'Stoccolma'),
(5, NULL, NULL, 'Aereo', 'Stoccolma', 'Berlino'),
(6, NULL, NULL, 'Aereo', 'Berlino', 'Roma'),
(7, NULL, NULL, 'Treno', 'Torino Porta Nuova', 'Ivrea'),
(8, NULL, NULL, 'Treno', 'Ivrea', 'Aosta'),
(9, NULL, NULL, 'Autobus', 'Aosta', 'Champoluc');

-- --------------------------------------------------------

--
-- Struttura della tabella `travel_booking`
--

CREATE TABLE IF NOT EXISTS `travel_booking` (
  `traveller` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `journey` int(11) NOT NULL,
  `num_travellers` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`traveller`,`journey`),
  KEY `traveller` (`traveller`),
  KEY `journey` (`journey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `accomodation`
--
ALTER TABLE `accomodation`
  ADD CONSTRAINT `accomodation_ibfk_1` FOREIGN KEY (`template`) REFERENCES `accomodation_template` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accomodation_ibfk_3` FOREIGN KEY (`ID`) REFERENCES `stay_template_component` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `accomodation_in_stay_template`
--
ALTER TABLE `accomodation_in_stay_template`
  ADD CONSTRAINT `accomodation_in_stay_template_ibfk_1` FOREIGN KEY (`stay_template`) REFERENCES `stay_template` (`ID`),
  ADD CONSTRAINT `accomodation_in_stay_template_ibfk_2` FOREIGN KEY (`accomodation_id`) REFERENCES `accomodation` (`ID`);

--
-- Limiti per la tabella `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`template`) REFERENCES `activity_template` (`ID`),
  ADD CONSTRAINT `activity_ibfk_3` FOREIGN KEY (`ID`) REFERENCES `stay_template_component` (`ID`);

--
-- Limiti per la tabella `activity_in_stay`
--
ALTER TABLE `activity_in_stay`
  ADD CONSTRAINT `activity_in_stay_ibfk_1` FOREIGN KEY (`id_stay`) REFERENCES `stay` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `activity_in_stay_ibfk_2` FOREIGN KEY (`id_activity`) REFERENCES `activity` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `activity_in_stay_template`
--
ALTER TABLE `activity_in_stay_template`
  ADD CONSTRAINT `activity_in_stay_template_ibfk_1` FOREIGN KEY (`stay_template`) REFERENCES `stay_template` (`ID`),
  ADD CONSTRAINT `activity_in_stay_template_ibfk_2` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`ID`);

--
-- Limiti per la tabella `itinerary`
--
ALTER TABLE `itinerary`
  ADD CONSTRAINT `itinerary_ibfk_1` FOREIGN KEY (`itinerary_creator`) REFERENCES `creator` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `itinerary_brick`
--
ALTER TABLE `itinerary_brick`
  ADD CONSTRAINT `itinerary_brick_ibfk_3` FOREIGN KEY (`id_itinerary`) REFERENCES `itinerary` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `journey`
--
ALTER TABLE `journey`
  ADD CONSTRAINT `journey_ibfk_1` FOREIGN KEY (`itinerary`) REFERENCES `itinerary` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journey_ibfk_2` FOREIGN KEY (`creator`) REFERENCES `creator` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `stay`
--
ALTER TABLE `stay`
  ADD CONSTRAINT `stay_ibfk_1` FOREIGN KEY (`template_id`) REFERENCES `stay_template` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stay_ibfk_2` FOREIGN KEY (`accomodation_id`) REFERENCES `accomodation` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `stay_ibfk_4` FOREIGN KEY (`ID`) REFERENCES `itinerary_brick` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `stay_template`
--
ALTER TABLE `stay_template`
  ADD CONSTRAINT `stay_template_ibfk_3` FOREIGN KEY (`ID`) REFERENCES `stay_template_component` (`ID`);

--
-- Limiti per la tabella `stay_template_structure`
--
ALTER TABLE `stay_template_structure`
  ADD CONSTRAINT `stay_template_structure_ibfk_1` FOREIGN KEY (`id_parent`) REFERENCES `stay_template` (`ID`),
  ADD CONSTRAINT `stay_template_structure_ibfk_2` FOREIGN KEY (`id_child`) REFERENCES `stay_template` (`ID`);

--
-- Limiti per la tabella `transfer`
--
ALTER TABLE `transfer`
  ADD CONSTRAINT `transfer_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `itinerary_brick` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transfer_ibfk_2` FOREIGN KEY (`transport_id`) REFERENCES `transport` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `transport`
--
ALTER TABLE `transport`
  ADD CONSTRAINT `transport_ibfk_2` FOREIGN KEY (`template`) REFERENCES `transport_template` (`ID`),
  ADD CONSTRAINT `transport_ibfk_3` FOREIGN KEY (`ID`) REFERENCES `stay_template_component` (`ID`);

--
-- Limiti per la tabella `travel_booking`
--
ALTER TABLE `travel_booking`
  ADD CONSTRAINT `travel_booking_ibfk_1` FOREIGN KEY (`journey`) REFERENCES `journey` (`id_journey`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
