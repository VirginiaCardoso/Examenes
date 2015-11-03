-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-10-2015 a las 19:21:11
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

# Creamos Base de Datos
CREATE DATABASE IF NOT EXISTS db_dcs;

# selecciono la base de datos sobre la cual voy a hacer modificaciones
USE db_dcs;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_dcs`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE IF NOT EXISTS `alumnos` (
  `lu_alu` int(10) unsigned NOT NULL,
  `apellido_alu` varchar(50) NOT NULL,
  `nom_alu` varchar(50) NOT NULL,
  `dni_alu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`lu_alu`, `apellido_alu`, `nom_alu`, `dni_alu`) VALUES
(98064, 'DimatePineda', 'JhoinerAlexander', 13),
(103027, 'Lambertucci', 'Antonela', 1),
(106038, 'Denk', 'Josefina', 12),
(106392, 'Escobar', 'Jorge', 8),
(108406, 'Munoz', 'Melisa', 4),
(108824, 'Campetelli', 'Estefania', 9),
(109054, 'Insaurralde', 'Alejandrina', 16),
(109120, 'Marin', 'Sofia', 7),
(111792, 'Santi', 'Agostina', 5),
(112181, 'Menendez', 'Celeste', 2),
(112183, 'Montana', 'Daiana', 3),
(112184, 'Gutierrez', 'MariaBelen', 14),
(112188, 'Laucirica', 'Ailen', 17),
(112194, 'Zabala', 'Victor', 6),
(112199, 'Cesari', 'Macarena', 10),
(112207, 'Hernandez', 'Monica', 15),
(112216, 'Cicconi', 'Gimena', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_catedras`
--

CREATE TABLE IF NOT EXISTS `alumnos_catedras` (
  `lu_alu` int(10) unsigned NOT NULL,
  `cod_cat` int(10) unsigned NOT NULL,
  `estado_alu_cat` int(11) NOT NULL DEFAULT '0',
  `periodo_alu_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos_catedras`
--

INSERT INTO `alumnos_catedras` (`lu_alu`, `cod_cat`, `estado_alu_cat`, `periodo_alu_cat`) VALUES
(98064, 20018, 0, 0),
(103027, 20018, 0, 0),
(106038, 20018, 0, 0),
(106392, 20018, 0, 0),
(108406, 20018, 0, 0),
(108824, 20018, 0, 0),
(109054, 20018, 0, 0),
(109120, 20018, 0, 0),
(111792, 20018, 0, 0),
(112181, 20018, 0, 0),
(112183, 20018, 0, 0),
(112184, 20018, 0, 0),
(112188, 20018, 0, 0),
(112194, 20018, 0, 0),
(112199, 20018, 0, 0),
(112207, 20018, 0, 0),
(112216, 20018, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE IF NOT EXISTS `carreras` (
  `cod_carr` int(10) unsigned NOT NULL,
  `nom_carr` varchar(40) NOT NULL
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
  `nom_cat` varchar(80) NOT NULL
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
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('1ea529dfc1a4a752cca0a0953bc98c9c', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/20100101 Firefox/38.0', 1443735002, 'a:3:{s:9:"user_data";s:0:"";s:7:"usuario";a:8:{s:7:"leg_doc";s:5:"12198";s:12:"apellido_doc";s:10:"Stepanosky";s:7:"nom_doc";s:6:"Silvia";s:7:"dni_doc";N;s:9:"email_doc";N;s:7:"tel_doc";N;s:6:"activo";s:1:"1";s:10:"privilegio";s:1:"2";}s:16:"actividad_actual";s:14:"generar_examen";}'),
('71dba3da6115e88e6c0cd41d74be518e', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/20100101 Firefox/38.0', 1444151819, 'a:3:{s:9:"user_data";s:0:"";s:7:"usuario";a:8:{s:7:"leg_doc";s:5:"12198";s:12:"apellido_doc";s:10:"Stepanosky";s:7:"nom_doc";s:6:"Silvia";s:7:"dni_doc";N;s:9:"email_doc";N;s:7:"tel_doc";N;s:6:"activo";s:1:"1";s:10:"privilegio";s:1:"2";}s:16:"actividad_actual";s:14:"generar_examen";}'),
('aa6cc5e9c4ff36f958f59bfc95bf3ff4', '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:38.0) Gecko/20100101 Firefox/38.0', 1444151804, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descripciones`
--

CREATE TABLE IF NOT EXISTS `descripciones` (
  `id_desc` int(10) unsigned NOT NULL,
  `id_guia` int(10) unsigned NOT NULL,
  `nom_desc` varchar(50) DEFAULT NULL,
  `contenido_desc` text
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

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
(10, 4, 'Caso clínico', 'El Sr. Matías de 47 años, se encuentra internado en el servicio de Clínica Médica y refiere dolor precordial agudo, punzante, valorado en 8/10 según escala de dolor de 1-10. \n\nUd. deberá realizarle un Electrocardiograma de 12 derivaciones de inmediato.\n'),
(11, 4, 'Escenario', 'Persona (simulador) en cama, en ámbito hospitalario, en posición supina.'),
(12, 4, 'Requerimientos', 'Simulador (muñeco completo o tronco) de adulto, electrocardiógrafo, alcohol en gel, gel conductor, hojas de registro de enfermería, lapicera.'),
(13, 5, 'Objetivo del taller', 'Realizar las maniobras de parto normal de término en presentación cefálica, incluyendo corte de cordón umbilical y alumbramiento'),
(14, 5, 'Escenario', 'Laboratorio de competencias profesionales'),
(15, 5, 'Requerimientos', 'Simulador de parto colocado en el borde de la camilla, armado con feto de término en presentación cefálica, con pared abdominal transparente, guantes, gasas, apósito (no estéril),antiséptico (reemplazar por agua para conservación del simulador), dos campos quirúrgicos,  clamp de cordón (ó similar),tijera, pinza de Kocher, recipiente con bolsa roja para desechar placenta'),
(16, 5, 'Consigna', 'El alumno deberá realizar el parto normal de término de un feto en cefálica, relatando cada paso que realice en voz alta y comunicándose con la paciente simulada y su asistente (enfermera - neonatólogo).'),
(17, 6, 'Objetivo del taller', 'El estudiante será capaz  de controlar oximetría de pulso.'),
(18, 6, 'Caso clínico', 'El señor Román, de 64 años, ingresa al Servicio de Cuidados Intensivos con diagnóstico de enfermedad pulmonar obstructiva crónica reagudizada. \nSe indica medición de oximetría de pulso.'),
(19, 6, 'Escenario', 'Laboratorio de competencias profesionales.'),
(20, 6, 'Requerimientos', 'Usuario simulado, alcohol en gel, bandeja, torundas de algodón, alcohol al 70%, oxímetro de pulso, hojas de registro y  bolígrafo.'),
(21, 7, 'Objetivo del taller', 'El estudiante será capaz de realizar cateterismo vesical permanente'),
(22, 7, 'Escenario', 'Laboratorio de competencias profesionales'),
(23, 7, 'Requerimientos', 'Simulador de genitales varón. Alcohol en gel.\r\nPara higiene perineal: Jarra, chata, paños o apósitos, Iodopovidona, solución jabonosa, guantes.\r\nPara colocación del catéter: Guantes estériles, solución de iodovopidona, ápósitos o gasas, compresas estériles(fenestrada y cerrada), catéter Doley de diferentes calibres, lidocaína jalea, 2 jeringas de 10 ml., ampollas de agua destilada estéril, bolsa colecta, cinta adhesiva, hojas de registro, bolígrafo, bandeja y bolsa roja.');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`leg_doc`, `pass`, `apellido_doc`, `nom_doc`, `dni_doc`, `email_doc`, `tel_doc`, `activo`, `privilegio`) VALUES
-- (123, '21232f297a57a5a743894a0e4a801fc3', 'Administrador', 'Super', 11111111, 'admin@laboratorios.dcs.uns.edu.ar', NULL, 1, 3),
-- (1010, '1e48c4420b7073bc11916c6c1de226bb', 'Castaña', 'Cacho', 5654456, NULL, NULL, 0, 0),
-- (2020, '7b7a53e239400a13bd6be6c91c4f6c4e', 'Mensaje', 'Manda', 12356845, NULL, NULL, 0, -1),
 (5201, '4d186321c1a7f0f354b297e8914ab240', 'Zapata', 'Juan', 10568956, 'johnzapata@uns.edu.ar', '4568746', 1, 0),
-- (5555, '6074c6aa3488f3c2dddff2a7ca821aab', 'Natalia', 'Natalia', 5585585, NULL, NULL, 1, 0),
 (7865, '4d1a65f1c6d24c1f8f714fe7e31d29fc', 'Pérez', 'Marcela', 20568987, NULL, NULL, 1, 0),
-- (10325, 'e10adc3949ba59abbe56e057f20f883e', 'Skinner', 'Seymour', 9125654, 'skinner@springfield.com', '(011)156-589632', 1, 2),
(12179, '3eb38fa8079f887324e8ee1d92b3da12', 'Steel', 'Idina', NULL, NULL, NULL, 1, 0),
(12198, '0c4f092e9f42a14a91c0d2183e106a45', 'Stepanosky', 'Silvia', NULL, NULL, NULL, 1, 2),
-- (12821, 'd419480c20f41bcd867bb4517ef14701', 'Coronel', 'Fernando', NULL, NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes_catedras`
--

CREATE TABLE IF NOT EXISTS `docentes_catedras` (
  `leg_doc` int(10) unsigned NOT NULL,
  `cod_cat` int(10) unsigned NOT NULL,
  `permiso_doc` int(11) NOT NULL DEFAULT '0'
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
(12821, 20020, 2);

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
  `porcentaje_exam` float DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `examenes`
--

INSERT INTO `examenes` (`id_exam`, `id_guia`, `cod_cat`, `lu_alu`, `leg_doc`, `fecha`, `calificacion`, `obs_exam`, `porcentaje_exam`) VALUES
(1, 1, 20018, 100233, 5201, '2015-09-29 16:14:52', 1, 'Esta es una observación general del examen', NULL),
(2, 2, 20059, 102137, 10325, '2015-09-29 16:15:02', 0, 'Esta es una observación general del examen', NULL),
(3, 7, 20018, 112199, 12198, '2015-10-01 22:35:33', 1, '', -1),
(4, 7, 20018, 106038, 12198, '2015-10-01 22:55:10', 1, '', -1),
(5, 7, 20018, 109054, 12198, '2015-10-01 23:13:16', 1, '', -1),
(6, 7, 20018, 98064, 12198, '2015-10-01 23:29:43', 2, '', -1),
(7, 7, 20018, 112188, 12198, '2015-10-01 23:50:43', 1, '', -1),
(8, 7, 20018, 112207, 12198, '2015-10-02 00:06:42', 0, '', -1),
(9, 7, 20018, 112184, 12198, '2015-10-02 00:18:24', 1, '', -1),
(10, 7, 20018, 112216, 12198, '2015-10-02 00:32:42', 1, '', -1),
(11, 7, 20018, 112183, 12198, '2015-10-02 01:57:54', 1, '', -1),
(12, 7, 20018, 108406, 12198, '2015-10-02 02:14:52', 1, '', -1),
(13, 7, 20018, 106392, 12198, '2015-10-02 02:30:02', 1, '', -1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupositems`
--

CREATE TABLE IF NOT EXISTS `grupositems` (
  `id_grupoitem` int(10) unsigned NOT NULL,
  `nom_grupoitem` varchar(255) DEFAULT NULL,
  `nro_grupoitem` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

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
(11, 'Prepara material:', 2),
(12, 'Prepara material:', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guias`
--

CREATE TABLE IF NOT EXISTS `guias` (
  `id_guia` int(10) unsigned NOT NULL,
  `tit_guia` varchar(100) NOT NULL,
  `subtit_guia` varchar(160) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `guias`
--

INSERT INTO `guias` (`id_guia`, `tit_guia`, `subtit_guia`) VALUES
(1, 'Control de constantes vitales', NULL),
(2, 'Examen final de carrera - Estación nº 3', NULL),
(3, 'Medición de altura uterina', NULL),
(4, 'Electrocardiograma de 12 derivaciones', NULL),
(5, 'Atención de parto normal', NULL),
(6, 'Oximetría de pulso', NULL),
(7, 'Cateterismo Vesical Permanente', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guias_catedras`
--

CREATE TABLE IF NOT EXISTS `guias_catedras` (
  `id_guia` int(10) unsigned NOT NULL,
  `cod_cat` int(10) unsigned NOT NULL,
  `nro_guia` int(10) unsigned NOT NULL
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
(6, 20018, 11),
(7, 20018, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id_item` int(10) unsigned NOT NULL,
  `nom_item` varchar(255) NOT NULL,
  `solo_texto` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=latin1;

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
(115, 'Decontamina el oxímetro con torundas de algodón y alcohol al 70%.', 0),
(116, 'Jarra y chata', 0),
(117, 'Paños o apósitos', 0),
(118, 'Iodopovidona solución jabonosa', 0),
(119, 'Guantes', 0),
(120, 'Guantes estériles', 0),
(121, 'Solución de Iodopovidona', 0),
(122, 'Gasas estériles', 0),
(123, 'Compresa estéril fenestrada', 0),
(124, 'Compresa estéril cerrada', 0),
(125, 'Catéter Foley del calibre adecuado', 0),
(126, 'Lidocaína jalea', 0),
(127, '2 jeringas de 10 ml.', 0),
(128, 'Ampollas de agua destilada estéril', 0),
(129, 'Bolsa colectora', 0),
(130, 'Cinta adhesiva', 0),
(131, 'Hoja de registro y bolígrafo', 0),
(132, 'Bandeja', 0),
(133, 'Bolsa roja', 0),
(134, 'Se coloca los guantes', 0),
(135, 'Realiza higiene perineal', 0),
(136, 'Se retira los guantes y los descarta', 0),
(137, 'Se lava manos', 0),
(138, 'Prepara material estéril sin contaminar', 0),
(139, 'Se coloca guantes estériles', 0),
(140, 'Inyecta lidocaína con jeringa en la uretra manteniendo el pene a 90 grados', 0),
(141, 'Introduce el catéter sin contaminar hasta hacer tope en el ángulo prostático', 0),
(142, 'Posiciona el pene en ángulo de 45 grados y continúa introduciendo el catéter hasta la bifurcación del mismo', 0),
(143, 'Verifica la ubicación', 0),
(144, 'Conecta el catéter a la bolsa colectora', 0),
(145, 'Insufla el balón con 10 ml de agua destilada', 0),
(146, 'Retrae suavemente el catéter hasta que haga tope', 0),
(147, 'Retira las compresas y las descarta', 0),
(148, 'Fija la tubuladura al muslo con cinta adhesiva', 0),
(149, 'Limpia y ordena los elementos utilizados', 0),
(150, 'Descarta el material y se retira los guantes', 0),
(151, 'Se lava las manos', 0),
(152, 'Registra el procedimiento', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itemsestudiante`
--

CREATE TABLE IF NOT EXISTS `itemsestudiante` (
  `id_itemest` int(10) unsigned NOT NULL,
  `nom_itemest` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

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
(8, 'Requerimientos: Haber leído / comprendido / preguntado las maniobras de atención del parto normal de término en cefálica. \nHaber visto partos normales de término en cefálica\n'),
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
  `nro_item` int(10) unsigned NOT NULL
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
  `obs_item` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `items_examenes`
--

INSERT INTO `items_examenes` (`id_item`, `id_exam`, `estado_item`, `obs_item`) VALUES
(1, 1, 0, 'Esto es una observación'),
(1, 3, 1, ''),
(1, 4, 1, ''),
(1, 5, 1, ''),
(1, 6, 1, ''),
(1, 7, -1, ''),
(1, 8, 1, ''),
(1, 9, 1, ''),
(1, 10, 1, ''),
(1, 11, 1, ''),
(1, 12, 1, ''),
(1, 13, 1, ''),
(2, 1, 1, NULL),
(3, 1, 0, NULL),
(4, 1, 1, NULL),
(5, 1, 0, NULL),
(6, 1, 1, NULL),
(7, 1, 1, NULL),
(7, 3, 1, ''),
(7, 4, 1, ''),
(7, 5, 1, ''),
(7, 6, 1, ''),
(7, 7, 1, ''),
(7, 8, 1, ''),
(7, 9, 1, ''),
(7, 10, 1, ''),
(7, 11, 1, ''),
(7, 12, 1, ''),
(7, 13, 1, ''),
(8, 1, 1, NULL),
(9, 1, 1, NULL),
(10, 1, 0, NULL),
(11, 1, 1, NULL),
(12, 1, 1, NULL),
(13, 1, 0, NULL),
(14, 1, 1, NULL),
(15, 1, 0, NULL),
(16, 1, 0, NULL),
(17, 1, 1, NULL),
(18, 1, 1, NULL),
(19, 1, 1, NULL),
(20, 1, 1, NULL),
(21, 1, 1, NULL),
(22, 1, 0, NULL),
(23, 1, 1, NULL),
(24, 1, 0, NULL),
(25, 1, -1, 'No pudo ser observado'),
(26, 1, 0, NULL),
(27, 1, 1, NULL),
(28, 1, 0, NULL),
(29, 1, 1, NULL),
(30, 1, 1, NULL),
(31, 1, 1, NULL),
(32, 1, 1, NULL),
(33, 1, 0, NULL),
(34, 1, 0, NULL),
(35, 1, 1, NULL),
(36, 1, 0, NULL),
(37, 1, 1, NULL),
(38, 2, 0, 'Esto es una observación'),
(39, 2, 1, NULL),
(40, 2, 0, NULL),
(41, 2, 1, NULL),
(42, 2, 0, NULL),
(43, 2, 1, NULL),
(44, 2, 1, NULL),
(45, 2, 1, NULL),
(46, 2, 1, NULL),
(47, 2, 0, NULL),
(48, 2, 1, NULL),
(49, 2, 1, NULL),
(50, 2, 0, NULL),
(51, 2, 1, NULL),
(52, 2, 0, NULL),
(53, 2, 0, NULL),
(54, 2, 1, NULL),
(55, 2, 1, NULL),
(56, 2, -1, 'Bla bla bla'),
(57, 2, 1, NULL),
(58, 2, -1, 'Bla bla bla'),
(59, 2, 0, NULL),
(60, 2, 1, NULL),
(61, 2, -1, 'Bla bla bla'),
(116, 3, 1, ''),
(116, 4, 1, ''),
(116, 5, 1, ''),
(116, 6, 1, ''),
(116, 7, 1, ''),
(116, 8, 1, ''),
(116, 9, 1, ''),
(116, 10, 1, ''),
(116, 11, 1, ''),
(116, 12, 1, ''),
(116, 13, 1, ''),
(117, 3, 1, ''),
(117, 4, 1, ''),
(117, 5, 1, ''),
(117, 6, 1, ''),
(117, 7, 1, ''),
(117, 8, 1, ''),
(117, 9, 1, ''),
(117, 10, 1, ''),
(117, 11, 1, ''),
(117, 12, 1, ''),
(117, 13, 1, ''),
(118, 3, 1, ''),
(118, 4, 1, ''),
(118, 5, 1, ''),
(118, 6, 1, ''),
(118, 7, 1, ''),
(118, 8, 1, ''),
(118, 9, 1, ''),
(118, 10, 1, ''),
(118, 11, 1, ''),
(118, 12, 1, ''),
(118, 13, 1, ''),
(119, 3, 1, ''),
(119, 4, 1, ''),
(119, 5, 1, ''),
(119, 6, 1, ''),
(119, 7, 1, ''),
(119, 8, 1, ''),
(119, 9, 1, ''),
(119, 10, 1, ''),
(119, 11, 1, ''),
(119, 12, 1, ''),
(119, 13, 1, ''),
(120, 3, 1, ''),
(120, 4, 1, ''),
(120, 5, 1, ''),
(120, 6, 1, ''),
(120, 7, 1, ''),
(120, 8, 1, ''),
(120, 9, 1, ''),
(120, 10, 1, ''),
(120, 11, 1, ''),
(120, 12, 1, ''),
(120, 13, 1, ''),
(121, 3, 1, ''),
(121, 4, 1, ''),
(121, 5, 1, ''),
(121, 6, 1, ''),
(121, 7, 1, ''),
(121, 8, 1, ''),
(121, 9, 1, ''),
(121, 10, 1, ''),
(121, 11, 1, ''),
(121, 12, 1, ''),
(121, 13, 1, ''),
(122, 3, 1, ''),
(122, 4, 1, ''),
(122, 5, 1, ''),
(122, 6, 1, ''),
(122, 7, 1, ''),
(122, 8, 1, ''),
(122, 9, 1, ''),
(122, 10, 1, ''),
(122, 11, 1, ''),
(122, 12, 1, ''),
(122, 13, 1, ''),
(123, 3, 1, ''),
(123, 4, 1, ''),
(123, 5, 1, ''),
(123, 6, 1, ''),
(123, 7, 1, ''),
(123, 8, 1, ''),
(123, 9, 1, ''),
(123, 10, 1, ''),
(123, 11, 1, ''),
(123, 12, 1, ''),
(123, 13, 1, ''),
(124, 3, 1, ''),
(124, 4, 1, ''),
(124, 5, 1, ''),
(124, 6, 1, ''),
(124, 7, 1, ''),
(124, 8, 1, ''),
(124, 9, 1, ''),
(124, 10, 1, ''),
(124, 11, 1, ''),
(124, 12, 1, ''),
(124, 13, 1, ''),
(125, 3, 1, ''),
(125, 4, 1, ''),
(125, 5, 1, ''),
(125, 6, 1, ''),
(125, 7, 1, ''),
(125, 8, 1, ''),
(125, 9, 1, ''),
(125, 10, 1, ''),
(125, 11, 1, ''),
(125, 12, 1, ''),
(125, 13, 1, ''),
(126, 3, 1, ''),
(126, 4, 1, ''),
(126, 5, 1, ''),
(126, 6, 1, ''),
(126, 7, 1, ''),
(126, 8, 1, ''),
(126, 9, 1, ''),
(126, 10, 1, ''),
(126, 11, 1, ''),
(126, 12, 1, ''),
(126, 13, 1, ''),
(127, 3, 1, ''),
(127, 4, 1, ''),
(127, 5, 1, ''),
(127, 6, 1, ''),
(127, 7, 1, ''),
(127, 8, 1, ''),
(127, 9, 1, ''),
(127, 10, 1, ''),
(127, 11, 1, ''),
(127, 12, 1, ''),
(127, 13, 1, ''),
(128, 3, 1, 'ampolla solo 1'),
(128, 4, 1, ''),
(128, 5, 1, ''),
(128, 6, 1, ''),
(128, 7, 1, ''),
(128, 8, 1, ''),
(128, 9, 1, ''),
(128, 10, 1, ''),
(128, 11, 1, 'lleva una sola ampolla'),
(128, 12, 1, ''),
(128, 13, 1, ''),
(129, 3, 1, ''),
(129, 4, 1, ''),
(129, 5, 1, ''),
(129, 6, 1, ''),
(129, 7, 1, ''),
(129, 8, 1, ''),
(129, 9, 1, ''),
(129, 10, 1, ''),
(129, 11, 1, ''),
(129, 12, 1, ''),
(129, 13, 1, ''),
(130, 3, 1, ''),
(130, 4, 1, ''),
(130, 5, 1, ''),
(130, 6, 1, ''),
(130, 7, 1, ''),
(130, 8, 1, ''),
(130, 9, 1, ''),
(130, 10, 1, ''),
(130, 11, 0, ''),
(130, 12, 1, ''),
(130, 13, 1, ''),
(131, 3, 1, ''),
(131, 4, 0, ''),
(131, 5, 1, ''),
(131, 6, 1, ''),
(131, 7, 1, ''),
(131, 8, 1, ''),
(131, 9, 1, ''),
(131, 10, 1, ''),
(131, 11, 1, ''),
(131, 12, 0, ''),
(131, 13, 1, ''),
(132, 3, 1, ''),
(132, 4, 1, ''),
(132, 5, 1, ''),
(132, 6, 1, ''),
(132, 7, 1, ''),
(132, 8, 1, ''),
(132, 9, 1, ''),
(132, 10, 1, ''),
(132, 11, 1, ''),
(132, 12, 1, ''),
(132, 13, 1, ''),
(133, 3, 1, ''),
(133, 4, 1, ''),
(133, 5, 1, ''),
(133, 6, 1, ''),
(133, 7, 1, ''),
(133, 8, 1, ''),
(133, 9, 1, ''),
(133, 10, 1, ''),
(133, 11, 1, ''),
(133, 12, 0, ''),
(133, 13, 1, ''),
(134, 3, 1, ''),
(134, 4, 1, ''),
(134, 5, 1, ''),
(134, 6, 1, ''),
(134, 7, 0, ''),
(134, 8, 1, ''),
(134, 9, 1, ''),
(134, 10, 1, ''),
(134, 11, 1, ''),
(134, 12, 0, ''),
(134, 13, 1, ''),
(135, 3, -1, 'incorrecto higiene'),
(135, 4, 1, 'incorrecto'),
(135, 5, 1, 'incorrecta, no coloca chata'),
(135, 6, 1, ''),
(135, 7, 1, ''),
(135, 8, 1, ''),
(135, 9, 1, ''),
(135, 10, 1, ''),
(135, 11, 1, ''),
(135, 12, 1, ''),
(135, 13, 1, ''),
(136, 3, 1, ''),
(136, 4, 1, ''),
(136, 5, 1, ''),
(136, 6, 1, ''),
(136, 7, 0, ''),
(136, 8, 1, ''),
(136, 9, 1, ''),
(136, 10, 1, ''),
(136, 11, 1, ''),
(136, 12, 1, 'no se los coloco'),
(136, 13, 1, ''),
(137, 3, 1, ''),
(137, 4, 1, ''),
(137, 5, 1, ''),
(137, 6, 1, ''),
(137, 7, 1, ''),
(137, 8, 1, ''),
(137, 9, 1, ''),
(137, 10, 1, ''),
(137, 11, 1, ''),
(137, 12, 1, ''),
(137, 13, 1, ''),
(138, 3, 0, ''),
(138, 4, 0, 'contamina compresa y guantes'),
(138, 5, -1, 'contamina los guantes'),
(138, 6, 1, ''),
(138, 7, 1, ''),
(138, 8, 1, ''),
(138, 9, 0, 'contamina los guantes'),
(138, 10, 0, ''),
(138, 11, 0, 'contamina guantes'),
(138, 12, -1, ''),
(138, 13, -1, ''),
(139, 3, 1, 'contamina'),
(139, 4, 1, ''),
(139, 5, 1, ''),
(139, 6, 1, ''),
(139, 7, 1, ''),
(139, 8, 1, ''),
(139, 9, 1, ''),
(139, 10, 1, 'contamina'),
(139, 11, 1, ''),
(139, 12, 1, ''),
(139, 13, 1, ''),
(140, 3, 1, ''),
(140, 4, 1, ''),
(140, 5, 1, ''),
(140, 6, 1, ''),
(140, 7, 1, ''),
(140, 8, 1, ''),
(140, 9, 1, ''),
(140, 10, 1, ''),
(140, 11, 1, ''),
(140, 12, 1, ''),
(140, 13, 1, ''),
(141, 3, 1, ''),
(141, 4, 1, ''),
(141, 5, 1, ''),
(141, 6, 1, ''),
(141, 7, 1, ''),
(141, 8, 1, ''),
(141, 9, 1, ''),
(141, 10, 1, ''),
(141, 11, 1, ''),
(141, 12, 1, ''),
(141, 13, 1, ''),
(142, 3, 1, ''),
(142, 4, 1, ''),
(142, 5, 1, ''),
(142, 6, 1, ''),
(142, 7, 1, ''),
(142, 8, 1, ''),
(142, 9, 1, ''),
(142, 10, 1, ''),
(142, 11, 0, ''),
(142, 12, 1, ''),
(142, 13, 1, ''),
(143, 3, 1, ''),
(143, 4, 1, ''),
(143, 5, 1, ''),
(143, 6, 1, ''),
(143, 7, 1, ''),
(143, 8, 1, ''),
(143, 9, 1, ''),
(143, 10, 1, ''),
(143, 11, 1, ''),
(143, 12, 1, ''),
(143, 13, 1, ''),
(144, 3, 1, ''),
(144, 4, 1, ''),
(144, 5, 1, ''),
(144, 6, 1, ''),
(144, 7, 1, ''),
(144, 8, 1, ''),
(144, 9, 1, ''),
(144, 10, 1, ''),
(144, 11, 1, ''),
(144, 12, 1, ''),
(144, 13, 1, ''),
(145, 3, 1, ''),
(145, 4, 1, ''),
(145, 5, 0, ''),
(145, 6, 1, ''),
(145, 7, 1, ''),
(145, 8, 1, ''),
(145, 9, 1, ''),
(145, 10, 1, ''),
(145, 11, 1, ''),
(145, 12, 1, ''),
(145, 13, 1, ''),
(146, 3, 1, ''),
(146, 4, 1, ''),
(146, 5, 1, 'reconoce no haber insuflado el balon'),
(146, 6, 1, ''),
(146, 7, 1, ''),
(146, 8, 1, ''),
(146, 9, 1, ''),
(146, 10, 1, ''),
(146, 11, 1, ''),
(146, 12, 1, ''),
(146, 13, 1, ''),
(147, 3, 1, ''),
(147, 4, 1, ''),
(147, 5, 1, ''),
(147, 6, 1, ''),
(147, 7, 1, ''),
(147, 8, 1, ''),
(147, 9, 1, ''),
(147, 10, 1, ''),
(147, 11, 1, ''),
(147, 12, 1, ''),
(147, 13, 1, ''),
(148, 3, 1, ''),
(148, 4, 1, ''),
(148, 5, 1, ''),
(148, 6, 1, ''),
(148, 7, 1, ''),
(148, 8, 1, ''),
(148, 9, 1, ''),
(148, 10, 1, ''),
(148, 11, 1, ''),
(148, 12, 1, ''),
(148, 13, 1, ''),
(149, 3, 1, ''),
(149, 4, 1, ''),
(149, 5, 1, ''),
(149, 6, 1, ''),
(149, 7, 1, ''),
(149, 8, 1, ''),
(149, 9, 1, ''),
(149, 10, 1, ''),
(149, 11, 1, ''),
(149, 12, 1, ''),
(149, 13, 1, ''),
(150, 3, 1, ''),
(150, 4, 1, ''),
(150, 5, 1, ''),
(150, 6, 1, ''),
(150, 7, 1, ''),
(150, 8, 1, ''),
(150, 9, 1, ''),
(150, 10, 1, ''),
(150, 11, 1, ''),
(150, 12, 1, ''),
(150, 13, 1, ''),
(151, 3, 1, ''),
(151, 4, 1, ''),
(151, 5, 1, ''),
(151, 6, 1, ''),
(151, 7, 1, ''),
(151, 8, 1, ''),
(151, 9, 1, ''),
(151, 10, 1, ''),
(151, 11, 1, ''),
(151, 12, 1, ''),
(151, 13, 1, ''),
(152, 3, 1, ''),
(152, 4, 1, ''),
(152, 5, 1, ''),
(152, 6, 1, ''),
(152, 7, 1, ''),
(152, 8, 1, ''),
(152, 9, 1, ''),
(152, 10, 1, ''),
(152, 11, 1, ''),
(152, 12, 1, ''),
(152, 13, 1, '');

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
  `id_sec` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `items_guias`
--

INSERT INTO `items_guias` (`id_item`, `id_guia`, `pos_item`, `nro_item`, `id_grupoitem`, `id_sec`) VALUES
(1, 1, 1, 1, NULL, NULL),
(1, 3, 1, 1, NULL, NULL),
(1, 4, 3, 3, NULL, NULL),
(1, 6, 1, 1, NULL, NULL),
(1, 7, 1, 1, NULL, NULL),
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
(7, 7, 2, 1, 12, NULL),
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
(115, 6, 15, 9, NULL, NULL),
(116, 7, 3, 2, 12, NULL),
(117, 7, 4, 3, 12, NULL),
(118, 7, 5, 4, 12, NULL),
(119, 7, 5, 4, 12, NULL),
(120, 7, 6, 5, 12, NULL),
(121, 7, 7, 6, 12, NULL),
(122, 7, 8, 7, 12, NULL),
(123, 7, 9, 8, 12, NULL),
(124, 7, 10, 9, 12, NULL),
(125, 7, 11, 10, 12, NULL),
(126, 7, 12, 11, 12, NULL),
(127, 7, 13, 12, 12, NULL),
(128, 7, 14, 13, 12, NULL),
(129, 7, 15, 14, 12, NULL),
(130, 7, 16, 15, 12, NULL),
(131, 7, 17, 16, 12, NULL),
(132, 7, 18, 17, 12, NULL),
(133, 7, 19, 18, 12, NULL),
(134, 7, 20, 3, NULL, NULL),
(135, 7, 21, 3, NULL, NULL),
(136, 7, 22, 4, NULL, NULL),
(137, 7, 23, 5, NULL, NULL),
(138, 7, 24, 6, NULL, NULL),
(139, 7, 25, 7, NULL, NULL),
(140, 7, 26, 8, NULL, NULL),
(141, 7, 27, 9, NULL, NULL),
(142, 7, 28, 10, NULL, NULL),
(143, 7, 29, 11, NULL, NULL),
(144, 7, 30, 12, NULL, NULL),
(145, 7, 31, 13, NULL, NULL),
(146, 7, 32, 14, NULL, NULL),
(147, 7, 33, 15, NULL, NULL),
(148, 7, 34, 16, NULL, NULL),
(149, 7, 35, 17, NULL, NULL),
(150, 7, 36, 18, NULL, NULL),
(151, 7, 37, 19, NULL, NULL),
(152, 7, 38, 20, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE IF NOT EXISTS `secciones` (
  `id_sec` int(10) unsigned NOT NULL,
  `nom_sec` varchar(100) DEFAULT NULL,
  `nro_sec` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

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
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`lu_alu`),
  ADD UNIQUE KEY `lu_alu` (`lu_alu`),
  ADD UNIQUE KEY `dni_alu` (`dni_alu`);

--
-- Indices de la tabla `alumnos_catedras`
--
ALTER TABLE `alumnos_catedras`
  ADD PRIMARY KEY (`lu_alu`,`cod_cat`),
  ADD KEY `cod_cat` (`cod_cat`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`cod_carr`),
  ADD UNIQUE KEY `cod_carr` (`cod_carr`);

--
-- Indices de la tabla `catedras`
--
ALTER TABLE `catedras`
  ADD PRIMARY KEY (`cod_cat`),
  ADD UNIQUE KEY `cod_cat` (`cod_cat`),
  ADD KEY `fk_cod_carr` (`cod_carr`);

--
-- Indices de la tabla `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indices de la tabla `descripciones`
--
ALTER TABLE `descripciones`
  ADD PRIMARY KEY (`id_desc`),
  ADD KEY `fk_id_guia` (`id_guia`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`leg_doc`),
  ADD UNIQUE KEY `leg_doc` (`leg_doc`),
  ADD UNIQUE KEY `dni_doc` (`dni_doc`);

--
-- Indices de la tabla `docentes_catedras`
--
ALTER TABLE `docentes_catedras`
  ADD PRIMARY KEY (`leg_doc`,`cod_cat`),
  ADD KEY `fk_cod_cat` (`cod_cat`);

--
-- Indices de la tabla `examenes`
--
ALTER TABLE `examenes`
  ADD PRIMARY KEY (`id_exam`),
  ADD KEY `id_guia` (`id_guia`),
  ADD KEY `cod_cat` (`cod_cat`),
  ADD KEY `lu_alu` (`lu_alu`),
  ADD KEY `leg_doc` (`leg_doc`);

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
  ADD PRIMARY KEY (`id_guia`,`cod_cat`),
  ADD KEY `cod_cat` (`cod_cat`);

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
  ADD PRIMARY KEY (`id_itemest`,`id_guia`),
  ADD KEY `id_guia` (`id_guia`);

--
-- Indices de la tabla `items_examenes`
--
ALTER TABLE `items_examenes`
  ADD PRIMARY KEY (`id_item`,`id_exam`),
  ADD KEY `id_exam` (`id_exam`);

--
-- Indices de la tabla `items_guias`
--
ALTER TABLE `items_guias`
  ADD PRIMARY KEY (`id_item`,`id_guia`),
  ADD KEY `id_guia` (`id_guia`),
  ADD KEY `id_grupoitem` (`id_grupoitem`),
  ADD KEY `id_sec` (`id_sec`);

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
  MODIFY `id_guia` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `id_item` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=153;
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
  ADD CONSTRAINT `alumnos_catedras_ibfk_1` FOREIGN KEY (`cod_cat`) REFERENCES `catedras` (`cod_cat`),
  ADD CONSTRAINT `fk_lu_alu` FOREIGN KEY (`lu_alu`) REFERENCES `alumnos` (`lu_alu`);

--
-- Filtros para la tabla `catedras`
--
ALTER TABLE `catedras`
  ADD CONSTRAINT `fk_cod_carr` FOREIGN KEY (`cod_carr`) REFERENCES `carreras` (`cod_carr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `descripciones`
--
ALTER TABLE `descripciones`
  ADD CONSTRAINT `fk_id_guia` FOREIGN KEY (`id_guia`) REFERENCES `guias` (`id_guia`);

--
-- Filtros para la tabla `docentes_catedras`
--
ALTER TABLE `docentes_catedras`
  ADD CONSTRAINT `fk_cod_cat` FOREIGN KEY (`cod_cat`) REFERENCES `catedras` (`cod_cat`),
  ADD CONSTRAINT `fk_leg_doc` FOREIGN KEY (`leg_doc`) REFERENCES `docentes` (`leg_doc`);

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
