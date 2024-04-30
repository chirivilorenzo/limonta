-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 30, 2024 alle 11:14
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `limonta`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE `cliente` (
  `ID` int(11) NOT NULL,
  `codice` char(6) NOT NULL,
  `nome` varchar(16) NOT NULL,
  `cognome` varchar(32) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `numTelefono` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`ID`, `codice`, `nome`, `cognome`, `username`, `password`, `email`, `numTelefono`) VALUES
(1, 'gg1234', 'a', 'a', 'mario', 'rossi', 'gg@gmail.com', '12');

-- --------------------------------------------------------

--
-- Struttura della tabella `dipendente`
--

CREATE TABLE `dipendente` (
  `ID` int(11) NOT NULL,
  `nome` varchar(16) NOT NULL,
  `cognome` varchar(32) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `numTelefono` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `dipendente`
--

INSERT INTO `dipendente` (`ID`, `nome`, `cognome`, `username`, `password`, `email`, `numTelefono`) VALUES
(1, 'b', 'b', 'gianluca', 'torre', 'abc@gmail', '122');

-- --------------------------------------------------------

--
-- Struttura della tabella `dipendente_ricket`
--

CREATE TABLE `dipendente_ricket` (
  `ID` int(11) NOT NULL,
  `idDipendente` int(11) NOT NULL,
  `idTicket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `ticket`
--

CREATE TABLE `ticket` (
  `ID` int(11) NOT NULL,
  `codiceCliente` char(6) NOT NULL,
  `stato` enum('aperto','chiuso','sospeso','annullato') NOT NULL,
  `area` enum('Area PC e reti','AS400','Java','Contabilità','Formatori','Derma','Terzisti','Commerciali') NOT NULL,
  `breveDescrizione` varchar(64) NOT NULL,
  `descrizione` text NOT NULL,
  `dataApertura` datetime NOT NULL,
  `categoria` varchar(32) NOT NULL,
  `userDipendente` varchar(16) NOT NULL,
  `soluzioneProblema` varchar(64) DEFAULT NULL,
  `dataChiusura` datetime DEFAULT NULL,
  `idTicketRif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `ticket`
--

INSERT INTO `ticket` (`ID`, `codiceCliente`, `stato`, `area`, `breveDescrizione`, `descrizione`, `dataApertura`, `categoria`, `userDipendente`, `soluzioneProblema`, `dataChiusura`, `idTicketRif`) VALUES
(1, 'gg1234', 'aperto', 'Area PC e reti', '', 'no', '2024-04-19 13:48:53', 'niente', 'gianluca', NULL, '2024-04-19 13:48:53', NULL);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`,`numTelefono`),
  ADD UNIQUE KEY `codice` (`codice`),
  ADD KEY `codice_2` (`codice`);

--
-- Indici per le tabelle `dipendente`
--
ALTER TABLE `dipendente`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`,`email`,`numTelefono`);

--
-- Indici per le tabelle `dipendente_ricket`
--
ALTER TABLE `dipendente_ricket`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idDipendente` (`idDipendente`,`idTicket`),
  ADD KEY `idTicket` (`idTicket`);

--
-- Indici per le tabelle `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `emailCliente` (`codiceCliente`),
  ADD UNIQUE KEY `codiceCliente` (`codiceCliente`),
  ADD KEY `idTicketRif` (`idTicketRif`),
  ADD KEY `userDipendenteChiuso` (`userDipendente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `dipendente`
--
ALTER TABLE `dipendente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `dipendente_ricket`
--
ALTER TABLE `dipendente_ricket`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `dipendente_ricket`
--
ALTER TABLE `dipendente_ricket`
  ADD CONSTRAINT `dipendente_ricket_ibfk_1` FOREIGN KEY (`idDipendente`) REFERENCES `dipendente` (`ID`),
  ADD CONSTRAINT `dipendente_ricket_ibfk_2` FOREIGN KEY (`idTicket`) REFERENCES `ticket` (`ID`);

--
-- Limiti per la tabella `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`idTicketRif`) REFERENCES `ticket` (`ID`),
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`userDipendente`) REFERENCES `dipendente` (`username`),
  ADD CONSTRAINT `ticket_ibfk_4` FOREIGN KEY (`codiceCliente`) REFERENCES `cliente` (`codice`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
