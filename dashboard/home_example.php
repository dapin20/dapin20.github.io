<?php
/**
 * CONTOH INTEGRASI: Dashboard Home User
 * 
 * Salin kode di bawah ke file dashboard/home.php Anda
 */

// TAMBAHKAN INI DI BARIS PALING ATAS SEBELUM HTML/OUTPUT APAPUN
session_start();
require_once('../config/koneksi.php');
require_once('../config/auth_helper.php');

// Cek apakah user sudah login sebagai user (bukan admin)
checkLogin('user');

// Dapatkan info user yang login
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];

// CONTOH: Ambil data dari database
// $query = "SELECT * FROM users WHERE id = ?";
// $stmt = $conn->prepare($query);
// $stmt->bind_param("i", $user_id);
// $stmt->execute();
// $result = $stmt->get_result();
// $user_data = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard User - WisataKu</title>
</head>
<body>
    <h1>Selamat datang, <?php echo htmlspecialchars($username); ?></h1>
    <p>Email: <?php echo htmlspecialchars($email); ?></p>
    
    <!-- Tombol Logout -->
    <a href="../auth/logout.php">Logout</a>
    
    <!-- Konten dashboard Anda di sini -->
    
</body>
</html>
