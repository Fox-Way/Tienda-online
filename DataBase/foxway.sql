-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2017 a las 21:00:08
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_actualizarCategorias` (IN `_nombre` VARCHAR(50), IN `_id_categoria` INT)  NO SQL
UPDATE categorias
SET nombre = _nombre
WHERE id = _id_categoria$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_actualizarMarcas` (IN `_marca` VARCHAR(100), IN `_id_marca` INT)  NO SQL
UPDATE marcas
SET marca = _marca
WHERE id_marca = _id_marca$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_actualizarPersonaPorId` (IN `_fecha` VARCHAR(255), IN `_nombres` VARCHAR(255), IN `_apellidos` VARCHAR(255), IN `_id_usuario` INT)  NO SQL
UPDATE personas
SET fecha_nacimiento = _fecha,
nombres = _nombres,
apellidos = _apellidos
WHERE id_usuario = _id_usuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_actualizarProductos` (IN `_id_producto` INT, IN `_nombre` VARCHAR(255), IN `_precio` DOUBLE, IN `_dcto` INT, IN `_descripcion` TEXT)  NO SQL
UPDATE productos
SET nombre = _nombre,
precio = _precio,
descuento = _dcto,
descripcion = _descripcion,
precio_con_descuento = (_precio * _dcto) / 100
WHERE id = _id_producto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_actualizarUsuario` (IN `_usuario` VARCHAR(255), IN `_email` VARCHAR(255), IN `_id_usuario` INT)  NO SQL
UPDATE usuarios
SET email = _email,
usuario = _usuario
WHERE id = _id_usuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_actualizarUsuarios` (IN `_usuario` VARCHAR(100), IN `_email` VARCHAR(255), IN `_id_usuario` INT)  NO SQL
UPDATE usuarios
SET usuario = _usuario,
email = _email
WHERE id = _id_usuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_cambiarEstadoCategoria` (IN `_id_categoria` INT)  NO SQL
UPDATE categorias
SET estado = (CASE WHEN estado = 1 THEN 0 ELSE 1 END) 
WHERE id = _id_categoria$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_cambiarEstadoMarca` (IN `_id_marca` INT)  NO SQL
UPDATE marcas
SET estado = (CASE WHEN estado = 1 THEN 0 ELSE 1 END) 
WHERE id_marca = _id_marca$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_cambiarEstadoProductosActivados` (IN `_id_producto` INT)  NO SQL
UPDATE productos
SET inicio = 1
WHERE id = _id_producto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_cambiarEstadoProductosDesactivados` (IN `_id_producto` INT)  NO SQL
UPDATE productos
SET inicio = 0
WHERE id = _id_producto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_cambiarEstadoProductosPorCategoria` (IN `_categoria` INT)  NO SQL
UPDATE productos
SET inicio = (CASE WHEN inicio = 1 THEN 0 ELSE 1 END) 
WHERE id_categoria = _categoria$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_cambiarEstadousuario` (IN `_id_usuario` INT)  NO SQL
UPDATE usuarios
SET estado = (CASE WHEN estado = 1 THEN 0 ELSE 1 END) 
WHERE id = _id_usuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarCategorias` ()  NO SQL
SELECT
	id,
    nombre,
    estado
FROM categorias
ORDER BY id DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarCategorias2` (IN `_nombre` VARCHAR(50), IN `_id_categoria` INT)  NO SQL
SELECT
    COUNT(nombre) AS nombre
FROM categorias
WHERE nombre = _nombre AND id <> _id_categoria AND nombre <> ''$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarEmail` (IN `_email` VARCHAR(255))  NO SQL
SELECT COUNT(email) AS email
FROM usuarios
WHERE email = _email$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarEmailPorId` (IN `_email` VARCHAR(255), IN `_id_usuario` INT)  NO SQL
SELECT
	COUNT(email) AS email
FROM usuarios
WHERE email = _email AND id <> _id_usuario AND email <> ''$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarEmailUsuario` (IN `_email` VARCHAR(255), IN `_id_usuario` INT)  NO SQL
SELECT
	COUNT(email) AS email
FROM usuarios 
WHERE email = _email AND id <> _id_usuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarEstadoProductoPorId` (IN `_id_producto` INT)  NO SQL
SELECT 
	inicio
FROM productos
WHERE id = _id_producto$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarMarcas` ()  NO SQL
SELECT
	id_marca,
    marca,
    estado
FROM marcas
ORDER BY id_marca DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarMarcas2` (IN `_marca` VARCHAR(100), IN `_id_marca` INT)  NO SQL
SELECT
    COUNT(marca) AS marca
FROM marcas
WHERE marca = _marca AND id_marca <> _id_marca AND marca <> ''$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarMarcasPorId` (IN `_id_marca` INT)  NO SQL
SELECT
	id_marca,
    marca,
    estado
FROM marcas 
WHERE id_marca = _id_marca$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarMarcasPorIdProducto` (IN `_id_producto` INT)  NO SQL
SELECT
	m.id_marca,
    m.marca,
    pm.id_producto_marcas,
    pm.id_producto,
    pm.id_marca
FROM marcas m
INNER JOIN productos_marcas pm
ON pm.id_marca = m.id_marca
WHERE pm.id_producto = _id_producto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarMarcasPorNombre` (IN `_marca` VARCHAR(100))  NO SQL
SELECT 
COUNT(marca) AS marca
FROM marcas
WHERE marca = _marca$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarNombreUsuario` (IN `_usuario` VARCHAR(100), IN `_id_usuario` INT)  NO SQL
SELECT
	COUNT(usuario) AS usuario
FROM usuarios
WHERE usuario = _usuario AND id <> _id_usuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarNombreUsuarioPorId` (IN `_usuario` VARCHAR(100), IN `_id_usuario` INT)  NO SQL
SELECT
    COUNT(usuario) AS usuario
FROM usuarios
WHERE usuario = _usuario AND id <> _id_usuario AND usuario <> ''$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarPersonaPorId` (IN `_id_usuario` INT)  NO SQL
SELECT
	nombres,
    apellidos,
    fecha_nacimiento
FROM personas
WHERE id_usuario = _id_usuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarProductos` (IN `_nombre` VARCHAR(255), IN `_id_producto` INT)  NO SQL
SELECT
    COUNT(nombre) AS nombre
FROM productos
WHERE nombre = _nombre AND id <> _id_producto AND nombre <> ''$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarProductosActivos` ()  NO SQL
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarProductosPorCategoria` (IN `_categoria` INT)  NO SQL
SELECT 
	id,
    nombre,
    precio,
    descripcion,
    inicio,
    cantidad,
    descuento,
    precio_con_descuento
FROM productos
WHERE id_categoria = _categoria$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarProductosPorFiltrado` (IN `nombre` VARCHAR(255))  NO SQL
SELECT
	id,
    nombre,
    precio,
    descripcion,
    descuento,
    (precio - precio_con_descuento) AS precio2,
    inicio
FROM productos
WHERE nombre LIKE '%nombre%' AND inicio = 1
ORDER BY nombre DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarProductosPorId` (IN `_id_producto` INT)  NO SQL
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarProductosPorNombre` (IN `_nombre` VARCHAR(255))  NO SQL
SELECT
    nombre
FROM productos
WHERE nombre = _nombre$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarRoles` ()  NO SQL
SELECT
	id_rol, 
    nombre
FROM roles$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarTodosProductosConImagen` ()  NO SQL
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarTodosProductosConImagenPorFiltrado` (IN `nombre` VARCHAR(255))  NO SQL
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
WHERE p.nombre LIKE '%nombre%' AND i.prioridad = 1 
ORDER BY p.id DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarUltimoIdProducto` ()  NO SQL
SELECT
	MAX(id) AS id
FROM productos$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarUltimoUsuario` ()  NO SQL
SELECT MAX(id) AS ultimo
FROM usuarios$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarUsuario` (IN `_usuario` VARCHAR(100))  NO SQL
SELECT COUNT(usuario) AS usuario
FROM usuarios
WHERE usuario = _usuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarUsuarioPorId` (IN `_id_usuario` INT)  NO SQL
SELECT
	u.id,
    u.usuario,
    u.email,
    r.id_rol,
    r.nombre,
    p.nombres,
    p.apellidos,
    p.fecha_nacimiento
FROM usuarios u
INNER JOIN personas p
ON p.id_usuario = u.id
INNER JOIN roles r
ON r.id_rol = u.id_rol
WHERE u.id = _id_usuario$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarUsuarios` (IN `_email` VARCHAR(255), IN `_password` VARCHAR(255))  NO SQL
SELECT 
	id, 
    LOWER(email) AS email, 
    password, 
    estado, 
    id_rol,
    usuario
FROM usuarios
WHERE email = _email AND password = _password and estado = 1 and id_rol = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarUsuariosPorId` (IN `_id_usuario` INT)  NO SQL
SELECT
	usuario,
    email,
    id_rol,
    estado
FROM usuarios
WHERE id = _id_usuario AND estado = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_eliminarDetallesColor` (IN `_id_producto` INT)  NO SQL
DELETE FROM productos_colores
WHERE id_producto = _id_producto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_eliminarDetallesMarcas` (IN `_id_producto` INT)  NO SQL
DELETE FROM productos_marcas
WHERE id_producto = _id_producto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_eliminarImagenProducto` (IN `_id_producto` INT)  NO SQL
DELETE FROM imagenes
WHERE id_producto = _id_producto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_eliminarProducto` (IN `_id_producto` INT)  NO SQL
DELETE FROM productos
WHERE id = _id_producto$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_guardarDatosPersona` (IN `_nombres` VARCHAR(255), IN `_apellidos` VARCHAR(255), IN `_fecha` VARCHAR(255), IN `_id_usuario` INT)  NO SQL
INSERT INTO personas
(
    id,
    nombres,
    apellidos,
    fecha_nacimiento,
    id_usuario
)
VALUES
(
    null,
    _nombres,
    _apellidos,
    _fecha,
    _id_usuario
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_guardarDetallesMarca` (IN `_id_producto` INT, IN `_id_marca` INT)  NO SQL
INSERT INTO productos_marcas
(
    id_producto_marcas,
    id_producto,
    id_marca
)
VALUES
(
	null,
    _id_producto,
    _id_marca
)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_guardarMarcas` (IN `_marca` VARCHAR(100), IN `_estado` INT)  NO SQL
INSERT INTO marcas
(
	id_marca,
    marca,
    estado
)
VALUES
(
    null,
    _marca,
    _estado
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_guardarUsuario` (IN `_usuario` VARCHAR(100), IN `_email` VARCHAR(255), IN `_pass` VARCHAR(255), IN `_rol` INT, IN `_estado` INT)  NO SQL
INSERT INTO usuarios
(
    id,
    usuario,
    email,
    password,
    id_rol,
    estado
)
VALUES
(
    null,
    _usuario,
    _email,
    _pass,
    _rol,
    _estado
)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_listarUsuarios` ()  NO SQL
SELECT
	u.id,
	u.usuario,
    u.email,
    u.estado,
    p.nombres,
    p.apellidos,
    p.fecha_nacimiento
FROM usuarios u
INNER JOIN personas p
ON p.id_usuario = u.id
ORDER BY u.id DESC$$

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
(1, 'Camisetas Deportivas Hombre', 1),
(2, 'Ropa Dama', 1),
(3, 'Ropa Deportiva Hombre', 1),
(4, 'Ropa Interior Hombre', 1);

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
(1, '1509401979_01.jpg', 1, 1),
(2, '1509401979_02.jpg', 2, 1),
(3, '1509401979_03.jpg', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `marca`, `estado`) VALUES
(1, 'no definido', 1),
(2, 'nike', 1),
(3, 'Tommy Hilfiger', 1),
(4, 'Adidas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `nombres` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `fecha_nacimiento` varchar(255) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombres`, `apellidos`, `fecha_nacimiento`, `id_usuario`) VALUES
(5, 'Juan David', 'Vargas Penagos', '23-12-1990', 8),
(6, 'david', 'penagos', '23-12-1990', 9);

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
(1, 'Camisa Hombre', 20000, 'Camisa de tela delgada, ideal para deportistas', 1, 1, 0, 7, 1400);

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
(1, 1, 3, 1);

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

--
-- Volcado de datos para la tabla `productos_marcas`
--

INSERT INTO `productos_marcas` (`id_producto_marcas`, `id_producto`, `id_marca`) VALUES
(1, 1, 2);

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
(1, 'Administrador'),
(2, 'Vendedor'),
(3, 'Oficios varios'),
(4, 'Otro');

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
(8, 'Juan', 'juan@gmail.com', 'ef187d06edac2230ab92f9cba1c15148', 1, 1),
(9, 'david', 'david@gmail.com', '12345678', 1, 1);

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
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `productos_colores`
--
ALTER TABLE `productos_colores`
  MODIFY `id_producto_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `productos_colores_tallas`
--
ALTER TABLE `productos_colores_tallas`
  MODIFY `id_producto_color_talla` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos_marcas`
--
ALTER TABLE `productos_marcas`
  MODIFY `id_producto_marcas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tallas`
--
ALTER TABLE `tallas`
  MODIFY `id_talla` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
