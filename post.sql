-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 10, 2023 at 05:48 PM
-- Server version: 8.0.33-0ubuntu0.20.04.1
-- PHP Version: 7.4.3-4ubuntu2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `post`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `coment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `coment`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'sdfsd', '2023-05-10 05:04:51', '2023-05-10 05:04:51'),
(2, 1, 4, 'hhhii', '2023-05-10 05:56:49', '2023-05-10 05:56:49'),
(3, 5, 4, 'hii', '2023-05-10 05:57:00', '2023-05-10 05:57:00'),
(4, 1, 3, 'sdf', '2023-05-10 06:00:19', '2023-05-10 06:00:19');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_03_061900_create_post_table', 1),
(6, '2023_05_03_061918_create_comments_table', 1),
(7, '2023_05_05_040200_create_reaction_table', 2),
(8, '2023_05_08_065046_create_notification__table', 3),
(9, '2023_05_09_052753_rename_notification_table_to_notification', 4),
(10, '2023_05_09_053140_add_reaction_id_column_to_notification_table', 5),
(11, '2023_05_09_061311_add_reaction_status_column_to_notification_table', 6),
(13, '2023_05_09_102517_add_dislike_column_to_notification_table', 7),
(14, '2023_05_09_104952_add_liked_column_to_notification_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `notification_status` smallint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reaction_id` int NOT NULL,
  `dislike` int NOT NULL DEFAULT '0',
  `liked` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `user_id`, `post_id`, `notification_status`, `created_at`, `updated_at`, `reaction_id`, `dislike`, `liked`) VALUES
(1, 1, 1, 0, '2023-05-10 05:53:54', '2023-05-10 06:36:02', 1, 0, 1),
(2, 3, 3, 1, '2023-05-10 05:55:20', '2023-05-10 05:56:01', 2, 0, 1),
(3, 3, 2, 1, '2023-05-10 05:55:21', '2023-05-10 06:26:17', 3, 0, 1),
(4, 3, 1, 1, '2023-05-10 05:55:22', '2023-05-10 06:00:25', 4, 0, 1),
(5, 5, 1, 1, '2023-05-10 05:55:24', '2023-05-10 06:36:23', 5, 0, 1),
(6, 5, 2, 1, '2023-05-10 05:55:25', '2023-05-10 06:29:01', 6, 0, 1),
(7, 5, 3, 1, '2023-05-10 05:55:27', '2023-05-10 05:56:04', 7, 0, 1),
(8, 1, 2, 1, '2023-05-10 05:55:34', '2023-05-10 06:29:03', 8, 0, 1),
(9, 1, 3, 0, '2023-05-10 05:55:36', '2023-05-10 05:57:52', 9, 0, 1),
(10, 1, 4, 0, '2023-05-10 05:55:36', '2023-05-10 05:55:36', 10, 0, 1),
(11, 5, 4, 0, '2023-05-10 06:14:21', '2023-05-10 06:14:21', 11, 0, 1),
(12, 4, 2, 1, '2023-05-10 06:30:51', '2023-05-10 06:30:56', 12, 0, 1);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `post_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `post_title`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'mahadev', '645b7ec776249_1683717831.jpg', 'Shiva', '2023-05-10 05:53:51', '2023-05-10 05:53:51'),
(2, 4, 'Shiva', '645b7ee585cbd_1683717861.jpeg', 'Tiger', '2023-05-10 05:54:21', '2023-05-10 05:54:21'),
(3, 5, 'Shiva', '645b7eff1ce78_1683717887.jpg', 'Shiva', '2023-05-10 05:54:47', '2023-05-10 05:54:47'),
(4, 3, 'flower', '645b7f1463067_1683717908.jpg', 'Flower', '2023-05-10 05:55:08', '2023-05-10 05:55:08');

-- --------------------------------------------------------

--
-- Table structure for table `reaction`
--

CREATE TABLE `reaction` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `upvote` smallint NOT NULL DEFAULT '0',
  `downvote` smallint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reaction`
--

INSERT INTO `reaction` (`id`, `user_id`, `post_id`, `upvote`, `downvote`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 0, '2023-05-10 05:53:54', '2023-05-10 06:36:02'),
(2, 3, 3, 1, 0, '2023-05-10 05:55:20', '2023-05-10 05:55:20'),
(3, 3, 2, 1, 0, '2023-05-10 05:55:21', '2023-05-10 05:55:21'),
(4, 3, 1, 1, 0, '2023-05-10 05:55:22', '2023-05-10 05:55:22'),
(5, 5, 1, 1, 0, '2023-05-10 05:55:24', '2023-05-10 06:36:14'),
(6, 5, 2, 1, 0, '2023-05-10 05:55:25', '2023-05-10 05:55:25'),
(7, 5, 3, 1, 0, '2023-05-10 05:55:27', '2023-05-10 05:55:27'),
(8, 1, 2, 1, 0, '2023-05-10 05:55:34', '2023-05-10 06:25:46'),
(9, 1, 3, 1, 0, '2023-05-10 05:55:36', '2023-05-10 05:57:52'),
(10, 1, 4, 1, 0, '2023-05-10 05:55:36', '2023-05-10 05:55:36'),
(11, 5, 4, 1, 0, '2023-05-10 06:14:21', '2023-05-10 06:14:21'),
(12, 4, 2, 1, 0, '2023-05-10 06:30:51', '2023-05-10 06:30:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Manish', 'skmanish@yopmail.com', NULL, '$2y$10$sHH0kiPtOJvRcRgvKUNGKeIpiNFDg3yab5q1fRWzAsLzKxRgDhOx2', NULL, '2023-05-03 01:46:15', '2023-05-03 01:46:15'),
(2, 'Raunak', 'rs@yopmail.com', NULL, '$2y$10$HHAhK5ZvLvCuNO0wrFQnZebxEMaGOkIZoTv17OYmcf8IqsvP9Xdli', NULL, '2023-05-04 01:38:37', '2023-05-04 01:38:37'),
(3, 'Test', 'test@yopmail.com', NULL, '$2y$10$vPtzMWjuLy0ImG57Zeikfe6AiSZdkDaTNly0LYKyQOMK9GsYhkK9u', NULL, '2023-05-08 04:23:53', '2023-05-08 04:23:53'),
(4, 'admin', 'admin@yopmail.com', NULL, '$2y$10$VqcrGpkgDosizqBvTHYsmO3IRWWL4pz2IdGIV5c.FhNh/iibzE1Pi', NULL, '2023-05-08 05:17:08', '2023-05-08 05:17:08'),
(5, 'manoj', 'manoj@yopmail.com', NULL, '$2y$10$LL3Q6huAIx3o7.1QIZ9xfukm2S7SIAOvarzqHi87pzDVgQXvoL4Mq', NULL, '2023-05-08 05:25:22', '2023-05-08 05:25:22'),
(6, 'Manoj', 'mj@yopmail.com', NULL, '$2y$10$utv2TPNUrfm0f3XDnuY1yeISKEXxkVmDFc4i1fsHoF8cugXCjoiOq', NULL, '2023-05-09 00:20:34', '2023-05-09 00:20:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reaction`
--
ALTER TABLE `reaction`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reaction`
--
ALTER TABLE `reaction`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
