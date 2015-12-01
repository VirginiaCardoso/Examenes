-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2015 a las 15:45:07
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
-- Estructura de tabla para la tabla `items_guias`
--

CREATE TABLE IF NOT EXISTS `items_guias` (
  `id_items_guia` int(10) unsigned NOT NULL,
  `id_item` int(10) unsigned NOT NULL,
  `id_guia` int(10) unsigned NOT NULL,
  `pon_item` float unsigned NOT NULL,
  `pos_item` int(10) unsigned NOT NULL,
  `nro_item` int(10) unsigned NOT NULL,
  `id_grupoitem` int(10) unsigned DEFAULT NULL,
  `id_sec` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `items_guias`
--

INSERT INTO `items_guias` (`id_items_guia`, `id_item`, `id_guia`, `pon_item`, `pos_item`, `nro_item`, `id_grupoitem`, `id_sec`) VALUES
(2, 1, 1, 0, 1, 1, NULL, NULL),
(3, 1, 3, 0, 1, 1, NULL, NULL),
(4, 1, 4, 0, 3, 3, NULL, NULL),
(5, 1, 6, 0, 1, 1, NULL, NULL),
(6, 1, 7, 7, 1, 1, NULL, NULL),
(7, 2, 1, 0, 2, 1, 1, NULL),
(8, 2, 6, 0, 3, 2, 11, NULL),
(9, 3, 1, 0, 3, 2, 1, NULL),
(10, 3, 6, 0, 7, 6, 11, NULL),
(11, 4, 1, 0, 4, 3, 1, NULL),
(12, 5, 1, 0, 5, 4, 1, NULL),
(13, 6, 1, 0, 6, 5, 1, NULL),
(14, 7, 1, 0, 7, 6, 1, NULL),
(15, 7, 3, 0, 2, 1, 8, NULL),
(16, 7, 4, 0, 5, 2, 9, NULL),
(17, 7, 6, 0, 2, 1, 11, NULL),
(18, 7, 7, 0.5, 2, 1, 12, NULL),
(19, 8, 1, 0, 8, 7, 1, NULL),
(20, 8, 6, 0, 8, 7, 11, NULL),
(21, 9, 1, 0, 9, 8, 1, NULL),
(22, 9, 3, 0, 4, 3, 8, NULL),
(23, 9, 4, 0, 7, 4, 9, NULL),
(24, 9, 6, 0, 5, 4, 11, NULL),
(25, 10, 1, 0, 10, 9, 1, NULL),
(26, 10, 3, 0, 5, 4, 8, NULL),
(27, 10, 4, 0, 8, 5, 9, NULL),
(28, 10, 6, 0, 6, 5, 11, NULL),
(29, 11, 1, 0, 11, 10, 1, NULL),
(30, 12, 1, 0, 12, 11, 1, NULL),
(31, 13, 1, 0, 13, 3, NULL, NULL),
(32, 13, 4, 0, 1, 1, NULL, NULL),
(33, 14, 1, 0, 14, 4, NULL, NULL),
(34, 14, 3, 0, 8, 5, NULL, NULL),
(35, 14, 4, 0, 2, 2, NULL, NULL),
(36, 14, 6, 0, 11, 5, NULL, NULL),
(37, 15, 1, 0, 15, 5, NULL, NULL),
(38, 16, 1, 0, 16, 6, NULL, NULL),
(39, 17, 1, 0, 17, 1, 2, NULL),
(40, 18, 1, 0, 18, 2, 2, NULL),
(41, 19, 1, 0, 19, 3, 2, NULL),
(42, 20, 1, 0, 20, 4, 2, NULL),
(43, 21, 1, 0, 21, 5, 2, NULL),
(44, 22, 1, 0, 22, 6, 2, NULL),
(45, 23, 1, 0, 23, 1, 3, NULL),
(46, 24, 1, 0, 24, 2, 3, NULL),
(47, 25, 1, 0, 25, 3, 3, NULL),
(48, 26, 1, 0, 26, 1, 4, NULL),
(49, 27, 1, 0, 27, 2, 4, NULL),
(50, 28, 1, 0, 28, 3, 4, NULL),
(51, 29, 1, 0, 29, 4, 4, NULL),
(52, 30, 1, 0, 30, 1, 5, NULL),
(53, 31, 1, 0, 31, 2, 5, NULL),
(54, 32, 1, 0, 32, 1, 6, NULL),
(55, 33, 1, 0, 33, 2, 6, NULL),
(56, 34, 1, 0, 34, 12, NULL, NULL),
(57, 35, 1, 0, 35, 13, NULL, NULL),
(58, 36, 1, 0, 36, 14, NULL, NULL),
(59, 36, 3, 0, 17, 14, NULL, NULL),
(60, 36, 4, 0, 23, 14, NULL, NULL),
(61, 36, 6, 0, 16, 10, NULL, NULL),
(62, 37, 1, 0, 37, 15, NULL, NULL),
(63, 37, 3, 0, 18, 15, NULL, NULL),
(64, 37, 6, 0, 17, 11, NULL, NULL),
(65, 38, 2, 0, 1, 1, NULL, 1),
(66, 39, 2, 0, 2, 2, NULL, 1),
(67, 40, 2, 0, 3, 1, 7, 1),
(68, 41, 2, 0, 4, 2, 7, 1),
(69, 42, 2, 0, 5, 3, 7, 1),
(70, 43, 2, 0, 6, 4, 7, 1),
(71, 44, 2, 0, 7, 5, 7, 1),
(72, 45, 2, 0, 8, 4, NULL, 1),
(73, 46, 2, 0, 9, 5, NULL, 1),
(74, 47, 2, 0, 10, 6, NULL, 1),
(75, 48, 2, 0, 11, 1, NULL, 2),
(76, 49, 2, 0, 12, 2, NULL, 2),
(77, 50, 2, 0, 13, 3, NULL, 2),
(78, 51, 2, 0, 14, 4, NULL, 2),
(79, 52, 2, 0, 15, 5, NULL, 2),
(80, 53, 2, 0, 16, 1, NULL, 3),
(81, 54, 2, 0, 17, 2, NULL, 3),
(82, 55, 2, 0, 18, 3, NULL, 3),
(83, 56, 2, 0, 19, 4, NULL, 3),
(84, 57, 2, 0, 20, 1, NULL, 4),
(85, 58, 2, 0, 21, 2, NULL, 4),
(86, 59, 2, 0, 22, 1, NULL, 5),
(87, 60, 2, 0, 23, 2, NULL, 5),
(88, 61, 2, 0, 24, 3, NULL, 5),
(89, 62, 3, 0, 3, 2, 8, NULL),
(90, 63, 3, 0, 6, 3, NULL, NULL),
(91, 63, 6, 0, 9, 3, NULL, NULL),
(92, 64, 3, 0, 7, 4, NULL, NULL),
(93, 64, 6, 0, 10, 4, NULL, NULL),
(94, 65, 3, 0, 9, 6, NULL, NULL),
(95, 66, 3, 0, 10, 7, NULL, NULL),
(96, 67, 3, 0, 11, 8, NULL, NULL),
(97, 68, 3, 0, 12, 9, NULL, NULL),
(98, 69, 3, 0, 13, 10, NULL, NULL),
(99, 70, 3, 0, 14, 11, NULL, NULL),
(100, 71, 3, 0, 15, 12, NULL, NULL),
(101, 72, 3, 0, 16, 13, NULL, NULL),
(102, 73, 4, 0, 4, 1, 9, NULL),
(103, 74, 4, 0, 6, 3, 9, NULL),
(104, 75, 4, 0, 9, 5, NULL, NULL),
(105, 76, 4, 0, 10, 6, NULL, NULL),
(106, 77, 4, 0, 11, 7, NULL, NULL),
(107, 78, 4, 0, 12, 1, 10, NULL),
(108, 79, 4, 0, 13, 2, 10, NULL),
(109, 80, 4, 0, 14, 3, 10, NULL),
(110, 81, 4, 0, 15, 4, 10, NULL),
(111, 82, 4, 0, 16, 5, 10, NULL),
(112, 83, 4, 0, 17, 6, 10, NULL),
(113, 84, 4, 0, 18, 9, NULL, NULL),
(114, 85, 4, 0, 19, 10, NULL, NULL),
(115, 86, 4, 0, 20, 11, NULL, NULL),
(116, 87, 4, 0, 21, 12, NULL, NULL),
(117, 88, 4, 0, 22, 13, NULL, NULL),
(118, 89, 4, 0, 24, 15, NULL, NULL),
(119, 90, 5, 0, 1, 1, NULL, NULL),
(120, 91, 5, 0, 2, 2, NULL, NULL),
(121, 92, 5, 0, 3, 3, NULL, NULL),
(122, 93, 5, 0, 4, 4, NULL, NULL),
(123, 94, 5, 0, 5, 5, NULL, NULL),
(124, 95, 5, 0, 6, 6, NULL, NULL),
(125, 96, 5, 0, 7, 7, NULL, NULL),
(126, 97, 5, 0, 8, 8, NULL, NULL),
(127, 98, 5, 0, 9, 9, NULL, NULL),
(128, 99, 5, 0, 10, 10, NULL, NULL),
(129, 100, 5, 0, 11, 11, NULL, NULL),
(130, 101, 5, 0, 12, 12, NULL, NULL),
(131, 102, 5, 0, 13, 13, NULL, NULL),
(132, 103, 5, 0, 14, 14, NULL, NULL),
(133, 104, 5, 0, 15, 15, NULL, NULL),
(134, 105, 5, 0, 16, 16, NULL, NULL),
(135, 106, 5, 0, 17, 17, NULL, NULL),
(136, 107, 5, 0, 18, 18, NULL, NULL),
(137, 108, 5, 0, 19, 19, NULL, NULL),
(138, 109, 5, 0, 20, 20, NULL, NULL),
(139, 110, 5, 0, 21, 21, NULL, NULL),
(140, 111, 6, 0, 4, 3, 11, NULL),
(141, 112, 6, 0, 12, 6, NULL, NULL),
(142, 113, 6, 0, 13, 7, NULL, NULL),
(143, 114, 6, 0, 14, 8, NULL, NULL),
(144, 115, 6, 0, 15, 9, NULL, NULL),
(145, 116, 7, 0.1, 3, 2, 12, NULL),
(146, 117, 7, 0.1, 4, 3, 12, NULL),
(147, 118, 7, 0.1, 5, 4, 12, NULL),
(148, 119, 7, 0.4, 5, 4, 12, NULL),
(149, 120, 7, 1, 6, 5, 12, NULL),
(150, 121, 7, 1, 7, 6, 12, NULL),
(151, 122, 7, 1, 8, 7, 12, NULL),
(152, 123, 7, 1, 9, 8, 12, NULL),
(153, 124, 7, 1, 10, 9, 12, NULL),
(154, 125, 7, 1, 11, 10, 12, NULL),
(155, 126, 7, 1, 12, 11, 12, NULL),
(156, 127, 7, 1, 13, 12, 12, NULL),
(158, 128, 7, 1, 14, 13, 12, NULL),
(159, 129, 7, 1, 15, 14, 12, NULL),
(160, 130, 7, 0.4, 16, 15, 12, NULL),
(161, 131, 7, 0.4, 17, 16, 12, NULL),
(162, 132, 7, 0.5, 18, 17, 12, NULL),
(163, 133, 7, 0.5, 19, 18, 12, NULL),
(164, 134, 7, 1, 20, 3, NULL, NULL),
(165, 135, 7, 5, 21, 4, NULL, NULL),
(166, 136, 7, 1, 22, 5, NULL, NULL),
(167, 137, 7, 10, 23, 6, NULL, NULL),
(168, 138, 7, 15, 24, 7, NULL, NULL),
(169, 139, 7, 10, 25, 8, NULL, NULL),
(170, 140, 7, 5, 26, 9, NULL, NULL),
(171, 141, 7, 5, 27, 10, NULL, NULL),
(172, 142, 7, 10, 28, 11, NULL, NULL),
(173, 143, 7, 2, 29, 12, NULL, NULL),
(174, 144, 7, 2, 30, 13, NULL, NULL),
(175, 145, 7, 2, 31, 14, NULL, NULL),
(176, 146, 7, 1, 32, 15, NULL, NULL),
(177, 147, 7, 1, 33, 16, NULL, NULL),
(178, 148, 7, 1, 34, 17, NULL, NULL),
(179, 149, 7, 1, 35, 18, NULL, NULL),
(180, 150, 7, 2, 36, 19, NULL, NULL),
(181, 151, 7, 5, 37, 20, NULL, NULL),
(182, 152, 7, 1, 38, 21, NULL, NULL),
(183, 153, 8, 1, 1, 1, NULL, NULL),
(184, 154, 8, 1, 2, 2, NULL, NULL),
(185, 155, 8, 1, 3, 3, NULL, NULL),
(186, 156, 8, 7, 4, 4, NULL, NULL),
(187, 157, 8, 10, 5, 5, NULL, NULL),
(188, 158, 8, 10, 6, 6, NULL, NULL),
(189, 159, 8, 10, 7, 7, NULL, NULL),
(190, 160, 8, 10, 8, 8, NULL, NULL),
(191, 161, 8, 10, 9, 9, NULL, NULL),
(192, 162, 8, 10, 10, 10, NULL, NULL),
(193, 163, 8, 10, 11, 11, NULL, NULL),
(194, 164, 8, 10, 12, 12, NULL, NULL),
(195, 165, 8, 10, 13, 13, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `items_guias`
--
ALTER TABLE `items_guias`
  ADD PRIMARY KEY (`id_items_guia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `items_guias`
--
ALTER TABLE `items_guias`
  MODIFY `id_items_guia` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=197;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
