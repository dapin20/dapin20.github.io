<?php
require_once(__DIR__ . '/../../config/koneksi.php');
require_once(__DIR__ . '/../../config/profile_avatar_helper.php');
$avatarSrc = getProfileAvatarSrc($conn, '../../');
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <script src="../../assets/js/theme.js?v=3.4"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WisataKu - Museum Angkut</title>
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
                <li><a href="../../tentang.php">Tentang Kami</a></li>
            </ul>

            <div class="nav-right">
                <a href="../../user/profile.php">
                    <img src="<?php echo htmlspecialchars($avatarSrc); ?>" alt="Profile" class="profile-icon" style="width:38px; height:38px; border-radius:50%; object-fit:cover; border:2px solid var(--blue-light);">
                </a>
            </div>
        </div>
    </header>

    <!-- IMMERSIVE HERO -->
    <div class="hero-wrapper">
        <img src="../../assets/images/museum_angkut.jpg" alt="Museum Angkut" class="hero-img">
        <div class="hero-overlay"></div>
    </div>

    <div class="container">
        <div class="content-grid">
            
            <!-- MAIN CONTENT -->
            <main class="main-content">
                <nav class="breadcrumb">
                    <a href="../../dashboard/home.php">Home</a> / <a href="WisataEdukasi.php">Wisata Edukasi</a> / Museum Angkut
                </nav>
                
                <h1>Museum Angkut</h1>
                
                <div class="stats-bar">
                    <div class="stat-item">
                        <span class="icon"><img src="../../assets/icon/map-pin-line2.svg" alt="Location" style="width: 16px; height: 16px;"/></span>
                        <span class="label">Batu, Jatim</span>
                    </div>
                    <div class="stat-item">
                        <span class="label">Wisata Edukasi</span>
                    </div>
                </div>

                <div class="description">
                    <p>Museum Angkut adalah museum transportasi pertama di Asia Tenggara yang berlokasi di Batu, Malang, dan dibuka pada tahun 2014.</p>
                    <br>
                    <p>Museum ini menampilkan koleksi transportasi dari berbagai negara dan zaman, mulai dari kendaraan tradisional hingga modern, dalam berbagai zona yang bertema seperti Gangster Town, Zona Eropa, dan Hollywood. Selain koleksinya, museum ini juga menawarkan hiburan dan edukasi tentang sejarah perkembangan transportasi.</p>
                </div>

            </main>

            <!-- STICKY SIDEBAR -->
            <aside class="sidebar-sticky">
                <div class="booking-card">
                    <div class="price-box">
                        <div class="price-label">Harga Tiket Mulai</div>
                        <div class="price-value">Rp 110.000 <span>/ orang</span></div>
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
                        <div class="total-price" id="totalPriceDisplay">Rp 110.000</div>
                    </div>

                    <button class="buy-btn" onclick="orderTicket()">Pesan Sekarang</button>
                    
                    <p style="text-align:center; font-size:12px; color:var(--text-light); margin-top:16px;">Pembayaran transfer bank dan verifikasi admin</p>
                </div>
            </aside>

        </div>
    </div>

    <!-- FOOTER -->
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
                    <li><a href="../../user/wisata_alam/Bromo.php">Gunung Bromo</a></li>
                    <li><a href="../../user/wisata_alam/PantaiNgudel.php">Pantai Balekambang</a></li>
                    <li><a href="../../user/wisata_alam/TumpakSewu.php">Tumpak Sewu</a></li>
                    <li><a href="../../user/wisata_alam/RanuRegulo.php">Ranu Regulo</a></li>
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        const pricePerTicket = 110000;
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
            const amount = Math.max(1, parseInt(amountInput.value, 10) || 1);
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '../../orders/checkout.php';

            const fields = {
                destination_id: 'museum-angkut',
                destination_name: 'Museum Angkut',
                destination_href: 'user/wisata_edukasi/MuseumAngkut.php',
                price: '110000',
                quantity: amount,
                visit_date: date
            };

            Object.keys(fields).forEach((key) => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = fields[key];
                form.appendChild(input);
            });

            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>
</html>



