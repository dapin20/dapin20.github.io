<?php
session_start();
require_once('../config/koneksi.php');

$redirect = 'login.php';

if (!empty($_SESSION['session_token'])) {
    $sessionsTable = $conn->query("SHOW TABLES LIKE 'sessions'");
    if ($sessionsTable && $sessionsTable->num_rows > 0) {
        $stmt = $conn->prepare("DELETE FROM sessions WHERE session_token = ?");
        if ($stmt) {
            $stmt->bind_param("s", $_SESSION['session_token']);
            $stmt->execute();
            $stmt->close();
        }
    }
}

session_destroy();
header("Location: " . $redirect);
exit;
?>
