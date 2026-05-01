<?php
require_once '../components/connect.php';

$recipe_id = (int)($_GET['id'] ?? 0);
$step = (int)($_GET['step'] ?? 0);

$q = "SELECT image_data, image_type FROM step_images WHERE recipe_id = $recipe_id AND step_number = $step";
$res = mysqli_query($conn, $q);

if ($res && mysqli_num_rows($res) > 0) {
    $row = mysqli_fetch_array($res);
    header('Content-Type: ' . $row['image_type']);
    echo $row['image_data'];
    exit;
}

header('Content-Type: image/gif');
echo base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7');
exit;