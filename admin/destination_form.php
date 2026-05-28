<?php
require_once('./_auth.php');

function admin_slugify($value) {
    $value = strtolower(trim($value));
    $value = preg_replace('/[^a-z0-9]+/', '-', $value);
    return trim($value, '-') ?: 'wisata-' . time();
}

$destinations = load_destinations();
$destinationId = $_GET['id'] ?? null;
$editing = false;
$destination = [
    'id' => '',
    'name' => '',
    'location' => '',
    'price' => 0,
    'rating' => 4.5,
    'image' => 'assets/images/background.png',
    'href' => 'user/wisata_alam/',
    'category' => 'wisata_alam',
    'popular' => false,
    'near' => true,
    'recommended' => false,
];

if ($destinationId) {
    $found = find_destination($destinationId);
    if ($found) {
        $destination = $found;
        $editing = true;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = trim($_POST['id'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $price = (int) ($_POST['price'] ?? 0);
    $rating = (float) ($_POST['rating'] ?? 0);
    $image = trim($_POST['image'] ?? '');
    $href = trim($_POST['href'] ?? '');
    $category = trim($_POST['category'] ?? 'wisata_alam');

    $payload = normalize_destination([
        'id' => $id !== '' ? $id : admin_slugify($name),
        'name' => $name,
        'location' => $location,
        'price' => $price,
        'rating' => $rating,
        'image' => ltrim($image, '/'),
        'href' => ltrim($href, '/'),
        'category' => $category,
        'popular' => isset($_POST['popular']),
        'near' => isset($_POST['near']),
        'recommended' => isset($_POST['recommended']),
    ]);

    $updated = [];
    $replaced = false;

    foreach ($destinations as $item) {
        if ($item['id'] === $payload['id']) {
            $updated[] = $payload;
            $replaced = true;
        } else {
            $updated[] = $item;
        }
    }

    if (!$replaced) {
        $updated[] = $payload;
    }

    save_destinations($updated);
    header('Location: destinations.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin WisataKu - <?php echo $editing ? 'Edit' : 'Tambah'; ?> Wisata</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin.css?v=1.0">
</head>
<body>
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <div class="admin-brand">
                <div class="admin-brand-badge">WK</div>
                <div>
                    <h2 class="admin-brand-title">Admin WisataKu</h2>
                    <p class="admin-brand-copy">Panel pengelolaan destinasi dan harga.</p>
                </div>
            </div>

            <nav class="admin-nav">
                <a href="home.php">Home Admin</a>
                <a href="dashboard.php">Dashboard</a>
                <a href="destinations.php" class="active">Kelola Wisata</a>
                <a href="../dashboard/home.php">Lihat Home User</a>
            </nav>

            <div class="admin-sidebar-footer">
                <a href="../auth/logout.php" class="admin-btn danger">Logout</a>
            </div>
        </aside>

        <main class="admin-content">
            <div class="admin-topbar">
                <div>
                    <p class="admin-eyebrow">Form wisata</p>
                    <h1><?php echo $editing ? 'Edit Wisata' : 'Tambah Wisata Baru'; ?></h1>
                    <p>Semua perubahan di sini langsung memengaruhi home user dan halaman favorite.</p>
                </div>
                <a href="destinations.php" class="admin-btn secondary">Kembali ke Daftar</a>
            </div>

            <form method="POST" class="admin-panel">
                <div class="admin-field">
                    <label for="id">ID Wisata</label>
                    <input id="id" name="id" type="text" value="<?php echo htmlspecialchars($destination['id']); ?>" <?php echo $editing ? 'readonly' : ''; ?>>
                </div>

                <div class="admin-field">
                    <label for="name">Nama Wisata</label>
                    <input id="name" name="name" type="text" value="<?php echo htmlspecialchars($destination['name']); ?>" required>
                </div>

                <div class="admin-field">
                    <label for="location">Lokasi</label>
                    <input id="location" name="location" type="text" value="<?php echo htmlspecialchars($destination['location']); ?>" required>
                </div>

                <div class="admin-field">
                    <label for="price">Harga</label>
                    <input id="price" name="price" type="number" min="0" value="<?php echo htmlspecialchars((string) $destination['price']); ?>" required>
                </div>

                <div class="admin-field">
                    <label for="rating">Rating</label>
                    <input id="rating" name="rating" type="number" min="0" max="5" step="0.1" value="<?php echo htmlspecialchars((string) $destination['rating']); ?>" required>
                </div>

                <div class="admin-field">
                    <label for="image">Path Gambar</label>
                    <input id="image" name="image" type="text" value="<?php echo htmlspecialchars($destination['image']); ?>" required>
                </div>

                <div class="admin-field">
                    <label for="href">Path Halaman Detail</label>
                    <input id="href" name="href" type="text" value="<?php echo htmlspecialchars($destination['href']); ?>" required>
                </div>

                <div class="admin-field">
                    <label for="category">Kategori</label>
                    <select id="category" name="category">
                        <option value="wisata_alam" <?php echo $destination['category'] === 'wisata_alam' ? 'selected' : ''; ?>>Wisata Alam</option>
                        <option value="wisata_buatan" <?php echo $destination['category'] === 'wisata_buatan' ? 'selected' : ''; ?>>Wisata Buatan</option>
                        <option value="wisata_edukasi" <?php echo $destination['category'] === 'wisata_edukasi' ? 'selected' : ''; ?>>Wisata Edukasi</option>
                    </select>
                </div>

                <div class="admin-field">
                    <label>Tampilkan di Section Home</label>
                    <div class="admin-checkboxes">
                        <label class="admin-check"><input type="checkbox" name="popular" <?php echo $destination['popular'] ? 'checked' : ''; ?>> Populer</label>
                        <label class="admin-check"><input type="checkbox" name="near" <?php echo $destination['near'] ? 'checked' : ''; ?>> Dekat Anda</label>
                        <label class="admin-check"><input type="checkbox" name="recommended" <?php echo $destination['recommended'] ? 'checked' : ''; ?>> Rekomendasi</label>
                    </div>
                </div>

                <button type="submit" class="admin-submit"><?php echo $editing ? 'Simpan Perubahan' : 'Tambah Wisata'; ?></button>
            </form>
        </main>
    </div>
</body>
</html>
