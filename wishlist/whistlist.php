<?php
require_once('../config/destination_helper.php');

$destinations = load_destinations();
$wishlistPayload = array_map(function ($destination) {
    return destination_payload($destination, '../');
}, $destinations);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WisataKu - Wishlist</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../user/account-theme.css?v=5.0" />
    <link rel="stylesheet" href="./whistlist.css?v=5.0" />
</head>
<body>
    <div class="profile-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <p class="sidebar-eyebrow">Akun</p>
                <h2 class="sidebar-title">Profil Pengguna</h2>
            </div>
            <nav class="sidebar-menu">
                <ul>
                    <li><a href="../user/profile.php" class="menu-item"><span class="menu-icon">👤</span><span>Profil Saya</span></a></li>
                    <li><a href="../orders/pesanan.php" class="menu-item"><span class="menu-icon">🎫</span><span>Pesanan Saya</span></a></li>
                    <li><a href="../orders/riwayat.php" class="menu-item"><span class="menu-icon">🧾</span><span>Riwayat Transaksi</span></a></li>
                    <li><a href="../orders/pembayaran.php" class="menu-item"><span class="menu-icon">💳</span><span>Metode Pembayaran</span></a></li>
                    <li><a href="../dashboard/promo.php" class="menu-item"><span class="menu-icon">🏷</span><span>Promo & Deals</span></a></li>
                    <li><a href="./whistlist.php" class="menu-item active"><span class="menu-icon">❤</span><span>Wishlist</span></a></li>
                    <li><a href="../user/akun.php" class="menu-item"><span class="menu-icon">⚙</span><span>Pengaturan Akun</span></a></li>
                    <li><a href="../help/bantuan.php" class="menu-item"><span class="menu-icon">❓</span><span>Bantuan & Dukungan</span></a></li>
                </ul>
            </nav>
            <a href="../admin/index.php" class="btn-admin-link">Login Admin</a>
            <button class="btn-logout" onclick="window.location.href='../auth/logout.php'">Keluar</button>
        </aside>

        <main class="profile-content">
            <div class="profile-header">
                <a href="../dashboard/home.php" class="btn-back">← Kembali ke Beranda</a>
                <p class="profile-subtitle">Destinasi di halaman ini mengikuti ikon hati di home. Klik hati merah untuk menghapus dari favorite.</p>
            </div>

            <div class="page-hero wishlist-header">
                <h1 class="page-hero-title">Favorite Saya</h1>
                <p class="page-hero-subtitle">Tampilan disamakan dengan kartu di home agar lebih konsisten.</p>
                <span class="wishlist-count" id="wishlistCount">0 destinasi tersimpan</span>
            </div>

            <section class="section-shell wishlist-shell">
                <div class="favorite-stage">
                    <button class="favorite-arrow prev" type="button" onclick="scrollFavorites(-1)">‹</button>
                    <div class="favorite-track" id="favoriteTrack"></div>
                    <button class="favorite-arrow next" type="button" onclick="scrollFavorites(1)">›</button>
                </div>
                <div class="favorite-empty" id="favoriteEmpty" hidden>
                    <img src="../assets/icon/save.svg" alt="Favorite kosong" class="favorite-empty-icon" />
                    <h2>Belum ada favorite</h2>
                    <p>Klik ikon hati di halaman home untuk menambahkan destinasi ke daftar ini.</p>
                    <a href="../dashboard/home.php" class="btn-primary">Buka Home</a>
                </div>
            </section>
        </main>
    </div>

    <script>
        window.destinationCatalog = <?php echo json_encode($wishlistPayload, JSON_UNESCAPED_SLASHES); ?>;
    </script>
    <script src="../assets/js/favorites.js"></script>
    <script>
        const destinationCatalog = new Map(window.destinationCatalog.map((destination) => [destination.id, destination]));
        const favoriteStage = document.querySelector(".favorite-stage");
        const favoriteTrack = document.getElementById("favoriteTrack");
        const favoriteEmpty = document.getElementById("favoriteEmpty");
        const wishlistCount = document.getElementById("wishlistCount");

        function favoriteSource() {
            return window.favoriteStore.getAll().map((favorite) => {
                return destinationCatalog.get(favorite.id) || favorite;
            });
        }

        function escapeHtml(value) {
            return String(value ?? "")
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#39;");
        }

        function renderFavorites() {
            const favorites = favoriteSource();
            wishlistCount.textContent = `${favorites.length} destinasi tersimpan`;

            if (favorites.length === 0) {
                favoriteTrack.innerHTML = "";
                favoriteStage.hidden = true;
                favoriteTrack.hidden = true;
                favoriteEmpty.hidden = false;
                return;
            }

            favoriteStage.hidden = false;
            favoriteTrack.hidden = false;
            favoriteEmpty.hidden = true;

            favoriteTrack.innerHTML = favorites.map((destination) => `
                <a href="${escapeHtml(destination.href)}" class="favorite-card">
                    <div class="favorite-card-image-wrap">
                        <img src="${escapeHtml(destination.image)}" alt="${escapeHtml(destination.name)}" class="favorite-card-image">
                        <button
                            class="favorite-heart"
                            type="button"
                            data-favorite-button
                            data-id="${escapeHtml(destination.id)}"
                            data-name="${escapeHtml(destination.name)}"
                            data-location="${escapeHtml(destination.location)}"
                            data-price="${destination.price}"
                            data-rating="${destination.rating}"
                            data-image="${escapeHtml(destination.image)}"
                            data-href="${escapeHtml(destination.href)}"
                            data-category="${escapeHtml(destination.category || "")}"
                            data-icon-default="../assets/icon/save.svg"
                            data-icon-active="../assets/icon/save_fill.svg"
                            aria-label="Hapus dari favorite"
                            aria-pressed="true"
                        >
                            <img src="../assets/icon/save_fill.svg" alt="Favorite aktif">
                        </button>
                    </div>
                    <div class="favorite-card-body">
                        <h3>${escapeHtml(destination.name)}</h3>
                        <div class="favorite-location">
                            <img src="../assets/icon/map-pin-line.svg" alt="Lokasi">
                            <span>${escapeHtml(destination.location)}</span>
                        </div>
                        <div class="favorite-meta">
                            <div class="favorite-price">${window.favoriteStore.formatPrice(destination.price)} <span>/ orang</span></div>
                            <div class="favorite-rating">★ ${Number(destination.rating).toFixed(1)}</div>
                        </div>
                    </div>
                </a>
            `).join("");

            window.favoriteStore.bindButtons(favoriteTrack);
        }

        function scrollFavorites(direction) {
            favoriteTrack.scrollBy({
                left: direction * 320,
                behavior: "smooth",
            });
        }

        window.addEventListener("favorites:updated", renderFavorites);
        document.addEventListener("DOMContentLoaded", renderFavorites);
    </script>
</body>
</html>
