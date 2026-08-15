-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Agu 2026 pada 05.47
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `sebatas-kopi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Signature Coffee', 'signature-coffee', 'categories/signature-coffee.png', '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(2, 'Coffee', 'coffee', 'categories/coffee.png', '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(3, 'Es Coffee', 'es-coffee', 'categories/es-coffee.png', '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(4, 'Latte', 'latte', 'categories/latte.png', '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(5, 'Teh', 'teh', 'categories/teh.png', '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(6, 'Milkshake', 'milkshake', 'categories/milkshake.png', '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(7, 'Mocktail', 'mocktail', 'categories/mocktail.png', '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(8, 'Es Mint', 'es-mint', 'categories/es-mint.png', '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(9, 'Snack', 'snack', 'categories/snack.png', '2025-12-11 12:39:01', '2025-12-11 12:39:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `extras`
--

CREATE TABLE `extras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `extras`
--

INSERT INTO `extras` (`id`, `name`, `price`, `is_available`, `created_at`, `updated_at`) VALUES
(1, 'Extra Shot', 5000.00, 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(2, 'Oat Milk', 8000.00, 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(3, 'Caramel Sauce', 3000.00, 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(4, 'Vanilla Syrup', 3000.00, 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(5, 'Cream Cheese', 5000.00, 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_01_124500_create_categories_table', 1),
(5, '2025_12_01_124510_create_products_table', 1),
(6, '2025_12_01_124516_create_orders_table', 1),
(7, '2025_12_01_124522_create_order_items_table', 1),
(8, '2025_12_01_130421_create_extras_tables', 1),
(9, '2025_12_03_add_payment_type_to_orders_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `status` enum('pending','paid','failed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `snap_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_item_extras`
--

CREATE TABLE `order_item_extras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `extra_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `price`, `stock`, `image`, `is_available`, `created_at`, `updated_at`) VALUES
(1, 1, 'Salted Creme Brulee', 'Salted Creme Brulee', 'Nikmati kesegaran Salted Creme Brulee khas Sebatas Kopi.', 28000.00, 100, 'products/Salted Creme Brulee.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(2, 1, 'No Name', 'No Name', 'Nikmati kesegaran No Name khas Sebatas Kopi.', 28000.00, 100, 'products/No Name.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(3, 1, 'Terserah Kopi Susu', 'Terserah Kopi Susu', 'Nikmati kesegaran Terserah Kopi Susu khas Sebatas Kopi.', 27000.00, 100, 'products/Terserah Kopi Susu.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(4, 1, 'Sekedar Kopi Susu', 'Sekedar Kopi Susu', 'Nikmati kesegaran Sekedar Kopi Susu khas Sebatas Kopi.', 25000.00, 100, 'products/Sekedar Kopi Susu.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(5, 1, 'Kopi Susu Biasa Aja', 'Kopi Susu Biasa Aja', 'Nikmati kesegaran Kopi Susu Biasa Aja khas Sebatas Kopi.', 25000.00, 100, 'products/Kopi Susu Biasa Aja.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(6, 1, 'Irish Coffee', 'Irish Coffee', 'Nikmati kesegaran Irish Coffee khas Sebatas Kopi.', 25000.00, 100, 'products/Irish Coffee.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(7, 1, 'Ngaspal', 'Ngaspal', 'Nikmati kesegaran Ngaspal khas Sebatas Kopi.', 25000.00, 100, 'products/Ngaspal.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(8, 1, 'Matcha Caramel', 'Matcha Caramel', 'Nikmati kesegaran Matcha Caramel khas Sebatas Kopi.', 20000.00, 100, 'products/Matcha Caramel.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(9, 1, 'Vanilla Caramel', 'Vanilla Caramel', 'Nikmati kesegaran Vanilla Caramel khas Sebatas Kopi.', 20000.00, 100, 'products/Vanilla Caramel.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(10, 1, 'Taro Caramel', 'Taro Caramel', 'Nikmati kesegaran Taro Caramel khas Sebatas Kopi.', 20000.00, 100, 'products/Taro Caramel.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(11, 2, 'Americano Hot', 'Americano Hot', 'Nikmati kesegaran Americano Hot khas Sebatas Kopi.', 15000.00, 100, 'products/Americano.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(12, 2, 'Americano Cold', 'Americano Cold', 'Nikmati kesegaran Americano Cold khas Sebatas Kopi.', 18000.00, 100, 'products/Americano.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(13, 2, 'Sanger Hot', 'Sanger Hot', 'Nikmati kesegaran Sanger Hot khas Sebatas Kopi.', 15000.00, 100, 'products/Sanger.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(14, 2, 'Sanger Cold', 'Sanger Cold', 'Nikmati kesegaran Sanger Cold khas Sebatas Kopi.', 18000.00, 100, 'products/Sanger.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(15, 2, 'Coffee Chocolate Hot', 'Coffee Chocolate Hot', 'Nikmati kesegaran Coffee Chocolate Hot khas Sebatas Kopi.', 15000.00, 100, 'products/Coffee Chocolate.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(16, 2, 'Coffee Chocolate Cold', 'Coffee Chocolate Cold', 'Nikmati kesegaran Coffee Chocolate Cold khas Sebatas Kopi.', 18000.00, 100, 'products/Coffee Chocolate.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(17, 2, 'Coffee Milo Hot', 'Coffee Milo Hot', 'Nikmati kesegaran Coffee Milo Hot khas Sebatas Kopi.', 20000.00, 100, 'products/Coffee Milo.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(18, 2, 'Coffee Milo Cold', 'Coffee Milo Cold', 'Nikmati kesegaran Coffee Milo Cold khas Sebatas Kopi.', 23000.00, 100, 'products/Coffee Milo.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(19, 2, 'Caramel Macchiato Hot', 'Caramel Macchiato Hot', 'Nikmati kesegaran Caramel Macchiato Hot khas Sebatas Kopi.', 23000.00, 100, 'products/Caramel Macchiato.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(20, 2, 'Caramel Macchiato Cold', 'Caramel Macchiato Cold', 'Nikmati kesegaran Caramel Macchiato Cold khas Sebatas Kopi.', 25000.00, 100, 'products/Caramel Macchiato.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(21, 2, 'Sebatas Kopi Susu Hot', 'Sebatas Kopi Susu Hot', 'Nikmati kesegaran Sebatas Kopi Susu Hot khas Sebatas Kopi.', 22000.00, 100, 'products/Sebatas Kopi Susu.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(22, 2, 'Sebatas Kopi Susu Cold', 'Sebatas Kopi Susu Cold', 'Nikmati kesegaran Sebatas Kopi Susu Cold khas Sebatas Kopi.', 25000.00, 100, 'products/Sebatas Kopi Susu.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(23, 2, 'White Chocolate Coffee Hot', 'White Chocolate Coffee Hot', 'Nikmati kesegaran White Chocolate Coffee Hot khas Sebatas Kopi.', 23000.00, 100, 'products/White Chocolate Coffee.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(24, 2, 'White Chocolate Coffee Cold', 'White Chocolate Coffee Cold', 'Nikmati kesegaran White Chocolate Coffee Cold khas Sebatas Kopi.', 25000.00, 100, 'products/White Chocolate Coffee.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(25, 3, 'Es Kopi Regal', 'Es Kopi Regal', 'Nikmati kesegaran Es Kopi Regal khas Sebatas Kopi.', 18000.00, 100, 'products/Es Kopi Regal.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(26, 3, 'Es Kopi Strawberry', 'Es Kopi Strawberry', 'Nikmati kesegaran Es Kopi Strawberry khas Sebatas Kopi.', 22000.00, 100, 'products/Es Kopi Strawberry.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(27, 3, 'Es Kopi Caramel', 'Es Kopi Caramel', 'Nikmati kesegaran Es Kopi Caramel khas Sebatas Kopi.', 22000.00, 100, 'products/Es Kopi Caramel.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(28, 3, 'Es Kopi Vanilla', 'Es Kopi Vanilla', 'Nikmati kesegaran Es Kopi Vanilla khas Sebatas Kopi.', 22000.00, 100, 'products/Es Kopi Vanilla.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(29, 3, 'Es Kopi Taro', 'Es Kopi Taro', 'Nikmati kesegaran Es Kopi Taro khas Sebatas Kopi.', 22000.00, 100, 'products/Es Kopi Taro.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(30, 3, 'Es Kopi Red Velvet', 'Es Kopi Red Velvet', 'Nikmati kesegaran Es Kopi Red Velvet khas Sebatas Kopi.', 22000.00, 100, 'products/Es Kopi Red Velvet.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(31, 3, 'Es Kopi Matcha', 'Es Kopi Matcha', 'Nikmati kesegaran Es Kopi Matcha khas Sebatas Kopi.', 22000.00, 100, 'products/Es Kopi Matcha.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(32, 3, 'Es Kopi Kocok', 'Es Kopi Kocok', 'Nikmati kesegaran Es Kopi Kocok khas Sebatas Kopi.', 18000.00, 100, 'products/Es Kopi Kocok.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(33, 3, 'Es Kopi Gula Aren', 'Es Kopi Gula Aren', 'Nikmati kesegaran Es Kopi Gula Aren khas Sebatas Kopi.', 22000.00, 100, 'products/Es Kopi Gula Aren.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(34, 4, 'Milo Latte Hot', 'Milo Latte Hot', 'Nikmati kesegaran Milo Latte Hot khas Sebatas Kopi.', 13000.00, 100, 'products/Milo Latte.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(35, 4, 'Milo Latte Cold', 'Milo Latte Cold', 'Nikmati kesegaran Milo Latte Cold khas Sebatas Kopi.', 15000.00, 100, 'products/Milo Latte.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(36, 4, 'Strawberry Latte Hot', 'Strawberry Latte Hot', 'Nikmati kesegaran Strawberry Latte Hot khas Sebatas Kopi.', 13000.00, 100, 'products/Strawberry Latte.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(37, 4, 'Strawberry Latte Cold', 'Strawberry Latte Cold', 'Nikmati kesegaran Strawberry Latte Cold khas Sebatas Kopi.', 15000.00, 100, 'products/Strawberry Latte.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(38, 4, 'Matcha Latte Hot', 'Matcha Latte Hot', 'Nikmati kesegaran Matcha Latte Hot khas Sebatas Kopi.', 13000.00, 100, 'products/Matcha Latte.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(39, 4, 'Matcha Latte Cold', 'Matcha Latte Cold', 'Nikmati kesegaran Matcha Latte Cold khas Sebatas Kopi.', 15000.00, 100, 'products/Matcha Latte.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(40, 4, 'Vanilla Latte Hot', 'Vanilla Latte Hot', 'Nikmati kesegaran Vanilla Latte Hot khas Sebatas Kopi.', 13000.00, 100, 'products/Vanilla Latte.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(41, 4, 'Vanilla Latte Cold', 'Vanilla Latte Cold', 'Nikmati kesegaran Vanilla Latte Cold khas Sebatas Kopi.', 15000.00, 100, 'products/Vanilla Latte.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(42, 4, 'Caramel Latte Hot', 'Caramel Latte Hot', 'Nikmati kesegaran Caramel Latte Hot khas Sebatas Kopi.', 13000.00, 100, 'products/Caramel Latte.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(43, 4, 'Caramel Latte Cold', 'Caramel Latte Cold', 'Nikmati kesegaran Caramel Latte Cold khas Sebatas Kopi.', 15000.00, 100, 'products/Caramel Latte.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(44, 4, 'Taro Latte Hot', 'Taro Latte Hot', 'Nikmati kesegaran Taro Latte Hot khas Sebatas Kopi.', 13000.00, 100, 'products/Taro Latte.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(45, 4, 'Taro Latte Cold', 'Taro Latte Cold', 'Nikmati kesegaran Taro Latte Cold khas Sebatas Kopi.', 15000.00, 100, 'products/Taro Latte.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(46, 4, 'Irish Latte Hot', 'Irish Latte Hot', 'Nikmati kesegaran Irish Latte Hot khas Sebatas Kopi.', 17000.00, 100, 'products/Irish Latte.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(47, 4, 'Irish Latte Cold', 'Irish Latte Cold', 'Nikmati kesegaran Irish Latte Cold khas Sebatas Kopi.', 20000.00, 100, 'products/Irish Latte.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(48, 5, 'Teh Vanilla Hot', 'Teh Vanilla Hot', 'Nikmati kesegaran Teh Vanilla Hot khas Sebatas Kopi.', 13000.00, 100, 'products/Teh Vanilla.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(49, 5, 'Teh Vanilla Cold', 'Teh Vanilla Cold', 'Nikmati kesegaran Teh Vanilla Cold khas Sebatas Kopi.', 15000.00, 100, 'products/Teh Vanilla.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(50, 5, 'Teh Lemon Hot', 'Teh Lemon Hot', 'Nikmati kesegaran Teh Lemon Hot khas Sebatas Kopi.', 13000.00, 100, 'products/Teh Lemon.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(51, 5, 'Teh Lemon Cold', 'Teh Lemon Cold', 'Nikmati kesegaran Teh Lemon Cold khas Sebatas Kopi.', 15000.00, 100, 'products/Teh Lemon.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(52, 5, 'Teh Matcha Hot', 'Teh Matcha Hot', 'Nikmati kesegaran Teh Matcha Hot khas Sebatas Kopi.', 13000.00, 100, 'products/Teh Matcha.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(53, 5, 'Teh Matcha Cold', 'Teh Matcha Cold', 'Nikmati kesegaran Teh Matcha Cold khas Sebatas Kopi.', 15000.00, 100, 'products/Teh Matcha.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(54, 5, 'Teh Apple Hot', 'Teh Apple Hot', 'Nikmati kesegaran Teh Apple Hot khas Sebatas Kopi.', 13000.00, 100, 'products/Teh Apple.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(55, 5, 'Teh Apple Cold', 'Teh Apple Cold', 'Nikmati kesegaran Teh Apple Cold khas Sebatas Kopi.', 15000.00, 100, 'products/Teh Apple.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(56, 5, 'Teh Irish Hot', 'Teh Irish Hot', 'Nikmati kesegaran Teh Irish Hot khas Sebatas Kopi.', 15000.00, 100, 'products/Teh Irish.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(57, 5, 'Teh Irish Cold', 'Teh Irish Cold', 'Nikmati kesegaran Teh Irish Cold khas Sebatas Kopi.', 17000.00, 100, 'products/Teh Irish.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(58, 6, 'Milkshake Milo', 'Milkshake Milo', 'Nikmati kesegaran Milkshake Milo khas Sebatas Kopi.', 15000.00, 100, 'products/Milkshake Milo.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(59, 6, 'Milkshake Strawberry', 'Milkshake Strawberry', 'Nikmati kesegaran Milkshake Strawberry khas Sebatas Kopi.', 15000.00, 100, 'products/Milkshake Strawberry.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(60, 6, 'Milkshake Matcha', 'Milkshake Matcha', 'Nikmati kesegaran Milkshake Matcha khas Sebatas Kopi.', 15000.00, 100, 'products/Milkshake Matcha.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(61, 6, 'Milkshake Vanilla', 'Milkshake Vanilla', 'Nikmati kesegaran Milkshake Vanilla khas Sebatas Kopi.', 15000.00, 100, 'products/Milkshake Vanilla.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(62, 6, 'Milkshake Chocolate', 'Milkshake Chocolate', 'Nikmati kesegaran Milkshake Chocolate khas Sebatas Kopi.', 15000.00, 100, 'products/Milkshake Chocolate.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(63, 6, 'Milkshake Caramel', 'Milkshake Caramel', 'Nikmati kesegaran Milkshake Caramel khas Sebatas Kopi.', 15000.00, 100, 'products/Milkshake Caramel.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(64, 6, 'Milkshake Red Velvet', 'Milkshake Red Velvet', 'Nikmati kesegaran Milkshake Red Velvet khas Sebatas Kopi.', 15000.00, 100, 'products/Milkshake Red Velvet.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(65, 6, 'Milkshake Taro', 'Milkshake Taro', 'Nikmati kesegaran Milkshake Taro khas Sebatas Kopi.', 15000.00, 100, 'products/Milkshake Taro.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(66, 7, 'Mocktail Calamansi', 'Mocktail Calamansi', 'Nikmati kesegaran Mocktail Calamansi khas Sebatas Kopi.', 20000.00, 100, 'products/Mocktail Calamansi.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(67, 7, 'Mocktail Iecy', 'Mocktail Iecy', 'Nikmati kesegaran Mocktail Iecy khas Sebatas Kopi.', 20000.00, 100, 'products/Mocktail Iecy.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(68, 7, 'Mocktail Blueberry', 'Mocktail Blueberry', 'Nikmati kesegaran Mocktail Blueberry khas Sebatas Kopi.', 20000.00, 100, 'products/Mocktail Blueberry.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(69, 7, 'Mocktail Mangga', 'Mocktail Mangga', 'Nikmati kesegaran Mocktail Mangga khas Sebatas Kopi.', 20000.00, 100, 'products/Mocktail Mangga.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(70, 7, 'Mocktail Orange', 'Mocktail Orange', 'Nikmati kesegaran Mocktail Orange khas Sebatas Kopi.', 20000.00, 100, 'products/Mocktail Orange.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(71, 8, 'Es Lemon Mint', 'Es Lemon Mint', 'Nikmati kesegaran Es Lemon Mint khas Sebatas Kopi.', 23000.00, 100, 'products/Es Lemon Mint.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(72, 8, 'Es Chocolate Mint', 'Es Chocolate Mint', 'Nikmati kesegaran Es Chocolate Mint khas Sebatas Kopi.', 23000.00, 100, 'products/Es Chocolate Mint.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(73, 8, 'Es White Chocolate Mint', 'Es White Chocolate Mint', 'Nikmati kesegaran Es White Chocolate Mint khas Sebatas Kopi.', 23000.00, 100, 'products/Es White Chocolate Mint.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(74, 9, 'Kentang Goreng', 'Kentang Goreng', 'Nikmati kesegaran Kentang Goreng khas Sebatas Kopi.', 18000.00, 100, 'products/Kentang Goreng.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(75, 9, 'Tempe Goreng', 'Tempe Goreng', 'Nikmati kesegaran Tempe Goreng khas Sebatas Kopi.', 15000.00, 100, 'products/Tempe Goreng.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(76, 9, 'Nugget', 'Nugget', 'Nikmati kesegaran Nugget khas Sebatas Kopi.', 18000.00, 100, 'products/Nugget.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(77, 9, 'Nasi Goreng', 'Nasi Goreng', 'Nikmati kesegaran Nasi Goreng khas Sebatas Kopi.', 18000.00, 100, 'products/Nasi Goreng.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(78, 9, 'Nasi Telur', 'Nasi Telur', 'Nikmati kesegaran Nasi Telur khas Sebatas Kopi.', 15000.00, 100, 'products/Nasi Telur.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(79, 9, 'Indomie Goreng', 'Indomie Goreng', 'Nikmati kesegaran Indomie Goreng khas Sebatas Kopi.', 15000.00, 100, 'products/Indomie Goreng.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(80, 9, 'Indomie Kuah', 'Indomie Kuah', 'Nikmati kesegaran Indomie Kuah khas Sebatas Kopi.', 18000.00, 100, 'products/Indomie Kuah.png', 1, '2025-12-11 12:39:01', '2025-12-11 12:39:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('CbBTdOxvRa1FvJkojpgy96OE94NNy7BlhuOQRkuW', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia01iaEM4eWI0WlE5aXRaamxYa09PWnI5WVo3TEFTdms0MUE4ekxoaSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9vcmRlcnMiO3M6NToicm91dGUiO3M6MTg6ImFkbWluLm9yZGVycy5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1786168019);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','customer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `phone`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@kopi.com', NULL, '$2y$12$MazKJdKCLl9L9XFBwb3FxuKPtcQWRDXjCj3Tkno03yWZMnwqPF38u', 'admin', '081234567890', NULL, '2025-12-11 12:39:00', '2025-12-11 12:39:00'),
(2, 'Customer Test', 'user@gmail.com', NULL, '$2y$12$/u009P.JuJaIzZHHziMjE.1JE.8kY9nGS1NytM3QRcaefNfHwXRhK', 'customer', '089876543210', NULL, '2025-12-11 12:39:01', '2025-12-11 12:39:01'),
(3, 'asd', 'asd@gmail.com', NULL, '$2y$12$arIGaoFrQUfY404jzwfgceL2z1D1Abt3icqYIhwYH2PBLCDM9spIy', 'customer', '1221212', NULL, '2026-08-08 05:32:24', '2026-08-08 05:32:24');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `order_item_extras`
--
ALTER TABLE `order_item_extras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_item_extras_order_item_id_foreign` (`order_item_id`),
  ADD KEY `order_item_extras_extra_id_foreign` (`extra_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `extras`
--
ALTER TABLE `extras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `order_item_extras`
--
ALTER TABLE `order_item_extras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_item_extras`
--
ALTER TABLE `order_item_extras`
  ADD CONSTRAINT `order_item_extras_extra_id_foreign` FOREIGN KEY (`extra_id`) REFERENCES `extras` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_item_extras_order_item_id_foreign` FOREIGN KEY (`order_item_id`) REFERENCES `order_items` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
