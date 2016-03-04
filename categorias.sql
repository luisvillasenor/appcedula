-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2016 at 04:47 PM
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
-- Table structure for table `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(11) NOT NULL,
  `id_coord` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `id_coord`, `categoria`) VALUES
(1, 4, 'DEPORTES'),
(2, 4, 'ARTE Y CULTURA'),
(3, 4, 'INFANTIL'),
(4, 4, 'MUNICIPIOS'),
(5, 6, 'GASTRONOMIA'),
(6, 6, 'TRADICIONES'),
(7, 1, 'ESPECTACULOS'),
(8, 1, 'ENTRETENIMIENTO'),
(9, 1, 'PERMISOS'),
(10, 2, 'GASTOS ADMINISTRATIVOS'),
(11, 2, 'COMPRAS'),
(12, 5, 'DIFUSION Y MEDIOS'),
(13, 5, 'COMERCIAL'),
(14, 5, 'CONCIERTOS'),
(15, 5, 'PROMOCION'),
(16, 5, 'PUBLICIDAD'),
(17, 5, 'PATROCINIOS'),
(18, 3, 'ATENCION A COMERCIANTES'),
(22, 7, 'CATEGORIA DE PRUEBA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
