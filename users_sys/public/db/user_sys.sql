-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: sql306.infinityfree.com
-- Tiempo de generación: 06-03-2026 a las 18:37:26
-- Versión del servidor: 11.4.10-MariaDB
-- Versión de PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

USE user_sys;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `user_sys`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Nombre` varchar(50) NOT NULL,
  `Ci` int(11) NOT NULL,
  `Direccion` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Telefono` int(11) NOT NULL,
  `Ci_texto` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Nombre`, `Ci`, `Direccion`, `Email`, `Telefono`, `Ci_texto`) VALUES
('Carlos', 123456, 'San Lorenzo', 'carlos@gmail.com', 982123451, '123456'),
('Tamara', 168902, 'Asuncion', 'thami@gmail.com', 98721441, '168902'),
('Ana', 235123, 'Asuncion', 'ana@gmail.com', 981234567, '235123'),
('Norma', 567890, 'Villa Elisa', 'Normi@gmail.com', 982123567, '567890'),
('Hector ', 1257932, 'Luque', 'ache@gmail.com', 912321345, '1257932'),
('Julia', 2341678, 'Encarnacion', 'julia@gmail.com', 9812311, '2341678');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Ci`),
  ADD UNIQUE KEY `Ci_UNIQUE` (`Ci`),
  ADD UNIQUE KEY `Ci_texto_UNIQUE` (`Ci_texto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
