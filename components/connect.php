<?php
session_start();

$host = 'localhost';
$user = 'root';
$pass = '';
$base = 'busk_baza';

$conn = mysqli_connect($host, $user, $pass, $base);

if (!$conn) {
    die('Ошибка подключения к базе данных');
}

mysqli_set_charset($conn, "utf8mb4");

function safe($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getUserLogin() {
    return $_SESSION['user_login'] ?? '';
}