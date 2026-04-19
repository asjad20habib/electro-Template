<?php
// include 'db.php';

session_start();

header('Content-Type: application/json');

$product_id = $_POST['id'] ?? null;

if (!$product_id) {
    echo json_encode([
        'status' => 'error',
        'message' => 'No product selected'
    ]);
    exit;
}

$cart = $_SESSION['cart'] ?? [];

// core cart logic
if (isset($cart[$product_id])) {
    $cart[$product_id]++;
} else {
    $cart[$product_id] = 1;
}

$_SESSION['cart'] = $cart;

echo json_encode([
    'status' => 'success',
    'message' => 'Product added to cart',
    'cart' => $_SESSION['cart']
]);
