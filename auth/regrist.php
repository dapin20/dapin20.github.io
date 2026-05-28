<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Daftar</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="regrist.css?v=3.0" />
</head>
<body>
  <!-- Toast Container -->
  <div id="toastContainer" class="toast-container"></div>

  <div class="container">
    <div class="left">
      <div class="logo">
        <div class="wave"></div>
        <img src="../assets/logo/logo.png" alt="Logo WisataKu" />
        <h1><span class=>Wisata</span>Ku</h1>
        <p>Jelajahi keindahan Malang Raya – Gunung, pantai selatan, dan budaya lokal.</p>
      </div>
    </div>

    <div class="right">
      <div class="card">
        <h2>Daftar Akun</h2>
        <p>Buat akun untuk melanjutkan pemesanan tiket wisata</p>

        <?php
        session_start();
        $toastMessages = [];
        
        if (!empty($_SESSION['success'])): 
          $toastMessages[] = ['type' => 'success', 'message' => $_SESSION['success']];
          unset($_SESSION['success']); 
        endif; 
        
        if (!empty($_SESSION['errors'])): 
          foreach ($_SESSION['errors'] as $error):
            $toastMessages[] = ['type' => 'error', 'message' => $error];
          endforeach;
          unset($_SESSION['errors']); 
        endif; 
        ?>

        <form method="POST" action="process_register.php">
          <label>Username</label>
          <input type="text" name="username" placeholder="" required />
            
          <label>Email </label>
          <input type="email" name="email" placeholder="" required />

          <label>Password</label>
          <input type="password" name="password" placeholder="" required />

          <label>Konfirmasi Password</label>
          <input type="password" name="confirm_password" placeholder="" required />

          <button type="submit" class="btn-submit">Daftar</button>
          <p class="register">Sudah punya akun?  <a href="login.php">Masuk</a></p>
        </form>
      </div>
    </div>
  </div>

  <script>
    const toastMessages = <?php echo json_encode($toastMessages); ?>;
    
    function showToast(type, message) {
      const container = document.getElementById('toastContainer');
      const toast = document.createElement('div');
      toast.className = `toast toast-${type}`;
      
      const icon = type === 'success' ? '✓' : '⚠';
      toast.innerHTML = `<span class="toast-icon">${icon}</span><span class="toast-message">${message}</span>`;
      
      container.appendChild(toast);
      
      // Trigger animation
      setTimeout(() => toast.classList.add('show'), 10);
      
      // Remove after 4 seconds
      setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
      }, 4000);
    }
    
    // Show all messages
    toastMessages.forEach(msg => {
      showToast(msg.type, msg.message);
    });
  </script>
</body>
</html>

    <div class="right">
      <div class="card">
        <h2>Daftar Akun</h2>
        <p>Buat akun untuk melanjutkan pemesanan tiket wisata</p>

        <?php
        session_start();
        if (!empty($_SESSION['errors'])): ?>
          <div class="error-messages">
            <?php foreach ($_SESSION['errors'] as $error): ?>
              <div class="error-item">⚠ <?php echo htmlspecialchars($error); ?></div>
            <?php endforeach; ?>
          </div>
          <?php unset($_SESSION['errors']); ?>
        <?php endif; ?>

        <form method="POST" action="process_register.php">
          <label>Username</label>
          <input type="text" name="username" placeholder="" required />
            
          <label>Email </label>
          <input type="email" name="email" placeholder="" required />

          <label>Password</label>
          <input type="password" name="password" placeholder="" required />

          <label>Konfirmasi Password</label>
          <input type="password" name="confirm_password" placeholder="" required />

          <button type="submit" class="btn-submit">Daftar</button>
          <p class="register">Sudah punya akun?  <a href="login.php">Masuk</a></p>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
