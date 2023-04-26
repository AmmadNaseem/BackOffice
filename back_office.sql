-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2023 at 10:55 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `back_office`
--

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `preco` float NOT NULL,
  `quantidade` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `id_tipo_iva` int(11) NOT NULL,
  `id_sub_familia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id_producto`, `nome`, `preco`, `quantidade`, `foto`, `id_tipo_iva`, `id_sub_familia`) VALUES
(1, 'Galaxy Node 20', 120000, 1, '1674423861-dot net.png', 1, 2),
(2, 'Lenvo', 123093, 5, '1674423961-firebase server.png', 1, 1),
(3, 'Quasi laboris volupt', 45, 51, '1674423977-abdullah uni.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subfamilia`
--

CREATE TABLE `subfamilia` (
  `id_sub_familia` int(11) NOT NULL,
  `desc_sub_familia` text NOT NULL,
  `id_familia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subfamilia`
--

INSERT INTO `subfamilia` (`id_sub_familia`, `desc_sub_familia`, `id_familia`) VALUES
(1, 'Laptop                                ', NULL),
(2, 'Mobile', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_iva`
--

CREATE TABLE `tipo_iva` (
  `id_tipo_iva` int(11) NOT NULL,
  `desc_tipo_iva` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tipo_iva`
--

INSERT INTO `tipo_iva` (`id_tipo_iva`, `desc_tipo_iva`) VALUES
(1, 'Abc                            ');

-- --------------------------------------------------------

--
-- Table structure for table `utilizadores`
--

CREATE TABLE `utilizadores` (
  `login` varchar(80) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nivel_utilizador` int(10) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilizadores`
--

INSERT INTO `utilizadores` (`login`, `password`, `nivel_utilizador`) VALUES
('Admin', 'Admin123', 1),
('User', '123456', 2),
('Other', '654321', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_sub_familia` (`id_sub_familia`),
  ADD KEY `id_tipo_iva` (`id_tipo_iva`);

--
-- Indexes for table `subfamilia`
--
ALTER TABLE `subfamilia`
  ADD PRIMARY KEY (`id_sub_familia`);

--
-- Indexes for table `tipo_iva`
--
ALTER TABLE `tipo_iva`
  ADD PRIMARY KEY (`id_tipo_iva`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subfamilia`
--
ALTER TABLE `subfamilia`
  MODIFY `id_sub_familia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tipo_iva`
--
ALTER TABLE `tipo_iva`
  MODIFY `id_tipo_iva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_sub_familia`) REFERENCES `subfamilia` (`id_sub_familia`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_tipo_iva`) REFERENCES `tipo_iva` (`id_tipo_iva`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
