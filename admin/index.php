<?php
session_start();

if (!empty($_SESSION['logged_in']) && ($_SESSION['user_type'] ?? '') === 'admin') {
    header('Location: home.php');
    exit;
}

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin WisataKu</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin.css?v=1.0">
</head>
<body>
    <div class="admin-auth">
        <div class="admin-auth-card">
            <section class="admin-auth-hero">
                <div class="admin-auth-logo">
                    <img src="../assets/logo/logo.png" alt="Logo WisataKu">
                </div>
                <div>
                    <p class="admin-eyebrow" style="color:#d8ebff;">Panel Internal</p>
                    <h1 class="admin-auth-title">Login Admin untuk kelola wisata, harga, dan tampilan home.</h1>
                    <p class="admin-auth-copy">Semua perubahan di panel ini langsung terhubung ke daftar destinasi pada halaman user dan wishlist.</p>
                </div>
                <div class="admin-auth-points">
                    <div class="admin-auth-point"><span>01</span><span>Edit harga tiket dan rating.</span></div>
                    <div class="admin-auth-point"><span>02</span><span>Tambah wisata baru ke data utama.</span></div>
                    <div class="admin-auth-point"><span>03</span><span>Atur wisata yang tampil di home dan favorite.</span></div>
                </div>
            </section>

            <section class="admin-auth-form">
                <p class="admin-eyebrow">Admin Access</p>
                <h2 class="admin-form-title">Masuk ke Panel Admin</h2>
                <p class="admin-form-copy">Gunakan akun admin yang tersimpan pada database. Setelah login Anda akan diarahkan ke home admin.</p>

                <?php if (!empty($errors)): ?>
                <div class="admin-alert">
                    <?php foreach ($errors as $error): ?>
                    <div><?php echo htmlspecialchars($error); ?></div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <form method="POST" action="../auth/process_login.php">
                    <input type="hidden" name="user_type" value="admin">

                    <div class="admin-field">
                        <label for="username">Username</label>
                        <input id="username" name="username" type="text" required>
                    </div>

                    <div class="admin-field">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" required>
                    </div>

                    <button type="submit" class="admin-submit">Login Admin</button>
                </form>

                <p class="admin-form-copy" style="margin-top:20px;">
                    <a href="../dashboard/home.php" style="text-decoration:none;color:var(--admin-primary);font-weight:700;">← Kembali ke halaman user</a>
                </p>
            </section>
        </div>
    </div>
</body>
</html>
