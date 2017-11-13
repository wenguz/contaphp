-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2017 a las 00:04:34
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `contabilidad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amortizacion`
--

CREATE TABLE `amortizacion` (
  `id_amortizacion` int(11) NOT NULL,
  `detalle_amortizacion` text,
  `monto_amortizacion` double DEFAULT NULL,
  `interes_amortizacion` double DEFAULT NULL,
  `tiempo_amortizacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asiento`
--

CREATE TABLE `asiento` (
  `id_asiento` int(11) NOT NULL,
  `glosa_asiento` text,
  `cantidad_asiento` int(11) DEFAULT NULL,
  `monto_asiento` double DEFAULT NULL,
  `debe_asiento` double DEFAULT NULL,
  `haber_asiento` double DEFAULT NULL,
  `ficha_id_ficha` int(11) NOT NULL,
  `id_subcuenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asiento_amortizacion`
--

CREATE TABLE `asiento_amortizacion` (
  `id_asiento_amortizacion` int(11) NOT NULL,
  `periodo_amortizacion` int(11) DEFAULT NULL,
  `capital_inicial` double DEFAULT NULL,
  `pago_interes` double DEFAULT NULL,
  `amortizacion` double DEFAULT NULL,
  `cuota` double DEFAULT NULL,
  `saldo_final` double DEFAULT NULL,
  `fecha_amortizacion` date DEFAULT NULL,
  `id_amortizacion` int(11) NOT NULL,
  `id_asiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asiento_depreciacion`
--

CREATE TABLE `asiento_depreciacion` (
  `id_asiento_depreciacion` int(11) NOT NULL,
  `periodo_depreciacion` int(11) DEFAULT NULL,
  `valor_original` double DEFAULT NULL,
  `depreciacion` double DEFAULT NULL,
  `acumulado` double DEFAULT NULL,
  `valor_residual` double DEFAULT NULL,
  `fecha_depreciacion` date DEFAULT NULL,
  `id_depreciacion` int(11) NOT NULL,
  `id_asiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE `clase` (
  `id_clase` int(11) NOT NULL,
  `nombre_clase` text,
  `estado_clase` varchar(45) DEFAULT NULL,
  `fecha_registro_clase` date DEFAULT NULL,
  `fecha_modifico_clase` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`id_clase`, `nombre_clase`, `estado_clase`, `fecha_registro_clase`, `fecha_modifico_clase`) VALUES
(1, 'Activo', 'ACTIVO', '2017-11-13', NULL),
(2, 'Pasivo', 'ACTIVO', '2017-11-13', NULL),
(3, 'Egresos', 'ACTIVO', '2017-11-13', NULL),
(4, 'Ingresos', 'ACTIVO', '2017-11-13', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `id_cuenta` int(11) NOT NULL,
  `nombre_cuenta` text,
  `estado_cuenta` varchar(45) DEFAULT NULL,
  `fecha_registro_cuenta` date DEFAULT NULL,
  `fecha_modifico_cuenta` date DEFAULT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`id_cuenta`, `nombre_cuenta`, `estado_cuenta`, `fecha_registro_cuenta`, `fecha_modifico_cuenta`, `id_grupo`) VALUES
(111, 'Caja', 'ACTIVO', '2017-11-13', NULL, 11),
(112, 'Caja moneda extranjera', 'ACTIVO', '2017-11-13', NULL, 11),
(113, 'Bancos', 'ACTIVO', '2017-11-13', NULL, 11),
(114, 'Cuentas por cobrar', 'ACTIVO', '2017-11-13', NULL, 11),
(115, 'Documentos por cobrar', 'ACTIVO', '2017-11-13', NULL, 11),
(116, 'Inventarios', 'ACTIVO', '2017-11-13', NULL, 11),
(117, 'Inventario de material de escritorio', 'ACTIVO', '2017-11-13', NULL, 11),
(118, 'Alquileres pagados por adelantado', 'ACTIVO', '2017-11-13', NULL, 11),
(119, 'Seguros pagados por adelantado', 'ACTIVO', '2017-11-13', NULL, 11),
(121, 'Terrenos', 'ACTIVO', '2017-11-13', NULL, 12),
(122, 'Edificios', 'ACTIVO', '2017-11-13', NULL, 12),
(123, 'Muebles y enseres', 'ACTIVO', '2017-11-13', NULL, 12),
(124, 'Maquinarias y equipos', 'ACTIVO', '2017-11-13', NULL, 12),
(125, 'Vehiculos', 'ACTIVO', '2017-11-13', NULL, 12),
(126, 'Equipo de computacion', 'ACTIVO', '2017-11-13', NULL, 12),
(131, 'Inversiones (largo plazo)', 'ACTIVO', '2017-11-13', NULL, 13),
(132, 'Cargos diferidos', 'ACTIVO', '2017-11-13', NULL, 13),
(133, 'Credito mercantil', 'ACTIVO', '2017-11-13', NULL, 13),
(134, '....................', 'ACTIVO', '2017-11-13', NULL, 13),
(141, 'Prevision para cuentas incobrables', 'ACTIVO', '2017-11-13', NULL, 14),
(142, 'Depreciacion acumulada activo fijo', 'ACTIVO', '2017-11-13', NULL, 14),
(151, 'Mercaderias recibidas en consignacion', 'ACTIVO', '2017-11-13', NULL, 15),
(211, 'Cuentas por pagar', 'ACTIVO', '2017-11-13', NULL, 21),
(212, 'Sueldos por pagar', 'ACTIVO', '2017-11-13', NULL, 21),
(213, 'Debito fiscal', 'ACTIVO', '2017-11-13', NULL, 21),
(214, 'Impuesto a las transacciones por pagar', 'ACTIVO', '2017-11-13', NULL, 21),
(215, 'IRPE por pagar', 'ACTIVO', '2017-11-13', NULL, 21),
(216, 'Documentos por pagar', 'ACTIVO', '2017-11-13', NULL, 21),
(217, 'Retenciones y cotizaciones por pagar', 'ACTIVO', '2017-11-13', NULL, 21),
(218, 'Anticipo de clientes', 'ACTIVO', '2017-11-13', NULL, 21),
(219, 'Prestamos por pagar', 'ACTIVO', '2017-11-13', NULL, 21),
(221, 'Prestamos por pagar', 'ACTIVO', '2017-11-13', NULL, 22),
(222, 'Hipotecas por pagar', 'ACTIVO', '2017-11-13', NULL, 22),
(223, '....................', 'ACTIVO', '2017-11-13', NULL, 22),
(231, 'Provision para indemnizaciones', 'ACTIVO', '2017-11-13', NULL, 23),
(232, '....................', 'ACTIVO', '2017-11-13', NULL, 23),
(241, 'Capital Sr. xx', 'ACTIVO', '2017-11-13', NULL, 24),
(242, 'Ajuste global del patrimonio', 'ACTIVO', '2017-11-13', NULL, 24),
(243, 'Utilidad (o perdida) de la gestion', 'ACTIVO', '2017-11-13', NULL, 24),
(251, 'Comitentes y consignaciones', 'ACTIVO', '2017-11-13', NULL, 25),
(311, 'Compras', 'ACTIVO', '2017-11-13', NULL, 31),
(312, 'Fletes sobre compras', 'ACTIVO', '2017-11-13', NULL, 31),
(313, '....................', 'ACTIVO', '2017-11-13', NULL, 31),
(321, 'Sueldos y salarios', 'ACTIVO', '2017-11-13', NULL, 32),
(322, 'Cargas sociales', 'ACTIVO', '2017-11-13', NULL, 32),
(323, 'Alquileres', 'ACTIVO', '2017-11-13', NULL, 32),
(324, 'Honorarios profesionales', 'ACTIVO', '2017-11-13', NULL, 32),
(325, 'Seguros', 'ACTIVO', '2017-11-13', NULL, 32),
(326, 'Impuestos a las transacciones', 'ACTIVO', '2017-11-13', NULL, 32),
(327, 'Perdida en cuentas dudosas', 'ACTIVO', '2017-11-13', NULL, 32),
(328, 'Depreciacion activos fijos', 'ACTIVO', '2017-11-13', NULL, 32),
(329, 'Amortizacion gastos de organizacion ', 'ACTIVO', '2017-11-13', NULL, 32),
(331, 'Ajuste p'' Inflac.y Ten de Bienes (deudor)', 'ACTIVO', '2017-11-13', NULL, 33),
(332, 'Diferencia de cambio (deudor)', 'ACTIVO', '2017-11-13', NULL, 33),
(411, 'Ventas', 'ACTIVO', '2017-11-13', NULL, 41),
(412, '...................', 'ACTIVO', '2017-11-13', NULL, 41),
(421, 'Intereses ganados', 'ACTIVO', '2017-11-13', NULL, 42),
(422, 'Comisiones ganadas', 'ACTIVO', '2017-11-13', NULL, 42),
(423, 'Aj. p''Infl. y Ten de bienes (Acreedor)', 'ACTIVO', '2017-11-13', NULL, 42),
(424, 'Diferencias de cambio (acreedor)', 'ACTIVO', '2017-11-13', NULL, 42),
(425, '...................', 'ACTIVO', '2017-11-13', NULL, 42),
(1110, 'Credito fiscal', 'ACTIVO', '2017-11-13', NULL, 11),
(1111, 'Inversiones (corto plazo)', 'ACTIVO', '2017-11-13', NULL, 11),
(1112, 'Mercaderias en transito', 'ACTIVO', '2017-11-13', NULL, 11),
(2110, 'Hipotecas por pagar (corto plazo)', 'ACTIVO', '2017-11-13', NULL, 21),
(2111, '....................', 'ACTIVO', '2017-11-13', NULL, 21),
(3210, 'Gastos generales', 'ACTIVO', '2017-11-13', NULL, 32),
(3211, '...................', 'ACTIVO', '2017-11-13', NULL, 32),
(3212, '...................', 'ACTIVO', '2017-11-13', NULL, 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depreciacion`
--

CREATE TABLE `depreciacion` (
  `id_depreciacion` int(11) NOT NULL,
  `bien` varchar(45) DEFAULT NULL,
  `vida_util` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `depreciacion`
--

INSERT INTO `depreciacion` (`id_depreciacion`, `bien`, `vida_util`) VALUES
(1, 'Terrenos', 40),
(2, 'Edificaciones', 40),
(3, 'Muebles y enseres de oficina', 10),
(4, 'Maquinaria en General', 8),
(5, 'Equipos e  Instalaciones', 8),
(6, 'VehÃ­culos', 5),
(7, 'Maquinaria para construccion', 5),
(8, 'Herramientas en general', 4),
(9, 'Equipos de Computacion', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_extra`
--

CREATE TABLE `documento_extra` (
  `id_documento_extra` int(11) NOT NULL,
  `codigo_documento` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `id_ficha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `cargo` varchar(45) DEFAULT NULL,
  `id_entidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `cargo`, `id_entidad`) VALUES
(1, 'ADMINISTRADOR', 1),
(2, 'CONTADOR', 1),
(3, 'SECRETARIA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_ficha`
--

CREATE TABLE `empleado_ficha` (
  `id_empleado_ficha` int(11) NOT NULL,
  `descripcion_empleado` varchar(45) DEFAULT NULL,
  `id_ficha` int(11) NOT NULL,
  `id_empleado_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_usuario`
--

CREATE TABLE `empleado_usuario` (
  `id_empleado_usuario` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `user` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleado_usuario`
--

INSERT INTO `empleado_usuario` (`id_empleado_usuario`, `id_empleado`, `id_usuario`, `estado`, `user`, `password`) VALUES
(1, 1, 1, 'ACTIVO', 'admin', 'admin'),
(2, 2, 2, 'ACTIVO', 'conta', 'conta'),
(3, 3, 3, 'ACTIVO', 'secre', 'secre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidad`
--

CREATE TABLE `entidad` (
  `id_entidad` int(11) NOT NULL,
  `nombre_entidad` text,
  `direccion_entidad` text,
  `fono1_entidad` int(11) DEFAULT NULL,
  `fono2_entidad` int(11) DEFAULT NULL,
  `ciudad_entidad` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `entidad`
--

INSERT INTO `entidad` (`id_entidad`, `nombre_entidad`, `direccion_entidad`, `fono1_entidad`, `fono2_entidad`, `ciudad_entidad`) VALUES
(1, 'Instituto Superior de Estudios TecnolÃ³gicos  ', 'Av. Armentia # 511', 2281900, 2281901, 'La Paz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `id_ficha` int(11) NOT NULL,
  `numero_partida_ficha` int(11) DEFAULT NULL,
  `fecha_ficha` date DEFAULT NULL,
  `tiempo_ficha` time DEFAULT NULL,
  `total_ficha` double DEFAULT NULL,
  `total_debe_ficha` double DEFAULT NULL,
  `total_haber_ficha` double DEFAULT NULL,
  `id_tipo_transaccion` int(11) NOT NULL,
  `id_tipo_cambio` int(11) NOT NULL,
  `id_tipo_pago` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id_grupo` int(11) NOT NULL,
  `nombre_grupo` text,
  `estado_grupo` varchar(45) DEFAULT NULL,
  `fecha_registro_grupo` date DEFAULT NULL,
  `fecha_modifico_grupo` date DEFAULT NULL,
  `id_clase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `nombre_grupo`, `estado_grupo`, `fecha_registro_grupo`, `fecha_modifico_grupo`, `id_clase`) VALUES
(11, 'Activo circulante', 'ACTIVO', '2017-11-13', NULL, 1),
(12, 'Activo fijo', 'ACTIVO', '2017-11-13', NULL, 1),
(13, 'Otros activos', 'ACTIVO', '2017-11-13', NULL, 1),
(14, 'Cuentas complementarias del activo', 'ACTIVO', '2017-11-13', NULL, 1),
(15, 'Cuentas de orden', 'ACTIVO', '2017-11-13', NULL, 1),
(21, 'Pasivo circulante', 'ACTIVO', '2017-11-13', NULL, 2),
(22, 'Pasivo a largo plazo', 'ACTIVO', '2017-11-13', NULL, 2),
(23, 'Provisiones', 'ACTIVO', '2017-11-13', NULL, 2),
(24, 'Capital contable', 'ACTIVO', '2017-11-13', NULL, 2),
(25, 'Cuentas de orden', 'ACTIVO', '2017-11-13', NULL, 2),
(31, 'Costo de mercaderia vendida', 'ACTIVO', '2017-11-13', NULL, 3),
(32, 'Gastos de operacion', 'ACTIVO', '2017-11-13', NULL, 3),
(33, 'Otros egresos', 'ACTIVO', '2017-11-13', NULL, 3),
(41, 'Ingresos de operacion', 'ACTIVO', '2017-11-13', NULL, 4),
(42, 'Otros ingresos', 'ACTIVO', '2017-11-13', NULL, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE `periodo` (
  `id_periodo` int(11) NOT NULL,
  `anio_periodo` int(11) DEFAULT NULL,
  `fecha_inicio_periodo` date DEFAULT NULL,
  `fecha_cierre_periodo` date DEFAULT NULL,
  `entidad_id_entidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`id_periodo`, `anio_periodo`, `fecha_inicio_periodo`, `fecha_cierre_periodo`, `entidad_id_entidad`) VALUES
(1, 2017, '2017-01-01', '2017-12-31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL,
  `nombre_persona` varchar(45) DEFAULT NULL,
  `ci_persona` int(11) DEFAULT NULL,
  `descripcion_persona` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcuenta`
--

CREATE TABLE `subcuenta` (
  `id_subcuenta` int(11) NOT NULL,
  `nombre_subcuenta` text,
  `estado_subcuenta` varchar(45) DEFAULT NULL,
  `fecha_registro_subcuenta` date DEFAULT NULL,
  `fecha_modifico_subcuenta` date DEFAULT NULL,
  `id_cuenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `subcuenta`
--

INSERT INTO `subcuenta` (`id_subcuenta`, `nombre_subcuenta`, `estado_subcuenta`, `fecha_registro_subcuenta`, `fecha_modifico_subcuenta`, `id_cuenta`) VALUES
(1131, 'Banco del estado', 'ACTIVO', '2017-11-13', NULL, 113),
(1132, 'Banco mercantil', 'ACTIVO', '2017-11-13', NULL, 113),
(1133, '..................', 'ACTIVO', '2017-11-13', NULL, 113),
(1141, 'Cliente Sr. xx', 'ACTIVO', '2017-11-13', NULL, 114),
(1142, 'Cliente Sr. yy', 'ACTIVO', '2017-11-13', NULL, 114),
(1143, '..................', 'ACTIVO', '2017-11-13', NULL, 114),
(1151, 'Cliente Sr. xx', 'ACTIVO', '2017-11-13', NULL, 115),
(1152, 'Cliente Sr. yy', 'ACTIVO', '2017-11-13', NULL, 115),
(1421, 'Edificios', 'ACTIVO', '2017-11-13', NULL, 142),
(1422, 'Muebles y enseres', 'ACTIVO', '2017-11-13', NULL, 142),
(1423, '..................', 'ACTIVO', '2017-11-13', NULL, 142),
(3281, 'Edificios', 'ACTIVO', '2017-11-13', NULL, 328),
(3282, 'Muebles y enseres ', 'ACTIVO', '2017-11-13', NULL, 328),
(3283, '.................', 'ACTIVO', '2017-11-13', NULL, 328),
(11111, 'Acciones', 'ACTIVO', '2017-11-13', NULL, 1111),
(11112, '..................', 'ACTIVO', '2017-11-13', NULL, 1111);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcuenta_amortizacion`
--

CREATE TABLE `subcuenta_amortizacion` (
  `id_subcuenta_amortizacion` int(11) NOT NULL,
  `fecha_subcuenta_amortizacion` date DEFAULT NULL,
  `id_amortizacion` int(11) NOT NULL,
  `id_subcuenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcuenta_depreciacion`
--

CREATE TABLE `subcuenta_depreciacion` (
  `id_subcuenta_depreciacion` int(11) NOT NULL,
  `fecha_subcuenta_depreciacion` date DEFAULT NULL,
  `id_depreciacion` int(11) NOT NULL,
  `id_subcuenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temp_as`
--

CREATE TABLE `temp_as` (
  `id_as` int(11) NOT NULL,
  `glosa_asiento` text,
  `monto_asiento` double DEFAULT NULL,
  `subcuenta_id_subcuenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cambio`
--

CREATE TABLE `tipo_cambio` (
  `id_tipo_cambio` int(11) NOT NULL,
  `monto` double DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `id_tipo_pago` int(11) NOT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `descripcion_tipo_pago` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_pago`
--

INSERT INTO `tipo_pago` (`id_tipo_pago`, `tipo`, `descripcion_tipo_pago`) VALUES
(1, 'Caja', 'Ingreso'),
(2, 'Caja', 'Egreso'),
(3, 'Banco', 'Deposito'),
(4, 'Banco', 'Retiro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_transaccion`
--

CREATE TABLE `tipo_transaccion` (
  `id_tipo_transaccion` int(11) NOT NULL,
  `nombre_transaccion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_transaccion`
--

INSERT INTO `tipo_transaccion` (`id_tipo_transaccion`, `nombre_transaccion`) VALUES
(1, 'Ingreso'),
(2, 'Egreso'),
(3, 'Inversion'),
(4, 'Transferencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(45) DEFAULT NULL,
  `ap_paterno_usuario` varchar(45) DEFAULT NULL,
  `ap_materno_usuario` varchar(45) DEFAULT NULL,
  `ci_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `ap_paterno_usuario`, `ap_materno_usuario`, `ci_usuario`) VALUES
(1, 'Wendy', 'Guzman', 'Rojas', 9876543),
(2, 'Cinthia', 'Alvarez', 'De la Torre', 1234567),
(3, 'Cristal', 'Flores', 'Hilari', 6861591);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amortizacion`
--
ALTER TABLE `amortizacion`
  ADD PRIMARY KEY (`id_amortizacion`);

--
-- Indices de la tabla `asiento`
--
ALTER TABLE `asiento`
  ADD PRIMARY KEY (`id_asiento`),
  ADD KEY `fk_asiento_ficha1_idx` (`ficha_id_ficha`),
  ADD KEY `fk_asiento_subcuenta1_idx` (`id_subcuenta`);

--
-- Indices de la tabla `asiento_amortizacion`
--
ALTER TABLE `asiento_amortizacion`
  ADD PRIMARY KEY (`id_asiento_amortizacion`),
  ADD KEY `fk_asiento_amortizacion_amortizacion1_idx` (`id_amortizacion`),
  ADD KEY `fk_asiento_amortizacion_asiento1_idx` (`id_asiento`);

--
-- Indices de la tabla `asiento_depreciacion`
--
ALTER TABLE `asiento_depreciacion`
  ADD PRIMARY KEY (`id_asiento_depreciacion`),
  ADD KEY `fk_asiento_deperciacion_depreciacion1_idx` (`id_depreciacion`),
  ADD KEY `fk_asiento_deperciacion_asiento1_idx` (`id_asiento`);

--
-- Indices de la tabla `clase`
--
ALTER TABLE `clase`
  ADD PRIMARY KEY (`id_clase`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`id_cuenta`),
  ADD KEY `fk_cuenta_grupo1_idx` (`id_grupo`);

--
-- Indices de la tabla `depreciacion`
--
ALTER TABLE `depreciacion`
  ADD PRIMARY KEY (`id_depreciacion`);

--
-- Indices de la tabla `documento_extra`
--
ALTER TABLE `documento_extra`
  ADD PRIMARY KEY (`id_documento_extra`),
  ADD KEY `fk_documento_extra_ficha1_idx` (`id_ficha`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `fk_empleado_entidad1_idx` (`id_entidad`);

--
-- Indices de la tabla `empleado_ficha`
--
ALTER TABLE `empleado_ficha`
  ADD PRIMARY KEY (`id_empleado_ficha`),
  ADD KEY `fk_empleado_ficha_ficha1_idx` (`id_ficha`),
  ADD KEY `fk_empleado_ficha_empleado_usuario1_idx` (`id_empleado_usuario`);

--
-- Indices de la tabla `empleado_usuario`
--
ALTER TABLE `empleado_usuario`
  ADD PRIMARY KEY (`id_empleado_usuario`),
  ADD KEY `fk_empleado_usuario_empleado1_idx` (`id_empleado`),
  ADD KEY `fk_empleado_usuario_usuario1_idx` (`id_usuario`);

--
-- Indices de la tabla `entidad`
--
ALTER TABLE `entidad`
  ADD PRIMARY KEY (`id_entidad`);

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`id_ficha`),
  ADD KEY `fk_ficha_tipo_transaccion1_idx` (`id_tipo_transaccion`),
  ADD KEY `fk_ficha_tipo_cambio1_idx` (`id_tipo_cambio`),
  ADD KEY `fk_ficha_tipo_pago1_idx` (`id_tipo_pago`),
  ADD KEY `fk_ficha_persona1_idx` (`id_persona`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `fk_grupo_clase1_idx` (`id_clase`);

--
-- Indices de la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id_periodo`),
  ADD KEY `fk_periodo_entidad1_idx` (`entidad_id_entidad`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `subcuenta`
--
ALTER TABLE `subcuenta`
  ADD PRIMARY KEY (`id_subcuenta`),
  ADD KEY `fk_subcuenta_cuenta1_idx` (`id_cuenta`);

--
-- Indices de la tabla `subcuenta_amortizacion`
--
ALTER TABLE `subcuenta_amortizacion`
  ADD PRIMARY KEY (`id_subcuenta_amortizacion`),
  ADD KEY `fk_subcuenta_amortizacion_amortizacion1_idx` (`id_amortizacion`),
  ADD KEY `fk_subcuenta_amortizacion_subcuenta1_idx` (`id_subcuenta`);

--
-- Indices de la tabla `subcuenta_depreciacion`
--
ALTER TABLE `subcuenta_depreciacion`
  ADD PRIMARY KEY (`id_subcuenta_depreciacion`),
  ADD KEY `fk_subcuenta_depreciacion_depreciacion1_idx` (`id_depreciacion`),
  ADD KEY `fk_subcuenta_depreciacion_subcuenta1_idx` (`id_subcuenta`);

--
-- Indices de la tabla `temp_as`
--
ALTER TABLE `temp_as`
  ADD PRIMARY KEY (`id_as`),
  ADD KEY `fk_temp_as_subcuenta1_idx` (`subcuenta_id_subcuenta`);

--
-- Indices de la tabla `tipo_cambio`
--
ALTER TABLE `tipo_cambio`
  ADD PRIMARY KEY (`id_tipo_cambio`);

--
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`id_tipo_pago`);

--
-- Indices de la tabla `tipo_transaccion`
--
ALTER TABLE `tipo_transaccion`
  ADD PRIMARY KEY (`id_tipo_transaccion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `depreciacion`
--
ALTER TABLE `depreciacion`
  MODIFY `id_depreciacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asiento`
--
ALTER TABLE `asiento`
  ADD CONSTRAINT `fk_asiento_ficha1` FOREIGN KEY (`ficha_id_ficha`) REFERENCES `ficha` (`id_ficha`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_asiento_subcuenta1` FOREIGN KEY (`id_subcuenta`) REFERENCES `subcuenta` (`id_subcuenta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asiento_amortizacion`
--
ALTER TABLE `asiento_amortizacion`
  ADD CONSTRAINT `fk_asiento_amortizacion_amortizacion1` FOREIGN KEY (`id_amortizacion`) REFERENCES `amortizacion` (`id_amortizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_asiento_amortizacion_asiento1` FOREIGN KEY (`id_asiento`) REFERENCES `asiento` (`id_asiento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asiento_depreciacion`
--
ALTER TABLE `asiento_depreciacion`
  ADD CONSTRAINT `fk_asiento_deperciacion_asiento1` FOREIGN KEY (`id_asiento`) REFERENCES `asiento` (`id_asiento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_asiento_deperciacion_depreciacion1` FOREIGN KEY (`id_depreciacion`) REFERENCES `depreciacion` (`id_depreciacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `fk_cuenta_grupo1` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `documento_extra`
--
ALTER TABLE `documento_extra`
  ADD CONSTRAINT `fk_documento_extra_ficha1` FOREIGN KEY (`id_ficha`) REFERENCES `ficha` (`id_ficha`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `fk_empleado_entidad1` FOREIGN KEY (`id_entidad`) REFERENCES `entidad` (`id_entidad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empleado_ficha`
--
ALTER TABLE `empleado_ficha`
  ADD CONSTRAINT `fk_empleado_ficha_empleado_usuario1` FOREIGN KEY (`id_empleado_usuario`) REFERENCES `empleado_usuario` (`id_empleado_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_empleado_ficha_ficha1` FOREIGN KEY (`id_ficha`) REFERENCES `ficha` (`id_ficha`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empleado_usuario`
--
ALTER TABLE `empleado_usuario`
  ADD CONSTRAINT `fk_empleado_usuario_empleado1` FOREIGN KEY (`id_empleado`) REFERENCES `empleado` (`id_empleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_empleado_usuario_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD CONSTRAINT `fk_ficha_persona1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ficha_tipo_cambio1` FOREIGN KEY (`id_tipo_cambio`) REFERENCES `tipo_cambio` (`id_tipo_cambio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ficha_tipo_pago1` FOREIGN KEY (`id_tipo_pago`) REFERENCES `tipo_pago` (`id_tipo_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ficha_tipo_transaccion1` FOREIGN KEY (`id_tipo_transaccion`) REFERENCES `tipo_transaccion` (`id_tipo_transaccion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `fk_grupo_clase1` FOREIGN KEY (`id_clase`) REFERENCES `clase` (`id_clase`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD CONSTRAINT `fk_periodo_entidad1` FOREIGN KEY (`entidad_id_entidad`) REFERENCES `entidad` (`id_entidad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subcuenta`
--
ALTER TABLE `subcuenta`
  ADD CONSTRAINT `fk_subcuenta_cuenta1` FOREIGN KEY (`id_cuenta`) REFERENCES `cuenta` (`id_cuenta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subcuenta_amortizacion`
--
ALTER TABLE `subcuenta_amortizacion`
  ADD CONSTRAINT `fk_subcuenta_amortizacion_amortizacion1` FOREIGN KEY (`id_amortizacion`) REFERENCES `amortizacion` (`id_amortizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_subcuenta_amortizacion_subcuenta1` FOREIGN KEY (`id_subcuenta`) REFERENCES `subcuenta` (`id_subcuenta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subcuenta_depreciacion`
--
ALTER TABLE `subcuenta_depreciacion`
  ADD CONSTRAINT `fk_subcuenta_depreciacion_depreciacion1` FOREIGN KEY (`id_depreciacion`) REFERENCES `depreciacion` (`id_depreciacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_subcuenta_depreciacion_subcuenta1` FOREIGN KEY (`id_subcuenta`) REFERENCES `subcuenta` (`id_subcuenta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `temp_as`
--
ALTER TABLE `temp_as`
  ADD CONSTRAINT `fk_temp_as_subcuenta1` FOREIGN KEY (`subcuenta_id_subcuenta`) REFERENCES `subcuenta` (`id_subcuenta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
