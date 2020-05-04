-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 04. Mai 2020 um 21:15
-- Server-Version: 10.1.44-MariaDB-0ubuntu0.18.04.1
-- PHP-Version: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `bothosting`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kresu24_server`
--

CREATE TABLE `kresu24_server` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `user` int(11) NOT NULL,
  `platform` varchar(250) NOT NULL,
  `ftp_user` varchar(200) NOT NULL,
  `ftp_password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kresu24_user`
--

CREATE TABLE `kresu24_user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` text NOT NULL,
  `birthday` date NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `key` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `kresu24_server`
--
ALTER TABLE `kresu24_server`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `kresu24_user`
--
ALTER TABLE `kresu24_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `kresu24_server`
--
ALTER TABLE `kresu24_server`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT für Tabelle `kresu24_user`
--
ALTER TABLE `kresu24_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
