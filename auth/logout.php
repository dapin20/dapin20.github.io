<?php
session_start();
$redirect = (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'admin')
    ? '../admin/index.php'
    : 'login.php';
session_destroy();
header("Location: " . $redirect);
exit;
?>
