-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2026 a las 23:00:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `philiapet_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_log`
--

CREATE TABLE `actividad_log` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `modulo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` varchar(50) DEFAULT 'Verificado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `actividad_log`
--

INSERT INTO `actividad_log` (`id`, `fecha`, `modulo`, `descripcion`, `estado`) VALUES
(1, '2026-11-07 21:35:22', 'Usuarios', 'Nuevo usuario registrado: beto', 'Verificado'),
(2, '2026-11-07 21:35:49', 'Seguridad', 'Inicio de sesión de: beto (adoptante)', 'Verificado'),
(3, '2026-11-07 21:36:36', 'Seguridad', 'Inicio de sesión de: Administrador General (admin)', 'Verificado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id_evento` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_evento` date NOT NULL,
  `hora_evento` time NOT NULL,
  `lugar` varchar(150) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `tipo_evento` varchar(100) DEFAULT NULL,
  `fecha_hora` varchar(150) DEFAULT NULL,
  `fundacion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id_evento`, `titulo`, `descripcion`, `fecha_evento`, `hora_evento`, `lugar`, `fecha_creacion`, `tipo_evento`, `fecha_hora`, `fundacion`) VALUES
(1, 'Pasarela de adopción de peluditos', 'Conoce las mascotas de las fundaciones aliadas, habla con voluntarios y descubre cómo apoyar.', '2026-06-06', '00:00:00', 'C.C. Plaza Central', '2026-06-10 16:18:53', 'Adopción', 'lunes 13diciembre 3pm a6pm ', 'Patitas Felices'),
(2, 'Jornada masiva en Simón Bolívar', 'Estaremos recolectando cobijas y alimento para los refugios independientes validados.', '2026-06-13', '00:00:00', 'Parque Simón Bolívar', '2026-06-10 16:18:53', 'Adopción', 'lunes 13diciembre 3pm a6pm ', 'Patitas Felices'),
(6, 'Pasarela de dizfraces', NULL, '0000-00-00', '00:00:00', 'Centro Comercial Titan Plaza ', '2026-11-07 15:45:00', 'Otro tipo de Evento', 'Domingo, 23 de Diciembre de 11am a 5pm', 'PELUDITOS'),
(7, 'Menos perritos embarazados', NULL, '0000-00-00', '00:00:00', 'C.C. Plaza Central', '2026-11-07 15:46:10', 'Adopción', 'lunes 12 de Diciembre 3pm a6pm ', 'PELUDITOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos_fundaciones`
--

CREATE TABLE `eventos_fundaciones` (
  `id_evento` int(11) NOT NULL,
  `id_fundacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `eventos_fundaciones`
--

INSERT INTO `eventos_fundaciones` (`id_evento`, `id_fundacion`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fundaciones`
--

CREATE TABLE `fundaciones` (
  `id_fundacion` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `representante` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `url_redes_sociales` varchar(255) DEFAULT NULL,
  `qr_nequi_ruta` varchar(255) DEFAULT NULL,
  `estado_verificacion` enum('pendiente','verificado','rechazado') DEFAULT 'pendiente',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `fundaciones`
--

INSERT INTO `fundaciones` (`id_fundacion`, `nombre`, `representante`, `telefono`, `correo`, `direccion`, `url_redes_sociales`, `qr_nequi_ruta`, `estado_verificacion`, `fecha_registro`) VALUES
(1, 'Fundación Huellas de Amor', 'Adriana Rondón', '3115551234', 'contacto@huellasdeamor.org', 'Calle 45 # 22-10, Bogotá', 'https://instagram.com/huellasdeamorbog', NULL, 'verificado', '2026-06-10 16:18:53'),
(2, 'Patitas Bogotanas', 'Carlos Mendoza', '3204445678', 'info@patitasbogotanas.com', 'Carrera 7 # 72-40, Bogotá', 'https://instagram.com/patitasbogotanas', NULL, 'verificado', '2026-06-10 16:18:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interesados_adopcion`
--

CREATE TABLE `interesados_adopcion` (
  `id_interesado` int(11) NOT NULL,
  `id_mascota` int(11) NOT NULL,
  `nombre_completo` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `mensaje_motivo` text DEFAULT NULL,
  `estado_solicitud` enum('enviada','en_revision','aprobada','archivada') DEFAULT 'enviada',
  `fecha_solicitud` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornadas_eventos`
--

CREATE TABLE `jornadas_eventos` (
  `id_evento` int(11) NOT NULL,
  `titulo_evento` varchar(150) NOT NULL,
  `tipo_evento` enum('vacunacion','adopcion_centro_comercial','recolecta','otro') NOT NULL,
  `descripcion_evento` text DEFAULT NULL,
  `fecha_programada` date NOT NULL,
  `hora_programada` time NOT NULL,
  `lugar_encuentro` varchar(150) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

CREATE TABLE `mascotas` (
  `id_mascota` int(11) NOT NULL,
  `id_fundacion` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `especie` enum('perro','gato') NOT NULL,
  `edad_aproximada` varchar(30) NOT NULL,
  `historia` text DEFAULT NULL,
  `estado_salud` varchar(255) DEFAULT 'Sano y listo para adoptar',
  `foto_ruta` varchar(255) DEFAULT NULL,
  `estado_adopcion` enum('disponible','en_proceso','adoptado') DEFAULT 'disponible',
  `imagen` text DEFAULT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `mascotas`
--

INSERT INTO `mascotas` (`id_mascota`, `id_fundacion`, `nombre`, `especie`, `edad_aproximada`, `historia`, `estado_salud`, `foto_ruta`, `estado_adopcion`, `imagen`, `fecha_ingreso`) VALUES
(7, 1, 'Nieve', 'perro', 'joven (4 años)', 'Estaba abandonada, es juguetona, muy cariñosa y tiene aproximadamente 4 años ', 'Esterilizada, sana  ', NULL, 'disponible', 'assets/img/mascota_1793574142_422.jpg', '2026-11-01 23:02:22'),
(8, 1, 'Beto', 'perro', 'adulto (9 años)', 'Es flojo, tranquilo odioso con las personas y tiene 9 años', 'Castrado,  fotosensible', NULL, 'disponible', 'assets/img/mascota_1793574945_289.jpg', '2026-11-01 23:15:45'),
(9, 1, 'Chimuelo ', 'perro', 'cachorro (12 dias)', 'Su madre murio despues de dar a luz y tiene aproximadamente 2 semanas', 'No tiene todas las vacunas al dia', NULL, 'disponible', 'assets/img/mascota_1793577315_513.jpg', '2026-11-01 23:26:42'),
(10, 1, 'Milo', 'gato', 'cachorro (cachorro (7 meses))', 'Estaba debajo de un puente abandonado, en una bolsa de basura ', 'Le falta la pata derecha inferior, sin novedades mayores vacunas al dia ', NULL, 'disponible', 'assets/img/mascota_1793578141_108.jpg', '2026-11-02 00:09:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participacion_eventos`
--

CREATE TABLE `participacion_eventos` (
  `id_evento` int(11) NOT NULL,
  `id_fundacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_donaciones`
--

CREATE TABLE `registro_donaciones` (
  `id_donacion` int(11) NOT NULL,
  `id_fundacion` int(11) NOT NULL,
  `tipo_aporte` enum('dinero','alimento','cobijas','otro') NOT NULL,
  `detalle_donacion` text DEFAULT NULL,
  `nombre_donante` varchar(100) DEFAULT 'Anónimo',
  `fecha_donacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_contacto`
--

CREATE TABLE `solicitudes_contacto` (
  `id_solicitud` int(11) NOT NULL,
  `id_mascota` int(11) NOT NULL,
  `nombre_interesado` varchar(100) NOT NULL,
  `telefono_interesado` varchar(20) NOT NULL,
  `correo_interesado` varchar(100) DEFAULT NULL,
  `mensaje_contacto` text DEFAULT NULL,
  `fecha_envio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('adoptante','refugio','admin') DEFAULT 'adoptante',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `descripcion` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `password`, `rol`, `created_at`, `descripcion`, `foto`) VALUES
(1, 'Refugio Central Bogotá', 'refugio@philiapet.com', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'refugio', '2026-09-23 15:39:25', NULL, NULL),
(2, 'Administrador General', 'A.I.S.ADMINS@yahoo.com', '$2y$10$IZpYfeO/eXItNaQwpASCs.YbGkmHOfEhtybIMAdOLoJqaE.M1iHFC', 'admin', '2026-09-23 15:51:59', NULL, NULL),
(6, 'isamar', 'isarrrr@gmail.com', '$2y$10$23sa/MX6G/kgf4/W.83omOPTJR6k1bIgABHLkzS2Nbb2cntvH1.ym', 'adoptante', '2026-09-28 13:35:20', NULL, NULL),
(8, 'Nieve Carvajal', 'isar88022@gmail.com', '$2y$10$IZpYfeO/eXItNaQwpASCs.YbGkmHOfEhtybIMAdOLoJqaE.M1iHFC', 'adoptante', '2026-11-01 20:39:10', '', 'assets/img/perfiles/perfil_8_1793566548.jpeg'),
(9, 'Fundacion patitas felices', 'patitasfelices@gmail.com', '$2y$10$SBqmu4Vgf8Qf8oih8fBNYeRHb42.xsdSCl4ukgjTqSm3XicC3nGTC', 'refugio', '2026-11-01 21:00:16', NULL, NULL),
(11, 'mariea', 'marie.lapro2@gmail.com', '$2y$10$OXv/tfaqAZf7R2YygmS8.eweCvobFvUXm3ULy9PjViO/uc8Vn3c.i', 'adoptante', '2026-11-07 21:26:44', NULL, NULL),
(12, 'beto', 'betoelmaspro@gmail.com', '$2y$10$C6z8kehHBf2BLvZ9IAFMcu4Q4kzjZ6okl/AXK4N2QHmhlh5Eft.la', 'adoptante', '2026-11-07 21:35:22', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad_log`
--
ALTER TABLE `actividad_log`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_evento`);

--
-- Indices de la tabla `eventos_fundaciones`
--
ALTER TABLE `eventos_fundaciones`
  ADD PRIMARY KEY (`id_evento`,`id_fundacion`),
  ADD KEY `fk_ef_fundaciones` (`id_fundacion`);

--
-- Indices de la tabla `fundaciones`
--
ALTER TABLE `fundaciones`
  ADD PRIMARY KEY (`id_fundacion`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `interesados_adopcion`
--
ALTER TABLE `interesados_adopcion`
  ADD PRIMARY KEY (`id_interesado`),
  ADD KEY `fk_interesados_mascotas` (`id_mascota`);

--
-- Indices de la tabla `jornadas_eventos`
--
ALTER TABLE `jornadas_eventos`
  ADD PRIMARY KEY (`id_evento`);

--
-- Indices de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`id_mascota`),
  ADD KEY `fk_mascotas_fundaciones` (`id_fundacion`);

--
-- Indices de la tabla `participacion_eventos`
--
ALTER TABLE `participacion_eventos`
  ADD PRIMARY KEY (`id_evento`,`id_fundacion`),
  ADD KEY `fk_participacion_fundaciones` (`id_fundacion`);

--
-- Indices de la tabla `registro_donaciones`
--
ALTER TABLE `registro_donaciones`
  ADD PRIMARY KEY (`id_donacion`),
  ADD KEY `fk_donaciones_fundaciones` (`id_fundacion`);

--
-- Indices de la tabla `solicitudes_contacto`
--
ALTER TABLE `solicitudes_contacto`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `fk_contacto_mascotas` (`id_mascota`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad_log`
--
ALTER TABLE `actividad_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `fundaciones`
--
ALTER TABLE `fundaciones`
  MODIFY `id_fundacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `interesados_adopcion`
--
ALTER TABLE `interesados_adopcion`
  MODIFY `id_interesado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jornadas_eventos`
--
ALTER TABLE `jornadas_eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `id_mascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `registro_donaciones`
--
ALTER TABLE `registro_donaciones`
  MODIFY `id_donacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitudes_contacto`
--
ALTER TABLE `solicitudes_contacto`
  MODIFY `id_solicitud` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `eventos_fundaciones`
--
ALTER TABLE `eventos_fundaciones`
  ADD CONSTRAINT `fk_ef_eventos` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id_evento`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ef_fundaciones` FOREIGN KEY (`id_fundacion`) REFERENCES `fundaciones` (`id_fundacion`) ON DELETE CASCADE;

--
-- Filtros para la tabla `interesados_adopcion`
--
ALTER TABLE `interesados_adopcion`
  ADD CONSTRAINT `fk_interesados_mascotas` FOREIGN KEY (`id_mascota`) REFERENCES `mascotas` (`id_mascota`) ON DELETE CASCADE;

--
-- Filtros para la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD CONSTRAINT `fk_mascotas_fundaciones` FOREIGN KEY (`id_fundacion`) REFERENCES `fundaciones` (`id_fundacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `participacion_eventos`
--
ALTER TABLE `participacion_eventos`
  ADD CONSTRAINT `fk_participacion_eventos` FOREIGN KEY (`id_evento`) REFERENCES `jornadas_eventos` (`id_evento`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_participacion_fundaciones` FOREIGN KEY (`id_fundacion`) REFERENCES `fundaciones` (`id_fundacion`) ON DELETE CASCADE;

--
-- Filtros para la tabla `registro_donaciones`
--
ALTER TABLE `registro_donaciones`
  ADD CONSTRAINT `fk_donaciones_fundaciones` FOREIGN KEY (`id_fundacion`) REFERENCES `fundaciones` (`id_fundacion`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitudes_contacto`
--
ALTER TABLE `solicitudes_contacto`
  ADD CONSTRAINT `fk_contacto_mascotas` FOREIGN KEY (`id_mascota`) REFERENCES `mascotas` (`id_mascota`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
