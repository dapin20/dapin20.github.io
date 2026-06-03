<?php
session_start();
require_once('../config/auth_helper.php');
require_once('../config/koneksi.php');
require_once('../config/order_helper.php');

checkLogin('user');
ensure_order_payment_columns($conn);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../dashboard/home.php');
    exit;
}

$userId = (int) $_SESSION['user_id'];
$destinationId = trim($_POST['destination_id'] ?? '');
$destinationName = trim($_POST['destination_name'] ?? '');
$destinationHref = trim($_POST['destination_href'] ?? '');
$price = max(0, (int) ($_POST['price'] ?? 0));
$quantity = max(1, (int) ($_POST['quantity'] ?? 1));
$visitDate = trim($_POST['visit_date'] ?? '');

if ($destinationId === '' || $destinationName === '' || $price <= 0 || $visitDate === '') {
    $_SESSION['errors'] = ['Data pemesanan belum lengkap. Pilih tanggal dan jumlah tiket terlebih dahulu.'];
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '../dashboard/home.php'));
    exit;
}

$dateCheck = DateTime::createFromFormat('Y-m-d', $visitDate);
if (!$dateCheck || $dateCheck->format('Y-m-d') !== $visitDate) {
    $_SESSION['errors'] = ['Format tanggal kunjungan tidak valid.'];
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '../dashboard/home.php'));
    exit;
}

$total = $price * $quantity;
$orderNumber = 'WK-' . date('Ymd') . '-' . strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));

$destinationCheck = $conn->prepare("SELECT id FROM destinations WHERE id = ?");
$destinationCheck->bind_param("s", $destinationId);
$destinationCheck->execute();
$destinationExists = $destinationCheck->get_result()->num_rows > 0;
$destinationCheck->close();

if (!$destinationExists) {
    $image = 'assets/images/background.png';
    $location = 'Malang Raya';
    $category = 'wisata_alam';
    $rating = 4.7;
    $popular = 0;
    $near = 0;
    $recommended = 0;

    $insertDestination = $conn->prepare(
        "INSERT INTO destinations (id, name, location, price, rating, image, href, category, popular, near, recommended)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );
    $insertDestination->bind_param(
        "sssidsssiii",
        $destinationId,
        $destinationName,
        $location,
        $price,
        $rating,
        $image,
        $destinationHref,
        $category,
        $popular,
        $near,
        $recommended
    );
    $insertDestination->execute();
    $insertDestination->close();
}

$paymentMethod = WISATAKU_BANK_NAME;
$stmt = $conn->prepare(
    "INSERT INTO orders (order_number, user_id, destination_id, quantity, total_price, visit_date, status, payment_method)
     VALUES (?, ?, ?, ?, ?, ?, 'pending', ?)"
);
$stmt->bind_param("sisiiss", $orderNumber, $userId, $destinationId, $quantity, $total, $visitDate, $paymentMethod);
$stmt->execute();
$stmt->close();

header('Location: pembayaran.php?order=' . urlencode($orderNumber));
exit;
?>
