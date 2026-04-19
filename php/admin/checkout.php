<?php

session_start();


ini_set('display_errors', 0);
error_reporting(0);
require_once __DIR__ . '/db.php';

header('Content-Type: application/json');

if (empty($_POST)) {
    echo json_encode(["success" => false, "message" => "POST empty"]);
    exit;
}

$product_id = intval($_POST['product_id'] ?? $_POST['id'] ?? 0);
$name       = trim($_POST['Name']    ?? $_POST['name']    ?? '');
$phone      = trim($_POST['Phone']   ?? $_POST['phone']   ?? '');
$address    = trim($_POST['Address'] ?? $_POST['address'] ?? '');
$user_id    = $_SESSION['user_id'] ?? 0;

if (!$product_id || $name === '' || $phone === '' || $address === '') {
    echo json_encode(["success" => false, "message" => "Missing fields"]);
    exit;
}

$q = "INSERT INTO orders (product_id, Name, Phone, Address, user_id, status) VALUES (?, ?, ?, ?, ?, 'pending')";
$stmt = $pdo->prepare($q);
$stmt->execute([$product_id, $name, $phone, $address, $user_id]);

echo json_encode(["success" => true, "message" => "Order placed!"]);

?>