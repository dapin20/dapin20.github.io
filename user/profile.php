<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Profil Saya</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="profile.css?v=2.0" />
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
          <li><a href="profile.php" class="menu-item active">Profil Saya</a></li>
          <li><a href="../orders/pesanan.php" class="menu-item">Pesanan Saya</a></li>
          <li><a href="../orders/riwayat.php" class="menu-item">Riwayat Transaksi</a></li>
          <li><a href="../orders/pembayaran.php" class="menu-item">Metode Pembayaran</a></li>
          <li><a href="../dashboard/promo.php" class="menu-item">Promo & Deals</a></li>
          <li><a href="../wishlist/whistlist.php" class="menu-item">Wishlist</a></li>
          <li><a href="akun.php" class="menu-item">Pengaturan Akun</a></li>
          <li><a href="../help/bantuan.php" class="menu-item">Bantuan & Dukungan</a></li>
        </ul>
      </nav>

      <button class="btn-logout" onclick="window.location.href='../auth/logout.php'">Keluar</button>
    </aside>

    <!-- RIGHT CONTENT: Konten Profil -->
    <main class="profile-content">
      <!-- Header Profil -->
      <div class="profile-header">
        <a href="../dashboard/home.php" class="btn-back">← Kembali ke Halaman Utama</a>
      </div>

      <!-- Card Profil Utama -->
      <div class="profile-card">
        <div class="profile-avatar">
          <img src="../images/dapin kecil.jpg" alt="Avatar Profil" />
        </div>
        <div class="profile-info">
          <h1 class="profile-name">Davin Aditya</h1>
          <p class="profile-email">davinadityasaputra20@gmail.com</p>
          <p class="profile-location">Malang, Indonesia</p>
        </div>
      </div>

      <!-- Informasi Akun -->
      <section class="info-section">
        <h2 class="section-title">Informasi Akun</h2>
        <table class="info-table">
          <tr>
            <td class="label">Nama Lengkap</td>
            <td class="value">Davin Aditya</td>
          </tr>
          <tr>
            <td class="label">Email</td>
            <td class="value">davinadityasaputra20@gmail.com</td>
          </tr>
          <tr>
            <td class="label">Nomor Telepon</td>
            <td class="value">+62 857-9287-4948</td>
          </tr>
          <tr>
            <td class="label">Tanggal Bergabung</td>
            <td class="value">27 September 2025</td>
          </tr>
        </table>
      </section>

      <!-- Aktivitas Terakhir -->
      <section class="activity-section">
        <h2 class="section-title">Aktivitas Terakhir</h2>
        <table class="activity-table">
          <tr>
            <td class="activity-name">Pemesanan Tiket Bromo</td>
            <td class="activity-date">2 hari lalu</td>
          </tr>
          <tr>
            <td class="activity-name">Pemesanan Tiket Coban Rondo</td>
            <td class="activity-date">5 hari lalu</td>
          </tr>
          <tr>
            <td class="activity-name">Pemesanan Tiket Jatim Park 2</td>
            <td class="activity-date">1 minggu lalu</td>
          </tr>
        </table>
      </section>
    </main>
  </div>
</body>
</html>
