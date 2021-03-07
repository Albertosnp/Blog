-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 01-03-2021 a las 16:44:25
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Blog_DAW`
--
CREATE DATABASE IF NOT EXISTS `Blog_DAW` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `Blog_DAW`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CATEGORIAS`
--

CREATE TABLE IF NOT EXISTS `CATEGORIAS` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `CATEGORIAS`
--

INSERT INTO `CATEGORIAS` (`id`, `name`) VALUES
(1, 'ATAQUE'),
(2, 'DEFENSA'),
(7, 'P.FISICA'),
(3, 'TRANSICIONES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ENTRADAS`
--

CREATE TABLE IF NOT EXISTS `ENTRADAS` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `date` varchar(255) NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_category` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_unique` (`title`),
  KEY `fk_user_entradas` (`id_user`) USING BTREE,
  KEY `fk_category_entradas` (`id_category`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ENTRADAS`
--

INSERT INTO `ENTRADAS` (`id`, `title`, `description`, `date`, `id_user`, `id_category`) VALUES
(1, 'DEFENSA EN ZONA Y LÍNEAS DE PASE', 'Dos equipos con el mismo número de jugadores (En el ejemplo 7 contra 7) se enfrentan con el objetivo de hacer llegar el balón al jugador de nuestro mismo equipo que está situado dentro del área del equipo contrario.\r\n\r\nEl equipo defensor basculará zonalmente en función del balón con la distancia adecuada entre jugadores para evitar que el jugador contrario situado en su área reciba el balón. El equipo atacante atacará en amplitud y moverá el balón hasta buscar el momento adecuado para el pase.\r\n\r\nLos dos equipos jugarán por fuera del área y el jugador atacante situado en el área del equipo contrario se podrá mover libremente dentro del área para recibir el balón.', '2021', 1, 2),
(2, 'Repliegues 3x5', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '2021-02-17', 2, 1),
(27, 'FARTLEK POLACO APLICADO AL FÚTBOL', 'FASE 1. CALENTAMIENTO\r\nEl calentamiento aumenta la capacidad de movimiento de nuestro cuerpo y genera calor, necesario para los músculos, ligamentos, la elasticidad de los tendones y aumenta la frecuencia cardíaca gradualmente.\r\nDurante 10 minutos aproximadamente realizaremos un buen calentamiento debido a que vamos a realizar unas tareas físicas a gran intensidad y velocidad y es necesario evitar lesiones.\r\nEl calentamiento lo estructuraremos en varias fases:\r\n · Trote ligero.\r\n · Estiramiento estático y dinámico.\r\n · Activaciones.\r\n · Carreras progresivas, parecidas a las que vamos a desarrollar aunque de menor distancia.\r\n\r\nFASE 2. VELOCIDAD\r\nRealizamos carreras con diferentes cambios de ritmo, alternados con velocidad máxima y recuperación dinámica.\r\n25 metros en sprint (100 %)\r\n25 metros trote (recuperación)\r\n50 metros en sprint (100 %)\r\n25 metros trote (recuperación)\r\n75 metros en sprint (100 %)\r\nRealizamos las siguientes distancias y series.\r\nCinco series.\r\nCada serie se compone de tres vueltas al espacio delimitado entre conos (600 metros)\r\nCada vuelta completa son 200 metros.\r\nLa distancia entre cono y cono es de 50 metros.\r\nRealizar tres minutos de recuperación, combinados con estiramientos entre serie y serie. Entre la fase de velocidad y la fase de ritmo realizaremos estiramientos de 5 a 10 minutos.', '2021-03-01', 1, 7),
(28, 'LA VUELTA A LA CALMA DEL FUTBOLISTA', '¿Para qué sirve la vuelta a la calma en el entrenamiento de fútbol?\r\nSe persigue el retorno a la normalidad fisiológica y psicológica del futbolista con el objetivo de conseguir:\r\n1. Descender la temperatura corporal\r\n2. Descender las pulsaciones (frecuencia cardíaca)\r\n3. Relajar la musculatura empleada durante el entrenamiento\r\n\r\nTareas como una carrera relajada combinada con ejercicios de estiramientos nos pueden ayudar para programar diversas formas de terminar la sesión de entrenamiento.\r\n\r\nEl tiempo recomendado para realizar la vuelta a la calma es de 5 a 20 minutos de duración.\r\n\r\n\r\nPodemos realizar gran variedad de ejercicios en la vuelta a la calma del futbolista como:\r\nTrote regenerativo.\r\nLanzamientos de penaltis.\r\nRelajación del futbolista. (Ejemplo de ejercicio de vuelta a la calma)\r\nRonda de estiramientos.\r\nJuegos recreativos para niños.\r\n“Haz siempre un esfuerzo total, aun cuando las probabilidades estén en tu contra” Arnold Palmer', '2021-03-01', 1, 7),
(29, 'FINALIZACIÓN CON OPOSICIÓN', 'Ejercicio de finalización dividido en 3 partes que se realizan sucesivamente,\r\nintentando que sea lo más dinámico posible.\r\n1. Se realiza una triangulación entre delantero y media puntas tal y como se ve en la representación gráfica. En esta acción no intervienen los  defensores.\r\n2. Seguidamente, el media punta más alejado a donde está el miembro del cuerpo técnico, va en busca del balón y realiza una pared con el extremo, centra y entra al remate, el media punta restante y el delantero contra los dos defensores.\r\n3. El extremo que ha participado en la acción anterior, recoge un balón del\r\ncuerpo técnico y realiza un cambio de orientación al otro extremo, que\r\ncontrolará y realizará un nuevo centro en el que rematarán los mimos.', '2021-03-01', 30, 1),
(30, 'CONTRAATAQUE TRAS ROBO DE BALÓN', 'Queremos trabajar que nuestro equipo defienda atrás en una zona determinada (la que nosotros fijemos) en función del rival que esta semana tenemos. El rival que tenemos enfrente este próximo partido juega en amplitud, con dominio del balón, buscando cambios de orientación y enfocando su juego a la búsqueda de espacios libres. Además se da la circunstancia de que el campo de ellos tiene unas dimensiones bastante considerables. Nuestro equipo tiene jugadores rápidos en las bandas y en punta. Para este partido jugamos con el esquema 1-4-2-3-1 y consideramos que nuestra presión, cuando ellos realicen ataque organizado, deberá comenzar un poco más adelante de medio campo y nuestra línea defensiva un poco más adelante del borde del área grande. Defendemos en zona, en función de donde este el balón y basculando el equipo en ese sentido.\r\n\r\nEste ejercicio esta enfocado para un planteamiento similar, pero lo podemos ir variando hasta alcanzar lo que nosotros busquemos y así conseguir nuestros objetivos.\r\n\r\nPara llevar este planteamiento a cabo en nuestro ejercicio, dividimos el equipo en dos partes dejando a los cuatro defensas presumiblemente titulares en el equipo que ataca en amplitud (Equipo amarillo) y resto titulares en el equipo que va a jugar a la contra (Equipo azul). El resto de los dos equipos lo completamos con jugadores de la plantilla según puestos.\r\nPara que se de esta circunstancia necesitamos que el otro equipo juegue en amplitud y tenga las únicas consignas de jugar buscando los espacios libres hasta llegar a zona de finalización y eventualmente realizar algún cambio de orientación. De este modo el equipo azul cuando robe balón deberá de llegar en pocos toques con un contraataque organizado a la portería contraria buscando rápidamente a los delanteros con cambios de orientación, triangulación o superioridad numérica.\r\n\r\nCuando el equipo azul pierda el balón deberá de realizar una presión al balón los dos jugadores más cercanos y el resto replegarse a zona defensiva.\r\n\r\nEs importante en la recuperación del balón del equipo azul una alta intensidad defensiva y coordinación en las basculaciones.', '2021-03-01', 30, 3),
(31, 'PPS. TÁCTICOS DEFENSIVOS: MARCAJES', 'Partido modificado estructurado por zonas donde se practica el marcaje individual, zonal y mixto. En zona defensiva se va a intentar hacer un marcaje individual, mientras en zona central haremos un marcaje mixto.', '2021-03-01', 1, 2),
(32, 'TRANSICIÓN 3x2 CON REPLIEGUE PARA EVITAR INFERIORIDAD', 'Oleadas de 3x3, en las que habrá siempre un defensor que deberá replegar rápidamente para evitar que el equipo atacante tenga superioridad a la hora de finalizar. Para ello, en el momento que el jugador de ataque inicia la conducción con el balón, saldrá tras él para evitar su progresión, si no consigue llegar a tiempo, deberá unirse a los dos centrales que ya estaban defendiendo la oleada', '2021-03-01', 23, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIOS`
--

CREATE TABLE IF NOT EXISTS `USUARIOS` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `type` varchar(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `USUARIOS`
--

INSERT INTO `USUARIOS` (`id`, `name`, `email`, `password`, `date`, `type`) VALUES
(1, 'a', 'a@a.com', '$2y$10$c.WuSu.Gukb/NUfURzFNR.4Ymg5Q2RKtdVId8sW4PtOTUzSP21I82', '2021-02-16', 'e'),
(2, 'alberto', 'albertosnp91@gmail.com', '$2y$10$oci4VPzJAuxU0.dXIJLJneAqvZuEzD9BAWs9Sd0texKHFlZ/IdkXO', '2021-02-17', 'c'),
(19, 'c', 'c@c.com', '$2y$10$.nugOh64akcstKxhky6lWePxt0gASIImW6NCEuACe4/DXtxjw/yre', '2021-02-17', 'c'),
(20, 'f', 'f@f.com', '$2y$10$suZNIzVb16h8XfV4Xf9Qq.Y7HHkQYVgqZkBGVunRXR626unXkbAZC', '2021-02-17', 'c'),
(23, 'e', 'e@e.com', '$2y$10$XiBPpKSnO/WauL9oNeV38.ubmc/vU/.Ynr0HmaPdRJe.PGHPyaSgy', '2021-02-17', 'c'),
(30, 'm', 'a@a.es', '$2y$10$J/wi0a7H2MQYGWomArUmUeoPBJYMy6q4dkkOszC93AciytlvHX0nK', '2021-03-01', 'c');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ENTRADAS`
--
ALTER TABLE `ENTRADAS`
  ADD CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `USUARIOS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entradas_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `CATEGORIAS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
