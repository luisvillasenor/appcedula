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
-- Table structure for table `sedes`
--

CREATE TABLE IF NOT EXISTS `sedes` (
  `id_sede` int(11) NOT NULL,
  `sede` varchar(254) NOT NULL COMMENT 'Nombre de la Sede',
  `id_mun` int(2) NOT NULL DEFAULT '1' COMMENT 'ID Municipio',
  `status_sede` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sedes`
--

INSERT INTO `sedes` (`id_sede`, `sede`, `id_mun`, `status_sede`) VALUES
(1, 'Isla San Marcos', 1, 1),
(2, 'Teatro Aguascalientes', 1, 1),
(3, 'Panteón de la Salud', 1, 1),
(4, 'Centro Histórico', 1, 1),
(5, 'Palacio de Gobierno', 1, 1),
(6, 'Casa de la Cultura Víctor Sandoval', 1, 1),
(7, 'Parque El Cedazo', 1, 1),
(8, 'Centro Cultural Los Arquitos', 1, 1),
(9, 'Ex Escuela de Cristo', 1, 1),
(10, 'Club Deportivo Futurama', 1, 1),
(11, 'Deportivo Ferrocarrilero', 1, 1),
(12, 'Gimnasio Olímpico de Aguascalientes', 1, 1),
(13, 'Diferentes ubicaciones', 8, 1),
(14, 'Panteón de Guadalupe', 2, 1),
(15, 'Ex Convento del Señor del Tepozán', 2, 1),
(16, 'Biblioteca Pública Municipal', 5, 1),
(17, 'Lienzo Charro del Municipio', 5, 1),
(18, 'Plaza Principal', 5, 1),
(19, 'Diferentes ubicaciones', 6, 1),
(20, 'Edificio conocido como La Vinata', 6, 1),
(21, 'Casa de la Cultura', 6, 1),
(22, 'Casa de la Cultura', 11, 1),
(23, 'Explanada del Jarín Juárez', 4, 1),
(24, 'Biblioteca Pública Municipal', 10, 1),
(25, 'Kiosco de la Plaza Principal', 10, 1),
(26, 'Jardín Juárez', 7, 1),
(27, 'Auditorio de la Casa de la Cultura', 9, 1),
(28, 'Calle Juárez', 9, 1),
(29, 'Castillo de las Calaveras', 3, 1),
(30, 'Plaza Monumental', 1, 1),
(31, 'Teatro Morelos', 1, 1),
(32, 'Club Campestre', 1, 1),
(33, 'Centro de la Ciudad', 1, 1),
(34, 'Campo de Tiro IDEA', 1, 1),
(35, 'Zona de Playas', 8, 1),
(36, 'Plaza del Auditorio Municipal', 11, 1),
(37, 'Andador Centenario', 3, 1),
(38, 'Teatro del Pueblo', 3, 1),
(39, 'Casa de las Artesanías', 1, 1),
(40, 'Plaza Tres Centurias', 1, 1),
(41, 'Centro Comercial Plaza Universidad', 1, 1),
(42, 'Museo Guadalupe Posada', 1, 1),
(43, 'Biblioteca Pública Municipal de la Casa de la Cultura', 6, 1),
(44, 'Biblioteca Pública Municipal Emiliano Zapata', 6, 1),
(45, 'Patio de la Casa de la Cultura', 10, 1),
(46, 'Auditorio e Instalaciones de la Casa de la Cultura', 10, 1),
(47, 'Biblioteca Pública Municipal', 6, 1),
(48, 'Comunidad de San Luis de Letras', 6, 1),
(49, 'Biblioteca Pública Municipal Profesor Enrique Olivares Santana', 6, 1),
(50, 'Plaza San Marcos', 1, 1),
(51, 'Centro de Extensión Cultural en la comunidad de San Antonio', 9, 1),
(52, 'Cerro del Muerto', 1, 1),
(53, 'Jardín de San Marcos', 1, 1),
(54, 'Velaria Expo Plaza', 1, 1),
(55, 'Drinkinteam Gotcha Club', 1, 1),
(56, 'Gran Hotel Alameda', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id_sede`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sedes`
--
ALTER TABLE `sedes`
  MODIFY `id_sede` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
