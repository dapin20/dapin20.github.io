<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
$success = $_SESSION['success'] ?? '';
unset($_SESSION['errors'], $_SESSION['success']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <script src="../assets/js/theme.js?v=3.4"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WisataKu - Lupa Password</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
  <div class="login-container">
    <div class="login-card">
      <div class="login-header">
        <h1>Reset Password</h1>
        <p>Masukkan username dan email akun untuk membuat password baru.</p>
      </div>

      <?php if (!empty($errors)): ?>
        <div class="error-message"><?php echo htmlspecialchars(implode(' ', $errors)); ?></div>
      <?php endif; ?>

      <?php if ($success): ?>
        <div class="success-message"><?php echo htmlspecialchars($success); ?></div>
      <?php endif; ?>

      <form action="process_forgot_password.php" method="POST" class="login-form">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
          <label for="password">Password Baru</label>
          <input type="password" id="password" name="password" minlength="6" required>
        </div>

        <div class="form-group">
          <label for="confirm_password">Konfirmasi Password</label>
          <input type="password" id="confirm_password" name="confirm_password" minlength="6" required>
        </div>

        <button type="submit" class="login-btn">Reset Password</button>
      </form>

      <p class="register-link"><a href="login.php">Kembali ke Login</a></p>
    </div>
  </div>
</body>
</html>
