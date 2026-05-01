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

require_once __DIR__ . '/functions.php';