<?php

function getProfileAvatarSrc(mysqli $conn, string $relativePrefix = ''): string
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $defaultAvatar = $relativePrefix . 'assets/images/dapin kecil.jpg';
    $userId = $_SESSION['user_id'] ?? null;
    $userType = $_SESSION['user_type'] ?? 'user';

    if (!$userId) {
        return $defaultAvatar;
    }

    $table = ($userType === 'admin') ? 'admins' : 'users';
    $colCheck = $conn->query("SHOW COLUMNS FROM $table LIKE 'avatar'");

    if (!$colCheck || $colCheck->num_rows === 0) {
        return $defaultAvatar;
    }

    $stmt = $conn->prepare("SELECT avatar FROM $table WHERE id = ? LIMIT 1");
    if (!$stmt) {
        return $defaultAvatar;
    }

    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (empty($row['avatar'])) {
        return $defaultAvatar;
    }

    $_SESSION['avatar'] = $row['avatar'];

    if (preg_match('/^https?:\/\//', $row['avatar'])) {
        return $row['avatar'];
    }

    return $relativePrefix . ltrim($row['avatar'], '/');
}
