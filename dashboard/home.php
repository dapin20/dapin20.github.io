<?php
session_start();
require_once('../config/auth_helper.php');
require_once('../config/destination_helper.php');
require_once('../config/koneksi.php');

$user_id = $_SESSION['user_id'] ?? null;
$user_type = $_SESSION['user_type'] ?? 'user';
$avatarSrc = '../assets/images/dapin kecil.jpg';

if ($user_id) {
    $table = ($user_type === 'admin') ? 'admins' : 'users';
    $hasAvatar = false;
    $colCheck = $conn->query("SHOW COLUMNS FROM $table LIKE 'avatar'");
    if ($colCheck && $colCheck->num_rows > 0) {
      $hasAvatar = true;
    }
    if ($hasAvatar) {
      $stmt = $conn->prepare("SELECT avatar FROM $table WHERE id = ?");
      $stmt->bind_param("i", $user_id);
      $stmt->execute();
      $res = $stmt->get_result();
      if ($row = $res->fetch_assoc()) {
        if (!empty($row['avatar'])) {
          $avatarSrc = '../' . $row['avatar'];
          $_SESSION['avatar'] = $row['avatar']; // Sync session
        }
      }
      $stmt->close();
    }
}

$destinations = load_destinations();
$popularDestinations = array_slice(destination_filter($destinations, 'popular'), 0, 5);
$nearDestinations = array_slice(destination_filter($destinations, 'near'), 0, 8);
$recommendedDestinations = array_slice(destination_filter($destinations, 'recommended'), 0, 8);

if (count($popularDestinations) < 5) {
    $popularDestinations = array_slice($destinations, 0, 5);
}

if (count($nearDestinations) === 0) {
    $nearDestinations = array_slice($destinations, 0, 8);
}

if (count($recommendedDestinations) === 0) {
    $recommendedDestinations = array_slice($destinations, 0, 8);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Jelajahi Keindahan Malang Raya</title>
  <script src="../assets/js/theme.js?v=3.4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="home.css?v=2.1">
  <!-- Flatpickr CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css?v=2.0">
  <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css?v=2.0">
</head>
<body>

  <!-- ===== NAVBAR ===== -->
  <header class="navbar">
    <div class="container">
      <div class="logo">WisataKu</div>

      <ul class="nav-links">
        <li><a href="home.php" class="active">Home</a></li>
        <li><a href="promo.php">Promo &amp; Deals</a></li>
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
      <a href="../user/profile.php" onclick="closeMobileMenu()">Profil</a>
      <a href="home.php" onclick="closeMobileMenu()">Home</a>
      <a href="#" onclick="closeMobileMenu()">Promo &amp; Deals</a>
      <a href="../tentang.php" onclick="closeMobileMenu()">Tentang Kami</a>
    </div>
  </div>

  <!-- ===== HERO ===== -->
  <section class="hero">
    <div class="container">
      <div class="hero-content">
        <h1>Jelajahi Keindahan<br>Malang Raya</h1>
        <p>Temukan berbagai destinasi wisata menarik di area Malang dan sekitarnya. Perjalananmu dimulai dari sini!</p>
        <div class="hero-buttons">
          <a href="#wisata-terdekat" class="btn-hero-primary" id="heroOrderButton">Pesan Tiket Sekarang</a>
          <a href="../tentang.php" class="btn-hero-secondary">Tentang Kami</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== FLOATING SEARCH ===== -->
  <div class="search-float">
    <div class="search-field search-destination-wrap">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path d="M17.657 16.657L22 21m-4.343-4.343A8 8 0 1 0 4.343 12.314a8 8 0 0 0 13.314 4.343z"/>
      </svg>
      <div>
        <label>Destinasi</label>
        <input type="text" id="destinationSearch" placeholder="Mau ke mana?" autocomplete="off" />
      </div>
    </div>
    <div class="search-divider"></div>
    <div class="search-field">
      <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
      </svg>
      <div>
        <label>Tanggal</label>
        <input type="text" id="homeDate" placeholder="Pilih tanggal" readonly />
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
    <button class="btn-search" id="destinationSearchButton"><img src="../assets/icon/search-line.svg" alt="Search" style="width: 18px; height: 18px; margin-right: 5px; display: inline-block;"/> Cari</button>
    <div class="search-suggestions" id="destinationSuggestions"></div>
  </div>

  <!-- ===== DESTINASI POPULER ===== -->
  <section class="section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Destinasi <span>Populer</span></h2>
        <a href="../user/wisata_alam/WisataAlam.php" class="see-all">Lihat Semua →</a>
      </div>

      <?php if (!empty($popularDestinations)): ?>
      <div class="populer-magazine">
        <?php $mainPopular = $popularDestinations[0]; ?>
        <a href="../<?php echo htmlspecialchars($mainPopular['href']); ?>" class="mag-card mag-main">
          <img src="../<?php echo htmlspecialchars($mainPopular['image']); ?>" alt="<?php echo htmlspecialchars($mainPopular['name']); ?>">
          <div class="mag-overlay"></div>
          <div class="mag-info">
            <span class="tag"><img src="../assets/icon/map-pin-line2.svg" alt="Location" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> <?php echo htmlspecialchars($mainPopular['location']); ?></span>
            <h3><?php echo htmlspecialchars($mainPopular['name']); ?></h3>
          </div>
        </a>

        <div class="mag-side">
          <?php foreach (array_slice($popularDestinations, 1, 4) as $destination): ?>
          <a href="../<?php echo htmlspecialchars($destination['href']); ?>" class="mag-card">
            <img src="../<?php echo htmlspecialchars($destination['image']); ?>" alt="<?php echo htmlspecialchars($destination['name']); ?>">
            <div class="mag-overlay"></div>
            <div class="mag-info">
              <span class="tag"><img src="../assets/icon/map-pin-line2.svg" alt="Location" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> <?php echo htmlspecialchars($destination['location']); ?></span>
              <h3><?php echo htmlspecialchars($destination['name']); ?></h3>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- ===== KATEGORI WISATA ===== -->
  <section class="kategori-section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Kategori <span>Wisata</span></h2>
      </div>
      <div class="kategori-chips">
        <a href="../user/wisata_alam/WisataAlam.php" class="chip-card">
          <div class="chip-icon">🏔</div>
          <div class="chip-label">Wisata Alam</div>
          <div class="chip-desc">Pesona alam indah di Malang Raya</div>
        </a>
        <a href="../user/wisata_buatan/WisataBuatan.php" class="chip-card">
          <div class="chip-icon">🎪</div>
          <div class="chip-label">Wisata Buatan</div>
          <div class="chip-desc">Wahana modern & hiburan keluarga</div>
        </a>
        <a href="../user/wisata_edukasi/WisataEdukasi.php" class="chip-card">
          <div class="chip-icon">🏛</div>
          <div class="chip-label">Wisata Edukasi</div>
          <div class="chip-desc">Belajar sambil berwisata</div>
        </a>
      </div>
    </div>
  </section>

  <!-- ===== DESTINASI DEKAT ===== -->
  <section class="scroll-section" id="wisata-terdekat" style="padding-top:60px;">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Destinasi <span>Dekat Anda</span></h2>
        <a href="../user/wisata_alam/WisataAlam.php" class="see-all">Lihat Semua →</a>
      </div>
      <div class="scroll-wrapper">
        <button class="scroll-btn prev" onclick="scrollCards('near', -1)">‹</button>
        <div class="card-scroll" id="near">
          <?php foreach ($nearDestinations as $destination): ?>
          <a href="../<?php echo htmlspecialchars($destination['href']); ?>" class="hotel-card">
            <div class="hotel-img-wrap">
              <img src="../<?php echo htmlspecialchars($destination['image']); ?>" alt="<?php echo htmlspecialchars($destination['name']); ?>">
              <button
                class="wishlist-btn"
                type="button"
                data-favorite-button
                data-id="<?php echo htmlspecialchars($destination['id'], ENT_QUOTES); ?>"
                data-name="<?php echo htmlspecialchars($destination['name'], ENT_QUOTES); ?>"
                data-location="<?php echo htmlspecialchars($destination['location'], ENT_QUOTES); ?>"
                data-price="<?php echo (int) $destination['price']; ?>"
                data-rating="<?php echo htmlspecialchars((string) $destination['rating'], ENT_QUOTES); ?>"
                data-image="../<?php echo htmlspecialchars($destination['image'], ENT_QUOTES); ?>"
                data-href="../<?php echo htmlspecialchars($destination['href'], ENT_QUOTES); ?>"
                data-category="<?php echo htmlspecialchars($destination['category'], ENT_QUOTES); ?>"
                data-icon-default="../assets/icon/save.svg"
                data-icon-active="../assets/icon/save_fill.svg"
                aria-label="Simpan ke favorite"
                aria-pressed="false"
              >
                <img src="../assets/icon/save.svg" alt="Favorite" class="save-icon" />
              </button>
            </div>
            <div class="hotel-info">
              <h4><?php echo htmlspecialchars($destination['name']); ?></h4>
              <div class="hotel-location"><img src="../assets/icon/map-pin-line.svg" alt="Location" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> <?php echo htmlspecialchars($destination['location']); ?></div>
              <div class="hotel-meta">
                <div class="hotel-price"><?php echo htmlspecialchars(destination_price_label($destination['price'])); ?> <span>/ orang</span></div>
                <div class="hotel-rating">★ <?php echo htmlspecialchars(number_format($destination['rating'], 1)); ?></div>
              </div>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
        <button class="scroll-btn next" onclick="scrollCards('near', 1)">›</button>
      </div>
    </div>
  </section>

  <!-- ===== REKOMENDASI ===== -->
  <section class="scroll-section" id="rekomendasi">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">Rekomendasi <span>Untukmu</span></h2>
        <a href="../user/wisata_alam/WisataAlam.php" class="see-all">Lihat Semua →</a>
      </div>
      <div class="scroll-wrapper">
        <button class="scroll-btn prev" onclick="scrollCards('reko', -1)">‹</button>
        <div class="card-scroll" id="reko">
          <?php foreach ($recommendedDestinations as $destination): ?>
          <a href="../<?php echo htmlspecialchars($destination['href']); ?>" class="hotel-card">
            <div class="hotel-img-wrap">
              <img src="../<?php echo htmlspecialchars($destination['image']); ?>" alt="<?php echo htmlspecialchars($destination['name']); ?>">
              <button
                class="wishlist-btn"
                type="button"
                data-favorite-button
                data-id="<?php echo htmlspecialchars($destination['id'], ENT_QUOTES); ?>"
                data-name="<?php echo htmlspecialchars($destination['name'], ENT_QUOTES); ?>"
                data-location="<?php echo htmlspecialchars($destination['location'], ENT_QUOTES); ?>"
                data-price="<?php echo (int) $destination['price']; ?>"
                data-rating="<?php echo htmlspecialchars((string) $destination['rating'], ENT_QUOTES); ?>"
                data-image="../<?php echo htmlspecialchars($destination['image'], ENT_QUOTES); ?>"
                data-href="../<?php echo htmlspecialchars($destination['href'], ENT_QUOTES); ?>"
                data-category="<?php echo htmlspecialchars($destination['category'], ENT_QUOTES); ?>"
                data-icon-default="../assets/icon/save.svg"
                data-icon-active="../assets/icon/save_fill.svg"
                aria-label="Simpan ke favorite"
                aria-pressed="false"
              >
                <img src="../assets/icon/save.svg" alt="Favorite" class="save-icon" />
              </button>
            </div>
            <div class="hotel-info">
              <h4><?php echo htmlspecialchars($destination['name']); ?></h4>
              <div class="hotel-location"><img src="../assets/icon/map-pin-line.svg" alt="Location" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> <?php echo htmlspecialchars($destination['location']); ?></div>
              <div class="hotel-meta">
                <div class="hotel-price"><?php echo htmlspecialchars(destination_price_label($destination['price'])); ?> <span>/ orang</span></div>
                <div class="hotel-rating">★ <?php echo htmlspecialchars(number_format($destination['rating'], 1)); ?></div>
              </div>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
        <button class="scroll-btn next" onclick="scrollCards('reko', 1)">›</button>
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
        <a href="../tentang.php" class="btn-white">Pelajari Lebih Lanjut →</a>
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
            <a href="https://www.instagram.com/da.ppin" class="social-icon">
              <img src="../assets/icon/instagram.svg" alt="Instagram" />
            </a>
            <a href="#" class="social-icon">
              <img src="../assets/icon/youtube.svg" alt="Facebook" />
            </a>
            <a href="#" class="social-icon">
              <img src="../assets/icon/twitter.svg" alt="Twitter" />
            </a>
            <a href="davinadityasaputra20@gmail.com" class="social-icon">
              <img src="../assets/icon/gmail.svg" alt="Email" />
            </a>
          </div>
        </div>
        <div class="footer-col">
          <h4>Navigasi</h4>
          <ul>
            <li><a href="../dashboard/home.php">Beranda</a></li>
            <li><a href="#">Promo &amp; Deals</a></li>
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
  <script src="../assets/js/favorites.js"></script>
  <script>
    // Global Date Picker for Home
    flatpickr("#homeDate", {
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

    const destinationSearch = document.getElementById('destinationSearch');
    const destinationSuggestions = document.getElementById('destinationSuggestions');
    const destinationSearchButton = document.getElementById('destinationSearchButton');
    let selectedDestination = null;
    let searchTimer = null;

    function priceLabel(value) {
      return 'Rp ' + Number(value || 0).toLocaleString('id-ID');
    }

    function closeSuggestions() {
      destinationSuggestions.innerHTML = '';
      destinationSuggestions.classList.remove('show');
    }

    function openDestination(destination) {
      if (!destination) return;
      window.location.href = '../' + destination.href.replace(/^\/+/, '');
    }

    function renderSuggestions(items) {
      destinationSuggestions.innerHTML = '';

      if (!items.length) {
        destinationSuggestions.innerHTML = '<div class="search-empty">Wisata tidak ditemukan</div>';
        destinationSuggestions.classList.add('show');
        return;
      }

      items.forEach((item) => {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'search-suggestion-card';
        button.innerHTML = `
          <img src="../${item.image}" alt="${item.name}">
          <span class="search-card-info">
            <strong>${item.name}</strong>
            <small>${item.location} • ${priceLabel(item.price)}</small>
          </span>
        `;
        button.addEventListener('click', () => openDestination(item));
        destinationSuggestions.appendChild(button);
      });

      destinationSuggestions.classList.add('show');
    }

    let isSuggestionDragging = false;
    let suggestionDragStarted = false;
    let suggestionStartX = 0;
    let suggestionScrollLeft = 0;

    destinationSuggestions.addEventListener('pointerdown', (event) => {
      if (!destinationSuggestions.classList.contains('show')) return;
      isSuggestionDragging = true;
      suggestionDragStarted = false;
      suggestionStartX = event.clientX;
      suggestionScrollLeft = destinationSuggestions.scrollLeft;
      destinationSuggestions.classList.add('dragging');
      destinationSuggestions.setPointerCapture(event.pointerId);
    });

    destinationSuggestions.addEventListener('pointermove', (event) => {
      if (!isSuggestionDragging) return;
      const distance = event.clientX - suggestionStartX;

      if (Math.abs(distance) > 6) {
        suggestionDragStarted = true;
      }

      destinationSuggestions.scrollLeft = suggestionScrollLeft - distance;
    });

    function stopSuggestionDrag(event) {
      if (!isSuggestionDragging) return;
      isSuggestionDragging = false;
      destinationSuggestions.classList.remove('dragging');

      if (destinationSuggestions.hasPointerCapture(event.pointerId)) {
        destinationSuggestions.releasePointerCapture(event.pointerId);
      }
    }

    destinationSuggestions.addEventListener('pointerup', stopSuggestionDrag);
    destinationSuggestions.addEventListener('pointercancel', stopSuggestionDrag);

    destinationSuggestions.addEventListener('click', (event) => {
      if (!suggestionDragStarted) return;
      event.preventDefault();
      event.stopPropagation();
      suggestionDragStarted = false;
    }, true);

    async function fetchDestinations(query) {
      const response = await fetch('../api/search_destinations.php?q=' + encodeURIComponent(query));
      if (!response.ok) return [];
      return response.json();
    }

    destinationSearch.addEventListener('input', () => {
      const query = destinationSearch.value.trim();
      selectedDestination = null;
      clearTimeout(searchTimer);

      if (query.length === 0) {
        closeSuggestions();
        return;
      }

      searchTimer = setTimeout(async () => {
        const items = await fetchDestinations(query);
        selectedDestination = items[0] || null;
        renderSuggestions(items);
      }, 180);
    });

    destinationSearch.addEventListener('keydown', (event) => {
      if (event.key === 'Enter') {
        event.preventDefault();
        openDestination(selectedDestination);
      }
    });

    destinationSearchButton.addEventListener('click', async () => {
      const query = destinationSearch.value.trim();
      if (!query) return;
      if (!selectedDestination) {
        const items = await fetchDestinations(query);
        selectedDestination = items[0] || null;
      }
      openDestination(selectedDestination);
    });

    document.addEventListener('click', (event) => {
      if (!event.target.closest('.search-float')) {
        closeSuggestions();
      }
    });

    const profileMenuButton = document.getElementById('profileMenuButton');
    const profileDropdown = document.getElementById('profileDropdown');

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

    const heroOrderButton = document.getElementById('heroOrderButton');
    const nearbySection = document.getElementById('wisata-terdekat');

    if (heroOrderButton && nearbySection) {
      heroOrderButton.addEventListener('click', (event) => {
        event.preventDefault();
        const navbarHeight = document.querySelector('.navbar')?.offsetHeight || 0;
        const targetTop = nearbySection.getBoundingClientRect().top + window.pageYOffset - navbarHeight - 16;
        window.scrollTo({
          top: targetTop,
          behavior: 'smooth'
        });
      });
    }

  </script>

</body>
</html>
