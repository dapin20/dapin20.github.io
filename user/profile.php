<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Profil Saya</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="account-theme.css?v=3.0" />
  <link rel="stylesheet" href="profile.css?v=2.0" />
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
          <li><a href="profile.php" class="menu-item active"><span class="menu-icon">👤</span><span>Profil Saya</span></a></li>
          <li><a href="../orders/pesanan.php" class="menu-item"><span class="menu-icon">🎫</span><span>Pesanan Saya</span></a></li>
          <li><a href="../orders/riwayat.php" class="menu-item"><span class="menu-icon">🧾</span><span>Riwayat Transaksi</span></a></li>
          <li><a href="../orders/pembayaran.php" class="menu-item"><span class="menu-icon">💳</span><span>Metode Pembayaran</span></a></li>
          <li><a href="../dashboard/promo.php" class="menu-item"><span class="menu-icon">🏷</span><span>Promo & Deals</span></a></li>
          <li><a href="../wishlist/whistlist.php" class="menu-item"><span class="menu-icon">❤</span><span>Wishlist</span></a></li>
          <li><a href="akun.php" class="menu-item"><span class="menu-icon">⚙</span><span>Pengaturan Akun</span></a></li>
          <li><a href="../help/bantuan.php" class="menu-item"><span class="menu-icon">❓</span><span>Bantuan & Dukungan</span></a></li>
        </ul>
      </nav>

      <a href="../admin/index.php" class="btn-admin-link">Login Admin</a>
      <button class="btn-logout" onclick="window.location.href='../auth/logout.php'">Keluar</button>
    </aside>

    <main class="profile-content">
      <div class="profile-header">
        <a href="../dashboard/home.php" class="btn-back">← Kembali ke Beranda</a>
        <p class="profile-subtitle">Kelola informasi akun dan data kontak Anda di satu tempat.</p>
      </div>

      <section class="profile-hero">
        <div class="profile-avatar-wrap">
          <div class="profile-avatar">
            <img src="../assets/images/dapin kecil.jpg" alt="Avatar Profil" />
          </div>
          <button class="avatar-badge" type="button" aria-label="Edit profil">✎</button>
        </div>
        <div class="profile-identity">
          <h1 class="profile-name">Davin Aditya</h1>
          <p class="profile-email">davinadityasaputra20@gmail.com</p>
          <p class="profile-location">Malang, Indonesia</p>
        </div>
      </section>

      <section class="profile-panel">
        <div class="panel-header">
          <h2 class="section-title">Informasi Akun</h2>
          <p class="panel-note">Tampilan baru mengikuti layout form profil, tanpa banyak gradient.</p>
        </div>

        <div class="info-grid">
          <div class="field-group">
            <label for="firstName">Nama Depan</label>
            <input id="firstName" type="text" value="Davin" readonly>
          </div>
          <div class="field-group">
            <label for="lastName">Nama Belakang</label>
            <input id="lastName" type="text" value="Aditya" readonly>
          </div>
          <div class="field-group">
            <label for="email">Email</label>
            <input id="email" type="email" value="davinadityasaputra20@gmail.com" readonly>
          </div>
          <div class="field-group">
            <label for="phone">Nomor Telepon</label>
            <input id="phone" type="text" value="+62 857-9287-4948" readonly>
          </div>
          <div class="field-group">
            <label for="location">Lokasi</label>
            <input id="location" type="text" value="Malang, Indonesia" readonly>
          </div>
          <div class="field-group">
            <label for="joined">Tanggal Bergabung</label>
            <input id="joined" type="text" value="27 September 2025" readonly>
          </div>
        </div>

        <div class="panel-actions">
          <a href="akun.php" class="btn-save">Simpan Perubahan</a>
        </div>
      </section>

      <section class="activity-section">
        <h2 class="section-title">Aktivitas Terakhir</h2>
        <div class="activity-list">
          <div class="activity-item">
            <div>
              <p class="activity-name">Pemesanan Tiket Bromo</p>
              <p class="activity-meta">Reservasi wisata alam</p>
            </div>
            <span class="activity-date">2 hari lalu</span>
          </div>
          <div class="activity-item">
            <div>
              <p class="activity-name">Pemesanan Tiket Coban Rondo</p>
              <p class="activity-meta">Reservasi destinasi air terjun</p>
            </div>
            <span class="activity-date">5 hari lalu</span>
          </div>
          <div class="activity-item">
            <div>
              <p class="activity-name">Pemesanan Tiket Jatim Park 2</p>
              <p class="activity-meta">Reservasi wisata keluarga</p>
            </div>
            <span class="activity-date">1 minggu lalu</span>
          </div>
        </div>
      </section>
    </main>
  </div>
</body>
</html>
