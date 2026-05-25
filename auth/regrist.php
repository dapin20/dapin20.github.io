<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Daftar</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="regrist.css?v=2.0" />
</head>
<body>
  <div class="container">
    <div class="left">
      <div class="logo">
        <div class="wave"></div>
        <img src="../images/logo.png" alt="Logo WisataKu" />
        <h1><span class=>Wisata</span>Ku</h1>
        <p>Jelajahi keindahan Malang Raya – Gunung, pantai selatan, dan budaya lokal.</p>
      </div>
    </div>

    <div class="right">
      <div class="card">
        <h2>Daftar Akun</h2>
        <p>Buat akun untuk melanjutkan pemesanan tiket wisata</p>

        <form>
          <label>Username</label>
          <input type="text" placeholder="" required />
            
          <label>Email </label>
          <input type="text" placeholder="" required />

          <label>Password</label>
          <input type="password" placeholder="" required />

          <a href="login.php" class="btn-submit">Daftar</a>
          <p class="register">Sudah punya akun?  <a href="login.php">Masuk</a></p>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
