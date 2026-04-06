-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th4 06, 2026 lúc 05:11 PM
-- Phiên bản máy phục vụ: 8.0.30
-- Phiên bản PHP: 8.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `topcv`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cvs`
--

CREATE TABLE `cvs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_uploaded` tinyint(1) NOT NULL DEFAULT '0',
  `extracted_skills` json DEFAULT NULL,
  `extracted_experience` json DEFAULT NULL,
  `content` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cvs`
--

INSERT INTO `cvs` (`id`, `user_id`, `title`, `file_path`, `is_uploaded`, `extracted_skills`, `extracted_experience`, `content`, `created_at`, `updated_at`) VALUES
(1, 2, 'CV mới (06/04/2026)', NULL, 0, NULL, NULL, '{\"header\": {\"dob\": \"\", \"name\": \"Đức Anh Nguyễn\", \"email\": \"anp93005@gmail.com\", \"phone\": \"\", \"gender\": \"\", \"address\": \"\", \"website\": \"\", \"job_title\": \"Vị trí mong muốn\"}, \"sections\": [{\"id\": \"objective\", \"type\": \"text\", \"title\": \"Lời giới thiệu\", \"content\": \"Tóm tắt kỹ năng bản thân...\"}, {\"id\": \"experience\", \"type\": \"list\", \"items\": [{\"date\": \"2022\", \"title\": \"Công ty X\", \"subtitle\": \"Designer\", \"description\": \"...\"}], \"title\": \"Quá trình làm việc\"}, {\"id\": \"skills\", \"type\": \"text\", \"title\": \"Kỹ năng\", \"content\": \"- PHP, Laravel, Tailwind...\"}], \"settings\": {\"theme\": \"rose\", \"template\": \"modern_bento\"}}', '2026-04-06 10:10:09', '2026-04-06 10:10:09');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cv_job_matches`
--

CREATE TABLE `cv_job_matches` (
  `id` bigint UNSIGNED NOT NULL,
  `cv_id` bigint UNSIGNED NOT NULL,
  `job_description_id` bigint UNSIGNED NOT NULL,
  `match_score` decimal(5,2) NOT NULL DEFAULT '0.00',
  `missing_skills` json DEFAULT NULL,
  `improvement_suggestions` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `job_descriptions`
--

CREATE TABLE `job_descriptions` (
  `id` bigint UNSIGNED NOT NULL,
  `employer_id` bigint UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domain` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `requirements` text COLLATE utf8mb4_unicode_ci,
  `benefits` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `job_descriptions`
--

INSERT INTO `job_descriptions` (`id`, `employer_id`, `company_name`, `title`, `domain`, `description`, `requirements`, `benefits`, `created_at`, `updated_at`) VALUES
(1, 2, 'Công ty TNHH thang máy An Đức', 'Chuyên viên Kinh doanh Thang máy', 'Marketing & Sales, DIG', '\"- Trung thực, thẳng thắn, có trách nhiệm\r\n- Có kinh nghiệm kinh doanh (ưu tiên ngành thang máy)\r\n- Giao tiếp tốt, chủ động trong công việc\"', '\"- Tìm kiếm, tư vấn và chăm sóc khách hàng\r\n- Phối hợp với bộ phận kỹ thuật triển khai hợp đồng\r\n- Duy trì mối quan hệ khách hàng lâu dài\"', '1 triệu', '2026-04-06 10:08:16', '2026-04-06 10:08:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2026_04_06_131029_create_job_descriptions_table', 2),
(10, '2026_04_06_131030_create_cvs_table', 2),
(11, '2026_04_06_131031_create_cv_job_matches_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('candidate','employer','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'candidate',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@gmail.com', 'admin', '2026-04-06 06:32:04', '$2y$10$2wbTsWf/auDrMWkGZPjI8ucpBzUbSha1gj7ykyhiYLgCFw5khRShS', 'UTiTYXdx1p4sH7PXkxMDTzSCpdMFDxqTcmAsu5dnOESxk7BwmuPn3WbAzhRV', '2026-04-06 06:32:04', '2026-04-06 06:32:04'),
(2, 'Đức Anh Nguyễn', 'anp93005@gmail.com', 'candidate', NULL, '$2y$10$bGf7F0Hu/MG/2mHmqbvxJuCxIgEqn3KUxcMEb67Nwexkyi/ZggWDW', NULL, '2026-04-06 06:32:49', '2026-04-06 06:38:05');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cvs`
--
ALTER TABLE `cvs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cvs_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `cv_job_matches`
--
ALTER TABLE `cv_job_matches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cv_job_matches_cv_id_foreign` (`cv_id`),
  ADD KEY `cv_job_matches_job_description_id_foreign` (`job_description_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `job_descriptions`
--
ALTER TABLE `job_descriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_descriptions_employer_id_foreign` (`employer_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cvs`
--
ALTER TABLE `cvs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `cv_job_matches`
--
ALTER TABLE `cv_job_matches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `job_descriptions`
--
ALTER TABLE `job_descriptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cvs`
--
ALTER TABLE `cvs`
  ADD CONSTRAINT `cvs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `cv_job_matches`
--
ALTER TABLE `cv_job_matches`
  ADD CONSTRAINT `cv_job_matches_cv_id_foreign` FOREIGN KEY (`cv_id`) REFERENCES `cvs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cv_job_matches_job_description_id_foreign` FOREIGN KEY (`job_description_id`) REFERENCES `job_descriptions` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `job_descriptions`
--
ALTER TABLE `job_descriptions`
  ADD CONSTRAINT `job_descriptions_employer_id_foreign` FOREIGN KEY (`employer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
