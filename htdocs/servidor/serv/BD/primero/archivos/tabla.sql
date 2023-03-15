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