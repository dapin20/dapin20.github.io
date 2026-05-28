<?php
session_start();
require_once('../config/koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $user_type = $_POST['user_type'] ?? 'user'; // 'user' atau 'admin'
    
    $errors = [];
    
    if (empty($username)) {
        $errors[] = "Username tidak boleh kosong";
    }
    
    if (empty($password)) {
        $errors[] = "Password tidak boleh kosong";
    }
    
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        if ($user_type === 'admin') {
            header("Location: ../admin/index.php");
        } else {
            header("Location: login.php");
        }
        exit;
    }
    
    // Cek login berdasarkan tipe user
    if ($user_type === 'admin') {
        $stmt = $conn->prepare("SELECT id, username, email, password FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $table = 'admins';
    } else {
        $stmt = $conn->prepare("SELECT id, username, email, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $table = 'users';
    }
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_type'] = $user_type;
            $_SESSION['logged_in'] = true;
            
            // Redirect berdasarkan tipe user
            if ($user_type === 'admin') {
                header("Location: ../admin/home.php");
            } else {
                header("Location: ../dashboard/home.php");
            }
            exit;
        } else {
            $_SESSION['errors'] = ["Username atau password salah"];
        }
    } else {
        $_SESSION['errors'] = ["Username atau password salah"];
    }
    
    $stmt->close();
    
    // Redirect kembali ke halaman login
    if ($user_type === 'admin') {
        header("Location: ../admin/index.php");
    } else {
        header("Location: login.php");
    }
    exit;
}

$conn->close();
?>
