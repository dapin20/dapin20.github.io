<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Metode Pembayaran</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="pembayaran.css?v=2.0" />
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

    .pembayaran-header {
      background-color: white;
      padding: 24px;
      border-radius: 12px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.06);
      margin-bottom: 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .pembayaran-title {
      font-size: 24px;
      font-weight: 700;
      color: #0157AD;
      margin-bottom: 4px;
    }

    .btn-tambah {
      background: linear-gradient(to right, #0157AD, #4E9CFF);
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: 0.3s;
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
          <li><a href="../user/profile.php" class="menu-item">Profil Saya</a></li>
          <li><a href="pesanan.php" class="menu-item">Pesanan Saya</a></li>
          <li><a href="riwayat.php" class="menu-item">Riwayat Transaksi</a></li>
          <li><a href="pembayaran.php" class="menu-item active">Metode Pembayaran</a></li>
          <li><a href="../dashboard/promo.php" class="menu-item">Promo & Deals</a></li>
          <li><a href="../wishlist/whistlist.php" class="menu-item">Wishlist</a></li>
          <li><a href="../user/akun.php" class="menu-item">Pengaturan Akun</a></li>
          <li><a href="../help/bantuan.php" class="menu-item">Bantuan & Dukungan</a></li>
        </ul>
      </nav>

      <button class="btn-logout" onclick="window.location.href='../auth/logout.php'">Keluar</button>
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
