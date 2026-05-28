<?php
require_once('./_auth.php');

$destinations = load_destinations();
$popular = destination_filter($destinations, 'popular');
$near = destination_filter($destinations, 'near');
$recommended = destination_filter($destinations, 'recommended');
$user = getUserInfo();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin WisataKu - Home</title>
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
                <a href="home.php" class="active">Home Admin</a>
                <a href="dashboard.php">Dashboard</a>
                <a href="destinations.php">Kelola Wisata</a>
                <a href="../dashboard/home.php">Lihat Home User</a>
            </nav>

            <div class="admin-sidebar-footer">
                <a href="../auth/logout.php" class="admin-btn danger">Logout</a>
            </div>
        </aside>

        <main class="admin-content">
            <div class="admin-topbar">
                <div>
                    <p class="admin-eyebrow">Selamat datang</p>
                    <h1>Home Admin</h1>
                    <p>Masuk sebagai <strong><?php echo htmlspecialchars($user['username'] ?? 'admin'); ?></strong>. Tambah wisata baru, edit harga, dan atur kartu yang tampil di halaman user dari panel ini.</p>
                </div>
                <a href="destinations.php" class="admin-btn">Tambah atau Edit Wisata</a>
            </div>

            <section class="admin-stats">
                <article class="admin-stat">
                    <span>Total wisata</span>
                    <strong><?php echo count($destinations); ?></strong>
                </article>
                <article class="admin-stat">
                    <span>Tampil di populer</span>
                    <strong><?php echo count($popular); ?></strong>
                </article>
                <article class="admin-stat">
                    <span>Tampil di dekat Anda</span>
                    <strong><?php echo count($near); ?></strong>
                </article>
                <article class="admin-stat">
                    <span>Tampil di rekomendasi</span>
                    <strong><?php echo count($recommended); ?></strong>
                </article>
            </section>

            <div class="admin-grid">
                <section class="admin-panel">
                    <h2 class="admin-section-title">Wisata Terbaru di Data</h2>
                    <div class="admin-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Destinasi</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (array_slice(array_reverse($destinations), 0, 5) as $destination): ?>
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
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="admin-panel">
                    <h2 class="admin-section-title">Aksi Cepat</h2>
                    <div class="admin-actions">
                        <a href="destination_form.php" class="admin-btn">Tambah Wisata Baru</a>
                        <a href="destinations.php" class="admin-btn secondary">Atur Harga</a>
                        <a href="../wishlist/whistlist.php" class="admin-btn secondary">Cek Favorite User</a>
                    </div>
                </section>
            </div>
        </main>
    </div>
</body>
</html>
