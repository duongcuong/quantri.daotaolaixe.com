-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 19, 2024 lúc 08:20 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `proj_pigs`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `breedings`
--

DROP TABLE IF EXISTS `breedings`;
CREATE TABLE IF NOT EXISTS `breedings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pig_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Mã số tai con nái',
  `oestrous_day` timestamp NULL DEFAULT NULL,
  `breeding_date_first` timestamp NULL DEFAULT NULL,
  `male_first` bigint(20) UNSIGNED DEFAULT NULL,
  `breeding_date_second` timestamp NULL DEFAULT NULL,
  `male_second` bigint(20) UNSIGNED DEFAULT NULL,
  `week` int(11) DEFAULT NULL,
  `expected_pregnancy_day` timestamp NULL DEFAULT NULL,
  `pregnancy_day` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expected_birth_date` timestamp NULL DEFAULT NULL,
  `actual_date_of_birth` timestamp NULL DEFAULT NULL,
  `number_of_children_to_raise` int(11) DEFAULT NULL,
  `weaning_date` timestamp NULL DEFAULT NULL,
  `number_of_weaning` int(11) DEFAULT NULL,
  `result` int(11) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_breedings_pigs` (`pig_id`),
  KEY `FK_breedings_pigs_3` (`male_first`),
  KEY `FK_breedings_pigs_4` (`male_second`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `breedings`
--

INSERT INTO `breedings` (`id`, `pig_id`, `oestrous_day`, `breeding_date_first`, `male_first`, `breeding_date_second`, `male_second`, `week`, `expected_pregnancy_day`, `pregnancy_day`, `created_at`, `updated_at`, `expected_birth_date`, `actual_date_of_birth`, `number_of_children_to_raise`, `weaning_date`, `number_of_weaning`, `result`, `weight`) VALUES
(1, 112, '2023-12-31 17:00:00', '2024-01-05 17:00:00', NULL, '2024-01-05 17:00:00', NULL, 1, '2024-01-25 17:00:00', NULL, '2024-01-11 08:59:11', '2024-01-12 09:30:44', '2024-05-18 17:00:00', '2024-01-10 17:00:00', 100, NULL, NULL, 1, NULL),
(2, 115, '2024-01-06 17:00:00', '2024-01-11 17:00:00', NULL, '2024-01-11 17:00:00', NULL, 1, '2024-01-31 17:00:00', NULL, '2024-01-12 09:56:11', '2024-01-12 09:56:11', '2024-05-24 17:00:00', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 112, '2024-01-15 17:00:00', '2024-01-20 17:00:00', NULL, '2024-01-20 17:00:00', NULL, NULL, '2024-02-09 17:00:00', NULL, '2024-01-15 08:22:10', '2024-01-16 02:29:13', '2024-06-02 17:00:00', '2024-01-19 17:00:00', NULL, NULL, NULL, NULL, NULL),
(11, 112, '2024-01-15 17:00:00', '2024-01-20 17:00:00', NULL, '2024-01-20 17:00:00', NULL, NULL, '2024-02-09 17:00:00', '2024-01-14 17:00:00', '2024-01-16 02:28:01', '2024-01-16 02:36:03', '2024-06-02 17:00:00', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `icon`, `image`, `status`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'Home & Lifestyle', 'home-lifestyle', 'las la-home', 'images/categories/0613202104481060c58e0a2f0daLOW-RES-PARKER-KITCHEN-VIEW-2.jpg', 1, NULL, NULL, '2023-12-06 17:00:00', NULL),
(2, 'Sports & Outdoor', 'sports-outdoor', 'las la-futbol', 'images/categories/0613202108100360c5bd5b9727edepositphotos_32564723-stock-photo-sports-balls-a-lot-of.jpg', 1, NULL, NULL, '2023-12-06 17:00:00', NULL),
(3, 'Watches & Accessories', 'watches-accessories', 'las la-stopwatch', 'images/categories/0613202104434360c58cff0dfacwatch-glasses-fashion-accessory-accessories-watch-glasses-watch-accessory-png-800_395.jpg', 1, NULL, NULL, '2023-12-06 17:00:00', NULL),
(4, 'Men\'s Fashion', 'mens-fashion', 'las la-user-secret', 'images/categories/0613202104424160c58cc1e90e3LassoClipping-1.png', 1, NULL, NULL, '2023-12-06 17:00:00', NULL),
(5, 'Women\'s Fashion', 'womens-fashion', 'las la-user-nurse', 'images/categories/0613202104412460c58c746f2cf20200126_0043-Full-JPG-980x653.jpg', 1, NULL, NULL, '2023-12-06 17:00:00', NULL),
(6, 'Babies & Toys', 'babies-toys', 'las la-baby-carriage', 'images/categories/0613202104395260c58c1860384baby-toys-many-colorful-isolated-white-background-30477357.jpg', 1, NULL, NULL, '2023-12-06 17:00:00', NULL),
(7, 'Health & Beauty', 'health-beauty', 'las la-hand-holding-heart', 'images/categories/0613202104375960c58ba7701dagrocery-store-icon-set-color-8-.jpg', 1, NULL, NULL, '2023-12-06 17:00:00', NULL),
(8, 'TV & Home Appliances', 'tv-home-appliances', 'las la-campground', 'images/categories/0613202104360360c58b336823bpng-transparent-smart-tv-television-refrigerator-icon-appliances-computer-home-appliance-household-appliances.png', 1, NULL, NULL, '2023-12-06 17:00:00', NULL),
(9, 'Electronics Accessories', 'electronics-accessories', 'las la-desktop', 'images/categories/0613202104342260c58ace62374preview_10654985.jpg', 1, NULL, NULL, '2023-12-06 17:00:00', NULL),
(10, 'Electronics device', 'electronics-device', 'las la-microchip', 'images/categories/0613202104230060c58824b947celectronics-goods-500x500.png', 1, NULL, NULL, '2023-12-06 17:00:00', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

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
-- Cấu trúc bảng cho bảng `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_expense_id` int(11) UNSIGNED NOT NULL,
  `weight` float DEFAULT NULL,
  `money` float DEFAULT NULL,
  `pepper_day` timestamp NULL DEFAULT NULL,
  `note` longtext DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `setting_expense_id` (`setting_expense_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `expenses`
--

INSERT INTO `expenses` (`id`, `setting_expense_id`, `weight`, `money`, `pepper_day`, `note`, `type`, `created_at`, `updated_at`) VALUES
(16, 33, 349389, 938493, '2023-12-04 17:00:00', NULL, 'expense', '2023-12-25 09:07:29', '2023-12-25 09:10:09'),
(17, 35, 39403, 454, '2023-12-03 17:00:00', 'dfdsf sdfsd', 'expense', '2023-12-25 09:07:49', '2023-12-25 09:07:49'),
(18, 34, 343, 433, '2023-12-11 17:00:00', '3sdfsd', 'expense', '2023-12-25 09:09:59', '2023-12-25 09:09:59'),
(19, 36, 343, 4544, '2023-12-24 17:00:00', 'dsfdsf', 'food', '2023-12-25 09:11:26', '2023-12-25 09:11:36'),
(20, 36, 343, 343, '2023-12-09 17:00:00', 'dsfds', 'food', '2023-12-25 09:11:44', '2023-12-25 09:11:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `filemanager`
--

DROP TABLE IF EXISTS `filemanager`;
CREATE TABLE IF NOT EXISTS `filemanager` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ext` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` double(8,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `absolute_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`extra`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `healths`
--

DROP TABLE IF EXISTS `healths`;
CREATE TABLE IF NOT EXISTS `healths` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_disease_id` int(11) UNSIGNED NOT NULL,
  `pig_id` int(11) NOT NULL,
  `day_of_illness` timestamp NULL DEFAULT NULL,
  `medicine` varchar(255) DEFAULT NULL,
  `day_of_recovery` timestamp NULL DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `setting_disease_id` (`setting_disease_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `healths`
--

INSERT INTO `healths` (`id`, `setting_disease_id`, `pig_id`, `day_of_illness`, `medicine`, `day_of_recovery`, `note`, `created_at`, `updated_at`) VALUES
(71, 1, 120, '2024-01-16 17:00:00', NULL, NULL, NULL, '2024-01-18 06:29:50', '2024-01-18 06:29:50'),
(77, 1, 115, '2024-01-16 17:00:00', 'Thuốc 1', '2024-01-25 17:00:00', NULL, '2024-01-18 18:05:24', '2024-01-18 18:05:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(21, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `modules_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `modules`
--

INSERT INTO `modules` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Role Management', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(2, 'User Management', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(3, 'Settings', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(4, 'Profile', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(5, 'Page Management', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(6, 'Menu Management', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(7, 'Admin Dashboard', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(8, 'Custommer', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(9, 'Brand Management', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(10, 'Category Management', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(11, 'Slider Management', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(12, 'Pig Management', '2023-12-06 20:31:39', '2023-12-06 20:31:39');

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
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8 COMMENT='Thông báo lịch của từng con';

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
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('duongdinhcuong20121999@gmail.com', '$2y$10$vX5Gr914f1vQuY3z.7cU4uIEkZ4ap1RXeNzaZA7UspnjjP.DDDfOO', '2024-01-08 05:48:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`),
  KEY `permissions_module_id_foreign` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `module_id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 1, 'Access Role', 'app.roles.index', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(2, 1, 'Create Role', 'app.roles.create', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(3, 1, 'Edit Role', 'app.roles.edit', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(4, 1, 'Delete Role', 'app.roles.destroy', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(5, 2, 'Access user', 'app.users.index', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(6, 2, 'Create user', 'app.users.create', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(7, 2, 'Edit user', 'app.users.edit', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(8, 2, 'Delete user', 'app.users.destroy', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(9, 3, 'General Settings', 'app.settings.general', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(10, 3, 'Appearance Settings', 'app.settings.appearance', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(11, 3, 'Database Settings', 'app.settings.database', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(12, 3, 'Mail Settings', 'app.settings.mail', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(13, 3, 'Socialite Settings', 'app.settings.socialite', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(14, 4, 'Update Profile', 'app.profile.update', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(15, 4, 'Update Password', 'app.profile.password', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(16, 5, 'Access Pages', 'app.pages.index', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(17, 5, 'Create Page', 'app.pages.create', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(18, 5, 'Edit Page', 'app.pages.edit', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(19, 5, 'Delete Page', 'app.pages.destroy', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(20, 6, 'Access Menus', 'app.menus.index', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(21, 6, 'Create Menu', 'app.menus.create', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(22, 6, 'Edit Menu', 'app.menus.edit', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(23, 6, 'Delete Menu', 'app.menus.destroy', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(24, 7, 'Access Dashboard', 'app.dashboard', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(25, 8, 'Update custommer Profile', 'app.custommerprofile.update', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(26, 8, 'Update custommer Password', 'app.custommerprofile.password', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(27, 9, 'Access Brands', 'app.brands.index', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(28, 9, 'Create Brand', 'app.brands.create', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(29, 9, 'Edit Brand', 'app.brands.edit', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(30, 9, 'Delete Brand', 'app.brands.destroy', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(31, 10, 'Access Category', 'app.categories.index', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(32, 10, 'Create Category', 'app.categories.create', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(33, 10, 'Edit Category', 'app.categories.edit', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(34, 10, 'Delete Category', 'app.categories.destroy', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(35, 11, 'Access Slider', 'app.sliders.index', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(36, 11, 'Create Slider', 'app.sliders.create', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(37, 11, 'Edit Slider', 'app.sliders.edit', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(38, 11, 'Delete Slider', 'app.sliders.destroy', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(39, 12, 'Access Pig', 'app.pigs.index', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(40, 12, 'Create Pig', 'app.pigs.create', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(41, 12, 'Edit Pig', 'app.pigs.edit', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(42, 12, 'Delete Pig', 'app.pigs.destroy', '2023-12-06 20:31:39', '2023-12-06 20:31:39');

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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 4, 1, NULL, NULL),
(5, 5, 1, NULL, NULL),
(6, 6, 1, NULL, NULL),
(7, 7, 1, NULL, NULL),
(8, 8, 1, NULL, NULL),
(9, 9, 1, NULL, NULL),
(10, 10, 1, NULL, NULL),
(11, 11, 1, NULL, NULL),
(12, 12, 1, NULL, NULL),
(13, 13, 1, NULL, NULL),
(14, 14, 1, NULL, NULL),
(15, 15, 1, NULL, NULL),
(16, 16, 1, NULL, NULL),
(17, 17, 1, NULL, NULL),
(18, 18, 1, NULL, NULL),
(19, 19, 1, NULL, NULL),
(20, 20, 1, NULL, NULL),
(21, 21, 1, NULL, NULL),
(22, 22, 1, NULL, NULL),
(23, 23, 1, NULL, NULL),
(24, 24, 1, NULL, NULL),
(25, 25, 1, NULL, NULL),
(26, 26, 1, NULL, NULL),
(27, 27, 1, NULL, NULL),
(28, 28, 1, NULL, NULL),
(29, 29, 1, NULL, NULL),
(30, 30, 1, NULL, NULL),
(31, 31, 1, NULL, NULL),
(32, 32, 1, NULL, NULL),
(33, 33, 1, NULL, NULL),
(34, 34, 1, NULL, NULL),
(35, 35, 1, NULL, NULL),
(36, 36, 1, NULL, NULL),
(37, 37, 1, NULL, NULL),
(38, 38, 1, NULL, NULL),
(39, 39, 1, NULL, NULL),
(40, 40, 1, NULL, NULL),
(41, 41, 1, NULL, NULL),
(42, 42, 1, NULL, NULL),
(43, 24, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pigs`
--

DROP TABLE IF EXISTS `pigs`;
CREATE TABLE IF NOT EXISTS `pigs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `origin` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breed_id` int(11) UNSIGNED DEFAULT NULL,
  `breeding_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` int(5) DEFAULT 1,
  `birthday` timestamp NULL DEFAULT NULL,
  `father_id` int(11) DEFAULT NULL,
  `mother_id` int(11) DEFAULT NULL,
  `weaning_date` timestamp NULL DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `total_meat` int(11) DEFAULT NULL,
  `total_die` int(11) DEFAULT NULL,
  `pig_breed_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pig_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `breed_id` (`breed_id`),
  KEY `FK_pigs_pigs` (`pig_breed_id`),
  KEY `FK_pigs_breedings` (`breeding_id`)
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `pigs`
--

INSERT INTO `pigs` (`id`, `code`, `origin`, `gender`, `type`, `breed_id`, `breeding_id`, `status`, `birthday`, `father_id`, `mother_id`, `weaning_date`, `total`, `total_meat`, `total_die`, `pig_breed_id`, `pig_type`, `joining_date`, `created_at`, `updated_at`) VALUES
(112, 'ABCCDA', 'ttgvn', 'female', 'manufacture', NULL, NULL, 4, '2023-07-30 17:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'center', '2024-01-10 17:00:00', '2024-01-11 08:58:16', '2024-01-16 02:36:03'),
(115, 'ABCCDAF', 'ttgvn', 'female', 'manufacture', NULL, NULL, 3, '2023-07-30 17:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'center', '2024-01-10 17:00:00', '2024-01-11 09:36:43', '2024-01-18 06:35:15'),
(116, 'MMMM', 'buy', NULL, NULL, 7, NULL, 11, '2023-07-30 17:00:00', NULL, NULL, '2023-08-27 17:00:00', 8, NULL, NULL, NULL, 'breed', NULL, '2024-01-11 09:42:04', '2024-01-16 11:41:03'),
(117, 'KKKKK', 'buy', 'male', 'reserve', 7, NULL, 1, '2024-01-03 17:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 116, 'center', NULL, '2024-01-11 09:56:44', '2024-01-11 11:03:47'),
(119, 'HHHH', 'ttgvn', NULL, NULL, 7, 1, 9, '2024-01-10 17:00:00', NULL, 112, '2023-12-18 17:00:00', 10, NULL, NULL, NULL, 'breed', NULL, '2024-01-16 02:22:29', '2024-01-16 11:41:30'),
(120, 'NNNN', 'ttgvn', 'male', 'manufacture', 7, 6, 1, '2024-01-14 17:00:00', NULL, 112, '2023-10-01 17:00:00', 15, NULL, NULL, NULL, 'center', NULL, '2024-01-16 02:26:18', '2024-01-18 06:29:50'),
(121, 'KKKK', 'ttgvn', 'male', 'manufacture', 7, NULL, 1, '2024-01-14 17:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 120, 'center', NULL, '2024-01-16 11:42:16', '2024-01-16 11:45:38'),
(122, 'AAAA', 'ttgvn', 'female', 'reserve', 7, NULL, 1, '2024-01-14 17:00:00', NULL, NULL, NULL, NULL, NULL, NULL, 120, 'center', NULL, '2024-01-16 11:42:25', '2024-01-16 23:00:00'),
(123, 'QQQ', 'buy', 'male', 'manufacture', 7, NULL, 1, '2023-12-17 02:12:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'center', '2024-01-16 17:00:00', '2023-12-17 02:12:15', '2024-01-17 02:12:15'),
(124, 'WWW', 'buy', 'male', 'manufacture', 7, NULL, 1, '2023-12-17 02:12:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'center', '2024-01-16 17:00:00', '2023-12-17 02:12:15', '2024-01-17 02:12:15'),
(125, 'EEE', 'buy', 'female', 'reserve', 7, NULL, 1, '2023-12-17 02:12:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'center', '2024-01-16 17:00:00', '2023-12-17 02:12:15', '2024-01-17 02:12:15'),
(126, 'RRR', 'buy', 'male', 'manufacture', 7, NULL, 1, '2023-12-17 02:12:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'center', '2024-01-16 17:00:00', '2023-12-17 02:12:15', '2024-01-17 02:12:15'),
(127, 'TTT', 'buy', 'male', 'manufacture', 7, NULL, 1, '2023-12-17 02:12:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'center', '2024-01-16 17:00:00', '2023-12-17 02:12:15', '2024-01-17 02:12:15'),
(128, 'YYY', 'buy', 'female', 'reserve', 7, NULL, 1, '2023-11-17 02:12:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'center', '2024-01-16 17:00:00', '2023-11-17 02:12:15', '2024-01-17 02:12:15'),
(129, 'UUU', 'buy', 'female', 'manufacture', 7, NULL, 1, '2023-11-17 02:12:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'center', '2024-01-16 17:00:00', '2023-11-17 02:12:15', '2024-01-17 02:12:15'),
(130, 'III', 'buy', 'female', 'manufacture', 7, NULL, 1, '2023-11-17 02:12:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'center', '2024-01-16 17:00:00', '2023-11-17 02:12:15', '2024-01-17 02:12:15'),
(131, 'OOO', 'buy', 'male', 'reserve', 7, NULL, 1, '2023-11-17 02:12:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'center', '2024-01-16 17:00:00', '2023-11-17 02:12:15', '2024-01-17 02:12:15'),
(132, 'PPP', 'buy', 'female', 'manufacture', 7, NULL, 1, '2023-11-17 02:12:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'center', '2024-01-16 17:00:00', '2023-10-17 02:12:15', '2024-01-17 02:12:15'),
(133, 'AAA', 'buy', 'male', 'manufacture', 7, NULL, 1, '2023-11-17 02:12:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'center', '2024-01-16 17:00:00', '2023-10-17 02:12:15', '2024-01-17 02:12:15'),
(134, 'SSS', 'buy', 'female', 'manufacture', 7, NULL, 1, '2023-10-17 02:12:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'center', '2024-01-16 17:00:00', '2023-10-17 02:12:15', '2024-01-17 02:12:15'),
(135, 'DDD', 'buy', 'male', 'reserve', 7, NULL, 1, '2023-10-17 02:12:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'center', '2024-01-16 17:00:00', '2023-10-17 02:12:15', '2024-01-17 02:12:15'),
(136, 'FFF', 'buy', 'female', 'manufacture', 7, NULL, 1, '2023-09-17 02:12:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'center', '2024-01-16 17:00:00', '2023-09-17 02:12:15', '2024-01-17 02:12:15'),
(137, 'GGG', 'buy', 'female', 'manufacture', 7, NULL, 1, '2023-09-16 17:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'center', '2024-01-16 17:00:00', '2023-09-17 02:12:15', '2024-01-18 05:04:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deletable` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `deletable`, `created_at`, `updated_at`) VALUES
(1, 'Super admin', 'super-admin', 'This is super-admin', 0, '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(2, 'Admin', 'admin', 'This is admin', 0, '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(3, 'User', 'user', 'This is User', 0, '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(4, 'Customer', 'customer', 'Khách hàng', 1, '2024-01-02 20:51:15', '2024-01-02 20:51:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `dated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `pig_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pig_id` (`pig_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
-- Cấu trúc bảng cho bảng `setting_breeds`
--

DROP TABLE IF EXISTS `setting_breeds`;
CREATE TABLE IF NOT EXISTS `setting_breeds` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `setting_breeds`
--

INSERT INTO `setting_breeds` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(7, 'Duroc', 'Đây là lợn Duroc', '2023-12-12 10:08:37', '2023-12-12 10:08:37'),
(8, 'Landrace', 'Đây là lợn Landrace', '2023-12-12 10:08:48', '2023-12-12 10:08:48'),
(9, 'Yorkshire', 'Đây là lợn Yorkshire', '2023-12-12 10:08:57', '2023-12-12 10:08:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting_diseases`
--

DROP TABLE IF EXISTS `setting_diseases`;
CREATE TABLE IF NOT EXISTS `setting_diseases` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `setting_diseases`
--

INSERT INTO `setting_diseases` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Chân tay miệng', 'Đây là lợn Chân tay miệng', '2023-12-06 17:00:00', NULL),
(2, 'Lở mồm long móng', 'Đây là lợn Lở mồm long móng', '2023-12-06 17:00:00', NULL),
(3, 'Tai xanh be', 'Đây là lợn Tai xanh 3', '2023-12-06 17:00:00', '2023-12-08 00:08:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting_expenses`
--

DROP TABLE IF EXISTS `setting_expenses`;
CREATE TABLE IF NOT EXISTS `setting_expenses` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `setting_expenses`
--

INSERT INTO `setting_expenses` (`id`, `name`, `slug`, `unit`, `description`, `type`, `created_at`, `updated_at`) VALUES
(32, 'Chi phí 1', 'chi-phi-1', 'VNĐ', NULL, 'expense', '2023-12-25 09:06:47', '2023-12-25 09:06:47'),
(33, 'Chi phí 2', 'chi-phi-2', 'VNĐ', NULL, 'expense', '2023-12-25 09:06:57', '2023-12-25 09:06:57'),
(34, 'Chi phí 3', 'chi-phi-3', 'VNĐ', NULL, 'expense', '2023-12-25 09:07:20', '2023-12-25 09:07:20'),
(35, 'Chi phí 4', 'chi-phi-4', 'VNĐ', NULL, 'expense', '2023-12-25 09:09:21', '2023-12-25 09:09:21'),
(36, 'Thức ăn 1', 'thuc-an-1', 'VNĐ', NULL, 'food', '2023-12-25 09:11:07', '2023-12-25 09:11:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting_vaccines`
--

DROP TABLE IF EXISTS `setting_vaccines`;
CREATE TABLE IF NOT EXISTS `setting_vaccines` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `setting_vaccines`
--

INSERT INTO `setting_vaccines` (`id`, `name`, `quantity`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Vaccine 1', 2, 'Đây là Vaccine 1', '2023-12-06 17:00:00', NULL),
(2, 'Vaccine 2', 3, 'Đây là lợn Vaccine 2', '2023-12-06 17:00:00', NULL),
(3, 'Vaccine 3', 4, 'Đây là lợn Vaccine 3', '2023-12-06 17:00:00', '2023-12-07 23:37:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sperms`
--

DROP TABLE IF EXISTS `sperms`;
CREATE TABLE IF NOT EXISTS `sperms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pig_id` int(11) NOT NULL,
  `mining_date` timestamp NULL DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sperm_extractions`
--

DROP TABLE IF EXISTS `sperm_extractions`;
CREATE TABLE IF NOT EXISTS `sperm_extractions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pig_id` int(11) NOT NULL,
  `dated_at` timestamp NULL DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `image`, `email_verified_at`, `password`, `status`, `remember_token`, `otp`, `otp_expires_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super Admin', 'superadmin@gmail.com', 'images/profiles/20231218144110657ff79648668landscape-photography_1645.jpg', NULL, '$2y$10$YiBLLIB6AHGWJhdqGNU2XO1QwDV4SL1S0b1KT1kP0Gy8tt2/UHbe6', 1, NULL, NULL, NULL, '2023-12-06 20:31:39', '2023-12-22 09:53:45'),
(2, 2, 'Admin', 'duongdinhcuong20121999@gmail.com', NULL, NULL, '$2y$10$xG76OzqQQwE8X.dHmwdFY.hbJ8wNGmAf.aY/oitHIvlCNo7G4hjkq', 1, NULL, '637226', '2024-01-08 06:03:34', '2023-12-06 20:31:39', '2024-01-08 05:48:34'),
(3, 3, 'User', 'user@gmail.com', NULL, NULL, '$2y$10$R3ddWp3tmQwyCm6FmBlWP.5kJ3IHXmmfXsyzhZerqyH7yKzs4OC..', 1, NULL, NULL, NULL, '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(4, 2, 'Khó Ưa', 'nghang.pr@gmail.com', 'images/users/010220241355586593b37ed4763[Commie] Hotarubi no Mori e [BD 1080p AAC] [52244604].mkv_snapshot_35.38_[2012.03.01_14.42.45].jpg', NULL, '$2y$10$cMlaC5HoR7.kb1I3Z9XXoOUvb2UqHibKQGDMpdCoiO5LnxUT2qdSu', 0, NULL, NULL, NULL, '2024-01-01 23:55:58', '2024-01-01 23:55:59'),
(5, 2, 'test123', 'thaodtb6mn@gmail.com', 'images/users/010320241021016594d29dd4426PureStretch on the App Store (1).jpg', NULL, '$2y$10$i39BRRxfFMhxmH3taAbQ1epb5s4ThGFNyVy9HSsKfr8iZSQczraui', 1, NULL, NULL, NULL, '2024-01-02 20:21:01', '2024-01-02 20:33:04'),
(6, 1, 'test123', 'thaodtb6mn@gmail1.com', 'images/users/010320241024416594d37914e64Bodybuilder HELPER on the App Store (4).jpg', NULL, '$2y$10$LcNmuIswE5bnbYB9jrXmLOAHsyWouPM7E4rSi29/VNbBphIIANO1e', 1, NULL, NULL, NULL, '2024-01-02 20:24:41', '2024-01-02 20:25:00'),
(7, 4, 'test123111', 'Thaodtb6mn@gmail2.com', 'images/users/010320241052556594da1712cd3PureStretch on the App Store (2).jpg', NULL, '$2y$10$CTRbB9lhPz8t3TIqN21V3uBE41DqpgxiJuVqiwIUMBFVykZ24YxzW', 1, NULL, NULL, NULL, '2024-01-02 20:52:55', '2024-01-02 20:53:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vaccines`
--

DROP TABLE IF EXISTS `vaccines`;
CREATE TABLE IF NOT EXISTS `vaccines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_vaccine_id` int(11) UNSIGNED NOT NULL,
  `pig_id` int(11) NOT NULL,
  `date_of_injection` timestamp NULL DEFAULT NULL,
  `next_injection_day` timestamp NULL DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `setting_vaccine_id` (`setting_vaccine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `vaccines`
--

INSERT INTO `vaccines` (`id`, `setting_vaccine_id`, `pig_id`, `date_of_injection`, `next_injection_day`, `note`, `created_at`, `updated_at`) VALUES
(130, 1, 137, '2024-01-17 17:00:00', '2024-01-19 17:00:00', NULL, '2024-01-18 05:04:37', '2024-01-18 05:04:37'),
(131, 1, 120, '2024-01-17 17:00:00', '2024-01-25 17:00:00', NULL, '2024-01-18 06:29:50', '2024-01-18 06:29:50'),
(135, 2, 112, '2024-01-17 17:00:00', '2024-01-23 17:00:00', NULL, '2024-01-18 17:46:28', '2024-01-18 17:46:28'),
(136, 1, 112, '2024-01-10 17:00:00', '2024-01-24 17:00:00', NULL, '2024-01-18 17:46:28', '2024-01-18 17:46:28'),
(141, 1, 115, '2024-01-16 17:00:00', '2024-01-21 17:00:00', NULL, '2024-01-18 18:05:24', '2024-01-18 18:05:24'),
(142, 2, 115, '2024-01-16 17:00:00', '2024-01-22 17:00:00', NULL, '2024-01-18 18:05:24', '2024-01-18 18:05:24'),
(143, 3, 115, NULL, '2024-01-19 17:00:00', NULL, '2024-01-18 18:05:24', '2024-01-18 18:05:24');

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `breedings`
--
ALTER TABLE `breedings`
  ADD CONSTRAINT `FK_breedings_pigs` FOREIGN KEY (`pig_id`) REFERENCES `pigs` (`id`),
  ADD CONSTRAINT `FK_breedings_pigs_3` FOREIGN KEY (`male_first`) REFERENCES `pigs` (`id`),
  ADD CONSTRAINT `FK_breedings_pigs_4` FOREIGN KEY (`male_second`) REFERENCES `pigs` (`id`);

--
-- Các ràng buộc cho bảng `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`setting_expense_id`) REFERENCES `setting_expenses` (`id`);

--
-- Các ràng buộc cho bảng `healths`
--
ALTER TABLE `healths`
  ADD CONSTRAINT `healths_ibfk_1` FOREIGN KEY (`setting_disease_id`) REFERENCES `setting_diseases` (`id`);

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
-- Các ràng buộc cho bảng `pigs`
--
ALTER TABLE `pigs`
  ADD CONSTRAINT `FK_pigs_breedings` FOREIGN KEY (`breeding_id`) REFERENCES `breedings` (`id`),
  ADD CONSTRAINT `FK_pigs_pigs` FOREIGN KEY (`pig_breed_id`) REFERENCES `pigs` (`id`),
  ADD CONSTRAINT `pigs_ibfk_1` FOREIGN KEY (`breed_id`) REFERENCES `setting_breeds` (`id`);

--
-- Các ràng buộc cho bảng `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`pig_id`) REFERENCES `pigs` (`id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Các ràng buộc cho bảng `vaccines`
--
ALTER TABLE `vaccines`
  ADD CONSTRAINT `vaccines_ibfk_1` FOREIGN KEY (`setting_vaccine_id`) REFERENCES `setting_vaccines` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
