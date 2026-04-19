<?php
session_start(); // ✅ Fix: session_start() zaroori tha
include 'db.php';

if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("UPDATE users SET remember_me = NULL WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
}

$_SESSION = [];
session_destroy();

setcookie("remember_token", "", time() - 3600, "/");

header("Location: login.php");
exit;