-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 23 okt 2024 om 17:03
-- Serverversie: 10.4.27-MariaDB
-- PHP-versie: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `86712`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `accounts_docenten`
--

CREATE TABLE `accounts_docenten` (
  `id` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `voornaam` varchar(256) NOT NULL,
  `achternaam` varchar(256) NOT NULL,
  `wachtwoord` varchar(256) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `accounts_docenten`
--

INSERT INTO `accounts_docenten` (`id`, `email`, `voornaam`, `achternaam`, `wachtwoord`, `level`) VALUES
(2, 'docent@glr.nl', 'Docent', 'DocentAchternaam', '$2y$10$BC3g6MX/H9.Kn3RxzAEqYuFFmlfLC5H8HjPrl.DcuNfu7oiKmofNi', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `accounts_studenten`
--

CREATE TABLE `accounts_studenten` (
  `id` int(11) NOT NULL,
  `studentnummer` int(10) NOT NULL,
  `voornaam` varchar(256) NOT NULL,
  `achternaam` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `wachtwoord` varchar(256) NOT NULL,
  `klas` varchar(256) NOT NULL,
  `adres` varchar(256) NOT NULL,
  `postcode` varchar(256) NOT NULL,
  `woonplaats` varchar(256) NOT NULL,
  `leeftijd` int(10) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `accounts_studenten`
--

INSERT INTO `accounts_studenten` (`id`, `studentnummer`, `voornaam`, `achternaam`, `email`, `wachtwoord`, `klas`, `adres`, `postcode`, `woonplaats`, `leeftijd`, `level`) VALUES
(1, 86712, 'Sem', 'Jansen', '86712@glr.nl', '$2y$10$uQ1cUwEVXKw6iD9eLLQZ5OgsZLGgCqz6FBUt.nVbhegMI3EtTYDHC', '1A', 'Nassauhavenpad', '3071JZ', 'Rotterdam', 19, 1),
(2, 12345, 'Joost', 'Jaap', '12345@glr.nl', '$2y$10$ZqCe.FYN2Mduz4WAf3IJGOttNP/VHMqq4REtgnJ7X03EzzFRAAo.i', '1B', 'Zwartjanstraat', '3333XE', 'Zwijndrecht', 17, 1),
(3, 87761, 'Timo', 'Wuurman', '87761@glr.nl', '$2y$10$4EVgMahZnV2WP69FnbWn3uc3ecGwVIutAc6KfVHngyGwD5OZgHn6G', '1B', 'Westblaak 92', '2121WX', 'Amsterdam', 14, 1),
(4, 11111, 'TestAcc', 'TestAcc', '11111@glr.nl', '$2y$10$Mt.w1AQPd90/2QccMjZ9F.JaBa1AhMRzVe0naggFJyRxLnKKegv7.', '1A', 'Teststraat', '3030ZZ', 'Rotterdam', 20, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `formulier_student`
--

CREATE TABLE `formulier_student` (
  `id` int(11) NOT NULL,
  `studentnummer` int(11) NOT NULL,
  `vraag_1` int(11) NOT NULL,
  `vraag_2` int(11) NOT NULL,
  `vraag_3` varchar(256) NOT NULL,
  `vraag_4` enum('Te vroeg','Goed','Te laat','') NOT NULL,
  `vraag_5` enum('Te vroeg','Goed','Te laat','') NOT NULL,
  `vraag_6` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `formulier_student`
--

INSERT INTO `formulier_student` (`id`, `studentnummer`, `vraag_1`, `vraag_2`, `vraag_3`, `vraag_4`, `vraag_5`, `vraag_6`) VALUES
(1, 86712, 2, 12, 'Trein Tram Metro ', 'Te vroeg', 'Te laat', 'Hopelijk werkt dit.'),
(2, 12345, 15, 45, 'Trein Tram Metro Bus ', 'Te vroeg', 'Goed', 'Perfecte school!'),
(4, 87761, 12, 12, 'Trein Tram Metro ', 'Te vroeg', 'Te vroeg', 'tawtwa');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `accounts_docenten`
--
ALTER TABLE `accounts_docenten`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `accounts_studenten`
--
ALTER TABLE `accounts_studenten`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `formulier_student`
--
ALTER TABLE `formulier_student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `accounts_docenten`
--
ALTER TABLE `accounts_docenten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `accounts_studenten`
--
ALTER TABLE `accounts_studenten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `formulier_student`
--
ALTER TABLE `formulier_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
