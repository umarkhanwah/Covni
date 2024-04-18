-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2023 at 10:04 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `covni`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `age`, `gender`, `phone`, `adress`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '18', 'Male', '03128571707', 'svdkmlskdnvlk', '$2y$10$HQmhyANKkuyTgWXMSi.y4.gZ3eOCb7Z9BuU.GSwJzwwNxMY1BvXlG', NULL, '2023-09-12 02:24:33', '2023-09-12 02:24:33');

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
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permission` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `name`, `email`, `adress`, `phone`, `country`, `city`, `province`, `password`, `permission`, `created_at`, `updated_at`) VALUES
(1, 'Agha Khan', 'agha@gmail.com', 'kajkcajja', '98765432100', 'Pakistan', 'Karachi', 'Sindh', '$2y$10$FS.i.DKfk06P6kS2wEpMUOL3/ntN2Aph9OgVvPob5CfX.QgiwwklW', 'yes', '2023-09-12 01:08:33', '2023-09-12 02:24:53'),
(2, 'Indus', 'indus@gmail.com', 'nvdakndvjn', '78945612300', 'Pakistan', 'Karachi', 'Sindh', '$2y$10$nB6TxUzQWGYLR5Tj./dZruQzTOq1L76Qc3tuUh61ZoqwaOgCq.sH.', NULL, '2023-09-12 03:03:25', '2023-09-12 03:03:25'),
(3, 'Seven Days', 'sevendays@gmail.com', 'ndvakjd', '12345678900', 'Pakistan', 'Karachi', 'Sindh', '$2y$10$jODOiXy22f9ydZGV1OcS5uHJkNkc/R7v9d3AfsLkiMrWumnW1SXui', NULL, '2023-09-12 03:03:52', '2023-09-12 03:03:52');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_17_060339_create_hospitals_table', 1),
(6, '2023_08_17_060405_create_admins_table', 1),
(7, '2023_08_23_062354_create_test_timings_table', 1),
(8, '2023_09_04_062852_create_test_reports_table', 1);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test_reports`
--

CREATE TABLE `test_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hosp_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `vaccination` varchar(255) NOT NULL,
  `pdf_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_reports`
--

INSERT INTO `test_reports` (`id`, `hosp_id`, `user_id`, `status`, `vaccination`, `pdf_path`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Positive', 'Covax', 'pdf/1_test_report.pdf', '2023-09-12 02:55:55', '2023-09-12 02:55:59');

-- --------------------------------------------------------

--
-- Table structure for table `test_timings`
--

CREATE TABLE `test_timings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hosp_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `days` varchar(255) NOT NULL,
  `timing` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_timings`
--

INSERT INTO `test_timings` (`id`, `hosp_id`, `user_id`, `days`, `timing`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Monday', '9 to 11', '2023-09-12 02:24:53', '2023-09-12 02:53:16'),
(2, 1, 1, 'Monday', '12 to 2', '2023-09-12 02:24:53', '2023-09-12 02:53:31'),
(3, 1, NULL, 'Monday', '3 to 5', '2023-09-12 02:24:53', '2023-09-12 02:53:07'),
(4, 1, NULL, 'Monday', '6 to 8', '2023-09-12 02:24:54', '2023-09-12 02:45:56'),
(5, 1, 1, 'Tuesday', '9 to 11', '2023-09-12 02:24:54', '2023-09-12 02:53:30'),
(6, 1, NULL, 'Tuesday', '12 to 2', '2023-09-12 02:24:54', '2023-09-12 02:37:17'),
(7, 1, NULL, 'Tuesday', '3 to 5', '2023-09-12 02:24:54', '2023-09-12 02:53:09'),
(8, 1, NULL, 'Tuesday', '6 to 8', '2023-09-12 02:24:54', '2023-09-12 02:24:54'),
(9, 1, NULL, 'Wednesday', '9 to 11', '2023-09-12 02:24:54', '2023-09-12 02:37:22'),
(10, 1, NULL, 'Wednesday', '12 to 2', '2023-09-12 02:24:54', '2023-09-12 02:24:54'),
(11, 1, NULL, 'Wednesday', '3 to 5', '2023-09-12 02:24:54', '2023-09-12 02:53:10'),
(12, 1, NULL, 'Wednesday', '6 to 8', '2023-09-12 02:24:54', '2023-09-12 02:53:12'),
(13, 1, NULL, 'Thursday', '9 to 11', '2023-09-12 02:24:54', '2023-09-12 02:24:54'),
(14, 1, NULL, 'Thursday', '12 to 2', '2023-09-12 02:24:54', '2023-09-12 02:24:54'),
(15, 1, NULL, 'Thursday', '3 to 5', '2023-09-12 02:24:54', '2023-09-12 02:24:54'),
(16, 1, NULL, 'Thursday', '6 to 8', '2023-09-12 02:24:54', '2023-09-12 02:24:54'),
(17, 1, NULL, 'Friday', '9 to 11', '2023-09-12 02:24:54', '2023-09-12 02:24:54'),
(18, 1, NULL, 'Friday', '12 to 2', '2023-09-12 02:24:54', '2023-09-12 02:24:54'),
(19, 1, NULL, 'Friday', '3 to 5', '2023-09-12 02:24:54', '2023-09-12 02:24:54'),
(20, 1, NULL, 'Friday', '6 to 8', '2023-09-12 02:24:54', '2023-09-12 02:24:54'),
(21, 1, NULL, 'Saturday', '9 to 11', '2023-09-12 02:24:54', '2023-09-12 02:24:54'),
(22, 1, NULL, 'Saturday', '12 to 2', '2023-09-12 02:24:54', '2023-09-12 02:24:54'),
(23, 1, NULL, 'Saturday', '3 to 5', '2023-09-12 02:24:54', '2023-09-12 02:24:54'),
(24, 1, NULL, 'Saturday', '6 to 8', '2023-09-12 02:24:54', '2023-09-12 02:24:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `age`, `gender`, `phone`, `adress`, `password`, `phone_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'User', '18', 'Male', '12345678900', 'kahi bhi', '$2y$10$tSGK2NLzh9fki3w7CUFzr.lEcpttRcuiWSX1WpqxzKqtJLLNG590C', NULL, NULL, '2023-09-12 02:25:46', '2023-09-12 02:25:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_phone_unique` (`phone`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hospitals_email_unique` (`email`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `test_reports`
--
ALTER TABLE `test_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_reports_hosp_id_foreign` (`hosp_id`),
  ADD KEY `test_reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `test_timings`
--
ALTER TABLE `test_timings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_timings_hosp_id_foreign` (`hosp_id`),
  ADD KEY `test_timings_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_reports`
--
ALTER TABLE `test_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `test_timings`
--
ALTER TABLE `test_timings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `test_reports`
--
ALTER TABLE `test_reports`
  ADD CONSTRAINT `test_reports_hosp_id_foreign` FOREIGN KEY (`hosp_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `test_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `test_timings`
--
ALTER TABLE `test_timings`
  ADD CONSTRAINT `test_timings_hosp_id_foreign` FOREIGN KEY (`hosp_id`) REFERENCES `hospitals` (`id`),
  ADD CONSTRAINT `test_timings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
