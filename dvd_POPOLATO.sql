-- phpMyAdmin SQL Dump
-- version 5.2.2deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 29, 2025 at 09:31 AM
-- Server version: 11.8.3-MariaDB-0+deb13u1 from Debian
-- PHP Version: 8.4.11

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
-- Table structure for table `tblAttori`
--

CREATE TABLE `tblAttori` (
  `CodAttore` int(11) NOT NULL,
  `Cognome` varchar(32) NOT NULL,
  `Nome` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `tblAttori`
--

INSERT INTO `tblAttori` (`CodAttore`, `Cognome`, `Nome`) VALUES
(1, 'Zalone', 'Checco');

-- --------------------------------------------------------

--
-- Table structure for table `tblCategorie`
--

CREATE TABLE `tblCategorie` (
  `CodCategoria` int(11) NOT NULL,
  `Nome` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `tblCategorie`
--

INSERT INTO `tblCategorie` (`CodCategoria`, `Nome`) VALUES
(1, 'Azione'),
(2, 'Commedia'),
(3, 'Drama');

-- --------------------------------------------------------

--
-- Table structure for table `tblClienti`
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
-- Dumping data for table `tblClienti`
--

INSERT INTO `tblClienti` (`CodTessera`, `Cognome`, `Nome`, `Via`, `NumCivico`, `Citta`, `Telefono`, `DataEmissioneTessera`) VALUES
(1, 'giacomini', 'ettore', 'oslavia', 34, 'pordenone', 3515486140, '2001-09-11'),
(3, 'dall\'acqua', 'luca', 'montebelluna', 11, 'pordenone', 35169696, '2025-10-09');

-- --------------------------------------------------------

--
-- Table structure for table `tblDiretti`
--

CREATE TABLE `tblDiretti` (
  `CodDiretto` int(11) NOT NULL,
  `CodDvd` int(11) NOT NULL,
  `CodRegista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `tblDiretti`
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
-- Table structure for table `tblDvd`
--

CREATE TABLE `tblDvd` (
  `CodDvd` int(11) NOT NULL,
  `CodCategoria` int(11) NOT NULL,
  `Titolo` varchar(64) NOT NULL,
  `Durata` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `tblDvd`
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
-- Table structure for table `tblInterpreti`
--

CREATE TABLE `tblInterpreti` (
  `CodInterpretato` int(11) NOT NULL,
  `CodDvd` int(11) NOT NULL,
  `CodAttore` int(11) NOT NULL,
  `Ruolo` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblNoleggi`
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
-- Dumping data for table `tblNoleggi`
--

INSERT INTO `tblNoleggi` (`CodNoleggio`, `CodTessera`, `CodDvd`, `DataNoleggio`, `DataScadenza`, `TariffaGiornaliera`) VALUES
(1, 1, 1, '2025-10-15', '2025-10-31', 1.5),
(2, 3, 1, '2025-10-02', '2025-10-25', 3),
(3, 1, 4, '2025-10-09', '2025-10-31', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tblRegisti`
--

CREATE TABLE `tblRegisti` (
  `CodRegista` int(11) NOT NULL,
  `Cognome` varchar(32) NOT NULL,
  `Nome` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `tblRegisti`
--

INSERT INTO `tblRegisti` (`CodRegista`, `Cognome`, `Nome`) VALUES
(1, 'Ozpetek', 'Ferzan'),
(2, 'argento', 'dario');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblAttori`
--
ALTER TABLE `tblAttori`
  ADD PRIMARY KEY (`CodAttore`);

--
-- Indexes for table `tblCategorie`
--
ALTER TABLE `tblCategorie`
  ADD PRIMARY KEY (`CodCategoria`);

--
-- Indexes for table `tblClienti`
--
ALTER TABLE `tblClienti`
  ADD PRIMARY KEY (`CodTessera`);

--
-- Indexes for table `tblDiretti`
--
ALTER TABLE `tblDiretti`
  ADD PRIMARY KEY (`CodDiretto`);

--
-- Indexes for table `tblDvd`
--
ALTER TABLE `tblDvd`
  ADD PRIMARY KEY (`CodDvd`);

--
-- Indexes for table `tblInterpreti`
--
ALTER TABLE `tblInterpreti`
  ADD PRIMARY KEY (`CodInterpretato`);

--
-- Indexes for table `tblNoleggi`
--
ALTER TABLE `tblNoleggi`
  ADD PRIMARY KEY (`CodNoleggio`),
  ADD KEY `DeleteCliente` (`CodTessera`);

--
-- Indexes for table `tblRegisti`
--
ALTER TABLE `tblRegisti`
  ADD PRIMARY KEY (`CodRegista`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblAttori`
--
ALTER TABLE `tblAttori`
  MODIFY `CodAttore` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblCategorie`
--
ALTER TABLE `tblCategorie`
  MODIFY `CodCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblClienti`
--
ALTER TABLE `tblClienti`
  MODIFY `CodTessera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblDiretti`
--
ALTER TABLE `tblDiretti`
  MODIFY `CodDiretto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblDvd`
--
ALTER TABLE `tblDvd`
  MODIFY `CodDvd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tblInterpreti`
--
ALTER TABLE `tblInterpreti`
  MODIFY `CodInterpretato` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblNoleggi`
--
ALTER TABLE `tblNoleggi`
  MODIFY `CodNoleggio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblRegisti`
--
ALTER TABLE `tblRegisti`
  MODIFY `CodRegista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblNoleggi`
--
ALTER TABLE `tblNoleggi`
  ADD CONSTRAINT `DeleteCliente` FOREIGN KEY (`CodTessera`) REFERENCES `tblClienti` (`CodTessera`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
