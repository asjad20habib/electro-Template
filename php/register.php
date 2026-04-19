<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $name        = $_POST['name']        ?? '';
    $email       = $_POST['email']       ?? '';
    $rawPass     = $_POST['password']    ?? '';
    $secret_code = $_POST['secret_code'] ?? '';

    // 1 — Validation
    if ($name === '' || $email === '' || $rawPass === '') {
        echo "All fields are required";
        exit;
    }

    // 2 — Email already exists check
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        header("Location: log.php?error=email_exists");
        exit;
    }

    // 3 — Admin check via secret code
    $is_admin = ($secret_code === 'asjad@admin123') ? 1 : 0;

    // 4 — Hash password
    $pass = password_hash($rawPass, PASSWORD_DEFAULT);

    // 5 — Insert user
    $insert = $pdo->prepare("
        INSERT INTO users (name, email, password, is_admin) 
        VALUES (?, ?, ?, ?)
    ");
    $insert->execute([$name, $email, $pass, $is_admin]);

    // 6 — Redirect
    header("Location: log.php?success=registered");
    exit;
}
?>