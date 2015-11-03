-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2015 a las 15:11:14
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
CREATE DATABASE IF NOT EXISTS `db_dcs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_dcs`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE IF NOT EXISTS `alumnos` (
  `lu_alu` int(10) unsigned NOT NULL,
  `apellido_alu` varchar(50) NOT NULL,
  `nom_alu` varchar(50) NOT NULL,
  `dni_alu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_catedras`
--

CREATE TABLE IF NOT EXISTS `alumnos_catedras` (
  `lu_alu` int(10) unsigned NOT NULL,
  `cod_cat` int(10) unsigned NOT NULL,
  `estado_alu_cat` int(11) NOT NULL DEFAULT '0',
  `year_alu_cat` varchar(4) NOT NULL,
  `periodo_alu_cat` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE IF NOT EXISTS `carreras` (
  `cod_carr` int(10) unsigned NOT NULL,
  `nom_carr` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catedras`
--

CREATE TABLE IF NOT EXISTS `catedras` (
  `cod_cat` int(10) unsigned NOT NULL,
  `cod_carr` int(10) unsigned NOT NULL,
  `nom_cat` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(250) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descripciones`
--

CREATE TABLE IF NOT EXISTS `descripciones` (
  `id_desc` int(10) unsigned NOT NULL,
  `id_guia` int(10) unsigned NOT NULL,
  `nom_desc` varchar(50) DEFAULT NULL,
  `contenido_desc` text
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE IF NOT EXISTS `docentes` (
  `leg_doc` int(10) unsigned NOT NULL,
  `pass` varchar(60) NOT NULL,
  `apellido_doc` varchar(50) NOT NULL,
  `nom_doc` varchar(50) NOT NULL,
  `dni_doc` int(11) DEFAULT NULL,
  `email_doc` varchar(60) DEFAULT NULL,
  `tel_doc` varchar(20) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  `privilegio` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes_catedras`
--

CREATE TABLE IF NOT EXISTS `docentes_catedras` (
  `leg_doc` int(10) unsigned NOT NULL,
  `cod_cat` int(10) unsigned NOT NULL,
  `permiso_doc` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes`
--

CREATE TABLE IF NOT EXISTS `examenes` (
  `id_exam` int(10) unsigned NOT NULL,
  `id_guia` int(10) unsigned NOT NULL,
  `cod_cat` int(10) unsigned NOT NULL,
  `lu_alu` int(10) unsigned NOT NULL,
  `leg_doc` int(10) unsigned NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `calificacion` int(11) NOT NULL DEFAULT '-1',
  `obs_exam` text,
  `porcentaje_exam` float DEFAULT NULL,
  `nota_exam` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupositems`
--

CREATE TABLE IF NOT EXISTS `grupositems` (
  `id_grupoitem` int(10) unsigned NOT NULL,
  `nom_grupoitem` varchar(255) DEFAULT NULL,
  `nro_grupoitem` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guias`
--

CREATE TABLE IF NOT EXISTS `guias` (
  `id_guia` int(10) unsigned NOT NULL,
  `tit_guia` varchar(100) NOT NULL,
  `subtit_guia` varchar(160) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guias_catedras`
--

CREATE TABLE IF NOT EXISTS `guias_catedras` (
  `id_guia` int(10) unsigned NOT NULL,
  `cod_cat` int(10) unsigned NOT NULL,
  `nro_guia` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id_item` int(10) unsigned NOT NULL,
  `nom_item` varchar(255) NOT NULL,
  `solo_texto` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itemsestudiante`
--

CREATE TABLE IF NOT EXISTS `itemsestudiante` (
  `id_itemest` int(10) unsigned NOT NULL,
  `nom_itemest` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itemsestudiante_guias`
--

CREATE TABLE IF NOT EXISTS `itemsestudiante_guias` (
  `id_itemest` int(10) unsigned NOT NULL,
  `id_guia` int(10) unsigned NOT NULL,
  `nro_item` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_examenes`
--

CREATE TABLE IF NOT EXISTS `items_examenes` (
  `id_item` int(10) unsigned NOT NULL,
  `id_exam` int(10) unsigned NOT NULL,
  `estado_item` int(11) NOT NULL DEFAULT '-1',
  `obs_item` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_guias`
--

CREATE TABLE IF NOT EXISTS `items_guias` (
  `id_item` int(10) unsigned NOT NULL,
  `id_guia` int(10) unsigned NOT NULL,
  `pon_item` int(10) unsigned NOT NULL,
  `pos_item` int(10) unsigned NOT NULL,
  `nro_item` int(10) unsigned NOT NULL,
  `id_grupoitem` int(10) unsigned DEFAULT NULL,
  `id_sec` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE IF NOT EXISTS `secciones` (
  `id_sec` int(10) unsigned NOT NULL,
  `nom_sec` varchar(100) DEFAULT NULL,
  `nro_sec` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`lu_alu`), ADD UNIQUE KEY `lu_alu` (`lu_alu`), ADD UNIQUE KEY `dni_alu` (`dni_alu`);

--
-- Indices de la tabla `alumnos_catedras`
--
ALTER TABLE `alumnos_catedras`
  ADD PRIMARY KEY (`lu_alu`,`cod_cat`), ADD KEY `cod_cat` (`cod_cat`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`cod_carr`), ADD UNIQUE KEY `cod_carr` (`cod_carr`);

--
-- Indices de la tabla `catedras`
--
ALTER TABLE `catedras`
  ADD PRIMARY KEY (`cod_cat`), ADD UNIQUE KEY `cod_cat` (`cod_cat`), ADD KEY `cod_carr` (`cod_carr`);

--
-- Indices de la tabla `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`), ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indices de la tabla `descripciones`
--
ALTER TABLE `descripciones`
  ADD PRIMARY KEY (`id_desc`), ADD KEY `id_guia` (`id_guia`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`leg_doc`), ADD UNIQUE KEY `leg_doc` (`leg_doc`), ADD UNIQUE KEY `dni_doc` (`dni_doc`);

--
-- Indices de la tabla `docentes_catedras`
--
ALTER TABLE `docentes_catedras`
  ADD PRIMARY KEY (`leg_doc`,`cod_cat`), ADD KEY `cod_cat` (`cod_cat`);

--
-- Indices de la tabla `examenes`
--
ALTER TABLE `examenes`
  ADD PRIMARY KEY (`id_exam`), ADD KEY `id_guia` (`id_guia`), ADD KEY `cod_cat` (`cod_cat`), ADD KEY `lu_alu` (`lu_alu`), ADD KEY `leg_doc` (`leg_doc`);

--
-- Indices de la tabla `grupositems`
--
ALTER TABLE `grupositems`
  ADD PRIMARY KEY (`id_grupoitem`);

--
-- Indices de la tabla `guias`
--
ALTER TABLE `guias`
  ADD PRIMARY KEY (`id_guia`);

--
-- Indices de la tabla `guias_catedras`
--
ALTER TABLE `guias_catedras`
  ADD PRIMARY KEY (`id_guia`,`cod_cat`), ADD KEY `cod_cat` (`cod_cat`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id_item`);

--
-- Indices de la tabla `itemsestudiante`
--
ALTER TABLE `itemsestudiante`
  ADD PRIMARY KEY (`id_itemest`);

--
-- Indices de la tabla `itemsestudiante_guias`
--
ALTER TABLE `itemsestudiante_guias`
  ADD PRIMARY KEY (`id_itemest`,`id_guia`), ADD KEY `id_guia` (`id_guia`);

--
-- Indices de la tabla `items_examenes`
--
ALTER TABLE `items_examenes`
  ADD PRIMARY KEY (`id_item`,`id_exam`), ADD KEY `id_exam` (`id_exam`);

--
-- Indices de la tabla `items_guias`
--
ALTER TABLE `items_guias`
  ADD PRIMARY KEY (`id_item`,`id_guia`), ADD KEY `id_guia` (`id_guia`), ADD KEY `id_grupoitem` (`id_grupoitem`), ADD KEY `id_sec` (`id_sec`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`id_sec`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `descripciones`
--
ALTER TABLE `descripciones`
  MODIFY `id_desc` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `examenes`
--
ALTER TABLE `examenes`
  MODIFY `id_exam` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `grupositems`
--
ALTER TABLE `grupositems`
  MODIFY `id_grupoitem` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `guias`
--
ALTER TABLE `guias`
  MODIFY `id_guia` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `id_item` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=155;
--
-- AUTO_INCREMENT de la tabla `itemsestudiante`
--
ALTER TABLE `itemsestudiante`
  MODIFY `id_itemest` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id_sec` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos_catedras`
--
ALTER TABLE `alumnos_catedras`
ADD CONSTRAINT `alumnos_catedras_ibfk_1` FOREIGN KEY (`lu_alu`) REFERENCES `alumnos` (`lu_alu`),
ADD CONSTRAINT `alumnos_catedras_ibfk_2` FOREIGN KEY (`cod_cat`) REFERENCES `catedras` (`cod_cat`);

--
-- Filtros para la tabla `catedras`
--
ALTER TABLE `catedras`
ADD CONSTRAINT `catedras_ibfk_1` FOREIGN KEY (`cod_carr`) REFERENCES `carreras` (`cod_carr`);

--
-- Filtros para la tabla `descripciones`
--
ALTER TABLE `descripciones`
ADD CONSTRAINT `descripciones_ibfk_1` FOREIGN KEY (`id_guia`) REFERENCES `guias` (`id_guia`);

--
-- Filtros para la tabla `docentes_catedras`
--
ALTER TABLE `docentes_catedras`
ADD CONSTRAINT `docentes_catedras_ibfk_1` FOREIGN KEY (`leg_doc`) REFERENCES `docentes` (`leg_doc`),
ADD CONSTRAINT `docentes_catedras_ibfk_2` FOREIGN KEY (`cod_cat`) REFERENCES `catedras` (`cod_cat`);

--
-- Filtros para la tabla `examenes`
--
ALTER TABLE `examenes`
ADD CONSTRAINT `examenes_ibfk_1` FOREIGN KEY (`id_guia`) REFERENCES `guias` (`id_guia`),
ADD CONSTRAINT `examenes_ibfk_2` FOREIGN KEY (`cod_cat`) REFERENCES `catedras` (`cod_cat`),
ADD CONSTRAINT `examenes_ibfk_3` FOREIGN KEY (`lu_alu`) REFERENCES `alumnos` (`lu_alu`),
ADD CONSTRAINT `examenes_ibfk_4` FOREIGN KEY (`leg_doc`) REFERENCES `docentes` (`leg_doc`);

--
-- Filtros para la tabla `guias_catedras`
--
ALTER TABLE `guias_catedras`
ADD CONSTRAINT `guias_catedras_ibfk_1` FOREIGN KEY (`id_guia`) REFERENCES `guias` (`id_guia`),
ADD CONSTRAINT `guias_catedras_ibfk_2` FOREIGN KEY (`cod_cat`) REFERENCES `catedras` (`cod_cat`);

--
-- Filtros para la tabla `itemsestudiante_guias`
--
ALTER TABLE `itemsestudiante_guias`
ADD CONSTRAINT `itemsestudiante_guias_ibfk_1` FOREIGN KEY (`id_guia`) REFERENCES `guias` (`id_guia`),
ADD CONSTRAINT `itemsestudiante_guias_ibfk_2` FOREIGN KEY (`id_itemest`) REFERENCES `itemsestudiante` (`id_itemest`);

--
-- Filtros para la tabla `items_examenes`
--
ALTER TABLE `items_examenes`
ADD CONSTRAINT `items_examenes_ibfk_1` FOREIGN KEY (`id_exam`) REFERENCES `examenes` (`id_exam`),
ADD CONSTRAINT `items_examenes_ibfk_2` FOREIGN KEY (`id_item`) REFERENCES `items` (`id_item`);

--
-- Filtros para la tabla `items_guias`
--
ALTER TABLE `items_guias`
ADD CONSTRAINT `items_guias_ibfk_1` FOREIGN KEY (`id_guia`) REFERENCES `guias` (`id_guia`),
ADD CONSTRAINT `items_guias_ibfk_2` FOREIGN KEY (`id_item`) REFERENCES `items` (`id_item`),
ADD CONSTRAINT `items_guias_ibfk_3` FOREIGN KEY (`id_grupoitem`) REFERENCES `grupositems` (`id_grupoitem`),
ADD CONSTRAINT `items_guias_ibfk_4` FOREIGN KEY (`id_sec`) REFERENCES `secciones` (`id_sec`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
