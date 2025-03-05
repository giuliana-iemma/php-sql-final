-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 10:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maldito`
--

-- --------------------------------------------------------

--
-- Table structure for table `carritos`
--

CREATE TABLE `carritos` (
  `id` int(11) NOT NULL,
  `fk_user_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `fk_estado` varchar(50) NOT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carritos`
--

INSERT INTO `carritos` (`id`, `fk_user_id`, `created_at`, `fk_estado`, `total`) VALUES
(6, 16, '2024-06-18 22:31:13', 'en curso', NULL),
(7, 15, '2024-06-19 15:36:04', 'en curso', 2400.00);

-- --------------------------------------------------------

--
-- Table structure for table `carrito_items`
--

CREATE TABLE `carrito_items` (
  `item_id` int(11) NOT NULL,
  `fk_carrito_id` int(11) NOT NULL,
  `fk_producto_id` int(11) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carrito_items`
--

INSERT INTO `carrito_items` (`item_id`, `fk_carrito_id`, `fk_producto_id`, `cantidad`) VALUES
(13, 6, 10, 2),
(14, 6, 11, 15),
(15, 6, 34, 1),
(16, 6, 15, 114),
(31, 7, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) UNSIGNED NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'Bebida'),
(2, 'Comida'),
(3, 'Remeras'),
(4, 'Tazas'),
(5, 'Molido');

-- --------------------------------------------------------

--
-- Table structure for table `categoria_usuario`
--

CREATE TABLE `categoria_usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `categoria_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categoria_usuario`
--

INSERT INTO `categoria_usuario` (`id`, `categoria_user`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `ordenes`
--

CREATE TABLE `ordenes` (
  `orden_id` int(11) UNSIGNED NOT NULL,
  `fk_user_id` int(11) UNSIGNED NOT NULL,
  `precio_total` decimal(10,2) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordenes`
--

INSERT INTO `ordenes` (`orden_id`, `fk_user_id`, `precio_total`, `estado`, `created_at`) VALUES
(1, 15, 0.00, 'incompleta', '2024-06-19 20:15:47'),
(2, 15, 0.00, 'incompleta', '2024-06-19 20:15:49'),
(3, 15, 0.00, 'incompleta', '2024-06-19 20:15:51'),
(4, 15, 0.00, 'incompleta', '2024-06-19 20:22:04'),
(5, 15, 0.00, 'incompleta', '2024-06-19 20:26:20'),
(6, 15, 0.00, 'incompleta', '2024-06-19 20:26:23');

-- --------------------------------------------------------

--
-- Table structure for table `ordenes_items`
--

CREATE TABLE `ordenes_items` (
  `orden_item_id` int(11) NOT NULL,
  `fk_orden_id` int(11) UNSIGNED NOT NULL,
  `fk_producto_id` int(11) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productos_bar`
--

CREATE TABLE `productos_bar` (
  `id` int(11) UNSIGNED NOT NULL,
  `fk_categoria` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` mediumtext DEFAULT NULL,
  `imagen` varchar(70) DEFAULT NULL,
  `precio` decimal(10,0) UNSIGNED NOT NULL,
  `stock` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productos_bar`
--

INSERT INTO `productos_bar` (`id`, `fk_categoria`, `nombre`, `descripcion`, `imagen`, `precio`, `stock`) VALUES
(9, 2, 'Tiramisu', 'Riquísimo y sabroso Tiramisú.', 'comida/tiramisu.jpg', 12503, 10),
(10, 2, 'Cheese Cake', 'Con una base bien humeda y un relleno suave y cremoso, el cheesecake es una delicia irresistiblemente rica. Disfruta de su sabor a queso cremoso con toques dulces.', 'comida/cheese-cake.jpg', 800, 10),
(11, 2, 'Croissant', 'Delicadamente hojaldrado y dorado, nuestro croissant fresco es un placer francés auténtico. Su interior tierno y su capa exterior crujiente lo hacen ideal para el desayuno o un bocado delicioso en cualquier momento del día.', 'comida/croissant.jpg', 1100, 10),
(15, 1, 'Iced Flat', 'Café helado intenso con leche vaporizada para una experiencia suave y deliciosa.\"', 'cafe/capuchino-ice.jpg', 1050, 100),
(18, 1, 'Capucchino Ice', 'Una versión fresca y deliciosa del clásico capuchino. Espres}o suave, leche vaporizada un toque de chocolate y canela, adornado con una capa de espuma cremosa', 'cafe/capuchino-ice.jpg', 1350, 100),
(34, 5, 'Cafe Brazil', 'Café brazil', 'molido/brazil.jpg', 2500, 3),
(36, 2, 'Cupcake', 'Un cupcake esponjoso y suave, adornado con una generosa porción de crema de vainilla. Este dulce clásico es perfecto para satisfacer antojos con su delicado sabor a vainilla y su presentación encantadora.', 'comida/cup-cake.jpg', 1800, 10),
(37, 2, 'Lemon Pie', 'Un equilibrio perfecto entre lo dulce y lo ácido, nuestro lemon pie es una explosión refrescante de sabor. Disfruta de su relleno de limón sedoso sobre una base de masa dorada, ideal para los amantes de los postres cítricos.', 'comida/lemonpie.jpg', 2500, 10),
(38, 1, 'Café Negro', 'Una clásica mezcla de espresso robusto y agua caliente. Perfecto para los amantes del café fuerte.', 'cafe/coffee.jpg', 1250, 100),
(39, 1, 'Latte', 'Una deliciosa combinación de espresso suave con leche vaporizada, coronada con una capa de espuma sedosa.', 'cafe/latte.jpg', 2300, 100),
(40, 1, 'Capuchino', 'Mezcla armoniosa de espresso intenso, leche vaporizada y espuma cremosa, con toque de chocolate y canela.', 'cafe/capuchino.jpg', 3000, 1000),
(41, 5, 'Italia', 'Sumérgete en la auténtica experiencia italiana con nuestro café molido de Italia. Este café oscuro y robusto presenta un sabor intenso y profundo con notas de cacao y un toque de amargor distintivo. Ideal para los amantes del espresso fuerte y aromático.', '/molido/italia.png', 6500, 25),
(42, 5, 'Colombia', 'Disfruta de la rica complejidad de nuestro café molido de Colombia, caracterizado por su cuerpo medio, acidez brillante y sabores vibrantes. Este café exhibe notas frutales y cítricas con un sutil dulzor, reflejando la calidad de los granos colombianos.', 'molido/colombia.png', 5600, 25),
(43, 5, 'Mocca', 'Descubre la exquisita mezcla de nuestro café molido tipo Mocca, que combina granos selectos con un carácter distintivo y un aroma envolvente. Este café ofrece un equilibrio armonioso entre notas terrosas, afrutadas y un sutil toque de chocolate.', 'molido/moka.png', 6500, 25),
(44, 5, 'Intenso', 'Para los que buscan una experiencia audaz, nuestro café molido Intenso es la elección perfecta. Con un cuerpo completo y un sabor fuerte y persistente, este café se destaca por sus notas robustas y tostadas que cautivan los sentidos.', 'molido/intenso.png', 7000, 25);

-- --------------------------------------------------------

--
-- Table structure for table `producto_variacion`
--

CREATE TABLE `producto_variacion` (
  `id` int(11) UNSIGNED NOT NULL,
  `fk_prod` int(11) UNSIGNED NOT NULL,
  `fk_variacion` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fk_categoria` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `email`, `password`, `fk_categoria`) VALUES
(15, 'admin', 'admin@gmail.com', '$2y$10$eXpmHaBT6sZxEC8TkAKRwOvTbKcBscYgWZfXMK8WPD.hF9puOcXqS', 1),
(16, 'giu', 'giu@gmail.com', '$2y$10$ivMnvd5IAO4OrWfkH4UUv.MW89psFykdXqciUwHvdzckt/Nrxy.re', 2);

-- --------------------------------------------------------

--
-- Table structure for table `variaciones`
--

CREATE TABLE `variaciones` (
  `id` int(11) UNSIGNED NOT NULL,
  `variacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `variaciones`
--

INSERT INTO `variaciones` (`id`, `variacion`) VALUES
(1, 'vegano'),
(2, 'celiaco'),
(3, 'light');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carritos`
--
ALTER TABLE `carritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado_id` (`fk_estado`),
  ADD KEY `user_id` (`fk_user_id`);

--
-- Indexes for table `carrito_items`
--
ALTER TABLE `carrito_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `carrito_id` (`fk_carrito_id`),
  ADD KEY `producto_id` (`fk_producto_id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categoria_usuario`
--
ALTER TABLE `categoria_usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`orden_id`),
  ADD KEY `usuario_id` (`fk_user_id`);

--
-- Indexes for table `ordenes_items`
--
ALTER TABLE `ordenes_items`
  ADD PRIMARY KEY (`orden_item_id`),
  ADD KEY `orden_id` (`fk_orden_id`),
  ADD KEY `producto` (`fk_producto_id`);

--
-- Indexes for table `productos_bar`
--
ALTER TABLE `productos_bar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_producto` (`fk_categoria`);

--
-- Indexes for table `producto_variacion`
--
ALTER TABLE `producto_variacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variacion_id` (`fk_variacion`),
  ADD KEY `prod_id` (`fk_prod`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat` (`fk_categoria`);

--
-- Indexes for table `variaciones`
--
ALTER TABLE `variaciones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carritos`
--
ALTER TABLE `carritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `carrito_items`
--
ALTER TABLE `carrito_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categoria_usuario`
--
ALTER TABLE `categoria_usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `orden_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ordenes_items`
--
ALTER TABLE `ordenes_items`
  MODIFY `orden_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productos_bar`
--
ALTER TABLE `productos_bar`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `producto_variacion`
--
ALTER TABLE `producto_variacion`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `variaciones`
--
ALTER TABLE `variaciones`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carritos`
--
ALTER TABLE `carritos`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`fk_user_id`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `carrito_items`
--
ALTER TABLE `carrito_items`
  ADD CONSTRAINT `carrito_id` FOREIGN KEY (`fk_carrito_id`) REFERENCES `carritos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_id` FOREIGN KEY (`fk_producto_id`) REFERENCES `productos_bar` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ordenes`
--
ALTER TABLE `ordenes`
  ADD CONSTRAINT `usuario_id` FOREIGN KEY (`fk_user_id`) REFERENCES `usuarios` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ordenes_items`
--
ALTER TABLE `ordenes_items`
  ADD CONSTRAINT `orden_id` FOREIGN KEY (`fk_orden_id`) REFERENCES `ordenes` (`orden_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `producto` FOREIGN KEY (`fk_producto_id`) REFERENCES `productos_bar` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `productos_bar`
--
ALTER TABLE `productos_bar`
  ADD CONSTRAINT `categoria_producto` FOREIGN KEY (`fk_categoria`) REFERENCES `categorias` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `producto_variacion`
--
ALTER TABLE `producto_variacion`
  ADD CONSTRAINT `prod_id` FOREIGN KEY (`fk_prod`) REFERENCES `productos_bar` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `variacion_id` FOREIGN KEY (`fk_variacion`) REFERENCES `variaciones` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `cat` FOREIGN KEY (`fk_categoria`) REFERENCES `categoria_usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
