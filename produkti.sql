-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql200.epizy.com
-- Generation Time: Jun 14, 2022 at 08:44 PM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_30982049_malefashion`
--

-- --------------------------------------------------------

--
-- Table structure for table `produkti`
--

CREATE TABLE `produkti` (
  `idProdukt` int(255) NOT NULL,
  `imeProdukta` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opis` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `novo` tinyint(1) NOT NULL DEFAULT 0,
  `cena` int(50) NOT NULL,
  `kategorija` int(30) NOT NULL,
  `brend` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produkti`
--

INSERT INTO `produkti` (`idProdukt`, `imeProdukta`, `opis`, `novo`, `cena`, `kategorija`, `brend`) VALUES
(3, 'Short sleeve shirt', 'Short sleeve shirtShort sleeve shirtShort sleeve shirtShort sleeve shirtShort sleeve shirtShort sleeve shirt', 0, 1, 1, 1),
(4, 'Short sleeve shirt', NULL, 0, 2, 1, 1),
(5, 'Destroyed jeans shorts', 'xaxa', 0, 3, 2, 2),
(6, 'Short swim shorts', NULL, 1, 2, 2, 2),
(8, 'Washed Slim Fit Denim', NULL, 1, 5, 4, 1),
(98, 'Sweatshirt', '', 0, 62, 5, 2),
(99, 'Long-sleeved shirt with round neck', '', 0, 63, 1, 3),
(100, 'Chino with allover print', '', 0, 64, 6, 1),
(101, 'Hoodie', '', 0, 65, 7, 3),
(102, 'Jacket with hood', '', 1, 66, 8, 3),
(103, 'Purple Hoodie', '', 0, 67, 7, 3),
(104, 'Green Hoodie', '', 1, 68, 7, 3),
(105, 'V-neck sweater', '', 0, 69, 5, 2),
(106, 'Basic pants', '', 1, 70, 6, 1),
(107, 'Shirt with baseball collar', '', 1, 71, 1, 2),
(108, 'T-shirt with round neck', '', 0, 72, 1, 2),
(109, 'Sweater in jacquard knit', '', 0, 73, 5, 2),
(110, 'High-Top Trainers', '', 0, 74, 9, 1),
(111, 'High-Top Trainers', '', 0, 75, 9, 1),
(112, 'Backpack', '', 0, 76, 10, 3),
(113, 'Necklase Silver', '', 0, 77, 10, 3),
(114, 'Beanie', '', 0, 78, 10, 1),
(115, 'Sunglasses', '', 0, 79, 10, 1),
(116, 'Sunglasses', '', 1, 80, 10, 3),
(117, 'Test', 'Test', 1, 81, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produkti`
--
ALTER TABLE `produkti`
  ADD PRIMARY KEY (`idProdukt`),
  ADD KEY `cena` (`cena`,`kategorija`,`brend`),
  ADD KEY `brend` (`brend`),
  ADD KEY `kategorija` (`kategorija`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produkti`
--
ALTER TABLE `produkti`
  MODIFY `idProdukt` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produkti`
--
ALTER TABLE `produkti`
  ADD CONSTRAINT `produkti_ibfk_1` FOREIGN KEY (`cena`) REFERENCES `cena` (`idCena`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `produkti_ibfk_2` FOREIGN KEY (`brend`) REFERENCES `brendovi` (`idBrend`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `produkti_ibfk_3` FOREIGN KEY (`kategorija`) REFERENCES `kategorije` (`idKategorija`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
