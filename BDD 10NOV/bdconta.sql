-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2017 a las 01:07:04
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdconta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amortizacion`
--

CREATE TABLE `amortizacion` (
  `idamortizacion` int(11) NOT NULL,
  `taza` double DEFAULT NULL,
  `tiempo` varchar(45) DEFAULT NULL,
  `plaza` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asiento`
--

CREATE TABLE `asiento` (
  `idasiento` int(11) NOT NULL,
  `idficha` int(11) NOT NULL,
  `idcuenta` int(11) NOT NULL,
  `num` int(11) DEFAULT NULL,
  `concepto` varchar(45) DEFAULT NULL,
  `monto` double DEFAULT NULL,
  `debe` double DEFAULT NULL,
  `haber` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asiento_amortizacion`
--

CREATE TABLE `asiento_amortizacion` (
  `idac_am` int(11) NOT NULL,
  `idasiento` int(11) NOT NULL,
  `idamortizacion` int(11) NOT NULL,
  `periodo` int(11) DEFAULT NULL,
  `capitalin` double DEFAULT NULL,
  `pagointeres` double DEFAULT NULL,
  `amortizacion` double DEFAULT NULL,
  `cuota` double DEFAULT NULL,
  `saldof` double DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asiento_depreciacion`
--

CREATE TABLE `asiento_depreciacion` (
  `idac_dp` int(11) NOT NULL,
  `idasiento` int(11) NOT NULL,
  `iddepreciacion` int(11) NOT NULL,
  `periodo` int(11) DEFAULT NULL,
  `voriginal` double DEFAULT NULL,
  `depreciacion` double DEFAULT NULL,
  `acumulado` double DEFAULT NULL,
  `vresidual` double DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `idclases` int(11) NOT NULL,
  `nombrec` text,
  `estado` tinyint(1) DEFAULT NULL,
  `fechareg` date DEFAULT NULL,
  `fechamod` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `idcuenta` int(11) NOT NULL,
  `cod_cuenta` int(11) DEFAULT NULL,
  `nombre_c` varchar(45) DEFAULT NULL,
  `idgrupo` int(11) NOT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `idgrupos` int(11) NOT NULL,
  `idcuentas` int(11) NOT NULL,
  `nombre_c` text,
  `estado` tinyint(1) DEFAULT NULL,
  `fechareg` date DEFAULT NULL,
  `fechamod` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depreciacion`
--

CREATE TABLE `depreciacion` (
  `iddepreciacion` int(11) NOT NULL,
  `bien` varchar(45) DEFAULT NULL,
  `vida_util` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `depresacion`
--

CREATE TABLE `depresacion` (
  `iddepresacion` int(11) NOT NULL,
  `bien` varchar(45) DEFAULT NULL,
  `vida_util` int(11) DEFAULT NULL,
  `coeficiente` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `iddocumento` int(11) NOT NULL,
  `cod_doc` int(11) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `idFicha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `idempleado` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido_p` varchar(45) DEFAULT NULL,
  `apellido_m` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idempleado`, `nombre`, `apellido_p`, `apellido_m`) VALUES
(101, 'juan1', 'romero1', 'diaz1'),
(102, 'juan2', 'romero2', 'diaz2'),
(103, 'juan3', 'romero3', 'diaz3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidad`
--

CREATE TABLE `entidad` (
  `idEntidad` int(11) NOT NULL,
  `nombre_en` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `fono` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `entidad`
--

INSERT INTO `entidad` (`idEntidad`, `nombre_en`, `direccion`, `fono`) VALUES
(151, 'san jeronimo', 'calle 1', 70000000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fempleado`
--

CREATE TABLE `fempleado` (
  `idfempleado` int(11) NOT NULL,
  `idficha` int(11) NOT NULL,
  `idempleado` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `idficha` int(11) NOT NULL,
  `idpago` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idtipotrans` int(11) NOT NULL,
  `idtipocambio` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `num_partida` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `total` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`idficha`, `idpago`, `idusuario`, `idtipotrans`, `idtipocambio`, `idpersona`, `num_partida`, `fecha`, `time`, `estado`, `total`) VALUES
(901, 142, 113, 123, 131, 506, 7, '2017-10-10', '16:00:00', 1, 1700);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `idclases` int(11) NOT NULL,
  `idgrupos` int(11) NOT NULL,
  `nombreg` text,
  `estado` tinyint(1) DEFAULT NULL,
  `fechareg` date DEFAULT NULL,
  `fechamod` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `idpago` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`idpago`, `descripcion`, `tipo`) VALUES
(141, 'descrip…', 'efectivo'),
(142, ' descrip…', 'cheque'),
(143, ' descrip…', 'efectivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodoc`
--

CREATE TABLE `periodoc` (
  `idperiodoc` int(11) NOT NULL,
  `idEntidad` int(11) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `finicio` date DEFAULT NULL,
  `fcierre` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` int(11) NOT NULL,
  `idEntidad` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `ci` int(11) DEFAULT NULL,
  `tipopersona` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `idEntidad`, `nombre`, `ci`, `tipopersona`) VALUES
(506, 151, 'pedro1', 100000, 'tipo1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcuenta`
--

CREATE TABLE `subcuenta` (
  `idcuenta` int(11) NOT NULL,
  `idsubcuenta` int(11) NOT NULL,
  `nombre` text,
  `estado` tinyint(1) DEFAULT NULL,
  `fechareg` date DEFAULT NULL,
  `fechamod` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subc_am`
--

CREATE TABLE `subc_am` (
  `idsubc_am` int(11) NOT NULL,
  `idsubcuenta` int(11) NOT NULL,
  `idamortizacion` int(11) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subc_dep`
--

CREATE TABLE `subc_dep` (
  `idsubc_dep` int(11) NOT NULL,
  `idsubcuenta` int(11) NOT NULL,
  `iddepreciacion` int(11) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopago`
--

CREATE TABLE `tipopago` (
  `idtpago` int(11) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `descripcion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipotrans`
--

CREATE TABLE `tipotrans` (
  `idtipotrans` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipotrans`
--

INSERT INTO `tipotrans` (`idtipotrans`, `descripcion`) VALUES
(121, 'ingreso '),
(122, 'egreso'),
(123, 'inversion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cambio`
--

CREATE TABLE `tipo_cambio` (
  `idtipocambio` int(11) NOT NULL,
  `monto` double DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_cambio`
--

INSERT INTO `tipo_cambio` (`idtipocambio`, `monto`, `fecha`) VALUES
(131, 50, '0000-00-00'),
(132, 350, '0000-00-00'),
(133, 200, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `usser` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `cargo` varchar(45) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `idempleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `usser`, `password`, `cargo`, `estado`, `idempleado`) VALUES
(111, 'admi', 'admi', 'administrador', 1, 101),
(112, 'conta', 'conta', 'contabilidad', 1, 102),
(113, 'secre', 'secre', 'secretario', 1, 103);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amortizacion`
--
ALTER TABLE `amortizacion`
  ADD PRIMARY KEY (`idamortizacion`);

--
-- Indices de la tabla `asiento`
--
ALTER TABLE `asiento`
  ADD PRIMARY KEY (`idasiento`),
  ADD KEY `fk_asiento_Ficha1_idx` (`idficha`),
  ADD KEY `fk_asiento_cuenta1_idx` (`idcuenta`);

--
-- Indices de la tabla `asiento_amortizacion`
--
ALTER TABLE `asiento_amortizacion`
  ADD PRIMARY KEY (`idac_am`),
  ADD KEY `fk_asiento_has_amortizacion_amortizacion1_idx` (`idamortizacion`),
  ADD KEY `fk_asiento_has_amortizacion_asiento1_idx` (`idasiento`);

--
-- Indices de la tabla `asiento_depreciacion`
--
ALTER TABLE `asiento_depreciacion`
  ADD PRIMARY KEY (`idac_dp`),
  ADD KEY `fk_depreciacion_has_asiento_asiento1_idx` (`idasiento`),
  ADD KEY `fk_depreciacion_has_asiento_depreciacion1_idx` (`iddepreciacion`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`idclases`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`idcuenta`);

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`idcuentas`),
  ADD KEY `fk_cuenta_grupo1_idx` (`idgrupos`);

--
-- Indices de la tabla `depreciacion`
--
ALTER TABLE `depreciacion`
  ADD PRIMARY KEY (`iddepreciacion`);

--
-- Indices de la tabla `depresacion`
--
ALTER TABLE `depresacion`
  ADD PRIMARY KEY (`iddepresacion`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`iddocumento`),
  ADD KEY `fk_documento_Ficha1_idx` (`idFicha`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`idempleado`);

--
-- Indices de la tabla `entidad`
--
ALTER TABLE `entidad`
  ADD PRIMARY KEY (`idEntidad`);

--
-- Indices de la tabla `fempleado`
--
ALTER TABLE `fempleado`
  ADD PRIMARY KEY (`idfempleado`),
  ADD KEY `fk_Fpersona_Ficha1_idx` (`idficha`),
  ADD KEY `fk_Fpersona_Empleado1_idx` (`idempleado`);

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`idficha`),
  ADD KEY `fk_Ficha_pago1_idx` (`idpago`),
  ADD KEY `fk_Ficha_Usuario1_idx` (`idusuario`),
  ADD KEY `fk_Ficha_tipotrans1_idx` (`idtipotrans`),
  ADD KEY `fk_Ficha_persona1_idx` (`idpersona`),
  ADD KEY `fk_Ficha_tipo_cambio1_idx` (`idtipocambio`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`idgrupos`),
  ADD KEY `fk_grupos_clases1_idx` (`idclases`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`idpago`);

--
-- Indices de la tabla `periodoc`
--
ALTER TABLE `periodoc`
  ADD PRIMARY KEY (`idperiodoc`),
  ADD KEY `fk_periodoc_Entidad1_idx` (`idEntidad`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`),
  ADD KEY `fk_persona_Entidad1_idx` (`idEntidad`);

--
-- Indices de la tabla `subcuenta`
--
ALTER TABLE `subcuenta`
  ADD PRIMARY KEY (`idsubcuenta`),
  ADD KEY `fk_subcuenta_cuenta1_idx` (`idcuenta`);

--
-- Indices de la tabla `subc_am`
--
ALTER TABLE `subc_am`
  ADD PRIMARY KEY (`idsubc_am`),
  ADD KEY `fk_subc_am_subcuenta1_idx` (`idsubcuenta`),
  ADD KEY `fk_subc_am_amortizacion1_idx` (`idamortizacion`);

--
-- Indices de la tabla `subc_dep`
--
ALTER TABLE `subc_dep`
  ADD PRIMARY KEY (`idsubc_dep`),
  ADD KEY `fk_subc_dep_subcuenta1_idx` (`idsubcuenta`),
  ADD KEY `fk_subc_dep_depreciacion1_idx` (`iddepreciacion`);

--
-- Indices de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  ADD PRIMARY KEY (`idtpago`);

--
-- Indices de la tabla `tipotrans`
--
ALTER TABLE `tipotrans`
  ADD PRIMARY KEY (`idtipotrans`);

--
-- Indices de la tabla `tipo_cambio`
--
ALTER TABLE `tipo_cambio`
  ADD PRIMARY KEY (`idtipocambio`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `fk_Usuario_Empleado_idx` (`idempleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `idcuentas` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asiento`
--
ALTER TABLE `asiento`
  ADD CONSTRAINT `fk_asiento_Ficha1` FOREIGN KEY (`idficha`) REFERENCES `ficha` (`idficha`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_asiento_cuenta1` FOREIGN KEY (`idcuenta`) REFERENCES `cuenta` (`idcuenta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asiento_amortizacion`
--
ALTER TABLE `asiento_amortizacion`
  ADD CONSTRAINT `fk_asiento_has_amortizacion_amortizacion1` FOREIGN KEY (`idamortizacion`) REFERENCES `amortizacion` (`idamortizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_asiento_has_amortizacion_asiento1` FOREIGN KEY (`idasiento`) REFERENCES `asiento` (`idasiento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asiento_depreciacion`
--
ALTER TABLE `asiento_depreciacion`
  ADD CONSTRAINT `fk_depreciacion_has_asiento_asiento1` FOREIGN KEY (`idasiento`) REFERENCES `asiento` (`idasiento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_depreciacion_has_asiento_depreciacion1` FOREIGN KEY (`iddepreciacion`) REFERENCES `depreciacion` (`iddepreciacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD CONSTRAINT `fk_cuenta_grupo1` FOREIGN KEY (`idgrupos`) REFERENCES `grupos` (`idgrupos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `fk_documento_Ficha1` FOREIGN KEY (`idFicha`) REFERENCES `ficha` (`idficha`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `fempleado`
--
ALTER TABLE `fempleado`
  ADD CONSTRAINT `fk_Fpersona_Empleado1` FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Fpersona_Ficha1` FOREIGN KEY (`idficha`) REFERENCES `ficha` (`idficha`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD CONSTRAINT `fk_Ficha_Usuario1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Ficha_pago1` FOREIGN KEY (`idpago`) REFERENCES `pago` (`idpago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Ficha_persona1` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Ficha_tipo_cambio1` FOREIGN KEY (`idtipocambio`) REFERENCES `tipo_cambio` (`idtipocambio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Ficha_tipotrans1` FOREIGN KEY (`idtipotrans`) REFERENCES `tipotrans` (`idtipotrans`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `fk_grupos_clases1` FOREIGN KEY (`idclases`) REFERENCES `clases` (`idclases`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `periodoc`
--
ALTER TABLE `periodoc`
  ADD CONSTRAINT `fk_periodoc_Entidad1` FOREIGN KEY (`idEntidad`) REFERENCES `entidad` (`idEntidad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_persona_Entidad1` FOREIGN KEY (`idEntidad`) REFERENCES `entidad` (`idEntidad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subcuenta`
--
ALTER TABLE `subcuenta`
  ADD CONSTRAINT `fk_subcuenta_cuenta1` FOREIGN KEY (`idcuenta`) REFERENCES `cuentas` (`idcuentas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subc_am`
--
ALTER TABLE `subc_am`
  ADD CONSTRAINT `fk_subc_am_amortizacion1` FOREIGN KEY (`idamortizacion`) REFERENCES `amortizacion` (`idamortizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_subc_am_subcuenta1` FOREIGN KEY (`idsubcuenta`) REFERENCES `subcuenta` (`idsubcuenta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subc_dep`
--
ALTER TABLE `subc_dep`
  ADD CONSTRAINT `fk_subc_dep_depreciacion1` FOREIGN KEY (`iddepreciacion`) REFERENCES `depreciacion` (`iddepreciacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_subc_dep_subcuenta1` FOREIGN KEY (`idsubcuenta`) REFERENCES `subcuenta` (`idsubcuenta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_Empleado` FOREIGN KEY (`idempleado`) REFERENCES `empleado` (`idempleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
