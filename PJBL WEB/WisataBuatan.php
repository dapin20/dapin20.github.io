<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WisataKu - Wisata Buatan Malang Raya</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="WisataAlam.css?v=2.0">
</head>
<body>

    <!-- ===== NAVBAR (Standardized) ===== -->
    <header class="navbar">
        <div class="container">
            <a href="../dashboard/home.html" class="logo">WisataKu</a>

            <ul class="nav-links">
                <li><a href="../dashboard/home.html">Home</a></li>
                <li><a href="#">Promo</a></li>
                <li><a href="../wishlist/whistlist.html">Favorite</a></li>
                <li><a href="../tentang.html">Tentang Kami</a></li>
            </ul>

            <div class="nav-right">
                <a href="../user/profile.html">
                    <img src="../images/dapin kecil.jpg" alt="Profile" class="profile-icon">
                </a>
            </div>
        </div>
    </header>

<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <h2>Wisata Buatan Malang Raya</h2>
        <p>Eksplorasi seru di Kampung tridi, Malang night paradise, Hawai water park, dan destinasi buatan populer lainnya di Malang Raya.</p>
    </div>
</section>

<!-- DESTINASI POPULER -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Destinasi Populer</h2>

        <div class="grid-card" >

            <!-- CARD 1 -->
            <div class="card">
                <img src="../images/Edukasi.png" alt="">
                <h3>Jatim Park 1</h3>
                <p class="rating">⭐ 4.8</p>
                <p>Rp 65.000–170.000 / tiket</p>
                 <button class="buy-btn" onclick="location.href=''">Beli Tiket</button>
                  <div class="bookmark-icon saved" onclick="toggleBookmark(this)">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z"/>
                    </svg>
                </div>
            </div>

            <!-- CARD 2 -->
            <div class="card">
                <img src="../images/Buatan2.png" alt="">
                <h3>Malang Night Paradise</h3>
                <p class="rating">⭐ 4.6</p>
                <p>Rp 220.000 / orang</p>
                 <button class="buy-btn" onclick="location.href=''">Beli Tiket</button>
                  <div class="bookmark-icon saved" onclick="toggleBookmark(this)">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z"/>
                    </svg>
                </div>
            </div>

            <!-- CARD 3 -->
            <div class="card">
                <img src="../images/Buatan3.png" alt="">
                <h3>Hawai Water Park</h3>
                <p class="rating">⭐ 4.8</p>
                <p>Rp 15.000 / tiket</p>
                 <button class="buy-btn" onclick="location.href='Hawai.html'">Beli Tiket</button>
                  <div class="bookmark-icon saved" onclick="toggleBookmark(this)">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z"/>
                    </svg>
                </div>
            </div>

            <!-- CARD 4 -->
            <div class="card">
                <img src="../images/buatan4.png" alt="">
                <h3>Kesembon Park</h3>
                <p class="rating">⭐ 4.8</p>
                <p>Rp 100.000–150.000 / tiket</p>
                 <button class="buy-btn" onclick="location.href=''">Beli Tiket</button>
                  <div class="bookmark-icon saved" onclick="toggleBookmark(this)">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z"/>
                    </svg>
                </div>
            </div>

            <!-- CARD 5 -->
            <div class="card">
                <img src="../images/buatan5.png" alt="">
                <h3>Fantasy Land</h3>
                <p class="rating">⭐ 4.6</p>
                <p>Rp 10.000 / tiket</p>
                 <button class="buy-btn" onclick="location.href=''">Beli Tiket</button>
                  <div class="bookmark-icon saved" onclick="toggleBookmark(this)">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z"/>
                    </svg>
                </div>
            </div>

            <!-- CARD 6 -->
            <div class="card">
                <img src="../images/buatan6.png" alt="">
                <h3>Kampung Tridi</h3>
                <p class="rating">⭐ 4.8</p>
                <p>Rp 20.000 / tiket</p>
                 <button class="buy-btn" onclick="location.href=''">Beli Tiket</button>
                  <div class="bookmark-icon saved" onclick="toggleBookmark(this)">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z"/>
                    </svg>
                </div>
            </div>

            <!-- CARD 7 -->
            <div class="card">
                <img src="https://selectawisata.id/wp-content/uploads/2023/12/20230105-DSC04944-scaled.jpg" alt="">
                <h3>Taman Rekreasi Selecta</h3>
                <p class="rating">⭐ 4.6</p>
                <p>Rp 10.000 / tiket</p>
                 <button class="buy-btn" onclick="location.href=''">Beli Tiket</button>
                  <div class="bookmark-icon saved" onclick="toggleBookmark(this)">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 3H7c-1.1 0-1.99.9-1.99 2L5 21l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z"/>
                    </svg>
                </div>
        </div>

        <!-- CARD 8 -->
            <div class="card">
                <img src="https://asset.kompas.com/crops/qVZ7dLMU2uwDODrZrSWLni3yUkI=/0x363:765x873/1200x800/data/photo/2023/12/26/658a7bf12e3f1.jpeg" alt=""> 
                <h3>Malang Skyland</h3>
                <p class="rating">⭐ 4.6</p>
                <p>Rp 45.000 / tiket</p>
                 <button class="buy-btn" onclick="location.href='MalangSky.html'">Beli Tiket</button>
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
            <h3 class="logo" style="background: none; -webkit-text-fill-color: white; color: white;">WisataKu</h3>
            <p style="font-size: 14px; opacity: 0.8; margin-top: 10px;">Platform reservasi tiket wisata terbaik di Malang Raya.</p>
        </div>

        <div>
            <h3>Navigasi</h3>
            <ul>
                <li><a href="../dashboard/home.html">Home</a></li>
                <li><a href="#">Wisata Buatan</a></li>
                <li><a href="../wishlist/whistlist.html">Favorit</a></li>
            </ul>
        </div>

        <div>
            <h3>Kontak</h3>
            <ul>
                <li>Email: info@wisataku.id</li> 
                <li>WhatsApp: +62 857-9287-4048</li>
            </ul>
        </div>
    </div>
    <p class="footer-bottom">&copy; 2025 WisataKu - Malang Raya. All rights reserved.</p>
</footer>

</body>
</html>