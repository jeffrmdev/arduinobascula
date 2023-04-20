-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-04-2023 a las 15:36:18
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectobascula`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigo_miembros`
--

CREATE TABLE `codigo_miembros` (
  `id` int(11) NOT NULL,
  `codigo_miembro` varchar(5) NOT NULL,
  `rol_miembro` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `codigo_miembros`
--

INSERT INTO `codigo_miembros` (`id`, `codigo_miembro`, `rol_miembro`) VALUES
(1, '1a2b3', 'Administrador'),
(5, '3d4e5', 'Secretaria'),
(6, '1234', 'Digitadores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosarduino`
--

CREATE TABLE `datosarduino` (
  `id` int(11) NOT NULL,
  `medida` varchar(20) NOT NULL,
  `valor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `datosarduino`
--

INSERT INTO `datosarduino` (`id`, `medida`, `valor`) VALUES
(1, 'gramo', '10000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_usuarios`
--

CREATE TABLE `login_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `username_usuario` varchar(16) NOT NULL,
  `nombre_usuario` varchar(20) NOT NULL,
  `apellido_usuario` varchar(20) NOT NULL,
  `id_codigo_miembro` int(11) NOT NULL,
  `correo_usuario` varchar(50) NOT NULL,
  `password_usuario` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `login_usuarios`
--

INSERT INTO `login_usuarios` (`id_usuario`, `username_usuario`, `nombre_usuario`, `apellido_usuario`, `id_codigo_miembro`, `correo_usuario`, `password_usuario`) VALUES
(1, 'admin', 'Jefferson', 'Moreno', 1, 'jeffrios@gmail.com', 'b2tZUm9rVXFvcVpmbUI0azdYV0dxQT09'),
(24, 'jeff123', 'jeff', 'rios', 5, 'jef@rio.com', 'bGwzTDl3V3k3cGplVlZrZmFLSUo0QT09'),
(25, 'jef1234', 'jeff', 'rios', 6, 'je@ri.com', 'bGwzTDl3V3k3cGplVlZrZmFLSUo0QT09'),
(26, 'jeff', 'Jeff', 'Rios', 6, 'jeff@rios123.com', 'bGwzTDl3V3k3cGplVlZrZmFLSUo0QT09'),
(27, 'juan123', 'Juan', 'Rios', 7, 'juan@rios.com', 'bGwzTDl3V3k3cGplVlZrZmFLSUo0QT09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio_materiales`
--

CREATE TABLE `precio_materiales` (
  `id` int(11) NOT NULL,
  `material` varchar(30) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `precio_materiales`
--

INSERT INTO `precio_materiales` (`id`, `material`, `precio`) VALUES
(1, 'PET (botellas plásticas)', '0.75'),
(2, 'Cartón', '0.15'),
(3, 'Vidrio', '0.10'),
(4, 'Chatarra electrónica', '0.15'),
(5, 'Plástico', '0.17'),
(6, 'Aluminio', '0.53'),
(7, 'Papel blanco', '0.18'),
(8, 'Papel mixto', '0.10'),
(14, 'Bateria', '0.57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `material` varchar(30) NOT NULL,
  `peso` varchar(10) NOT NULL,
  `precio` varchar(20) NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `cedula`, `nombre`, `apellido`, `correo`, `direccion`, `material`, `peso`, `precio`, `fecha_registro`) VALUES
(1, '1754126157', 'Jefferson', 'Rios', 'jeff_rios@outlook.com', 'La Morita', '2', '5000', '0.55', '2023-02-21'),
(2, '1754126157', 'Juan', 'Rios', 'jeff_rios1234@outlook.com', 'La Morita', '1', '', '0.00', '2023-02-20'),
(3, '1234567890', 'Alex', 'Perez', 'alex@perez.com', 'La Moriuta', '1', '10000', '7.00', '2023-01-04'),
(4, '1234567890', 'Fern', 'Piedra', '', '', '8', '4500', '0.45', '2023-03-01'),
(5, '1754126157', 'Juan', 'Rios', 'jeff_rios1234@outlook.com', 'La Morita', '14', '10000', '5.70', '2023-06-20'),
(6, '1755123456', 'Alexis', 'Naranjo', '', '', '1', '200', '0.15', '2023-04-06'),
(7, '1567098765', 'Alejandro', 'Hernandez', '', 'Quito', '2', '160', '0.02', '2022-05-19');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `codigo_miembros`
--
ALTER TABLE `codigo_miembros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datosarduino`
--
ALTER TABLE `datosarduino`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login_usuarios`
--
ALTER TABLE `login_usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `precio_materiales`
--
ALTER TABLE `precio_materiales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `codigo_miembros`
--
ALTER TABLE `codigo_miembros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `datosarduino`
--
ALTER TABLE `datosarduino`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `login_usuarios`
--
ALTER TABLE `login_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `precio_materiales`
--
ALTER TABLE `precio_materiales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
