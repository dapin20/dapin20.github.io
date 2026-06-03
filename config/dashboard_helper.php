<?php
require_once('../config/koneksi.php');

// 1. Fungsi Fetch Destinasi (DB version)
function load_destinations_db() {
    global $conn;
    $result = $conn->query("SELECT * FROM destinations");
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

// 2. Fungsi Filter Destinasi
function destination_filter_db($destinations, $key) {
    return array_filter($destinations, function($d) use ($key) {
        return !empty($d[$key]);
    });
}

// 3. Label Harga
function destination_price_label_db($price) {
    if ($price == 0) return 'Gratis';
    return 'Rp ' . number_format($price, 0, ',', '.');
}

// 4. Statistik Keseluruhan
function get_overall_stats() {
    global $conn;
    $stats = [];
    
    // Total Wisata
    $res = $conn->query("SELECT COUNT(*) as total FROM destinations");
    $stats['total_wisata'] = $res->fetch_assoc()['total'];
    
    // Total User
    $res = $conn->query("SELECT COUNT(*) as total FROM users");
    $stats['total_user'] = $res->fetch_assoc()['total'];
    
    // Total Pendapatan (dari orders status success)
    $res = $conn->query("SELECT SUM(total_price) as income FROM orders WHERE status = 'success'");
    $stats['income'] = $res->fetch_assoc()['income'] ?? 0;
    
    // Tiket Terjual
    $res = $conn->query("SELECT SUM(quantity) as sold FROM orders WHERE status = 'success'");
    $stats['tickets_sold'] = $res->fetch_assoc()['sold'] ?? 0;
    
    return $stats;
}
?>
