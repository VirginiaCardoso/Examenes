-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2015 a las 19:51:47
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db_dcs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ponderacion`
--

CREATE TABLE IF NOT EXISTS `ponderacion` (
  `texto_pond` text NOT NULL,
  `nro_pond` int(11) NOT NULL,
  `max_valor` int(11) NOT NULL,
  `min_valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ponderacion`
--

INSERT INTO `ponderacion` (`texto_pond`, `nro_pond`, `max_valor`, `min_valor`) VALUES
('No Adquirida', 0, 84, 0),
('Medianamente Adquirida', 1, 89, 85),
('Adquirida', 2, 100, 90);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ponderacion`
--
ALTER TABLE `ponderacion`
  ADD UNIQUE KEY `nro` (`nro_pond`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
