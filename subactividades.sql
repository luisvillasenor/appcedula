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
-- Table structure for table `subactividades`
--

CREATE TABLE IF NOT EXISTS `subactividades` (
  `id_subact` int(11) NOT NULL,
  `id_act` int(11) NOT NULL,
  `subactividad` varchar(254) NOT NULL,
  `fecha_taller` date NOT NULL,
  `sede` varchar(250) NOT NULL,
  `ubicacion` varchar(254) NOT NULL,
  `hora_ini` time NOT NULL DEFAULT '08:00:00',
  `hora_fin` time NOT NULL DEFAULT '24:00:00',
  `status_subact` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subactividades`
--
ALTER TABLE `subactividades`
  ADD PRIMARY KEY (`id_subact`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subactividades`
--
ALTER TABLE `subactividades`
  MODIFY `id_subact` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
