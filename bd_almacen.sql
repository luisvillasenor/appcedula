-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-06-2013 a las 14:26:07
-- Versión del servidor: 5.1.41
-- Versión de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bd_almacen`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudadanos`
--

CREATE TABLE IF NOT EXISTS `ciudadanos` (
  `ciud_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `apellido_p` varchar(50) NOT NULL,
  `apellido_m` varchar(50) NOT NULL,
  `sexo` varchar(6) NOT NULL,
  `edad` int(1) NOT NULL,
  `tel_of` varchar(10) NOT NULL,
  `tel_casa` varchar(10) NOT NULL,
  `tel_cel` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hora` varchar(5) NOT NULL COMMENT 'Horario para localizarlo',
  `fecha_alta` datetime NOT NULL,
  `num_hijos` int(11) NOT NULL,
  `domicilio` varchar(254) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `capturista` varchar(50) NOT NULL,
  `edocivil` varchar(11) NOT NULL,
  `ref_id` int(11) NOT NULL,
  `sec_id` int(11) NOT NULL,
  PRIMARY KEY (`ciud_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `ciudadanos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificados`
--

CREATE TABLE IF NOT EXISTS `clasificados` (
  `tipo_id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(35) NOT NULL,
  PRIMARY KEY (`tipo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Tipo de Necesidad' AUTO_INCREMENT=12 ;

--
-- Volcar la base de datos para la tabla `clasificados`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencias`
--

CREATE TABLE IF NOT EXISTS `dependencias` (
  `dep_id` int(11) NOT NULL AUTO_INCREMENT,
  `dependencia` varchar(254) NOT NULL,
  PRIMARY KEY (`dep_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Dependencias de Gobierno' AUTO_INCREMENT=40 ;

--
-- Volcar la base de datos para la tabla `dependencias`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distritos`
--

CREATE TABLE IF NOT EXISTS `distritos` (
  `dis_id` int(11) NOT NULL AUTO_INCREMENT,
  `distrito` varchar(3) NOT NULL,
  PRIMARY KEY (`dis_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Distritos Electorales' AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `distritos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prioridades`
--

CREATE TABLE IF NOT EXISTS `prioridades` (
  `prioridad_id` int(11) NOT NULL AUTO_INCREMENT,
  `prioridad` varchar(25) NOT NULL,
  PRIMARY KEY (`prioridad_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Nivel de Prioridad' AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `prioridades`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referencias`
--

CREATE TABLE IF NOT EXISTS `referencias` (
  `ref_id` int(11) NOT NULL AUTO_INCREMENT,
  `cp` varchar(6) NOT NULL,
  `asenta` varchar(254) NOT NULL,
  `tipo_asenta` varchar(50) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `sec_id` int(11) NOT NULL,
  PRIMARY KEY (`ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `referencias`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retro`
--

CREATE TABLE IF NOT EXISTS `retro` (
  `retro_id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `comentario` text NOT NULL,
  `solicitud_id` int(11) NOT NULL,
  `gestor` varchar(60) NOT NULL,
  PRIMARY KEY (`retro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `retro`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE IF NOT EXISTS `secciones` (
  `sec_id` int(11) NOT NULL AUTO_INCREMENT,
  `seccion` varchar(45) NOT NULL,
  `dis_id` int(11) NOT NULL,
  PRIMARY KEY (`sec_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Volcar la base de datos para la tabla `secciones`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimientos`
--

CREATE TABLE IF NOT EXISTS `seguimientos` (
  `seg_id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `comentario` text NOT NULL,
  `solicitud_id` int(11) NOT NULL,
  `gestor` varchar(60) NOT NULL,
  `tipo_seg` int(11) NOT NULL,
  PRIMARY KEY (`seg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `seguimientos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE IF NOT EXISTS `solicitudes` (
  `solicitud_id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `fecha_alta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `necesidad` text NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `prioridad_id` int(11) NOT NULL,
  `ciud_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '0',
  `dep_id` int(11) NOT NULL DEFAULT '0',
  `origen` int(11) NOT NULL,
  `capturista` varchar(100) NOT NULL,
  PRIMARY KEY (`solicitud_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Volcar la base de datos para la tabla `solicitudes`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(15) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `status`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_ult_acceso` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `grupo` varchar(13) NOT NULL,
  `sucursal` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Usuarios Miembros del Sistema' AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellido`, `usuario`, `email_address`, `password`, `fecha_creacion`, `fecha_ult_acceso`, `grupo`, `sucursal`) VALUES
(4, 'Luis Gabriel', 'Villasenor Alarcon', 'luis.villasenor', 'luisvillasenor@yahoo.com', '7c222fb2927d828af22f592134e8932480637c0d', '2013-06-04', '2013-06-04 12:31:53', 'administrador', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
