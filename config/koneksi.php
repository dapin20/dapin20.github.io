<?php
// Konfigurasi Database
$servername = "localhost";
$username = "root";
$password = "";
$database = "wisata_ku";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Set charset ke utf8
$conn->set_charset("utf8");

?>
