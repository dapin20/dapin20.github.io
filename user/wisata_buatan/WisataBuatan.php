<?php
session_start();
require_once('../../config/koneksi.php');
require_once('../../config/destination_helper.php');
require_once('../../config/category_page_helper.php');

$avatarSrc = '../../assets/images/dapin kecil.jpg';
$userId = $_SESSION['user_id'] ?? null;
$userType = $_SESSION['user_type'] ?? 'user';

if ($userId) {
    $table = ($userType === 'admin') ? 'admins' : 'users';
    $colCheck = $conn->query("SHOW COLUMNS FROM $table LIKE 'avatar'");
    if ($colCheck && $colCheck->num_rows > 0) {
        $stmt = $conn->prepare("SELECT avatar FROM $table WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($row = $res->fetch_assoc()) {
            if (!empty($row['avatar'])) {
                $avatarSrc = preg_match('/^https?:\/\//', $row['avatar']) ? $row['avatar'] : '../../' . ltrim($row['avatar'], '/');
            }
        }
        $stmt->close();
    }
}

$destinations = [
    ['id' => 'jatim-park-1', 'name' => 'Jatim Park 1', 'location' => 'Batu', 'price' => 100000, 'rating' => 4.8, 'image' => '../../assets/images/Edukasi.png', 'href' => 'JatimPark1.php'],
    ['id' => 'malang-night-paradise', 'name' => 'Malang Night Paradise', 'location' => 'Malang', 'price' => 90000, 'rating' => 4.6, 'image' => '../../assets/images/Buatan2.png', 'href' => 'MalangNightParadise.php'],
    ['id' => 'hawai-water-park', 'name' => 'Hawai Water Park', 'location' => 'Malang', 'price' => 100000, 'rating' => 4.8, 'image' => '../../assets/images/Buatan3.png', 'href' => 'Hawai.php'],
    ['id' => 'kesembon-park', 'name' => 'Kesembon Park', 'location' => 'Malang', 'price' => 50000, 'rating' => 4.8, 'image' => '../../assets/images/buatan4.png', 'href' => 'KesembonPark.php'],
    ['id' => 'fantasy-land', 'name' => 'Fantasy Land', 'location' => 'Malang', 'price' => 15000, 'rating' => 4.6, 'image' => '../../assets/images/buatan5.png', 'href' => 'FantasyLand.php'],
    ['id' => 'kampung-tridi', 'name' => 'Kampung Tridi', 'location' => 'Malang', 'price' => 5000, 'rating' => 4.8, 'image' => '../../assets/images/buatan6.png', 'href' => 'KampungTridi.php'],
    ['id' => 'selecta', 'name' => 'Taman Rekreasi Selecta', 'location' => 'Batu', 'price' => 40000, 'rating' => 4.6, 'image' => '../../assets/images/WisataBuatan.png', 'href' => 'Selecta.php'],
    ['id' => 'malang-skyland', 'name' => 'Malang Skyland', 'location' => 'Malang', 'price' => 35000, 'rating' => 4.6, 'image' => '../../assets/images/WIsata Buatan.png', 'href' => 'MalangSky.php'],
];

$destinations = category_page_destinations('wisata_buatan', $destinations, '../../');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <script src="../../assets/js/theme.js?v=3.4"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WisataKu - Wisata Buatan Malang Raya</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="WisataBuatan.css?v=2.2">
</head>
<body>
    <header class="navbar">
        <div class="container">
            <a href="../../dashboard/home.php" class="logo">WisataKu</a>
            <ul class="nav-links">
                <li><a href="../../dashboard/home.php">Home</a></li>
                <li><a href="../../dashboard/promo.php">Promo &amp; Deals</a></li>
                <li><a href="../../tentang.php">Tentang Kami</a></li>
            </ul>
            <div class="nav-right">
                <button class="profile-menu-button" type="button" id="profileMenuButton" aria-label="Menu profil" aria-expanded="false">
                    <img src="<?php echo htmlspecialchars($avatarSrc); ?>" alt="Profile" class="profile-icon">
                </button>
                <div class="profile-dropdown" id="profileDropdown">
                    <a href="../../user/profile.php">Profil Saya</a>
                    <a href="../../wishlist/whistlist.php">Favorite Saya</a>
                    <a href="../../auth/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h2>Wisata Buatan Malang Raya</h2>
            <p>Eksplorasi taman rekreasi, wahana air, dan destinasi hiburan populer.</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h2 class="section-title">Destinasi Populer</h2>
            <div class="grid-card">
                <?php foreach ($destinations as $destination): ?>
                    <?php
                    $favoriteImage = $destination['favorite_image'] ?? preg_replace('#^\.\./\.\./#', '../', $destination['image']);
                    $favoriteHref = $destination['favorite_href'] ?? ('../user/wisata_buatan/' . $destination['href']);
                    ?>
                    <article class="card">
                        <img src="<?php echo htmlspecialchars($destination['image']); ?>" alt="<?php echo htmlspecialchars($destination['name']); ?>">
                        <h3><?php echo htmlspecialchars($destination['name']); ?></h3>
                        <p class="rating">★ <?php echo number_format($destination['rating'], 1); ?></p>
                        <p>Rp <?php echo number_format($destination['price'], 0, ',', '.'); ?> / tiket</p>
                        <button class="buy-btn" type="button" onclick="location.href='<?php echo htmlspecialchars($destination['href']); ?>'">Beli Tiket</button>
                        <button
                            class="bookmark-icon"
                            type="button"
                            data-favorite-button
                            data-id="<?php echo htmlspecialchars($destination['id']); ?>"
                            data-name="<?php echo htmlspecialchars($destination['name']); ?>"
                            data-location="<?php echo htmlspecialchars($destination['location']); ?>"
                            data-price="<?php echo htmlspecialchars((string) $destination['price']); ?>"
                            data-rating="<?php echo htmlspecialchars((string) $destination['rating']); ?>"
                            data-image="<?php echo htmlspecialchars($favoriteImage); ?>"
                            data-href="<?php echo htmlspecialchars($favoriteHref); ?>"
                            data-category="Wisata Buatan"
                            data-icon-default="../../assets/icon/save.svg"
                            data-icon-active="../../assets/icon/save_fill.svg"
                            aria-label="Simpan ke favorite"
                            aria-pressed="false">
                            <img src="../../assets/icon/save.svg" alt="Favorite" class="save-icon">
                        </button>
                    </article>
                <?php endforeach; ?>
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
                        <a href="https://www.instagram.com/da.ppin" class="social-icon"><img src="../../assets/icon/instagram.svg" alt="Instagram" /></a>
                        <a href="#" class="social-icon"><img src="../../assets/icon/youtube.svg" alt="YouTube" /></a>
                        <a href="#" class="social-icon"><img src="../../assets/icon/twitter.svg" alt="Twitter" /></a>
                        <a href="mailto:info@wisataku.id" class="social-icon"><img src="../../assets/icon/gmail.svg" alt="Email" /></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h4>Navigasi</h4>
                    <ul>
                        <li><a href="../../dashboard/home.php">Beranda</a></li>
                        <li><a href="../../dashboard/promo.php">Promo &amp; Deals</a></li>
                        <li><a href="../../tentang.php">Tentang Kami</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Destinasi</h4>
                    <ul>
                        <li><a href="../../user/wisata_buatan/JatimPark1.php">Jatim Park 1</a></li>
                        <li><a href="../../user/wisata_buatan/Hawai.php">Hawai Water Park</a></li>
                        <li><a href="../../user/wisata_buatan/MalangNightParadise.php">Malang Night Paradise</a></li>
                        <li><a href="../../user/wisata_buatan/KampungTridi.php">Kampung Tridi</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Kontak</h4>
                    <ul>
                        <li><span class="contact-item"><img src="../../assets/icon/mail-line.svg" alt="Email" /> info@wisataku.id</span></li>
                        <li><span class="contact-item"><img src="../../assets/icon/phone-line.svg" alt="Phone" /> +62 857 9287 4948</span></li>
                        <li><span class="contact-item"><img src="../../assets/icon/map-pin-line.svg" alt="Location" /> Malang, Jawa Timur</span></li>
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

    <script src="../../assets/js/favorites.js"></script>
    <script>
        const profileMenuButton = document.getElementById('profileMenuButton');
        const profileDropdown = document.getElementById('profileDropdown');

        profileMenuButton && profileDropdown && profileMenuButton.addEventListener('click', function(event) {
            event.stopPropagation();
            const isOpen = profileDropdown.classList.toggle('show');
            profileMenuButton.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        document.addEventListener('click', function(event) {
            if (profileDropdown && profileMenuButton && !event.target.closest('.nav-right')) {
                profileDropdown.classList.remove('show');
                profileMenuButton.setAttribute('aria-expanded', 'false');
            }
        });
    </script>
</body>
</html>
