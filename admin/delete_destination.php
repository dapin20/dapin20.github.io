<?php
require_once('./_auth.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $destinations = array_values(array_filter(load_destinations(), function ($destination) use ($id) {
        return $destination['id'] !== $id;
    }));

    save_destinations($destinations);
}

header('Location: destinations.php');
exit;
