-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Lip 2020, 12:50
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `projekt`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ankieta`
--

CREATE TABLE `ankieta` (
  `Id_a` int(11) NOT NULL,
  `nazwa` text COLLATE utf8mb4_polish_ci NOT NULL,
  `data_r` date DEFAULT NULL,
  `data_k` date DEFAULT NULL,
  `id_u` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `odpowiedź`
--

CREATE TABLE `odpowiedź` (
  `Id_p` int(11) NOT NULL,
  `Treść_odpowiedzi` text COLLATE utf8mb4_polish_ci NOT NULL,
  `Czas` int(11) NOT NULL,
  `Id_u` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pytanie`
--

CREATE TABLE `pytanie` (
  `Id_p` int(11) NOT NULL,
  `Id_a` int(11) NOT NULL,
  `Treść_pytania` text COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `użytkownik`
--

CREATE TABLE `użytkownik` (
  `id_u` int(11) NOT NULL,
  `nazwa_użytkownika` text COLLATE utf8mb4_polish_ci NOT NULL,
  `login` text COLLATE utf8mb4_polish_ci NOT NULL,
  `hasło` text COLLATE utf8mb4_polish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `użytkownik`
--

INSERT INTO `użytkownik` (`id_u`, `nazwa_użytkownika`, `login`, `hasło`) VALUES
(1, 'adam', 'adam', 'adam'),
(2, 'Paweł', 'pawel', '1234');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `ankieta`
--
ALTER TABLE `ankieta`
  ADD PRIMARY KEY (`Id_a`),
  ADD KEY `id_u` (`id_u`);

--
-- Indeksy dla tabeli `odpowiedź`
--
ALTER TABLE `odpowiedź`
  ADD PRIMARY KEY (`Id_p`),
  ADD KEY `odpowiedź_ibfk_1` (`Id_u`);

--
-- Indeksy dla tabeli `pytanie`
--
ALTER TABLE `pytanie`
  ADD PRIMARY KEY (`Id_p`),
  ADD KEY `Id_a` (`Id_a`);

--
-- Indeksy dla tabeli `użytkownik`
--
ALTER TABLE `użytkownik`
  ADD PRIMARY KEY (`id_u`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `ankieta`
--
ALTER TABLE `ankieta`
  MODIFY `Id_a` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `pytanie`
--
ALTER TABLE `pytanie`
  MODIFY `Id_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `użytkownik`
--
ALTER TABLE `użytkownik`
  MODIFY `id_u` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `ankieta`
--
ALTER TABLE `ankieta`
  ADD CONSTRAINT `ankieta_ibfk_1` FOREIGN KEY (`id_u`) REFERENCES `użytkownik` (`id_u`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `odpowiedź`
--
ALTER TABLE `odpowiedź`
  ADD CONSTRAINT `odpowiedź_ibfk_1` FOREIGN KEY (`Id_u`) REFERENCES `użytkownik` (`id_u`);

--
-- Ograniczenia dla tabeli `pytanie`
--
ALTER TABLE `pytanie`
  ADD CONSTRAINT `pytanie_ibfk_1` FOREIGN KEY (`Id_a`) REFERENCES `ankieta` (`Id_a`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
