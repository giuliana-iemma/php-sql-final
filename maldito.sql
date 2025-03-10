-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2025 at 04:01 AM
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
  `fk_estado` int(10) UNSIGNED NOT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carritos`
--

INSERT INTO `carritos` (`id`, `fk_user_id`, `created_at`, `fk_estado`, `total`) VALUES
(16, 15, '2025-03-06 03:11:18', 2, 23213.00),
(17, 15, '2025-03-06 03:16:34', 2, 213.00),
(18, 15, '2025-03-06 03:26:39', 2, 23213.00),
(19, 15, '2025-03-10 02:20:49', 2, 213.00),
(20, 15, '2025-03-10 02:41:20', 2, 213.00);

-- --------------------------------------------------------

--
-- Table structure for table `carritos_estado`
--

CREATE TABLE `carritos_estado` (
  `id` int(10) UNSIGNED NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carritos_estado`
--

INSERT INTO `carritos_estado` (`id`, `estado`) VALUES
(1, 'en curso'),
(2, 'orden emit');

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
(5, 'Cápsulas'),
(6, 'Vegano'),
(7, 'Sin TACC');

-- --------------------------------------------------------

--
-- Table structure for table `ordenes`
--

CREATE TABLE `ordenes` (
  `orden_id` int(11) UNSIGNED NOT NULL,
  `fk_user_id` int(11) UNSIGNED NOT NULL,
  `precio_total` decimal(10,2) NOT NULL,
  `estado_fk` int(10) UNSIGNED NOT NULL,
  `carrito_fk` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordenes`
--

INSERT INTO `ordenes` (`orden_id`, `fk_user_id`, `precio_total`, `estado_fk`, `carrito_fk`, `created_at`) VALUES
(62, 15, 23213.00, 4, 16, '2025-03-06 03:15:12'),
(63, 15, 213.00, 2, 17, '2025-03-06 03:16:35'),
(64, 15, 23213.00, 2, 18, '2025-03-10 01:11:57'),
(65, 15, 213.00, 1, 19, '2025-03-10 02:20:50'),
(66, 15, 213.00, 2, 20, '2025-03-10 02:42:16');

-- --------------------------------------------------------

--
-- Table structure for table `ordenes_estados`
--

CREATE TABLE `ordenes_estados` (
  `id` int(10) UNSIGNED NOT NULL,
  `estado` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordenes_estados`
--

INSERT INTO `ordenes_estados` (`id`, `estado`) VALUES
(1, 'Pendiente de pago'),
(2, 'Pago en revisión'),
(3, 'Pago aprobado. '),
(4, 'Pago rechazado.');

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

--
-- Dumping data for table `ordenes_items`
--

INSERT INTO `ordenes_items` (`orden_item_id`, `fk_orden_id`, `fk_producto_id`, `cantidad`, `precio`) VALUES
(59, 62, 10, 1, 23213.00),
(60, 63, 9, 1, 213.00),
(61, 64, 10, 1, 23213.00),
(62, 65, 9, 1, 213.00),
(63, 66, 9, 1, 213.00);

-- --------------------------------------------------------

--
-- Table structure for table `productos_bar`
--

CREATE TABLE `productos_bar` (
  `id` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` mediumtext DEFAULT NULL,
  `imagen` varchar(70) DEFAULT NULL,
  `precio` decimal(10,0) UNSIGNED NOT NULL,
  `stock` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productos_bar`
--

INSERT INTO `productos_bar` (`id`, `nombre`, `descripcion`, `imagen`, `precio`, `stock`) VALUES
(9, 'Tiramisu', 'desc', 'comida/tiramisu.jpg', 213, 10),
(10, 'Cheese Cake', 'Con una base bien humeda y un relleno suave y crem', 'comida/cheese-cake.jpg', 23213, 3123),
(11, 'Croissant', 'Delicadamente hojaldrado y dorado, nuestro croissa', '10', 0, 1100),
(15, 'Iced Flat', 'Café helado intenso con leche vaporizada para una experiencia suave y deliciosa.\"', 'cafe/capuchino-ice.jpg', 1050, 100),
(18, 'Capucchino Ice', 'Una versión fresca y deliciosa del clásico capuchino. Espres}o suave, leche vaporizada un toque de chocolate y canela, adornado con una capa de espuma cremosa', 'cafe/capuchino-ice.jpg', 1350, 100),
(36, 'Cupcake', 'Un cupcake esponjoso y suave, adornado con una generosa porción de crema de vainilla. Este dulce clásico es perfecto para satisfacer antojos con su delicado sabor a vainilla y su presentación encantadora.', 'comida/cup-cake.jpg', 1800, 10),
(37, 'Lemon Pie', 'Un equilibrio perfecto entre lo dulce y lo ácido, nuestro lemon pie es una explosión refrescante de sabor. Disfruta de su relleno de limón sedoso sobre una base de masa dorada, ideal para los amantes de los postres cítricos.', 'comida/lemonpie.jpg', 2500, 10),
(38, 'Café Negro', 'Una clásica mezcla de espresso robusto y agua caliente. Perfecto para los amantes del café fuerte.', 'cafe/coffee.jpg', 1250, 100),
(39, 'Latte', 'Una deliciosa combinación de espresso suave con leche vaporizada, coronada con una capa de espuma sedosa.', 'cafe/latte.jpg', 2300, 100),
(40, 'Capuchino', 'Mezcla armoniosa de espresso intenso, leche vaporizada y espuma cremosa, con toque de chocolate y canela.', 'cafe/capuchino.jpg', 3000, 1000),
(45, 'Aurora ', 'Un espresso vibrante y afrutado con notas de frutos rojos y un toque cítrico. Ideal para quienes buscan un café ligero pero con carácter.', 'capsulas/1.jpg', 5000, 10),
(46, 'Nocturno ', 'Intenso y profundo, con notas de cacao amargo, nueces tostadas y un final especiado. Perfecto para los amantes del café fuerte y robusto.', 'capsulas/1.jpg', 3455, 10),
(47, 'Dulce Alba', 'Suave y equilibrado, con notas de caramelo, vainilla y un toque de almendra. Un café envolvente y cremoso.', 'capsulas/1.jpg', 3656, 10),
(48, 'Brisa Andina', 'Un blend con cuerpo medio, notas de chocolate con leche y un ligero aroma floral. Fresco y armonioso.', 'capsulas/1.jpg', 5658, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `productos_categorias`
--

CREATE TABLE `productos_categorias` (
  `id` int(11) NOT NULL,
  `producto_fk` int(10) UNSIGNED NOT NULL,
  `categoria_fk` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productos_categorias`
--

INSERT INTO `productos_categorias` (`id`, `producto_fk`, `categoria_fk`) VALUES
(3, 45, 5),
(4, 48, 5),
(5, 47, 5),
(7, 46, 5),
(8, 45, 7),
(9, 48, 7),
(10, 46, 7),
(12, 47, 7),
(13, 38, 1),
(14, 18, 1),
(15, 40, 1),
(16, 15, 1),
(17, 39, 1),
(18, 38, 6),
(19, 15, 6),
(21, 36, 7),
(34, 36, 2),
(35, 37, 2),
(42, 11, 2),
(43, 11, 6),
(90, 10, 2),
(91, 10, 4),
(92, 10, 7),
(95, 9, 2),
(96, 9, 3);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `categoria_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `categoria_user`) VALUES
(1, 'admin'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fk_rol` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `email`, `password`, `fk_rol`) VALUES
(15, 'admin', 'admin@email.com', '$2y$10$eXpmHaBT6sZxEC8TkAKRwOvTbKcBscYgWZfXMK8WPD.hF9puOcXqS', 1),
(16, 'giu', 'giu@gmail.com', '$2y$10$ivMnvd5IAO4OrWfkH4UUv.MW89psFykdXqciUwHvdzckt/Nrxy.re', 1),
(17, 'Santiago', 'santi@gmail.com', '$2y$10$dKnr6Qi9o0SiJhTsYVSxQusEaNT8zLIMi6zBNqccRrEIZrlogycUW', 2),
(18, 'caracol', 'caracol@hotmail.com', '$2y$10$4YsgnNXXMxp9znYEWv51.eAAGR6xuIE3UxGGKFSJZ8fN4Vrv2f5cK', 2),
(19, 'canela', 'canela@email.com', '$2y$10$MYCUfdBZbTQga5Ix.hlJKuFWZvBV9RpxtpKGCpYSOw1zG7LJl0Qje', 2),
(20, 'canela2', 'canela2@email.com', '$2y$10$Nm0MlxY/2BsWAo.3m0g7s.d4teJBsKTfHPErxAd4gcyTCxqDkkLUK', 2);

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
-- Indexes for table `carritos_estado`
--
ALTER TABLE `carritos_estado`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`orden_id`),
  ADD KEY `usuario_id` (`fk_user_id`),
  ADD KEY `estado_fk` (`estado_fk`),
  ADD KEY `carrito_fk` (`carrito_fk`);

--
-- Indexes for table `ordenes_estados`
--
ALTER TABLE `ordenes_estados`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productos_categorias`
--
ALTER TABLE `productos_categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_categoria` (`producto_fk`),
  ADD KEY `categoria_producto` (`categoria_fk`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat` (`fk_rol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carritos`
--
ALTER TABLE `carritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `carritos_estado`
--
ALTER TABLE `carritos_estado`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carrito_items`
--
ALTER TABLE `carrito_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `orden_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `ordenes_estados`
--
ALTER TABLE `ordenes_estados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ordenes_items`
--
ALTER TABLE `ordenes_items`
  MODIFY `orden_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `productos_bar`
--
ALTER TABLE `productos_bar`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `productos_categorias`
--
ALTER TABLE `productos_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carritos`
--
ALTER TABLE `carritos`
  ADD CONSTRAINT `fk_estado` FOREIGN KEY (`fk_estado`) REFERENCES `carritos_estado` (`id`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`fk_user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `carrito_fk` FOREIGN KEY (`carrito_fk`) REFERENCES `carritos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estado_fk` FOREIGN KEY (`estado_fk`) REFERENCES `ordenes_estados` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_id` FOREIGN KEY (`fk_user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ordenes_items`
--
ALTER TABLE `ordenes_items`
  ADD CONSTRAINT `orden_id` FOREIGN KEY (`fk_orden_id`) REFERENCES `ordenes` (`orden_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `producto` FOREIGN KEY (`fk_producto_id`) REFERENCES `productos_bar` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `productos_categorias`
--
ALTER TABLE `productos_categorias`
  ADD CONSTRAINT `categoria_producto` FOREIGN KEY (`categoria_fk`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_categoria` FOREIGN KEY (`producto_fk`) REFERENCES `productos_bar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `cat` FOREIGN KEY (`fk_rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
