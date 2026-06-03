<?php
require_once('./_auth.php');
require_once('../config/koneksi.php');

$userId = (int) ($_SESSION['user_id'] ?? 0);
$user = getUserInfo();

if ($userId > 0) {
    $stmt = $conn->prepare("SELECT username, email, role, created_at FROM admins WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $dbUser = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if ($dbUser) {
        $user = array_merge($user, $dbUser);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <script src="../assets/js/theme.js?v=3.4"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin WisataKu - Profil</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="admin-shell">
        <?php render_admin_sidebar('profile', admin_role_label($adminRole)); ?>

        <main class="admin-content">
            <header class="admin-topbar">
                <div>
                    <p class="admin-eyebrow">Akun</p>
                    <h1>Profil Admin</h1>
                </div>
            </header>

            <section class="admin-panel admin-profile-card">
                <div class="admin-profile-avatar">
                    <?php echo strtoupper(substr($user['username'] ?? 'A', 0, 1)); ?>
                </div>

                <div class="admin-profile-info">
                    <div class="admin-profile-item">
                        <span class="admin-profile-label">Username</span>
                        <span class="admin-profile-value"><?php echo htmlspecialchars($user['username'] ?? '-'); ?></span>
                    </div>
                    <div class="admin-profile-item">
                        <span class="admin-profile-label">Email</span>
                        <span class="admin-profile-value"><?php echo htmlspecialchars($user['email'] ?? '-'); ?></span>
                    </div>
                    <div class="admin-profile-item">
                        <span class="admin-profile-label">Role</span>
                        <span class="admin-profile-value"><?php echo htmlspecialchars(admin_role_label($user['role'] ?? $adminRole)); ?></span>
                    </div>
                    <div class="admin-profile-item">
                        <span class="admin-profile-label">Bergabung</span>
                        <span class="admin-profile-value"><?php echo !empty($user['created_at']) ? date('d F Y', strtotime($user['created_at'])) : '-'; ?></span>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
