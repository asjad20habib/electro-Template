<?php
session_start();
// include 'db.php';
require_once __DIR__ . '/db.php';


header('Content-Type: application/json');

$product_id = $_POST['id'] ?? null;


if (!$product_id) {
    echo json_encode(['message' => 'No product selected']);
    exit;
}


$cart = $_SESSION['cart'] ?? [];

if (isset($cart[$product_id])) {
    
    $cart[$product_id]++;
} 

else {
    $cart[$product_id] = 1;
}

$_SESSION['cart'] = $cart;

echo json_encode([
    'message' => 'Product added',
    'cart' => $cart
]);
