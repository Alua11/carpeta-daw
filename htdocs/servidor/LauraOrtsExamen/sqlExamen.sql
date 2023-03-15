DROP DATABASE if exists examen;
create database examen;
use examen;
-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-03-2011 a las 19:11:44
-- Versión del servidor: 5.1.53
-- Versión de PHP: 5.3.4
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8 */
;
--
-- Base de datos: `manager`
--
-- --------------------------------------------------------
--
-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `socios`
--
DROP TABLE IF EXISTS mis_jugadores_de_mi_equipo;
DROP TABLE IF EXISTS jugadores;
DROP TABLE IF EXISTS partidos;
DROP TABLE IF EXISTS equipos_futbol;
DROP TABLE IF EXISTS mi_equipo;
DROP TABLE IF EXISTS socios;
CREATE TABLE IF NOT EXISTS `socios` (
    `nick` varchar(12) NOT NULL DEFAULT '',
    `contrasenya` varchar(12) DEFAULT NULL,
    `edad` int(11) DEFAULT NULL,
    `telefono` varchar(9) DEFAULT NULL,
    `planeta` varchar(12) DEFAULT NULL,
    `direccion` varchar(20) DEFAULT NULL,
    alta_equipo varchar (5) DEFAULT 'NO',
    PRIMARY KEY (`nick`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Volcar la base de datos para la tabla `socios`
--
INSERT INTO `socios` (
        `nick`,
        `contrasenya`,
        `edad`,
        `telefono`,
        `planeta`,
        `direccion`,
        alta_equipo
    )
VALUES (
        'jorge',
        'jorge',
        56,
        '983221003',
        'Saturno',
        'Mass Effects',
        'NO'
    ),
    (
        'juan',
        'juan',
        21,
        '654321789',
        'Marte',
        'plaza roja',
        'NO'
    ),
    (
        'prueba',
        'prueba',
        12,
        '234',
        'dklgn',
        'fgjkldf',
        'SI'
    ),
    (
        'rafa',
        'rafa',
        20,
        '653481689',
        'Jupiter',
        'calle raticulin',
        'NO'
    );
--
-- Estructura de tabla para la tabla `equipos_futbol`
--
CREATE TABLE IF NOT EXISTS `equipos_futbol` (
    `codigo_equipo` varchar(3) NOT NULL DEFAULT '',
    `nombre` varchar(50) DEFAULT NULL,
    `anyodefundacion` date DEFAULT NULL,
    `galaxia` varchar(40) DEFAULT NULL,
    `luna` varchar(20) DEFAULT NULL,
    `direccion` varchar(20) DEFAULT NULL,
    `otrosdatos` varchar(20) DEFAULT NULL,
    PRIMARY KEY (`codigo_equipo`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Volcar la base de datos para la tabla `equipos_futbol`
--
INSERT INTO `equipos_futbol` (
        `codigo_equipo`,
        `nombre`,
        `anyodefundacion`,
        `galaxia`,
        `luna`,
        `direccion`,
        `otrosdatos`
    )
VALUES (
        'FCB',
        'Barcelona',
        '0000-00-00',
        'Catalunya',
        'media',
        'camp nou',
        'none'
    ),
    (
        'BBT',
        'Big Bang Theory',
        '0000-00-00',
        'Pasadena',
        'Orion',
        'Alfa Centauro',
        'none'
    ),
    (
        '2_J',
        'Real Alumnos',
        '0000-00-00',
        'Aspe y Cercanías',
        'Orion',
        'Alfa Centauro',
        'none'
    ),
    (
        'HCF',
        'Hercules',
        '0000-00-00',
        'monte Olimpo',
        'valencia',
        'rico perez',
        'none'
    ),
    (
        'JFC',
        'Juventus',
        '0000-00-00',
        'Torino',
        'Vecchia signora',
        'turin',
        'none'
    ),
    (
        'DIG',
        'Digimon CF',
        '0000-00-00',
        'MuLejos',
        'DigiWorld',
        'DigiCasa',
        'none'
    ),
    (
        'ESA',
        'El Senyor de los Anillos CF ',
        '0000-00-00',
        'Mordor',
        'Torre Oscura',
        'turin',
        'none'
    ),
    (
        'MUT',
        'Manchester',
        '0000-00-00',
        'fishandchips',
        'Shearer',
        'old trafor',
        'none'
    ),
    (
        'OMF',
        'Marsella',
        '0000-00-00',
        'gabacholandia',
        'gallo',
        'velodrome',
        'none'
    ),
    (
        'RMF',
        'Madrid',
        '0000-00-00',
        '7 estrellas',
        'aguirre',
        'bernabeu',
        'none'
    );
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `jugadores` (
    `codigo_jugador` int(11) NOT NULL DEFAULT '0',
    `nombre` varchar(40) DEFAULT NULL,
    `posicion` varchar(10) DEFAULT NULL,
    `codigo_equipo` varchar(3) DEFAULT NULL,
    `valor` int(11) NOT NULL,
    PRIMARY KEY (`codigo_jugador`),
    KEY `fk_jugadores_equipo_futbol` (`codigo_equipo`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Volcar la base de datos para la tabla `jugadores`
--
INSERT INTO `jugadores` (
        `codigo_jugador`,
        `posicion`,
        `nombre`,
        `codigo_equipo`,
        `valor`
    )
VALUES (1, 'portero', 'Victor Valdes', 'FCB', 83),
    (2, 'defensa', 'Alves', 'FCB', 85),
    (3, 'defensa', 'Pique', 'FCB', 82),
    (4, 'defensa', 'Puyol', 'FCB', 88),
    (5, 'defensa', 'Abidal', 'FCB', 82),
    (6, 'medio', 'Busquets', 'FCB', 76),
    (7, 'medio', 'Xavi', 'FCB', 87),
    (8, 'medio', 'Iniesta', 'FCB', 87),
    (9, 'delantero', 'Pedro', 'FCB', 74),
    (10, 'delantero', 'Messi', 'FCB', 90),
    (11, 'delantero', 'Villa', 'FCB', 87),
    (12, 'portero', 'Casillas', 'RMF', 90),
    (13, 'defensa', 'Ramos', 'RMF', 54),
    (14, 'defensa', 'Pepe', 'RMF', 45),
    (15, 'defensa', 'Carvalho', 'RMF', 78),
    (16, 'defensa', 'Marcelo', 'RMF', 71),
    (17, 'medio', 'Alonso', 'RMF', 79),
    (18, 'medio', 'Khedira', 'RMF', 45),
    (19, 'medio', 'Kaka', 'RMF', 33),
    (20, 'medio', 'Ozil', 'RMF', 50),
    (21, 'delantero', 'C.Ronaldo', 'RMF', 89),
    (22, 'delantero', 'Benzema', 'RMF', 73),
    (23, 'portero', 'Lev Yashin', 'HCF', 92),
    (24, 'defensa', 'Cafu', 'HCF', 84),
    (25, 'defensa', 'Franco Baresi', 'HCF', 86),
    (26, 'defensa', 'Bekembabuer', 'HCF', 94),
    (27, 'defensa', 'Maldini', 'HCF', 93),
    (28, 'medio', 'Matthaus ', 'HCF', 90),
    (29, 'medio', 'Platini', 'HCF', 89),
    (30, 'medio', 'Luis Suarez', 'HCF', 91),
    (31, 'medio', 'Maradona', 'HCF', 95),
    (32, 'delantero', 'Van Basten ', 'HCF', 89),
    (33, 'delantero', 'Cruyff', 'HCF', 94),
    (34, 'portero', 'Barthez', 'OMF', 76),
    (35, 'defensa', 'Thuran', 'OMF', 82),
    (36, 'defensa', 'Desailly', 'OMF', 79),
    (37, 'defensa', 'Marius Tresor', 'OMF', 84),
    (38, 'medio', 'Patrick Vieira', 'OMF', 86),
    (39, 'medio', 'Makelele', 'OMF', 45),
    (40, 'medio', 'Pires', 'OMF', 81),
    (41, 'medio', 'Zidane', 'OMF', 88),
    (42, 'delantero', 'Eric Cantona', 'OMF', 84),
    (43, 'delantero', 'Trezeguet', 'OMF', 85),
    (44, 'delantero', 'Henry', 'OMF', 86),
    (45, 'portero', 'Angoy', 'MUT', 7),
    (46, 'defensa', 'Okunowo ', 'MUT', 12),
    (47, 'defensa', 'Bogarde', 'MUT', 29),
    (48, 'defensa', 'Raul Bravo', 'MUT', 26),
    (49, 'defensa', 'Ivan Campo', 'MUT', 31),
    (50, 'medio', 'Gravesen', 'MUT', 46),
    (51, 'medio', 'Amunike', 'MUT', 39),
    (52, 'medio', 'Freddy Rincon', 'MUT', 3),
    (53, 'medio', 'Quaresma', 'MUT', 51),
    (54, 'delantero', 'Dobrowolsky', 'MUT', 11),
    (55, 'delantero', 'Tren Valencia', 'MUT', 13),
    (56, 'portero', 'Schmeichel', 'JFC', 33),
    (57, 'defensa', 'Facchetti', 'JFC', 84),
    (58, 'defensa', 'Nesta', 'JFC', 86),
    (59, 'defensa', 'Passarella', 'JFC', 81),
    (60, 'medio', 'Guardiola', 'JFC', 83),
    (61, 'medio', 'Schuster', 'JFC', 85),
    (62, 'medio', 'Rijkaard', 'JFC', 81),
    (63, 'medio', 'Socrates ', 'JFC', 88),
    (64, 'medio', 'Laudrup ', 'JFC', 90),
    (65, 'delantero', 'Roberto Baggio', 'JFC', 95),
    (66, 'delantero', 'Stoichkov', 'JFC', 89),
    (67, 'defensa', 'Ikakumon', 'DIG', 81),
    (68, 'medio', 'Garurumon', 'DIG', 50),
    (69, 'medio', 'Agumon', 'DIG', 60),
    (70, 'medio', 'Gatomon', 'DIG', 35),
    (71, 'medio', 'Patamon ', 'DIG', 25),
    (72, 'medio', 'Palmon ', 'DIG', 99),
    (73, 'delantero', 'Gogamon', 'DIG', 25),
    (74, 'delantero', 'Jamon', 'DIG', 50),
    (75, 'defensa', 'Gimli', 'ESA', 81),
    (76, 'medio', 'Bilbo', 'ESA', 50),
    (77, 'medio', 'Frodo', 'ESA', 60),
    (78, 'medio', 'Sam', 'ESA', 35),
    (79, 'medio', 'Pippin ', 'ESA', 25),
    (80, 'medio', 'Merry ', 'ESA', 99),
    (81, 'delantero', 'Legolas', 'ESA', 25),
    (82, 'delantero', 'Aragorn', 'ESA', 50),
    (83, 'portero', 'Boromir', 'ESA', 69),
    (84, 'portero', 'Iker Senen', '2_J', 43),
    (85, 'defensa', 'German Pique', '2_J', 81),
    (86, 'medio', 'Alberto Messi', '2_J', 50),
    (87, 'medio', 'Jesus Navas Martinez', '2_J', 60),
    (88, 'defensa', 'Nieves Blanc', '2_J', 35),
    (89, 'medio', 'Carlinhos Quiles', '2_J', 25),
    (
        90,
        'medio',
        'Andres Iniesta Bertomeu ',
        '2_J',
        99
    ),
    (
        91,
        'delantero',
        'Luis Suarez Clavel',
        '2_J',
        25
    ),
    (92, 'delantero', 'Ivan Zarcorano', '2_J', 50),
    (93, 'portero', 'Penny', 'BBT', 65),
    (94, 'defensa', 'Leslie', 'BBT', 43),
    (95, 'defensa', 'Sheldon', 'BBT', 81),
    (96, 'medio', 'Leonard', 'BBT', 50),
    (97, 'medio', 'Bernadette', 'BBT', 60),
    (98, 'medio', 'Amy', 'BBT', 35),
    (99, 'medio', 'Howard ', 'BBT', 65),
    (100, 'medio', 'Rajesh ', 'BBT', 99),
    (101, 'delantero', 'Stuart', 'BBT', 25),
    (102, 'delantero', 'Dc Proton', 'BBT', 40),
    (103, 'portero', 'Barry Kripki', 'BBT', 15);
CREATE TABLE IF NOT EXISTS `mi_equipo` (
    `codigo_mi_equipo` int(11) NOT NULL AUTO_INCREMENT,
    `nombre` varchar(10) DEFAULT NULL,
    `creditos_gastados` int(11) DEFAULT '0',
    `nick_socio` varchar(12) DEFAULT 0 NOT NULL,
    fichajes_hechos varchar (5) DEFAULT 'NO',
    PRIMARY KEY (`codigo_mi_equipo`),
    KEY `fk_mi_equipo_socios` (`nick_socio`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1 AUTO_INCREMENT = 59;
--
CREATE TABLE IF NOT EXISTS `partidos` (
    `cod_local` varchar(3) NOT NULL DEFAULT '',
    `cod_visitante` varchar(3) NOT NULL DEFAULT '',
    `numJornada` int(11) NOT NULL DEFAULT '0',
    `resultado_visitante` int(11) DEFAULT '0',
    `resultado_local` int(11) DEFAULT '0',
    PRIMARY KEY (`cod_local`, `cod_visitante`, `numJornada`),
    KEY `fk_jornada_equipos_futbol2` (`cod_visitante`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
INSERT INTO `partidos` (
        `cod_local`,
        `cod_visitante`,
        `numJornada`,
        `resultado_visitante`,
        `resultado_local`
    )
VALUES ('DIG', 'ESA', 1, 2, 4),
    ('ESA', 'DIG', 5, 2, 4),
    ('FCB', 'HCF', 1, 2, 4),
    ('FCB', 'JFC', 3, 0, 0),
    ('FCB', 'MUT', 5, 0, 0),
    ('FCB', 'OMF', 2, 0, 0),
    ('FCB', 'RMF', 4, 0, 0),
    ('HCF', 'OMF', 4, 0, 0),
    ('JFC', 'HCF', 5, 0, 0),
    ('JFC', 'MUT', 4, 0, 0),
    ('MUT', 'HCF', 2, 0, 0),
    ('MUT', 'JFC', 1, 5, 1),
    ('MUT', 'OMF', 3, 0, 0),
    ('OMF', 'RMF', 5, 0, 0),
    ('RMF', 'HCF', 3, 0, 0),
    ('RMF', 'JFC', 2, 0, 0),
    ('RMF', 'OMF', 1, 3, 1);
CREATE TABLE IF NOT EXISTS mis_jugadores_de_mi_equipo (
    codigo_mi_equipo int(11) NOT NULL,
    codigo_jugador int(11) NOT NULL DEFAULT '0',
    PRIMARY KEY (codigo_mi_equipo, codigo_jugador)
) ENGINE = InnoDB DEFAULT CHARSET = latin1 AUTO_INCREMENT = 59;
--
-- Filtros para la tabla `jugadores`
--
INSERT INTO `mi_equipo` (
        `codigo_mi_equipo`,
        `nombre`,
        `creditos_gastados`,
        `nick_socio`,
        `fichajes_hechos`
    )
VALUES (1, 'Los Pates', 324, 'prueba', 'SI');
INSERT INTO `mis_jugadores_de_mi_equipo` (`codigo_mi_equipo`, `codigo_jugador`)
VALUES (1, 1),
    (1, 70),
    (1, 75),
    (1, 77),
    (1, 101),
    (1, 102);
/*!40000 ALTER TABLE `mis_jugadores_de_mi_equipo` ENABLE KEYS */
;
ALTER TABLE `jugadores`
ADD CONSTRAINT `fk_jugadores_equipo_futbol` FOREIGN KEY (`codigo_equipo`) REFERENCES `equipos_futbol` (`codigo_equipo`) ON DELETE NO ACTION ON UPDATE CASCADE;
--
-- Filtros para la tabla `mi_equipo`
--
ALTER TABLE `mi_equipo`
ADD CONSTRAINT `fk_mi_equipo_socios` FOREIGN KEY (`nick_socio`) REFERENCES `socios` (`nick`) ON DELETE NO ACTION ON UPDATE CASCADE;
ALTER TABLE mi_equipo
ADD CONSTRAINT unica_miequipo UNIQUE (nick_socio);
--
-- Filtros para la tabla `partidos`
--
ALTER TABLE `partidos`
ADD CONSTRAINT `fk_jornada_equipos_futbol` FOREIGN KEY (`cod_local`) REFERENCES `equipos_futbol` (`codigo_equipo`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `fk_jornada_equipos_futbol2` FOREIGN KEY (`cod_visitante`) REFERENCES `equipos_futbol` (`codigo_equipo`) ON DELETE NO ACTION ON UPDATE CASCADE;
ALTER TABLE `mis_jugadores_de_mi_equipo`
ADD CONSTRAINT `fk_mis_jug1` FOREIGN KEY (`codigo_mi_equipo`) REFERENCES `mi_equipo` (`codigo_mi_equipo`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `fk_mis_jug2` FOREIGN KEY (`codigo_jugador`) REFERENCES `jugadores` (`codigo_jugador`) ON DELETE NO ACTION ON UPDATE CASCADE;