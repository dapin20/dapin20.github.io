<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Metode Pembayaran</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="pembayaran.css?v=2.0" />
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
          <li><a href="../user/profile.html" class="menu-item">Profil Saya</a></li>
          <li><a href="pesanan.html" class="menu-item">Pesanan Saya</a></li>
          <li><a href="riwayat.html" class="menu-item">Riwayat Transaksi</a></li>
          <li><a href="pembayaran.html" class="menu-item active">Metode Pembayaran</a></li>
          <li><a href="../wishlist/whistlist.html" class="menu-item">Wishlist</a></li>
          <li><a href="../user/akun.html" class="menu-item">Pengaturan Akun</a></li>
          <li><a href="../help/bantuan.html" class="menu-item">Bantuan & Dukungan</a></li>
        </ul>
      </nav>

      <button class="btn-logout">Keluar</button>
    </aside>

    <!-- RIGHT CONTENT: Konten Metode Pembayaran -->
    <main class="profile-content">
      <!-- Header Pembayaran -->
      <div class="profile-header">
        <a href="../dashboard/home.php" class="btn-back">← Kembali ke Halaman Utama</a>
      </div>

      <!-- Title Pembayaran -->
      <div class="pembayaran-header">
        <div>
          <h1 class="pembayaran-title">Metode Pembayaran</h1>
          <p class="pembayaran-subtitle">Kelola metode pembayaran untuk kemudahan transaksi Anda</p>
        </div>
        <button class="btn-tambah">+ Tambah Metode</button>
      </div>

      <!-- Metode Pembayaran Tersimpan -->
      <section class="pembayaran-section">
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
