<?php

const WISATAKU_BANK_NAME = 'Bank BCA';
const WISATAKU_BANK_ACCOUNT = '8392017465';
const WISATAKU_BANK_HOLDER = 'WisataKu';

function ensure_order_payment_columns($conn) {
    $columns = [
        'payment_proof' => "ALTER TABLE orders ADD COLUMN payment_proof VARCHAR(255) DEFAULT NULL AFTER payment_method",
        'verified_at' => "ALTER TABLE orders ADD COLUMN verified_at DATETIME DEFAULT NULL AFTER payment_proof",
    ];

    foreach ($columns as $column => $sql) {
        $check = $conn->query("SHOW COLUMNS FROM orders LIKE '" . $conn->real_escape_string($column) . "'");
        if ($check && $check->num_rows === 0) {
            $conn->query($sql);
        }
    }
}

function order_status_label($status, $paymentProof = null) {
    if ($status === 'success') {
        return 'Diterima';
    }

    if ($status === 'failed') {
        return 'Ditolak';
    }

    if ($status === 'cancelled') {
        return 'Dibatalkan';
    }

    return $paymentProof ? 'Menunggu Verifikasi Admin' : 'Menunggu Upload Bukti';
}

function order_status_class($status) {
    if ($status === 'success') {
        return 'status-berhasil';
    }

    if ($status === 'failed' || $status === 'cancelled') {
        return 'status-gagal';
    }

    return 'status-pending';
}

function order_price_label($price) {
    return 'Rp ' . number_format((int) $price, 0, ',', '.');
}

function ensure_payment_upload_dir() {
    $dir = __DIR__ . '/../assets/uploads/payment_proofs';

    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    return $dir;
}

function normalize_order_number($number) {
    return trim((string) $number);
}

?>
