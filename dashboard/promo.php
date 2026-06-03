<?php
session_start();
require_once('../config/koneksi.php');

$user_id = $_SESSION['user_id'] ?? null;
$user_type = $_SESSION['user_type'] ?? 'user';
$avatarSrc = '../assets/images/dapin kecil.jpg';

if ($user_id) {
    $table = ($user_type === 'admin') ? 'admins' : 'users';
    $colCheck = $conn->query("SHOW COLUMNS FROM $table LIKE 'avatar'");
    if ($colCheck && $colCheck->num_rows > 0) {
        $stmt = $conn->prepare("SELECT avatar FROM $table WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($row = $res->fetch_assoc()) {
            if (!empty($row['avatar'])) {
                $avatarSrc = '../' . $row['avatar'];
                $_SESSION['avatar'] = $row['avatar'];
            }
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <script src="../assets/js/theme.js?v=3.4"></script>
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
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 22px;
      padding: 40px 0;
    }

    .promo-card {
      background: white;
      border-radius: 26px;
      overflow: hidden;
      box-shadow: 0 16px 36px rgba(15, 23, 42, 0.08);
      transition: transform 0.2s ease, box-shadow 0.2s ease;
      border: 1px solid #e6eef7;
      position: relative;
    }

    .promo-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 24px 50px rgba(15, 23, 42, 0.12);
    }

    .promo-image-wrap {
      position: relative;
      height: 186px;
    }

    .promo-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .promo-thumb {
      position: absolute;
      top: 14px;
      left: 14px;
      display: inline-flex;
      align-items: center;
      gap: 7px;
      padding: 8px 11px;
      border-radius: 999px;
      background: rgba(255, 255, 255, 0.94);
      color: #0157AD;
      font-size: 12px;
      font-weight: 800;
      box-shadow: 0 10px 22px rgba(15, 23, 42, 0.16);
    }

    .promo-thumb img {
      width: 16px;
      height: 16px;
    }

    .promo-badge {
      position: absolute;
      top: 14px;
      right: 14px;
      background: #0157AD;
      color: white;
      padding: 8px 12px;
      border-radius: 999px;
      font-weight: 700;
      font-size: 12px;
      box-shadow: 0 10px 22px rgba(1, 87, 173, 0.22);
    }

    .promo-content {
      padding: 16px 18px 20px;
    }

    .promo-content h3 {
      font-size: 18px;
      line-height: 1.35;
      color: var(--text-dark);
      margin-bottom: 10px;
      font-weight: 700;
    }

    .promo-content p {
      font-size: 13px;
      color: var(--text-light);
      margin-bottom: 14px;
      line-height: 1.65;
    }

    .promo-price {
      display: flex;
      align-items: baseline;
      gap: 8px;
      margin-bottom: 14px;
    }

    .promo-price-old {
      color: var(--text-light);
      font-size: 13px;
      text-decoration: line-through;
      font-weight: 600;
    }

    .promo-price-new {
      color: #0157AD;
      font-size: 18px;
      font-weight: 800;
    }

    .promo-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 10px;
    }

    .promo-date {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      font-size: 12px;
      color: var(--text-light);
      font-weight: 600;
    }

    .promo-date::before {
      content: "";
      width: 7px;
      height: 7px;
      border-radius: 999px;
      background: #4E9CFF;
      flex: 0 0 auto;
    }

    .btn-claim {
      background: linear-gradient(to right, #0157AD, #4E9CFF);
      color: white;
      padding: 10px 14px;
      border-radius: 12px;
      text-decoration: none;
      font-weight: 600;
      font-size: 13px;
      transition: 0.3s;
      white-space: nowrap;
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
        <li><a href="../tentang.php">Tentang Kami</a></li>
      </ul>

      <div class="nav-right">
        <button class="profile-menu-button" type="button" id="profileMenuButton" aria-label="Menu profil" aria-expanded="false">
          <img src="<?php echo htmlspecialchars($avatarSrc); ?>" alt="Profile" class="profile-icon">
        </button>
        <div class="profile-dropdown" id="profileDropdown">
          <a href="../user/profile.php">Profil Saya</a>
          <a href="../wishlist/whistlist.php">Favorite Saya</a>
          <a href="../auth/logout.php">Logout</a>
        </div>
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
        <div class="promo-image-wrap">
          <img src="../assets/images/Bromo.png" alt="Promo Bromo" class="promo-img">
          <span class="promo-thumb"><img src="../assets/icon/ticket.svg" alt=""> Promo</span>
          <div class="promo-badge">DISKON 30%</div>
        </div>
        <div class="promo-content">
          <h3>Bromo Sunrise Package</h3>
          <p>Nikmati keindahan matahari terbit di Gunung Bromo dengan harga lebih hemat 30% untuk pemesanan minimal 4 orang.</p>
          <div class="promo-price"><span class="promo-price-old">Rp 155.000</span><span class="promo-price-new">Rp 108.500</span></div>
          <div class="promo-footer">
            <span class="promo-date">Hingga 30 Jun 2026</span>
            <a href="../user/wisata_alam/Bromo.php?promo=1&regular_price=155000&promo_price=108500" class="btn-claim">Gunakan Promo</a>
          </div>
        </div>
      </div>

      <!-- Promo 2 -->
      <div class="promo-card">
        <div class="promo-image-wrap">
          <img src="../assets/images/Edukasi.png" alt="Promo Jatim Park" class="promo-img">
          <span class="promo-thumb"><img src="../assets/icon/ticket.svg" alt=""> Promo</span>
          <div class="promo-badge">BELI 2 GRATIS 1</div>
        </div>
        <div class="promo-content">
          <h3>Jatim Park 1 Holiday</h3>
          <p>Promo spesial liburan sekolah! Dapatkan 1 tiket gratis setiap pembelian 2 tiket Jatim Park 1. Berlaku setiap hari.</p>
          <div class="promo-price"><span class="promo-price-new">Rp 100.000</span></div>
          <div class="promo-footer">
            <span class="promo-date">Hingga 15 Jul 2026</span>
            <a href="../user/wisata_buatan/JatimPark1.php" class="btn-claim">Gunakan Promo</a>
          </div>
        </div>
      </div>

      <!-- Promo 3 -->
      <div class="promo-card">
        <div class="promo-image-wrap">
          <img src="../assets/images/Buatan3.png" alt="Promo Hawai" class="promo-img">
          <span class="promo-thumb"><img src="../assets/icon/ticket.svg" alt=""> Promo</span>
          <div class="promo-badge">POTONGAN 50RB</div>
        </div>
        <div class="promo-content">
          <h3>Hawai Waterpark Seru</h3>
          <p>Khusus pemesanan via website WisataKu, dapatkan potongan langsung Rp 50.000 untuk paket keluarga Hawai Waterpark.</p>
          <div class="promo-price"><span class="promo-price-old">Rp 100.000</span><span class="promo-price-new">Rp 50.000</span></div>
          <div class="promo-footer">
            <span class="promo-date">Hingga 20 Jun 2026</span>
            <a href="../user/wisata_buatan/Hawai.php?promo=1&regular_price=100000&promo_price=50000" class="btn-claim">Gunakan Promo</a>
          </div>
        </div>
      </div>

      <!-- Promo 4 -->
      <div class="promo-card">
        <div class="promo-image-wrap">
          <img src="../assets/images/Tumpak.png" alt="Promo Tumpak Sewu" class="promo-img">
          <span class="promo-thumb"><img src="../assets/icon/ticket.svg" alt=""> Promo</span>
          <div class="promo-badge">DISKON 20%</div>
        </div>
        <div class="promo-content">
          <h3>Tumpak Sewu Adventure</h3>
          <p>Petualangan tak terlupakan di air terjun termegah. Diskon 20% khusus pemesanan hari kerja (Senin-Jumat).</p>
          <div class="promo-price"><span class="promo-price-old">Rp 20.000</span><span class="promo-price-new">Rp 16.000</span></div>
          <div class="promo-footer">
            <span class="promo-date">Hingga 25 Jun 2026</span>
            <a href="../user/wisata_alam/TumpakSewu.php?promo=1&regular_price=20000&promo_price=16000" class="btn-claim">Gunakan Promo</a>
          </div>
        </div>
      </div>

      <!-- Promo 5 -->
      <div class="promo-card">
        <div class="promo-image-wrap">
          <img src="../assets/images/OverlayEdukasi.png" alt="Promo Eco Green Park" class="promo-img">
          <span class="promo-thumb"><img src="../assets/icon/ticket.svg" alt=""> Promo</span>
          <div class="promo-badge">WEEKEND DEAL</div>
        </div>
        <div class="promo-content">
          <h3>Eco Green Park Family</h3>
          <p>Bawa keluarga belajar tentang lingkungan lebih hemat. Paket keluarga (4 orang) hanya Rp 250.000 saja.</p>
          <div class="promo-price"><span class="promo-price-new">Rp 55.000</span></div>
          <div class="promo-footer">
            <span class="promo-date">Hingga 10 Jul 2026</span>
            <a href="../user/wisata_edukasi/EcoGreenPark.php" class="btn-claim">Gunakan Promo</a>
          </div>
        </div>
      </div>

      <!-- Promo 6 -->
      <div class="promo-card">
        <div class="promo-image-wrap">
          <img src="../assets/images/Buatan2.png" alt="Promo Malang Night Paradise" class="promo-img">
          <span class="promo-thumb"><img src="../assets/icon/ticket.svg" alt=""> Promo</span>
          <div class="promo-badge">CASHBACK 15%</div>
        </div>
        <div class="promo-content">
          <h3>Malang Night Paradise Glow</h3>
          <p>Dapatkan cashback 15% dalam bentuk koin WisataKu untuk setiap pembelian tiket Malang Night Paradise.</p>
          <div class="promo-price"><span class="promo-price-new">Rp 90.000</span></div>
          <div class="promo-footer">
            <span class="promo-date">Hingga 05 Jul 2026</span>
            <a href="../user/wisata_buatan/MalangNightParadise.php" class="btn-claim">Gunakan Promo</a>
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
            <a href="https://www.instagram.com/da.ppin" class="social-icon"><img src="../assets/icon/instagram.svg" alt="Instagram" /></a>
            <a href="#" class="social-icon"><img src="../assets/icon/youtube.svg" alt="YouTube" /></a>
            <a href="#" class="social-icon"><img src="../assets/icon/twitter.svg" alt="Twitter" /></a>
            <a href="mailto:info@wisataku.id" class="social-icon"><img src="../assets/icon/gmail.svg" alt="Email" /></a>
          </div>
        </div>
        <div class="footer-col">
          <h4>Navigasi</h4>
          <ul>
            <li><a href="home.php">Beranda</a></li>
            <li><a href="promo.php">Promo &amp; Deals</a></li>
            <li><a href="../tentang.php">Tentang Kami</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Destinasi</h4>
          <ul>
            <li><a href="../user/wisata_alam/Bromo.php">Gunung Bromo</a></li>
            <li><a href="../user/wisata_alam/PantaiNgudel.php">Pantai Balekambang</a></li>
            <li><a href="../user/wisata_alam/TumpakSewu.php">Tumpak Sewu</a></li>
            <li><a href="../user/wisata_alam/RanuRegulo.php">Ranu Regulo</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Kontak</h4>
          <ul>
            <li><span class="contact-item"><img src="../assets/icon/mail-line.svg" alt="Email" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> info@wisataku.id</span></li>
            <li><span class="contact-item"><img src="../assets/icon/phone-line.svg" alt="Phone" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> +62 857 9287 4948</span></li>
            <li><span class="contact-item"><img src="../assets/icon/map-pin-line.svg" alt="Location" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> Malang, Jawa Timur</span></li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2025 WisataKu. Semua rights reserved.</p>
        <div class="footer-links">
          <a href="#">Kebijakan Privasi</a>
          <a href="#">Syarat &amp; Ketentuan</a>
        </div>
      </div>
    </div>
</footer>

  <script>
    const profileMenuButton = document.getElementById('profileMenuButton');
    const profileDropdown = document.getElementById('profileDropdown');

    if (profileMenuButton && profileDropdown) {
      profileMenuButton.addEventListener('click', (event) => {
        event.stopPropagation();
        const isOpen = profileDropdown.classList.toggle('show');
        profileMenuButton.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      });

      document.addEventListener('click', (event) => {
        if (!event.target.closest('.nav-right')) {
          profileDropdown.classList.remove('show');
          profileMenuButton.setAttribute('aria-expanded', 'false');
        }
      });
    }
  </script>

</body>
</html>
