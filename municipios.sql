-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2016 at 04:48 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `appcedula`
--

-- --------------------------------------------------------

--
-- Table structure for table `municipios`
--

CREATE TABLE IF NOT EXISTS `municipios` (
  `id_mun` int(11) NOT NULL,
  `municipio` varchar(25) NOT NULL COMMENT 'Nombre del Municipio'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `municipios`
--

INSERT INTO `municipios` (`id_mun`, `municipio`) VALUES
(1, 'Aguascalientes'),
(2, 'Asientos'),
(3, 'Calvillo'),
(4, 'Cosío'),
(5, 'Jesús María'),
(6, 'Pabellón de Arteaga'),
(7, 'Rincón de Romos'),
(8, 'San José de Gracia'),
(9, 'Tepezalá'),
(10, 'El Llano'),
(11, 'San Francisco de los Romo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id_mun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id_mun` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
