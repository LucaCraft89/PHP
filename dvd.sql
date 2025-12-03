-- phpMyAdmin SQL Dump
-- version 5.2.2deb1+deb13u1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 26, 2025 at 08:31 AM
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
  `DataEmissioneTessera` date NOT NULL,
  `password` varchar(60) NOT NULL,
  `SessionID` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `tblClienti`
--

INSERT INTO `tblClienti` (`CodTessera`, `Cognome`, `Nome`, `Via`, `NumCivico`, `Citta`, `Telefono`, `DataEmissioneTessera`, `password`, `SessionID`) VALUES
(1, 'giacomini', 'ettore', 'oslavia', 34, 'pordenone', 3515486140, '2001-09-11', '$2y$10$3VEq8y/aiocAxeQJKJFcueYRPLu5Hy67XiF1svb4EskISdHXJJ9Fm', '4d8e5b7ae1538d4dc679c0f825927f1bb2b1f24607cca95839d7a55d14ad5a9e3d364ac054976481450db36492e64f82db625667152bb6c6bda93d2927e751d12d037cc28c0f64dec4410fc9092ef531876486401f0b97fd6c56e849333a341b810f077a1a5ff1e84b45bb5ac8a5c600094cd686cc5d46f8cd4a2a2ad77b59d4d9ed160b03374c5893ea89280ee1ba6caa6dd7bdaf3ebfe33a1be9284dc0bbc0fd82b1d0462fc71f6a1177d3428eeadf05156f0096e89360c303e06eceb4c23fdfcd3e443b09b9773c302e7a56bd6225c69b267ebcef03534d1d5ed29480d3f4eaad537225127fc07f2984d482b512e6a8f741ab1e60aa5fa1b21db3a8c9695e'),
(4, 'rossi', 'giuseppe', 'rossi', 104, 'MILANO', 333333333, '2001-09-11', '$2y$12$LljYrwL3PQXohBw9NxhfbeBaMxxqmoQHMx4xN656z0TXm5kTP.1mK', '3937e1ff2a5f5f553a8778b466f65ddacb0169170dfae1ba80cff0cf08657d25c37510c527affbed281a95f2e8eab39a7e772a5dc576aee57286e69cd1c3a14fb3b86968a4299ada45a06ecdaeebc73c43c95ae202db8338b17108af1d6c886e9d40ff4b779ab5ab9f2f37b150f2844216f9a2ebac1daa4f44276a60b4806b6f05448ecfa336f111880337f1e58b88f9c854070b458bbf9046a3cb0f5fe6a75a7511c4aa39472e3493a8e5f56c8e1b90a77ff8e5b6b8910a22d63f3b74b450f6182229a774f0fb476abd953c383c49966d1db62a843effc97a8272b371afbdd4e2da1e11241173d9cd0b0473fe9e9fd5164a2714a5039a34a9db6d671cb457b5');

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
(4, 1, 5, '2025-11-20', '2025-11-26', 12),
(5, 1, 11, '2021-10-02', '9222-10-10', 12);

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
  MODIFY `CodTessera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `CodNoleggio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
