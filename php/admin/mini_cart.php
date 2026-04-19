<?php
session_start();
// require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/db.php';


// $id   = $_GET['id']   ?? null;



$items = [];
$subtotal = 0;

foreach ($_SESSION['cart'] ?? [] as $id => $qty) {

    $stmt = $pdo->prepare("SELECT name, price, image FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) continue;

    $lineTotal = $product['price'] * $qty;
    $subtotal += $lineTotal;


    $items[] = [
        'id'    => $id,
        'name'  => $product['name'],       
        'price' => $product['price'],
        'image' => $product['image'],
        'qty'   => $qty
    ];
}

echo json_encode([     
    'success'  => true,
    'items'    => $items,
    'subtotal' => $subtotal
]);  



?>