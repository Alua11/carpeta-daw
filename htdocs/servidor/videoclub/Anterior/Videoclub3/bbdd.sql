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
INSERT INTO `cliente` (`id`, `dni`, `nombre`, `apellido1`, `apellido2`) VALUES (NULL, '743952145A', 'Manolo', 'Garcia', 'Lopez'); 