-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-08-2013 a las 04:56:49
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `formulariopdf`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE IF NOT EXISTS `solicitud` (
  `idsolicitud` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `director` varchar(200) NOT NULL,
  `correodirector` varchar(200) NOT NULL,
  `materia` varchar(200) NOT NULL,
  `clave` varchar(200) NOT NULL,
  `curso` varchar(200) NOT NULL,
  `cuatri` varchar(200) NOT NULL,
  `unidades` varchar(200) NOT NULL,
  `numestudiantes` varchar(200) NOT NULL,
  `carrera` varchar(200) NOT NULL,
  `fechai` varchar(200) NOT NULL,
  `fechaf` varchar(200) NOT NULL,
  `profesores` varchar(200) NOT NULL,
  `justificacion` varchar(200) NOT NULL,
  `actividades` varchar(200) NOT NULL,
  PRIMARY KEY (`idsolicitud`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`idsolicitud`, `nombre`, `correo`, `director`, `correodirector`, `materia`, `clave`, `curso`, `cuatri`, `unidades`, `numestudiantes`, `carrera`, `fechai`, `fechaf`, `profesores`, `justificacion`, `actividades`) VALUES
(47, 'hola', 'h', 'h', 'hh', 'h', 'h', 'h', '2', '2', 'h', 'Ingenieria en Sistemas Computacionales', '2013-08-20', '2013-08-28', 'h', 'h', 'h'),
(48, 'k', 'k', 'k', 'k', 'k', 'k', 'k', '3', '2', 'k', 'Ingenieria en Tecnologias de Manufactura', '2013-08-01', '2013-08-22', 'k', 'k', 'k'),
(49, 'Juan AndrÃ©s', 'jagarmorales@gmail.com', 'Ely Karina', 'karina.anaya@upq.edu.mx', 'Operativos', 'SOD-ED', 'OPERATIVOS', '5', '4', '80', 'Ing. Sistemas Computacionales', '2013-08-08', '2013-08-19', 'juan andres', 'tests', 'foros');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
