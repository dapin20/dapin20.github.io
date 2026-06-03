<?php
session_start();
require_once('../config/koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $user_type = 'user';
    
    $errors = [];
    
    if (empty($username)) {
        $errors[] = "Username tidak boleh kosong";
    }
    
    if (empty($password)) {
        $errors[] = "Password tidak boleh kosong";
    }
    
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: login.php");
        exit;
    }
    
    $stmt = $conn->prepare("SELECT id, username, email, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows !== 1) {
        $stmt->close();
        $stmt = $conn->prepare("SELECT id, username, email, password, role FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user_type = 'admin';
    }
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $session_token = session_id();

            // Set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['user_type'] = $user_type;
            $_SESSION['admin_role'] = $user_type === 'admin' ? ($user['role'] ?? 'ticket_admin') : null;
            $_SESSION['logged_in'] = true;
            $_SESSION['avatar'] = $user['avatar'] ?? null;
            $_SESSION['session_token'] = $session_token;

            $sessionsTable = $conn->query("SHOW TABLES LIKE 'sessions'");
            if ($user_type === 'user' && $sessionsTable && $sessionsTable->num_rows > 0) {
                $ip_address = $_SERVER['REMOTE_ADDR'] ?? null;
                $user_agent = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255);

                // Check whether sessions table has user_agent column
                $hasUserAgent = false;
                $columnCheck = $conn->query("SHOW COLUMNS FROM sessions LIKE 'user_agent'");
                if ($columnCheck && $columnCheck->num_rows > 0) {
                    $hasUserAgent = true;
                }

                if ($hasUserAgent) {
                    $sessionStmt = $conn->prepare(
                        "INSERT INTO sessions (user_id, user_type, session_token, ip_address, user_agent)
                         VALUES (?, ?, ?, ?, ?)
                         ON DUPLICATE KEY UPDATE
                            user_id = VALUES(user_id),
                            user_type = VALUES(user_type),
                            last_activity = CURRENT_TIMESTAMP,
                            ip_address = VALUES(ip_address),
                            user_agent = VALUES(user_agent)"
                    );
                    if ($sessionStmt) {
                        $sessionStmt->bind_param("issss", $user['id'], $user_type, $session_token, $ip_address, $user_agent);
                        $sessionStmt->execute();
                        $sessionStmt->close();
                    }
                } else {
                    $sessionStmt = $conn->prepare(
                        "INSERT INTO sessions (user_id, user_type, session_token, ip_address)
                         VALUES (?, ?, ?, ?)
                         ON DUPLICATE KEY UPDATE
                            user_id = VALUES(user_id),
                            user_type = VALUES(user_type),
                            last_activity = CURRENT_TIMESTAMP,
                            ip_address = VALUES(ip_address)"
                    );
                    if ($sessionStmt) {
                        $sessionStmt->bind_param("isss", $user['id'], $user_type, $session_token, $ip_address);
                        $sessionStmt->execute();
                        $sessionStmt->close();
                    }
                }
            }
            
            // Redirect berdasarkan tipe user
            if ($user_type === 'admin') {
                if (($_SESSION['admin_role'] ?? '') === 'super_admin') {
                    header("Location: ../admin/dashboard.php");
                } else {
                    header("Location: ../admin/tickets.php");
                }
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
    
    header("Location: login.php");
    exit;
}

$conn->close();
?>
