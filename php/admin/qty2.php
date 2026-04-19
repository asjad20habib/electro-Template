<?php
session_start();
header('Content-Type: application/json');

$id   = $_POST['id']   ?? null;
$type = $_POST['type'] ?? null;

if (!$id || !$type) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request'
    ]);
    exit;
}

$stock = 5;
// $currentQty = 0;

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (!isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id] = 0;
}

$currentQty = $_SESSION['cart'][$id];

if ($type === 'plus') {

    if ($currentQty >= $stock) {
        echo json_encode([
            'success' => false,
            'message' => 'Stock limit reached',
            'qty' => $currentQty
        ]);
        exit;
    }

    $_SESSION['cart'][$id]++;
    $currentQty++;
}

if ($type === 'minus') {

    if ($currentQty < 0) {
        unset($_SESSION['cart'][$id]);
        
        echo json_encode([
            'success' => true,
            'qty' => 0
        ]);
        exit;
    }

    $_SESSION['cart'][$id]--;
    $currentQty--;
}

/* 6️⃣ final response */
echo json_encode([
    'success' => true,
    'qty' => $currentQty
]);
