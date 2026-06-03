<?php
require_once('./_auth.php');
require_once('../config/koneksi.php');
require_once('../config/admin_ticket_helper.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $destination = find_destination($id);

    if ($destination && ($isSuperAdmin || destination_belongs_to_admin($destination, $adminId))) {
        $destinations = array_values(array_filter(load_destinations(), function ($destination) use ($id, $isSuperAdmin, $adminId) {
            if ($destination['id'] !== $id) {
                return true;
            }

            return !$isSuperAdmin && !destination_belongs_to_admin($destination, $adminId);
        }));

        save_destinations($destinations);
        delete_destination_from_database($conn, $id, $adminRole, $adminId);
    }
}

header('Location: destinations.php');
exit;
