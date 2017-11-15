-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2017 a las 01:40:11
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_buscar_usuario` (IN `_email` VARCHAR(80), IN `_password` VARCHAR(80))  NO SQL
SELECT
	email,
    password,
    estado,
    id_rol
FROM usuarios
WHERE email = _email AND PASSWORD = _password and estado = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultar_facturas` ()  NO SQL
SELECT
	f.id_factura,
    f.estado,
    p.nombre_persona,
    p.id_persona,
    pro.cantidad,
    pro.valor,
    (pro.valor * pro.cantidad) as valor_factura,
     ((pro.valor * pro.cantidad) - af.valor_abono) as saldo,
    af.valor_abono
FROM factura f
INNER JOIN personas p ON p.id_persona = f.id_persona
INNER JOIN productos pro ON pro.id_producto = f.id_factura
LEFT JOIN abonos_factura af ON af.id_factura = f.id_factura
where f.estado = 1 ORDER BY f.id_factura DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_consultar_ids_personas` ()  NO SQL
SELECT
	id_persona
FROM personas$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_datos_factura` (IN `_nombre` VARCHAR(80))  NO SQL
SELECT
	date_format(f.fecha_registro, '%Y-%m-%d') as fecha,
    f.id_factura,
    p.nombre_persona,
    p.telefono,
    p.direccion,
    pro.nombre_producto,
    pro.cantidad,
    pro.valor,
    (pro.valor * pro.cantidad) as valor_final
FROM factura f 
INNER JOIN personas p ON p.id_persona = f.id_persona
INNER JOIN productos pro ON pro.id_producto = f.id_producto
WHERE p.nombre_persona = _nombre$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_datos_producto` ()  NO SQL
SELECT
	id_producto,
    nombre_producto,
    cantidad,
    valor,
    fecha_registro
FROM productos$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_guardar_abono_factura` (IN `_valor` DOUBLE, IN `_estado` INT, IN `_id_persona` INT, IN `_id_factura` INT)  NO SQL
INSERT INTO abonos_factura 
(
    id_abono, 
    valor_abono, 
    fecha_abono,
    estado_abono,
    id_persona,
    id_factura
)
VALUES
(
    null,
    _valor,
    null,
    _estado,
    _id_persona,
    _id_factura
    
)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_guardar_encabezado` (IN `_nombre` VARCHAR(80), IN `_telefono` VARCHAR(15), IN `_direccion` VARCHAR(30))  NO SQL
INSERT INTO personas 
(
    id_persona, 
    nombre_persona, 
    telefono, 
    direccion
)
VALUES
(
	null,
    _nombre,
    _telefono,
    _direccion
)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_guardar_factura` (IN `_id_persona` INT(11), IN `_id_producto` INT(11), IN `_estado` INT(2))  NO SQL
INSERT INTO factura
(
    id_factura,
    id_persona,
    id_producto,
    fecha_registro, 
    estado
)
VALUES
(
    null,
    _id_persona,
    _id_producto,
    null,
    _estado
)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_guardar_producto` (IN `_nombre` VARCHAR(80), IN `_cantidad` INT, IN `_valor` DOUBLE)  NO SQL
INSERT INTO productos
(
     id_producto, 
     nombre_producto, 
     cantidad, 
     valor
 ) 
 VALUES 
 (
 	null,
    _nombre,
    _cantidad,
    _valor
 )$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_nombre_persona` ()  NO SQL
SELECT
	nombre_persona
FROM personas
WHERE id_persona = (SELECT max(id_persona)as id FROM personas)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ultimo_id_persona` ()  NO SQL
SELECT
	max(id_persona) as id_persona
FROM personas$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ultimo_id_producto` ()  NO SQL
SELECT 
		max(id_producto) as id_producto
FROM productos$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonos_factura`
--

CREATE TABLE `abonos_factura` (
  `id_abono` int(11) NOT NULL,
  `valor_abono` double NOT NULL,
  `fecha_abono` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado_abono` int(2) NOT NULL DEFAULT '1',
  `id_factura` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `abonos_factura`
--

INSERT INTO `abonos_factura` (`id_abono`, `valor_abono`, `fecha_abono`, `estado_abono`, `id_factura`, `id_persona`) VALUES
(1, 1000, '2017-10-03 23:39:13', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_factura`, `id_persona`, `id_producto`, `fecha_registro`, `estado`) VALUES
(1, 1, 1, '2017-10-03 23:20:39', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL,
  `nombre_persona` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_persona`, `nombre_persona`, `telefono`, `direccion`) VALUES
(1, 'juan david', '2347890', 'sur');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `valor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `cantidad`, `valor`) VALUES
(1, 'camisetas', 2, 5000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
(1, 'rol 1'),
(2, 'rol 2'),
(3, 'otro rol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(2) NOT NULL DEFAULT '1',
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `estado`, `id_rol`) VALUES
(1, 'juan@gmail.com', '12345', 1, 1),
(2, 'david@gmail.com', '123456', 1, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abonos_factura`
--
ALTER TABLE `abonos_factura`
  ADD PRIMARY KEY (`id_abono`),
  ADD KEY `id_factura_abono` (`id_factura`),
  ADD KEY `id_persona_abono` (`id_persona`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_usuario` (`id_persona`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abonos_factura`
--
ALTER TABLE `abonos_factura`
  MODIFY `id_abono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `abonos_factura`
--
ALTER TABLE `abonos_factura`
  ADD CONSTRAINT `id_factura_abonos_id_factura_factura` FOREIGN KEY (`id_factura`) REFERENCES `factura` (`id_factura`),
  ADD CONSTRAINT `id_persona_abonos_id_persona_persona` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `id_persona_factura_id_persona_personas` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`),
  ADD CONSTRAINT `id_producto_productos_id_producto_factura` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_id_rol_roles` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
