<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Pesanan Saya</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../user/account-theme.css?v=3.0" />
  <link rel="stylesheet" href="pesanan.css?v=2.0" />
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
          <li><a href="pesanan.php" class="menu-item active"><span class="menu-icon">🎫</span><span>Pesanan Saya</span></a></li>
          <li><a href="riwayat.php" class="menu-item"><span class="menu-icon">🧾</span><span>Riwayat Transaksi</span></a></li>
          <li><a href="pembayaran.php" class="menu-item"><span class="menu-icon">💳</span><span>Metode Pembayaran</span></a></li>
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
        <p class="profile-subtitle">Pantau status tiket aktif, pembayaran, dan aksi lanjutan dalam satu tampilan.</p>
      </div>

      <div class="page-hero">
        <h1 class="page-hero-title">Pesanan Saya</h1>
        <p class="page-hero-subtitle">Kelola dan pantau semua pesanan tiket wisata Anda.</p>
      </div>

      <section class="section-shell pesanan-section">
        <h2 class="section-title">Pesanan Aktif</h2>
        <div class="pesanan-list">
          <div class="pesanan-card">
            <div class="pesanan-card-header">
              <h3 class="pesanan-nama">Tiket Bromo</h3>
              <span class="status-badge status-confirmed">Dikonfirmasi</span>
            </div>
            <div class="pesanan-card-body">
              <div class="pesanan-detail">
                <span class="detail-label">Tanggal Pesan:</span>
                <span class="detail-value">20 November 2025</span>
              </div>
              <div class="pesanan-detail">
                <span class="detail-label">Tanggal Kunjungan:</span>
                <span class="detail-value">22 November 2025</span>
              </div>
              <div class="pesanan-detail">
                <span class="detail-label">Jumlah Tiket:</span>
                <span class="detail-value">2 tiket</span>
              </div>
              <div class="pesanan-detail">
                <span class="detail-label">Total Harga:</span>
                <span class="detail-value-price">Rp 200.000</span>
              </div>
            </div>
            <div class="pesanan-card-footer">
              <button class="btn-action btn-detail">Lihat Detail</button>
              <button class="btn-action btn-cancel">Batalkan</button>
            </div>
          </div>

          <div class="pesanan-card">
            <div class="pesanan-card-header">
              <h3 class="pesanan-nama">Tiket Coban Rondo</h3>
              <span class="status-badge status-pending">Menunggu Pembayaran</span>
            </div>
            <div class="pesanan-card-body">
              <div class="pesanan-detail">
                <span class="detail-label">Tanggal Pesan:</span>
                <span class="detail-value">18 November 2025</span>
              </div>
              <div class="pesanan-detail">
                <span class="detail-label">Tanggal Kunjungan:</span>
                <span class="detail-value">25 November 2025</span>
              </div>
              <div class="pesanan-detail">
                <span class="detail-label">Jumlah Tiket:</span>
                <span class="detail-value">4 tiket</span>
              </div>
              <div class="pesanan-detail">
                <span class="detail-label">Total Harga:</span>
                <span class="detail-value-price">Rp 400.000</span>
              </div>
            </div>
            <div class="pesanan-card-footer">
              <button class="btn-action btn-detail">Lihat Detail</button>
              <button class="btn-action btn-pay">Bayar Sekarang</button>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
