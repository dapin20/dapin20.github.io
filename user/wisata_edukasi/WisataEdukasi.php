<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WisataKu - Wisata Edukasi Malang Raya</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="WisataEdukasi.css?v=2.0">
</head>
<body>

    <!-- ===== NAVBAR (Standardized) ===== -->
    <header class="navbar">
        <div class="container">
            <a href="../../dashboard/home.php" class="logo">WisataKu</a>

            <ul class="nav-links">
                <li><a href="../../dashboard/home.php">Home</a></li>
                <li><a href="#">Promo</a></li>
                <li><a href="../../wishlist/whistlist.php">Favorite</a></li>
                <li><a href="../../tentang.php">Tentang Kami</a></li>
            </ul>

            <div class="nav-right">
                <a href="../../user/profile.php">
                    <img src="../../assets/images/dapin kecil.jpg" alt="Profile" class="profile-icon">
                </a>
            </div>
        </div>
    </header>

<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <h2>Wisata Edukasi Malang Raya</h2>
        <p>Eksplorasi seru di Eco Green Park, Predator Fun Park, Batu Secret Zoo, dan destinasi alam populer lainnya di Malang Raya.</p>
    </div>
</section>

<!-- DESTINASI POPULER -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Destinasi Populer</h2>

        <div class="grid-card">

            <!-- CARD 1 -->
            <div class="card">
                <img src="https://i.pinimg.com/736x/39/fc/1c/39fc1c4b828e4b116dc09d82f590219c.jpg" alt="">
                <h3>Eco Green Park</h3>
                <p class="rating">⭐ 4.8</p>
                <p>Rp 65.000–170.000 / tiket</p>
                 <button class="buy-btn" onclick="location.href='EcoGreenPark.php'">Beli Tiket</button>
                 <div class="bookmark-icon saved" onclick="toggleBookmark(this)">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z"/>
                    </svg>
                </div>
            </div>

            <!-- CARD 2 -->
            <div class="card">
                <img src="../../assets/images/Edukasi.png" alt="Predator Fun Park">
                <h3>Predator Fun Park</h3>
                <p class="rating">⭐ 4.6</p>
                <p>Rp 50.000 / orang</p>
                 <button class="buy-btn" onclick="location.href='PredatorFunPark.php'">Beli Tiket</button>
                 <div class="bookmark-icon saved" onclick="toggleBookmark(this)">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z"/>
                    </svg>
                </div>
            </div>

            <!-- CARD 3 -->
            <div class="card">
                <img src="https://i.pinimg.com/736x/65/91/7f/65917fe94e54b7afa39ddc85d868a9a6.jpg" alt="">
                <h3>Museum Mpu Purwa</h3>
                <p class="rating">⭐ 4.8</p>
                <p>Rp 10.000 / tiket</p>
                 <button class="buy-btn" onclick="location.href='MuseumMpuPurwa.php'">Beli Tiket</button>
                 <div class="bookmark-icon saved" onclick="toggleBookmark(this)">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z"/>
                    </svg>
                </div>
            </div>

            <!-- CARD 4 -->
            <div class="card">
                <img src="https://i.pinimg.com/1200x/23/48/83/2348832180a88e989ed04f3f24faa9f5.jpg" alt="">
                <h3>Batu Secret Zoo</h3>
                <p class="rating">⭐ 4.8</p>
                <p>Rp 120.000 / tiket</p>
                 <button class="buy-btn" onclick="location.href='BatuSecretZoo.php'">Beli Tiket</button>
                 <div class="bookmark-icon saved" onclick="toggleBookmark(this)">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z"/>
                    </svg>
                </div>
            </div>

            <!-- CARD 5 -->
            <div class="card">
                <img src="https://i.pinimg.com/736x/61/8d/05/618d055f5a0f1f4acf5b31359bcbc41d.jpg" alt="">
                <h3>Museum Brawijaya</h3>
                <p class="rating">⭐ 4.6</p>
                <p>Rp 10.000 / tiket</p>
                 <button class="buy-btn" onclick="location.href='MuseumBrawijaya.php'">Beli Tiket</button>
                 <div class="bookmark-icon saved" onclick="toggleBookmark(this)">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z"/>
                    </svg>
                </div>
            </div>

            <!-- CARD 6 -->
            <div class="card">
                <img src="https://i.pinimg.com/736x/53/e3/44/53e344edb748846077be55054012cda7.jpg" alt="">
                <h3>Museum Angkut</h3>
                <p class="rating">⭐ 4.8</p>
                <p>Rp 110.000 / tiket</p>
                 <button class="buy-btn" onclick="location.href='MuseumAngkut.php'">Beli Tiket</button>
                 <div class="bookmark-icon saved" onclick="toggleBookmark(this)">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z"/>
                    </svg>
                </div>
            </div>

            <!-- CARD 7 -->
            <div class="card">
                <img src="https://lh3.googleusercontent.com/gps-cs-s/AG0ilSyridUvPL3cMoK9yAXNAMfEacZc5_ZxAWouTh4sZ-dFNykKZZHk2QPul2P_yLHwi_PDJvwtCQ0mVKLYFDv4zY06qo_K9UFRavSCpST1sy-Rtm3KufIY_XDPypsimi5jnHmGa6P1=s294-w294-h220-n-k-no" alt="">
                <h3>Kampung Budaya Polowijen</h3>
                <p class="rating">⭐ 4.6</p>
                <p>Rp 10.000 / tiket</p>
                 <button class="buy-btn" onclick="location.href='KampungBudayaPolowijen.php'">Beli Tiket</button>
                 <div class="bookmark-icon saved" onclick="toggleBookmark(this)">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z"/>
                    </svg>
                </div>
        </div>

        <!-- CARD 8 -->
            <div class="card">
                <img src="https://lh3.googleusercontent.com/gps-cs-s/AG0ilSy9CSxK1HGJuaqLjeICmBZhYZ8hf1eER4TrMq6WKtAKmAZHF6mS-XnWe7jF8lL-tF_I_4cbb6-qhALcCEzRCJTBAeoCEbU7wfdRnMLV2376zQGddpvVknyA6LXcZ1DZM_YkLep7=s1360-w1360-h1020-rw" alt=""> 
                <h3>Museum Zoologi Frater Vianney</h3>
                <p class="rating">⭐ 4.6</p>
                <p>Rp 10.000 / tiket</p>
                 <button class="buy-btn" onclick="location.href='MuseumZoologiFraterVianney.php'">Beli Tiket</button>
                 <div class="bookmark-icon saved" onclick="toggleBookmark(this)">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z"/>
                    </svg>
                </div>
    </div>
     <script>
        function toggleBookmark(el) {
            el.classList.toggle("saved");
            el.classList.toggle("unsaved");                 
            el.style.transform = "scale(1.2)";
            setTimeout(() => {
                el.style.transform = "scale(1)";
            }, 150);
        }
    </script>
</section>

<!-- FOOTER -->
<footer>
    <div class="container footer-grid">
        <div class="footer-col">
            <h3 class="logo">WisataKu</h3>
            <p>Jelajahi keindahan Malang Raya dengan kemudahan reservasi tiket secara online dan terpercaya.</p>
        </div>

        <div class="footer-col">
            <h3>Navigasi</h3>
            <ul>
                <li><a href="../../dashboard/home.php">Beranda</a></li>
                <li><a href="WisataEdukasi.php">Wisata Edukasi</a></li>
                <li><a href="../../wishlist/whistlist.php">Favorit</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h3>Hubungi Kami</h3>
            <ul>
                <li><img src="../../assets/icon/mail-line.svg" alt="Email" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"> info@wisataku.id</li>
                <li><img src="../../assets/icon/phone-line.svg" alt="Phone" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"> +62 857-9287-4048</li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        &copy; 2025 WisataKu - Malang Raya. All rights reserved.
    </div>
</footer>

</body>
</html>





