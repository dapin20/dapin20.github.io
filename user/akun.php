<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Pengaturan Akun</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="akun.css?v=2.0" />
</head>
<body>
  <div class="profile-container">
    <!-- LEFT SIDEBAR: Menu Navigasi -->
    <aside class="sidebar">
      <div class="sidebar-header">
        <h2 class="sidebar-title">WisataKu</h2>
      </div>

      <nav class="sidebar-menu">
        <ul>
          <li><a href="profile.html" class="menu-item">Profil Saya</a></li>
          <li><a href="../orders/pesanan.html" class="menu-item">Pesanan Saya</a></li>
          <li><a href="../orders/riwayat.html" class="menu-item">Riwayat Transaksi</a></li>
          <li><a href="../orders/pembayaran.html" class="menu-item">Metode Pembayaran</a></li>
          <li><a href="../wishlist/whistlist.html" class="menu-item">Wishlist</a></li>
          <li><a href="akun.html" class="menu-item active">Pengaturan Akun</a></li>
          <li><a href="../help/bantuan.html" class="menu-item">Bantuan & Dukungan</a></li>
        </ul>
      </nav>

      <button class="btn-logout">Keluar</button>
    </aside>

    <!-- RIGHT CONTENT: Konten Pengaturan Akun -->
    <main class="profile-content">
      <!-- Header Pengaturan -->
      <div class="profile-header">
        <a href="../dashboard/home.html" class="btn-back">← Kembali ke Halaman Utama</a>
      </div>

      <!-- Title Pengaturan -->
      <div class="akun-header">
        <h1 class="akun-title">Pengaturan Akun</h1>
        <p class="akun-subtitle">Kelola preferensi dan keamanan akun Anda</p>
      </div>

      <!-- Pengaturan Umum -->
      <section class="akun-section">
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
