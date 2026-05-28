<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Metode Pembayaran</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../user/account-theme.css?v=3.0" />
  <link rel="stylesheet" href="pembayaran.css?v=2.0" />
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
          <li><a href="../user/profile.php" class="menu-item"><span class="menu-icon">👤</span><span>Profil Saya</span></a></li>
          <li><a href="pesanan.php" class="menu-item"><span class="menu-icon">🎫</span><span>Pesanan Saya</span></a></li>
          <li><a href="riwayat.php" class="menu-item"><span class="menu-icon">🧾</span><span>Riwayat Transaksi</span></a></li>
          <li><a href="pembayaran.php" class="menu-item active"><span class="menu-icon">💳</span><span>Metode Pembayaran</span></a></li>
          <li><a href="../dashboard/promo.php" class="menu-item"><span class="menu-icon">🏷</span><span>Promo & Deals</span></a></li>
          <li><a href="../wishlist/whistlist.php" class="menu-item"><span class="menu-icon">❤</span><span>Wishlist</span></a></li>
          <li><a href="../user/akun.php" class="menu-item"><span class="menu-icon">⚙</span><span>Pengaturan Akun</span></a></li>
          <li><a href="../help/bantuan.php" class="menu-item"><span class="menu-icon">❓</span><span>Bantuan & Dukungan</span></a></li>
        </ul>
      </nav>

      <a href="../admin/index.php" class="btn-admin-link">Login Admin</a>
      <button class="btn-logout" onclick="window.location.href='../auth/logout.php'">Keluar</button>
    </aside>

    <main class="profile-content">
      <div class="profile-header">
        <a href="../dashboard/home.php" class="btn-back">← Kembali ke Beranda</a>
        <p class="profile-subtitle">Simpan metode pembayaran utama Anda dalam tampilan yang sama dengan halaman profil.</p>
      </div>

      <div class="page-hero pembayaran-header">
        <div>
          <h1 class="page-hero-title">Metode Pembayaran</h1>
          <p class="page-hero-subtitle">Kelola metode pembayaran untuk kemudahan transaksi Anda.</p>
        </div>
        <button class="btn-primary btn-tambah">+ Tambah Metode</button>
      </div>

      <section class="section-shell pembayaran-section">
        <h2 class="section-title">Metode Pembayaran Tersimpan</h2>
        <div class="pembayaran-list">
          <!-- Metode 1 -->
          <div class="payment-card">
            <div class="payment-header">
              <div class="payment-icon transfer-icon">🏦</div>
              <div class="payment-info">
                <h3 class="payment-name">Transfer Bank BCA</h3>
                <p class="payment-detail">Rekening: 1234 5678 9012</p>
              </div>
              <span class="badge-utama">Utama</span>
            </div>
            <div class="payment-actions">
              <button class="btn-action btn-edit">Edit</button>
              <button class="btn-action btn-hapus">Hapus</button>
            </div>
          </div>

          <!-- Metode 2 -->
          <div class="payment-card">
            <div class="payment-header">
              <div class="payment-icon ewallet-icon">💳</div>
              <div class="payment-info">
                <h3 class="payment-name">E-Wallet GCash</h3>
                <p class="payment-detail">Nomor: 0895 1234 5678</p>
              </div>
            </div>
            <div class="payment-actions">
              <button class="btn-action btn-edit">Edit</button>
              <button class="btn-action btn-hapus">Hapus</button>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
