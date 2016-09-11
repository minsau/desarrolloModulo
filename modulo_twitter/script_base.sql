DROP DATABASE events;
CREATE DATABASE events;

USE events

CREATE TABLE Evento(
	id int not null auto_increment primary key,
	titulo varchar(150) ,
  	descripcion text ,
  	lugar varchar(45) ,
  	inicio timestamp,
	final timestamp
);

CREATE TABLE Files(
	id INT NOT NULL auto_increment,
	archivo LONGBLOB,	
	tipo VARCHAR(255),	
	nombre VARCHAR(255),
	PRIMARY KEY (id)
);

CREATE TABLE DocumentosAgenda(
	idDocumentos int not null auto_increment primary key,
	idEvento int not null,
	ordenDia int not null,
	gaceta int not null,
	asistencias int not null,
	votaciones int not null,
	versionEstenografia text,
	debates int not null,
	numeralia int not null,
	FOREIGN KEY(idEvento) REFERENCES Evento(id),
	FOREIGN KEY(gaceta) REFERENCES Files(id),
	FOREIGN KEY(asistencias) REFERENCES Files(id),
	FOREIGN KEY(votaciones) REFERENCES Files(id),
	FOREIGN KEY(debates) REFERENCES Files(id),
	FOREIGN KEY(numeralia) REFERENCES Files(id)
);

INSERT INTO Evento VALUES (null,'Café con clase','descripcion','Sala 1',now(),DATE_ADD(now(), INTERVAL 60 MINUTE));
INSERT INTO Evento VALUES (null,'Café sin clase','descripcion','Sala 2',now(),DATE_ADD(now(), INTERVAL 60 MINUTE));
INSERT INTO Evento VALUES (null,'Café con leche','descripcion','Sala 1',now(),DATE_ADD(now(), INTERVAL 60 MINUTE));