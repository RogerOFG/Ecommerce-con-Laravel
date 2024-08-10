-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2024 at 12:28 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tienda`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `idBill` varchar(255) NOT NULL,
  `idUser` varchar(255) NOT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `idBill`, `idUser`, `discount`, `created_at`, `updated_at`) VALUES
(32, '20240710R1O448', '1', 'NULL', '2024-07-10 17:21:03', '2024-07-11 03:22:55'),
(33, '20240710S1F228', '1', 'NULL', '2024-07-11 00:04:24', '2024-07-11 00:05:07'),
(38, '20240710X1V929', '1', 'NULL', '2024-07-11 02:19:56', '2024-07-11 02:19:56'),
(39, '20240710G1P382', '1', 'NULL', '2024-07-11 04:08:50', '2024-07-11 07:25:54'),
(44, '20240714T1G678', '1', '10', '2024-07-14 06:22:03', '2024-07-14 06:22:03'),
(45, '2024071571G690', '1', 'NULL', '2024-07-15 05:03:15', '2024-07-15 05:03:15'),
(46, '20240723U1V682', '1', 'NULL', '2024-07-23 23:20:12', '2024-07-23 23:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idUser` varchar(255) NOT NULL,
  `idProduct` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `idUser`, `idProduct`, `amount`, `created_at`, `updated_at`) VALUES
(2, '2', '1', '2', '2024-05-03 23:28:23', '2024-05-03 23:28:32');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `idProduct` varchar(255) NOT NULL,
  `idUser` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `amountLimit` varchar(255) NOT NULL,
  `amountUsage` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `type`, `idProduct`, `idUser`, `discount`, `amountLimit`, `amountUsage`, `created_at`, `updated_at`) VALUES
(1, 'NUEVO20', 'ALL', 'NULL', 'NULL', '10', '20', '1', '2024-07-06 23:24:45', '2024-07-14 06:22:03');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_usage`
--

CREATE TABLE `coupon_usage` (
  `id` int(11) NOT NULL,
  `idCoupon` varchar(255) NOT NULL,
  `idBill` varchar(255) DEFAULT NULL,
  `idUser` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupon_usage`
--

INSERT INTO `coupon_usage` (`id`, `idCoupon`, `idBill`, `idUser`, `created_at`, `updated_at`) VALUES
(15, '1', '20240714T1G678', '1', '2024-07-14 06:22:03', '2024-07-14 06:22:03');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(40, '0001_01_01_000000_create_users_table', 1),
(41, '0001_01_01_000001_create_cache_table', 1),
(42, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idBill` varchar(255) NOT NULL,
  `idProduct` varchar(255) NOT NULL,
  `idUser` varchar(255) NOT NULL,
  `idAddress` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `idBill`, `idProduct`, `idUser`, `idAddress`, `state`, `amount`, `created_at`, `updated_at`) VALUES
(34, '20240710R1O448', '17', '1', '1', '0', '1', '2024-07-10 17:21:03', '2024-07-11 03:22:55'),
(35, '20240710R1O448', '16', '1', '1', '0', '1', '2024-07-10 17:21:03', '2024-07-11 03:22:47'),
(36, '20240710R1O448', '2', '1', '1', '0', '1', '2024-07-10 17:21:03', '2024-07-11 03:20:23'),
(37, '20240710R1O448', '1', '1', '1', '0', '2', '2024-07-10 17:21:03', '2024-07-11 03:19:55'),
(41, '20240710S1F228', '17', '1', '1', '0', '1', '2024-07-11 00:04:24', '2024-07-11 00:06:52'),
(46, '20240710X1V929', '2', '1', '11', '0', '1', '2024-07-11 02:19:56', '2024-07-11 03:38:58'),
(47, '20240710G1P382', '17', '1', '1', '2', '2', '2024-07-11 04:08:50', '2024-07-15 04:56:53'),
(48, '20240710G1P382', '16', '1', '1', '2', '2', '2024-07-11 04:08:50', '2024-07-15 04:56:53'),
(49, '20240710G1P382', '1', '1', '1', '2', '5', '2024-07-11 04:08:50', '2024-07-15 04:56:53'),
(50, '20240710G1P382', '2', '1', '1', '0', '1', '2024-07-11 04:08:50', '2024-07-14 07:54:06'),
(55, '20240714T1G678', '17', '1', '1', '3', '1', '2024-07-14 06:22:03', '2024-07-15 18:31:29'),
(56, '20240714T1G678', '2', '1', '1', '3', '1', '2024-07-14 06:22:03', '2024-07-15 18:31:29'),
(57, '2024071571G690', '1', '1', '11', '0', '2', '2024-07-15 05:03:15', '2024-07-15 05:04:28'),
(58, '2024071571G690', '2', '1', '11', '0', '1', '2024-07-15 05:03:15', '2024-07-15 05:04:28'),
(59, '20240723U1V682', '17', '1', '11', '1', '1', '2024-07-23 23:20:12', '2024-07-23 23:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `bisuteria_hilo` varchar(255) DEFAULT NULL,
  `bisuteria_piedras` varchar(255) DEFAULT NULL,
  `bisuteria_dijen` varchar(255) DEFAULT NULL,
  `bisuteria_cierre` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `cristal` varchar(255) DEFAULT NULL,
  `caja` varchar(255) DEFAULT NULL,
  `pulsera` varchar(255) DEFAULT NULL,
  `manecillas` varchar(255) DEFAULT NULL,
  `metrosAgua` varchar(255) DEFAULT NULL,
  `garanty` varchar(255) DEFAULT NULL,
  `amountAvailable` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `bisuteria_hilo`, `bisuteria_piedras`, `bisuteria_dijen`, `bisuteria_cierre`, `brand`, `price`, `cristal`, `caja`, `pulsera`, `manecillas`, `metrosAgua`, `garanty`, `amountAvailable`, `created_at`, `updated_at`) VALUES
(1, 'Q&Q Hombre', 'Relojeria', NULL, NULL, NULL, NULL, 'Q&Q', '70000', 'Cristal Mineral', 'Caja de acero horneado', 'Pulso en acero inoxidable', 'Hora, minutos y segundos', '3', '5', '22', NULL, '2024-07-15 05:04:28'),
(2, 'Q&Q Dama', 'Relojeria', NULL, NULL, NULL, NULL, 'Q&Q', '60000', 'Cristal Mineral', 'Caja de acero horneado', 'Pulso en acero inoxidable', 'Hora, minutos y segundos', '0', '4', '18', NULL, '2024-07-15 05:04:28'),
(16, 'Rolex Dama', 'Relojeria', NULL, NULL, NULL, NULL, 'Rolex', '75000', 'Cristal Mineral', 'Caja de acero', 'Pulso en acero inoxidable', 'Hora, minutos y segundos', 'Resiste lavado de manos y salpicaduras', '3', '17', '2024-06-21 05:36:22', '2024-07-11 07:31:18'),
(17, 'Orient', 'Relojeria', 'Hilo Chino', NULL, NULL, NULL, 'Orient', '72000', 'Cristal Mineral', 'Caja de acero horneado', 'Pulso en acero inoxidable', 'Hora, minutos y segundos', 'Resiste lavado de manos y salpicaduras', '3', '0', '2024-06-27 16:31:34', '2024-07-24 00:04:30');

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idProduct` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `idProduct`, `url`, `created_at`, `updated_at`) VALUES
(3, '1', '1-qq-m0cO.webp', '2024-05-06 03:44:58', '2024-05-06 03:44:58'),
(5, '1', '1-qq-VIje.webp', '2024-06-14 09:08:06', '2024-06-14 09:08:06'),
(7, '1', '1-qq-EAvj.webp', '2024-06-14 09:08:06', '2024-06-14 09:08:06'),
(22, '14', '14-casio-tzNr.jpg', '2024-06-17 07:41:12', '2024-06-17 07:41:12'),
(23, '13', '13-casio-Jnju.jpg', '2024-06-17 10:33:02', '2024-06-17 10:33:02'),
(24, '16', '16-rolex-EAbK.webp', '2024-06-21 05:36:33', '2024-06-21 05:36:33'),
(26, '2', '2-qq-oWJ8.webp', '2024-06-21 05:38:33', '2024-06-21 05:38:33'),
(27, '17', '17-orient-z3iZ.webp', '2024-06-27 16:31:56', '2024-06-27 16:31:56'),
(28, '19', '19--6xbO.jpg', '2024-07-16 00:51:17', '2024-07-16 00:51:17'),
(29, '20', '20--j4AJ.jpg', '2024-07-16 00:55:55', '2024-07-16 00:55:55'),
(31, '23', '23--Lotj.jpg', '2024-07-16 01:26:26', '2024-07-16 01:26:26');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('50bREXvLC6E8HJnLY9QbfsnVC5swYumYLEPXvhrp', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36 OPR/112.0.0.0', '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LTA3LTIzVDIzOjIwOjEyLjAwMDAwMFoiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6Mjc6IjIwMjQtMDctMjNUMjM6MjA6MTIuMDAwMDAwWiI7czoyOiJpZCI7aTo1OTt9fXM6MTE6ImN1cnJlbnREYXRlIjtPOjEzOiJDYXJib25cQ2FyYm9uIjozOntzOjQ6ImRhdGUiO3M6MjY6IjIwMjQtMDctMjMgMTg6MjA6MTIuNjQxMjI2IjtzOjEzOiJ0aW1lem9uZV90eXBlIjtpOjM7czo4OiJ0aW1lem9uZSI7czoxNDoiQW1lcmljYS9Cb2dvdGEiO31zOjc6ImFkZHJlc3MiO2E6MTI6e3M6MjoiaWQiO2k6MTE7czo2OiJpZFVzZXIiO3M6MToiMSI7czo0OiJjaXR5IjtzOjk6Ik1lZGVsbMOtbiI7czoxMDoiZGVwYXJ0bWVudCI7czo5OiJBbnRpb3F1aWEiO3M6ODoiZGlzdHJpY3QiO3M6MTY6IkJhcnJpbyBBbnRpb3F1aWEiO3M6NzoiYWRkcmVzcyI7czozNjoiW0F2ZW5pZGEgQ2FycmVyYV0gWzIzXSAjIFsxNF0gLSBbMjVdIjtzOjQ6ImluZm8iO3M6OTE6IkVzIHVuYSBjYXNhIHZlcmRlIGRlIDMgcGlzb3MgYSBtaXRhZCBkZSBsYSBjdWFkcmEsIGVuZnJlbnRlIGhheSB1biB2ZWhpY3VsbyBhbnRpZ3VvIGRhw7FhZG8iO3M6NjoibnVtYmVyIjtzOjI6Ijk0IjtzOjU6InBob25lIjtzOjEzOiIzMDAgMDAwIDAwIDAwIjtzOjE0OiJyZW1lbWJlcl90b2tlbiI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO047fXM6ODoicHJvZHVjdHMiO2E6MTp7aTowO2E6MTg6e3M6MjoiaWQiO2k6MTc7czo0OiJuYW1lIjtzOjY6Ik9yaWVudCI7czo4OiJjYXRlZ29yeSI7czo5OiJSZWxvamVyaWEiO3M6MTQ6ImJpc3V0ZXJpYV9oaWxvIjtOO3M6MTc6ImJpc3V0ZXJpYV9waWVkcmFzIjtOO3M6MTU6ImJpc3V0ZXJpYV9kaWplbiI7TjtzOjE2OiJiaXN1dGVyaWFfY2llcnJlIjtOO3M6NToiYnJhbmQiO3M6NjoiT3JpZW50IjtzOjU6InByaWNlIjtzOjU6IjcyMDAwIjtzOjc6ImNyaXN0YWwiO3M6MTU6IkNyaXN0YWwgTWluZXJhbCI7czo0OiJjYWphIjtzOjIyOiJDYWphIGRlIGFjZXJvIGhvcm5lYWRvIjtzOjc6InB1bHNlcmEiO3M6MjU6IlB1bHNvIGVuIGFjZXJvIGlub3hpZGFibGUiO3M6MTA6Im1hbmVjaWxsYXMiO3M6MjQ6IkhvcmEsIG1pbnV0b3MgeSBzZWd1bmRvcyI7czoxMDoibWV0cm9zQWd1YSI7czozODoiUmVzaXN0ZSBsYXZhZG8gZGUgbWFub3MgeSBzYWxwaWNhZHVyYXMiO3M6NzoiZ2FyYW50eSI7czoxOiIzIjtzOjE1OiJhbW91bnRBdmFpbGFibGUiO3M6MToiMSI7czoxMDoiY3JlYXRlZF9hdCI7czoyNzoiMjAyNC0wNi0yN1QxNjozMTozNC4wMDAwMDBaIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjI3OiIyMDI0LTA3LTE0VDA2OjIyOjAzLjAwMDAwMFoiO319fQ==', 1721779472);

-- --------------------------------------------------------

--
-- Table structure for table `shipment_info`
--

CREATE TABLE `shipment_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idUser` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `number` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipment_info`
--

INSERT INTO `shipment_info` (`id`, `idUser`, `city`, `department`, `district`, `address`, `info`, `number`, `phone`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '1', 'Barranquilla', 'Atlántico', 'San Isidro', '[Calle] [50] # [23] - [42]', 'Casa de 2 pisos Blanca', 'Apto 101', '3005369591', NULL, NULL, '2024-06-14 04:56:08'),
(2, '2', 'Barranquilla', 'Atlántico', 'San Isidro', '[Calle] [47] # [26] - [100]', 'Arcadas de San Isidro', 'Bloque 42 apto 5C', '3206455912', NULL, NULL, NULL),
(11, '1', 'Medellín', 'Antioquia', 'Barrio Antioquia', '[Avenida Carrera] [23] # [14] - [25]', 'Es una casa verde de 3 pisos a mitad de la cuadra, enfrente hay un vehiculo antiguo dañado', '94', '300 000 00 00', NULL, NULL, NULL),
(13, '1', 'Barranco de Loba', 'Bolívar', 'San Inistio', '[Avenida] [16] # [45] - [14]', 'Es una casa azul', 'Apr 101', '3004578412', NULL, NULL, '2024-06-27 16:37:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `numCC` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `admin` varchar(255) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `numCC`, `email`, `email_verified_at`, `password`, `admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Roger Omar', 'Florez Garcia', '1002212675', 'roger_flasx@hotmail.com', NULL, '$2y$12$/6mU3y.i5SjsD6fnVXrGvOXSVN8xiTby6/tOfkJPu4j7wvKeDKR4C', '1', NULL, '2024-05-03 22:05:21', '2024-06-20 00:47:19'),
(2, 'Isabel', 'Cepeda', NULL, 'icepeda0801@gmail.com', NULL, '$2y$12$JDkMnV4zFYurQ7KB8ise7u5CUqaOE7V/Sh03REwa2E3Qpil7ycmnm', '0', NULL, '2024-05-03 23:27:43', '2024-05-03 23:27:43'),
(9, 'Javi', 'azure', NULL, 'javi@correo.com', NULL, '$2y$12$Eb0.BBvvf9y/3.j4229wT.LtcOQIWOVy/K1oWsPs.wSoePOSV/o9e', '1', NULL, NULL, NULL),
(12, 'Maria', 'Vargas', NULL, 'maria@correo.com', NULL, '$2y$12$EBTtn3QjDxQa86gKwvMvf.mhaWW7Bnb.L6aDCRRsTUvw65DgtJ7Oy', '0', NULL, '2024-07-11 22:10:07', '2024-07-11 22:10:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `coupon_usage`
--
ALTER TABLE `coupon_usage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `shipment_info`
--
ALTER TABLE `shipment_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupon_usage`
--
ALTER TABLE `coupon_usage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `shipment_info`
--
ALTER TABLE `shipment_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
