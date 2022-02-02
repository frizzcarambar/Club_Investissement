-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 02, 2022 at 01:30 PM
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
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `idCompany` int(11) NOT NULL,
  `exchange` varchar(32) NOT NULL,
  `longname` varchar(256) NOT NULL,
  `shortname` varchar(256) NOT NULL,
  `symbol` varchar(32) NOT NULL,
  `find_with` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`idCompany`, `exchange`, `longname`, `shortname`, `symbol`, `find_with`) VALUES
(1, 'NMS', 'Tesla, Inc.', 'Tesla, Inc.', 'TSLA', 'tesla'),
(2, 'NEO', 'Tesla, Inc.', 'TESLA, INC. CDR (CAD HEDGED)', 'TSLA.NE', 'tesla'),
(3, 'GER', 'Tesla, Inc.', 'TESLA INC', 'TL0.DE', 'tesla'),
(4, 'LSE', 'Leverage Shares 3x Tesla ETP', 'LEVERAGE SHARES PUBLIC LIMITED ', 'TSL3.L', 'tesla'),
(5, 'FRA', 'Tesla, Inc.', 'TESLA INC', 'TL0.F', 'tesla'),
(6, 'LSE', 'Graniteshares Financial PLC - 3X Long Tesla Daily ETP', 'GRANITESHARES FINANCIAL PLC GRA', '3LTS.L', 'tesla'),
(7, 'MEX', 'Tesla, Inc.', 'TESLA INC', 'TSLA.MX', 'tesla'),
(8, 'NMS', 'Advanced Micro Devices, Inc.', 'Advanced Micro Devices, Inc.', 'AMD', 'amd'),
(9, 'NMS', 'Amdocs Limited', 'Amdocs Limited', 'DOX', 'amd'),
(10, 'GER', 'Advanced Micro Devices, Inc.', 'ADVANCED MICRO DEVICES INC', 'AMD.DE', 'amd'),
(11, 'NAS', 'American Century Mid Cap Value Fund R6 Class', 'American Century Mid Cap Value ', 'AMDVX', 'amd'),
(12, 'PAR', 'Bouygues SA', 'BOUYGUES', 'EN.PA', 'bouygues'),
(13, 'FRA', 'Bouygues SA', 'BOUYGUES SA INH.  EO 1', 'BYG.F', 'bouygues'),
(14, 'PNK', 'Bouygues SA', 'BOUYGUES', 'BOUYF', 'bouygues'),
(15, 'IOB', 'Bouygues SA', 'BOUYGUES SA BOUYGUES ORD SHS', '0HAN.IL', 'bouygues'),
(16, 'PNK', 'Bouygues SA', 'BOUYGUES', 'BOUYY', 'bouygues'),
(59, 'PAR', 'Air France-KLM SA', 'AIR FRANCE -KLM', 'AF.PA', 'air france'),
(60, 'PNK', 'Air France-KLM SA', 'AIR FRANCE-KLM', 'AFLYY', 'air france'),
(61, 'FRA', 'Air France-KLM SA', 'AIR FRANCE-KLM', 'AFR.F', 'air france'),
(62, 'VIE', 'Air France-KLM SA', 'AIR FRANCE-KLM', 'AIRF.VI', 'air france'),
(63, 'PNK', 'Air France-KLM SA', 'AIR FRANCE-KLM', 'AFRAF', 'air france'),
(64, 'GER', 'Air France-KLM SA', 'AIR FRANCE-KLM', 'AFR.DE', 'air france'),
(65, 'DUS', 'null', 'AIR FRANCE-KLM', 'AFR.DU', 'air france'),
(66, 'NMS', 'Intel Corporation', 'Intel Corporation', 'INTC', 'intel'),
(67, 'PNK', 'Artificial Intelligence Technology Solutions Inc.', 'ARTIFICIAL INTELLIGENC TECH SOL', 'AITX', 'intel'),
(68, 'NGM', 'Intellia Therapeutics, Inc.', 'Intellia Therapeutics, Inc.', 'NTLA', 'intel'),
(69, 'NGM', 'Faraday Future Intelligent Electric Inc.', 'Faraday Future Intelligent Elec', 'FFIE', 'intel'),
(70, 'PNK', 'IntelGenx Technologies Corp.', 'INTELGENX TECHNOLOGIES CORPORAT', 'IGXT', 'intel'),
(71, 'NGM', 'Global X Robotics & Artificial Intelligence ETF', 'Global X Robotics & Artificial ', 'BOTZ', 'intel'),
(72, 'NYQ', 'Gol Linhas Aéreas Inteligentes S.A.', 'Gol Linhas Aereas Inteligentes ', 'GOL', 'intel'),
(73, 'NMS', 'Apple Inc.', 'Apple Inc.', 'AAPL', 'apple'),
(74, 'NYQ', 'Apple Hospitality REIT, Inc.', 'Apple Hospitality REIT, Inc.', 'APLE', 'apple'),
(75, 'NEO', 'Apple Inc.', 'APPLE CDR (CAD HEDGED)', 'AAPL.NE', 'apple'),
(76, 'FRA', 'Apple Inc.', 'APPLE INC', 'APC.F', 'apple'),
(77, 'GER', 'Apple Inc.', 'APPLE INC', 'APC.DE', 'apple'),
(78, 'MEX', 'Apple Inc.', 'APPLE INC', 'AAPL.MX', 'apple'),
(79, 'BUE', 'Apple Inc.', 'APPLE INC', 'AAPL.BA', 'apple'),
(80, 'NYB', 'null', 'Orange Juice Mar 22', 'OJ=F', 'orange'),
(81, 'NYQ', 'Orange S.A.', 'Orange', 'ORAN', 'orange'),
(82, 'PAR', 'Orange S.A.', 'ORANGE', 'ORA.PA', 'orange'),
(83, 'NCM', 'Orange County Bancorp, Inc.', 'Orange County Bancorp, Inc.', 'OBT', 'orange'),
(84, 'HAM', 'null', 'ORANGE', 'FTE.HM', 'orange'),
(85, 'NYB', 'null', 'Orange Juice Mar 22', 'OJH22.NYB', 'orange'),
(86, 'PNK', 'Orange Polska S.A.', 'ORANGE POLSKA SA', 'PTTWF', 'orange'),
(87, 'NYQ', 'NIKE, Inc.', 'Nike, Inc.', 'NKE', 'nike'),
(88, 'GER', 'NIKE, Inc.', 'NIKE INC', 'NKE.DE', 'nike'),
(89, 'MEX', 'NIKE, Inc.', 'NIKE INC', 'NKE.MX', 'nike'),
(90, 'FRA', 'NIKE, Inc.', 'NIKE INC', 'NKE.F', 'nike'),
(91, 'BER', 'null', 'NIKE INC', 'NKE.BE', 'nike'),
(92, 'BUE', 'NIKE, Inc.', 'NIKE INC', 'NKE.BA', 'nike'),
(93, 'HAN', 'null', 'NIKE INC', 'NKE.HA', 'nike'),
(94, 'NYQ', 'The Coca-Cola Company', 'Coca-Cola Company (The)', 'KO', 'coca cola'),
(95, 'NMS', 'Coca-Cola Consolidated, Inc.', 'Coca-Cola Consolidated, Inc.', 'COKE', 'coca cola'),
(96, 'NMS', 'Coca-Cola Europacific Partners PLC', 'Coca-Cola Europacific Partners ', 'CCEP', 'coca cola'),
(97, 'NYQ', 'Coca-Cola FEMSA, S.A.B. de C.V.', 'Coca Cola Femsa S.A.B. de C.V.', 'KOF', 'coca cola'),
(98, 'MEX', 'Coca-Cola FEMSA, S.A.B. de C.V.', 'COCA-COLA FEMSA S.A.B. DE C.V.', 'KOFUBL.MX', 'coca cola'),
(99, 'LSE', 'Coca-Cola HBC AG', 'COCA-COLA HBC AG ORD CHF6.70 (C', 'CCH.L', 'coca cola'),
(100, 'GER', 'The Coca-Cola Company', 'COCA-COLA CO', 'CCC3.DE', 'coca cola'),
(101, 'NYQ', 'Stone Harbor Emerging Markets Income Fund', 'null', 'EDF', 'edf'),
(102, 'PAR', 'Electricité de France S.A.', 'EDF', 'EDF.PA', 'edf'),
(103, 'VIE', 'Electricité de France S.A.', 'ELECTRICITE DE FRANCE SA', 'EDF.VI', 'edf'),
(104, 'SAO', 'Fundo de Investimento Imobiliário Edifício Ourinvest', 'FD INV IMOB ED OUR', 'EDFO11B.SA', 'edf'),
(105, 'TLO', 'Electricité de France S.A.', 'EDF', 'EDF-U.TI', 'edf'),
(106, 'PAR', 'null', 'Euronext G EDF 151121 GR Decrem', 'SGE2D.PA', 'edf'),
(107, 'PAR', 'null', 'Euronext G EDF 151121 PR 0.60', 'SGE2P.PA', 'edf'),
(108, 'NYQ', 'Twitter, Inc.', 'Twitter, Inc.', 'TWTR', 'twitter'),
(109, 'GER', 'Twitter, Inc.', 'TWITTER INC.  DL-,000005', 'TWR.DE', 'twitter'),
(110, 'MEX', 'Twitter, Inc.', 'TWITTER INC', 'TWTR.MX', 'twitter'),
(111, 'FRA', 'Twitter, Inc.', 'TWITTER INC.  DL-,000005', 'TWR.F', 'twitter'),
(112, 'DUS', 'null', 'TWITTER INC.  DL-,000005', 'TWR.DU', 'twitter'),
(113, 'VIE', 'Twitter, Inc.', 'TWITTER INC', 'TWTR.VI', 'twitter'),
(114, 'SAO', 'Twitter, Inc.', 'TWITTER     DRN', 'TWTR34.SA', 'twitter'),
(115, 'BER', 'null', 'FACEBOOK INC', 'FB2A.BE', 'facebook'),
(116, 'FRA', 'Meta Platforms, Inc.', 'FACEBOOK INC', 'FB2A.F', 'facebook'),
(117, 'MUN', 'null', 'FACEBOOK INC', 'FB2A.MU', 'facebook'),
(118, 'CCC', 'null', 'Facebook tokenized stock FTX USD', 'FB-USD', 'facebook'),
(119, 'HAN', 'null', 'FACEBOOK INC', 'FB2A.HA', 'facebook'),
(120, 'LSE', 'Graniteshares Financial PLC - 3X Long Facebook Daily ETP', 'GRANITESHARES FINANCIAL PLC GRA', '3LFB.L', 'facebook'),
(121, 'PAR', 'null', 'LS 1x Facebook Tracker ETP', '1FB.PA', 'facebook'),
(122, 'ASE', 'Emerson Radio Corp.', 'Emerson Radio Corporation', 'MSN', 'msn'),
(123, 'PNK', 'Mission Ready Solutions Inc.', 'MISSION READY SOLUTIONS INC', 'MSNVF', 'msn'),
(124, 'NAS', 'MFS New York Municipal Bond Fund Class A', 'MFS New York Municipal Bond Fun', 'MSNYX', 'msn'),
(125, 'NAS', 'BlackRock New Jersey Municipal Bond Fund Service Shares', 'BlackRock NJ Muni Bnd S', 'MSNJX', 'msn'),
(126, 'MCX', 'Public Joint Stock Company Mosenergo', 'MOSENERGO PJSC', 'MSNG.ME', 'msn'),
(127, 'NAS', 'MFS North Carolina Municipal Bond Fund Class A', 'MFS North Carolina Municipal Bo', 'MSNCX', 'msn'),
(128, 'STU', 'null', 'Marsh & McLennan Cos. Inc.', 'MSN.SG', 'msn'),
(129, 'NMS', 'Alphabet Inc.', 'Alphabet Inc.', 'GOOG', 'google'),
(130, 'CCC', 'null', 'Google tokenized stock FTX USD', 'GOOGL-USD', 'google'),
(131, 'CCC', 'null', 'Google tokenized stock Bittrex USD', 'GOOGL1-USD', 'google'),
(132, 'WCB', 'null', 'CBOE EQUITY VIXON GOOGLE', '^VXGOG', 'google'),
(133, 'CCC', 'null', 'Mirrored Google USD', 'mGOOGL-USD', 'google'),
(134, 'NMS', 'Microsoft Corporation', 'Microsoft Corporation', 'MSFT', 'microsoft'),
(135, 'NEO', 'null', 'MICROSOFT CDR (CAD HEDGED)', 'MSFT.NE', 'microsoft'),
(136, 'GER', 'Microsoft Corporation', 'MICROSOFT CORP', 'MSF.DE', 'microsoft'),
(137, 'MEX', 'Microsoft Corporation', 'MICROSOFT CORP', 'MSFT.MX', 'microsoft'),
(138, 'FRA', 'Microsoft Corporation', 'MICROSOFT CORP', 'MSF.F', 'microsoft'),
(139, 'BRU', 'Microsoft Corporation', 'Microsoft corp.', 'MSF.BR', 'microsoft'),
(140, 'SAO', 'Microsoft Corporation', 'MICROSOFT   DRN', 'MSFT34.SA', 'microsoft'),
(141, 'NMS', 'Amazon.com, Inc.', 'Amazon.com, Inc.', 'AMZN', 'amazon'),
(142, 'NEO', 'Amazon.com, Inc.', 'AMAZON.COM CDR (CAD HEDGED)', 'AMZN.NE', 'amazon'),
(143, 'PNK', 'Amazonas Florestal, Ltd', 'AMAZONAS FLORESTAL LTD', 'AZFL', 'amazon'),
(144, 'MEX', 'Amazon.com, Inc.', 'AMAZON COM INC', 'AMZN.MX', 'amazon'),
(145, 'GER', 'Amazon.com, Inc.', 'AMAZON COM INC', 'AMZ.DE', 'amazon'),
(146, 'FRA', 'Amazon.com, Inc.', 'AMAZON COM INC', 'AMZ.F', 'amazon'),
(147, 'SAO', 'Amazon.com, Inc.', 'AMAZON      DRN', 'AMZO34.SA', 'amazon'),
(148, 'PAR', 'Renault SA', 'RENAULT', 'RNO.PA', 'renault'),
(149, 'PNK', 'Renault SA', 'RENAULT SA', 'RNLSY', 'renault'),
(150, 'FRA', 'Renault SA', 'RENAULT INH.  EO 3,81', 'RNL.F', 'renault'),
(151, 'GER', 'Renault SA', 'RENAULT INH.  EO 3,81', 'RNL.DE', 'renault'),
(152, 'IOB', 'Renault SA', 'RENAULT SA RENAULT PAR SHS', '0NQF.IL', 'renault'),
(153, 'VIE', 'Renault SA', 'RENAULT SA', 'RNO.VI', 'renault'),
(154, 'HAM', 'null', 'RENAULT INH.  EO 3,81', 'RNL.HM', 'renault');

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
  `role` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUsers`, `mail`, `password`, `role`) VALUES
(1, 'comptetest@test.com', 'test', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`idCompany`);

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
  MODIFY `idCompany` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `idTransaction` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
