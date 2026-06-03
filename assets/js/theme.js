(function () {
  var storageKey = "wisataku-theme";
  var languageKey = "wisataku-language";
  var translations = {
    id: {
      "common.home": "Home",
      "common.backHome": "Kembali ke Beranda",
      "common.buyTicket": "Beli Tiket",
      "common.orderNow": "Pesan Sekarang",
      "common.uploadProof": "Upload Bukti",
      "common.viewDetail": "Lihat Detail",
      "common.viewReceipt": "Lihat Nota",
      "common.payment": "Pembayaran",
      "common.destination": "Destinasi",
      "common.totalPrice": "Total Harga",
      "common.ticketCount": "Jumlah Tiket",
      "common.status": "Status",
      "common.action": "Aksi",
      "account.sidebar.eyebrow": "Akun",
      "account.sidebar.title": "Profil Pengguna",
      "nav.profile": "Profil Saya",
      "nav.orders": "Pesanan Saya",
      "nav.history": "Riwayat Transaksi",
      "nav.payment": "Metode Pembayaran",
      "nav.settings": "Pengaturan Akun",
      "nav.help": "Bantuan & Dukungan",
      "nav.logout": "Keluar",
      "settings.back": "Kembali ke Beranda",
      "settings.subtitle": "Atur preferensi umum dan kontrol akun dengan tampilan yang seragam.",
      "settings.title": "Pengaturan Akun",
      "settings.hero": "Kelola preferensi dan keamanan akun Anda.",
      "settings.general": "Pengaturan Umum",
      "settings.language": "Bahasa",
      "settings.languageDesc": "Pilih bahasa yang ingin Anda gunakan",
      "settings.theme": "Tema",
      "settings.themeDesc": "Pilih tema aplikasi Anda",
      "settings.light": "Terang",
      "settings.dark": "Gelap",
      "profile.title": "Informasi Akun",
      "profile.name": "Nama Pengguna",
      "profile.email": "Email",
      "profile.phone": "Nomor Telepon",
      "profile.address": "Alamat",
      "profile.save": "Simpan Perubahan",
      "orders.title": "Pesanan Saya",
      "orders.list": "Daftar Pesanan",
      "history.title": "Riwayat Transaksi",
      "payment.title": "Metode Pembayaran"
    },
    en: {
      "common.home": "Home",
      "common.backHome": "Back to Home",
      "common.buyTicket": "Buy Ticket",
      "common.orderNow": "Order Now",
      "common.uploadProof": "Upload Proof",
      "common.viewDetail": "View Detail",
      "common.viewReceipt": "View Receipt",
      "common.payment": "Payment",
      "common.destination": "Destination",
      "common.totalPrice": "Total Price",
      "common.ticketCount": "Ticket Count",
      "common.status": "Status",
      "common.action": "Action",
      "account.sidebar.eyebrow": "Account",
      "account.sidebar.title": "User Profile",
      "nav.profile": "My Profile",
      "nav.orders": "My Orders",
      "nav.history": "Transaction History",
      "nav.payment": "Payment Methods",
      "nav.settings": "Account Settings",
      "nav.help": "Help & Support",
      "nav.logout": "Logout",
      "settings.back": "Back to Home",
      "settings.subtitle": "Manage general preferences and account controls in one consistent view.",
      "settings.title": "Account Settings",
      "settings.hero": "Manage your preferences and account security.",
      "settings.general": "General Settings",
      "settings.language": "Language",
      "settings.languageDesc": "Choose the language you want to use",
      "settings.theme": "Theme",
      "settings.themeDesc": "Choose your app theme",
      "settings.light": "Light",
      "settings.dark": "Dark",
      "profile.title": "Account Information",
      "profile.name": "Username",
      "profile.email": "Email",
      "profile.phone": "Phone Number",
      "profile.address": "Address",
      "profile.save": "Save Changes",
      "orders.title": "My Orders",
      "orders.list": "Order List",
      "history.title": "Transaction History",
      "payment.title": "Payment Methods"
    }
  };

  var exactTextKeys = {
    "Home": "common.home",
    "Kembali ke Beranda": "common.backHome",
    "Back to Home": "common.backHome",
    "Beli Tiket": "common.buyTicket",
    "Buy Ticket": "common.buyTicket",
    "Pesan Sekarang": "common.orderNow",
    "Order Now": "common.orderNow",
    "Upload Bukti": "common.uploadProof",
    "Upload Proof": "common.uploadProof",
    "Lihat Detail": "common.viewDetail",
    "View Detail": "common.viewDetail",
    "Lihat Nota": "common.viewReceipt",
    "View Receipt": "common.viewReceipt",
    "Pembayaran": "common.payment",
    "Payment": "common.payment",
    "Destinasi": "common.destination",
    "Destination": "common.destination",
    "Total Harga": "common.totalPrice",
    "Total Price": "common.totalPrice",
    "Jumlah Tiket": "common.ticketCount",
    "Ticket Count": "common.ticketCount",
    "Status": "common.status",
    "Aksi": "common.action",
    "Action": "common.action",
    "Akun": "account.sidebar.eyebrow",
    "Account": "account.sidebar.eyebrow",
    "Profil Pengguna": "account.sidebar.title",
    "User Profile": "account.sidebar.title",
    "Profil Saya": "nav.profile",
    "My Profile": "nav.profile",
    "Pesanan Saya": "nav.orders",
    "My Orders": "nav.orders",
    "Riwayat Transaksi": "nav.history",
    "Transaction History": "nav.history",
    "Metode Pembayaran": "nav.payment",
    "Payment Methods": "nav.payment",
    "Pengaturan Akun": "nav.settings",
    "Account Settings": "nav.settings",
    "Bantuan & Dukungan": "nav.help",
    "Help & Support": "nav.help",
    "Keluar": "nav.logout",
    "Logout": "nav.logout",
    "Informasi Akun": "profile.title",
    "Account Information": "profile.title",
    "Nama Pengguna": "profile.name",
    "Username": "profile.name",
    "Email": "profile.email",
    "Nomor Telepon": "profile.phone",
    "Phone Number": "profile.phone",
    "Alamat": "profile.address",
    "Address": "profile.address",
    "Simpan Perubahan": "profile.save",
    "Save Changes": "profile.save",
    "Daftar Pesanan": "orders.list",
    "Order List": "orders.list"
  };

  var phraseTranslations = {
    "Tentang Kami": "About Us",
    "Promo & Deals": "Promos & Deals",
    "Promo": "Promo",
    "Favorite": "Favorites",
    "Favorit": "Favorites",
    "Masuk": "Login",
    "Daftar": "Register",
    "Beranda": "Home",
    "Navigasi": "Navigation",
    "Kontak": "Contact",
    "Hubungi Kami": "Contact Us",
    "Destinasi wisata": "Tourist destinations",
    "Kategori wisata": "Tour categories",
    "Akses pemesanan": "Booking access",
    "Rata-rata rating destinasi": "Average destination rating",
    "Layanan": "Services",
    "Transparan": "Transparent",
    "Terpantau": "Trackable",
    "Praktis": "Practical",
    "Mulai jelajah": "Start exploring",
    "Lihat Destinasi": "View Destinations",
    "Lihat Promo": "View Promos",
    "Platform tiket wisata Malang Raya.": "Malang Raya travel ticket platform.",
    "Wisata Malang lebih mudah dipesan.": "Malang trips are easier to book.",
    "Temukan destinasi, pilih tanggal, dan pesan tiket dalam satu tempat.": "Find destinations, choose a date, and book tickets in one place.",
    "Tentang WisataKu": "About WisataKu",
    "Platform pemesanan tiket wisata Malang Raya.": "Malang Raya travel ticket booking platform.",
    "WisataKu membantu pengunjung melihat destinasi, harga, tanggal kunjungan, dan status pesanan dengan jelas.": "WisataKu helps visitors clearly view destinations, prices, visit dates, and order status.",
    "Ringkas, jelas, dan mudah digunakan.": "Simple, clear, and easy to use.",
    "Harga dan detail tiket terlihat sejak awal.": "Prices and ticket details are visible from the start.",
    "Status pembayaran bisa dicek dengan mudah.": "Payment status can be checked easily.",
    "Pilih destinasi, tanggal, dan jumlah tiket langsung dari web.": "Choose destinations, dates, and ticket quantities directly on the web.",
    "Cari destinasi favoritmu.": "Find your favorite destination.",
    "Lihat rekomendasi dan promo terbaru di WisataKu.": "View the latest recommendations and promos on WisataKu.",
    "Jelajahi Keindahan": "Explore the Beauty",
    "Jelajahi Keindahan\nMalang Raya": "Explore the Beauty\nof Malang Raya",
    "Temukan berbagai destinasi wisata menarik di area Malang dan sekitarnya. Perjalananmu dimulai dari sini!": "Discover exciting destinations around Malang and nearby areas. Your journey starts here.",
    "Pesan Tiket Sekarang": "Book Tickets Now",
    "Destinasi": "Destination",
    "Dekat Anda": "Near You",
    "Untukmu": "For You",
    "Apa Kata": "What",
    "Mereka?": "They Say",
    "Mau ke mana?": "Where do you want to go?",
    "Tanggal": "Date",
    "Pilih tanggal": "Choose a date",
    "Pilih Tanggal...": "Choose Date...",
    "Wisatawan": "Travelers",
    "Berapa orang?": "How many people?",
    "Cari": "Search",
    "Populer": "Popular",
    "Kategori": "Category",
    "Wisata": "Tourism",
    "Rekomendasi": "Recommendations",
    "Destinasi Populer": "Popular Destinations",
    "Kategori Wisata": "Tour Categories",
    "Wisata Alam": "Nature Tourism",
    "Wisata Buatan": "Man-made Tourism",
    "Wisata Edukasi": "Educational Tourism",
    "Pesona alam indah di Malang Raya": "Beautiful natural charm in Malang Raya",
    "Wahana modern & hiburan keluarga": "Modern rides and family entertainment",
    "Belajar sambil berwisata": "Learn while traveling",
    "Destinasi Dekat Anda": "Destinations Near You",
    "Rekomendasi Untukmu": "Recommended For You",
    "Lihat Semua →": "View All ->",
    "Lihat Semua →": "View All ->",
    "Apa Kata Mereka?": "What They Say",
    "\"Pengalaman berwisata di Malang sangat berkesan! Banyak tempat yang indah dan WisataKu membuatnya mudah.\"": "\"Traveling in Malang was memorable. There are many beautiful places, and WisataKu makes it easy.\"",
    "\"Tempat wisatanya sangat lengkap dan mudah diakses dengan aplikasi ini. Sangat direkomendasikan!\"": "\"The tourist options are complete and easy to access with this app. Highly recommended.\"",
    "\"Website-nya membantu sekali untuk merencanakan liburan keluarga kami. Antarmukanya juga sangat nyaman!\"": "\"This website really helped us plan our family trip. The interface is also very comfortable.\"",
    "Tentang WisataKu": "About WisataKu",
    "Platform pemesanan tiket wisata Malang Raya. Kami berkomitmen untuk memberikan kemudahan dalam menemukan dan memesan destinasi wisata terbaik di Malang.": "Malang Raya travel ticket booking platform. We are committed to making it easier to find and book the best destinations in Malang.",
    "Pelajari Lebih Lanjut →": "Learn More ->",
    "Pelajari Lebih Lanjut →": "Learn More ->",
    "Platform booking tiket wisata terpercaya di Malang Raya, dari destinasi alam hingga wisata edukasi.": "Trusted travel ticket booking platform in Malang Raya, from nature destinations to educational tourism.",
    "Kebijakan Privasi": "Privacy Policy",
    "Syarat & Ketentuan": "Terms & Conditions",
    "Wisata tidak ditemukan": "Destination not found",
    "/ orang": "/ person",
    "Harga Tiket Mulai": "Starting Ticket Price",
    "Tanggal Kunjungan": "Visit Date",
    "Jumlah Tiket": "Ticket Quantity",
    "Total Pembayaran": "Total Payment",
    "Pembayaran transfer bank dan verifikasi admin": "Bank transfer payment and admin verification",
    "Fasilitas & Akses": "Facilities & Access",
    "Lumajang - Malang, Jatim": "Lumajang - Malang, East Java",
    "Jelajahi keindahan Malang Raya dengan kemudahan reservasi tiket secara online dan terpercaya.": "Explore the beauty of Malang Raya with easy and trusted online ticket reservations.",
    "Jelajahi keindahan Malang Raya dengan kemudahan reservasi tiket secara online and terpercaya.": "Explore the beauty of Malang Raya with easy and trusted online ticket reservations.",
    "Panel pengelolaan destinasi dan harga.": "Destination and pricing management panel.",
    "Dashboard": "Dashboard",
    "Kelola Wisata": "Manage Destinations",
    "Kelola Tiket": "Manage Tickets",
    "Lihat Home User": "View User Home",
    "Ringkasan": "Summary",
    "Dashboard Admin": "Admin Dashboard",
    "Data destinasi": "Destination data",
    "Tambah Wisata": "Add Destination",
    "Tambah Wisata Baru": "Add New Destination",
    "Form wisata": "Destination form",
    "Pesanan Customer": "Customer Orders",
    "Admin tiket memverifikasi bukti pembayaran, menerima pesanan, atau menolak transaksi.": "Ticket admins verify payment proof, approve orders, or reject transactions.",
    "Total pesanan": "Total orders",
    "Menunggu": "Pending",
    "Diterima": "Accepted",
    "Ditolak": "Rejected",
    "Semua": "All",
    "Belum ada pesanan customer.": "There are no customer orders yet.",
    "No Pesanan": "Order No.",
    "Customer": "Customer",
    "Total": "Total",
    "Bukti": "Proof",
    "Profil Admin": "Admin Profile",
    "Role": "Role",
    "Bergabung": "Joined",
    "Kembali ke Pesanan": "Back to Orders",
    "Transfer sesuai total tagihan, lalu upload bukti pembayaran berupa gambar.": "Transfer the exact billed amount, then upload an image of your payment proof.",
    "Lihat rekening pembayaran dan lanjutkan pembayaran pesanan yang belum selesai.": "View the payment account and continue paying unfinished orders.",
    "Pembayaran Transfer Bank": "Bank Transfer Payment",
    "Nomor pesanan:": "Order number:",
    "Gunakan rekening resmi WisataKu untuk menyelesaikan pembayaran tiket.": "Use the official WisataKu account to complete your ticket payment.",
    "Instruksi Transfer": "Transfer Instructions",
    "No Rekening": "Account Number",
    "Atas Nama": "Account Name",
    "Total Transfer": "Total Transfer",
    "Status akan menjadi diterima setelah admin memverifikasi bukti pembayaran.": "The status will become accepted after an admin verifies the payment proof.",
    "Upload Bukti Pembayaran": "Upload Payment Proof",
    "Bukti pembayaran": "Payment proof",
    "Bukti pembayaran sudah diupload.": "Payment proof has been uploaded.",
    "Pilih gambar bukti transfer": "Choose transfer proof image",
    "Kirim Bukti Pembayaran": "Submit Payment Proof",
    "Rekening Pembayaran": "Payment Account",
    "Buka salah satu pesanan yang belum selesai untuk mengupload bukti pembayaran.": "Open one unfinished order to upload payment proof.",
    "Pesanan Belum Selesai": "Unfinished Orders",
    "Belum ada pesanan yang perlu dibayar.": "There are no orders that need payment.",
    "Lihat Bukti": "View Proof",
    "Upload Bukti": "Upload Proof",
    "Bukti pembayaran wajib diupload.": "Payment proof must be uploaded.",
    "Upload bukti pembayaran gagal.": "Payment proof upload failed.",
    "Gagal menyimpan bukti pembayaran.": "Failed to save payment proof.",
    "Bukti pembayaran berhasil dikirim. Status pesanan menunggu verifikasi admin.": "Payment proof has been submitted. The order is waiting for admin verification.",
    "Tanggal Kunjungan": "Visit Date",
    "tiket": "tickets",
    "Dibatalkan": "Cancelled",
    "Menunggu Verifikasi Admin": "Waiting for Admin Verification",
    "Menunggu Upload Bukti": "Waiting for Proof Upload",
    "Pantau status tiket, bukti pembayaran, dan hasil verifikasi admin.": "Track ticket status, payment proof, and admin verification results.",
    "Metode Pembayaran": "Payment Methods",
    "Kelola informasi akun dan data kontak Anda di satu tempat.": "Manage your account information and contact details in one place.",
    "Avatar Profil": "Profile Avatar",
    "Tampilan baru mengikuti layout form profil, tanpa banyak gradient.": "The new view follows the profile form layout without too many gradients.",
    "Tanggal Bergabung": "Join Date",
    "Aktivitas Terakhir": "Recent Activity",
    "Pemesanan Tiket Bromo": "Bromo Ticket Booking",
    "Pemesanan Tiket Coban Rondo": "Coban Rondo Ticket Booking",
    "Pemesanan Tiket Jatim Park 2": "Jatim Park 2 Ticket Booking",
    "Reservasi wisata alam": "Nature tourism reservation",
    "Reservasi destinasi air terjun": "Waterfall destination reservation",
    "Reservasi wisata keluarga": "Family tourism reservation",
    "2 hari lalu": "2 days ago",
    "5 hari lalu": "5 days ago",
    "1 minggu lalu": "1 week ago",
    "Profil": "Profile",
    "Pesanan": "Orders",
    "Riwayat": "History",
    "Pengaturan": "Settings",
    "Bantuan": "Help",
    "Cari jawaban cepat, lihat FAQ, dan hubungi tim dukungan dari layout yang sama.": "Find quick answers, view FAQs, and contact support from the same layout.",
    "Kami siap membantu Anda mengatasi masalah apa pun.": "We are ready to help you solve any issue.",
    "Cari bantuan atau topik...": "Search help or topics...",
    "Kategori Populer": "Popular Categories",
    "Pemesanan Tiket": "Ticket Booking",
    "Panduan cara memesan tiket wisata": "Guide to booking travel tickets",
    "Bantuan metode pembayaran & transaksi": "Help with payment methods and transactions",
    "Status Pesanan": "Order Status",
    "Info status pesanan Anda": "Information about your order status",
    "Keamanan Akun": "Account Security",
    "Lindungi akun Anda dengan aman": "Keep your account secure",
    "Pertanyaan Umum (FAQ)": "Frequently Asked Questions (FAQ)",
    "Bagaimana cara memesan tiket wisata?": "How do I book travel tickets?",
    "Untuk memesan tiket wisata, ikuti langkah berikut:": "To book travel tickets, follow these steps:",
    "Pilih destinasi wisata yang Anda inginkan": "Choose the destination you want",
    "Pilih tanggal kunjungan dan jumlah tiket": "Choose the visit date and ticket quantity",
    "Klik tombol \"Pesan Sekarang\"": "Click the \"Order Now\" button",
    "Isi data diri Anda dengan lengkap": "Fill in your personal data completely",
    "Pilih metode pembayaran dan selesaikan transaksi": "Choose a payment method and complete the transaction",
    "Tiket akan dikirim ke email Anda": "Tickets will be sent to your email",
    "Berapa lama proses pembayaran diproses?": "How long does payment processing take?",
    "Waktu pemrosesan pembayaran tergantung metode yang Anda pilih:": "Payment processing time depends on the method you choose:",
    "Transfer Bank:": "Bank Transfer:",
    "1-2 jam": "1-2 hours",
    "E-Wallet:": "E-Wallet:",
    "Kartu Kredit:": "Credit Card:",
    "Langsung terproses (realtime)": "Processed instantly (realtime)",
    "Anda akan menerima konfirmasi melalui email dan notifikasi SMS.": "You will receive confirmation by email and SMS notification.",
    "Bisakah saya membatalkan pesanan?": "Can I cancel an order?",
    "Pesanan dapat dibatalkan dengan syarat dan ketentuan berikut:": "Orders can be cancelled under the following terms and conditions:",
    "Pembatalan harus dilakukan paling lambat 3 hari sebelum tanggal kunjungan": "Cancellation must be made no later than 3 days before the visit date",
    "Akan dikenakan biaya pembatalan sebesar 10% dari total harga": "A cancellation fee of 10% of the total price will apply",
    "Dana akan dikembalikan ke metode pembayaran awal dalam 3-5 hari kerja": "Funds will be returned to the original payment method within 3-5 business days",
    "Bagaimana cara mengubah password akun?": "How do I change my account password?",
    "Untuk mengubah password akun Anda:": "To change your account password:",
    "Masuk ke akun WisataKu Anda": "Log in to your WisataKu account",
    "Klik menu \"Pengaturan Akun\"": "Click the \"Account Settings\" menu",
    "Pilih \"Ubah Password\"": "Choose \"Change Password\"",
    "Masukkan password lama Anda": "Enter your old password",
    "Masukkan password baru (minimal 8 karakter)": "Enter a new password (minimum 8 characters)",
    "Konfirmasi password baru dan klik \"Simpan\"": "Confirm the new password and click \"Save\"",
    "Apakah data saya aman di WisataKu?": "Is my data safe on WisataKu?",
    "Ya, keamanan data Anda adalah prioritas utama kami. WisataKu menggunakan:": "Yes, your data security is our top priority. WisataKu uses:",
    "Enkripsi SSL 256-bit untuk semua transaksi": "256-bit SSL encryption for all transactions",
    "Sistem keamanan berlapis dengan proteksi fraud detection": "Layered security system with fraud detection protection",
    "Compliance dengan standar PCI DSS untuk keamanan data kartu kredit": "PCI DSS compliance for credit card data security",
    "Audit keamanan berkala oleh pihak ketiga independen": "Regular security audits by independent third parties",
    "Hubungi tim support kami": "Contact our support team",
    "Mulai Chat": "Start Chat",
    "Kirim Email": "Send Email",
    "Telepon": "Phone",
    "Hubungi": "Contact"
  };

  var reversePhraseTranslations = {};
  Object.keys(phraseTranslations).forEach(function (key) {
    reversePhraseTranslations[phraseTranslations[key]] = key;
  });

  function installGlobalThemeStyles() {
    if (document.getElementById("wisataku-global-theme-style")) {
      return;
    }

    var style = document.createElement("style");
    style.id = "wisataku-global-theme-style";
    style.textContent = [
      'html[data-theme="dark"]{color-scheme:dark;--bg:#101624;--white:#172033;--blue-pale:#17385f;--text-dark:#eef4ff;--text-mid:#c4cedd;--text-light:#8f9bad;--card-shadow:0 10px 30px rgba(0,0,0,.35);--card-shadow-hover:0 14px 38px rgba(0,0,0,.45);--shadow:0 18px 42px rgba(0,0,0,.35);}',
      'html[data-theme="dark"] body{background:#101624!important;color:#eef4ff!important;}',
      'html[data-theme="dark"] .navbar,html[data-theme="dark"] .profile-dropdown,html[data-theme="dark"] .mobile-nav-panel,html[data-theme="dark"] .form-container{background:#172033!important;color:#eef4ff!important;border-color:#2a3548!important;}',
      'html[data-theme="dark"] .card,html[data-theme="dark"] .dest-card,html[data-theme="dark"] .destination-card,html[data-theme="dark"] .category-card,html[data-theme="dark"] .promo-card,html[data-theme="dark"] .hotel-card,html[data-theme="dark"] .testimonial-card,html[data-theme="dark"] .info-card,html[data-theme="dark"] .content-card,html[data-theme="dark"] .booking-card,html[data-theme="dark"] .detail-card,html[data-theme="dark"] .ticket-card,html[data-theme="dark"] .stat-card{background:#172033!important;color:#eef4ff!important;border-color:#2a3548!important;box-shadow:0 10px 30px rgba(0,0,0,.35)!important;}',
      'html[data-theme="dark"] section,html[data-theme="dark"] .section,html[data-theme="dark"] .search-box,html[data-theme="dark"] .filter-box{border-color:#2a3548;}',
      'html[data-theme="dark"] p,html[data-theme="dark"] li,html[data-theme="dark"] span,html[data-theme="dark"] label,html[data-theme="dark"] td{color:inherit;}',
      'html[data-theme="dark"] h1,html[data-theme="dark"] h2,html[data-theme="dark"] h3,html[data-theme="dark"] h4{color:#eef4ff!important;}',
      'html[data-theme="dark"] a:not(.btn-primary):not(.buy-btn):not(.btn-claim){color:#8ec5ff;}',
      'html[data-theme="dark"] input,html[data-theme="dark"] select,html[data-theme="dark"] textarea{background:#111827!important;color:#eef4ff!important;border-color:#2a3548!important;}',
      'html[data-theme="dark"] img[src$=".svg"]{filter:brightness(0) invert(1);}'
    ].join("");

    (document.head || document.documentElement).appendChild(style);
  }

  function getSavedTheme() {
    try {
      return localStorage.getItem(storageKey) || "light";
    } catch (error) {
      return "light";
    }
  }

  function applyTheme(theme) {
    var nextTheme = theme === "dark" ? "dark" : "light";
    installGlobalThemeStyles();
    document.documentElement.setAttribute("data-theme", nextTheme);

    document.querySelectorAll("[data-theme-choice]").forEach(function (button) {
      var isActive = button.getAttribute("data-theme-choice") === nextTheme;
      button.classList.toggle("active", isActive);
      button.setAttribute("aria-pressed", isActive ? "true" : "false");
    });
  }

  function saveTheme(theme) {
    try {
      localStorage.setItem(storageKey, theme);
    } catch (error) {
      // Browser private mode can block storage; applying the theme is enough.
    }
    applyTheme(theme);
  }

  function getSavedLanguage() {
    try {
      return localStorage.getItem(languageKey) || "id";
    } catch (error) {
      return "id";
    }
  }

  function translateExactText(dictionary) {
    if (!document.body || !document.createTreeWalker) {
      return;
    }

    var walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, {
      acceptNode: function (node) {
        var parent = node.parentElement;
        if (!parent || parent.closest("script,style,noscript,textarea")) {
          return NodeFilter.FILTER_REJECT;
        }
        return node.nodeValue.trim() ? NodeFilter.FILTER_ACCEPT : NodeFilter.FILTER_REJECT;
      }
    });

    var nodes = [];
    var node;
    while ((node = walker.nextNode())) {
      nodes.push(node);
    }

    nodes.forEach(function (textNode) {
      var value = textNode.nodeValue;
      var trimmed = value.trim().replace(/^(?:←|â†)\s*/, "");
      var key = exactTextKeys[trimmed];
      if (!key || !dictionary[key]) {
        return;
      }

      var leading = value.match(/^\s*/)[0];
      var trailing = value.match(/\s*$/)[0];
      textNode.nodeValue = leading + dictionary[key] + trailing;
    });
  }

  function translatePlainText(language) {
    if (!document.body || !document.createTreeWalker) {
      return;
    }

    var phraseMap = language === "en" ? phraseTranslations : reversePhraseTranslations;
    var walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, {
      acceptNode: function (node) {
        var parent = node.parentElement;
        if (!parent || parent.closest("script,style,noscript,textarea")) {
          return NodeFilter.FILTER_REJECT;
        }
        return node.nodeValue.trim() ? NodeFilter.FILTER_ACCEPT : NodeFilter.FILTER_REJECT;
      }
    });

    var nodes = [];
    var node;
    while ((node = walker.nextNode())) {
      nodes.push(node);
    }

    nodes.forEach(function (textNode) {
      var value = textNode.nodeValue;
      var trimmed = value.trim();
      var translated = phraseMap[trimmed];

      if (!translated) {
        translated = trimmed;
        Object.keys(phraseMap).forEach(function (source) {
          translated = translated.split(source).join(phraseMap[source]);
        });
      }

      if (!translated || translated === trimmed) {
        return;
      }

      var leading = value.match(/^\s*/)[0];
      var trailing = value.match(/\s*$/)[0];
      textNode.nodeValue = leading + translated + trailing;
    });
  }

  function translateAttributes(language) {
    var phraseMap = language === "en" ? phraseTranslations : reversePhraseTranslations;
    ["placeholder", "title", "aria-label", "alt"].forEach(function (attribute) {
      document.querySelectorAll("[" + attribute + "]").forEach(function (element) {
        var value = element.getAttribute(attribute);
        if (phraseMap[value]) {
          element.setAttribute(attribute, phraseMap[value]);
        }
      });
    });
  }

  function applyLanguage(language) {
    var nextLanguage = language === "en" ? "en" : "id";
    var dictionary = translations[nextLanguage] || translations.id;
    document.documentElement.setAttribute("lang", nextLanguage);

    document.querySelectorAll("[data-i18n]").forEach(function (element) {
      var key = element.getAttribute("data-i18n");
      if (dictionary[key]) {
        element.textContent = dictionary[key];
      }
    });

    document.querySelectorAll("[data-i18n-placeholder]").forEach(function (element) {
      var key = element.getAttribute("data-i18n-placeholder");
      if (dictionary[key]) {
        element.setAttribute("placeholder", dictionary[key]);
      }
    });

    document.querySelectorAll("[data-language-select]").forEach(function (select) {
      select.value = nextLanguage;
    });

    translateExactText(dictionary);
    translatePlainText(nextLanguage);
    translateAttributes(nextLanguage);
  }

  function saveLanguage(language) {
    var nextLanguage = language === "en" ? "en" : "id";
    try {
      localStorage.setItem(languageKey, nextLanguage);
    } catch (error) {
      // Applying the language is enough when storage is blocked.
    }
    applyLanguage(nextLanguage);
  }

  installGlobalThemeStyles();
  applyTheme(getSavedTheme());

  document.addEventListener("DOMContentLoaded", function () {
    applyTheme(getSavedTheme());
    applyLanguage(getSavedLanguage());

    document.querySelectorAll("[data-theme-choice]").forEach(function (button) {
      button.addEventListener("click", function () {
        saveTheme(button.getAttribute("data-theme-choice"));
      });
    });

    document.querySelectorAll("[data-language-select]").forEach(function (select) {
      select.addEventListener("change", function () {
        saveLanguage(select.value);
      });
    });

    if (window.MutationObserver) {
      var languageObserverTimer = null;
      var observer = new MutationObserver(function () {
        clearTimeout(languageObserverTimer);
        languageObserverTimer = setTimeout(function () {
          applyLanguage(getSavedLanguage());
        }, 60);
      });
      observer.observe(document.body, { childList: true, subtree: true });
    }
  });
})();
