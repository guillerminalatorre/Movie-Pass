create database moviepass;

use moviepass;

CREATE TABLE Cines
(
	id_cine INT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(50) NOT NULL,
	direccion VARCHAR(50) NOT NULL,
	capacidad INT NOT NULL,
	precio FLOAT NOT NULL,
	CONSTRAINT PK_Cine PRIMARY KEY (id_cine ASC),
	CONSTRAINT UNQ_nombre UNIQUE (nombre ASC)
);

CREATE TABLE Generos
(
	id_genero INT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(50) NOT NULL,
	CONSTRAINT PK_Genero PRIMARY KEY (id_genero ASC)
);

CREATE TABLE Peliculas
(
	id_pelicula INT NOT NULL,
	id_TMDB INT NOT NULL,
	titulo VARCHAR(50) NOT NULL,
	duracion INT NOT NULL,
	descripcion VARCHAR(512) NOT NULL,
	idioma VARCHAR(50) NOT NULL,
	clasificacion BOOL NOT NULL,
	fechaDeEstreno DATE NOT NULL,
	poster VARCHAR(255) NULL,
	video VARCHAR(255) NULL,
	popularidad INT NOT NULL,
	CONSTRAINT PK_Pelicula PRIMARY KEY (id_pelicula ASC)
);

CREATE TABLE Funciones
(
	id_funcion INT NOT NULL AUTO_INCREMENT,
	id_cine INT NOT NULL,
	id_pelicula INT NOT NULL,
	fecha DATE NOT NULL,
	hora TIME NOT NULL,
	CONSTRAINT PK_Funcion PRIMARY KEY (id_funcion ASC),
	CONSTRAINT FK_id_cine FOREIGN KEY (id_cine) REFERENCES Cines (id_cine) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_id_pelicula FOREIGN KEY (id_pelicula) REFERENCES Peliculas (id_pelicula) ON DELETE CASCADE ON UPDATE CASCADE
);

drop table peliculasxgeneros;
CREATE TABLE PeliculasXGeneros
(
	id_peliculasxgeneros INT NOT NULL AUTO_INCREMENT,
	id_peliculaa INT NOT NULL,
	id_generoo INT NOT NULL,
	CONSTRAINT PK_id_peliculasxgeneros PRIMARY KEY (id_peliculasxgeneros),
	CONSTRAINT FK_id_peliculaa FOREIGN KEY (id_peliculaa) REFERENCES Peliculas (id_pelicula) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT FK_id_generoo FOREIGN KEY (id_generoo) REFERENCES Generos (id_genero) ON DELETE NO ACTION ON UPDATE CASCADE
);

DROP TABLE Usuarios;
CREATE TABLE Usuarios
(
	id_usuario int(11) NOT NULL,
	dni int(11) NOT NULL,
	contraseña varchar(50) COLLATE utf8_unicode_ci NOT NULL,
	email varchar(50) COLLATE utf8_unicode_ci NOT NULL,
	apellido varchar(50) COLLATE utf8_unicode_ci NOT NULL,
	nombre varchar(50) COLLATE utf8_unicode_ci NOT NULL,
	rol tinyint(1) NOT NULL,
	ip int(11) DEFAULT NULL,
	registerDate int(11) DEFAULT NULL,
	lastConnection int(11) DEFAULT NULL,
	loggedIn tinyint(1) DEFAULT NULL,
	image varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
	facebookId int(11) DEFAULT NULL
	CONSTRAINT PK_id_usuario PRIMARY KEY (id_usuario ASC),
	CONSTRAINT UNQ_email UNIQUE (email ASC),
	CONSTRAINT UNQ_dni UNIQUE (dni ASC)
);