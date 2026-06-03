<?php
require_once('./_auth.php');
require_once('../config/koneksi.php');
require_once('../config/order_helper.php');
require_once('../config/admin_ticket_helper.php');

ensure_order_payment_columns($conn);
ensure_destination_admin_column($conn);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tickets.php');
    exit;
}

$orderId = (int) ($_POST['order_id'] ?? 0);
$action = $_POST['action'] ?? '';

if ($orderId > 0 && in_array($action, ['accept', 'reject'], true)) {
    $accessSql = "SELECT o.id
                  FROM orders o
                  JOIN destinations d ON o.destination_id = d.id
                  WHERE o.id = ?";
    if (!$isSuperAdmin) {
        $accessSql .= " AND d.admin_id = ?";
    }

    $accessStmt = $conn->prepare($accessSql);
    if ($isSuperAdmin) {
        $accessStmt->bind_param("i", $orderId);
    } else {
        $accessStmt->bind_param("ii", $orderId, $adminId);
    }
    $accessStmt->execute();
    $canUpdate = $accessStmt->get_result()->num_rows === 1;
    $accessStmt->close();

    if (!$canUpdate) {
        header('Location: tickets.php');
        exit;
    }

    if ($action === 'accept') {
        $stmt = $conn->prepare("UPDATE orders SET status = 'success', verified_at = NOW() WHERE id = ?");
    } else {
        $stmt = $conn->prepare("UPDATE orders SET status = 'failed', verified_at = NOW() WHERE id = ?");
    }

    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $stmt->close();
}

header('Location: tickets.php');
exit;
?>
