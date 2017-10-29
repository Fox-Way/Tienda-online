-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-10-2017 a las 02:20:53
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `foxway`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_actualizarProductos` (IN `_id_producto` INT, IN `_nombre` VARCHAR(255), IN `_precio` DOUBLE, IN `_dcto` INT, IN `_descripcion` TEXT)  NO SQL
UPDATE productos
SET nombre = _nombre,
precio = _precio,
descuento = _dcto,
descripcion = _descripcion,
precio_con_descuento = (_precio * _dcto) / 100
WHERE id = _id_producto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_cambiarEstadoProductosActivados` (IN `_id_producto` INT)  NO SQL
UPDATE productos
SET inicio = 1
WHERE id = _id_producto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_cambiarEstadoProductosDesactivados` (IN `_id_producto` INT)  NO SQL
UPDATE productos
SET inicio = 0
WHERE id = _id_producto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarCategorias` ()  NO SQL
SELECT
	id,
    nombre,
    estado
FROM categorias
ORDER BY id DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarCategoriasPorId` (IN `_id_categoria` INT)  NO SQL
SELECT
	id,
    nombre,
    estado
FROM categorias
WHERE id = _id_categoria AND estado = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarCategoriasPorNombre` (IN `_nombre` VARCHAR(50))  NO SQL
SELECT count(nombre) as nombre
FROM categorias
WHERE nombre = _nombre$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarColores` ()  NO SQL
SELECT
	id_color,
    color,
    codigo_color
FROM colores$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarColoresPorIdProducto` (IN `_id_producto` INT)  NO SQL
SELECT 
	c.id_color,
    c.color,
    c.codigo_color,
    p.id,
    pc.id_producto,
    pc.id_producto_color
FROM colores c 
INNER JOIN productos_colores pc
ON c.id_color = pc.id_color
INNER JOIN productos p
ON p.id = pc.id_producto
WHERE pc.id_producto = _id_producto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarImagenPorIdProducto` (IN `_id_producto` INT)  NO SQL
SELECT
	id_imagen,
    nombre,
    prioridad
FROM imagenes
WHERE id_producto = _id_producto AND prioridad = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarImagenPrioridad2` (IN `_id_producto` INT)  NO SQL
SELECT
	id_imagen,
    nombre,
    prioridad
FROM imagenes
WHERE id_producto = _id_producto AND prioridad = 2$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarImagenPrioridad3` (IN `_id_producto` INT)  NO SQL
SELECT
	id_imagen,
    nombre,
    prioridad
FROM imagenes
WHERE id_producto = _id_producto AND prioridad = 3$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ConsultarProductos` (IN `_nombre` VARCHAR(255), IN `_id_producto` INT)  NO SQL
SELECT
    COUNT(nombre) AS nombre
FROM productos
WHERE nombre = _nombre AND id <> _id_producto AND nombre <> ''$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ConsultarProductosActivos` ()  NO SQL
SELECT
	p.id,
    p.nombre,
    p.precio,
    p.descripcion,
    p.descuento,
    p.inicio,
    i.nombre AS imagen,
    i.prioridad
FROM productos p
INNER JOIN imagenes i ON i.id_producto = p.id
WHERE i.prioridad = 1 AND inicio = 1 ORDER BY p.nombre$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarProductosParaPaginador` (IN `_pagina` INT, IN `_tamanio` INT)  NO SQL
SELECT
	p.id,
    p.nombre,
    p.precio,
    p.descripcion,
    p.descuento,
    (p.precio - p.precio_con_descuento) AS precio2,
    p.inicio,
    i.nombre AS imagen,
    i.prioridad
FROM productos p
INNER JOIN imagenes i ON i.id_producto = p.id
WHERE i.prioridad = 1 AND inicio = 1 ORDER BY p.nombre DESC LIMIT _pagina, _tamanio$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ConsultarProductosPorId` (IN `_id_producto` INT)  NO SQL
SELECT
	id,
    nombre,
    precio,
    descripcion,
    id_categoria,
    inicio,
    cantidad,
    descuento,
    (precio - precio_con_descuento) AS precio2
FROM productos
WHERE id = _id_producto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ConsultarProductosPorNombre` (IN `_nombre` VARCHAR(255))  NO SQL
SELECT
    nombre
FROM productos
WHERE nombre = _nombre$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarRolPorId` (IN `_email` VARCHAR(255))  NO SQL
SELECT 
	u.id,
    u.email,
    u.id_rol,
    u.estado,
    r.id_rol,
    r.nombre AS rol
FROM usuarios u
INNER JOIN roles r
ON u.id_rol = r.id_rol
WHERE u.email = _email$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ConsultarTodosProductosConImagen` ()  NO SQL
SELECT
	p.id,
    p.nombre,
    p.precio,
    p.descripcion,
    p.descuento,
    p.inicio,
    i.nombre AS imagen,
    i.prioridad
FROM productos p
INNER JOIN imagenes i ON i.id_producto = p.id
WHERE i.prioridad = 1 ORDER BY p.id DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarUltimoIdProducto` ()  NO SQL
SELECT
	MAX(id) AS id
FROM productos$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarUsuarios` (IN `_email` VARCHAR(255), IN `_password` VARCHAR(255))  NO SQL
SELECT 
	id, 
    email, 
    password, 
    estado, 
    id_rol,
    usuario
FROM usuarios
WHERE email = _email and password = _password and estado = 1 and id_rol = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_guardarCategorias` (IN `_nombre` VARCHAR(50), IN `_estado` INT(1))  NO SQL
INSERT INTO categorias 
(
    id, 
    nombre, 
    estado
)
VALUES
(
    null,
    _nombre,
    _estado
)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_guardarDetallesColor` (IN `_id_producto` INT, IN `_id_color` INT, IN `_cantidad` INT)  NO SQL
INSERT INTO productos_colores
(
	id_producto_color,
    id_producto,
    id_color,
    cantidad
)
VALUES
(
	null,
    _id_producto,
    _id_color,
    _cantidad
)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_guardarNombreImagen` (IN `_nombre` VARCHAR(100), IN `_prioridad` INT, IN `_id_producto` INT)  NO SQL
INSERT INTO imagenes
(
	id_imagen,
    nombre,
    prioridad,
    id_producto
)
VALUES
(
	null,
    _nombre,
    _prioridad,
    _id_producto
)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_guardarProductos` (IN `_nombre` VARCHAR(255), IN `_precio` DOUBLE, IN `_descripcion` TEXT, IN `_categoria` INT, IN `_inicio` INT, IN `_cantidad` SMALLINT, IN `_descuento` DOUBLE)  NO SQL
INSERT INTO productos
(
    id,
    nombre,
    precio,
    descripcion,
    id_categoria,
    inicio,
    cantidad,
    descuento,
    precio_con_descuento
)
VALUES
(
    null,
    _nombre,
    _precio,
    _descripcion,
    _categoria,
    _inicio,
    _cantidad,
    _descuento,
    (_precio * _descuento) / 100
)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `estado`) VALUES
(1, 'camisetas deportivas hombre', 1),
(2, 'ropa dama', 1),
(3, 'ropa deportiva hombre', 1),
(4, 'ropa interior hombre', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colores`
--

CREATE TABLE `colores` (
  `id_color` int(11) NOT NULL,
  `color` varchar(50) NOT NULL,
  `codigo_color` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `colores`
--

INSERT INTO `colores` (`id_color`, `color`, `codigo_color`) VALUES
(1, 'No definido', '0'),
(2, 'yellow', '#ffff00'),
(3, 'blue', '#0000ff'),
(4, 'red', '#ff0000'),
(5, 'green', '#008000'),
(6, 'skyblue', '#87edeb'),
(7, 'white', '#ffffff'),
(8, 'black', '#000000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id_imagen` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `prioridad` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id_imagen`, `nombre`, `prioridad`, `id_producto`) VALUES
(1, '1508890476_01.jpg', 1, 1),
(2, '1508890476_02.jpg', 2, 1),
(3, '1509139852_01.jpg', 1, 2),
(4, '1509213770_01.jpg', 1, 3),
(5, '1509224908_01.jpg', 1, 4),
(6, '1509228981_01.jpeg', 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL,
  `marca` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `fecha_nacimiento` varchar(255) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombres`, `apellidos`, `fecha_nacimiento`, `id_usuario`) VALUES
(1, 'Juan David', 'Vargas Penagos', '23-12-1990', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` double NOT NULL,
  `descripcion` text,
  `id_categoria` int(11) NOT NULL,
  `inicio` int(11) NOT NULL DEFAULT '0',
  `cantidad` smallint(6) DEFAULT NULL,
  `descuento` int(11) DEFAULT NULL,
  `precio_con_descuento` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `descripcion`, `id_categoria`, `inicio`, `cantidad`, `descuento`, `precio_con_descuento`) VALUES
(1, 'camisa', 12000, 'esta es la descripcion del producto y que debe contener minímo 100 caracteres para que sea una descripción válida', 1, 1, 0, 3, 360),
(2, 'camibuso dama', 13500, 'Camibuso para dama hecho 100% en algódon, producto hecho en Colombia, ideal para las noches frías y lluviosas.', 2, 1, 0, 0, 0),
(3, 'pantaloneta', 18000, 'esta es la descripcion', 3, 1, 0, 0, 0),
(4, 'test producto sin descripcion', 2300, '', 3, 1, 0, 1, 23),
(5, 'ropa interior', 12000, 'ropa interior para niño y adulto', 4, 1, 0, 10, 1200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_colores`
--

CREATE TABLE `productos_colores` (
  `id_producto_color` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_color` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos_colores`
--

INSERT INTO `productos_colores` (`id_producto_color`, `id_producto`, `id_color`, `cantidad`) VALUES
(1, 1, 3, 2),
(2, 2, 4, 2),
(3, 3, 2, 1),
(4, 4, 1, 1),
(5, 5, 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_colores_tallas`
--

CREATE TABLE `productos_colores_tallas` (
  `id_producto_color_talla` int(11) NOT NULL,
  `id_talla` int(11) NOT NULL,
  `id_producto_color` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_marcas`
--

CREATE TABLE `productos_marcas` (
  `id_producto_marcas` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre`) VALUES
(1, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tallas`
--

CREATE TABLE `tallas` (
  `id_talla` int(11) NOT NULL,
  `talla` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `email`, `password`, `id_rol`, `estado`) VALUES
(1, 'juan', 'juan@gmail.com', '12345678', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`id_color`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id_imagen`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_colores`
--
ALTER TABLE `productos_colores`
  ADD PRIMARY KEY (`id_producto_color`);

--
-- Indices de la tabla `productos_colores_tallas`
--
ALTER TABLE `productos_colores_tallas`
  ADD PRIMARY KEY (`id_producto_color_talla`);

--
-- Indices de la tabla `productos_marcas`
--
ALTER TABLE `productos_marcas`
  ADD PRIMARY KEY (`id_producto_marcas`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tallas`
--
ALTER TABLE `tallas`
  ADD PRIMARY KEY (`id_talla`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `productos_colores`
--
ALTER TABLE `productos_colores`
  MODIFY `id_producto_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `productos_colores_tallas`
--
ALTER TABLE `productos_colores_tallas`
  MODIFY `id_producto_color_talla` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos_marcas`
--
ALTER TABLE `productos_marcas`
  MODIFY `id_producto_marcas` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tallas`
--
ALTER TABLE `tallas`
  MODIFY `id_talla` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
