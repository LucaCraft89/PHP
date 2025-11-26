-- phpMyAdmin SQL Dump
-- version 5.2.2deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Creato il: Nov 12, 2025 alle 09:45
-- Versione del server: 11.8.3-MariaDB-0+deb13u1 from Debian
-- Versione PHP: 8.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dvd`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `tblAttori`
--

CREATE TABLE `tblAttori` (
  `CodAttore` int(11) NOT NULL,
  `Cognome` varchar(32) NOT NULL,
  `Nome` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dump dei dati per la tabella `tblAttori`
--

INSERT INTO `tblAttori` (`CodAttore`, `Cognome`, `Nome`) VALUES
(1, 'Zalone', 'Checco');

-- --------------------------------------------------------

--
-- Struttura della tabella `tblCategorie`
--

CREATE TABLE `tblCategorie` (
  `CodCategoria` int(11) NOT NULL,
  `Nome` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dump dei dati per la tabella `tblCategorie`
--

INSERT INTO `tblCategorie` (`CodCategoria`, `Nome`) VALUES
(1, 'Azione'),
(2, 'Commedia'),
(3, 'Drama');

-- --------------------------------------------------------

--
-- Struttura della tabella `tblClienti`
--

CREATE TABLE `tblClienti` (
  `CodTessera` int(11) NOT NULL,
  `Cognome` varchar(32) NOT NULL,
  `Nome` varchar(32) NOT NULL,
  `Via` varchar(128) NOT NULL,
  `NumCivico` int(11) NOT NULL,
  `Citta` varchar(64) NOT NULL,
  `Telefono` bigint(20) NOT NULL,
  `DataEmissioneTessera` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dump dei dati per la tabella `tblClienti`
--

INSERT INTO `tblClienti` (`CodTessera`, `Cognome`, `Nome`, `Via`, `NumCivico`, `Citta`, `Telefono`, `DataEmissioneTessera`) VALUES
(1, 'giacomini', 'ettore', 'oslavia', 34, 'pordenone', 3515486140, '2001-09-11'),
(3, 'dall\'acqua', 'luca3', 'montebelluna', 11, 'pordenone', 35169696, '2025-10-09');

-- --------------------------------------------------------

--
-- Struttura della tabella `tblDiretti`
--

CREATE TABLE `tblDiretti` (
  `CodDiretto` int(11) NOT NULL,
  `CodDvd` int(11) NOT NULL,
  `CodRegista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dump dei dati per la tabella `tblDiretti`
--

INSERT INTO `tblDiretti` (`CodDiretto`, `CodDvd`, `CodRegista`) VALUES
(1, 12, 1),
(2, 13, 1),
(3, 14, 1),
(4, 15, 1),
(5, 16, 2),
(6, 17, 2),
(7, 18, 2),
(8, 19, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `tblDvd`
--

CREATE TABLE `tblDvd` (
  `CodDvd` int(11) NOT NULL,
  `CodCategoria` int(11) NOT NULL,
  `Titolo` varchar(64) NOT NULL,
  `Durata` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dump dei dati per la tabella `tblDvd`
--

INSERT INTO `tblDvd` (`CodDvd`, `CodCategoria`, `Titolo`, `Durata`) VALUES
(1, 1, 'Fast&Furious 8', '02:16:02'),
(2, 2, 'Notte da leoni', '01:44:00'),
(3, 2, 'Scemo & più scemo', '01:47:00'),
(4, 2, 'Una settimana da Dio', '01:41:00'),
(5, 2, 'Miss Detective', '01:49:00'),
(6, 2, 'Zoolander', '01:30:00'),
(7, 2, 'Tutti pazzi per Mary', '01:59:00'),
(8, 2, 'Quel pazzo venerdì', '01:37:00'),
(9, 2, 'Benvenuti al Sud', '01:42:00'),
(10, 2, 'Totò, Peppino e la malafemmina', '01:46:00'),
(11, 2, 'La grande bellezza', '02:21:00'),
(12, 1, 'Le fate ignoranti', '02:00:00'),
(13, 1, 'La finestra di fronte', '01:51:00'),
(14, 1, 'Mine vaganti', '01:46:00'),
(15, 3, 'Saturno contro', '01:54:00'),
(16, 2, 'Profondo Rosso', '02:10:00'),
(17, 2, 'Suspiria', '01:41:00'),
(18, 2, 'Tenebre', '01:50:00'),
(19, 2, 'Phenomena', '01:40:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `tblInterpreti`
--

CREATE TABLE `tblInterpreti` (
  `CodInterpretato` int(11) NOT NULL,
  `CodDvd` int(11) NOT NULL,
  `CodAttore` int(11) NOT NULL,
  `Ruolo` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `tblNoleggi`
--

CREATE TABLE `tblNoleggi` (
  `CodNoleggio` int(11) NOT NULL,
  `CodTessera` int(11) NOT NULL,
  `CodDvd` int(11) NOT NULL,
  `DataNoleggio` date NOT NULL,
  `DataScadenza` date NOT NULL,
  `TariffaGiornaliera` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dump dei dati per la tabella `tblNoleggi`
--

INSERT INTO `tblNoleggi` (`CodNoleggio`, `CodTessera`, `CodDvd`, `DataNoleggio`, `DataScadenza`, `TariffaGiornaliera`) VALUES
(1, 1, 1, '2025-10-15', '2025-10-31', 1.5),
(2, 3, 1, '2025-10-02', '2025-10-25', 3),
(3, 1, 4, '2025-10-09', '2025-10-31', 4),
(4, 1, 1, '2025-11-15', '2026-02-11', 22);

-- --------------------------------------------------------

--
-- Struttura della tabella `tblRegisti`
--

CREATE TABLE `tblRegisti` (
  `CodRegista` int(11) NOT NULL,
  `Cognome` varchar(32) NOT NULL,
  `Nome` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dump dei dati per la tabella `tblRegisti`
--

INSERT INTO `tblRegisti` (`CodRegista`, `Cognome`, `Nome`) VALUES
(1, 'Ozpetek', 'Ferzan'),
(2, 'argento', 'dario');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `tblAttori`
--
ALTER TABLE `tblAttori`
  ADD PRIMARY KEY (`CodAttore`);

--
-- Indici per le tabelle `tblCategorie`
--
ALTER TABLE `tblCategorie`
  ADD PRIMARY KEY (`CodCategoria`);

--
-- Indici per le tabelle `tblClienti`
--
ALTER TABLE `tblClienti`
  ADD PRIMARY KEY (`CodTessera`);

--
-- Indici per le tabelle `tblDiretti`
--
ALTER TABLE `tblDiretti`
  ADD PRIMARY KEY (`CodDiretto`);

--
-- Indici per le tabelle `tblDvd`
--
ALTER TABLE `tblDvd`
  ADD PRIMARY KEY (`CodDvd`);

--
-- Indici per le tabelle `tblInterpreti`
--
ALTER TABLE `tblInterpreti`
  ADD PRIMARY KEY (`CodInterpretato`);

--
-- Indici per le tabelle `tblNoleggi`
--
ALTER TABLE `tblNoleggi`
  ADD PRIMARY KEY (`CodNoleggio`),
  ADD KEY `DeleteCliente` (`CodTessera`);

--
-- Indici per le tabelle `tblRegisti`
--
ALTER TABLE `tblRegisti`
  ADD PRIMARY KEY (`CodRegista`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `tblAttori`
--
ALTER TABLE `tblAttori`
  MODIFY `CodAttore` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `tblCategorie`
--
ALTER TABLE `tblCategorie`
  MODIFY `CodCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `tblClienti`
--
ALTER TABLE `tblClienti`
  MODIFY `CodTessera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `tblDiretti`
--
ALTER TABLE `tblDiretti`
  MODIFY `CodDiretto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `tblDvd`
--
ALTER TABLE `tblDvd`
  MODIFY `CodDvd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT per la tabella `tblInterpreti`
--
ALTER TABLE `tblInterpreti`
  MODIFY `CodInterpretato` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `tblNoleggi`
--
ALTER TABLE `tblNoleggi`
  MODIFY `CodNoleggio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `tblRegisti`
--
ALTER TABLE `tblRegisti`
  MODIFY `CodRegista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `tblNoleggi`
--
ALTER TABLE `tblNoleggi`
  ADD CONSTRAINT `DeleteCliente` FOREIGN KEY (`CodTessera`) REFERENCES `tblClienti` (`CodTessera`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
