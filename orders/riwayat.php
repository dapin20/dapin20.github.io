<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Riwayat Transaksi</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../user/account-theme.css?v=3.0" />
  <link rel="stylesheet" href="riwayat.css?v=2.0" />
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
          <li><a href="riwayat.php" class="menu-item active"><span class="menu-icon">🧾</span><span>Riwayat Transaksi</span></a></li>
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
        <p class="profile-subtitle">Lihat seluruh histori pembayaran dan status transaksi dengan tata letak yang konsisten.</p>
      </div>

      <div class="page-hero">
        <h1 class="page-hero-title">Riwayat Transaksi</h1>
        <p class="page-hero-subtitle">Lihat semua transaksi pembayaran tiket wisata Anda.</p>
      </div>

      <section class="section-shell riwayat-section">
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
