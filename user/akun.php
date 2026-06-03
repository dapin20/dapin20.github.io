<?php
header('Location: profile.php');
exit;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Pengaturan Akun</title>
  <script src="../assets/js/theme.js?v=3.4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="account-theme.css?v=3.1" />
  <link rel="stylesheet" href="akun.css?v=2.1" />
</head>
<body>
  <div class="profile-container">
    <aside class="sidebar">
      <div class="sidebar-header">
        <p class="sidebar-eyebrow" data-i18n="account.sidebar.eyebrow">Akun</p>
        <h2 class="sidebar-title" data-i18n="account.sidebar.title">Profil Pengguna</h2>
      </div>

      <nav class="sidebar-menu">
        <ul>
          <li><a href="profile.php" class="menu-item">
            <span class="menu-icon"><img src="../assets/icon/user-circle.svg" width="24" height="24" alt="Profil"></span>
            <span data-i18n="nav.profile">Profil Saya</span>
          </a></li>
          <li><a href="../orders/pesanan.php" class="menu-item">
            <span class="menu-icon"><img src="../assets/icon/ticket.svg" width="24" height="24" alt="Pesanan"></span>
            <span data-i18n="nav.orders">Pesanan Saya</span>
          </a></li>
          <li><a href="../orders/riwayat.php" class="menu-item">
            <span class="menu-icon"><img src="../assets/icon/Note.svg" width="24" height="24" alt="Riwayat"></span>
            <span data-i18n="nav.history">Riwayat Transaksi</span>
          </a></li>
          <li><a href="../orders/pembayaran.php" class="menu-item">
            <span class="menu-icon"><img src="../assets/icon/credit-card.svg" width="24" height="24" alt="Pembayaran"></span>
            <span data-i18n="nav.payment">Metode Pembayaran</span>
          </a></li>
          <li><a href="../wishlist/whistlist.php" class="menu-item">
            <span class="menu-icon"><img src="../assets/icon/save.svg" width="24" height="24" alt="Favorite"></span>
            <span>Favorite Saya</span>
          </a></li>
          <li><a href="akun.php" class="menu-item active">
            <span class="menu-icon"><img src="../assets/icon/gear.svg" width="24" height="24" alt="Pengaturan"></span>
            <span data-i18n="nav.settings">Pengaturan Akun</span>
          </a></li>
          <li><a href="../help/bantuan.php" class="menu-item">
            <span class="menu-icon"><img src="../assets/icon/question.svg" width="24" height="24" alt="Bantuan"></span>
            <span data-i18n="nav.help">Bantuan & Dukungan</span>
          </a></li>
        </ul>
      </nav>

      <button class="btn-logout" onclick="window.location.href='../auth/logout.php'">
        <span class="menu-icon">Keluar</span>
        <span data-i18n="nav.logout">Keluar</span>
      </button>
    </aside>

    <main class="profile-content">
      <div class="profile-header">
        <a href="../dashboard/home.php" class="btn-back" data-i18n="settings.back">← Kembali ke Beranda</a>
        <p class="profile-subtitle" data-i18n="settings.subtitle">Atur preferensi umum dan kontrol akun dengan tampilan yang seragam.</p>
      </div>

      <div class="page-hero akun-header">
        <h1 class="page-hero-title" data-i18n="settings.title">Pengaturan Akun</h1>
        <p class="page-hero-subtitle" data-i18n="settings.hero">Kelola preferensi dan keamanan akun Anda.</p>
      </div>

      <section class="section-shell akun-section">
        <h2 class="section-title" data-i18n="settings.general">Pengaturan Umum</h2>
        <div class="setting-item">
          <div class="setting-info">
            <h3 class="setting-label" data-i18n="settings.language">Bahasa</h3>
            <p class="setting-desc" data-i18n="settings.languageDesc">Pilih bahasa yang ingin Anda gunakan</p>
          </div>
          <select class="setting-input" data-language-select>
            <option value="id">Bahasa Indonesia</option>
            <option value="en">English</option>
          </select>
        </div>

        <div class="setting-item">
          <div class="setting-info">
            <h3 class="setting-label" data-i18n="settings.theme">Tema</h3>
            <p class="setting-desc" data-i18n="settings.themeDesc">Pilih tema aplikasi Anda</p>
          </div>
          <div class="theme-buttons">
            <button type="button" class="theme-btn active" data-theme-choice="light" aria-pressed="true" data-i18n="settings.light">Terang</button>
            <button type="button" class="theme-btn" data-theme-choice="dark" aria-pressed="false" data-i18n="settings.dark">Gelap</button>
          </div>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
