-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 15, 2022 at 12:33 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `club_investissement`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

DROP TABLE IF EXISTS `action`;
DROP TABLE IF EXISTS `company`;
DROP TABLE IF EXISTS `portefeuille`;
DROP TABLE IF EXISTS `transaction`;
DROP TABLE IF EXISTS `users`;

CREATE TABLE `action` (
  `symbol` varchar(32) NOT NULL,
  `date_achat` date NOT NULL,
  `prix_achat` float NOT NULL,
  `nombre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`symbol`, `date_achat`, `prix_achat`, `nombre`) VALUES
('TSLA', '2022-03-11', 50, 2);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `idCompany` int(11) NOT NULL,
  `exch` varchar(32) NOT NULL,
  `name` varchar(256) NOT NULL,
  `symbol` varchar(32) NOT NULL,
  `find_with` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`idCompany`, `exch`, `name`, `symbol`, `find_with`) VALUES
(1, 'NYQ', 'Dell Technologies Inc.', 'DELL', 'dell'),
(2, 'MIL', 'Banco di Desio e della Brianza S.p.A.', 'BDB.MI', 'dell'),
(3, 'HAM', 'DELL TECHS INC. C  DL-,01', '12DA.HM', 'dell'),
(4, 'LSE', 'Dell Technologies Inc.', '0A7D.L', 'dell'),
(5, 'STU', 'Banco di Desio e della Brianza S.p.A.', 'BJ7.SG', 'dell'),
(6, 'FRA', 'Dell Technologies Inc.', '12DA.F', 'dell'),
(7, 'VIE', 'Dell Technologies Inc.', 'DELL.VI', 'dell'),
(8, 'HAN', 'DELL TECHS INC. C  DL-,01', '12DA.HA', 'dell'),
(9, 'SAO', 'Dell Technologies Inc.', 'D1EL34.SA', 'dell'),
(10, 'NMS', 'Apple Inc.', 'AAPL', 'apple'),
(11, 'NYQ', 'Apple Hospitality REIT, Inc.', 'APLE', 'apple'),
(12, 'PNK', 'Apple Rush Company, Inc.', 'APRU', 'apple'),
(13, 'NAS', 'Appleseed Fund Investor Share', 'APPLX', 'apple'),
(14, 'WCB', 'CBOE EQUITY VIXON APPLE', '^VXAPL', 'apple'),
(15, 'PNK', 'Golden Apple Oil & Gas Inc.', 'GAPJ', 'apple'),
(16, 'NAS', 'Appleseed Fund Institutional Share', 'APPIX', 'apple'),
(17, 'PNK', 'Appletree Subordinatd Debt Fund', '0P000186HG', 'apple'),
(18, 'PNK', 'Appletree Subordinatd Debt Fund', '0P000186HI', 'apple'),
(19, 'NYQ', 'Helmerich & Payne, Inc.', 'HP', 'hp'),
(20, 'NYQ', 'HP Inc.', 'HPQ', 'hp'),
(21, 'NYQ', 'Hewlett Packard Enterprise Company', 'HPE', 'hp'),
(22, 'NMS', 'HighPeak Energy, Inc.', 'HPK', 'hp'),
(23, 'PNK', 'Hop-On Inc.', 'HPNN', 'hp'),
(24, 'PNK', 'Cybernetic Technologies Ltd.', 'HPIL', 'hp'),
(25, 'NYQ', 'John Hancock Preferred Income Fund', 'HPI', 'hp'),
(26, 'NYQ', 'John Hancock Preferred Income Fund II', 'HPF', 'hp'),
(27, 'NYQ', 'John Hancock Preferred Income Fund III', 'HPS', 'hp'),
(28, 'NMS', 'Apple Inc.', 'AAPL', 'appl'),
(29, 'NMS', 'Applied Materials, Inc.', 'AMAT', 'appl'),
(30, 'NMS', 'AppLovin Corporation', 'APP', 'appl'),
(31, 'NYQ', 'Apple Hospitality REIT, Inc.', 'APLE', 'appl'),
(32, 'NYQ', 'Science Applications International Corporation', 'SAIC', 'appl'),
(33, 'NMS', 'Applied Optoelectronics, Inc.', 'AAOI', 'appl'),
(34, 'NMS', 'Applied Genetic Technologies Corporation', 'AGTC', 'appl'),
(35, 'NMS', 'Applied Therapeutics, Inc.', 'APLT', 'appl'),
(36, 'PNK', 'Applied Energetics, Inc.', 'AERG', 'appl'),
(37, 'NMS', 'Applied Molecular Transport Inc.', 'AMTI', 'appl'),
(38, 'NAS', 'Future Scholar 529 College Savings Plan - Columbia Acorn Portfolio', 'CACAX', 'caca'),
(39, 'NAS', 'CACAWX', 'CACAWX', 'caca'),
(40, 'NAS', 'CACAYX', 'CACAYX', 'caca'),
(41, 'NAS', 'CACAZX', 'CACAZX', 'caca'),
(42, 'PNK', 'Ubisoft Entertainment SA', 'UBSFY', 'ubisoft'),
(43, 'PNK', 'Ubisoft Entertainment SA', 'UBSFF', 'ubisoft'),
(44, 'PAR', 'Ubisoft Entertainment SA', 'UBI.PA', 'ubisoft'),
(45, 'VIE', 'Ubisoft Entertainment SA', 'UBIS.VI', 'ubisoft'),
(46, 'TLO', 'Ubisoft Entertainment SA', 'UEN.TI', 'ubisoft'),
(47, 'DUS', 'UBISOFT ENTMT IN.EO-,0775', 'UEN.DU', 'ubisoft'),
(48, 'STU', 'Ubisoft Entertainment S.A.', 'UEN.SG', 'ubisoft'),
(49, 'FRA', 'Ubisoft Entertainment SA', 'UEN.F', 'ubisoft'),
(50, 'MEX', 'Ubisoft Entertainment SA', 'UBIN.MX', 'ubisoft'),
(51, 'BER', 'UBISOFT ENTMT IN.EO-,0775', 'UEN.BE', 'ubisoft'),
(52, 'NMS', 'Tesla, Inc.', 'TSLA', 'tesla'),
(53, 'PNK', 'Tesla Exploration Ltd.', 'TXLZF', 'tesla'),
(54, 'NEO', 'Tesla, Inc.', 'TSLA.NE', 'tesla'),
(55, 'GER', 'Tesla, Inc.', 'TL0.DE', 'tesla'),
(56, 'MEX', 'Tesla, Inc.', 'TSLA.MX', 'tesla'),
(57, 'LSE', 'Leverage Shares 3x Tesla ETP', 'TSL3.L', 'tesla'),
(58, 'FRA', 'Tesla, Inc.', 'TL0.F', 'tesla'),
(59, 'BUE', 'Tesla, Inc.', 'TSLA.BA', 'tesla'),
(60, 'LSE', 'Graniteshares Financial PLC - 3X Long Tesla Daily ETP', '3LTS.L', 'tesla'),
(61, 'STU', 'Nestle S.A. (ADRs)', 'NESM.SG', 'nestle'),
(62, 'NSI', 'Nestlé India Limited', 'NESTLEIND.NS', 'nestle'),
(63, 'BSE', 'Nestlé India Limited', 'NESTLEIND.BO', 'nestle'),
(64, 'CSE', 'NESTLE LANKA', 'NESTN0000.CM', 'nestle'),
(65, 'BER', 'NESTLE NAM. ADR/1 SF 1', 'NESM.BE', 'nestle'),
(66, 'DUS', 'NESTLE NAM. ADR/1 SF 1', 'NESM.DU', 'nestle'),
(67, 'MUN', 'NESTLE NAM. ADR/1 SF 1', 'NESM.MU', 'nestle'),
(68, 'PNK', 'Samsung Global Mid-term Master ', '0P0001H7NH', 'samsung'),
(69, 'PNK', 'Samsung Dollar Short-term Bond ', '0P00016O32', 'samsung'),
(70, 'PNK', 'Samsung Dollar Denominated US I', '0P0001N9KC', 'samsung'),
(71, 'PNK', 'Samsung Dollar Short-term Bond ', '0P0001LJEX', 'samsung'),
(72, 'PNK', 'Samsung Dollar Denominated US I', '0P0001N5AX', 'samsung'),
(73, 'PNK', 'Samsung Dollar Denominated US I', '0P0001N9QI', 'samsung'),
(74, 'PNK', 'Samsung Dollar Short-term Bond ', '0P0001LGXU', 'samsung'),
(75, 'PNK', 'Samsung Dollar Short-term Bond ', '0P000179GJ', 'samsung'),
(76, 'PNK', 'Samsung Global Mid Short-term M', '0P0001H7NG', 'samsung'),
(77, 'PNK', 'Samsung Dollar Denominated US I', '0P0001NG37', 'samsung'),
(78, 'NMS', 'Tesla, Inc.', 'TSLA', 'tsla'),
(79, 'NAS', 'Transamerica Small Cap Value A', 'TSLAX', 'tsla'),
(80, 'NEO', 'Tesla, Inc.', 'TSLA.NE', 'tsla'),
(81, 'MEX', 'Tesla, Inc.', 'TSLA.MX', 'tsla'),
(82, 'BUE', 'Tesla, Inc.', 'TSLA.BA', 'tsla'),
(83, 'SAO', 'Tesla, Inc.', 'TSLA34.SA', 'tsla'),
(84, 'MIL', 'Tesla, Inc.', 'TSLA.MI', 'tsla'),
(85, 'VIE', 'Tesla, Inc.', 'TSLA.VI', 'tsla'),
(86, 'PNK', 'Air France-KLM SA', 'AFLYY', 'air france'),
(87, 'PNK', 'Air France-KLM SA', 'AFRAF', 'air france'),
(88, 'PAR', 'Air France-KLM SA', 'AF.PA', 'air france'),
(89, 'VIE', 'Air France-KLM SA', 'AIRF.VI', 'air france'),
(90, 'TLO', 'AIR FRANCE KLM', 'AIRF-U.TI', 'air france'),
(91, 'DUS', 'AIR FRANCE-KLM', 'AFR.DU', 'air france'),
(92, 'BER', 'AIR FRANCE-KLM ADR EO 8,5', 'FQZ.BE', 'air france'),
(93, 'MUN', 'AIR FRANCE-KLM ADR EO 8,5', 'FQZ.MU', 'air france'),
(94, 'FRA', 'Air France-KLM SA', 'AFR.F', 'air france'),
(95, 'MIL', 'Air France-KLM SA', 'AF.MI', 'air france'),
(96, 'NMS', 'Alphabet Inc.', 'GOOG', 'google'),
(97, 'WCB', 'CBOE EQUITY VIXON GOOGLE', '^VXGOG', 'google');

-- --------------------------------------------------------

--
-- Table structure for table `portefeuille`
--

CREATE TABLE `portefeuille` (
  `idPortefeuille` int(11) NOT NULL,
  `starting_money` float NOT NULL,
  `current_money` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `portefeuille`
--

INSERT INTO `portefeuille` (`idPortefeuille`, `starting_money`, `current_money`) VALUES
(1, 250, 150);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `idTransaction` int(11) NOT NULL,
  `idCompany` int(11) NOT NULL,
  `price` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUsers` int(11) NOT NULL,
  `mail` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUsers`, `mail`, `password`, `role`) VALUES
(1, 'admin', 'test', 'admin'),
(2, 'analyst', 'test', 'analyst'),
(4, 'com', 'test', 'communication'),
(5, 'membre', 'test', 'membre');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`symbol`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`idCompany`);

--
-- Indexes for table `portefeuille`
--
ALTER TABLE `portefeuille`
  ADD PRIMARY KEY (`idPortefeuille`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`idTransaction`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsers`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `idCompany` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `portefeuille`
--
ALTER TABLE `portefeuille`
  MODIFY `idPortefeuille` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `idTransaction` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
