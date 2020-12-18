-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2020 a las 05:17:35
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemabar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id` int(11) NOT NULL,
  `Id_Tipo` int(11) NOT NULL,
  `Nombre` varchar(200) DEFAULT NULL,
  `Apellidos` varchar(200) NOT NULL,
  `DNI` int(8) UNSIGNED ZEROFILL NOT NULL,
  `Celular` int(9) DEFAULT NULL,
  `Correo` varchar(100) NOT NULL,
  `Direccion` varchar(200) NOT NULL,
  `Sexo` varchar(1) NOT NULL,
  `Estado_Civil` varchar(1) NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Fecha_Ingreso` date NOT NULL,
  `Fecha_Registro` date NOT NULL,
  `Login` varchar(200) DEFAULT NULL,
  `Clave` varchar(200) DEFAULT NULL,
  `Nombre_Foto` varchar(200) DEFAULT NULL,
  `Estado` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id`, `Id_Tipo`, `Nombre`, `Apellidos`, `DNI`, `Celular`, `Correo`, `Direccion`, `Sexo`, `Estado_Civil`, `Fecha_Nacimiento`, `Fecha_Ingreso`, `Fecha_Registro`, `Login`, `Clave`, `Nombre_Foto`, `Estado`) VALUES
(1, 1, 'Juan Carlos', 'Colala Sandoval', 71885613, 555555555, 'colalon25@gmail.com', 'nose', 'H', 'S', '2019-12-25', '2019-12-02', '2019-01-23', 'admin', 'admin', '', 1),
(2, 3, 'Hemiliana', 'Diaz Cespedes', 44444444, 0, '', '', '', '', '0000-00-00', '0000-00-00', '2019-12-24', 'caja', 'caja', '', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
