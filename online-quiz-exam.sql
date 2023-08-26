-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2023 at 06:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online-quiz-exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1:active, 0:inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Quiz', 1, '2023-06-06 23:03:16', '2023-06-06 23:03:16'),
(2, 'Mcq', 1, '2023-06-06 23:03:24', '2023-06-06 23:03:24');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `exam_date` date NOT NULL,
  `exam_duration` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1:active, 0:inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `category_id`, `title`, `exam_date`, `exam_duration`, `status`, `created_at`, `updated_at`) VALUES
(4, 2, 'Bangla Test', '2023-06-08', 10, 1, '2023-06-08 01:45:25', '2023-06-08 01:45:25'),
(5, 1, 'Leran web development', '2023-06-08', 1, 1, '2023-06-08 03:01:07', '2023-06-08 03:01:07');

-- --------------------------------------------------------

--
-- Table structure for table `exam_ques`
--

CREATE TABLE `exam_ques` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `exam_id` bigint(20) UNSIGNED DEFAULT NULL,
  `question` varchar(255) DEFAULT NULL,
  `options` varchar(255) DEFAULT NULL,
  `ans` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1:active, 0:inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_ques`
--

INSERT INTO `exam_ques` (`id`, `exam_id`, `question`, `options`, `ans`, `status`, `created_at`, `updated_at`) VALUES
(7, 4, 'What is the vacation date', '{\"option1\":\"5 day\",\"option2\":\"4 Day\",\"option3\":\"2 Day\",\"option4\":\"7 Day\",\"option5\":\"11 day\",\"option6\":\"1 day\"}', '1 day', 1, '2023-06-08 01:45:48', '2023-06-08 01:45:48'),
(8, 4, 'National Income estimates in India are prepared by', '{\"option1\":\"An operating system\",\"option2\":\"A processing device\",\"option3\":\"Application software\",\"option4\":\"Indian statistical Institute\",\"option5\":\"compensating error\",\"option6\":\"one side and two angles\"}', 'Application software', 1, '2023-06-08 01:46:06', '2023-06-08 01:46:06'),
(9, 4, 'The staple food of the Vedic Aryan was', '{\"option1\":\"checks the\",\"option2\":\"enables\",\"option3\":\"fixes up the\",\"option4\":\"adjustment\",\"option5\":\"three angles\",\"option6\":\"always folt\"}', 'adjustment', 1, '2023-06-08 01:46:28', '2023-06-08 01:46:28'),
(10, 5, 'What is php', '{\"option1\":\"program\",\"option2\":\"langauge\",\"option3\":\"script\",\"option4\":\"word\",\"option5\":\"nothing\",\"option6\":\"cse\"}', 'script', 1, '2023-06-08 03:01:48', '2023-06-08 03:01:48'),
(11, 5, 'Python is', '{\"option1\":\"essy\",\"option2\":\"good\",\"option3\":\"nothing\",\"option4\":\"bad\",\"option5\":\"all\",\"option6\":\"ok\"}', 'essy', 1, '2023-06-08 03:02:16', '2023-06-08 03:02:16');

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `exam_id` bigint(20) NOT NULL,
  `correct_ans` varchar(255) DEFAULT NULL,
  `wrong_ans` varchar(255) DEFAULT NULL,
  `result_json` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_results`
--

INSERT INTO `exam_results` (`id`, `user_id`, `exam_id`, `correct_ans`, `wrong_ans`, `result_json`, `created_at`, `updated_at`) VALUES
(2, 2, 4, '1', '2', '{\"7\":\"YES\",\"8\":\"NO\",\"9\":\"NO\"}', '2023-06-08 04:18:13', '2023-06-08 04:18:13'),
(3, 3, 4, '2', '1', '{\"7\":\"YES\",\"8\":\"YES\",\"9\":\"NO\"}', '2023-06-08 04:19:27', '2023-06-08 04:19:27'),
(4, 2, 5, '1', '1', '{\"10\":\"YES\",\"11\":\"NO\"}', '2023-06-08 04:48:21', '2023-06-08 04:48:21');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_25_041701_create_categories_table', 1),
(6, '2023_05_25_060449_create_exams_table', 1),
(7, '2023_06_04_050847_create_exam_ques_table', 1),
(8, '2023_06_07_074900_create_user_exams_table', 2),
(9, '2023_06_08_043426_create_exam_results_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `role` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '01642953542', 1, NULL, '$2y$10$P2XgvngbGFbbo4jnftDVFuIN3ZMNZTTAs8fX5AxcfIFQKSV1/5Lg2', NULL, '2023-06-06 23:01:01', '2023-06-06 23:01:01'),
(2, 'Md Anikul Islam', 'anikul.islam01@northsouth.edu', '01905256528', 2, NULL, '$2y$10$8mh7CGPSsxzv93R9w5yaNun3fbF0oS.zuZ2JtEavQmGEm35yezSyC', NULL, '2023-06-06 23:08:46', '2023-06-06 23:08:46'),
(3, 'Mahfuzur Rahman', 'dcf.ctg@dgfood.gov.bd', '01905256524', 2, NULL, '$2y$10$6O.T7JO.6TrqQrJrmivFWe5m/ZQ1L1TMO59TD/XmAQnX1w.jwB4dG', NULL, '2023-06-07 04:49:53', '2023-06-07 04:49:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_exams`
--

CREATE TABLE `user_exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `exam_id` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1:active, 0:inactive',
  `exam_join_status` int(11) NOT NULL DEFAULT 0 COMMENT '1:Exam Complete, 0:Exam Not Complete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_exams`
--

INSERT INTO `user_exams` (`id`, `user_id`, `exam_id`, `status`, `exam_join_status`, `created_at`, `updated_at`) VALUES
(22, 2, 4, 1, 1, '2023-06-08 01:46:47', '2023-06-08 04:18:13'),
(23, 3, 5, 1, 0, '2023-06-08 03:02:34', '2023-06-08 03:02:34'),
(24, 2, 5, 1, 1, '2023-06-08 03:08:38', '2023-06-08 04:48:21'),
(25, 3, 4, 1, 1, '2023-06-08 04:18:57', '2023-06-08 04:19:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_ques`
--
ALTER TABLE `exam_ques`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `user_exams`
--
ALTER TABLE `user_exams`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `exam_ques`
--
ALTER TABLE `exam_ques`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_exams`
--
ALTER TABLE `user_exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
