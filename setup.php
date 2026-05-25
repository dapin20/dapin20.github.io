<?php
// File untuk setup database - jalankan ini satu kali untuk membuat database
// Buka di browser: http://localhost/PJBL/setup.php

require_once('config/koneksi.php');

$sql_commands = array(
    // Membuat Database
    "CREATE DATABASE IF NOT EXISTS wisata_ku",
    
    // Menggunakan Database
    "USE wisata_ku",
    
    // Tabel Users (untuk pengguna biasa)
    "CREATE TABLE IF NOT EXISTS users (
        id INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50) UNIQUE NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        no_telpon VARCHAR(15),
        alamat TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )",
    
    // Tabel Admins (untuk admin)
    "CREATE TABLE IF NOT EXISTS admins (
        id INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50) UNIQUE NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        role VARCHAR(50) DEFAULT 'admin',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )",
);

$mysqli = new mysqli("localhost", "root", "");

if ($mysqli->connect_error) {
    die("Koneksi ke MySQL gagal: " . $mysqli->connect_error);
}

foreach ($sql_commands as $sql) {
    if ($mysqli->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $mysqli->error . "<br>";
    }
}

// Insert admin default
$admin_password = password_hash("admin123", PASSWORD_BCRYPT);
$insert_admin = "INSERT IGNORE INTO admins (username, email, password, role) 
                 VALUES ('admin', 'admin@wisataku.com', '$admin_password', 'admin')";

if ($mysqli->query($insert_admin) === FALSE) {
    echo "Error: " . $mysqli->error;
} else {
    echo "<h2>✓ Database berhasil dibuat!</h2>";
    echo "<p>Silahkan hapus file setup.php setelah selesai.</p>";
    echo "<p><strong>Akun Admin Default:</strong></p>";
    echo "<ul>";
    echo "<li>Username: <code>admin</code></li>";
    echo "<li>Password: <code>admin123</code></li>";
    echo "</ul>";
}

$mysqli->close();
?>
