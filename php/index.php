<?php
include 'db.php';

// already logged in
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {

    $stmt = $pdo->prepare("SELECT * FROM users WHERE remember_me = ?");
    $stmt->execute([$_COOKIE['remember_token']]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['is_admin'] = $user['is_admin'];
    }
}

// load home page
include "../index2.php";
