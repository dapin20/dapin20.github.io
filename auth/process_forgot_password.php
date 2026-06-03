<?php
session_start();
require_once('../config/koneksi.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: forgot_password.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';
$errors = [];

if ($username === '') {
    $errors[] = 'Username tidak boleh kosong';
}

if ($email === '') {
    $errors[] = 'Email tidak boleh kosong';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Format email tidak valid';
}

if ($password === '') {
    $errors[] = 'Password baru tidak boleh kosong';
} elseif (strlen($password) < 6) {
    $errors[] = 'Password minimal 6 karakter';
}

if ($password !== $confirmPassword) {
    $errors[] = 'Konfirmasi password tidak cocok';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: forgot_password.php');
    exit;
}

$stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND email = ?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$user) {
    $_SESSION['errors'] = ['Username dan email tidak cocok dengan akun user.'];
    header('Location: forgot_password.php');
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
$stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
$stmt->bind_param("si", $hashedPassword, $user['id']);

if ($stmt->execute()) {
    $_SESSION['success'] = 'Password berhasil direset. Silahkan login dengan password baru.';
    $stmt->close();
    header('Location: login.php');
    exit;
}

$stmt->close();
$_SESSION['errors'] = ['Password gagal direset. Coba lagi.'];
header('Location: forgot_password.php');
exit;
?>
