<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WisataKu - Bromo</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Bromo.css?v=2.0">
</head>
<body>

    <!-- ===== NAVBAR (Standardized) ===== -->
    <header class="navbar">
        <div class="container">
            <a href="../dashboard/home.php" class="logo">WisataKu</a>

            <ul class="nav-links">
                <li><a href="../dashboard/home.php">Home</a></li>
                <li><a href="#">Promo</a></li>
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

    <div class="container">

        <!-- Image -->
        <div class="image-section">
            <img src="https://i.pinimg.com/736x/39/fc/1c/39fc1c4b828e4b116dc09d82f590219c.jpg " alt="EcoGreenPark">
        </div>

        <!-- Content -->
        <div class="content-section">
            <a href="WisataEdukasi.html" class="back">← Kembali</a>
            <h1>ECO GREEN PARK</h1>

            <p class="desc">
                Eco Green Park merupakan taman edukasi yang terletak di kota Batu, Jawa Timur. Taman ini 
                memiliki berbagai macam atraksi yang cocok untuk seluruh keluarga. Kunjungi eco park yang 
                memamerkan berbagai macam spesies unggas, mulai dari emu, flamingo, japanese crane, dan 
                masih banyak lagi!
            </p>
            <button class="map-btn" onclick="window.location.href='https://maps.app.goo.gl/UsVKvj5VtjE1TDam6'"><img src="../assets/icon/map-pin-line2.svg" alt="Location" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> Show Map</button>

            <div class="price">
                <span class="highlight">Rp 55.000</span>
                <span class="old-price">Rp 75.000</span>
            </div>

            <!-- Form Box -->
            <div class="form-box">
                <p><label><b>Tanggal Kunjungan</b></label>
                <input type="date"></p>

                <p></p><label><b>Jumlah Tiket</b></label>
                <input type="number" min="1" value="1"></p>

                <button class="buy-btn" onclick="window.location.href='https://wa.me/+6285847739780?text=Halo+Admin+WisataKu+mau+memesan+iket+wisata+ke+Eco+Green+Park'">Beli Tiket</button>
            </div>

        </div>

    </div>

<!-- Footer -->
  <footer>
    <div class="container footer-grid">

        <div>
            <h3>Navigasi</h3>
            <ul>
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Wisata Malang Raya</a></li>
                <li><a href="#">Tentang Kami</a></li>
                <li><a href="#">Kontak</a></li>
            </ul>
        </div>

        <div>
            <h3>Kontak</h3>
            <ul>
                <li>Email: info@wisataku.id</li>
                <li>WhatsApp: +62 857-9287-4048</li>
            </ul>
        </div>

        <div>
            <h3>Ikuti Kami</h3>
            <div class="sosmed">
                <a
                href="https://www.instagram.com/chipmunkhu/" target="_blank">
            <img src="../images/Instagram.png" alt="">
        </a>
                 <a
                href="https://www.instagram.com/chipmunkhu/" target="_blank">
            <img src="../images/Facebook.png" alt="">
        </a>
                <a
                href="https://www.instagram.com/chipmunkhu/" target="_blank">
            <img src="../images/Twitter.png" alt="">
        </a>
            </div>
        </div>

    </div>

    <p class="footer-bottom">&copy; 2025 WisataKu - Malang Raya. All rights reserved.</p>
</footer>

</body>
</html>
