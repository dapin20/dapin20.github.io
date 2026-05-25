<?php
// Fungsi untuk mengecek apakah user sudah login
function checkLogin($required_role = null) {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header("Location: ../auth/login.php");
        exit;
    }
    
    if ($required_role && $_SESSION['user_type'] !== $required_role) {
        header("Location: ../auth/login.php");
        exit;
    }
}

// Fungsi untuk logout
function logoutUser() {
    session_start();
    session_destroy();
    header("Location: ../auth/login.php");
    exit;
}

// Fungsi untuk mendapatkan info user dari session
function getUserInfo() {
    return [
        'id' => $_SESSION['user_id'] ?? null,
        'username' => $_SESSION['username'] ?? null,
        'email' => $_SESSION['email'] ?? null,
        'user_type' => $_SESSION['user_type'] ?? null
    ];
}
?>
