-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 07-04-2021 a las 01:46:03
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_controlventas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_archivos`
--

CREATE TABLE `tb_archivos` (
  `id_archivos` int(11) NOT NULL,
  `ruta_archivos` varchar(500) NOT NULL,
  `ventas_archivos` int(11) NOT NULL,
  `estado_archivos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_estado`
--

CREATE TABLE `tb_estado` (
  `id_estado` int(11) NOT NULL,
  `descripción_estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_estado`
--

INSERT INTO `tb_estado` (`id_estado`, `descripción_estado`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_tipopago`
--

CREATE TABLE `tb_tipopago` (
  `id_tipopago` int(11) NOT NULL,
  `descripcion_tipopago` varchar(50) NOT NULL,
  `estado_tipopago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_tipopago`
--

INSERT INTO `tb_tipopago` (`id_tipopago`, `descripcion_tipopago`, `estado_tipopago`) VALUES
(1, 'Online', 1),
(2, 'RedCompra', 1),
(3, 'Efectivo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_tipousuario`
--

CREATE TABLE `tb_tipousuario` (
  `id_tipousuario` int(11) NOT NULL,
  `descripcion_tipousuario` varchar(20) NOT NULL,
  `estado_tipousuario` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_tipousuario`
--

INSERT INTO `tb_tipousuario` (`id_tipousuario`, `descripcion_tipousuario`, `estado_tipousuario`) VALUES
(1, 'Administrador', 1),
(2, 'Vendedor', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `rut_usuario` varchar(12) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `apellido_usuario` varchar(50) NOT NULL,
  `correo_usuario` varchar(20) NOT NULL,
  `estado_usuario` int(1) NOT NULL,
  `tipo_usuario` int(1) NOT NULL,
  `password_usuario` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_venta`
--

CREATE TABLE `tb_venta` (
  `id_venta` int(11) NOT NULL,
  `descripción_venta` varchar(500) NOT NULL,
  `cliente_venta` varchar(50) NOT NULL,
  `valor_venta` int(11) NOT NULL,
  `direccion_venta` varchar(50) NOT NULL,
  `fechaUsuario_venta` date NOT NULL,
  `fecha_venta` date NOT NULL,
  `tipopago_venta` int(11) NOT NULL,
  `estado_venta` int(11) NOT NULL,
  `usuario_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_archivos`
--
ALTER TABLE `tb_archivos`
  ADD PRIMARY KEY (`id_archivos`);

--
-- Indices de la tabla `tb_estado`
--
ALTER TABLE `tb_estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `tb_tipopago`
--
ALTER TABLE `tb_tipopago`
  ADD PRIMARY KEY (`id_tipopago`);

--
-- Indices de la tabla `tb_tipousuario`
--
ALTER TABLE `tb_tipousuario`
  ADD PRIMARY KEY (`id_tipousuario`);

--
-- Indices de la tabla `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`rut_usuario`);

--
-- Indices de la tabla `tb_venta`
--
ALTER TABLE `tb_venta`
  ADD PRIMARY KEY (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_archivos`
--
ALTER TABLE `tb_archivos`
  MODIFY `id_archivos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tb_estado`
--
ALTER TABLE `tb_estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tb_tipopago`
--
ALTER TABLE `tb_tipopago`
  MODIFY `id_tipopago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tb_venta`
--
ALTER TABLE `tb_venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
