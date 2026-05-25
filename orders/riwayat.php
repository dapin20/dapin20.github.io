<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Riwayat Transaksi</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="riwayat.css?v=2.0" />
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
          <li><a href="riwayat.html" class="menu-item active">Riwayat Transaksi</a></li>
          <li><a href="pembayaran.html" class="menu-item">Metode Pembayaran</a></li>
          <li><a href="../wishlist/whistlist.html" class="menu-item">Wishlist</a></li>
          <li><a href="../user/akun.html" class="menu-item">Pengaturan Akun</a></li>
          <li><a href="../help/bantuan.html" class="menu-item">Bantuan & Dukungan</a></li>
        </ul>
      </nav>

      <button class="btn-logout">Keluar</button>
    </aside>

    <!-- RIGHT CONTENT: Konten Riwayat Transaksi -->
    <main class="profile-content">
      <!-- Header Riwayat -->
      <div class="profile-header">
        <a href="../dashboard/home.html" class="btn-back">← Kembali ke Halaman Utama</a>
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
