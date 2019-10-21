CREATE DATABASE moviepass;

USE moviepass;

CREATE TABLE `Cines`
(
	`id_cine` INT NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(50) NOT NULL,
	`direccion` VARCHAR(50) NOT NULL,
	`capacidad` INT NOT NULL,
	`precio` FLOAT NOT NULL,
	CONSTRAINT `PK_Cine` PRIMARY KEY (`id_cine` ASC),
	CONSTRAINT `UNQ_nombre` UNIQUE (`nombre` ASC)
);

CREATE TABLE `Generos`
(
	`id_genero` INT NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(50) NOT NULL,
	CONSTRAINT `PK_Genero` PRIMARY KEY (`id_genero` ASC)
);

CREATE TABLE `Peliculas`
(
	`id_pelicula` INT NOT NULL,
	`titulo` VARCHAR(50) NOT NULL,
	`duracion` INT NOT NULL,
	`descripcion` VARCHAR(255) NOT NULL,
	`idioma` VARCHAR(50) NOT NULL,
	`clasificacion` BOOL NOT NULL,
	`fechaDeEstreno` DATE NOT NULL,
	`poster` VARCHAR(255) NULL,
	`video` VARCHAR(255) NULL,
	`popularidad` INT NOT NULL,
	CONSTRAINT `PK_Pelicula` PRIMARY KEY (`id_pelicula` ASC)
);

CREATE TABLE `Funciones`
(
	`id_funcion` INT NOT NULL AUTO_INCREMENT,
	`id_cine` INT NOT NULL,
	`id_pelicula` INT NOT NULL,
	`fecha` DATE NOT NULL,
	`hora` TIME NOT NULL,
	CONSTRAINT `PK_Funcion` PRIMARY KEY (`id_funcion` ASC),
	CONSTRAINT `FK_id_cine` FOREIGN KEY (`id_cine`) REFERENCES `Cines` (`id_cine`) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT `FK_id_pelicula` FOREIGN KEY (`id_pelicula`) REFERENCES `Peliculas` (`id_pelicula`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `PeliculasXGeneros`
(
	`id_pelicula` INT NOT NULL,
	`id_genero` INT NOT NULL,
	CONSTRAINT `FK_id_genero` FOREIGN KEY (`id_genero`) REFERENCES `Generos` (`id_genero`)  ON DELETE set null ON UPDATE Cascade,
	CONSTRAINT `FK_id_pelicula` FOREIGN KEY (`id_pelicula`) REFERENCES `Peliculas` (`id_pelicula`) ON DELETE cascade ON UPDATE Cascade,
	CONSTRAINT `PK_PeliculasXGeneros` PRIMARY KEY (`id_pelicula`, `id_genero` )
);

CREATE TABLE `Usuarios`
(
	`dni` INT NOT NULL AUTO_INCREMENT,
	`contraseña` VARCHAR(50) NOT NULL,
	`email` VARCHAR(50) NOT NULL,
	`apellido` VARCHAR(50) NOT NULL,
	`nombre` VARCHAR(50) NOT NULL,
	`rol` INT NOT NULL,
	CONSTRAINT `PK_dni` PRIMARY KEY (`dni` ASC),
	CONSTRAINT `UNQ_email` UNIQUE (`email` ASC),
	CONSTRAINT `CHK_rol` CHECK (1 or 2 or 3)
);



