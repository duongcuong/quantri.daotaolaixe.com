-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th1 01, 2025 lúc 08:01 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `proj_quanlydayhoc`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `activities`
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE IF NOT EXISTS `activities` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `related_type` enum('lead','opportunity') NOT NULL,
  `related_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('email','call','meeting','task') NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `assigned_to` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','in_progress','completed','cancelled') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `activities_assigned_to_foreign` (`assigned_to`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT 0,
  `dob` date DEFAULT NULL,
  `identity_card` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `rank` varchar(255) DEFAULT NULL,
  `license` varchar(255) DEFAULT NULL,
  `card_name` varchar(255) DEFAULT NULL,
  `card_number` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `thumbnail` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `gender`, `dob`, `identity_card`, `address`, `rank`, `license`, `card_name`, `card_number`, `email_verified_at`, `password`, `status`, `thumbnail`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'duongdinhcuong.20121992@gmail.com', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$YiBLLIB6AHGWJhdqGNU2XO1QwDV4SL1S0b1KT1kP0Gy8tt2/UHbe6', 1, NULL, 'af29RM1abc0wu58Q9OLQ8cUMoaZiACYewwgM7RIhsJ4Eokdjo1aEtx1DjHWi', '2024-12-17 15:39:15', '2024-12-17 18:29:28'),
(11, 'Giáo viên 1', 'abc@gmail.com', 0, '2024-12-19', '0394039403', NULL, '[\"A2\",\"B1\",\"C\"]', NULL, NULL, NULL, NULL, '$2y$10$1tu/X12cMtHLtz1YcwqXee4RWSjtMFL.S0NFaL7WU6F/FhYKJ800O', 1, NULL, NULL, '2024-12-17 18:29:13', '2024-12-19 10:54:17'),
(12, 'Quang Tèo', 'abcc@gmail.com', 0, '2024-12-18', '0394039403', 'Phú thọ', '[\"A2\",\"B1\"]', '0394039043', '39490394', '394039403', NULL, '$2y$10$wEXrsttItKU.6NE81MCt8ekc2Y63xaqZHFOWqt8.NJxmQQz77e43G', 1, NULL, NULL, '2024-12-18 10:25:58', '2024-12-19 10:53:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_role`
--

DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE IF NOT EXISTS `admin_role` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_role_admin_id_foreign` (`admin_id`),
  KEY `admin_role_role_id_foreign` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin_role`
--

INSERT INTO `admin_role` (`id`, `admin_id`, `role_id`, `created_at`, `updated_at`) VALUES
(16, 1, 1, NULL, NULL),
(18, 11, 5, NULL, NULL),
(19, 12, 5, NULL, NULL),
(20, 12, 8, NULL, NULL),
(21, 11, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `rank_gp` varchar(255) NOT NULL,
  `number_bc` varchar(255) NOT NULL,
  `date_bci` date NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `number_students` int(11) DEFAULT NULL,
  `decision_kg` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `status` tinyint(255) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `courses_code_unique` (`code`),
  UNIQUE KEY `courses_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `courses`
--

INSERT INTO `courses` (`id`, `code`, `name`, `rank`, `rank_gp`, `number_bc`, `date_bci`, `start_date`, `end_date`, `number_students`, `decision_kg`, `duration`, `status`, `created_at`, `updated_at`) VALUES
(1, 'sdfsd', 'Khoá 8', 'A2', 'A1', 'sdfdsf', '2024-12-19', '2024-12-19', '2024-12-19', 12323, '343d', 22, 1, '2024-12-19 05:02:21', '2024-12-25 18:18:38'),
(2, 'sdfsd2', 'Khoá 7', 'A1', 'A1', 'sdfdsf', '2024-12-19', '2024-12-19', '2024-12-19', 12334, '200', 44, 1, '2024-12-19 05:31:53', '2024-12-25 18:18:31'),
(3, 'MMM', 'Khoá 6', 'A1', 'A1', 'sdfdsf', '2024-12-18', '2024-12-11', '2024-12-18', 12, '343d', 22, 1, '2024-12-19 05:33:06', '2024-12-25 18:18:25'),
(4, 'XXX', 'Khoá 5', 'A1', 'A1', 'sdfdsf', '2024-12-11', '2024-12-19', '2024-12-20', 10, '343d', 99, 1, '2024-12-19 05:35:41', '2024-12-25 18:18:18'),
(5, 'HHH', 'Khoá 4', 'A1', 'A1', 'sdfsdfds', '2024-12-05', '2024-12-21', '2024-12-17', 44, '554', NULL, 1, '2024-12-19 07:53:39', '2024-12-25 18:18:13'),
(6, 'KKK', 'Khoá 3', 'A1', 'A1', 'sdfdsf', '2024-12-19', '2024-12-19', '2024-12-18', 3943, 'sfsdf', NULL, 1, '2024-12-19 07:54:53', '2024-12-25 18:18:07'),
(7, 'LLLLL', 'Khoá 2', 'A1', 'A1', 'sdfsdfds', '2024-12-19', '2024-12-20', '2024-12-10', 322, '445', 55578, 1, '2024-12-19 07:55:58', '2024-12-25 18:18:02'),
(8, 'MMMMM', 'Khoá 1', 'A1', 'A1', 'sdfdsf', '2024-12-23', '2024-12-23', '2024-12-26', 100, '200', 90, 1, '2024-12-23 16:21:08', '2024-12-25 18:17:56'),
(9, 'KKKKKK', 'Khoá học 9', 'A1', 'A1', 'sdfdsf', '2024-12-12', '2024-12-13', '2024-12-20', 22, '33', 11, 1, '2024-12-29 12:14:03', '2024-12-29 12:14:03'),
(10, 'LLLLLL', 'Khoá học 10', 'A1', 'A1', 'sdfsdfds', '2024-12-11', '2024-12-19', '2024-12-12', 10000, '220', NULL, 1, '2024-12-29 15:21:41', '2024-12-29 15:21:41'),
(11, 'CCC', 'Khoá học 11', 'A2', 'B1', 'sdfdsf', '2024-12-25', '2024-12-25', '2024-12-28', 22, '33', NULL, 1, '2024-12-29 15:22:14', '2024-12-29 15:22:14'),
(12, 'NN', 'Khoá học 12', 'A1', 'A1', 'sdfdsf', '2024-12-12', '2024-12-14', '2024-12-26', 444, '44', NULL, 1, '2024-12-29 15:23:02', '2024-12-29 15:23:02'),
(13, 'MMMM', 'Khoá học 13', 'A1', 'A1', 'sdfsdfds', '2024-12-26', '2024-12-26', '2024-12-27', 3, '42', 2, 1, '2024-12-29 15:31:24', '2024-12-29 15:34:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `course_users`
--

DROP TABLE IF EXISTS `course_users`;
CREATE TABLE IF NOT EXISTS `course_users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `basic_status` tinyint(4) NOT NULL DEFAULT 0,
  `shape_status` tinyint(4) NOT NULL DEFAULT 0,
  `road_status` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `chip_status` tinyint(4) NOT NULL DEFAULT 0,
  `hours` double(8,2) NOT NULL DEFAULT 0.00,
  `km` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_user_user_id_foreign` (`user_id`),
  KEY `course_user_course_id_foreign` (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `course_users`
--

INSERT INTO `course_users` (`id`, `user_id`, `course_id`, `basic_status`, `shape_status`, `road_status`, `status`, `chip_status`, `hours`, `km`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 1, 1, 1, 1, 103.00, 1000.00, '2024-12-19 14:28:24', '2024-12-29 15:50:51'),
(2, 1, 1, 1, 0, 0, 1, 0, 0.00, 0.00, '2024-12-19 14:37:05', '2024-12-23 15:37:22'),
(3, 1, 6, 0, 0, 0, 1, 0, 0.00, 0.00, '2024-12-23 15:38:06', '2024-12-25 14:32:46'),
(4, 1, 8, 2, 0, 2, 1, 0, 0.00, 0.00, '2024-12-25 14:24:02', '2024-12-25 14:32:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cron_logs`
--

DROP TABLE IF EXISTS `cron_logs`;
CREATE TABLE IF NOT EXISTS `cron_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `signature` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cron_logs`
--

INSERT INTO `cron_logs` (`id`, `signature`, `description`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 'pig:update-status', 'Update pig status', 'Update success', 1, '2024-01-16 05:00:25', '2024-01-16 05:00:25'),
(2, 'pig:update-status', 'Update pig status', 'Lỗi xảy ra: SQLSTATE[42S22]: Column not found: 1054 Unknown column \'signature2\' in \'field list\' (SQL: insert into `cron_logs` (`content`, `status`, `signature2`, `description`, `updated_at`, `created_at`) values (Update success, 1, pig:update-status, Update pig status, 2024-01-16 12:00:51, 2024-01-16 12:00:51))', 0, '2024-01-16 05:00:51', '2024-01-16 05:00:51'),
(3, 'pig:update-status', 'Update pig status', 'Update success', 1, '2024-01-16 07:13:02', '2024-01-16 07:13:02'),
(4, 'pig:update-status', 'Update pig status', 'Update success', 1, '2024-01-16 07:14:30', '2024-01-16 07:14:30'),
(5, 'pig:update-status', 'Update pig status', 'Update success', 1, '2024-01-16 07:16:40', '2024-01-16 07:16:40'),
(6, 'pig:update-status', 'Update pig status', 'Update success', 1, '2024-01-16 07:17:00', '2024-01-16 07:17:00'),
(7, 'pig:update-status', 'Update pig status', 'Update success', 1, '2024-01-16 07:18:00', '2024-01-16 07:18:00'),
(8, 'pig:update-status', 'Update pig status', 'Update success', 1, '2024-01-16 07:25:00', '2024-01-16 07:25:00'),
(9, 'pig:update-status', 'Update pig status', 'Update success', 1, '2024-01-16 10:48:24', '2024-01-16 10:48:24'),
(10, 'pig:update-status', 'Update pig status', 'Update success', 1, '2024-01-16 10:48:24', '2024-01-16 10:48:24'),
(11, 'pig:update-status', 'Update pig status', 'Update success', 1, '2024-01-16 10:48:37', '2024-01-16 10:48:37'),
(12, 'pig:update-status', 'Update pig status', 'Update success', 1, '2024-01-16 10:48:37', '2024-01-16 10:48:37'),
(13, 'pig:update-status', 'Update pig status', 'Update success', 1, '2024-01-16 10:48:43', '2024-01-16 10:48:43'),
(14, 'pig:update-status', 'Update pig status', 'Update success', 1, '2024-01-16 10:48:43', '2024-01-16 10:48:43'),
(15, 'pig:update-status', 'Update pig status', 'Update success', 1, '2024-01-16 23:00:00', '2024-01-16 23:00:00'),
(16, 'pig:update-status', 'Update pig status', 'Update success', 1, '2024-01-16 23:00:00', '2024-01-16 23:00:00'),
(17, 'pig:notification', 'Send notification', 'Update success', 1, '2024-01-18 19:45:42', '2024-01-18 19:45:42'),
(18, 'pig:notification', 'Send notification', 'Update success', 1, '2024-01-18 19:46:19', '2024-01-18 19:46:19'),
(19, 'pig:notification', 'Send notification', 'Update success', 1, '2024-01-18 19:46:25', '2024-01-18 19:46:25'),
(20, 'pig:notification', 'Send notification', 'Update success', 1, '2024-01-18 19:46:26', '2024-01-18 19:46:26'),
(21, 'pig:notification', 'Send notification', 'Update success', 1, '2024-01-18 19:46:27', '2024-01-18 19:46:27'),
(22, 'pig:notification', 'Send notification', 'Update success', 1, '2024-01-18 19:55:36', '2024-01-18 19:55:36'),
(23, 'pig:notification', 'Send notification', 'Update success', 1, '2024-01-18 19:55:37', '2024-01-18 19:55:37'),
(24, 'pig:notification', 'Send notification', 'Update success', 1, '2024-01-18 19:55:38', '2024-01-18 19:55:38'),
(25, 'pig:notification', 'Send notification', 'Update success', 1, '2024-01-18 19:55:39', '2024-01-18 19:55:39'),
(26, 'pig:notification', 'Send notification', 'Update success', 1, '2024-01-18 19:55:39', '2024-01-18 19:55:39'),
(27, 'pig:notification', 'Send notification', 'Update success', 1, '2024-01-18 19:55:40', '2024-01-18 19:55:40'),
(28, 'pig:notification', 'Send notification', 'Update success', 1, '2024-01-18 20:00:45', '2024-01-18 20:00:45'),
(29, 'pig:notification', 'Send notification', 'Update success', 1, '2024-01-18 20:00:46', '2024-01-18 20:00:46'),
(30, 'pig:notification', 'Send notification', 'Update success', 1, '2024-01-18 20:00:47', '2024-01-18 20:00:47'),
(31, 'pig:notification', 'Send notification', 'Update success', 1, '2024-01-18 20:00:48', '2024-01-18 20:00:48'),
(32, 'pig:notification', 'Send notification', 'Update success', 1, '2024-01-18 20:00:48', '2024-01-18 20:00:48'),
(33, 'pig:notification', 'Send notification', 'Update success', 1, '2024-01-18 20:00:49', '2024-01-18 20:00:49'),
(34, 'pig:notification', 'Send notification', 'Update success', 1, '2024-01-18 20:00:50', '2024-01-18 20:00:50'),
(35, 'pig:notification', 'Send notification', 'Update success', 1, '2024-01-18 20:00:51', '2024-01-18 20:00:51'),
(36, 'pig:notification', 'Send notification', 'Update success', 1, '2024-01-18 20:07:20', '2024-01-18 20:07:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `fees`
--

DROP TABLE IF EXISTS `fees`;
CREATE TABLE IF NOT EXISTS `fees` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `amount` double(15,2) NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `is_received` tinyint(1) NOT NULL DEFAULT 0,
  `course_user_id` bigint(20) UNSIGNED NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fees_admin_id_foreign` (`admin_id`),
  KEY `fees_course_user_id_foreign` (`course_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `fees`
--

INSERT INTO `fees` (`id`, `payment_date`, `amount`, `admin_id`, `is_received`, `course_user_id`, `note`, `created_at`, `updated_at`) VALUES
(1, '1992-03-01 17:00:00', 1000011.00, 1, 1, 2, 'sdfdsf', '2024-12-19 17:55:17', '2024-12-23 15:26:00'),
(2, '1992-03-09 17:00:00', 10003390.00, 11, 1, 1, 'sfsdfsdf', '2024-12-19 17:57:56', '2024-12-25 18:44:25'),
(3, '2024-12-25 17:00:00', 5000000.00, 11, 1, 1, 'sdfsdfds', '2024-12-25 17:13:58', '2024-12-25 17:13:58'),
(4, '2024-12-24 17:00:00', 1000.00, 1, 1, 1, 'sdfsdf', '2024-12-25 18:32:07', '2024-12-25 18:32:07'),
(5, '2024-12-24 17:00:00', 1000.00, 1, 1, 1, 'sdfsdf', '2024-12-25 18:32:07', '2024-12-25 18:32:07'),
(6, '2024-12-03 17:00:00', 400000.00, 1, 1, 1, NULL, '2024-12-25 18:32:38', '2024-12-25 18:32:38'),
(7, '2024-12-18 17:00:00', 9000.00, 1, 1, 2, NULL, '2024-12-25 18:44:48', '2024-12-25 18:44:48'),
(8, '2024-12-12 17:00:00', 3000.00, 1, 1, 1, 'sdfdsf', '2024-12-29 16:05:27', '2024-12-29 16:05:27'),
(9, '2024-12-24 17:00:00', 900000.00, 1, 1, 1, 'sdfdf', '2024-12-29 16:05:42', '2024-12-29 16:05:42'),
(10, '2024-11-29 17:00:00', 8000.00, 1, 1, 1, NULL, '2024-12-29 16:08:30', '2024-12-29 16:08:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `leads`
--

DROP TABLE IF EXISTS `leads`;
CREATE TABLE IF NOT EXISTS `leads` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `source` varchar(255) DEFAULT NULL,
  `interest_level` enum('low','medium','high') NOT NULL,
  `status` varchar(255) DEFAULT 'open',
  `assigned_to` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leads_user_id_foreign` (`user_id`),
  KEY `leads_assigned_to_foreign` (`assigned_to`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `leads`
--

INSERT INTO `leads` (`id`, `user_id`, `source`, `interest_level`, `status`, `assigned_to`, `created_at`, `updated_at`, `name`, `email`, `phone`, `address`, `description`, `dob`) VALUES
(1, 8, 'Trên mạng', 'low', 'Đang bàn bạc', 12, '2024-12-29 17:13:06', '2024-12-30 16:16:51', 'Trần C', 'abdd@gmail.com', '09078878', 'Hà Nội', NULL, '2024-12-30'),
(2, 8, 'Trên mạng', 'medium', 'Đang bàn bạc', 11, '2024-12-29 17:15:12', '2024-12-30 16:16:28', 'Nguyễn D', 'abdd@gmail.com', NULL, 'Hà Nội', NULL, '2024-12-30'),
(3, 1, 'Trên mạng', 'low', 'Đang bàn bạc', 11, '2024-12-29 17:19:18', '2024-12-30 16:14:44', 'Phan B', 'aaa@gmail.com', '34334343', 'Phú thọ HN', NULL, NULL),
(4, 1, 'Trên mạng', 'low', 'Đang bàn bạc', 12, '2024-12-29 17:34:03', '2024-12-29 17:34:03', 'Dương Cường', 'duongdinhcuong20121999@gmail.com', '09078878', 'Phú thọ', 'sdf', '2024-12-30'),
(5, 1, 'Trên mạng', 'low', 'Đang bàn bạc', 12, '2024-12-29 18:05:03', '2024-12-29 18:05:03', 'Học Viên 1', 'duongdinhcuong.20121992@gmail.com', '09078878', '3232', 'dsfdsfd', '2024-12-12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_11_073508_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2020_05_02_100001_create_filemanager_table', 1),
(6, '2021_05_18_073047_create_modules_table', 1),
(7, '2021_05_18_073324_create_permissions_table', 1),
(8, '2021_05_18_074727_create_permission_role_table', 1),
(9, '2021_05_28_125652_create_pages_table', 1),
(10, '2021_06_01_040453_create_settings_table', 1),
(11, '2021_06_04_131030_create_categories_table', 1),
(12, '2023_11_30_082610_create_pigs_table', 1),
(13, '2023_12_07_021946_create_setting_expenses_table', 1),
(14, '2023_12_07_022412_create_setting_vaccines_table', 1),
(15, '2023_12_07_022955_create_setting_diseases_table', 1),
(16, '2023_12_07_023546_create_setting_breeds_table', 1),
(17, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(18, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(19, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(20, '2016_06_01_000004_create_oauth_clients_table', 2),
(21, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(22, '2024_12_16_215934_create_role_user_table', 3),
(23, '2024_12_17_131814_create_admins_table', 4),
(25, '2024_12_17_172841_create_admin_role_table', 5),
(27, '2024_12_17_220737_add_status_and_thumbnail_to_admins_table', 6),
(28, '2024_12_18_143527_add_teacher_fields_to_admins_table', 6),
(29, '2024_12_19_075311_create_courses_table', 7),
(30, '2024_12_19_075436_create_course_users_table', 8),
(31, '2024_12_19_075602_create_fees_table', 9),
(32, '2024_12_19_094211_update_courses_table', 10),
(33, '2024_12_19_164413_add_columns_to_users_table', 11),
(34, '2024_12_19_181806_add_status_to_course_user_table', 12),
(35, '2024_12_19_183507_rename_course_user_table_to_course_users', 13),
(36, '2024_12_19_221530_rename_course_user_id_to_course_id_in_fees_table', 14),
(37, '2024_12_19_233708_add_note_to_fees_table', 15),
(38, '2024_12_20_001759_rename_course_id_to_course_user_id_in_fees_table', 16),
(39, '2024_12_26_163116_create_leads_table', 17),
(40, '2024_12_30_002932_add_fields_to_leads_table', 18),
(41, '2024_12_30_231130_modify_status_nullable_in_leads_table', 19),
(43, '2025_01_02_012107_create_activities_table', 20),
(44, '2025_01_02_013906_add_status_to_activities_table', 21);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `modules_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `modules`
--

INSERT INTO `modules` (`id`, `name`, `created_at`, `updated_at`) VALUES
(13, 'Quản lý người dùng', '2024-12-17 19:05:19', '2024-12-17 19:13:09'),
(15, 'Quản lý giáo viên', '2024-12-18 02:15:22', '2024-12-18 02:15:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pig_id` bigint(20) DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `status` tinyint(4) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci COMMENT='Thông báo lịch của từng con';

--
-- Đang đổ dữ liệu cho bảng `notifications`
--

INSERT INTO `notifications` (`id`, `pig_id`, `content`, `status`, `type`, `created_at`, `updated_at`) VALUES
(109, 115, '{\"date\":\"19\\/01\\/2024\",\"code\":\"ABCCDAF\",\"pig_type\":\"center\",\"pig_type_name\":\"Lợn trung tâm\",\"status\":\"success\",\"message\":\"Hôm nay\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/app\\/pig-centers\\/115\\/edit\"}', 1, 'Kiểm tra có chửa', '2024-01-18 20:07:20', '2024-01-18 20:24:55'),
(110, 115, '{\"date\":\"23\\/01\\/2024\",\"code\":\"ABCCDAF\",\"pig_type\":\"center\",\"pig_type_name\":\"Lợn trung tâm\",\"status\":\"warning\",\"message\":\"Còn 4 ngày\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/app\\/pig-centers\\/115\\/edit\"}', 0, 'Tiêm Vaccine', '2024-01-18 20:07:20', '2024-01-18 20:07:20'),
(111, 112, '{\"date\":\"19\\/01\\/2024\",\"code\":\"ABCCDA\",\"pig_type\":\"center\",\"pig_type_name\":\"Lợn trung tâm\",\"status\":\"success\",\"message\":\"Hôm nay\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/app\\/pig-centers\\/112\\/edit\"}', 0, 'Dự sinh', '2024-01-18 20:07:20', '2024-01-18 20:07:20'),
(112, 112, '{\"date\":\"25\\/01\\/2024\",\"code\":\"ABCCDA\",\"pig_type\":\"center\",\"pig_type_name\":\"Lợn trung tâm\",\"status\":\"warning\",\"message\":\"Còn 6 ngày\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/app\\/pig-centers\\/112\\/edit\"}', 0, 'Tiêm Vaccine', '2024-01-18 20:07:20', '2024-01-18 20:07:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('cc8038c160eaed4edfc4e6c397c67df753cbd25a4f93b3c922fa57f70ca814b7777ea865d804110b', 1, 3, 'auth_api', '[]', 0, '2024-01-10 02:15:01', '2024-01-10 02:15:01', '2025-01-10 09:15:01'),
('f1c6b3e157533c71af7b2705e36ff088a7c88944f60e688518e9afca75a7600d692f809599a93a88', 1, 3, 'auth_api', '[]', 0, '2024-01-08 04:46:27', '2024-01-08 04:46:27', '2025-01-08 11:46:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(3, NULL, 'TTGVN Personal Access Client', '5XjlXoDyUV6roVkCndsZtcBUQGuHnq9trVc3cY1D', NULL, 'http://localhost', 1, 0, 0, '2024-01-08 04:46:13', '2024-01-08 04:46:13'),
(4, NULL, 'TTGVN Password Grant Client', 'Xb0fthesE4ZqL1Cr03DLCI4RwxZxxpxbd0SGI5w9', 'users', 'http://localhost', 0, 1, 0, '2024-01-08 04:46:13', '2024-01-08 04:46:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(2, 3, '2024-01-08 04:46:13', '2024-01-08 04:46:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `body` longtext DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `image`, `excerpt`, `body`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Page', 'page', NULL, 'This is page', '<h1>This is page seed</h1>', 'Page desc', 'page,about', 1, '2023-12-06 20:31:39', '2023-12-06 20:31:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('duongdinhcuong20121999@gmail.com', '$2y$10$vX5Gr914f1vQuY3z.7cU4uIEkZ4ap1RXeNzaZA7UspnjjP.DDDfOO', '2024-01-08 05:48:34'),
('duongdinhcuong.2012199@gmail.com', '$2y$10$p7zCBJNe62FYnKoyy7m87OqXTYzh9QcjdeqbrCR14aSi3erLdSzHC', '2024-12-16 14:21:02'),
('duongdinhcuong.20121992@gmail.com', '$2y$10$pOXSwChGaUDDroLcQg4VGeyd.6DnLrMzWC67vrGuS.X9o7HjWc.Me', '2024-12-16 14:27:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`),
  KEY `permissions_module_id_foreign` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `module_id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(43, 13, 'Danh sách', 'admins.admins.index', '2024-12-17 19:24:46', '2024-12-17 19:24:46'),
(44, 13, 'Thêm', 'admins.admins.create', '2024-12-18 02:15:46', '2024-12-18 02:15:46'),
(45, 15, 'Danh sách', 'admins.teachers.index', '2024-12-18 02:16:12', '2024-12-18 02:16:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(87, 43, 5, NULL, NULL),
(88, 45, 1, NULL, NULL),
(89, 43, 1, NULL, NULL),
(90, 44, 1, NULL, NULL),
(91, 45, 7, NULL, NULL),
(92, 43, 7, NULL, NULL),
(93, 44, 7, NULL, NULL),
(94, 45, 8, NULL, NULL),
(95, 43, 8, NULL, NULL),
(96, 44, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `deletable` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `deletable`, `created_at`, `updated_at`) VALUES
(1, 'Super admin', 'super-admin', 'This is super-admin', 0, '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(2, 'Admin', 'admin', 'This is admin', 0, '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(3, 'User', 'user', 'This is User', 0, '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(5, 'Giáo Viên', 'giao-vien', 'Đây là role dành cho giáo viên', 1, '2024-12-16 14:37:51', '2024-12-16 14:37:51'),
(7, 'Quản lý Sales', 'quan-ly-sales', NULL, 1, '2024-12-26 07:07:21', '2024-12-26 07:07:21'),
(8, 'Sale', 'sale', NULL, 1, '2024-12-29 16:57:18', '2024-12-29 16:57:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  KEY `role_user_role_id_foreign` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_title', 'Ecommerce', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(2, 'site_description', 'A laravel Ecommerce  web app.', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(3, 'site_address', 'Dhaka,Bangladesh', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(4, 'site_logo', NULL, '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(5, 'site_favicon', NULL, '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(6, 'mail_mailer', 'smtp', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(7, 'mail_host', 'smtp.mailtrap.io', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(8, 'mail_port', '2525', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(9, 'mail_username', 'admin@gmail.com', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(10, 'mail_password', 'admin', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(11, 'mail_encryption', 'TLS', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(12, 'mail_from_address', 'admin@gmail.com', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(13, 'mail_from_name', 'admin@gmail.com', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(14, 'db_connection', 'mysql', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(15, 'db_host', '127.0.0.1', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(16, 'db_port', '3306', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(17, 'db_database', 'ecommerce', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(18, 'db_username', 'admin', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(19, 'db_password', 'password', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(20, 'facebook_client_id', NULL, '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(21, 'facebook_client_secret', NULL, '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(22, 'google_client_id', NULL, '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(23, 'google_client_secret', NULL, '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(24, 'github_client_id', NULL, '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(25, 'github_client_secret', NULL, '2023-12-06 20:31:39', '2023-12-06 20:31:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT 0,
  `dob` date DEFAULT NULL,
  `identity_card` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `card_name` varchar(255) DEFAULT NULL,
  `card_number` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `thumbnail`, `email`, `gender`, `dob`, `identity_card`, `address`, `card_name`, `card_number`, `email_verified_at`, `password`, `status`, `remember_token`, `otp_expires_at`, `created_at`, `updated_at`) VALUES
(1, 'Học Viên 1', '74e1d3a7-a6f3-4373-859e-ca65830963e8.png', 'duongdinhcuong.20121992@gmail.com', 0, '2024-12-12', '0394039403', '3232', '39490394', 'ssdfdf', NULL, '$2y$10$YiBLLIB6AHGWJhdqGNU2XO1QwDV4SL1S0b1KT1kP0Gy8tt2/UHbe6', 1, NULL, NULL, '2023-12-06 20:31:39', '2024-12-19 10:55:30'),
(8, 'Học Viên 2', NULL, 'abdd@gmail.com', 0, '2024-12-30', '03940394032', 'Hà Nội', '3949039493', '39304933', NULL, '$2y$10$L5GeBo7ptd9nWfGtW5joZOBi7miCQ0W9N38PDaoEHto/bnNocjUgC', 1, NULL, NULL, '2024-12-30 16:03:03', '2024-12-30 16:03:03');

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `admin_role`
--
ALTER TABLE `admin_role`
  ADD CONSTRAINT `admin_role_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admin_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `course_users`
--
ALTER TABLE `course_users`
  ADD CONSTRAINT `course_user_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `fees`
--
ALTER TABLE `fees`
  ADD CONSTRAINT `fees_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fees_course_user_id_foreign` FOREIGN KEY (`course_user_id`) REFERENCES `course_users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `leads`
--
ALTER TABLE `leads`
  ADD CONSTRAINT `leads_assigned_to_foreign` FOREIGN KEY (`assigned_to`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `leads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
