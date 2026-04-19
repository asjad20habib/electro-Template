<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLogged() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLogged()) {
        header("Location: /electro-Template/php/login.php");
        exit;
    }
}
