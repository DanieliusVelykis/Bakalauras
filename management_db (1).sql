-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 01, 2024 at 07:37 PM
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
-- Database: `management_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_services`
--

CREATE TABLE `additional_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `workerServiceId` varchar(255) NOT NULL,
  `reservationId` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `additional_services`
--

INSERT INTO `additional_services` (`id`, `workerServiceId`, `reservationId`, `created_at`, `updated_at`) VALUES
(1, '19', '74', '2024-06-01 05:22:09', '2024-06-01 05:22:09'),
(2, '18', '74', '2024-06-01 05:22:09', '2024-06-01 05:22:09'),
(3, '16', '75', '2024-06-01 05:27:17', '2024-06-01 05:27:17'),
(4, '20', '75', '2024-06-01 05:27:17', '2024-06-01 05:27:17'),
(5, 'NOT', '76', '2024-06-01 05:41:55', '2024-06-01 05:41:55'),
(6, '16', '67', '2024-06-01 05:43:26', '2024-06-01 05:43:26'),
(7, '16', '79', '2024-06-01 05:44:49', '2024-06-01 05:44:49'),
(8, '20', '67', '2024-06-01 05:44:49', '2024-06-01 05:44:49'),
(9, '17', '67', '2024-06-01 05:44:49', '2024-06-01 05:44:49'),
(10, '18', '79', '2024-06-01 05:44:49', '2024-06-01 05:44:49'),
(11, '19', '81', '2024-06-01 05:45:43', '2024-06-01 05:45:43'),
(12, '18', '81', '2024-06-01 05:45:43', '2024-06-01 05:45:43'),
(13, '17', '81', '2024-06-01 05:45:43', '2024-06-01 05:45:43'),
(14, '18', '82', '2024-06-01 05:46:16', '2024-06-01 05:46:16'),
(15, '17', '82', '2024-06-01 05:46:16', '2024-06-01 05:46:16'),
(16, '19', '86', '2024-06-01 07:03:03', '2024-06-01 07:03:03'),
(17, '18', '86', '2024-06-01 07:03:03', '2024-06-01 07:03:03');

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
-- Table structure for table `communication_channel`
--

CREATE TABLE `communication_channel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` varchar(255) NOT NULL,
  `reservationId` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `communication_channel`
--

INSERT INTO `communication_channel` (`id`, `userId`, `reservationId`, `comment`, `created_at`, `updated_at`) VALUES
(1, '4', '64', 'dsadsads', '2024-05-31 15:17:59', '2024-05-31 15:17:59'),
(2, '4', '65', 'Sveiki', '2024-05-31 15:21:03', '2024-05-31 15:21:03'),
(3, '4', '66', 'Sveiki as esu Lukas ir man idomu jusu paslauga', '2024-05-31 15:21:25', '2024-05-31 15:21:25'),
(4, '4', '66', 'Mano naujas komentaras ahaha', '2024-05-31 16:24:29', '2024-05-31 16:24:29'),
(5, '4', '66', 'Mano komentaras nebe toks ir naujas', '2024-05-31 16:27:07', '2024-05-31 16:27:07'),
(6, '4', '66', 'Aha palik', '2024-05-31 16:28:35', '2024-05-31 16:28:35'),
(7, '4', '66', 'Dar vienas toks', '2024-05-31 16:31:14', '2024-05-31 16:31:14'),
(8, '4', '66', 'Paskutinis', '2024-05-31 16:31:45', '2024-05-31 16:31:45'),
(9, '4', '66', 'Paskutinisss', '2024-05-31 16:31:59', '2024-05-31 16:31:59'),
(10, '4', '66', 'Paskutinissssss', '2024-05-31 16:32:28', '2024-05-31 16:32:28'),
(11, '4', '66', 'Paskutinissssssss', '2024-05-31 16:34:08', '2024-05-31 16:34:08'),
(12, '4', '66', 'Paskutinissssssss', '2024-05-31 16:34:16', '2024-05-31 16:34:16'),
(13, '4', '66', 'asdasd', '2024-05-31 16:34:34', '2024-05-31 16:34:34'),
(14, '4', '66', 'Sveiki visi pabendraukime', '2024-05-31 16:41:36', '2024-05-31 16:41:36'),
(15, '8', '67', 'Sveiki, palieku komentara man reikalinga', '2024-05-31 17:00:40', '2024-05-31 17:00:40'),
(16, '4', '57', 'Sw', '2024-05-31 17:07:04', '2024-05-31 17:07:04'),
(17, '8', '67', 'Sw', '2024-05-31 17:07:14', '2024-05-31 17:07:14'),
(18, '4', '57', 'Newas', '2024-05-31 17:08:04', '2024-05-31 17:08:04'),
(19, '4', '57', 'Aha', '2024-05-31 17:08:11', '2024-05-31 17:08:11'),
(20, '8', '67', 'Grazinu', '2024-05-31 17:08:18', '2024-05-31 17:08:18'),
(21, '8', '67', 'Mano naujas komentariukas', '2024-05-31 17:09:33', '2024-05-31 17:09:33'),
(22, '4', '57', 'sw', '2024-05-31 17:10:38', '2024-05-31 17:10:38'),
(23, '4', '57', 'Nu sveikas', '2024-05-31 17:11:51', '2024-05-31 17:11:51'),
(24, '8', '57', 'św ka Gero', '2024-05-31 17:13:44', '2024-05-31 17:13:44'),
(25, '4', '57', 'Komentariux', '2024-05-31 17:20:52', '2024-05-31 17:20:52'),
(26, '8', '57', 'Naujas?', '2024-05-31 17:21:08', '2024-05-31 17:21:08'),
(27, '4', '68', 'ss', '2024-05-31 17:42:13', '2024-05-31 17:42:13'),
(28, '4', '69', 'sss', '2024-05-31 17:42:22', '2024-05-31 17:42:22'),
(29, '4', '70', 'sss', '2024-05-31 17:42:30', '2024-05-31 17:42:30'),
(30, '4', '71', 'sss', '2024-05-31 17:43:07', '2024-05-31 17:43:07'),
(31, '4', '72', 'ss', '2024-06-01 05:11:08', '2024-06-01 05:11:08'),
(32, '4', '73', 'sss', '2024-06-01 05:14:14', '2024-06-01 05:14:14'),
(33, '4', '74', 'sss', '2024-06-01 05:22:11', '2024-06-01 05:22:11'),
(34, '4', '75', 'asd', '2024-06-01 05:27:20', '2024-06-01 05:27:20'),
(35, '4', '76', 'NOT', '2024-06-01 05:41:58', '2024-06-01 05:41:58'),
(36, '4', '80', 'Atsakymas AAA', '2024-06-01 05:45:16', '2024-06-01 05:45:16'),
(37, '4', '81', 'Testinukiux', '2024-06-01 05:45:46', '2024-06-01 05:45:46'),
(38, '4', '82', 'AHAHAHAHAAHAHAHHAHAHAA', '2024-06-01 05:46:19', '2024-06-01 05:46:19'),
(39, '4', '87', 'asdas', '2024-06-01 07:03:35', '2024-06-01 07:03:35'),
(40, '4', '57', 'Ahaha', '2024-06-01 10:53:41', '2024-06-01 10:53:41');

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
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `serviceId` varchar(255) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `serviceId`, `feedback`, `user`, `created_at`, `updated_at`) VALUES
(1, '2', 'dasdas\r\nads\r\n\r\ndsa\r\nas\r\n\r\n\r\n\r\n\r\nadssda', 'adm adm', '2024-05-13 20:07:24', '2024-05-13 20:07:24'),
(2, '2', 'Mano atsiliepimas', 'adm adm', '2024-05-13 20:18:20', '2024-05-13 20:18:20'),
(3, '1', 'Mana', 'adm adm', '2024-05-13 20:21:23', '2024-05-13 20:21:23'),
(4, '1', 'Random shit', 'adm adm', '2024-05-14 14:49:34', '2024-05-14 14:49:34');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_04_20_174800_create_services_table', 2),
(6, '2024_04_20_180107_add_roles_and_phone_to_users', 3),
(7, '2024_04_20_180107_create_roles', 4),
(8, '2024_05_11_183428_create_new_services_table', 5),
(10, '2024_05_12_170316_create_reservations_table', 6),
(11, '2024_05_13_205321_updated_reservations', 7),
(12, '2024_05_13_225143_create_feedback_table', 8),
(13, '2024_05_31_121339_communication_channel', 9),
(14, '2024_05_31_204945_workers_services', 10),
(15, '2024_06_01_075440_additional_services', 11),
(16, '2024_06_01_075912_additional_service', 12);

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
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `userId` varchar(255) NOT NULL,
  `serviceId` varchar(255) NOT NULL,
  `reservedDate` date NOT NULL,
  `reservedTime` time NOT NULL,
  `price` varchar(255) NOT NULL,
  `paid` varchar(255) NOT NULL,
  `paymentType` varchar(255) NOT NULL,
  `reservationStatus` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `name`, `userId`, `serviceId`, `reservedDate`, `reservedTime`, `price`, `paid`, `paymentType`, `reservationStatus`, `file`, `created_at`, `updated_at`) VALUES
(1, 'Rezervacija_2024-05-13_20', '4', '1', '2024-05-05', '11:00:00', '123', 'yes', 'full', 'Patvirtinta apmokėta', 'files/Užklausa _2405291122', '2024-05-13 17:56:35', '2024-05-31 08:28:40'),
(2, 'Rezervacija_2024-05-13_20', '4', '1', '2024-05-30', '14:00:00', '123', 'yes', 'Pilnas', 'Atlikta', 'files/PayPal-JavaScript-FullStack-Standard-Checkout-Sample-main.zip', '2024-05-13 17:56:35', '2024-05-14 14:54:06'),
(3, 'Rezervacija_2024-05-14_13', '2', '1', '2024-05-05', '11:00:00', '123', 'yes', 'full', 'Pateikta apmokėta', '', '2024-05-14 10:08:00', '2024-05-14 10:08:00'),
(4, 'Rezervacija_2024-05-14_13', '2', '1', '2024-05-05', '11:00:00', '123', 'yes', 'full', 'Pateikta apmokėta', 'files/csvjson.csv', '2024-05-14 10:08:56', '2024-06-01 06:29:06'),
(5, 'Rezervacija_2024-05-14_13', '2', '1', '2024-05-05', '11:00:00', '123', 'yes', 'full', 'Pateikta apmokėta', 'files/csvjson.csv', '2024-05-14 10:09:16', '2024-06-01 06:30:10'),
(6, 'Rezervacija_2024-05-14_13', '2', '1', '2024-05-05', '11:00:00', '123', 'yes', 'full', 'Pateikta apmokėta', 'files/csvjson (1).csv', '2024-05-14 10:10:07', '2024-06-01 06:30:36'),
(7, 'Rezervacija_2024-05-14_13', '2', '1', '2024-05-05', '11:00:00', '123', 'yes', 'full', 'Pateikta apmokėta', '', '2024-05-14 10:11:25', '2024-05-14 10:11:25'),
(8, 'Rezervacija_2024-05-14_13', '2', '1', '2024-05-05', '11:00:00', '123', 'yes', 'full', 'Pateikta apmokėta', '', '2024-05-14 10:11:54', '2024-05-14 10:11:54'),
(9, 'Rezervacija_2024-05-14_13', '2', '1', '2024-05-05', '11:00:00', '123', 'yes', 'full', 'Pateikta apmokėta', '', '2024-05-14 10:12:27', '2024-05-14 10:12:27'),
(10, 'Rezervacija_2024-05-14_13', '2', '1', '2024-05-05', '11:00:00', '123', 'yes', 'full', 'Pateikta apmokėta', '', '2024-05-14 10:12:36', '2024-05-14 10:12:36'),
(11, 'Rezervacija_2024-05-14_13', '2', '1', '2024-05-05', '11:00:00', '123', 'yes', 'full', 'Pateikta apmokėta', '', '2024-05-14 10:12:48', '2024-05-14 10:12:48'),
(12, 'Rezervacija_2024-05-14_13', '2', '1', '2024-05-05', '11:00:00', '123', 'yes', 'full', 'Pateikta apmokėta', '', '2024-05-14 10:12:54', '2024-05-14 10:12:54'),
(13, 'Rezervacija_2024-05-14_13', '2', '1', '2024-05-05', '11:00:00', '123', 'yes', 'full', 'Pateikta apmokėta', '', '2024-05-14 10:13:05', '2024-05-14 10:13:05'),
(14, 'Rezervacija_2024-05-14_13', '2', '1', '2024-05-05', '11:00:00', '123', 'yes', 'full', 'Pateikta apmokėta', '', '2024-05-14 10:13:09', '2024-05-14 10:13:09'),
(15, 'Rezervacija_2024-05-14_13', '2', '1', '2024-05-05', '11:00:00', '123', 'yes', 'full', 'Pateikta apmokėta', '', '2024-05-14 10:28:45', '2024-05-14 10:28:45'),
(16, 'Rezervacija_2024-05-14_14', '2', '1', '2024-05-05', '11:00:00', '123', 'yes', 'full', 'Pateikta apmokėta', '', '2024-05-14 11:00:02', '2024-05-14 11:00:02'),
(17, 'Rezervacija_2024-05-14_14', '2', '1', '2024-05-05', '11:00:00', '123', 'yes', 'full', 'Pateikta apmokėta', '', '2024-05-14 11:06:14', '2024-05-14 11:06:14'),
(18, 'Rezervacija_2024-05-14_15', '2', '1', '2024-02-02', '11:00:00', '120', 'yes', 'full', 'Pateikta apmokėta', '', '2024-05-14 12:24:38', '2024-05-14 12:24:38'),
(19, 'Rezervacija_2024-05-14_15', '2', '1', '2024-05-03', '10:00:00', '00000', 'yes', 'full', 'Pateikta apmokėta', '', '2024-05-14 12:26:14', '2024-05-14 12:26:14'),
(20, 'Rezervacija_2024-05-14_15', '2', '1', '2024-05-03', '16:00:00', '00000', 'yes', 'full', 'Pateikta apmokėta', '', '2024-05-14 12:29:04', '2024-05-14 12:29:04'),
(29, 'Rezervacija_2024-05-29_17', '4', '2', '2024-05-04', '14:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-29 14:52:18', '2024-05-29 14:52:18'),
(30, 'Rezervacija_2024-05-29_17', '4', '2', '2024-05-04', '14:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-29 14:52:34', '2024-05-29 14:52:34'),
(31, 'Rezervacija_2024-05-29_17', '4', '2', '2024-05-05', '12:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-29 14:52:51', '2024-05-29 14:52:51'),
(32, 'Rezervacija_2024-05-29_17', '4', '2', '2024-05-05', '12:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-29 14:53:20', '2024-05-29 14:53:20'),
(33, 'Rezervacija_2024-05-29_17', '4', '2', '2024-05-05', '12:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-29 14:56:20', '2024-05-29 14:56:20'),
(34, 'Rezervacija_2024-05-29_17', '4', '2', '2024-05-05', '12:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-29 14:59:09', '2024-05-29 14:59:09'),
(35, 'Rezervacija_2024-05-30_16', '4', '2', '2024-05-02', '16:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-30 13:47:27', '2024-05-30 13:47:27'),
(36, 'Rezervacija_2024-05-30_16', '4', '1', '2024-05-02', '16:00:00', '234', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-30 13:52:29', '2024-05-30 13:52:29'),
(37, 'Rezervacija_2024-05-30_16', '4', '1', '2024-05-02', '14:00:00', '234', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-30 13:53:46', '2024-05-30 13:53:46'),
(38, 'Rezervacija_2024-05-30_17', '4', '2', '2024-05-06', '16:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-30 14:00:58', '2024-05-30 14:00:58'),
(39, 'Rezervacija_2024-05-30_17', '4', '2', '2024-05-04', '14:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-30 14:32:50', '2024-05-30 14:32:50'),
(40, 'Rezervacija_2024-05-30_17', '4', '2', '2024-05-04', '14:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-30 14:36:57', '2024-05-30 14:36:57'),
(41, 'Rezervacija_2024-05-30_17', '4', '10', '2024-05-07', '14:00:00', '123123', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-30 14:40:54', '2024-05-30 14:40:54'),
(42, 'Rezervacija_2024-05-30_17', '4', '2', '2024-05-07', '14:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-30 14:42:50', '2024-05-30 14:42:50'),
(43, 'Rezervacija_2024-05-30_17', '4', '1', '2024-05-02', '14:00:00', '234', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-30 14:45:08', '2024-05-30 14:45:08'),
(44, 'Rezervacija_2024-05-30_17', '4', '2', '2024-05-03', '12:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-30 14:49:05', '2024-05-30 14:49:05'),
(45, 'Rezervacija_2024-05-30_18', '4', '1', '2024-05-03', '14:00:00', '234', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-30 15:01:43', '2024-05-30 15:01:43'),
(46, 'Rezervacija_2024-05-30_18', '4', '2', '2024-05-06', '14:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-30 15:03:13', '2024-05-30 15:03:13'),
(47, 'Rezervacija_2024-05-30_18', '4', '1', '2024-05-04', '16:00:00', '234', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-30 15:03:51', '2024-05-30 15:03:51'),
(48, 'Rezervacija_2024-05-30_18', '4', '10', '2024-05-07', '10:00:00', '123123', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-30 15:06:54', '2024-05-30 15:06:54'),
(49, 'Rezervacija_2024-05-30_18', '4', '10', '2024-05-01', '14:00:00', '123123', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-30 15:09:29', '2024-05-30 15:09:29'),
(50, 'Rezervacija_2024-05-31_05', '4', '2', '2024-05-05', '16:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-31 02:20:12', '2024-05-31 02:20:12'),
(51, 'Rezervacija_2024-05-31_05', '4', '2', '2024-05-05', '16:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-31 02:53:56', '2024-05-31 02:53:56'),
(52, 'Rezervacija_2024-05-31_05', '4', '1', '2024-05-02', '14:00:00', '234', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-31 02:55:28', '2024-05-31 02:55:28'),
(53, 'Rezervacija_2024-05-31_08', '4', '2', '2024-05-03', '10:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-31 05:32:59', '2024-05-31 05:32:59'),
(54, 'Rezervacija_2024-05-31_08', '4', '1', '2024-05-01', '14:00:00', '234', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-31 05:34:14', '2024-05-31 05:34:14'),
(55, 'Rezervacija_2024-05-31_08', '4', '2', '2024-05-06', '16:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-31 05:42:25', '2024-05-31 05:42:25'),
(56, 'Rezervacija_2024-05-31_08', '4', '1', '2024-05-03', '16:00:00', '234', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-31 05:43:52', '2024-05-31 05:43:52'),
(57, 'Rezervacija_2024-05-31_08', '4', '13', '2024-06-11', '14:00:00', '999', 'Taip', 'Apmokėta iš karto', 'Atšaukta', '', '2024-05-31 05:47:09', '2024-06-01 10:54:11'),
(58, 'Rezervacija_2024-05-31_18', '4', '2', '2024-05-03', '16:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-31 15:02:46', '2024-05-31 15:02:46'),
(59, 'Rezervacija_2024-05-31_18', '4', '1', '2024-05-04', '12:00:00', '234', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-31 15:06:08', '2024-05-31 15:06:08'),
(60, 'Rezervacija_2024-05-31_18', '4', '2', '2024-05-04', '16:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-31 15:08:27', '2024-05-31 15:08:27'),
(61, 'Rezervacija_2024-05-31_18', '4', '2', '2024-05-25', '12:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-31 15:09:59', '2024-05-31 15:09:59'),
(62, 'Rezervacija_2024-05-31_18', '4', '2', '2024-05-25', '12:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-31 15:11:34', '2024-05-31 15:11:34'),
(63, 'Rezervacija_2024-05-31_18', '4', '2', '2024-05-20', '10:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-31 15:16:07', '2024-05-31 15:16:07'),
(64, 'Rezervacija_2024-05-31_18', '4', '2', '2024-05-03', '12:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-31 15:17:57', '2024-05-31 15:17:57'),
(65, 'Rezervacija_2024-05-31_18', '4', '2', '2024-05-06', '16:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-31 15:21:00', '2024-05-31 15:21:00'),
(66, 'Rezervacija_2024-05-31_18', '4', '10', '2024-05-14', '14:00:00', '123123', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-31 15:21:23', '2024-05-31 15:21:23'),
(67, 'Rezervacija_2024-05-31_20', '8', '2', '2024-06-01', '10:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-31 17:00:36', '2024-05-31 17:00:36'),
(68, 'Rezervacija_2024-05-31_20', '4', '13', '2024-05-01', '16:00:00', '999', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-31 17:42:10', '2024-05-31 17:42:10'),
(69, 'Rezervacija_2024-05-31_20', '4', '13', '2024-05-02', '16:00:00', '999', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-31 17:42:19', '2024-05-31 17:42:19'),
(70, 'Rezervacija_2024-05-31_20', '4', '13', '2024-05-02', '16:00:00', '999', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-31 17:42:27', '2024-05-31 17:42:27'),
(71, 'Rezervacija_2024-05-31_20', '4', '13', '2024-05-02', '16:00:00', '999', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-05-31 17:43:04', '2024-05-31 17:43:04'),
(72, 'Rezervacija_2024-06-01_08', '4', '2', '2024-06-03', '12:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-06-01 05:11:04', '2024-06-01 05:11:04'),
(73, 'Rezervacija_2024-06-01_08', '4', '10', '2024-06-07', '10:00:00', '123123', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-06-01 05:14:11', '2024-06-01 05:14:11'),
(74, 'Rezervacija_2024-06-01_08', '4', '10', '2024-06-07', '16:00:00', '123123', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-06-01 05:22:09', '2024-06-01 05:22:09'),
(75, 'Rezervacija_2024-06-01_08', '4', '2', '2024-06-02', '10:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-06-01 05:27:17', '2024-06-01 05:27:17'),
(76, 'Rezervacija_2024-06-01_08', '4', '2', '2024-06-12', '14:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-06-01 05:41:55', '2024-06-01 05:41:55'),
(77, 'Rezervacija_2024-06-01_08', '4', '2', '2024-06-04', '10:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-06-01 05:43:26', '2024-06-01 05:43:26'),
(78, 'Rezervacija_2024-06-01_08', '4', '2', '2024-06-28', '14:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-06-01 05:44:26', '2024-06-01 05:44:26'),
(79, 'Rezervacija_2024-06-01_08', '4', '1', '2024-06-30', '12:00:00', '234', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-06-01 05:44:49', '2024-06-01 05:44:49'),
(80, 'Rezervacija_2024-06-01_08', '4', '1', '2024-06-22', '14:00:00', '234', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-06-01 05:45:13', '2024-06-01 05:45:13'),
(81, 'Rezervacija_2024-06-01_08', '4', '1', '2024-06-01', '10:00:00', '234', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-06-01 05:45:43', '2024-06-01 05:45:43'),
(82, 'Rezervacija_2024-06-01_08', '4', '1', '2024-06-23', '12:00:00', '234', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-06-01 05:46:16', '2024-06-01 05:46:16'),
(83, 'Rezervacija_2024-06-01_09', '4', '1', '2024-06-02', '10:00:00', '234', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-06-01 06:37:16', '2024-06-01 06:37:16'),
(84, 'Rezervacija_2024-06-01_09', '4', '1', '2024-06-23', '10:00:00', '234', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-06-01 06:46:38', '2024-06-01 06:46:38'),
(85, 'Rezervacija_2024-06-01_09', '4', '2', '2024-06-02', '14:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-06-01 06:51:57', '2024-06-01 06:51:57'),
(86, 'Rezervacija_2024-06-01_10', '4', '2', '2024-06-05', '10:00:00', '30', 'Taip', 'Mokėta dalimis', 'Pateikta dalinai apmokėta', '', '2024-06-01 07:03:03', '2024-06-01 07:03:03'),
(87, 'Rezervacija_2024-06-01_10', '4', '2', '2024-06-11', '12:00:00', '30', 'Taip', 'Apmokėta iš karto', 'Pateikta apmokėta', '', '2024-06-01 07:03:32', '2024-06-01 07:03:32');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `roleName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `roleName`) VALUES
(1, 'Vartotojas'),
(2, 'Fotografas'),
(3, 'Darbuotojas');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `detailed_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `detailed_description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`, `detailed_description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Naujas KLAIDA', 'asdsad', '234', 'Assad', 'images/test.jpg', '2024-05-11 15:35:32', '2024-05-14 14:52:49'),
(2, 'Fotke su gandrais', 'Na cia tai aprasymas', '30', 'Mano detalus aprasymas', 'images/ahah.jpg', '2024-05-11 16:39:07', '2024-05-14 12:29:47'),
(10, 'dsad', 'asdsda', '123123', 'sss', 'images/ahah.jpg', '2024-05-11 16:39:07', '2024-05-13 19:06:56'),
(13, 'dsasd', 'adsdas', '999', 'asdasdds', 'images/dice-1963036_1280.jpg', '2024-05-14 14:52:34', '2024-05-14 14:52:34');

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
('517ayDJ10yx3O1nbNZq5T4JyX1a2pn3oY0WvB7KE', 4, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVjdTMjZodkdrZWVrSWtRaklwdHpPalNaWXJDZERaRGMxR1ZoeHRESCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC91cGNvbWluZy1ldmVudHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O30=', 1717236241),
('5q6A2YjCvpYlPir9lWq9d4wyBXF9dndIGiWQeoBH', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidWpQVU85Q280U0Z4QVFrV1F5Y3JqQUtCUmhKNTBrMlg4ZkJmVUE3aSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS8yMDI0LTA2LTI4LzE0OjAwLzMwL0FwbW9rJUM0JTk3dGElMjBpJUM1JUExJTIwa2FydG8vMi80L05PVC9OT1QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717231469),
('7Y66iB9t3MgPw1yrnEC5xRw9S4O6qS7no1Chs0ns', 4, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZE1XSWZMc2lmWTZ5clhUY21PYW84MDhMZU9lcFV0NGo0WDNFOFE5eCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC93b3JrZXItc2VydmljZXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O30=', 1717250118),
('8BelySYXSqqFlqeBK58osMnNqL9rZTP849lr7G4k', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQkNKRURGaGtGYTRIbVZWQU9SRlJydWlzV3B2Q1hURTFNMkdmYUxOQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS91bmRlZmluZWQvdW5kZWZpbmVkL3VuZGVmaW5lZC91bmRlZmluZWQvdW5kZWZpbmVkL3VuZGVmaW5lZC91bmRlZmluZWQvdW5kZWZpbmVkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1717229619),
('9C8O2BU5hYwzJTKrE0Fyf0Sm6WGZ6yYuR3MJhVxT', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYnkyTHE2TzBnNWJReTAxcW5pZGllRlZQUVZSOXkwVXJ0bndocUVpQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTI1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS8yMDI0LTA2LTIzLzEyOjAwLzIzNC9BcG1vayVDNCU5N3RhJTIwaSVDNSVBMSUyMGthcnRvLzEvNC9BSEFIQUhBSEFBSEFIQUhIQUhBSEFBLzE4LDE3LCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1717231579),
('9O3T4m4bWqeUlCTRGy969AkUDXKr9Q5KczZvsxPn', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiekV1UVRNbjV5ajVkaUxTRVBGdDZ3c3hpQWRIQjdIQkF2OTlYb2FiNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS91bmRlZmluZWQvdW5kZWZpbmVkL3VuZGVmaW5lZC91bmRlZmluZWQvdW5kZWZpbmVkL3VuZGVmaW5lZC91bmRlZmluZWQvdW5kZWZpbmVkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1717230083),
('aLK69TDCdJgwCcVYXYVuUg7fv4qc11S2IH0193uZ', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTkFtaWhnRVQ5Q1ZlTTd0SUVVWGRtOE03dG4zNEpWQ0pMUUlWdzJkTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6OTU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZXNlcnZhdGlvbl9kb25lLzIwMjQtMDYtMDUvMTA6MDAvMzAvTW9rJUM0JTk3dGElMjBkYWxpbWlzLzIvNC9OT1QvMTksMTgsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1717236186),
('B8MpgkQJulZTTldY7VvWzKLz1Iu1iatLifKtY0E4', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVWpTTUVvRlN1QXk3ZDhQT1B0aEVPMVZrcjBwM3R5dGhmNk9RM0szMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS8yMDI0LTA2LTIyLzE0OjAwLzIzNC9BcG1vayVDNCU5N3RhJTIwaSVDNSVBMSUyMGthcnRvLzEvNC9BdHNha3ltYXMlMjBBQUEvTk9UIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1717231516),
('BuMuWFv2vuUEnm8fPpPTSwTHMh3RdjwY6LryaMda', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaGFGdk9MOEdoWVNxZzlSQjM1bUpxc3hVVmNENlBqZmYwMWswTjdtMSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS91bmRlZmluZWQvdW5kZWZpbmVkL3VuZGVmaW5lZC91bmRlZmluZWQvdW5kZWZpbmVkL3VuZGVmaW5lZC91bmRlZmluZWQvdW5kZWZpbmVkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1717234640),
('cx8IERIbnYE0GlsxEXln3tnwof76py14KJ4tLXtb', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSXpQSUIyV00zY1RBdXk4d0UzNmJKc3ZqZG9zdHkyRmYwSjhFY0cxViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS91bmRlZmluZWQvdW5kZWZpbmVkL3VuZGVmaW5lZC91bmRlZmluZWQvdW5kZWZpbmVkL3VuZGVmaW5lZC91bmRlZmluZWQvdW5kZWZpbmVkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1717235521),
('DILYvpoNcyjqDSXDhuDMqyQ9VB8sVQGlqJBGEUBQ', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV2NyQVJkMjN1MndXZVB4NGZtQ09jQTVnenNTYW1qTmJEaTZQRnBVcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS91bmRlZmluZWQvdW5kZWZpbmVkL3VuZGVmaW5lZC91bmRlZmluZWQvdW5kZWZpbmVkL3VuZGVmaW5lZC91bmRlZmluZWQvdW5kZWZpbmVkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1717230739),
('EB79NpXMrRJjlRlPuYxUCSsPOW5NzQB2abc9dmck', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieXVva2ZzVmxjNDhHWG9QMEJmZFFjYzE4M3dGRmRvN3BGRXNDNzA2VCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS91bmRlZmluZWQvdW5kZWZpbmVkL3VuZGVmaW5lZC91bmRlZmluZWQvdW5kZWZpbmVkL3VuZGVmaW5lZC91bmRlZmluZWQvdW5kZWZpbmVkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1717230814),
('IYQJMQnKFRb9BbCFO2h6EFVbTOyHLlUBol282Ja0', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSFhFVXlqU3pTRU8xMjVpeTdna2ZKOElTZEZaS21lcUx2dHVPQkY3SSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS8yMDI0LTA2LTAxLzEwOjAwLzIzNC9BcG1vayVDNCU5N3RhJTIwaSVDNSVBMSUyMGthcnRvLzEvNC9UZXN0aW51a2l1eC8xOSwxOCwxNywiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717231546),
('kLpV0Wfg5I4KIzWGMcV1KbFg0NuVMvw5RROxFNVQ', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibWpDSzRidWwxR3dQdEZPNzJJYU9oZWdwV3plT2E2QjRTWkE5SDkxWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS8yMDI0LTA2LTEyLzE0OjAwLzMwL0FwbW9rJUM0JTk3dGElMjBpJUM1JUExJTIwa2FydG8vMi80L05PVC9OT1QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717231318),
('MhzHi5381cVWGRzuzQ7PWApXJZCWjA6o5H6yZ0je', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSXFIYmUxM1RvZ295VFIzdThybkpFM0kzTWZmeXY1OXVxOXpmaktVcyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS8yMDI0LTA2LTAyLzE0OjAwLzMwL0FwbW9rJUM0JTk3dGElMjBpJUM1JUExJTIwa2FydG8vMi80L05PVC9OT1QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717235520),
('pBlNlMcFSGwOk9woRXvbuKXxEmaq21xXBhZupV7j', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFcwSVpaTnZTZjlVWGkxaUJaOVAwS1BvNFJxYVNHSjhVYnFOZXJRMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS8yMDI0LTA2LTAyLzEwOjAwLzMwL0FwbW9rJUM0JTk3dGElMjBpJUM1JUExJTIwa2FydG8vMi80L2FzZC8xNiwyMCwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717230440),
('PpaCVWFrIwG2P7m8Uxfs5r3KRi8GBraGONS8Dgm4', 8, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.2.1 Safari/605.1.15', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNDVFd3FWVUptWEJWMUU3anpGQkNhckRFRnYwdVoyNDRCZno2MkJFeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kb25lLWV2ZW50cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjg7fQ==', 1717234240),
('q5glYXTJABCS7e95dVj1RUGVFTZQKllAqpdnIjCa', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidlpoUjZaZ1d3VkI2djkzZmlHbnRySDg3QkQ4QVRNRFNzMmFMQWhNVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS91bmRlZmluZWQvdW5kZWZpbmVkL3VuZGVmaW5lZC91bmRlZmluZWQvdW5kZWZpbmVkL3VuZGVmaW5lZC91bmRlZmluZWQvdW5kZWZpbmVkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1717230554),
('Q8Qjqsb7FdHsxo6qdNRMuVgzvGMUCiFsM7RcpMa3', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZmxycWhadkFkWmJFbFlHaHczbm5MSVNkZFpMbjk3TmgxOWZCTWgxYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTEwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS8yMDI0LTA2LTA3LzE2OjAwLzEyMzEyMy9BcG1vayVDNCU5N3RhJTIwaSVDNSVBMSUyMGthcnRvLzEwLzQvc3NzLzE5LDE4LCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1717230131),
('tarZoqIaswDIBX32bEJAyucOnjuUwiqG7RaPaROJ', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQUpXcGJrcjZrQWZQRVc0RmpFYTBsR3JPY09yME5PRmlSQnFDMkppViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS8yMDI0LTA2LTIzLzEwOjAwLzIzNC9BcG1vayVDNCU5N3RhJTIwaSVDNSVBMSUyMGthcnRvLzEvNC9OT1QvTk9UIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1717235200),
('tYwogy19r9VRX56yaFNNI1uvxDQEypmtylIn0qBq', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiek1oajRwSmcwUHlwajc5dGl4N21jS2NzdUZJVktoc3hCeW1MdzVMQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS8yMDI0LTA2LTA3LzEwOjAwLzEyMzEyMy9BcG1vayVDNCU5N3RhJTIwaSVDNSVBMSUyMGthcnRvLzEwLzQvc3NzLzE5LDE4LDIwLDE2LCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1717229654),
('Ulqqi2sdtrYSwZrdcWLisJbFXhRMiOqfFkoB5L9R', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNE1LaEpZaTY1OVBKYmJMRkV5NVAyckdacTF0bWpRb0I1VFlRZlh6TSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS8yMDI0LTA2LTAyLzEwOjAwLzIzNC9BcG1vayVDNCU5N3RhJTIwaSVDNSVBMSUyMGthcnRvLzEvNC9OT1QvTk9UIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1717234639),
('Yb03gFbnfoxIQ6sGNQS1ml6ejjZ4Da8sCmz6SRy6', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMXBSR2h3QUM5QUZCU2Z2b3hLU3dUWWlqQ2hLRDI3OWlhcUg5VXE4eiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS8yMDI0LTA2LTExLzEyOjAwLzMwL0FwbW9rJUM0JTk3dGElMjBpJUM1JUExJTIwa2FydG8vMi80L2FzZGFzL05PVCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1717236215),
('Ystt8MXrLTB0CmXfkiplvec57sRMLRKyZi2NJJU0', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZzZLYVl6U2NyTmR5cGkyVGVoa3RGT0tHWUpJeVdqaG9Ka0Z2SVU1eiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS8yMDI0LTA2LTA0LzEwOjAwLzMwL0FwbW9rJUM0JTk3dGElMjBpJUM1JUExJTIwa2FydG8vMi80L05PVC9OT1QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1717231408),
('yzZNxdWs2l9qZT6Am5dGKy1qW8KNrRizABasWhv3', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidTJ0cDJKb3lNUkE5RFdpSkZING1iY0FXZ2tZdDB3MmptbEVsa2RWQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTEyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS8yMDI0LTA2LTMwLzEyOjAwLzIzNC9BcG1vayVDNCU5N3RhJTIwaSVDNSVBMSUyMGthcnRvLzEvNC9OT1QvMTYsMjAsMTcsMTgsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1717231491),
('ZIFGozwgvxTbANFQldf5XOB2TmC1SYbjfb3X64vz', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT0xLakFJOG53a21DZEdXRnVyM1UzMWRiOFQ0QWJnN3dveWMxVTNNMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTA3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS8yMDI0LTA2LTAzLzEyOjAwLzMwL0FwbW9rJUM0JTk3dGElMjBpJUM1JUExJTIwa2FydG8vMi80L3NzL3VuZGVmaW5lZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1717229468),
('ZThWpR9xbL8ngWqpBu9gdWf7RLh30V2XeuvRRbxo', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYkdHeGFnMkJlVnlzZmRIaFppVnBEb0R4R1k4TGlrZk5TcmlZVm95eCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS91bmRlZmluZWQvdW5kZWZpbmVkL3VuZGVmaW5lZC91bmRlZmluZWQvdW5kZWZpbmVkL3VuZGVmaW5lZC91bmRlZmluZWQvdW5kZWZpbmVkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1717230667),
('zxRTvmq52M3NURN7gJiK6TZnuDvm5uT5dbIT9AkB', NULL, '127.0.0.1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidzNHaXFuWG9Oa2czRVQ0ZFZLQ2FMU0JvTEpLMnlCcVFyZ2dLbVFWUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcmVzZXJ2YXRpb25fZG9uZS91bmRlZmluZWQvdW5kZWZpbmVkL3VuZGVmaW5lZC91bmRlZmluZWQvdW5kZWZpbmVkL3VuZGVmaW5lZC91bmRlZmluZWQvdW5kZWZpbmVkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1717236187);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'Užsiregistravęs vartotojas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phoneNumber`, `role`) VALUES
(1, 'Kojalinis AHAHA', 'admins@gmails.com', NULL, '$2y$12$kDWkIpPOtxnGfJMEPLEMuOhuAaLxAxAZdJ5e.TQyjMSdsxZs1Oh8e', NULL, '2024-04-20 14:07:00', '2024-05-14 14:53:31', '+37061211232', 'Fotografas'),
(2, 'testinis ahahaaaaaaa', 'asdds@gmail.com', NULL, '$2y$12$6lZ3Ed3CgpLAzg69c/tGSO90kipmzOE1IZIT3/o9bt6gisKHqDJ1O', NULL, '2024-04-20 14:07:51', '2024-05-13 19:27:59', '+37069222121', 'Vartotojas'),
(3, 'Lukas Emilijas', 'admin@gmail.com', NULL, '$2y$12$Lb/VWgUlVUzbCIC3CHMkYe/Ss549QvKwf43YEABfPfFs6eI.0DcSy', NULL, '2024-04-20 14:09:19', '2024-05-13 19:28:00', '+37061211213', 'Vartotojas'),
(4, 'adminas', 'lukaskojalad@gmail.com', NULL, '$2y$12$pqWI6ZeN4r5RYMB3aHW8Fex/FEwEaR2wDL0GJu2jWgnzd9KhvT.J6', NULL, '2024-05-10 17:17:37', '2024-05-14 14:57:48', '+37062122123', 'Fotografas'),
(5, 'asd asdsa', 'ssslukas@asd.com', NULL, '$2y$12$HxrhyuYIVE/xxFZvtfg6hu7FYR.gf5WnOCf/kK/426D73GpQtAwzS', NULL, '2024-05-10 18:11:09', '2024-05-14 04:35:16', '+37069222121', 'Darbuotojas'),
(6, 'AA aaaaaa', 'lzzzzzukas@asd.com', NULL, '$2y$12$zwUfFYubaqB.OF7Yjrm3bOqQvE/njJTElsCNJrIQ1Ffk9Cc7lHFv2', NULL, '2024-05-10 18:27:38', '2024-05-13 19:28:11', '+37061211231', 'Vartotojas'),
(7, 'adm adm', 'adm@adm.com', NULL, '$2y$12$ocJ1lbFJqNd6y.6CN/4TaOQBNejJwsdSZVimFXQGxJ2IqP6DKM7Aa', NULL, '2024-05-13 15:13:47', '2024-05-13 19:28:13', '+37062122123', 'Vartotojas'),
(8, 'Danielius', 'sss@sss.com', NULL, '$2y$12$BpfFuqST7lB2o6/R/oklOu1A/OUk67R/g5aYQ1CVBscjp.jBUT35K', NULL, '2024-05-14 14:51:58', '2024-05-14 14:51:58', '+37062322321', 'Vartotojas');

-- --------------------------------------------------------

--
-- Table structure for table `workers_services`
--

CREATE TABLE `workers_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `workerId` varchar(255) NOT NULL,
  `workerPrice` varchar(255) NOT NULL,
  `workerServiceTitle` varchar(255) NOT NULL,
  `workserServiceDescription` varchar(255) NOT NULL,
  `workerServiceType` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workers_services`
--

INSERT INTO `workers_services` (`id`, `workerId`, `workerPrice`, `workerServiceTitle`, `workserServiceDescription`, `workerServiceType`, `created_at`, `updated_at`) VALUES
(6, '4', '123', 'adsdasddsa', 'asdads', 'ads', '2024-05-31 21:04:11', '2024-05-31 21:04:11'),
(7, '4', '123', 'adssad', 'adsads', 'asdd', '2024-05-31 21:04:43', '2024-05-31 21:04:43'),
(8, '4', '12', 'Jou jou', 'Aha', '1221', '2024-05-31 21:05:58', '2024-05-31 21:05:58'),
(9, '4', '333', 'asdsda', 'assad', 'asd', '2024-05-31 21:06:04', '2024-05-31 21:06:04'),
(10, '4', '123', 'ddddd', 'dd', 'ddd', '2024-05-31 21:08:19', '2024-05-31 21:08:19'),
(11, '4', '1113', 'asdasd', 'dsads', 'asd', '2024-05-31 21:09:10', '2024-05-31 21:09:10'),
(12, '4', '12', 'Kleckas', 'Asad', '123', '2024-05-31 21:09:32', '2024-05-31 21:09:32'),
(13, '4', '123', 'dsasd', 'asad', 'asd', '2024-05-31 21:10:24', '2024-05-31 21:10:24'),
(14, '4', '132', 'asd', 'asad11', 'asd', '2024-05-31 21:11:07', '2024-05-31 21:11:07'),
(15, '4', '123', 'Testinukas', 'asd', 'asdd', '2024-05-31 21:12:10', '2024-05-31 21:12:10'),
(16, '4', '10', 'asdd', 'asd', 'Visažistas', '2024-05-31 21:15:41', '2024-05-31 21:49:57'),
(17, '4', '25', 'assd', 'asdsa', 'Plaukų stilistas', '2024-05-31 21:16:13', '2024-05-31 21:50:03'),
(18, '4', '100', 'Testinukas dar vienas', 'Testuojame', 'Plaukų stilistas', '2024-05-31 21:54:30', '2024-05-31 21:54:30'),
(19, '4', '25', 'Ir dar vienas', 'Tesas', 'Plaukų stilistas', '2024-05-31 21:54:39', '2024-05-31 21:54:39'),
(20, '4', '14', 'Na ir visazitas', 'Vienas', 'Visažistas', '2024-05-31 21:54:46', '2024-05-31 21:54:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_services`
--
ALTER TABLE `additional_services`
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
-- Indexes for table `communication_channel`
--
ALTER TABLE `communication_channel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `workers_services`
--
ALTER TABLE `workers_services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_services`
--
ALTER TABLE `additional_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `communication_channel`
--
ALTER TABLE `communication_channel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `workers_services`
--
ALTER TABLE `workers_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
