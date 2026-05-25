<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WisataKu - Tumpak Sewu Immersive Experience</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="Bromo.css?v=2.0">
    <!-- Flatpickr untuk kalender modern -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css?v=2.0">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css?v=2.0">
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

    <!-- IMMERSIVE HERO -->
    <div class="hero-wrapper">
        <img src="https://i.pinimg.com/736x/e4/4e/96/e44e9612cae7bed3b92816e3a0de50f5.jpg" alt="Tumpak Sewu" class="hero-img">
        <div class="hero-overlay"></div>
    </div>

    <div class="container">
        <div class="content-grid">
            
            <!-- MAIN CONTENT -->
            <main class="main-content">
                <nav class="breadcrumb">
                    <a href="../dashboard/home.html">Home</a> / <a href="WisataAlam.html">Wisata Alam</a> / Tumpak Sewu
                </nav>
                
                <h1>Air Terjun Tumpak Sewu</h1>
                
                <div class="stats-bar">
                    <div class="stat-item">
                        <span class="icon">⭐</span>
                        <span class="label">4.8</span>
                        <span class="value">(800+ review)</span>
                    </div>
                    <div class="stat-item">
                        <span class="icon"><img src="../assets/icon/map-pin-line2.svg" alt="Location" style="width: 16px; height: 16px;"/></span>
                        <span class="label">Lumajang - Malang, Jatim</span>
                    </div>
                    <div class="stat-item">
                        <span class="icon">🏔</span>
                        <span class="label">Wisata Alam</span>
                    </div>
                </div>

                <div class="description">
                    <p>Air Terjun Tumpak Sewu merupakan salah satu destinasi wisata alam paling menakjubkan di Jawa Timur. Terletak di perbatasan Kabupaten Malang dan Lumajang, air terjun ini terkenal dengan keindahan panorama yang dijuluki Niagara dari Timur Jawa.</p>
                    <br>
                    <p>Dikelilingi tebing tinggi dan hijaunya pepohonan, Tumpak Sewu menyuguhkan pemandangan spektakuler berupa air terjun yang menjulang lebar dengan aliran air yang tampak seperti tirai raksasa. Pengunjung bisa menikmati keindahan dari titik pandang atas (panorama) maupun turun ke dasar lembah untuk merasakan langsung kesegaran percikan airnya.</p>
                </div>

                <h2 style="margin-bottom: 20px;">Fasilitas & Akses</h2>
                <div class="description">
                    <p>Lokasi ini menyediakan berbagai fasilitas pendukung seperti area parkir yang luas, warung makan lokal, toilet, dan pemandu wisata berpengalaman. Akses menuju lokasi sudah terbilang baik, namun disarankan untuk menggunakan alas kaki yang nyaman jika ingin turun ke area bawah air terjun.</p>
                </div>
            </main>

            <!-- STICKY SIDEBAR -->
            <aside class="sidebar-sticky">
                <div class="booking-card">
                    <div class="price-box">
                        <div class="price-label">Harga Tiket Mulai</div>
                        <div class="price-value">Rp 100.000 <span>/ orang</span></div>
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
                        <div class="total-price" id="totalPriceDisplay">Rp 100.000</div>
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
                <h3 class="logo" style="background: none; -webkit-text-fill-color: white; color: white;">WisataKu</h3>
                <p>Jelajahi keindahan Malang Raya dengan kemudahan reservasi tiket secara online dan terpercaya.</p>
            </div>
            <div class="footer-col">
                <h3>Navigasi</h3>
                <ul>
                    <li><a href="../dashboard/home.html">Beranda</a></li>
                    <li><a href="WisataAlam.html">Wisata Alam</a></li>
                    <li><a href="../wishlist/whistlist.html">Favorit</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Hubungi Kami</h3>
                <ul>
                    <li><img src="../assets/icon/gmail.svg" alt="Email" style="width: 16px; height: 16px; margin-right: 5px; display: inline-block;"> info@wisataku.id</li>
                    <li>📞 +62 857-9287-4048</li>
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
        const pricePerTicket = 100000;
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
            
            const message = `Halo Admin WisataKu, saya mau pesan ${amount} tiket Tumpak Sewu untuk tanggal ${date}. Total tagihan: Rp ${total.toLocaleString('id-ID')}`;
            window.location.href = `https://wa.me/+6285847739780?text=${encodeURIComponent(message)}`;
        }
    </script>
</body>
</html>