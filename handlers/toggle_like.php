<?php
session_start();
require_once '../components/connect.php';
header('Content-Type: application/json');

$response = ['success' => false];

if (!isset($_SESSION['user_id'])) {
    echo json_encode($response);
    exit;
}

$uid = $_SESSION['user_id'];
$rid = $_POST['recipe_id'] ?? 0;
$action = $_POST['action'] ?? '';

if (!$rid || !in_array($action, ['like', 'unlike'])) {
    echo json_encode($response);
    exit;
}

if ($action === 'like') {
    mysqli_query($conn, "INSERT IGNORE INTO user_likes (user_id, recipe_id) VALUES ($uid, $rid)");
    mysqli_query($conn, "UPDATE recipes SET likes = likes + 1 WHERE id = $rid");
} else {
    mysqli_query($conn, "DELETE FROM user_likes WHERE user_id = $uid AND recipe_id = $rid");
    mysqli_query($conn, "UPDATE recipes SET likes = GREATEST(likes - 1, 0) WHERE id = $rid");
}

$response['success'] = true;
echo json_encode($response);