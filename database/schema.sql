-- Complete Tasks for Today MySQL import.
-- Import this file in phpMyAdmin to create the database, tables, and demo rows.
-- CAUTION: Re-importing deletes existing tasks and users in tasks_for_today.
-- The session uses Singapore time so CURDATE() agrees with the app's default day.
SET NAMES utf8mb4;
SET time_zone = '+08:00';

CREATE DATABASE IF NOT EXISTS `tasks_for_today`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE `tasks_for_today`;

DROP TABLE IF EXISTS `tasks`;
DROP TABLE IF EXISTS `users`;

CREATE TABLE `tasks` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(150) NOT NULL,
    `status` VARCHAR(20) NOT NULL DEFAULT 'pending',
    `task_date` DATE NOT NULL,
    `created_at` DATETIME NOT NULL,
    `is_archived` TINYINT(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `full_name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `created_at` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `username`, `full_name`, `email`, `password`, `created_at`)
VALUES
    (1, 'admin_reign', 'Adrien Russel Tan', 'admin_reign@example.com', '$2y$12$CljDW9BYegKST4n4gSe5sulMwYVVWl5zmyTVRI9cG0ZWr5Iq6V532', NOW());

-- Dates are evaluated when the file is imported: 4 tasks are due today.
INSERT INTO `tasks` (`id`, `title`, `status`, `task_date`, `created_at`)
VALUES
    (1, 'Organize project assets',      'completed',   DATE_SUB(CURDATE(), INTERVAL 2 DAY), DATE_SUB(NOW(), INTERVAL 3 DAY)),
    (2, 'Prepare weekly sprint notes',  'completed',   DATE_SUB(CURDATE(), INTERVAL 1 DAY), DATE_SUB(NOW(), INTERVAL 2 DAY)),
    (3, 'Review client feedback',       'completed',   DATE_SUB(CURDATE(), INTERVAL 1 DAY), DATE_SUB(NOW(), INTERVAL 2 DAY)),
    (4, 'Check team inbox',             'completed',   CURDATE(),                           DATE_SUB(NOW(), INTERVAL 20 MINUTE)),
    (5, 'Finalize landing page copy',   'in_progress', CURDATE(),                           DATE_SUB(NOW(), INTERVAL 19 MINUTE)),
    (6, 'Review open pull requests',    'pending',     CURDATE(),                           DATE_SUB(NOW(), INTERVAL 18 MINUTE)),
    (7, 'Send daily status update',     'pending',     CURDATE(),                           DATE_SUB(NOW(), INTERVAL 17 MINUTE)),
    (8, 'Plan next sprint',             'pending',     DATE_ADD(CURDATE(), INTERVAL 1 DAY), DATE_SUB(NOW(), INTERVAL 16 MINUTE)),
    (9, 'Prepare stakeholder check-in', 'pending',     DATE_ADD(CURDATE(), INTERVAL 1 DAY), DATE_SUB(NOW(), INTERVAL 15 MINUTE));
