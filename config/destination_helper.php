<?php

function destination_storage_path() {
    return __DIR__ . '/../data/destinations.json';
}

function destination_defaults() {
    return [
        [
            'id' => 'bromo',
            'name' => 'Gunung Bromo',
            'location' => 'Probolinggo',
            'price' => 150000,
            'rating' => 4.9,
            'image' => 'assets/images/Bromo.png',
            'href' => 'user/wisata_alam/Bromo.php',
            'category' => 'wisata_alam',
            'popular' => true,
            'near' => true,
            'recommended' => true,
        ],
        [
            'id' => 'pantai-balekambang',
            'name' => 'Pantai Balekambang',
            'location' => 'Malang Selatan',
            'price' => 25000,
            'rating' => 4.7,
            'image' => 'assets/images/Kondang.png',
            'href' => 'user/wisata_alam/PantaiNgudel.php',
            'category' => 'wisata_alam',
            'popular' => true,
            'near' => true,
            'recommended' => false,
        ],
        [
            'id' => 'tumpak-sewu',
            'name' => 'Tumpak Sewu',
            'location' => 'Lumajang',
            'price' => 20000,
            'rating' => 4.8,
            'image' => 'assets/images/Tumpak.png',
            'href' => 'user/wisata_alam/TumpakSewu.php',
            'category' => 'wisata_alam',
            'popular' => true,
            'near' => true,
            'recommended' => true,
        ],
        [
            'id' => 'ranu-regulo',
            'name' => 'Ranu Regulo',
            'location' => 'Malang',
            'price' => 30000,
            'rating' => 4.6,
            'image' => 'assets/images/ranu_regulo.jpg',
            'href' => 'user/wisata_alam/RanuRegulo.php',
            'category' => 'wisata_alam',
            'popular' => true,
            'near' => true,
            'recommended' => true,
        ],
        [
            'id' => 'gunung-buthak',
            'name' => 'Gunung Buthak',
            'location' => 'Malang',
            'price' => 50000,
            'rating' => 4.8,
            'image' => 'assets/images/buthak.jpg',
            'href' => 'user/wisata_alam/GunungButhak.php',
            'category' => 'wisata_alam',
            'popular' => true,
            'near' => true,
            'recommended' => true,
        ],
        [
            'id' => 'ranu-kumbolo',
            'name' => 'Ranu Kumbolo',
            'location' => 'Malang',
            'price' => 45000,
            'rating' => 4.9,
            'image' => 'assets/images/ranu_kumbolo.jpg',
            'href' => 'user/wisata_alam/RanuKumbolo.php',
            'category' => 'wisata_alam',
            'popular' => false,
            'near' => true,
            'recommended' => false,
        ],
        [
            'id' => 'jatim-park-1',
            'name' => 'Jatim Park 1',
            'location' => 'Batu',
            'price' => 120000,
            'rating' => 4.8,
            'image' => 'assets/images/Edukasi.png',
            'href' => 'user/wisata_buatan/JatimPark1.php',
            'category' => 'wisata_buatan',
            'popular' => false,
            'near' => false,
            'recommended' => true,
        ],
        [
            'id' => 'eco-green-park',
            'name' => 'Eco Green Park',
            'location' => 'Batu',
            'price' => 90000,
            'rating' => 4.7,
            'image' => 'assets/images/OverlayEdukasi.png',
            'href' => 'user/wisata_edukasi/EcoGreenPark.php',
            'category' => 'wisata_edukasi',
            'popular' => false,
            'near' => false,
            'recommended' => true,
        ],
    ];
}

function normalize_destination($destination) {
    return [
        'id' => (string) ($destination['id'] ?? ''),
        'name' => (string) ($destination['name'] ?? ''),
        'location' => (string) ($destination['location'] ?? ''),
        'price' => (int) ($destination['price'] ?? 0),
        'rating' => (float) ($destination['rating'] ?? 0),
        'image' => (string) ($destination['image'] ?? ''),
        'href' => (string) ($destination['href'] ?? '#'),
        'category' => (string) ($destination['category'] ?? 'wisata_alam'),
        'popular' => !empty($destination['popular']),
        'near' => !empty($destination['near']),
        'recommended' => !empty($destination['recommended']),
    ];
}

function ensure_destination_storage() {
    $path = destination_storage_path();
    $dir = dirname($path);

    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    if (!file_exists($path)) {
        file_put_contents(
            $path,
            json_encode(destination_defaults(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );
    }
}

function load_destinations() {
    ensure_destination_storage();

    $raw = file_get_contents(destination_storage_path());
    $decoded = json_decode($raw, true);

    if (!is_array($decoded)) {
        $decoded = destination_defaults();
    }

    return array_values(array_map('normalize_destination', $decoded));
}

function save_destinations($destinations) {
    ensure_destination_storage();

    $normalized = array_values(array_map('normalize_destination', $destinations));

    file_put_contents(
        destination_storage_path(),
        json_encode($normalized, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
    );
}

function find_destination($id) {
    foreach (load_destinations() as $destination) {
        if ($destination['id'] === $id) {
            return $destination;
        }
    }

    return null;
}

function destination_filter($destinations, $flag) {
    return array_values(array_filter($destinations, function ($destination) use ($flag) {
        return !empty($destination[$flag]);
    }));
}

function destination_price_label($price) {
    return 'Rp ' . number_format((int) $price, 0, ',', '.');
}

function destination_root_path($path, $prefix = '') {
    if ($path === '') {
        return '#';
    }

    return $prefix . ltrim($path, '/');
}

function destination_payload($destination, $prefix = '') {
    return [
        'id' => $destination['id'],
        'name' => $destination['name'],
        'location' => $destination['location'],
        'price' => (int) $destination['price'],
        'rating' => (float) $destination['rating'],
        'image' => destination_root_path($destination['image'], $prefix),
        'href' => destination_root_path($destination['href'], $prefix),
        'category' => $destination['category'],
    ];
}

