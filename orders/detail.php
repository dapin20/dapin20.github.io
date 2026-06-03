<?php
session_start();
require_once('../config/auth_helper.php');
require_once('../config/koneksi.php');
require_once('../config/order_helper.php');

checkLogin('user');
ensure_order_payment_columns($conn);

$userId = (int) $_SESSION['user_id'];
$orderNumber = normalize_order_number($_GET['id'] ?? '');

if ($orderNumber === '') {
    header('Location: pesanan.php');
    exit;
}

$stmt = $conn->prepare(
    "SELECT o.*, d.name AS destination_name, u.username, u.email
     FROM orders o
     JOIN destinations d ON o.destination_id = d.id
     JOIN users u ON o.user_id = u.id
     WHERE o.order_number = ? AND o.user_id = ?"
);
$stmt->bind_param("si", $orderNumber, $userId);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$order) {
    header('Location: pesanan.php');
    exit;
}

$pricePerTicket = $order['quantity'] > 0 ? $order['total_price'] / $order['quantity'] : $order['total_price'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Detail Pesanan</title>
  <script src="../assets/js/theme.js?v=3.4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../user/account-theme.css?v=3.1" />
  <style>
    .detail-grid { display: grid; grid-template-columns: 1.5fr 1fr; gap: 24px; }
    .ticket-info { background: var(--panel); padding: 30px; border-radius: 20px; border: 1px solid var(--line); }
    .order-status-banner { padding: 12px 20px; border-radius: 12px; font-weight: 700; margin-bottom: 24px; display: inline-flex; align-items: center; gap: 10px; }
    .status-success { background: #e6f7ef; color: #1d8f5b; }
    .status-pending { background: var(--warning-bg); color: var(--warning-text); }
    .status-failed { background: var(--danger-bg); color: var(--danger-text); }
    .info-row { display: flex; justify-content: space-between; gap: 16px; padding: 14px 0; border-bottom: 1px dashed var(--line); }
    .info-row:last-child { border-bottom: none; }
    .info-label { color: var(--text-soft); font-weight: 500; }
    .info-value { color: var(--text-dark); font-weight: 700; text-align: right; }
    .barcode-area { background: var(--panel-muted); padding: 24px; border-radius: 16px; text-align: center; border: 2px dashed var(--primary-soft); }
    .barcode-placeholder { width: 100%; height: 80px; background: var(--text-dark); margin-bottom: 12px; display: flex; align-items: center; justify-content: center; color: #fff; font-family: monospace; letter-spacing: 5px; }
    .btn-print { width: 100%; margin-top: 20px; background: var(--primary); color: #fff; border: none; padding: 14px; border-radius: 12px; font-weight: 700; cursor: pointer; }
    .proof-box { margin-top: 20px; padding: 18px; border: 1px solid var(--line); border-radius: 16px; background: var(--panel-muted); }
    .proof-box img { width: 100%; max-height: 240px; object-fit: contain; border-radius: 12px; background: #fff; }
    @media (max-width: 900px) { .detail-grid { grid-template-columns: 1fr; } }
  </style>
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
          <li><a href="../user/profile.php" class="menu-item"><span>Profil Saya</span></a></li>
          <li><a href="pesanan.php" class="menu-item active"><span>Pesanan Saya</span></a></li>
          <li><a href="riwayat.php" class="menu-item"><span>Riwayat Transaksi</span></a></li>
          <li><a href="../wishlist/whistlist.php" class="menu-item"><span>Favorite Saya</span></a></li>
          <li><a href="../help/bantuan.php" class="menu-item"><span>Bantuan & Dukungan</span></a></li>
        </ul>
      </nav>

      <button class="btn-logout" onclick="window.location.href='../auth/logout.php'">Keluar</button>
    </aside>

    <main class="profile-content">
      <div class="profile-header">
        <a href="pesanan.php" class="btn-back">Kembali ke Pesanan</a>
      </div>

      <div class="page-hero">
        <h1 class="page-hero-title"><?php echo $order['status'] === 'success' ? 'Nota Pesanan' : 'Detail Pesanan'; ?></h1>
        <p class="page-hero-subtitle">Nomor Pesanan: <?php echo htmlspecialchars($order['order_number']); ?></p>
      </div>

      <div class="detail-grid">
        <div class="ticket-info">
          <div class="order-status-banner <?php echo $order['status'] === 'success' ? 'status-success' : ($order['status'] === 'failed' ? 'status-failed' : 'status-pending'); ?>">
            Status: <?php echo order_status_label($order['status'], $order['payment_proof']); ?>
          </div>

          <h2 class="section-title">Informasi Tiket</h2>
          <div class="info-row"><span class="info-label">Destinasi</span><span class="info-value"><?php echo htmlspecialchars($order['destination_name']); ?></span></div>
          <div class="info-row"><span class="info-label">Tanggal Kunjungan</span><span class="info-value"><?php echo date('d F Y', strtotime($order['visit_date'])); ?></span></div>
          <div class="info-row"><span class="info-label">Jumlah Tiket</span><span class="info-value"><?php echo (int) $order['quantity']; ?> Orang</span></div>
          <div class="info-row"><span class="info-label">Harga per Tiket</span><span class="info-value"><?php echo order_price_label($pricePerTicket); ?></span></div>
          <div class="info-row"><span class="info-label">Total Pembayaran</span><span class="info-value" style="font-size:22px;color:var(--primary);"><?php echo order_price_label($order['total_price']); ?></span></div>

          <h2 class="section-title" style="margin-top: 30px;">Informasi Pemesan</h2>
          <div class="info-row"><span class="info-label">Nama</span><span class="info-value"><?php echo htmlspecialchars($order['username']); ?></span></div>
          <div class="info-row"><span class="info-label">Email</span><span class="info-value"><?php echo htmlspecialchars($order['email']); ?></span></div>
          <div class="info-row"><span class="info-label">Metode Pembayaran</span><span class="info-value"><?php echo htmlspecialchars($order['payment_method'] ?: WISATAKU_BANK_NAME); ?></span></div>
          <div class="info-row"><span class="info-label">Tanggal Pesan</span><span class="info-value"><?php echo date('d F Y', strtotime($order['created_at'])); ?></span></div>

          <?php if (!empty($order['payment_proof'])): ?>
          <div class="proof-box">
            <h3>Bukti Pembayaran</h3>
            <img src="../<?php echo htmlspecialchars($order['payment_proof']); ?>" alt="Bukti pembayaran">
          </div>
          <?php endif; ?>
        </div>

        <div class="ticket-sidebar">
          <?php if ($order['status'] === 'success'): ?>
          <div class="section-shell barcode-area">
            <h3 style="margin-bottom: 20px;">E-Ticket</h3>
            <div class="barcode-placeholder">||| || |||| ||| | ||</div>
            <p style="font-size: 12px; color: var(--text-soft);">Tunjukkan nota ini kepada petugas di pintu masuk destinasi.</p>
            <button class="btn-print" onclick="window.print()">Cetak Nota</button>
          </div>
          <?php else: ?>
          <div class="section-shell barcode-area">
            <h3 style="margin-bottom: 12px;">Menunggu Verifikasi</h3>
            <p style="font-size: 13px; color: var(--text-soft);">Nota akan muncul setelah admin menerima bukti pembayaran.</p>
            <button class="btn-print" onclick="location.href='pembayaran.php?order=<?php echo urlencode($order['order_number']); ?>'">Ke Pembayaran</button>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
