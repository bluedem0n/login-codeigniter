-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-12-2016 a las 04:59:40
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(100) DEFAULT NULL,
  `apellido_usuario` varchar(100) DEFAULT NULL,
  `correo_usuario` varchar(100) DEFAULT NULL,
  `direccion_usuario` varchar(100) DEFAULT NULL,
  `telefono_usuario` varchar(20) DEFAULT NULL,
  `nick_usuario` varchar(50) DEFAULT NULL,
  `pass_usuario` varchar(20) DEFAULT NULL,
  `perfil_usuario` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre_usuario`, `apellido_usuario`, `correo_usuario`, `direccion_usuario`, `telefono_usuario`, `nick_usuario`, `pass_usuario`, `perfil_usuario`) VALUES
(1, 'admin', 'admin', 'aqui va el correo que se configura como remitente en la aplicación', 'direccion', '99999999', 'admin', 'admin', 'administrador'),
(3, 'Sthefany', 'Floriano', 'fany1995fgs@gmail.com', 'jajsajsj', '9078981327', 'sfloriano', 'florianoG1', 'empleado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
