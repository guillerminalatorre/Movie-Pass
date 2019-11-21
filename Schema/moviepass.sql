SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `Cines` (
  `id_cine` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Compras` (
  `id_compra` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `precio` int(11) NOT NULL,
  `cantidad` smallint(6) NOT NULL,
  `descuento` tinyint(4) NOT NULL,
  `total` float NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Entradas` (
  `id_entrada` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_funcion` int(11) NOT NULL,
  `qr` varchar(255) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Funciones` (
  `id_funcion` int(11) NOT NULL,
  `id_cine` int(11) NOT NULL,
  `id_sala` int(11) NOT NULL,
  `id_pelicula` int(11) NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Generos` (
  `id_genero` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Peliculas` (
  `id_pelicula` int(11) NOT NULL,
  `id_TMDB` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `duracion` int(11) DEFAULT NULL,
  `descripcion` varchar(1024) NOT NULL,
  `idioma` varchar(50) NOT NULL,
  `clasificacion` tinyint(1) NOT NULL,
  `fechaDeEstreno` date NOT NULL,
  `poster` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `popularidad` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `PeliculasXGeneros` (
  `id_peliculasxgeneros` int(11) NOT NULL,
  `id_pelicula` int(11) NOT NULL,
  `id_genero` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Salas` (
  `id_sala` int(11) NOT NULL,
  `id_cine` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `precio` int(11) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Usuarios` (
  `id_usuario` int(11) NOT NULL,
  `dni` int(11) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `rol` tinyint(1) NOT NULL,
  `ip` varchar(32) DEFAULT NULL,
  `registerDate` int(11) DEFAULT NULL,
  `lastConnection` int(11) DEFAULT NULL,
  `loggedIn` tinyint(1) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL,
  `facebookId` bigint(64) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `Cines`
  ADD PRIMARY KEY (`id_cine`),
  ADD UNIQUE KEY `UNQ_nombre` (`nombre`);

ALTER TABLE `Compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `FK_id_usuario` (`id_usuario`);

ALTER TABLE `Entradas`
  ADD PRIMARY KEY (`id_entrada`),
  ADD KEY `FK_id_compraa` (`id_compra`),
  ADD KEY `FK_id_funcionn` (`id_funcion`);

ALTER TABLE `Funciones`
  ADD PRIMARY KEY (`id_funcion`),
  ADD KEY `FK_id_cine` (`id_cine`),
  ADD KEY `FK_id_pelicula` (`id_pelicula`),
  ADD KEY `FK_id_sala` (`id_sala`);

ALTER TABLE `Generos`
  ADD PRIMARY KEY (`id_genero`);

ALTER TABLE `Peliculas`
  ADD PRIMARY KEY (`id_pelicula`);

ALTER TABLE `PeliculasXGeneros`
  ADD PRIMARY KEY (`id_peliculasxgeneros`),
  ADD KEY `FK_id_pelicula` (`id_pelicula`) USING BTREE,
  ADD KEY `FK_id_genero` (`id_genero`) USING BTREE;

ALTER TABLE `Salas`
  ADD PRIMARY KEY (`id_sala`),
  ADD UNIQUE KEY `unq_nombre` (`nombre`),
  ADD KEY `FK_id_cinee` (`id_cine`);

ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `UNQ_email` (`email`),
  ADD UNIQUE KEY `UNQ_dni` (`dni`) USING BTREE;


ALTER TABLE `Cines`
  MODIFY `id_cine` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Entradas`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Funciones`
  MODIFY `id_funcion` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Peliculas`
  MODIFY `id_pelicula` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `PeliculasXGeneros`
  MODIFY `id_peliculasxgeneros` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Salas`
  MODIFY `id_sala` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `Usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `Compras`
  ADD CONSTRAINT `FK_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Entradas`
  ADD CONSTRAINT `FK_id_compraa` FOREIGN KEY (`id_compra`) REFERENCES `Compras` (`id_compra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_id_funcionn` FOREIGN KEY (`id_funcion`) REFERENCES `Funciones` (`id_funcion`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Funciones`
  ADD CONSTRAINT `FK_id_cine` FOREIGN KEY (`id_cine`) REFERENCES `Cines` (`id_cine`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_id_pelicula` FOREIGN KEY (`id_pelicula`) REFERENCES `Peliculas` (`id_pelicula`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_id_sala` FOREIGN KEY (`id_sala`) REFERENCES `Salas` (`id_sala`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `PeliculasXGeneros`
  ADD CONSTRAINT `FK_id_generoo` FOREIGN KEY (`id_genero`) REFERENCES `Generos` (`id_genero`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_id_peliculaa` FOREIGN KEY (`id_pelicula`) REFERENCES `Peliculas` (`id_pelicula`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `Salas`
  ADD CONSTRAINT `FK_id_cinee` FOREIGN KEY (`id_cine`) REFERENCES `Cines` (`id_cine`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
