DROP DATABASE if exists TRABAJO_DAW;
CREATE DATABASE TRABAJO_DAW;
USE TRABAJO_DAW;
CREATE TABLE USUARIOS_GESTION (
    cod_usuario_gestion INT(11) AUTO_INCREMENT,
    nombre VARCHAR(50),
    nick VARCHAR(20) UNIQUE NOT NULL,
    contrasenya VARCHAR(20) NOT NULL,
    PRIMARY KEY (cod_usuario_gestion)
);
CREATE TABLE CLIENTES (
    cod_cliente INT(11) AUTO_INCREMENT,
    cif_dni VARCHAR(11) UNIQUE NOT NULL,
    razon_social VARCHAR(50),
    domicilio_social VARCHAR(50),
    ciudad VARCHAR(50),
    email VARCHAR(50),
    telefono VARCHAR(50),
    nick VARCHAR(20) UNIQUE NOT NULL,
    contrasenya VARCHAR(20) NOT NULL,
    baja ENUM ('alta', 'baja') DEFAULT 'alta',
    PRIMARY KEY (cod_cliente)
);
CREATE TABLE ARTICULOS (
    cod_articulo INT(11) AUTO_INCREMENT,
    nombre VARCHAR(11) NOT NULL,
    descripcion VARCHAR(50),
    precio DECIMAL(8, 2) NOT NULL,
    descuento INT(3) NOT NULL DEFAULT 0,
    iva INT(3) NOT NULL DEFAULT 21,
    baja ENUM ('alta', 'baja') DEFAULT 'alta',
    PRIMARY KEY (cod_articulo)
);
CREATE TABLE PEDIDOS (
    cod_pedido INT(11) AUTO_INCREMENT,
    fecha DATE,
    cod_cliente INT(11) NOT NULL,
    PRIMARY KEY (cod_pedido)
);
CREATE TABLE ALBARANES (
    cod_albaran INT(11) AUTO_INCREMENT,
    fecha DATE,
    facturado ENUM('SI', 'NO') DEFAULT 'NO',
    cod_cliente INT(11) NOT NULL,
    PRIMARY KEY (cod_albaran)
);
CREATE TABLE FACTURAS (
    cod_factura INT(11) AUTO_INCREMENT,
    fecha DATE,
    descuento VARCHAR(2) DEFAULT 0,
    cod_cliente INT(11) NOT NULL,
    PRIMARY KEY (cod_factura)
);
CREATE TABLE LINEAS_PEDIDOS (
    num_linea_pedido INT(11) NOT NULL,
    cod_pedido INT(11) NOT NULL,
    precio DECIMAL(8, 6) NOT NULL,
    cantidad INT(11),
    descuento INT(3),
    iva INT(3),
    cantidad_en_albaran INT(11) DEFAULT 0,
    cod_articulo INT(11),
    cod_usuario_gestion INT(11),
    PRIMARY KEY (num_linea_pedido, cod_pedido)
);
CREATE TABLE LINEAS_ALBARAN (
    num_linea_albaran INT(11) NOT NULL,
    cod_albaran INT(11) NOT NULL,
    precio DECIMAL(8, 6) NOT NULL,
    cantidad INT(11),
    descuento INT(3) DEFAULT 0,
    iva INT(3) DEFAULT 0,
    cod_articulo INT(11),
    cod_usuario_gestion INT(11),
    cod_pedido INT(11) NOT NULL,
    num_linea_pedido INT(11) NOT NULL,
    PRIMARY KEY (num_linea_albaran, cod_albaran)
);

CREATE TABLE LINEAS_FACTURAS (
    num_linea_factura INT(11) NOT NULL,
    cod_factura INT(11) NOT NULL,
    precio DECIMAL(8, 6) NOT NULL,
    cantidad INT(11),
    descuento INT(3),
    iva INT(3),
    cod_articulo INT(11),
    cod_usuario_gestion INT(11),
    cod_albaran INT(11) NOT NULL,
    num_linea_albaran INT(11) NOT NULL,
    PRIMARY KEY (num_linea_factura, cod_factura)
);
-- Insertar usuarios de gestión
INSERT INTO USUARIOS_GESTION (nombre, nick, contrasenya) VALUES
('Juan Pérez', 'juanp', 'contraseña123'),
('María García', 'mariag', 'contraseña456'),
('María García', 'gestor1', '1234'),
('María García', 'gestor2', '1234'),
('Pedro Gómez', 'pedrog', 'contraseña789');

-- Insertar clientes
INSERT INTO CLIENTES (cif_dni, razon_social, domicilio_social, ciudad, email, telefono, nick, contrasenya, baja) VALUES
('12345678A', 'ACME S.L.', 'C/ Mayor 12', 'Madrid', 'acme@acme.com', '912345678', 'acme', 'contraseña123', 'alta'),
('98765432B', 'Mundo S.A.', 'Avda. de la Paz 22', 'Barcelona', 'mundo@mundo.com', '934567890', 'mundo', 'contraseña456', 'alta'),
('11111111C', 'Estrella S.A.', 'C/ Gran Vía 100', 'Valencia', 'estrella@estrella.com', '960123456', 'estrella', 'contraseña789', 'alta');

-- Insertar artículos
INSERT INTO ARTICULOS (nombre, descripcion, precio, descuento, iva, baja) VALUES
('Artículo 1', 'Descripción del artículo 1', 10.00, 0, 21, 'alta'),
('Artículo 2', 'Descripción del artículo 2', 20.00, 5, 21, 'alta'),
('Artículo 3', 'Descripción del artículo 3', 30.00, 10, 21, 'alta');

-- Insertar pedidos
INSERT INTO PEDIDOS (fecha, cod_cliente) VALUES
('2022-01-01', 1),
('2022-02-02', 2),
('2022-03-03', 3);

-- Insertar albaranes
INSERT INTO ALBARANES (fecha, facturado, cod_cliente) VALUES
('2022-01-02', 'NO', 1),
('2022-02-03', 'NO', 2),
('2022-03-04', 'NO', 3);

-- Insertar facturas
INSERT INTO FACTURAS (fecha, descuento, cod_cliente) VALUES
('2022-01-03', '0', 1),
('2022-02-04', '5', 2),
('2022-03-05', '10', 3);

-- Insertar líneas de pedidos
INSERT INTO LINEAS_PEDIDOS (num_linea_pedido, cod_pedido, precio, cantidad, descuento, iva, cantidad_en_albaran, cod_articulo, cod_usuario_gestion) VALUES
(1, 1, 10.00, 20, 0, 21, 2, 1, 1),
(2, 1, 20.00, 20, 5, 21, 10, 2, 2),
(3, 1, 20.00, 20, 5, 21, 0, 3, 2),
(1, 2, 30.00, 20, 10, 21, 2, 3, 3),
(1, 3, 30.00, 20, 10, 21, 2, 3, 3);
-- Líneas de albarán 
INSERT INTO LINEAS_ALBARAN (num_linea_albaran, cod_albaran, precio, cantidad, descuento, iva, cod_articulo, cod_usuario_gestion, cod_pedido, num_linea_pedido)
VALUES
(1, 1, 2.50, 2, 0, 21, 1, 1, 1, 1),
(2, 1, 1.00, 5, 0, 21, 2, 1, 1, 2),
(1, 2, 5.00, 2, 2, 21, 3, 1, 2, 1),
(1, 3, 1.00, 5, 0, 21, 2, 1, 1, 2);


/****************************************************************************/
/*                               Foreign Keys                               */
/****************************************************************************/
ALTER TABLE PEDIDOS
ADD CONSTRAINT CAJ_PEDIDOS_CLIENTES FOREIGN KEY (cod_cliente) REFERENCES CLIENTES (cod_cliente) ON UPDATE CASCADE ON DELETE NO ACTION;
ALTER TABLE ALBARANES
ADD CONSTRAINT CAJ_ALBARANES_CLIENTES FOREIGN KEY (cod_cliente) REFERENCES CLIENTES (cod_cliente) ON UPDATE CASCADE ON DELETE NO ACTION;
ALTER TABLE FACTURAS
ADD CONSTRAINT CAJ_FACTURAS_CLIENTES FOREIGN KEY (cod_cliente) REFERENCES CLIENTES (cod_cliente) ON UPDATE CASCADE ON DELETE NO ACTION;
ALTER TABLE LINEAS_PEDIDOS
ADD CONSTRAINT CAJ_LINPED_PEDIDOS FOREIGN KEY (cod_pedido) REFERENCES PEDIDOS (cod_pedido) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE LINEAS_PEDIDOS
ADD CONSTRAINT CAJ_LINPED_ARTICULOS FOREIGN KEY (cod_articulo) REFERENCES ARTICULOS (cod_articulo) ON UPDATE CASCADE ON DELETE NO ACTION;
ALTER TABLE LINEAS_PEDIDOS
ADD CONSTRAINT CAJ_LINPED_USUGESTION FOREIGN KEY (cod_usuario_gestion) REFERENCES USUARIOS_GESTION (cod_usuario_gestion) ON UPDATE CASCADE ON DELETE NO ACTION;
ALTER TABLE LINEAS_ALBARAN
ADD CONSTRAINT CAJ_LINALB_ALBARANES FOREIGN KEY (cod_albaran) REFERENCES ALBARANES (cod_albaran) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE LINEAS_ALBARAN
ADD CONSTRAINT CAJ_LINALB_ARTICULOS FOREIGN KEY (cod_articulo) REFERENCES ARTICULOS (cod_articulo) ON UPDATE CASCADE ON DELETE NO ACTION;
ALTER TABLE LINEAS_ALBARAN
ADD CONSTRAINT CAJ_LINALB_USUGESTION FOREIGN KEY (cod_usuario_gestion) REFERENCES USUARIOS_GESTION (cod_usuario_gestion) ON UPDATE CASCADE ON DELETE NO ACTION;
ALTER TABLE LINEAS_ALBARAN
ADD CONSTRAINT CAJ_LINALB_LINPED FOREIGN KEY (num_linea_pedido, cod_pedido) REFERENCES LINEAS_PEDIDOS (num_linea_pedido, cod_pedido) ON UPDATE CASCADE ON DELETE NO ACTION;
ALTER TABLE LINEAS_FACTURAS
ADD CONSTRAINT CAJ_LINFACT_FACTURAS FOREIGN KEY (cod_factura) REFERENCES FACTURAS (cod_factura) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE LINEAS_FACTURAS
ADD CONSTRAINT CAJ_LINFACT_ARTICULOS FOREIGN KEY (cod_articulo) REFERENCES ARTICULOS (cod_articulo) ON UPDATE CASCADE ON DELETE NO ACTION;
ALTER TABLE LINEAS_FACTURAS
ADD CONSTRAINT CAJ_LINFACT_USUGESTION FOREIGN KEY (cod_usuario_gestion) REFERENCES USUARIOS_GESTION (cod_usuario_gestion) ON UPDATE CASCADE ON DELETE NO ACTION;
ALTER TABLE LINEAS_FACTURAS
ADD CONSTRAINT CAJ_LINFACT_LINALB FOREIGN KEY (num_linea_albaran, cod_albaran) REFERENCES LINEAS_ALBARAN (num_linea_albaran, cod_albaran) ON UPDATE CASCADE ON DELETE NO ACTION;