-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 12 mei 2022 om 02:31
-- Serverversie: 10.4.6-MariaDB
-- PHP-versie: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `excellenttaste`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingen`
--

CREATE TABLE `bestellingen` (
  `id` int(11) NOT NULL,
  `aantal` int(11) DEFAULT NULL,
  `geserveerd` tinyint(4) DEFAULT 0,
  `reservering_id` int(11) NOT NULL,
  `menuitems_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `bestellingen`
--

INSERT INTO `bestellingen` (`id`, `aantal`, `geserveerd`, `reservering_id`, `menuitems_id`) VALUES
(1, 2, 0, 3, 3),
(4, 2, 0, 3, 3),
(5, 5, 1, 3, 12),
(6, 2, 1, 3, 7),
(7, 2, 1, 3, 13);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gerechtcategorien`
--

CREATE TABLE `gerechtcategorien` (
  `id` int(11) NOT NULL,
  `code` varchar(3) DEFAULT NULL,
  `naam` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gerechtcategorien`
--

INSERT INTO `gerechtcategorien` (`id`, `code`, `naam`) VALUES
(1, 'bar', 'Dranken'),
(2, 'kok', 'Hapjes'),
(3, 'kok', 'Hoofdgerechten'),
(4, 'kok', 'Nagerechten'),
(5, 'kok', 'Voorgerechten');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gerechtsoorten`
--

CREATE TABLE `gerechtsoorten` (
  `id` int(11) NOT NULL,
  `code` varchar(3) DEFAULT NULL,
  `naam` varchar(20) DEFAULT NULL,
  `gerechtcategorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gerechtsoorten`
--

INSERT INTO `gerechtsoorten` (`id`, `code`, `naam`, `gerechtcategorie_id`) VALUES
(1, 'bar', 'Bieren', 1),
(2, 'bar', 'Frisdranken', 1),
(3, 'bar', 'Warme dranken', 1),
(4, 'bar', 'Wijnen', 1),
(5, 'kok', 'Koude hapjes', 2),
(6, 'kok', 'Warme hapjes', 2),
(7, 'kok', 'Vegetarisch', 3),
(8, 'kok', 'Vis', 3),
(9, 'kok', 'Vlees', 3),
(10, 'kok', 'Ijs', 4),
(11, 'kok', 'Mousse', 4),
(12, 'kok', 'Koud', 5),
(13, 'kok', 'Warm', 5);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
--

CREATE TABLE `klant` (
  `id` int(11) NOT NULL,
  `naam` varchar(20) NOT NULL,
  `telefoon` varchar(11) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `klant`
--

INSERT INTO `klant` (`id`, `naam`, `telefoon`, `email`) VALUES
(3, 'bilal', '0612345674', 'bilal1@gmail.com'),
(4, 'jason', '0612345670', 'jason@gmail.com');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `medewerker`
--

CREATE TABLE `medewerker` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `medewerker`
--

INSERT INTO `medewerker` (`id`, `username`, `password`) VALUES
(1, 'lverhoeven', 'excellenttaste'),
(2, 'mreule', '123');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `menuitems`
--

CREATE TABLE `menuitems` (
  `id` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `naam` varchar(255) DEFAULT NULL,
  `prijs` decimal(10,2) NOT NULL,
  `gerechtsoort_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `menuitems`
--

INSERT INTO `menuitems` (`id`, `code`, `naam`, `prijs`, `gerechtsoort_id`) VALUES
(1, 'bar', 'Pilsner', '2.00', 1),
(2, 'bar', 'Kasteel donker', '2.00', 1),
(3, 'bar', 'Palm', '2.00', 1),
(4, 'bar', 'Chaudfontaine Rood', '2.00', 2),
(5, 'bar', 'Verse Jus', '2.00', 2),
(6, 'bar', 'Tonic', '2.00', 2),
(7, 'bar', 'Koffie', '2.00', 3),
(8, 'bar', 'Thee', '2.00', 3),
(9, 'bar', 'Espresso', '2.00', 3),
(10, 'bar', 'Per glas', '2.00', 4),
(11, 'bar', 'Rode port', '2.00', 4),
(12, 'kok', 'Portie kaas met mosterd', '10.00', 5),
(13, 'kok', 'Brood met kruidenboter', '10.00', 5),
(14, 'kok', 'Portie salami worst', '7.00', 5),
(15, 'kok', 'Bitterballetjes met mosterd', '5.00', 6),
(16, 'kok', 'Gebakken banana', '15.00', 7),
(17, 'kok', 'Bonengerecht met diverse groen', '5.00', 7),
(18, 'kok', 'Gebakken makreel', '10.00', 8),
(19, 'kok', 'Mosselen uit pan', '35.00', 8),
(20, 'kok', 'Wienerschnitzel', '12.00', 9),
(21, 'kok', 'Biefstuk in champignonsaus', '45.00', 9),
(22, 'kok', 'Vruchtenijs', '4.00', 10),
(23, 'kok', 'Dame Blanche', '14.00', 10),
(24, 'kok', 'Chocolademousse', '3.00', 11),
(25, 'kok', 'Vanillemousse', '3.00', 11);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reservering`
--

CREATE TABLE `reservering` (
  `id` int(11) NOT NULL,
  `tafel` int(11) NOT NULL,
  `datum` date NOT NULL,
  `tijd` time NOT NULL,
  `aantal_personen` int(11) NOT NULL,
  `aantal_kinderen` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `datum_toegevoegd` timestamp NOT NULL DEFAULT `tijd`,
  `allergien` text DEFAULT NULL,
  `opmerkingen` text DEFAULT NULL,
  `klant_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `reservering`
--

INSERT INTO `reservering` (`id`, `tafel`, `datum`, `tijd`, `aantal_personen`, `aantal_kinderen`, `status`, `datum_toegevoegd`, `allergien`, `opmerkingen`, `klant_id`) VALUES
(3, 2, '2022-05-12', '22:22:00', 3, 3, 0, '2022-05-11 19:13:43', 'geen', 'dichtbij raam', 3),
(6, 6, '2022-05-19', '16:00:00', 1, 0, 0, '2022-05-12 00:27:32', 'noten allergie', 'gelieve ober mondkapje te laten dragen', 4);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservering_id` (`reservering_id`),
  ADD KEY `menuitems_id` (`menuitems_id`);

--
-- Indexen voor tabel `gerechtcategorien`
--
ALTER TABLE `gerechtcategorien`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gerechtsoorten`
--
ALTER TABLE `gerechtsoorten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gerechtcategorie_id` (`gerechtcategorie_id`);

--
-- Indexen voor tabel `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `medewerker`
--
ALTER TABLE `medewerker`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `menuitems`
--
ALTER TABLE `menuitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gerechtsoort_id` (`gerechtsoort_id`);

--
-- Indexen voor tabel `reservering`
--
ALTER TABLE `reservering`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservering_ibfk_1` (`klant_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `gerechtcategorien`
--
ALTER TABLE `gerechtcategorien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `gerechtsoorten`
--
ALTER TABLE `gerechtsoorten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT voor een tabel `klant`
--
ALTER TABLE `klant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `medewerker`
--
ALTER TABLE `medewerker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `menuitems`
--
ALTER TABLE `menuitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT voor een tabel `reservering`
--
ALTER TABLE `reservering`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD CONSTRAINT `bestellingen_ibfk_1` FOREIGN KEY (`reservering_id`) REFERENCES `reservering` (`id`),
  ADD CONSTRAINT `bestellingen_ibfk_2` FOREIGN KEY (`menuitems_id`) REFERENCES `menuitems` (`id`);

--
-- Beperkingen voor tabel `gerechtsoorten`
--
ALTER TABLE `gerechtsoorten`
  ADD CONSTRAINT `gerechtsoorten_ibfk_1` FOREIGN KEY (`gerechtcategorie_id`) REFERENCES `gerechtcategorien` (`id`);

--
-- Beperkingen voor tabel `menuitems`
--
ALTER TABLE `menuitems`
  ADD CONSTRAINT `menuitems_ibfk_1` FOREIGN KEY (`gerechtsoort_id`) REFERENCES `gerechtsoorten` (`id`);

--
-- Beperkingen voor tabel `reservering`
--
ALTER TABLE `reservering`
  ADD CONSTRAINT `reservering_ibfk_1` FOREIGN KEY (`klant_id`) REFERENCES `klant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
