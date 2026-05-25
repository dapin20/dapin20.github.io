<?php
/**
 * CONTOH INTEGRASI: Dashboard Admin
 * 
 * Salin kode di bawah ke file user/DashborAdmin.php Anda
 */

// TAMBAHKAN INI DI BARIS PALING ATAS SEBELUM HTML/OUTPUT APAPUN
session_start();
require_once('../config/koneksi.php');
require_once('../config/auth_helper.php');

// Cek apakah user sudah login sebagai ADMIN
checkLogin('admin');

// Dapatkan info admin yang login
$admin_id = $_SESSION['user_id'];
$admin_username = $_SESSION['username'];
$admin_email = $_SESSION['email'];

// CONTOH: Ambil data dari database
// $query = "SELECT * FROM admins WHERE id = ?";
// $stmt = $conn->prepare($query);
// $stmt->bind_param("i", $admin_id);
// $stmt->execute();
// $result = $stmt->get_result();
// $admin_data = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin - WisataKu</title>
</head>
<body>
    <h1>Dashboard Admin</h1>
    <p>Selamat datang, <?php echo htmlspecialchars($admin_username); ?></p>
    <p>Email: <?php echo htmlspecialchars($admin_email); ?></p>
    
    <!-- Tombol Logout -->
    <a href="../auth/logout.php">Logout</a>
    
    <!-- Konten admin dashboard di sini -->
    
</body>
</html>
