-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-02-2017 a las 22:02:27
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jubiladosaluchar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `master` tinyint(1) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `username`, `password`, `master`, `timestamp`, `active`) VALUES
(1, 'Francisco Domingo Córdova Armas', 'cnontolr@gmail.com', 'fdcordova', '$2y$10$V9CCsRO3iSql5uGFcm7DIeQEFNVnFikacNJ6EtPL./RnFCWt9Zy8y', 1, '2017-02-02 02:43:22', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `article`
--

CREATE TABLE `article` (
  `article_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `source` varchar(255) DEFAULT NULL,
  `date` datetime NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `article`
--

INSERT INTO `article` (`article_id`, `admin_id`, `title`, `content`, `source`, `date`, `timestamp`, `active`) VALUES
(1, 1, 'Problemática del Sistema Pensionario para los Jubilados (Modificado)', '<h2>Este será visto como título</h2><p>Aqui va contenido un párrafo...</p><h3>Y este será un subtítulo</h3><div><a href="http://www.google.com.pe/">Aqui un enlace..</a>&nbsp;modificado</div><div><br /></div><div><br /></div><div><b>Este será un texto en negritas..</b></div><div>...&nbsp;<i>y este en cursvas</i></div><div><i><br /></i></div><div>Una lista sin orden:</div><div><ul><li>Item 1</li><li>Item 2</li></ul><div><br /></div></div><div>Una lista ordenada:</div><div><ol><li>Item 1</li><li>Item 2</li></ol><div>mas texto... &nbsp;mas texto... mas texto... mas texto... mas texto...&nbsp;</div></div><div>mas texto... &nbsp;mas texto... mas texto... mas texto... mas texto...&nbsp;</div><div>mas texto... &nbsp;mas texto... mas texto... mas texto... mas texto...&nbsp;</div><div><div>mas texto... &nbsp;mas texto... mas texto... mas texto... mas texto...&nbsp;</div><div>mas texto... &nbsp;mas texto... mas texto... mas texto... mas texto...&nbsp;</div><div>mas texto... &nbsp;mas texto... mas texto... mas texto... mas texto...&nbsp;</div></div><div><div>mas texto... &nbsp;mas texto... mas texto... mas texto... mas texto...&nbsp;</div><div>mas texto... &nbsp;mas texto... mas texto... mas texto... mas texto...&nbsp;</div><div>mas texto... &nbsp;mas texto... mas texto... mas texto... mas texto...&nbsp;</div></div><div><div>mas texto... &nbsp;mas texto... mas texto... mas texto... mas texto...&nbsp;</div><div>mas texto... &nbsp;mas texto... mas texto... mas texto... mas texto...&nbsp;</div><div>mas texto... &nbsp;mas texto... mas texto... mas texto... mas texto...&nbsp;</div></div><div><br /></div><div><div>mas texto... &nbsp;mas texto... mas texto... mas texto... mas texto...&nbsp;</div><div>mas texto... &nbsp;mas texto... mas texto... mas texto... mas texto...&nbsp;</div><div>mas texto... &nbsp;mas texto... mas texto... mas texto... mas texto...&nbsp;</div></div><div><div>mas texto... &nbsp;mas texto... mas texto... mas texto... mas texto...&nbsp;</div><div>mas texto... &nbsp;mas texto... mas texto... mas texto... mas texto...&nbsp;</div><div>mas texto... &nbsp;mas texto... mas texto... mas texto... mas texto...&nbsp;</div></div><div><br /></div><p>texto agregado... &nbsp;texto agregado texto agregado texto agregado texto agregado</p>', 'Jubilados a Luchar. Por una pensión digna.\n\nFuente: Gobierno del Perú (modificada)', '2017-02-02 00:07:32', '2017-02-04 02:30:25', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_comment_id` int(11) DEFAULT NULL,
  `reference_comment_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `edited` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `comment`
--

INSERT INTO `comment` (`comment_id`, `article_id`, `user_id`, `parent_comment_id`, `reference_comment_id`, `content`, `date`, `edited`, `deleted`, `timestamp`) VALUES
(1, 1, 1, NULL, NULL, 'Primer comentario.<br><br>Nueva l&iacute;nea. Misma l&iacute;nea.<br>Otra l&iacute;nea.', '2017-02-16 00:23:58', 0, 0, '2017-02-16 05:23:58'),
(2, 1, 1, NULL, NULL, 'Segundo comentario.<br>Nueva línea.<br><br>Dos espacios &lt;br&gt;.<br>&lt;?php echo ''lol''; ?&gt;', '2017-02-16 01:24:53', 0, 0, '2017-02-16 06:24:53'),
(3, 1, 2, 2, NULL, 'Error en el contenido...', '2017-02-17 03:16:11', 0, 0, '2017-02-17 18:44:56'),
(4, 1, 1, 2, 3, 'Segunda respuesta.<br>probando...', '2017-02-17 03:22:37', 0, 0, '2017-02-17 20:44:49'),
(5, 1, 2, 2, 4, 'Tercer respuesta...', '2017-02-17 18:17:12', 0, 0, '2017-02-17 23:17:12'),
(6, 1, 2, 1, NULL, 'Respuesta a otro comentario...<br>respuesta 01', '2017-02-17 18:29:14', 0, 0, '2017-02-17 23:29:14'),
(7, 1, 1, 1, 6, 'Respuesta a la respuesta..<br>probando... :)', '2017-02-17 18:30:17', 0, 0, '2017-02-17 23:30:17'),
(8, 1, 1, 1, NULL, 'Respuesta al comentario principal..', '2017-02-17 18:32:28', 0, 0, '2017-02-17 23:32:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `email` varchar(70) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `picture` varchar(100) NOT NULL DEFAULT 'default-avatar.png',
  `reg_date` datetime NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`user_id`, `name`, `surname`, `email`, `username`, `password`, `hash`, `picture`, `reg_date`, `timestamp`, `active`) VALUES
(1, 'César', 'Nontol', 'nontol-cesar@hotmail.com', 'nontolcesar', '$2y$10$mSoZdqZtJaz2un7MnlENcO9eRXqxT59ZoHp9xrlw7UxEXe.7vPfeq', '6d48344a9bfcb41607e7c07687fb07fb', 'default-avatar.png', '2017-02-07 17:27:21', '2017-02-08 06:48:55', 1),
(2, 'Usuario', 'De Prueba', 'csrnontol@gmail.com', 'testuser', '$2y$10$TQOkYlIr0Wzc0VmW5mqel.1xLVCk7nAGCx6kMjkmIGZ8Edhnwhwhy', 'bfeed6ac57670935171513081119b2b3', 'default-avatar.png', '2017-02-17 13:40:55', '2017-02-17 18:44:36', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indices de la tabla `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Filtros para la tabla `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`article_id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
