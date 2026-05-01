<?php
require_once '../components/connect.php';

$id = (int)($_GET['id'] ?? 0);
$q = "SELECT image_data, image_type FROM recipes WHERE id = $id";
$res = mysqli_query($conn, $q);

if ($res) {
    $row = mysqli_fetch_array($res);
    if ($row && !empty($row['image_data'])) {
        header('Content-Type: ' . ($row['image_type'] ?? 'image/jpeg'));
        echo $row['image_data'];
        exit;
    }
}

header('Content-Type: image/png');
$logo = '../images/ui/logo.png';
if (file_exists($logo)) {
    readfile($logo);
}
exit;