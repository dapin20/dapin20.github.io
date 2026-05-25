<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WisataKu - Ranu Regulo Immersive Experience</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="Bromo.css?v=2.0">
    <!-- Flatpickr untuk kalender modern -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css?v=2.0">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css?v=2.0">
</head>
<body>

    <!-- ===== NAVBAR ===== -->
    <header class="navbar">
        <div class="container nav-flex">
            <a href="../dashboard/home.php" class="logo">WisataKu</a>

            <ul class="nav-links">
                <li><a href="../dashboard/home.php">Home</a></li>
                <li><a href="#">Promo</a></li>
                <li><a href="../wishlist/whistlist.php">Favorite</a></li>
                <li><a href="../tentang.php">Tentang Kami</a></li>
            </ul>

            <div class="nav-right">
                <a href="profile.php">
                    <img src="../images/dapin kecil.jpg" alt="Profile" class="profile-icon" style="width:38px; height:38px; border-radius:50%; object-fit:cover; border:2px solid var(--blue-light);">
                </a>
            </div>
        </div>
    </header>

    <!-- IMMERSIVE HERO -->
    <div class="hero-wrapper">
        <img src="../assets/images/ranu_regulo.jpg" alt="Ranu Regulo" class="hero-img">
        <div class="hero-overlay"></div>
    </div>

    <div class="container">
        <div class="content-grid">
            
            <!-- MAIN CONTENT -->
            <main class="main-content">
                <nav class="breadcrumb">
                    <a href="../dashboard/home.php">Home</a> / <a href="WisataAlam.php">Wisata Alam</a> / Ranu Regulo
                </nav>
                
                <h1>Ranu Regulo</h1>
                
                <div class="stats-bar">
                    <div class="stat-item">
                        <span class="icon">⭐</span>
                        <span class="label">4.6</span>
                        <span class="value">(850 review)</span>
                    </div>
                    <div class="stat-item">
                        <span class="icon"><img src="../assets/icon/map-pin-line2.svg" alt="Location" style="width: 16px; height: 16px;"/></span>
                        <span class="label">Senduro, Lumajang</span>
                    </div>
                    <div class="stat-item">
                        <span class="icon">🏔</span>
                        <span class="label">Wisata Alam</span>
                    </div>
                </div>

                <div class="description">
                    <p>Ranu Regulo adalah sebuah danau cantik yang terletak di kaki Gunung Semeru, tepatnya di kawasan Taman Nasional Bromo Tengger Semeru. Danau ini menawarkan suasana yang sangat tenang dan asri, jauh dari keramaian.</p>
                    <br>
                    <p>Dikelilingi oleh hutan pinus dan udara yang sejuk, Ranu Regulo menjadi tempat favorit bagi para pencinta alam untuk berkemah atau sekadar menikmati keindahan matahari terbit yang memantul di permukaan danau yang tenang.</p>
                </div>
            </main>

            <!-- STICKY SIDEBAR -->
            <aside class="sidebar-sticky">
                <div class="booking-card">
                    <div class="price-box">
                        <div class="price-label">Harga Tiket Mulai</div>
                        <div class="price-value">Rp 25.000 <span>/ orang</span></div>
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
                        <div class="total-price" id="totalPriceDisplay">Rp 25.000</div>
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
                <p>Jelajahi keindahan Malang Raya dengan kemudahan reservasi tiket secara online and terpercaya.</p>
            </div>
            <div class="footer-col">
                <h3>Navigasi</h3>
                <ul>
                    <li><a href="../dashboard/home.php">Beranda</a></li>
                    <li><a href="WisataAlam.php">Wisata Alam</a></li>
                    <li><a href="../wishlist/whistlist.php">Favorit</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Hubungi Kami</h3>
                <ul>
                    <li><img src="../assets/icon/mail-line.svg" alt="Email" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"> info@wisataku.id</li>
                    <li><img src="../assets/icon/phone-line.svg" alt="Phone" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"> +62 857-9287-4048</li>
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
        const pricePerTicket = 25000;
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
            
            const message = `Halo Admin WisataKu, saya mau pesan ${amount} tiket Ranu Regulo untuk tanggal ${date}. Total tagihan: Rp ${total.toLocaleString('id-ID')}`;
            window.location.href = `https://wa.me/+6285847739780?text=${encodeURIComponent(message)}`;
        }
    </script>
</body>
</html>
