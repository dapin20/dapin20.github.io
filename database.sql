-- ==========================================================
-- DATABASE: wisata_ku
-- Bagian autentikasi: login user, login admin, dan session
-- ==========================================================

CREATE DATABASE IF NOT EXISTS wisata_ku
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;
USE wisata_ku;

CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    no_telpon VARCHAR(20) DEFAULT NULL,
    alamat TEXT DEFAULT NULL,
    avatar VARCHAR(255) DEFAULT 'assets/images/dapin kecil.jpg',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS admins (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('super_admin', 'ticket_admin') NOT NULL DEFAULT 'ticket_admin',
    avatar VARCHAR(255) DEFAULT 'assets/images/dapin kecil.jpg',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS sessions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    user_type ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    session_token VARCHAR(255) UNIQUE NOT NULL,
    login_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    ip_address VARCHAR(50) DEFAULT NULL,
    user_agent VARCHAR(255) DEFAULT NULL,
    INDEX idx_sessions_user (user_id, user_type),
    INDEX idx_sessions_token (session_token)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO admins (username, email, password, role)
VALUES
    ('superadmin', 'superadmin@wisataku.com', '$2y$10$ttK.CRRqNTOUx3LAEE5Cc.18DklGy/Wniq2W4GqoJ6jaBuEEytOEu', 'super_admin'),
    ('admin_tiket', 'admintiket@wisataku.com', '$2y$10$auxS3MSdqe6qqLV58hfumOChQyfQUmJAbO7VhWl8ILynEjcDHqHXy', 'ticket_admin');
