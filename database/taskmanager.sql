-- ============================================================
-- TaskManager — Database Schema
-- Database: ci3_task_manager
-- ============================================================

CREATE DATABASE IF NOT EXISTS `ci3_task_manager`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE `ci3_task_manager`;

-- ------------------------------------------------------------
-- Table: users
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
    `id`          INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    `name`        VARCHAR(100)    NOT NULL,
    `email`       VARCHAR(191)    NOT NULL,
    `password`    VARCHAR(255)    NOT NULL COMMENT 'bcrypt hash',
    `role`        ENUM('admin','member') NOT NULL DEFAULT 'member',
    `is_active`   TINYINT(1)      NOT NULL DEFAULT 1,
    `last_login`  DATETIME            NULL DEFAULT NULL,
    `created_at`  DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`  DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_users_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ------------------------------------------------------------
-- Seed: default admin user
-- Password: Admin@1234  (bcrypt, cost 12)
-- CHANGE THIS PASSWORD after first login!
-- ------------------------------------------------------------
INSERT INTO `users` (`name`, `email`, `password`, `role`) VALUES
(
    'Admin',
    'admin@taskmanager.com',
    '$2y$12$/zLD4WGztySh3qZTviUjYugFeWtQy5N19jkD3Ntjf4Gk7g5.EKn4O',
    'admin'
);
