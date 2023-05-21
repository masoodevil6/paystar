-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2023 at 01:59 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paystar`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `main` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `title`, `status`, `main`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'مدیر اصلی', 1, 75297530, '2023-05-16 18:02:10', '2023-05-16 19:44:37', '2023-05-16 19:44:37'),
(2, 'مدیر اصلی', 1, 75297530, '2023-05-16 19:44:37', '2023-05-16 19:44:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_panel`
--

CREATE TABLE `admin_panel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `panel_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_panel`
--

INSERT INTO `admin_panel` (`id`, `panel_id`, `admin_id`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 2),
(4, 4, 2),
(5, 5, 2),
(6, 6, 2),
(7, 7, 2),
(8, 8, 2),
(9, 9, 2),
(10, 10, 2),
(11, 11, 2),
(12, 12, 2),
(13, 13, 2),
(14, 14, 2);

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'test1402',
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `password`, `status`, `user_id`, `admin_id`, `created_at`, `updated_at`) VALUES
(2, '$2y$10$/hW4Dc5R28m03DimVFILPeqKTNIen4vaRXlzhvizGkX91Ki/Ch6Tq', 1, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `app_categories`
--

CREATE TABLE `app_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_files`
--

CREATE TABLE `app_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `format` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `app_file_links`
--

CREATE TABLE `app_file_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=>disable , 1=> enable',
  `app_file_id` bigint(20) UNSIGNED DEFAULT NULL,
  `app_category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merchant_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'access-token for connect personal request',
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT '0:url file , 1:uploaded file ; image',
  `image_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=>disable , 1=> enable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `title`, `merchant_id`, `access_token`, `service_name`, `image_location`, `image_type`, `image_title`, `image_alt`, `status`, `created_at`, `updated_at`) VALUES
(1, 'پی-استار', '0yovdk2l6e143', '9A3EC03483556C73714510C507529DF70A1228C83477D1455E0511BD72C5AAB8A6715A414AA48B7C905FCEF45868BD26DA58196EF29C77C194C9F14A4B47456CC6454E9D50B388D6FC5AC91BB08B234A8060FDC85B1CEC32CA036DC907F8A4A635D9CBB9CAA31B42549B8D70B2CE5EDE8274FFB55DABFE92D76BC42D91696FAF', 'PayStar', 'images/bank-images/1680682304.png', '1', 'انتخاب درگاه pay-star', 'انتخاب درگاه pay-star', 1, '2023-05-18 22:10:28', '2023-05-18 22:10:28');

-- --------------------------------------------------------

--
-- Table structure for table `bank_payments`
--

CREATE TABLE `bank_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Res_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authority_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_data` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_admin` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'mark text for admin',
  `active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0:not active , 1:active ; for verify',
  `is_test` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:false , 1:true ; type payment',
  `is_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:false , 1:true ; status payment',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_payments`
--

INSERT INTO `bank_payments` (`id`, `code`, `message`, `Res_num`, `authority_num`, `ref_num`, `mobile`, `email`, `extra_data`, `amount`, `description`, `service_name`, `text_admin`, `active`, `is_test`, `is_status`, `user_id`, `order_id`, `created_at`, `updated_at`) VALUES
(21, '1', 'موفق', '1684656346', 'EizL3zT6CvT9h4IHDHFdka0jQXBLM3NtInrE0hTOtECuZwLKfvXy8h3hjmai', 'nxnk48', '', 'masoodevil6@gmail.com', '{\"transaction_id\":\"zydyl7\",\"card_number\":\"585983******0523\",\"tracking_code\":\"126082459441\"}', '5000', 'پرداخت سبد خرید', 'پی استار', NULL, 0, 0, 1, 1, 78, '2023-05-21 07:05:47', '2023-05-21 07:07:13');

-- --------------------------------------------------------

--
-- Table structure for table `bank_payment_refunds`
--

CREATE TABLE `bank_payment_refunds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `res_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authority_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_data` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0:failed , 1:success ;  refund',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bank_payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_payment_un_verifies`
--

CREATE TABLE `bank_payment_un_verifies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `authority_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra_data` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_submit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=>failed , 1=> success',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `bank_payment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `code_offs`
--

CREATE TABLE `code_offs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `off_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_public` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=>person , 1=> public',
  `used` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=>not used , 1=> used',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=>disable , 1=> enable',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `code_offs`
--

INSERT INTO `code_offs` (`id`, `code`, `off_price`, `period`, `min_price`, `image`, `is_public`, `used`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'asd', '1000', '25', '1000', NULL, 1, 0, 1, NULL, '2023-05-18 21:36:40', '2023-05-18 21:36:40');

-- --------------------------------------------------------

--
-- Table structure for table `code_off_statuses`
--

CREATE TABLE `code_off_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `min_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `off_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=>disable , 1=> enable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `seen` tinyint(4) NOT NULL DEFAULT 0,
  `approved` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:not active , 1:active ; from admin',
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment_likes`
--

CREATE TABLE `comment_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `like_or_dislike` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'like: +1 and dislike: -1',
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_12_19_201253_create-admin-table', 1),
(7, '2022_12_19_201416_create-panel-groups-table', 1),
(8, '2022_12_19_201647_create-panels-table', 1),
(9, '2022_12_19_201846_create-admin-user-table', 1),
(10, '2022_12_19_202135_create-admin-panel-table', 1),
(11, '2022_12_20_045649_create-setting-table', 1),
(12, '2022_12_24_070558_create-otp-table', 1),
(13, '2022_12_27_002530_create-request-change-password-table', 1),
(14, '2022_12_27_040859_create-comments-table', 1),
(15, '2022_12_27_052253_create-ticket-categories-table', 1),
(16, '2022_12_27_052856_create-ticket-folders-table', 1),
(17, '2022_12_27_053005_create-tickets-table', 1),
(18, '2022_12_28_010121_create-subscribes-table', 1),
(19, '2022_12_28_010555_create-banks-table', 1),
(20, '2022_12_28_010716_create-subscribe-payment-table', 1),
(21, '2023_01_05_121156_create-comment-likes-table', 1),
(22, '2023_01_28_105502_create_app_categories_table', 1),
(23, '2023_01_28_105512_create_app_files_table', 1),
(24, '2023_01_28_105700_create_app_file_links_table', 1),
(25, '2023_02_27_113705_create_seo_robots', 1),
(26, '2023_02_27_114611_create_seo_pages', 1),
(27, '2023_02_27_114858_create_seo_metas', 1),
(28, '2023_02_27_120512_create_seo_keyword', 1),
(29, '2023_02_27_120710_create_seo_meta_robot', 1),
(30, '2023_03_04_115936_create_sitemap_files_tables', 1),
(31, '2023_03_04_120136_create_sitemap_urls_table', 1),
(32, '2023_04_06_120239_create-orders-table', 1),
(33, '2023_04_06_120435_create-order-baskets-table', 1),
(34, '2023_04_07_160455_create-bank-payments-table', 1),
(35, '2023_04_08_223734_create-code-off-status-table', 1),
(36, '2023_04_09_000723_create-code-off-table', 1),
(37, '2023_04_09_132445_create-user-messages-table', 1),
(38, '2023_04_15_154059_create-bank-payment-refund-table', 1),
(39, '2023_04_15_173036_create-bank-payment-un-verifies-table', 1),
(40, '2023_05_03_112635_create-phone-web-services-table', 1),
(41, '2023_05_03_171136_create-phone-messages-table', 1),
(42, '2023_05_07_161449_create-rules-tables', 1),
(43, '2023_05_08_215235_create-phone-stores-table', 1),
(44, '2023_05_08_224333_create-phone-store-reaquest-tokens', 1),
(45, '2023_05_08_230120_create-phone-store-tokens-table', 1),
(46, '2023_05_10_142601_create-phone-store-purchase-table', 1),
(47, '2023_05_19_100345_add-user-cart-number-in-users-table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `res_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_off` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_price` int(11) NOT NULL DEFAULT 0,
  `real_price` int(11) NOT NULL DEFAULT 0,
  `off_price` int(11) NOT NULL DEFAULT 0,
  `total_Price` int(11) NOT NULL DEFAULT 0,
  `description_finish` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'the reason for finish is true',
  `is_finish` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:false , 1:true ; is finish order',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `res_num`, `code_off`, `code_price`, `real_price`, `off_price`, `total_Price`, `description_finish`, `is_finish`, `user_id`, `created_at`, `updated_at`) VALUES
(75, '1684656225', 'asd', 1000, 4500, 3000, 1500, NULL, 0, 1, '2023-05-21 07:03:45', '2023-05-21 07:03:45'),
(76, '1684656240', 'asd', 1000, 4500, 3000, 1500, NULL, 0, 1, '2023-05-21 07:04:00', '2023-05-21 07:04:00'),
(77, '1684656256', 'asd', 1000, 4500, 3000, 1500, NULL, 0, 1, '2023-05-21 07:04:16', '2023-05-21 07:04:16'),
(78, '1684656346', 'asd', 1000, 4500, 3000, 1500, 'به علت وجود خطا، تراکنش لغو گشت. لطفا دوباره تلاش نمایید ...', 1, 1, '2023-05-21 07:05:46', '2023-05-21 07:13:02');

-- --------------------------------------------------------

--
-- Table structure for table `order_baskets`
--

CREATE TABLE `order_baskets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_basketable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_basketable_id` bigint(20) NOT NULL,
  `cookie` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'cookie is token basket',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `off` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submitted` int(11) NOT NULL DEFAULT 0 COMMENT '0:not submitted , 1:submitted ;  payment',
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_baskets`
--

INSERT INTO `order_baskets` (`id`, `order_basketable_type`, `order_basketable_id`, `cookie`, `name`, `description`, `price`, `off`, `submitted`, `order_id`, `created_at`, `updated_at`) VALUES
(45, 'App\\Models\\Subscribes\\Subscribe', 1, NULL, 'اشتراک شماره 1', '[{\"title\":\"\\u0645\\u062f\\u062a \\u0627\\u0634\\u062a\\u0631\\u0627\\u06a9\",\"value\":\"2  \\u0645\\u0627\\u0647 \"}]', '1000', '500', 1, 78, '2023-05-21 07:03:32', '2023-05-21 07:07:13'),
(46, 'App\\Models\\Subscribes\\Subscribe', 2, NULL, 'اشتراک شماره 2', '[{\"title\":\"\\u0645\\u062f\\u062a \\u0627\\u0634\\u062a\\u0631\\u0627\\u06a9\",\"value\":\"2  \\u0645\\u0627\\u0647 \"}]', '1500', '1000', 1, 78, '2023-05-21 07:03:34', '2023-05-21 07:07:13'),
(47, 'App\\Models\\Subscribes\\Subscribe', 3, NULL, 'اشتراک شماره 3', '[{\"title\":\"\\u0645\\u062f\\u062a \\u0627\\u0634\\u062a\\u0631\\u0627\\u06a9\",\"value\":\"2  \\u0645\\u0627\\u0647 \"}]', '2000', '1500', 1, 78, '2023-05-21 07:03:36', '2023-05-21 07:07:13'),
(48, 'App\\Models\\Subscribes\\Subscribe', 1, '1684403673441', NULL, NULL, NULL, NULL, 0, NULL, '2023-05-21 07:54:33', '2023-05-21 07:54:33');

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'email or mobile inserted',
  `type` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=> mobile 1=>email',
  `used` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=>not used 1=>used',
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otps`
--

INSERT INTO `otps` (`id`, `token`, `otp_code`, `input_login`, `type`, `used`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(40, 'fACcg5HKmtmaZcJUPuRyBcgOQWelYogGMlFOLTNYwA1HZ1xWiZtkSelNTuCR', '462372', 'masoodevil6@gmail.com', 1, 1, 1, 1, '2023-05-17 20:29:32', '2023-05-17 20:29:43'),
(41, '6ru46wtyB6mRXAlGU1c8KoglAzNoXbrC04txzEQwLQTjmM3vwZRcQoy8EFv1', '975518', 'masoodevil6@gmail.com', 1, 1, 1, 1, '2023-05-17 20:33:55', '2023-05-17 20:34:08'),
(42, 'DmLN6QGKQu1UTQO8qc693ZW2qctQAYz5GyTgdR1Sz9yJw9JgFkFYCkQ4TCzq', '854798', 'masoodevil6@gmail.com', 1, 1, 1, 1, '2023-05-17 21:14:22', '2023-05-17 21:14:35'),
(43, 'NYG15lXbElcB3phvsWr9uZUISxncalhmoG8rYQvtobUyOnGKpev3usDqBi1m', '279274', 'masoodevil6@gmail.com', 1, 1, 1, 1, '2023-05-17 21:17:52', '2023-05-17 21:18:03'),
(44, 'H6fDks9bS6Meepk4eeTjvXMmuRPynbvcBW1CACN09BNizy1iCtTXm3HcWtkl', '682265', 'masoodevil6@gmail.com', 1, 1, 1, 1, '2023-05-17 21:57:01', '2023-05-17 21:57:17'),
(45, 'ss95w4N7oMxyAZ4JIfYz3rHgLqKBqyzJHGrEv5ulSOKg4kqCAad3NIewfN44', '690155', 'masoodevil6@gmail.com', 1, 1, 1, 1, '2023-05-18 06:57:44', '2023-05-18 06:57:58'),
(46, 'Yzajcz3OTpRSmBAUZl1Bjh2kk8fa0alGjVjkxqVUEGUb27RadDn0DvOQZK2I', '395908', 'masoodevil6@gmail.com', 1, 1, 1, 1, '2023-05-18 15:42:31', '2023-05-18 15:43:02'),
(47, 'GsMSl1yfo6aAOJ5hDdNFEFjMWB3yFJQTn3Rj4ZucQKf9eEOlLZg2HKbslv8U', '588973', 'masoodevil6@gmail.com', 1, 1, 1, 1, '2023-05-18 15:46:48', '2023-05-18 15:46:59'),
(48, 'NpBZRpjAdnh3wBjx8Zehn4vSGrdV9Jus9JAYeJBNUSqfITH6m85BSWMp7s4i', '741927', 'masoodevil6@gmail.com', 1, 1, 1, 1, '2023-05-18 15:51:11', '2023-05-18 15:51:25'),
(49, 'V6wlInSQhkLGa7ZlhYTHjXYya6dx9tXIwPd806sm51ZCvkzwvmFFN24ZJxm6', '289902', 'masoodevil6@gmail.com', 1, 1, 1, 1, '2023-05-18 15:59:08', '2023-05-18 15:59:23'),
(50, '3BHYGhSDPHYYCdsw5pn9Q0U2VO20Uw3pRA8EbE7fO3oNA2FYSd6fhYYsByxZ', '255985', 'masoodevil6@gmail.com', 1, 1, 1, 1, '2023-05-18 16:01:29', '2023-05-18 16:01:41'),
(51, 'dakxJxYON4dZolw4MldltXZ5xRSoMUcK5e87NMJo121JQpthTpLmij0gM18Y', '340218', 'masoodevil6@gmail.com', 1, 1, 1, 1, '2023-05-18 16:03:59', '2023-05-18 16:04:18'),
(52, 'tEtxzFHegahHfXE5SUfK4eCE1pRTuXDY7cJG7n2RUxm5chPahDzZmJ0U5Isf', '462926', 'masoodevil6@gmail.com', 1, 1, 1, 1, '2023-05-18 16:08:04', '2023-05-18 16:08:19'),
(53, 'RbBjMjyCssVAh8xdGZptjygWICYinXuatt7nntNBpCVdeOw4lcc4NpMURiBj', '976396', 'masoodevil6@gmail.com', 1, 1, 1, 1, '2023-05-19 06:57:02', '2023-05-19 06:57:17'),
(54, 'Kb3F6dXzEE6zdG30CzDFAj68xLeWXya0wj2FGtv8SRl0fBax1pwDS2QCva5T', '235131', 'masoodevil6@gmail.com', 1, 1, 1, 1, '2023-05-21 07:30:51', '2023-05-21 07:31:07'),
(55, 'qvTj3F3wfD0GJz8wjIQZFBuMZHIfnyhFGp88bk2nSkxWL41T58YCU8KRgn8a', '825576', 'masoodevil6@gmail.com', 1, 1, 1, 1, '2023-05-21 07:44:00', '2023-05-21 07:44:13'),
(56, 'VHaRtzOOdxHRR2d5Z95wu8B6U55QUSBGZ1bG93Gc7CMQDG85YDBgL9WVBV5K', '464825', 'masoodevil6@gmail.com', 1, 1, 1, 1, '2023-05-21 07:50:46', '2023-05-21 07:50:57'),
(57, 'OduUxlNS6P6V3q0BuGB6WW2mcdCeddN18skzvHTQm96dJXLNBtGqarlEaRRV', '191180', 'masoodevil6@gmail.com', 1, 1, 1, 1, '2023-05-21 07:53:07', '2023-05-21 07:53:17'),
(58, 'm9zystRMgnHI7352omcSZVjv74rPnbNP0cUoFtdwuudsWmJB2WngD6LznVML', '954240', 'masoodevil6@gmail.com', 1, 1, 1, 1, '2023-05-21 08:58:44', '2023-05-21 08:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `panels`
--

CREATE TABLE `panels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `panel_group_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `panels`
--

INSERT INTO `panels` (`id`, `icon`, `name`, `link`, `panel_group_id`, `created_at`, `updated_at`) VALUES
(1, 'fa fa-address-card', 'پنل ها', 'admin.panel.admin.index', 1, '2023-05-16 19:44:37', '2023-05-16 19:44:37'),
(2, 'fa fa-users', 'ادمین ها', 'admin.panel.user-admin.index', 1, '2023-05-16 19:44:37', '2023-05-16 19:44:37'),
(3, 'fa fa-bank', 'بانک ها', 'admin.banks.bank.index', 2, '2023-05-16 19:44:37', '2023-05-16 19:44:37'),
(4, 'fa fa-usd', 'تراکنش ها', 'admin.banks.payment.index', 2, '2023-05-16 19:44:37', '2023-05-16 19:44:37'),
(5, 'fa fa-credit-card', 'تراکنش ها un-verifies', 'admin.banks.un-verifies.index', 2, '2023-05-16 19:44:37', '2023-05-16 19:44:37'),
(6, 'fa fa-undo', 'درخواست های استرداد', 'admin.banks.refund.index', 2, '2023-05-16 19:44:37', '2023-05-16 19:44:37'),
(7, 'fa fa-shopping-cart', 'سفارشات ها', 'admin.Orders.order.index', 3, '2023-05-16 19:44:37', '2023-05-16 19:44:37'),
(8, 'fas fa-cog', 'تنظیمات عمومی', 'admin.public.setting.index', 4, '2023-05-16 19:44:37', '2023-05-16 19:44:37'),
(9, 'fa fa-credit-card', 'اشتراک ها', 'admin.subscribes.subscribe.index', 5, '2023-05-16 19:44:37', '2023-05-16 19:44:37'),
(10, 'fa fa-usd', 'تراکنش های اشتراک', 'admin.subscribes.subscribe-payment.index', 5, '2023-05-16 19:44:37', '2023-05-16 19:44:37'),
(11, 'fa fa-user', 'کاربران', 'admin.users.user.index', 6, '2023-05-16 19:44:37', '2023-05-16 19:44:37'),
(12, 'fa fa-sun-o', 'شرط تولید کد', 'admin.offs.code-off-status.index', 7, '2023-05-16 19:44:37', '2023-05-16 19:44:37'),
(13, 'fa fa-gift', 'کد تخفیف عمومی', 'admin.offs.code-off-public.index', 7, '2023-05-16 19:44:37', '2023-05-16 19:44:37'),
(14, 'fa fa-tag', 'کد تخفیف شخصی', 'admin.offs.code-off-person.index', 7, '2023-05-16 19:44:37', '2023-05-16 19:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `panel_groups`
--

CREATE TABLE `panel_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `panel_groups`
--

INSERT INTO `panel_groups` (`id`, `title`, `title_en`, `created_at`, `updated_at`) VALUES
(1, 'مدیریت ادمین ها', 'admin', '2023-05-16 19:44:37', '2023-05-16 19:44:37'),
(2, 'مدیریت بانک ها', 'bank', '2023-05-16 19:44:37', '2023-05-16 19:44:37'),
(3, 'مدیریت سفارشات', 'order', '2023-05-16 19:44:37', '2023-05-16 19:44:37'),
(4, 'مدیریت عمومی', 'public', '2023-05-16 19:44:37', '2023-05-16 19:44:37'),
(5, 'مدیریت اشتراک', 'subscribe', '2023-05-16 19:44:37', '2023-05-16 19:44:37'),
(6, 'مدیریت کاربران', 'user', '2023-05-16 19:44:37', '2023-05-16 19:44:37'),
(7, 'مدیریت تخفتفات', 'off', '2023-05-16 19:44:37', '2023-05-16 19:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone_messages`
--

CREATE TABLE `phone_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=>failed , 1=> success',
  `rec_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_my_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sms_target_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sms_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_class_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone_stores`
--

CREATE TABLE `phone_stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rsa_key` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jwt_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=>disable , 1=> enable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone_store_purchases`
--

CREATE TABLE `phone_store_purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `res_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_time` timestamp NULL DEFAULT NULL,
  `purchase_state` tinyint(4) NOT NULL DEFAULT -1 COMMENT '0=>pay , 1=> refund',
  `consumption_state` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=>yes consume , 1=> no consume',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_off` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `real_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `off_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jwt_string` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_result` text COLLATE utf8mb4_unicode_ci DEFAULT '',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subscribe_id` bigint(20) UNSIGNED NOT NULL,
  `phone_store_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone_store_request_tokens`
--

CREATE TABLE `phone_store_request_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_secret` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `refresh_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect_uri` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=>disable , 1=> enable',
  `phone_store_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone_store_tokens`
--

CREATE TABLE `phone_store_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `access_token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `expired_in` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=>disable , 1=> enable',
  `phone_store_id` bigint(20) UNSIGNED NOT NULL,
  `phone_store_request_token_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone_web_services`
--

CREATE TABLE `phone_web_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_class_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_panel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=>failed , 1=> success',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request_change_passwords`
--

CREATE TABLE `request_change_passwords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_rule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=>failed , 1=> success',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seo_keywords`
--

CREATE TABLE `seo_keywords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_meta_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seo_metas`
--

CREATE TABLE `seo_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_id` bigint(20) DEFAULT NULL,
  `seo_page_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seo_meta_seo_robot`
--

CREATE TABLE `seo_meta_seo_robot` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seo_robot_id` bigint(20) UNSIGNED NOT NULL,
  `seo_meta_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seo_pages`
--

CREATE TABLE `seo_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spical` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seo_robots`
--

CREATE TABLE `seo_robots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titleEn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titleFa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `titleEn`, `titleFa`, `value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'site_name', 'عنوان سایت', 'فاکتور ساز', '2023-05-16 19:43:20', '2023-05-16 19:43:20', NULL),
(2, 'site_name_en', 'عنوان انگلیسی', 'FactorSize', '2023-05-16 19:43:20', '2023-05-16 19:43:20', NULL),
(3, 'address', 'آدرس', '', '2023-05-16 19:43:20', '2023-05-16 19:43:20', NULL),
(4, 'site_email', 'ایمیل سایت', '', '2023-05-16 19:43:20', '2023-05-16 19:43:20', NULL),
(5, 'site_phone', 'تلفن سایت', '', '2023-05-16 19:43:20', '2023-05-16 19:43:20', NULL),
(6, 'telegram', 'کانال تلگرام', '', '2023-05-16 19:43:20', '2023-05-16 19:43:20', NULL),
(7, 'instagram', 'کانال اینستاگرام', '', '2023-05-16 19:43:20', '2023-05-16 19:43:20', NULL),
(8, 'twitter', 'کانال تویتر', '', '2023-05-16 19:43:20', '2023-05-16 19:43:20', NULL),
(9, 'facebook', 'کانال فیسبوک', '', '2023-05-16 19:43:20', '2023-05-16 19:43:20', NULL),
(10, 'about_us', 'درباره ما', '', '2023-05-16 19:43:20', '2023-05-16 19:43:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sitemap_files`
--

CREATE TABLE `sitemap_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_fa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sitemap_urls`
--

CREATE TABLE `sitemap_urls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priority` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `changefreq` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sitemap_file_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribes`
--

CREATE TABLE `subscribes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `real_price` int(11) DEFAULT NULL,
  `off_price` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=>disable , 1=> enable',
  `selected` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=>not selected , 1=> selected :for slider',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribes`
--

INSERT INTO `subscribes` (`id`, `title`, `sku`, `description`, `slug`, `real_price`, `off_price`, `duration`, `status`, `selected`, `created_at`, `updated_at`) VALUES
(1, 'اشتراک شماره 1', NULL, 'متن برای اشتراک اول', 'اشتراک-اول', 1000, 500, 2, 1, 0, '2023-05-18 08:01:19', '2023-05-18 08:01:19'),
(2, 'اشتراک شماره 2', NULL, 'متن برای اشتراک دوم', 'اشتراک-دوم', 1500, 1000, 2, 1, 0, '2023-05-18 08:01:19', '2023-05-18 08:01:19'),
(3, 'اشتراک شماره 3', NULL, 'متن برای اشتراک سوم', 'اشتراک-سوم', 2000, 1500, 2, 1, 0, '2023-05-18 08:01:19', '2023-05-18 08:01:19');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe_payments`
--

CREATE TABLE `subscribe_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `res_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=>not pay , 1=> pay',
  `admin_add` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=>not admin add , 1=> admin add',
  `time_set` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subscribe_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribe_payments`
--


-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `seen` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=>not seen , 1=> seen',
  `ticket_folder_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_categories`
--

CREATE TABLE `ticket_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=>disable , 1=> enable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_folders`
--

CREATE TABLE `ticket_folders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=>disable , 1=> enable',
  `ticket_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'avatar',
  `activation` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=>disable , 1=>enable , for register client ',
  `activation_time` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=>disable , 1=> enable , for disable client for site',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `cart_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `family`, `email`, `email_verified_at`, `mobile`, `mobile_verified_at`, `password`, `profile_photo_path`, `activation`, `activation_time`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `cart_number`) VALUES
(1, 'مهدی', 'معارفیان', 'masoodevil6@gmail.com', '2023-05-16 17:55:27', NULL, NULL, '', NULL, 1, '2023-05-16 17:55:27', 1, NULL, '2023-05-16 17:55:27', '2023-05-20 20:57:13', NULL, '5859831121010523');

-- --------------------------------------------------------

--
-- Table structure for table `user_messages`
--

CREATE TABLE `user_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visit` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=>not see , 1=> see',
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_panel`
--
ALTER TABLE `admin_panel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_panel_panel_id_foreign` (`panel_id`),
  ADD KEY `admin_panel_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_user_user_id_foreign` (`user_id`),
  ADD KEY `admin_user_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `app_categories`
--
ALTER TABLE `app_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_files`
--
ALTER TABLE `app_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_files_app_category_id_foreign` (`app_category_id`);

--
-- Indexes for table `app_file_links`
--
ALTER TABLE `app_file_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_file_links_app_file_id_foreign` (`app_file_id`),
  ADD KEY `app_file_links_app_category_id_foreign` (`app_category_id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_payments`
--
ALTER TABLE `bank_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_payments_user_id_foreign` (`user_id`),
  ADD KEY `bank_payments_order_id_foreign` (`order_id`);

--
-- Indexes for table `bank_payment_refunds`
--
ALTER TABLE `bank_payment_refunds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_payment_refunds_user_id_foreign` (`user_id`),
  ADD KEY `bank_payment_refunds_bank_payment_id_foreign` (`bank_payment_id`),
  ADD KEY `bank_payment_refunds_order_id_foreign` (`order_id`);

--
-- Indexes for table `bank_payment_un_verifies`
--
ALTER TABLE `bank_payment_un_verifies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_payment_un_verifies_user_id_foreign` (`user_id`),
  ADD KEY `bank_payment_un_verifies_bank_payment_id_foreign` (`bank_payment_id`),
  ADD KEY `bank_payment_un_verifies_order_id_foreign` (`order_id`);

--
-- Indexes for table `code_offs`
--
ALTER TABLE `code_offs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `code_offs_user_id_foreign` (`user_id`);

--
-- Indexes for table `code_off_statuses`
--
ALTER TABLE `code_off_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_parent_id_foreign` (`parent_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_likes_comment_id_foreign` (`comment_id`),
  ADD KEY `comment_likes_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_baskets`
--
ALTER TABLE `order_baskets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_baskets_order_id_foreign` (`order_id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `otps_token_unique` (`token`),
  ADD KEY `otps_user_id_foreign` (`user_id`);

--
-- Indexes for table `panels`
--
ALTER TABLE `panels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `panels_panel_group_id_foreign` (`panel_group_id`);

--
-- Indexes for table `panel_groups`
--
ALTER TABLE `panel_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `phone_messages`
--
ALTER TABLE `phone_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phone_stores`
--
ALTER TABLE `phone_stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phone_store_purchases`
--
ALTER TABLE `phone_store_purchases`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_store_purchases_order_id_unique` (`order_id`),
  ADD KEY `phone_store_purchases_user_id_foreign` (`user_id`),
  ADD KEY `phone_store_purchases_subscribe_id_foreign` (`subscribe_id`),
  ADD KEY `phone_store_purchases_phone_store_id_foreign` (`phone_store_id`);

--
-- Indexes for table `phone_store_request_tokens`
--
ALTER TABLE `phone_store_request_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone_store_request_tokens_phone_store_id_foreign` (`phone_store_id`);

--
-- Indexes for table `phone_store_tokens`
--
ALTER TABLE `phone_store_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone_store_tokens_phone_store_id_foreign` (`phone_store_id`),
  ADD KEY `phone_store_tokens_phone_store_request_token_id_foreign` (`phone_store_request_token_id`);

--
-- Indexes for table `phone_web_services`
--
ALTER TABLE `phone_web_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_change_passwords`
--
ALTER TABLE `request_change_passwords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_keywords`
--
ALTER TABLE `seo_keywords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seo_keywords_seo_meta_id_foreign` (`seo_meta_id`);

--
-- Indexes for table `seo_metas`
--
ALTER TABLE `seo_metas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seo_metas_seo_page_id_foreign` (`seo_page_id`);

--
-- Indexes for table `seo_meta_seo_robot`
--
ALTER TABLE `seo_meta_seo_robot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seo_meta_seo_robot_seo_robot_id_foreign` (`seo_robot_id`),
  ADD KEY `seo_meta_seo_robot_seo_meta_id_foreign` (`seo_meta_id`);

--
-- Indexes for table `seo_pages`
--
ALTER TABLE `seo_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_robots`
--
ALTER TABLE `seo_robots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sitemap_files`
--
ALTER TABLE `sitemap_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sitemap_urls`
--
ALTER TABLE `sitemap_urls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sitemap_urls_sitemap_file_id_foreign` (`sitemap_file_id`);

--
-- Indexes for table `subscribes`
--
ALTER TABLE `subscribes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscribes_slug_unique` (`slug`);

--
-- Indexes for table `subscribe_payments`
--
ALTER TABLE `subscribe_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscribe_payments_user_id_foreign` (`user_id`),
  ADD KEY `subscribe_payments_subscribe_id_foreign` (`subscribe_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_ticket_folder_id_foreign` (`ticket_folder_id`),
  ADD KEY `tickets_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_folders`
--
ALTER TABLE `ticket_folders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_folders_ticket_category_id_foreign` (`ticket_category_id`),
  ADD KEY `ticket_folders_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`);

--
-- Indexes for table `user_messages`
--
ALTER TABLE `user_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_messages_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_panel`
--
ALTER TABLE `admin_panel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `app_categories`
--
ALTER TABLE `app_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_files`
--
ALTER TABLE `app_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_file_links`
--
ALTER TABLE `app_file_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_payments`
--
ALTER TABLE `bank_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `bank_payment_refunds`
--
ALTER TABLE `bank_payment_refunds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_payment_un_verifies`
--
ALTER TABLE `bank_payment_un_verifies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `code_offs`
--
ALTER TABLE `code_offs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `code_off_statuses`
--
ALTER TABLE `code_off_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment_likes`
--
ALTER TABLE `comment_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `order_baskets`
--
ALTER TABLE `order_baskets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `panels`
--
ALTER TABLE `panels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `panel_groups`
--
ALTER TABLE `panel_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone_messages`
--
ALTER TABLE `phone_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone_stores`
--
ALTER TABLE `phone_stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone_store_purchases`
--
ALTER TABLE `phone_store_purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone_store_request_tokens`
--
ALTER TABLE `phone_store_request_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone_store_tokens`
--
ALTER TABLE `phone_store_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone_web_services`
--
ALTER TABLE `phone_web_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request_change_passwords`
--
ALTER TABLE `request_change_passwords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seo_keywords`
--
ALTER TABLE `seo_keywords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seo_metas`
--
ALTER TABLE `seo_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seo_meta_seo_robot`
--
ALTER TABLE `seo_meta_seo_robot`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seo_pages`
--
ALTER TABLE `seo_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seo_robots`
--
ALTER TABLE `seo_robots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sitemap_files`
--
ALTER TABLE `sitemap_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sitemap_urls`
--
ALTER TABLE `sitemap_urls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribes`
--
ALTER TABLE `subscribes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscribe_payments`
--
ALTER TABLE `subscribe_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_categories`
--
ALTER TABLE `ticket_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_folders`
--
ALTER TABLE `ticket_folders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_messages`
--
ALTER TABLE `user_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_panel`
--
ALTER TABLE `admin_panel`
  ADD CONSTRAINT `admin_panel_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `admin_panel_panel_id_foreign` FOREIGN KEY (`panel_id`) REFERENCES `panels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD CONSTRAINT `admin_user_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `admin_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `app_files`
--
ALTER TABLE `app_files`
  ADD CONSTRAINT `app_files_app_category_id_foreign` FOREIGN KEY (`app_category_id`) REFERENCES `app_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `app_file_links`
--
ALTER TABLE `app_file_links`
  ADD CONSTRAINT `app_file_links_app_category_id_foreign` FOREIGN KEY (`app_category_id`) REFERENCES `app_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `app_file_links_app_file_id_foreign` FOREIGN KEY (`app_file_id`) REFERENCES `app_files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bank_payments`
--
ALTER TABLE `bank_payments`
  ADD CONSTRAINT `bank_payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bank_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bank_payment_refunds`
--
ALTER TABLE `bank_payment_refunds`
  ADD CONSTRAINT `bank_payment_refunds_bank_payment_id_foreign` FOREIGN KEY (`bank_payment_id`) REFERENCES `bank_payments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bank_payment_refunds_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bank_payment_refunds_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bank_payment_un_verifies`
--
ALTER TABLE `bank_payment_un_verifies`
  ADD CONSTRAINT `bank_payment_un_verifies_bank_payment_id_foreign` FOREIGN KEY (`bank_payment_id`) REFERENCES `bank_payments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bank_payment_un_verifies_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bank_payment_un_verifies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `code_offs`
--
ALTER TABLE `code_offs`
  ADD CONSTRAINT `code_offs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD CONSTRAINT `comment_likes_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_baskets`
--
ALTER TABLE `order_baskets`
  ADD CONSTRAINT `order_baskets_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `otps`
--
ALTER TABLE `otps`
  ADD CONSTRAINT `otps_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `panels`
--
ALTER TABLE `panels`
  ADD CONSTRAINT `panels_panel_group_id_foreign` FOREIGN KEY (`panel_group_id`) REFERENCES `panel_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `phone_store_purchases`
--
ALTER TABLE `phone_store_purchases`
  ADD CONSTRAINT `phone_store_purchases_phone_store_id_foreign` FOREIGN KEY (`phone_store_id`) REFERENCES `phone_stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phone_store_purchases_subscribe_id_foreign` FOREIGN KEY (`subscribe_id`) REFERENCES `subscribes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phone_store_purchases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `phone_store_request_tokens`
--
ALTER TABLE `phone_store_request_tokens`
  ADD CONSTRAINT `phone_store_request_tokens_phone_store_id_foreign` FOREIGN KEY (`phone_store_id`) REFERENCES `phone_stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `phone_store_tokens`
--
ALTER TABLE `phone_store_tokens`
  ADD CONSTRAINT `phone_store_tokens_phone_store_id_foreign` FOREIGN KEY (`phone_store_id`) REFERENCES `phone_stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `phone_store_tokens_phone_store_request_token_id_foreign` FOREIGN KEY (`phone_store_request_token_id`) REFERENCES `phone_store_request_tokens` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seo_keywords`
--
ALTER TABLE `seo_keywords`
  ADD CONSTRAINT `seo_keywords_seo_meta_id_foreign` FOREIGN KEY (`seo_meta_id`) REFERENCES `seo_metas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seo_metas`
--
ALTER TABLE `seo_metas`
  ADD CONSTRAINT `seo_metas_seo_page_id_foreign` FOREIGN KEY (`seo_page_id`) REFERENCES `seo_pages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seo_meta_seo_robot`
--
ALTER TABLE `seo_meta_seo_robot`
  ADD CONSTRAINT `seo_meta_seo_robot_seo_meta_id_foreign` FOREIGN KEY (`seo_meta_id`) REFERENCES `seo_metas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seo_meta_seo_robot_seo_robot_id_foreign` FOREIGN KEY (`seo_robot_id`) REFERENCES `seo_robots` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sitemap_urls`
--
ALTER TABLE `sitemap_urls`
  ADD CONSTRAINT `sitemap_urls_sitemap_file_id_foreign` FOREIGN KEY (`sitemap_file_id`) REFERENCES `sitemap_files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscribe_payments`
--
ALTER TABLE `subscribe_payments`
  ADD CONSTRAINT `subscribe_payments_subscribe_id_foreign` FOREIGN KEY (`subscribe_id`) REFERENCES `subscribes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subscribe_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tickets_ticket_folder_id_foreign` FOREIGN KEY (`ticket_folder_id`) REFERENCES `ticket_folders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket_folders`
--
ALTER TABLE `ticket_folders`
  ADD CONSTRAINT `ticket_folders_ticket_category_id_foreign` FOREIGN KEY (`ticket_category_id`) REFERENCES `ticket_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_folders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_messages`
--
ALTER TABLE `user_messages`
  ADD CONSTRAINT `user_messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
