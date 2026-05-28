<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WisataKu - Batu Secret Zoo</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="WisataEdukasi.css?v=2.0">
    <!-- Flatpickr untuk kalender modern -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css?v=2.0">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css?v=2.0">
</head>
<body>

    <!-- ===== NAVBAR ===== -->
    <header class="navbar">
        <div class="container nav-flex">
            <a href="../../dashboard/home.php" class="logo">WisataKu</a>

            <ul class="nav-links">
                <li><a href="../../dashboard/home.php">Home</a></li>
                <li><a href="#">Promo</a></li>
                <li><a href="../../wishlist/whistlist.php">Favorite</a></li>
                <li><a href="../../tentang.php">Tentang Kami</a></li>
            </ul>

            <div class="nav-right">
                <a href="../../user/profile.php">
                    <img src="../../assets/images/dapin kecil.jpg" alt="Profile" class="profile-icon" style="width:38px; height:38px; border-radius:50%; object-fit:cover; border:2px solid var(--blue-light);">
                </a>
            </div>
        </div>
    </header>

    <!-- IMMERSIVE HERO -->
    <div class="hero-wrapper">
        <img src="https://i.pinimg.com/1200x/23/48/83/2348832180a88e989ed04f3f24faa9f5.jpg" alt="Batu Secret Zoo" class="hero-img">
        <div class="hero-overlay"></div>
    </div>

    <div class="container">
        <div class="content-grid">
            
            <!-- MAIN CONTENT -->
            <main class="main-content">
                <nav class="breadcrumb">
                    <a href="../../dashboard/home.php">Home</a> / <a href="WisataEdukasi.php">Wisata Edukasi</a> / Batu Secret Zoo
                </nav>
                
                <h1>Batu Secret Zoo</h1>
                
                <div class="stats-bar">
                    <div class="stat-item">
                        <span class="icon">⭐</span>
                        <span class="label">4.9</span>
                        <span class="value">(3.5k review)</span>
                    </div>
                    <div class="stat-item">
                        <span class="icon"><img src="../../assets/icon/map-pin-line2.svg" alt="Location" style="width: 16px; height: 16px;"/></span>
                        <span class="label">Batu, Jatim</span>
                    </div>
                    <div class="stat-item">
                        <span class="icon">🦁</span>
                        <span class="label">Wisata Edukasi</span>
                    </div>
                </div>

                <div class="description">
                    <p>Batu Secret Zoo adalah kebun binatang modern bertaraf internasional yang menawarkan konsep edukasi dan konservasi satwa dengan cara yang interaktif dan menarik.</p>
                    <br>
                    <p>Terletak di kawasan Jawa Timur Park 2, pengunjung dapat melihat berbagai koleksi satwa dari berbagai belahan dunia dalam habitat yang dirancang sedemikian rupa agar mirip dengan aslinya. Fasilitas yang lengkap dan wahana permainan yang terintegrasi menjadikannya salah satu kebun binatang terbaik di Asia Tenggara.</p>
                </div>

                <div class="map-wrapper">
                    <button class="map-btn" onclick="window.location.href='https://maps.app.goo.gl/UsVKvj5VtjE1TDam6'"><img src="../../assets/icon/map-pin-line2.svg" alt="Location" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> Lihat di Google Maps</button>
                </div>
            </main>

            <!-- STICKY SIDEBAR -->
            <aside class="sidebar-sticky">
                <div class="booking-card">
                    <div class="price-box">
                        <div class="price-label">Harga Tiket Mulai</div>
                        <div class="price-value">Rp 120.000 <span>/ orang</span></div>
                    </div>

                    <div class="input-group">
                        <label>Tanggal Kunjungan</label>
                        <input type="text" id="bookingDate" placeholder="Pilih Tanggal..." readonly>
                    </div>

                    <div class="input-group">
                        <label>Jumlah Tiket</label>
                        <input type="number" id="ticketAmount" min="1" value="1">
                    </div>

                    <div class="total-payment">
                        <div class="total-label">Total Pembayaran</div>
                        <div class="total-price" id="totalPriceDisplay">Rp 120.000</div>
                    </div>

                    <button class="buy-btn" onclick="orderTicket()">Pesan Sekarang</button>
                    
                    <p style="text-align:center; font-size:12px; color:var(--text-light); margin-top:16px;">
                        ⚡ Konfirmasi instan via WhatsApp
                    </p>
                </div>
            </aside>

        </div>
    </div>

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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        const pricePerTicket = 120000;
        const datePicker = flatpickr("#bookingDate", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            minDate: "today",
            defaultDate: "today"
        });

        // Update total price real-time
        const amountInput = document.getElementById('ticketAmount');
        const priceDisplay = document.getElementById('totalPriceDisplay');

        amountInput.addEventListener('input', () => {
            const total = amountInput.value * pricePerTicket;
            priceDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
        });

        function orderTicket() {
            const date = document.getElementById('bookingDate').value;
            const amount = amountInput.value;
            const total = amount * pricePerTicket;
            
            const message = `Halo Admin WisataKu, saya mau pesan ${amount} tiket Batu Secret Zoo for tanggal ${date}. Total tagihan: Rp ${total.toLocaleString('id-ID')}`;
            window.location.href = `https://wa.me/+6285847739780?text=${encodeURIComponent(message)}`;
        }
    </script>
</body>
</html>





