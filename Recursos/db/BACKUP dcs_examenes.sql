-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2014 a las 17:54:53
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `dcs_examenes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE IF NOT EXISTS `alumnos` (
  `lu_alu` int(10) unsigned NOT NULL,
  `apellido_alu` varchar(50) NOT NULL,
  `nom_alu` varchar(50) NOT NULL,
  `dni_alu` int(11) DEFAULT NULL,
  PRIMARY KEY (`lu_alu`),
  UNIQUE KEY `lu_alu` (`lu_alu`),
  UNIQUE KEY `dni_alu` (`dni_alu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`lu_alu`, `apellido_alu`, `nom_alu`, `dni_alu`) VALUES
(79115, 'Reisvig', 'Mariela', NULL),
(82015, 'Urban', 'Frederike', NULL),
(87250, 'Caligaris', 'Marisel', NULL),
(87546, 'Jones', 'Jimbo', 33843567),
(87942, 'Pérez', 'Roque', 3040502),
(89592, 'Alessandroni', 'Gianfranco', NULL),
(89689, 'Panizoni', 'Estefanía', NULL),
(90536, 'Arró Ortiz', 'Carolina', NULL),
(90821, 'Herold', 'Andrea', NULL),
(90840, 'Tracanna', 'Ezio', NULL),
(90909, 'Schwerdt', 'Juana', 3858855),
(92335, 'Mosna', 'Catalina', NULL),
(93256, 'Muntz', 'Nelson', 35987654),
(94436, 'Hartstock', 'Joaquín', NULL),
(94462, 'Iriarte', 'Fermín', NULL),
(94589, 'Pesticone', 'María Eugenia', NULL),
(99887, 'Smith', 'Ricardo', 3685226),
(100100, 'Gutiérrez', 'María', 3221165),
(100233, 'Gómez', 'Fulano', 37896524),
(100598, 'Johansen', 'Paloma', 37333636),
(102137, 'Prince', 'Martin', 36893521),
(105698, 'Enriquez', 'Heracio', 39852136),
(106601, 'Gorgory', 'Rafael', 38652459),
(110568, 'González', 'Natalia', 39852147);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_catedras`
--

CREATE TABLE IF NOT EXISTS `alumnos_catedras` (
  `lu_alu` int(10) unsigned NOT NULL,
  `cod_cat` int(10) unsigned NOT NULL,
  `estado_alu_cat` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lu_alu`,`cod_cat`),
  KEY `cod_cat` (`cod_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos_catedras`
--

INSERT INTO `alumnos_catedras` (`lu_alu`, `cod_cat`, `estado_alu_cat`) VALUES
(79115, 20063, 1),
(82015, 20063, 1),
(87250, 20063, 1),
(87546, 20020, 1),
(87942, 20018, 0),
(87942, 20022, 0),
(89592, 20063, 1),
(89689, 20063, 1),
(90536, 20063, 1),
(90821, 20063, 1),
(90840, 20063, 1),
(90909, 20020, 0),
(92335, 20063, 1),
(93256, 20018, 1),
(93256, 20020, 0),
(94436, 20063, 1),
(94462, 20063, 1),
(94589, 20063, 1),
(99887, 20059, 0),
(100100, 20022, 0),
(100100, 20024, 0),
(100233, 20018, 1),
(100233, 20022, 1),
(100598, 20018, 2),
(102137, 20024, 1),
(102137, 20059, 1),
(105698, 20022, 2),
(105698, 20059, 0),
(110568, 20018, 2),
(110568, 20020, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE IF NOT EXISTS `carreras` (
  `cod_carr` int(10) unsigned NOT NULL,
  `nom_carr` varchar(40) NOT NULL,
  PRIMARY KEY (`cod_carr`),
  UNIQUE KEY `cod_carr` (`cod_carr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`cod_carr`, `nom_carr`) VALUES
(155, 'Medicina'),
(166, 'Licenciatura en Enfermería');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catedras`
--

CREATE TABLE IF NOT EXISTS `catedras` (
  `cod_cat` int(10) unsigned NOT NULL,
  `cod_carr` int(10) unsigned NOT NULL,
  `nom_cat` varchar(80) NOT NULL,
  PRIMARY KEY (`cod_cat`),
  UNIQUE KEY `cod_cat` (`cod_cat`),
  KEY `cod_carr` (`cod_carr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `catedras`
--

INSERT INTO `catedras` (`cod_cat`, `cod_carr`, `nom_cat`) VALUES
(20018, 166, 'Enfermería, Fundamentos, Prácticas y Tendencias II'),
(20020, 166, 'Enfermería Familiar I'),
(20022, 166, 'Enfermería Familiar II'),
(20024, 166, 'Enfermería Familiar III'),
(20059, 155, 'Examen general final de carrera'),
(20063, 155, 'Obstetricia y ginecología');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(250) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('170a425647fcb661d9148ddd0ef43f98', '192.168.1.86', 'Mozilla/5.0 (iPad; CPU OS 7_1_1 like Mac OS X) AppleWebKit/537.51.2 (KHTML, like Gecko) Version/7.0 Mobile/11D201 Safari', 1401901530, 'a:3:{s:9:"user_data";s:0:"";s:7:"usuario";a:8:{s:7:"leg_doc";s:5:"12666";s:12:"apellido_doc";s:5:"Menna";s:7:"nom_doc";s:6:"Teresa";s:7:"dni_doc";N;s:9:"email_doc";N;s:7:"tel_doc";N;s:6:"activo";s:1:"1";s:10:"privilegio";s:1:"0";}s:16:"actividad_actual";s:14:"generar_examen";}'),
('4833c11c4d23d9602615f22e5b7f5103', '::1', 'Mozilla/5.0 (Linux; U; Android 2.2; en-us; SCH-I800 Build/FROYO) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobil', 1401894747, 'a:3:{s:9:"user_data";s:0:"";s:7:"usuario";a:8:{s:7:"leg_doc";s:5:"12666";s:12:"apellido_doc";s:5:"Menna";s:7:"nom_doc";s:6:"Teresa";s:7:"dni_doc";N;s:9:"email_doc";N;s:7:"tel_doc";N;s:6:"activo";s:1:"1";s:10:"privilegio";s:1:"0";}s:16:"actividad_actual";s:14:"generar_examen";}'),
('661cb56d5cf61bd732a1c27a47d6751c', '192.168.1.28', 'Mozilla/5.0 (Linux; U; Android 4.0.4; es-ar; SonyEricssonWT19i Build/4.1.B.0.431) AppleWebKit/534.30 (KHTML, like Gecko)', 1401898307, 'a:2:{s:9:"user_data";s:0:"";s:7:"usuario";a:8:{s:7:"leg_doc";s:5:"12666";s:12:"apellido_doc";s:5:"Menna";s:7:"nom_doc";s:6:"Teresa";s:7:"dni_doc";N;s:9:"email_doc";N;s:7:"tel_doc";N;s:6:"activo";s:1:"1";s:10:"privilegio";s:1:"0";}}'),
('9f876c7d32ab6968a222cf2861b60b9b', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.114 Safari/537.36', 1401894568, 'a:3:{s:9:"user_data";s:0:"";s:7:"usuario";a:8:{s:7:"leg_doc";s:5:"12666";s:12:"apellido_doc";s:5:"Menna";s:7:"nom_doc";s:6:"Teresa";s:7:"dni_doc";N;s:9:"email_doc";N;s:7:"tel_doc";N;s:6:"activo";s:1:"1";s:10:"privilegio";s:1:"0";}s:16:"actividad_actual";s:14:"generar_examen";}'),
('a72ec420b8d46c38a3702bfb5e8950e6', '192.168.1.103', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.114 Safari/537.36', 1401894035, 'a:2:{s:9:"user_data";s:0:"";s:7:"usuario";a:8:{s:7:"leg_doc";s:5:"12666";s:12:"apellido_doc";s:5:"Menna";s:7:"nom_doc";s:6:"Teresa";s:7:"dni_doc";N;s:9:"email_doc";N;s:7:"tel_doc";N;s:6:"activo";s:1:"1";s:10:"privilegio";s:1:"0";}}'),
('dfd73b3c1f83ef7fcbf60325c3777de4', '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.114 Safari/537.36', 1401901084, 'a:3:{s:9:"user_data";s:0:"";s:7:"usuario";a:8:{s:7:"leg_doc";s:5:"12666";s:12:"apellido_doc";s:5:"Menna";s:7:"nom_doc";s:6:"Teresa";s:7:"dni_doc";N;s:9:"email_doc";N;s:7:"tel_doc";N;s:6:"activo";s:1:"1";s:10:"privilegio";s:1:"0";}s:16:"actividad_actual";s:14:"generar_examen";}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descripciones`
--

CREATE TABLE IF NOT EXISTS `descripciones` (
  `id_desc` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_guia` int(10) unsigned NOT NULL,
  `nom_desc` varchar(50) DEFAULT NULL,
  `contenido_desc` text,
  PRIMARY KEY (`id_desc`),
  KEY `id_guia` (`id_guia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `descripciones`
--

INSERT INTO `descripciones` (`id_desc`, `id_guia`, `nom_desc`, `contenido_desc`) VALUES
(1, 1, 'Objetivo del taller', 'El estudiante será capaz de controlar constantes vitales.'),
(2, 1, 'Caso clínico', 'La señorita Mayra, de 20 años, ingresa al consultorio para control de presión arterial, pulso, frecuencia  respiratoria,  temperatura y dolor.'),
(3, 1, 'Escenario', 'Laboratorio de competencias profesionales.'),
(4, 1, 'Requerimientos', 'Usuario simulado, estetoscopio, esfigmomanómetro, reloj, termómetro digital, torundas de algodón, alcohol en gel, alcohol al 70%, bandeja, hojas de registro, bolígrafo, bolsa  roja, toallas descartables.'),
(5, 3, 'Objetivo del taller', 'El estudiante será capaz de medir la altura uterina.'),
(6, 3, 'Caso clínico', 'Susana de 23 años, cursa un embarazo de 30 semanas. Concurre al CAP para realizarse el control prenatal. Usted debe medir su altura uterina.'),
(7, 3, 'Escenario', 'Laboratorio de competencias profesionales.'),
(8, 3, 'Requerimientos', 'Simulador de embarazada, alcohol en gel, camilla, salea, cinta métrica, hoja de registro y bolígrafo.'),
(9, 4, 'Objetivo del taller', 'Realizar un Electrocardiograma de 12 derivaciones a un paciente internado con dolor precordial.'),
(10, 4, 'Caso clínico', 'El Sr. Matías de 47 años, se encuentra internado en el servicio de Clínica Médica y refiere dolor precordial agudo, punzante, valorado en 8/10 según escala de dolor de 1-10. \r\n\r\nUd. deberá realizarle un Electrocardiograma de 12 derivaciones de inmediato.\r\n'),
(11, 4, 'Escenario', 'Persona (simulador) en cama, en ámbito hospitalario, en posición supina.'),
(12, 4, 'Requerimientos', 'Simulador (muñeco completo o tronco) de adulto, electrocardiógrafo, alcohol en gel, gel conductor, hojas de registro de enfermería, lapicera.'),
(13, 5, 'Objetivo del taller', 'Realizar las maniobras de parto normal de término en presentación cefálica, incluyendo corte de cordón umbilical y alumbramiento'),
(14, 5, 'Escenario', 'Laboratorio de competencias profesionales'),
(15, 5, 'Requerimientos', 'Simulador de parto colocado en el borde de la camilla, armado con feto de término en presentación cefálica, con pared abdominal transparente, guantes, gasas, apósito (no estéril),antiséptico (reemplazar por agua para conservación del simulador), dos campos quirúrgicos,  clamp de cordón (ó similar),tijera, pinza de Kocher, recipiente con bolsa roja para desechar placenta'),
(16, 5, 'Consigna', 'El alumno deberá realizar el parto normal de término de un feto en cefálica, relatando cada paso que realice en voz alta y comunicándose con la paciente simulada y su asistente (enfermera - neonatólogo).'),
(17, 6, 'Objetivo del taller', 'El estudiante será capaz  de controlar oximetría de pulso.'),
(18, 6, 'Caso clínico', 'El señor Román, de 64 años, ingresa al Servicio de Cuidados Intensivos con diagnóstico de enfermedad pulmonar obstructiva crónica reagudizada. \r\nSe indica medición de oximetría de pulso.'),
(19, 6, 'Escenario', 'Laboratorio de competencias profesionales.'),
(20, 6, 'Requerimientos', 'Usuario simulado, alcohol en gel, bandeja, torundas de algodón, alcohol al 70%, oxímetro de pulso, hojas de registro y  bolígrafo.');

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
  `privilegio` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`leg_doc`),
  UNIQUE KEY `leg_doc` (`leg_doc`),
  UNIQUE KEY `dni_doc` (`dni_doc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`leg_doc`, `pass`, `apellido_doc`, `nom_doc`, `dni_doc`, `email_doc`, `tel_doc`, `activo`, `privilegio`) VALUES
(123, '21232f297a57a5a743894a0e4a801fc3', 'Administrador', 'Super', 11111111, 'admin@laboratorios.dcs.uns.edu.ar', NULL, 1, 3),
(1010, '1e48c4420b7073bc11916c6c1de226bb', 'Castaña', 'Cacho', 5654456, NULL, NULL, 0, 0),
(2020, '7b7a53e239400a13bd6be6c91c4f6c4e', 'Mensaje', 'Manda', 12356845, NULL, NULL, 0, -1),
(5201, '4d186321c1a7f0f354b297e8914ab240', 'Zapata', 'Juan', 10568956, 'johnzapata@uns.edu.ar', '4568746', 1, 0),
(5555, '6074c6aa3488f3c2dddff2a7ca821aab', 'Natalia', 'Natalia', 5585585, NULL, NULL, 1, 0),
(7865, '4d1a65f1c6d24c1f8f714fe7e31d29fc', 'Pérez', 'Marcela', 20568987, NULL, NULL, 1, 0),
(10325, 'e10adc3949ba59abbe56e057f20f883e', 'Skinner', 'Seymour', 9125654, 'skinner@springfield.com', '(011)156-589632', 1, 2),
(12179, '3eb38fa8079f887324e8ee1d92b3da12', 'Steel', 'Idina', NULL, NULL, NULL, 1, 0),
(12198, '0c4f092e9f42a14a91c0d2183e106a45', 'Stepanosky', 'Silvia', NULL, NULL, NULL, 1, 2),
(12666, 'f47fe15e1e1f336e31f0a7de2337a185', 'Menna', 'Teresa', NULL, NULL, NULL, 1, 0),
(12821, 'd419480c20f41bcd867bb4517ef14701', 'Coronel', 'Fernando', NULL, NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes_catedras`
--

CREATE TABLE IF NOT EXISTS `docentes_catedras` (
  `leg_doc` int(10) unsigned NOT NULL,
  `cod_cat` int(10) unsigned NOT NULL,
  `permiso_doc` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`leg_doc`,`cod_cat`),
  KEY `cod_cat` (`cod_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `docentes_catedras`
--

INSERT INTO `docentes_catedras` (`leg_doc`, `cod_cat`, `permiso_doc`) VALUES
(5201, 20018, 1),
(5201, 20020, 1),
(5201, 20022, 0),
(5201, 20024, 0),
(5555, 20063, 1),
(7865, 20018, 0),
(7865, 20020, 1),
(7865, 20022, 2),
(7865, 20024, 0),
(10325, 20059, 2),
(12179, 20020, 0),
(12179, 20022, 0),
(12179, 20024, 2),
(12198, 20018, 2),
(12666, 20063, 2),
(12821, 20020, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes`
--

CREATE TABLE IF NOT EXISTS `examenes` (
  `id_exam` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_guia` int(10) unsigned NOT NULL,
  `cod_cat` int(10) unsigned NOT NULL,
  `lu_alu` int(10) unsigned NOT NULL,
  `leg_doc` int(10) unsigned NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `calificacion` int(11) NOT NULL DEFAULT '-1',
  `obs_exam` text,
  `porcentaje_exam` float DEFAULT NULL,
  PRIMARY KEY (`id_exam`),
  KEY `id_guia` (`id_guia`),
  KEY `cod_cat` (`cod_cat`),
  KEY `lu_alu` (`lu_alu`),
  KEY `leg_doc` (`leg_doc`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `examenes`
--

INSERT INTO `examenes` (`id_exam`, `id_guia`, `cod_cat`, `lu_alu`, `leg_doc`, `fecha`, `calificacion`, `obs_exam`, `porcentaje_exam`) VALUES
(1, 1, 20018, 100233, 5201, '2014-05-21 18:06:05', 1, 'Esta es una observación general del examen', NULL),
(2, 2, 20059, 102137, 10325, '2014-05-21 18:06:06', 0, 'Esta es una observación general del examen', NULL),
(3, 3, 20020, 93256, 5201, '2014-05-21 18:08:18', 1, 'djdgjz', -1),
(4, 1, 20018, 100233, 5201, '2014-05-21 19:32:26', 1, 'Obs gral', -1),
(5, 2, 20059, 102137, 123, '2014-05-21 19:45:36', 2, '', -1),
(6, 1, 20018, 100233, 5201, '2014-05-21 20:03:53', 2, '', -1),
(7, 6, 20018, 100598, 5201, '2014-05-23 01:11:02', 0, '', -1),
(8, 6, 20018, 100598, 5201, '2014-04-27 01:21:03', 0, '', -1),
(9, 6, 20018, 93256, 5201, '2014-05-23 10:49:33', 1, ' vbm bm b', -1),
(10, 1, 20018, 87942, 5201, '2014-05-23 11:31:40', 1, 'Obs. gral', -1),
(11, 6, 20018, 100233, 5201, '2014-05-23 14:31:29', 0, '', -1),
(12, 1, 20018, 100598, 5201, '2014-05-23 15:51:18', 2, '', -1),
(13, 1, 20018, 100233, 5201, '2014-05-23 15:51:40', 1, '', -1),
(14, 1, 20018, 87942, 5201, '2014-05-23 15:52:09', 0, '', -1),
(15, 3, 20020, 90909, 12821, '2014-05-28 15:17:41', 1, '', -1),
(16, 6, 20018, 110568, 12198, '2014-05-28 15:18:33', 0, '', -1),
(17, 6, 20018, 100233, 5201, '2014-05-28 16:24:18', 1, 'Obs. gral.', -1),
(18, 5, 20063, 102137, 123, '2014-05-28 16:40:58', 2, '', -1),
(19, 3, 20020, 110568, 5201, '2014-05-30 17:50:11', 1, '', -1),
(21, 5, 20063, 89689, 12666, '2014-06-04 15:54:36', 2, '', -1),
(22, 5, 20063, 79115, 12666, '2014-06-04 16:06:39', 2, '', -1),
(23, 5, 20063, 94589, 12666, '2014-06-04 16:22:11', 2, '', -1),
(24, 5, 20063, 90821, 12666, '2014-06-04 16:40:08', 2, '', -1),
(25, 5, 20063, 87250, 12666, '2014-06-04 16:58:11', 2, '', -1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupositems`
--

CREATE TABLE IF NOT EXISTS `grupositems` (
  `id_grupoitem` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom_grupoitem` varchar(255) DEFAULT NULL,
  `nro_grupoitem` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_grupoitem`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `grupositems`
--

INSERT INTO `grupositems` (`id_grupoitem`, `nom_grupoitem`, `nro_grupoitem`) VALUES
(1, 'Prepara material:', 2),
(2, 'Presión Arterial:', 7),
(3, 'Pulso:', 8),
(4, 'Temperatura:', 9),
(5, 'Temperatura:', 10),
(6, 'Dolor:', 11),
(7, 'Respecto del dolor abdominal:', 3),
(8, 'Prepara material:', 2),
(9, 'Prepara material:', 4),
(10, 'Conecta electrodos precordiales en orden y posición  adecuadas, con gel conductor:', 8),
(11, 'Prepara material:', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guias`
--

CREATE TABLE IF NOT EXISTS `guias` (
  `id_guia` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tit_guia` varchar(100) NOT NULL,
  `subtit_guia` varchar(160) DEFAULT NULL,
  PRIMARY KEY (`id_guia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `guias`
--

INSERT INTO `guias` (`id_guia`, `tit_guia`, `subtit_guia`) VALUES
(1, 'Control de constantes vitales', NULL),
(2, 'Examen final de carrera - Estación nº 3', NULL),
(3, 'Medición de altura uterina', NULL),
(4, 'Electrocardiograma de 12 derivaciones', NULL),
(5, 'Atención de parto normal', NULL),
(6, 'Oximetría de pulso', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guias_catedras`
--

CREATE TABLE IF NOT EXISTS `guias_catedras` (
  `id_guia` int(10) unsigned NOT NULL,
  `cod_cat` int(10) unsigned NOT NULL,
  `nro_guia` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_guia`,`cod_cat`),
  KEY `cod_cat` (`cod_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `guias_catedras`
--

INSERT INTO `guias_catedras` (`id_guia`, `cod_cat`, `nro_guia`) VALUES
(1, 20018, 6),
(2, 20059, 3),
(3, 20020, 1),
(4, 20022, 5),
(4, 20024, 1),
(5, 20063, 1),
(6, 20018, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id_item` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom_item` varchar(255) NOT NULL,
  `solo_texto` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_item`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=116 ;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id_item`, `nom_item`, `solo_texto`) VALUES
(1, 'Se lava las manos al inicio del procedimiento.', 0),
(2, 'Bandeja.', 0),
(3, 'Torundas de algodón.', 0),
(4, 'Estetoscopio y esfigmomanómetro.', 0),
(5, 'Reloj.', 0),
(6, 'Termómetro digital.', 0),
(7, 'Alcohol en gel.', 0),
(8, 'Alcohol al 70%.', 0),
(9, 'Hojas de registro.', 0),
(10, 'Bolígrafo.', 0),
(11, 'Bolsa roja.', 0),
(12, 'Toallas descartables.', 0),
(13, 'Se presenta al paciente y lo identifica.', 0),
(14, 'Explica el procedimiento a realizar.', 0),
(15, 'Considera la privacidad del usuario.', 0),
(16, 'Tiene en cuenta los factores predisponentes que alteran la presión arterial, pulso, frecuencia  respiratoria,  temperatura y dolor.', 0),
(17, 'Coloca adecuadamente el manguito.', 0),
(18, 'Palpa pulsos para localizar arterias (radial y braquial).', 0),
(19, 'Insufla el manguito de acuerdo al pulso radial percibido y 20 mmHg. por encima de la ausencia del mismo.', 0),
(20, 'Coloca la membrana del estetoscopio en el lugar adecuado (arteria braquial).', 0),
(21, 'Abre la válvula del rubinete y desinfla el manguito.', 0),
(22, 'Percibe presión arterial sistólica y diastólica.', 0),
(23, 'Ubica adecuadamente la arteria para tomar pulso radial.', 0),
(24, 'Tiene en cuenta las características del pulso (frecuencia, ritmo, amplitud y elasticidad).', 0),
(25, 'Utiliza  el tiempo correcto, 60’’ o 30’’ si es regular.', 0),
(26, 'Verifica el estado de la axila.', 0),
(27, 'Utiliza las toallas descartables si es necesario.', 0),
(28, 'Coloca el termómetro en la línea media axilar.', 0),
(29, 'Espera el tiempo correcto para la lectura según el termómetro utilizado.', 0),
(30, 'Tiene en cuenta las características de la respiración (frecuencia, profundidad, ritmo y calidad).', 0),
(31, 'Utiliza  el tiempo correcto (60’’).', 0),
(32, 'Dolor: Explica el procedimiento.', 0),
(33, 'Solicita que ubique grado de dolor en la escala numérica.', 0),
(34, 'Limpia y ordena  los elementos utilizados.', 0),
(35, 'Informa al usuario los valores obtenidos.', 0),
(36, 'Se lava las manos al finalizar el procedimiento.', 0),
(37, 'Registra el procedimiento.', 0),
(38, 'Investiga comienzo', 0),
(39, 'Investiga evolución', 0),
(40, 'Localización', 0),
(41, 'Irradiación', 0),
(42, 'Calma con las comidas', 0),
(43, 'Horarios', 0),
(44, 'Duración', 0),
(45, 'Investiga nauseas', 0),
(46, 'Investiga vomito', 0),
(47, 'Investiga sobre la dieta (debe preguntar sobre tipo de alimentos y cantidad', 0),
(48, 'Anuncia que realiza inspección y observa el abdomen por instante (no se penaliza si no observa la contracción muscular o la inspiración profunda)', 0),
(49, 'Realiza palpación superficial (debe comenzar por el lugar opuesto al dolor)', 0),
(50, 'Realiza maniobra de descomprensión abdominal', 0),
(51, 'Realiza al menos una de las siguientes maniobras (búsqueda del signo de psoas, del obturador, Rovsing) ', 0),
(52, 'Realiza auscultación del abdomen', 0),
(53, 'Ecografía', 0),
(54, 'Recuento leucocitario o hemograma', 0),
(55, 'Sedimento urinario', 0),
(56, 'Examenes solicitados', 1),
(57, 'DEBE DECIR Abdomen agudo quirúrgico o Apendicitis aguda o abdomen agudo inflamatorio', 0),
(58, '¿Qué diagnóstico considera como más probable?', 1),
(59, 'Internación en observación', 0),
(60, 'Consulta con cirujano de guardia', 0),
(61, '¿Qué decisión tomaría con el paciente?', 1),
(62, 'Cinta métrica', 0),
(63, 'Se presenta al usuario', 0),
(64, 'Identifica al usuario', 0),
(65, 'Coloca a la embarazada decúbito dorsal.', 0),
(66, 'Le pide que se afloje y descienda el pantalón (en caso que lo tenga).', 0),
(67, 'Cubre la pelvis con la salea.', 0),
(68, 'Palpa la sínfisis pubiana.', 0),
(69, 'Coloca el extremo de la cinta métrica y la sujeta con la mano no hábil.', 0),
(70, 'Con la mano diestra desplaza la cinta hasta la palpación del fondo uterino.', 0),
(71, 'Lee la medición.', 0),
(72, 'Acondiciona a la mujer.', 0),
(73, 'Electrocardiógrafo', 0),
(74, 'Gel conductor', 0),
(75, 'Conecta el electrocardiógrafo a la fuente de energía.', 0),
(76, 'Conecta el cable a tierra adecuadamente.', 0),
(77, 'Conecta electrodos de los miembros adecuadamente, en regiones que no tengan prominencias óseas ni movimientos significativos: MSD (rojo), MSI (amarillo), MII (verde) y MID (negro), con gel conductor.', 0),
(78, 'V1 en borde esternal derecho, 4° espacio intercostal (EIC) ', 0),
(79, 'V2 en borde esternal izquierdo, 4° espacio intercostal (EIC) ', 0),
(80, 'V4 en línea medio-clavicular izquierda, 5° espacio intercostal (EIC) ', 0),
(81, 'V3 entre V2 y V4 ', 0),
(82, 'V5 en línea axilar anterior izquierda, 5° espacio intercostal (EIC)', 0),
(83, 'V6 en línea media axilar, 5° espacio intercostal (EIC) ', 0),
(84, 'Comienza a desplazarse el papel a una velocidad de 25 mm por segundo.', 0),
(85, 'Marca standard al inicio del electrocardiograma (manualmente).', 0),
(86, 'Registra las derivaciones en el siguiente orden: DI, DII, DIII, AVR, AVL, AVF, V1, V2, V3, V4, V5 y V6.', 0),
(87, 'Acondiciona al paciente.', 0),
(88, 'Rotula el ECG con nombre del paciente, habitación, cama, fecha, hora, edad.', 0),
(89, 'Registra adecuadamente el procedimiento y el resultado de la medición.', 0),
(90, 'Explicación a la paciente del procedimiento: realización de la antisepsia, momento de los pujos, respiración.', 0),
(91, 'Realiza antisepsia de región vulvoperineal', 0),
(92, 'Coloca el campo quirúrgico entre el periné y la camilla', 0),
(93, 'Invita a la paciente a pujar durante las contracciones', 0),
(94, 'Protege el periné cuando corona la presentación', 0),
(95, 'Realiza la rotación de hombros para colocar el hombro anterior debajo de pubis, traccionando hacia abajo', 0),
(96, 'Cuando exterioriza el hombro anterior, realiza la rotación para el hombro posterior (en sentido contrario) con suave tracción hacia abajo', 0),
(97, 'Indica Ocitocina para el alumbramiento activo', 0),
(98, 'Extrae el feto y lo coloca sobre el abdomen de la paciente, el neonatólogo ha colocado el otro campo quirúrgico sobre el abdomen de la madre', 0),
(99, 'Espera al menos un minuto para realizar la ligadura del cordón umbilical (puede palpar los latidos del mismo para establecer el momento oportuno)', 0),
(100, 'Liga el cordón umbilical y entrega el recién nacido al neonatólogo', 0),
(101, 'Espera el alumbramiento con tracción sostenida del cordón', 0),
(102, 'Cuando se exterioriza la placenta la extrae y la descarta en recipiente con bolsa roja ', 0),
(103, 'Realiza masaje del fondo uterino (ó solicita a un ayudante que lo realice)', 0),
(104, 'Comprueba indemnidad del periné', 0),
(105, 'Comprueba contracción uterina y cese de la pérdida hemática', 0),
(106, 'Indica a la paciente cómo masajear el fondo uterino cuando se movilice.', 0),
(107, 'Realiza limpieza del periné con antiséptico.', 0),
(108, 'Cubre el periné con apósito ', 0),
(109, 'Se saca los guantes y los descarta en el recipiente', 0),
(110, 'Saluda a la mujer y le explica que durante dos horas se realizará control estricto del sangrado, que puede tomar líquidos y comer liviano', 0),
(111, 'Oxímetro de pulso', 0),
(112, 'Identifica sitios correctos donde puede realizarse la medición (dedos de la mano o lóbulo de las orejas).', 0),
(113, 'Identifica elementos que podrían arrojar valores erróneos.', 0),
(114, 'Valora la oximetría de pulso.', 0),
(115, 'Decontamina el oxímetro con torundas de algodón y alcohol al 70%.', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itemsestudiante`
--

CREATE TABLE IF NOT EXISTS `itemsestudiante` (
  `id_itemest` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom_itemest` varchar(255) NOT NULL,
  PRIMARY KEY (`id_itemest`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `itemsestudiante`
--

INSERT INTO `itemsestudiante` (`id_itemest`, `nom_itemest`) VALUES
(1, 'Realizar la técnica completa y su registro.'),
(2, 'Tiempo para leer el caso: 2 minutos.'),
(3, 'Tiempo para preparar los materiales: 3 minutos.'),
(4, 'Tiempo para realizar y registrar la técnica: 10 minutos.'),
(5, 'Realizar la técnica completa.'),
(6, 'Tiempo para realizar y registrar la técnica: 5 minutos.'),
(7, 'Tiempo para leer el caso: 1 minuto.'),
(8, 'Requerimientos: Haber leído / comprendido / preguntado las maniobras de atención del parto normal de término en cefálica. \r\nHaber visto partos normales de término en cefálica\r\n'),
(9, 'Ud. deberá realizar el parto normal de término de un feto en cefálica, relatando cada paso que realice en voz alta y comunicándose con la paciente simulada y su asistente (enfermera / neonatólogo)'),
(10, 'Realizar el procedimiento completo y su registro.'),
(11, 'Tiempo para preparar los materiales: 2 minutos.'),
(12, 'Tiempo para realizar y registrar la técnica: 3 minutos.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itemsestudiante_guias`
--

CREATE TABLE IF NOT EXISTS `itemsestudiante_guias` (
  `id_itemest` int(10) unsigned NOT NULL,
  `id_guia` int(10) unsigned NOT NULL,
  `nro_item` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_itemest`,`id_guia`),
  KEY `id_guia` (`id_guia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `itemsestudiante_guias`
--

INSERT INTO `itemsestudiante_guias` (`id_itemest`, `id_guia`, `nro_item`) VALUES
(1, 1, 1),
(2, 1, 2),
(2, 3, 2),
(2, 6, 2),
(3, 1, 3),
(3, 3, 3),
(3, 4, 3),
(4, 1, 4),
(4, 4, 4),
(5, 3, 1),
(5, 4, 1),
(6, 3, 4),
(7, 4, 2),
(8, 5, 1),
(9, 5, 2),
(10, 6, 1),
(11, 6, 3),
(12, 6, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_examenes`
--

CREATE TABLE IF NOT EXISTS `items_examenes` (
  `id_item` int(10) unsigned NOT NULL,
  `id_exam` int(10) unsigned NOT NULL,
  `estado_item` int(11) NOT NULL DEFAULT '-1',
  `obs_item` text,
  PRIMARY KEY (`id_item`,`id_exam`),
  KEY `id_exam` (`id_exam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `items_examenes`
--

INSERT INTO `items_examenes` (`id_item`, `id_exam`, `estado_item`, `obs_item`) VALUES
(1, 1, 0, 'Esto es una observación'),
(1, 3, 1, ''),
(1, 4, 1, 'j,g,f'),
(1, 6, -1, ''),
(1, 7, -1, ''),
(1, 8, -1, ''),
(1, 9, 1, ''),
(1, 10, 1, ''),
(1, 11, -1, ''),
(1, 12, -1, ''),
(1, 13, -1, ''),
(1, 14, -1, ''),
(1, 15, -1, ''),
(1, 16, -1, ''),
(1, 17, -1, 'No lo pude observar'),
(1, 19, -1, ''),
(2, 1, 1, NULL),
(2, 4, -1, ''),
(2, 6, -1, ''),
(2, 7, -1, ''),
(2, 8, -1, ''),
(2, 9, 1, ''),
(2, 10, 0, ''),
(2, 11, -1, ''),
(2, 12, -1, ''),
(2, 13, -1, ''),
(2, 14, -1, ''),
(2, 16, -1, ''),
(2, 17, 0, ''),
(3, 1, 0, NULL),
(3, 4, 0, ''),
(3, 6, -1, ''),
(3, 7, -1, ''),
(3, 8, -1, ''),
(3, 9, -1, ''),
(3, 10, 1, ''),
(3, 11, -1, ''),
(3, 12, -1, ''),
(3, 13, -1, ''),
(3, 14, -1, ''),
(3, 16, -1, ''),
(3, 17, 1, 'Otra obs.'),
(4, 1, 1, NULL),
(4, 4, 1, ''),
(4, 6, -1, ''),
(4, 10, -1, 'No pude observarlo'),
(4, 12, -1, ''),
(4, 13, -1, ''),
(4, 14, -1, ''),
(5, 1, 0, NULL),
(5, 4, 0, ''),
(5, 6, -1, ''),
(5, 10, 1, ''),
(5, 12, -1, ''),
(5, 13, -1, ''),
(5, 14, -1, ''),
(6, 1, 1, NULL),
(6, 4, 1, ''),
(6, 6, -1, ''),
(6, 10, 1, ''),
(6, 12, -1, ''),
(6, 13, -1, ''),
(6, 14, -1, ''),
(7, 1, 1, NULL),
(7, 3, 0, ''),
(7, 4, 1, ''),
(7, 6, -1, ''),
(7, 7, -1, ''),
(7, 8, -1, ''),
(7, 9, 0, ''),
(7, 10, 1, ''),
(7, 11, -1, ''),
(7, 12, -1, ''),
(7, 13, -1, ''),
(7, 14, -1, ''),
(7, 15, -1, ''),
(7, 16, -1, ''),
(7, 17, 1, ''),
(7, 19, -1, ''),
(8, 1, 1, NULL),
(8, 4, 0, ''),
(8, 6, -1, ''),
(8, 7, -1, ''),
(8, 8, -1, ''),
(8, 9, -1, ''),
(8, 10, 0, ''),
(8, 11, -1, ''),
(8, 12, -1, ''),
(8, 13, -1, ''),
(8, 14, -1, ''),
(8, 16, -1, ''),
(8, 17, 1, ''),
(9, 1, 1, NULL),
(9, 3, 0, ''),
(9, 4, 1, ''),
(9, 6, -1, 'Crece cgi g br efe at'),
(9, 7, -1, ''),
(9, 8, -1, ''),
(9, 9, -1, ''),
(9, 10, 0, ''),
(9, 11, -1, ''),
(9, 12, -1, ''),
(9, 13, -1, ''),
(9, 14, -1, ''),
(9, 15, -1, ''),
(9, 16, -1, ''),
(9, 17, 1, ''),
(9, 19, -1, ''),
(10, 1, 0, NULL),
(10, 3, 1, ''),
(10, 4, 1, ''),
(10, 6, -1, ''),
(10, 7, -1, ''),
(10, 8, -1, ''),
(10, 9, -1, ''),
(10, 10, 1, ''),
(10, 11, -1, ''),
(10, 12, -1, ''),
(10, 13, -1, ''),
(10, 14, -1, ''),
(10, 15, -1, ''),
(10, 16, -1, ''),
(10, 17, 0, ''),
(10, 19, -1, ''),
(11, 1, 1, NULL),
(11, 4, 1, ''),
(11, 6, -1, ''),
(11, 10, -1, ''),
(11, 12, -1, ''),
(11, 13, -1, ''),
(11, 14, -1, ''),
(12, 1, 1, NULL),
(12, 4, -1, ''),
(12, 6, -1, ''),
(12, 10, -1, ''),
(12, 12, -1, ''),
(12, 13, -1, ''),
(12, 14, -1, ''),
(13, 1, 0, NULL),
(13, 4, -1, 'No se presenta'),
(13, 6, -1, ''),
(13, 10, -1, 'blabla'),
(13, 12, -1, ''),
(13, 13, -1, ''),
(13, 14, -1, ''),
(14, 1, 1, NULL),
(14, 3, 0, ''),
(14, 4, 1, ''),
(14, 6, -1, ''),
(14, 7, -1, ''),
(14, 8, -1, ''),
(14, 9, -1, ''),
(14, 10, 1, ''),
(14, 11, -1, ''),
(14, 12, -1, ''),
(14, 13, -1, ''),
(14, 14, -1, ''),
(14, 15, -1, ''),
(14, 16, -1, ''),
(14, 17, 0, ''),
(14, 19, -1, ''),
(15, 1, 0, NULL),
(15, 4, 1, ''),
(15, 6, -1, ''),
(15, 10, 1, ''),
(15, 12, -1, ''),
(15, 13, -1, ''),
(15, 14, -1, ''),
(16, 1, 0, NULL),
(16, 4, 1, ''),
(16, 6, -1, ''),
(16, 10, 1, ''),
(16, 12, -1, ''),
(16, 13, -1, ''),
(16, 14, -1, ''),
(17, 1, 1, NULL),
(17, 4, 0, ''),
(17, 6, -1, ''),
(17, 10, 0, ''),
(17, 12, -1, ''),
(17, 13, -1, ''),
(17, 14, -1, ''),
(18, 1, 1, NULL),
(18, 4, 0, ''),
(18, 6, -1, ''),
(18, 10, -1, ''),
(18, 12, -1, ''),
(18, 13, -1, ''),
(18, 14, -1, ''),
(19, 1, 1, NULL),
(19, 4, 1, ''),
(19, 6, -1, ''),
(19, 10, -1, ''),
(19, 12, -1, ''),
(19, 13, -1, ''),
(19, 14, -1, ''),
(20, 1, 1, NULL),
(20, 4, 1, ''),
(20, 6, -1, ''),
(20, 10, -1, ''),
(20, 12, -1, ''),
(20, 13, -1, ''),
(20, 14, -1, ''),
(21, 1, 1, NULL),
(21, 4, 1, ''),
(21, 6, -1, ''),
(21, 10, -1, ''),
(21, 12, -1, ''),
(21, 13, -1, ''),
(21, 14, -1, ''),
(22, 1, 0, NULL),
(22, 4, 1, ''),
(22, 6, -1, ''),
(22, 10, -1, ''),
(22, 12, -1, ''),
(22, 13, -1, ''),
(22, 14, -1, ''),
(23, 1, 1, NULL),
(23, 4, 1, ''),
(23, 6, -1, ''),
(23, 10, -1, ''),
(23, 12, -1, ''),
(23, 13, -1, ''),
(23, 14, -1, ''),
(24, 1, 0, NULL),
(24, 4, 1, ''),
(24, 6, -1, ''),
(24, 10, -1, ''),
(24, 12, -1, ''),
(24, 13, -1, ''),
(24, 14, -1, ''),
(25, 1, -1, 'No pudo ser observado'),
(25, 4, 1, ''),
(25, 6, -1, ''),
(25, 10, -1, ''),
(25, 12, -1, ''),
(25, 13, -1, ''),
(25, 14, -1, ''),
(26, 1, 0, NULL),
(26, 4, 0, ''),
(26, 6, -1, ''),
(26, 10, -1, ''),
(26, 12, -1, ''),
(26, 13, -1, ''),
(26, 14, -1, ''),
(27, 1, 1, NULL),
(27, 4, 1, ''),
(27, 6, -1, ''),
(27, 10, -1, ''),
(27, 12, -1, ''),
(27, 13, -1, ''),
(27, 14, -1, ''),
(28, 1, 0, NULL),
(28, 4, 1, ''),
(28, 6, -1, ''),
(28, 10, -1, ''),
(28, 12, -1, ''),
(28, 13, -1, ''),
(28, 14, -1, ''),
(29, 1, 1, NULL),
(29, 4, 1, ''),
(29, 6, -1, ''),
(29, 10, -1, ''),
(29, 12, -1, ''),
(29, 13, -1, ''),
(29, 14, -1, ''),
(30, 1, 1, NULL),
(30, 4, -1, ''),
(30, 6, -1, ''),
(30, 10, -1, ''),
(30, 12, -1, ''),
(30, 13, -1, ''),
(30, 14, -1, ''),
(31, 1, 1, NULL),
(31, 4, -1, ''),
(31, 6, -1, ''),
(31, 10, -1, ''),
(31, 12, -1, ''),
(31, 13, -1, ''),
(31, 14, -1, ''),
(32, 1, 1, NULL),
(32, 4, -1, ''),
(32, 6, -1, ''),
(32, 10, -1, ''),
(32, 12, -1, ''),
(32, 13, -1, ''),
(32, 14, -1, ''),
(33, 1, 0, NULL),
(33, 4, -1, ''),
(33, 6, -1, ''),
(33, 10, -1, ''),
(33, 12, -1, ''),
(33, 13, -1, ''),
(33, 14, -1, ''),
(34, 1, 0, NULL),
(34, 4, -1, ''),
(34, 6, -1, ''),
(34, 10, -1, ''),
(34, 12, -1, ''),
(34, 13, -1, ''),
(34, 14, -1, ''),
(35, 1, 1, NULL),
(35, 4, -1, ''),
(35, 6, -1, ''),
(35, 10, 1, ''),
(35, 12, -1, ''),
(35, 13, -1, ''),
(35, 14, -1, ''),
(36, 1, 0, NULL),
(36, 3, 1, ''),
(36, 4, -1, ''),
(36, 6, -1, ''),
(36, 7, -1, ''),
(36, 8, -1, ''),
(36, 9, 1, ''),
(36, 10, 0, ''),
(36, 11, -1, ''),
(36, 12, -1, ''),
(36, 13, -1, ''),
(36, 14, -1, ''),
(36, 15, -1, ''),
(36, 16, -1, ''),
(36, 17, -1, ''),
(36, 19, -1, ''),
(37, 1, 1, NULL),
(37, 3, 0, ''),
(37, 4, -1, ''),
(37, 6, -1, ''),
(37, 7, -1, ''),
(37, 8, -1, ''),
(37, 9, -1, ''),
(37, 10, -1, 'blabla'),
(37, 11, -1, ''),
(37, 12, -1, ''),
(37, 13, -1, ''),
(37, 14, -1, ''),
(37, 15, -1, ''),
(37, 16, -1, ''),
(37, 17, -1, ''),
(37, 19, -1, ''),
(38, 2, 0, 'Esto es una observación'),
(38, 5, -1, ''),
(39, 2, 1, NULL),
(39, 5, -1, ''),
(40, 2, 0, NULL),
(40, 5, -1, ''),
(41, 2, 1, NULL),
(41, 5, -1, ''),
(42, 2, 0, NULL),
(42, 5, -1, ''),
(43, 2, 1, NULL),
(43, 5, -1, ''),
(44, 2, 1, NULL),
(44, 5, -1, ''),
(45, 2, 1, NULL),
(45, 5, -1, ''),
(46, 2, 1, NULL),
(46, 5, -1, ''),
(47, 2, 0, NULL),
(47, 5, -1, ''),
(48, 2, 1, NULL),
(48, 5, -1, ''),
(49, 2, 1, NULL),
(49, 5, -1, ''),
(50, 2, 0, NULL),
(50, 5, -1, ''),
(51, 2, 1, NULL),
(51, 5, -1, ''),
(52, 2, 0, NULL),
(52, 5, -1, ''),
(53, 2, 0, NULL),
(53, 5, -1, ''),
(54, 2, 1, NULL),
(54, 5, -1, ''),
(55, 2, 1, NULL),
(55, 5, -1, ''),
(56, 2, -1, 'Bla bla bla'),
(56, 5, -1, ''),
(57, 2, 1, NULL),
(57, 5, -1, ''),
(58, 2, -1, 'Bla bla bla'),
(58, 5, -1, ''),
(59, 2, 0, NULL),
(59, 5, -1, ''),
(60, 2, 1, NULL),
(60, 5, -1, ''),
(61, 2, -1, 'Bla bla bla'),
(61, 5, -1, ''),
(62, 3, 1, ''),
(62, 15, -1, ''),
(62, 19, -1, ''),
(63, 3, 1, ''),
(63, 7, -1, ''),
(63, 8, -1, ''),
(63, 9, -1, ''),
(63, 11, -1, ''),
(63, 15, -1, ''),
(63, 16, -1, ''),
(63, 17, 1, ''),
(63, 19, -1, ''),
(64, 3, 1, ''),
(64, 7, -1, ''),
(64, 8, -1, ''),
(64, 9, -1, ''),
(64, 11, -1, ''),
(64, 15, -1, ''),
(64, 16, -1, ''),
(64, 17, -1, ''),
(64, 19, -1, ''),
(65, 3, 0, ''),
(65, 15, -1, ''),
(65, 19, -1, ''),
(66, 3, -1, 'sd'),
(66, 15, -1, ''),
(66, 19, -1, ''),
(67, 3, 0, ''),
(67, 15, -1, ''),
(67, 19, -1, ''),
(68, 3, 1, ''),
(68, 15, -1, ''),
(68, 19, -1, ''),
(69, 3, 1, ''),
(69, 15, -1, ''),
(69, 19, -1, ''),
(70, 3, 0, ''),
(70, 15, -1, ''),
(70, 19, -1, ''),
(71, 3, 0, ''),
(71, 15, -1, ''),
(71, 19, -1, ''),
(72, 3, 1, ''),
(72, 15, -1, ''),
(72, 19, -1, ''),
(90, 18, -1, ''),
(90, 21, 1, ''),
(90, 22, 1, ''),
(90, 23, 1, ''),
(90, 24, 1, ''),
(90, 25, 1, ''),
(91, 18, -1, ''),
(91, 21, 1, ''),
(91, 22, 1, ''),
(91, 23, 1, ''),
(91, 24, 1, ''),
(91, 25, -1, 'Incompleto'),
(92, 18, -1, ''),
(92, 21, 1, ''),
(92, 22, 0, ''),
(92, 23, 1, ''),
(92, 24, 1, ''),
(92, 25, 1, ''),
(93, 18, -1, ''),
(93, 21, 1, ''),
(93, 22, 1, ''),
(93, 23, 1, ''),
(93, 24, 1, ''),
(93, 25, 1, ''),
(94, 18, -1, ''),
(94, 21, 1, ''),
(94, 22, 1, ''),
(94, 23, 1, ''),
(94, 24, 1, ''),
(94, 25, 1, ''),
(95, 18, -1, ''),
(95, 21, 1, ''),
(95, 22, 1, ''),
(95, 23, 1, ''),
(95, 24, 1, ''),
(95, 25, 1, ''),
(96, 18, -1, ''),
(96, 21, 1, ''),
(96, 22, 1, ''),
(96, 23, 1, ''),
(96, 24, 1, ''),
(96, 25, 1, ''),
(97, 18, -1, ''),
(97, 21, 1, ''),
(97, 22, 1, ''),
(97, 23, 1, ''),
(97, 24, 1, ''),
(97, 25, 1, ''),
(98, 18, -1, ''),
(98, 21, 1, ''),
(98, 22, 1, ''),
(98, 23, 1, ''),
(98, 24, 1, ''),
(98, 25, 1, ''),
(99, 18, -1, ''),
(99, 21, 1, ''),
(99, 22, 1, ''),
(99, 23, 1, ''),
(99, 24, 1, ''),
(99, 25, 1, ''),
(100, 18, -1, ''),
(100, 21, 1, ''),
(100, 22, 1, ''),
(100, 23, 1, ''),
(100, 24, 1, ''),
(100, 25, 1, ''),
(101, 18, -1, ''),
(101, 21, 1, ''),
(101, 22, 1, ''),
(101, 23, 1, ''),
(101, 24, 1, ''),
(101, 25, 1, ''),
(102, 18, -1, ''),
(102, 21, 1, ''),
(102, 22, 1, ''),
(102, 23, 1, ''),
(102, 24, 1, ''),
(102, 25, 1, ''),
(103, 18, -1, ''),
(103, 21, 1, ''),
(103, 22, 0, ''),
(103, 23, 1, ''),
(103, 24, 0, ''),
(103, 25, 0, ''),
(104, 18, -1, ''),
(104, 21, 1, ''),
(104, 22, 1, ''),
(104, 23, 1, ''),
(104, 24, 1, ''),
(104, 25, 1, ''),
(105, 18, -1, ''),
(105, 21, 0, ''),
(105, 22, 0, ''),
(105, 23, 1, ''),
(105, 24, 0, ''),
(105, 25, 0, ''),
(106, 18, -1, ''),
(106, 21, 1, ''),
(106, 22, 1, ''),
(106, 23, 1, ''),
(106, 24, 0, ''),
(106, 25, 1, ''),
(107, 18, -1, ''),
(107, 21, 1, ''),
(107, 22, 1, ''),
(107, 23, 1, ''),
(107, 24, 1, ''),
(107, 25, 1, ''),
(108, 18, -1, ''),
(108, 21, 0, ''),
(108, 22, 0, ''),
(108, 23, 1, ''),
(108, 24, 1, ''),
(108, 25, 1, ''),
(109, 18, -1, ''),
(109, 21, 1, ''),
(109, 22, 1, ''),
(109, 23, 1, ''),
(109, 24, 1, ''),
(109, 25, 1, ''),
(110, 18, -1, ''),
(110, 21, 0, ''),
(110, 22, 1, ''),
(110, 23, 1, ''),
(110, 24, 1, ''),
(110, 25, 1, ''),
(111, 7, -1, ''),
(111, 8, -1, ''),
(111, 9, -1, ' vbm bm'),
(111, 11, -1, ''),
(111, 16, -1, ''),
(111, 17, 0, ''),
(112, 7, -1, ''),
(112, 8, -1, ''),
(112, 9, -1, ''),
(112, 11, -1, ''),
(112, 16, -1, ''),
(112, 17, 1, ''),
(113, 7, -1, ''),
(113, 8, -1, ''),
(113, 9, -1, ''),
(113, 11, -1, ''),
(113, 16, -1, ''),
(113, 17, 1, ''),
(114, 7, -1, ''),
(114, 8, -1, ''),
(114, 9, -1, ''),
(114, 11, -1, ''),
(114, 16, -1, ''),
(114, 17, 1, ''),
(115, 7, -1, ''),
(115, 8, -1, ''),
(115, 9, -1, ''),
(115, 11, -1, ''),
(115, 16, -1, ''),
(115, 17, 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_guias`
--

CREATE TABLE IF NOT EXISTS `items_guias` (
  `id_item` int(10) unsigned NOT NULL,
  `id_guia` int(10) unsigned NOT NULL,
  `pos_item` int(10) unsigned NOT NULL,
  `nro_item` int(10) unsigned NOT NULL,
  `id_grupoitem` int(10) unsigned DEFAULT NULL,
  `id_sec` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_item`,`id_guia`),
  KEY `id_guia` (`id_guia`),
  KEY `id_grupoitem` (`id_grupoitem`),
  KEY `id_sec` (`id_sec`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `items_guias`
--

INSERT INTO `items_guias` (`id_item`, `id_guia`, `pos_item`, `nro_item`, `id_grupoitem`, `id_sec`) VALUES
(1, 1, 1, 1, NULL, NULL),
(1, 3, 1, 1, NULL, NULL),
(1, 4, 3, 3, NULL, NULL),
(1, 6, 1, 1, NULL, NULL),
(2, 1, 2, 1, 1, NULL),
(2, 6, 3, 2, 11, NULL),
(3, 1, 3, 2, 1, NULL),
(3, 6, 7, 6, 11, NULL),
(4, 1, 4, 3, 1, NULL),
(5, 1, 5, 4, 1, NULL),
(6, 1, 6, 5, 1, NULL),
(7, 1, 7, 6, 1, NULL),
(7, 3, 2, 1, 8, NULL),
(7, 4, 5, 2, 9, NULL),
(7, 6, 2, 1, 11, NULL),
(8, 1, 8, 7, 1, NULL),
(8, 6, 8, 7, 11, NULL),
(9, 1, 9, 8, 1, NULL),
(9, 3, 4, 3, 8, NULL),
(9, 4, 7, 4, 9, NULL),
(9, 6, 5, 4, 11, NULL),
(10, 1, 10, 9, 1, NULL),
(10, 3, 5, 4, 8, NULL),
(10, 4, 8, 5, 9, NULL),
(10, 6, 6, 5, 11, NULL),
(11, 1, 11, 10, 1, NULL),
(12, 1, 12, 11, 1, NULL),
(13, 1, 13, 3, NULL, NULL),
(13, 4, 1, 1, NULL, NULL),
(14, 1, 14, 4, NULL, NULL),
(14, 3, 8, 5, NULL, NULL),
(14, 4, 2, 2, NULL, NULL),
(14, 6, 11, 5, NULL, NULL),
(15, 1, 15, 5, NULL, NULL),
(16, 1, 16, 6, NULL, NULL),
(17, 1, 17, 1, 2, NULL),
(18, 1, 18, 2, 2, NULL),
(19, 1, 19, 3, 2, NULL),
(20, 1, 20, 4, 2, NULL),
(21, 1, 21, 5, 2, NULL),
(22, 1, 22, 6, 2, NULL),
(23, 1, 23, 1, 3, NULL),
(24, 1, 24, 2, 3, NULL),
(25, 1, 25, 3, 3, NULL),
(26, 1, 26, 1, 4, NULL),
(27, 1, 27, 2, 4, NULL),
(28, 1, 28, 3, 4, NULL),
(29, 1, 29, 4, 4, NULL),
(30, 1, 30, 1, 5, NULL),
(31, 1, 31, 2, 5, NULL),
(32, 1, 32, 1, 6, NULL),
(33, 1, 33, 2, 6, NULL),
(34, 1, 34, 12, NULL, NULL),
(35, 1, 35, 13, NULL, NULL),
(36, 1, 36, 14, NULL, NULL),
(36, 3, 17, 14, NULL, NULL),
(36, 4, 23, 14, NULL, NULL),
(36, 6, 16, 10, NULL, NULL),
(37, 1, 37, 15, NULL, NULL),
(37, 3, 18, 15, NULL, NULL),
(37, 6, 17, 11, NULL, NULL),
(38, 2, 1, 1, NULL, 1),
(39, 2, 2, 2, NULL, 1),
(40, 2, 3, 1, 7, 1),
(41, 2, 4, 2, 7, 1),
(42, 2, 5, 3, 7, 1),
(43, 2, 6, 4, 7, 1),
(44, 2, 7, 5, 7, 1),
(45, 2, 8, 4, NULL, 1),
(46, 2, 9, 5, NULL, 1),
(47, 2, 10, 6, NULL, 1),
(48, 2, 11, 1, NULL, 2),
(49, 2, 12, 2, NULL, 2),
(50, 2, 13, 3, NULL, 2),
(51, 2, 14, 4, NULL, 2),
(52, 2, 15, 5, NULL, 2),
(53, 2, 16, 1, NULL, 3),
(54, 2, 17, 2, NULL, 3),
(55, 2, 18, 3, NULL, 3),
(56, 2, 19, 4, NULL, 3),
(57, 2, 20, 1, NULL, 4),
(58, 2, 21, 2, NULL, 4),
(59, 2, 22, 1, NULL, 5),
(60, 2, 23, 2, NULL, 5),
(61, 2, 24, 3, NULL, 5),
(62, 3, 3, 2, 8, NULL),
(63, 3, 6, 3, NULL, NULL),
(63, 6, 9, 3, NULL, NULL),
(64, 3, 7, 4, NULL, NULL),
(64, 6, 10, 4, NULL, NULL),
(65, 3, 9, 6, NULL, NULL),
(66, 3, 10, 7, NULL, NULL),
(67, 3, 11, 8, NULL, NULL),
(68, 3, 12, 9, NULL, NULL),
(69, 3, 13, 10, NULL, NULL),
(70, 3, 14, 11, NULL, NULL),
(71, 3, 15, 12, NULL, NULL),
(72, 3, 16, 13, NULL, NULL),
(73, 4, 4, 1, 9, NULL),
(74, 4, 6, 3, 9, NULL),
(75, 4, 9, 5, NULL, NULL),
(76, 4, 10, 6, NULL, NULL),
(77, 4, 11, 7, NULL, NULL),
(78, 4, 12, 1, 10, NULL),
(79, 4, 13, 2, 10, NULL),
(80, 4, 14, 3, 10, NULL),
(81, 4, 15, 4, 10, NULL),
(82, 4, 16, 5, 10, NULL),
(83, 4, 17, 6, 10, NULL),
(84, 4, 18, 9, NULL, NULL),
(85, 4, 19, 10, NULL, NULL),
(86, 4, 20, 11, NULL, NULL),
(87, 4, 21, 12, NULL, NULL),
(88, 4, 22, 13, NULL, NULL),
(89, 4, 24, 15, NULL, NULL),
(90, 5, 1, 1, NULL, NULL),
(91, 5, 2, 2, NULL, NULL),
(92, 5, 3, 3, NULL, NULL),
(93, 5, 4, 4, NULL, NULL),
(94, 5, 5, 5, NULL, NULL),
(95, 5, 6, 6, NULL, NULL),
(96, 5, 7, 7, NULL, NULL),
(97, 5, 8, 8, NULL, NULL),
(98, 5, 9, 9, NULL, NULL),
(99, 5, 10, 10, NULL, NULL),
(100, 5, 11, 11, NULL, NULL),
(101, 5, 12, 12, NULL, NULL),
(102, 5, 13, 13, NULL, NULL),
(103, 5, 14, 14, NULL, NULL),
(104, 5, 15, 15, NULL, NULL),
(105, 5, 16, 16, NULL, NULL),
(106, 5, 17, 17, NULL, NULL),
(107, 5, 18, 18, NULL, NULL),
(108, 5, 19, 19, NULL, NULL),
(109, 5, 20, 20, NULL, NULL),
(110, 5, 21, 21, NULL, NULL),
(111, 6, 4, 3, 11, NULL),
(112, 6, 12, 6, NULL, NULL),
(113, 6, 13, 7, NULL, NULL),
(114, 6, 14, 8, NULL, NULL),
(115, 6, 15, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE IF NOT EXISTS `secciones` (
  `id_sec` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom_sec` varchar(100) DEFAULT NULL,
  `nro_sec` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_sec`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`id_sec`, `nom_sec`, `nro_sec`) VALUES
(1, 'Historia clínica', 1),
(2, 'Examen físico', 2),
(3, 'Pedido de exámenes complementarios. Debe incluir todos', 3),
(4, 'Diagnóstico principal', 4),
(5, '¿Qué recomendación realiza?', 5);

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
