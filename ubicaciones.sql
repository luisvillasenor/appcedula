-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2016 at 04:49 PM
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
-- Table structure for table `ubicaciones`
--

CREATE TABLE IF NOT EXISTS `ubicaciones` (
  `id_ubic` int(11) NOT NULL,
  `id_sede` int(11) NOT NULL,
  `ubicacion` varchar(254) NOT NULL COMMENT 'Nombre de la Ubicacion',
  `id_mun` int(2) NOT NULL DEFAULT '1' COMMENT 'ID Municipio',
  `status_ubicacion` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ubicaciones`
--

INSERT INTO `ubicaciones` (`id_ubic`, `id_sede`, `ubicacion`, `id_mun`, `status_ubicacion`) VALUES
(1, 1, 'Foro Catrina', 1, 1),
(2, 1, 'Velaria de la Isla', 1, 1),
(3, 1, 'Dentro de las instalaciones', 1, 1),
(4, 1, 'Area de Caballerizas', 1, 1),
(5, 42, 'Galería Artica', 1, 1),
(6, 33, 'Primer Cuadro de la Ciudad', 1, 1),
(7, 1, 'Pabellón Infantil', 1, 1),
(8, 1, 'Pabellón del Pan', 1, 1),
(9, 1, 'Foro Posada', 1, 1),
(10, 1, 'La Garbancera', 1, 1),
(11, 1, 'Explanada del Lago', 1, 1),
(12, 4, 'Calle Madero', 1, 1),
(13, 1, 'Pabellón Gastronómico', 1, 1),
(14, 1, 'Villa Verde', 1, 1),
(15, 1, 'Cine al Aire Libre', 1, 1),
(16, 1, 'Acceso Principal', 1, 1),
(17, 1, 'Area del Panteón de Posada', 1, 1),
(18, 1, 'Pabellón Hidrocalidad - SEDEC', 1, 1),
(19, 1, 'Pabellón Atascate Panteón - SEDRAE', 1, 1),
(20, 1, 'Pabellón Artesanal', 1, 1),
(21, 1, 'Casa de las Artesanías', 1, 1),
(22, 1, 'Mesón de Posada', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`id_ubic`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `id_ubic` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
