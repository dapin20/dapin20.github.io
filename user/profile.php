<?php
session_start();
require_once(__DIR__ . '/../config/auth_helper.php');
require_once(__DIR__ . '/../config/koneksi.php');

checkLogin();
$sess = getUserInfo();
$user_id = $sess['id'] ?? null;

$message = '';

if (!$user_id) {
    header('Location: ../auth/login.php');
    exit;
}

// handle POST update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $phone = trim($_POST['phone'] ?? '');
  $alamat = trim($_POST['alamat'] ?? '');

  // basic validation
  if ($username === '' || $email === '') {
    $message = 'Nama pengguna dan email tidak boleh kosong.';
  } else {
    // check email uniqueness
    $check = $conn->prepare('SELECT COUNT(*) AS cnt FROM users WHERE email = ? AND id <> ?');
    $check->bind_param('si', $email, $user_id);
    $check->execute();
    $r = $check->get_result()->fetch_assoc();
    $check->close();

    if (!empty($r['cnt'])) {
      $message = 'Email sudah digunakan oleh akun lain.';
    } else {
      // handle avatar upload if provided
      $avatar_path = null;
      if (!empty($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $allowed = ['image/jpeg','image/png','image/webp'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES['avatar']['tmp_name']);
        finfo_close($finfo);

        if (in_array($mime, $allowed)) {
          $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
          $dir = __DIR__ . '/../assets/images/avatars';
          if (!is_dir($dir)) mkdir($dir, 0755, true);
          $filename = $user_id . '_' . time() . '.' . $ext;
          $dest = $dir . '/' . $filename;
          if (move_uploaded_file($_FILES['avatar']['tmp_name'], $dest)) {
            $avatar_path = 'assets/images/avatars/' . $filename;
          }
        }
      }

      if ($avatar_path !== null) {
        $stmt = $conn->prepare('UPDATE users SET username = ?, email = ?, no_telpon = ?, alamat = ?, avatar = ?, updated_at = NOW() WHERE id = ?');
        $stmt->bind_param('sssssi', $username, $email, $phone, $alamat, $avatar_path, $user_id);
      } else {
        $stmt = $conn->prepare('UPDATE users SET username = ?, email = ?, no_telpon = ?, alamat = ?, updated_at = NOW() WHERE id = ?');
        $stmt->bind_param('ssssi', $username, $email, $phone, $alamat, $user_id);
      }

      if ($stmt->execute()) {
        // update session
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        if ($avatar_path !== null) {
            $_SESSION['avatar'] = $avatar_path;
        }
        $message = 'Profil berhasil diperbarui.';
      } else {
        $message = 'Gagal menyimpan perubahan. Coba lagi.';
      }
      $stmt->close();
    }
  }
}

// load current user data
$ensureCol = $conn->query("SHOW COLUMNS FROM users LIKE 'avatar'");
if ($ensureCol && $ensureCol->num_rows === 0) {
  $conn->query("ALTER TABLE users ADD COLUMN avatar VARCHAR(255) DEFAULT NULL AFTER alamat");
}

$stmt = $conn->prepare('SELECT username, email, no_telpon, alamat, created_at, avatar FROM users WHERE id = ? LIMIT 1');
$stmt->bind_param('i', $user_id);
$stmt->execute();
$res = $stmt->get_result();
$user = $res->fetch_assoc() ?: [];
$stmt->close();
if (!empty($user['avatar'])) {
    $_SESSION['avatar'] = $user['avatar'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Profil Saya</title>
  <script src="../assets/js/theme.js?v=3.4"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="account-theme.css?v=3.0" />
  <link rel="stylesheet" href="profile.css?v=2.0" />
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
    <li><a href="profile.php" class="menu-item active">
      <span class="menu-icon">
        <img src="../assets/icon/user-circle.svg" width="24" height="24" alt="Profil">
      </span>
      <span>Profil Saya</span>
    </a></li>

    <li><a href="../orders/pesanan.php" class="menu-item">
      <span class="menu-icon">
        <img src="../assets/icon/ticket.svg" width="24" height="24" alt="Pesanan">
      </span>
      <span>Pesanan Saya</span>
    </a></li>

    <li><a href="../orders/riwayat.php" class="menu-item">
      <span class="menu-icon">
        <img src="../assets/icon/Note.svg" width="24" height="24" alt="Riwayat">
      </span>
      <span>Riwayat Transaksi</span>
    </a></li>

    <li><a href="../orders/pembayaran.php" class="menu-item">
      <span class="menu-icon">
        <img src="../assets/icon/credit-card.svg" width="24" height="24" alt="Pembayaran">
      </span>
      <span>Metode Pembayaran</span>
    </a></li>

    <li><a href="../wishlist/whistlist.php" class="menu-item">
      <span class="menu-icon">
        <img src="../assets/icon/save.svg" width="24" height="24" alt="Favorite">
      </span>
      <span>Favorite Saya</span>
    </a></li>

    <li><a href="../help/bantuan.php" class="menu-item">
      <span class="menu-icon">
        <img src="../assets/icon/question.svg" width="24" height="24" alt="Bantuan">
      </span>
      <span>Bantuan & Dukungan</span>
    </a></li>
  </ul>
</nav>
      <button class="btn-logout" onclick="window.location.href='../auth/logout.php'"><span>Keluar</span></button>
    </aside>

    <main class="profile-content">
      <div class="profile-header">
        <a href="../dashboard/home.php" class="btn-back">← Kembali ke Beranda</a>
        <p class="profile-subtitle">Kelola informasi akun dan data kontak Anda di satu tempat.</p>
      </div>

      <section class="profile-hero">
        <div class="profile-avatar-wrap">
          <div class="profile-avatar">
              <?php $avatarSrc = '../' . ($user['avatar'] ?? 'assets/images/dapin kecil.jpg'); ?>
              <img id="profileAvatarImg" src="<?php echo htmlspecialchars($avatarSrc); ?>" alt="Avatar Profil" />
            </div>
            <label class="avatar-badge" for="avatarInput" style="cursor:pointer">✎</label>
        </div>
        <div class="profile-identity">
          <h1 class="profile-name"><?php echo htmlspecialchars($user['username'] ?? ''); ?></h1>
          <p class="profile-email"><?php echo htmlspecialchars($user['email'] ?? ''); ?></p>
          <p class="profile-location"><?php echo htmlspecialchars($user['alamat'] ?? ''); ?></p>
        </div>
      </section>

      <section class="profile-panel">
        <div class="panel-header">
          <h2 class="section-title">Informasi Akun</h2>
          <p class="panel-note">Tampilan baru mengikuti layout form profil, tanpa banyak gradient.</p>
        </div>
        <form method="post" enctype="multipart/form-data" class="info-grid">
          <input id="avatarInput" name="avatar" type="file" accept="image/*" style="display:none">
          <?php if ($message): ?>
            <div class="field-group" style="grid-column:1/-1;color:#1f8f5f;font-weight:700;"><?php echo htmlspecialchars($message); ?></div>
          <?php endif; ?>

          <div class="field-group">
            <label for="username">Nama Pengguna</label>
            <input id="username" name="username" type="text" value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>">
          </div>

          <div class="field-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>">
          </div>

          <div class="field-group">
            <label for="phone">Nomor Telepon</label>
            <input id="phone" name="phone" type="text" value="<?php echo htmlspecialchars($user['no_telpon'] ?? ''); ?>">
          </div>

          <div class="field-group" style="grid-column:1/-1;">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat"><?php echo htmlspecialchars($user['alamat'] ?? ''); ?></textarea>
          </div>

          <div class="field-group">
            <label for="joined">Tanggal Bergabung</label>
            <input id="joined" type="text" value="<?php echo htmlspecialchars(date('j F Y', strtotime($user['created_at'] ?? 'now'))); ?>" readonly>
          </div>

          <div class="panel-actions" style="grid-column:1/-1;">
            <button type="submit" class="btn-save">Simpan Perubahan</button>
          </div>
        </form>
      </section>

      <section class="activity-section">
        <h2 class="section-title">Aktivitas Terakhir</h2>
        <div class="activity-list">
          <div class="activity-item">
            <div>
              <p class="activity-name">Pemesanan Tiket Bromo</p>
              <p class="activity-meta">Reservasi wisata alam</p>
            </div>
            <span class="activity-date">2 hari lalu</span>
          </div>
          <div class="activity-item">
            <div>
              <p class="activity-name">Pemesanan Tiket Coban Rondo</p>
              <p class="activity-meta">Reservasi destinasi air terjun</p>
            </div>
            <span class="activity-date">5 hari lalu</span>
          </div>
          <div class="activity-item">
            <div>
              <p class="activity-name">Pemesanan Tiket Jatim Park 2</p>
              <p class="activity-meta">Reservasi wisata keluarga</p>
            </div>
            <span class="activity-date">1 minggu lalu</span>
          </div>
        </div>
      </section>
    </main>
  </div>

<script>
  const avatarInput = document.getElementById('avatarInput');
  const avatarImg = document.getElementById('profileAvatarImg');
  const avatarBadge = document.querySelector('.avatar-badge');

  avatarBadge && avatarBadge.addEventListener('click', function(e){
    avatarInput && avatarInput.click();
  });

  avatarInput && avatarInput.addEventListener('change', function(){
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) { avatarImg.src = e.target.result; };
    reader.readAsDataURL(file);
  });
</script>
</body>
</html>
