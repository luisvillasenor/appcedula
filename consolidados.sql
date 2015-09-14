-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 11, 2015 at 07:51 PM
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
-- Table structure for table `consolidados`
--

CREATE TABLE IF NOT EXISTS `consolidados` (
  `id_con` int(11) NOT NULL,
  `id_act` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL COMMENT 'Requisicion o Factura',
  `clasificacion` varchar(254) NOT NULL COMMENT 'Clasificador por Concepto de Gasto',
  `proveedor` varchar(254) NOT NULL,
  `concepto` text NOT NULL COMMENT 'Concepto solicitado',
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(11,2) NOT NULL,
  `iva` decimal(11,2) NOT NULL,
  `precio_total` decimal(11,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_ult_modificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quien_modifica` varchar(254) DEFAULT NULL,
  `status_cons` int(1) NOT NULL COMMENT 'Status del Registro'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consolidados`
--
ALTER TABLE `consolidados`
  ADD PRIMARY KEY (`id_con`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consolidados`
--
ALTER TABLE `consolidados`
  MODIFY `id_con` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
