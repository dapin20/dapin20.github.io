<?php
require_once('./_auth.php');

$destinations = load_destinations();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin WisataKu - Kelola Wisata</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin.css?v=1.0">
</head>
<body>
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <div class="admin-brand">
                <div class="admin-brand-badge">WK</div>
                <div>
                    <h2 class="admin-brand-title">Admin WisataKu</h2>
                    <p class="admin-brand-copy">Panel pengelolaan destinasi dan harga.</p>
                </div>
            </div>

            <nav class="admin-nav">
                <a href="home.php">Home Admin</a>
                <a href="dashboard.php">Dashboard</a>
                <a href="destinations.php" class="active">Kelola Wisata</a>
                <a href="../dashboard/home.php">Lihat Home User</a>
            </nav>

            <div class="admin-sidebar-footer">
                <a href="../auth/logout.php" class="admin-btn danger">Logout</a>
            </div>
        </aside>

        <main class="admin-content">
            <div class="admin-topbar">
                <div>
                    <p class="admin-eyebrow">Data destinasi</p>
                    <h1>Kelola Wisata</h1>
                    <p>Tambah wisata baru, edit harga, perbarui gambar, dan atur apakah kartu muncul di section populer, dekat Anda, atau rekomendasi.</p>
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
                                <td><?php echo htmlspecialchars(destination_price_label($destination['price'])); ?></td>
                                <td>★ <?php echo htmlspecialchars(number_format($destination['rating'], 1)); ?></td>
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
