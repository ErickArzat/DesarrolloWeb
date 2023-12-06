-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-11-2023 a las 00:21:40
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `partytion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cakes`
--

CREATE TABLE `cakes` (
  `id_cake` int(11) NOT NULL,
  `name_cake` varchar(50) NOT NULL,
  `img_cake` varchar(100) NOT NULL,
  `price_cake` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `id_clnt` int(11) NOT NULL,
  `name_clnt` varchar(50) NOT NULL,
  `last_name_clnt` varchar(50) NOT NULL,
  `user_clnt` varchar(50) NOT NULL,
  `pass_clnt` varchar(50) NOT NULL,
  `email_clnt` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `decorations`
--

CREATE TABLE `decorations` (
  `id_deco` int(11) NOT NULL,
  `name_deco` varchar(50) NOT NULL,
  `img_deco` varchar(100) NOT NULL,
  `price_deco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deco_party`
--

CREATE TABLE `deco_party` (
  `id_party` int(11) NOT NULL,
  `id_deco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extras`
--

CREATE TABLE `extras` (
  `id_extra` int(11) NOT NULL,
  `name_extra` varchar(50) NOT NULL,
  `price_extra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extra_party`
--

CREATE TABLE `extra_party` (
  `id_party` int(11) NOT NULL,
  `id_extra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palettes`
--

CREATE TABLE `palettes` (
  `id_pal` int(11) NOT NULL,
  `name_pal` varchar(50) NOT NULL,
  `img_pal` varchar(100) NOT NULL,
  `price_pal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parties`
--

CREATE TABLE `parties` (
  `id_party` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_clnt` int(11) NOT NULL,
  `id_pal` int(11) NOT NULL,
  `id_cake` int(11) NOT NULL,
  `id_pay` int(11) NOT NULL,
  `id_staff` int(11) NOT NULL,
  `date_party` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payments`
--

CREATE TABLE `payments` (
  `id_pay` int(11) NOT NULL,
  `amount` int(16) NOT NULL,
  `status` varchar(20) NOT NULL,
  `date_pay` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `staff`
--

CREATE TABLE `staff` (
  `id_staff` int(11) NOT NULL,
  `name_staff` varchar(50) NOT NULL,
  `last_name_staff` varchar(50) NOT NULL,
  `user_staff` varchar(50) NOT NULL,
  `pass_staff` varchar(50) NOT NULL,
  `email_staff` varchar(100) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `types_parties`
--

CREATE TABLE `types_parties` (
  `id_type` int(11) NOT NULL,
  `name_type` varchar(50) NOT NULL,
  `img_type` varchar(100) NOT NULL,
  `price_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cakes`
--
ALTER TABLE `cakes`
  ADD PRIMARY KEY (`id_cake`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id_clnt`);

--
-- Indices de la tabla `decorations`
--
ALTER TABLE `decorations`
  ADD PRIMARY KEY (`id_deco`);

--
-- Indices de la tabla `deco_party`
--
ALTER TABLE `deco_party`
  ADD KEY `id_deco` (`id_deco`),
  ADD KEY `id_party` (`id_party`);

--
-- Indices de la tabla `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id_extra`);

--
-- Indices de la tabla `extra_party`
--
ALTER TABLE `extra_party`
  ADD KEY `id_extra` (`id_extra`),
  ADD KEY `id_party` (`id_party`);

--
-- Indices de la tabla `palettes`
--
ALTER TABLE `palettes`
  ADD PRIMARY KEY (`id_pal`);

--
-- Indices de la tabla `parties`
--
ALTER TABLE `parties`
  ADD PRIMARY KEY (`id_party`),
  ADD KEY `id_type` (`id_type`),
  ADD KEY `id_clnt` (`id_clnt`),
  ADD KEY `id_pal` (`id_pal`),
  ADD KEY `id_cake` (`id_cake`),
  ADD KEY `id_pay` (`id_pay`),
  ADD KEY `id_staff` (`id_staff`);

--
-- Indices de la tabla `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id_pay`);

--
-- Indices de la tabla `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id_staff`);

--
-- Indices de la tabla `types_parties`
--
ALTER TABLE `types_parties`
  ADD PRIMARY KEY (`id_type`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cakes`
--
ALTER TABLE `cakes`
  MODIFY `id_cake` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `id_clnt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `decorations`
--
ALTER TABLE `decorations`
  MODIFY `id_deco` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `extras`
--
ALTER TABLE `extras`
  MODIFY `id_extra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `palettes`
--
ALTER TABLE `palettes`
  MODIFY `id_pal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `parties`
--
ALTER TABLE `parties`
  MODIFY `id_party` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `payments`
--
ALTER TABLE `payments`
  MODIFY `id_pay` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `staff`
--
ALTER TABLE `staff`
  MODIFY `id_staff` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `types_parties`
--
ALTER TABLE `types_parties`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `deco_party`
--
ALTER TABLE `deco_party`
  ADD CONSTRAINT `deco_party_ibfk_1` FOREIGN KEY (`id_deco`) REFERENCES `decorations` (`id_deco`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deco_party_ibfk_2` FOREIGN KEY (`id_party`) REFERENCES `parties` (`id_party`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `extra_party`
--
ALTER TABLE `extra_party`
  ADD CONSTRAINT `extra_party_ibfk_1` FOREIGN KEY (`id_extra`) REFERENCES `extras` (`id_extra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `extra_party_ibfk_2` FOREIGN KEY (`id_party`) REFERENCES `parties` (`id_party`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `parties`
--
ALTER TABLE `parties`
  ADD CONSTRAINT `parties_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `types_parties` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parties_ibfk_2` FOREIGN KEY (`id_clnt`) REFERENCES `clients` (`id_clnt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parties_ibfk_3` FOREIGN KEY (`id_pal`) REFERENCES `palettes` (`id_pal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parties_ibfk_4` FOREIGN KEY (`id_cake`) REFERENCES `cakes` (`id_cake`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parties_ibfk_5` FOREIGN KEY (`id_pay`) REFERENCES `payments` (`id_pay`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parties_ibfk_6` FOREIGN KEY (`id_staff`) REFERENCES `staff` (`id_staff`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
