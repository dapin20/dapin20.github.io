<?php
require_once('../config/koneksi.php');

header('Content-Type: application/json; charset=utf-8');

$query = trim($_GET['q'] ?? '');
$results = [];
$seen = [];

if ($query !== '') {
    $prefix = $query . '%';
    $wordPrefix = '% ' . $query . '%';
    $contains = '%' . $query . '%';

    $stmt = $conn->prepare(
        "SELECT id, name, location, price, image, href, category
         FROM destinations
         WHERE name LIKE ? OR name LIKE ? OR location LIKE ? OR name LIKE ?
         ORDER BY
            CASE
                WHEN name LIKE ? THEN 0
                WHEN name LIKE ? THEN 1
                WHEN name LIKE ? THEN 2
                ELSE 3
            END,
            name ASC
         LIMIT 20"
    );
    $stmt->bind_param(
        "sssssss",
        $prefix,
        $wordPrefix,
        $prefix,
        $contains,
        $prefix,
        $wordPrefix,
        $contains
    );
    $stmt->execute();
    $data = $stmt->get_result();

    while ($row = $data->fetch_assoc()) {
        $uniqueKey = strtolower($row['name'] . '|' . $row['href']);
        if (isset($seen[$uniqueKey])) {
            continue;
        }

        $seen[$uniqueKey] = true;
        $results[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'location' => $row['location'],
            'price' => (int) $row['price'],
            'image' => $row['image'],
            'href' => $row['href'],
            'category' => $row['category'],
        ];

        if (count($results) >= 8) {
            break;
        }
    }

    $stmt->close();
}

echo json_encode($results);
?>
