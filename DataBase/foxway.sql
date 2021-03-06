-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2017 a las 02:13:49
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultarImagenPorIdProducto` (IN `_id_producto` INT)  NO SQL
SELECT
	id_imagen,
    nombre,
    prioridad
FROM imagenes
WHERE id_producto = _id_producto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ConsultarProductosPorId` (IN `_id_producto` INT)  NO SQL
SELECT
	id,
    nombre,
    precio,
    descripcion,
    id_categoria,
    inicio,
    cantidad,
    descuento
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
    i.nombre AS imagen,
    i.prioridad
FROM productos p
INNER JOIN imagenes i ON i.id_producto = p.id
WHERE i.prioridad = 1$$

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
    descuento
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
    _descuento
    
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
(2, 'ropa dama', 1);

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
(1, '1508717723_01.jpg', 1, 1),
(2, '1508717723_02.jpg', 2, 1),
(3, '1508717723_03.jpg', 3, 1),
(4, '1508718505_01.jpg', 1, 2);

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
  `descripcion` text NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `inicio` int(11) NOT NULL DEFAULT '0',
  `cantidad` smallint(6) DEFAULT NULL,
  `descuento` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `descripcion`, `id_categoria`, `inicio`, `cantidad`, `descuento`) VALUES
(1, 'camisa deportiva hombre', 15000, 'Camisa hecha 100% en algodón, fabricada en Colombia, ideal para deportistas, ya que su delgada tela proporciona una gran frescura', 1, 0, 0, 0),
(2, 'camibuso para dama', 12000, 'Tela 100% algodón, hecha en Colombia, todas las tallas tanto para niña como para mujer, tela muy delgada y resistente', 2, 0, 0, 15);

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
(2, 2, 3, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `colores`
--
ALTER TABLE `colores`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `productos_colores`
--
ALTER TABLE `productos_colores`
  MODIFY `id_producto_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
