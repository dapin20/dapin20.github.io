<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Pengaturan Akun</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="akun.css?v=2.0" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

    *, *::before, *::after {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif !important;
    }

    body {
      background-color: #f5f5f5;
      color: #333;
    }

    .profile-container {
      display: flex;
      height: 100vh;
    }

    .sidebar {
      width: 200px;
      background: linear-gradient(135deg, #0157AD 0%, #4E9CFF 100%);
      color: white;
      padding: 20px;
      display: flex;
      flex-direction: column;
      box-shadow: 2px 0 8px rgba(0,0,0,0.1);
      overflow-y: auto;
    }

    .sidebar-title {
      font-size: 20px;
      font-weight: 700;
      background: linear-gradient(90deg, #4E9CFF 40%, #0157AD 120%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .menu-item {
      display: block;
      color: rgba(255,255,255,0.85);
      text-decoration: none;
      padding: 10px 12px;
      border-radius: 6px;
      transition: 0.2s;
      font-size: 14px;
    }

    .menu-item:hover,
    .menu-item.active {
      background-color: rgba(255,255,255,0.2);
      color: white;
    }

    .profile-content {
      flex: 1;
      padding: 24px;
      overflow-y: auto;
      background-color: #f5f5f5;
    }

    .btn-back {
      display: inline-block;
      background: linear-gradient(to right, #0157AD, #4E9CFF);
      color: white;
      border: none;
      padding: 10px 18px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 13px;
      font-weight: 500;
      transition: 0.2s;
      text-decoration: none;
    }

    .akun-section {
      background-color: white;
      padding: 24px;
      border-radius: 12px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.06);
      margin-bottom: 24px;
    }

    .section-title {
      font-size: 18px;
      font-weight: 700;
      color: #333;
      margin-bottom: 20px;
      border-bottom: 2px solid #f0f0f0;
      padding-bottom: 10px;
    }

    @media (max-width: 768px) {
      .profile-container {
        flex-direction: column;
        height: auto;
      }
      .sidebar {
        width: 100%;
        height: auto;
      }
    }
  </style>
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
          <li><a href="profile.php" class="menu-item">Profil Saya</a></li>
          <li><a href="../orders/pesanan.php" class="menu-item">Pesanan Saya</a></li>
          <li><a href="../orders/riwayat.php" class="menu-item">Riwayat Transaksi</a></li>
          <li><a href="../orders/pembayaran.php" class="menu-item">Metode Pembayaran</a></li>
          <li><a href="../dashboard/promo.php" class="menu-item">Promo & Deals</a></li>
          <li><a href="../wishlist/whistlist.php" class="menu-item">Wishlist</a></li>
          <li><a href="akun.php" class="menu-item active">Pengaturan Akun</a></li>
          <li><a href="../help/bantuan.php" class="menu-item">Bantuan & Dukungan</a></li>
        </ul>
      </nav>

      <button class="btn-logout" onclick="window.location.href='../auth/logout.php'">Keluar</button>
    </aside>

    <!-- RIGHT CONTENT: Konten Pengaturan Akun -->
    <main class="profile-content">
      <!-- Header Pengaturan -->
      <div class="profile-header">
        <a href="../dashboard/home.php" class="btn-back">← Kembali ke Halaman Utama</a>
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
