<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Pengaturan Akun</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="account-theme.css?v=3.0" />
  <link rel="stylesheet" href="akun.css?v=2.0" />
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
          <li><a href="profile.php" class="menu-item"><span class="menu-icon">👤</span><span>Profil Saya</span></a></li>
          <li><a href="../orders/pesanan.php" class="menu-item"><span class="menu-icon">🎫</span><span>Pesanan Saya</span></a></li>
          <li><a href="../orders/riwayat.php" class="menu-item"><span class="menu-icon">🧾</span><span>Riwayat Transaksi</span></a></li>
          <li><a href="../orders/pembayaran.php" class="menu-item"><span class="menu-icon">💳</span><span>Metode Pembayaran</span></a></li>
          <li><a href="../dashboard/promo.php" class="menu-item"><span class="menu-icon">🏷</span><span>Promo & Deals</span></a></li>
          <li><a href="../wishlist/whistlist.php" class="menu-item"><span class="menu-icon">❤</span><span>Wishlist</span></a></li>
          <li><a href="akun.php" class="menu-item active"><span class="menu-icon">⚙</span><span>Pengaturan Akun</span></a></li>
          <li><a href="../help/bantuan.php" class="menu-item"><span class="menu-icon">❓</span><span>Bantuan & Dukungan</span></a></li>
        </ul>
      </nav>

      <a href="../admin/index.php" class="btn-admin-link">Login Admin</a>
      <button class="btn-logout" onclick="window.location.href='../auth/logout.php'">Keluar</button>
    </aside>

    <main class="profile-content">
      <div class="profile-header">
        <a href="../dashboard/home.php" class="btn-back">← Kembali ke Beranda</a>
        <p class="profile-subtitle">Atur preferensi umum dan kontrol akun dengan tampilan yang seragam.</p>
      </div>

      <div class="page-hero akun-header">
        <h1 class="page-hero-title">Pengaturan Akun</h1>
        <p class="page-hero-subtitle">Kelola preferensi dan keamanan akun Anda.</p>
      </div>

      <section class="section-shell akun-section">
        <h2 class="section-title">Pengaturan Umum</h2>
        <div class="setting-item">
          <div class="setting-info">
            <h3 class="setting-label">Bahasa</h3>
            <p class="setting-desc">Pilih bahasa yang ingin Anda gunakan</p>
          </div>
          <select class="setting-input">
            <option value="id">Bahasa Indonesia</option>
            <option value="en">English</option>
          </select>
        </div>

        <div class="setting-item">
          <div class="setting-info">
            <h3 class="setting-label">Tema</h3>
            <p class="setting-desc">Pilih tema aplikasi Anda</p>
          </div>
          <div class="theme-buttons">
            <button class="theme-btn active">Terang</button>
            <button class="theme-btn">Gelap</button>
          </div>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
