<?php
session_start();
require_once('../config/auth_helper.php');
require_once('../config/koneksi.php');
require_once('../config/order_helper.php');

checkLogin('user');
ensure_order_payment_columns($conn);

$userId = (int) $_SESSION['user_id'];
$stmt = $conn->prepare(
    "SELECT o.*, d.name AS destination_name
     FROM orders o
     JOIN destinations d ON o.destination_id = d.id
     WHERE o.user_id = ?
     ORDER BY o.created_at DESC"
);
$stmt->bind_param("i", $userId);
$stmt->execute();
$orders = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Pesanan Saya</title>
  <script src="../assets/js/theme.js?v=3.4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../user/account-theme.css?v=3.0" />
  <link rel="stylesheet" href="pesanan.css?v=3.0" />
</head>
<body>
  <div class="profile-container">
    <aside class="sidebar">
      <div class="sidebar-header">
        <p class="sidebar-eyebrow">Akun</p>
        <h2 class="sidebar-title">Profil Pengguna</h2>
      </div>

      <nav class="sidebar-menu">
        <ul>
          <li><a href="../user/profile.php" class="menu-item"><span class="menu-icon"><img src="../assets/icon/user-circle.svg" width="24" height="24" alt="Profil"></span><span>Profil Saya</span></a></li>
          <li><a href="../orders/pesanan.php" class="menu-item active"><span class="menu-icon"><img src="../assets/icon/ticket.svg" width="24" height="24" alt="Pesanan"></span><span>Pesanan Saya</span></a></li>
          <li><a href="../orders/riwayat.php" class="menu-item"><span class="menu-icon"><img src="../assets/icon/Note.svg" width="24" height="24" alt="Riwayat"></span><span>Riwayat Transaksi</span></a></li>
          <li><a href="../orders/pembayaran.php" class="menu-item"><span class="menu-icon"><img src="../assets/icon/credit-card.svg" width="24" height="24" alt="Pembayaran"></span><span>Metode Pembayaran</span></a></li>
          <li><a href="../wishlist/whistlist.php" class="menu-item"><span class="menu-icon"><img src="../assets/icon/save.svg" width="24" height="24" alt="Favorite"></span><span>Favorite Saya</span></a></li>
          <li><a href="../help/bantuan.php" class="menu-item"><span class="menu-icon"><img src="../assets/icon/question.svg" width="24" height="24" alt="Bantuan"></span><span>Bantuan & Dukungan</span></a></li>
        </ul>
      </nav>

      <button class="btn-logout" onclick="window.location.href='../auth/logout.php'"><span>Keluar</span></button>
    </aside>

    <main class="profile-content">
      <div class="profile-header">
        <a href="../dashboard/home.php" class="btn-back">Kembali ke Beranda</a>
        <p class="profile-subtitle">Pantau status tiket, bukti pembayaran, dan hasil verifikasi admin.</p>
      </div>

      <div class="page-hero">
        <h1 class="page-hero-title">Pesanan Saya</h1>
        <p class="page-hero-subtitle">Pesanan yang sudah dibayar akan menjadi nota setelah diterima admin.</p>
      </div>

      <section class="section-shell pesanan-section">
        <h2 class="section-title">Daftar Pesanan</h2>
        <div class="pesanan-list">
          <?php if ($orders->num_rows === 0): ?>
            <div class="pesanan-empty">Belum ada pesanan. Pilih destinasi wisata lalu klik Pesan Sekarang.</div>
          <?php endif; ?>

          <?php while ($order = $orders->fetch_assoc()): ?>
          <div class="pesanan-card">
            <div class="pesanan-card-header">
              <h3 class="pesanan-nama"><?php echo htmlspecialchars($order['destination_name']); ?></h3>
              <span class="status-badge <?php echo order_status_class($order['status']); ?>">
                <?php echo order_status_label($order['status'], $order['payment_proof']); ?>
              </span>
            </div>
            <div class="pesanan-card-body">
              <div class="pesanan-detail">
                <span class="detail-label">Nomor Pesanan</span>
                <span class="detail-value"><?php echo htmlspecialchars($order['order_number']); ?></span>
              </div>
              <div class="pesanan-detail">
                <span class="detail-label">Tanggal Kunjungan</span>
                <span class="detail-value"><?php echo date('d F Y', strtotime($order['visit_date'])); ?></span>
              </div>
              <div class="pesanan-detail">
                <span class="detail-label">Jumlah Tiket</span>
                <span class="detail-value"><?php echo (int) $order['quantity']; ?> tiket</span>
              </div>
              <div class="pesanan-detail">
                <span class="detail-label">Total Harga</span>
                <span class="detail-value-price"><?php echo order_price_label($order['total_price']); ?></span>
              </div>
            </div>
            <div class="pesanan-card-footer">
              <?php if ($order['status'] === 'success'): ?>
                <button class="btn-action btn-detail" onclick="location.href='detail.php?id=<?php echo urlencode($order['order_number']); ?>'">Lihat Nota</button>
              <?php else: ?>
                <button class="btn-action btn-pay" onclick="location.href='pembayaran.php?order=<?php echo urlencode($order['order_number']); ?>'">Upload Bukti</button>
                <button class="btn-action btn-detail" onclick="location.href='detail.php?id=<?php echo urlencode($order['order_number']); ?>'">Lihat Detail</button>
              <?php endif; ?>
            </div>
          </div>
          <?php endwhile; ?>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
<?php $stmt->close(); ?>
