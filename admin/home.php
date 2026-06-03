<?php
require_once('./_auth.php');

header('Location: ' . ($isSuperAdmin ? 'dashboard.php' : 'tickets.php'));
exit;
?>
