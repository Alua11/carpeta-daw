SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

DROP DATABASE IF EXISTS `ejemplo`;
CREATE DATABASE `ejemplo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ejemplo`;

-- Estructura de tabla para la tabla `localidad`
DROP TABLE IF EXISTS `localidad`;
CREATE TABLE IF NOT EXISTS `localidad` (
`nombre` varchar(50) NOT NULL DEFAULT '',
`descripcion_nombre` varchar(50) DEFAULT NULL,
`fecha_creacion` datetime DEFAULT NULL,
`extension` int(11) DEFAULT NULL,
`nombre_provincia` varchar(50) NOT NULL DEFAULT '',
PRIMARY KEY (`nombre`,`nombre_provincia`),
KEY `caj_localidad` (`nombre_provincia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcar la base de datos para la tabla `localidad`
INSERT INTO `localidad` (`nombre`, `descripcion_nombre`, `fecha_creacion`,
`extension`, `nombre_provincia`) VALUES
('ASPE', 'IS DIFFERENT', '1924-01-01 00:00:00', 3000, 'ALICANTE'),
('BONETE', NULL, '1950-01-01 00:00:00', NULL, 'ALBACETE'),
('BURRIOL', 'UNA CACA', '1950-01-01 00:00:00', 5000, 'VALENCIA'),
('HELLIN', 'MI CIUDAD', '0000-00-00 00:00:00', 0, 'ALBACETE'),
('HELLIN', 'TU CIUDAD', NULL, NULL, 'MURCIA'),
('LEZUZA', NULL, '1924-01-01 00:00:00', 2000, 'ALBACETE'),
('NOVELDA', 'LA MEJOR', '1925-02-02 00:00:00', 1000, 'ALICANTE'),
('TOTANA', NULL, NULL, 2000, 'MURCIA'),
('VINAROS', 'BUENOS LANGOSTINOS', NULL, 1950, 'CASTELLON'),
('XATIVA', 'QUE BONITA ERES', NULL, 250000, 'VALENCIA');

-- Estructura de tabla para la tabla `provincia`
DROP TABLE IF EXISTS `provincia`;
CREATE TABLE IF NOT EXISTS `provincia` (
`nombre` varchar(50) NOT NULL DEFAULT '',
`descripcion_nombre` varchar(50) DEFAULT NULL,
`fecha_creacion` datetime DEFAULT NULL,
`extension` int(11) DEFAULT NULL,
PRIMARY KEY (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcar la base de datos para la tabla `provincia`
INSERT INTO `provincia` (`nombre`, `descripcion_nombre`, `fecha_creacion`,
`extension`) VALUES
('ALBACETE', NULL, NULL, 200),
('ALICANTE', 'LA MEJOR', '1925-02-02 00:00:00', 1000),
('CASTELLON', 'BUENOS LANGOSTINOS', '1924-01-01 00:00:00', 3000),
('MURCIA', 'QUE BONITA ERES', NULL, 3),
('VALENCIA', 'UNA CACA', '1950-01-01 00:00:00', 5000),
('ZARAGOZA', 'ARRIBA LOS MA?OS', NULL, 5);
-- Estructura de tabla para la tabla `vendedor`

DROP TABLE IF EXISTS `vendedor`;
CREATE TABLE IF NOT EXISTS `vendedor` (
`numvendedor` int(11) NOT NULL DEFAULT '0',
`nombre` varchar(50) DEFAULT NULL,
`direccion` varchar(50) DEFAULT NULL,
`sueldo` float NOT NULL,
`fecha_nacimiento` datetime DEFAULT NULL,
`cif` varchar(10) DEFAULT NULL,
PRIMARY KEY (`numvendedor`),
UNIQUE KEY `cif` (`cif`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcar la base de datos para la tabla `vendedor`
INSERT INTO `vendedor` (`numvendedor`, `nombre`, `direccion`, `sueldo`,
`fecha_nacimiento`, `cif`) VALUES
(1, 'HONORATO', NULL, 1000, '2002-02-02 00:00:00', 'B11111111'),
(3, 'HECTOR', 'C/ EL GENERAL', 5000, '2002-02-02 00:00:00', 'B33333333'),
(5, 'FERMIN', 'AVD. MI CASA', 500, '2002-02-02 00:00:00', 'B66666666'),
(6, 'FELIPE', NULL, 1200, '2002-02-02 00:00:00', 'B00000000'),
(7, 'JOSE', NULL, 1000000, NULL, 'B77777777'),
(8, 'ANDRES', 'C/ MICASA', 2000, '2002-02-02 00:00:00', 'B88888888'),
(9, NULL, 'C/ EL GENERAL', 500, NULL, 'B55555555'),
(10, 'SIN NOMBRE', NULL, 250, '2002-02-02 00:00:00', 'C85285285');

-- Estructura de tabla para la tabla `vender`
DROP TABLE IF EXISTS `vender`;
CREATE TABLE IF NOT EXISTS `vender` (
`numvendedor` int(11) NOT NULL DEFAULT '0',
`nombre_provincia` varchar(50) NOT NULL DEFAULT '',
PRIMARY KEY (`numvendedor`,`nombre_provincia`),
KEY `caj2_vender` (`nombre_provincia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcar la base de datos para la tabla `vender`
INSERT INTO `vender` (`numvendedor`, `nombre_provincia`) VALUES
(1, 'ALBACETE'),
(6, 'ALBACETE'),
(1, 'ALICANTE'),
(10, 'ALICANTE'),
(7, 'MURCIA'),
(9, 'MURCIA'),
(3, 'VALENCIA'),
(8, 'VALENCIA'),
(10, 'VALENCIA'),
(6, 'ZARAGOZA');

-- Claves ajenas para la tabla `localidad`
ALTER TABLE `localidad`
ADD CONSTRAINT `caj_localidad` FOREIGN KEY (`nombre_provincia`) REFERENCES
`provincia` (`nombre`) ON UPDATE CASCADE;

-- Claves ajena para la tabla `vender`
ALTER TABLE `vender`
ADD CONSTRAINT `caj1_vender` FOREIGN KEY (`numvendedor`) REFERENCES
`vendedor` (`numvendedor`) ON UPDATE CASCADE,
ADD CONSTRAINT `caj2_vender` FOREIGN KEY (`nombre_provincia`) REFERENCES
`provincia` (`nombre`) ON UPDATE CASCADE;