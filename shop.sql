-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-12-2017 a las 10:34:15
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `shop`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_CATEGORIES` ()  NO SQL
    COMMENT 'Get categories'
SELECT c.id,
       c.name
FROM categories c
ORDER BY c.name$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_CATEGORY` (IN `category_id` INT)  NO SQL
    COMMENT 'Get category'
SELECT c.id,
       c.name
FROM categories c
WHERE c.id = category_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_CATEGORY_PRODUCTS` (IN `category_id` INT)  NO SQL
    COMMENT 'Get category products'
SELECT p.id,
       p.name
FROM categories c INNER JOIN products_categories pc ON c.id = pc.category_id
                  INNER JOIN products p ON pc.product_id = p.id
WHERE c.id = category_id
ORDER BY p.name$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_PRODUCT` (IN `product_id` INT)  NO SQL
    COMMENT 'Get product'
SELECT p.id,
       p.code,
       p.name,
       p.description,
       p.image,
       p.price
FROM products p
WHERE p.id = product_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_PRODUCTS` ()  NO SQL
    COMMENT 'Get products'
SELECT p.id,
       p.code,
       p.name,
       p.description,
       p.image,
       p.price
FROM products p
ORDER BY p.name$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_PRODUCTS_BY_CATEGORY` (IN `category_id` INT)  NO SQL
    COMMENT 'Get products by category'
SELECT p.id,
       p.code,
       p.name,
       p.description,
       p.image,
       p.price
FROM products p INNER JOIN products_categories pc ON p.id = pc.product_id
WHERE pc.category_id = category_id
ORDER BY p.name$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GET_PRODUCT_CATEGORIES` (IN `product_id` INT)  NO SQL
    COMMENT 'Get product categories'
SELECT c.id,
       c.name
FROM products p INNER JOIN products_categories pc ON p.id = pc.product_id
                INNER JOIN categories c ON pc.category_id = c.id
WHERE p.id = product_id
ORDER BY c.name$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_PRODUCT` (IN `code` VARCHAR(20) CHARSET utf8, IN `name` VARCHAR(100) CHARSET utf8, IN `description` TEXT CHARSET utf8, IN `image` VARCHAR(250) CHARSET utf8, IN `price` DECIMAL(15,2), IN `category_id_1` INT, IN `category_id_2` INT)  NO SQL
    COMMENT 'Insert product'
BEGIN
	INSERT INTO products
		(code, name, description, image, price)
	VALUES
		(code, name, description, image, price);
	SET @last_id_products = LAST_INSERT_ID();
	INSERT INTO products_categories
		(product_id, category_id)
	VALUES (@last_id_products, category_id_1);
    IF (category_id_1 != category_id_2) THEN
    	INSERT INTO products_categories
			(product_id, category_id)
		VALUES (@last_id_products, category_id_2);
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL COMMENT 'Category identifier',
  `name` varchar(50) NOT NULL COMMENT 'Category name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Categories table';

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Deportes'),
(2, 'Mujer'),
(3, 'Niños y bebés'),
(4, 'Hombre'),
(5, 'Accesorios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL COMMENT 'Product identifier',
  `code` varchar(20) NOT NULL COMMENT 'Product code',
  `name` varchar(100) NOT NULL COMMENT 'Product name',
  `description` text NOT NULL COMMENT 'Product description',
  `image` varchar(250) DEFAULT '' COMMENT 'Product image',
  `price` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT 'Product price'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Products table';

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `description`, `image`, `price`) VALUES
(1, '8569324', 'BICICLETA DE MONTAÑA BTWIN ROCKRIDER 520', 'Concebido para la BTT de travesía deportiva.\r\nBTT de travesía equipada con 27 velocidades, una horquilla con bloqueo y frenos de disco hidráulicos: una bicicleta todoterreno más precisa y eficaz.', 'https://www.decathlon.es/media/835/8350582/big_23c25284-2810-415d-8bcc-e6bebdb536fc.jpg', '249.99'),
(2, '6532153', 'ZAPATILLAS DE RUNNING HOMBRE RUN ONE GRIS KALENJI', 'Concebido para los hombres que quieren correr hasta 30 minutos, de una a dos veces a la semana, por carretera y en la cinta.\r\nEstas zapatillas están provistas de una suela de espuma EVA para asegurar comodidad y ligereza en la iniciación al running.', 'https://www.decathlon.es/media/835/8351755/big_c5c699880be943b08b1a3225ee25696b.jpg', '10.99'),
(3, '9865124', 'PANTALÓN SLIM DE GIMNASIA Y PILATES MUJER NEGRO DOMYOS', 'Concebido para mantener el cuerpo abrigado antes, durante y después de la sesión de gimnasia y pilates.\r\nPantalón corte slim , afina la silueta.', 'https://www.decathlon.es/media/836/8366457/big_ed76139c39bf41c4a738c29a87c8b1b0.jpg', '12.99'),
(4, '7562159', 'PORTABICIS DE PLATAFORMA SOBRE BOLA DE REMOLQUE VELOCOMPACT 927 3 BICICLETAS THULE', 'Concebido para transportar hasta 3 bicicletas en una plataforma sobre la bola de remolque del coche.\r\nEl portabicis más compacto y ligero de Thule.', 'https://www.decathlon.es/media/834/8340817/big_b6e60f80cbe147b091b14380eb4446e1.jpg', '419.99'),
(5, '8652154', 'MITONES BARCO NIÑOS 500 VERDE/NEGRO TRIBORD', 'Concebido para proteger las manos de los niños durante la práctica de la vela ligera, la vela crucero, kayak o SUP con cualquier tiempo.\r\nMitones de barco equipados con un grip técnico que ofrece protección y agarre en las zonas de desgaste de la mano durante la práctica con vela o con remo.', 'https://www.decathlon.es/media/838/8388106/big_c1fef32e-7af5-41e8-801e-08b21c5f612b.jpg', '9.99'),
(6, '4569853', 'PALA DE PÁDEL HOMBRE PR700 BLANCO AZUL ARTENGO', 'Concebido para jugadores ocasionales o principiantes que buscan una primera pala manejable y tolerante para los primeros intercambios.\r\nEs la pala ideal si quieres descubrir el pádel a un precio muy accesible. Cómoda y manejable, ¡benefíciate de un gran confort de juego!', 'https://www.decathlon.es/media/833/8331181/big_ee89245e04dc4957b5a66bf42ee3146a.jpg', '19.99'),
(7, '8542136', 'PALA DE PÁDEL NIÑOS PR730 (7-10AÑOS) ARTENGO', 'Concebido para jóvenes jugadores de pádel (9-12 años), ocasionales y/o principiantes, que buscan una pala manejable.\r\nPala con excelente manejabilidad y buen confort de juego : ideal para niños de 9 a 12 años.', 'https://www.decathlon.es/media/835/8353532/big_7672de478fe04228b85737577ed68a66.jpg', '29.99'),
(8, '3216584', 'PALA DE PÁDEL BULLPADEL COMPLEX MUJER 2017 BULL PADEL', 'Concebido para jugadores debutantes que juegan ocasionalmente y buscan una pala manejable y confortable.', 'https://www.decathlon.es/media/838/8386179/big_af9a40e2-6b2d-420f-a824-4d13cf53c3dc.jpg', '39.99'),
(9, '5123695', 'RELOJ GPS CON PULSÓMETRO DE MUÑECA FORERUNNER 35 NEGRO GARMIN', 'Concebido para los practicantes de running, en distancias de 5 y 10 km. El forerunner 35 es un reloj GPS multiactividades.\r\nFino y ligero, ideal para la práctica diaria, en entrenamiento y carrera. Gracias al pulsómetro de muñeca integrado y a la antena GPS, registra la distancia, la cadencia y el pulso.', 'https://www.decathlon.es/media/838/8387237/big_3e20a09848ce438d94ef367b64f6713e.jpg', '157.99'),
(10, '8652659', 'RECUPERACIÓN BATIDO GEL WEIDER', 'Concebido para Fórmula avanzada para maximizar la recuperación después del entrenamiento.\r\nTOTAL-RECOVERY es un suplemento especialmente diseñado para todos aquellos atletas que necesitan maximizar su recuperación tras una intensa sesión de entrenamiento.', 'https://www.decathlon.es/media/834/8344036/big_d86848d0-4167-4803-8f7e-c12fd0b4ba84.jpg', '22.99');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products_categories`
--

CREATE TABLE `products_categories` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Products - Categories table';

--
-- Volcado de datos para la tabla `products_categories`
--

INSERT INTO `products_categories` (`product_id`, `category_id`) VALUES
(1, 1),
(2, 4),
(3, 2),
(4, 5),
(5, 3),
(6, 1),
(6, 4),
(7, 1),
(7, 3),
(8, 1),
(8, 2),
(9, 5),
(10, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products_categories`
--
ALTER TABLE `products_categories`
  ADD PRIMARY KEY (`product_id`,`category_id`),
  ADD KEY `FK_category_id_idx` (`category_id`),
  ADD KEY `FK_product_id_idx` (`product_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Category identifier', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Product identifier', AUTO_INCREMENT=11;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `products_categories`
--
ALTER TABLE `products_categories`
  ADD CONSTRAINT `FK_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
