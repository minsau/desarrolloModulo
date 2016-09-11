DROP DATABASE admin;
CREATE DATABASE admin;
USE admin

CREATE TABLE Usuario(
	id int not null auto_increment primary key,
	nombre varchar(100),
	apellidoPaterno varchar(100),
	apellidoMaterno varchar(100),
	cargo varchar(100),
	clave varchar(50),
	inicioClave timestamp,
	finClave timestamp
);

CREATE TABLE DatosExtra(
	id int not null auto_increment primary key,
	idUsuario int not null,
	nombreDato varchar(50),
	valorDato varchar(200),
	FOREIGN KEY (idUsuario) REFERENCES Usuario(id)
);

CREATE TABLE Lugar(
	id int not null auto_increment primary key,
	nombreLugar varchar(100),
	descripcion text,
	activo int,
	url varchar(200)
);

CREATE TABLE Permiso(
	idPermiso int not null auto_increment primary key,
	idUsuario int not null,
	idLugar int not null,
	estado TINYINT,
	fecha_permiso timestamp,
	FOREIGN KEY (idUsuario) REFERENCES Usuario(id),
	FOREIGN KEY (idLugar) REFERENCES Lugar(id)
);

INSERT INTO Usuario VALUES (null, 'Saúl','Gómez', 'Navarrete','Tesorero','esasistemas',now(),DATE_ADD(now(), INTERVAL 60 MINUTE));
INSERT INTO Usuario VALUES (null, 'Efren','Cruz', 'Cruz','Presidente','esasistemas',now(),DATE_ADD(now(), INTERVAL 60 MINUTE));
INSERT INTO Usuario VALUES (null, 'Marco','Morales', 'Lopez','Tesorero','esasistemas',now(),DATE_ADD(now(), INTERVAL 60 MINUTE));
INSERT INTO Lugar VALUES (null,'Biblioteca','Pues es la biblioteca',1,'localhost/modulo_administrarUsuarios/biblioteca.php');
INSERT INTO Lugar VALUES (null,'Centro de Computo','Pues es el Centro de Computo',1,'localhost/modulo_administrarUsuarios/centroComputo.php');
INSERT INTO Lugar VALUES (null,'Laboratorio','Pues es el Laboratorio',1,'localhost/modulo_administrarUsuarios/laboratorio.php');
INSERT INTO Lugar VALUES (null,'Direccion','Pues es la Direccion',1,'localhost/modulo_administrarUsuarios/direccion.php');
INSERT INTO Permiso VALUES (null,1,1,1,now());
INSERT INTO Permiso VALUES (null,1,2,1,now());
INSERT INTO Permiso VALUES (null,1,3,1,now());
INSERT INTO Permiso VALUES (null,1,4,1,now());
INSERT INTO Permiso VALUES (null,2,1,1,now());
INSERT INTO Permiso VALUES (null,2,2,0,now());
INSERT INTO Permiso VALUES (null,2,3,0,now());
INSERT INTO Permiso VALUES (null,2,4,0,now());
INSERT INTO Permiso VALUES (null,3,1,0,now());
INSERT INTO Permiso VALUES (null,3,2,0,now());
INSERT INTO Permiso VALUES (null,3,3,0,now());
INSERT INTO Permiso VALUES (null,3,4,0,now());
