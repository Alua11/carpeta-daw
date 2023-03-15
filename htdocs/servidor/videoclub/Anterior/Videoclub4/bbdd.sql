CREATE DATABASE videoclub;
USE videoclub;

CREATE TABLE producto(
    id INT(11) AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    precio INT(10) NOT NULL,
    tipo SET("juego","cd","pelicula"),
    plataforma SET("nintendo","xbox","playstation"),
    idioma VARCHAR(10),
    duracion INT(10),
    genero VARCHAR(15),
    PRIMARY KEY(id)
);

DROP TABLE if exists cliente;
CREATE TABLE cliente(
    id INT(11) AUTO_INCREMENT,
    dni VARCHAR(10) UNIQUE NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    apellido1 VARCHAR(50) NOT NULL,
    apellido2 VARCHAR(50),
    PRIMARY KEY(id)
);

DROP TABLE if exists alquilado;
CREATE TABLE alquilado(
    id INT(11) AUTO_INCREMENT,
    id_cliente INT(11) NOT NULL,
    id_producto INT(11) NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE,
    PRIMARY KEY(id)
);

DROP TABLE if exists videoclub;
CREATE TABLE videoclub(
    id INT(11) AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    PRIMARY KEY(id)
);

ALTER TABLE alquilado ADD CONSTRAINT alquilado_cliente FOREIGN KEY (id_cliente) REFERENCES cliente (id) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE alquilado ADD CONSTRAINT alquilado_producto FOREIGN KEY (id_producto) REFERENCES producto (id) ON UPDATE NO ACTION ON DELETE NO ACTION;

INSERT INTO `producto`(`nombre`, `precio`, `tipo`, `plataforma`) VALUES ('The last of us', 70, 'juego', 'playstation');
-- INSERT INTO `producto`(`nombre`, `precio`, `tipo`, `plataforma`) VALUES ('The last of us', 70, 'juego', 'playstation');
-- INSERT INTO `producto`(`nombre`, `precio`, `tipo`, `plataforma`) VALUES ('The last of us', 70, 'juego', 'playstation');
-- INSERT INTO `producto`(`nombre`, `precio`, `tipo`, `plataforma`) VALUES ('The last of us', 70, 'juego', 'playstation');
-- INSERT INTO `producto`(`nombre`, `precio`, `tipo`, `plataforma`) VALUES ('The last of us', 70, 'juego', 'playstation');
-- INSERT INTO `producto`(`nombre`, `precio`, `tipo`, `plataforma`) VALUES ('The last of us', 70, 'juego', 'playstation');
-- INSERT INTO `producto`(`nombre`, `precio`, `tipo`, `plataforma`) VALUES ('The last of us', 70, 'juego', 'playstation');
-- INSERT INTO `producto`(`nombre`, `precio`, `tipo`, `plataforma`) VALUES ('The last of us', 70, 'juego', 'playstation');
-- INSERT INTO `producto`(`nombre`, `precio`, `tipo`, `plataforma`) VALUES ('The last of us', 70, 'juego', 'playstation');
-- INSERT INTO `producto`(`nombre`, `precio`, `tipo`, `plataforma`) VALUES ('The last of us', 70, 'juego', 'playstation');
-- INSERT INTO `producto`(`nombre`, `precio`, `tipo`, `plataforma`) VALUES ('The last of us', 70, 'juego', 'playstation');
-- INSERT INTO `producto`(`nombre`, `precio`, `tipo`, `plataforma`) VALUES ('The last of us', 70, 'juego', 'playstation');
-- INSERT INTO `producto`(`nombre`, `precio`, `tipo`, `plataforma`) VALUES ('The last of us', 70, 'juego', 'playstation');
-- INSERT INTO `producto`(`nombre`, `precio`, `tipo`, `plataforma`) VALUES ('The last of us', 70, 'juego', 'playstation');
-- INSERT INTO `producto`(`nombre`, `precio`, `tipo`, `plataforma`) VALUES ('The last of us', 70, 'juego', 'playstation');

INSERT INTO `cliente` (`dni`, `nombre`, `apellido1`, `apellido2`) VALUES ('74500214A', 'Manolo', 'Garcia', 'Lopez');
INSERT INTO `cliente` (`dni`, `nombre`, `apellido1`, `apellido2`) VALUES ('74395214B', 'Ana', 'Segadora', 'Torres');
INSERT INTO `cliente` (`dni`, `nombre`, `apellido1`, `apellido2`) VALUES ('35392344Z', 'Paco', 'Alonso', 'Garcia');
INSERT INTO `cliente` (`dni`, `nombre`, `apellido1`, `apellido2`) VALUES ('23395234S', 'Juan', 'Garcia', 'Soriano');
INSERT INTO `cliente` (`dni`, `nombre`, `apellido1`, `apellido2`) VALUES ('15394514D', 'Paco', 'Moreno', 'Rubio');
INSERT INTO `cliente` (`dni`, `nombre`, `apellido1`, `apellido2`) VALUES ('44394414M', 'Sara', 'Lozano', 'Perez');
INSERT INTO `cliente` (`dni`, `nombre`, `apellido1`, `apellido2`) VALUES ('12341234A', 'Carla', 'Ramon', 'Martinez');
INSERT INTO `cliente` (`dni`, `nombre`, `apellido1`, `apellido2`) VALUES ('24354678L', 'Ana', 'Rubio', 'Murcia');
INSERT INTO `cliente` (`dni`, `nombre`, `apellido1`, `apellido2`) VALUES ('48952643M', 'Alba', 'Garcia', 'Lopez');
INSERT INTO `cliente` (`dni`, `nombre`, `apellido1`, `apellido2`) VALUES ('60040633N', 'Paco', 'Palau', 'Rubio');

INSERT INTO `alquilado` (`id_cliente`, `id_producto`, `fecha_inicio`, `fecha_fin`) VALUES ('1', '1', '2022/09/12', '2022/09/13');
INSERT INTO `alquilado` (`id_cliente`, `id_producto`, `fecha_inicio`, `fecha_fin`) VALUES ('2', '1', '2022/09/13', '2022/09/14');
-- INSERT INTO `alquilado` (`id_cliente`, `id_producto`, `fecha_inicio`, `fecha_fin`) VALUES ('1', '2', '2022/09/20', '2022/09/23');
INSERT INTO `alquilado` (`id_cliente`, `id_producto`, `fecha_inicio`, `fecha_fin`) VALUES ('3', '1', '2023/01/28', '2023/01/31');
INSERT INTO `alquilado` (`id_cliente`, `id_producto`, `fecha_inicio`, `fecha_fin`) VALUES ('4', '1', '2023/02/01', NULL);
-- INSERT INTO `alquilado` (`id_cliente`, `id_producto`, `fecha_inicio`, `fecha_fin`) VALUES ('5', '2', '2023/02/02', NULL);
