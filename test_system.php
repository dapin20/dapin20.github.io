<?php
/**
 * TESTING FILE - Test Koneksi Database & Session
 * 
 * Buka di browser: http://localhost/PJBL/test_system.php
 */

session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Sistem Login - WisataKu</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .test-item { margin: 15px 0; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        .success { background-color: #d4edda; }
        .error { background-color: #f8d7da; }
    </style>
</head>
<body>
    <h1>🧪 Test Sistem Login WisataKu</h1>

    <div class="test-item">
        <h3>1. Test Koneksi Database</h3>
        <?php
            require_once('config/koneksi.php');
            
            if ($conn->ping()) {
                echo "<div class='success'>✓ Koneksi database BERHASIL</div>";
                
                // Test database existence
                $result = $conn->query("SHOW DATABASES LIKE 'wisata_ku'");
                if ($result->num_rows > 0) {
                    echo "<div class='success'>✓ Database 'wisata_ku' sudah ada</div>";
                    
                    // Test tables
                    $tables = ['users', 'admins'];
                    foreach ($tables as $table) {
                        $check = $conn->query("SHOW TABLES LIKE '$table'");
                        if ($check->num_rows > 0) {
                            echo "<div class='success'>✓ Tabel '$table' sudah ada</div>";
                        } else {
                            echo "<div class='error'>✗ Tabel '$table' TIDAK ada - Jalankan setup.php!</div>";
                        }
                    }
                } else {
                    echo "<div class='error'>✗ Database 'wisata_ku' belum ada - Jalankan setup.php!</div>";
                }
            } else {
                echo "<div class='error'>✗ Koneksi database GAGAL</div>";
            }
        ?>
    </div>

    <div class="test-item">
        <h3>2. Test Session</h3>
        <?php
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                echo "<div class='success'>✓ Session login aktif</div>";
                echo "<p>Username: " . htmlspecialchars($_SESSION['username']) . "</p>";
                echo "<p>User Type: " . htmlspecialchars($_SESSION['user_type']) . "</p>";
            } else {
                echo "<div class='success'>✓ Session belum ada (normal untuk kondisi tidak login)</div>";
            }
        ?>
    </div>

    <div class="test-item">
        <h3>3. Test File Eksistensi</h3>
        <?php
            $files_check = [
                'config/koneksi.php' => 'Database Connection',
                'config/auth_helper.php' => 'Auth Helper',
                'auth/login.php' => 'User Login Form',
                'auth/regrist.php' => 'User Register Form',
                'auth/process_login.php' => 'Login Processor',
                'auth/process_register.php' => 'Register Processor',
                'auth/logout.php' => 'Logout Handler',
                'admin/index.php' => 'Admin Login Form',
                'admin/home.php' => 'Admin Home',
                'admin/dashboard.php' => 'Admin Dashboard',
                'admin/destinations.php' => 'Admin Destination Manager',
            ];

            foreach ($files_check as $file => $desc) {
                if (file_exists($file)) {
                    echo "<div class='success'>✓ $file - $desc</div>";
                } else {
                    echo "<div class='error'>✗ $file - $desc (MISSING)</div>";
                }
            }
        ?>
    </div>

    <div class="test-item">
        <h3>4. Test BCrypt Password Hashing</h3>
        <?php
            $test_password = "test123";
            $hashed = password_hash($test_password, PASSWORD_BCRYPT);
            $verified = password_verify($test_password, $hashed);
            
            if ($verified) {
                echo "<div class='success'>✓ BCrypt hashing berfungsi dengan baik</div>";
            } else {
                echo "<div class='error'>✗ BCrypt hashing ERROR</div>";
            }
        ?>
    </div>

    <div class="test-item">
        <h3>5. Test Admin Default Account</h3>
        <?php
            $query = "SELECT id, username, email FROM admins WHERE username = 'admin' LIMIT 1";
            $result = $conn->query($query);
            
            if ($result && $result->num_rows > 0) {
                $admin = $result->fetch_assoc();
                echo "<div class='success'>✓ Admin default account sudah ada</div>";
                echo "<ul>";
                echo "<li>ID: " . $admin['id'] . "</li>";
                echo "<li>Username: " . htmlspecialchars($admin['username']) . "</li>";
                echo "<li>Email: " . htmlspecialchars($admin['email']) . "</li>";
                echo "</ul>";
            } else {
                echo "<div class='error'>✗ Admin default account TIDAK ditemukan</div>";
            }
        ?>
    </div>

    <div class="test-item">
        <h3>6. Quick Links untuk Testing</h3>
        <ul>
            <li><a href="auth/login.php" target="_blank">Login User</a></li>
            <li><a href="auth/regrist.php" target="_blank">Register User</a></li>
            <li><a href="admin/index.php" target="_blank">Login Admin</a></li>
            <li><a href="dashboard/home.php" target="_blank">User Dashboard</a></li>
            <li><a href="admin/home.php" target="_blank">Admin Home</a></li>
            <li><a href="admin/dashboard.php" target="_blank">Admin Dashboard</a></li>
            <li><a href="admin/destinations.php" target="_blank">Kelola Wisata</a></li>
        </ul>
    </div>

    <hr>
    <p><small>🧪 Halaman testing ini. Hapus setelah development selesai untuk keamanan.</small></p>
</body>
</html>

<?php
$conn->close();
?>
