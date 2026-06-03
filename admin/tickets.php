<?php
require_once('./_auth.php');
require_once('../config/koneksi.php');
require_once('../config/order_helper.php');
require_once('../config/admin_ticket_helper.php');

ensure_order_payment_columns($conn);
ensure_destination_admin_column($conn);

$status = $_GET['status'] ?? 'all';
$allowedStatus = ['all', 'pending', 'success', 'failed', 'cancelled'];
if (!in_array($status, $allowedStatus, true)) {
    $status = 'all';
}

$sql = "SELECT o.*, u.username, u.email, d.name AS destination_name
        FROM orders o
        JOIN users u ON o.user_id = u.id
        JOIN destinations d ON o.destination_id = d.id";

$where = [];

if (!$isSuperAdmin) {
    $where[] = "d.admin_id = ?";
}

if ($status !== 'all') {
    $where[] = "o.status = ?";
}

$sql .= $where ? " WHERE " . implode(" AND ", $where) : "";
$sql .= " ORDER BY o.created_at DESC";
$stmt = $conn->prepare($sql);

if (!$isSuperAdmin && $status !== 'all') {
    $stmt->bind_param("is", $adminId, $status);
} elseif (!$isSuperAdmin) {
    $stmt->bind_param("i", $adminId);
} elseif ($status !== 'all') {
    $stmt->bind_param("s", $status);
}

$stmt->execute();
$orders = $stmt->get_result();

$summary = [
    'pending' => 0,
    'success' => 0,
    'failed' => 0,
    'total' => 0,
];
$summarySql = "SELECT o.status, COUNT(*) AS total
               FROM orders o
               JOIN destinations d ON o.destination_id = d.id";
if (!$isSuperAdmin) {
    $summarySql .= " WHERE d.admin_id = " . (int) $adminId;
}
$summarySql .= " GROUP BY o.status";
$summaryResult = $conn->query($summarySql);
if ($summaryResult) {
    while ($row = $summaryResult->fetch_assoc()) {
        $summary[$row['status']] = (int) $row['total'];
        $summary['total'] += (int) $row['total'];
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <script src="../assets/js/theme.js?v=3.4"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin WisataKu - Kelola Tiket</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="admin.css?v=1.1">
</head>
<body>
  <div class="admin-shell">
    <?php render_admin_sidebar('tickets', admin_role_label($adminRole) . ' - urus tiket customer.'); ?>

    <main class="admin-content">
      <div class="admin-topbar">
        <div>
          <p class="admin-eyebrow">Pesanan Customer</p>
          <h1>Kelola Tiket</h1>
          <p><?php echo $isSuperAdmin ? 'Pantau dan verifikasi pesanan dari semua loket wisata.' : 'Verifikasi bukti pembayaran untuk wisata yang dikelola loket Anda.'; ?></p>
        </div>
      </div>

      <section class="admin-stats">
        <article class="admin-stat"><span>Total pesanan</span><strong><?php echo $summary['total']; ?></strong></article>
        <article class="admin-stat"><span>Menunggu</span><strong><?php echo $summary['pending']; ?></strong></article>
        <article class="admin-stat"><span>Diterima</span><strong><?php echo $summary['success']; ?></strong></article>
        <article class="admin-stat"><span>Ditolak</span><strong><?php echo $summary['failed']; ?></strong></article>
      </section>

      <section class="admin-panel">
        <div class="admin-filterbar">
          <a class="admin-btn <?php echo $status === 'all' ? '' : 'secondary'; ?>" href="tickets.php">Semua</a>
          <a class="admin-btn <?php echo $status === 'pending' ? '' : 'secondary'; ?>" href="tickets.php?status=pending">Menunggu</a>
          <a class="admin-btn <?php echo $status === 'success' ? '' : 'secondary'; ?>" href="tickets.php?status=success">Diterima</a>
          <a class="admin-btn <?php echo $status === 'failed' ? '' : 'secondary'; ?>" href="tickets.php?status=failed">Ditolak</a>
        </div>

        <?php if ($orders->num_rows === 0): ?>
          <div class="admin-empty">Belum ada pesanan customer.</div>
        <?php else: ?>
          <div class="admin-table-wrap">
            <table class="admin-table">
              <thead>
                <tr>
                  <th>No Pesanan</th>
                  <th>Customer</th>
                  <th>Destinasi</th>
                  <th>Total</th>
                  <th>Bukti</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($order = $orders->fetch_assoc()): ?>
                  <tr>
                    <td>
                      <strong><?php echo htmlspecialchars($order['order_number']); ?></strong><br>
                      <span><?php echo date('d F Y H:i', strtotime($order['created_at'])); ?></span>
                    </td>
                    <td>
                      <strong><?php echo htmlspecialchars($order['username']); ?></strong><br>
                      <span><?php echo htmlspecialchars($order['email']); ?></span>
                    </td>
                    <td>
                      <strong><?php echo htmlspecialchars($order['destination_name']); ?></strong><br>
                      <span><?php echo (int) $order['quantity']; ?> tiket - <?php echo date('d F Y', strtotime($order['visit_date'])); ?></span>
                    </td>
                    <td><?php echo order_price_label($order['total_price']); ?></td>
                    <td>
                      <?php if (!empty($order['payment_proof'])): ?>
                        <a class="admin-proof-link" href="../<?php echo htmlspecialchars($order['payment_proof']); ?>" target="_blank">Lihat Bukti</a>
                      <?php else: ?>
                        <span>-</span>
                      <?php endif; ?>
                    </td>
                    <td><span class="admin-chip"><?php echo order_status_label($order['status'], $order['payment_proof']); ?></span></td>
                    <td>
                      <?php if ($order['status'] !== 'success'): ?>
                        <div class="admin-actions">
                          <form action="update_order_status.php" method="POST">
                            <input type="hidden" name="order_id" value="<?php echo (int) $order['id']; ?>">
                            <input type="hidden" name="action" value="accept">
                            <button type="submit" class="admin-btn">Terima</button>
                          </form>
                          <form action="update_order_status.php" method="POST">
                            <input type="hidden" name="order_id" value="<?php echo (int) $order['id']; ?>">
                            <input type="hidden" name="action" value="reject">
                            <button type="submit" class="admin-btn danger">Tolak</button>
                          </form>
                        </div>
                      <?php else: ?>
                        <span>Selesai</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>
      </section>
    </main>
  </div>
</body>
</html>
<?php $stmt->close(); ?>
