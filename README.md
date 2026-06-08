Tienda + Chat tipo Messenger (PHP + MySQL)

Proyecto web tipo marketplace con sistema de publicaciones y chat interno entre usuarios.

---Tecnologías

- PHP (MVC básico)
- MySQL
- HTML / CSS
- JavaScript
- XAMPP

---Funcionalidades

- Registro / Login de usuarios
- Publicaciones CRUD
- Chat entre comprador y vendedor
- Notificaciones de mensajes
- Sistema de leído / entregado / visto
- Panel de usuario
- Separación de chats (Recibidos / Enviados)

  aqui dejo de igual forma la exportacion del sql que uso para la base de datos
  
  -- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-06-2026 a las 23:46:50
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
-- Base de datos: `blog_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Electrónica'),
(2, 'Celulares'),
(3, 'Computadoras'),
(4, 'Videojuegos'),
(5, 'Vehículos'),
(6, 'Hogar'),
(7, 'Ropa'),
(8, 'Mascotas'),
(9, 'Herramientas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios_publicacion`
--

CREATE TABLE `comentarios_publicacion` (
  `id` int(11) NOT NULL,
  `publicacion_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comentarios_publicacion`
--

INSERT INTO `comentarios_publicacion` (`id`, `publicacion_id`, `usuario_id`, `comentario`, `fecha`) VALUES
(1, 7, 1, 'wa wa wa', '2026-06-08 07:24:18'),
(2, 7, 1, 'otia', '2026-06-08 18:02:21'),
(3, 9, 2, 'YEAH', '2026-06-08 19:07:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conversaciones`
--

CREATE TABLE `conversaciones` (
  `id` int(11) NOT NULL,
  `publicacion_id` int(11) NOT NULL,
  `comprador_id` int(11) NOT NULL,
  `vendedor_id` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `conversaciones`
--

INSERT INTO `conversaciones` (`id`, `publicacion_id`, `comprador_id`, `vendedor_id`, `fecha_creacion`) VALUES
(1, 7, 2, 1, '2026-06-08 08:14:54'),
(2, 9, 1, 2, '2026-06-08 19:08:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `publicacion_id` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_producto`
--

CREATE TABLE `imagenes_producto` (
  `id` int(11) NOT NULL,
  `publicacion_id` int(11) NOT NULL,
  `ruta_imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` int(11) NOT NULL,
  `conversacion_id` int(11) NOT NULL,
  `emisor_id` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `leido` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `conversacion_id`, `emisor_id`, `mensaje`, `fecha`, `leido`) VALUES
(1, 1, 2, 'QUE PASO CHAVO DE A COCMO O QUE?', '2026-06-08 08:15:06', 0),
(2, 1, 1, 'OK PUTA', '2026-06-08 08:28:20', 0),
(3, 1, 1, 'SI WE?', '2026-06-08 08:28:32', 0),
(4, 1, 1, 'DATE ´PUS', '2026-06-08 08:28:44', 0),
(5, 1, 1, 'SI WE?', '2026-06-08 08:32:18', 0),
(6, 1, 1, 'OAREL PUES', '2026-06-08 08:34:03', 0),
(7, 1, 1, 'mmmm', '2026-06-08 18:17:03', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_chat`
--

CREATE TABLE `mensajes_chat` (
  `id` int(11) NOT NULL,
  `conversacion_id` int(11) NOT NULL,
  `emisor_id` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `leido` tinyint(4) DEFAULT 0,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `entregado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `mensajes_chat`
--

INSERT INTO `mensajes_chat` (`id`, `conversacion_id`, `emisor_id`, `mensaje`, `leido`, `fecha`, `entregado`) VALUES
(5, 1, 1, 'otia', 1, '2026-06-08 18:39:43', 0),
(6, 1, 1, 'otia', 1, '2026-06-08 18:41:45', 0),
(7, 1, 2, 'ese mero quiero', 1, '2026-06-08 18:42:34', 0),
(8, 1, 2, 'se?', 1, '2026-06-08 18:54:48', 0),
(9, 2, 1, 'si we?', 1, '2026-06-08 19:10:42', 0),
(10, 1, 1, 'ora', 0, '2026-06-08 20:34:09', 0),
(11, 2, 1, 'ok', 0, '2026-06-08 20:34:13', 0),
(12, 1, 1, 'hola', 0, '2026-06-08 20:45:15', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_publicacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `precio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `categoria` varchar(100) DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `condicion_producto` enum('Nuevo','Seminuevo','Usado','Para piezas') DEFAULT 'Usado',
  `estado` enum('Disponible','Apartado','Vendido') DEFAULT 'Disponible',
  `visitas` int(11) DEFAULT 0,
  `destacado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`id`, `titulo`, `contenido`, `imagen`, `usuario_id`, `fecha_publicacion`, `precio`, `categoria`, `ubicacion`, `condicion_producto`, `estado`, `visitas`, `destacado`) VALUES
(5, 'Nueva publicaion', '213', '6a26668460b45.png', 1, '2026-06-08 06:51:48', 123.00, 'Electrónica', NULL, 'Nuevo', 'Disponible', 0, 0),
(6, 'Nueva publicaion', '123244', '6a2666a6b07b4.jpg', 1, '2026-06-08 06:52:22', 546.00, 'Electrónica', NULL, 'Nuevo', 'Disponible', 0, 0),
(7, 'Nueva publicaion', 'jbfbdf', NULL, 1, '2026-06-08 07:07:07', 123.00, 'Electrónica', NULL, 'Nuevo', 'Disponible', 0, 0),
(9, 'Nueva publicaion', '12345567767676', NULL, 2, '2026-06-08 19:07:14', 7657.00, 'Electrónica', NULL, 'Nuevo', 'Disponible', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones_imagenes`
--

CREATE TABLE `publicaciones_imagenes` (
  `id` int(11) NOT NULL,
  `publicacion_id` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `publicaciones_imagenes`
--

INSERT INTO `publicaciones_imagenes` (`id`, `publicacion_id`, `imagen`) VALUES
(1, 7, '6a266a1b3b683.png'),
(2, 7, '6a266a1b3b7f2.jpg'),
(3, 7, '6a266a1b3b9c6.jpg'),
(4, 9, '6a2712e2bc994_8961794.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `publicacion_id` int(11) NOT NULL,
  `motivo` text NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguidores`
--

CREATE TABLE `seguidores` (
  `id` int(11) NOT NULL,
  `seguidor_id` int(11) NOT NULL,
  `vendedor_id` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` varchar(50) DEFAULT 'usuario',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `foto_perfil` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `correo`, `contrasena`, `rol`, `fecha_registro`, `foto_perfil`, `descripcion`, `telefono`) VALUES
(1, 'Javier', 'javiernaranjo344@gmail.com', '12345678', 'usuario', '2026-06-08 01:24:44', NULL, NULL, NULL),
(2, 'JAVI2', 'cuchurrumais@gmail.com', '12345678', 'usuario', '2026-06-08 08:14:45', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `id` int(11) NOT NULL,
  `vendedor_id` int(11) NOT NULL,
  `comprador_id` int(11) NOT NULL,
  `puntuacion` int(11) NOT NULL,
  `comentario` text DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios_publicacion`
--
ALTER TABLE `comentarios_publicacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `conversaciones`
--
ALTER TABLE `conversaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_conversacion` (`publicacion_id`,`comprador_id`,`vendedor_id`),
  ADD KEY `comprador_id` (`comprador_id`),
  ADD KEY `vendedor_id` (`vendedor_id`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `publicacion_id` (`publicacion_id`);

--
-- Indices de la tabla `imagenes_producto`
--
ALTER TABLE `imagenes_producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publicacion_id` (`publicacion_id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversacion_id` (`conversacion_id`),
  ADD KEY `emisor_id` (`emisor_id`);

--
-- Indices de la tabla `mensajes_chat`
--
ALTER TABLE `mensajes_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `publicaciones_imagenes`
--
ALTER TABLE `publicaciones_imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publicacion_id` (`publicacion_id`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seguidores`
--
ALTER TABLE `seguidores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `comentarios_publicacion`
--
ALTER TABLE `comentarios_publicacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `conversaciones`
--
ALTER TABLE `conversaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagenes_producto`
--
ALTER TABLE `imagenes_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `mensajes_chat`
--
ALTER TABLE `mensajes_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `publicaciones_imagenes`
--
ALTER TABLE `publicaciones_imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seguidores`
--
ALTER TABLE `seguidores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `conversaciones`
--
ALTER TABLE `conversaciones`
  ADD CONSTRAINT `conversaciones_ibfk_1` FOREIGN KEY (`publicacion_id`) REFERENCES `publicaciones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `conversaciones_ibfk_2` FOREIGN KEY (`comprador_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `conversaciones_ibfk_3` FOREIGN KEY (`vendedor_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`publicacion_id`) REFERENCES `publicaciones` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `imagenes_producto`
--
ALTER TABLE `imagenes_producto`
  ADD CONSTRAINT `imagenes_producto_ibfk_1` FOREIGN KEY (`publicacion_id`) REFERENCES `publicaciones` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`conversacion_id`) REFERENCES `conversaciones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`emisor_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD CONSTRAINT `publicaciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `publicaciones_imagenes`
--
ALTER TABLE `publicaciones_imagenes`
  ADD CONSTRAINT `publicaciones_imagenes_ibfk_1` FOREIGN KEY (`publicacion_id`) REFERENCES `publicaciones` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
