CREATE DATABASE linea;
USE linea

CREATE TABLE Tabla1(
	id int not null auto_increment primary key,
	titulo varchar(200),
	descripcion varchar(200),
	url varchar(200),
	file int,
	fecha_creacion timestamp
);

CREATE TABLE Tabla2(
	id int not null auto_increment primary key,
	titulo varchar(200),
	descripcion varchar(200),
	url varchar(200),
	file int,
	fecha_creacion timestamp
);

CREATE TABLE Tabla3(
	id int not null auto_increment primary key,
	titulo varchar(200),
	descripcion varchar(200),
	url varchar(200),
	file int,
	fecha_creacion timestamp
);

CREATE TABLE Tabla4(
	id int not null auto_increment primary key,
	titulo varchar(200),
	descripcion varchar(200),
	url varchar(200),
	file int,
	fecha_creacion timestamp
);

CREATE TABLE Tabla5(
	id int not null auto_increment primary key,
	titulo varchar(200),
	descripcion varchar(200),
	url varchar(200),
	file int,
	fecha_creacion timestamp
);

CREATE TABLE Tabla6(
	id int not null auto_increment primary key,
	titulo varchar(200),
	descripcion varchar(200),
	url varchar(200),
	file int,
	fecha_creacion timestamp
);

INSERT INTO Tabla1 VALUES (null,'Un registro','Una descripcion','localhost/url',1,now());
INSERT INTO Tabla1 VALUES (null,'Un registro','Una descripcion','localhost/url',1,now());
INSERT INTO Tabla1 VALUES (null,'Un registro','Una descripcion','localhost/url',1,now());

INSERT INTO Tabla2 VALUES (null,'Un registro','Una descripcion','localhost/url',2,now());
INSERT INTO Tabla2 VALUES (null,'Un registro','Una descripcion','localhost/url',2,now());
INSERT INTO Tabla2 VALUES (null,'Un registro','Una descripcion','localhost/url',2,now());

INSERT INTO Tabla3 VALUES (null,'Un registr3','Una descripcion','localhost/url',3,now());
INSERT INTO Tabla3 VALUES (null,'Un registr3','Una descripcion','localhost/url',3,now());
INSERT INTO Tabla3 VALUES (null,'Un registr3','Una descripcion','localhost/url',3,now());

INSERT INTO Tabla4 VALUES (null,'Un registro4','Una descripcion4','localhost/url4',4,now());
INSERT INTO Tabla4 VALUES (null,'Un registro4','Una descripcion4','localhost/url4',4,now());
INSERT INTO Tabla4 VALUES (null,'Un registro4','Una descripcion4','localhost/url4',4,now());

INSERT INTO Tabla5 VALUES (null,'Un registro5','Una descripcion5','localhost/url',5,now());
INSERT INTO Tabla5 VALUES (null,'Un registro5','Una descripcion5','localhost/url',5,now());
INSERT INTO Tabla5 VALUES (null,'Un registro5','Una descripcion5','localhost/url',5,now());

INSERT INTO Tabla6 VALUES (null,'Un registro6','Una descripcion','localhost/url6',6,now());
INSERT INTO Tabla6 VALUES (null,'Un registro6','Una descripcion','localhost/url6',6,now());
INSERT INTO Tabla6 VALUES (null,'Un registro6','Una descripcion','localhost/url6',6,now());