<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Riwayat Transaksi</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="riwayat.css?v=2.0" />
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

    .riwayat-header {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.06);
      margin-bottom: 24px;
    }

    .riwayat-title {
      font-size: 24px;
      font-weight: 700;
      color: #0157AD;
      margin-bottom: 8px;
    }

    .riwayat-section {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.06);
    }

    .riwayat-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
    }

    .riwayat-table th {
      text-align: left;
      padding: 12px 16px;
      background-color: #f9f9f9;
      color: #0157AD;
      font-weight: 600;
      border-bottom: 2px solid #eee;
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
          <li><a href="riwayat.php" class="menu-item active">Riwayat Transaksi</a></li>
          <li><a href="pembayaran.php" class="menu-item">Metode Pembayaran</a></li>
          <li><a href="../dashboard/promo.php" class="menu-item">Promo & Deals</a></li>
          <li><a href="../wishlist/whistlist.php" class="menu-item">Wishlist</a></li>
          <li><a href="../user/akun.php" class="menu-item">Pengaturan Akun</a></li>
          <li><a href="../help/bantuan.php" class="menu-item">Bantuan & Dukungan</a></li>
        </ul>
      </nav>

      <button class="btn-logout" onclick="window.location.href='../auth/logout.php'">Keluar</button>
    </aside>

    <!-- RIGHT CONTENT: Konten Riwayat Transaksi -->
    <main class="profile-content">
      <!-- Header Riwayat -->
      <div class="profile-header">
        <a href="../dashboard/home.php" class="btn-back">← Kembali ke Halaman Utama</a>
      </div>

      <!-- Title Riwayat -->
      <div class="riwayat-header">
        <h1 class="riwayat-title">Riwayat Transaksi</h1>
        <p class="riwayat-subtitle">Lihat semua transaksi pembayaran tiket wisata Anda</p>
      </div>

      <!-- Tabel Riwayat Transaksi -->
      <section class="riwayat-section">
        <table class="riwayat-table">
          <thead>
            <tr>
              <th>No</th>
              <th>ID Transaksi</th>
              <th>Destinasi</th>
              <th>Tanggal Transaksi</th>
              <th>Nominal</th>
              <th>Metode Pembayaran</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>TRX-2025-001</td>
              <td>Tiket Bromo</td>
              <td>20 November 2025</td>
              <td>Rp 200.000</td>
              <td>Transfer Bank</td>
              <td><span class="status-badge status-berhasil">Berhasil</span></td>
              <td><button class="btn-riwayat">Detail</button></td>
            </tr>
            <tr>
              <td>2</td>
              <td>TRX-2025-002</td>
              <td>Tiket Coban Rondo</td>
              <td>18 November 2025</td>
              <td>Rp 400.000</td>
              <td>E-Wallet</td>
              <td><span class="status-badge status-pending">Pending</span></td>
              <td><button class="btn-riwayat">Detail</button></td>
            </tr>
            <tr>
              <td>3</td>
              <td>TRX-2025-003</td>
              <td>Tiket Jatim Park 2</td>
              <td>15 November 2025</td>
              <td>Rp 300.000</td>
              <td>Kartu Kredit</td>
              <td><span class="status-badge status-berhasil">Berhasil</span></td>
              <td><button class="btn-riwayat">Detail</button></td>
            </tr>
          </tbody>
        </table>
      </section>
    </main>
  </div>
</body>
</html>
