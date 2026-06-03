<?php
// Fungsi untuk mengecek apakah user sudah login
function checkLogin($required_role = null) {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        $redirect = '../auth/login.php';
        header("Location: " . $redirect);
        exit;
    }
    
    if ($required_role && $_SESSION['user_type'] !== $required_role) {
        $redirect = '../auth/login.php';
        header("Location: " . $redirect);
        exit;
    }
}

function checkAdminRole($allowed_roles) {
    $roles = is_array($allowed_roles) ? $allowed_roles : [$allowed_roles];
    checkLogin('admin');

    $adminRole = $_SESSION['admin_role'] ?? 'ticket_admin';
    if (!in_array($adminRole, $roles, true)) {
        header('Location: ../admin/tickets.php');
        exit;
    }
}

// Fungsi untuk logout
function logoutUser() {
    session_start();
    $redirect = '../auth/login.php';
    session_destroy();
    header("Location: " . $redirect);
    exit;
}

// Fungsi untuk mendapatkan info user dari session
function getUserInfo() {
    return [
        'id' => $_SESSION['user_id'] ?? null,
        'username' => $_SESSION['username'] ?? null,
        'email' => $_SESSION['email'] ?? null,
        'user_type' => $_SESSION['user_type'] ?? null,
        'admin_role' => $_SESSION['admin_role'] ?? null,
        'avatar' => $_SESSION['avatar'] ?? null,
    ];
}
?>
