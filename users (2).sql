-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-02-2014 a las 12:49:24
-- Versión del servidor: 5.1.41
-- Versión de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `appcedula`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_ult_acceso` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `grupo` varchar(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Usuarios Miembros del Sistema' AUTO_INCREMENT=16 ;

--
-- Volcar la base de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellido`, `email_address`, `password`, `fecha_creacion`, `fecha_ult_acceso`, `grupo`) VALUES
(1, 'Luis Gabriel', 'Villasenor Alarcon', 'luisvillasenor@yahoo.com', 'fe3bc49a3f2ce06fd948086cf520a0bc0e08e0c7', '2013-04-11', '2013-12-17 11:00:33', 'administrador'),
(2, 'Leslie', 'Atilano', 'leslieatilano@capturista.com', '35a551de74ab093bfd98df8728f5675cc55a80be', '2013-05-10', '2013-09-11 12:04:55', 'gestor'),
(9, 'Celia', 'Veliz', 'celia.veliz@capturista.com', '8d13c11b860f8c7775457dd06148f03c53bf4c85', '2013-05-27', '2013-06-04 00:26:38', 'gestor'),
(15, 'Capturista', 'Capturista', 'captura@captura.com', '8d13c11b860f8c7775457dd06148f03c53bf4c85', '2013-09-11', '2013-09-11 10:39:03', 'gestor'),
(14, 'Vero', '1', 'vero@capturista.com', 'vero1', '2013-07-01', '0000-00-00 00:00:00', 'gestor');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
