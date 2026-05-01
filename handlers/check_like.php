<?php
session_start();
require_once '../components/connect.php';
header('Content-Type: application/json');

$rid = $_GET['recipe_id'] ?? 0;
$uid = $_SESSION['user_id'] ?? 0;
$liked = false;

if ($uid && $rid) {
    $q = "SELECT id FROM user_likes WHERE user_id = $uid AND recipe_id = $rid";
    $res = mysqli_query($conn, $q);
    $liked = mysqli_num_rows($res) > 0;
}

echo json_encode(['liked' => $liked]);