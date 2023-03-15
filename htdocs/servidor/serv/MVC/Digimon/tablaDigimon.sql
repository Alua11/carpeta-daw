CREATE DATABASE IF NOT EXISTS p_digimon;
USE p_digimon;
CREATE TABLE digimon(
id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
nombre VARCHAR(50) NOT NULL,
ataque INT(50) not NULL,
defensa INT(255) NOT NULL,
tipo ENUM('vacuna','virus','elemental','animal','planta') NOT NULL,
nivel ENUM('1','2','3') NOT NULL,
unique (nombre),
PRIMARY KEY(id)
);
INSERT INTO digimon (nombre, ataque, defensa, tipo, nivel) VALUES
('agumon','20','20','vacuna', '1');
INSERT INTO digimon (nombre, ataque, defensa, tipo, nivel)
VALUES('tentomon','20','20','virus', '1');
INSERT INTO digimon (nombre, ataque, defensa, tipo, nivel) VALUES
('gabumon','20','20','animal', '1');
INSERT INTO digimon (nombre, ataque, defensa, tipo, nivel)
VALUES('piyomon','20','20','elemental', '1');
INSERT INTO digimon (nombre, ataque, defensa, tipo, nivel)
VALUES('palmon','20','20','planta', '1');