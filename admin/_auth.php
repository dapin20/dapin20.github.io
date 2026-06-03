<?php
session_start();

require_once('../config/auth_helper.php');
require_once('../config/destination_helper.php');

checkLogin('admin');

$adminRole = $_SESSION['admin_role'] ?? 'ticket_admin';
$adminId = (int) ($_SESSION['user_id'] ?? 0);
$isSuperAdmin = $adminRole === 'super_admin';

function require_super_admin() {
    checkAdminRole('super_admin');
}

function admin_role_label($role) {
    return $role === 'super_admin' ? 'Super Admin' : 'Admin Tiket';
}

function render_admin_sidebar($active = '', $copy = '') {
    global $adminRole, $isSuperAdmin;

    $copy = $copy ?: admin_role_label($adminRole);
    $items = [
        ['key' => 'dashboard', 'href' => 'dashboard.php', 'label' => 'Dashboard', 'show' => $isSuperAdmin],
        ['key' => 'destinations', 'href' => 'destinations.php', 'label' => 'Kelola Wisata', 'show' => true],
        ['key' => 'tickets', 'href' => 'tickets.php', 'label' => 'Kelola Tiket', 'show' => true],
        ['key' => 'profile', 'href' => 'profile.php', 'label' => 'Profil', 'show' => true],
        ['key' => 'user_home', 'href' => '../dashboard/home.php', 'label' => 'Lihat Home User', 'show' => true],
    ];
    ?>
    <aside class="admin-sidebar">
        <div class="admin-brand">
            <div class="admin-brand-badge">WK</div>
            <div>
                <h2 class="admin-brand-title">Admin WisataKu</h2>
                <p class="admin-brand-copy"><?php echo htmlspecialchars($copy); ?></p>
            </div>
        </div>

        <nav class="admin-nav">
            <?php foreach ($items as $item): ?>
                <?php if ($item['show']): ?>
                    <a href="<?php echo $item['href']; ?>" class="<?php echo $active === $item['key'] ? 'active' : ''; ?>">
                        <?php echo $item['label']; ?>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </nav>

        <div class="admin-sidebar-footer">
            <a href="../auth/logout.php" class="admin-btn danger">Logout</a>
        </div>
    </aside>
    <?php
}
