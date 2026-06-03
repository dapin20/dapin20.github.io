<?php
session_start();
require_once('config/koneksi.php');

$isLoggedIn = !empty($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$user_id = $_SESSION['user_id'] ?? null;
$user_type = $_SESSION['user_type'] ?? 'user';
$avatarSrc = 'assets/images/dapin kecil.jpg';

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
                $avatarSrc = $row['avatar'];
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
  <script src="assets/js/theme.js?v=3.4"></script>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Tentang Kami</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    *,
    *::before,
    *::after {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif !important;
    }

    :root {
      --blue-dark: #0157ad;
      --blue-mid: #1a6dc4;
      --blue-light: #4e9cff;
      --blue-pale: #e8f1fb;
      --ink: #07345f;
      --muted: #456b9a;
      --soft: #f4f7fc;
      --line: #e2eaf4;
      --white: #ffffff;
      --radius: 18px;
      --shadow: 0 14px 34px rgba(15, 35, 58, 0.10);
    }

    body {
      background: var(--soft);
      color: var(--ink);
      line-height: 1.6;
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    .container {
      width: 90%;
      max-width: 1200px;
      margin: 0 auto;
    }

    .navbar {
      background: var(--white);
      height: 64px;
      display: flex;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 1000;
      box-shadow: 0 2px 12px rgba(1, 87, 173, 0.07);
    }

    .navbar .container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 24px;
      position: relative;
    }

    .logo {
      font-size: 24px;
      font-weight: 800;
      background: linear-gradient(90deg, var(--blue-dark), var(--blue-light));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      letter-spacing: 0;
      white-space: nowrap;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 36px;
      list-style: none;
    }

    .nav-links a {
      font-size: 15px;
      font-weight: 600;
      color: var(--muted);
      transition: color 0.2s;
    }

    .nav-links a:hover,
    .nav-links a.active {
      color: var(--blue-dark);
    }

    .nav-right {
      position: relative;
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .profile-menu-button {
      border: 0;
      background: transparent;
      padding: 0;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
    }

    .profile-icon {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid var(--blue-light);
      display: block;
    }

    .profile-dropdown {
      position: absolute;
      top: calc(100% + 12px);
      right: 0;
      width: 170px;
      background: var(--white);
      border: 1px solid #dce7f5;
      border-radius: 10px;
      box-shadow: 0 14px 30px rgba(15, 35, 58, 0.12);
      padding: 8px;
      display: none;
      z-index: 1002;
    }

    .profile-dropdown.show {
      display: grid;
      gap: 4px;
    }

    .profile-dropdown a {
      color: var(--ink);
      font-size: 14px;
      font-weight: 600;
      padding: 10px 12px;
      border-radius: 8px;
    }

    .profile-dropdown a:hover {
      background: var(--blue-pale);
      color: var(--blue-dark);
    }

    .auth-actions {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .btn-outline,
    .btn-primary {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 10px 18px;
      border-radius: 12px;
      font-size: 14px;
      font-weight: 700;
      border: 1px solid var(--blue-dark);
    }

    .btn-outline {
      color: var(--blue-dark);
      background: var(--white);
    }

    .btn-primary {
      color: #fff;
      background: var(--blue-dark);
    }

    .hamburger {
      display: none;
      width: 40px;
      height: 40px;
      border: 0;
      background: transparent;
      cursor: pointer;
      padding: 8px;
    }

    .hamburger span {
      display: block;
      width: 22px;
      height: 2px;
      background: var(--blue-dark);
      margin: 5px 0;
      border-radius: 999px;
    }

    .hero {
      min-height: 470px;
      display: flex;
      align-items: end;
      color: #fff;
      background:
        linear-gradient(180deg, rgba(10, 26, 44, 0.08), rgba(10, 26, 44, 0.78)),
        url('assets/images/Bromo.png') center/cover no-repeat;
    }

    .hero-inner {
      width: 100%;
      padding: 120px 0 54px;
    }

    .hero h1 {
      max-width: 760px;
      font-size: 52px;
      line-height: 1.08;
      font-weight: 800;
      letter-spacing: 0;
      margin-bottom: 18px;
    }

    .hero p {
      max-width: 680px;
      color: rgba(255, 255, 255, 0.9);
      font-size: 17px;
    }

    .intro-band {
      background: var(--white);
      border-bottom: 1px solid var(--line);
    }

    .intro-grid {
      display: grid;
      grid-template-columns: minmax(0, 1.15fr) minmax(320px, 0.85fr);
      gap: 42px;
      align-items: center;
      padding: 64px 0;
    }

    .eyebrow {
      color: var(--blue-dark);
      font-size: 12px;
      font-weight: 800;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      margin-bottom: 12px;
    }

    .section-title {
      color: var(--ink);
      font-size: 34px;
      line-height: 1.18;
      font-weight: 800;
      margin-bottom: 18px;
      letter-spacing: 0;
    }

    .lead {
      color: var(--muted);
      font-size: 16px;
      line-height: 1.8;
      margin-bottom: 16px;
    }

    .intro-photo {
      width: 100%;
      aspect-ratio: 4 / 3;
      object-fit: cover;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
    }

    .stats-band {
      background: var(--blue-dark);
      color: #fff;
      padding: 36px 0;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 18px;
    }

    .stat-item {
      padding: 14px 0;
    }

    .stat-number {
      display: block;
      font-size: 34px;
      font-weight: 800;
      margin-bottom: 4px;
    }

    .stat-label {
      color: rgba(255, 255, 255, 0.78);
      font-size: 14px;
    }

    .values-section,
    .cta-section {
      padding: 66px 0;
    }

    .values-header,
    .cta-inner {
      max-width: 760px;
      margin-bottom: 30px;
    }

    .values-grid {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 18px;
    }

    .value-card {
      background: var(--white);
      border: 1px solid var(--line);
      border-radius: var(--radius);
      padding: 24px;
      box-shadow: 0 8px 22px rgba(15, 35, 58, 0.06);
    }

    .value-mark {
      width: 42px;
      height: 42px;
      border-radius: 12px;
      display: grid;
      place-items: center;
      color: #fff;
      font-weight: 800;
      margin-bottom: 18px;
    }

    .mark-blue { background: var(--blue-dark); }
    .mark-light { background: var(--blue-light); }
    .mark-mid { background: var(--blue-mid); }

    .value-card h3 {
      color: var(--ink);
      font-size: 18px;
      margin-bottom: 10px;
    }

    .value-card p {
      color: var(--muted);
      font-size: 14px;
      line-height: 1.7;
    }

    .cta-section {
      background:
        linear-gradient(90deg, rgba(1, 87, 173, 0.94), rgba(78, 156, 255, 0.84)),
        url('assets/images/Tumpak.png') center/cover no-repeat;
      color: #fff;
    }

    .cta-inner {
      margin-bottom: 0;
    }

    .cta-section .section-title,
    .cta-section .lead {
      color: #fff;
    }

    .cta-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      margin-top: 24px;
    }

    .cta-actions .btn-primary {
      background: #fff;
      color: var(--blue-dark);
      border-color: #fff;
    }

    .cta-actions .btn-outline {
      background: transparent;
      color: #fff;
      border-color: rgba(255, 255, 255, 0.72);
    }

    footer {
      background: #0f2135;
      color: #fff;
      padding: 44px 0 26px;
    }

    .footer-grid {
      display: grid;
      grid-template-columns: 1.3fr 0.8fr 0.9fr;
      gap: 34px;
    }

    .footer-title {
      font-size: 22px;
      font-weight: 800;
      margin-bottom: 12px;
    }

    .footer-copy,
    .footer-grid li {
      color: rgba(255, 255, 255, 0.72);
      font-size: 14px;
      line-height: 1.8;
    }

    .footer-grid h3 {
      font-size: 15px;
      margin-bottom: 14px;
    }

    .footer-grid ul {
      list-style: none;
      display: grid;
      gap: 8px;
    }

    .footer-grid a:hover {
      color: var(--blue-light);
    }

    .footer-bottom {
      border-top: 1px solid rgba(255, 255, 255, 0.12);
      margin-top: 32px;
      padding-top: 18px;
      color: rgba(255, 255, 255, 0.65);
      font-size: 13px;
      text-align: center;
    }

    @media (max-width: 900px) {
      .nav-links {
        display: none;
      }

      .hamburger {
        display: block;
      }

      .nav-links.open {
        position: absolute;
        top: 52px;
        left: 0;
        right: 0;
        display: grid;
        gap: 0;
        background: var(--white);
        border: 1px solid var(--line);
        border-radius: 0 0 14px 14px;
        box-shadow: var(--shadow);
        overflow: hidden;
      }

      .nav-links.open a {
        display: block;
        padding: 14px 18px;
        border-bottom: 1px solid var(--line);
      }

      .hero h1 {
        font-size: 38px;
      }

      .intro-grid,
      .footer-grid {
        grid-template-columns: 1fr;
      }

      .stats-grid,
      .values-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }
    }

    @media (max-width: 560px) {
      .auth-actions {
        display: none;
      }

      .hero {
        min-height: 390px;
      }

      .hero h1 {
        font-size: 31px;
      }

      .section-title {
        font-size: 27px;
      }

      .stats-grid,
      .values-grid {
        grid-template-columns: 1fr;
      }
    }

    /* Footer mengikuti tampilan Home */
    footer {
      background: var(--blue-dark) !important;
      color: #fff !important;
      padding: 56px 0 24px !important;
    }

    .footer-top {
      display: grid;
      grid-template-columns: 1.8fr 1fr 1fr 1fr;
      gap: 40px;
      margin-bottom: 48px;
    }

    .footer-brand .logo-footer {
      font-size: 22px;
      font-weight: 800;
      color: #fff;
      margin-bottom: 12px;
      display: block;
    }

    .footer-brand p {
      max-width: 430px;
      font-size: 13px;
      color: rgba(255,255,255,0.7);
      line-height: 1.7;
      margin: 0 0 20px;
    }

    .social-icons {
      display: flex;
      gap: 10px;
    }

    .social-icon {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      background: rgba(255,255,255,0.12);
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.2s;
    }

    .social-icon:hover {
      background: rgba(255,255,255,0.25);
    }

    .social-icon img {
      width: 24px;
      height: 24px;
      object-fit: contain;
    }

    .footer-col h4 {
      font-size: 14px;
      font-weight: 700;
      margin: 0 0 16px;
      color: #fff;
    }

    .footer-col ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .footer-col li {
      margin-bottom: 10px;
    }

    .footer-col a,
    .footer-col .contact-item {
      color: rgba(255,255,255,0.7);
      font-size: 13px;
      transition: color 0.2s;
    }

    .footer-col a:hover {
      color: #fff;
    }

    .footer-col .contact-item {
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }

    .footer-col .contact-item img {
      width: 16px;
      height: 16px;
      object-fit: contain;
    }

    .footer-bottom {
      border-top: 1px solid rgba(255,255,255,0.12) !important;
      padding-top: 24px !important;
      display: flex !important;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 8px;
      text-align: left !important;
      color: rgba(255,255,255,0.55);
      margin-top: 0;
    }

    .footer-bottom p {
      margin: 0;
      font-size: 13px;
    }

    .footer-links {
      display: flex;
      gap: 20px;
    }

    .footer-links a {
      font-size: 13px;
      color: rgba(255,255,255,0.55);
    }

    .footer-links a:hover {
      color: #fff;
    }

    @media (max-width: 900px) {
      .footer-top {
        grid-template-columns: 1fr 1fr;
        gap: 28px;
      }
    }

    @media (max-width: 600px) {
      .footer-top {
        grid-template-columns: 1fr;
      }

      .footer-bottom {
        flex-direction: column;
        align-items: flex-start;
      }
    }
  </style>
</head>
<body>
  <header class="navbar">
    <div class="container">
      <a href="dashboard/home.php" class="logo">WisataKu</a>

      <ul class="nav-links" id="navLinks">
        <li><a href="dashboard/home.php">Home</a></li>
        <li><a href="dashboard/promo.php">Promo &amp; Deals</a></li>
        <li><a href="tentang.php" class="active">Tentang Kami</a></li>
      </ul>

      <div class="nav-right">
        <?php if ($isLoggedIn): ?>
          <button class="profile-menu-button" type="button" id="profileMenuButton" aria-label="Menu profil" aria-expanded="false">
            <img src="<?php echo htmlspecialchars($avatarSrc); ?>" alt="Profile" class="profile-icon">
          </button>
          <div class="profile-dropdown" id="profileDropdown">
            <a href="user/profile.php">Profil Saya</a>
            <a href="wishlist/whistlist.php">Favorite Saya</a>
            <a href="auth/logout.php">Logout</a>
          </div>
        <?php else: ?>
          <div class="auth-actions">
            <a href="auth/login.php" class="btn-outline">Masuk</a>
            <a href="auth/regrist.php" class="btn-primary">Daftar</a>
          </div>
        <?php endif; ?>
        <button class="hamburger" type="button" id="hamburger" aria-label="Menu navigasi">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>
    </div>
  </header>

  <section class="hero">
    <div class="container hero-inner">
      <h1>Wisata Malang lebih mudah dipesan.</h1>
      <p>Temukan destinasi, pilih tanggal, dan pesan tiket dalam satu tempat.</p>
    </div>
  </section>

  <section class="intro-band">
    <div class="container intro-grid">
      <div>
        <p class="eyebrow">Tentang WisataKu</p>
        <h2 class="section-title">Platform pemesanan tiket wisata Malang Raya.</h2>
        <p class="lead">WisataKu membantu pengunjung melihat destinasi, harga, tanggal kunjungan, dan status pesanan dengan jelas.</p>
      </div>
      <img class="intro-photo" src="assets/images/Tumpak.png" alt="Air terjun Tumpak Sewu">
    </div>
  </section>

  <section class="stats-band">
    <div class="container stats-grid">
      <div class="stat-item">
        <span class="stat-number">50+</span>
        <span class="stat-label">Destinasi wisata</span>
      </div>
      <div class="stat-item">
        <span class="stat-number">3</span>
        <span class="stat-label">Kategori wisata</span>
      </div>
      <div class="stat-item">
        <span class="stat-number">24/7</span>
        <span class="stat-label">Akses pemesanan</span>
      </div>
      <div class="stat-item">
        <span class="stat-number">4.8</span>
        <span class="stat-label">Rata-rata rating destinasi</span>
      </div>
    </div>
  </section>

  <section class="values-section">
    <div class="container">
      <div class="values-header">
        <p class="eyebrow">Layanan</p>
        <h2 class="section-title">Ringkas, jelas, dan mudah digunakan.</h2>
      </div>
      <div class="values-grid">
        <article class="value-card">
          <div class="value-mark mark-blue">1</div>
          <h3>Transparan</h3>
          <p>Harga dan detail tiket terlihat sejak awal.</p>
        </article>
        <article class="value-card">
          <div class="value-mark mark-light">2</div>
          <h3>Terpantau</h3>
          <p>Status pembayaran bisa dicek dengan mudah.</p>
        </article>
        <article class="value-card">
          <div class="value-mark mark-mid">3</div>
          <h3>Praktis</h3>
          <p>Pilih destinasi, tanggal, dan jumlah tiket langsung dari web.</p>
        </article>
      </div>
    </div>
  </section>

  <section class="cta-section">
    <div class="container">
      <div class="cta-inner">
        <p class="eyebrow">Mulai jelajah</p>
        <h2 class="section-title">Cari destinasi favoritmu.</h2>
        <p class="lead">Lihat rekomendasi dan promo terbaru di WisataKu.</p>
        <div class="cta-actions">
          <a href="dashboard/home.php" class="btn-primary">Lihat Destinasi</a>
          <a href="dashboard/promo.php" class="btn-outline">Lihat Promo</a>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div class="container">
      <div class="footer-top">
        <div class="footer-brand">
          <span class="logo-footer">WisataKu</span>
          <p>Platform booking tiket wisata terpercaya di Malang Raya, dari destinasi alam hingga wisata edukasi.</p>
          <div class="social-icons">
            <a href="https://www.instagram.com/da.ppin" class="social-icon"><img src="assets/icon/instagram.svg" alt="Instagram" /></a>
            <a href="#" class="social-icon"><img src="assets/icon/youtube.svg" alt="YouTube" /></a>
            <a href="#" class="social-icon"><img src="assets/icon/twitter.svg" alt="Twitter" /></a>
            <a href="mailto:info@wisataku.id" class="social-icon"><img src="assets/icon/gmail.svg" alt="Email" /></a>
          </div>
        </div>
        <div class="footer-col">
          <h4>Navigasi</h4>
          <ul>
            <li><a href="dashboard/home.php">Beranda</a></li>
            <li><a href="dashboard/promo.php">Promo &amp; Deals</a></li>
            <li><a href="tentang.php">Tentang Kami</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Destinasi</h4>
          <ul>
            <li><a href="user/wisata_alam/Bromo.php">Gunung Bromo</a></li>
            <li><a href="user/wisata_alam/PantaiNgudel.php">Pantai Ngudel</a></li>
            <li><a href="user/wisata_alam/TumpakSewu.php">Tumpak Sewu</a></li>
            <li><a href="user/wisata_edukasi/EcoGreenPark.php">Eco Green Park</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Kontak</h4>
          <ul>
            <li><span class="contact-item"><img src="assets/icon/mail-line.svg" alt="Email" /> info@wisataku.id</span></li>
            <li><span class="contact-item"><img src="assets/icon/phone-line.svg" alt="Phone" /> +62 857 9287 4948</span></li>
            <li><span class="contact-item"><img src="assets/icon/map-pin-line.svg" alt="Location" /> Malang, Jawa Timur</span></li>
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
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.getElementById('navLinks');
    const profileMenuButton = document.getElementById('profileMenuButton');
    const profileDropdown = document.getElementById('profileDropdown');

    hamburger && hamburger.addEventListener('click', function(event) {
      event.stopPropagation();
      navLinks.classList.toggle('open');
    });

    profileMenuButton && profileDropdown && profileMenuButton.addEventListener('click', function(event) {
      event.stopPropagation();
      const isOpen = profileDropdown.classList.toggle('show');
      profileMenuButton.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    document.addEventListener('click', function(event) {
      if (!event.target.closest('.navbar')) {
        navLinks.classList.remove('open');
      }

      if (profileDropdown && profileMenuButton && !event.target.closest('.nav-right')) {
        profileDropdown.classList.remove('show');
        profileMenuButton.setAttribute('aria-expanded', 'false');
      }
    });
  </script>
</body>
</html>
