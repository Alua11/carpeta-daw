CREATE DATABASE IF NOT EXISTS proveedores;
USE proveedores;

/****************************************************************************/
/*                                  Tables                                  */
/****************************************************************************/

CREATE TABLE INVENTARIO (
    NUMPIEZA CHAR(16) NOT NULL,
    NUMBIN SMALLINT NOT NULL,
    CANTDISPONIBLE SMALLINT,
    FECHARECUENTO DATE,
    PERIODORECUEN SMALLINT,
    CANTAJUSTE SMALLINT,
    CARTREORD SMALLINT,
    PUNTOREORD SMALLINT);


CREATE TABLE LINPED (
    NUMPEDIDO SMALLINT NOT NULL,
    NUMLINEA SMALLINT NOT NULL,
    NUMPIEZA CHAR(16),
    PRECIOCOMPRA INTEGER,
    CANTPEDIDA SMALLINT,
    FECHARECEP DATE,
    CANTRECIBIDA SMALLINT);


CREATE TABLE PEDIDO (
    NUMPEDIDO SMALLINT NOT NULL,
    NUMVEND SMALLINT,
    FECHA DATE);


CREATE TABLE PIEZAS (
    NUMPIEZA CHAR(16) NOT NULL,
    NOMPIEZA CHAR(30),
    PRECIOVENT FLOAT);


CREATE TABLE PRECIOSUM (
    NUMPIEZA CHAR(16) NOT NULL,
    NUMVEND SMALLINT NOT NULL,
    PRECIOUNIT INTEGER,
    DIASSUM SMALLINT,
    DESCUENTO SMALLINT);


CREATE TABLE VENDEDOR (
    NUMVEND SMALLINT NOT NULL,
    NOMVEND CHAR(30),
    NOMBRECOMER CHAR(30),
    TELEFONO CHAR(15),
    CALLE CHAR(30),
    CIUDAD CHAR(20),
    PROVINCIA CHAR(20),
    COD_POSTAL CHAR(5));



INSERT INTO LINPED (NUMPEDIDO, NUMLINEA, NUMPIEZA, PRECIOCOMPRA, CANTPEDIDA, FECHARECEP, CANTRECIBIDA) VALUES (6, 1, 'O-0001-PP', 1500, 10000, '1995-08-25 00:00:00', 10000);
INSERT INTO LINPED (NUMPEDIDO, NUMLINEA, NUMPIEZA, PRECIOCOMPRA, CANTPEDIDA, FECHARECEP, CANTRECIBIDA) VALUES (6, 2, 'O-0002-PP', 9900, 20000, '1995-08-25 00:00:00', 19980);
INSERT INTO LINPED (NUMPEDIDO, NUMLINEA, NUMPIEZA, PRECIOCOMPRA, CANTPEDIDA, FECHARECEP, CANTRECIBIDA) VALUES (1, 1, 'M-0001-C', 30000, 10, '1992-05-10 00:00:00', 10);
INSERT INTO LINPED (NUMPEDIDO, NUMLINEA, NUMPIEZA, PRECIOCOMPRA, CANTPEDIDA, FECHARECEP, CANTRECIBIDA) VALUES (1, 2, 'P-0001-33', 21000, 20, '1992-05-10 00:00:00', 18);
INSERT INTO LINPED (NUMPEDIDO, NUMLINEA, NUMPIEZA, PRECIOCOMPRA, CANTPEDIDA, FECHARECEP, CANTRECIBIDA) VALUES (1, 3, 'FD-0001-144', 13500, 20, '1992-05-10 00:00:00', 20);
INSERT INTO LINPED (NUMPEDIDO, NUMLINEA, NUMPIEZA, PRECIOCOMPRA, CANTPEDIDA, FECHARECEP, CANTRECIBIDA) VALUES (1, 4, 'DD-0001-210', 15000, 20, '1992-05-10 00:00:00', 20);
INSERT INTO LINPED (NUMPEDIDO, NUMLINEA, NUMPIEZA, PRECIOCOMPRA, CANTPEDIDA, FECHARECEP, CANTRECIBIDA) VALUES (2, 1, 'DK144-0002-P', 545, 100, '1992-10-15 00:00:00', 101);
INSERT INTO LINPED (NUMPEDIDO, NUMLINEA, NUMPIEZA, PRECIOCOMPRA, CANTPEDIDA, FECHARECEP, CANTRECIBIDA) VALUES (2, 2, 'T-0002-AT', 3000, 1, '1992-10-15 00:00:00', 1);
INSERT INTO LINPED (NUMPEDIDO, NUMLINEA, NUMPIEZA, PRECIOCOMPRA, CANTPEDIDA, FECHARECEP, CANTRECIBIDA) VALUES (1, 5, 'T-0002-AT', 3100, 22, '1992-10-17 00:00:00', 22);
INSERT INTO LINPED (NUMPEDIDO, NUMLINEA, NUMPIEZA, PRECIOCOMPRA, CANTPEDIDA, FECHARECEP, CANTRECIBIDA) VALUES (3, 1, 'DD-0001-210', 14600, 15, '1992-10-17 00:00:00', 15);
INSERT INTO LINPED (NUMPEDIDO, NUMLINEA, NUMPIEZA, PRECIOCOMPRA, CANTPEDIDA, FECHARECEP, CANTRECIBIDA) VALUES (3, 2, 'P-0001-33', 21000, 3, '1992-10-17 00:00:00', 3);
INSERT INTO LINPED (NUMPEDIDO, NUMLINEA, NUMPIEZA, PRECIOCOMPRA, CANTPEDIDA, FECHARECEP, CANTRECIBIDA) VALUES (4, 1, 'O-0002-PP', 9900, 10, '1992-10-17 00:00:00', 10);
INSERT INTO LINPED (NUMPEDIDO, NUMLINEA, NUMPIEZA, PRECIOCOMPRA, CANTPEDIDA, FECHARECEP, CANTRECIBIDA) VALUES (5, 1, 'T-0002-AT', 1500, 15, '1993-06-11 00:00:00', 13);
INSERT INTO LINPED (NUMPEDIDO, NUMLINEA, NUMPIEZA, PRECIOCOMPRA, CANTPEDIDA, FECHARECEP, CANTRECIBIDA) VALUES (7, 1, 'C-400-Z', 700, 45, '1992-10-09 00:00:00', 8);

COMMIT WORK;

INSERT INTO PEDIDO (NUMPEDIDO, NUMVEND, FECHA) VALUES (1, 1, '1992-05-05 00:00:00');
INSERT INTO PEDIDO (NUMPEDIDO, NUMVEND, FECHA) VALUES (2, 1, '1992-10-11 00:00:00');
INSERT INTO PEDIDO (NUMPEDIDO, NUMVEND, FECHA) VALUES (3, 2, '1992-10-15 00:00:00');
INSERT INTO PEDIDO (NUMPEDIDO, NUMVEND, FECHA) VALUES (4, 2, '1992-10-16 00:00:00');
INSERT INTO PEDIDO (NUMPEDIDO, NUMVEND, FECHA) VALUES (5, 1, '1992-10-22 00:00:00');
INSERT INTO PEDIDO (NUMPEDIDO, NUMVEND, FECHA) VALUES (7, 8002, '0992-10-02 00:00:00');
INSERT INTO PEDIDO (NUMPEDIDO, NUMVEND, FECHA) VALUES (6, 5, '1998-05-25 00:00:00');

COMMIT WORK;

INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('A-1001-L', 'RATON NEGRO 3BOTONES', 300);
INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('C-1002-H', NULL, 400);
INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('C-1002-J', NULL, 700);
INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('C-400-Z', 'FILTRO PANTALLA 17', 1800);
INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('DD-0001-210', 'DISCO DURO 20 Gb WD', 25000);
INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('DD-0001-30', 'DISCO DURO 20 Gb SEAGATE', 20000);
INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('DK144-0002-P', 'CAJA DISCOS 1.44Mb', 1100);
INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('DK720-0002-P', 'CAJA DISCOS 720Mb', 1500);
INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('FD-0001-144', 'UNIDAD DISCO 1.44 SAMSUNG', 15000);
INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('FD-0002-720', 'UNIDAD DISCO 720 SAMSUNG', 17000);
INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('M-0001-C', 'MONITOR LG 17P', 30000);
INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('M-0003-C', 'MONITOR SONY 17P', 45000);
INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('O-0001-PP', 'PEGATINAS ESPECIALES FD 1.44', 400);
INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('O-0002-PP', 'PEGATINAS ESPECIALES FD 720', 450);
INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('P-0001-33', 'PLACA BASE SOLTEK 33Mhz', 25000);
INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('P-0002-533', 'PLACA BASE INTEL', 75000);
INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('T-0001-AT', 'TECLADO COMPATIBLE AT', 1000);
INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('T-0001-IBM', 'TECLADO COMPATIBLE IBM', 1500);
INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('T-0002-AT', 'TECLADO COMPATIBLE AT2', 1045);
INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('2', 'Teclado ErgonOmico', 15000);
INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('3', 'Teclado ps/2', 2570);
INSERT INTO PIEZAS (NUMPIEZA, NOMPIEZA, PRECIOVENT) VALUES ('4', 'RatOn ps/2', 1500);

COMMIT WORK;

INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('A-1001-L', 1, 220, 3, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('A-1001-L', 3, 550, 1, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('A-1001-L', 4, 539, 1, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('A-1001-L', 100, 440, 3, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('C-1002-H', 1, 55, 2, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('C-1002-J', 1, 165, 2, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('C-400-Z', 1, 935, 2, 5);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('C-400-Z', 8002, 770, 3, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('DD-0001-210', 1, 16500, 3, 15);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('DD-0001-210', 2, 18700, 5, 12);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('DD-0001-210', 101, 15400, 15, 14);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('DD-0001-30', 1, 13200, 4, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('DK144-0002-P', 1, 616, 3, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('DK144-0002-P', 2, 605, 5, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('FD-0001-144', 1, 14300, 3, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('FD-0001-144', 55, 13200, 10, 13);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('FD-0001-144', 102, 14960, 3, 7);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('FD-0002-720', 1, 15400, 3, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('M-0001-C', 1, 17050, 3, 10);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('M-0001-C', 3, 20350, 7, 15);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('M-0003-C', 1, 22000, 7, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('M-0003-C', 3, 39050, 2, 15);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('M-0003-C', 4, 31350, 7, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('O-0001-PP', 1, 1650, 1, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('O-0001-PP', 5, 2145, 1, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('O-0001-PP', 55, 1650, 7, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('O-0002-PP', 1, 8250, 7, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('O-0002-PP', 2, 10890, 7, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('O-0002-PP', 5, 10780, 7, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('O-0002-PP', 101, 9350, 7, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('P-0001-33', 1, 27500, 3, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('P-0001-33', 2, 23100, 5, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('P-0001-33', 3, 27500, 2, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('P-0001-33', 4, 30800, 7, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('P-0001-33', 5, 30800, 3, 10);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('T-0001-IBM', 1, 9900, 15, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('T-0001-IBM', 2, 9900, 5, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('T-0001-IBM', 100, 10450, 5, 10);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('T-0002-AT', 1, 3850, 3, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('T-0002-AT', 2, 3300, 5, 10);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('T-0002-AT', 4, 2750, 7, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('T-0002-AT', 5, 3630, 3, NULL);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('T-0002-AT', 100, 3740, 2, 5);
INSERT INTO PRECIOSUM (NUMPIEZA, NUMVEND, PRECIOUNIT, DIASSUM, DESCUENTO) VALUES ('T-0002-AT', 201, 3300, 1, 5);

COMMIT WORK;

INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (1, 'AGAPITO LAFUENTE DEL CORRAL', 'MECEMSA', '965758745', 'Avda. Valencia,32', 'ALICANTE', 'ALICANTE', NULL);
INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (2, 'LUCIANO BLAZQUEZ VAZQUEZ', 'HARW SA', '965548726', 'General Lacy,15', 'ALICANTE', 'ALICANTE', NULL);
INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (3, 'GODOFREDO MARTIN MARTINEZ', 'MECEMSA', '965754128', 'Avda. Valencia,15', 'ALICANTE', 'ALICANTE', NULL);
INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (4, 'JUAN REINA PRINCESA', 'HARW SA', '965115342', 'C/Desconocida,7', 'New York', 'EEUU', NULL);
INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (5, 'JUAN REINA PRINCESA', 'LA DEAQUI', '984578115', 'San Francisco de Asis,5', 'GijOn', 'ASTURIAS', NULL);
INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (6, 'MANOLO PIEDRA POMEZ', 'HUMP SA', '983445879', 'Corredera,2', 'SAN VICENTE', 'ALICANTE', NULL);
INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (7, 'MANUEL RODRIGUEZ PEREZ', 'SoftHard distribuidora S.A', '966774455', 'Perdida,3', 'NEW ORLEANS', 'LOUSSIANA', NULL);
INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (8, 'LUISA PINTO HEREDIA', 'LaMeJoR, S.A', '555447788', 'Perdida,8', 'NEW ORLEANS', 'LOUSSIANA', NULL);
INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (9, 'CHEMA PAMUNDI GRANDE', 'OLE ESPA�A', NULL, NULL, 'MADRID', 'MADRID', NULL);
INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (10, 'GUSTAVO DE B�SICA ZURRO', 'OLE ESPA�A', NULL, NULL, 'MADRID', 'MADRID', NULL);
INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (11, 'MARIO DUQUE LIZONDO', 'BANESTOSOFT,SA', NULL, NULL, 'GIJON', 'ASTURIAS', NULL);
INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (12, 'JOSE ANT. MARTINEZ JUANO', 'OLE ESPA�A', NULL, NULL, 'MADRID', 'MADRID', NULL);
INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (13, 'MANUEL COMEZ APATILLA', 'OLE ESPA�A', '3667798', 'COLON,21', 'VALENCIA', 'VALENCIA', NULL);
INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (55, 'LUIS GRACIA LATORRE', 'DANYSOFT, S.A', '999-448734', 'AZORIN,1', 'ALICANTE', 'ALICANTE', NULL);
INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (100, 'PEDRO GARCIA MORALES', 'SOFT, S.A', NULL, 'MAYOR,145', 'VALENCIA', 'VALENCIA', NULL);
INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (101, 'SALVADOR PLA GRACIA', 'HOUSESOFT, S.A', '555-555555', 'MENOR,13', 'SAN VICENTE', 'ALICANTE', NULL);
INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (102, 'SOLEDAD MARTINEZ ORTEGAA', 'IXSOFT, S.L', '555-468998', 'PLAZA MANILA,13', 'ALICANTE', 'ALICANTE', NULL);
INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (200, 'SEVERINO MARTINEZ MARTI', 'DANYSOFT, S.A', '999-448734', 'AZORIN,1', 'ALICANTE', 'ALICANTE', NULL);
INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (201, 'MANUEL TUNO LAFUENTE', 'HALA, S.A', '655-487711', 'QUINTANA,33', 'ALICANTE', 'ALICANTE', NULL);
INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (8001, 'JUAN RODRIGUEZ JUAN', 'HALA, S.A', NULL, NULL, 'SAN JUAN', 'ALICANTE', NULL);
INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (8002, 'JUAN MARTINEZ GARCIA', 'HARW, S.A', '555-667713', 'CISCAR,15', 'ELCHE', 'ALICANTE', NULL);
INSERT INTO VENDEDOR (NUMVEND, NOMVEND, NOMBRECOMER, TELEFONO, CALLE, CIUDAD, PROVINCIA, COD_POSTAL) VALUES (8003, 'LUIS RODRIGUEZ SALA', 'HARW, S.A', '555-667713', 'CISCAR,15', 'ELCHE', 'ALICANTE', NULL);

COMMIT WORK;

INSERT INTO INVENTARIO (NUMPIEZA, NUMBIN, CANTDISPONIBLE, FECHARECUENTO, PERIODORECUEN, CANTAJUSTE, CARTREORD, PUNTOREORD) VALUES ('FD-0001-144', 7, 10, '1992-12-11 00:00:00', 2, 0, 5, 5);
INSERT INTO INVENTARIO (NUMPIEZA, NUMBIN, CANTDISPONIBLE, FECHARECUENTO, PERIODORECUEN, CANTAJUSTE, CARTREORD, PUNTOREORD) VALUES ('DD-0001-30', 1, 120, '1990-10-15 00:00:00', 1, 15, 20, 23);
INSERT INTO INVENTARIO (NUMPIEZA, NUMBIN, CANTDISPONIBLE, FECHARECUENTO, PERIODORECUEN, CANTAJUSTE, CARTREORD, PUNTOREORD) VALUES ('P-0001-33', 2, 10, '1990-10-15 00:00:00', NULL, 5, 5, 6);
INSERT INTO INVENTARIO (NUMPIEZA, NUMBIN, CANTDISPONIBLE, FECHARECUENTO, PERIODORECUEN, CANTAJUSTE, CARTREORD, PUNTOREORD) VALUES ('O-0002-PP', 3, 110, '1990-10-15 00:00:00', 1, 3, 20, 20);
INSERT INTO INVENTARIO (NUMPIEZA, NUMBIN, CANTDISPONIBLE, FECHARECUENTO, PERIODORECUEN, CANTAJUSTE, CARTREORD, PUNTOREORD) VALUES ('M-0001-C', 4, 15, '1990-10-15 00:00:00', 2, 2, 20, 16);
INSERT INTO INVENTARIO (NUMPIEZA, NUMBIN, CANTDISPONIBLE, FECHARECUENTO, PERIODORECUEN, CANTAJUSTE, CARTREORD, PUNTOREORD) VALUES ('M-0003-C', 5, 2, '1990-10-20 00:00:00', 1, 0, NULL, NULL);

COMMIT WORK;





/****************************************************************************/
/*                            Unique Constraints                            */
/****************************************************************************/

ALTER TABLE INVENTARIO ADD CONSTRAINT UNICO_NUMPIEZA UNIQUE (NUMPIEZA);


/****************************************************************************/
/*                            Primary Keys                                  */
/****************************************************************************/

ALTER TABLE INVENTARIO ADD CONSTRAINT CP_INVENTARIO PRIMARY KEY (NUMBIN);
ALTER TABLE LINPED ADD CONSTRAINT CP_LINPED PRIMARY KEY (NUMPEDIDO, NUMLINEA);
ALTER TABLE PEDIDO ADD CONSTRAINT CP_PEDIDO PRIMARY KEY (NUMPEDIDO);
ALTER TABLE PIEZAS ADD CONSTRAINT CP_PIEZA PRIMARY KEY (NUMPIEZA);
ALTER TABLE PRECIOSUM ADD CONSTRAINT CP_PRECIOSUM PRIMARY KEY (NUMPIEZA, NUMVEND);
ALTER TABLE VENDEDOR ADD CONSTRAINT CP_VENDEDOR PRIMARY KEY (NUMVEND);


/****************************************************************************/
/*                               Foreign Keys                               */
/****************************************************************************/

ALTER TABLE INVENTARIO ADD CONSTRAINT CAJ_INVENTARIO_PIEZA FOREIGN KEY (NUMPIEZA) REFERENCES PIEZAS (NUMPIEZA);
ALTER TABLE LINPED ADD CONSTRAINT CAJ_LINPED_PEDIDO FOREIGN KEY (NUMPEDIDO) REFERENCES PEDIDO (NUMPEDIDO);
ALTER TABLE LINPED ADD CONSTRAINT CAJ_LINPED_PIEZA FOREIGN KEY (NUMPIEZA) REFERENCES PIEZAS (NUMPIEZA);
ALTER TABLE PEDIDO ADD CONSTRAINT CAJ_PEDIDO_VENDEDOR FOREIGN KEY (NUMVEND) REFERENCES VENDEDOR (NUMVEND);
ALTER TABLE PRECIOSUM ADD CONSTRAINT CA_PIEZA_PRECIOSUM FOREIGN KEY (NUMPIEZA) REFERENCES PIEZAS (NUMPIEZA);
ALTER TABLE PRECIOSUM ADD CONSTRAINT CA_VENDEDOR_PRECIOSUM FOREIGN KEY (NUMVEND) REFERENCES VENDEDOR (NUMVEND);
