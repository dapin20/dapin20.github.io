<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Jelajahi Keindahan Malang Raya</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="dashboard/home.css?v=2.0">
  <!-- Flatpickr CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css?v=2.0">
  <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css?v=2.0">
  <style>
*, *::before, *::after {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif !important;
}

input, button, select, textarea, optgroup, option {
  font-family: 'Poppins', sans-serif !important;
}


    /* Penyesuaian khusus untuk index (root) agar background tetap muncul */
    .hero {
          background: url('assets/images/background.png') center/cover no-repeat !important;
    }
  </style>
</head>
<body>

  <!-- ===== NAVBAR ===== -->
  <header class="navbar">
    <div class="container">
      <span class="logo">WisataKu</span>

      <ul class="nav-links">
        <li><a href="index.php" class="active">Home</a></li>
        <li><a href="dashboard/promo.php">Promo &amp; Deals</a></li>
        <li><a href="auth/login.php">Favorite</a></li>
        <li><a href="tentang.php">Tentang Kami</a></li>
      </ul>

      <div class="nav-right">
        <a href="auth/login.php" class="btn-outline">Masuk</a>
        <a href="auth/regrist.php" class="btn-outline" style="background: var(--blue-dark); color: white;">Daftar</a>
        <div class="hamburger" onclick="openMobileMenu()">
          <span></span><span></span><span></span>
        </div>
      </div>
    </div>
  </header>

  <!-- Mobile Nav -->
  <div class="mobile-nav" id="mobileNav">
    <div class="mobile-nav-overlay" onclick="closeMobileMenu()"></div>
    <div class="mobile-nav-panel">
      <a href="auth/login.php" onclick="closeMobileMenu()">Masuk</a>
      <a href="index.php" onclick="closeMobileMenu()">Home</a>
      <a href="dashboard/promo.php" onclick="closeMobileMenu()">Promo &amp; Deals</a>
      <a href="auth/login.php" onclick="closeMobileMenu()">Favorite</a>
      <a href="tentang.php" onclick="closeMobileMenu()">Tentang Kami</a>
    </div>
  </div>

  <!-- ===== HERO ===== -->
  <section class="hero">
    <div class="container">
      <div class="hero-content">
        <h1>Jelajahi Keindahan<br>Malang Raya</h1>
        <p>Temukan berbagai destinasi wisata menarik di area Malang dan sekitarnya. Perjalananmu dimulai dari sini!</p>
        <div class="hero-buttons">
          <a href="auth/login.php" class="btn-hero-primary">Pesan Tiket Sekarang</a>
          <a href="tentang.php" class="btn-hero-secondary">Tentang Kami</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== FLOATING SEARCH ===== -->
  <div class="search-float">
    <div class="search-field">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M17.657 16.657L22 21m-4.343-4.343A8 8 0 1 0 4.343 12.314a8 8 0 0 0 13.314 4.343z"/>
      </svg>
      <div>
        <label>Destinasi</label>
        <input type="text" placeholder="Mau ke mana?" />
      </div>
    </div>
    <div class="search-divider"></div>
    <div class="search-field">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
      </svg>
      <div>
        <label>Tanggal</label>
        <input type="text" id="indexDate" placeholder="Pilih tanggal" readonly />
      </div>
    </div>
    <div class="search-divider"></div>
    <div class="search-field">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
      </svg>
      <div>
        <label>Wisatawan</label>
        <input type="text" placeholder="Berapa orang?" />
      </div>
    </div>
    <button class="btn-search"><img src="assets/icon/search-line.svg" alt="Search" style="width: 18px; height: 18px; margin-right: 5px; display: inline-block;"/> Cari</button>
  </div>

  <!-- ===== DESTINASI POPULER (MAGAZINE STYLE) ===== -->
  <section class="section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Destinasi <span>Populer</span></h2>
        <a href="#" class="see-all">Lihat Semua →</a>
      </div>

      <div class="populer-magazine">
        <!-- Main large card -->
        <a href="auth/login.php" class="mag-card mag-main">
          <img src="assets/images/Bromo.png" alt="Gunung Bromo">
          <div class="mag-overlay"></div>
          <div class="mag-info">
            <span class="tag"><img src="assets/icon/map-pin-line2.svg" alt="Location" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> Probolinggo, Jawa Timur</span>
            <h3>Gunung Bromo</h3>
          </div>
        </a>

        <!-- Side 2x2 cards -->
        <div class="mag-side">
          <a href="auth/login.php" class="mag-card">
            <img src="assets/images/Kondang.png" alt="Pantai Balekambang">
            <div class="mag-overlay"></div>
            <div class="mag-info">
              <span class="tag"><img src="assets/icon/map-pin-line2.svg" alt="Location" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> Malang Selatan</span>
              <h3>Pantai Balekambang</h3>
            </div>
          </a>
          <a href="auth/login.php" class="mag-card">
            <img src="assets/images/Tumpak.png" alt="Tumpak Sewu">
            <div class="mag-overlay"></div>
            <div class="mag-info">
              <span class="tag"><img src="assets/icon/map-pin-line2.svg" alt="Location" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> Lumajang</span>
              <h3>Tumpak Sewu</h3>
            </div>
          </a>
          <a href="user/RanuRegulo.php" class="mag-card">
            <img src="assets/images/ranu_regulo.jpg" alt="Ranu Regulo">
            <div class="mag-overlay"></div>
            <div class="mag-info">
              <span class="tag"><img src="assets/icon/map-pin-line2.svg" alt="Location" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> Malang</span>
              <h3>Ranu Regulo</h3>
            </div>
          </a>
          <a href="user/GunungButhak.php" class="mag-card">
            <img src="assets/images/buthak.jpg" alt="Gunung Buthak">
            <div class="mag-overlay"></div>
            <div class="mag-info">
              <span class="tag"><img src="assets/icon/map-pin-line2.svg" alt="Location" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> Malang Kota</span>
              <h3>Gunung Buthak</h3>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== KATEGORI WISATA ===== -->
  <section class="kategori-section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Kategori <span>Wisata</span></h2>
      </div>
      <div class="kategori-chips">
        <a href="auth/login.php" class="chip-card">
          <div class="chip-icon">🏔</div>
          <div class="chip-label">Wisata Alam</div>
          <div class="chip-desc">Pesona alam indah di Malang Raya</div>
        </a>
        <a href="auth/login.php" class="chip-card">
          <div class="chip-icon">🎪</div>
          <div class="chip-label">Wisata Buatan</div>
          <div class="chip-desc">Wahana modern & hiburan keluarga</div>
        </a>
        <a href="auth/login.php" class="chip-card">
          <div class="chip-icon">🏛</div>
          <div class="chip-label">Wisata Edukasi</div>
          <div class="chip-desc">Belajar sambil berwisata</div>
        </a>
      </div>
    </div>
  </section>

  <!-- ===== DESTINASI DEKAT (SCROLL) ===== -->
  <section class="scroll-section" style="padding-top:60px;">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Destinasi <span>Dekat Anda</span></h2>
        <a href="#" class="see-all">Lihat Semua →</a>
      </div>
      <div class="scroll-wrapper">
        <button class="scroll-btn prev" onclick="scrollCards('near', -1)">‹</button>
        <div class="card-scroll" id="near">
          <a href="auth/login.php" class="hotel-card">
            <div class="hotel-img-wrap">
              <img src="assets/images/Bromo.png" alt="Gunung Bromo">
              <button class="wishlist-btn">
                <img src="assets/icon/save.svg" alt="Save" class="save-icon" />
              </button>
            </div>
            <div class="hotel-info">
              <h4>Gunung Bromo</h4>
              <div class="hotel-location"><img src="assets/icon/map-pin-line.svg" alt="Location" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> Probolinggo</div>
              <div class="hotel-meta">
                <div class="hotel-price">Rp 150.000 <span>/ orang</span></div>
                <div class="hotel-rating">★ 4.9</div>
              </div>
            </div>
          </a>
          <a href="user/RanuRegulo.php" class="hotel-card">
            <div class="hotel-img-wrap">
              <img src="assets/images/ranu_regulo.jpg" alt="Ranu Regulo">
              <button class="wishlist-btn">
                <img src="assets/icon/save.svg" alt="Save" class="save-icon" />
              </button>
            </div>
            <div class="hotel-info">
              <h4>Ranu Regulo</h4>
              <div class="hotel-location"><img src="assets/icon/map-pin-line.svg" alt="Location" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> Malang</div>
              <div class="hotel-meta">
                <div class="hotel-price">Rp 30.000 <span>/ orang</span></div>
                <div class="hotel-rating">★ 4.6</div>
              </div>
            </div>
          </a>
          <a href="user/GunungButhak.php" class="hotel-card">
            <div class="hotel-img-wrap">
              <img src="assets/images/buthak.jpg" alt="Gunung Buthak">
              <button class="wishlist-btn">
                <img src="assets/icon/save.svg" alt="Save" class="save-icon" />
              </button>
            </div>
            <div class="hotel-info">
              <h4>Gunung Buthak</h4>
              <div class="hotel-location"><img src="assets/icon/map-pin-line.svg" alt="Location" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> Malang</div>
              <div class="hotel-meta">
                <div class="hotel-price">Rp 50.000 <span>/ orang</span></div>
                <div class="hotel-rating">★ 4.8</div>
              </div>
            </div>
          </a>
          <a href="user/RanuKumbolo.php" class="hotel-card">
            <div class="hotel-img-wrap">
              <img src="assets/images/ranu_kumbolo.jpg" alt="Ranu Kumbolo">
              <button class="wishlist-btn">
                <img src="assets/icon/save.svg" alt="Save" class="save-icon" />
              </button>
            </div>
            <div class="hotel-info">
              <h4>Ranu Kumbolo</h4>
              <div class="hotel-location"><img src="assets/icon/map-pin-line.svg" alt="Location" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> Malang</div>
              <div class="hotel-meta">
                <div class="hotel-price">Rp 45.000 <span>/ orang</span></div>
                <div class="hotel-rating">★ 4.9</div>
              </div>
            </div>
          </a>
        </div>
        <button class="scroll-btn next" onclick="scrollCards('near', 1)">›</button>
      </div>
    </div>
  </section>

  <!-- ===== TESTIMONI ===== -->
  <section class="testi-section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Apa Kata <span>Mereka?</span></h2>
      </div>
      <div class="testi-grid">
        <div class="testi-card">
          <p>"Pengalaman berwisata di Malang sangat berkesan! Banyak tempat yang indah dan WisataKu membuatnya mudah."</p>
          <div class="testi-author">
            <div class="testi-avatar">A</div>
            <div>
              <div class="testi-name">Anjani</div>
              <div class="testi-from">Jakarta</div>
            </div>
          </div>
        </div>
        <div class="testi-card">
          <p>"Tempat wisatanya sangat lengkap dan mudah diakses dengan aplikasi ini. Sangat direkomendasikan!"</p>
          <div class="testi-author">
            <div class="testi-avatar">B</div>
            <div>
              <div class="testi-name">Bima</div>
              <div class="testi-from">Surabaya</div>
            </div>
          </div>
        </div>
        <div class="testi-card">
          <p>"Website-nya membantu sekali untuk merencanakan liburan keluarga kami. Antarmukanya juga sangat nyaman!"</p>
          <div class="testi-author">
            <div class="testi-avatar">N</div>
            <div>
              <div class="testi-name">Nita</div>
              <div class="testi-from">Sidoarjo</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== ABOUT BANNER ===== -->
  <div class="container">
    <div class="about-banner">
      <div class="about-banner-text">
        <h2>Tentang WisataKu</h2>
        <p>Platform pemesanan tiket wisata Malang Raya. Kami berkomitmen untuk memberikan kemudahan dalam menemukan dan memesan destinasi wisata terbaik di Malang.</p>
      </div>
      <div class="about-banner-action">
        <a href="#" class="btn-white">Pelajari Lebih Lanjut →</a>
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
            <a href="#" class="social-icon">
              <img src="assets/icon/instagram.svg" alt="Instagram" />
            </a>
            <a href="#" class="social-icon">
              <img src="assets/icon/youtube.svg" alt="Facebook" />
            </a>
            <a href="#" class="social-icon">
              <img src="assets/icon/twitter.svg" alt="Twitter" />
            </a>
            <a href="#" class="social-icon">
              <img src="assets/icon/gmail.svg" alt="Email" />
            </a>
          </div>
        </div>
        <div class="footer-col">
          <h4>Navigasi</h4>
          <ul>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="dashboard/promo.php">Promo &amp; Deals</a></li>
            <li><a href="auth/login.php">Favorite</a></li>
            <li><a href="tentang.php">Tentang Kami</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Destinasi</h4>
          <ul>
            <li><a href="user/Bromo.php">Gunung Bromo</a></li>
            <li><a href="user/PantaiNgudel.php">Pantai Balekambang</a></li>
            <li><a href="user/TumpakSewu.php">Tumpak Sewu</a></li>
            <li><a href="user/RanuRegulo.php">Ranu Regulo</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Kontak</h4>
          <ul>
            <li><span class="contact-item"><img src="assets/icon/mail-line.svg" alt="Email" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> info@wisataku.id</span></li>
            <li><span class="contact-item"><img src="assets/icon/phone-line.svg" alt="Phone" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> +62 857 9287 4948</span></li>
            <li><span class="contact-item"><img src="assets/icon/map-pin-2-fill.svg" alt="Location" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> Malang, Jawa Timur</span></li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <p>© 2025 WisataKu. All rights reserved.</p>
        <div class="footer-links">
          <a href="#">Kebijakan Privasi</a>
          <a href="#">Syarat &amp; Ketentuan</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Flatpickr JS -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    // Inisialisasi Flatpickr
    flatpickr("#indexDate", {
        altInput: true,
        altFormat: "j F Y",
        dateFormat: "Y-m-d",
        minDate: "today",
        disableMobile: "true"
    });

    function openMobileMenu() {
      document.getElementById('mobileNav').classList.add('open');
      document.body.style.overflow = 'hidden';
    }
    function closeMobileMenu() {
      document.getElementById('mobileNav').classList.remove('open');
      document.body.style.overflow = '';
    }

    function scrollCards(id, dir) {
      const el = document.getElementById(id);
      el.scrollBy({ left: dir * 250, behavior: 'smooth' });
    }

    // Wishlist toggle
    document.querySelectorAll('.wishlist-btn').forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        const img = this.querySelector('.save-icon');
        if (img) {
          const isSaved = img.src.includes('save_fill');
          img.src = isSaved ? 'assets/icon/save.svg' : 'assets/icon/save_fill.svg';
        }
      });
    });
  </script>

</body>
</html>