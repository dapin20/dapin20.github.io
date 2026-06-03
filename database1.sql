-- ==========================================================
-- DATABASE: wisata_ku
-- Bagian fitur: destinasi, wishlist, orders, pembayaran, promo
-- Catatan: login users/admins/sessions ada di database.sql
-- ==========================================================

CREATE DATABASE IF NOT EXISTS wisata_ku
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;
USE wisata_ku;

CREATE TABLE IF NOT EXISTS destinations (
    id VARCHAR(50) PRIMARY KEY,
    admin_id INT DEFAULT NULL,
    name VARCHAR(150) NOT NULL,
    location VARCHAR(120) NOT NULL,
    price INT NOT NULL DEFAULT 0,
    rating DECIMAL(3,1) NOT NULL DEFAULT 0.0,
    image VARCHAR(255) NOT NULL,
    href VARCHAR(255) NOT NULL,
    category ENUM('wisata_alam', 'wisata_buatan', 'wisata_edukasi') NOT NULL DEFAULT 'wisata_alam',
    popular TINYINT(1) NOT NULL DEFAULT 0,
    near TINYINT(1) NOT NULL DEFAULT 0,
    recommended TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_destinations_admin (admin_id),
    INDEX idx_destinations_category (category),
    INDEX idx_destinations_flags (popular, near, recommended)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS wishlist (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    destination_id VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY uniq_wishlist_user_destination (user_id, destination_id),
    INDEX idx_wishlist_user (user_id),
    CONSTRAINT fk_wishlist_user
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_wishlist_destination
        FOREIGN KEY (destination_id) REFERENCES destinations(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_number VARCHAR(30) UNIQUE NOT NULL,
    user_id INT NOT NULL,
    destination_id VARCHAR(50) NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    total_price INT NOT NULL DEFAULT 0,
    visit_date DATE NOT NULL,
    status ENUM('pending', 'success', 'failed', 'cancelled') NOT NULL DEFAULT 'pending',
    payment_method VARCHAR(50) DEFAULT NULL,
    payment_proof VARCHAR(255) DEFAULT NULL,
    verified_at DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_orders_user (user_id),
    INDEX idx_orders_status (status),
    CONSTRAINT fk_orders_user
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_orders_destination
        FOREIGN KEY (destination_id) REFERENCES destinations(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS payment_methods (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    type ENUM('bank_transfer', 'ewallet', 'card') NOT NULL DEFAULT 'bank_transfer',
    provider VARCHAR(80) NOT NULL,
    account_name VARCHAR(100) DEFAULT NULL,
    account_number VARCHAR(50) NOT NULL,
    is_primary TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_payment_methods_user (user_id),
    CONSTRAINT fk_payment_methods_user
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS promos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    code VARCHAR(30) UNIQUE NOT NULL,
    discount_percent INT NOT NULL,
    description TEXT DEFAULT NULL,
    expiry_date DATE DEFAULT NULL,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS order_payments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    payment_method_id INT DEFAULT NULL,
    amount INT NOT NULL DEFAULT 0,
    status ENUM('pending', 'paid', 'failed', 'refunded') NOT NULL DEFAULT 'pending',
    paid_at DATETIME DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_order_payments_order (order_id),
    CONSTRAINT fk_order_payments_order
        FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    CONSTRAINT fk_order_payments_method
        FOREIGN KEY (payment_method_id) REFERENCES payment_methods(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO destinations (id, admin_id, name, location, price, rating, image, href, category, popular, near, recommended)
VALUES
    ('bromo', NULL, 'Gunung Bromo', 'Probolinggo', 150000, 4.9, 'assets/images/Bromo.png', 'user/wisata_alam/Bromo.php', 'wisata_alam', 1, 1, 1),
    ('pantai-balekambang', NULL, 'Pantai Balekambang', 'Malang Selatan', 25000, 4.7, 'assets/images/Kondang.png', 'user/wisata_alam/PantaiNgudel.php', 'wisata_alam', 1, 1, 0),
    ('tumpak-sewu', NULL, 'Tumpak Sewu', 'Lumajang', 20000, 4.8, 'assets/images/Tumpak.png', 'user/wisata_alam/TumpakSewu.php', 'wisata_alam', 1, 1, 1),
    ('ranu-regulo', NULL, 'Ranu Regulo', 'Malang', 30000, 4.6, 'assets/images/ranu_regulo.jpg', 'user/wisata_alam/RanuRegulo.php', 'wisata_alam', 1, 1, 1),
    ('gunung-buthak', NULL, 'Gunung Buthak', 'Malang', 50000, 4.8, 'assets/images/buthak.jpg', 'user/wisata_alam/GunungButhak.php', 'wisata_alam', 1, 1, 1),
    ('ranu-kumbolo', NULL, 'Ranu Kumbolo', 'Malang', 45000, 4.9, 'assets/images/ranu_kumbolo.jpg', 'user/wisata_alam/RanuKumbolo.php', 'wisata_alam', 0, 1, 0),
    ('jatim-park-1', NULL, 'Jatim Park 1', 'Batu', 120000, 4.8, 'assets/images/Edukasi.png', 'user/wisata_buatan/JatimPark1.php', 'wisata_buatan', 0, 0, 1),
    ('eco-green-park', NULL, 'Eco Green Park', 'Batu', 90000, 4.7, 'assets/images/OverlayEdukasi.png', 'user/wisata_edukasi/EcoGreenPark.php', 'wisata_edukasi', 0, 0, 1);

INSERT IGNORE INTO promos (code, discount_percent, description, expiry_date)
VALUES
    ('WISATA10', 10, 'Diskon 10% untuk semua destinasi pilihan.', '2026-12-31'),
    ('LIBURAN20', 20, 'Diskon liburan untuk pengguna aktif.', '2026-12-31');
