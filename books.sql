-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2021 at 06:44 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lara_s_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

-- CREATE TABLE `books` (
--   `id` bigint(20) UNSIGNED NOT NULL,
--   `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `summary` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `price` bigint(20) NOT NULL,
--   `ordinal` int(10) UNSIGNED DEFAULT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL,
--   `deleted_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `image`, `title`, `summary`, `price`, `ordinal`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'uploads/book/1617164983-book.jpg', 'Konsep dan Implementasi Pemrograman Laravel 7', 'Buku ini dapat membimbing anda mempelajari Framework Laravel versi 7 dari amatir hingga mahir', 75000, 1, '2021-03-30 05:59:35', '2021-03-30 21:29:43', NULL),
(2, 'uploads/book/1617165143-book.jpg', '[BUNDLE] 3 Buku JavaScript + Bonus', 'Buku JavaScript ini dapat anda pelajari untuk menguasai bahasa pemrograman JavaScript', 160000, 3, '2021-03-30 06:04:49', '2021-03-30 21:32:23', NULL),
(6, 'uploads/book/1617119505-book.jpg', 'test', 'soft delete', 123444, 4, '2021-03-30 08:51:45', '2021-03-30 21:31:11', '2021-03-30 21:31:11'),
(7, 'uploads/book/1617165060-book.jpg', 'Go Programming', 'Buku edisi ke dua dari Aaron Torres yang merupakan panduan untuk menguasai bahasa pemrograman Go', 100000, 2, '2021-03-30 21:11:04', '2021-03-30 21:31:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
-- ALTER TABLE `books`
-- ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
-- ALTER TABLE `books`
  -- MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
-- COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
