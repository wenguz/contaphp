-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2017 a las 23:35:00
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Estructura de tabla para la tabla `asiento_deperciacion`
--

CREATE TABLE `asiento_deperciacion` (
  `id_asiento_deperciacion` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depreciacion`
--

CREATE TABLE `depreciacion` (
  `id_depreciacion` int(11) NOT NULL,
  `bien` varchar(45) DEFAULT NULL,
  `vida_util` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_transaccion`
--

CREATE TABLE `tipo_transaccion` (
  `id_tipo_transaccion` int(11) NOT NULL,
  `nombre_transaccion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Indices de la tabla `asiento_deperciacion`
--
ALTER TABLE `asiento_deperciacion`
  ADD PRIMARY KEY (`id_asiento_deperciacion`),
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
-- Filtros para la tabla `asiento_deperciacion`
--
ALTER TABLE `asiento_deperciacion`
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
