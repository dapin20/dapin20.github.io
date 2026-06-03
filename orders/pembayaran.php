<?php
session_start();
require_once('../config/auth_helper.php');
require_once('../config/koneksi.php');
require_once('../config/order_helper.php');

checkLogin('user');
ensure_order_payment_columns($conn);

$userId = (int) $_SESSION['user_id'];
$orderNumber = normalize_order_number($_GET['order'] ?? $_POST['order_number'] ?? '');
$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $orderNumber !== '') {
    if (empty($_FILES['payment_proof']['name'])) {
        $errors[] = 'Bukti pembayaran wajib diupload.';
    } else {
        $file = $_FILES['payment_proof'];
        $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $mime = mime_content_type($file['tmp_name']);
        $allowedMime = ['image/jpeg', 'image/png', 'image/webp'];

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'Upload bukti pembayaran gagal.';
        } elseif (!in_array($ext, $allowedExt, true) || !in_array($mime, $allowedMime, true)) {
            $errors[] = 'Bukti pembayaran harus berupa gambar JPG, JPEG, PNG, atau WEBP. File PDF tidak diperbolehkan.';
        } elseif ($file['size'] > 2 * 1024 * 1024) {
            $errors[] = 'Ukuran gambar maksimal 2 MB.';
        } else {
            $uploadDir = ensure_payment_upload_dir();
            $fileName = $orderNumber . '-' . time() . '.' . $ext;
            $target = $uploadDir . '/' . $fileName;

            if (move_uploaded_file($file['tmp_name'], $target)) {
                $relativePath = 'assets/uploads/payment_proofs/' . $fileName;
                $stmt = $conn->prepare("UPDATE orders SET payment_proof = ?, status = 'pending' WHERE order_number = ? AND user_id = ?");
                $stmt->bind_param("ssi", $relativePath, $orderNumber, $userId);
                $stmt->execute();
                $stmt->close();
                $success = 'Bukti pembayaran berhasil dikirim. Status pesanan menunggu verifikasi admin.';
            } else {
                $errors[] = 'Gagal menyimpan bukti pembayaran.';
            }
        }
    }
}

$order = null;
if ($orderNumber !== '') {
    $stmt = $conn->prepare(
        "SELECT o.*, d.name AS destination_name
         FROM orders o
         JOIN destinations d ON o.destination_id = d.id
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
}

$pendingStmt = $conn->prepare(
    "SELECT o.order_number, o.total_price, o.payment_proof, o.status, d.name AS destination_name
     FROM orders o
     JOIN destinations d ON o.destination_id = d.id
     WHERE o.user_id = ? AND o.status <> 'success'
     ORDER BY o.created_at DESC
     LIMIT 5"
);
$pendingStmt->bind_param("i", $userId);
$pendingStmt->execute();
$pendingOrders = $pendingStmt->get_result();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Pembayaran</title>
  <script src="../assets/js/theme.js?v=3.4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../user/account-theme.css?v=3.0" />
  <link rel="stylesheet" href="pembayaran.css?v=3.0" />
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
          <li><a href="../orders/pesanan.php" class="menu-item"><span class="menu-icon"><img src="../assets/icon/ticket.svg" width="24" height="24" alt="Pesanan"></span><span>Pesanan Saya</span></a></li>
          <li><a href="../orders/riwayat.php" class="menu-item"><span class="menu-icon"><img src="../assets/icon/Note.svg" width="24" height="24" alt="Riwayat"></span><span>Riwayat Transaksi</span></a></li>
          <li><a href="../orders/pembayaran.php<?php echo $orderNumber !== '' ? '?order=' . urlencode($orderNumber) : ''; ?>" class="menu-item active"><span class="menu-icon"><img src="../assets/icon/credit-card.svg" width="24" height="24" alt="Pembayaran"></span><span>Metode Pembayaran</span></a></li>
          <li><a href="../wishlist/whistlist.php" class="menu-item"><span class="menu-icon"><img src="../assets/icon/save.svg" width="24" height="24" alt="Favorite"></span><span>Favorite Saya</span></a></li>
          <li><a href="../help/bantuan.php" class="menu-item"><span class="menu-icon"><img src="../assets/icon/question.svg" width="24" height="24" alt="Bantuan"></span><span>Bantuan & Dukungan</span></a></li>
        </ul>
      </nav>

      <button class="btn-logout" onclick="window.location.href='../auth/logout.php'"><span>Keluar</span></button>
    </aside>

    <main class="profile-content">
      <div class="profile-header">
        <a href="pesanan.php" class="btn-back">Kembali ke Pesanan</a>
        <p class="profile-subtitle"><?php echo $order ? 'Transfer sesuai total tagihan, lalu upload bukti pembayaran berupa gambar.' : 'Lihat rekening pembayaran dan lanjutkan pembayaran pesanan yang belum selesai.'; ?></p>
      </div>

      <div class="page-hero pembayaran-header">
        <div>
          <h1 class="page-hero-title"><?php echo $order ? 'Pembayaran Transfer Bank' : 'Metode Pembayaran'; ?></h1>
          <p class="page-hero-subtitle">
            <?php echo $order ? 'Nomor pesanan: ' . htmlspecialchars($order['order_number']) : 'Gunakan rekening resmi WisataKu untuk menyelesaikan pembayaran tiket.'; ?>
          </p>
        </div>
      </div>

      <?php if (!empty($errors)): ?>
        <div class="payment-alert error"><?php echo htmlspecialchars(implode(' ', $errors)); ?></div>
      <?php endif; ?>
      <?php if ($success): ?>
        <div class="payment-alert success"><?php echo htmlspecialchars($success); ?></div>
      <?php endif; ?>

      <?php if ($order): ?>
      <section class="section-shell payment-flow">
        <div class="bank-card">
          <h2 class="section-title">Instruksi Transfer</h2>
          <div class="bank-row"><span>Bank</span><strong><?php echo WISATAKU_BANK_NAME; ?></strong></div>
          <div class="bank-row"><span>No Rekening</span><strong><?php echo WISATAKU_BANK_ACCOUNT; ?></strong></div>
          <div class="bank-row"><span>Atas Nama</span><strong><?php echo WISATAKU_BANK_HOLDER; ?></strong></div>
          <div class="bank-row total"><span>Total Transfer</span><strong><?php echo order_price_label($order['total_price']); ?></strong></div>
          <p class="bank-note">Status akan menjadi diterima setelah admin memverifikasi bukti pembayaran.</p>
        </div>

        <div class="upload-card">
          <h2 class="section-title">Upload Bukti Pembayaran</h2>
          <div class="order-summary">
            <div><span>Destinasi</span><strong><?php echo htmlspecialchars($order['destination_name']); ?></strong></div>
            <div><span>Tanggal Kunjungan</span><strong><?php echo date('d F Y', strtotime($order['visit_date'])); ?></strong></div>
            <div><span>Jumlah Tiket</span><strong><?php echo (int) $order['quantity']; ?> tiket</strong></div>
            <div><span>Status</span><strong><?php echo order_status_label($order['status'], $order['payment_proof']); ?></strong></div>
          </div>

          <?php if (!empty($order['payment_proof'])): ?>
            <div class="proof-preview">
              <img src="../<?php echo htmlspecialchars($order['payment_proof']); ?>" alt="Bukti pembayaran">
              <p>Bukti pembayaran sudah diupload.</p>
            </div>
          <?php endif; ?>

          <?php if ($order['status'] !== 'success'): ?>
          <form method="POST" enctype="multipart/form-data" class="upload-form">
            <input type="hidden" name="order_number" value="<?php echo htmlspecialchars($order['order_number']); ?>">
            <label for="payment_proof">Pilih gambar bukti transfer</label>
            <input id="payment_proof" type="file" name="payment_proof" accept="image/png,image/jpeg,image/webp" required>
            <button type="submit" class="btn-primary">Kirim Bukti Pembayaran</button>
          </form>
          <?php else: ?>
            <a href="detail.php?id=<?php echo urlencode($order['order_number']); ?>" class="btn-primary nota-link">Lihat Nota</a>
          <?php endif; ?>
        </div>
      </section>
      <?php else: ?>
      <section class="section-shell payment-flow">
        <div class="bank-card">
          <h2 class="section-title">Rekening Pembayaran</h2>
          <div class="bank-row"><span>Bank</span><strong><?php echo WISATAKU_BANK_NAME; ?></strong></div>
          <div class="bank-row"><span>No Rekening</span><strong><?php echo WISATAKU_BANK_ACCOUNT; ?></strong></div>
          <div class="bank-row"><span>Atas Nama</span><strong><?php echo WISATAKU_BANK_HOLDER; ?></strong></div>
          <p class="bank-note">Buka salah satu pesanan yang belum selesai untuk mengupload bukti pembayaran.</p>
        </div>

        <div class="upload-card">
          <h2 class="section-title">Pesanan Belum Selesai</h2>
          <?php if ($pendingOrders->num_rows === 0): ?>
            <div class="payment-empty">Belum ada pesanan yang perlu dibayar.</div>
          <?php else: ?>
            <div class="pending-payment-list">
              <?php while ($pending = $pendingOrders->fetch_assoc()): ?>
                <div class="pending-payment-item">
                  <div>
                    <strong><?php echo htmlspecialchars($pending['destination_name']); ?></strong>
                    <span><?php echo htmlspecialchars($pending['order_number']); ?> - <?php echo order_price_label($pending['total_price']); ?></span>
                  </div>
                  <a class="btn-primary small-link" href="pembayaran.php?order=<?php echo urlencode($pending['order_number']); ?>">
                    <?php echo $pending['payment_proof'] ? 'Lihat Bukti' : 'Upload Bukti'; ?>
                  </a>
                </div>
              <?php endwhile; ?>
            </div>
          <?php endif; ?>
        </div>
      </section>
      <?php endif; ?>
    </main>
  </div>
</body>
</html>
<?php $pendingStmt->close(); ?>
