-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-09-2019 a las 17:55:54
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `banco_coperacion_ind`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amortizacion`
--

CREATE TABLE `amortizacion` (
  `id_am` int(11) NOT NULL,
  `nombre` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `tiempo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `valor` int(11) NOT NULL,
  `tipo_credito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `amortizacion`
--

INSERT INTO `amortizacion` (`id_am`, `nombre`, `tiempo`, `valor`, `tipo_credito`) VALUES
(3, 'Mensual', 'Dias', 30, 1),
(4, 'Bimestral', 'Dias', 60, 1),
(5, 'Mensual', 'Dias', 30, 3),
(6, 'Trimestral', 'Dias', 90, 3),
(7, 'Bimestral', 'Dias', 60, 7),
(8, 'Trimestral', 'Dias', 90, 7),
(9, 'Mensual', 'Dias', 30, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cli` int(11) NOT NULL,
  `nombre` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `identificacion` varchar(14) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(14) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credito`
--

CREATE TABLE `credito` (
  `id_cre` int(11) NOT NULL,
  `id_usu` int(11) NOT NULL,
  `id_cli` int(11) NOT NULL,
  `id_pla` int(11) NOT NULL,
  `id_am` int(11) NOT NULL,
  `id_tipo_cre` int(11) NOT NULL,
  `id_pago` int(11) NOT NULL,
  `tasa_nominal` float NOT NULL,
  `tasa_eanual` float NOT NULL,
  `tasa_periodica` float NOT NULL,
  `monto` double NOT NULL,
  `n_periodos` int(11) NOT NULL,
  `n_gracia` int(11) DEFAULT NULL,
  `fecha_pago` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plazos`
--

CREATE TABLE `plazos` (
  `id_pla` int(11) NOT NULL,
  `tiempo` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  `tipo_credito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `plazos`
--

INSERT INTO `plazos` (`id_pla`, `tiempo`, `valor`, `tipo_credito`) VALUES
(1, 'Meses', 60, 3),
(2, 'Meses', 72, 3),
(4, 'Meses', 84, 3),
(5, 'Meses', 96, 3),
(6, 'Meses', 108, 3),
(7, 'Meses', 120, 3),
(8, 'Meses', 36, 1),
(9, 'Meses', 48, 1),
(10, 'Meses', 60, 1),
(11, 'Meses', 72, 1),
(12, 'Meses', 84, 1),
(13, 'Meses', 36, 7),
(14, 'Meses', 72, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_credito`
--

CREATE TABLE `tipo_credito` (
  `id_tipo_cre` int(11) NOT NULL,
  `nombre_credito` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ap_gracia` tinyint(1) DEFAULT NULL,
  `id_pago` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_credito`
--

INSERT INTO `tipo_credito` (`id_tipo_cre`, `nombre_credito`, `ap_gracia`, `id_pago`) VALUES
(1, 'CREDITO CON CUOTA FIJA ', 0, 3),
(3, 'CREDITO CON PERIODO DE GRACIA PROPIAMENTE DICHO', 1, 2),
(7, 'CREDITO SIMULADO', 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `id_pago` int(11) NOT NULL,
  `nombre_pago` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_tabla` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_pago`
--

INSERT INTO `tipo_pago` (`id_pago`, `nombre_pago`, `tipo_tabla`) VALUES
(2, 'CUOTAS IGUALES A CAPITAL ', 1),
(3, 'CUOTAS FIJAS DE AMORTIZACION GRADUAL', 2),
(5, 'PAGO SIMULADO', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usu` int(11) NOT NULL,
  `alias` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contrasena` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usu`, `alias`, `usuario`, `contrasena`) VALUES
(3, 'Camilo', 'camilo', '123456'),
(4, 'Administrador', 'admin', '123456'),
(5, 'Usuario', 'usuario@mail.com', '123456');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amortizacion`
--
ALTER TABLE `amortizacion`
  ADD PRIMARY KEY (`id_am`),
  ADD KEY `tipo_credito` (`tipo_credito`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cli`);

--
-- Indices de la tabla `credito`
--
ALTER TABLE `credito`
  ADD PRIMARY KEY (`id_cre`),
  ADD KEY `id_usu` (`id_usu`),
  ADD KEY `id_cli` (`id_cli`),
  ADD KEY `id_pla` (`id_pla`),
  ADD KEY `id_am` (`id_am`),
  ADD KEY `id_pago` (`id_tipo_cre`),
  ADD KEY `id_pago_2` (`id_pago`);

--
-- Indices de la tabla `plazos`
--
ALTER TABLE `plazos`
  ADD PRIMARY KEY (`id_pla`),
  ADD KEY `tipo_credito` (`tipo_credito`);

--
-- Indices de la tabla `tipo_credito`
--
ALTER TABLE `tipo_credito`
  ADD PRIMARY KEY (`id_tipo_cre`),
  ADD KEY `id_pago` (`id_pago`);

--
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`id_pago`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `amortizacion`
--
ALTER TABLE `amortizacion`
  MODIFY `id_am` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cli` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `credito`
--
ALTER TABLE `credito`
  MODIFY `id_cre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plazos`
--
ALTER TABLE `plazos`
  MODIFY `id_pla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tipo_credito`
--
ALTER TABLE `tipo_credito`
  MODIFY `id_tipo_cre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `amortizacion`
--
ALTER TABLE `amortizacion`
  ADD CONSTRAINT `amortizacion_ibfk_1` FOREIGN KEY (`tipo_credito`) REFERENCES `tipo_credito` (`id_tipo_cre`);

--
-- Filtros para la tabla `credito`
--
ALTER TABLE `credito`
  ADD CONSTRAINT `credito_ibfk_2` FOREIGN KEY (`id_cli`) REFERENCES `clientes` (`id_cli`),
  ADD CONSTRAINT `credito_ibfk_3` FOREIGN KEY (`id_pla`) REFERENCES `plazos` (`id_pla`),
  ADD CONSTRAINT `credito_ibfk_4` FOREIGN KEY (`id_am`) REFERENCES `amortizacion` (`id_am`),
  ADD CONSTRAINT `credito_ibfk_5` FOREIGN KEY (`id_usu`) REFERENCES `usuario` (`id_usu`),
  ADD CONSTRAINT `credito_ibfk_6` FOREIGN KEY (`id_tipo_cre`) REFERENCES `tipo_credito` (`id_tipo_cre`),
  ADD CONSTRAINT `credito_ibfk_7` FOREIGN KEY (`id_pago`) REFERENCES `tipo_pago` (`id_pago`);

--
-- Filtros para la tabla `plazos`
--
ALTER TABLE `plazos`
  ADD CONSTRAINT `plazos_ibfk_1` FOREIGN KEY (`tipo_credito`) REFERENCES `tipo_credito` (`id_tipo_cre`);

--
-- Filtros para la tabla `tipo_credito`
--
ALTER TABLE `tipo_credito`
  ADD CONSTRAINT `tipo_credito_ibfk_1` FOREIGN KEY (`id_pago`) REFERENCES `tipo_pago` (`id_pago`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
