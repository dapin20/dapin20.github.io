<?php
require_once('./_auth.php');
require_once('../config/koneksi.php');

$destinations = destination_filter_by_admin(load_destinations(), $adminRole, $adminId);
$ticketAdminNames = [];
$ticketAdminResult = $conn->query("SELECT id, username FROM admins WHERE role = 'ticket_admin'");
if ($ticketAdminResult) {
    while ($ticketAdmin = $ticketAdminResult->fetch_assoc()) {
        $ticketAdminNames[(int) $ticketAdmin['id']] = $ticketAdmin['username'];
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <script src="../assets/js/theme.js?v=3.4"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin WisataKu - Kelola Wisata</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin.css?v=1.0">
</head>
<body>
    <div class="admin-shell">
        <?php render_admin_sidebar('destinations', admin_role_label($adminRole) . ' - kelola data wisata.'); ?>

        <main class="admin-content">
            <div class="admin-topbar">
                <div>
                    <p class="admin-eyebrow">Data destinasi</p>
                    <h1>Kelola Wisata</h1>
                    <p><?php echo $isSuperAdmin ? 'Pantau semua wisata yang dikelola oleh seluruh loket.' : 'Tambah wisata, edit harga tiket, perbarui gambar, dan atur tampilan wisata milik loket Anda.'; ?></p>
                </div>
                <a href="destination_form.php" class="admin-btn">Tambah Wisata Baru</a>
            </div>

            <section class="admin-panel">
                <?php if (empty($destinations)): ?>
                <div class="admin-empty">
                    Belum ada data destinasi.
                </div>
                <?php else: ?>
                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Destinasi</th>
                                <th>Kategori</th>
                                <?php if ($isSuperAdmin): ?><th>Admin Tiket</th><?php endif; ?>
                                <th>Harga</th>
                                <th>Rating</th>
                                <th>Tampil di Home</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($destinations as $destination): ?>
                            <tr>
                                <td>
                                    <div class="admin-destination">
                                        <img src="../<?php echo htmlspecialchars($destination['image']); ?>" alt="<?php echo htmlspecialchars($destination['name']); ?>">
                                        <div>
                                            <strong><?php echo htmlspecialchars($destination['name']); ?></strong><br>
                                            <span><?php echo htmlspecialchars($destination['location']); ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="admin-chip"><?php echo htmlspecialchars(str_replace('_', ' ', $destination['category'])); ?></span></td>
                                <?php if ($isSuperAdmin): ?>
                                <td>
                                    <?php
                                    $ownerId = (int) ($destination['owner_admin_id'] ?? 0);
                                    echo htmlspecialchars($ticketAdminNames[$ownerId] ?? 'Belum ditetapkan');
                                    ?>
                                </td>
                                <?php endif; ?>
                                <td><?php echo htmlspecialchars(destination_price_label($destination['price'])); ?></td>
                                <td>&#9733; <?php echo htmlspecialchars(number_format($destination['rating'], 1)); ?></td>
                                <td>
                                    <div class="admin-flags">
                                        <?php if ($destination['popular']): ?><span class="admin-flag">Populer</span><?php endif; ?>
                                        <?php if ($destination['near']): ?><span class="admin-flag">Dekat Anda</span><?php endif; ?>
                                        <?php if ($destination['recommended']): ?><span class="admin-flag">Rekomendasi</span><?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="admin-actions">
                                        <a href="destination_form.php?id=<?php echo urlencode($destination['id']); ?>" class="admin-btn secondary">Edit</a>
                                        <form action="delete_destination.php" method="POST" onsubmit="return confirm('Hapus wisata ini?');">
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($destination['id']); ?>">
                                            <button type="submit" class="admin-btn danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </section>
        </main>
    </div>
</body>
</html>
