<?php
// session_start();
require_once 'db.php';


$totalItems = 0;
$subtotal   = 0;

foreach ($_SESSION['cart'] ?? [] as $id => $qty) {

    $stmt = $pdo->prepare("SELECT price FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch();

    if (!$product) continue;

    $totalItems += $qty;
    $subtotal += $product['price'] * $qty;
    
}

$grandTotal = $subtotal;




?> 


