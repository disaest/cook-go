<?php
function safe($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getUserLogin() {
    return $_SESSION['user_login'] ?? '';
}