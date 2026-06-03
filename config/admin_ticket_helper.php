<?php

function ensure_destination_admin_column($conn) {
    $check = $conn->query("SHOW COLUMNS FROM destinations LIKE 'admin_id'");
    if ($check && $check->num_rows === 0) {
        $conn->query("ALTER TABLE destinations ADD COLUMN admin_id INT DEFAULT NULL AFTER id");
        $conn->query("ALTER TABLE destinations ADD INDEX idx_destinations_admin (admin_id)");
    }
}

function sync_destination_to_database($conn, $destination) {
    ensure_destination_admin_column($conn);

    $adminId = $destination['owner_admin_id'] ?? null;
    $popular = !empty($destination['popular']) ? 1 : 0;
    $near = !empty($destination['near']) ? 1 : 0;
    $recommended = !empty($destination['recommended']) ? 1 : 0;

    $stmt = $conn->prepare(
        "INSERT INTO destinations (id, admin_id, name, location, price, rating, image, href, category, popular, near, recommended)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
         ON DUPLICATE KEY UPDATE
            admin_id = VALUES(admin_id),
            name = VALUES(name),
            location = VALUES(location),
            price = VALUES(price),
            rating = VALUES(rating),
            image = VALUES(image),
            href = VALUES(href),
            category = VALUES(category),
            popular = VALUES(popular),
            near = VALUES(near),
            recommended = VALUES(recommended)"
    );

    $stmt->bind_param(
        "sissidsssiii",
        $destination['id'],
        $adminId,
        $destination['name'],
        $destination['location'],
        $destination['price'],
        $destination['rating'],
        $destination['image'],
        $destination['href'],
        $destination['category'],
        $popular,
        $near,
        $recommended
    );
    $stmt->execute();
    $stmt->close();
}

function delete_destination_from_database($conn, $destinationId, $adminRole, $adminId) {
    ensure_destination_admin_column($conn);

    if ($adminRole === 'super_admin') {
        $stmt = $conn->prepare("DELETE FROM destinations WHERE id = ?");
        $stmt->bind_param("s", $destinationId);
    } else {
        $stmt = $conn->prepare("DELETE FROM destinations WHERE id = ? AND admin_id = ?");
        $stmt->bind_param("si", $destinationId, $adminId);
    }

    $stmt->execute();
    $stmt->close();
}

?>
