<?php

session_start();
header('Content-Type: application/json');

$id = $_POST['id'] ?? null;

if (!$id) {
    echo json_encode([
        'success' => false,
        'message' => 'No product specified'
    ]);
    exit;
}

if (isset($_SESSION['cart'][$id])) {
    unset($_SESSION['cart'][$id]);
    echo json_encode([
        'success' => true,
        'message' => 'Product removed'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Product not found in cart'
    ]);
}

