<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WisataKu - Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="loginadmin.css?v=2.0" />
</head>
<body>
  <div class="container">
    <div class="left">
      <div class="logo">
        <div class="wave"></div>
        <img src="../images/logo.png" alt="Logo WisataKu" />
        <h1><span class=>Wisata</span>Ku</h1>
        <h2>Selamat Datang Admin</h2>
        <p>Kelola pemesanan tiket wisata Malang Raya
dengan mudah & profesional.</p>
      </div>
    </div>

    <div class="right">
      <div class="card">
        <h2>WisataKu </h2>
        <p>Login Admin</p>

        <form action="../PJBL WEB/DashborAdmin.php" method="GET">
          <label>Username </label>
          <input type="text" placeholder="" required />

          <label>Password</label>
          <input type="password" placeholder="" required />

          <button type="submit">Masuk</button>
          <p class="register"><a href="index.php">← Kembali ke Halaman Utama</a></p>
        </form>
      </div>
    </div>
  </div>
</body>
</html>

