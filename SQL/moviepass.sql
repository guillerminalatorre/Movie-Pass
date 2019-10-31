-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 30, 2019 at 05:18 PM
-- Server version: 5.7.27-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviepass`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cines`
--

CREATE TABLE `Cines` (
  `id_cine` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `precio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Cines`
--

INSERT INTO `Cines` (`id_cine`, `nombre`, `direccion`, `capacidad`, `precio`) VALUES
(1, 'Ambassador', 'Cordoba 2551', 300, 150),
(2, 'Aldrey', 'Sarmiento 2685', 500, 180),
(3, 'Los Gallegos', 'Rivadavia 3050', 250, 150);

-- --------------------------------------------------------

--
-- Table structure for table `Compras`
--

CREATE TABLE `Compras` (
  `id_compra` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_funcion` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cantidad` smallint(6) NOT NULL,
  `descuento` tinyint(4) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Funciones`
--

CREATE TABLE `Funciones` (
  `id_funcion` int(11) NOT NULL,
  `id_cine` int(11) NOT NULL,
  `id_pelicula` int(11) NOT NULL,
  `fechaHora` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Funciones`
--

INSERT INTO `Funciones` (`id_funcion`, `id_cine`, `id_pelicula`, `fechaHora`) VALUES
(1, 1, 1, '2019-10-29 00:27:40'),
(2, 2, 1, '2019-10-29 20:36:14'),
(4, 2, 1, '2019-11-01 00:27:40'),
(10, 3, 2, '2019-10-29 09:45:00'),
(11, 3, 5, '2019-10-30 09:46:00'),
(12, 1, 6, '2019-10-30 09:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `Generos`
--

CREATE TABLE `Generos` (
  `id_genero` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Generos`
--

INSERT INTO `Generos` (`id_genero`, `nombre`) VALUES
(12, 'Aventura'),
(14, 'Fantasía'),
(16, 'Animación'),
(18, 'Drama'),
(27, 'Terror'),
(28, 'Acción'),
(35, 'Comedia'),
(36, 'Historia'),
(37, 'Western'),
(53, 'Suspense'),
(80, 'Crimen'),
(99, 'Documental'),
(878, 'Ciencia ficción'),
(9648, 'Misterio'),
(10402, 'Música'),
(10749, 'Romance'),
(10751, 'Familia'),
(10752, 'Bélica'),
(10770, 'Película de TV');

-- --------------------------------------------------------

--
-- Table structure for table `Peliculas`
--

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
  `popularidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Peliculas`
--

INSERT INTO `Peliculas` (`id_pelicula`, `id_TMDB`, `titulo`, `duracion`, `descripcion`, `idioma`, `clasificacion`, `fechaDeEstreno`, `poster`, `video`, `popularidad`) VALUES
(1, 475557, 'Joker', 122, 'Arthur Fleck es un hombre ignorado por la sociedad, cuya motivación en la vida es hacer reír. Pero una serie de trágicos acontecimientos le llevarán a ver el mundo de otra forma. Película basada en Joker, el popular personaje de DC Comics y archivillano de Batman, pero que en este film toma un cariz más realista y oscuro.', 'en', 0, '2019-10-02', 'https://image.tmdb.org/t/p/w500/v0eQLbzT6sWelfApuYsEkYpzufl.jpg', 'c5QLnApJX5o', 9),
(2, 420809, 'Maléfica: Maestra del Mal', 118, 'Secuela de \"Maléfica\" que cuenta la vida de Maléfica y Aurora, así como las alianzas que formarán para sobrevivir a las amenazas del mágico mundo en el que habitan.', 'en', 0, '2019-10-16', 'https://image.tmdb.org/t/p/w500/eZOkXqHXWCKytd78TggAtJ0M3gU.jpg', 'qiL0QbKE69s', 7),
(3, 338967, 'Zombieland: Mata y remata', 99, 'En esta secuela y empleando el característico sentido del humor del que hizo gala \"Zombieland\", el grupo de protagonistas tendrá que viajar desde la Casa Blanca hasta el corazón de los Estados Unidos, sobreviviendo a nuevas clases de muertos vivientes que han evolucionado desde lo sucedido hace algunos años, así como a algunos supervivientes humanos rezagados. Pero, por encima de todo, tendrán que tratar de soportar los inconvenientes de convivir entre ellos.', 'en', 0, '2019-10-09', 'https://image.tmdb.org/t/p/w500/fIkRmyo1UPlwM9zEVfs5QqevmuI.jpg', 'e3LV7ei2804', 7),
(4, 453405, 'Géminis', 117, 'Un asesino a sueldo, demasiado mayor, decide retirarse. Pero esto no le va a resultar tan fácil, pues tendrá que enfrentarse a un clon suyo, mucho más joven.', 'en', 0, '2019-10-02', 'https://image.tmdb.org/t/p/w500/gJpbw3pVCAKksp1LgsTGW7c8SFV.jpg', NULL, 6),
(5, 417384, 'Historias de miedo para contar en la oscuridad', 103, 'Un grupo de adolescentes debe resolver el misterio que rodea a una serie de repentinas y macabras muertes que suceden en su pueblo. Producida por Guillermo del Toro.', 'en', 0, '2019-08-08', 'https://image.tmdb.org/t/p/w500/lfmxj0BZuTlwahHB3AEMqvjygef.jpg', NULL, 6),
(6, 515195, 'Yesterday', 125, 'Ayer todo el mundo conocía a Los Beatles. Hoy Jack (Himesh Patel) es el único que recuerda sus canciones. Este músico que malvive en una pequeña localidad costera de Inglaterra, se ha resignado a renunciar a sus sueños. Pero tras un misterioso apagón en todo el mundo, se despierta en una línea de tiempo alternativa donde nunca existieron Los Beatles. Entonces será su oportunidad de hacerse inmensamente famoso al ritmo de las míticas canciones del cuarteto de Liverpool, eso sí, se arriesgará a perder a Ellie (Lily James), su musa y el amor de su vida.', 'en', 0, '2019-06-27', 'https://image.tmdb.org/t/p/w500/b8VhTJxAitF5ynjosPuqEAQvdlg.jpg', NULL, 7),
(7, 530385, 'Midsommar', 148, 'Una joven pareja y sus amigos viajan a Hårga, situado en Hälsingland, una provincia de Suecia, para visitar la ciudad rural de uno de ellos y asistir a su festival de solsticio de verano. Lo que comienza como un retiro idílico desciende rápidamente en una competencia cada vez más violenta y extraña a manos de un culto pagano.', 'en', 0, '2019-07-03', 'https://image.tmdb.org/t/p/w500/93uHy4f6PXJaEtAhBEV47AeyhnR.jpg', '1Vnghdsjmd0', 7),
(8, 419706, 'Mary', NULL, '', 'en', 0, '2019-09-19', 'https://image.tmdb.org/t/p/w500/cdcyHzqqBrzPGJFVH29ONnzsV6I.jpg', NULL, 6),
(9, 633154, 'Rosita', 96, 'Lola vuelve a casa, donde dejó a sus hijos Alejo, Gustavo y Rosita al cuidado de Omar, el abuelo materno. Pero los niños le cuentan que Omar salió con Rosita, y ella no puede encontrarlos. En las primeras horas de angustia, Lola descubre aspectos muy oscuros del pasado de su padre, decide confrontarlo y vuelve con la niña al día siguiente: ¿qué sucedió con Rosita mientras estuvo fuera de casa? ¿Qué hizo Omar con ella, y por qué está escapando de la policía?', 'es', 0, '2019-10-17', 'https://image.tmdb.org/t/p/w500/rSW6LL10XgeE7AVtqJJofUzb17A.jpg', NULL, 0),
(10, 630213, 'Karaoke Bowie', 4, 'Karaoke Bowie es un video karaoke a partir de la  canción \"Heroes\" de David Bowie. El Karaoke reproduce un texto (editado) de Hito Steyerl cuestionando el uso de la imagen de Bowie. ', 'es', 0, '2019-10-15', 'https://image.tmdb.org/t/p/w500/ey2Eq7CFysYwdUlDhmd18uhcxPC.jpg', NULL, 0),
(11, 563314, 'Nervio', 12, 'Un zoom en retroceso lentísimo con dos planos diferentes, uno general y otro más cercano de unas imágenes de super 8 veraniegas, unidas por el nervio que separa un fotograma del siguiente. La ampliación de ese marco oscuro mientras las dos imágenes también siguen en movimiento, crea una tensión que otorga sentido a ese nervio que no percibimos a una velocidad normal de visionado. Este fue el primer proyecto inacabado de la sesión.', 'xx', 0, '2019-10-15', 'https://image.tmdb.org/t/p/w500/kbF8n96d6wdLptneH20WPY14sHE.jpg', NULL, 0),
(12, 630603, '¿Para qué sirve un zeide?', 16, '‘Zeide’ es la denominación yiddish para “abuelo”. Ilan Serruya nos sumerge en un viaje al pasado\r y las raíces familiares a través de una celebración captada en precario formato doméstico para\r dejarnos entrever un mapa de afectos y de relatos personales.', 'es', 0, '2019-10-15', 'https://image.tmdb.org/t/p/w500/7P7IHoSjV35SGuVSy5wwb9pNVHl.jpg', NULL, 0),
(13, 630204, 'New Dimensions of Dialogue', 11, 'Cada película esconde una segunda película secreta, pero que para poder verla, es necesario un movimiento que se produzca en una dirección que no esté contenida en la película original. Una suerte de desdoblamiento o \"doble visión\" para acceder a la siguiente dimensión.', 'xx', 0, '2019-10-15', 'https://image.tmdb.org/t/p/w500/rTnKeMyT4akdvjJOVL5geYeHdar.jpg', NULL, 0),
(14, 640813, '¿Yo te gusto?', 78, 'Nati, vive con sus padres y su hermano Seba en un barrio marginal. Nati y Seba trabajan haciendo repartos en el bar de su madre y pasan el tiempo con un grupo de amigos que se gana la vida cometiendo delitos menores. Cuando Nati descubre que sus padres tienen una deuda que no pueden pagar, intenta unirse a los hombres de la banda para conseguir el dinero.', 'es', 0, '2019-10-24', 'https://image.tmdb.org/t/p/w500/acxGPOsAyeUVZgVokS2KUzW9CKw.jpg', 'oEKAlnK9oDc', 0),
(15, 614601, 'El rocío', 79, 'Sara y su hija Olivia viven en una zona rural de Entre Ríos. Cuando la niña empieza a presentar problemas con su salud, causados por los pesticidas de los campos, el médico le sugiere viajar a Buenos Aires para realizarse estudios. Para poder costear el viaje, Sara aceptará transportar drogas hacia la ciudad.', 'es', 0, '2019-10-24', 'https://image.tmdb.org/t/p/w500/qOiBm1X2Fr4MfUC9HbDofQnvfis.jpg', NULL, 0),
(16, 638955, '中孚 61. La verdad interior', 68, 'Desde el inicio al fin, tantos los paisajes filmados como los interiores de una cabaña, así como el sistema de registro empleado pertenecen al universo simbólico del protagonista excluyente de este retrato, James Benning, quizás el cineasta que más lejos haya llegado en el aprovechamiento del poder observacional que detenta una cámara. Al respecto, Benning expresará su credo sobre la observación como un método insustituible para conocer el mundo circundante y la vida de los otros, aun más allá del lenguaje, lo que explica en parte la afinidad anímica y la fluidez comunicacional entre el cineasta nacido en 1942 y la actriz argentina devenida en cineasta nacida en 1983, quien apenas puede hablar en inglés. Una entrevista, algunos paseos y la preparación de una película de Benning sobre Brito y la de la propia actriz sobre el cineasta revelan las ideas del maestro sobre el tiempo, la libertad, la justicia, la soledad, la cultura y la política estadounidenses. - Roger Koza', 'es', 0, '2019-10-12', 'https://image.tmdb.org/t/p/w500/2bSFRQzBhaWABIBBgXoxoGoHmZS.jpg', NULL, 0),
(17, 630849, 'Todo por el ascenso', 80, 'Néstor es extremadamente supersticioso. Este año, su equipo, se juega el ascenso en Mendoza y se dispone a viajar con Rafa, su amigo. Pero aparece Fabián, un piedra, un mufa, un desgraciado para el fútbol. El ascenso está en peligro, a menos que puedan evitar que el Fabián llegue a la cancha.', 'es', 0, '2019-09-12', 'https://image.tmdb.org/t/p/w500/m2RqyjDP6YSOKtPn43Y034pAQAX.jpg', NULL, 7),
(18, 630343, 'El Juego de las Llaves', 600, '', 'es', 0, '2019-09-18', 'https://image.tmdb.org/t/p/w500/uMuw1IX9yT6JUHcd1CaeXw6cxxg.jpg', NULL, 8),
(19, 621268, 'Así habló el cambista', 97, 'Durante los años 70, la economía de la región atrajo a muchos oportunistas a Uruguay. Las instituciones estaban en bancarrota; había un gobierno militar; los subversivos estaban tras las rejas y, para los sectores de baja reputación de las economías de Brasil y Argentina, el mercado financiero uruguayo parecía el lugar ideal para hacer desaparecer el dinero. Así es como Humberto Brause comienza una meteórica carrera en la compra y venta de divisas extranjeras, patrocinado por su propio suegro, un veterano en el negocio de la fuga de capitales. Ciego por su excesiva ambición, Humberto se lleva por delante a todo aquel que se cruce en su camino. Consigue hacerse cargo del negocio familiar y acepta una sospechosa tarea: lavar la cantidad de dinero más grande que ha visto en su vida.', 'es', 0, '2019-09-26', 'https://image.tmdb.org/t/p/w500/dUwpZl6QJUFoqkhEcu10Hzbd5Bn.jpg', NULL, 0),
(20, 629522, 'La sombra del gallo', 100, 'Tras la muerte de su padre, el ex policía Román Maidana retorna al pueblo de su infancia que se encuentra atravesado por la reciente desaparición de una adolescente. Mientras enfrenta el duelo, se encuentra teniendo visiones de una joven que lo alienta a desarmar un grupo criminal que está relacionado con la trata de mujeres.', 'es', 0, '2019-10-10', '/TP-Metodologia/Uploads/la-sombra-del-gallo.jpg', 'CbX3ovj4bAk', 0),
(21, 290859, 'Terminator: Destino Oscuro', 120, 'Sarah Connor une todas sus fuerzas con una mujer cyborg para proteger a una joven de un extremadamente poderoso y nuevo Terminator.', 'en', 0, '2019-10-23', 'https://image.tmdb.org/t/p/w500/xGecvRFG8vBQewLAqoNzVSYIdVr.jpg', 'TwKkavM9VeE', 7),
(22, 449924, 'Ip Man 4', 0, '', 'cn', 0, '2019-10-18', 'https://image.tmdb.org/t/p/w500/mAWBfTDAmfpvQGMVFuzuVl49N1P.jpg', NULL, 6),
(23, 559969, 'El Camino: Una película de Breaking Bad', 123, 'Tiempo después de los eventos sucedidos tras el último episodio de la serie \"Breaking Bad\", el fugitivo Jesse Pinkman huye de sus perseguidores, de la ley y de su pasado.', 'en', 0, '2019-10-11', 'https://image.tmdb.org/t/p/w500/hoWADuvXs3Ua4AXBAiZYnppTupO.jpg', NULL, 7),
(24, 454640, 'Angry Birds 2: La película', 96, 'Vuelven a la carga Red, el pájaro de color rojo con problemas de mal genio, y sus amigos Chuck, el pájaro amarillo hiperactivo, y Bomb, el pájaro negro muy volátil. En esta segunda parte, los pájaros protagonistas y los intrigantes cerdos de color verde llevarán su conflicto a un nuevo nivel. Y es que, aparecerá una nueva y malvada villana: Zeta, un pájaro que vive en una isla helada. Cuando Zeta lance una bola de hielo sobre la isla en la que se encuentran Red y compañía, nuestros protagonistas tendrán que hacer frente a esta nueva amenaza.', 'en', 0, '2019-08-02', 'https://image.tmdb.org/t/p/w500/xfgMVop9eZ3sP1Qpx9nW5jLKUrJ.jpg', NULL, 7),
(25, 568012, 'One Piece: Stampede', 101, 'La película tiene lugar durante la Pirates Expo, \"hecha por piratas para piratas\", donde los piratas de todo el mundo, incluidos algunos de sus personajes más infames, se unen a la búsqueda de un gran tesoro para encontrar un tesoro perdido, esta vez el tesoro. Perteneció nada menos que a Gold Roger!', 'ja', 0, '2019-08-09', 'https://image.tmdb.org/t/p/w500/suPfemWGPk8xOePePITOhg1C5EP.jpg', NULL, 8),
(26, 474350, 'It Capítulo 2', 169, '27 años después, los ex-miembros del Club de los Perdedores, que crecieron y se mudaron lejos de Derry, vuelven a unirse tras una devastadora llamada telefónica.', 'en', 0, '2019-09-04', 'https://image.tmdb.org/t/p/w500/9oERKIVyTWpHNum3STVsAGD4ojz.jpg', 'zh9-9_CeQEc', 7),
(27, 458156, 'John Wick: Capítulo 3 - Parabellum', 131, 'John Wick (Keanu Reeves) regresa a la acción, solo que esta vez con una recompensa de 14 millones de dólares sobre su cabeza y con un ejército de mercenarios intentando darle caza. Tras asesinar a uno de los miembros del gremio de asesinos al que pertenecía, Wick es expulsado de la organización, pasando a convertirse en el centro de atención de multitud de asesinos a sueldo que esperan detrás de cada esquina para tratar de deshacerse de él.', 'en', 0, '2019-05-15', 'https://image.tmdb.org/t/p/w500/aKw7oqYdfn4pkKYvp18Gd1YhK6m.jpg', 'F4_o_Ci6o7E', 7),
(28, 481084, 'La familia Addams', 86, 'Película de animación basada en la serie de La familia Addams.', 'en', 0, '2019-10-10', 'https://image.tmdb.org/t/p/w500/307Y96L1iJ6gujCfuGPWNTqgbBd.jpg', 'xUAUk00Vxq4', 6),
(29, 578189, 'Black and Blue', 109, '', 'en', 0, '2019-10-25', 'https://image.tmdb.org/t/p/w500/fjmMu9fpqMMF17mCyLhNfkagKB0.jpg', NULL, 6),
(30, 428045, 'The Mystery of the Dragon’s Seal', 121, '', 'ru', 0, '2019-08-16', 'https://image.tmdb.org/t/p/w500/hi7WQseemJ3mW1Iz29JSgI4FK0l.jpg', NULL, 5),
(31, 599975, 'Countdown', 90, '', 'en', 0, '2019-10-25', 'https://image.tmdb.org/t/p/w500/qCDPKUMX5xrxxQY8XhGVCKO3fks.jpg', NULL, 6),
(32, 496243, 'Parásitos', 132, 'Tanto Gi Taek (Song Kang Ho) como su familia están sin trabajo. Cuando su hijo mayor, Gi Woo (Choi Woo Shik), empieza a recibir clases particulares en casa de Park (Lee Sun Gyun), las dos familias, que tienen mucho en común pese a pertenecer a dos mundos totalmente distintos, comienzan una interrelación de resultados imprevisibles.', 'ko', 0, '2019-05-30', 'https://image.tmdb.org/t/p/w500/zHk9i6yFodI6fJPbY85z9HURNnQ.jpg', NULL, 9),
(33, 466272, 'Érase una Vez en... Hollywood', 165, '“Érase una vez en… Hollywood” de Quentin Tarantino, nos lleva a Los Angeles de 1969, donde todo está cambiando, y donde la estrella de la televisión Rick Dalton (Leonardo DiCaprio), y Cliff Booth (Brad Pitt), su doble de muchos años, se abren camino en una industria que ya prácticamente no reconocen. La novena película del célebre escritor y director cuenta con amplio reparto y múltiples tramas argumentales que rinden un tributo a los momentos finales de la época dorada de Hollywood.', 'en', 0, '2019-07-25', 'https://image.tmdb.org/t/p/w500/vKSyaptSA7zZ9H8mSfaDnvyQl9k.jpg', '_mUZobwljrc', 8),
(34, 459992, 'Casi imposible', 120, 'Cuando Fred Flarsky (Seth Rogen) se reencuentra inesperadamente con el primer amor de su vida, que ahora es una de las mujeres más influyentes del mundo, Charlotte Field (Charlize Theron), logra llamar su atención gracias a su peculiar sentido del humor y a su visión idealista del mundo y de la política. Mientras se prepara para aspirar a la presidencia del país, Charlotte contrata a Fred para que sea el encargado de escribir sus discursos. Sin embargo, Fred se va a encontrar como un pez fuera del agua en el equipo de élite de Charlotte.', 'en', 0, '2019-05-02', 'https://image.tmdb.org/t/p/w500/d5SjdpTAyn0zLzJYSAJ1AzosHh8.jpg', 'JkFZ2sX9pxw', 7),
(35, 540901, 'Estafadoras de Wall Street', 107, 'Inspirado por el artículo viral de la revista New York Magazine, Hustlers sigue a un grupo de ex empleadas de un club de striptease que se unen para vengarse de sus clientes de Wall Street.', 'en', 0, '2019-09-12', 'https://image.tmdb.org/t/p/w500/di8JeI8otBrQMy6SZr4Hc3Ve3oj.jpg', '1QGDg3U8jYg', 6),
(36, 511987, 'Infierno bajo el agua', 88, 'Cuando un enorme huracán llega a su pueblo en Florida, Haley ignora las órdenes de evacuación para buscar a su padre. Tras encontrarle gravemente herido, ambos quedan atrapados por la inundación. Prácticamente sin tiempo para escapar de la tormenta que arrecia, Haley y su padre descubren que la subida del nivel del agua es el menor de sus problemas.', 'en', 0, '2019-07-11', 'https://image.tmdb.org/t/p/w500/vPCQHc1LqLEC2ozuFQngqvc2SIO.jpg', '5_MeTpr-e9A', 6),
(37, 522938, 'Rambo: Last Blood', 101, 'Cuatro décadas después, el veterano de Vietnam y paciente con TEPT (Trastorno de estrés postraumático) regresa a su rancho familiar de Arizona. John Rambo (Sylvester Stallone), uno de los mayores héroes de acción de todos los tiempos, deberá enfrentarse a su pasado y desenterrar sus despiadadas habilidades de combate para vengarse en una misión final, emprendiendo así un viaje mortal, justiciero y sin retorno.', 'en', 0, '2019-09-19', 'https://image.tmdb.org/t/p/w500/kG3pY61LWGAzcaSne12CGEeRvtg.jpg', '3WcrgWJXCHg', 6),
(38, 480105, 'A 47 metros 2', 89, 'Esta secuela de \"A 47 Metros\" traslada la mortífera acción de los tiburones desde México a Brasil, y seguirá a un grupo de chicas en busca de aventuras en la costa de Recife. Con la esperanza de salir del rutinario sendero turístico, las chicas escuchan algo acerca de unas ruinas submarinas ocultas, pero descubren que bajo las olas turquesas su Atlantis secreta no está completamente deshabitada.', 'en', 0, '2019-08-15', 'https://image.tmdb.org/t/p/w500/tWZ9tgEEpeku0hBjjHLBPHd0jXT.jpg', NULL, 6),
(39, 513045, 'Stuber Express', 105, 'La vida de un apacible conductor de Uber, Stu (Kumail Nanjiani), cambia repentinamente cuando se sube a su vehículo un pasajero (Dave Bautista) que resulta ser un policía que sigue la pista a un brutal asesino. Stu se ve obligado a luchar por salvar la vida, protagonizando una misión en la que nunca pidió participar, y cuyo principal objetivo tiene claro desde que descubre lo que está sucediendo: obtener las cinco estrellas de calificación en este movido viaje.', 'en', 0, '2019-07-11', 'https://image.tmdb.org/t/p/w500/jySe3Z0eVO1vZTrDuctt0zJWBHz.jpg', 's8PEylhZMTM', 7),
(40, 527641, 'A dos metros de ti', 116, 'Will y Stella son dos adolescentes que padecen fibrosis quística y están ingresados en el hospital para tratarse. Aunque ambos tratan de refugiarse en su propio mundo, de forma inevitable acaban enamorándose. La pareja deberá luchar para mantener viva su relación, con una única regla: separarse con una distancia de alrededor de dos metros para evitar que ambos se puedan contagiar. Sin embargo, la vida de ambos estará en peligro.', 'en', 0, '2019-03-15', 'https://image.tmdb.org/t/p/w500/3ZNKu4TfGgACD1D3kibI5Pgmqe4.jpg', 'vWhX8aTj5TI', 8),
(41, 419704, 'Ad Astra', 124, 'El astronauta Roy McBride (Brad Pitt) viaja a los límites exteriores del sistema solar para encontrar a su padre perdido y desentrañar un misterio que amenaza la supervivencia de nuestro planeta. Su viaje desvelará secretos que desafían la naturaleza de la existencia humana y nuestro lugar en el cosmos.', 'en', 0, '2019-09-17', 'https://image.tmdb.org/t/p/w500/wcTICyta60bfwGs01y0meHQuKpP.jpg', NULL, 6),
(42, 603, 'Matrix', 138, 'Thomas Anderson lleva una doble vida: por el día es programador en una importante empresa de software, y por la noche un hacker informático llamado Neo. Su vida no volverá a ser igual cuando unos misteriosos personajes le inviten a descubrir la pregunta que no le deja dormir: ¿qué es Matrix?', 'en', 0, '1999-03-30', 'https://image.tmdb.org/t/p/w500/ejmTPNAkgZaVJ4AI9zb9SehAYU0.jpg', 'nL5kq0rfbBk', 8),
(43, 431580, 'Abominable', 92, 'Yi es una adolescente más en la enorme ciudad de Shanghai. Un día, se encuentra a un joven yeti en la azotea de su edificio. La supuestamente “abominable” criatura, que se ha escapado del laboratorio donde estaba encerrado, está siendo buscada por toda la ciudad. Junto con sus ingeniosos amigos Jin y Peng, Yi decide ayudarle a huir, le bautizan como “Everest” y los cuatro se embarcan en una épica aventura para reunir a la mítica criatura con su familia en el pico más alto del mundo.', 'en', 0, '2019-09-19', 'https://image.tmdb.org/t/p/w500/gp7d1OGYpBGyG5E6fr1fMi01bvK.jpg', NULL, 7),
(44, 487680, 'The Kitchen', 104, 'Años 70. Las esposas de un grupo de mafiosos de Nueva York continúan con los negocios de sus maridos después de que estos sean encarcelados.', 'en', 0, '2019-08-08', 'https://image.tmdb.org/t/p/w500/l3smhHvnczXg8E2WzysRVKIXSYJ.jpg', NULL, 6),
(45, 517909, 'The Laundromat: Dinero sucio', 95, 'Una viuda (Meryl Streep) investiga un fraude al seguro. Todas las pistas conducen a dos abogados de Ciudad de Panamá (Gary Oldman y Antonio Banderas) que se benefician de las lagunas del sistema financiero mundial.... Película sobre los llamados \"papeles de Panamá\", investigación periodística del 2017 en la que tras un filtración de un despacho de abogados se desveló que importantes personalidad mundiales tenían patrimonio no declarado en bancos de Panamá, paraíso fiscal.', 'en', 0, '2019-09-05', 'https://image.tmdb.org/t/p/w500/hwNMJgbiUUvPCxsnADjbV9ysM5j.jpg', NULL, 6),
(46, 535581, 'Los muertos no mueren', 103, 'En la pacífica localidad de Centerville pasa algo raro. Los animales se empiezan a comportar de forma extraña, las horas de luz solar cambian de forma impredecible y la luna vigila permanentemente desde el horizonte. Los científicos están preocupados y los informativos dan noticias desconcertantes. Y es que, una extraña invasión está a punto de suceder en la que los muertos ya no está muertos y se levantarán de sus tumbas. Los habitantes de Centerville, liderados por Ronald Peterson y Cliff Robertson, deberán detener esta amenaza y luchar para sobrevivir.', 'en', 0, '2019-05-15', 'https://image.tmdb.org/t/p/w500/rYVKIiyE6vK2riNTPtk1XKWejvJ.jpg', 'teOGqx26lBA', 6),
(81, 505060, 'La Horca 2', 99, 'Aune Rue, una adolescente vloguera que aspira a convertirse en actriz, se conecta en una página web de aspecto siniestro y acaba viéndose atrapada en el malévolo mundo de una obra teatral maldita llamada \"The Gallows\". Tras realizar un pequeño fragmento de la misma para su grupo de fans, Auna alcanza inmediatamente el estrellato que siempre había buscado, como también captar la atención de un espíritu mortífero, \"The Hangman\".', 'en', 0, '2019-10-25', 'https://image.tmdb.org/t/p/w500/h2OCcYwUGqSBvqHjE3QBtTNeKXY.jpg', NULL, 6),
(82, 521029, 'Annabelle vuelve a casa', 115, 'Annabelle Vuelve a Casa es la tercera entrega de la saga \"Annabelle\" de New Line Cinema, protagonizada por la infame y siniestra muñeca del universo \"Expediente Warren\".  Los demonólogos Ed y Lorraine Warren están decididos a evitar que Annabelle cause más estragos, así que llevan a la muñeca poseída a la sala de objetos bajo llave que tienen en su casa. La colocan \"a salvo\" en una vitrina sagrada bendecida por un sacerdote. Pero una terrorífica noche nada santa, Annabelle despierta a los espíritus malignos de la habitación que se fijan un nuevo objetivo: la hija de diez años de los Warren, Judy, y sus amigas.', 'en', 0, '2019-06-26', 'https://image.tmdb.org/t/p/w500/zxwPksbRKGaAi06rapPfFTVsMHv.jpg', '1VTnFrWGD-w', 6),
(83, 484641, 'Anna', 119, 'Bajo la hipnotizante belleza de Anna Poliatova yace un secreto que le permite desatar una imparable agilidad y fuerza y convertirse en una de las asesinas más temidas por los gobiernos del mundo.', 'fr', 0, '2019-06-19', 'https://image.tmdb.org/t/p/w500/Ai4mWR2wHh6jemkzu6CI49Zxsw4.jpg', NULL, 6),
(84, 522924, 'El arte de vivir bajo la lluvia', 109, 'El argumento está basado en la novela publicada por Garth Stein, la cual responde al mismo nombre que el filme. La historia combina diferentes sentimientos y situaciones comprometidas para la sociedad como son el dolor, la liberación, el cariño o el riesgo. Enzo, un perro que ha experimentado muchas aventuras interesantes a lo largo de su vida, es el personaje que pone voz a la película. Pese a no ser una persona de carne y hueso, este entrañable animal será capaz de dar diferentes lecciones a los seres humanos sobre cuál tendría que ser la manera adecuada de actuar sea cual sea la situación en la que se encuentren.', 'en', 0, '2019-08-08', 'https://image.tmdb.org/t/p/w500/10DEBjRtAH7ocGHYufecnGZOEq0.jpg', NULL, 8),
(85, 456740, 'Hellboy', 125, 'La Agencia para la Investigación y Defensa Paranormal (AIDP) encomienda a Hellboy la tarea de derrotar a un espíritu ancestral: Nimue, conocida como \"La Reina de la Sangre\". Nimue fue la amante del mismísimo Merlín durante el reinado del Rey Arturo, de él aprendió los hechizos que la llevaron a ser una de las brujas más poderosas… Pero la locura se apoderó de ella y aprisionó al mago para toda la eternidad. Hace siglos consiguieron acabar con esta villana, enterrándola profundamente, pero ha vuelto de entre los muertos con la intención de destruir a la humanidad con su magia negra.  Nueva película basada en el cómic \"Hellboy\" de Mike Mignola, que tendrá calificación R y se desmarcará de los films de Guillermo del Toro.', 'en', 0, '2019-04-10', 'https://image.tmdb.org/t/p/w500/tNSpy125u15oQ9EOsDLzmMSvvub.jpg', '-y41bDJa32w', 5),
(86, 480001, 'The Art of Self-Defense', 104, 'Un hombre que es atacado mientras camina solo por la calle (Jesse Eisenberg) decide apuntarse en un dojo de karate, donde un peculiar y carismático maestro (Alessandro Nivola) le enseña mucho más que a defenderse a sí mismo.', 'en', 0, '2019-07-12', 'https://image.tmdb.org/t/p/w500/2yzkRUONrJV4jNj6FSEZBNRCzvC.jpg', NULL, 7),
(87, 503919, 'The Lighthouse', 110, 'Gira en torno al personaje de Old, un envejecido farero del estado norteamericano de Maine de principios del siglo XX.', 'en', 0, '2019-10-18', 'https://image.tmdb.org/t/p/w500/3nk9UoepYmv1G9oP18q6JJCeYwN.jpg', 'IuKoSN594MI', 8),
(88, 540158, 'High Strung Free Dance', 103, '', 'en', 0, '2018-09-13', 'https://image.tmdb.org/t/p/w500/2PKXkTik1sOICveKTNh6BspD5Xj.jpg', NULL, 7),
(89, 611748, 'Housefull 4', 142, '', 'hi', 0, '2019-10-25', 'https://image.tmdb.org/t/p/w500/aCJOZzWV6cpZ9p9tmfEzXq4EqN8.jpg', NULL, 8),
(90, 423204, 'Objetivo: Washington D.C.', 114, 'Tras las amenazas a la Casa Blanca y Londres, esta vez el objetivo a batir es el agente del Servicio Secreto de Estados Unidos Banning (Gerard Butler), quien se ha ganado muchos enemigos al haber frustrado los diferentes planes terroristas hasta ahora.', 'en', 0, '2019-08-21', 'https://image.tmdb.org/t/p/w500/hCfKCVrBs2r2gb5hz9E0Oysc9i9.jpg', 'AJBjwU66Z3c', 6),
(91, 520901, 'Doom: aniquilación', 97, 'Sigue a un grupo de marines espaciales que responden a una llamada de socorro desde una luna de Marte. Cuando llegan allí, descubren que criaturas demoníacas han tomado el control de la zona y amenazan con llevar el Infierno a la Tierra. Nueva película basada en la saga de videojuegos “Doom”.', 'en', 0, '2019-09-30', 'https://image.tmdb.org/t/p/w500/g78vTiPcIGgpLHG7gktEg0rqF0D.jpg', 'mDF9CPwSvFA', 4),
(92, 530382, 'El Lado Siniestro de la Luna', 115, 'En 1988, el oficial de la policía de Filadelfia Thomas Lockhart (Boyd Holbrook), ansioso por convertirse en detective, comienza a seguirle la pista a un asesino en serie que misteriosamente resurge cada nueve años. Cuando los crímenes del asesino empiezan a desafiar cualquier explicación científica, la obsesión por descubrir la verdad amenaza con destruir su carrera, su familia y posiblemente su cordura.', 'en', 0, '2019-09-27', 'https://image.tmdb.org/t/p/w500/nn1LVyYKASSsxEp4JCyBRYe3a27.jpg', NULL, 6),
(93, 637475, 'A Noise That Carries', 15, '', 'en', 0, '2019-10-22', 'https://image.tmdb.org/t/p/w500/2804sVWpmGCKHrK63RUVdu8LOwz.jpg', NULL, 0),
(94, 501170, 'Doctor Sueño', 152, 'Secuela del film de culto \"El resplandor\" (1980) dirigido por Stanley Kubrick y también basado en una famosa novela de Stephen King. La historia transcurre algunos años después de los acontecimientos de \"The Shining\", y sigue a Danny Torrance (Ewan McGregor), traumatizado y con problemas de ira y alcoholismo que hacen eco de los problemas de su padre Jack, que cuando sus habilidades psíquicas resurgen, se contacta con una niña de nombre Abra Stone, a quien debe rescatar de un grupo de viajeros que se alimentan de los niños que poseen el don de \"el resplandor\".', 'en', 0, '2019-10-30', 'https://image.tmdb.org/t/p/w500/spw3MXaAK44lLVqZLKVYSlfHYtD.jpg', NULL, 7),
(95, 694, 'El resplandor', 146, 'Jack Torrance se traslada, junto a su mujer y a su hijo, al impresionante hotel Overlook, en Colorado, para encargarse del mantenimiento del mismo durante la temporada invernal, en la que permanece cerrado y aislado por la nieve. Su idea es escribir su novela al tiempo que cuida de las instalaciones durante esos largos y solitarios meses de invierno, pero desde su llegada al hotel, Jack comienza a padecer inquietantes transtornos de personalidad, al mismo tiempo que en el lugar comienzan a suceder diversos fenómenos paranormales.', 'en', 0, '1980-05-22', 'https://image.tmdb.org/t/p/w500/p9hqo2JWhBytLxskz4FBKcP2e1k.jpg', 'A3q03BBwMp4', 8);

-- --------------------------------------------------------

--
-- Table structure for table `PeliculasXGeneros`
--

CREATE TABLE `PeliculasXGeneros` (
  `id_peliculasxgeneros` int(11) NOT NULL,
  `id_pelicula` int(11) NOT NULL,
  `id_genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PeliculasXGeneros`
--

INSERT INTO `PeliculasXGeneros` (`id_peliculasxgeneros`, `id_pelicula`, `id_genero`) VALUES
(1, 1, 80),
(2, 1, 53),
(3, 1, 18),
(4, 2, 14),
(5, 2, 12),
(6, 2, 10751),
(7, 3, 27),
(8, 3, 28),
(9, 3, 35),
(10, 4, 28),
(11, 4, 53),
(12, 5, 27),
(13, 5, 53),
(14, 6, 35),
(15, 6, 10402),
(16, 6, 10749),
(17, 6, 14),
(18, 7, 27),
(19, 7, 18),
(20, 7, 53),
(21, 7, 9648),
(22, 8, 27),
(23, 8, 18),
(24, 9, 18),
(25, 14, 53),
(26, 14, 18),
(27, 17, 35),
(28, 19, 35),
(29, 19, 18),
(30, 20, 53),
(31, 20, 18),
(32, 21, 28),
(33, 21, 878),
(34, 22, 28),
(35, 22, 18),
(36, 22, 36),
(37, 23, 80),
(38, 23, 18),
(39, 23, 53),
(40, 24, 16),
(41, 24, 35),
(42, 24, 28),
(43, 24, 12),
(44, 24, 10751),
(45, 25, 16),
(46, 25, 28),
(47, 25, 12),
(48, 26, 27),
(49, 27, 28),
(50, 27, 53),
(51, 27, 80),
(52, 28, 16),
(53, 28, 35),
(54, 28, 10751),
(55, 28, 27),
(56, 28, 14),
(57, 29, 28),
(58, 29, 80),
(59, 29, 18),
(60, 30, 12),
(61, 30, 14),
(62, 31, 27),
(63, 31, 53),
(64, 32, 18),
(65, 32, 53),
(66, 32, 35),
(67, 33, 18),
(68, 33, 35),
(69, 34, 35),
(70, 34, 10749),
(71, 35, 35),
(72, 35, 80),
(73, 35, 18),
(74, 36, 53),
(75, 36, 27),
(76, 36, 28),
(77, 36, 18),
(78, 37, 28),
(79, 37, 53),
(80, 38, 53),
(81, 38, 27),
(82, 38, 12),
(83, 38, 18),
(84, 39, 28),
(85, 39, 35),
(86, 39, 53),
(87, 39, 80),
(88, 40, 10749),
(89, 40, 18),
(90, 41, 878),
(91, 41, 18),
(92, 41, 12),
(93, 42, 28),
(94, 42, 878),
(95, 43, 16),
(96, 43, 12),
(97, 43, 35),
(98, 43, 10751),
(99, 44, 80),
(100, 44, 18),
(101, 44, 28),
(102, 45, 18),
(103, 45, 80),
(104, 45, 35),
(105, 46, 35),
(106, 46, 27),
(107, 46, 14),
(185, 81, 27),
(186, 81, 53),
(187, 82, 27),
(188, 82, 53),
(189, 82, 9648),
(190, 83, 53),
(191, 83, 28),
(192, 84, 35),
(193, 84, 18),
(194, 84, 10749),
(195, 85, 28),
(196, 85, 12),
(197, 85, 14),
(198, 85, 878),
(199, 86, 35),
(200, 86, 18),
(201, 87, 14),
(202, 87, 27),
(203, 87, 18),
(204, 88, 10749),
(205, 88, 10751),
(206, 89, 35),
(207, 89, 18),
(208, 90, 28),
(209, 91, 28),
(210, 91, 878),
(211, 91, 27),
(212, 91, 9648),
(213, 92, 9648),
(214, 92, 878),
(215, 92, 53),
(216, 93, 53),
(217, 94, 27),
(218, 95, 27),
(219, 95, 53);

-- --------------------------------------------------------

--
-- Table structure for table `Usuarios`
--

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
  `facebookId` bigint(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Usuarios`
--

INSERT INTO `Usuarios` (`id_usuario`, `dni`, `password`, `email`, `apellido`, `nombre`, `rol`, `ip`, `registerDate`, `lastConnection`, `loggedIn`, `image`, `facebookId`) VALUES
(1, NULL, '680023', 'rodrii_cs@hotmail.com', 'Fanjul', 'Rodrigo', 3, '::1', 1571886736, 1572228444, 1, 'http://graph.facebook.com/1874330122626592/picture?type=square&height=200', 1874330122626592),
(2, 38831866, '1234', 'rodrii.fan@gmail.com', 'Fanjul', 'Rodrigo', 1, '::1', 1571886976, 1572387855, 1, '/TP-Metodologia/Views/img/avatar.png', NULL),
(3, 41570767, '123', 'micael15papa@gmail.com', 'Papa', 'Micael', 1, '::1', 1571959317, 1571959318, 1, '/TP-Metodologia/Views/img/avatar.png', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cines`
--
ALTER TABLE `Cines`
  ADD PRIMARY KEY (`id_cine`),
  ADD UNIQUE KEY `UNQ_nombre` (`nombre`);

--
-- Indexes for table `Compras`
--
ALTER TABLE `Compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `FK_id_usuario` (`id_usuario`),
  ADD KEY `FK_id_funcion` (`id_funcion`);

--
-- Indexes for table `Funciones`
--
ALTER TABLE `Funciones`
  ADD PRIMARY KEY (`id_funcion`),
  ADD KEY `FK_id_cine` (`id_cine`),
  ADD KEY `FK_id_pelicula` (`id_pelicula`);

--
-- Indexes for table `Generos`
--
ALTER TABLE `Generos`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indexes for table `Peliculas`
--
ALTER TABLE `Peliculas`
  ADD PRIMARY KEY (`id_pelicula`);

--
-- Indexes for table `PeliculasXGeneros`
--
ALTER TABLE `PeliculasXGeneros`
  ADD PRIMARY KEY (`id_peliculasxgeneros`),
  ADD KEY `FK_id_pelicula` (`id_pelicula`) USING BTREE,
  ADD KEY `FK_id_genero` (`id_genero`) USING BTREE;

--
-- Indexes for table `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `UNQ_email` (`email`),
  ADD UNIQUE KEY `UNQ_dni` (`dni`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Cines`
--
ALTER TABLE `Cines`
  MODIFY `id_cine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Funciones`
--
ALTER TABLE `Funciones`
  MODIFY `id_funcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Peliculas`
--
ALTER TABLE `Peliculas`
  MODIFY `id_pelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `PeliculasXGeneros`
--
ALTER TABLE `PeliculasXGeneros`
  MODIFY `id_peliculasxgeneros` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Compras`
--
ALTER TABLE `Compras`
  ADD CONSTRAINT `FK_id_funcion` FOREIGN KEY (`id_funcion`) REFERENCES `Funciones` (`id_funcion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Funciones`
--
ALTER TABLE `Funciones`
  ADD CONSTRAINT `FK_id_cine` FOREIGN KEY (`id_cine`) REFERENCES `Cines` (`id_cine`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_id_pelicula` FOREIGN KEY (`id_pelicula`) REFERENCES `Peliculas` (`id_pelicula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `PeliculasXGeneros`
--
ALTER TABLE `PeliculasXGeneros`
  ADD CONSTRAINT `FK_id_generoo` FOREIGN KEY (`id_genero`) REFERENCES `Generos` (`id_genero`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_id_peliculaa` FOREIGN KEY (`id_pelicula`) REFERENCES `Peliculas` (`id_pelicula`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
