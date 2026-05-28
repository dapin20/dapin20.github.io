<?php
require_once('./_auth.php');

$destinations = load_destinations();
$totalPrice = array_reduce($destinations, function ($carry, $destination) {
    return $carry + (int) $destination['price'];
}, 0);
$averagePrice = count($destinations) > 0 ? round($totalPrice / count($destinations)) : 0;
$highestPrice = count($destinations) > 0 ? max(array_column($destinations, 'price')) : 0;
$highestRating = count($destinations) > 0 ? max(array_column($destinations, 'rating')) : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin WisataKu - Dashboard</title>
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
                <a href="dashboard.php" class="active">Dashboard</a>
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
                    <p class="admin-eyebrow">Ringkasan</p>
                    <h1>Dashboard Admin</h1>
                    <p>Ringkasan cepat untuk memantau data destinasi yang tampil di website user.</p>
                </div>
                <a href="destination_form.php" class="admin-btn">Tambah Wisata</a>
            </div>

            <section class="admin-stats">
                <article class="admin-stat">
                    <span>Total destinasi</span>
                    <strong><?php echo count($destinations); ?></strong>
                </article>
                <article class="admin-stat">
                    <span>Harga rata-rata</span>
                    <strong><?php echo htmlspecialchars(destination_price_label($averagePrice)); ?></strong>
                </article>
                <article class="admin-stat">
                    <span>Harga tertinggi</span>
                    <strong><?php echo htmlspecialchars(destination_price_label($highestPrice)); ?></strong>
                </article>
                <article class="admin-stat">
                    <span>Rating tertinggi</span>
                    <strong><?php echo htmlspecialchars(number_format($highestRating, 1)); ?></strong>
                </article>
            </section>

            <section class="admin-panel">
                <h2 class="admin-section-title">Distribusi Kartu Home</h2>
                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Destinasi</th>
                                <th>Populer</th>
                                <th>Dekat Anda</th>
                                <th>Rekomendasi</th>
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
                                <td><?php echo $destination['popular'] ? '<span class="admin-chip">Aktif</span>' : '-'; ?></td>
                                <td><?php echo $destination['near'] ? '<span class="admin-chip">Aktif</span>' : '-'; ?></td>
                                <td><?php echo $destination['recommended'] ? '<span class="admin-chip">Aktif</span>' : '-'; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
