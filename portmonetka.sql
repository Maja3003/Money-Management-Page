-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2023 at 10:05 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portmonetka`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `LOGIN` varchar(32) NOT NULL,
  `PASSWORD` varchar(32) NOT NULL,
  `EMAIL` varchar(32) NOT NULL,
  `Wydatki_transport` int(11) NOT NULL,
  `Wydatki_zakupy` int(11) NOT NULL,
  `Wydatki_zdrowie` int(11) NOT NULL,
  `Wydatki_aktywnosc` int(11) NOT NULL,
  `Wydatki_jedzenie` int(11) NOT NULL,
  `Wydatki_wynajem` int(11) NOT NULL,
  `przychod` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `LOGIN`, `PASSWORD`, `EMAIL`, `Wydatki_transport`, `Wydatki_zakupy`, `Wydatki_zdrowie`, `Wydatki_aktywnosc`, `Wydatki_jedzenie`, `Wydatki_wynajem`, `przychod`) VALUES
(20, 'MariuszElf12', 'MarioMario', 'Mario@wp.pl', 0, 30, 0, 129, 503, 0, 3100);

-- --------------------------------------------------------

--
-- Table structure for table `wydatkihistoria`
--

CREATE TABLE `wydatkihistoria` (
  `ID` int(11) NOT NULL,
  `wydatekNazwa` varchar(40) NOT NULL,
  `kwota` float NOT NULL,
  `idUser` int(11) NOT NULL,
  `Opis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wydatkihistoria`
--

INSERT INTO `wydatkihistoria` (`ID`, `wydatekNazwa`, `kwota`, `idUser`, `Opis`) VALUES
(15, 'przychod', 3100, 20, 'Praca'),
(16, 'aktywnosc', 129, 20, 'Siłownia'),
(17, 'jedzenie', 500, 20, 'Akademik'),
(18, 'jedzenie', 3, 20, 'Pasztet'),
(19, 'zakupy', 30, 20, 'Szminka');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `wydatkihistoria`
--
ALTER TABLE `wydatkihistoria`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Opis` (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `wydatkihistoria`
--
ALTER TABLE `wydatkihistoria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
