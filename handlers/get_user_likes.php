<?php
session_start();
require_once '../components/connect.php';
header('Content-Type: application/json');

$uid = $_SESSION['user_id'] ?? 0;
$likes = [];

if ($uid) {
    $q = "SELECT recipe_id FROM user_likes WHERE user_id = $uid";
    $res = mysqli_query($conn, $q);
    while ($row = mysqli_fetch_array($res)) {
        $likes[] = (int)$row['recipe_id'];
    }
}

echo json_encode(['likes' => $likes]);