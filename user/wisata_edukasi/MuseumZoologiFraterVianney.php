<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WisataKu - Museum Zoologi Frater Vianney</title>
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
        <img src="https://lh3.googleusercontent.com/gps-cs-s/AG0ilSy9CSxK1HGJuaqLjeICmBZhYZ8hf1eER4TrMq6WKtAKmAZHF6mS-XnWe7jF8lL-tF_I_4cbb6-qhALcCEzRCJTBAeoCEbU7wfdRnMLV2376zQGddpvVknyA6LXcZ1DZM_YkLep7=s1360-w1360-h1020-rw" alt="Museum Zoologi Frater Vianney" class="hero-img">
        <div class="hero-overlay"></div>
    </div>

    <div class="container">
        <div class="content-grid">
            
            <!-- MAIN CONTENT -->
            <main class="main-content">
                <nav class="breadcrumb">
                    <a href="../../dashboard/home.php">Home</a> / <a href="WisataEdukasi.php">Wisata Edukasi</a> / Museum Zoologi Frater Vianney
                </nav>
                
                <h1>Museum Zoologi Frater Vianney</h1>
                
                <div class="stats-bar">
                    <div class="stat-item">
                        <span class="icon">⭐</span>
                        <span class="label">4.6</span>
                        <span class="value">(200 review)</span>
                    </div>
                    <div class="stat-item">
                        <span class="icon"><img src="../../assets/icon/map-pin-line2.svg" alt="Location" style="width: 16px; height: 16px;"/></span>
                        <span class="label">Malang, Jatim</span>
                    </div>
                    <div class="stat-item">
                        <span class="icon">🐢</span>
                        <span class="label">Wisata Edukasi</span>
                    </div>
                </div>

                <div class="description">
                    <p>Museum Zoologi Frater Vianney menyimpan ribuan koleksi spesimen hewan yang telah diawetkan, mulai dari moluska, serangga, hingga mamalia besar.</p>
                    <br>
                    <p>Museum ini didirikan oleh Frater Vianney sebagai sarana edukasi dan penelitian biologi. Pengunjung dapat melihat keragaman fauna nusantara dan dunia dalam satu tempat, menjadikannya destinasi yang sangat berharga bagi pelajar dan mahasiswa biologi.</p>
                </div>

                <div class="map-wrapper">
                    <button class="map-btn" onclick="window.location.href='#'"><img src="../../assets/icon/map-pin-line2.svg" alt="Location" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"/> Lihat di Google Maps</button>
                </div>
            </main>

            <!-- STICKY SIDEBAR -->
            <aside class="sidebar-sticky">
                <div class="booking-card">
                    <div class="price-box">
                        <div class="price-label">Harga Tiket Mulai</div>
                        <div class="price-value">Rp 10.000 <span>/ orang</span></div>
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
                        <div class="total-price" id="totalPriceDisplay">Rp 10.000</div>
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
        const pricePerTicket = 10000;
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
            
            const message = `Halo Admin WisataKu, saya mau pesan ${amount} tiket Museum Zoologi Frater Vianney untuk tanggal ${date}. Total tagihan: Rp ${total.toLocaleString('id-ID')}`;
            window.location.href = `https://wa.me/+6285847739780?text=${encodeURIComponent(message)}`;
        }
    </script>
</body>
</html>





