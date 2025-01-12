-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 14, 2023 lúc 12:24 PM
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
-- Cơ sở dữ liệu: `proj_laravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `breedings`
--

DROP TABLE IF EXISTS `breedings`;
CREATE TABLE IF NOT EXISTS `breedings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pig_id` int(11) NOT NULL,
  `oestrous_day` timestamp NULL DEFAULT NULL,
  `breeding_date_first` timestamp NULL DEFAULT NULL,
  `male_first` int(11) DEFAULT NULL,
  `breeding_date_second` timestamp NULL DEFAULT NULL,
  `male_second` int(11) DEFAULT NULL,
  `week` timestamp NULL DEFAULT NULL,
  `pregnancy_day` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `setting_disease_id` int(11) NOT NULL,
  `pig_id` int(11) NOT NULL,
  `day_of_illness` timestamp NULL DEFAULT NULL,
  `medicine` varchar(255) DEFAULT NULL,
  `day_of_recovery` timestamp NULL DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `healths`
--

INSERT INTO `healths` (`id`, `setting_disease_id`, `pig_id`, `day_of_illness`, `medicine`, `day_of_recovery`, `note`, `created_at`, `updated_at`) VALUES
(1, 2, 26, '2023-12-12 17:00:00', NULL, '2023-12-12 17:00:00', NULL, '2023-12-14 07:28:07', '2023-12-14 07:28:07'),
(2, 2, 26, '2023-12-11 17:00:00', NULL, NULL, NULL, '2023-12-14 07:28:07', '2023-12-14 07:28:07'),
(3, 2, 28, '2023-12-13 17:00:00', NULL, '2023-12-11 17:00:00', NULL, '2023-12-14 07:49:25', '2023-12-14 07:49:25');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(16, '2023_12_07_023546_create_setting_breeds_table', 1);

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
('duongdinhcuong20121999@gmail.com', '$2y$10$dJUoET4ATDmvzSHWwDTuGuy2ert0obA0d12ObT17PYELMOq1kyOyS', '2023-12-12 07:09:05');

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
(39, 12, 'Access Pig', 'app.pig-centers.index', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(40, 12, 'Create Pig', 'app.pig-centers.create', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(41, 12, 'Edit Pig', 'app.pig-centers.edit', '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(42, 12, 'Delete Pig', 'app.pig-centers.destroy', '2023-12-06 20:31:39', '2023-12-06 20:31:39');

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
  `breed_id` int(11) DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` timestamp NULL DEFAULT NULL,
  `father_id` int(11) DEFAULT NULL,
  `mother_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `pigs`
--

INSERT INTO `pigs` (`id`, `code`, `origin`, `gender`, `type`, `breed_id`, `status`, `birthday`, `father_id`, `mother_id`, `created_at`, `updated_at`) VALUES
(26, 'ABCCDA', 'ttgvn', 'female', 'disease', 8, 'normal', '2023-12-13 17:00:00', NULL, NULL, '2023-12-14 07:28:06', '2023-12-14 07:28:06'),
(27, 'ABCCDAE', 'ttgvn', 'female', 'disease', 7, 'normal', '2023-12-12 17:00:00', 26, NULL, '2023-12-14 07:39:06', '2023-12-14 07:39:06'),
(28, 'ABCCDAD', 'ttgvn', 'male', 'manufacture', 8, NULL, '2023-12-12 17:00:00', 27, NULL, '2023-12-14 07:49:25', '2023-12-14 07:49:25'),
(29, 'AMC', 'ttgvn', NULL, NULL, NULL, 'disease', NULL, NULL, NULL, '2023-12-14 07:49:37', '2023-12-14 07:49:37');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `deletable`, `created_at`, `updated_at`) VALUES
(1, 'Super admin', 'super-admin', 'This is super-admin', 0, '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(2, 'Admin', 'admin', 'This is admin', 0, '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(3, 'User', 'user', 'This is User', 0, '2023-12-06 20:31:39', '2023-12-06 20:31:39');

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
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
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
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
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
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `setting_expenses`
--

INSERT INTO `setting_expenses` (`id`, `name`, `unit`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Tiền điện', 'VNĐ', 'Đây là tiền điện', '2023-12-06 17:00:00', NULL),
(2, 'Tiền thuê', 'VNĐ', 'Đây là lợn Tiền thuê', '2023-12-06 17:00:00', NULL),
(3, 'Tiền nước', 'VNĐ', 'Đây là lợn Tiền nước', '2023-12-06 17:00:00', NULL),
(10, 'Tiền Bo', 'VNĐ', 'sdfsd', '2023-12-07 21:58:04', '2023-12-07 21:58:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting_vaccines`
--

DROP TABLE IF EXISTS `setting_vaccines`;
CREATE TABLE IF NOT EXISTS `setting_vaccines` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `image`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Super Admin', 'superadmin@gmail.com', 'images/profiles/2023121103202365767ff7608c1login-frent-img.jpg', NULL, '$2y$10$YiBLLIB6AHGWJhdqGNU2XO1QwDV4SL1S0b1KT1kP0Gy8tt2/UHbe6', 1, NULL, '2023-12-06 20:31:39', '2023-12-10 20:20:23'),
(2, 2, 'Admin', 'duongdinhcuong20121999@gmail.com', NULL, NULL, '$2y$10$KuzkiGtl5hpogKPpHBiTkOtQZ9R4uaznAGZhVUY1qGBiBJYot5rvu', 1, NULL, '2023-12-06 20:31:39', '2023-12-06 20:31:39'),
(3, 3, 'User', 'user@gmail.com', NULL, NULL, '$2y$10$R3ddWp3tmQwyCm6FmBlWP.5kJ3IHXmmfXsyzhZerqyH7yKzs4OC..', 1, NULL, '2023-12-06 20:31:39', '2023-12-06 20:31:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vaccines`
--

DROP TABLE IF EXISTS `vaccines`;
CREATE TABLE IF NOT EXISTS `vaccines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_vaccine_id` int(11) NOT NULL,
  `pig_id` int(11) NOT NULL,
  `date_of_injection` timestamp NULL DEFAULT NULL,
  `next_injection_day` timestamp NULL DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `vaccines`
--

INSERT INTO `vaccines` (`id`, `setting_vaccine_id`, `pig_id`, `date_of_injection`, `next_injection_day`, `note`, `created_at`, `updated_at`) VALUES
(5, 2, 26, '2023-12-13 17:00:00', '2023-12-12 17:00:00', NULL, '2023-12-14 07:28:06', '2023-12-14 07:28:06'),
(6, 1, 26, '2023-12-04 17:00:00', '2023-12-09 17:00:00', NULL, '2023-12-14 07:28:07', '2023-12-14 07:28:07'),
(7, 1, 28, '2023-12-13 17:00:00', '2023-12-11 17:00:00', NULL, '2023-12-14 07:49:25', '2023-12-14 07:49:25'),
(8, 2, 28, '2023-12-14 17:00:00', '2023-12-10 17:00:00', NULL, '2023-12-14 07:49:25', '2023-12-14 07:49:25');

--
-- Các ràng buộc cho các bảng đã đổ
--

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
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
