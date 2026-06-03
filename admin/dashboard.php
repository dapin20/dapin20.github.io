<?php
require_once('./_auth.php');
require_once('../config/koneksi.php');
require_once('../config/order_helper.php');
require_once('../config/admin_ticket_helper.php');
require_super_admin();

ensure_order_payment_columns($conn);
ensure_destination_admin_column($conn);

$stats = [
    'total_destinations' => 0,
    'total_ticket_admins' => 0,
    'tickets_sold' => 0,
    'income' => 0,
];

$result = $conn->query("SELECT COUNT(*) AS total FROM destinations");
$stats['total_destinations'] = $result ? (int) $result->fetch_assoc()['total'] : 0;

$result = $conn->query("SELECT COUNT(*) AS total FROM admins WHERE role = 'ticket_admin'");
$stats['total_ticket_admins'] = $result ? (int) $result->fetch_assoc()['total'] : 0;

$result = $conn->query("SELECT COALESCE(SUM(quantity), 0) AS sold, COALESCE(SUM(total_price), 0) AS income FROM orders WHERE status = 'success'");
if ($result) {
    $row = $result->fetch_assoc();
    $stats['tickets_sold'] = (int) $row['sold'];
    $stats['income'] = (int) $row['income'];
}

$salesByDestination = $conn->query(
    "SELECT d.id, d.name, d.location, a.username AS admin_name,
            COUNT(o.id) AS total_orders,
            COALESCE(SUM(CASE WHEN o.status = 'success' THEN o.quantity ELSE 0 END), 0) AS tickets_sold,
            COALESCE(SUM(CASE WHEN o.status = 'success' THEN o.total_price ELSE 0 END), 0) AS income
     FROM destinations d
     LEFT JOIN admins a ON d.admin_id = a.id
     LEFT JOIN orders o ON o.destination_id = d.id
     GROUP BY d.id, d.name, d.location, a.username
     ORDER BY income DESC, total_orders DESC, d.name ASC"
);

$salesRows = [];
if ($salesByDestination) {
    while ($row = $salesByDestination->fetch_assoc()) {
        $salesRows[] = $row;
    }
}

$chartRows = array_slice($salesRows, 0, 4);
$maxTicketsSold = 1;
foreach ($chartRows as $row) {
    $maxTicketsSold = max($maxTicketsSold, (int) $row['tickets_sold']);
}

$statusCounts = [
    'success' => 0,
    'pending' => 0,
    'failed' => 0,
    'unpaid' => 0,
];

$statusResult = $conn->query("SELECT status, COUNT(*) AS total FROM orders GROUP BY status");
if ($statusResult) {
    while ($row = $statusResult->fetch_assoc()) {
        $status = $row['status'] ?: 'unpaid';
        if (!isset($statusCounts[$status])) {
            $statusCounts[$status] = 0;
        }
        $statusCounts[$status] += (int) $row['total'];
    }
}

$totalStatus = max(1, array_sum($statusCounts));
$successEnd = ($statusCounts['success'] / $totalStatus) * 100;
$pendingEnd = $successEnd + (($statusCounts['pending'] / $totalStatus) * 100);
$failedEnd = $pendingEnd + (($statusCounts['failed'] / $totalStatus) * 100);

$recentOrders = $conn->query(
    "SELECT o.order_number, o.quantity, o.total_price, o.status, o.created_at,
            d.name AS destination_name, a.username AS admin_name
     FROM orders o
     JOIN destinations d ON o.destination_id = d.id
     LEFT JOIN admins a ON d.admin_id = a.id
     ORDER BY o.created_at DESC
     LIMIT 8"
);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <script src="../assets/js/theme.js?v=3.4"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin WisataKu - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin.css?v=1.0">
</head>
<body>
    <div class="admin-shell">
        <?php render_admin_sidebar('dashboard', admin_role_label($adminRole) . ' - fitur lengkap.'); ?>

        <main class="admin-content">
            <div class="admin-topbar">
                <div>
                    <p class="admin-eyebrow">Ringkasan</p>
                    <h1>Dashboard Admin</h1>
                    <p>Ringkasan penjualan tiket dari setiap wisata yang dikelola oleh admin tiket.</p>
                </div>
                <a href="destinations.php" class="admin-btn">Cek Wisata</a>
            </div>

            <section class="admin-stats">
                <article class="admin-stat">
                    <span>Total wisata</span>
                    <strong><?php echo $stats['total_destinations']; ?></strong>
                </article>
                <article class="admin-stat">
                    <span>Admin tiket</span>
                    <strong><?php echo $stats['total_ticket_admins']; ?></strong>
                </article>
                <article class="admin-stat">
                    <span>Tiket terjual</span>
                    <strong><?php echo $stats['tickets_sold']; ?></strong>
                </article>
                <article class="admin-stat">
                    <span>Total pendapatan</span>
                    <strong><?php echo htmlspecialchars(order_price_label($stats['income'])); ?></strong>
                </article>
            </section>

            <section class="admin-analytics-grid">
                <article class="admin-panel analytics-card">
                    <div class="analytics-card-header">
                        <div>
                            <p class="admin-eyebrow">Tren</p>
                            <h2 class="admin-section-title">Penjualan Wisata</h2>
                        </div>
                    </div>

                    <div class="bar-chart" aria-label="Grafik penjualan wisata">
                        <?php if (!empty($chartRows)): ?>
                            <?php foreach ($chartRows as $row): ?>
                                <?php
                                    $ticketsSold = (int) $row['tickets_sold'];
                                    $barHeight = max(8, ($ticketsSold / $maxTicketsSold) * 100);
                                ?>
                                <div class="bar-chart-item">
                                    <div class="bar-track">
                                        <div class="bar-fill" style="height: <?php echo $barHeight; ?>%;"></div>
                                    </div>
                                    <strong><?php echo $ticketsSold; ?></strong>
                                    <span><?php echo htmlspecialchars($row['name']); ?></span>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="admin-empty">Belum ada data penjualan.</div>
                        <?php endif; ?>
                    </div>
                </article>

                <article class="admin-panel analytics-card">
                    <div class="analytics-card-header">
                        <div>
                            <p class="admin-eyebrow">Distribusi</p>
                            <h2 class="admin-section-title">Status Pesanan</h2>
                        </div>
                    </div>

                    <div class="status-donut-wrap">
                        <div class="status-donut" style="background: conic-gradient(#0157AD 0 <?php echo $successEnd; ?>%, #4E9CFF <?php echo $successEnd; ?>% <?php echo $pendingEnd; ?>%, #d93025 <?php echo $pendingEnd; ?>% <?php echo $failedEnd; ?>%, #dce9f8 <?php echo $failedEnd; ?>% 100%);">
                            <span><?php echo array_sum($statusCounts); ?></span>
                        </div>
                        <div class="status-legend">
                            <span><i class="legend-success"></i>Diterima: <?php echo $statusCounts['success']; ?></span>
                            <span><i class="legend-pending"></i>Menunggu: <?php echo $statusCounts['pending']; ?></span>
                            <span><i class="legend-failed"></i>Ditolak: <?php echo $statusCounts['failed']; ?></span>
                            <span><i class="legend-unpaid"></i>Belum bayar: <?php echo $statusCounts['unpaid']; ?></span>
                        </div>
                    </div>
                </article>
            </section>

            <section class="admin-panel admin-panel-spaced">
                <h2 class="admin-section-title">Penjualan per Wisata</h2>
                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Destinasi</th>
                                <th>Admin Tiket</th>
                                <th>Total Order</th>
                                <th>Tiket Terjual</th>
                                <th>Pendapatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($salesRows)): ?>
                            <?php foreach ($salesRows as $destination): ?>
                            <tr>
                                <td>
                                    <div class="admin-destination">
                                        <div>
                                            <strong><?php echo htmlspecialchars($destination['name']); ?></strong><br>
                                            <span><?php echo htmlspecialchars($destination['location']); ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars($destination['admin_name'] ?: 'Belum ditetapkan'); ?></td>
                                <td><?php echo (int) $destination['total_orders']; ?></td>
                                <td><?php echo (int) $destination['tickets_sold']; ?></td>
                                <td><?php echo htmlspecialchars(order_price_label($destination['income'])); ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="5">Belum ada data wisata.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="admin-panel admin-panel-spaced">
                <h2 class="admin-section-title">Pesanan Terbaru</h2>
                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>No Pesanan</th>
                                <th>Destinasi</th>
                                <th>Admin Tiket</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($recentOrders && $recentOrders->num_rows > 0): ?>
                            <?php while ($order = $recentOrders->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <strong><?php echo htmlspecialchars($order['order_number']); ?></strong><br>
                                    <span><?php echo date('d F Y H:i', strtotime($order['created_at'])); ?></span>
                                </td>
                                <td>
                                    <strong><?php echo htmlspecialchars($order['destination_name']); ?></strong><br>
                                    <span><?php echo (int) $order['quantity']; ?> tiket</span>
                                </td>
                                <td><?php echo htmlspecialchars($order['admin_name'] ?: 'Belum ditetapkan'); ?></td>
                                <td><?php echo htmlspecialchars(order_price_label($order['total_price'])); ?></td>
                                <td><span class="admin-chip"><?php echo htmlspecialchars(order_status_label($order['status'])); ?></span></td>
                            </tr>
                            <?php endwhile; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="5">Belum ada pesanan.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
