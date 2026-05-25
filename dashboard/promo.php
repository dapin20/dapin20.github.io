<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Promo & Deals</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="home.css?v=3.0">
  <style>
    /* Custom styles for Promo Page to keep it themed with home.css */
    .promo-hero {
      background: linear-gradient(135deg, rgba(1, 87, 173, 0.9), rgba(78, 156, 255, 0.9)),
                  url('../assets/images/background.png') center/cover no-repeat;
      padding: 100px 0 60px;
      text-align: center;
      color: white;
      margin-bottom: 40px;
    }
    
    .promo-hero h1 {
      font-size: 42px;
      font-weight: 800;
      margin-bottom: 15px;
    }
    
    .promo-hero p {
      font-size: 18px;
      opacity: 0.9;
    }

    .promo-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
      gap: 30px;
      padding: 40px 0;
    }

    .promo-card {
      background: white;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 10px 25px rgba(0,0,0,0.05);
      transition: 0.3s;
      border: 1px solid #eee;
      position: relative;
    }

    .promo-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }

    .promo-img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .promo-badge {
      position: absolute;
      top: 15px;
      right: 15px;
      background: #ff4757;
      color: white;
      padding: 8px 15px;
      border-radius: 10px;
      font-weight: 700;
      font-size: 14px;
    }

    .promo-content {
      padding: 25px;
    }

    .promo-content h3 {
      font-size: 20px;
      color: #0157AD;
      margin-bottom: 10px;
      font-weight: 700;
    }

    .promo-content p {
      font-size: 14px;
      color: #666;
      margin-bottom: 20px;
      line-height: 1.6;
    }

    .promo-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .promo-date {
      font-size: 12px;
      color: #999;
    }

    .btn-claim {
      background: linear-gradient(to right, #0157AD, #4E9CFF);
      color: white;
      padding: 10px 20px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
      font-size: 14px;
      transition: 0.3s;
    }

    .btn-claim:hover {
      opacity: 0.9;
    }

    .filter-tabs {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-bottom: 30px;
      flex-wrap: wrap;
    }

    .filter-tab {
      padding: 10px 25px;
      background: white;
      border: 1px solid #ddd;
      border-radius: 30px;
      cursor: pointer;
      font-weight: 600;
      color: #527E90;
      transition: 0.3s;
    }

    .filter-tab.active, .filter-tab:hover {
      background: #0157AD;
      color: white;
      border-color: #0157AD;
    }
  </style>
</head>
<body>

  <!-- ===== NAVBAR ===== -->
  <header class="navbar">
    <div class="container">
      <a href="home.php" class="logo" style="text-decoration:none;">WisataKu</a>

      <ul class="nav-links">
        <li><a href="home.php">Home</a></li>
        <li><a href="promo.php" class="active">Promo &amp; Deals</a></li>
        <li><a href="../wishlist/whistlist.php">Favorite</a></li>
        <li><a href="../tentang.php">Tentang Kami</a></li>
      </ul>

      <div class="nav-right">
        <a href="../user/profile.php">
          <img src="../images/dapin kecil.jpg" alt="Profile" class="profile-icon" style="width:38px; height:38px; border-radius:50%; object-fit:cover; border:2px solid var(--blue-light);">
        </a>
      </div>
    </div>
  </header>

  <!-- ===== HERO PROMO ===== -->
  <section class="promo-hero">
    <div class="container">
      <h1>Promo & Penawaran Menarik</h1>
      <p>Dapatkan diskon spesial untuk berbagai destinasi impianmu di Malang Raya!</p>
    </div>
  </section>

  <div class="container">
    <!-- Filter Tabs -->
    <div class="filter-tabs">
      <div class="filter-tab active">Semua Promo</div>
      <div class="filter-tab">Tiket Alam</div>
      <div class="filter-tab">Wisata Buatan</div>
      <div class="filter-tab">Edukasi</div>
      <div class="filter-tab">Hotel & Resort</div>
    </div>

    <!-- Promo Grid -->
    <div class="promo-grid">
      <!-- Promo 1 -->
      <div class="promo-card">
        <img src="../assets/images/Bromo.png" alt="Promo Bromo" class="promo-img">
        <div class="promo-badge">DISKON 30%</div>
        <div class="promo-content">
          <h3>Bromo Sunrise Package</h3>
          <p>Nikmati keindahan matahari terbit di Gunung Bromo dengan harga lebih hemat 30% untuk pemesanan minimal 4 orang.</p>
          <div class="promo-footer">
            <span class="promo-date">Hingga 30 Jun 2026</span>
            <a href="../user/Bromo.php" class="btn-claim">Gunakan Promo</a>
          </div>
        </div>
      </div>

      <!-- Promo 2 -->
      <div class="promo-card">
        <img src="../assets/images/Edukasi.png" alt="Promo Jatim Park" class="promo-img">
        <div class="promo-badge">BELI 2 GRATIS 1</div>
        <div class="promo-content">
          <h3>Jatim Park 1 Holiday</h3>
          <p>Promo spesial liburan sekolah! Dapatkan 1 tiket gratis setiap pembelian 2 tiket Jatim Park 1. Berlaku setiap hari.</p>
          <div class="promo-footer">
            <span class="promo-date">Hingga 15 Jul 2026</span>
            <a href="../user/JatimPark1.php" class="btn-claim">Gunakan Promo</a>
          </div>
        </div>
      </div>

      <!-- Promo 3 -->
      <div class="promo-card">
        <img src="../images/Buatan3.png" alt="Promo Hawai" class="promo-img">
        <div class="promo-badge">POTONGAN 50RB</div>
        <div class="promo-content">
          <h3>Hawai Waterpark Seru</h3>
          <p>Khusus pemesanan via website WisataKu, dapatkan potongan langsung Rp 50.000 untuk paket keluarga Hawai Waterpark.</p>
          <div class="promo-footer">
            <span class="promo-date">Hingga 20 Jun 2026</span>
            <a href="../user/Hawai.php" class="btn-claim">Gunakan Promo</a>
          </div>
        </div>
      </div>

      <!-- Promo 4 -->
      <div class="promo-card">
        <img src="../assets/images/Tumpak.png" alt="Promo Tumpak Sewu" class="promo-img">
        <div class="promo-badge">DISKON 20%</div>
        <div class="promo-content">
          <h3>Tumpak Sewu Adventure</h3>
          <p>Petualangan tak terlupakan di air terjun termegah. Diskon 20% khusus pemesanan hari kerja (Senin-Jumat).</p>
          <div class="promo-footer">
            <span class="promo-date">Hingga 25 Jun 2026</span>
            <a href="../user/TumpakSewu.php" class="btn-claim">Gunakan Promo</a>
          </div>
        </div>
      </div>

      <!-- Promo 5 -->
      <div class="promo-card">
        <img src="../assets/images/OverlayEdukasi.png" alt="Promo Eco Green Park" class="promo-img">
        <div class="promo-badge">WEEKEND DEAL</div>
        <div class="promo-content">
          <h3>Eco Green Park Family</h3>
          <p>Bawa keluarga belajar tentang lingkungan lebih hemat. Paket keluarga (4 orang) hanya Rp 250.000 saja.</p>
          <div class="promo-footer">
            <span class="promo-date">Hingga 10 Jul 2026</span>
            <a href="../user/EcoGreenPark.php" class="btn-claim">Gunakan Promo</a>
          </div>
        </div>
      </div>

      <!-- Promo 6 -->
      <div class="promo-card">
        <img src="../images/Buatan2.png" alt="Promo Malang Night Paradise" class="promo-img">
        <div class="promo-badge">CASHBACK 15%</div>
        <div class="promo-content">
          <h3>Malang Night Paradise Glow</h3>
          <p>Dapatkan cashback 15% dalam bentuk koin WisataKu untuk setiap pembelian tiket Malang Night Paradise.</p>
          <div class="promo-footer">
            <span class="promo-date">Hingga 05 Jul 2026</span>
            <a href="../user/MalangNightParadise.php" class="btn-claim">Gunakan Promo</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ===== FOOTER ===== -->
  <footer>
    <div class="container">
      <div class="footer-top">
        <div class="footer-brand">
          <span class="logo-footer">WisataKu</span>
          <p>Platform booking tiket wisata terpercaya di Malang Raya, dari destinasi alam hingga wisata edukasi.</p>
          <div class="social-icons">
            <a href="#" class="social-icon"><img src="../assets/icon/instagram.svg" alt="Instagram" /></a>
            <a href="#" class="social-icon"><img src="../assets/icon/youtube.svg" alt="Facebook" /></a>
            <a href="#" class="social-icon"><img src="../assets/icon/twitter.svg" alt="Twitter" /></a>
            <a href="#" class="social-icon"><img src="../assets/icon/mail-line.svg" alt="Email" /></a>
          </div>
        </div>
        <div class="footer-col">
          <h4>Navigasi</h4>
          <ul>
            <li><a href="home.php">Beranda</a></li>
            <li><a href="promo.php">Promo &amp; Deals</a></li>
            <li><a href="../wishlist/whistlist.php">Favorite</a></li>
            <li><a href="../tentang.php">Tentang Kami</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Kontak</h4>
          <ul>
             <li><span class="contact-item"><img src="../assets/icon/mail-line.svg" alt="Email" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> info@wisataku.id</span></li>
            <li><span class="contact-item"><img src="../assets/icon/phone-line.svg" alt="Phone" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> +62 857 9287 4948</span></li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <p>© 2025 WisataKu. All rights reserved.</p>
      </div>
    </div>
  </footer>

</body>
</html>
